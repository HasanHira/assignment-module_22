<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // User View Pages Method
    function LoginPage(Request $request):View{
        return view('pages.auth.login-page');
    }
    function RegistrationPage(Request $request):View{
        return view('pages.auth.registration-page');
    }

    // User API Routes Method
    function RegisterUser(Request $request){

        try{
            User::create([
                'name' =>$request->input('name'),
                'email' =>$request->input('email'),
                'phone' =>$request->input('phone'),
                'password' =>$request->input('password')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User Regestered Successfully'
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong'
            ]);
        }

    }

    function LoginUser(Request $request){
        $count = User::where('email', '=', $request->input('email'))
        ->where('password', '=', $request->input('password'))
        ->select('id')->first();

        if($count !== null){
            // Issue Token
            $token = JWTToken::CreateToken($request->input('email'), $request->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Loged In Successful'
            ])->cookie('token', $token, 60*60*24);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' => 'unathorized'
            ]);
        }
    }

    function ProfileUser(Request $request){
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ]);
    }

    function LogoutUser(Request $request){
        return redirect('/user-login')->cookie('token', '', -1);
    }

}
