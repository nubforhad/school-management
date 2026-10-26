<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRoleController extends Controller
{
    private function usersQuery(Request $request)
    {
        $query = User::query()
            ->with(['roles', 'branch']);

        if (! $request->user()->hasRole('Super Admin')) {
            $query->where(
                'branch_id',
                $request->user()->branch_id
            );
        }

        return $query;
    }

    public function index(Request $request)
    {
        $users = $this->usersQuery($request)
            ->orderBy('name')
            ->paginate(15);

        return view('admin.user-roles.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        $this->ensureUserInScope($request, $user);

        $roles = Role::where('guard_name', 'web')
            ->withCount('permissions')
            ->orderBy('name')
            ->get();

        $selectedRoles = $user->roles()
            ->pluck('roles.id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('admin.user-roles.edit', compact(
            'user',
            'roles',
            'selectedRoles'
        ));
    }

    public function update(Request $request, User $user)
    {
        $this->ensureUserInScope($request, $user);

        $validated = $request->validate([
            'roles' => ['sometimes', 'array'],
            'roles.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('roles', 'id')
                    ->where('guard_name', 'web'),
            ],
        ]);

        $roleIds = $validated['roles'] ?? [];

        $roles = Role::where('guard_name', 'web')
            ->whereIn('id', $roleIds)
            ->with('permissions')
            ->get();

        $actor = $request->user();

        // Only Super Admin may assign the Super Admin role.
        if (
            ! $actor->hasRole('Super Admin')
            && $roles->contains('name', 'Super Admin')
        ) {
            return back()
                ->withErrors([
                    'roles' => 'Only Super Admin can assign this role.',
                ])
                ->withInput();
        }

        // Prevent privilege escalation through custom roles.
        if (! $actor->hasRole('Super Admin')) {
            $actorPermissions = $actor->getAllPermissions()
                ->pluck('name')
                ->all();

            foreach ($roles as $role) {
                $rolePermissions = $role->permissions
                    ->pluck('name')
                    ->all();

                $unauthorizedPermissions = array_diff(
                    $rolePermissions,
                    $actorPermissions
                );

                if (! empty($unauthorizedPermissions)) {
                    return back()
                        ->withErrors([
                            'roles' => "You cannot assign the {$role->name} role because it contains permissions you do not have.",
                        ])
                        ->withInput();
                }
            }
        }

        $user->syncRoles($roles);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.user-roles.index')
            ->with('success', 'User roles updated successfully.');
    }

    private function ensureUserInScope(
        Request $request,
        User $user
    ): void {
        $actor = $request->user();

        if ($actor->hasRole('Super Admin')) {
            return;
        }

        abort_unless(
            $actor->branch_id !== null
            && $user->branch_id !== null
            && (int) $user->branch_id === (int) $actor->branch_id,
            403,
            'You cannot manage users from another branch.'
        );
    }
}
