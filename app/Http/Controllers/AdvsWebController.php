<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advs;
use App\Models\Advservice;
use App\Models\Category;
use App\Models\Company;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/**
 * Class AdvsController
 * @package App\Http\Controllers
 */
class AdvsWebController extends Controller
{

    public function index()
    {
        if (Auth::user()->account_type == 'manager') {
            $data = Advs::query()->where('user_id', Auth::user()->id)->paginate(10);
        } else {
            $data = Advs::query()->paginate(10);
        }
        return view("ADS/index", compact("data"));
    }


    public function create()
    {
        $services = Advservice::all();
        $categories = Category::all();
        return view("ADS/create", compact("services", "categories"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'location' => 'nullable|string',
            'working_hour' => 'nullable|integer',
            's-date' => 'nullable|date',
            'e-date' => 'nullable|date',
            'category_id' => 'required|integer',
            'cost' => 'nullable|integer',
            'picture' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,bmp',
            'explaining' => 'nullable|string',
            'advservice_id' => 'required|integer'
        ], [
            //messages
            'category_id.required' => 'you have to add category to this advertisements',
            'advservice_id.required' => 'what the service name of this advertisements ??? "its required"'
        ]);

        $sDate = Carbon::createFromFormat("Y-d-m",$request["s-date"]);
        $eDate = Carbon::createFromFormat("Y-d-m",$request["e-date"]);

        if ($sDate->gt($eDate)) {
            $request->validate([
                "required" => "required"
            ], [
                "required.required" => "end date must be greater than start date "
            ]);
        }
        $category = Category::query()->findOrFail($request["category_id"]);
        $service = Advservice::query()->findOrFail($request["advservice_id"]);
        Advs::create([
            'location' => $request['location'],
            'working_hour' => $request['working_hour'],
            's-date' => $request['s-date'],
            'e-date' => $request['e-date'],
            'category_id' => $request['category_id'],
            'cost' => $request['cost'],
            'explaining' => $request['explaining'],
            'advservice_id' => $request['advservice_id'],
            'picture' => $request['picture'] != null ? $request['picture']->store('images', 'public') : null,
            'user_id' => Auth::user()->id
        ]);
        return redirect("ADS");
    }


    public function edit(int $id)
    {
        if (Auth::user()->account_type == 'manager') {
            $adv = Advs::query()->where("id", $id)->where("user_id", Auth::user()->id)->firstOrFail();
        } else {
            $adv = Advs::query()->findOrFail($id);
        }
        $services = Advservice::all();
        $categories = Category::all();
        return view('ADS/edit', compact('adv', 'services', 'categories'));
    }


    public function update(Request $request, int $id)
    {
        $sDate = Carbon::createFromFormat("Y-d-m",$request["s-date"]);
        $eDate = Carbon::createFromFormat("Y-d-m",$request["e-date"]);
        if ($sDate->gt($eDate)) {
            $request->validate([
                "required" => "required"
            ], [
                "required.required" => "end date must be greater than start date "
            ]);
        }
        if (Auth::user()->account_type == 'manager') {
            $adv = Advs::query()->where("id", $id)->where("user_id", Auth::user()->id)->firstOrFail();
        } else {
            $adv = Advs::query()->findOrFail($id);
        }
        $adv->update($request->all());

        if ($request->hasFile('picture')) {
            ///store new picture in folder
            $image = $request['picture']->store('images', 'public');
            ////delete old picture
            Storage::disk('public')->delete($adv['picture']);
            $adv['picture'] = $image;
        }
        $adv->save();
        return redirect('ADS');
    }


    public function delete(int $id)
    {
        if (Auth::user()->account_type == 'manager') {
            $adv = Advs::query()->where("id", $id)->where("user_id", Auth::user()->id)->firstOrFail();
        } else {
            $adv = Advs::query()->findOrFail($id);
        }
        return view('ADS/delete', compact('adv'));
    }

    public function destroy($id)
    {
        if (Auth::user()->account_type == 'manager') {
            $adv = Advs::query()->where("id", $id)->where("user_id", Auth::user()->id)->firstOrFail();
        } else {
            $adv = Advs::query()->findOrFail($id);
        }
        Advs::destroy($id);
        return redirect('ADS');
    }


}
