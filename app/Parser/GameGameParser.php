<?php


namespace App\Parser;


use App\Games;
use App\Genres;
use PHPHtmlParser\Dom;

class GameGameParser extends BaseParser {

    public function parse($page = 1) {
        $countAdd = 0;
        $dom = new Dom;
        $games = $this->getGames();
        $genres = $this->getGenres();
        $dom->loadFromUrl("http://www.game-game.com.ua/" . ($page ? "page$page/" : ""));

        foreach ($dom->find(".items-list__item a") as $item) {
            $itemDom = new Dom;

            $url = "http://www.game-game.com.ua/" . $item->getAttribute("href");
            $game = $itemDom->loadFromUrl($url);

            if (array_key_exists($url, $games)) {
                continue;
            }

            try {
                $htmlGame = $game->find(".game-window")[0]->innerHtml;
            } catch (\Exception $e) {
                continue;
            }

            $listGenres = $game->find(".breadcrumb-item");
            $gameGenres = [];

            foreach ($listGenres as $genre) {
                if (array_key_exists(trim($genre->text), $genres)) {
                    $gameGenres[] = $genres[trim($genre->text)]->id;
                    continue;
                }

                $newGenre = new Genres();
                $newGenre->name = trim($genre->text);
                $newGenre->description = "Описание";
                $newGenre->section_id = 1;
                $newGenre->save();
                $gameGenres[] = $newGenre->id;
                $genres[$newGenre->name] = $newGenre;
            }

            $gameModel = new Games();
            $gameModel->html = $htmlGame;
            $gameModel->url = $url;
            $gameModel->name = $item->getAttribute("title");
            $gameModel->image = "http://cdn1.game-game.com.ua/gamesimg/" . substr($item->getAttribute("href"), 0, -1) . ".jpg";
            $gameModel->save();
            $gameModel->genres()->attach($gameGenres);
            $countAdd++;
        }

        return [
            "count" => $countAdd,
        ];
    }
}
