<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このユーザがお気に入りしたユーザの投稿。（ Userモデルとの関係を定義）
     */
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'user_favorites', 'user_id', 'microposts_id')->withTimestamps();
    }
}
