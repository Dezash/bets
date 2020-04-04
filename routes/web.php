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
    return view('welcome');
});


Route::resource('employees', 'EmployeesController', [
    'as' => 'employees'
]);
Route::get('/employees/{id}/delete', 'EmployeesController@delete');

Route::resource('users', 'UsersController', [
    'as' => 'users'
]);
Route::get('/users/{id}/delete', 'UsersController@delete');
Route::post('/usersearch', 'UsersController@getUsers')->name('users.search');


Route::resource('payouts', 'PayoutsController', [
    'as' => 'payouts'
]);
Route::get('/payouts/{id}/delete', 'PayoutsController@delete');

Route::resource('sports', 'SportController', [
    'as' => 'sports'
]);
Route::get('/sports/{id}/delete', 'SportController@delete');
Route::post('/sportsearch', 'SportController@getSports')->name('sports.search');

Route::resource('leagues', 'LeagueController', [
    'as' => 'leagues'
]);
Route::get('/leagues/{id}/delete', 'LeagueController@delete');
Route::post('/leaguesearch', 'LeagueController@getLeagues')->name('leagues.search');

Route::resource('teams', 'TeamController', [
    'as' => 'teams'
]);
Route::get('/teams/{id}/delete', 'TeamController@delete');
Route::post('/teamsearch', 'TeamController@getTeams')->name('teams.search');

Route::resource('players', 'PlayerController', [
    'as' => 'players'
]);
Route::get('/players/{id}/delete', 'PlayerController@delete');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
