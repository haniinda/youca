<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permit;
use App\Models\Role;
use App\Models\TypeAccount;
use App\Models\User;
use Cassandra\Date;
use Faker\Provider\DateTime;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Class UserWebController
 * @package App\Http\Controllers
 */
class UserWebController extends Controller
{

    public function index()
    {
        $data = User::query()->paginate(10);
        return view("users/index", compact("data"));
    }


    public function create()
    {
        $roles = Role::all();
        return view("users/create", compact("roles"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'f-name' => 'required|string',
            'l-name' => 'required|string',
            'email' => ['required', Rule::unique('users')->whereNull('deleted_at')],
            'phone' => 'nullable|string|min:9',
            'education' => 'nullable|string',
            'address' => 'nullable|string',
            'birth-date' => 'nullable|date'
        ], [
            'f-name.required' => 'you have to enter the first name for your profile ',
            'l-name.required' => 'you have to enter the last name for your profile '
        ]);

        $user = new User();
        $user->fill($request->all());
        if ($request->has("role_id") && $request["role_id"] != "") {
            $role = Role::query()->findOrFail($request["role_id"]);
            $user->role_id = $role->id;
        }
        $user->password = bcrypt($user->password);
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();
        return redirect("/users");
    }


    public function edit($id)
    {
//        $types = TypeAccount::all();
        $user = User::query()->findOrFail($id);
        $roles = Role::all();

        return view("users/edit", compact("user", "roles"));
    }


    public function update(Request $request, int $id)
    {
        //dd($request->input('user'));
        $request->validate([
            'f-name' => 'required|string',
            'l-name' => 'required|string',
            'email' => 'required',
            'role_id' => 'required',
            'account_type' => 'required'
        ]);
        $ser = User::query()->findOrFail($id);
        $existUsersCount = user::query()->where('email', $request["email"])->where('id', '!=', $id)->count();
        if ($existUsersCount > 0) {
            $request->validate([
                "required" => "required"
            ], [
                "required.required" => "Email exist"
            ]);
        }
        $ser->update($request->all());
        if ($request->has("role_id") && $request["role_id"] != "") {
            $role = Role::query()->findOrFail($request["role_id"]);
            $ser->role_id = $role->id;
        }
//        $ser->password = bcrypt($ser->password);
        $ser->save();
        return redirect("/users");
    }

    public function delete($id)
    {
        $user = User::query()->findOrFail($id);
        return view("users/delete", compact("user"));
    }

    public function destroy(int $id)
    {
        $user = user::query()->findOrFail($id);
        $user->destroy($id);
        return redirect("users");
    }

    public function UpdatePassword(Request $request, int $id)
    {
        $request->validate([
            'password' => 'required|confirmed']);

        $user = user::query()->findOrFail($id);
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect("users");
    }

    public function changePassword(int $id)
    {
        $user = User::query()->findOrFail($id);
        return view("users/changepassword", compact("user"));
    }

    public function logout()
    {
        Session::flush();
        return redirect("ADS");
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
