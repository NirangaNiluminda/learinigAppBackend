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
        //get our catogaries
        //key value pair
        //last one  is the key 
        $result = CourseType::pluck('title', 'id');
        //select method helps you select one of the options the comes from result
        //dd($result);
        $form->select('type_id', __('Category'))->options($result);
        $form->image('thumbnail', __('Thumbnail'))->uniqueName();
        //File is used for video and other format like pdf/doc
        $form->file('video', __('Video'))->uniqueName();
        $form->text('description', __('Description'));
        //decimal method helps with retrieving float format from the database
        $form->decimal('price', __('Price'));
        $form->number('lesson_num', __('Lesson Number'));
        $form->number('video_length', __('Video Length'));
        //for posting, who is posting
        $result = User::pluck('name','token');
        $form->select('user_token',__('Teacher'))->options($result);
        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

        return $form;
        // dd($result);
        // $form->select('parent_id', __('Parent Category'))->options((new CourseType())::selectOptions());
    
        // $form->text('title', __('Title'));
        // $form->textarea('description', __('Description'));
        // $form->number('order', __('Order'));    

    }

}
