
{{-- =========================================================
    MADRASAH ERP SIDEBAR
    Existing Seeder Permission Names are Preserved
========================================================= --}}

@php
    $user = auth()->user();

    // Academic section
    $hasAcademicMenu =
        $user->can('academic-sessions.view') ||
        $user->can('classes.view') ||
        $user->can('sections.view') ||
        $user->can('subjects.view') ||
        $user->can('class-subjects.view');

    // Student section
    $hasStudentMenu =
        $user->can('students.view') ||
        $user->can('student-enrollments.view') ||
        $user->can('guardians.view') ||
        $user->can('class-routines.view');

    // Attendance section
    $hasAttendanceMenu = $user->can('attendance.view');

    // Fee section
    $hasFeeMenu =
        $user->can('fee-types.view') ||
        $user->can('student-fees.view') ||
        $user->can('fee-collection.view') ||
        $user->can('fee-payment-history.view') ||
        $user->can('fee-reports.view');

    // Examination section
    $hasExamMenu =
        $user->can('exams.view') ||
        $user->can('exam-schedules.view') ||
        $user->can('exam-subjects.view') ||
        $user->can('exam-marks.view') ||
        $user->can('student-results.view') ||
        $user->can('result-sheets.view') ||
        $user->can('class-results.view');

    // Teachers and Staff section
    $hasStaffMenu =
        $user->can('departments.view') ||
        $user->can('designations.view') ||
        $user->can('teacher-staff.view') ||
        $user->can('teacher-assignment.view') ||
        $user->can('salary-structures.view') ||
        $user->can('salary-payments.view');

    // Leave section
    $hasLeaveMenu =
        $user->can('leave-types.view') ||
        $user->can('leave-allocations.view') ||
        $user->can('leave-applications.view') ||
        $user->can('teacher-staff-attendance.view');

    // Finance section
    $hasFinanceMenu =
        $user->can('income-categories.view') ||
        $user->can('expense-categories.view') ||
        $user->can('expenses.view') ||
        $user->can('accounts.view') ||
        $user->can('finance.view');
@endphp

<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full lg:translate-x-0 bg-slate-900 text-white border-r border-slate-800 transition-transform duration-300 ease-in-out flex flex-col">

    {{-- Logo / Header --}}
    <div class="flex h-16 shrink-0 items-center justify-between px-4 border-b border-slate-800">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 min-w-0">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-900/40 ring-1 ring-white/10">
                <img src="{{ asset('asset/image/imagelogo.png') }}" alt="logo">
            </div>

            <div class="min-w-0">
                <h1 class="font-semibold text-sm text-white truncate">Madrasah ERP</h1>
                <p class="text-[11px] text-slate-500 truncate">Administration</p>
            </div>

        </a>

        <button type="button" onclick="closeSidebar()"
            class="lg:hidden flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition">
            <i class="bi bi-x-lg text-sm"></i>
        </button>

    </div>

    {{-- Navigation --}}
    <div class="flex-1 overflow-y-auto px-3 py-4 sidebar-scroll">

        {{-- ================= MAIN ================= --}}
        @if(
            $user->can('dashboard.view') ||
            $user->can('users.view') ||
            $user->can('branches.view')
        )

            <p class="sidebar-heading">Main</p>

            <nav class="space-y-1">

                @can('dashboard.view')
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-blue-400">
                            <i class="bi bi-grid-1x2-fill"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                @endcan

                @can('users.view')
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-green-400">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <span>Users</span>
                    </a>
                @endcan

                @can('branches.view')
                    <a href="{{ route('admin.branches.index') }}"
                        class="nav-link {{ request()->routeIs('admin.branches.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-indigo-400">
                            <i class="bi bi-building"></i>
                        </span>
                        <span>Branches</span>
                    </a>
                @endcan

            </nav>
        @endif


        {{-- ================= ACADEMIC ================= --}}
        @if($hasAcademicMenu)

            <p class="sidebar-heading">Academic</p>

            <nav class="space-y-1">

                @can('academic-sessions.view')
                    <a href="{{ route('admin.academic.sessions.index') }}"
                        class="nav-link {{ request()->routeIs('admin.academic.sessions.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-sky-400">
                            <i class="bi bi-calendar-event"></i>
                        </span>
                        <span>Academic Sessions</span>
                    </a>
                @endcan

                @can('classes.view')
                    <a href="{{ route('admin.academic.classes.index') }}"
                        class="nav-link {{ request()->routeIs('admin.academic.classes.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-violet-400">
                            <i class="bi bi-mortarboard-fill"></i>
                        </span>
                        <span>Classes</span>
                    </a>
                @endcan

                @can('sections.view')
                    <a href="{{ route('admin.academic.sections.index') }}"
                        class="nav-link {{ request()->routeIs('admin.academic.sections.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-teal-400">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <span>Sections</span>
                    </a>
                @endcan

                @can('subjects.view')
                    <a href="{{ route('admin.academic.subjects.index') }}"
                        class="nav-link {{ request()->routeIs('admin.academic.subjects.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-amber-400">
                            <i class="bi bi-book-half"></i>
                        </span>
                        <span>Subjects</span>
                    </a>
                @endcan

                @can('class-subjects.view')
                    <a href="{{ route('admin.academic.class-subjects.index') }}"
                        class="nav-link {{ request()->routeIs('admin.academic.class-subjects.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-rose-400">
                            <i class="bi bi-diagram-3"></i>
                        </span>
                        <span>Class Subjects</span>
                    </a>
                @endcan

            </nav>
        @endif


        {{-- ================= STUDENT MANAGEMENT ================= --}}
        @if($hasStudentMenu)

            <p class="sidebar-heading">Student Management</p>

            <nav class="space-y-1">

                @can('students.view')
                    <a href="{{ route('admin.students.index') }}"
                        class="nav-link {{ request()->routeIs('admin.students.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-cyan-400">
                            <i class="bi bi-people"></i>
                        </span>
                        <span>Students</span>
                    </a>
                @endcan

                @can('guardians.view')
                    <a href="{{ route('admin.guardians.index') }}"
                        class="nav-link {{ request()->routeIs('admin.guardians.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-cyan-400">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <span>Guardians</span>
                    </a>
                @endcan

                @can('class-routines.view')
                    <a href="{{ route('admin.class-routines.index') }}"
                        class="nav-link {{ request()->routeIs('admin.class-routines.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-cyan-400">
                            <i class="bi bi-calendar-week"></i>
                        </span>
                        <span>Class Routines</span>
                    </a>
                @endcan

                @can('student-enrollments.view')
                    <a href="{{ route('admin.student-enrollments.bulk.create') }}"
                        class="nav-link {{ request()->routeIs('admin.student-enrollments.*') || request()->routeIs('admin.students.enrollments.*') ? 'nav-link-active' : '' }}">
                        <span class="nav-icon bg-slate-800 text-emerald-400">
                            <i class="bi bi-person-check-fill"></i>
                        </span>
                        <span>Enrollments</span>
                    </a>
                @endcan

            </nav>
        @endif


        {{-- ================= ATTENDANCE ================= --}}
        @if($hasAttendanceMenu)

            <div class="nav-group">

                <button type="button" onclick="toggleNavGroup(this)"
                    class="nav-group-title w-full flex items-center justify-between text-left
                    {{ request()->routeIs('admin.attendance.*') || request()->routeIs('admin.attendances.*') ? 'active' : '' }}">

                    <div class="flex items-center gap-3">
                        <span class="nav-icon bg-slate-800 text-slate-300">
                            <i class="bi bi-calendar-check-fill"></i>
                        </span>
                        <span>Attendance</span>
                    </div>

                    <i class="bi bi-chevron-down nav-group-arrow"></i>

                </button>

                <div class="nav-submenu hidden">

                    @can('attendance.view')
                        <a href="{{ route('admin.attendance.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-check2-square"></i>
                            </span>
                            <span>Take Attendance</span>
                        </a>
                    @endcan

                </div>

            </div>
        @endif


        {{-- ================= FEE MANAGEMENT ================= --}}
        @if($hasFeeMenu)

            <div class="nav-group">

                <button type="button" onclick="toggleNavGroup(this)"
                    class="nav-group-title w-full flex items-center justify-between text-left
                    {{ request()->routeIs('admin.fee-types.*') ||
                       request()->routeIs('admin.student-fees.*') ||
                       request()->routeIs('admin.fee-collection.*') ||
                       request()->routeIs('admin.fee-payment-history.*') ||
                       request()->routeIs('admin.fee-reports.*') ? 'active' : '' }}">

                    <div class="flex items-center gap-3">
                        <span class="nav-icon bg-slate-800 text-orange-400">
                            <i class="bi bi-cash-stack"></i>
                        </span>
                        <span>Fee Management</span>
                    </div>

                    <i class="bi bi-chevron-down nav-group-arrow"></i>

                </button>

                <div class="nav-submenu hidden">

                    @can('fee-types.view')
                        <a href="{{ route('admin.fee-types.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-tags"></i>
                            </span>
                            <span>Fee Types</span>
                        </a>
                    @endcan

                    @can('student-fees.view')
                        <a href="{{ route('admin.student-fees.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-person-check"></i>
                            </span>
                            <span>Student Fees</span>
                        </a>
                    @endcan

                    @can('fee-collection.view')
                        <a href="{{ route('admin.fee-collection.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-wallet2"></i>
                            </span>
                            <span>Fee Collection</span>
                        </a>
                    @endcan

                    @can('fee-payment-history.view')
                        <a href="{{ route('admin.fee-payment-history.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-clock-history"></i>
                            </span>
                            <span>Payment History</span>
                        </a>
                    @endcan

                    @can('fee-reports.view')
                        <a href="{{ route('admin.fee-reports.collection') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-file-earmark-bar-graph"></i>
                            </span>
                            <span>Fee Reports</span>
                        </a>
                    @endcan

                </div>
            </div>
        @endif


        {{-- ================= EXAMINATION ================= --}}
        @if($hasExamMenu)

            <div class="nav-group">

                <button type="button" onclick="toggleNavGroup(this)"
                    class="nav-group-title w-full flex items-center justify-between text-left
                    {{ request()->routeIs('admin.exams.*') ||
                       request()->routeIs('admin.exam-schedules.*') ||
                       request()->routeIs('admin.exam-subjects.*') ||
                       request()->routeIs('admin.exam-marks.*') ||
                       request()->routeIs('admin.student-results.*') ||
                       request()->routeIs('admin.result-sheets.*') ||
                       request()->routeIs('admin.class-results.*') ? 'active' : '' }}">

                    <div class="flex items-center gap-3">
                        <span class="nav-icon bg-slate-800 text-slate-300">
                            <i class="bi bi-journal-text"></i>
                        </span>
                        <span>Examination</span>
                    </div>

                    <i class="bi bi-chevron-down nav-group-arrow"></i>

                </button>

                <div class="nav-submenu hidden">

                    @can('exams.view')
                        <a href="{{ route('admin.exams.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-journal-text"></i>
                            </span>
                            <span>Exams</span>
                        </a>
                    @endcan

                    @can('exam-schedules.view')
                        <a href="{{ route('admin.exam-schedules.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-calendar2-week"></i>
                            </span>
                            <span>Exam Schedules</span>
                        </a>
                    @endcan

                    @can('exam-subjects.view')
                        <a href="{{ route('admin.exam-subjects.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-book"></i>
                            </span>
                            <span>Exam Subjects</span>
                        </a>
                    @endcan

                    @can('exam-marks.view')
                        <a href="{{ route('admin.exam-marks.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-pencil-square"></i>
                            </span>
                            <span>Exam Marks</span>
                        </a>
                    @endcan

                    @can('student-results.view')
                        <a href="{{ route('admin.student-results.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-person-vcard"></i>
                            </span>
                            <span>Student Results</span>
                        </a>
                    @endcan

                    @can('result-sheets.view')
                        <a href="{{ route('admin.result-sheets.show') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                            </span>
                            <span>Result Sheets</span>
                        </a>
                    @endcan

                    @can('class-results.view')
                        <a href="{{ route('admin.class-results.index') }}" class="nav-link group">
                            <span class="nav-icon bg-slate-800 text-slate-400">
                                <i class="bi bi-clipboard-data"></i>
                            </span>
                            <span>Class Results</span>
                        </a>
                    @endcan

                </div>
            </div>
        @endif


        {{-- ================= OTHER MODULES ================= --}}
        @if($hasStaffMenu || $hasLeaveMenu || $hasFinanceMenu)

            <p class="sidebar-heading">Other Modules</p>

            @if($hasStaffMenu)

                <div class="nav-group">

                    <button type="button" onclick="toggleNavGroup(this)"
                        class="nav-group-title w-full flex items-center justify-between text-left">

                        <div class="flex items-center gap-3">
                            <span class="nav-icon bg-slate-800 text-slate-300">
                                <i class="bi bi-person-workspace"></i>
                            </span>
                            <span>Teachers & Staff</span>
                        </div>

                        <i class="bi bi-chevron-down nav-group-arrow"></i>

                    </button>

                    <div class="nav-submenu hidden">

                        @can('departments.view')
                            <a href="{{ route('admin.departments.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                                <span>Departments</span>
                            </a>
                        @endcan

                        @can('designations.view')
                            <a href="{{ route('admin.designations.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                <span>Designations</span>
                            </a>
                        @endcan

                        @can('teacher-staff.view')
                            <a href="{{ route('admin.teacher-staff.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-people"></i>
                                </span>
                                <span>Teachers & Staff</span>
                            </a>
                        @endcan

                        @can('teacher-assignment.view')
                            <a href="{{ route('admin.teacher-assignment.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-person-lines-fill"></i>
                                </span>
                                <span>Teacher Assignment</span>
                            </a>
                        @endcan

                        @can('salary-structures.view')
                            <a href="{{ route('admin.salary-structures.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-cash"></i>
                                </span>
                                <span>Salary Structures</span>
                            </a>
                        @endcan

                        @can('salary-payments.view')
                            <a href="{{ route('admin.salary-payments.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-wallet"></i>
                                </span>
                                <span>Salary Payments</span>
                            </a>
                        @endcan

                    </div>
                </div>
            @endif


            {{-- Leave Management --}}
            @if($hasLeaveMenu)

                <div class="nav-group">

                    <button type="button" onclick="toggleNavGroup(this)"
                        class="nav-group-title w-full flex items-center justify-between text-left">

                        <div class="flex items-center gap-3">
                            <span class="nav-icon bg-slate-800 text-slate-300">
                                <i class="bi bi-calendar2-check"></i>
                            </span>
                            <span>Leave Management</span>
                        </div>

                        <i class="bi bi-chevron-down nav-group-arrow"></i>

                    </button>

                    <div class="nav-submenu hidden">

                        @can('leave-types.view')
                            <a href="{{ route('admin.leave-types.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-list-check"></i>
                                </span>
                                <span>Leave Types</span>
                            </a>
                        @endcan

                        @can('leave-allocations.view')
                            <a href="{{ route('admin.leave-allocations.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-calendar-plus"></i>
                                </span>
                                <span>Leave Allocations</span>
                            </a>
                        @endcan

                        @can('leave-applications.view')
                            <a href="{{ route('admin.leave-applications.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-envelope-paper"></i>
                                </span>
                                <span>Leave Applications</span>
                            </a>
                        @endcan

                        @can('teacher-staff-attendance.view')
                            <a href="{{ route('admin.teacher-staff-attendance.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-person-check"></i>
                                </span>
                                <span>Teacher Staff Attendance</span>
                            </a>
                        @endcan

                    </div>
                </div>
            @endif


            {{-- Finance --}}
            @if($hasFinanceMenu)

                <div class="nav-group">

                    <button type="button" onclick="toggleNavGroup(this)"
                        class="nav-group-title w-full flex items-center justify-between text-left">

                        <div class="flex items-center gap-3">
                            <span class="nav-icon bg-slate-800 text-slate-300">
                                <i class="bi bi-calculator"></i>
                            </span>
                            <span>Finance</span>
                        </div>

                        <i class="bi bi-chevron-down nav-group-arrow"></i>

                    </button>

                    <div class="nav-submenu hidden">

                        @can('income-categories.view')
                            <a href="{{ route('admin.income-categories.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <span>Income Categories</span>
                            </a>
                        @endcan

                        @can('expense-categories.view')
                            <a href="{{ route('admin.expense-categories.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <span>Expense Categories</span>
                            </a>
                        @endcan

                        @can('expenses.view')
                            <a href="{{ route('admin.expenses.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-receipt"></i>
                                </span>
                                <span>Expenses</span>
                            </a>
                        @endcan

                        @can('accounts.view')
                            <a href="{{ route('admin.accounts.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-bank"></i>
                                </span>
                                <span>Accounts</span>
                            </a>
                        @endcan

                        @can('finance.view')
                            <a href="{{ route('admin.finance.index') }}" class="nav-link group">
                                <span class="nav-icon bg-slate-800 text-slate-400">
                                    <i class="bi bi-graph-up"></i>
                                </span>
                                <span>Finance Report</span>
                            </a>
                        @endcan

                    </div>
                </div>
            @endif

        @endif


        {{-- ================= SETTINGS ================= --}}
        @can('settings.view')
            <a href="{{ route('admin.settings.general') }}"
                class="nav-link {{ request()->routeIs('admin.settings.*') ? 'nav-link-active' : '' }}">
                <span class="nav-icon bg-slate-800 text-slate-400">
                    <i class="bi bi-gear"></i>
                </span>
                <span>Settings</span>
            </a>
        @endcan


        {{-- ================= ROLE MANAGEMENT ================= --}}
        @can('roles.view')
            <a href="{{ route('admin.roles.index') }}"
                class="nav-link {{ request()->routeIs('admin.roles.*') ? 'nav-link-active' : '' }}">
                <span class="nav-icon bg-slate-800 text-indigo-400">
                    <i class="bi bi-shield-lock"></i>
                </span>
                <span>Roles & Permissions</span>
            </a>
        @endcan

    </div>


    {{-- Sidebar Footer --}}
    <div class="shrink-0 border-t border-slate-800 p-3">

        <div class="flex items-center gap-3 rounded-xl bg-slate-800/60 px-3 py-2.5 ring-1 ring-white/5">

            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 shadow-md shadow-blue-900/30">
                <i class="bi bi-person-fill text-sm"></i>
            </div>

            <div class="min-w-0">
                <p class="text-xs font-medium text-white truncate">
                    {{ $user->name }}
                </p>
                <p class="text-[10px] text-slate-500">Madrasah ERP</p>
            </div>

        </div>

    </div>

</aside>


{{-- Mobile Overlay --}}
<div id="sidebarOverlay"
    onclick="closeSidebar()"
    class="fixed inset-0 z-40 hidden bg-black/50 backdrop-blur-sm lg:hidden">
</div>


{{-- Sidebar CSS --}}
<style>
    .sidebar-scroll {
        scrollbar-width: thin;
        scrollbar-color: #334155 transparent;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 10px;
    }

    .sidebar-heading {
        padding-left: 12px;
        margin-bottom: 8px;
        margin-top: 28px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #64748b;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-radius: 0.65rem;
        padding: 0.5rem 0.625rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #cbd5e1;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .nav-link:hover {
        background-color: #1e293b;
        color: #ffffff;
    }

    .nav-link-active {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: #ffffff;
        box-shadow: 0 4px 14px -4px rgba(37, 99, 235, 0.5);
    }

    .nav-link-active:hover {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
    }

    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 2rem;
        height: 2rem;
        border-radius: 0.55rem;
        font-size: 0.95rem;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .nav-group-title {
        border: 0;
        background: transparent;
        cursor: pointer;
        padding: 10px 12px;
        color: #cbd5e1;
        transition: all 0.25s ease;
        border-radius: 10px;
    }

    .nav-group-title:hover,
    .nav-group-title.active {
        background: rgba(30, 41, 59, 0.8);
        color: #ffffff;
    }

    .nav-group-arrow {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .nav-group-title.active .nav-group-arrow {
        transform: rotate(180deg);
    }

    .nav-submenu {
        margin-left: 12px;
        padding-left: 14px;
        border-left: 1px solid rgba(148, 163, 184, 0.15);
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.25s ease;
        animation: submenuOpen 0.25s ease;
    }

    .nav-submenu .nav-link {
        position: relative;
        margin-top: 3px;
        padding-left: 10px;
    }

    .nav-submenu .nav-link::before {
        content: "";
        position: absolute;
        left: -15px;
        top: 50%;
        width: 8px;
        height: 1px;
        background: rgba(148, 163, 184, 0.25);
        transition: all 0.2s ease;
    }

    .nav-submenu .nav-link:hover::before {
        width: 14px;
        background: #3b82f6;
    }

    @keyframes submenuOpen {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


{{-- Sidebar JavaScript --}}
<script>
    function openSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (sidebar) sidebar.classList.remove("-translate-x-full");
        if (overlay) overlay.classList.remove("hidden");

        document.body.classList.add("overflow-hidden");
    }

    function closeSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (sidebar) sidebar.classList.add("-translate-x-full");
        if (overlay) overlay.classList.add("hidden");

        document.body.classList.remove("overflow-hidden");
    }

    function toggleNavGroup(button) {
        const submenu = button.nextElementSibling;

        if (!submenu) return;

        const isOpen = !submenu.classList.contains("hidden");

        submenu.classList.toggle("hidden");
        button.classList.toggle("active", !isOpen);
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("#sidebar a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });

        // Automatically open active submenu
        document.querySelectorAll("#sidebar .nav-group").forEach(function (group) {
            const activeLink = group.querySelector(".nav-link-active");

            if (activeLink) {
                const submenu = activeLink.closest(".nav-submenu");
                const button = submenu ? submenu.previousElementSibling : null;

                if (submenu && button) {
                    submenu.classList.remove("hidden");
                    button.classList.add("active");
                }
            }
        });
    });
</script>
