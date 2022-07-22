<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::query()->paginate(10);
        return view("companyTypes/index", compact("types"));
    }


    public function create()
    {
        return view("companyTypes/create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|unique:types,type'
        ], [
            'type.required' => 'you have to enter type name to add!!!!',
        ]);
        $type = new Type();
        $type->fill($request->all());
        $type->save();
        return  redirect("/companyTypes");
    }


    public function edit(int $id)
    {
        $type = Type::query()->findOrFail($id);
        return view("companyTypes/edit", compact("type"));
    }


    public function update(Request $request, int $id)
    {
        $type = Type::query()->where('id', $id)->first();
        $type->update($request->all());
        return  redirect("/companyTypes");
    }


    public function delete($id)
    {
        $type = Type::query()->findOrFail($id);
        return view("companyTypes/delete", compact("type"));
    }

    public function destroy(int $id,Request $request)
    {
        $companies= Company::query()->where('type_id',$id)->count();
        if($companies>0)
        {
            $request->validate([
                "required" => "required"
            ], [
                "required.required" => "can not delete this type  because contain many company"
            ]);
        }
        $type = Type::query()->findOrFail($id);
        $type->delete();
        return redirect("companyTypes");
    }
}
