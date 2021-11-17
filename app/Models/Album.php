<?php

namespace App\Models;

use App\Models\Recent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'picture', 'duration', 'artiste_id', 'genre_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function titre() {
        return $this->hasMany(Titre::class);
    }
    public function artiste() {
        return $this->belongsTo(Artiste::class);
    }
    public function genre() {
        return $this->belongsTo(Genre::class);
    }
    public function recents() {
        return $this->hasMany(Recent::class);
    }
}
