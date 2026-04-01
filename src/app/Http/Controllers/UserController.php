<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class UserController extends Controller
{
   // マイページ
   public function mypage(Request $request)
   {
       $user = Auth::user();

    // 表示するページ
       $page = $request->query('page', 'sell');

       if ($page === 'buy') {
       // 購入した商品
          $items = $user->purchases()
          ->with('item')
          ->get()
          ->pluck('item');
       } else {
       // 出品した商品
          $items = Item::where('user_id', $user->id)->get();
       }

       return view('profile.index', compact('user','items','page'));
   }

   public function saveInitialProfile(Request $request)
   {
       $user = Auth::user();

    // バリデーション
       $request->validate([
         'name' => 'required|string|max:255',
       ]);

       $user->name = $request->name;
       $user->save();

    // 保存後は商品一覧画面に遷移
       return redirect('/');
   }

   // 初回登録時プロフィール設定画面表示
   public function initialProfile()
   {
        return view('profile.initial');
   }

   // 初回登録時プロフィール更新情報
   public function initialProfileUpdate(ProfileRequest $request)
   {
       $user = auth()->user();

    // バリデーション
       $request->validate([
        'name' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png',
       ]);

    // ユーザー情報更新
        $user->name = $request->name;

    // 住所情報はリレーション経由で保存
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

    // 画像処理
        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $path = $image->store('items', 'public'); // storage/app/public/profile_images
           $user->profile_image = $path;
        }

        $user->save();

    // 更新後トップページへリダイレクト
        return redirect('/');
   }

   // プロフィール編集
   public function edit()
   {
        $user = Auth::user();
        $address = $user->address;

        return view('profile.edit', compact('user', 'address'));
   }

   public function update(ProfileRequest $request)
   {
       $user = auth()->user();

    // ユーザー更新
       $user->name = $request->name;

    // 住所更新
       $user->address()->updateOrCreate(
          ['user_id' => $user->id],
          [
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
          ]
       );

    // 画像更新
       if ($request->hasFile('image')) {
        $path = $request->file('image')->store('items', 'public');
        $user->profile_image = $path;
       }

       $user->save();

       return redirect('/mypage');
   }

   public function profile(Request $request)
   {
       $user = Auth::user();

       if ($request->page === 'buy') {
       // 購入した商品
          $items = $user->purchases()->with('item')->get()->pluck('item');
       } else {
       // 出品した商品
          $items = Item::where('user_id', $user->id)->get();
       }

       return view('profile.index', [
          'user' => $user,
          'items' => $items,
          'page' => $request->page ?? 'sell',
       ]);
   }
}