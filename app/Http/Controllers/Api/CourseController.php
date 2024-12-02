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

    public function courseDetail(Request $request)
{
    $id = $request->id;

    try {
        // Fetch course details by ID
        $result = Course::where('id', '=', $id)->select(
            'id',
            'name',
            'user_token',
            'description',
            'thumbnail',
            'lesson_num',
            'video_length',
            'price'
        )->first();

        // Return success response
        return response()->json(
            [
                'code' => 200,
                'msg' => 'My course detail is here',
                'data' => $result
            ],
            200
        );

    } catch (\Throwable $e) {
        // Return error response
        return response()->json(
            [
                'code' => 500,
                'msg' => 'Server internal error',
                'error' => $e->getMessage() // Include error message for debugging
            ],
            500
        );
    }
}

}