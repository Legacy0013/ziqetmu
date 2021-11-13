<?php

namespace Database\Seeders;

use App\Models\Artiste;
use Illuminate\Database\Seeder;

class ArtisteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auteurs = [];
        $genres = array_diff(scandir('./resources/sources/artistes/'),array(".",".."));
        foreach($genres as $genre){
            $artistes = array_diff(scandir('./resources/sources/artistes/'.$genre),array(".",".."));
            foreach($artistes as $artiste){
                array_push($auteurs, $artiste);
                sort($auteurs);
            }
        }
        foreach($auteurs as $auteur){
            Artiste::create([
                "name" => ucwords(str_replace('-',' ',str_replace('.jpg','',$auteur))), 
                'picture' => $auteur]);
        }
    }
}