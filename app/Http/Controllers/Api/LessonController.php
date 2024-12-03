<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //
    public function lessonList(Request $request){
        $id = $request->id;

    try {
        // Fetch course details by ID
        $result = Lesson::where('course_id', '=', $id)->select(
            'id',
            'name',
            
            'description',
            'thumbnail',
            'video',
            
            
        )->get();

        // Return success response
        return response()->json(
            [
                'code' => 200,
                'msg' => 'My lesson list is here',
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





    public function lessonDetails(Request $request){
        $id = $request->id;

    try {
        // Fetch course details by ID
        $result = Lesson::where('id', '=', $id)->select(
            
            'name',
            
            'description',
            'thumbnail',
            'video',
            
            
        )->get();

        // Return success response
        return response()->json(
            [
                'code' => 200,
                'msg' => 'My lesson details is here',
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
