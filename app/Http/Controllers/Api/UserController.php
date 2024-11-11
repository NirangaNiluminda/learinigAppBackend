<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    /**
     * @param Request $request
     * @return User
     */
    //

    // public function login(Request $request){

        

    //     try{
    //         $validateUser = Validator::make($request->all(),
            
    //     [
    //         'avatar' => 'required',
    //         'type' => 'required',
    //         'open_id' => 'required',
    //         'name' => 'required',
    //         'email' => 'required',
    //         //'password' => 'required|min:6'
            
    //     ]);

    //     if($validateUser-> fails()){
    //         return response()-> json(
    //             [
    //                 'status' => false,
    //                 'message' => 'Validation failed',
    //                 'errors' => $validateUser->errors()
    //             ], 401 );
            
    //     }

    //     $validated = $validateUser->validate();
    //     $map=[];
    //     //email, phone, google, facebook, apple 
    //     $map['type'] = $validated['type'];
    //     $map['open_id'] = $validated['open_id'];

    //     $user = User::where($map)->first();

    //     //where yser log in or not
    //     if(empty($user->id)){
    //         //this user in the database

    //         $validated['token'] = md5(uniqid().rand(10000,99999));
    //         //user first time created
    //         $validated['created_at'] = Carbon::now();

    //         //encrypted password
    //         //$validated['password'] = Hash::make($validated['password']);

    //         //return the id after saving
    //         $userID = User::insertGetId($validated);
    //         //User all information
    //         $userInfo = User::where('id', '=', $userID)->first();

    //         $accessToken = $userInfo->createToken(uniqid())->plainTextToken;

    //         $userInfo -> access_token = $accessToken;

    //         User::where('id', '=', $userID)->update(['access_token' => $accessToken]);
    //         return response()-> json([
    //             'code' => 200,
    //             'mgs' => 'User Created Successfully',
    //             'data' => $userInfo
    //         ],200);

    //     }
    //     //User previously logged in
        


    //     $accessToken = $user->createToken(uniqid())->plainTextToken;
    //     $user ->access_token = $accessToken;
    //     User::where('open_id', '=', $validated['open_id'])->update(['access_token' => $accessToken]);

    //     // $user = User:: create([
    //     //     'name' => $request->name,
    //     //     'email' => $request->email,
    //     //     'password' => Hash::make($request->password)
    //     // ]);

    //     return response()-> json([
    //         'codes' => 200,
    //         'msg' => 'User Created Successfully',
    //         'data' => $user
    //     ],200);

    //     }catch(\Throwable $th){
    //         return response()-> json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ],500);
    //     }
    // }



    // public function login(Request $request) {
    //     try {
    //         // Validate incoming request
    //         $validateUser = Validator::make($request->all(), [
    //             'avatar' => 'required',
    //             'type' => 'required',
    //             'open_id' => 'required',
    //             'name' => 'required',
    //             'email' => 'required|email',
    //         ]);
    
    //         if ($validateUser->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validation failed',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }
    
    //         // Validate and retrieve the validated data
    //         $validated = $validateUser->validate();
            
    //         // Search for an existing user by `open_id` and `type`
    //         $user = User::where('open_id', $validated['open_id'])
    //                      ->where('type', $validated['type'])
    //                      ->first();
    
    //         // If user does not exist, create a new one
    //         if (!$user) {
    //             $validated['token'] = md5(uniqid() . rand(10000, 99999));
    //             $validated['created_at'] = Carbon::now();
    
    //             // Insert new user and retrieve the inserted record
    //             $userID = User::insertGetId($validated);
    //             $user = User::find($userID);
    
    //             $accessToken = $user->createToken(uniqid())->plainTextToken;
    //             $user->access_token = $accessToken;
    
    //             // Update user with access token
    //             User::where('id', $userID)->update(['access_token' => $accessToken]);
    
    //             return response()->json([
    //                 'code' => 200,
    //                 'msg' => 'User Created Successfully',
    //                 'data' => $user
    //             ], 200);
    //         }
    
    //         // User exists: update access token for existing user
    //         $accessToken = $user->createToken(uniqid())->plainTextToken;
    //         $user->access_token = $accessToken;
    
    //         // Save access token to database
    //         User::where('id', $user->id)->update(['access_token' => $accessToken]);
    
    //         return response()->json([
    //             'code' => 200,
    //             'msg' => 'User Logged In Successfully',
    //             'data' => $user
    //         ], 200);
    
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }



    // /**
    //  * @param Request $request
    //  * @return User
    //  */

    //  public function loginUser(Request $request){
    //     try{
    //         $validateUser = Validator::make($request->all(),
    //         [
    //             'email' => 'required|email',
    //             'password' => 'required'
    //         ]);

    //         if($validateUser->fails()){
    //             return response()-> json(
    //                 [
    //                    'status' => false,
    //                    'message' => 'Validation failed',
    //                     'errors' => $validateUser->errors()
    //                 ], 401 );
    //         }

    //         if(!Auth::attempt($request-> only (['email', 'password']))){
    //             return response()-> json([
    //                 'status' => false,
    //                'message' => 'Email and password are not march with our records',
    //             ], 401);
    //         }

    //         $user = User::where('email', $request->email)->first();
    //         return response()-> json([
    //             'status' => true,
    //             'message' => 'User Logged In Successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ],200);


    //     }
    //     catch(\Throwable $th){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ],500);
    //     }
    //  }

















    public function login(Request $request)
    {
        try {
            // Validate incoming request
            $validateUser = Validator::make($request->all(), [
                'avatar' => 'required',
                'type' => 'required',
                'open_id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
            ]);
    
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            // Retrieve validated data
            $validated = $validateUser->validated();
    
            // Check if the user already exists by email
            $existingUser = User::where('email', $validated['email'])->first();
    
            if (!$existingUser) {
                // If no user exists with this email, create a new one
                $validated['created_at'] = Carbon::now();
                $validated['updated_at'] = Carbon::now();
    
                // Check if user already exists with open_id and type
                $user = User::where('open_id', $validated['open_id'])
                            ->where('type', $validated['type'])
                            ->first();
    
                if (!$user) {
                    // Create new user
                    $user = User::create($validated);
    
                    // Generate access token
                    $accessToken = $user->createToken('YourAppName')->plainTextToken;
                    $user->access_token = $accessToken;
    
                    // Save the access token in the database
                    $user->save();
    
                    return response()->json([
                        'code' => 200,
                        'msg' => 'User Created Successfully',
                        'data' => $user
                    ], 200);
                }
    
                return response()->json([
                    'status' => false,
                    'message' => 'User already exists with the provided open_id and type',
                ], 400);
            }
    
            // If the user exists, update the access token for login
            $accessToken = $existingUser->createToken('YourAppName')->plainTextToken;
            $existingUser->access_token = $accessToken;
    
            // Save the updated access token
            $existingUser->save();
    
            return response()->json([
                'code' => 200,
                'msg' => 'User Logged In Successfully',
                'data' => $existingUser
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    

}
