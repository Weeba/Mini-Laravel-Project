<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::auth();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('home/{category}', 'HomeController@category');
Route::get('user/{id}', 'ProfileController@show');
// Route::get('answers/{id}', 'ProfileAnswerController@show');
Route::resource('question', 'QuestionsController'); 
Route::resource('profile', 'ProfileController');   
Route::resource('user', 'UsersController');
Route::resource('answer', 'AnswersController');
Route::resource('question.question_vote', 'QuestionVotesController');
Route::resource('answer.answer_vote', 'AnswerVotesController');
