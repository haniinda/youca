<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Permit;
use App\Models\PermitRole;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Role::all()->count() == 0) {
            $role = new Role();
            $role["role-name"] = 'supperadmin';
            $role->save();
            $permits = [
                "create user",
                "edit user",
                "delete user",
                "create service",
                "edit service",
                "delete service",
                "create role",
                "edit role",
                "delete role",
                "change password user",
                "create category",
                "edit category",
                "delete category",
                "manage company",
                "create advs",
                "edit advs",
                "delete advs",
                "manage service's category"
            ];
            foreach ($permits as $permit)
            {
                $perm=new Permit();
                $perm->permit=$permit;
                $perm->save();
                $prole= new PermitRole();
                $prole->permit_id=$perm->id;
                $prole->role_id=$role->id;
                $prole->save();
            }
            $user=new User();
            $user->email="hanen.he.essa@gmail.com";
            $user->password= bcrypt('1234567890');
            $user->account_type="admin";
            $user->role_id=$role->id;
            $user->save();
        }
        $this->middleware('guest')->except('logout');
    }
}
