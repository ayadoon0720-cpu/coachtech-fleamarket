<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'user_id' => 1,
                'name' => '腕時計',
                'price' => '15000',
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image' => 'items/watch.jpg',
                'condition_id' => 1,
                'categories' => [1,12],
            ],
            [
                'user_id' => 2,
                'name' => 'HDD',
                'price' => '5000',
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image' => 'items/hard-disk.jpg',
                'condition_id' => 2,
                'categories' => [2,8],
            ],
            [
                'user_id' => 3,
                'name' => '玉ねぎ３束',
                'price' => '300',
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ３束のセット',
                'image' => 'items/onion.jpg',
                'condition_id' => 3,
                'categories' => [10],
            ],
            [
                'user_id' => 4,
                'name' => '革靴',
                'price' => '4000',
                'brand' => null,
                'description' => 'クラシックなデザインの革靴',
                'image' => 'items/leather-shoes.jpg',
                'condition_id' => 4,
                'categories' => [1,5],
            ],
            [
                'user_id' => 5,
                'name' => 'ノートPC',
                'price' => '45000',
                'brand' => null,
                'description' => '高性能なノートパソコン',
                'image' => 'items/pc.jpg',
                'condition_id' => 1,
                'categories' => [2,8],
            ],
            [
                'user_id' => 6,
                'name' => 'マイク',
                'price' => '8000',
                'brand' => 'なし',
                'description' => '高音質のレコーディング用マイク',
                'image' => 'items/microphone.jpg',
                'condition_id' => 2,
                'categories' => [2,8],
            ],
            [
                'user_id' => 7,
                'name' => 'ショルダーバッグ',
                'price' => '3500',
                'brand' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'image' => 'items/bag.jpg',
                'condition_id' => 3,
                'categories' => [1,4],
            ],
            [
                'user_id' => 8,
                'name' => 'タンブラー',
                'price' => '500',
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'image' => 'items/tumbler.jpg',
                'condition_id' => 4,
                'categories' => [10],
            ],
            [
                'user_id' => 9,
                'name' => 'コーヒーミル',
                'price' => '4000',
                'brand' => 'starbacks',
                'description' => '手動のコーヒーミル',
                'image' => 'items/coffee-mill.jpg',
                'condition_id' => 1,
                'categories' => [10],
            ],
            [
                'user_id' => 10,
                'name' => 'メイクセット',
                'price' => '2500',
                'brand' => null,
                'description' => '便利なメイクアップセット',
                'image' => 'items/makeup-set.jpg',
                'condition_id' => 2,
                'categories' => [6],
            ],
        ];

        foreach ($items as $data) {

            // categoriesだけ別にする
            $categories = $data['categories'];
            unset($data['categories']);

            // item作成
            $item = Item::create($data);

            // カテゴリー紐付け
            $item->categories()->attach($categories);
        }
    }
}
