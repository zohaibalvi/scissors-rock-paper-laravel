<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'u_id', 'player_points', 'computer_points', 'created_at', 'updated_at',
    ];
}
