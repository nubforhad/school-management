@extends('admin.layouts.app')

@section('content')

<style>

/* ========================================
   Attendance Report
======================================== */

.attendance-report {
    padding-bottom: 30px;
}


/* Header */

.report-header h4 {
    font-size: 1.25rem;
    color: #212529;
}

.report-header small {
    font-size: 13px;
}


/* Cards */

.attendance-report .card {
    border-radius: 10px;
}

.attendance-report .card-header {
    border-bottom: 1px solid #edf0f2;
}

.summary-card {
    border: 1px solid #edf0f2 !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
    transition: all .2s ease;
}

.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, .07);
}

.summary-card .card-body {
    padding: 20px;
}

.summary-label {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 5px;
}

.summary-number {
    font-size: 27px;
    font-weight: 600;
}

.summary-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
    background: #f5f7fa;
}


/* Form */

.attendance-report .form-label {
    font-size: 13px;
    color: #495057;
    margin-bottom: 6px;
}

.attendance-report .form-control,
.attendance-report .form-select {
    min-height: 40px;
    border-radius: 7px;
    border-color: #dfe3e7;
    font-size: 14px;
}

.attendance-report .form-control:focus,
.attendance-report .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .10);
}


/* Buttons */

.attendance-report .btn {
    border-radius: 7px;
    font-size: 14px;
    min-height: 40px;
}


/* Table */

.attendance-table-card {
    overflow: hidden;
}

.attendance-table {
    font-size: 13px;
}

.attendance-table thead th {
    background: #f8f9fa;
    color: #495057;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .2px;
    white-space: nowrap;
    border-bottom: 1px solid #dee2e6;
    padding: 13px 12px;
}

.attendance-table tbody td {
    padding: 13px 12px;
    white-space: nowrap;
    border-color: #eef0f2;
}

.attendance-table tbody tr:hover {
    background: #fafbfc;
}

.student-name {
    font-weight: 600;
    color: #212529;
}

.time-text {
    font-size: 13px;
    font-weight: 500;
}


/* Status */

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.status-present {
    background: #e8f7ee;
    color: #198754;
}

.status-late {
    background: #fff4d6;
    color: #9a6700;
}

.status-absent {
    background: #fdeaea;
    color: #dc3545;
}

.status-other {
    background: #eef0f2;
    color: #6c757d;
}


/* Empty */

.empty-state i {
    font-size: 42px;
    color: #adb5bd;
}

.empty-state h6 {
    color: #495057;
}


/* ========================================
   Responsive
======================================== */

@media (max-width: 767.98px) {

    .report-header {
        align-items: flex-start !important;
        flex-direction: column;
        gap: 15px;
    }

    .report-header > div:last-child {
        width: 100%;
    }

    .report-header .btn {
        flex: 1;
    }

    .summary-card .card-body {
        padding: 16px;
    }

    .summary-number {
        font-size: 23px;
    }

    .attendance-table {
        min-width: 1050px;
    }

}


/* ========================================
   Print
======================================== */

@media print {

    @page {
        size: landscape;
        margin: 10mm;
    }

    body {
        background: #fff !important;
    }

    .sidebar,
    .navbar,
    .btn,
    form {
        display: none !important;
    }

    .report-header {
        display: flex !important;
    }

    .report-header > div:last-child {
        display: none !important;
    }

    .container-fluid {
        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
    }

    .attendance-report .card {
        border: 0 !important;
        box-shadow: none !important;
    }

    .summary-card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }

    .attendance-table {
        font-size: 10px;
    }

    .attendance-table thead th,
    .attendance-table tbody td {
        padding: 6px;
    }

}

</style>
<div class="container-fluid attendance-report">
 
{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4 report-header">

    <div>
        <h4 class="mb-1 fw-semibold">
            <i class="bi bi-bar-chart-line me-1"></i>
            Attendance Report
        </h4>

        <small class="text-muted">
            Attendance summary and detailed report
        </small>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.attendance.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

        <button type="button"
                onclick="window.print()"
                class="btn btn-dark">
            <i class="bi bi-printer me-1"></i>
            Print
        </button>
    </div>

</div>


{{-- Filter --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white py-3">
        <strong>
            <i class="bi bi-funnel me-1"></i>
            Filter Attendance
        </strong>
    </div>

    <div class="card-body">

        <form method="GET"
              action="{{ route('admin.attendances.report') }}">

            <div class="row g-3">

                {{-- Date --}}
                <div class="col-xl-3 col-md-6">

                    <label class="form-label fw-medium">
                        Date
                    </label>

                    <input type="date"
                           name="date"
                           value="{{ request('date') }}"
                           class="form-control">

                </div>


                {{-- From Date --}}
                <div class="col-xl-3 col-md-6">

                    <label class="form-label fw-medium">
                        From Date
                    </label>

                    <input type="date"
                           name="from_date"
                           value="{{ request('from_date') }}"
                           class="form-control">

                </div>


                {{-- To Date --}}
                <div class="col-xl-3 col-md-6">

                    <label class="form-label fw-medium">
                        To Date
                    </label>

                    <input type="date"
                           name="to_date"
                           value="{{ request('to_date') }}"
                           class="form-control">

                </div>


                {{-- Branch --}}
                <div class="col-xl-3 col-md-6">

                    <label class="form-label fw-medium">
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


                {{-- Student --}}
                <div class="col-xl-4 col-md-6">

                    <label class="form-label fw-medium">
                        Student
                    </label>

                    <select name="student_id"
                            class="form-select">

                        <option value="">
                            All Students
                        </option>

                        @foreach($students as $student)

                            <option value="{{ $student->id }}"
                                {{ request('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="col-xl-8 col-md-6 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-primary me-2">

                        <i class="bi bi-search me-1"></i>
                        Search

                    </button>

                    <a href="{{ route('admin.attendances.report') }}"
                       class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise me-1"></i>
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
    <div class="col-xl-3 col-md-6">

        <div class="card summary-card total-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="summary-label">
                            Total Attendance
                        </div>

                        <h3 class="summary-number mb-0">
                            {{ $total }}
                        </h3>

                    </div>

                    <div class="summary-icon text-primary">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Present --}}
    <div class="col-xl-3 col-md-6">

        <div class="card summary-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="summary-label">
                            Present
                        </div>

                        <h3 class="summary-number text-success mb-0">
                            {{ $present }}
                        </h3>

                    </div>

                    <div class="summary-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Late --}}
    <div class="col-xl-3 col-md-6">

        <div class="card summary-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="summary-label">
                            Late
                        </div>

                        <h3 class="summary-number text-warning mb-0">
                            {{ $late }}
                        </h3>

                    </div>

                    <div class="summary-icon text-warning">
                        <i class="bi bi-clock"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Absent --}}
    <div class="col-xl-3 col-md-6">

        <div class="card summary-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="summary-label">
                            Absent
                        </div>

                        <h3 class="summary-number text-danger mb-0">
                            {{ $absent }}
                        </h3>

                    </div>

                    <div class="summary-icon text-danger">
                        <i class="bi bi-x-circle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- Attendance Table --}}
<div class="card shadow-sm border-0 attendance-table-card">

    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

        <strong>
            <i class="bi bi-table me-1"></i>
            Attendance Details
        </strong>

        <span class="badge bg-light text-dark border">
            {{ $attendances->count() }} Records
        </span>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0 attendance-table">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Branch</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Status</th>
                        <th>Remarks</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            {{-- Serial --}}
                            <td class="text-muted">
                                {{ $loop->iteration }}
                            </td>


                            {{-- Date --}}
                            <td>
                                <span class="fw-medium">
                                    {{ $attendance->date
                                        ? $attendance->date->format('d M Y')
                                        : '-' }}
                                </span>
                            </td>


                            {{-- Student --}}
                            <td>

                                @if($attendance->student)

                                    <div class="student-name">
                                        {{ $attendance->student->name }}
                                    </div>

                                    @if(isset($attendance->student->student_id))

                                        <small class="text-muted">
                                            ID:
                                            {{ $attendance->student->student_id }}
                                        </small>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            {{-- Branch --}}
                            <td>
                                {{ $attendance->student->branch->name
                                    ?? $attendance->branch->name
                                    ?? 'N/A' }}
                            </td>


                            {{-- Class --}}
                            <td>
                                {{ $attendance->schoolClass->name ?? 'N/A' }}
                            </td>


                            {{-- Section --}}
                            <td>
                                {{ $attendance->section->name ?? 'N/A' }}
                            </td>


                            {{-- In Time --}}
                            <td>
                                <span class="time-text">
                                    {{ $attendance->in_time ?? '-' }}
                                </span>
                            </td>


                            {{-- Out Time --}}
                            <td>
                                <span class="time-text">
                                    {{ $attendance->out_time ?? '-' }}
                                </span>
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($attendance->status === 'Present')

                                    <span class="status-badge status-present">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Present
                                    </span>

                                @elseif($attendance->status === 'Late')

                                    <span class="status-badge status-late">
                                        <i class="bi bi-clock me-1"></i>
                                        Late
                                    </span>

                                @elseif($attendance->status === 'Absent')

                                    <span class="status-badge status-absent">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Absent
                                    </span>

                                @else

                                    <span class="status-badge status-other">
                                        {{ $attendance->status ?? 'N/A' }}
                                    </span>

                                @endif

                            </td>


                            {{-- Remarks --}}
                            <td>

                                @if($attendance->remarks)

                                    <span title="{{ $attendance->remarks }}">
                                        {{ \Illuminate\Support\Str::limit($attendance->remarks, 30) }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10"
                                class="text-center py-5">

                                <div class="empty-state">

                                    <i class="bi bi-inbox"></i>

                                    <h6 class="mt-3 mb-1">
                                        No attendance records found
                                    </h6>

                                    <p class="text-muted mb-0">
                                        Try changing your filters and search again.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
```

</div>


@endsection
