<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function store(Request $requst, Post $post) {

        $post->likes()->create([
            'user_id' => $requst->user()->id
        ]);

        return back();

    }

    public function destroy(Request $request, Post $post) {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();

    }
}
