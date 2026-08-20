@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-bar-chart-line"></i>
                Attendance Report
            </h4>

            <small class="text-muted">
                Attendance summary and detailed report
            </small>
        </div>

        <div>
            <a href="{{ route('attendances.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

            <button onclick="window.print()"
                    class="btn btn-dark">
                <i class="bi bi-printer"></i>
                Print
            </button>
        </div>

    </div>


    {{-- Filter --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>
                <i class="bi bi-funnel"></i>
                Filter Attendance
            </strong>
        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('attendances.report') }}">

                <div class="row g-3">

                    {{-- From Date --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            From Date
                        </label>

                        <input type="date"
                               name="from_date"
                               value="{{ request('from_date') }}"
                               class="form-control">

                    </div>


                    {{-- To Date --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            To Date
                        </label>

                        <input type="date"
                               name="to_date"
                               value="{{ request('to_date') }}"
                               class="form-control">

                    </div>


                    {{-- Branch --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Branch
                        </label>

                        <select name="branch_id"
                                class="form-select">

                            <option value="">
                                All Branches
                            </option>

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ request('branch_id') == $branch->id ? 'selected' : '' }}>

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Employee --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Employee
                        </label>

                        <select name="employee_id"
                                class="form-select">

                            <option value="">
                                All Employees
                            </option>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}"
                                    {{ request('employee_id') == $employee->id ? 'selected' : '' }}>

                                    {{ $employee->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-12">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bi bi-search"></i>
                            Search

                        </button>


                        <a href="{{ route('attendances.report') }}"
                           class="btn btn-outline-secondary">

                            <i class="bi bi-arrow-clockwise"></i>
                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">

        {{-- Total --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Total Attendance
                            </small>

                            <h3 class="mb-0">
                                {{ $total }}
                            </h3>
                        </div>

                        <div class="fs-2 text-primary">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Present --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Present
                            </small>

                            <h3 class="mb-0 text-success">
                                {{ $present }}
                            </h3>
                        </div>

                        <div class="fs-2 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Late --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Late
                            </small>

                            <h3 class="mb-0 text-warning">
                                {{ $late }}
                            </h3>
                        </div>

                        <div class="fs-2 text-warning">
                            <i class="bi bi-clock"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Absent --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Absent
                            </small>

                            <h3 class="mb-0 text-danger">
                                {{ $absent }}
                            </h3>
                        </div>

                        <div class="fs-2 text-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Attendance Table --}}
    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between">

            <strong>
                Attendance Details
            </strong>

            <span class="text-muted">
                {{ $attendances->count() }} Records
            </span>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-bordered mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Date</th>

                            <th>Employee</th>

                            <th>Branch</th>

                            <th>In Time</th>

                            <th>Out Time</th>

                            <th>Working Hours</th>

                            <th>Late</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($attendances as $attendance)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                                </td>

                                <td>

                                    <strong>
                                        {{ $attendance->employee->name ?? 'N/A' }}
                                    </strong>

                                    @if(isset($attendance->employee->finger_id))

                                        <br>

                                        <small class="text-muted">
                                            Finger ID:
                                            {{ $attendance->employee->finger_id }}
                                        </small>

                                    @endif

                                </td>


                                <td>
                                    {{ $attendance->employee->branch->name ?? 'N/A' }}
                                </td>


                                <td>
                                    {{ $attendance->in_time ?? '-' }}
                                </td>


                                <td>
                                    {{ $attendance->out_time ?? '-' }}
                                </td>


                                <td>
                                    {{ $attendance->working_hours ?? '-' }}
                                </td>


                                <td>

                                    @if(($attendance->late_minutes ?? 0) > 0)

                                        <span class="badge bg-warning text-dark">
                                            {{ $attendance->late_minutes }} min
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($attendance->status === 'Present')

                                        <span class="badge bg-success">
                                            Present
                                        </span>

                                    @elseif($attendance->status === 'Late')

                                        <span class="badge bg-warning text-dark">
                                            Late
                                        </span>

                                    @elseif($attendance->status === 'Absent')

                                        <span class="badge bg-danger">
                                            Absent
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $attendance->status ?? 'N/A' }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center py-4">

                                    <i class="bi bi-inbox fs-1 text-muted"></i>

                                    <p class="mb-0 text-muted">
                                        No attendance records found.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- Print CSS --}}
<style>

@media print {

    .sidebar,
    .navbar,
    .btn,
    form,
    .card-header {
        display: none !important;
    }

    body {
        background: #fff !important;
    }

    .container-fluid {
        width: 100% !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

}

</style>

@endsection