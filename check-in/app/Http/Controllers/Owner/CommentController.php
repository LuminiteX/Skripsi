<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $restaurant = Auth::user()->restaurant;
        $comments =  Comment::where('restaurant_id', [$restaurant->id])->where('parent', 0)->orderBy('created_at', 'desc')->get();

        //  dd($restaurant->id);

        return view('owner.comment.index', compact('comments','restaurant'));
    }

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

        return redirect()->route('owner.comments.index');
    }

    public function reply(Comment $comments){
        if (!$comments) {
            dd('hit');
        }

        // dd($comments);
        $restaurant = Auth::user()->restaurant;
        $comment_id = $comments->id;
        $repliedComments =  Comment::where('id', $comments->id)->where('parent', 0)->orderBy('created_at', 'desc')->get();
        // dd($comments);
        return view('owner.comment.reply_comment', compact('repliedComments','restaurant','comment_id'));
    }

    public function sendReply(Request $request, Restaurant $restaurant){

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

        return redirect()->route('owner.comments.index');
    }

    public function destroy(Comment $comments){

        if($comments->parent == 0){
            Comment::whereIn('parent',[$comments->id])->delete();
        }
        $comments->delete();

        return redirect()->route('owner.comments.index');
    }
}
