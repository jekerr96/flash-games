<?php

namespace App\Http\Controllers;

use App\Favorites;
use App\Games;
use App\Helper;
use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function toggle(Request $request) {
        $id = $request->post("id");
        $result = true;

        $favorite = Favorites::query()->where("game_id", $id)->where(function ($query) use ($request) {
            $token = Helper::getUserToken();
            $ip = $request->ip();
            $query->where("token", $token)->orWhere("ip", $ip);
        })->get();

        if ($favorite->isNotEmpty()) {
            Favorites::query()->whereIn("id", $favorite->pluck("id")->toArray())->delete();
            $result = false;
        } else {
            $favorite = new Favorites();
            $favorite->token = Helper::getUserToken();
            $favorite->ip = $request->ip();
            $favorite->game_id = $id;
            $favorite->save();
        }

        return response()->json(["result" => $result]);
    }

    public function index(Request $request) {
        $q = $request->get("q");
        $token = Helper::getUserToken();
        $ip = $request->ip();

        $history = Favorites::query()->where("token", $token)->orWhere("ip", $ip)->orderBy("updated_at", "desc")->pluck("game_id")->toArray();
        $order = implode(",", $history);

        $query = Games::query();

        if ($q) {
            $query->where("name", "like", "%$q%");
        }

        $items = $query->whereIn("id", $history)->orderByRaw(DB::raw("FIELD(id, $order)"))->paginate(42);
        $sections = Sections::query()->get();
        return view('favorites.index', ["pageType" => "favorites", "items" => $items, "sections" => $sections]);
    }
}
