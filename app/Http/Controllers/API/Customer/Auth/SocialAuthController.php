<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // try {
        //     $isCustomerExist = Customer::where('email', $providerUser->email)->first();
        //     $password = 'password@bG193zzYRmLIliaDhQLdBB&&ABlbZ)##Xges6vN4hSFcXoM6oh@';
        //     if (!$isCustomerExist) {
        //         DB::beginTransaction();
        //         $customer = Customer::create([
        //             'name' =>  $providerUser->name,
        //             'email' => $providerUser->email,
        //             'password' => Hash::make($password),
        //         ]);
        //         DB::table('auth_providers')->insert([
        //             'customer_id' => $customer->id,
        //             'provider' => $provider,
        //             'provider_user_id' => $providerUser->id,
        //             'provider_token' => $providerUser->token,
        //         ]);
        //         DB::commit();

        //         return $this->respondWithToken($customer->email, $password);
        //     } else {
        //         // If the user already exists, you might want to log them in
        //         return $this->respondWithToken($isCustomerExist->email, $password);
        //     }
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->json([
        //         'message' => 'An error occurred while processing your request.',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
    }

    private function respondWithToken($email, $password)
    {
        $token =  auth('customer')->attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => '1d'
        ]);
    }
}
