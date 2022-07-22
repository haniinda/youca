<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view("category/index", compact("categories"));
    }


    public function create()
    {
        return view("category/create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|unique:categories,category'
        ] , [
            'category.required' => 'you have to enter category’s name to add!!!!'
        ]);
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        return  redirect("/category");
    }



    public function edit(int $id)
    {
        $category = Category::query()->findOrFail($id);
        return view("category/edit", compact("category"));
    }

    public function update(Request $request, int $id)
    {
        $category = Category::query()->where('id', $id)->first();
        $category->update($request->all());
        return  redirect("/category");
    }

    public function delete($id)
    {
        $category = Category::query()->findOrFail($id);
        return view("category/delete", compact("category"));
    }

    public function destroy(int $id)
    {
        $category = Category::destroy($id);
        return redirect("category");
    }
}
