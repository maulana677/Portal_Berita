<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermisionController extends Controller
{
    function index(): View
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    function create(): View
    {
        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.role.create', compact('permissions'));
    }

    function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:permissions,name']
        ]);

        /** create the role */
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->role]);

        /** asign permissions to the role */
        $role->syncPermissions($request->permissions);

        toast(__('Created Successfully!'), 'success');

        return redirect()->route('admin.role.index');
    }

    function edit(string $id): View
    {
        $permissions = Permission::all()->groupBy('group_name');
        $role = Role::findOrFail($id);
        $rolesPermissions = $role->permissions;
        $rolesPermissions = $rolesPermissions->pluck('name')->toArray();
        return view('admin.role.edit', compact('permissions', 'role', 'rolesPermissions'));
    }

    function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:permissions,name']
        ]);

        /** create the role */
        $role = Role::findOrFail($id);
        $role->update(['guard_name' => 'admin', 'name' => $request->role]);

        /** asign permissions to the role */
        $role->syncPermissions($request->permissions);

        toast(__('Updated Successfully!'), 'success');

        return redirect()->route('admin.role.index');
    }
}
