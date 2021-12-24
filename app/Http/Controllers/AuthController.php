<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {

       $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'


        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $result = $user->save();
        if ($result) {

            $token = $user->createToken('myapptoken')->plainTextToken;


            $responseData['token'] = $token;
            $responseData['error'] = false;
            $responseData['user'] = $user;
            $responseData['message'] = 'data has been saved';

        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'data has not saved';
        }

        return response()->json($responseData);
       // return response($response, 201);
    }

    public function login(Request $request) {
        $rules = array(
            'phone' => 'required|string',
            'password' => 'required|string'
        );
        $messsages = array(
            'phone.required'=>'You cant leave phone field empty',
            'password.required'=>'You cant leave password field empty',
//            'name.min'=>'The field has to be :min chars long',
        );
        $fields = $request->validate($rules,$messsages);
      /*  $fields = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string'
        ]);*/
        // Check email
        $user = User::where('phone', $fields['phone'])->first();
if ($user==null){
    $responseData['error'] = true;
    $responseData['message'] = 'عفواً هذا الرقم غير مسجل';

    return response()->json($responseData);
    /*return response([
        'error' => true,
        'message' => 'عفواً هذا الرقم غير مسجل'
    ], 401);*/
}
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
             $responseData['error'] = true;
            $responseData['message'] = 'كلمة المرور غير صحيحة';

            return response()->json($responseData);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $responseData['error'] = false;
        $responseData['user'] = $user;
        $responseData['token'] = $token;

        return response()->json($responseData);

    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
