<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        /* Center the main table */
        .main-table {
            margin: 0 auto; /* Center the table horizontally */
        }
        table {
            width: 100%;
        }
        @page {
            size: landscape;
            margin: 10mm;
        }

    </style>
</head>
<body>

    <!-- Main Table Centered -->
    <table class="main-table">
        <tr>
            @for ($i = 0; $i < 3; $i++)
            <td style="@if ($i > 0) border-left: 1px solid black; @endif padding: 10px;">

                <table style="margin: 10px; line-height: 25px">
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{  url(config('app.logo'))}}" height="50px" width="70px" alt=" ">
                                <br>
                                <img src="{{url('storage/' . $record->admission->bank->logo)}}" height="50px" width="70px" alt=" ">
                            </td>

                            <td style="text-align: center; white-space: nowrap; line-break: strict;">
                                <p style="font-size: 20px; margin: 5px;">{{ config('app.fullname') }}</p>
                                <p style="font-size: 15px; margin: 5px">{{ $record->admission->bank->name }}</p>
                                <p style="font-size: 15px; margin: 5px">A/C.No {{ $record->admission->bank->account }}</p>
                                <p style="font-size: 10px; margin: 8px">Copy of {{ $i === 0 ? 'Bank' : ($i === 1 ? 'Institution' : 'Student') }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin: 10px">
                    <tbody style="font-size: 12px; line-height: 30px">
                        <tr>
                            <td colspan="2"><b>Due Date:</b></td>
                            <td style="font-size: 15px"><b>{{ $record->admission->challan_last_date->format('d-m-Y') }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Challan No:</b></td>
                            <td>{{ $record->challan->challan_no }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Name:</b></td>
                            <td>{{ $record->user->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Father Name:</b></td>
                            <td>{{ $record->user->fatherinfo->fname }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>CNIC No:</b></td>
                            <td>{{ $record->user->personalinfo->cnic }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Subject:</b></td>
                            <td>{{ $record->program->name.' ('.$record->admission->semester.','.$record->admission->batch.')' }}</td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin: 5px;  line-height: 30px; font-size: 16px; border: 1px solid black; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <td style="text-align: center; border: 1px solid black; border-collapse: collapse;">Admission Application Fee <br>+<br> Process Fee</td>
                            <td style="text-align: center;">{{ number_format($record->challan->fee, 0) }}</td>
                        </tr>
                        <tr style=" border: 1px solid black; border-collapse: collapse;">
                            <th>Total</th>
                            <th>= {{ number_format($record->challan->fee, 0) }}</th>
                        </tr>
                    </tbody>
                </table>

                <table style="margin: 20px">
                    <tbody>

                        <tr>
                            <th colspan="2"> </th>
                            <th> Cashier:____________________</th>
                        </tr>
                    </tbody>
                </table>

                <!-- Footer -->
                <div style="color: #6c757d; font-size: 10px; text-align: center;">
                    <small><i>Generated on ({{ $record->challan->created_at->format('d-m-Y') }})</i></small>
                </div>

            </td>
            @endfor
        </tr>

    </table>
</body>
</html>
