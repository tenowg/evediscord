<?php

namespace discord\models;

use Illuminate\Database\Eloquent\Model;

/**
 * discord\models\DiscordGuild
 *
 * @mixin \Eloquent
 */
class DiscordGuild extends Model
{
    protected $fillable = [
        'id',
        'name',
        'icon',
        'owner',
        'permissions'
    ];

    public $incrementing = false;
    protected $primaryKey = 'id';
}
