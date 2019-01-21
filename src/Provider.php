<?php

namespace tenowg\discord;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;
use discord\models\DiscordAuth0User;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'DISCORD';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://discordapp.com/api/oauth2/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://discordapp.com/api/oauth2/token';
    }

    /**
	 * {@inheritdoc}
	 */
	public function getAccessToken( $code )
	{
		$response = $this->getHttpClient()->post( $this->getTokenUrl(), [
			'headers'     => [ 'Authorization' => 'Basic ' . base64_encode( $this->clientId . ':' . $this->clientSecret ) ],
			'form_params' => $this->getTokenFields( $code ),
		] );

		$this->credentialsResponseBody = json_decode( $response->getBody(), true );

		return $this->parseAccessToken( $response->getBody() );
    }
    
    public function refreshToken($token) {
        $response = $this->getHttpClient()->post( $this->getTokenUrl(), [
			'headers'     => [ 'Authorization' => 'Basic ' . base64_encode( $this->clientId . ':' . $this->clientSecret ) ],
			'form_params' => $this->getRefreshFields( $token ),
		] );

		$this->credentialsResponseBody = json_decode( $response->getBody(), true );

        return $this->credentialsResponseBody['access_token'];
    }

    public function handleDatabase($user) {
        return DiscordAuth0User::updateOrCreate(
            [
                'user_id' => $user->user['id']
            ],
            [
                'name' => $user->name,
                'nickname' => $user->nickname,
                'access_token' => $user->token, 
                'refresh_token' => $user->refreshToken == null ? '' : $user->refreshToken,
                'expires' => $user->expiresIn,
                'scopes' => explode(' ', $user->accessTokenResponseBody['scope']),
                'avatar' => $user->avatar,
                'email' => $user->email
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://discordapp.com/api/users/@me', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
            'nickname' => sprintf('%s#%s', $user['username'], $user['discriminator']),
            'name'     => $user['username'],
            'email'    => (array_key_exists('email', $user)) ? $user['email'] : null,
            'avatar'   => (is_null($user['avatar'])) ? null : sprintf('https://cdn.discordapp.com/avatars/%s/%s.jpg', $user['id'], $user['avatar']),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getRefreshFields($code)
    {
        return [
            'grant_type' => 'refresh_token',
            'refresh_token' => $code
        ];
    }
}
