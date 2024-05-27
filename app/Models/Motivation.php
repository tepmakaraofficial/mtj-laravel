<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivation extends Model
{
    use HasFactory;
    protected $table = 'motivations';
    const TYPES = [
        1=>"Youtube"
    ];
    const STATUS = [
        1=>"Active",
        0=>"Deactive"
    ];

}
