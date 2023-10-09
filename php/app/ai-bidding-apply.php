<?php
global $config;

use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;


if (isset($current_user['id'])) {
    try {
        $provider = new FreelancerIdentity(['sandbox' => $config['ai_bidding']['sandbox']]);
        $tokenArray = unserialize(get_user_option($current_user['id'], 'freelancer_token'));
        if (!$tokenArray) {
            HtmlTemplate::display('freelancer-login');
        }
        $provider->setAccessTokenFromArray($tokenArray);
        $project = get_freelancer_project($provider, $_GET['project']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            bid_freelancer_project($provider, intval($_POST['project']), intval($_POST['amount']), intval($_POST['period']), $_POST['description']);
        }
        HtmlTemplate::display('ai-bidding-apply', array(
            'project' => $project,
            'bid_status' => get_freelancer_bid_status($provider, $_GET['project'], get_freelancer_self($provider))
        ));
    } catch (FreelancerIdentityException $e) {
        if ($e->getCode() == 0) {
            HtmlTemplate::display('ai-bidding-apply', array(
                'project' => $project,
                'error' => $e->getMessage(),
                'bid_status' => get_freelancer_bid_status($provider, $_GET['project'], get_freelancer_self($provider))
            ));
        } else {
            HtmlTemplate::display('freelancer-login');
        }
    } catch (Exception $e) {
        exit($e->getMessage());
//        HtmlTemplate::display('ai-bidding-apply', array(
//            'project' => $_POST['project'],
//            'error' => $e->getMessage()
//        ));
    }
} else {
    headerRedirect($link['LOGIN']);
}