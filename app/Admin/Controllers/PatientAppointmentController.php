<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\DocumentPatients;
use App\Helper\AdminHelper;
use App\Location;
use App\Mail\PatientMailer;
use App\Patient;
use App\PatientAppointment;
use App\UsersLocation;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PatientAppointmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patient Appointments';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PatientAppointment());

        $authUser = Auth::guard('admin')->user();
        $gridModel = $grid->model();

        if($authUser->id == 15) { // BIT CARE ID
            $gridModel->where([['appointment', '>', date('Y-m-d', strtotime('2021-03-15'))]]);
        }
        if($authUser && $authUser->id <> 1){ // ID is for admin
            $locationIds = UsersLocation::where('user_id', $authUser->id)->pluck('location_id');
            $gridModel->whereIn('locationId', $locationIds);
        }

        $grid->column('id', __('Id'))->sortable();
        $grid->column('patient.full_name', __('Patient'));
//        $grid->column('patient_id', __('Patient id'));
        $grid->column('location.name', __('Location'));

        $grid->column('appointment')->display(function ($title) {
            return Carbon::parse($title)->format('m/d/Y');
        })->sortable();

        $grid->column('timeslot', __('Appointment Time'))->display(function ($time) {
            return Carbon::parse($time)->format('h:i a');
        })->sortable();

        $grid->column('state.name', __('State'));
        $grid->column('paid_or_free', __('Paid/Free'))->display(function ($title) {
            if($title == 0){
                return "Free";
            }
            return "Paid";
        });

        $grid->column('checkin', __('CheckIn'))->display(function ($title) {
            if($title){
                return "<i class='fa fa-check text-success'></i>";
            }
            return "";
        });
        $grid->column('front', __('Front'))->display(function ($front) {
            if($front){
                return '<a href="javascript:void(0)" data-url="'.url('storage/'.$front).'" class="fancybox-manual-a" title="">
                          <img class="grid-image-thumbnail" src="'.url('storage/'.$front).'" alt="Front Image" />
                        </a>';
            }
            return '';
        });

        $grid->column('back', __('Back'))->display(function ($back) {
            if($back){
                return '<a href="javascript:void(0)" data-url="'.url('storage/'.$back).'" class="fancybox-manual-a" title="">
                          <img class="grid-image-thumbnail" src="'.url('storage/'.$back).'" alt="Back Image" />
                        </a>';
            }
            return '';
        });

        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');


        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
//            $actions->disableEdit();
            //$actions->disableView();
        });

        $grid->column('Print')->display(function () {
            $documentPatient = DocumentPatients::where([['appointment_id', $this->id], ['type', 'appointment'], ['patient_id', $this->patient_id]])->first();
            //dd($this->id);
            if($documentPatient){
                $pdfRoute = url('storage/'.$documentPatient->url);
            }else {
                $pdfRoute = route('generate.pdf', $this->id);
            }
           
            $checkInRoute = '/admin/patient/checkin/'.$this->id;
            $btnTitle = 'CheckIn';
            if($this->checkin == 1){
                $btnTitle = 'CheckOut';
            }
            $printRoute = '/dymo-printer/'.$this->id;
            $emailLoginRoute = '/admin/patient/send-credentials/'.$this->id;
            $emailRoute = '/admin/patient/send-email/'.$this->id;
            return "<a href='".$emailRoute."' class='fa fa-envelope'></a>
                    <a target='_blank' href='".$pdfRoute."' class='fa fa-file-pdf-o'></a>&nbsp;
                    <a target='_blank' href='".$printRoute."' class='fa fa-print'></a>
                    <a title='Send Login Email to Patient' href='".$emailLoginRoute."' class='fa fa-envelope-open-o'></a>
                    <a href='".$checkInRoute."' class='btn btn-sm btn-primary'>$btnTitle</a>
            ";
        });


        $grid->filter(function($filter) use ($authUser){
            $filter->like('first_name', 'First Name');
            $filter->like('last_name', 'Last Name');

            // set datetime field type
            $filter->between('appointment', 'Appointment')->date();
            if($authUser){
                if($authUser->id <> 1){
                    $locationIds = UsersLocation::where('user_id', 2)->pluck('location_id');
                    $locationsByUsers = Location::where([["status", 1]])->whereIn('id', $locationIds)->pluck("name", "id");
                }else{
                    $locationsByUsers = Location::where([["status", 1]])->pluck("name", "id");
                }
                $filter->in('locationId','Locations')->multipleSelect(
                    $locationsByUsers
                );
            }

            $filter->equal('checkin')->select([1 => 'Yes', 0 => 'No']);
        });

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
        $show = new Show(PatientAppointment::findOrFail($id));

        $show->field('id', __('Id'));

        $show->field('patient.full_name', __('Patient'));

//        $show->field('patient_id', __('Patient'));

        $show->field('front', __('Front Image'))->as(function ($front) {
            if(empty($front)){
                return '';
            }
            return '<div class="printImageContainer">
                      <img src="'.url('storage/'.$front).'" alt="Front" class="printImage">
                      <div class="printImageOverlay">
                        <a href="javascript:void(0)" data-path="'.url('storage/'.$front).'" class="print-image icon" title="Front Image Print">
                          <i class="fa fa-print"></i>
                        </a>
                      </div>
                    </div>';
        })->unescape();

        $show->field('back', __('Back Image'))->as(function ($back) {
            if(empty($back)){
                return '';
            }
            return '<div class="printImageContainer">
                      <img src="'.url('storage/'.$back).'" alt="Back" class="printImage">
                      <div class="printImageOverlay">
                        <a href="javascript:void(0)" data-path="'.url('storage/'.$back).'" class="print-image icon" title="Back Image Print">
                          <i class="fa fa-print"></i>
                        </a>
                      </div>
                    </div>';
        })->unescape();

        //AdminHelper::displayImage($show, "Front Image", 'front');
        //AdminHelper::displayImage($show, "Back Image",'back');

        $show->field('is_fax', __('Is fax'))->as(function ($is_fax) {
            if($is_fax === 1){
                return "Yes";
            }
            return "No";
        });

        $show->field('fax', __('Fax'));
        $show->field('is_email', __('Is Email'))->as(function ($is_email) {
            if($is_email === 1){
                return "Yes";
            }
            return "No";
        });
//
        $show->field('email_cb', __('Email'));
        $show->field('passcode', __('Passcode'));
        $show->field('group_no', __('Group Number'));
        $show->field('ins_name', __('Insurance Name'));
        $show->field('bill_to', __('Bill To'));
//
        $show->field('landline', __('Alternate Phone Number'));
        $show->field('zipcode', __('Zipcode'));
        $show->field('location.name', __('Location'));
        $show->field('appointment', __('Appointment'));
        $show->field('timeslot', __('Appointment Time'));
        $show->field('city', __('City'));
        $show->field('address', __('Address'));
        $show->field('state.name', __('State'));
        $show->field('terms', __('Terms'))->as(function ($terms) {
            if($terms === 1){
                return "Yes";
            }
            return "No";
        });
        $show->field('status', __('Status'))->as(function ($status) {
            if($status === 0){
                return "Inactive";
            }
            return "Active";
        });

        AdminHelper::showDateFormat($show , 'created_at', 'Created at');
        $show->panel()
            ->tools(function ($tools) {
                $tools->disableDelete();
                $tools->disableEdit();
            });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PatientAppointment());

        $form->tab('Remarks', function ($form) {
            $form->select('pcr', __('PCR'))->options(
                [1 => 'Negative', 2 => 'Positive']
            );
            $form->textarea('pcr_remark', __('PCR Remark'));
            $form->select('blood', __('Blood'))->options(
                [1 => 'Negative', 2 => 'Positive']
            );
            $form->textarea('blood_remark', __('Blood Remark'));
            $form->file('additional_doc', __('Additional Document'));
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableCreatingCheck();
        });

        $form->saved(function (Form $form) {
            $patient = Patient::find($form->model()->patient_id);
            //Mail::to($patient->email_address)->send(new PatientMailer($patient, $form->model()));
        });
        return $form;
    }
}
