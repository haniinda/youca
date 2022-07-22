<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleWebController extends Controller
{
    public function index()
    {
        $roles = Role::query()->paginate(10);
        return view("roles/index", compact("roles"));
    }


    public function create()
    {
        //
        $permissions = Permit::all();
        return view("roles/create" , compact("permissions"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'role-name' => 'required|string|unique:roles,role-name',
            'permissions' => 'required|array'
        ], [
            'role-name.required' => 'you have to enter service’s name to add!!!!',
        ]);
        $role = new Role();
        $role->fill($request->all());
        $role->save();
        foreach ($request["permissions"] as $permission)
        {
            $role_permission = new PermitRole();
            $role_permission->role_id = $role->id;
            $role_permission->permit_id = $permission;
            $role_permission->save();
        }
        return  redirect("/roles");
    }

    /**
     *
     *
     * @param int $id
     */


    public function edit(int $id)
    {
        $role = Role::query()->with("permission")->findOrFail($id);
        $permissions = Permit::all();
        return view("roles/edit", compact("role","permissions"));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'role-name' => 'required|string',
            'permissions' => 'required|array'
        ], [
            'role-name.required' => 'you have to enter service’s name to add!!!!',
        ]);
        $role = Role::query()->findOrFail($id);
        $role->update($request->all());
        $role->rolePermissions()->delete();
        foreach ($request["permissions"] as $permission)
        {
            $role_permission = new PermitRole();
            $role_permission->role_id = $role->id;
            $role_permission->permit_id = $permission;
            $role_permission->save();
        }
        return  redirect("/roles");
    }

    /**
     * Remove the specified resource from storage.
     *
     **/

    public function delete(int $id)
    {
        $role = Role::query()->findOrFail($id);
        return view("roles/delete", compact("role"));
    }

    public function destroy(int $id)
    {
        $adv = Role::destroy($id);
        return redirect("roles");
    }
}
