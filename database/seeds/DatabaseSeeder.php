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
                "description" => ""
            ],
            [
                "name" => "Для девочек",
                "description" => ""
            ],
            [
                "name" => "Для детей",
                "description" => ""
            ],
            [
                "name" => "Для двоих",
                "description" => ""
            ],
        ];

        foreach ($sections as $section) {
            \App\Sections::create($section);
        }
    }
}
