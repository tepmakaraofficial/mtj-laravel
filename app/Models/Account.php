<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table="accounts";
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = -1;
}
