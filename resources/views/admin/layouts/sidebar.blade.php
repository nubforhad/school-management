{{-- =========================================================
    SIDEBAR
========================================================= --}}

<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64
           -translate-x-full lg:translate-x-0
           bg-slate-900 text-white
           border-r border-slate-800
           transition-transform duration-300 ease-in-out
           flex flex-col">

    {{-- =====================================================
        Logo / Header
    ====================================================== --}}

    <div class="flex h-16 shrink-0 items-center
                justify-between px-4
                border-b border-slate-800">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 min-w-0">

            {{-- Logo --}}

            <div class="flex h-9 w-9 shrink-0
                        items-center justify-center
                        rounded-xl
                        bg-gradient-to-br from-blue-500 to-indigo-600
                        shadow-lg shadow-blue-900/40
                        ring-1 ring-white/10">

                <span class="text-sm font-bold tracking-tight">
                    SE
                </span>

            </div>


            {{-- Brand --}}

            <div class="min-w-0">

                <h1 class="font-semibold text-sm
                           text-white truncate">

                    School ERP

                </h1>

                <p class="text-[11px]
                          text-slate-500 truncate">

                    Administration

                </p>

            </div>

        </a>


        {{-- Mobile Close --}}

        <button
            type="button"
            onclick="closeSidebar()"
            class="lg:hidden
                   flex h-8 w-8
                   items-center justify-center
                   rounded-lg
                   text-slate-400
                   hover:bg-slate-800
                   hover:text-white
                   transition">

            <i class="bi bi-x-lg text-sm"></i>

        </button>

    </div>


    {{-- =====================================================
        Scrollable Navigation
    ====================================================== --}}

    <div class="flex-1 overflow-y-auto
                px-3 py-4
                sidebar-scroll">

        {{-- =================================================
            MAIN
        ================================================== --}}

        <p class="px-3 mb-2
                  text-[10px]
                  font-semibold
                  uppercase
                  tracking-[0.12em]
                  text-slate-500">

            Main

        </p>


        <nav class="space-y-1">


            {{-- Dashboard --}}

            <a href="{{ route('dashboard') }}"
               class="nav-link group
                      {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('dashboard')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-blue-400 group-hover:text-blue-300' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- Branches --}}

            <a href="{{ route('admin.branches.index') }}"
               class="nav-link group
                      {{ request()->routeIs('admin.branches.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('admin.branches.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-indigo-400 group-hover:text-indigo-300' }}">
                    <i class="bi bi-building"></i>
                </span>

                <span>
                    Branches
                </span>

            </a>

        </nav>
<!-- //  ACADEMIC  -->

        <p class="px-3 mb-2 mt-7
                  text-[10px]
                  font-semibold
                  uppercase
                  tracking-[0.12em]
                  text-slate-500">

            Academic

        </p>


        <nav class="space-y-1">


            {{-- Academic Sessions --}}

            <a href="{{ route('admin.academic.sessions.index') }}"
               class="nav-link group
                      {{ request()->routeIs('admin.academic.sessions.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('admin.academic.sessions.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-sky-400 group-hover:text-sky-300' }}">
                    <i class="bi bi-calendar-event"></i>
                </span>

                <span>
                    Academic Sessions
                </span>

            </a>


            {{-- Classes --}}

            <a href="{{ route('admin.academic.classes.index') }}"
               class="nav-link group
                      {{ request()->routeIs('admin.academic.classes.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('admin.academic.classes.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-violet-400 group-hover:text-violet-300' }}">
                    <i class="bi bi-mortarboard-fill"></i>
                </span>

                <span>
                    Classes
                </span>

            </a>


            {{-- Sections --}}

            <a href="{{ route('admin.academic.sections.index') }}"
               class="nav-link group
                      {{ request()->routeIs('admin.academic.sections.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('admin.academic.sections.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-teal-400 group-hover:text-teal-300' }}">
                    <i class="bi bi-people-fill"></i>
                </span>

                <span>
                    Sections
                </span>

            </a>


            {{-- Subjects --}}

            <a href="{{ route('admin.academic.subjects.index') }}"
               class="nav-link group
                      {{ request()->routeIs('admin.academic.subjects.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon
                             {{ request()->routeIs('admin.academic.subjects.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-800 text-amber-400 group-hover:text-amber-300' }}">
                    <i class="bi bi-book-half"></i>
                </span>
                <span>  Subjects </span>
            </a>
            {{-- Class Subjects --}}

            <a href="{{ route('admin.academic.class-subjects.index') }}"  class="nav-link group   {{ request()->routeIs('admin.academic.class-subjects.*') ? 'nav-link-active' : '' }}">
                <span class="nav-icon {{ request()->routeIs('admin.academic.class-subjects.*') ? 'bg-white/15 text-white'  : 'bg-slate-800 text-rose-400 group-hover:text-rose-300' }}">
                    <i class="bi bi-diagram-3"></i>
                </span>
                <span>  Class Subjects </span>
            </a>
        </nav>


         <!-- STUDENT MANAGEMENT  -->

        <p class="px-3 mb-2 mt-7 text-[10px]  font-semibold  uppercase  tracking-[0.12em]  text-slate-500">
            Student Management
        </p>
        <nav class="space-y-1">
            {{-- Students --}}
            <a href="{{ route('admin.students.index') }}" class="nav-link group  {{ request()->routeIs('admin.students.*') ? 'nav-link-active' : '' }}">
                <span class="nav-icon   {{ request()->routeIs('admin.students.*')   ? 'bg-white/15 text-white'  : 'bg-slate-800 text-cyan-400 group-hover:text-cyan-300' }}">
                    <i class="bi bi-people"></i>
                </span>
                <span>  Students </span>
            </a>
            {{-- Enrollments --}}
            <a href="{{ route('admin.student-enrollments.bulk.create') }}" class="nav-link group {{ request()->routeIs('admin.student-enrollments.*') ? 'nav-link-active' : '' }}">

                <span class="nav-icon  {{ request()->routeIs('admin.student-enrollments.*') ? 'bg-white/15 text-white' : 'bg-slate-800 text-emerald-400 group-hover:text-emerald-300' }}">
                    <i class="bi bi-person-check-fill"></i>
                </span>
                <span>  Enrollments  </span>
            </a>
        </nav>


        {{-- =================================================
            ATTENDANCE
        ================================================== --}}

        <p class="px-3 mb-2 mt-7
                  text-[10px]
                  font-semibold
                  uppercase
                  tracking-[0.12em]
                  text-slate-500">

            Attendance

        </p>


        <nav class="space-y-1">


            {{-- Attendance Parent --}}

            <div
                x-data="{
                    open: {{ request()->routeIs('admin.attendance.*')
                            || request()->routeIs('admin.attendances.*')
                            ? 'true'
                            : 'false' }}
                }">


                {{-- Parent Button --}}

                <button
                    type="button"
                    @click="open = !open"
                    class="w-full flex items-center
                           justify-between
                           gap-3
                           rounded-lg px-2.5 py-2
                           text-sm font-medium
                           transition-colors duration-150

                           {{ request()->routeIs('admin.attendance.*')
                                || request()->routeIs('admin.attendances.*')
                                ? 'bg-slate-800 text-white'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    <span class="flex items-center gap-3">

                        <span class="nav-icon
                                     {{ request()->routeIs('admin.attendance.*')
                                            || request()->routeIs('admin.attendances.*')
                                            ? 'bg-white/15 text-white'
                                            : 'bg-slate-800 text-orange-400' }}">
                            <i class="bi bi-calendar-check-fill"></i>
                        </span>

                        <span>
                            Attendance
                        </span>

                    </span>


                    <i class="bi text-xs text-slate-500 transition-transform duration-200"
                       :class="open
                            ? 'bi-chevron-up'
                            : 'bi-chevron-down'">
                    </i>

                </button>


                {{-- Submenu --}}

                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="mt-1 ml-[18px] pl-4
                           border-l border-slate-700
                           space-y-0.5">


                    {{-- Take Attendance --}}

                    <a href="{{ route('admin.attendance.index') }}"
                       class="sub-link
                              {{ request()->routeIs('admin.attendance.index')
                                    ? 'sub-link-active'
                                    : '' }}">

                        <i class="bi bi-check2-square w-4 text-center"></i>

                        <span>
                            Take Attendance
                        </span>

                    </a>


                    {{-- Attendance Report --}}

                    <a href="{{ route('admin.attendances.report') }}"
                       class="sub-link
                              {{ request()->routeIs('admin.attendances.report')
                                    ? 'sub-link-active'
                                    : '' }}">

                        <i class="bi bi-file-earmark-bar-graph w-4 text-center"></i>

                        <span>
                            Attendance Report
                        </span>

                    </a>


                    {{-- Analytics --}}

                    <a href="{{ route('admin.attendance.analytics') }}"
                       class="sub-link
                              {{ request()->routeIs('admin.attendance.analytics')
                                    ? 'sub-link-active'
                                    : '' }}">

                        <i class="bi bi-graph-up-arrow w-4 text-center"></i>

                        <span>
                            Analytics
                        </span>

                    </a>


                    {{-- Student History --}}

                    <a href="{{ route('admin.attendance.student-history') }}"
                       class="sub-link
                              {{ request()->routeIs('admin.attendance.student-history')
                                    ? 'sub-link-active'
                                    : '' }}">

                        <i class="bi bi-person-lines-fill w-4 text-center"></i>

                        <span>
                            Student History
                        </span>

                    </a>


                    {{-- Monthly Report --}}

                    <a href="{{ route('admin.attendance.monthly-report') }}"
                       class="sub-link
                              {{ request()->routeIs('admin.attendance.monthly-report')
                                    ? 'sub-link-active'
                                    : '' }}">

                        <i class="bi bi-calendar3 w-4 text-center"></i>

                        <span>
                            Monthly Report
                        </span>

                    </a>

                </div>

            </div>

        </nav>

      {{-- =========================================================
    Fee Management
========================================================= --}}

<p class="px-3 mb-2 mt-7
          text-[10px]
          font-semibold
          uppercase
          tracking-[0.12em]
          text-slate-500">

    Fee Management

</p>


<nav class="space-y-1">

    {{-- Fee Management Parent --}}
    <div
        x-data="{
            open: {{ request()->routeIs('admin.fee-types.*')
                        ? 'true'
                        : 'false' }}
        }">


        {{-- Parent Button --}}
        <button
            type="button"
            @click="open = !open"
            class="w-full flex items-center
                   justify-between
                   gap-3
                   rounded-lg px-2.5 py-2
                   text-sm font-medium
                   transition-colors duration-150

                   {{ request()->routeIs('admin.fee-types.*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">


            <span class="flex items-center gap-3">

                {{-- Icon --}}
                <span
                    class="nav-icon
                           {{ request()->routeIs('admin.fee-types.*')
                                ? 'bg-white/15 text-white'
                                : 'bg-slate-800 text-orange-400' }}">

                    <i class="bi bi-cash-stack"></i>

                </span>


                {{-- Title --}}
                <span>
                    Fee
                </span>

            </span>


            {{-- Arrow --}}
            <i
                class="bi text-xs text-slate-500
                       transition-transform duration-200"
                :class="open
                    ? 'bi-chevron-up'
                    : 'bi-chevron-down'">
            </i>

        </button>


        {{-- =====================================================
            Submenu
        ====================================================== --}}

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"

            class="mt-1 ml-[18px] pl-4
                   border-l border-slate-700
                   space-y-0.5">


            {{-- Fee Types --}}
            <a
                href="{{ route('admin.fee-types.index') }}"
                class="sub-link
                       {{ request()->routeIs('admin.fee-types.index')
                            ? 'sub-link-active'
                            : '' }}">

                <i class="bi bi-tags w-4 text-center"></i>

                <span>
                    Fee Types
                </span>

            </a>


            {{-- Future: Fee Assignment --}}
            

            <a
                href="{{ route('admin.student-fees.index') }}"
                class="sub-link
                       {{ request()->routeIs('admin.student-fees.*')
                            ? 'sub-link-active'
                            : '' }}">

                <i class="bi bi-person-check w-4 text-center"></i>

                <span>
                    Student Fees
                </span>

            </a>
 


            {{-- Future: Fee Collection --}}
           

            <a
                href="{{ route('admin.fee-collection.index') }}"
                class="sub-link
                       {{ request()->routeIs('admin.fee-collection.*')
                            ? 'sub-link-active'
                            : '' }}">

                <i class="bi bi-wallet2 w-4 text-center"></i>

                <span>
                    Fee Collection
                </span>

            </a>

            <a href="{{ route('admin.fee-payment-history.index') }}" class="flex items-center gap-3 px-3 py-2.5
                    rounded-lg text-sm  text-slate-600  hover:bg-slate-100 hover:text-slate-800 transition">

                <i class="bi bi-clock-history"></i>

                <span>
                    Payment History
                </span>

            </a>




        </div>

    </div>

</nav>


        {{-- =================================================
            OTHER MODULES
        ================================================== --}}

        <p class="px-3 mb-2 mt-7
                  text-[10px]
                  font-semibold
                  uppercase
                  tracking-[0.12em]
                  text-slate-500">

            Other Modules

        </p>


        <nav class="space-y-1">


            {{-- Teachers --}}

            <a href="#" class="nav-link nav-link-disabled group">

                <span class="nav-icon bg-slate-800 text-slate-500">
                    <i class="bi bi-person-workspace"></i>
                </span>

                <span>
                    Teachers & Staff
                </span>

                <span class="soon-badge">
                    Soon
                </span>

            </a>


            {{-- Examination --}}

            <a href="#" class="nav-link nav-link-disabled group">

                <span class="nav-icon bg-slate-800 text-slate-500">
                    <i class="bi bi-journal-text"></i>
                </span>

                <span>
                    Examination
                </span>

                <span class="soon-badge">
                    Soon
                </span>

            </a>


            {{-- Fees --}}

            <a href="#" class="nav-link nav-link-disabled group">

                <span class="nav-icon bg-slate-800 text-slate-500">
                    <i class="bi bi-cash-stack"></i>
                </span>

                <span>
                    Fees
                </span>

                <span class="soon-badge">
                    Soon
                </span>

            </a>


            {{-- Accounts --}}

            <a href="#" class="nav-link nav-link-disabled group">

                <span class="nav-icon bg-slate-800 text-slate-500">
                    <i class="bi bi-wallet2"></i>
                </span>

                <span>
                    Accounts
                </span>

                <span class="soon-badge">
                    Soon
                </span>

            </a>

        </nav>

    </div>


    {{-- =====================================================
        Sidebar Footer
    ====================================================== --}}

    <div class="shrink-0
                border-t border-slate-800
                p-3">

        <div class="flex items-center gap-3
                    rounded-xl
                    bg-slate-800/60
                    px-3 py-2.5
                    ring-1 ring-white/5">

            <div class="flex h-8 w-8
                        items-center justify-center
                        rounded-full
                        bg-gradient-to-br from-blue-500 to-indigo-600
                        shadow-md shadow-blue-900/30">

                <i class="bi bi-person-fill text-sm"></i>

            </div>

            <div class="min-w-0">

                <p class="text-xs font-medium
                          text-white truncate">

                    Administrator

                </p>

                <p class="text-[10px]
                          text-slate-500">

                    School ERP

                </p>

            </div>

        </div>

    </div>

</aside>


{{-- =========================================================
    MOBILE OVERLAY
========================================================= --}}

<div
    id="sidebarOverlay"
    onclick="closeSidebar()"
    class="fixed inset-0 z-40
           hidden
           bg-black/50
           backdrop-blur-sm
           lg:hidden">
</div>


{{-- =========================================================
    SIDEBAR STYLES
========================================================= --}}

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

/* ---- Nav links ---- */

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border-radius: 0.65rem;
    padding: 0.5rem 0.625rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #cbd5e1; /* slate-300 */
    transition: background-color .15s ease, color .15s ease, transform .1s ease;
}

.nav-link:hover {
    background-color: #1e293b; /* slate-800 */
    color: #ffffff;
}

.nav-link:active {
    transform: scale(0.98);
}

.nav-link-active {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    box-shadow: 0 4px 14px -4px rgba(37, 99, 235, .5);
}

.nav-link-active:hover {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
}

.nav-link-disabled {
    color: #64748b; /* slate-500 */
    cursor: not-allowed;
}

.nav-link-disabled:hover {
    background-color: transparent;
    color: #94a3b8;
}

/* ---- Icon chip ---- */

.nav-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 2rem;
    height: 2rem;
    border-radius: 0.55rem;
    font-size: 0.95rem;
    transition: background-color .15s ease, color .15s ease;
}

/* ---- Sub links (submenu) ---- */

.sub-link {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    border-radius: 0.5rem;
    padding: 0.45rem 0.6rem;
    font-size: 0.8125rem;
    color: #94a3b8; /* slate-400 */
    transition: background-color .15s ease, color .15s ease;
}

.sub-link:hover {
    background-color: #1e293b;
    color: #ffffff;
}

.sub-link-active {
    background-color: #2563eb;
    color: #ffffff;
}

/* ---- Soon badge ---- */

.soon-badge {
    margin-left: auto;
    font-size: 9px;
    border-radius: 9999px;
    background-color: #1e293b;
    padding: 0.15rem 0.45rem;
    color: #64748b;
    letter-spacing: .02em;
}

</style>


// SIDEBAR JS 

<script>

    function openSidebar()
    {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) {
            sidebar.classList.remove('-translate-x-full');
        }
        if (overlay) {
            overlay.classList.remove('hidden');
        }
        document.body.classList.add('overflow-hidden');
    }

    function closeSidebar()
    {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) {
            sidebar.classList.add('-translate-x-full');
        }
        if (overlay) {
            overlay.classList.add('hidden');
        }
        document.body.classList.remove('overflow-hidden');
    }


    // Close mobile sidebar after clicking a link

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#sidebar a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });
    });

</script>