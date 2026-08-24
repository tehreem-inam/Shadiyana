<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendOtpRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    public function verify(VerifyOtpRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Verification service is not configured yet.',
        ], 501);
    }

    public function resend(ResendOtpRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Verification service is not configured yet.',
        ], 501);
    }
}