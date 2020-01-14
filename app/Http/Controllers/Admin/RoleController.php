<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', ['roles' => \Spatie\Permission\Models\Role::all()]);
    }

    public function createRole(Request $request)
    {
        try {
            Role::create(['name' => $request->name])->givePermissionTo($request->permissions);
        } catch (Exception $e) {
            return redirect()->back()->with('status', 'Error creating new role... The system reported:' . $e->getMessage());
        }
    }

    public function showCreateRoleForm()
    {
        return view('admin.roles.create', ['permissions' => \Spatie\Permission\Models\Permission::all()]);
    }

    public function deleteRole(Role $role)
    {
        if($role->exists) {
            $role->delete();
            return redirect()->route('admin.users.index');
        } else {
            return redirect()->back()->with('status', 'Could not find this user. Failed to delete');
        }
    }

    public function editRole(Role $role)
    {
        dd(\request()->get('permissions'));
    }

    public function showEditRoleForm(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role, 'permissions' => \Spatie\Permission\Models\Permission::all()]);
    }

}
