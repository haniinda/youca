<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function  getprofile (Request $request) {
      return  \response()->json(Auth::user());
        try {

            $users = User::query()->firstOrFail($request->user()->id);
            return response()->json([ 'status ' => 'true' , 'message' => 'user profile'
                , 'data' =>$users]);

        }catch(\Exception $exception){
            return response()->json([ 'status ' => 'false' , 'message' => $exception->getMessage()
                , 'data' => []] , 500);
        }
    }

    /**
     * @param Request $request
     */
    public function updateprofile (Request $request){
        $validation = Validator::make($request->all(), [
            'f-name' => 'required|string' ,
            'l-name' => 'required|string' ,
            'phone' => 'nullable|string|min:9' ,
            'education' => 'nullable|string' ,
            'address' => 'nullable|string' ,
            'birth-date' => 'nullable|date'
        ],[
            'f-name.required' => 'you have to enter the first name for your profile ' ,
            'l-name.required' => 'you have to enter the last name for your profile '
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        }

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user['f-name'] = $request->input('f-name');
        $user['l-name'] = $request->input('l-name');
        $user['phone'] = $request->input('phone');
        $user['education'] = $request->input('education');
        $user['address'] = $request->input('address');
        $user['birth-date'] = $request->input('birth-date');

        if ($request->hasFile('picture')){
            ///store new picture in folder
            $image = $request['picture']->store('images' , 'public');
            ////delete old picture
            Storage::disk('public')->delete($user['picture']);
            $user['picture'] = $image;
        }
        $user->update();
        return response()->json([ 'status ' => 'true' , 'message' => 'profile updated !!!!'
            , 'data' =>$user]);
    }
    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */

//    public function delete(int $id){
//        $user = User::query()->findOrFail($id);
//        $user->delete();
//        return  response()->json(['message' => 'THE USER IS DELETED SUCCESSFULLY !!! '] , 200);
//    }
}
