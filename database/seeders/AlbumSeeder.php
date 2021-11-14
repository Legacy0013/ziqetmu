<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Artiste;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $genres = [];
        // $genresDir = array_diff(scandir('./resources/sources/artistes/'),array(".",".."));
        // foreach($genresDir as $genreDir) {
        //     $genres[str_replace(' - ',' ',$genreDir)] = [];
        //         $artistes = array_diff(scandir('./resources/sources/artistes/'.$genreDir),array(".",".."));
        //         foreach($artistes as $artiste){
        //             array_push($genres[str_replace(' - ',' ',$genreDir)], strToLower(str_replace('.jpg','',$artiste)));
        //         }
        // }

        // $pistes = array_diff(scandir('./resources/sources/music-20s/'),array(".",".."));

        // $albums = array_diff(scandir('./resources/sources/albums/'.$aut.'/'),array(".",".."));
        
        // $auteurs = array_diff(scandir('./resources/sources/albums/'),array(".",".."));
        // foreach($auteurs as $aut){
        //     foreach ($genres as $key => $value){
        //         foreach($value as $art){
        //             if(strToLower($art) == strToLower($aut)){
        //             }
        //         }
        //     }
        // }


        if(!File::exists(storage_path('app\\public\\albums'))){
            File::makeDirectory(storage_path('app\\public\\albums'));
        }
        if(!File::exists(storage_path('app\\public\\albums\\covers'))){
            File::makeDirectory(storage_path('app\\public\\albums\\covers'));
        }
        $albums = array_diff(scandir('./resources/sources/music-20s/'), array('.','..'));
        foreach($albums as $k => $album){
            $titres = array_diff(scandir("./resources/sources/music-20s/$album"), array('.','..'));
            $ex = explode(' - ', $album);
            $ar = [
                'year' => $ex[0],
                'duration' => $ex[1],
                'artist' => $ex[2],
                'name' => $ex[3],
                'genre' => $ex[4]
            ];
            
            $g = Genre::where('name', $ar['genre'])->first();
            if(!$g){
                dd($g, $ar['genre']);
            }
            $a = Artiste::where('name', str_replace('-', ' ', $ar['artist']))->first();
            $alb = Album::firstOrCreate([
                'name' => $ar['name'], 
                'date' => $ar['year'],
                'duration' => $ar['duration'],
                'artiste_id' => $a->id ?? '156465465465',
                'genre_id' => $g->id
            ]);   
            
            foreach($titres as $t => $titre){
                if($titre == 'cover.jpg'){
                    if(!File::exists(storage_path("app\\public\\albums\\covers\\{$alb->id}"))){
                        File::makeDirectory(storage_path("app\\public\\albums\\covers\\{$alb->id}\\"));
                    }
                    if(storage_path("app\\public\\albums\\covers\\{$alb->id}\\cover.jpg")){
                        File::copy(".\\resources\\sources\\music-20s\\$album\\cover.jpg", storage_path("app\\public\\albums\\covers\\{$alb->id}\\cover.jpg"));
                    }
                }
            }

            $alb->picture = "\\albums\\covers\\{$alb->id}\\cover.jpg";
            $alb->save();
        }
    }
}