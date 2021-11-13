<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!File::exists(storage_path('app\\public\\albums'))){
            File::makeDirectory(storage_path('app\\public\\albums'));
        }
        if(!File::exists(storage_path('app\\public\\albums\\covers'))){
            File::makeDirectory(storage_path('app\\public\\albums\\titres'));
        }
        $albums = array_diff(scandir("./resources/sources/music-20s/"), array('.', '..'));
        foreach ($albums as $key => $album) {
            $ex = explode(' - ', $album);
            $ar = [
                'year' => $ex[0],
                'duration' => $ex[1],
                'artist' => $ex[2],
                'name' => $ex[3],
            ];
            $titres = array_diff(scandir("./resources/sources/music-20s/$album"), array('.', '..'));
            foreach ($titres as $t => $titre) {
                if ($titre != 'cover.jpg') {
                    $a = Album::where('name', $ar['name'])->first();
                    if(!File::exists(storage_path("app\\public\\albums\\titres\\{$a->id}"))){
                        File::makeDirectory(storage_path("app\\public\\albums\\titres\\{$a->id}\\"));
                    }
                    if(!File::exists(storage_path("app\\public\\albums/titres/{$a->id}/$titre"))){
                        File::copy("./resources/sources/music-20s/$album/$titre", storage_path("app\\public\\albums/titres/{$a->id}/$titre"));
                    }
                }
            }
        }
    }
}
