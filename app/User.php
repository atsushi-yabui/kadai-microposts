<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
     * このユーザが所有する投稿。（ Micropostモデルとの関係を定義）
     */
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['microposts', 'followings', 'followers','favorites']);
    }
    

    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_microposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Micropost::whereIn('user_id', $userIds);
    }
    
    /**
     * このユーザがお気に入りしたユーザの投稿。（ Userモデルとの関係を定義）
     */
    public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'user_favorites', 'user_id', 'microposts_id')->withTimestamps();
    }

    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function favorite($micropostsId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_favoriting($micropostsId);
        // 対象が自分自身かどうかの確認
        //$its_me = $this->id == $micropostsId;

        if ($exist) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->favorites()->attach($micropostsId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfavorite($micropostsId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_favoriting($micropostsId);
        // 対象が自分自身かどうかの確認
        //$its_me = $this->id == $userId;

        if ($exist) {
            // すでにフォローしていればフォローを外す
            $this->favorites()->detach($micropostsId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_favoriting($micropostsId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->favorites()->where('microposts_id', $micropostsId)->exists();
    }
    
    /**
     * ユーザー検索
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchUser(Request $request)
    {
        $query = $this->query();
        if ($request->input('email')) {
            $query->where('email', $request->input('email'));
        }

        if ($request->input('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        $direction = $request->input('direction', 'desc');
        if ($request->input('sort')) {
            $query->orderBy($request->input('sort'), $direction);
        } else {
            $query->orderBy('id', $direction);
        }

        return $query->paginate();
    }
    
    /**
     * このユーザが所有するコメント。（ Commentモデルとの関係を定義）
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function is_commenting($micropostsId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->comments()->where('microposts_id', $micropostsId)->exists();
    }
    
}
