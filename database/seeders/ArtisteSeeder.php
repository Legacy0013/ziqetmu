<?php

namespace Database\Seeders;

use App\Models\Artiste;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArtisteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = Storage::disk('sources')->allFiles('artistes');

        if(!File::exists(storage_path("app/public/artists"))){
            File::makeDirectory(storage_path("app/public/artists"));
        }
        if(!File::exists(storage_path("app/public/artists/covers"))){
            File::makeDirectory(storage_path("app/public/artists/covers"));
        }

        foreach($genres as $genre){
            $slashed = explode('/', $genre);
            $g = [
                'name' => $slashed[1],
            ];
            $ar = [
                'name' => str_replace('.jpg', '', $slashed[2]),
                'cover' => $slashed[2]
            ];

            $art = Artiste::create([
                "name" => ucwords(str_replace('-', ' ', $ar['name'])),
            ]);

            if(!File::exists(storage_path("app/public/artists/covers/{$art->id}"))){
                File::makeDirectory(storage_path("app/public/artists/covers/{$art->id}/"));
            }
            File::copy("./storage/sources/artistes/{$g['name']}/{$ar['cover']}", storage_path("app/public/artists/covers/{$art->id}/cover.jpg"));

            $art->picture = "/artists/covers/{$art->id}/cover.jpg";
            $art->save();
        }
    }
}
