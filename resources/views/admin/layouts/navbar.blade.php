<header class="sticky top-0 z-30 h-16 border-b border-slate-200 bg-white">
    <div class="flex h-full items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-3">
            <button
                onclick="openSidebar()"
                class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden">
                ☰
            </button>
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    @yield('page-title', 'Dashboard')
                </h2>
                <p class="hidden text-xs text-slate-500 sm:block">
                    School Management ERP
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            {{-- Notification --}}
            <button  class="relative rounded-lg p-2 text-slate-500 hover:bg-slate-100"> 🔔
                <span
                    class="absolute right-1 top-1 h-2 w-2 rounded-full bg-red-500">
                </span>
            </button>
            {{-- User --}}
            <div class="hidden items-center gap-3 sm:flex">
                {{-- User Info --}}
                <div class="text-right">
                    <p class="text-sm font-medium text-slate-800">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        Administrator
                    </p>
                </div>
                {{-- Avatar --}}
                <div  class="flex h-9 w-9 items-center justify-center
                        rounded-full bg-blue-600
                        text-sm font-semibold text-white">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                {{-- Logout --}}
                <form  method="POST"  action="{{ route('logout') }}" class="ml-1">
                    @csrf
                    <button type="submit"  title="Logout" class="flex h-9 w-9 items-center justify-center  rounded-lg  text-slate-500 transition  hover:bg-red-50   hover:text-red-600">
                        <i class="bi bi-box-arrow-right text-lg"></i> 
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>