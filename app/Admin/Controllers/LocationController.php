<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CheckRow;
use App\Helper\AdminHelper;
use App\Location;
use App\LocationLog;
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
        $grid->column('status', __('Status'))->switch();
//        $grid->column('deleted_at', __('Deleted at'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

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

        $form->tab('Basic info', function ($form) {
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
        })->tab('Timings', function ($form) {
            $form->time('start_time', __('Start time'))->default(date('H:i:s'))->required();
            $form->time('end_time', __('End time'))->default(date('H:i:s'))->required();
            $form->time('block_start_time', __('Block Start time'));
//                ->format('hh:mm:ss');
            $form->time('block_end_time', __('Block End time'));
//                ->format('hh:mm:ss');
            $form->number('time_interval', __('Time interval'))->min(1)->required();
            $form->number('block_limit', __('Block limit'))->min(1)->required();
        })->tab('Appointment Dates', function ($form) {
            $form->table('disabled_appointment_dates', function ($table) {
                $table->date('appointment_date');
            });
        })->tab('Terms & Condition', function ($form) {
            $form->summernote('terms_and_condition', __('Terms and Condition'))->required();
        });

//        $form->saving(function (Form $form) {
//            $locationLog = LocationLog::where('location_id', $form->model()->id)->orderBy('id', 'desc')->first();
//            if ($locationLog && $locationLog->terms_and_condition != $form->model()->terms_and_condition) {
//                LocationLog::create([
//                    'terms_and_condition' => $form->model()->terms_and_condition,
//                    'location_id' => $form->model()->id,
//                    'created_at' => date('Y-m-d h:i:s')
//                ]);
//            }else {
//                if($locationLog == null){
//                    LocationLog::create([
//                        'terms_and_condition' => $form->model()->terms_and_condition,
//                        'location_id' => $form->model()->id,
//                        'created_at' => date('Y-m-d h:i:s')
//                    ]);
//                }
//            }
//        });

        return $form;
    }
}
