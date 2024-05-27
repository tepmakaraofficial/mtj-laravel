<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MistakeNotes extends Model
{
    use HasFactory;
    protected $table="mistakes";
    const ALL_LEVELS = [
        1=>"Normal",
        2=>"Moderate",
        3=>"Extreme"
    ];
    const ALL_ACTIONS = [
        1 => "Note",
        2 => "Check-list",
        3 => "Pin"
    ];
}
