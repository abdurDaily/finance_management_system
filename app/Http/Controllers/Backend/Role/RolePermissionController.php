<?php

namespace App\Http\Controllers\Backend\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    //*INDEX
    public function index(){
        $roles = Role::select('id','name')->latest()->get();
        $rolesWithPermission = Role::with('permissions')->get();
        $allPermissions = Permission::select('id','name')->get();
        
        return view('Backend.RolePermission.Index',compact('roles','rolesWithPermission','allPermissions'));
    }


    //**STORE ROLE  */
    public function storeRole(Request $request){
        $request->validate([
            "role_name" => 'required|unique:roles,name'
         ]);
        $role = new Role();
        $role->name = $request->role_name;
        $role->guard_name = 'web';
        $role->save();
        Session::flash('success', 'Role created successfully!');
        return back();
    }
    //**DELETE ROLE  */
    public function deleteRole($id){
        Role::find($id)->delete();
        Session::flash('deleteRole', 'Role deleted!');
        return back();
    }


    //**STORE ROLE  */
    public function storePermission(Request $request){

        $request->validate([
           "permission_name" => 'required|unique:permissions,name'
        ]);
        $role = new Permission();
        $role->name = $request->permission_name;
        $role->guard_name = 'web';
        $role->save();
        Session::flash('permission', 'a new Permission created successfully!');
        return back();
    }


    //**ASSIGNING PERMISSION  */
    public function assignPermissions(Request $request){
        $request->validate([
            'permissions' => 'required|array|min:1',
        ], [
            'permissions.required' => 'Please select at least one permission.',
            'permissions.array' => 'Permissions must be an array.',
            'permissions.min' => 'Please select at least one permission.',
        ]);

        $role = Role::find($request->role_id);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        Session::flash('permissionAssin', 'Permissions assigned successfully!');
        return back();
    }

    

    
        
}
