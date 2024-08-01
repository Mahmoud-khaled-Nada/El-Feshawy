<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Helpers\Formater;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:customers,email'],
            'phone' => ['required', 'string', 'min:10', 'max:18', 'unique:customers,phone'],
            'password' => ['required', 'string', 'min:3'],
        ];

        $formater = new Formater;

        $validationResponse = $formater->formatValidateRequest($request, $rules);
        if ($validationResponse)  return $validationResponse;

        try {
            Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (!$token = auth('customer')->attempt($validator->validated())) {
            return response()->json(['error' => 'Your email or password is incorrect'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function profile()
    {
        $user =  auth('customer')->user();

        $avatar = DB::table('customers_profile')->where('customer_id', $user->id)->first();
        $user->avatar = $avatar ? $avatar->avatar : null;

        return response()->json($user);
    }

    public function logout()
    {
        auth('customer')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('customer')->factory()->getTTL() * 60,
        ]);
    }
}
