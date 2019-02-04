<?php

namespace tenowg\discord\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use discord\services\DiscordGuildService;

class JoinGuildJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var DiscordAuth0User
     */
    public $user;

    /**
     * @var int
     */
    public $guild;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DiscordAuth0User $user, $guild_id) {
        $this->user = $user;
        $this->guild = $guild;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DiscordGuildService $service)
    {
        $service->addGuildMember($this->guild, $this->user);
    }
}
