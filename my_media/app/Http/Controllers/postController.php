<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    //
    private function validationForPostCreate($request)
    {
        return Validator::make($request->all(), [
            'postName' => 'required',
            'postDescription' => 'required',
            'categoryId' => 'required',
        ]);
    }

    private function createPost($request, $imageFile)
    {
        return [
            'title' => $request->postName,
            'description' => $request->postDescription,
            'image' => $imageFile,
            'category_id' => $request->categoryId
        ];
    }

    public function homePost()
    {

        $post = DB::table('posts')->get();

        $category = DB::table('categories')
            ->select('category_id', 'title')
            ->get();
        return view('admin.post.index', compact('category', 'post'));
    }

    //create new post
    public function postNew(Request $request)
    {
        $validator = $this->validationForPostCreate($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        };
        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);

            $data = $this->createPost($request, $fileName);
        } else {
            $data = $this->createPost($request, NULL);
        }
        DB::table('posts')
            ->insert($data);

        return back();
    }

    //post delete
    public function postDelete($id)
    {
        $dbImage = DB::table('posts')->select('image')->where('post_id', $id)->first();
        DB::table('posts')
            ->where('post_id', $id)->delete();
        if (File::exists(public_path() . '/postImage/' . $dbImage->image)) {
            File::delete(public_path() . '/postImage/' . $dbImage->image);
        };
        return back();
    }

    //Data for post update page
    public function updatePost($id)
    {
        $category = DB::table('categories')
            ->select('category_id', 'title')
            ->get();
        $postData = DB::table('posts')
            ->where('post_id', $id)
            ->first();

        return view('admin.post.updatePost', compact('postData', 'category'));
    }

    //post updating
    public function UpdatingPost(Request $request)
    {
        $validator = $this->validationForPostCreate($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        };

        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);

            $data = $this->createPost($request, $fileName);

            $dbImage = DB::table('posts')->select('image')->where('post_id', $request->postId)->first();
            if (File::exists(public_path() . '/postImage/' . $dbImage->image)) {
                File::delete(public_path() . '/postImage/' . $dbImage->image);
            };
        } else {
            $data = $this->createPost($request, NULL);
        }
        DB::table('posts')
            ->where('post_id', $request->postId)
            ->update($data);
        return back()->with('postUpdateSuccess', 'Post Updating successfully');
    }
}
