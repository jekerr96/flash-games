<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 */
class Genres extends Model
{
    public function games() {
        return $this->belongsToMany("App\Games");
    }

    public function section() {
        return $this->belongsTo("App\Sections");
    }

    public function getUrl() {
        return $this->section->getUrl() . "/" . $this->id;
    }
}
