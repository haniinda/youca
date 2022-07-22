<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advservice;
use Illuminate\Http\Request;

/**
 * Class AdvserviceController
 * @package App\Http\Controllers
 */
class AdvserviceController extends Controller
{
    public function index()
    {
        return Advservice::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
//            'service' => 'required|string'
//        ] , [
//            'service.required' => 'PLEASE ADD NAME FOR SERVICE TO ADD !!!!'
//        ]);
//        return  Advservice::create($request->all());
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Advservice::query()->firstOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advservice  $advservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Advservice $advservice)
    {
        //
    }


//    public function update(Request $request,int $id)
//    {
//        //dd($request->input('service'));
//        $ser = Advservice::where('id' , $id)->first();
//        $ser->update($request->all());
//        return response()->json([ 'status ' => 'true' , 'message' => 'SERVICE UPDATED !!!!'
//            , 'data' =>$ser]);
//
//
//    }


//    public function destroy(int $id)
//    {
//        $adv = Advservice::destroy($id);
//        return response()->json([ 'status ' => 'true' , 'message' => 'SERVICE DELETED !!!!']);
//    }
}
