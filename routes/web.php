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

use App\Games;

Route::get('/', function () {
    $items = Games::query()->paginate();
    return view('index.index', ["pageType" => "main", "items" => $items]);
});

Route::get("/parse/", "ParseController@index");

Route::post("/parse/{page?}", "ParseController@parse");

Route::get("/game/{id}", "GamesController@detail");
