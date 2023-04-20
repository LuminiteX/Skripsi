<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function send(Request $request, Restaurant $restaurant){
        $request->validate([
            'comment' => 'required',
        ]);

        $user = Auth::user();

        Comment::create([
            'restaurant_id'=>$restaurant->id,
            'user_id' => $user->id,
            'comment' =>$request->comment
        ]);

        return back();
    }

    public function reply(Request $request, Restaurant $restaurant){
        $request->validate([
            'comment' => 'required',
        ]);
        $user = Auth::user();
        // dd($request->comment_id);
        Comment::create([
            'restaurant_id'=>$restaurant->id,
            'user_id' => $user->id,
            'comment' =>$request->comment,
            'parent' => $request->comment_id
        ]);

        return back();
    }

    public function destroy(Comment $comments){

        if($comments->parent == 0){
            Comment::whereIn('parent',[$comments->id])->delete();
        }
        $comments->delete();

        return back();
    }
}
