<?php

namespace App\Http\Controllers;

use App\Games;
use App\Helper;
use App\History;
use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request) {
        $q = $request->get("q");
        $token = Helper::getUserToken();
        $ip = $request->ip();

        $history = History::query()->where("token", $token)->orWhere("ip", $ip)->orderBy("updated_at", "desc")->pluck("game_id")->toArray();
        $order = implode(",", $history);

        $query = Games::query();

        if ($q) {
            $query->where("name", "like", "%$q%");
        }

        $items = $query->whereIn("id", $history)->orderByRaw(DB::raw("FIELD(id, $order)"))->paginate(42);
        $sections = Sections::query()->get();
        return view('history.index', ["pageType" => "history", "items" => $items, "sections" => $sections]);
    }
}
