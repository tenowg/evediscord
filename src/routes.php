<?php

use discord\services\BotAuthService;

Route::get('discord/register', function(BotAuthService $service) {
    dd($service->authRedirectURL);
})