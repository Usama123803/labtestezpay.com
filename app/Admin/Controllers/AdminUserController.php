<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\AdminUser;
use App\Helper\AdminHelper;
use App\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Assign Users Location';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdminUser());

        $grid->column('id', __('Id'))->sortable();
//        $grid->column('locationId', __('LocationId'));
        $grid->column('username', __('Username'));
//        $grid->column('password', __('Password'));
        $grid->column('name', __('Name'));
        $grid->column('location.name', __('Location'));
//        $grid->column('avatar', __('Avatar'));
//        $grid->column('remember_token', __('Remember token'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

        AdminHelper::gridDateFormat($grid, 'created_at', 'Created at');
        AdminHelper::gridDateFormat($grid, 'updated_at', 'Updated at');

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
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
        $show = new Show(AdminUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('locationId', __('LocationId'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'));
//        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdminUser());


//        $form->text('username', __('Username'))->required();
        $form->text('name', __('Name'))->required();
//        $form->image('avatar', __('Avatar'));
//        $form->icon('icon');
//        $form->password('password', __('Password'))->required();
//        $form->password('password_confirmation', __('Password confirmation'))->required();

        $form->select('locationId', __('Location'))->options(
            Location::where([["status", 1]])->pluck("name", "id")
        )->required();
//        $form->text('remember_token', __('Remember token'));

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
