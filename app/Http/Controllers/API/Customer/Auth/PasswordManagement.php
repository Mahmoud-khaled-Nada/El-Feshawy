<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Mail\SendOtp;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordManagement extends Controller
{

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $customer = Customer::where('email', $request->post('email'))->first();

        if (!$customer) {
            return response()->json(['message' => 'We couldn\'t find an account associated with that email.'], 422);
        }

        try {
            // Generate a unique OTP
            $otp = $this->generateUniqueOtpCode(DB::table('customer_otps'), 'otp');

            DB::table('customer_otps')->insert([
                'customer_id' => $customer->id,
                'otp' => $otp,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(60),
                'used' => false,
            ]);

            // Notify the user (uncomment when notification is set up)
            Mail::to($customer->email)->send(new SendOtp($otp));



            return response()->json(['message' => 'Check your email, please.'], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Verify the OTP code
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:4'
        ]);

        $otp = DB::table('customer_otps')
            ->where('otp', $request->post('otp'))
            ->where('used', false)
            ->first();

        if (!$otp) {
            return response()->json(['message' => 'Invalid OTP.'], 422);
        }

        $current_time = Carbon::now();
        $expires_at = Carbon::parse($otp->expires_at);

        if ($current_time->greaterThan($expires_at)) {
            DB::table('customer_otps')->where('id', $otp->id)->update(['used' => true]);
            return response()->json(['message' => 'OTP has expired.'], 422);
        }

        DB::table('customer_otps')->where('id', $otp->id)->update(['used' => true]);

        $customer = Customer::find($otp->customer_id);

        return response()->json([
            'message' => 'OTP verified.',
            'email' => $customer->email
        ], 200);
    }


    public function resetPassword(Request $request, $email)
    {
        $request->validate([
            'password' => 'required|string|min:3|confirmed',
        ]);

        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            return response()->json(['message' => 'We couldn\'t find an account associated with that email.'], 422);
        }

        $customer->password = Hash::make($request->post('password'));
        $customer->save();

        return response()->json(['message' => 'Password has been reset successfully.'], 200);
    }

    protected function generateUniqueOtpCode($model, $colume_name)
    {
        do {
            $number = random_int(1000, 9999);
        } while ($model->where($colume_name, $number)->exists());

        return $number;
    }
}
