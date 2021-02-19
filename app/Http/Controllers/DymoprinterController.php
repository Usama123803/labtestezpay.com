<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class DymoprinterController extends Controller
{
    public function index()
    {
        return view('pages.dymo-printer');
    }

    public function labelXML()
    {
        return '<?xml version="1.0" encoding="utf-8"?>
<DesktopLabel Version="1">
  <DYMOLabel Version="3">
    <Description>DYMO Label</Description>
    <Orientation>Landscape</Orientation>
    <LabelName>6MMX7M-TAPE BLACK/WHITE</LabelName>
    <InitialLength>0.2444444</InitialLength>
    <BorderStyle>SolidLine</BorderStyle>
    <DYMORect>
      <DYMOPoint>
        <X>0.4166667</X>
        <Y>0.02222222</Y>
      </DYMOPoint>
      <Size>
        <Width>0.5</Width>
        <Height>0.2</Height>
      </Size>
    </DYMORect>
    <BorderColor>
      <SolidColorBrush>
        <Color A="1" R="0.1372549" G="0.1215686" B="0.1254902"></Color>
      </SolidColorBrush>
    </BorderColor>
    <BorderThickness>1</BorderThickness>
    <Show_Border>False</Show_Border>
    <ContinuousLayoutManager>
      <RotationBehavior>ClearObjects</RotationBehavior>
      <LabelObjects>
        <TextObject>
          <Name>TEXT</Name>
          <Brushes>
            <BackgroundBrush>
              <SolidColorBrush>
                <Color A="0" R="0.1372549" G="0.1215686" B="0.1254902"></Color>
              </SolidColorBrush>
            </BackgroundBrush>
            <BorderBrush>
              <SolidColorBrush>
                <Color A="1" R="0.137" G="0.122" B="0.125"></Color>
              </SolidColorBrush>
            </BorderBrush>
            <StrokeBrush>
              <SolidColorBrush>
                <Color A="1" R="0" G="0.018" B="0.014"></Color>
              </SolidColorBrush>
            </StrokeBrush>
            <FillBrush>
              <SolidColorBrush>
                <Color A="0" R="0" G="0" B="0"></Color>
              </SolidColorBrush>
            </FillBrush>
          </Brushes>
          <Rotation>Rotation0</Rotation>
          <OutlineThickness>1</OutlineThickness>
          <IsOutlined>False</IsOutlined>
          <BorderStyle>SolidLine</BorderStyle>
          <Margin>
            <DYMOThickness Left="0" Top="0" Right="0" Bottom="0" />
          </Margin>
          <HorizontalAlignment>Center</HorizontalAlignment>
          <VerticalAlignment>Middle</VerticalAlignment>
          <FitMode>AlwaysFit</FitMode>
          <IsVertical>False</IsVertical>
          <FormattedText>
            <FitMode>AlwaysFit</FitMode>
            <HorizontalAlignment>Center</HorizontalAlignment>
            <VerticalAlignment>Middle</VerticalAlignment>
            <IsVertical>False</IsVertical>
            <LineTextSpan>
              <TextSpan>
                <Text>Testing</Text>
                <FontInfo>
                  <FontName>Segoe UI</FontName>
                  <FontSize>10</FontSize>
                  <IsBold>False</IsBold>
                  <IsItalic>False</IsItalic>
                  <IsUnderline>False</IsUnderline>
                  <FontBrush>
                    <SolidColorBrush>
                      <Color A="1" R="0.1372549" G="0.1215686" B="0.1254902"></Color>
                    </SolidColorBrush>
                  </FontBrush>
                </FontInfo>
              </TextSpan>
            </LineTextSpan>
          </FormattedText>
          <ObjectLayout>
            <DYMOPoint>
              <X>0.4166667</X>
              <Y>0.02222222</Y>
            </DYMOPoint>
            <Size>
              <Width>0.5</Width>
              <Height>0.2</Height>
            </Size>
          </ObjectLayout>
        </TextObject>
      </LabelObjects>
    </ContinuousLayoutManager>
  </DYMOLabel>
  <LabelApplication>Blank</LabelApplication>
  <DataTable>
    <Columns></Columns>
    <Rows></Rows>
  </DataTable>
</DesktopLabel>';
    }

    public function readPdf()
    {
        $pdfDoc = public_path('storage/pdftotext/1.pdf');
//        $pdfDoc = url('/public/storage');

//        dd($pdfDoc);

//        $text = (new Pdf())
//            ->setPdf($pdfDoc)
//            ->setOptions(['-layout', 'r 96'])
//            ->text();

        $text = $this->getPDFText();

        preg_match_all('/DOB: (?<dob>.*?) /', $text, $m);
        preg_match_all('/Name: (?<name>.*?) {2} /', $text, $a);

//            echo "<pre>";
//            print_r(end($m['dob']));
//            print_r(end($a['name']));

        if (isset($m['dob']) && isset($a['name'])) {
            $dob = end($m['dob']);
            $name = end($a['name']);
            $patient = Patient::where([['full_name' => $name],['dob'=> $dob]])->first();

            

        }
//        continue;
        echo($text);
    }
    private function getPDFText(){
        return 'Gene Street Laboratories, LLC
                                               11455 Fallbrook Drive, Suite 102, Houston, TX 77065
                                               Laboratory Director: Jonathan Stein, PhD.                                RT-PCR COVID-19 Report
                                               CLIA#: 45D2176552 COLA#: 29895
                                               support@genestreet.com




              Patient Information                                    Specimen Information                                       Facility Information
 Name: Syed Rizvi                                         Accession Number: GSCOV37177                             Facility Name: LabTest Diagnostics
                                                                                                                   Houston
 DOB: 04/20/1966                                          Date Collected: 12/04/2020
                                                                                                                   Provider Name: LABTEST LLC
 Gender: M                                                Date Received: 12/04/2020
                                                                                                                   Address: 8150 Southwest Freeway, Suite
 Ethnicity:                                               Report Date: 12/04/2020                                  V1, Houston, Texas, 77074
 Medical Record Number:                                   Sample Type: Nasopharyngeal Swab
 Address: 23207 Fall Wind Court, Katy,
 Texas, 77494
 Phone number: (314) 737-1914
 Email:
 Clinical Notes from Ordering Physician:




                            RT-PCR COVID-19 Test Result Summary
                       SARS-COV-2 NOT DETECTED - NEGATIVE

SARS-CoV-2/2019-nCoV
Assay                                                                                                 Results

N Protein                                                                                              Not Detected
ORF 1ab                                                                                                Not Detected
S Protein                                                                                              Not Detected
';
    }

}
