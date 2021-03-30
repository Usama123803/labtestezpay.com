<?php

namespace App\Admin\Controllers;

use App\DocumentPatients;
use App\Helper\AdminHelper;
use App\Helper\GeneralHelper;
use App\Patient;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Spatie\PdfToText\Pdf;

class DocumentPatientsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document Patients';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DocumentPatients());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('url', __('Url'));
        $grid->column('patients.full_name', __('Patient'));
        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
        $grid->disableActions();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(DocumentPatients::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('url', __('Url'));
        $show->field('patient_id', __('Patient id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DocumentPatients());

        //$form->url('url', __('Url'));
        $form->multipleFile('url','Attachments')->required()->rules('')->removable();
//        $form->number('patient_id', __('Patient id'));


        $form->saving(function ($form) {
            $response =$this->fileAttachment($form->url);
            if($response['error']){
                $error = new MessageBag([
                    'title'   => 'Error',
                    'message' => $response['message'],
                ]);
                return back()->with(compact('error'));
            }
            else {
                $success = new MessageBag([
                    'title'   => 'Success',
                    'message' => $response['message'],
                ]);
                return back()->with(compact('success'));
            }
        });


        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    private function fileAttachment($files)
    {
        try {
            if (!empty($files)) {
                foreach ($files as $file) {
                    $text = (new Pdf())->setPdf($file)->setOptions(['-layout', 'r 96'])->text();

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
            return ['error'=> false, 'message' => 'Patient test report files uploaded successfully'];
           // return redirect()->back()->with('status', 'Patient test report files uploaded successfully');
        } catch (\Exception $e) {
            return ['error'=> true, 'message' => $e->getMessage()];
          //  return redirect()->back()->with('statusError', $e->getMessage());
        }
    }





}
