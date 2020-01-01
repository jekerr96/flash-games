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
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $q = $request->get("q");

    $query = Games::query();

    if ($q) {
        $query->where("name", "like", "%$q%");
    }

    $order = Games::getSort($request);
    $query->orderBy($order[0], $order[1])->orderBy("created_at", "desc");

    $items = $query->paginate(42);
    $sections = Sections::query()->get();
    return view('index.index', ["pageType" => "main", "items" => $items, "sections" => $sections, "sort" => true]);
});

Route::get("/section/{section}/{tag?}", "GamesController@section");

Route::get("/parse/", "ParseController@index");

Route::post("/parse/{page?}", "ParseController@parse");

Route::get("/game/{id}", "GamesController@detail");

Route::get("/edit-genres/", "GenresController@index");

Route::get("/create-genre/", "GenresController@create");

Route::get("/edit-genre/{id}", "GenresController@edit");

Route::post("/edit-genre/", "GenresController@update");

Route::post("/delete-genre/", "GenresController@delete");

Route::get("/edit-game/{id}", "GamesController@edit");

Route::get("/create-game/", "GamesController@create");

Route::post("/edit-game/", "GamesController@save");

Route::get("/delete-game/{id}", "GamesController@delete");

Route::get("/empty-games/", "GamesController@listEmpty");

Route::get("/history/", "HistoryController@index");

Route::post("/favorites", "FavoritesController@toggle");

Route::get("/favorites", "FavoritesController@index");
