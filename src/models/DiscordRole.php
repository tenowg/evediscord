<?php

namespace discord\models;

use Illuminate\Database\Eloquent\Model;

class DiscordRole extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'color',
        'hoist',
        'position',
        'permissions',
        'managed',
        'mentionable'
    ];
}
