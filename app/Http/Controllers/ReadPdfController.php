<?php

namespace App\Http\Controllers;

use App\DocumentPatients;
use App\Helper\GeneralHelper;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class ReadPdfController extends Controller
{
    public function index(Request $request)
    {
        try {
            if($request->allFiles()) {
                foreach ($request->allFiles()['file'] as $file) {
                    $text = (new Pdf())
                        ->setPdf($file)
                        ->setOptions(['-layout', 'r 96'])
                        ->text();

                    // For Just Testing Purpose in Local
//                $text = $this->getPDFText();

                    preg_match_all('/DOB: (?<dob>.*?) /', $text, $m);
                    preg_match_all('/Name: (?<name>.*?) {2} /', $text, $a);
                    if (isset($m['dob']) && isset($a['name'])) {
                        $dob = end($m['dob']);
                        $name = end($a['name']);
                        $dob = Carbon::parse($dob)->format('Y-m-d');
                        $patient = Patient::where(['full_name' => $name], ['dob' => $dob])->first();
                        if ($patient) {
                            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                            $filePath = GeneralHelper::uploadAttachment($file, $fileName);
                            DocumentPatients::create([
                                'patient_id' => $patient->id,
                                'url' => $filePath,
                                'type' => 'external_attachment',
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                        }
                    }
                }
            }
            return redirect()->back()->with('status','Patient test report files uploaded successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('statusError',$e->getMessage());
        }
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
