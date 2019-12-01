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
         $this->call(GamesTableSeeder::class);
    }
}

class GamesTableSeeder extends Seeder{
    public function run() {
        \App\Games::create([
            "html" => '<embed src="http://g.vseigru.net/igra-dusha-razbojnika.swf" width="860" height="648" allownetworking="internal" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">',
            "url" => "http://vseigru.net/igry-prikolnye/11594-igra-dusha-razbojnika.html",
        ]);
    }
}
