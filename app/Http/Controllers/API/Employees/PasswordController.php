<?php

namespace App\Http\Controllers\API\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ConfirmOTPRequest;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Http\Requests\API\ResetPasswordRequest;
use App\Mail\SendOtp;
use App\Models\Employee;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Swift_TransportException;

class PasswordController extends Controller
{
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $employee = Employee::where('email', $request->email)->first();
        if ($employee->status == '0') {
            return response()->json([
                'status' => 'failed',
                'message' => __('lang.inactive'),
            ], 422);
        }
        $otp = rand(1000, 9999);
        $token = Str::random(60);
        $employee->otps()->create([
            'token' => $token,
            'otp' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);



        try {
            Mail::to($employee->email)->send(new SendOtp($otp));
        } catch (Swift_TransportException $exception) {
            Log::error($exception->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => __('lang.otp_sent'),
        ]);
    }

    public function confirmOTP(ConfirmOTPRequest $request)
    {
        $otp = $request->otp;
        $otpRecord = Otp::where('otp', $otp)
            ->where('expired_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'status' => 'failed',
                'message' => __('lang.invalid_otp'),
            ], 422);
        }

        $client = $otpRecord->employee;
        $clientTokent = Auth::guard('employee')->login($client);

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $clientTokent,
                'otp' => $otpRecord,
            ],
        ], 200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        $otp = auth('employee')->user()->otps()->where('token', $request['token'])
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => 'failed',
                'message' => __('lang.invalid_token'),
            ], 422);
        }

        $otp->delete();
        auth('employee')->user()->update([
            'password' => $request->new_password
        ]);
        return response()->json([
            'status' => 'success',
            'message' => __('lang.updated'),
            'data' => auth('employee')->user(),
        ], 200);
    }
}
