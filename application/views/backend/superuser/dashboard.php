<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $this->db->get('user')->num_rows(); ?></h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?php echo site_url('superuser/user/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $this->db->get_where('user', array('user_type !=' => 'EMPLOYEE'))->num_rows(); ?></h3>
                            <p>Total Special User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <a href="<?php echo site_url('superuser/user/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $this->db->get_where('login_log', array('DATE_FORMAT(log_time,"%Y-%m-%d")' => date('Y-m-d'), 'log_status' => 'Success'))->num_rows(); ?></h3>
                            <p>Total Today's Login Success</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <a href="<?php echo site_url('superuser/log/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $this->db->get_where('login_log', array('DATE_FORMAT(log_time,"%Y-%m-%d")' => date('Y-m-d'), 'log_status' => 'Failed'))->num_rows(); ?></h3>
                            <p>Total Today's Login Failed</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <a href="<?php echo site_url('superuser/log/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-globe-asia"></i>&nbsp;&nbsp;Login Log This Month</h5>
                        </div>
                        <div class="card-body">
                            <!-- Styles -->
                            <style>
                            #chartdiv {
                            width: 100%;
                            height: 500px;
                            }

                            </style>

                            <!-- Resources -->
                            <script src="https://www.amcharts.com/lib/4/core.js"></script>
                            <script src="https://www.amcharts.com/lib/4/charts.js"></script>
                            <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

                            <!-- Chart code -->
                            <script>
                            am4core.ready(function() {

                            // Themes begin
                            am4core.useTheme(am4themes_animated);
                            // Themes end

                            // Create chart instance
                            var chart = am4core.create("chartdiv", am4charts.XYChart);

                            // Add data
                            chart.data = [
                                <?php
                                    foreach ($graph as $data) {
                                        echo "{ 'date' : '" . $data->log_time ."',";
                                        echo "'value' : " . $data->total ."},";
                                    }
                                ?>];

                            // Set input format for the dates
                            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

                            // Create axes
                            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                            // Create series
                            var series = chart.series.push(new am4charts.LineSeries());
                            series.dataFields.valueY = "value";
                            series.dataFields.dateX = "date";
                            series.tooltipText = "{value}"
                            series.strokeWidth = 2;
                            series.minBulletDistance = 15;

                            // Drop-shaped tooltips
                            series.tooltip.background.cornerRadius = 20;
                            series.tooltip.background.strokeOpacity = 0;
                            series.tooltip.pointerOrientation = "vertical";
                            series.tooltip.label.minWidth = 40;
                            series.tooltip.label.minHeight = 40;
                            series.tooltip.label.textAlign = "middle";
                            series.tooltip.label.textValign = "middle";

                            // Make bullets grow on hover
                            var bullet = series.bullets.push(new am4charts.CircleBullet());
                            bullet.circle.strokeWidth = 2;
                            bullet.circle.radius = 4;
                            bullet.circle.fill = am4core.color("#fff");

                            var bullethover = bullet.states.create("hover");
                            bullethover.properties.scale = 1.3;

                            // Make a panning cursor
                            chart.cursor = new am4charts.XYCursor();
                            chart.cursor.behavior = "panXY";
                            chart.cursor.xAxis = dateAxis;
                            chart.cursor.snapToSeries = series;

                            // Create vertical scrollbar and place it before the value axis
                            chart.scrollbarY = new am4core.Scrollbar();
                            chart.scrollbarY.parent = chart.leftAxesContainer;
                            chart.scrollbarY.toBack();

                            // Create a horizontal scrollbar with previe and place it underneath the date axis
                            chart.scrollbarX = new am4charts.XYChartScrollbar();
                            chart.scrollbarX.series.push(series);
                            chart.scrollbarX.parent = chart.bottomAxesContainer;

                            dateAxis.start = 0.79;
                            dateAxis.keepSelection = true;


                            }); // end am4core.ready()
                            </script>

                            <!-- HTML -->
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->