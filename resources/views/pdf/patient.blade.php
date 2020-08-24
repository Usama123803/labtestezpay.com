<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $data['title'] }}</title>
    <style>
        .table-p-bottom{
            margin-bottom: 2px;
        }
        .table-p-margin{
            margin: 2px;
        }
        .table-p-top{
            margin-top: 2px;
        }
        .table-ol-padding-left{
            padding-left: 8px;
        }
        .label-value-200{
            border-bottom: 1px solid black;
            width: 200px;
            display: inline-block;
        }
        .label-value-130{
            border-bottom: 1px solid black;
            width: 130px;
            display: inline-block;
        }
        .label-value-400{
            border-bottom: 1px solid black;
            width: 400px;
            display: inline-block;
        }
        .label-value-80{
            border-bottom: 1px solid black;
            width: 80px;
            display: inline-block;
        }
        .label-value-250{
            border-bottom: 1px solid black;
            width: 250px;
            display: inline-block;
        }
        .dob-underline{
            border-bottom: 1px solid black;
            width: 40px;
            display: inline-block;
        }
        .width-60{
            width: 60px !important;
        }
    </style>
</head>
<body>

<table style="font-family:Calibri; font-size: 12px;">
    <tr>
        <td>
            <div style="display: inline-block;float: left;">
                                <img src="{{ public_path('assets/images/labtest-logo.png') }}" alt="LabTest-Logo" width="150" />
{{--                                <img src="http://labtestest.com/assets/images/labtest-logo.PNG" alt="LabTest-Logo" width="150" />--}}
            </div>
            <div style="display: inline-block;float: right">
                <p style="margin: 2px;">
                    <span>PCR:</span>
                    <span><input type="checkbox" style="vertical-align: sub" {{ $patient->pcr == 1 ? 'checked' : '' }}>Negative</span>
                    <span><input type="checkbox" style="vertical-align: sub" {{ $patient->pcr == 2 ? 'checked' : '' }}>Positive</span>
                    <span style="margin-left: 10px;"><strong>Remarks:</strong></span>
                    <span >{{ $patient->pcr_remark }}</span>
                </p>
                <p style="margin: 2px;">
                    <span>Blood:</span>
                    <span><input type="checkbox" style="vertical-align: sub" {{ $patient->blood == 1 ? 'checked' : '' }}>Negative</span>
                    <span><input type="checkbox" style="vertical-align: sub" {{ $patient->blood == 2 ? 'checked' : '' }}>Positive</span>
                    <span style="margin-left: 10px;"><strong>Remarks:</strong></span>
                    <span >{{ $patient->blood_remark }}</span>
                </p>
            </div>
        </td>
{{--        <td>--}}
{{--            --}}
{{--        </td>--}}
    </tr>
    <tr>
        <td>
            <div style="text-align: center;clear: both">
                <h4 style="margin:0px;">COVID-19 Test Request Form</h4>
                <small style="font-size: 12px;">Please complete one form for each patient that Covid-19 testing is requested for. Include form with specimen submission.</small>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <table style="border-collapse:collapse;border:none;">
                <tbody>
                <tr>
                    <td style="border: 1pt solid windowtext;padding: 0in 5.4pt;height: 18.9pt;vertical-align: top;">
                        <p style="margin-top: 5px;margin-bottom: 5px;font-size: 13px;">
                            <strong>
                                <span>FACILITY/ EMPLOYER INFORMATION</span>
                            </strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style="">
                        <span>Facility: <span class="label-value-200">{{ $patient->location->name }}</span> Phone: <span class="label-value-130">{{ $patient->location->phone }}</span>&nbsp;&nbsp;Fax: <span class="label-value-130">{{ $patient->location->fax }}</span></span></p>
                        <p><span>Address: <span class="label-value-200">{{ $patient->location->address }}</span>&nbsp;&nbsp;City:<span class="label-value-130">{{ $patient->location->city }}</span> State:<span class="label-value-80">{{ $patient->location->state ? $patient->location->state->name : '' }}</span> Zip: <span class="label-value-80">{{ $patient->location->zipcode }}</span> </span></p>
                        <p>Phone: <span class="label-value-200">{{ $patient->location->alt_phone }}</span>&nbsp;&nbsp;Fax: <span class="label-value-200">{{ $patient->location->alt_fax }}</span></p>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;height: 18.9pt;vertical-align: top;">
                        <p style="margin-top: 5px;margin-bottom: 5px;font-size: 13px;">
                            <strong>
                                <span style=''>PATIENT INFORMATION</span>
                            </strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;height: 450.6pt;vertical-align: top;">
                        <p class="table-p-bottom"><span>First Name: <span class="label-value-200">{{ $patient->first_name }}</span>&nbsp;&nbsp;Last Name: <span class="label-value-200">{{ $patient->last_name }}</span></span></p>
                        <p class="table-p-bottom"><span>Phone: <span class="label-value-130">{{ $patient->cell_phone }}</span></span><span>&nbsp;</span><span>Address: <span class="label-value-200">{{ $patient->address }}</span> City <span class="label-value-130">{{ $patient->city }}</span></span></p>
                        <p class="table-p-bottom">
                            <span>&nbsp;State: <span class="label-value-130">{{ $patient->state->name }}</span>&nbsp;&nbsp;Zip: <span class="label-value-130">{{ $patient->zipcode }}</span> Age: <span class="label-value-130 width-60">{{ $data['age'] }}</span>&nbsp; &nbsp;Date of Birth: <span class="dob-underline">{{ $data['dob_month'] }}</span>/<span class="dob-underline">{{ $data['dob_day'] }}</span>/<span class="dob-underline">{{ $data['dob_year'] }}</span></span>
                        </p>
                        <p>
                            <span>Biological Sex:</span> &nbsp;
                            <span>
                                <input type="checkbox" name="male" style="vertical-align: sub;" {{ $patient->gender == 'male' ? 'checked' : '' }}>
                                <span>Male</span>&nbsp;
                            </span>  &nbsp;&nbsp;
                            <span>
                            <input type="checkbox" name="female" style="vertical-align: sub;" {{ $patient->gender == 'female' ? 'checked' : '' }}>
                            <span >Female&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span>
                            <span>(mm&nbsp; &nbsp;/&nbsp; &nbsp;dd&nbsp; &nbsp;/&nbsp; &nbsp;yyyy)</span>
                        </p>
                        <p style="margin-top:0; margin-bottom: 3px;"><strong><span >I would like to receive my results via:</span></strong></p>
                        <p class="table-p-bottom table-p-top"><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->is_fax == 1 ? 'checked' : '' }}></span><span>&nbsp;Fax: <span class="label-value-200">{{ $patient->fax }}</span>&nbsp; &nbsp;</span></p>
                        <p class="table-p-bottom table-p-top"><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->is_email == 1 ? 'checked' : '' }}></span><span >&nbsp;Email with Passcode Patient email address: <span class="label-value-400">{{ $patient->email_cb }}</span></span></p>
                        <p class="table-p-bottom table-p-top"><span >&nbsp; &nbsp; &nbsp;Verify Email address:_____________________________________________________________________________________</span></p>
                        <p class="table-p-bottom table-p-top"><span >&nbsp; &nbsp; &nbsp;Passcode: <span class="label-value-130">{{ $patient->passcode }}</span></span></p>
                        <p >
                            <strong><span>Bill To:</span></strong><span>&nbsp; &nbsp; &nbsp;</span><span><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->bill_to == 'Insurance' ? 'checked' : '' }}></span><span >&nbsp;Insurance&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->bill_to == 'Uninsured Program' ? 'checked' : '' }}></span><span>&nbsp;Uninsured Program</span></p>
                        <p ><span >Insurance Name &amp; policy: <span class="label-value-250">{{ $patient->ins_name }}</span> Group No: <span class="label-value-80">{{ $patient->group_no }}</span></span></p>
                        <p ><span >Driver&rsquo;s License Number/State ID: <span class="label-value-200">{{ $patient->drivlic_id }}</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Issued State: <span class="label-value-80">{{ $patient->issued_state }}</span></span></p>
                        <p><span>By <strong>signing below, I certify</strong> the <strong>information</strong> I provided on and in connection with this form is true and correct to the best of my knowledge. I also understand that any false statements or deliberate omissions on this form may subject me to legal actions for fraudulent misrepresentation.</span></p>

                        <p><span>I consent Labtest Diagnostics to share my  results with Inb Sina Community Clinics.</span></p>
                        <p><span>Patient Signature:_________________________________________ Today&rsquo;s Date: <span class="label-value-200">{{ date('Y-m-d') }}</span></span></p>
                        <p class="table-p-bottom" style="border-bottom:1px solid black;"><strong>PATIENT DECLARATION</strong></p>
                        <p class="table-p-margin"><strong><span>The answers below shall be truthful and inclusive for all members of household (including children and live-in adults). Within the past 14 days:</span></strong></p>
                        <ol class="table-p-top" style="padding:0px;list-style: none;">
{{--                            <li>--}}
{{--                                1. Have you travelled outside of <strong>TEXAS OR IN CLOSE CONTACT WHO HAS TRAVELLED OUTSIDE TEXAS</strong>--}}
{{--                                <span style="margin-left:8px">--}}
{{--                                    <strong>YES</strong>--}}
{{--                                </span>--}}
{{--                                <input type="checkbox" name="billTo" style="vertical-align: sub;">--}}
{{--                                <strong><span>NO</span></strong>--}}
{{--                                <input type="checkbox" name="billTo" style="vertical-align: sub;">--}}
{{--                            </li>--}}
                            <li>1. Have you had close contact with someone diagnosed with <strong>COVID-19?&nbsp;&nbsp;YES&nbsp;</strong></span><strong><span><input type="checkbox" name="billTo" style="vertical-align: sub;"></span></strong><strong><span>&nbsp;NO&nbsp;</span></strong><strong><span ><input type="checkbox" name="billTo" style="vertical-align: sub;"></span>&nbsp;</strong></li>
                            <li>2. Have you experienced any cold or flu-like symptoms (such as fever, cough, sore throat, respiratory illness, difficulty breathing, loss of smell, Nausea or vomiting, Congestion or runny nose, diarrhea).&nbsp; &nbsp; &nbsp;<strong>YES <span ><input type="checkbox" name="billTo" style="vertical-align: sub;"></span></strong></span><strong>&nbsp;NO <span ><input type="checkbox" name="billTo" style="vertical-align: sub;"></span></strong></li>
                        </ol>
                        <p style="margin-top: 0px; margin-bottom: 2px;"><strong><span>Phlebotomist Use Only:</span></strong></p>
                        <table border="1" style="border-collapse:collapse;width: 100%">
                            <tbody>
                            <tr>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Collection Date:</span></p>
                                </td>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Collection Time:</span></p>
                                </td>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Name:</span></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><span style='font-size:14px;'>Signature:</span></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
