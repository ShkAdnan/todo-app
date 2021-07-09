<?php

namespace App\Repositories;

use App\Repositories\RepeatedRespository;
use Auth;

class RepeatedRespository{

    public function validation($errors){
        return response()->json([
            'status'        => 'error',
            'statusMessage' => 'Validation Error',
            'httpCode'      => '422',
            'errorCode'     => '4001',
            'response'      => $errors
        ],422);
    }
    public function auth(){
        return response()->json([
            'status'        => 'error',
            'statusMessage' => 'Authenication Failed',
            'httpCode'      => '401',
            'errorCode'     => '0',
            'response'      =>  []
        ],401);
    }
    public function response($description){
        return response()->json([
            'status'        => 'success',
            'statusMessage' =>  $description,
            'httpCode'      => '200',
            'errorCode'     => '0',
            'response'      => []
        ]);
    }
    public function response201($description){
        return response()->json([
            'status'        => 'success',
            'statusMessage' =>  $description,
            'httpCode'      => '201',
            'errorCode'     => '0',
            'response'      => []
        ],201);
    }
    public function responseTodo($description,$response){
        return response()->json([
            'status'        => 'success',
            'statusMessage' =>  $description,
            'httpCode'      => '200',
            'errorCode'     => '0',
            'response'      => $response
        ]);
    }
    public function error($description){
        return response()->json([
            'status'        => 'error',
            'statusMessage' =>  $description,
            'httpCode'      => '200',
            'errorCode'     => '0',
            'response'      => []
        ]);
    }
    public function response401($description){
        return response()->json([
            'status'        => 'error',
            'statusMessage' => $description,
            'httpCode'      => '401',
            'errorCode'     => '0',
            'response'      => []
        ],401);
    }
    public function response403(){
        return response()->json([
            'status'        => 'error',
            'statusMessage' => 'Access Forbidden',
            'httpCode'      => '403',
            'errorCode'     => '0',
            'response'      => []
        ],403);
    }
    public function response422($description){
        return response()->json([
            'status'        => 'error',
            'statusMessage' =>  $description,
            'httpCode'      => '422',
            'errorCode'     => '0',
            'response'      => []
        ],422);
    }
    /** 
    * Get the guard to be used during authentication.
    *
    * @return \Illuminate\Contracts\Auth\Guard
    */
    public function guard()
    {
        return Auth::guard();
    }
}

?>