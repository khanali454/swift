<?php

use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

global $config, $link, $current_user;
try {
    $provider = new FreelancerIdentity(['sandbox' => $config['ai_bidding']['sandbox']]);
    $tokenArray = unserialize(get_user_option($current_user['id'], 'freelancer_token'));
    if ($tokenArray) {
        $provider->setAccessTokenFromArray($tokenArray);
        if (!$provider->accessToken->hasExpired()) {
            $self = get_freelancer_self($provider);
            ?>
            <p>Not <?php echo $self['username'] ?>? <a href="<?php echo $link['FREELANCER_LOGOUT']; ?>">Logout</a></p>
            <?php
        }
    }
} catch (FreelancerIdentityException $e) {
    echo $e->getMessage();
}