<?php

namespace App\Admin\Controllers;

use App\Configuration;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigurationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Configuration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
//        $grid = new Grid(new Configuration());
//
//        $grid->column('id', __('Id'));
//        $grid->column('start_time', __('Start time'));
//        $grid->column('end_time', __('End time'));
//        $grid->column('time_interval', __('Time interval'));
//        $grid->column('block_limit', __('Block limit'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
//
//        return $grid;

        return redirect("/admin/configurations/1/edit");

    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
//        $show = new Show(Configuration::findOrFail($id));
//
//        $show->field('id', __('Id'));
//        $show->field('start_time', __('Start time'));
//        $show->field('end_time', __('End time'));
//        $show->field('time_interval', __('Time interval'));
//        $show->field('block_limit', __('Block limit'));
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));
//
//        return $show;

        return redirect("/admin/configurations/1/edit");

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Configuration());

        $form->time('start_time', __('Start time'))->default(date('H:i:s'))->required();;
        $form->time('end_time', __('End time'))->default(date('H:i:s'))->required();;
        $form->number('time_interval', __('Time interval'))->min(1)->required();;
        $form->number('block_limit', __('Block limit'))->min(1)->required();;

        $form->table('disabled_appointment_dates', function ($table) {
            $table->date('appointment_date');
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
            $footer->disableEditingCheck();
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
