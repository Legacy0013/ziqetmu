<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'name' => 'BO',
        ]);
        Genre::create([
            'name' => 'Classique',
        ]);
        Genre::create([
            'name' => 'Country-folk',
        ]);
        Genre::create([
            'name' => 'Electro',
        ]);
        Genre::create([
            'name' => 'Hip-hop',
        ]);
        Genre::create([
            'name' => 'Indé',
        ]);
        Genre::create([
            'name' => 'Pop',
        ]);
        Genre::create([
            'name' => 'Rock',
        ]);
        Genre::create([
            'name' => 'test',
        ]);
    }
}
