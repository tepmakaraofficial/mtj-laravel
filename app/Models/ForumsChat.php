<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumsChat extends Model
{
    use HasFactory;
    protected $table = 'forums_chats';

    function user(){
        return $this->belongsTo(User::class,'fk_user');
    }

    function cat(){
        return $this->belongsTo(ForumsCategory::class,'fk_cat');
    }

    function childs(){
        return $this->hasMany(ForumsChat::class,'parent_id');
    }

    function parent(){
        return $this->belongsTo(ForumsChat::class,'parent_id');
    }
}
