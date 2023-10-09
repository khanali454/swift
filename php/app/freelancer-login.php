<?php
global $config;


//if user is logged in to switf job ai
use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

if (isset($current_user['id'])) {
    //if user is logged in with freelancer

    try {
        $provider = new FreelancerIdentity([
            'clientId' => $config['ai_bidding']['client_id'],
            'clientSecret' => $config['ai_bidding']['client_secret'],
            'redirectUri' => $config['ai_bidding']['redirect_ui'],
            'scopes' => ['basic'], // Optional only needed when retrieve access token
            'prompt' => ['select_account'], // Optional only needed when retrieve access token
            'advancedScopes' => [1, 3], // Optional only needed when retrieve access token
            'sandbox' => $config['ai_bidding']['sandbox'], // to play with https://accounts.freelancer-sandbox.com
        ]);
        // If we don't have an authorization code then get one
        // Fetch the authorization URL from the provider; this returns the
        // urlAuthorize option and generates and applies any necessary parameters
        $authorizationUrl = $provider->getAuthorizationUrl();

        // Redirect the user to the authorization URL.
        header('Location: ' . $authorizationUrl);
        exit;
    } catch (FreelancerIdentityException $e) {
        $msg = __('Error login : ') . $e->getMessage();
    }

} else {
    headerRedirect($link['LOGIN']);
}