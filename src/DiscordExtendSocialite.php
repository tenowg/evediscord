<?php

namespace tenowg\discord;

use SocialiteProviders\Manager\SocialiteWasCalled;

class DiscordExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('discord', __NAMESPACE__.'\Provider');
    }
}