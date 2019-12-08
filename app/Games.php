<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Games extends Model
{
    public function genres() {
        return $this->belongsToMany("App\Genres");
    }

    public static function getSort(Request $request) {
        $sort = $request->get("sort");

        if (!$sort || $sort == "date") return ["created_at", "desc"];

        if ($sort == "popularity") return ["popularity", "desc"];

        return ["created_at", "desc"];
    }
}
