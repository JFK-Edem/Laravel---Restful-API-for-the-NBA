<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotTable extends Model
{
    use HasFactory;


    protected $table = 'player_team';
}
