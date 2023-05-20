<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiCategoryController extends Controller
{
    //
    public function allCategory()
    {
        $category = DB::table('categories')->select('category_id', 'title', 'description')->get();
        return response()->json([
            'category' => $category
        ]);
    }

    public function chooseCategory(Request $request)
    {
        $choosingData = Category::select('posts.*')
            ->join('posts', 'categories.category_id', 'posts.category_id')
            ->where('categories.title', 'LIKE', '%' . $request->key . '%')
            ->get();

        return response()->json([
            'choosingData' => $choosingData
        ]);
    }
}
