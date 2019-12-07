<?php

namespace App\Http\Controllers;

use App\Games;
use App\Sections;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function detail(Request $request, $id) {
        $game = Games::query()->where("id", $id)->first();

        if (!$game) abort(404);

        $sections = Sections::query()->get();

        return view("index.game", ["pageType" => "game", "game" => $game, "sections" => $sections]);
    }

    public function section($section, $tag = null) {
        $sectionItem = Sections::query()->where("url", $section)->first();

        if (!$sectionItem) {
            abort(404);
        }

        $items = Games::whereHas("genres", function ($query) use ($sectionItem, $tag) {
           $query->where("section_id", $sectionItem->id);

           if ($tag) {
               $query->where("id", $tag);
           }
        })->paginate(42);
        $genres = $sectionItem->genres()->orderBy("name")->get();
        $sections = Sections::query()->get();
        return view('index.index', ["pageType" => "main", "items" => $items, "sections" => $sections, "genres" => $genres, "tag" => $tag]);
    }

    public function tag($tag) {
        $games = Games::whereHas("genres", function ($query) use ($tag) {
           $query->where("id", $tag);
        })->paginate(42);

        $sections = Sections::query()->get();
        return view('index.index', ["pageType" => "main", "items" => $games, "sections" => $sections]);
    }
}
