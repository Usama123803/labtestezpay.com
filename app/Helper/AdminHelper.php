<?php
namespace App\Helper;

use App\Admin\Actions\Post\BatchRestore;
use App\Admin\Actions\Post\Restore;
use Carbon\Carbon;
use Encore\Admin\Grid;

class AdminHelper{

    static function trashAndRestore($grid){
        $grid->filter(function($filter) {
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
        });
        $grid->actions (function ($actions) {
            if (\ request('_ scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });
        $grid->batchActions (function($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }
        });

    }

    static function showDateFormat($show, $type = 'created_at', $label = 'Created at'){
        $show->field($type, __($label))->as(function ($field) {
            return Carbon::parse($field)->format('M d Y');
        });
    }

    static function gridDateFormat($grid, $type = 'created_at', $label = 'Created at'){
        $grid->column($type)->display(function ($title) {
            return Carbon::parse($title)->format('M d Y');
        });
    }

    static function displayImage($show, $label = "Image", $fieldName = 'image'){
        $show->field($fieldName, __($label))->image(storage_path().'/');
    }

}
