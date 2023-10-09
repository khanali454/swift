<?php
overall_header(__("AI Bidding"));
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
                        <?php _e("AI Bidding") ?>
                    </h3>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="<?php url("INDEX") ?>"><?php _e("Home") ?></a></li>
                            <li><?php _e("AI Bidding") ?></li>
                        </ul>
                    </nav>
                    <?php include 'partials/freelancer-logout.php'; ?>
                </div>


                <div class="margin-top-0">

                    <style>
                        .job-listings {
                            padding: 50px;
                        }

                        .job-card {
                            display: block;
                            background-color: #fff;
                            margin-top: 30px;
                            border-radius: 9px;
                            border: 1px solid #e5e7eb;
                            box-shadow: none;
                            transition: 0.3s;
                            padding: 20px;
                        }

                        .job-card:hover {
                            box-shadow: 0 2px 8px rgb(0 0 0 / 8%);
                            transform: translateY(-3px);
                        }

                        .job-card .job-card-header {
                            padding: 20px 30px;
                            border-bottom: 1px solid #f2f4ff;
                            display: flex;
                            flex-wrap: wrap;
                            flex-direction: row;
                            justify-content: space-between;
                        }

                        .job-card .job-description {
                            font-size: 14px;
                            line-height: 1.5;
                            color: #6b7280 !important;
                            padding: 20px 30px;

                        }

                        #pagination button {
                            margin: 20px auto;
                        }

                    </style>
                    <div class="job-listings" id="jobListings">
                        <!-- Example Card - Repeat this block for each job -->
                        <?php foreach ($result['projects'] as $project): ?>
                            <div class="job-card">
                                <div class="job-card-header">
                                    <h2><b><?php echo $project['title']; ?></b></h2>
                                    <div>
                                        <span style="margin-right: 20px"><?php echo $project['bid_stats']['bid_count'] ?> bids</span>
                                        <span><b><?php echo $project['currency']['sign'] ?><?php echo $project['bid_stats']['bid_avg'] ? round($project['bid_stats']['bid_avg'], 2) : $project['budget']['maximum'] ?><?php echo $project['type'] == 'fixed' ? $project['currency']['code'] : 'per hour' ?></b></span>
                                    </div>
                                </div>
                                <div class="job-description">
                                    <p style="font-size: 13px">
                                        Budget <?php echo $project['currency']['sign'] . $project['budget']['minimum']; ?>
                                        - <?php echo $project['currency']['sign'] . $project['budget']['maximum']; ?> <?php echo $project['type'] == 'fixed' ? $project['currency']['code'] : 'per hour' ?> </p>
                                    <p><?php echo $project['preview_description'] ?>...
                                        <a href="<?php url('AI_BIDDING_APPLY') ?>?project=<?php echo $project['id'] ?>">
                                            Read More
                                        </a>
                                    </p>
                                    <p style="font-size: 13px">
                                        <span>Skills : </span>
                                        <?php foreach ($project['jobs'] as $job) : ?>
                                            <span><?php echo $job['name'] ?></span>
                                            <span>, </span>
                                        <?php endforeach; ?>
                                    </p>
                                    <p>
                                        <?php
                                        HtmlTemplate::display('partials/star-rating', [
                                            'stars' => $result['users'][$project['owner_id']]['employer_reputation']['entire_history']['overall']
                                        ]);
                                        ?>
                                    </p>
                                </div>
                                <div style="text-align: right">
                                    <a href="<?php url('AI_BIDDING_APPLY') ?>?project=<?php echo $project['id'] ?>"
                                       class="button ripple-effect">
                                        Apply Now
                                        <i class="icon-feather-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- End of Job Card -->
                    </div>
                    <div id="pagination" style="text-align: right; font-size: 30px">
                        <div>
                            <?php if ($_GET['page'] && is_numeric($_GET['page']) && $_GET['page'] > 1) : ?>
                                <a href="<?php url('AI_BIDDING') ?>?page=<?php echo $_GET['page'] - 1 ?>"><i
                                            class="icon-feather-arrow-left-circle"></i></a>
                            <?php endif; ?>
                            <?php if (count($result['projects']) == $limit) : ?>
                                <a href="<?php url('AI_BIDDING') ?>?page=<?php echo $_GET['page'] && is_numeric($_GET['page']) ? $_GET['page'] + 1 : 2 ?>"><i
                                            class="icon-feather-arrow-right-circle"></i></a>
                            <?php endif; ?>
                        </div>
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