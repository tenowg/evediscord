<?php

namespace discord\models;

use Illuminate\Database\Eloquent\Model;

class GuildMember extends Model
{
    protected $fillable = [
        'user_id',
        'nick',
        'roles',
        'joined_at',
        'deaf',
        'mute'
    ];
}
