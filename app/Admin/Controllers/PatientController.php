<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Post\AttachPatientTestReport;
use App\Admin\Actions\Post\SendPatientEmail;
use App\Admin\Extensions\CheckRow;
use App\Country;
use App\DocumentPatients;
use App\Helper\AdminHelper;
use App\Location;
use App\Mail\PatientMailer;
use App\Patient;
use App\PatientAppointment;
use App\State;
use App\UsersLocation;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PatientController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patient';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Patient());
        $authUser = Auth::guard('admin')->user();
        $gridModel = $grid->model();

//        $patientApp = PatientAppointment::where('patient_id', $this->id)->orderBy('appointment', 'desc')->get();
//        if($authUser->id == 15) { // BIT CARE ID
//            $gridModel->where([['appointment', '>', date('Y-m-d', strtotime('2021-03-15'))]]);
//        }
//        if($authUser && $authUser->id <> 1){ // ID is for admin
//            $locationIds = UsersLocation::where('user_id', $authUser->id)->pluck('location_id');
//            $gridModel->whereIn('locationId', $locationIds);
//        }

        $grid->column('id', __('Id'))->sortable();
        $grid->column('Name')->display(function () {
            return $this->first_name." ".$this->last_name;
        });
        $grid->column('email_address', __('Email'));
        $grid->column('gender', __('Gender'));

        $grid->column('dob')->display(function ($title) {
            return Carbon::parse($title)->format('m/d/Y');
        });

        $grid->column('cell_phone', __('Cell phone'))->sortable();

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->append(new CheckRow($actions->getKey()));
        });

        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');
        $grid->filter(function($filter) use ($authUser){
            $filter->like('first_name', 'First Name');
            $filter->like('last_name', 'Last Name');
            $filter->where(function ($query) {
                if($this->input){
                    $dob = Carbon::parse($this->input)->format('Y-m-d');
                    $query->whereRaw("`dob` = '{$dob}'");
                }
            }, 'Date of Birth', 'dob')->datetime([
                'format' => 'MM/DD/YYYY'
            ]);
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
        $show = new Show(Patient::findOrFail($id));

        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email_address', __('Email address'));
        $show->field('gender', __('Gender'));
        $show->field('dob', __('Dob'));
        $show->field('cell_phone', __('Cell phone'));

//        $show->field('front', __('Front Image'))->as(function ($front) {
//            if(empty($front)){
//                return '';
//            }
//            return '<div class="printImageContainer">
//                      <img src="'.url('storage/'.$front).'" alt="Front" class="printImage">
//                      <div class="printImageOverlay">
//                        <a href="javascript:void(0)" data-path="'.url('storage/'.$front).'" class="print-image icon" title="Front Image Print">
//                          <i class="fa fa-print"></i>
//                        </a>
//                      </div>
//                    </div>';
//        })->unescape();
//
//        $show->field('back', __('Back Image'))->as(function ($back) {
//            if(empty($back)){
//                return '';
//            }
//            return '<div class="printImageContainer">
//                      <img src="'.url('storage/'.$back).'" alt="Back" class="printImage">
//                      <div class="printImageOverlay">
//                        <a href="javascript:void(0)" data-path="'.url('storage/'.$back).'" class="print-image icon" title="Back Image Print">
//                          <i class="fa fa-print"></i>
//                        </a>
//                      </div>
//                    </div>';
//        })->unescape();

        //AdminHelper::displayImage($show, "Front Image", 'front');
        //AdminHelper::displayImage($show, "Back Image",'back');

//        $show->field('is_fax', __('Is fax'))->as(function ($is_fax) {
//            if($is_fax === 1){
//                return "Yes";
//            }
//            return "No";
//        });
//
//        $show->field('fax', __('Fax'));
//        $show->field('is_email', __('Is Email'))->as(function ($is_email) {
//            if($is_email === 1){
//                return "Yes";
//            }
//            return "No";
//        });
//
//        $show->field('email_cb', __('Email'));
//        $show->field('passcode', __('Passcode'));
//        $show->field('group_no', __('Group Number'));
//        $show->field('ins_name', __('Insurance Name'));
//        $show->field('bill_to', __('Bill To'));
//
//        $show->field('landline', __('Alternate Phone Number'));
//        $show->field('zipcode', __('Zipcode'));
//        $show->field('location.name', __('Location'));
//        $show->field('appointment', __('Appointment'));
//        $show->field('timeslot', __('Appointment Time'));
//        $show->field('city', __('City'));
//        $show->field('address', __('Address'));
//        $show->field('state.name', __('State'));
//        $show->field('terms', __('Terms'))->as(function ($terms) {
//            if($terms === 1){
//                return "Yes";
//            }
//            return "No";
//        });
//        $show->field('status', __('Status'))->as(function ($status) {
//            if($status === 0){
//                return "Inactive";
//            }
//            return "Active";
//        });

        AdminHelper::showDateFormat($show , 'created_at', 'Created at');
        $show->panel()
            ->tools(function ($tools) {
                $tools->disableDelete();
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
        $form = new Form(new Patient());

        $form->tab('Basic info', function ($form) {
            $form->text('first_name', __('First name'))->required();
            $form->text('last_name', __('Last name'))->required();
            $form->text('email_address', __('Email address'))->required();
            $form->select('gender', __('Gender'))->options(
                ['male' => 'Male', 'female' => 'Female']
            )->required();
            $form->date('dob', __('Dob'))->format('MM/DD/YYYY')->required();
            $form->text('cell_phone', __('Cell phone'))->required();
//            $form->text('landline', __('Landline'));
//            $form->textarea('address', __('Address'));
//            $form->text('city', __('City'));
//            $form->select('stateId', __('State'))->options(
//                State::where([["status", 1]])->pluck("name", "id")
//            )->required();
//            $form->text('zipcode', __('Zipcode'))->required();
//            $form->select('locationId', __('Location'))->options(
//                Location::where([["status", 1]])->pluck("name", "id")
//            )->required();
//            $form->datetime('appointment', __('Appointment'))->format('MM/DD/YYYY');
//            $form->text('timeslot', __('Appointment time'));
            $form->switch('status', __('Status'))->default(1);
        });
//            ->tab('Remarks', function ($form) {
//            $form->select('pcr', __('PCR'))->options(
//                [1 => 'Negative', 2 => 'Positive']
//            );
//            $form->textarea('pcr_remark', __('PCR Remark'));
//            $form->select('blood', __('Blood'))->options(
//                [1 => 'Negative', 2 => 'Positive']
//            );
//            $form->textarea('blood_remark', __('Blood Remark'));
//            $form->file('additional_doc', __('Additional Document'));
//            //$form->multipleFile('documents')->pathColumn('url')->rules('required|mimes:pdf');
//        });

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
            $patient = Patient::find($form->model()->id);
            Mail::to($patient->email_address)->send(new PatientMailer($patient));
        });

        return $form;
    }
}
