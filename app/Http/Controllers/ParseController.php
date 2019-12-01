<?php

namespace App\Http\Controllers;

use App\Games;
use App\Parser\GameGameParser;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class ParseController extends Controller
{
    public function index() {
        return view("parse.index", ["pageType" => "parse"]);
    }

    public function parse(Request $request, $page = 1) {
        $id = $request->post("id");
        $response = [];

        switch ($id) {
            case 1: $response = (new GameGameParser())->parse($page); break;
        }

        return response()->json($response);
    }
}
