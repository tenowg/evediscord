<?php

namespace discord\services;

use discord\models\DiscordAuth0User;
use GuzzleHttp\Client;

class DiscordAPIService {
    public function callAPI(string $uri, DiscordAuth0User $user, string $method) {
        $url = config('evediscord') . '/' . $uri;

        $client = new Client();

        $headers = array(
            'User-Agent' => config('evediscord.useragent'),
            'Authorization' => 'Bearer ' . $user->access_token
        );

        $options = array('headers' => $headers);

        $res = $client->request($method, $url, $options);

        return json_decode($res->getBody(), true);
    }

    public function callAPIBot(string $uri, string $method) {
        $url = config('evediscord') . '/' . $uri;

        $client = new Client();

        $headers = array(
            'User-Agent' => config('evediscord.useragent'),
            'Authorization' => 'Bot ' . config('evediscord.token');
        );

        $options = array('headers' => $headers);

        $res = $client->request($method, $url, $options);

        return json_decode($res->getBody(), true);
    }
}
