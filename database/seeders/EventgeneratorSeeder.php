<?php

namespace Database\Seeders;

use App\Models\Eventgenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventgeneratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $m = new Eventgenerator();
        $m->name = 'Magyar Közlöny scraper';
        $m->active = true;
        $m->save();

        $m = new Eventgenerator();
        $m->name = 'Teszt scraper';
        $m->active = true;
        $m->save();
    }
}
