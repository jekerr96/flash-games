<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    public function genres() {
        return $this->hasMany("App\Genres", "section_id", "id");
    }

    public function getUrl() {
        return "/section/" . $this->url;
    }
}
