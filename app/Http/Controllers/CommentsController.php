<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        
        // バリデーション
        $request->validate([
            'content' => ['required', 'string', 'max:140'],
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        $savedata = [
            'microposts_id' => $request->micropost_id,
            'comment' => $request->comment,
        ];
 
        $comment = new Comment;
        $comment->fill($savedata)->save();
 
        return redirect()->route('user.show', [$savedata['post_id']])->with('commentstatus','コメントを投稿しました');
    }
    
}
