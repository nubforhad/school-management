<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64
           -translate-x-full lg:translate-x-0
           bg-slate-900 text-white
           transition-transform duration-300">

    <div class="flex h-16 items-center justify-between px-5 border-b border-slate-700">

        <div class="flex items-center gap-3">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600">
                <span class="font-bold">SE</span>
            </div>

            <div>
                <h1 class="font-semibold text-sm">
                    School ERP
                </h1>

                <p class="text-xs text-slate-400">
                    Administration
                </p>
            </div>

        </div>

        <button
            onclick="closeSidebar()"
            class="lg:hidden text-slate-400 hover:text-white">

            ✕

        </button>

    </div>


    <div class="p-4">

        <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Main
        </p>

        <nav class="space-y-1">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5
                      text-sm text-slate-300 hover:bg-slate-800 hover:text-white">

                <span>📊</span>
                <span>Dashboard</span>

            </a>


            <a href="{{ route('admin.branches.index') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5
                      text-sm
                      {{ request()->routeIs('admin.branches.*')
                            ? 'bg-blue-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>🏢</span>
                <span>Branches</span>

            </a>

        </nav>

        <p class="px-3 mb-2 mt-7 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Academic
        </p>

        <nav class="space-y-1">
               <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm
                {{ request()->routeIs('admin.academic.sessions.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>📅</span>
                <span>Academic Sessions</span>

            </a>


            <a
                href="{{ route('admin.academic.classes.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm
                {{ request()->routeIs('admin.academic.classes.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>🎓</span>
                <span>Classes</span>

            </a>


            <a
                href="{{ route('admin.academic.sections.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm
                {{ request()->routeIs('admin.academic.sections.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>👥</span>
                <span>Sections</span>

            </a>


            <a
                href="{{ route('admin.academic.subjects.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm
                {{ request()->routeIs('admin.academic.subjects.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>📚</span>
                <span>Subjects</span>

            </a>


            <a
                href="{{ route('admin.academic.class-subjects.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm
                {{ request()->routeIs('admin.academic.class-subjects.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>🔗</span>
                <span>Class Subjects</span>

            </a>

        </nav>


        <p class="px-3 mb-2 mt-7 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Modules
        </p>


        <nav class="space-y-1">

            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>🎓</span>
                <span>Students</span>

            </a>
 
            <a href="{{ route('admin.student-enrollments.bulk.create') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>🎓</span>
                <span>Enrollments</span>

            </a>
 
            <a href="{{ route('admin.attendance.index') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>🎓</span>
                <span>Attendance</span>

            </a>
            
            <a href="{{ route('admin.attendances.report') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <i class="bi bi-bar-chart-line"></i>
                <span>Attendance Report</span>

            </a>
 


            <a href="#"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>👨‍🏫</span>
                <span>Teachers & Staff</span>

            </a>


            <a href="#"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>📚</span>
                <span>Academic</span>

            </a>


            <a href="#"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>📝</span>
                <span>Examination</span>

            </a>


            <a href="#"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>💰</span>
                <span>Fees</span>

            </a>


            <a href="#"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">

                <span>📈</span>
                <span>Accounts</span>

            </a>

        </nav>

    </div>

</aside>


{{-- Mobile Overlay --}}
<div
    id="sidebarOverlay"
    onclick="closeSidebar()"
    class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden">
</div>


<script>

function openSidebar()
{
    document.getElementById('sidebar')
        .classList.remove('-translate-x-full');

    document.getElementById('sidebarOverlay')
        .classList.remove('hidden');
}


function closeSidebar()
{
    document.getElementById('sidebar')
        .classList.add('-translate-x-full');

    document.getElementById('sidebarOverlay')
        .classList.add('hidden');
}

</script>