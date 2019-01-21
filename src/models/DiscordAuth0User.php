<?php

namespace discord\models;

use Illuminate\Database\Eloquent\Model;

/**
 * discord\models\DiscordUser
 *
 * @mixin \Eloquent
 */
class DiscordAuth0User extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nickname',
        'access_token',
        'refresh_token',
        'expires',
        'scopes',
        'avatar',
        'email'
    ];

    protected $casts = [
        'scopes' => 'array'
    ];
}
