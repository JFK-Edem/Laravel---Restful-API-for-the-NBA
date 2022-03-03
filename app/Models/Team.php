<?php

namespace App\Models;

use App\Models\PivotTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Team extends Model
{

    use HasFactory;


    protected $fillable = ['name','abbr'];

    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot('joined_at', 'left_at');
    }
}
