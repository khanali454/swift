<?php
global $config;

//if user is logged in to switf job ai
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

if (isset($current_user['id'])) {
    //if user is logged in with freelancer
    //user never logged in
    if (null == get_user_option($current_user['id'], 'freelancer_token') && !isset($_GET['code'])) {
        //else show login
        HtmlTemplate::display('freelancer-login');
        //user tried to log in this time
    } elseif (null == get_user_option($current_user['id'], 'freelancer_token') && isset($_GET['code'])) {
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

            // Try to get an access token using the authorization code grant.
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            // Store this bearer token in your data store for future use
            // including these information
            // token_type, expires_in, scope, access_token and refresh_token
            update_user_option($current_user['id'], 'freelancer_token', serialize($provider->accessTokenArray));
            $provider->setAccessTokenFromArray($provider->accessTokenArray);
            $projects = get_freelancer_active_projects($provider, $_GET['page']);
            if ($projects) {
                HtmlTemplate::display('ai-bidding', array(
                    'result' => $projects,
                    'limit' => 10
                ));
            }
        } catch (FreelancerIdentityException $e) {
            HtmlTemplate::display('freelancer-login');
            // Failed to get the access token or user details.
            // exit($e->getMessage());
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    } else { //user already logged in
        try {
            $provider = new FreelancerIdentity(['sandbox' => $config['ai_bidding']['sandbox']]);
            $tokenArray = unserialize(get_user_option($current_user['id'], 'freelancer_token'));
            $provider->setAccessTokenFromArray($tokenArray);
            $projects = get_freelancer_active_projects($provider, $_GET['page']);
            if ($projects) {
                HtmlTemplate::display('ai-bidding', array(
                    'result' => $projects,
                    'limit' => 10
                ));
            }
        } catch (FreelancerIdentityException $e) {
            HtmlTemplate::display('freelancer-login');
            // exit($e->getMessage());
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
} else {
    headerRedirect($link['LOGIN']);
}

