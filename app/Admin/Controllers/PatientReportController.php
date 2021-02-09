<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\SendPatientEmail;
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
        $grid->column('email_address', __('Email'));
        $grid->column('cell_phone', __('Cell phone'))->sortable();
        $grid->column('test_identifier', __('Test Identifier'));
        $grid->column('appointment', __('Date Collected'))->display(function ($title) {
            return Carbon::parse($title)->format('m/d/Y');
        })->sortable();
        $grid->column('location.name', __('Collecting Location'));
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

        $grid->column('test_type', __('Test Type'));
        $grid->column('testing_lab', __('Testing Lab'));

        $grid->column('collection_bill_code', __('Collecting Bill Code'));
        $grid->column('collecting_billed_amount', __('Collecting Billed Amount'));
        $grid->column('collecting_paid_amount', __('Collecting Paid Amount'));
        $grid->column('testing_bill_code', __('Testing Bill Code'));
        $grid->column('testing_billed_amount', __('Testing Billed Amount'));
        $grid->column('testing_paid_amount', __('Testing Paid Amount'));
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
            $filter->where(function ($query) {
                if($this->input){
                    $dob = Carbon::parse($this->input)->format('Y-m-d');
                    $query->whereRaw("`dob` = '{$dob}'");
                }
            }, 'Date of Birth', 'dob')->datetime([
                'format' => 'MM/DD/YYYY'
            ]);
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

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new SendPatientEmail());
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

        return $form;
    }
}
