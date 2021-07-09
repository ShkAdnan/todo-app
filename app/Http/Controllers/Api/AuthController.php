<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RepeatedRespository;
use Illuminate\Support\Facades\Mail;
use Hash;
use App\Models\User;
use App\Mail\verificationMail;

class AuthController extends Controller
{
    protected  $repeatedRespository;


    public function __construct(RepeatedRespository $repeatedRespository){
        //
        $this->repeatedRespository = $repeatedRespository;
    }
     /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authToken(Request $request)
    {
        $validator = \Validator::make($request->all(),[ 
            'email'    => 'required|email',
            'password' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        $user = $this->validUser($credentials);

        if($user > 0){
            if ($token = $this->repeatedRespository->guard()->attempt($credentials)) {
                return $this->respondWithToken($token);
            }
        }
        else{
            //Throw Error
            return $this->repeatedRespository->auth();
        }

    }

    /**
     * Register User
    */
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(),[ 
            'email'    => 'required|email',
            'password' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        $user = $this->userExist($credentials);

        if($user > 0){
            return $this->repeatedRespository->response422('User already exists');
        }

        //Creating Verification Code || Generate Six digit Code
        $code = rand(1000000, 9000000);

        $newUser = User::create([
            'name'     => "",
			'email'    => $request->input('email'),
			'password' => Hash::make($request->input('password')),
            'verification_code'  => $code,
            'Active'             => 0
        ]);

        //Send Verifaication Code Through Mail
        $this->sendVerificationCode($request->input('email'),$code);

        return $this->repeatedRespository->response201('Account Created Successfully || Check your email and verify your account');

    }

    /**
     * Verify Account
    */
    public function verifyAccount(Request $request){

        $validator = \Validator::make($request->all(),[ 
            'email' => 'required|email',
            'code'  => 'required',
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }
        $credentials = $request->only('email', 'code');

        $checkUser = $this->checkVerificationCode($credentials);

        if($checkUser > 0){
            return $this->repeatedRespository->response('Account Activated');
        }
        return $this->repeatedRespository->response401('Code Verification Failed');
        
    }

    /**
     * Check User
    */
    private function userExist($credentials){
        $exists = User::where('email', $credentials['email'])->get();
        if($exists->count() > 0){
            return 1;
        }
        return 0;
    }
    private function validUser($credentials){
        $exists = User::where('email', $credentials['email'])->where('Active', '1')->get();
        if($exists->count() > 0){
            return 1;
        }
        return 0;
    }
    private function checkVerificationCode($credentials){
        $exists = User::where('email', $credentials['email'])->where('verification_code', $credentials['code'])->get();
        if($exists->count() > 0){
            User::where('email', $credentials['email'])->where('verification_code', $credentials['code'])->update([
                'Active' => 1
            ]);
            return 1;
        }
        return 0;
    }
    /**
     * Send Mail
    */
    private function sendVerificationCode($email,$code){

      Mail::to($email)->send(new verificationMail($code));
    
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'        => 'success',
            'statusMessage' => 'Token Created',
            'httpCode'      => '200',
            'errorCode'     => '0',
            'response'  =>[
                'access_token'     => $token,
                'token_type'       => 'bearer',
                'expires_in'       => $this->repeatedRespository->guard()->factory()->getTTL() * 60,
                'user_id'          => $this->repeatedRespository->guard()->user()->id
            ]
        ]);
    }

        /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function me()
    {
        return response()->json($this->repeatedRespository->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove()
    {
        $this->repeatedRespository->guard()->logout();

        return $this->repeatedRespository->response('Successfully Logout');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->repeatedRespository->guard()->refresh());
    }
    
}
