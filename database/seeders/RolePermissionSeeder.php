<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $guard = 'web';

        $modules = [
            'dashboard',
            'branches',
            'academic-sessions',
            'classes',
            'sections',
            'subjects',
            'class-subjects',
            'students',
            'student-enrollments',
            'attendance',
            'fee-types',
            'student-fees',
            'fee-collection',
            'fee-payment-history',
            'fee-reports',
            'exams',
            'exam-schedules',
            'exam-subjects',
            'exam-marks',
            'student-results',
            'class-results',
            'result-sheets',
            'class-routines',
            'guardians',
            'departments',
            'designations',
            'teacher-staff',
            'teacher-assignment',
            'salary-structures',
            'salary-payments',
            'leave-types',
            'leave-allocations',
            'leave-applications',
            'teacher-staff-attendance',
            'income-categories',
            'expense-categories',
            'expenses',
            'accounts',
            'finance',
            'settings',
            'users',
            'roles',
        ];

        $actions = [
            'view',
            'create',
            'edit',
            'delete',
            'approve',
            'export',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$module}.{$action}",
                    'guard_name' => $guard,
                ]);
            }
        }

        $allPermissions = Permission::where(
            'guard_name',
            $guard
        )->get();

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => $guard,
        ]);

        $superAdmin->syncPermissions($allPermissions);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => $guard,
        ]);

        $admin->syncPermissions(
            $allPermissions->reject(
                fn ($permission) =>
                    $permission->name === 'roles.delete'
            )
        );

        $branchManager = Role::firstOrCreate([
            'name' => 'Branch Manager',
            'guard_name' => $guard,
        ]);

        $branchManager->syncPermissions(
            $allPermissions->filter(
                fn ($permission) =>
                    ! in_array($permission->name, [
                        'branches.create',
                        'branches.edit',
                        'branches.delete',
                        'roles.create',
                        'roles.edit',
                        'roles.delete',
                        'users.delete',
                        'settings.edit',
                    ], true)
            )
        );

        $teacher = Role::firstOrCreate([
            'name' => 'Teacher',
            'guard_name' => $guard,
        ]);

        $teacher->syncPermissions(
            Permission::where('guard_name', $guard)
                ->whereIn('name', [
                    'dashboard.view',
                    'students.view',
                    'student-enrollments.view',
                    'attendance.view',
                    'attendance.create',
                    'attendance.edit',
                    'exams.view',
                    'exam-schedules.view',
                    'exam-marks.view',
                    'exam-marks.create',
                    'exam-marks.edit',
                    'student-results.view',
                    'class-results.view',
                    'result-sheets.view',
                    'class-routines.view',
                    'leave-applications.view',
                    'leave-applications.create',
                    'leave-applications.edit',
                ])->get()
        );

        $accountant = Role::firstOrCreate([
            'name' => 'Accountant',
            'guard_name' => $guard,
        ]);

        $accountant->syncPermissions(
            Permission::where('guard_name', $guard)
                ->whereIn('name', [
                    'dashboard.view',
                    'fee-types.view',
                    'student-fees.view',
                    'student-fees.create',
                    'student-fees.edit',
                    'fee-collection.view',
                    'fee-collection.create',
                    'fee-payment-history.view',
                    'fee-reports.view',
                    'fee-reports.export',
                    'accounts.view',
                    'finance.view',
                    'income-categories.view',
                    'expenses.view',
                    'expenses.create',
                    'expenses.edit',
                    'expense-categories.view',
                    'salary-payments.view',
                ])->get()
        );

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}
