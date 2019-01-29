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
        $uri = sprintf('guilds/%s/members', $guild_id);
        return $this->api->callAPIBot($uri, 'GET', ['limit' => 1000]);
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

    public function addRoleToMember($guild_id, $guild_member_id, $role_id) {
        $uri = sprintf('guilds/%s/members/%s/roles/%s', $guild_id, $guild_member_id, $role_id);
        return $this->api->callAPIBot($uri, 'PUT');
    }

    public function removeRoleFromMemberByRole($guild_member, DiscordRole $role) {

    }
    
    public function removeRoleFromMember($guild_id, $guild_member_id, $role_id) {
        $uri = sprintf('guilds/%s/members/%s/roles/%s', $guild_id, $guild_member_id, $role_id);
        return $this->api->callAPIBot($uri, 'DELETE');
    }

    public function getGuildRoles($guild_id) {
        $uri = sprintf('guilds/%s/roles', $guild_id);
        return $this->api->callAPIBot($uri, 'GET', []);
    }

    public function modifyGuildMember($guild_id, $user_id, $modify_body) {
        $uri = sprintf('guilds/%s/members/%s', $guild_id, $user_id);
        $this->api->callAPIBot($uri, 'PATCH', [], $modify_body);
    }
}
