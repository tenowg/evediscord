<?php

use discord\services\BotAuthService;

Route::get('discord/register', function(BotAuthService $service) {
    return redirect()->away($service->authRedirectURL());
});

Route::get('discord/callback', function() {
    
});
