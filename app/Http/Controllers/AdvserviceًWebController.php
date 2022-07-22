<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advservice;
use App\Models\AdvserviceCategory;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class AdvserviceًWebController extends Controller
{

    public function index()
    {
        $data = Advservice::query()->paginate(10);
        return view("services/index", compact("data"));
    }


    public function create()
    {
        //
        return view("services/create");
    }


    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string|unique:advservices,service'
        ], [
            'service.required' => 'you have to enter service’s name to add!!!!',
        ]);
        $service = new Advservice();
        $service->fill($request->all());
        $service->save();
        return  redirect("/services");
    }

    public function edit($id)
    {
        $service = Advservice::query()->findOrFail($id);
        return view("services/edit", compact("service"));
    }


    public function update(Request $request,  $id)
    {
        //dd($request->input('service'));
        $ser = Advservice::query()->where('id', $id)->first();
        $ser->update($request->all());
        return  redirect("/services");
    }


    public function delete($id)
    {
        $service = Advservice::query()->findOrFail($id);
        return view("services/delete", compact("service"));
    }

    public function destroy(int $id,Request $request)
    {
        $categories= AdvserviceCategory::query()->where('advservice_id',$id)->count();
        if($categories>0)
        {
            $request->validate([
                "required" => "required"
            ], [
                "required.required" => "can not delete this service  because contain many categories"
            ]);
        }
        $adv = Advservice::query()->findOrFail($id);
        $adv->delete();
        return redirect("services");
    }
    public function categories(int $id)
    {
        $service = Advservice::query()->findOrFail($id);
        $oldCats = AdvserviceCategory::query()->where("advservice_id", $id)->get()->pluck("category_id")->toArray();
        $categories = Category::all();
        return view('services/categories', compact("oldCats", "categories", "service"));
    }

    public function updateCategories(int $id, Request $request)
    {
        $request->validate([
            "categories" => "array|nullable"
        ]);
        $service = Advservice::query()->findOrFail($id);
        $categories = $request["categories"];
        $oldCats = AdvserviceCategory::query()->where("advservice_id", $id)->get();
        foreach ($oldCats as $oldCat) {
            $oldCat->delete();
        }
        if (isset($categories) && count($categories) > 0) {
//            $newCats = Category::query()->whereIn("id", $categories)->get();
            foreach ($categories as $newId) {
                $newCat = new AdvserviceCategory();
                $newCat->category_id = $newId;
                $newCat->advservice_id = $id;
                $newCat->save();
            }
        }
        return redirect('services');
    }
}
