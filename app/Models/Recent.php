<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recent extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'album_id', 'titre_id', 'artiste_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function titre() {
        return $this->hasMany(Titre::class);
    }
    public function album() {
        return $this->hasMany(Album::class);
    }
    public function artiste() {
        return $this->hasMany(Artiste::class);
    }
    public function user() {
        return $this->hasMany(User::class);
    }
}
