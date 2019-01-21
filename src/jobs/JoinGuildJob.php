<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JoinGuildJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var DiscordAuth0User
     */
    public $user;

    /**
     * @var DiscordGuild
     */
    public $guild;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DiscordAuth0User $user, DiscordGuild $guild) {
        $this->user = $user;
        $this->guild = $guild;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
