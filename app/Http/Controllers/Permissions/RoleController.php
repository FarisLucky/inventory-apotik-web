<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\role\RoleFormRequest;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $findAllRole = Role::with("permissions")->get();
        $data = [
            "rolePermissions" => $findAllRole
        ];
        return view("modules.role_permission.index", $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function create()
    {
        $findAllPermission = Permission::all();
        $data = [
            'permissions' => $findAllPermission
        ];
        return view("modules.role_permission.create", $data);
    }

    /**
     * @param RoleFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleFormRequest $request)
    {
        $input = $request->validated();
        $createUser = Role::create(['name' => $input['role']]);
        $createUser->syncPermissions($input['permission']);

        return redirect(route('role_permission.create'))
            ->with('success', true);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $findAllPermission = Permission::all();
        $findPermissionByRole = Role::with("permissions")->findOrFail($id);
        $data = [
            "permissions" => $findAllPermission,
            "role" => $findPermissionByRole,
            "rolePermissions" => $findPermissionByRole->permissions
        ];
        return view("modules.role_permission.edit", $data);
    }

    /**
     * @param RoleFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoleFormRequest $request, $id_role)
    {
        if (!empty($request->permission)) {
            $permissions = $request->permission;
            try {
                DB::beginTransaction();
                $role = Role::with("permissions")->findOrFail($id_role);
                // Sama aja dengan syncPermissions;
                // dan syncPermissions disediakan oleh sptiee librayry
//                $role->permissions()->detach();
//                foreach ($permissions as $p) {
//                    $role->permissions()->attach($p);
//                }
                $role->syncPermissions($permissions);
                DB::commit();
                return redirect(route("role_permission.edit",["id_role"=>$id_role]))
                    ->with("success", true);
            } catch (Exception $ex) {
                DB::rollBack();
                return redirect(route("role_permission.edit", ["id_role" => $id_role]))
                    ->with("gagal", true);
            }
        } else {
            return redirect(route("role_permission.edit", ["id_role" => $id_role]))
                ->with("gagal", true);
        }
    }
    public function destroy($id_role)
    {
        $destroyRole = Role::findById($id_role);
        $destroyRole->delete();
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'routing' => route('role_permission.index')
            ]
        ];
        return response()
            ->json($data);

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id_permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyPermission(Request $request,$id_permission)
    {
        DB::table('role_has_permissions')
            ->where('permission_id',$id_permission)
            ->where('role_id', $request->role)
            ->delete();
        $data = [
            "code" => 200,
            "status" => "OK",
            "data" => [
                "routing" => route('role_permission.edit', $request->role)
            ]
        ];
        return response()
            ->json($data);
    }
}
