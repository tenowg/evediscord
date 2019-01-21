<?php

return [
    'permissions' => env('DISCORD_PERMISSIONS', 1006816343),
    'client_id' => env('DISCORD_CLIENT_ID'),
    'client_secret' => env('DISCORD_SECRET'),
    'end_point' => env('DISCORD_API_ENDPOINT', 'https://discordapp.com/api'),
    'token' => env('DISCORD_BOT_TOKEN'),
    'useragent' => env('DISCORD_USER_AGENT', 'EveDiscord (n/a, 0.0.1)'),
    'guild' => env('DISCORD_GUILD_ID'),
    'scopes' => [
        'identify',
        'email',
        'guilds',
        'guilds.join'
    ]
];