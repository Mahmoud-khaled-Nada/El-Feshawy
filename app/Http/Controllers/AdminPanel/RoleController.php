<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public $pages = [];
    public $permessions = [];
    public function __construct()
    {
        $this->permessions = ['view', 'new', 'update', 'delete'];
        $this->pages = [
            'employees',
            'customers',
            'pages',
            'news',
            'aboutus',
            'people',
            'services',
            'contact',
            'notifications',
            'messages',
            'events',
            'tasks',
            'meeting',
            'inquiries'
        ];
    }

    public function index()
    {

        $roles = Role::where('id', '!=', 1)->get();
        return view('AdminPanel.roles.index', get_defined_vars());
    }


    public function create()
    {
        $permessions = $this->permessions;
        $pages = $this->pages;
        return view('AdminPanel.roles.create', get_defined_vars());
    }


    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

        $role->syncPermissions(Permission::whereIn('id', $request->permessions)->pluck('name')->toArray());
        flashy()->success(__('lang.created'));
        return redirect('/role');
    }

    public function edit($id)
    {
        if ($id == 1) {
            abort(404);
        }
        $permessions = $this->permessions;
        $pages = $this->pages;
        $role = Role::findOrFail($id);
        $rolePermissions =  $role->permissions->pluck('id')->toArray();
        return view('AdminPanel.roles.edit', get_defined_vars());
    }


    public function update(RoleRequest $request)
    {
        if ($request->id == 1) {
            abort(404);
        }
        $role = Role::FindOrFail($request->id);
        $role->update(['name' => $request->input('name')]);
        $role->syncPermissions(Permission::whereIn('id', $request->permessions)->pluck('name')->toArray());
        flashy()->success(__('lang.updated'));
        return redirect('/role');
    }


    public function destroy($id)
    {
        if ($id == 1) {
            abort(404);
        }
        $role = Role::findOrFail($id);
        $role->delete();
        flashy()->success(__('lang.deleted'));
        return redirect('/role');
    }
}
