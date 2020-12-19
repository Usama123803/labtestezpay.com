<?php

namespace App\Admin\Controllers;

use App\CovidSymptom;
use App\Helper\AdminHelper;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CovidSymptomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Covid Symptom';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CovidSymptom());

        $grid->column('id', __('Id'))->sortable();
//        $grid->column('key', __('Key'));
        $grid->column('name', __('Name'));
        $grid->column('status', __('Status'))->bool();
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
        $show = new Show(CovidSymptom::findOrFail($id));

        $show->field('id', __('Id'));
//        $show->field('key', __('Key'));
        $show->field('name', __('Name'));
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
        $form = new Form(new CovidSymptom());

//        $form->text('key', __('Key'))->required();
        $form->text('name', __('Name'))->required();
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
