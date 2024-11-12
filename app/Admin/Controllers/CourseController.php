<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;

class CourseController extends AdminController
{
    protected function grid(){
        $grid = new Grid(new Course());


        return $grid;
    }
    
    protected function detail($id)
    {
        $show= new Show(Course:: findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Category'));
        $show->field('description', __('description'));
        $show->field('order', __('Order'));
        
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));


        // $show->disableActions();
        // $show->disableCreateButton();
        // $show->disableExport();
        // $show->disableFilter();

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Course());
        $form->text('name', __('Name'));
        $result = CourseType::pluck('title', 'id');
        dd($result);
        $form->select('parent_id', __('Parent Category'))->options((new CourseType())::selectOptions());
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->number('order', __('Order'));    

        return $form;
    }

}
