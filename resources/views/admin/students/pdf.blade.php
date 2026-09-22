<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Student Information - {{ $student->name }}</title>

    <style>

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            color: #0f172a;
            font-size: 12px;
        }

        .page {
            width: 100%;
            padding: 4mm;
        }

        /* =========================
           HEADER
        ========================== */

        .school-header {
            width: 100%;
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .school-header h1 {
            margin: 0;
            font-size: 22px;
            color: #1e3a8a;
        }

        .school-header h2 {
            margin: 4px 0 0;
            font-size: 15px;
            color: #334155;
        }

        .school-header p {
            margin: 3px 0 0;
            font-size: 10px;
            color: #64748b;
        }

        /* =========================
           TITLE
        ========================== */

        .title {
            text-align: center;
            margin-bottom: 14px;
        }

        .title span {
            display: inline-block;
            border: 1px solid #1e3a8a;
            padding: 6px 18px;
            font-size: 15px;
            font-weight: bold;
            color: #1e3a8a;
        }

        /* =========================
           STUDENT TOP
        ========================== */

        .student-top {
            width: 100%;
            border: 1px solid #cbd5e1;
            margin-bottom: 14px;
        }

        .student-top td {
            vertical-align: top;
        }

        .photo-cell {
            width: 105px;
            padding: 8px;
        }

        .student-photo {
            width: 90px;
            height: 110px;
            border: 1px solid #cbd5e1;
            text-align: center;
            vertical-align: middle;
        }

        .student-photo img {
            width: 90px;
            height: 110px;
            object-fit: cover;
        }

        .initial {
            font-size: 35px;
            font-weight: bold;
            color: #2563eb;
            padding-top: 30px;
        }

        .student-main {
            padding: 10px;
        }

        .student-name {
            font-size: 19px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .status {
            display: inline-block;
            padding: 4px 9px;
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* =========================
           QUICK INFO
        ========================== */

        .quick-info {
            width: 100%;
            border-collapse: collapse;
        }

        .quick-info td {
            width: 33.33%;
            border: 1px solid #e2e8f0;
            padding: 7px;
        }

        .quick-label {
            display: block;
            font-size: 9px;
            color: #64748b;
            margin-bottom: 3px;
        }

        .quick-value {
            display: block;
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
        }

        /* =========================
           SECTION
        ========================== */

        .section {
            margin-top: 13px;
            page-break-inside: avoid;
        }

        .section-title {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 7px 9px;
            font-size: 13px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 7px;
        }

        /* =========================
           INFORMATION TABLE
        ========================== */

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-table td {
            border: 1px solid #cbd5e1;
            padding: 7px;
            vertical-align: top;
        }

        .info-label {
            width: 22%;
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: bold;
        }

        .info-value {
            width: 28%;
            color: #0f172a;
            font-size: 11px;
        }

        /* =========================
           ADDRESS
        ========================== */

        .address-box {
            border: 1px solid #cbd5e1;
            padding: 9px;
            min-height: 45px;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================
           FOOTER
        ========================== */

        .footer {
            width: 100%;
            margin-top: 45px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature {
            width: 33.33%;
            text-align: center;
            vertical-align: bottom;
            font-size: 10px;
            color: #334155;
        }

        .signature-line {
            width: 130px;
            border-top: 1px solid #334155;
            margin: 0 auto 5px auto;
        }

        .generated {
            text-align: right;
            font-size: 8px;
            color: #94a3b8;
            padding-top: 15px;
        }

    </style>
</head>


<body>

<div class="page">

    {{-- ==========================================
         SCHOOL HEADER
    =========================================== --}}

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


    {{-- ==========================================
         TITLE
    =========================================== --}}

    <div class="title">
        <span>
            STUDENT PROFILE
        </span>
    </div>


    {{-- ==========================================
         STUDENT BASIC INFORMATION
    =========================================== --}}

    <table class="student-top">

        <tr>

            {{-- PHOTO --}}
            <td class="photo-cell">

                <div class="student-photo">

                    @if(!empty($student->photo))

                        <img
                            src="{{ public_path('storage/' . $student->photo) }}"
                            alt="{{ $student->name }}"
                        >

                    @else

                        <div class="initial">
                            {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}
                        </div>

                    @endif

                </div>

            </td>


            {{-- STUDENT MAIN DATA --}}
            <td class="student-main">

                <div class="student-name">
                    {{ $student->name ?? 'N/A' }}
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


                <table class="quick-info">

                    <tr>

                        <td>

                            <span class="quick-label">
                                Student ID
                            </span>

                            <span class="quick-value">
                                {{ $student->student_id ?? 'N/A' }}
                            </span>

                        </td>


                        <td>

                            <span class="quick-label">
                                Admission No
                            </span>

                            <span class="quick-value">
                                {{ $student->admission_no ?? 'N/A' }}
                            </span>

                        </td>


                        <td>

                            <span class="quick-label">
                                Roll No
                            </span>

                            <span class="quick-value">
                                {{ $student->roll_no ?? 'N/A' }}
                            </span>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>


    {{-- ==========================================
         ACADEMIC INFORMATION
    =========================================== --}}

    <div class="section">

        <div class="section-title">
            Academic Information
        </div>


        <table class="info-table">

            <tr>

                <td class="info-label">
                    Branch
                </td>

                <td class="info-value">
                    {{ $student->branch->name ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Academic Session
                </td>

                <td class="info-value">
                    {{ $student->academicSession->name ?? 'N/A' }}
                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Class
                </td>

                <td class="info-value">
                    {{ $student->schoolClass->name ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Section
                </td>

                <td class="info-value">
                    {{ $student->section->name ?? 'N/A' }}
                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Admission No
                </td>

                <td class="info-value">
                    {{ $student->admission_no ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Student ID
                </td>

                <td class="info-value">
                    {{ $student->student_id ?? 'N/A' }}
                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Roll No
                </td>

                <td class="info-value">
                    {{ $student->roll_no ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Admission Date
                </td>

                <td class="info-value">

                    @if($student->admission_date)

                        {{ \Illuminate\Support\Carbon::parse($student->admission_date)->format('d M Y') }}

                    @else

                        N/A

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- ==========================================
         PERSONAL INFORMATION
    =========================================== --}}

    <div class="section">

        <div class="section-title">
            Personal Information
        </div>


        <table class="info-table">

            <tr>

                <td class="info-label">
                    Full Name
                </td>

                <td class="info-value">
                    {{ $student->name ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Bangla Name
                </td>

                <td class="info-value">
                    {{ $student->name_bn ?? 'N/A' }}
                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Gender
                </td>

                <td class="info-value">
                    {{ $student->gender ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Date of Birth
                </td>

                <td class="info-value">

                    @if($student->date_of_birth)

                        {{ \Illuminate\Support\Carbon::parse($student->date_of_birth)->format('d M Y') }}

                    @else

                        N/A

                    @endif

                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Blood Group
                </td>

                <td class="info-value">
                    {{ $student->blood_group ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Religion
                </td>

                <td class="info-value">
                    {{ $student->religion ?? 'N/A' }}
                </td>

            </tr>

        </table>

    </div>


    {{-- ==========================================
         GUARDIAN INFORMATION
    =========================================== --}}

    <div class="section">

        <div class="section-title">
            Guardian Information
        </div>


        <table class="info-table">

            <tr>

                <td class="info-label">
                    Guardian Name
                </td>

                <td class="info-value">
                    {{ $student->guardian_name ?? 'N/A' }}
                </td>


                <td class="info-label">
                    Guardian Phone
                </td>

                <td class="info-value">
                    {{ $student->guardian_phone ?? 'N/A' }}
                </td>

            </tr>


            <tr>

                <td class="info-label">
                    Guardian Email
                </td>

                <td class="info-value" colspan="3">
                    {{ $student->guardian_email ?? 'N/A' }}
                </td>

            </tr>

        </table>

    </div>


    {{-- ========  ADDRESS ============ --}}

    <div class="section">

        <div class="section-title">
            Address
        </div>


        <div class="address-box">

            @if(!empty($student->address))

                {!! nl2br(e($student->address)) !!}

            @else

                N/A

            @endif

        </div>

    </div>


    {{-- ========  FOOTER / SIGNATURE ===== --}}

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="signature">
                    <div class="signature-line"></div>
                    Student Signature
                </td>
                <td class="signature">
                    <div class="signature-line"></div>
                    Guardian Signature
                </td>
                <td class="signature">
                    <div class="signature-line"></div>
                    Authorized Signature
                </td>
            </tr>
        </table>
        <div class="generated">
            Printed:
            {{ now()->format('d M Y h:i A') }}
        </div>
    </div>
</div>

</body>

</html>