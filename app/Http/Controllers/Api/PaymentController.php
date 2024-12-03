<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Stripe\Webhook;
use Stripe\Customer;
use Stripe\price;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Exception\SignatureVerificationException;

class PaymentController extends Controller
{
    //
    public function checkouts(Request $request){
        try{
            //this the user by cousrse id
        $courseId = $request->id;
        $user = $request->user();
        $token = $user->token;

        //key stripe key

        Stripe::setApiKey(
            "sk_test_51PVBInP195CKm0dBLnZrNZoau3q01EUK5bKd8yUKmrF5iIhGnLqfPk0Gh6Ky1PiVKMdBzJYzh3stz45UdEzyx3O500oyFMV3jw"
        );


        $searchCourse = Course::where('id','=', $courseId)->first();

        if(empty($searchCourse)){
            return response()->json(
                [
                    'code' => 200,
                    'msg' => 'No course found',
                    'data' => ""
                ],
                200
            );
        }

        $orderMap = [];
        $orderMap['course_id'] = $courseId;
        $orderMap['user_token'] = $token;
        $orderMap["status"]= 1;  // successful order
        $orderRes = Order::where($orderMap)->first();

        if(!empty($orderRes)){
            return response()->json(
                [
                    'code' => 200,
                    'msg' => 'You have already ordered this course',
                    'data' => ""
                ],
                200
            );
        }

        

        $your_domain = env('APP_URL');
        $map = [];
        $map['user_token']= $token;
        $map['course_id']= $courseId;
        $map['total_amount']= $searchCourse->price;
        $map['status']= 0;

        $map['created_at'] = Carbon::now();

        

        $orderNum = Order::insertGetId($map);

        $checkOutSession = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => $searchCourse->name,
                        'description' => $searchCourse->description
                    ],
                    'unit_amount' => intval(($searchCourse->price)*100)
                ],
                'quantity' => 1,
            ]],
            'payment_intent_data' => [
                'metadata'=> ['order_num'=>$orderNum, 'user_token'=>$token],

            ],
            'metadata'=> ['order_num'=>$orderNum, 'user_token'=>$token],
            'mode'=>'payment',
            'success_url'=>$your_domain.'success',
            'cancel_url'=>$your_domain.'cancel',
        ]);

        return response()->json(
            [
                'code' => 200,
                'msg' => 'Order has been Placed',
                'data' => $checkOutSession->url
            ],
            200
        );

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function webGoHooks(){
        Log::info("Start Here...");
        Stripe::setApiKey('sk_test_51PVBInP195CKm0dBLnZrNZoau3q01EUK5bKd8yUKmrF5iIhGnLqfPk0Gh6Ky1PiVKMdBzJYzh3stz45UdEzyx3O500oyFMV3jw');
        $endPointSecret = 'whsec_DI4IrHM2NDGnXkUypA1xFbFu6aLtmkFG';
        $payload =  @file_get_contents('php://input'); 

        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        Log::info("SET up buffer and Handshake Done...");

        try{
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endPointSecret
            );

        }catch(\UnexpectedValueException $e){
            Log::info('UnexpectedValueException '.$e);
            http_response_code(400);
            exit();
        }catch(\Stripe\Exception\SignatureVerificationException $e){
            Log::info('SignatureVerificationException '.$e);
            http_response_code(400);
            exit();
        }


        if($event->type=="charge.succeeded"){
            $session = $event->data->object;
            $metadata = $session["metadata"];
            $orderNum = $metadata->order_num;
            $userToken = $metadata->user_token;
            Log::info('order id'.$orderNum);
            $map = [];
            $map['status']=1;
            $map['updated_at']= Carbon::now();
            $whereMap['user_token'] = $userToken;
            $whereMap['id']= $orderNum;
            Order::where($whereMap)->update($map);
        }

        http_response_code(200);

    }

}
