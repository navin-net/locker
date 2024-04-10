<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Start main-content -->
<div class="main-content-area">
<!-- Section: page title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets?>images/bg/bg1.jpg">
  <div class="container pt-50 pb-50">
    <div class="section-content">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="title"><?= lang('event_detail'); ?></h2>
          <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
            <div class="breadcrumbs">
              <span><a href="#" rel="home"><?= lang('home'); ?></a></span>
              <span><i class="fa fa-angle-right"></i></span>
              <span><a href="#"><?= lang('pages'); ?></a></span>
              <span><i class="fa fa-angle-right"></i></span>
              <span class="active"><?= lang('event_detail'); ?></span>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-theme-colored1">
  <div class="container pt-40 pb-40">
    <div class="row text-center">
      <div class="col-md-12">
        <h2 id="basic-coupon-clock" class="text-white"></h2>
        <!-- Final Countdown Timer Script -->
        <script>
          (function($) {
            $('#basic-coupon-clock').countdown('<?= date('Y/m/d', strtotime($event_detail->end_date));?>', function(event) {
              $(this).html(event.strftime('%D <?= lang('days'); ?> %H:%M:%S'));
            });
          })(jQuery);
        </script>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <ul class="list-style-none">
          <li>
            <h5><?= lang('topics'); ?>:</h5>
            <?= $event_detail->title; ?>
          </li>
          <li>
            <h5><?= lang('host'); ?>:</h5>
            <?php 
            foreach($speakers as $speak){
             echo  $speak->name.'<br>';
            }
            ?>
          </li>
          <li>
            <h5><?= lang('location'); ?>:</h5>
            <?= $event_detail->location; ?>
          </li>
          <li>
            <h5><?= lang('start_date'); ?>:</h5>
            <?= $event_detail->start_date; ?>
          </li>
          <li>
            <h5><?= lang('end_date'); ?>:</h5>
            <?= $event_detail->end_date; ?>
          </li>
          <li>
            <h5><?= lang('share'); ?>:</h5>
            <div class="styled-icons icon-sm icon-gray icon-circled">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= shop_url('event_detail/'.$event_detail->id); ?>"><i class="fab fa-facebook"></i></a>
              <a href="https://twitter.com/intent/tweet?text=<?= $event_detail->title; ?>&url=<?= shop_url('event_detail/'.$event_detail->id); ?>"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/sharer.php?u=<?= shop_url('event_detail/'.$event_detail->id); ?>"><i class="fab fa-instagram"></i></a>
              <a href="https://plus.google.com/share?url=<?= shop_url('event_detail/'.$event_detail->id); ?>"><i class="fab fa-google-plus"></i></a>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-md-8">
        <img src="<?= ($event_detail->image != null) ? base_url('assets/uploads/'.$event_detail->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images">
      </div>
    </div>
    <div class="row mt-60">
      <div class="col-md-12">
        <h4 class="mt-0"><?= lang('event_description'); ?></h4>
        <p><?= $event_detail->description; ?></p>
      </div>
      <!-- <div class="col-md-6">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
        </blockquote>
      </div> -->
    </div>
    <div class="row mt-40">
      <div class="col-md-12">
        <h4 class="mb-20"><?= lang('keynote_speakers'); ?></h4>
        <div class="tm-owl-carousel-6col" data-nav="true">
          <?php foreach($speakers as $speak){ ?>
          <div class="item">
            <div class="attorney">
              <div class="thumb"><img src="<?= ($speak->image != null) ? base_url('assets/uploads/'.$speak->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images"></div>
              <div class="content text-center">
                <h5 class="author mb-0"><a class="text-theme-colored1" href="#"><?= $speak->name; ?></a></h5>
                <h6 class="title text-gray font-12 mt-0 mb-0"><?= $speak->company; ?></h6>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section: Registration Form -->
<section class="layer-overlay overlay-white-8" data-tm-bg-img="<?= $assets?>images/bg/bg1.jpg">
  <div class="container-fluid">
    <div class="section-title">
      <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
          <h3 class="title text-theme-colored1"><?= lang('registration_form'); ?></h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form id="booking-form" action="<?= shop_url('event_register'); ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12">
              <div class="mb-3">
                <input type="text" placeholder="<?= lang('enter_name'); ?>" name="name" id="name" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <input type="text" placeholder="<?= lang('enter_email'); ?>" name="email" id="email" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <input type="text" placeholder="<?= lang('enter_phone'); ?>" name="phone" id="phone" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label>Sex</label>
                <select name="sex" id="sex" class="form-control">
                  <option value="male"><?= lang('male'); ?></option>
                  <option value="female"><?= lang('female'); ?></option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label><?= lang('event_types'); ?></label>
                <select name="event_id" id="event_id" class="form-control">
                  <option value="<?= $event_detail->id; ?>"><?= $event_detail->title; ?></option>
                  <?php foreach($events as $event){
                    if($event->id != $event_detail->id){ ?>
                    <option value="<?= $event->id; ?>"><?= $event->title; ?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <input type="text" placeholder="<?= lang('enter_address'); ?>" name="address" id="address" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <input type="text" placeholder="<?= lang('enter_company'); ?>" name="company" id="company" class="form-control">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="mb-3 text-center">
                <button data-loading-text="<?= lang('please_wait'); ?>..."  class="btn btn-theme-colored1 btn-round btn-block mt-20 pt-10 pb-10" type="submit"><?= lang('register_now'); ?></button>
              </div>
            </div>
          </div>
        </form>
        <!-- Job Form Validation-->
      </div>
    </div>
  </div>
</section>

<!-- <section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="mb-20"><?= lang('photo_gallery'); ?></h4>
        <div class="tm-owl-carousel-5col" data-nav="true">
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
          <div class="item"><img src="http://placehold.it/285x215" alt="images"></div>
        </div>
      </div>
    </div>
  </div>
</section> -->
</div>
<!-- end main-content -->