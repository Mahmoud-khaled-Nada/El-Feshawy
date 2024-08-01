<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\AdminCreateRequest;
use App\Http\Requests\AdminPanel\AdminUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{


    public function index()
    {
        $admins = User::where('id', '!=', 1)->with('roles')->get();
        return view('AdminPanel.admins.index', get_defined_vars());
    }


    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('AdminPanel.admins.create', get_defined_vars());
    }


    public function store(AdminCreateRequest  $request)
    {
        try {
            $admin = User::create($request->input());
            $admin->assignRole($request->input('role_id'));
            flashy()->success(__('lang.created'));
            return redirect()->route('admins.index');
        } catch (\Exception $ex) {
            flashy()->warning(__('lang.warning'));
            return redirect()->back();
        }
    }





    public function edit($id)
    {
        if ($id == 1) {
            abort(404);
        }
        $roles = Role::where('id', '!=', 1)->get();
        $admin = User::findOrFail($id);
        return view('AdminPanel.admins.edit', get_defined_vars());
    }


    public function update(AdminUpdateRequest $request, $id)
    {
        try {
            $admin = User::findOrFail($id);
            if ($admin->id == 1) {
                abort(404);
            }
            $request['password'] = $request->password ?? $admin->password;
            $admin->update($request->input());
            $admin->syncRoles($request->role_id);
            flashy()->success(__('lang.updated'));
            return redirect()->route('admins.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with('warning', __('lang.warning'));
        }
    }


    public function destroy($id)
    {
        if ($id != 1) {
            User::findOrFail($id)->delete();
            flashy()->success(__('lang.deleted'));
            return redirect()->back();
        } else {
            abort(404);
        }
    }
}
