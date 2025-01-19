<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class Song extends Model
{
    use hasFactory;

    public string $title;
    public string $artist;
    public string $album;
    public string $genre;
    protected $table = 'songs';
    protected $fillable =
        [
            'title',
            'artist',
            'album',
            'genre',
        ];

}

