<?php
overall_header(__("Auto Bidding"));
global $current_user;
$options = unserialize(get_user_option($current_user['id'], 'auto_bidding_settings',
        serialize([
                'status' => 'disable',
                'delay' => 60,
                'interval' => 1,
                'time-limit' => -1,
                'bids-limit' => -1
            ]
        )
    )
);
?>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <?php
        include_once TEMPLATE_PATH . '/dashboard_sidebar.php';
        ?>
        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container" data-simplebar>
            <div class="dashboard-content-inner">
                <?php print_adsense_code('header_bottom'); ?>
                <!-- Dashboard Headline -->
                <div class="dashboard-headline">
                    <h3 class="d-flex align-items-center">
                        <?php _e("Auto Bidding") ?>
                    </h3>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="<?php url("INDEX") ?>"><?php _e("Home") ?></a></li>
                            <li><?php _e("Auto Bidding") ?></li>
                        </ul>
                    </nav>
                    <?php include 'partials/freelancer-logout.php'; ?>
                </div>


                <div class="margin-top-0">
                    <!-- auto bidding notification-->
                    <?php if ('enable' == $options['status']) : ?>
                        <a href="<?php url('AUTO_BIDDING_SETTING') ?>"
                           style="display: block; padding:20px; background: rgba(16,163,127,0.2); color: rgba(16,163,127); cursor: pointer">
                            Auto bidding is
                            enabled. Click here to
                            disable auto
                            bidding
                        </a>
                    <?php else: ?>
                        <a href="<?php url('AUTO_BIDDING_SETTING') ?>"
                           style="display: block; padding:20px; background: rgba(16,163,127,0.2); color: rgba(16,163,127); cursor: pointer">
                            Auto bidding is
                            disabled. Click here to
                            enable auto
                            bidding
                        </a>
                    <?php endif; ?>

                    <div style="margin-top: 20px">
                        <?php if ($bids) : ?>
                            <table>
                                <thead>
                                <tr>
                                    <td>Time</td>
                                    <td>Project Title</td>
                                    <td>Bid Amount</td>
                                    <td>View Bid</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($bids as $bid): ?>
                                    <tr>
                                        <td><?php echo $bid['timestamp']; ?></td>
                                        <td><?php echo unserialize($bid['project'])['title']; ?></td>
                                        <td>100</td>
                                        <td>link</td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div style="display: block; padding:20px; background: rgba(163,16,16,0.2); color: rgba(163,16,16);">
                                No auto bids placed! Automatic bids will be listed here.
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php print_adsense_code('footer_top'); ?>
                <!-- Footer -->
                <div class="dashboard-footer-spacer"></div>
                <div class="small-footer margin-top-15">
                    <div class="footer-copyright">
                        <?php _esc($config['copyright_text']); ?>
                    </div>
                    <ul class="footer-social-links">
                        <?php
                        if ($config['facebook_link'] != "")
                            echo '<li><a href="' . _esc($config['facebook_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>';
                        if ($config['twitter_link'] != "")
                            echo '<li><a href="' . _esc($config['twitter_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>';
                        if ($config['instagram_link'] != "")
                            echo '<li><a href="' . _esc($config['instagram_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a></li>';
                        if ($config['linkedin_link'] != "")
                            echo '<li><a href="' . _esc($config['linkedin_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a></li>';
                        if ($config['pinterest_link'] != "")
                            echo '<li><a href="' . _esc($config['pinterest_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a></li>';
                        if ($config['youtube_link'] != "")
                            echo '<li><a href="' . _esc($config['youtube_link'], false) . '" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a></li>';
                        ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
<?php
include_once TEMPLATE_PATH . '/overall_footer_dashboard.php';