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

Route::get('/', 'HomeController@index'); //Mise en place du controller
Route::get('/details/{id}', 'HomeController@details'); //Création d'une route pour la page Details avec l'id de l'application
Route::post('/applications/new', 'HomeController@newapp'); // Route pour l'envois de données via le formulaire concernant l'ajout de nouvelles applications
