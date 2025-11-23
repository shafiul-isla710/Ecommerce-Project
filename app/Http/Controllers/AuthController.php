<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SentoptRequest;

class AuthController extends Controller
{
    
    public function sentOtp(SentoptRequest $request)
    {
        try{
            $request->validated();

            $user = User::where('email',$request->email)->first();
           
            if($user != null && $user->name != $request->name){
                $user->name = $request->name;
                $user->save();
            }
            $otp = rand(100000,999999);
            if(!$user){
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'otp'=>$otp,
                ]);
                Mail::raw('Your OTP is '.$otp, function($message) use ($request){
                    
                    $message->to($request->email);
                    $message->subject('OTP');
                });
                return $this->success([],'User create and otp sent successfully');
            }
            else{
                $user->otp = $otp;
                $user->save();
                Mail::raw('Your OTP is '.$otp, function($message) use ($request){
                    $message->to($request->email);
                    $message->subject('OTP');
                });
                return $this->success([],'Otp sent successfully');
            }
        }
        catch(\Exception $e){
            Log::error('Sent otp error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try{
            $request->validated();
            $user = User::where('otp',$request->otp)->first();
            
            if($user){
                $user->update([
                    'otp'=>null,
                ]);
                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->success(['token'=>$token],'Login successfully');
            }
            else{
                return $this->error('Invalid otp');
            }
        }
        catch(\Exception $e){
            Log::error('Login error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }


    public function logout(Request $request){
        try{
            $user = auth()->user();
            $user->tokens()->delete();
            return $this->success([],'Logout successfully');
        }
        catch(\Exception $e){
            Log::error('Logout error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }

}
