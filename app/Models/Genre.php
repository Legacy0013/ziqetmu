<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];

    public function titre() {
        return $this->hasMany(Titre::class);
    }
    public function album() {
        return $this->hasMany(Album::class);
    }
}
