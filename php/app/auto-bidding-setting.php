<?php
global $config;


if (isset($current_user['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        update_user_option($current_user['id'], 'auto_bidding_settings', serialize([
            'status' => $_POST['status'],
            'delay' => $_POST['delay'],
            'interval' => $_POST['interval'],
            'time-limit' => $_POST['time-limit'],
            'bids-limit' => $_POST['bids-limit'],
        ]));
        // The request was generated using POST
        // You can access POST data using $_POST array
        // Example: $data = $_POST['key'];
    }
    HtmlTemplate::display('auto-bidding-setting',
        array(
            'options' =>
                unserialize(get_user_option($current_user['id'], 'auto_bidding_settings',
                        serialize([
                            'status' => 'disable',
                            'delay' => 60,
                            'interval' => 1,
                            'time-limit' => -1,
                            'bids-limit' => -1
                        ]))
                )
        )
    );
} else {
    headerRedirect($link['LOGIN']);
}