<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Student Information - {{ $student->name }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            background: #f1f5f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #0f172a;
        }

        .print-actions {
            width: 210mm;
            margin: 0 auto 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            border: 0;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-print {
            background: #2563eb;
            color: #fff;
        }

        .btn-back {
            background: #fff;
            color: #334155;
            border: 1px solid #cbd5e1;
            text-decoration: none;
        }

        .paper {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            padding: 15mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
        }

        .school-header {
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .school-header h1 {
            margin: 0;
            font-size: 25px;
            color: #1e3a8a;
        }

        .school-header h2 {
            margin: 5px 0 0;
            font-size: 17px;
            color: #334155;
        }

        .school-header p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #64748b;
        }

        .title {
            text-align: center;
            margin: 15px 0 20px;
        }

        .title h2 {
            display: inline-block;
            margin: 0;
            padding: 7px 20px;
            border: 1px solid #1e3a8a;
            border-radius: 5px;
            color: #1e3a8a;
            font-size: 18px;
        }

        .student-top {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .student-photo {
            width: 120px;
            height: 145px;
            border: 1px solid #cbd5e1;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .student-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-photo .initial {
            font-size: 45px;
            font-weight: bold;
            color: #2563eb;
        }

        .student-main {
            flex: 1;
        }

        .student-name {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .quick-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .quick-box {
            border: 1px solid #e2e8f0;
            padding: 9px;
            border-radius: 5px;
        }

        .label {
            display: block;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .value {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
        }

        .section {
            margin-top: 18px;
            page-break-inside: avoid;
        }

        .section-title {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 8px 10px;
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            border-top: 1px solid #cbd5e1;
            border-left: 1px solid #cbd5e1;
        }

        .info-item {
            display: grid;
            grid-template-columns: 40% 60%;
            border-right: 1px solid #cbd5e1;
            border-bottom: 1px solid #cbd5e1;
            min-height: 36px;
        }

        .info-label {
            padding: 8px;
            background: #f8fafc;
            font-size: 11px;
            color: #475569;
            font-weight: 600;
        }

        .info-value {
            padding: 8px;
            font-size: 12px;
            color: #0f172a;
        }

        .address {
            border: 1px solid #cbd5e1;
            padding: 12px;
            min-height: 55px;
            font-size: 12px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 45px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .signature {
            width: 160px;
            text-align: center;
            font-size: 11px;
            color: #334155;
        }

        .signature-line {
            border-top: 1px solid #334155;
            margin-bottom: 5px;
        }

        .generated {
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
        }

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        @media print {

            body {
                background: #fff;
                padding: 0;
            }

            .print-actions {
                display: none !important;
            }

            .paper {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 5mm;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    {{-- Print Buttons --}}
    <div class="print-actions">

        <a
            href="{{ route('admin.students.show', $student) }}"
            class="btn btn-back"
        >
            ← Back
        </a>

        <button
            type="button"
            class="btn btn-print"
            onclick="window.print()"
        >
            🖨 Print Student
        </button>

    </div>


    {{-- A4 PAPER --}}
    <div class="paper">

        {{-- SCHOOL HEADER --}}
        <div class="school-header">

            <h1>
                {{ $student->branch->name ?? 'School Management System' }}
            </h1>

            <h2>
                Student Information
            </h2>

            <p>
                Academic Student Record
            </p>

        </div>


        {{-- TITLE --}}
        <div class="title">
            <h2>STUDENT PROFILE</h2>
        </div>


        {{-- STUDENT TOP --}}
        <div class="student-top">

            {{-- Photo --}}
            <div class="student-photo">

                @if(!empty($student->photo))

                    <img
                        src="{{ asset('storage/' . $student->photo) }}"
                        alt="{{ $student->name }}"
                    >

                @else

                    <div class="initial">
                        {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}
                    </div>

                @endif

            </div>


            {{-- Main Information --}}
            <div class="student-main">

                <div class="student-name">
                    {{ $student->name }}
                </div>

                @if($student->status)

                    <span class="status active">
                        ACTIVE
                    </span>

                @else

                    <span class="status inactive">
                        INACTIVE
                    </span>

                @endif


                <div class="quick-info">

                    <div class="quick-box">
                        <span class="label">Student ID</span>
                        <span class="value">
                            {{ $student->student_id ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="quick-box">
                        <span class="label">Admission No</span>
                        <span class="value">
                            {{ $student->admission_no ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="quick-box">
                        <span class="label">Roll No</span>
                        <span class="value">
                            {{ $student->roll_no ?? 'N/A' }}
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- ACADEMIC INFORMATION --}}
        <div class="section">

            <div class="section-title">
                Academic Information
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <div class="info-label">Branch</div>
                    <div class="info-value">
                        {{ $student->branch->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Academic Session</div>
                    <div class="info-value">
                        {{ $student->academicSession->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Class</div>
                    <div class="info-value">
                        {{ $student->schoolClass->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Section</div>
                    <div class="info-value">
                        {{ $student->section->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Admission No</div>
                    <div class="info-value">
                        {{ $student->admission_no ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Admission Date</div>
                    <div class="info-value">

                        @if($student->admission_date)
                            {{ \Illuminate\Support\Carbon::parse($student->admission_date)->format('d M Y') }}
                        @else
                            N/A
                        @endif

                    </div>
                </div>

            </div>

        </div>


        {{-- PERSONAL INFORMATION --}}
        <div class="section">

            <div class="section-title">
                Personal Information
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">
                        {{ $student->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Bangla Name</div>
                    <div class="info-value">
                        {{ $student->name_bn ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Gender</div>
                    <div class="info-value">
                        {{ $student->gender ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value">

                        @if($student->date_of_birth)
                            {{ \Illuminate\Support\Carbon::parse($student->date_of_birth)->format('d M Y') }}
                        @else
                            N/A
                        @endif

                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Blood Group</div>
                    <div class="info-value">
                        {{ $student->blood_group ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Religion</div>
                    <div class="info-value">
                        {{ $student->religion ?? 'N/A' }}
                    </div>
                </div>

            </div>

        </div>


        {{-- GUARDIAN --}}
        <div class="section">

            <div class="section-title">
                Guardian Information
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <div class="info-label">Guardian Name</div>
                    <div class="info-value">
                        {{ $student->guardian_name ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Guardian Phone</div>
                    <div class="info-value">
                        {{ $student->guardian_phone ?? 'N/A' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Guardian Email</div>
                    <div class="info-value">
                        {{ $student->guardian_email ?? 'N/A' }}
                    </div>
                </div>

            </div>

        </div>


        {{-- ADDRESS --}}
        <div class="section">

            <div class="section-title">
                Address
            </div>

            <div class="address">

                @if(!empty($student->address))

                    {!! nl2br(e($student->address)) !!}

                @else

                    N/A

                @endif

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="footer">

            <div class="signature">

                <div class="signature-line"></div>

                Authorized Signature

            </div>


            <div class="generated">

                Printed:
                {{ now()->format('d M Y h:i A') }}

            </div>

        </div>

    </div>

</body>

</html>