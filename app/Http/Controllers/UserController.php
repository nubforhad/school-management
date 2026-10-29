<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Existing Public Pages
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('welcome', compact('settings'));
    }

    public function notice(Request $request)
    {
        $settings = Setting::pluck('value', 'key');

        return view('frontend.notice', compact('settings'));
    }

    public function contact(Request $request)
    {
        $settings = Setting::pluck('value', 'key');

        return view('frontend.pages.contact', compact('settings'));
    }

    public function about(Request $request)
    {
        $settings = Setting::pluck('value', 'key');

        return view('frontend.pages.about', compact('settings'));
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    private function isSuperAdminOrAdmin(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole([
            'Super Admin',
            'super-admin',
            'super_admin',
            'Admin',
            'admin',
        ]);
    }

    private function isBranchManager(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole([
            'Branch Manager',
            'branch-manager',
            'branch_manager',
        ]);
    }

    private function authorizeUserManagement(): void
    {
        abort_unless(
            $this->isSuperAdminOrAdmin() || $this->isBranchManager(),
            403,
            'You are not authorized to manage users.'
        );

        if ($this->isBranchManager()) {
            abort_if(
                !auth()->user()->branch_id,
                403,
                'Your account has no assigned branch.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Branch Access
    |--------------------------------------------------------------------------
    */

    private function availableBranches()
    {
        if ($this->isSuperAdminOrAdmin()) {
            return Branch::orderBy('name')->get();
        }

        return Branch::where(
            'id',
            auth()->user()->branch_id
        )->get();
    }

    private function authorizeUserBranch(User $user): void
    {
        if ($this->isBranchManager()) {
            abort_unless(
                (int) $user->branch_id ===
                (int) auth()->user()->branch_id,
                403,
                'You cannot access users from another branch.'
            );
        }
    }

    private function availableRoles()
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        // Branch Manager cannot assign privileged roles.
        if ($this->isBranchManager()) {
            $restrictedRoles = [
                'Super Admin',
                'super-admin',
                'super_admin',
                'Admin',
                'admin',
                'Branch Manager',
                'branch-manager',
                'branch_manager',
            ];

            $roles = $roles->reject(
                fn ($role) => in_array(
                    $role->name,
                    $restrictedRoles,
                    true
                )
            );
        }

        return $roles;
    }

    /*
    |--------------------------------------------------------------------------
    | User List
    |--------------------------------------------------------------------------
    */

    public function adminUsers()
    {
        $this->authorizeUserManagement();

        $query = User::with(['roles', 'branch'])->latest();

        if ($this->isBranchManager()) {
            $query->where(
                'branch_id',
                auth()->user()->branch_id
            );
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create User
    |--------------------------------------------------------------------------
    */

    public function createUser()
    {
        $this->authorizeUserManagement();

        $roles = $this->availableRoles();
        $branches = $this->availableBranches();

        return view(
            'admin.users.create',
            compact('roles', 'branches')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store User
    |--------------------------------------------------------------------------
    */

    public function storeUser(Request $request)
    {
        $this->authorizeUserManagement();

        $allowedRoleNames = $this->availableRoles()
            ->pluck('name')
            ->all();

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'branch_id' => [
                'required',
                'integer',
                Rule::exists('branches', 'id'),
            ],

            'role' => [
                'required',
                Rule::exists('roles', 'name')
                    ->where('guard_name', 'web'),
                Rule::in($allowedRoleNames),
            ],
        ]);

        // Never trust a Branch Manager's submitted branch_id.
        if ($this->isBranchManager()) {
            abort_unless(
                (int) $data['branch_id'] ===
                (int) auth()->user()->branch_id,
                403,
                'You can only create users in your own branch.'
            );

            $data['branch_id'] = auth()->user()->branch_id;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'branch_id' => $data['branch_id'],
        ]);

        $user->assignRole($data['role']);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User created and role assigned successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit User
    |--------------------------------------------------------------------------
    */

    public function editUser(User $user)
    {
        $this->authorizeUserManagement();
        $this->authorizeUserBranch($user);

        $user->load('roles');

        $roles = $this->availableRoles();
        $branches = $this->availableBranches();

        return view(
            'admin.users.edit',
            compact('user', 'roles', 'branches')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */

    public function updateUser(Request $request, User $user)
    {
        $this->authorizeUserManagement();
        $this->authorizeUserBranch($user);

        // Branch Managers cannot edit privileged accounts.
        if ($this->isBranchManager()) {
            abort_if(
                $user->hasAnyRole([
                    'Super Admin',
                    'super-admin',
                    'super_admin',
                    'Admin',
                    'admin',
                    'Branch Manager',
                    'branch-manager',
                    'branch_manager',
                ]),
                403,
                'You cannot edit a privileged account.'
            );
        }

        $allowedRoleNames = $this->availableRoles()
            ->pluck('name')
            ->all();

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'branch_id' => [
                'required',
                'integer',
                Rule::exists('branches', 'id'),
            ],

            'role' => [
                'required',
                Rule::exists('roles', 'name')
                    ->where('guard_name', 'web'),
                Rule::in($allowedRoleNames),
            ],
        ]);

        if ($this->isBranchManager()) {
            abort_unless(
                (int) $data['branch_id'] ===
                (int) auth()->user()->branch_id,
                403,
                'You cannot move users to another branch.'
            );

            $data['branch_id'] = auth()->user()->branch_id;
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->branch_id = $data['branch_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        $user->syncRoles([$data['role']]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    public function deleteUser(User $user)
    {
        $this->authorizeUserManagement();
        $this->authorizeUserBranch($user);

        abort_if(
            $user->id === auth()->id(),
            403,
            'You cannot delete your own account.'
        );

        if ($this->isBranchManager()) {
            abort_if(
                $user->hasAnyRole([
                    'Super Admin',
                    'super-admin',
                    'super_admin',
                    'Admin',
                    'admin',
                    'Branch Manager',
                    'branch-manager',
                    'branch_manager',
                ]),
                403,
                'You cannot delete a privileged account.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
