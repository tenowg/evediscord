<?php

namespace tenowg\discord\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use discord\services\DiscordGuildService;
use discord\models\DiscordRole;

class GetDiscordRoles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $guild_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($guild_id)
    {
        $this->guild_id = $guild_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DiscordGuildService $service)
    {
        $roles = $service->getGuildRoles($this->guild_id);

        foreach($roles as $role) {
            DiscordRole::updateOrCreate(['id' => $role['id']], $role);
        }

        $current_roles = DiscordRole::all()->toArray();

        $diff = array_udiff($current_roles, $roles, [$this, 'diff']);

        foreach($diff as $remove) {
            DiscordRole::destroy($remove['id']);
        }
    }

    protected function diff($a, $b) {
        if ($a['id'] == $b['id']) {
            return 0;
        }
        return ($a['id']>$b['id'])?1:-1;;
    }
}
