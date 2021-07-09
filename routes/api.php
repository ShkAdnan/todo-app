<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//All the routes without JWT Token
Route::post('/login',    [AuthController::class, 'authToken']);
//Register New User
Route::post('/register', [AuthController::class, 'register']);
//Verify Account 
Route::post('/verify',   [AuthController::class, 'verifyAccount']);

Route::group(['middleware' => 'JwtToken'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('/logout', [AuthController::class, 'remove']);

    Route::group(['prefix' => 'todo'], function(){
        
        Route::get('/',       [TodoController::class, 'todoList']);
       
        Route::post('/',    [TodoController::class, 'createTodo']);
        
        Route::post('/edit',   [TodoController::class, 'editTodo']);
       
        Route::post('/update', [TodoController::class, 'updateTodo']);
        
        Route::post('/delete', [TodoController::class, 'deleteTodo']);
    });
});

//Http Exception
Route::any('{path}', function() {
    return response()->json([
        'status'        => 'error',
        'statusMessage' => 'Route not found',
        'httpCode'      => '404',
        'errorCode'     => '9002',
        'response'      => ''
    ], 404);
})->where('path', '.*');