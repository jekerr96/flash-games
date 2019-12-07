<?php

namespace App\Http\Controllers;

use App\Genres;
use App\Sections;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index() {
        $genres = Genres::query()->orderBy("name")->get();
        return view("edit-genres.index", ["pageType" => "edit-genres", "genres" => $genres]);
    }

    public function edit($id) {
        $genre = Genres::query()->where("id", $id)->first();
        $sections = Sections::query()->get();

        return view("edit-genres.edit", ["pageType" => "edit-genres", "genre" => $genre, "sections" => $sections]);
    }

    public function update(Request $request) {
        $id = $request->post("id");

        $genre = Genres::query()->where("id", $id)->first();
        $genre->name = $request->post("name");
        $genre->description = $request->post("description");
        $genre->section_id = $request->post("section");

        $genre->save();

        return response()->redirectTo("/edit-genres/");
    }

    public function delete(Request $request) {
        $id = $request->post("id");
        Genres::query()->where("id", $id)->delete();

        return response()->json(["success" => true]);
    }
}
