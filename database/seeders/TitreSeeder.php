<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artiste;
use App\Models\Genre;
use App\Models\Titre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!File::exists(storage_path('app/public/albums'))){
            File::makeDirectory(storage_path('app/public/albums'));
        }
        if(!File::exists(storage_path('app/public/albums/titres'))){
            File::makeDirectory(storage_path('app/public/albums/titres'));
        }
        
        $albums = Storage::disk('sources')->allFiles('music-20s');
        foreach ($albums as $key => $album) {
            $slashed = explode('/', $album);
            $albu = explode(' - ', $slashed[1]);
            $al = [
                'year' => $albu[0],
                'duration' => $albu[1],
                "artist" => $albu[2],
                'name' => $albu[3],
                'genre' => $albu[4],
            ];

            $ge = Genre::firstOrCreate([
                'name' => str_replace('-', ' ', $al['genre']),
            ]);

            $ar = Artiste::where('name', str_replace('-', ' ',$al['artist']))->first();

            $alb = Album::firstOrCreate([
                'duration' => $al['duration'],
                'date' => $al['year'],
                'artiste_id' => $ar->id,
                'genre_id' => $ge->id,
                'name' => $al['name'],
            ]);

            if($slashed[2] == 'cover.jpg'){
                // var_dump($album);
                if(!File::exists(storage_path("app/public/albums/covers/{$alb->id}"))){
                    File::makeDirectory(storage_path("app/public/albums/covers/{$alb->id}/"));
                }
                if(storage_path("app/public/albums/covers/{$alb->id}/cover.jpg")){
                    File::copy("./storage/sources/".$album, storage_path("app/public/albums/covers/{$alb->id}/cover.jpg"));
                }
                
                $alb->picture = "/albums/covers/{$alb->id}/cover.jpg";
                $alb->save();

            }else{
                $titl = explode(' - ', $slashed[2]);
                if(!isset($titl[1])){
                    dd($titl);
                }
                $title = [
                    'order' => $titl[0],
                    'title' => $titl[1],
                ];
    
                
                if(!File::exists(storage_path("app/public/albums/titres/{$alb->id}"))){
                    File::makeDirectory(storage_path("app/public/albums/titres/{$alb->id}/"));
                }
                if(!File::exists(storage_path("app/public/albums/titres/{$alb->id}/{$title['title']}"))){
                    File::copy("./storage/sources/$album", storage_path("app/public/albums/titres/{$alb->id}/{$title['title']}"));
                }
    
                Titre::firstOrCreate([
                    'name' => str_replace('.mp3', '', $title['title']),
                    'order'=> $title['order'],
                    'artiste_id' => $ar->id,
                    'album_id' => $alb->id,
                ]);
            }
        }
    }
}
