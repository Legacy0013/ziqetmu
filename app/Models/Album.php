<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
