<?php
overall_header(__("Auto Bidding"));
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
                    <form action="<?php url('AUTO_BIDDING_SETTING') ?>" method="post">
                        <div>
                            <label for="status">Status</label>
                            <select name="status" id="status">
                                <option value="enable">Enable</option>
                                <option value="disable"
                                    <?php echo $options['status'] == 'disable' ? 'selected' : '' ?>
                                >
                                    Disable
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="delay">Delay (Seconds)</label>
                            <input type="number" placeholder="60" name="delay" id="delay"
                                   value="<?php echo $options['delay'] ?>"/>
                        </div>
                        <div>
                            <label for="interval">Time Interval</label>
                            <select name="interval" id="interval">
                                <option value="1" <?php echo $options['interval'] == '1' ? 'selected' : '' ?> >
                                    Every 1 minute
                                </option>
                                <option value="2" <?php echo $options['interval'] == '2' ? 'selected' : '' ?> >
                                    Every 2 minute
                                </option>
                                <option value="3" <?php echo $options['interval'] == '3' ? 'selected' : '' ?> >
                                    Every 3 minute
                                </option>
                                <option value="4" <?php echo $options['interval'] == '4' ? 'selected' : '' ?> >
                                    Every 4 minute
                                </option>
                                <option value="5" <?php echo $options['interval'] == '5' ? 'selected' : '' ?> >
                                    Every 5 minute
                                </option>
                                <option value="6" <?php echo $options['interval'] == '6' ? 'selected' : '' ?> >
                                    Every 6 minute
                                </option>
                                <option value="7" <?php echo $options['interval'] == '7' ? 'selected' : '' ?> >
                                    Every 7 minute
                                </option>
                                <option value="8" <?php echo $options['interval'] == '8' ? 'selected' : '' ?> >
                                    Every 8 minute
                                </option>
                                <option value="9" <?php echo $options['interval'] == '9' ? 'selected' : '' ?> >
                                    Every 9 minute
                                </option>
                            </select>
                        </div>
                        <div style="display: none">
                            <label for="time-limit">Time Limit</label>
                            <select name="time-limit" id="time-limit">
                                <option value="-1">No time limit</option>
                                <option <?php echo $options['time-limit'] == '1' ? 'selected' : '' ?> value="1">
                                    Turn off after 1 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '2' ? 'selected' : '' ?> value="2">
                                    Turn off after 2 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '3' ? 'selected' : '' ?> value="3">
                                    Turn off after 3 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '4' ? 'selected' : '' ?> value="4">
                                    Turn off after 4 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '5' ? 'selected' : '' ?> value="5">
                                    Turn off after 5 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '6' ? 'selected' : '' ?> value="6">
                                    Turn off after 6 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '7' ? 'selected' : '' ?> value="7">
                                    Turn off after 7 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '8' ? 'selected' : '' ?> value="8">
                                    Turn off after 8 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '9' ? 'selected' : '' ?> value="9">
                                    Turn off after 9 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '10' ? 'selected' : '' ?> value="10">
                                    Turn off after 10 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '11' ? 'selected' : '' ?> value="11">
                                    Turn off after 11 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '12' ? 'selected' : '' ?> value="12">
                                    Turn off after 12 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '13' ? 'selected' : '' ?> value="13">
                                    Turn off after 13 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '14' ? 'selected' : '' ?> value="14">
                                    Turn off after 14 hour
                                </option>
                                <option <?php echo $options['time-limit'] == '15' ? 'selected' : '' ?> value="15">
                                    Turn off after 15 hour
                                </option>
                            </select>
                        </div>
                        <div style="display: none">
                            <label for="bids-limit">Bids Limit</label>
                            <select name="bids-limit" id="bids-limit">
                                <option value="-1">No Bids limit</option>
                                <option <?php echo $options['bids-limit'] == '10' ? 'selected' : '' ?> value="10">
                                    Turn off after 10 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '20' ? 'selected' : '' ?> value="20">
                                    Turn off after 20 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '30' ? 'selected' : '' ?> value="30">
                                    Turn off after 30 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '40' ? 'selected' : '' ?> value="40">
                                    Turn off after 40 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '50' ? 'selected' : '' ?> value="50">
                                    Turn off after 50 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '70' ? 'selected' : '' ?> value="70">
                                    Turn off after 70 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '80' ? 'selected' : '' ?> value="80">
                                    Turn off after 80 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '90' ? 'selected' : '' ?> value="90">
                                    Turn off after 90 bids
                                </option>
                                <option <?php echo $options['bids-limit'] == '100' ? 'selected' : '' ?> value="100">
                                    Turn off after 100 bids
                                </option>
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="save" class="button">
                        </div>
                    </form>
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