<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    //

    private function validationForCategory($request)
    {
        return Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);
    }

    private function creatingNewCategory($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
        ];
    }

    public function homeCategory()
    {
        $allCategories = DB::table('categories')
            ->select('category_id', 'title', 'description')
            ->get();
        return view('admin.category.index', compact('allCategories'));
    }

    public function homeCategoryCreate(Request $request)
    {
        $validator = $this->validationForCategory($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $createCategory = $this->creatingNewCategory($request);
        DB::table('categories')->insert($createCategory);
        return back();
    }

    public function homeCategorySearch(Request $request)
    {
        $allCategories = DB::table('categories')
            ->orWhere(DB::raw('lower(title)'), 'LIKE', '%' . strtolower($request->searchKey) . '%')
            ->orWhere(DB::raw('lower(description)'), 'LIKE', '%' . strtolower($request->searchKey) . '%')
            ->get();
        return view('admin.category.index', compact('allCategories'));
    }

    public function deleteCategory($id)
    {
        DB::table('categories')->where('category_id', $id)->delete();
        return back();
    }

    public function updateCategory($id)
    {
        $categoryData = DB::table('categories')->where('category_id', $id)->first();
        return view('admin.category.updateCategory', compact('categoryData'));
    }

    public function newCategory(Request $request)
    {
        $validator = $this->validationForCategory($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('categories')
            ->where('category_id', $request->categoryId)
            ->update([
                'title' => $request->categoryName,
                'description' => $request->categoryDescription,
            ]);
        return back()->with('success', 'updated successfully');
    }
}
