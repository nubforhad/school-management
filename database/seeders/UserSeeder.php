<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'role' => 'Super Admin',
                'branch_id' => null,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'Admin',
                'branch_id' => null,
            ],
            [
                'name' => 'Branch Manager',
                'email' => 'manager@gmail.com',
                'role' => 'Branch Manager',
                'branch_id' => null,
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@gmail.com',
                'role' => 'Teacher',
                'branch_id' => null,
            ],
            [
                'name' => 'Accountant',
                'email' => 'accountant@gmail.com',
                'role' => 'Accountant',
                'branch_id' => null,
            ],
        ];

        foreach ($users as $item) {
            $role = Role::where('name', $item['role'])
                ->where('guard_name', $guard)
                ->first();

            if (! $role) {
                throw new \RuntimeException(
                    "Role not found: {$item['role']}. Run RolePermissionSeeder first."
                );
            }
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'branch_id' => $item['branch_id'],
                    'password' => Hash::make('ChangeMe123!'),
                ]
            );

            $user->syncRoles([$role]);
        }
    }
}