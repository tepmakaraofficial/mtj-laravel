<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCalendar extends Model
{
    use HasFactory;
    protected $table = 'news_calendars';
    const TYPE_FOREX = "FOREX";
    const TYPE_CRYPTO = "CRYPTO";
    const TYPE_STOCK = "STOCK";

}
