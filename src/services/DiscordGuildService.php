<?php

namespace discord\services;

use discord\models\DiscordRole;
use discord\models\DiscordGuild;
use discord\services\DiscordAPIService;
use discord\models\DiscordAuth0User;

class DiscordGuildService {
    /**
     * @var DiscordAPIService
     */
    private $api;

    public function __construct(DiscordAPIService $api)
    {
        $this->api = $api;
    }

    public function getGuildMembers($guild_id) {

    }

    public function addGuildMember($guild, DiscordAuth0User $user) {
        $uri = sprintf('guilds/%s/members/%s', $guild, $user->user_id);
        $body = new \stdClass();
        $body->access_token = $user->access_token;
        $this->api->callAPIBot($uri, 'PUT', [], $body);
    }

    public function removeGuildMember($guild_id, $user_id) {

    }

    public function addRoleToMemberByRole($guild_member, DiscordRole $role) {

    }

    public function addRoleToMember($guild_member, $role_id) {

    }

    public function removeRoleFromMemberByRole($guild_member, DiscordRole $role) {

    }
    
    public function removeRoleFromMember($guild_member, $role_id) {

    }
}
