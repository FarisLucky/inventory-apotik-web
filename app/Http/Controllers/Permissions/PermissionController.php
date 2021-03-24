<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $findAllPermission = Permission::all();
        $data = [
            "permissions" => $findAllPermission
        ];
        return view("modules.permission.index", $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view("modules.permission.create");
    }

    public function store(){

    }
    public function destroy(){}
    public function edit(){}
}
