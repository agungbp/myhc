<?php 
    $details = $this->db->get_where('vacancy', array('vacancy_id' => $vacancy_id))->result_array();

    foreach ($details as $row):
?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url();?>assets/frontend3/images/slider/bg/JNE4-1.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Detail Lowongan</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo site_url('erecruitment'); ?>">Home</a>
                                  <span class="brd-separetor">-</span>
                                  <span class="breadcrumb-item active">Detail Lowongan</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Blog Area -->
        <section class="htc__blog__details__page blog--details ptb--150 bg__white">
            <div class="container">
                <div class="row">
                	<div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                        <div class="htc__bl__dtl__inner">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="<?php echo $this->get_model->get_image_vacancy_url($row['vacancy_images']); ?>" alt="blog image">
                                    <div class="blog__hover__info">
                                        <ul class="blog__meta">
                                            <li><?php echo date_format(date_create($row['vacancy_publishdate']),"d F Y") . ' - ' . date_format(date_create($row['vacancy_lastdate']),"d F Y"); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="htc__blog__details">
                                    <h2><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></h2>
                                    <div class="bl__dtl">
                                        <p class="text text-bold" style="margin-bottom: -20px;">Job Descriptions </p>
                                        <p style="margin-bottom: 30px;"><?php echo nl2br($row['vacancy_jobdesc']); ?></p>
                                    </div>
                                    <div class="bl__dtl">
                                        <p class="text text-bold" style="margin-bottom: -20px;">Kriteria</p>
                                        <p><?php echo nl2br($row['vacancy_requirements']); ?></p>
                                    </div>
                                </div><br>
                                <div class="contact-btn">
                                    <a href="<?php echo site_url('erecruitment/login'); ?>" class="htc__btn btn--theme">Login untuk melamar</a>
                                </div>
                            </div>
                        </div>
                	</div>
                	<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 smt-40 xmt-40">
                		<div class="htc__page__sidebar">
                			<!-- Start Single -->
                			<div class="htc__recent__post bg__gray sidebar__separator">
                				<h2 class="sidebar__title">Lowongan Lainnya</h2>
                				<div class="recent__post__wrap">
                                    <?php 
                                        $vacancy = $this->db->query("SELECT * FROM vacancy WHERE vacancy_lastdate >= DATE(NOW()) AND user_type = 'CANDIDATE'");
                                        foreach ($vacancy->result_array() as $row1): 
                                    ?>
                                            <div class="htc__single__post">
                                                <div class="post__thumb">
                                                    <a href="<?php echo site_url('erecruitment/vacancy/details/'. $row1['vacancy_id']); ?>"><img src="<?php echo $this->get_model->get_image_vacancy_url($row1['vacancy_images']); ?>" width="70px"></a>
                                                </div>
                                                <div class="post__details">
                                                    <h4><a href="<?php echo site_url('erecruitment/vacancy/details/'. $row1['vacancy_id']); ?>"><?php echo $row1['vacancy_position'] . ' ' . $row['vacancy_level']; ?></a></h4>
                                                    <div class="post__meta">
                                                        <span><?php echo 'Berakhir ' . date_format(date_create($row1['vacancy_lastdate']),"d F Y"); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endforeach; ?>
                                </div>
                                
                			</div>
                			<!-- End Single -->
                		</div>
                	</div>
                </div>
            </div>
        </section>
        <!-- End Blog Area -->
<?php endforeach; ?>