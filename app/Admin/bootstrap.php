<?php

use Encore\Admin\Admin;
use Encore\Admin\Grid\Column;
//use App\Admin\Actions\Post\CustomActions;
//use Encore\Admin\Grid\Displayers\Actions;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
//Column::define('__actions__', CustomActions::class);
Admin::css(asset('assets/css/admin_custom.css'));
Admin::js(asset('assets/js/admin_custom.js'));
