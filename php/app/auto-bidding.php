<?php
global $config;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = ORM::get_db();
    $sql = "SELECT id FROM `" . $config['db']['pre'] . "user` ";
    $queryRecords = $pdo->query($sql);
    foreach ($queryRecords as $row) {
        $user_id = $row['id'];
        $option = unserialize(get_user_option($user_id, 'auto_bidding_settings',
                serialize([
                    'status' => 'disable',
                    'delay' => 60,
                    'interval' => 1,
                    'time-limit' => -1,
                    'bids-limit' => -1
                ]))
        );
        if ('enable' == $option['status']) {
            try {
                $provider = new FreelancerIdentity(['sandbox' => $config['ai_bidding']['sandbox']]);
                $tokenArray = unserialize(get_user_option($user_id, 'freelancer_token'));
                if ($tokenArray) {
                    $provider->setAccessTokenFromArray($tokenArray);
                    $project_response = get_freelancer_active_projects($provider, 1);
                    if (is_array($project_response['projects'])) {
                        $project = $project_response['projects'][0];
                        $avg = $project['bid_stats']['bid_avg'];
                        bid_freelancer_project($provider, $project['id'], $avg ?: $project['budget']['minimum'], 10, get_content_from_chat_gpt('For project description : ' . $project['description'] . 'in freelancer.com can you please write content for the proposal. I will not modify the returned content so make it paste ready and dont include any assumption values.'));
                        add_user_freelancer_bid($user_id, $project);
                    }
                }
            } catch (IdentityProviderException|FreelancerIdentityException|Exception $e) {
                echo $user_id . '=>' . $e->getMessage() . '<br>';
                continue;
            }
        }
    }
    exit("Auto bidding completed!");
}

if (isset($current_user['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
            $provider = new FreelancerIdentity(['sandbox' => $config['ai_bidding']['sandbox']]);
            $tokenArray = unserialize(get_user_option($current_user['id'], 'freelancer_token'));
            if (!$tokenArray) {
                HtmlTemplate::display('freelancer-login');
            }
            $bids = list_freelancer_bids($current_user['id']);
            $provider->setAccessTokenFromArray($tokenArray);
            if (!$provider->accessToken->hasExpired()) {
                HtmlTemplate::display('auto-bidding', [
                    'bids' => $bids
                ]);
            }
        } catch (FreelancerIdentityException|Exception $e) {
            exit($e->getMessage());
        }
    }
} else {
    headerRedirect($link['LOGIN']);
}