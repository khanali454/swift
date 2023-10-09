<?php
global $config;

if (isset($current_user['id'])) {
    //if user is logged in with freelancer
    //user never logged in
    delete_user_option($current_user['id'], 'freelancer_token');
    headerRedirect($link['AI_BIDDING']);
} else {
    headerRedirect($link['LOGIN']);
}

