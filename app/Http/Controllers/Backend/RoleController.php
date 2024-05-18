<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permission = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permission'));
    }//End Method
}
