<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Actions\Mail\Otp;
use Illuminate\Http\Request;
use App\Models\Otp as OtpModel;
use Illuminate\Validation\Rule;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function Register(Request $request, Otp $otp)
    {
        try {
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email', Rule::unique(User::class)],
                'password' => ['required', Password::min(8)->mixedCase()],
                'repassword' => ['required', 'same:password', Password::min(8)->mixedCase()],
            ];

            $validation = Validator::make(
                data: $request->all(),
                rules: $rules,
            );

            if ($validation->fails()) {
                return ResponseFormatter::error(
                    data: [
                        'error' => array_values($validation->errors()->all()),
                    ],
                    message: 'Invalid validation',
                    code: 406,
                );
            }

            $otp->send(request: $request);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return ResponseFormatter::success(
                data: null,
                message: 'Success Register',
            );

        } catch (Exception $error) {
            return ResponseFormatter::error(
                data: [
                    'message' => "Something went wrong",
                    'error' => $error,
                ],
                message: "Authentication Failed",
                code: 500,
            );
        }
    }

    public function Login(Request $request)
    {
        try {
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ];

            $validation = Validator::make(
                data: $request->all(),
                rules: $rules,
            );

            if ($validation->fails()) {
                return ResponseFormatter::error(
                    data: [
                        'error' => array_values($validation->errors()->all()),
                    ],
                    message: 'Invalid validation',
                    code: 406,
                );
            }

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error(
                    data: null,
                    message: 'Autentication Failed',
                    code: 500,
                );
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception("Invalid Credential");
            }

            if ($user->email_verified_at) {
                $email_verified_status = TRUE;
                $tokenResult = $user->createToken('authToken', ['*'])->plainTextToken;
            } else {
                $email_verified_status = FALSE;
                $tokenResult = null;
            }

            return (new UserResource($user))->additional(
                [
                    'meta' =>[
                        'code' => '200',
                        "message" => "Authenticated"
                    ],
                    'data'=>[
                        'access_token' => $tokenResult,
                        'token_type' => "Bearer",
                        'email_verified_status' => $email_verified_status,
                    ]
                ]
            );

        } catch (Exception $error) {
            return ResponseFormatter::error(
                data: [
                    'message' => "Something went wrong",
                    'error' => $error,
                ],
                message: "Authentication Failed",
                code: 500,
            );
        }
    }

    public function OtpSubmit(Request $request)
    {
        $rules=[
            'email'=>['required','email','exists:users,email'],
            'code'=>['required'],
        ];

        $validation= Validator::make(
            data: $request->all(),
            rules: $rules,
        );
        
        if ($validation->fails()) {
            
            return ResponseFormatter::error(
                data: [
                    'error' => array_values($validation->errors()->all()),
                ],
                message: 'Invalid validation',
                code: 406,
            );

        }

        if ($Otp = OtpModel::where('email',$request->email)->first()) {
            if ($Otp->expired_date >= Carbon::now()) {

                if ($Otp->code == $request->code) {
                    $user=User::where('email',$request->email)->first();
                    $user->update([
                        'email_verified_at' => Carbon::now(),
                    ]);
        
                    $tokenResult=$user->createToken('authToken',['*'])->plainTextToken;
                    
                    $Otp->delete();

                    return (new UserResource($user))->additional(
                        [
                            'meta' =>[
                                'code' => '200',
                                "message" => "OTP Submited"
                            ],
                            'data'=>[
                                'access_token' => $tokenResult,
                                'token_type' => "Bearer",
                                'email_verified_status' => true,
                            ]
                        ]
                    );

                }else {
                    return ResponseFormatter::error(
                        data:null,
                        message: 'OTP Does Not Match',
                        code:500,
                    );
                }

            }else {
                return ResponseFormatter::error(
                    data:null,
                    message: 'OTP Expired',
                    code:500,
                );
            }
        }else {
            return ResponseFormatter::error(
                data:null,
                message: 'OTP Not Found',
                code:500,
            );
        }
    }

    public function OtpResend(Request $request, Otp $otp)
    {
        try {
            $rules=[
                'email'=>['required','email','exists:otps,email'],
            ];

            $validation= Validator::make(
                data: $request->all(),
                rules: $rules,
            );
            
            if ($validation->fails()) {
                
                return ResponseFormatter::error(
                    data: [
                        'error' => array_values($validation->errors()->all()),
                    ],
                    message: 'Invalid validation',
                    code: 406,
                );

            }

            $otp->send($request);

            return ResponseFormatter::success(
                data: null,
                message: 'OTP Success Resend',
            );
        } catch (Exception $error) {
            return ResponseFormatter::error(
                data: [
                    'message'=>"Something went wrong",
                    'error'=>$error,
                ],
                message: "Resend OTP Failed",
                code: 500,
            );
        }
    }

    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(
            data: null,
            message: 'Token Revoked',
        );
    }
}
