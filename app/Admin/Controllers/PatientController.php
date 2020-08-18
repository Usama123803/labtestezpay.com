<?php

namespace App\Admin\Controllers;


use App\Admin\Extensions\CheckRow;
use App\Country;
use App\Helper\AdminHelper;
use App\Location;
use App\Patient;
use App\State;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('id', __('Id'))->sortable();

        $grid->column('Name')->display(function () {
            return $this->first_name." ".$this->last_name;
        });

        $grid->column('email_address', __('Email'));
        $grid->column('gender', __('Gender'));
        $grid->column('dob', __('Dob'));
        $grid->column('cell_phone', __('Cell phone'));
//        $grid->column('zipcode', __('Zipcode'));
//        $grid->column('country.name', __('Country'));
        $grid->column('location.name', __('Location'));
        $grid->column('appointment', __('Appointment'));
//        $grid->column('city', __('City'));
        $grid->column('state.name', __('State'));
        $grid->column('status', __('Status'))->bool();

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->append(new CheckRow($actions->getKey()));
//            $actions->disableEdit();
            $actions->disableDelete();
//            $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
        });

//        $grid->tools(function ($tools) {
//            $tools->append("<a href='your-create-URI' class='btn btn-default'>Create</a>");
//        });

        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');

        $grid->column('Print')->display(function () {
            $pdfRoute = route('generate.pdf', $this->id);
            return "<a target='_blank' href='".$pdfRoute."' class='fa fa-file-pdf-o'></a>";
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
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email_address', __('Email address'));
        $show->field('gender', __('Gender'));
        $show->field('dob', __('Dob'));
        $show->field('cell_phone', __('Cell phone'));

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

        $show->field('email_cb', __('Email'));
        $show->field('passcode', __('Passcode'));
        $show->field('group_no', __('Group Number'));
        $show->field('ins_name', __('Insurance Name'));
        $show->field('bill_to', __('Bill To'));

        $show->field('landline', __('Alternate Phone Number'));
        $show->field('zipcode', __('Zipcode'));
//        $show->field('country.name', __('Country'));
        $show->field('location.name', __('Location'));
        $show->field('appointment', __('Appointment'));
        $show->field('city', __('City'));
        $show->field('address', __('Address'));
        $show->field('state.name', __('State'));
        $show->field('terms', __('Terms'));
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

//        AdminHelper::showDateFormat($show , 'deleted_at', 'Deleted at');
        AdminHelper::showDateFormat($show , 'created_at', 'Created at');
//        AdminHelper::showDateFormat($show, 'updated_at','Updated at');

        $show->panel()
            ->tools(function ($tools) {
//                $tools->disableEdit();
//                $tools->disableList();
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
            $form->text('first_name', __('First name'))->readonly();
            $form->text('last_name', __('Last name'))->readonly();
            $form->text('email_address', __('Email address'))->readonly();
            $form->text('gender', __('Gender'))->readonly();
            $form->date('dob', __('Dob'))->default(date('Y-m-d'))->readonly();
            $form->text('cell_phone', __('Cell phone'))->readonly();
            $form->text('landline', __('Landline'))->readonly();
            $form->text('zipcode', __('Zipcode'))->readonly();
//        $form->select('countryId', __('Country'))->options(
//            Country::where([["status", 1]])->pluck("name", "id")
//        );
            $form->select('locationId', __('Location'))->options(
                Location::where([["status", 1]])->pluck("name", "id")
            )->readonly();
            $form->datetime('appointment', __('Appointment'))->default(date('Y-m-d H:i:s'))->readonly();
            $form->text('city', __('City'))->readonly();
            $form->textarea('address', __('Address'))->readonly();
            $form->select('stateId', __('State'))->options(
                State::where([["status", 1]])->pluck("name", "id")
            )->readonly();
            $form->text('terms', __('Terms'))->readonly();
            $form->switch('status', __('Status'))->readonly()->default(1);
        })->tab('Remarks', function ($form) {

            $form->select('pcr', __('PCR'))->options(
                [1 => 'Negative', 2 => 'Positive']
            );

            $form->textarea('pcr_remark', __('PCR Remark'));

            $form->select('blood', __('Blood'))->options(
                [1 => 'Negative', 2 => 'Positive']
            );

            $form->textarea('blood_remark', __('Blood Remark'));

        });



        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
        });

        $form->footer(function ($footer) {
            // disable reset btn
            $footer->disableReset();
            // disable `View` checkbox
            $footer->disableViewCheck();
            // disable `Continue editing` checkbox
//            $footer->disableEditingCheck();
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
