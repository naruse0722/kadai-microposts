<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index () 
    {
        $data = [];
            if(\Auth::check()) {
                $user = \Auth::user();
                $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);
                $data = [
                    'user' => $user,
                    'microposts' => $microposts,
                    ];
            }
        return view('welcome', $data);
    }
    
    public function store (Request $request) {
          // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy ($id) {
        $microposts = \App\Micropost::findOrFail($id);
        
        if(\Auth::id() === $microposts->user_id) {
            $microposts->delete();
        }
        
        return back();
    }
    
}
