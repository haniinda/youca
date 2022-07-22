<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class EmailVerificationController
 * @package App\Http\Controllers
 */
class EmailVerificationController extends Controller
{

    /**
     * @param Request $request
     * @return string[]
     */
    public function sendverificationemail(Request $request)
    {
        //dd($request->all());
        if (Auth::user()->hasverifiedemail()) {
            return [
                'message' => 'Already Verified'
            ];
        }
        $users = User::query()->find(Auth::user()->id);
        $code = mt_rand(1000, 9999);
        $users->email_verification_code = $code;
        $users->save();
        Mail::send('email_verification_mail', ["code" => $code], function ($message) use ($users) {
            $message->to($users["email"])->subject
            ('Email Confirmation Code');
        });
        return ['status', 'Verification Code sent'];
    }


    public function verify(Request $request)
    {
        ///EmailVerificationRequest this will take care of validating the request's id and hash parameters.
        if ($request->user()->hasverifiedemail()) {
            return [
                'message' => 'Email Already Verified'
            ];
        }
//        if ($request->user()->markEmailAsVerified()) {
//            event(new Verified($request->user()));
//            /////this will add date to email verified at in user table
//        }
        $validation = Validator::make($request->all(), [
            'code' => 'required',
        ], [
            'code.required' => 'code is required ',
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        }
        if (Auth::user()->email_verification_code == $request['code']) {
            $user = User::query()->find(Auth::user()->id);
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->save();
            return [
                'message' => 'Your Email is verified'
            ];
        }
        return [
            'message' => 'Your Code Is Invalid'
        ];
    }
}
