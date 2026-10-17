<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guard = 'web';
        $modules = [
            'dashboard', 'branches', 'academic-sessions', 'classes', 'sections',
            'subjects', 'class-subjects', 'students', 'student-enrollments',
            'guardians', 'attendance', 'fee-types', 'student-fees',
            'fee-collection', 'fee-payment-history', 'fee-reports', 'exams',
            'exam-schedules', 'exam-subjects', 'exam-marks', 'student-results',
            'class-results', 'result-sheets', 'class-routines', 'departments',
            'designations', 'teacher-staff', 'teacher-assignment',
            'teacher-staff-attendance', 'salary-structures', 'salary-payments',
            'leave-types', 'leave-allocations', 'leave-applications',
            'income-categories', 'accounts', 'expense-categories', 'expenses',
            'finance', 'settings', 'users', 'roles',
        ];

        $actions = ['view', 'create', 'edit', 'delete', 'print', 'approve'];

        // 1. Shob permission toiri
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name'       => "{$module}.{$action}",
                    'guard_name' => $guard,
                ]);
            }
        }

        // 2. Role wise permission list
        $allPermissions = Permission::where('guard_name', $guard)->pluck('name')->all();

        $rolePermissions = [
            'Super Admin' => $allPermissions,

            'Admin' => array_values(array_diff($allPermissions, [
                'roles.create', 'roles.edit', 'roles.delete',
            ])),

            'Branch Manager' => [
                'dashboard.view',
                'students.view', 'students.create', 'students.edit',
                'student-enrollments.view', 'student-enrollments.create', 'student-enrollments.edit',
                'guardians.view',
                'attendance.view', 'attendance.create', 'attendance.edit',
                'exams.view', 'exam-schedules.view',
                'exam-marks.view', 'exam-marks.create', 'exam-marks.edit',
                'student-results.view', 'class-results.view', 'class-routines.view',
                'teacher-staff.view', 'teacher-staff-attendance.view',
                'fee-collection.view', 'fee-collection.create',
                'fee-payment-history.view', 'fee-reports.view',
            ],

            'Teacher' => [
                'dashboard.view',
                'students.view', 'student-enrollments.view',
                'attendance.view', 'attendance.create', 'attendance.edit',
                'exams.view', 'exam-schedules.view', 'exam-subjects.view',
                'exam-marks.view', 'exam-marks.create', 'exam-marks.edit',
                'student-results.view', 'class-results.view',
                'result-sheets.view', 'class-routines.view',
            ],

            'Accountant' => [
                'dashboard.view',
                'fee-types.view',
                'student-fees.view', 'student-fees.create',
                'fee-collection.view', 'fee-collection.create',
                'fee-payment-history.view', 'fee-reports.view',
                'accounts.view', 'income-categories.view',
                'expenses.view', 'expenses.create', 'expenses.edit',
                'expense-categories.view', 'finance.view',
            ],

            'Receptionist' => [
                'dashboard.view',
                'students.view', 'students.create', 'students.edit',
                'student-enrollments.view', 'student-enrollments.create',
                'guardians.view',
            ],

            // Controller e own-record check lagbe
            'Student' => [
                'dashboard.view', 'student-results.view',
                'result-sheets.view', 'class-routines.view',
            ],

            // Controller e child-record check lagbe
            'Guardian' => [
                'dashboard.view', 'student-results.view',
                'result-sheets.view', 'attendance.view',
            ],
        ];

        // 3. Role toiri + permission assign
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name'       => $roleName,
                'guard_name' => $guard,
            ]);

            $role->syncPermissions($permissions);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}