<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserPostFormRequest;
use App\Http\Requests\User\UserPutFormRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $findAllUser = User::with('roles')->get();
        $data = [
            'user' => $findAllUser
        ];
        return view('modules.akun.index', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $findAllRole = Role::all();
        $data= [
            'roles' => $findAllRole
        ];
        return view('modules.akun.create', $data);
    }

    /**
     * @param UserPostFormRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(UserPostFormRequest $request)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            $role = Role::findById($input['role']);
            $input["password"] = Hash::make($input["password"]);
            $user = User::create($input);
            $user->assignRole($role->id);
            DB::commit();
            return redirect(route("user.create"))
                ->with("success", true);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect(route("user.create"))
                ->with("gagal", true);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new Response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $findUserById = User::with("roles")->find($id);
        $findAllRole = Role::all();
        $data = [
            "roles" => $findAllRole,
            "user" => $findUserById
        ];
        return view("modules.akun.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UserPutFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UserPutFormRequest $request, $id)
    {
        $input = $request->validated();
        try {
            DB::beginTransaction();
            $findUserById = User::findOrFail($id);
            $findUserById->update($input);
            $findUserById->roles()->detach();
            $findUserById->assignRole($request->role);
            DB::commit();
            return redirect()
                ->route('user.edit',['id_user'=>$id])
                ->with("success", true);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::debug("Update User",[$ex]);
            return redirect(route("user.edit",["id_user"=>$id]))
                ->with("gagal", true);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $findUserById = User::find($id);
        $findUserById->roles()->detach();
        $findUserById->delete();
        $data = [
            "code" => 200,
            "status" => "OK",
            "data" => [
                "routing" => route("user.index")
            ]
        ];
        return response()
            ->json($data);
    }
}
