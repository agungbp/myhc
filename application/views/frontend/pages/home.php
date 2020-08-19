<!-- Start Slider Area -->
<div class="slider__container">
            <div class="slider__activation__wrap owl-carousel owl-theme">
                <!-- Start Single Slide -->
                <div class="slide slider__fixed--height slide__align--center" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url();?>assets/frontend3/images/slider/bg/JNE1.jpg) no-repeat scroll 0 0 / cover;" data--black__overlay="6">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="slider__inner">
                                    <h4>ERECRUITMENT</h4>
                                    <h1>JNE EXPRESS BANDUNG</h1>
                                    <p>Kami mengajak talenta di seluruh Indonesia untuk bergabung bersama lebih dari 40.000 Karyawan JNE.</p>
                                    <div class="slider__btn">
                                        <a class="htc__btn" href="<?php echo site_url('erecruitment/login'); ?>">DAFTAR SEKARANG</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="slide slider__fixed--height slide__align--center" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url();?>assets/frontend3/images/slider/bg/JNE5.jpg) no-repeat scroll 0 0 / cover;" data--black__overlay="6">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="slider__inner">
                                    <h4>ERECRUITMENT</h4>
                                    <h1>JNE EXPRESS BANDUNG</h1>
                                    <p>Kami mengajak talenta di seluruh Indonesia untuk bergabung bersama lebih dari 40.000 Karyawan JNE.</p>
                                    <div class="slider__btn">
                                        <a class="htc__btn" href="<?php echo site_url('erecruitment/login'); ?>">DAFTAR SEKARANG</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- Start Slider Area -->
        <!-- Start About Area -->
        <section class="htc__about__area about--2 text__pos ptb--150 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title text-center">
                            <h2 class="title__line">PROFIL <span class="text--theme">JNE Express</span></h2>
                            <p>Dengan pengalaman selama 29 tahun, JNE melayani kebutuhan pelanggan setianya, dengan jasa pengiriman dalam dan luar negeri.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt--70">
                    <div class="col-md-4 col-lg-3 col-lg-offset-1 col-sm-6 col-xs-12">
                        <div class="about foo">
                            <div class="about__inner">
                                <h2>SEJARAH</h2>
                                <p>Didirikan tahun 1990, JNE melayani masyarakat dalam urusan jasa kepabeanan terutama import atas kiriman peka waktu melalui gudang 'Rush Handling'</p><br>
                            </div>
                            <div class="about__inner about__hober__info">
                                <h2>SEJARAH</h2>
                                <p>Didirikan tahun 1990, JNE melayani masyarakat dalam urusan jasa kepabeanan terutama import atas kiriman peka waktu melalui gudang 'Rush Handling'</p><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
                        <div class="about foo">
                            <div class="about__inner">
                                <h2>VISI & MISI</h2>
                                <p>
                                    Untuk menjadi perusahaan rantai pasok global terdepan di dunia<br>
                                    Untuk memberi pengalaman terbaik kepada pelanggan secara konsisten
                                </p><br><br>
                            </div>
                            <div class="about__inner about__hober__info active">
                                <h2>VISI & MISI</h2>
                                <p>
                                    Untuk menjadi perusahaan rantai pasok global terdepan di dunia<br><br>
                                    Untuk memberi pengalaman terbaik kepada pelanggan secara konsisten
                                </p><br><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 hidden-sm col-xs-12">
                        <div class="about foo">
                            <div class="about__inner">
                                <h2>PENGHARGAAN</h2>
                                <p>Kehandalan dan komitmen JNE terbukti dengan diraihnya berbagai bentuk penghargaan serta sertifikasi ISO 9001:2008 atas sistem manajemen mutu.</p><br>
                            </div>
                            <div class="about__inner about__hober__info">
                                <h2>PENGHARGAAN</h2>
                                <p>Kehandalan dan komitmen JNE terbukti dengan diraihnya berbagai bentuk penghargaan serta sertifikasi ISO 9001:2008 atas sistem manajemen mutu.</p><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Area -->
        <!-- Start Blog Area -->
        <section class="htc__blog__area pt--150 bg__gray">
            <div class="container">
                <div class="row">
                    <div class="section__title text-center">
                        <h2 class="title__line">DAFTAR <span class="text--theme">LOWONGAN</span></h2>
                        <p>Kami mencari profesional-profesional yang berpengalaman, memiliki tanggung jawab tinggi, dan menyukai tantangan untuk bergabung bersama JNE Express Bandung.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="htc__blog__wrap mt--30 clearfix">
                        <?php 
                            $vacancy = $this->db->query("SELECT * FROM vacancy WHERE vacancy_lastdate >= DATE(NOW()) AND user_type = 'CANDIDATE'"); 
                            $available = $vacancy->num_rows();

                            if ($available > 0) {
                                foreach ($vacancy->result_array() as $row):
                        ?>
                                    <!-- Start Single Blog -->
                                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
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
                                                <h2><a href="<?php echo site_url('erecruitment/vacancy/details/'. $row['vacancy_id']); ?>"> <?php echo $row['vacancy_position'] . ' ' . $row['vacancy_level']; ?> </a></h2>
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
                            <br><br>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <p class="text-center">Tidak ada lowongan tersedia. </p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div><br><br><br><br><br><br>
        </section>
        <!-- End Blog Area -->
        <!-- Start Counter Up Area -->
        <section class="htc__counterup__area ptb--50" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url();?>assets/frontend3/images/slider/bg/banner-4.jpg) no-repeat scroll center center / cover ;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="htc__counterup__wrap">
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__count ">
                                            <span class="count text-white">40000</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>KARYAWAN</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__count ">
                                            <span class="count">6000</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>TITIK LAYANAN</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__count ">
                                            <span class="count">18</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>PRODUK</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                            <!-- Start Single Fact -->
                            <div class="funfact">
                                <div class="fact__details">
                                    <div class="funfact__count__inner">
                                        <div class="fact__count ">
                                            <span class="count">111</span>
                                        </div>
                                    </div>
                                    <div class="fact__title">
                                        <h2>PENGHARGAAN</h2>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Single Fact -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Counter Up Area -->
        <!-- Start Brand Area -->
        <div class="htc__brand__area">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="brand__list">
                            <li><img src="<?php echo base_url();?>assets/frontend3/images/slider/bg/product-logo-4.jpg" width="100"></li>
                            <li><img src="<?php echo base_url();?>assets/frontend3/images/slider/bg/product-logo-5.jpg" width="100"></li>
                            <li><img src="<?php echo base_url();?>assets/frontend3/images/slider/bg/product-logo-3.jpg" width="100"></li>
                            <li><img src="<?php echo base_url();?>assets/frontend3/images/slider/bg/product-logo-6.png" width="100"></li>
                            <li><img src="<?php echo base_url();?>assets/frontend3/images/slider/bg/product-logo-24.png" width="100"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Brand Area -->