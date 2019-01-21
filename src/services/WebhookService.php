<?php

namespace discord\services;

use GuzzleHttp\Client;
use discord\models\EmbedMessage;


class WebhookService {
    public function send(string $hook, string $message) {
        $client = new Client();
        $client->request('POST', $hook, [
                'json' => ['content' => $message]
            ]);
    }

    public function sendEmbed(string $hook, EmbedMessage $message) {
        $client = new Client();
    }
}