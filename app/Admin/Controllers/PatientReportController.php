<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\Location;
use App\Patient;
use App\UsersLocation;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class PatientReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patients Report';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Patient());

        $grid->column('id', __('Id'));

        $grid->column('Name')->display(function () {
            return $this->first_name." ".$this->last_name;
        });

//        $grid->column('first_name', __('First name'));
//        $grid->column('last_name', __('Last name'));

        $grid->column('email_address', __('Email'));
        $grid->column('', __('Test Identifier'));
        $grid->column('', __('Date Collected'));
        $grid->column('', __('Collecting Location'));


        $grid->column('gender', __('Gender'));
        $grid->column('dob','Date of Birth')->width('400')->display(function ($title) {
            return Carbon::parse($title)->format('m/d/Y');
        });

        $grid->column('status', __('Status'))->display(function ($status) {
            if($status === 0){
                return "Inactive";
            }
            return "Active";
        });

        $grid->column('', __('Test Type'));
        $grid->column('location.name', __('Testing Lab'));

        $grid->column('', __('Collecting Bill Code'));
        $grid->column('', __('Collecting Billed Amount'));
        $grid->column('', __('Collecting Paid Amount'));
        $grid->column('', __('Testing Bill Code'));
        $grid->column('', __('Testing Billed Amount'));
        $grid->column('', __('Testing Paid Amount'));
        $grid->column('bill_to',__('Insurance/Uninsured?'));
        $grid->column('paid_or_free', __('Paid/Free'))->display(function ($title) {
            if($title == 0){
                return "Free";
            }
            return "Paid";
        });
        $grid->column('remarks', __('Remarks'));
        $grid->disableCreateButton();
        $grid->disableActions();

        $authUser = Auth::guard('admin')->user();
        if($authUser && $authUser->id <> 1){ // ID is for admin
            $locationIds = UsersLocation::where('user_id', $authUser->id)->pluck('location_id');
            $grid->model()->whereIn('locationId', $locationIds);
        }

        $grid->filter(function($filter) use ($authUser){
            $filter->like('first_name', 'First Name');
            $filter->like('last_name', 'Last Name');
//            $filter->equal('dob')->datetime(['format' => 'MM/DD/YYYY']);
            $filter->where(function ($query) {
                if($this->input){
                    $dob = Carbon::parse($this->input)->format('Y-m-d');
                    $query->whereRaw("`dob` = '{$dob}'");
                }
            }, 'Date of Birth', 'dob')->datetime([
                'format' => 'MM/DD/YYYY'
            ]);

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

//        $show->field('id', __('Id'));
//        $show->field('first_name', __('First name'));
//        $show->field('last_name', __('Last name'));
//        $show->field('email_address', __('Email address'));
//        $show->field('gender', __('Gender'));
//        $show->field('dob', __('Dob'));
//        $show->field('cell_phone', __('Cell phone'));
//        $show->field('is_fax', __('Is fax'));
//        $show->field('fax', __('Fax'));
//        $show->field('is_email', __('Is email'));
//        $show->field('email_cb', __('Email cb'));
//        $show->field('passcode', __('Passcode'));
//        $show->field('group_no', __('Group no'));
//        $show->field('ins_name', __('Ins name'));
//        $show->field('bill_to', __('Bill to'));
//        $show->field('landline', __('Landline'));
//        $show->field('zipcode', __('Zipcode'));
//        $show->field('countryId', __('CountryId'));
//        $show->field('locationId', __('LocationId'));
//        $show->field('appointment', __('Appointment'));
//        $show->field('city', __('City'));
//        $show->field('address', __('Address'));
//        $show->field('stateId', __('StateId'));
//        $show->field('drivlic_id', __('Drivlic id'));
//        $show->field('issued_state', __('Issued state'));
//        $show->field('terms', __('Terms'));
//        $show->field('pcr', __('Pcr'));
//        $show->field('blood', __('Blood'));
//        $show->field('pcr_remark', __('Pcr remark'));
//        $show->field('blood_remark', __('Blood remark'));
//        $show->field('additional_doc', __('Additional doc'));
//        $show->field('hear_about', __('Hear about'));
//        $show->field('refer_name', __('Refer name'));
//        $show->field('status', __('Status'));
//        $show->field('timeslot', __('Timeslot'));
//        $show->field('result_type', __('Result type'));
//        $show->field('flight_datetime', __('Flight datetime'));
//        $show->field('paid_or_free', __('Paid or free'));
//        $show->field('checkin', __('Checkin'));
//        $show->field('deleted_at', __('Deleted at'));
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));

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

//        $form->text('first_name', __('First name'));
//        $form->text('last_name', __('Last name'));
//        $form->text('email_address', __('Email address'));
//        $form->text('gender', __('Gender'));
//        $form->date('dob', __('Dob'))->default(date('Y-m-d'));
//        $form->text('cell_phone', __('Cell phone'));
//        $form->switch('is_fax', __('Is fax'));
//        $form->text('fax', __('Fax'));
//        $form->switch('is_email', __('Is email'));
//        $form->text('email_cb', __('Email cb'));
//        $form->text('passcode', __('Passcode'));
//        $form->text('group_no', __('Group no'));
//        $form->text('ins_name', __('Ins name'));
//        $form->text('bill_to', __('Bill to'));
//        $form->text('landline', __('Landline'));
//        $form->text('zipcode', __('Zipcode'));
//        $form->number('countryId', __('CountryId'));
//        $form->number('locationId', __('LocationId'));
//        $form->date('appointment', __('Appointment'))->default(date('Y-m-d'));
//        $form->text('city', __('City'));
//        $form->textarea('address', __('Address'));
//        $form->number('stateId', __('StateId'));
//        $form->textarea('drivlic_id', __('Drivlic id'));
//        $form->textarea('issued_state', __('Issued state'));
//        $form->switch('terms', __('Terms'));
//        $form->number('pcr', __('Pcr'));
//        $form->number('blood', __('Blood'));
//        $form->textarea('pcr_remark', __('Pcr remark'));
//        $form->textarea('blood_remark', __('Blood remark'));
//        $form->text('additional_doc', __('Additional doc'));
//        $form->text('hear_about', __('Hear about'));
//        $form->text('refer_name', __('Refer name'));
//        $form->switch('status', __('Status'))->default(1);
//        $form->text('timeslot', __('Timeslot'));
//        $form->text('result_type', __('Result type'));
//        $form->text('flight_datetime', __('Flight datetime'));
//        $form->number('paid_or_free', __('Paid or free'));
//        $form->number('checkin', __('Checkin'));



        return $form;
    }
}
