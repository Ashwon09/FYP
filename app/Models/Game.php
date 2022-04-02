<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'game_developer',
        'game_description',
        'game_image',
        'game_price',
        'game_genre',
        'game_comment',
        'game_status',
        'user_id',
        'genre_id',
        'console_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function console(){
        return $this->belongsTo(Console::class);
    }
    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }


}
