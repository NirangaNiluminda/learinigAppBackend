<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api;
use Illuminate\Http\Request;

Class CourseController extends Controller
{

    public function courseList(){
        return response()->json([
            'code'=>200,
            'msg'=>'MY course list is here',
            'data'=> "data is available"
        ],200);
    }

}