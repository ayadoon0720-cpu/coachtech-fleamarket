<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;
use App\Models\Purchase;
use App\Models\Address;

class ItemController extends Controller
{
   // 商品一覧
   public function index(Request $request)
   {
      // マイリストタブ
        if ($request->query('tab') === 'mylist') {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $items = Item::whereHas('likes', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        })
        ->get();

        return view('index', compact('items'));
        }

      // おすすめ（全商品）
         $items = Item::query()

      // 検索
         ->when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
         })

      //自分の商品を除外
         ->when(auth()->check(), function ($query) {
            $query->where('user_id', '!=', auth()->id());
         })
         ->get();

         return view('index', compact('items'));
   }

   // 商品詳細
   public function detail($item_id)
   {
       $item = Item::with([
        'categories',
        'comments.user',
        'likes',
        'condition'
       ])->findOrFail($item_id);

       $like_count = $item->likes->count();
       $comment_count = $item->comments->count();

       $liked = false;

       if (Auth::check()) {
        $liked = Like::where('user_id', Auth::id())
            ->where('item_id', $item_id)
            ->exists();
       }

       return view('detail', compact(
          'item',
          'like_count',
          'comment_count',
          'liked'
       ));
   }

   // 商品購入画面
   public function purchase($item_id)
   {
       $item = Item::findOrFail($item_id);
       $user = Auth::user();

    // アイテムごとに紐づく住所を取得
       $address = Address::where('user_id', $user->id)->first();

       return view('purchase.index', [
        'item' => $item,
        'address' => $address,
       ]);
   }

   // 購入処理
   public function purchaseStore(purchaseRequest $request, $item_id)
   {
       $item = Item::findOrFail($item_id);
       $user = Auth::user();

       Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentMethod = $request->payment_method;

    // 支払い方法設定
        if ($paymentMethod === 'card') {
            $methods = ['card'];
        } elseif ($paymentMethod === 'konbini') {
            $methods = ['konbini'];
        } else {
            abort(400);
        }

    // コンビニだけここで保存
        if ($paymentMethod === 'konbini') {
            Purchase::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'payment_method' => 'konbini',
                'address_id' => Address::where('user_id', $user->id)->value('id'),
            ]);

            $item->update([
                'is_sold' => true,
            ]);
        }

        $session = Session::create([
            'payment_method_types' => $methods,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/purchase/success/' . $item->id),
            'cancel_url' => url('/'),
        ]);

        return redirect($session->url);
   }

   public function success($item_id)
   {
      $item = Item::findOrFail($item_id);
      $user = Auth::user();

      if (!Purchase::where('item_id', $item->id)->where('user_id', $user->id)->exists()) {

    // 購入履歴
      Purchase::create([
        'user_id' => $user->id,
        'item_id' => $item->id,
        'payment_method' => 'card',
        'address_id' => Address::where('user_id', $user->id)->value('id'),
      ]);

    // soldにする
      $item->update([
        'is_sold' => true,
      ]);
      }
    return redirect('/');
   }

   // 商品出品画面
   public function create()
   {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('create', compact('categories', 'conditions'));
   }

   public function store(ExhibitionRequest $request)
   {
        $path = $request->file('image')->store('items', 'public');

        $item = Item::create([
           'name' => $request->name,
           'brand' => $request->brand,
           'description' => $request->description,
           'price' => $request->price,
           'condition_id' => $request->condition,
           'image' => $path,
           'user_id' => auth()->id()
        ]);

        $item->categories()->attach($request->categories);

        return redirect('/');
   }
}