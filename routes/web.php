<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\PlayersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $user = User::first();

    $token = $user->createToken('myApi');

    return ['token' => $token->plainTextToken];
   /// return view('welcome');
});

Route::get('importTeam', [PlayersController::class, 'importTeam']);

Route::get('importPlayer', [PlayersController::class, 'importPlayer']);

