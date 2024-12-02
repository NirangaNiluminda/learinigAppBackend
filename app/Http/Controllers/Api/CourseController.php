<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

Class CourseController extends Controller
{
   
    //return all the courses list
    public function courseList(){

        // select the fields
        $result = Course::select('name','thumbnail', 'lesson_num', 'price', 'id')->get();


        return response()->json([
            'code'=>200,
            'msg'=>'MY course list is here',
            'data'=> $result
        ],200);
    }

}