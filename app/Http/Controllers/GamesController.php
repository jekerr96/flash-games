<?php

namespace App\Http\Controllers;

use App\Games;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function detail(Request $request, $id) {
        $game = Games::query()->where("id", $id)->first();

        if (!$game) abort(404);

        return view("index.game", ["pageType" => "game", "game" => $game]);
    }
}
