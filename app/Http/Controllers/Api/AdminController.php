<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /** [getCategories 分类列表] */
    public function getCategories(Request $request)
    {
        $q = $request->get('q');

        return Category::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }
}
