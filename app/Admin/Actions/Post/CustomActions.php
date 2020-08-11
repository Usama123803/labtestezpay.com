<?php

namespace App\Admin\Actions\Post;

class CustomActions extends \Encore\Admin\Grid\Displayers\Actions
{
  protected function renderEdit()
  {
    return '
            <a href="'.$this->getResource().'/'.$this->getKey().'/edit" class="btn btn-xs btn-default">
                <i class="fa fa-edit"></i> Edit
            </a>';
    }

    protected function renderView()
    {
        return '
            <a href="'.$this->getResource().'/'.$this->getRouteKey().'" class="btn btn-xs btn-primary {$this->grid->getGridRowName()}-view">
                <i class="fa fa-eye"></i> View
            </a>';
    }

    protected function renderDelete()
    {
        parent::renderDelete();

        return '
            <a href="javascript:void(0);" data-id="'.$this->getKey().'" class="grid-row-delete btn btn-xs btn-danger">
                <i class="fa fa-trash"></i> Remove
            </a>';
    }
}
