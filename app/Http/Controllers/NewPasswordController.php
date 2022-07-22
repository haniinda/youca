<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

/**
 * Class NewPasswordController
 * @package App\Http\Controllers
 */
class NewPasswordController extends Controller
{

    public function sendResetLinkResponse(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        }

        //you forgot your password and want to change it

//        $status = Password::sendResetLink
//        ($request->only('email'));
//        if ($status == Password::RESET_LINK_SENT){
//            return [
//                'status' => __($status)
//            ];
//        }
//
//        throw ValidationException::withMessages
//        ([
//            'email' => [trans($status)]
//        ]);
        $user = User::query()->where("email", $request["email"])->firstOrFail();

        $code = mt_rand(1000, 9999);
        $user->forget_password_code = $code;
        $user->save();
        Mail::send('forget_password_code', ["code" => $code], function ($message) use ($user) {
            $message->to($user["email"])->subject
            ('Forget Password Code');
        });
    }


    public function sendResetResponse(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        }
        $user = User::query()->where("email", $request["email"])->firstOrFail();
        if ($user->forget_password_code == $request["code"]) {
            $user->password = Hash::make($request["password"]);
            $user->forget_password_code = null;
            $user->save();
            return response()->json("Password reset Successfully");
        } else {
            return response()->json("invalid Code");
        }
//        $status = Password::reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'),
//            function ($user, $password) {
//                $user->forceFill([
//                    'password' => Hash::make($password)
//                ])->setRememberToken(Str::random(60));
//
//                $user->save();
//
//                event(new PasswordReset($user));
//            }
//        );
//        if ($status == Password::PASSWORD_RESET) {
//
//            return response([
//                'message' => 'password reset successfully '
//            ]);
//        }
//        return response([
//            'message' => __($status)
//        ], 500);
    }
}
