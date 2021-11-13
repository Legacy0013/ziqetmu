<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Artiste;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [];
        $genresDir = array_diff(scandir('./resources/sources/artistes/'),array(".",".."));
        foreach($genresDir as $genreDir) {
            $genres[str_replace('-',' ',$genreDir)] = [];
                $artistes = array_diff(scandir('./resources/sources/artistes/'.$genreDir),array(".",".."));
                foreach($artistes as $artiste){
                    array_push($genres[str_replace('-',' ',$genreDir)], strToLower(str_replace('.jpg','',$artiste)));
                }
        }

        // $pistes = array_diff(scandir('./resources/sources/music-20s/'),array(".",".."));

        $auteurs = array_diff(scandir('./resources/sources/albums/'),array(".",".."));
        foreach($auteurs as $aut){
            foreach ($genres as $key => $value){
                foreach($value as $art){
                        if(strToLower($art) == strToLower($aut)){
                        $albums = array_diff(scandir('./resources/sources/albums/'.$aut.'/'),array(".",".."));
                            foreach($albums as $album){
                                $g = Genre::where('name', $key)->first();
                                Album::create([
                                    'name' => str_replace('.jpg', '', $album), 
                                    'date' => '1985',
                                    'picture' => $album ,
                                    'duration' => '77',
                                    'artiste_id' => '1',
                                    'genre_id' => $g ? $g->id : 9
                                ]);   
                                // dd($g);
                            }
                        }
                    }
                }
        }
    }
}