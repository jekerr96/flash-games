<?php


namespace App\Parser;


use App\Games;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BaseParser {
    public function __construct() {
        set_time_limit(60000);
    }

    protected function getGames() {
        $games = Games::query()->get();
        $arGames = [];

        foreach ($games as $game) {
            $arGames[$game->url] = $game;
        }

        return $arGames;
    }

    protected function saveImageFromUrl($url) {
        $contents = file_get_contents($url);
        $name = Str::random(20) . ".png";
        Storage::put("public/games/" . $name, $contents);

        return $name;
    }
}
