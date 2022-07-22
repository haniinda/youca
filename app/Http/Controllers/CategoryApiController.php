<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    //
    public function index(){
        return Category::all();
    }

    public function show($id)
    {
        return Category::query()->firstOrFail($id);
    }
}
