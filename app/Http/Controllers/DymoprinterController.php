<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class DymoprinterController extends Controller
{
    public function index($id)
    {
        if(empty($id)){
            abort(404);
        }
        $patient = Patient::find($id);
        $address = '';
        if ($patient) {
            $fullName = $patient->first_name . ' ' . $patient->last_name;
            $address = empty($patient->full_name) ? $fullName : $patient->full_name . ' \n DOB:' . $patient->dob . ' \n Collection:' . $patient->appointment;
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
