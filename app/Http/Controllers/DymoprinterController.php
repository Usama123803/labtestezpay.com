<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientAppointment;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class DymoprinterController extends Controller
{
    public function index($id)
    {
        if(empty($id)){
            abort(404);
        }
        $patientAppointment = PatientAppointment::find($id);
        $address = '';
        if ($patientAppointment) {
            $fullName = $patientAppointment->patient->first_name . ' ' . $patientAppointment->patient->last_name;
            $address = empty($patientAppointment->patient->full_name) ? $fullName : $patientAppointment->patient->full_name
            . '<br />DOB:' . $patientAppointment->patient->dob
            . '<br />Collection:' . $patientAppointment->appointment;
            $address = str_replace('<br />', PHP_EOL, $address);
        }
        return view('pages.dymo-printer',compact('address'));
    }

    public function labelXML()
    {
        return '<?xml version="1.0" encoding="utf-8"?>
<DieCutLabel Version="8.0" Units="twips">
	<PaperOrientation>Portrait</PaperOrientation>
	<Id>Small30334</Id>
	<PaperName>30334 2-1/4 in x 1-1/4 in</PaperName>
	<DrawCommands>
		<RoundRectangle X="0" Y="0" Width="3240" Height="1800" Rx="270" Ry="270" />
	</DrawCommands>
	<ObjectInfo>
		<TextObject>
			<Name>Text</Name>
			<ForeColor Alpha="255" Red="0" Green="0" Blue="0" />
			<BackColor Alpha="0" Red="255" Green="255" Blue="255" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>True</IsVariable>
			<HorizontalAlignment>Center</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String></String>
					<Attributes>
						<Font Family="Arial" Size="12" Bold="False" Italic="False" Underline="False" Strikeout="False" />
						<ForeColor Alpha="255" Red="0" Green="0" Blue="0" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X="58" Y="86" Width="3123.77954101563" Height="1627" />
	</ObjectInfo>
</DieCutLabel>';
    }

}
