<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '山田花子',
                'email' => 'hanako@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'flower.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '佐藤太郎',
                'email' => 'taro@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'サッカーボール.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '鈴木結衣',
                'email' => 'yui@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'食パン.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '田中健',
                'email' => 'ken@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'野球ボール.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '伊藤大地',
                'email' => 'daichi@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'陸上.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '小林美香',
                'email' => 'mika@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'テニスボール.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '中村亮',
                'email' => 'ryo@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'卓球.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '加藤葵',
                'email' => 'aoi@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'犬くま.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '吉田空',
                'email' => 'sora@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'バスケットボール.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '山本芽依',
                'email' => 'mei@test.com',
                'password' => Hash::make('password'),
                'profile_image' =>'女の子.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}