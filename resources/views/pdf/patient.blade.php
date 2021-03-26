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
        .sz{
            font-size: 15px;
        }
        .sz-terms *{
            font-size: 10px;
        }
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
        div.page_break{
            page-break-before: always;
        }
    </style>
</head>
<body>

<table style="font-family:Calibri; font-size: 12px;">
    <tr>
        <td>
            <div  style="display: inline-block;text-align: center; width: 100%">
                <img src="{{ url('assets/images/labtest-logo.jpg') }}" alt="LabTest-Logo" width="150" />
            </div>
        </td>
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
                                <span>How did you hear about us: </span>
                            </strong>
                            {{ $patient->hear_about == "other" ? $patient->refer_name : $patient->hear_about }}
                            @if($patient->paid_or_free == 1)
                            <span style="float:right;">
                                <strong>
                                    <span>PAID </span>
                                </strong>

                            </span>
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0in 5.4pt;vertical-align: top;">
                        <p style="">
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
                        <p class="table-p-bottom"><span>First Name: <span class="sz label-value-200">{{ $patient->first_name }}</span>&nbsp;&nbsp;Last Name: <span class="sz label-value-200">{{ $patient->last_name }}</span></span></p>
                        <p class="table-p-bottom"><span>Phone: <span class="sz label-value-130">{{ $patient->cell_phone }}</span></span><span>&nbsp;</span><span>Address: <span class="sz label-value-200">{{ $patient->address }}</span> City <span class="sz label-value-130">{{ $patient->city }}</span></span></p>
                        <p class="table-p-bottom">
                            <span>&nbsp;State: <span class="sz label-value-130">{{ $patient->state->name }}</span>&nbsp;&nbsp;Zip: <span class="sz label-value-130">{{ $patient->zipcode }}</span> Age: <span class="sz label-value-130 width-60">{{ $data['age'] }}</span>&nbsp; &nbsp;Date of Birth: <span class="sz dob-underline">{{ $data['dob_month'] }}</span>/<span class="sz dob-underline">{{ $data['dob_day'] }}</span>/<span class="sz dob-underline">{{ $data['dob_year'] }}</span></span>
                        </p>
                        <p>
                            <span>Biological Sex:</span> &nbsp;
                            <span>
                                <input type="checkbox" name="male" style="vertical-align: sub;" {{ $patient->gender == 'male' ? 'checked' : '' }}>
                                <span>Male</span>&nbsp;
                            </span>   &nbsp;&nbsp;
                            <span>
                            <input type="checkbox" name="female" style="vertical-align: sub;" {{ $patient->gender == 'female' ? 'checked' : '' }}>
                            <span >Female&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span>
                            <span>(mm&nbsp; &nbsp;/&nbsp; &nbsp;dd&nbsp; &nbsp;/&nbsp; &nbsp;yyyy)</span>
                        </p>
                        <p style="margin-top:0; margin-bottom: 3px;"><strong><span >I would like to receive my results via:</span></strong></p>
                        <p class="table-p-bottom table-p-top"><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->is_fax == 1 ? 'checked' : '' }}></span><span>&nbsp;Fax: <span class="sz label-value-200">{{ $patient->fax }}</span>&nbsp; &nbsp;</span></p>
                        <p class="table-p-bottom table-p-top"><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->is_email == 1 ? 'checked' : '' }}></span><span >&nbsp;Email with Passcode Patient email address: <span class="sz label-value-400">{{ $patient->email_address }}</span></span></p>
                        <p class="table-p-bottom table-p-top"><span >&nbsp; &nbsp; &nbsp;Passcode: <span class="sz label-value-130">{{ $patient->passcode }}</span></span></p>
                        @if($patient->paid_or_free == 0)
                        <p >
                            <strong><span>Bill To:</span></strong><span>&nbsp; &nbsp; &nbsp;</span><span><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->bill_to == 'Insurance' ? 'checked' : '' }}></span><span >&nbsp;Insurance&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span ><input type="checkbox" name="billTo" style="vertical-align: sub;" {{ $patient->bill_to == 'Uninsured Program' ? 'checked' : '' }}></span><span>&nbsp;Uninsured Program</span></p>
                        @endif
                        @if($patient->paid_or_free == 1)
                            <p><span>Result Delivered Type: <span class="sz label-value-250">{{ $patient->result_type }}</span>&nbsp;&nbsp;Flight Date & Time: <span class="sz label-value-200">{{ $patient->flight_datetime }}</span></span></p>
                        @endif
                        @if($patient->paid_or_free == 0)
                        <p ><span >Insurance Name &amp; policy: <span class="sz label-value-250">{{ $patient->ins_name }}</span> Group No: <span class="sz label-value-80">{{ $patient->group_no }}</span></span></p>
                        @endif
                        <p ><span >Driver&rsquo;s License Number/State ID: <span class="sz label-value-200">{{ $patient->drivlic_id }}</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Issued State: <span class="sz label-value-80">{{ $patient->issued_state }}</span></span></p>
                        <p><span>By <strong>signing below, I certify</strong> the <strong>information</strong> I provided on and in connection with this form is true and correct to the best of my knowledge. I also understand that any false statements or deliberate omissions on this form may subject me to legal actions for fraudulent misrepresentation.</span></p>


                        @if($patient->paid_or_free == 0)
                        <p><span>Covid Symptoms:<span class="sz label-value-250">{{ $covidSymptoms }}</span></span></p>
                        @endif
                        <p><span>Patient Signature:<span class="sz label-value-250">{{ $patient->first_name }} {{ $patient->last_name }}</span> Appointment&rsquo;s Date: <span class="sz label-value-200">{{ $patient->appointment }} </span></span></p>
                        <p style="margin-top: 0px; margin-bottom: 2px;"><strong><span>Phlebotomist Use Only:</span></strong></p>
                        <table border="1" style="border-collapse:collapse;width: 100%">
                            <tbody>
                            <tr>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Collection Date:</span> <br> &nbsp; {{ $patient->appointment }}</p>
                                </td>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Collection Time:</span> <br> &nbsp; {{ date("h:i a", strtotime($patient->timeslot)) }} </p>
                                </td>
                                <td>
                                    <p style="margin-top:0px;"><span style='font-size:14px;'>Name:</span><br> &nbsp;</p>
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
@if($patient->location)
<p style="text-align: center">{{ $patient->location->name }} {{ $patient->location->address }} {{ $patient->location->city }} {{ $patient->location->state ? $patient->location->state->name : '' }} {{ $patient->location->zipcode }} {{ $patient->location->phone }}</p>
@endif

<div class="page_break"></div>

<section>
    <u><h2 style="text-align: center;">Terms and Condition</h2></u>
    <div class="sz-terms">
        {!! $patient->location->terms_and_condition !!}
    <p><span>Patient Signature:<span class="sz label-value-250">{{ $patient->first_name }}</span></span></p>
    </div>

</section>
</body>
</html>

