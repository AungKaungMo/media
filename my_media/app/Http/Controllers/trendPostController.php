<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class trendPostController extends Controller
{
    //
    public function homeTrendpost()
    {
        return view('admin.trend_post.index');
    }
}
