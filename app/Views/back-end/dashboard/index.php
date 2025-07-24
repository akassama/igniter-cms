<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4">Dashboard </h1>
<?php
    // Breadcrumbs
    $breadcrumb_links = array(
        array('title' => 'Dashboard')
    );
    echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        Users
                        <span class="badge rounded-pill bg-dark border border-light">
                            <?= getTotalRecords("users") ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('/account/admin/users'); ?>">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        Blogs
                        <span class="badge rounded-pill bg-dark border border-light">
                            <?= getTotalRecords("blogs") ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('/account/cms/blogs'); ?>">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        Pages
                        <span class="badge rounded-pill bg-dark border border-light">
                            <?= getTotalRecords("pages") ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('/account/cms/pages'); ?>">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        Themes
                        <span class="badge rounded-pill bg-dark border border-light">
                            <?= getTotalRecords("themes") ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('/account/themes'); ?>">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Site Analytics-->
        <div class="row">
            <div class="col-12">
                <h4 class="text-start">
                    Site Analytics
                </h4>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-chart-area me-1"></i>
                        Recent Visits (Last 7 Days)
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    <script>
                        $(document).ready(function(){
                            // Set new default font family and font color to mimic Bootstrap's default styling
                            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                            Chart.defaults.global.defaultFontColor = '#292b2c';

                            // Data for the chart
                            const labels = [<?= getLastSevenDaysList() ?>]; // Last 7 days
                            const data = [<?= getLastSevenDaysListCount() ?>]; // Dynamic visit counts

                            // Calculate dynamic max value for the y-axis
                            const maxDataValue = Math.max(...data);
                            const dynamicMax = Math.ceil(maxDataValue * 1.2); // Add 20% buffer above the maximum value

                            // Area Chart
                            var ctx = document.getElementById("myAreaChart");
                            var myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: "Sessions",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(2,117,216,0.2)",
                                        borderColor: "rgba(2,117,216,1)",
                                        pointRadius: 5,
                                        pointBackgroundColor: "rgba(2,117,216,1)",
                                        pointBorderColor: "rgba(255,255,255,0.8)",
                                        pointHoverRadius: 5,
                                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                        pointHitRadius: 50,
                                        pointBorderWidth: 2,
                                        data: data,
                                    }],
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            time: {
                                                unit: 'date'
                                            },
                                            gridLines: {
                                                display: false
                                            },
                                            ticks: {
                                                maxTicksLimit: 7
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                max: dynamicMax, // Dynamically set max value
                                                maxTicksLimit: 5
                                            },
                                            gridLines: {
                                                color: "rgba(0, 0, 0, .125)",
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    }
                                }
                            });

                        });
                    </script>

                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-chart-bar me-1"></i>
                        Recent Visits (Last 6 Months)
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    <script>
                        $(document).ready(function(){
                            // Set new default font family and font color to mimic Bootstrap's default styling
                            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                            Chart.defaults.global.defaultFontColor = '#292b2c';

                            // Data for the chart
                            const labels2 = [<?=getLastMonthsList()?>]; // Last 6 months
                            const data2 = [<?= getLastMonthsListCount() ?>]; // Dynamic visit counts

                            // Calculate dynamic max value for the y-axis
                            const maxDataValue2 = Math.max(...data2);
                            const dynamicMax2 = Math.ceil(maxDataValue2 * 1.2); // Add 20% buffer above the maximum value

                            // Bar Chart
                            var ctx = document.getElementById("myBarChart");
                            var myLineChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels2,
                                datasets: [{
                                label: "Visits",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: data2,
                                }],
                            },
                            options: {
                                scales: {
                                xAxes: [{
                                    time: {
                                    unit: 'month'
                                    },
                                    gridLines: {
                                    display: false
                                    },
                                    ticks: {
                                    maxTicksLimit: 6
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                    min: 0,
                                    max: dynamicMax2,
                                    maxTicksLimit: 5
                                    },
                                    gridLines: {
                                    display: true
                                    }
                                }],
                                },
                                legend: {
                                display: false
                                }
                            }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        
        <!--Site Analytics-->
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-chart-area me-1"></i>
                        Most Pages Visited
                    </div>
                    <div class="card-body">
                        <?=getMostVisitedPages()?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">
                        <i class="fas fa-chart-bar me-1"></i>
                        Top Browsers
                    </div>
                    <div class="card-body">
                        <?=getTopBrowsers()?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="custom-analytics"></div>

        <!--Recent Posts-->
        <div class="card mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-table me-1"></i>
                Recent Posts
            </div>
            <div class="card-body">
                <?=getRecentPosts()?>
            </div>
        </div>

        <!--News Feed-->
        <div class="card mb-4">
            <?php
                $newsFeedUrl = "https://ignitercms.com/api/igniter-cms-news-feed";
                try {
                    // Attempt to fetch the news feed
                    $newsFeedJson = @file_get_contents($newsFeedUrl);
                    
                    if ($newsFeedJson === false) {
                        throw new Exception("Failed to fetch news feed. Please try again later.");
                    }
                    
                    $newsFeed = json_decode($newsFeedJson, true);
                    
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new Exception("Failed to parse news feed data.");
                    }
                    
                    if (empty($newsFeed)) {
                        throw new Exception("No news items available at this time.");
                    }
                ?>
                <div class="card-header fw-bold">
                    <i class="fas fa-table me-1"></i>
                    News Feed
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($newsFeed as $news) { ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?php echo htmlspecialchars($news['image']); ?>" class="card-img-top" alt="News Image">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo htmlspecialchars($news['title']); ?>
                                            <?php if ($news['category'] === "Security") { ?>
                                                <i class="ri-shield-keyhole-line text-danger security-news-feed"></i>
                                            <?php } ?>
                                        </h5>
                                        <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($news['date']); ?></small></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="<?php echo htmlspecialchars($news['link']); ?>" target="_blank" class="btn btn-outline-primary">
                                            Read More <i class="ri-arrow-right-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php
            } catch (Exception $e) {
                // Display error message if something goes wrong
                echo '<div class="card-body text-center text-muted py-5">';
                echo '<i class="ri-error-warning-line display-6 mb-3"></i>';
                echo '<p class="mb-0">' . htmlspecialchars($e->getMessage()) . '</p>';
                echo '</div>';
            }
            ?>
        </div>

    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
