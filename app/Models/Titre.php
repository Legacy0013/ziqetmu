<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];

    public function artiste() {
        return $this->belongsTo(Artiste::class);
    }
    public function album() {
        return $this->belongsTo(Album::class);
    }
    // public function genre() {
    //     return $this->belongsTo(Genre::class);
    // }
}
