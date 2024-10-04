<?php

namespace App\Http\Controllers\Backend\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RolePermissionController extends Controller
{
    //*INDEX
    public function index(){
        return view('Backend.RolePermission.Index');
    }


    //**STORE ROLE  */
    public function storeRole(Request $request){
        $role = new Role();
        $role->name = $request->role_name;
        $role->guard_name = 'web';
        $role->save();
        Session::flash('success', 'Role created successfully!');
        return back();
    }
}
