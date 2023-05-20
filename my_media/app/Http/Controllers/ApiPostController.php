<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{
    //
    public function allPost()
    {
        $post = DB::table('posts')->get();
        return response()->json([
            'post' => $post
        ]);
    }
    public function searchPost(Request $request)
    {
        $searchData =
            DB::table('posts')
            ->orWhere(DB::raw('lower(title)'), 'LIKE', '%' . strtolower($request->key) . '%')
            ->orWhere(DB::raw('lower(description)'), 'LIKE', '%' . strtolower($request->key) . '%')->get();
        return response()->json([
            'searchData' => $searchData
        ]);
    }
    public function postDetails(Request $request)
    {
        $postDetail = Post::where('post_id', $request->key)->first();
        return response()->json([
            'postDetail' => $postDetail
        ]);
    }
}
