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


    public function courseDetails(Request $request){

        $id = $request->id;

        try{
            $result = Course::where('id', '=', $id)->select(
                'id',
                'user_token',
                'description',
                'name',
                'thumbnail' , 
                'lesson_num',
                'video_length',
                'hello_feild',
                'price')->first();

                return response()->json(
                    [
                        'code'=>200,
                       'msg'=>'Course details',
                       'data'=>$result
                    ],200
                );
        }
        catch(\Throwable $e){
            return response()->json(
                [
                    'code'=>200,
                   'msg'=>'Server internal error',
                   'data'=>$e->getMessage()
                ],500
            );
        }
        // $result = Course::select('name','thumbnail', 'lesson_num', 'price', 'id')->get();


        // return response()->json([
        //     'code'=>200,
        //     'msg'=>'MY course list is here',
        //     'data'=> $result
        // ],200);
    }
}