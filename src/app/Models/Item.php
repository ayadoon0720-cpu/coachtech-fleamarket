<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'brand',
        'price',
        'description',
        'image',
        'is_sold',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 商品状態
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    // カテゴリ（多対多）
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item')
                    ->withTimestamps();
    }

    // いいね
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // コメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 購入（1対1）
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    // 売却済み判定
    public function isSold()
    {
        return $this->purchase()->exists();
    }
}