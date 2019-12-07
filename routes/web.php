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
use App\Sections;

Route::get('/', function () {
    $items = Games::query()->paginate(42);
    $sections = Sections::query()->get();
    return view('index.index', ["pageType" => "main", "items" => $items, "sections" => $sections]);
});

Route::get("/section/{section}/{tag?}", "GamesController@section");

//Route::get("/tag/{tag}", "GamesController@tag");

Route::get("/parse/", "ParseController@index");

Route::post("/parse/{page?}", "ParseController@parse");

Route::get("/game/{id}", "GamesController@detail");

Route::get("/edit-genres/", "GenresController@index");

Route::get("/edit-genre/{id}", "GenresController@edit");

Route::post("/edit-genre/", "GenresController@update");

Route::post("/delete-genre/", "GenresController@delete");
