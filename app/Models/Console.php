<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;
    protected $fillable = [
        'console_name',
        'console_description',
        'manufacturer_id',

    ];

    public function games(){
        return $this->hasMany(Game::class);
    }

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }
}
