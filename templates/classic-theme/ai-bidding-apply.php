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

                        .job-card, .card {
                            display: block;
                            background-color: #fff;
                            margin-top: 30px;
                            border-radius: 9px;
                            border: 1px solid #e5e7eb;
                            box-shadow: none;
                            transition: 0.3s;
                            padding: 20px;
                        }

                        .job-card:hover, .card:hover {
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


                        p.text-danger {
                            color: red;
                        }

                        .card label {
                            font-weight: bold;
                        }

                    </style>
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
                                - <?php echo $project['currency']['sign'] . $project['budget']['maximum']; ?> <?php echo $project['type'] == 'fixed' ? $project['currency']['code'] : 'per hour' ?>
                            </p>
                            <p><?php echo $project['preview_description'] ?>
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
                                    'stars' => $project['owner']['employer_reputation']['entire_history']['overall']
                                ]);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php if ($bid == null) : ?>
                    <form method="post"
                          action="<?php echo url('AI_BIDDING_APPLY') ?>?project=<?php echo $project['id'] ?>"
                          class="card">
                        <h2 class="title">Apply Job</h2>
                        <table style="width: 100%; margin-top: 10px">
                            <tr>
                                <td style="padding-right: 5px">
                                    <label for="amount">Bid Amount</label>
                                    <input type="number" name="amount" id="amount"/>
                                </td>
                                <td style="padding-left: 5px">
                                    <label for="period">This project will be delivered in (Days)</label>
                                    <input type="number" name="period" id="period"/>
                                </td>
                            </tr>
                        </table>
                        <label for="description">Describe your proposal (minimum 100 characters)</label>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        <?php if ($error) : ?>
                            <p class="text-danger">*<?php echo $error; ?></p>
                        <?php endif; ?>

                        <input type="hidden" name="project" id="project" value="<?php echo $project['id'] ?>"/>
                        <input type="submit" value="Apply Now" class="button"/>
                        <!--to be sent from backend-->
                        <!--<input type="hidden" name="bidder_id" id="bidder_id"/>-->
                        <!--<input type="hidden" name="profile_id" id="profile_id"/>-->
                    </form>
                <?php else : ?>
                    <div class="card">
                        <?php if ($bid['award_status'] == null) : ?>
                            <p>You have already applied to this job</p>
                        <?php else : ?>
                            <p>Your bid status is : <?php echo $bid['award_status'] ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif ?>

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