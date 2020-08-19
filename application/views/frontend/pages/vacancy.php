<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url();?>assets/frontend3/images/slider/bg/JNE4-1.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Lowongan</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?php echo site_url('erecruitment'); ?>">Home</a>
                                  <span class="brd-separetor">-</span>
                                  <span class="breadcrumb-item active">Lowongan</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Blog Area -->
        <section class="htc__blog__area ptb--150 bg__white">
            <div class="container">
                <div class="row">
                    <div class="htc__blog__wrap clearfix blog--two">
                        <?php 
                            $vacancy = $this->db->query("SELECT * FROM vacancy WHERE vacancy_lastdate >= DATE(NOW()) AND user_type = 'CANDIDATE'"); 
                            $available = $vacancy->num_rows();

                            if ($available > 0) {
                                foreach ($vacancy->result_array() as $row):
                        ?>
                        <!-- Start Single Blog -->
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="blog foo">
                                <div class="blog__thumb">
                                    <a href="<?php echo site_url('erecruitment/vacancy/details/'. $row['vacancy_id']); ?>">
                                        <img src="<?php echo $this->get_model->get_image_vacancy_url($row['vacancy_images']); ?>">
                                    </a>
                                    <div class="blog__hover__info">
                                        <ul class="blog__meta">
                                            <li><?php echo date_format(date_create($row['vacancy_publishdate']),"d F Y") . ' - ' . date_format(date_create($row['vacancy_lastdate']),"d F Y"); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog__details">
                                    <h2><a href="<?php echo site_url('erecruitment/vacancy/details/'. $row['vacancy_id']); ?>"><?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?></a></h2>
                                    <div class="blog__btn">
                                        <a href="<?php echo site_url('erecruitment/vacancy/details/'. $row['vacancy_id']); ?>">SELENGKAPNYA<i class="zmdi zmdi-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                        <?php 
                                endforeach; 
                            } else {
                        ?>  
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <p class="text-center">Tidak ada lowongan tersedia</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog Area -->