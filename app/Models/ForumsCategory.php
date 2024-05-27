<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumsCategory extends Model
{
    use HasFactory;
    const ALL_STATUS = [
        "1"=>"Active",
        "0"=>"Deactive",
    ];
}
