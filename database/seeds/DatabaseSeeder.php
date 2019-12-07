<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SectionsTableSeeder::class);
    }
}

class SectionsTableSeeder extends Seeder{
    public function run() {
        $sections = [
            [
                "name" => "Для мальчиков",
                "url" => "for-man",
                "description" => ""
            ],
            [
                "name" => "Для девочек",
                "url" => "for-woman",
                "description" => ""
            ],
            [
                "name" => "Для детей",
                "url" => "for-kids",
                "description" => ""
            ],
            [
                "name" => "Для двоих",
                "url" => "two-players",
                "description" => ""
            ],
        ];

        foreach ($sections as $section) {
            \App\Sections::create($section);
        }
    }
}
