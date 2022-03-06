<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_by',
        'report_to',
        'report_game',
        'report_reason',
        'report_comment'
    ];

    public function report_by(){
        return $this->belongsTo(User::class);
    }

    public function report_to(){
        return $this->belongsTo(User::class);
    }

    public function report_game(){
        return $this->belongsTo(Game::class);
    }
}
