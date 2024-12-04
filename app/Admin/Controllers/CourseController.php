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
use Illuminate\Support\Facades\Log;

class CourseController extends AdminController
{
    // protected function grid(){
    //     $grid = new Grid(new Course());


    //     return $grid;
    // }
    
    // protected function detail($id)
    // {
    //     $show= new Show(Course:: findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('title', __('Category'));
    //     $show->field('description', __('description'));
    //     $show->field('order', __('Order'));
        
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));


    //     // $show->disableActions();
    //     // $show->disableCreateButton();
    //     // $show->disableExport();
    //     // $show->disableFilter();

    //     return $show;
    // }

    /**
     * @return Grid
     */
    protected function grid(){
        $grid = new Grid(new Course());
        //fist argument is the database field
        
        $grid->column('id', __('Id'));
        $grid->column('user_token', __('Teacher'))->display(function ($token) {
            // Fetch the teacher's name based on the user token
            return User::where('token', '=', $token)->value('name');
        });


        

        //$grid->column('user_token', __('Teacher'));
        #$grid->column('name', __('Name'));

        
        // $grid->column('thumbnail', __('Thumbnail'));
        $grid->column('thumbnail', __('Thumbnail'))->image('', 50,50);

        // $grid->column('thumbnail', __('Thumbnail'))->display(function ($thumbnail) {
        //     // Remove the extra '/images' part if it exists
        //     $cleanedThumbnail = str_replace('uploads/images/images/', 'uploads/images/', $thumbnail);
        
        //     return $thumbnail;
        // });
        

        // $grid->column('thumbnail', __('Thumbnail'))->display(function ($thumbnail) {
        //     dd($thumbnail);  // Debug the value of $thumbnail
        //     return asset('uploads/images/' . $thumbnail);
        // })->image('', 50, 50);
        
        // $grid->column('thumbnail', __('Thumbnail'))->display(function ($thumbnail) {
        //     // Check if the path is missing 'uploads/images/'
        //     if (strpos($thumbnail, 'uploads/images/') === false) {
        //         dd($thumbnail); 
        //         $thumbnail = 'uploads/images/' . $thumbnail;
        //     }
        //     dd($thumbnail); 
        //     return asset($thumbnail);
        // })->image('', 50, 50);

       
        

        
        
        $grid->column('description', __('Description'));
        $grid->column('type_id', __('Type Id'));
        $grid->column('price', __('Price'));
        $grid->column('lesson_num', __('Lesson Number'));
        $grid->column('video_length', __('Video Length'));
        // $grid->column('follow', __('Follow'));
        // $grid->column('score', __('Score'));
        $grid->column('created_at', __('Created At'));
        // $grid->column('updated_at', __('Updated At'));


        return $grid;
    }

    /**
     * @param mixed $id
     * return Show
     */
    protected function details($id){
        $show = new Show(Course::findOrFail($id));
        





        $show->field('id', __('Id'));
        $show->field('user_token', __('User Token'));
        $show->field('name', __('Name'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('video', __('Video'));
        $show->field('description', __('Description'));
        $show->field('type_id', __('Type Id'));
        $show->field('price', __('Price'));
        $show->field('lesson_num', __('Lesson Number'));
        $show->field('video_length', __('Video Length'));
        $show->field('follow', __('Follow'));
        $show->field('score', __('Score'));
        $show->field('created_at', __('Created At'));
        $show->field('updated_at', __('Updated At'));



        
        

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
