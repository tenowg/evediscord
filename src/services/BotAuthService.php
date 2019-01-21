<?php

namespace discord\services;

class BotAuthService {
    public function authRedirectURL() {
        $client_id = config('evediscord.client_id');
        $client_permissions = config('evediscord.permissions');
        return config('evediscord.end_point') . '/oauth2/authorize?client_id=' . $client_id . '&scope=bot&permissions=' . $client_id;
    }
}