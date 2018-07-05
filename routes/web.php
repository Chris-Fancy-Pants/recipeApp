<?php

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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/new-recipe', 'RecipeController@index');
Route::post('recipe/create', 'RecipeController@create');
Route::post('recipe/update', 'RecipeController@update');
Route::get('recipe/edit/{id}', 'RecipeController@edit');
Route::get('recipe/{id}', 'RecipeController@show');


Route::post('recipe/delete-recipe', 'RecipeController@deleteRecipe');
Route::post('recipe/remove-ingredient', 'RecipeController@removeIngredient');
Route::post('recipe/remove-step', 'RecipeController@removeStep');