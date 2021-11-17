<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $fillable = [
        'manufacturer_name',
        'manufacturer_description',
        'manufacturer_image',
    ];

    public function consoles(){
        return $this->hasMany(Console::class);
    }
}
