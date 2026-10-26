<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('guard_name', 'web')
            ->withCount('permissions')
            ->with('permissions')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($permission) => Str::before(
                $permission->name,
                '.'
            ));

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web'),
            ],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [
                'integer',
                'distinct',
                Rule::exists('permissions', 'id')
                    ->where('guard_name', 'web'),
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            $permissionIds = $validated['permissions'] ?? [];

            $role->syncPermissions(
                Permission::where('guard_name', 'web')
                    ->whereIn('id', $permissionIds)
                    ->get()
            );
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($permission) => Str::before(
                $permission->name,
                '.'
            ));

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('admin.roles.edit', compact(
            'role',
            'permissions',
            'selectedPermissions'
        ));
    }

    public function update(Request $request, Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        if (
            $role->name === 'Super Admin'
            && ! $request->user()->hasRole('Super Admin')
        ) {
            abort(403, 'You cannot modify the Super Admin role.');
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web')
                    ->ignore($role->id),
            ],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [
                'integer',
                'distinct',
                Rule::exists('permissions', 'id')
                    ->where('guard_name', 'web'),
            ],
        ]);

        DB::transaction(function () use ($validated, $role) {
            $role->update(['name' => $validated['name']]);

            $permissionIds = $validated['permissions'] ?? [];

            $role->syncPermissions(
                Permission::where('guard_name', 'web')
                    ->whereIn('id', $permissionIds)
                    ->get()
            );
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role and permissions updated successfully.');
    }

    public function destroy(Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        if ($role->name === 'Super Admin') {
            return back()->with(
                'error',
                'The Super Admin role cannot be deleted.'
            );
        }

        if ($role->users()->exists()) {
            return back()->with(
                'error',
                'This role is assigned to users. Reassign them before deleting.'
            );
        }

        $role->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
