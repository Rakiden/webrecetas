<?php

use Illuminate\Support\Facades\Route;
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
    return redirect('index');
});
Route::get('index','App\Http\Controllers\RecipeController@getIndex');
Route::post('index','App\Http\Controllers\RecipeController@getIndex');
Route::get('panel','App\Http\Controllers\RecipeController@getPanel')->middleware('auth');
Route::post('panel','App\Http\Controllers\RecipeController@getPanel')->middleware('auth');
Route::get('creation','App\Http\Controllers\RecipeController@getcreateRecipe')->middleware('auth');
Route::post('create','App\Http\Controllers\RecipeController@createRecipe')->middleware('auth');
Route::post('myrecipe/{id}','App\Http\Controllers\RecipeController@getupdateRecipe')->middleware('auth');
Route::post('update/{id}','App\Http\Controllers\RecipeController@updateRecipe')->middleware('auth');
Route::post('delete/{id}','App\Http\Controllers\RecipeController@deleteRecipe')->middleware('auth');
Route::get('recipe/{id}','App\Http\Controllers\RecipeController@getRecipe');
Route::post('comment/{recipe_id}','App\Http\Controllers\RecipeController@insertComment')->middleware('auth');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout', function () {
    return view('index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
