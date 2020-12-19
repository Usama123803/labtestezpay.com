<?php

namespace App\Admin\Controllers;

use App\Helper\AdminHelper;
use App\Location;
use App\State;
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

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('fax', __('Fax'));
        $grid->column('address', __('Address'));
        $grid->column('city', __('City'));
        $grid->column('state.name', __('state'));
        $grid->column('zipcode', __('ZipCode'));
        $grid->column('alt_phone', __('Alt.Phone'));
        $grid->column('alt_fax', __('Alt.Fax'));
        $grid->column('status', __('Status'))->bool();
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
        $form->text('phone', __('Phone'));
        $form->number('hours_1', __('72 Hours $'))->min(0);
        $form->number('hours_2', __('24 Hours $'))->min(0);
        $form->number('same_day', __('Same day $'))->min(0);
        $form->text('fax', __('Fax'));
        $form->text('address', __('Address'));
        $form->text('city', __('City'));
//        $form->text('state', __('state'));
        $form->select('stateId', __('State'))->options(
            State::where([["status", 1]])->pluck("name", "id")
        )->required();
        $form->text('zipcode', __('ZipCode'));
        $form->text('alt_phone', __('Alt.Phone'));
        $form->text('alt_fax', __('Alt.Fax'));

        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
