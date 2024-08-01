<?php

namespace App\Http\Controllers\API\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateProfileRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $input = $request->input('email') ?? $request->input('phone');
        $fieldType = $request->input('email') ? 'email' : 'phone';


        $credentials = [
            $fieldType => $input,
            'password' => $request->input('password'),
            'code' => $request->input('code'),
        ];


        if (!$token = auth('employee')->attempt($credentials)) {
            return response()->json([
                'status' => 'failed',
                'message' => __('auth.failed'),
            ], 422);
        } else if (auth('employee')->user()->status == '0') {
            return response()->json([
                'status' => 'failed',
                'message' => __('lang.inactive'),
            ], 422);
        } else {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => auth('employee')->user(),
                    'token' => $token
                ],
            ], 200);
        }
    }

    public function profile()
    {
        return response()->json([
            'status' => 'success',
            'data' =>  auth('employee')->user(),
        ], 200);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        auth('employee')->user()->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => __('lang.updated'),
            'data' => auth('employee')->user(),
        ], 200);
    }


    public function logout()
    {
        auth('employee')->user()->fcm_token = NULL;
        auth('employee')->user()->save();
        auth('employee')->logout();


        return response()->json([
            'status' => 'success',
            'message' => __('lang.success'),
        ], 200);
    }

    public function updateFCMToken(Request $request)
    {
        auth('employee')->user()->update([
            'fcm_token' =>  $request->fcm_token ?? NULL,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('lang.success'),
            'data' => auth('employee')->user(),
        ], 200);
    }
}
