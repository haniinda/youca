<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function index()
    {
        $data = Company::query()->paginate(10);
        return view("Clients/index", compact("data"));

    }


    public function create()
    {
        $types = Type::all();
        return view("Clients/create", compact("types"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'picture' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,bmp',
            'type_id' => 'required|integer'
        ], [
            'name.required' => 'PLEASE ENTER COMPANYS NAME',
            'location.required' => 'PLEASE ENTER COMPANYS LOCATION ',
            'picture.nullable' => 'THE MIMES OF PICTURE MUST BE ONE OF THIS "JPG,JPEG,PNG,BMP"',
            'type_id.required' => 'YOU HAVE TO CHOOSE TYPE FOR THIS COMPANY'
        ]);
        $type = Type::query()->findOrFail($request["type_id"]);
        Company::create([
            'name' => $request['name'],
            'location' => $request['location'],
            'picture' => $request['picture'] != null ? $request['picture']->store('images', 'public') : null,
            'type_id' => $request['type_id']
        ]);
        return redirect('Clients');
    }


    public function edit( $id)
    {
        $company = Company::query()->findOrFail($id);
        $types = Type::all();
        return view('Clients/edit', compact('company', 'types'));
    }


    public function update(Request $request,  $id)
    {
        $company = Company::query()->findOrFail($id);
        $company->update($request->all());
        if ($request->hasFile('picture')) {
            ///store new picture in folder
            $image = $request['picture']->store('images', 'public');
            ////delete old picture
            Storage::disk('public')->delete($company['picture']);
            $company['picture'] = $image;
        }
        $company->save();
        return redirect('Clients');
    }

    public function delete( $id)
    {
        $company = Company::query()->findOrFail($id);
        return view('Clients/delete', compact('company'));
    }

    public function destroy( $id)
    {
        Company::destroy($id);
        return redirect('Clients');
    }

    public function users( $id)
    {
        $company = Company::query()->findOrFail($id);
        $oldUsers = User::query()->where("companie_id", $id)->get()->pluck("id")->toArray();
        $users = User::all();
        return view('Clients/users', compact("oldUsers", "users", "company"));
    }

    public function updateUsers( $id, Request $request)
    {
        $request->validate([
            "users" => "array|nullable"
        ]);
        $company = Company::query()->findOrFail($id);
        $users = $request["users"];
        $oldUsers = User::query()->where("companie_id", $id)->get();
        foreach ($oldUsers as $oldUser) {
            $oldUser->companie_id = null;
            $oldUser->save();
        }
        if (isset($users) && count($users) > 0) {
            $newUsers = User::query()->whereIn("id", $users)->get();
            foreach ($newUsers as $newUser) {
                $newUser->companie_id = $id;
                if ($newUser->account_type != "admin") {
                    $newUser->account_type = "manager";
                }
                $newUser->save();
            }
        }
        return redirect('Clients');
    }
}
