<?php

namespace App\Http\Controllers;

use App\Favorites;
use App\Games;
use App\Genres;
use App\Helper;
use App\History;
use App\Sections;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function detail(Request $request, $id) {
        $game = Games::query()->where("id", $id)->first();

        if (!$game) abort(404);

        if (!$request->session()->get("user.games." . $game->id)) {
            $game->increment("popularity");
            $request->session()->push("user.games." . $game->id, 1);
        }


        $sections = Sections::query()->get();

        History::query()->where("game_id", $game->id)->where(function ($query) use ($request) {
            $token = Helper::getUserToken();
            $ip = $request->ip();
            $query->where("token", $token)->orWhere("ip", $ip);
        })->delete();

        $history = new History();
        $history->ip = $request->ip();
        $history->token = Helper::getUserToken();
        $history->game_id = $game->id;
        $history->save();

        $favorite = Favorites::query()->where("game_id", $id)->where(function ($query) use ($request) {
            $token = Helper::getUserToken();
            $ip = $request->ip();
            $query->where("token", $token)->orWhere("ip", $ip);
        })->get();

        return view("index.game", ["pageType" => "game", "game" => $game, "sections" => $sections, "favorite" => $favorite->isNotEmpty()]);
    }

    public function section(Request $request, $section, $tag = null) {
        $sectionItem = Sections::query()->where("url", $section)->first();
        $q = $request->get("q");

        if (!$sectionItem) {
            abort(404);
        }

        $query = Games::whereHas("genres", function ($query) use ($sectionItem, $tag, $q) {
            $query->where("section_id", $sectionItem->id);

            if ($tag) {
                $query->where("id", $tag);
            }
        });

        if ($q) {
            $query->where("name", "like", "%$q%");
        }

        $order = Games::getSort($request);
        $query->orderBy($order[0], $order[1])->orderBy("created_at", "desc");

        $items = $query->paginate(42);

        $genres = $sectionItem->genres()->orderBy("name")->get();
        $sections = Sections::query()->get();
        return view('index.index', ["pageType" => "main", "items" => $items, "sections" => $sections, "genres" => $genres, "tag" => $tag, "sort" => true,]);
    }

    public function edit($id) {
        $game = Games::query()->where("id", $id)->first();
        $genres = Genres::query()->orderBy("name")->get();

        return view("games.edit", ["pageType" => "edit-games", "game" => $game, "genres" => $genres]);
    }

    public function create() {
        $genres = Genres::query()->orderBy("name")->get();

        return view("games.create", ["pageType" => "edit-games", "genres" => $genres]);
    }

    public function save(Request $request) {
        $id = $request->post("id");

        if ($id) {
            $game = Games::query()->where("id", $id)->first();
        } else {
            $game = new Games();
        }

        $game->name = $request->post("name");
        $game->description = $request->post("description");
        $game->html = $request->post("html");
        $game->image = $request->post("image");
        $game->image = $request->post("image");

        if (!$id) {
            $game->url = "/";
        }

        $game->save();

        $genres = $request->post("genres");

        $game->genres()->detach();
        if ($genres) {
            $game->genres()->attach($request->post("genres"));
        }

        if (!$id) $id = $game->id;

        return response()->redirectTo("/edit-game/" . $id);
    }

    public function listEmpty() {
        $games = Games::query()->doesntHave("genres")->paginate(42);

        return view("games.empty-games", ["pageType" => "edit-games", "games" => $games]);
    }

    public function delete($id) {
//        History::query()->where("game_id", $id)->delete();
//        Favorites::query()->where("game_id", $id)->delete();
        Games::query()->where("id", $id)->delete();

        return response()->redirectTo("/");
    }
}
