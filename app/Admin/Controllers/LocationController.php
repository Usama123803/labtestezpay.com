<?php

namespace App\Admin\Controllers;

use App\Helper\AdminHelper;
use App\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LocationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Location';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Location());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('status', __('Status'));
//        $grid->column('deleted_at', __('Deleted at'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
        AdminHelper::gridDateFormat($grid, 'deleted_at', 'Deleted at');
        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');
        AdminHelper::gridDateFormat($grid, 'updated_at', 'Updated at');

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
        $show = new Show(Location::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
//        $show->field('deleted_at', __('Deleted at'));
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));

        AdminHelper::gridDateFormat($show, 'deleted_at', 'Deleted at');
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
        $form = new Form(new Location());

        $form->text('name', __('Name'));
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
