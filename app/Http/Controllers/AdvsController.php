<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advs;
use App\Models\Advservice;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 * Class AdvsController
 * @package App\Http\Controllers
 */
class AdvsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Advs[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        //to get all advs
        return  Advs::all();
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $request->validate([
//            'location' => 'nullable|string',
//            'working_hour' => 'nullable|integer',
//            's-date' => 'nullable|date',
//            'e-date' => 'nullable|date',
//            'category_id' => 'required|integer',
//            'cost' => 'nullable|integer',
//            'picture' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,bmp',
//            'explaining' => 'nullable|string',
//            'advservice_id' => 'required|integer'
//        ], [
//            //messages
//            'category_id.required' => 'you have to add category to this advertisements',
//            'advservice_id.required' => 'what the service name of this advertisements ??? "its required"'
//        ]);
//
//        return Advs::create([
//            'location' => $request['location'] ,
//            'working_hour' => $request['working_hour'] ,
//            's-date' => $request['s-date'] ,
//            'e-date' => $request['e-date'] ,
//            'category_id' => $request['category_id'] ,
//            'cost' => $request['cost'] ,
//            'explaining' => $request['explaining'] ,
//            'advservice_id' => $request['advservice_id'] ,
//            'picture' => $request['picture']->store('images' , 'public')
//        ]);
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return  Advs::query()->firstOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advs  $advs
     * @return \Illuminate\Http\Response
     */
    public function edit(Advs $advs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advs $advs
     * @return \Illuminate\Http\JsonResponse
     */
//    public function update(Request $request, Advs $advs)
//    {
//        $data = $request->only('location' , 'working_hour' , 'e-date' , 's-date',
//            'category_id','cost' , 'explaining' , 'advservice_id');
//        if ($request->hasFile('picture')) {
//            ///store new picture in folder
//            $image = $request['picture']->store('images', 'public');
//            ////delete old picture
//            Storage::disk('public')->delete($advs['picture']);
//            $advs['picture'] = $image;
//        }
//        $advs->update();
//        return response()->json([ 'status ' => 'true' , 'message' => ' advertisements updated !!!!'
//            , 'data' =>$advs]);
//
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
//    public function destroy( $id)
//    {
//        return Advs::destroy($id);
//    }

    /**

     */
    public function search ($service_id,$category_id){
        return Advs::query()->where("advservice_id" , $service_id)->where("category_id",$category_id)->get();
    }

}
