<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
  <!-- Start main-content -->
  <div class="main-content-area">
   <?php include('slider.php'); ?>
   <!-- Section: about  -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2><?= lang('about_us'); ?></h2>
            <video class="elementor-video float-end" width="370"  src="<?= base_url('assets/uploads/videos/Planmeca Romexis 6.mp4');?>" autoplay="true" loop="true" controls="" muted="false" playsinline="" controlslist="nodownload"style="display: block; margin: 0 auto;"></video>

            <p><?= $about->description; ?></p>
            <div class="clearfix"></div>
            <a class="btn btn-hover" style="color: white;border-radius: 20px;box-shadow: 10px 10px 20px 0px rgb(189, 188, 188);" href="<?= shop_url('page/'.$about->slug); ?>" target="_blank">
              <span class="elementor-button-content-wrapper">
              <span class="elementor-button-icon elementor-align-icon-right">
              <i aria-hidden="true" class="fas fa-angle-right"></i>			</span>
              <span class="elementor-button-text"><?= lang('view_more'); ?></span>
              </span>
            </a>
          </div>
        </div>

      </div>

    </section>

     <!-- Section: category  -->

    <section class="bg-white-f5">

      <div class="container pb-70">

        <div class="mb-40" style="margin-top: -70px;display: flex;justify-content: space-between;"><span style="font-size: 25px;font-weight: 700;color: black;"><?= lang('category'); ?></span></span><a class="btn btn-hover" style="color: white;border-radius: 20px;box-shadow: 10px 10px 20px 0px rgb(189, 188, 188);" href="<?= shop_url('products'); ?>" target="_blank">
          <span class="elementor-button-content-wrapper">
          <span class="elementor-button-icon elementor-align-icon-right">
          <i aria-hidden="true" class="fas fa-angle-right"></i></span>
          <span class="elementor-button-text"><?= lang('view_more'); ?></span>
          </span>
        </a></div>
        <div class="section-content">
          <div class="row">
            <?php foreach($categories as $category){ ?>
              <!-- start category item -->
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="team-members border-bottom-theme-color-2px text-center maxwidth200 mb-30" style="height: 300px;">
                <div class="team-thumb">
                  <img class="img-fullwidth" alt="" src="<?= ($category->image != null) ? base_url('assets/uploads/'.$category->image) : base_url('assets/images/sma_no_image.png'); ?>" style="background-size: cover; width: 200px; height: 200px;">
                  <div class="team-overlay"></div>
                </div>
                <div class="team-details bg-white pt-10 pb-20">
                  <h3 class="mb-0"><?= $category->name; ?></h3>
                  <!-- <h6 class="text-theme-colored1 mb-10">Dentist Surgeon</h6> -->
                </div>
              </div>
            </div>
            <!-- end category item -->
          <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- pruduct -->
  <section class="divider">
    <div class="container pb-50">
      <div class="mb-40" style="margin-top: -70px;display: flex;justify-content: space-between;"><span style="font-size: 25px;font-weight: 700;color: black;"><?= lang('products'); ?></span></span><a class="btn btn-hover" style="color: white;border-radius: 20px;box-shadow: 10px 10px 20px 0px rgb(189, 188, 188);" href="<?= shop_url('products'); ?>" target="_blank">
        <span class="elementor-button-content-wrapper">
        <span class="elementor-button-icon elementor-align-icon-right">
        <i aria-hidden="true" class="fas fa-angle-right"></i>			</span>
        <span class="elementor-button-text"><?= lang('view_more'); ?></span>
        </span>
      </a></div>
      <div class="row">
        <div class="col-md-12">
          <div class="owl-carousel owl-theme tm-owl-carousel-4col owl-nav-top mb-sm-0" data-nav="true">
            <!-- start single product -->
            <?php foreach($featured_products as $product){ ?>
            <div class="item">
              <article class="post clearfix maxwidth600 mb-30 wow fadeInRight" data-wow-delay=".3s">
                <div class="entry-header">
                  <div class="post-thumb thumb">
                    <img src="<?= ($product->image != null) ? base_url('assets/uploads/'.$product->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="" class="img-responsive img-fullwidth" style="background-size: cover; width: 200px; height: 250px;">
                  </div>
                </div>
                <div class="bg-theme-colored1 text-center pt-10 pb-10">
                  <span class="mb-10 text-white mr-10 font-13"><i class="far fa-calendar-alt me-1 text-white"></i><?= $product->name; ?></span>
                </div>
              </article>
            </div>
          <?php } ?>
          <!-- end single product -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- supplier -->
  
  <section id="depertment" class="bg-silver-light">
      <div class="container">
        <div class="section-title text-center">
          <div class="row justify-content-md-center">
            <div class="col-md-8">
              <h2 class="text-uppercase mt-0 line-height-1"><?= lang('partners'); ?></h2>
              <p><?= lang('o_p_u'); ?></p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <?php foreach($partners as $partner){ ?>
            <div class="col-xs-12 col-sm-6 col-md-2 mb-30">
              <div class="p-20 bg-white border border-2 rounded border-success">
                <img src="<?= $partner->image ? base_url('assets/uploads/'.$partner->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="<?= $partner->name; ?>" style="background-size: cover;">           
              </div>
            </div>
          <?php } ?>
          
          </div>
        </div>
      </div>
    </section>
<!-- Event -->
  <section class="divider">
    <div class="container pb-50">
      <div class="mb-40" style="margin-top: -70px;display: flex;justify-content: space-between;"><span style="font-size: 25px;font-weight: 700;color: black;"><?= lang('events'); ?></span></span><a class="btn btn-hover" style="color: white;border-radius: 20px;box-shadow: 10px 10px 20px 0px rgb(189, 188, 188);" href="<?= shop_url('news_event'); ?>" target="_blank">
        <span class="elementor-button-content-wrapper">
        <span class="elementor-button-icon elementor-align-icon-right">
        <i aria-hidden="true" class="fas fa-angle-right"></i>			</span>
        <span class="elementor-button-text"><?= lang('view_more'); ?></span>
        </span>
      </a></div>
      <div class="row">
        <div class="col-md-12">
          <div class="owl-carousel owl-theme tm-owl-carousel-3col owl-nav-top mb-sm-0" data-nav="true">
            <!-- start event item -->
            <?php foreach($events as $event){ ?>
            <div class="item">
              <article class="post clearfix maxwidth600 mb-30 wow fadeInRight" data-wow-delay=".3s">
                <div class="image-box-thum">
                  <img class="img-fullwidth" src="<?= ($event->image != null) ? base_url('assets/uploads/'.$event->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images" style="background-size: cover; width: 200px; height: 250px;">
                </div>
                <div class="image-box-details text-center p-20 pt-30 pb-30 bg-white-f7">
                  <h3 class="title mt-0"><?= $event->title; ?></h3>
                  <p class="desc mb-20"><?= $event->description ? substr($event->description,0,150).' ...' : ''; ?></p>
                  <div class="tm-sc-button mb-15">
                    <a href="<?= shop_url('event_detail/'. $event->id); ?>" target="_self" class="btn btn-theme-colored1"><?= lang('read_more'); ?></a>
                  </div>
                </div>
              </article>
            </div>
          <?php } ?>
            <!-- end event item -->
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- news -->
<section class="divider">
  <div class="container pb-50">
    <div class="mb-40" style="margin-top: -70px;display: flex;justify-content: space-between;"><span style="font-size: 25px;font-weight: 700;color: black;"><?= lang('news'); ?></span></span><a class="btn btn-hover" style="color: white;border-radius: 20px;box-shadow: 10px 10px 20px 0px rgb(189, 188, 188);" href="<?= shop_url('news_event'); ?>" target="_blank">
      <span class="elementor-button-content-wrapper">
      <span class="elementor-button-icon elementor-align-icon-right">
      <i aria-hidden="true" class="fas fa-angle-right"></i>			</span>
      <span class="elementor-button-text"><?= lang('view_more'); ?></span>
      </span>
    </a></div>
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme tm-owl-carousel-3col owl-nav-top mb-sm-0" data-nav="true">
          <?php foreach($all_news as $news){ ?>
          <div class="item">
            <article class="post clearfix maxwidth600 mb-30 wow fadeInRight" data-wow-delay=".3s">
              <div class="image-box-thum">
                <img class="img-fullwidth" src="<?= ($news->image != null) ? base_url('assets/uploads/'.$news->image) : base_url('assets/images/sma_no_image.png');  ?>" alt="images" style="background-size: cover; width: 200px; height: 250px;">
              </div>
              <div class="image-box-details text-center p-20 pt-30 pb-30 bg-white-f7">
                <h3 class="title mt-0"><?= $news->title; ?></h3>
                <p class="desc mb-20"><?= $news->description ? substr($news->description,0,200).' ...' : ''; ?></p>
                <div class="tm-sc-button mb-15">
                  <a href="<?= shop_url('news_details/'.$news->id); ?>" target="_self" class="btn btn-theme-colored1"><?= lang('read_more'); ?></a>
                </div>
              </div>
            </article>
          </div>
          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>
</section>