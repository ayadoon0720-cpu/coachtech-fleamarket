<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('addresses')->insert([
        [
          'user_id' => 1,
          'postal_code' => '100-0001',
          'address' => '京都府京都市中京区堀川町１丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 2,
          'postal_code' => '100-0002',
          'address' => '京都府京都市中京区堀川町2丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 3,
          'postal_code' => '100-0003',
          'address' => '京都府京都市中京区堀川町3丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 4,
          'postal_code' => '100-0004',
          'address' => '京都府京都市中京区堀川町4丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 5,
          'postal_code' => '100-0005',
          'address' => '京都府京都市中京区堀川町5丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 6,
          'postal_code' => '100-0006',
          'address' => '京都府京都市中京区堀川町6丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 7,
          'postal_code' => '100-0007',
          'address' => '京都府京都市中京区堀川町7丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 8,
          'postal_code' => '100-0008',
          'address' => '京都府京都市中京区堀川町8丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 9,
          'postal_code' => '100-0009',
          'address' => '京都府京都市中京区堀川町9丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],

        [
          'user_id' => 10,
          'postal_code' => '100-0010',
          'address' => '京都府京都市中京区堀川町10丁目',
          'building' => null,
          'created_at' => now(),
          'updated_at' => now(),
        ],
    ]);
    }
}
