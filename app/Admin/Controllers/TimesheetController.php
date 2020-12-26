<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\Helper\AdminHelper;
use App\Timesheet;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Timesheet';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Timesheet());

        $authUser = Auth::guard('admin')->user();
        if($authUser && $authUser->id){
            $grid->model()->where('user_id', $authUser->id);
        }

        $grid->column('id', __('Id'))->sortable();
        $grid->column('adminUser.name', __('User'));
        $grid->column('check_in', __('Check in'));
        $grid->column('check_out', __('Check out'));
        $grid->column('break_in', __('Break in'));
        $grid->column('break_out', __('Break out'));

        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');
        AdminHelper::gridDateFormat($grid, 'updated_at', 'Updated at');


        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
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
        $show = new Show(Timesheet::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('check_in', __('Check in'));
        $show->field('check_out', __('Check out'));
        $show->field('break_in', __('Break in'));
        $show->field('break_out', __('Break out'));

        AdminHelper::gridDateFormat($show, 'created_at', 'Created at');
        AdminHelper::gridDateFormat($show, 'updated_at', 'Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Timesheet());

        $form->datetime('check_in', __('Check in'))->default(date('Y-m-d H:i:s'));
        $form->datetime('check_out', __('Check out'))->default(date('Y-m-d H:i:s'));
        $form->datetime('break_in', __('Break in'))->default(date('Y-m-d H:i:s'));
        $form->datetime('break_out', __('Break out'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
