<?php

namespace App\Services;
use App\Models\User;
use App\Models\OtpAttempt;
use App\Events\CheckOTpEvent;
use App\Events\SendMessageEvent;
use App\Events\LoginOrSignupEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function CreateUser($validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();
        if($user)
        return response()->json([
            "This email is used before"], 401);
            else
        $user = User::updateOrCreate($validatedData);
        event(new LoginOrSignupEvent($user->email, "Signed Up"));
        return response()->json([
            "Check Your Email Address"], 201);

    }


    public function LoginUser($validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();
        if ($user) {
                event(new CheckOTpEvent($user->email, "Your code is: " ,$this->generateOtp($user)));
                return response()->json([
                    "Check Your Email Address"], 201);
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function generateOtp(User $user)
    {
        $otp = strval(random_int(100000, 999999));
        OtpAttempt::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expiry_time' => now()->addMinutes(30),
        ]);
        return $otp;

    }



    public function checkOtp($validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();
        $enteredOtp = $validatedData['otp'];
        $otpAttempt = OtpAttempt::where('user_id', $user->id)
            ->where('otp', $enteredOtp)
            ->where('expiry_time', '>', now())
            ->first();

        if ($otpAttempt) {
            $token = $user->createToken('API TOKEN')->plainTextToken;
            event(new SendMessageEvent($user, 'hi'));
            $otpAttempt->delete();
            return response()->json([$user->email , $token],201);

                        }
        else {
           return response()->json(["invalid"],201);;
            }
    }



}
