<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
    // 住所編集フォーム表示
    public function edit($item_id)
    {
        $user = Auth::user();

        $address = Address::where('user_id', $user->id)->first();

        return view('purchase.address', compact('address', 'item_id'));
    }

    // 住所更新
    public function updatePurchaseAddress(AddressRequest $request, $item_id)
    {
        $request->validate([
            'postal_code' => 'required',
            'address' => 'required',
            'building' => 'nullable'
        ]);

        $user = Auth::user();

        Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building
            ]
        );

        return redirect('/purchase/' . $item_id);
    }
}
