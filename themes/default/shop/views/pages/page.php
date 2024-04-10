 <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets; ?>/images/bg/bg1.jpg">
      <div class="container pt-50 pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= $page->title; ?></h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="<?= base_url(); ?>" rel="home"><?= lang('home'); ?></a></span>
                  <!-- <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#">Pages</a></span> -->
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= $page->title; ?></span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- start about page -->
    <?php if($page->slug == 'about-us' || $page->slug == 'privacy-policy'){ ?>
    <!-- Section: about -->
    <section class="about">
      <div class="container pb-0">
        <div class="row">
          <div class="col-md-8">
            <h4 class="text-uppercase text-theme-colored2 mt-sm-10"><?= lang('welcome_to'); ?> <?= $shop_settings->shop_name; ?></h4>
            <!-- <h2 class="mt-0">A dentist, also known as a dental surgeon, The dentist's supporting team aids in providing oral health services.</h2> -->
            <p class="lead"><?= $page->body; ?></p>
            <!-- <h3 class="text-theme-colored mb-0">Dr. Corvin Adams</h3>
            <p><span>Doctor of Dental Surgery (DDS)</span></p> -->
            <!-- <p class="mt-20"><img src="<?= $assets; ?>/images/signature.png" alt=""></p> -->
          </div>
          <div class="col-md-4">
            <img src="<?= $assets; ?>images/about/dc1.png" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Funfact -->
    <section class="divider parallax layer-overlay overlay-theme-colored1-8" data-tm-bg-img="<?= $assets; ?>images/bg/bg5.jpg">
      <div class="container">
        <div class="row section-typo-light">
          <div class="col-lg-3 col-md-6">
            <div class="tm-sc-funfact funfact text-center">
              <div class="funfact-icon mb-20"><i class="flaticon-medical-family21"></i></div>
              <h2 class="counter"> <span class="animate-number" data-value="<?= $shop_settings->customers; ?>" data-animation-duration="1500">0</span><span class="counter-postfix">+</span></h2>
              <h4 class="title"><?= lang('customers'); ?></h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="tm-sc-funfact funfact text-center">
              <div class="funfact-icon mb-20"><i class="flaticon-medical-first32"></i></div>
              <h2 class="counter"> <span class="animate-number" data-value="<?= $total_products; ?>" data-animation-duration="1500">0</span><span class="counter-postfix">+</span></h2>
              <h4 class="title"><?= lang('our_products'); ?></h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="tm-sc-funfact funfact text-center">
              <div class="funfact-icon mb-20">
                <!-- <i class="flaticon-medical-medical51"></i> -->
                <i class="fas fa-map-marked-alt"></i>
              </div>
              <h2 class="counter"> <span class="animate-number" data-value="<?= $shop_settings->total_areas; ?>" data-animation-duration="1500">0</span><span class="counter-postfix">+</span></h2>
              <h4 class="title"><?= ($shop_settings->total_areas > 1) ? lang('areas_in_cambodia') : lang('area_in_cambodia'); ?></h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="tm-sc-funfact funfact text-center">
              <div class="funfact-icon mb-20">
              <i class="fas fa-handshake"></i></div>
              <h2 class="counter"> <span class="animate-number" data-value="<?= $total_partners; ?>" data-animation-duration="1500">0</span><span class="counter-postfix">+</span></h2>
              <h4 class="title"><?= lang('partners'); ?></h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Depertment -->
    <!-- <section id="depertment" class="bg-silver-light">
      <div class="container">
        <div class="section-title text-center">
          <div class="row justify-content-md-center">
            <div class="col-md-8">
              <h2 class="text-uppercase mt-0 line-height-1">Our Depertment</h2>
              <div class="title-icon">
                <img class="mb-10" src="<?= $assets; ?>/images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/1.jpg" alt="">
                <h3 class=""><a href="#">Dental Implant</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>                
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/4.jpg" alt="">
                <h3 class=""><a href="#">Dental Bridges</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>             
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/2.jpg" alt="">
                <h3 class=""><a href="#">Root Canel</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>             
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/1.jpg" alt="">
                <h3 class=""><a href="#">Dental Implant</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>                
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/4.jpg" alt="">
                <h3 class=""><a href="#">Dental Bridges</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>             
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
              <div class="p-20 bg-white">
                <img src="<?= $assets; ?>/images/blog/2.jpg" alt="">
                <h3 class=""><a href="#">Root Canel</a></h3>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit tem autem voluptatem obcaecati.</p>
                <a href="#" class="btn btn-flat btn-theme-colored1 mt-15 text-theme-color-2">Read More</a>             
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- end about page -->
     <?php }elseif ($page->slug == 'career') {
     ?>
    <!-- Start job-list  -->
    <section>
      <div class="container pb-60">
        <div class="row text-center">
          <?php foreach($last_careers as $car){ ?>
          <div class="col-sm-4 mb-30">
            <div class="icon-box iconbox-border iconbox-theme-colored p-40">
              <a href="<?= shop_url('job_detail/'.$car->id); ?>" class="icon icon-gray icon-bordered icon-border-effect effect-flat">
                <i class="pe-7s-users"></i>
              </a>
              <h5 class="icon-box-title"><?= $car->job_title; ?></h5>
              <p class="text-gray text-start"><?= substr($car->job_description,0,140).'...'; ?></p>
              <a class="btn btn-theme-colored2" href="#"><?= lang('apply_now'); ?></a>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>
    <section>
      <div class="container pt-0">
        <div class="row">
          <div class="col-md-12">
            <div class="heading-line-bottom mt-0 mb-30">
              <h4 class="heading-title"><?= lang('job_list'); ?></h4>
            </div>
            <?php foreach($careers as $career){ ?>
            <div class="icon-box mb-0 p-0">
              <a href="#" class="icon icon-gray float-start mb-0 mr-10">
                <i class="pe-7s-users"></i>
              </a>
              <h3 class="icon-box-title pt-15 mt-0"><?= $career->job_title; ?></h3>
              <p class="text-gray"><?= $career->job_description; ?></p>
              <a class="btn btn-theme-colored1 btn-round" href="#"><?= lang('apply_now'); ?></a>
              <?php if(!empty($career->file)){ ?>
              <a class="btn btn-theme-colored2 btn-round" href="<?= base_url('assets/uploads/pdf/'.$career->file); ?>"><?= lang('download_job'); ?></a>
            <?php }?>
             <div class="float-end">
              <span><?= lang('location'); ?>: <?= $career->location; ?></span>,
               <span><?= lang('start_date'); ?>: <?= date('d F Y',strtotime($career->start_date)); ?></span>
               <span> - </span>
               <span><?= lang('end_date'); ?>: <?= date('d F Y', strtotime($career->end_date)); ?></span>
             </div>
            </div>
            <hr>
          <?php } ?>
            
            
          </div>
        </div>
      </div>
    </section>
    <!-- end job-list  -->
  <?php }elseif($page->slug == 'contact-us'){  ?>
    <!-- start contact form -->
    <!-- Section: Contact Form -->

    <section  id="contact">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-lg-6">
              <h5 class="mb-0 text-gray"><?= lang('happy_to_help'); ?>!</h5>
              <h2 class="mb-30">If you need someone to talk to, we listen. We won’t judge or tell you what to do.</h2>
              <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-50">
                <div class="icon-box-wrapper">
                  <div class="icon-wrapper">
                    <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-044-call-1"></i> </a>
                  </div>
                  <div class="icon-text">
                    <h5 class="icon-box-title mt-0"><?= lang('phone'); ?></h5>
                    <div class="content"><a href="tel:<?= $shop_settings->phone; ?>"><?= $shop_settings->phone; ?></a></div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-50">
                <div class="icon-box-wrapper">
                  <div class="icon-wrapper">
                    <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-043-email-1"></i> </a>
                  </div>
                  <div class="icon-text">
                    <h5 class="icon-box-title mt-0"><?= lang('email'); ?></h5>
                    <div class="content"><a href="mailto:<?= $shop_settings->email; ?>"><?= $shop_settings->email; ?></a></div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-50">
                <div class="icon-box-wrapper">
                  <div class="icon-wrapper">
                    <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-025-world"></i> </a>
                  </div>
                  <div class="icon-text">
                    <h5 class="icon-box-title mt-0"><?= lang('address'); ?></h5>
                    <div class="content"><?= $shop_settings->address; ?></div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- <ul class="styled-icons icon-dark icon-sm icon-circled mt-30">
                <li><a href="http://www.facebook.com/sharer.php?u=<?= base_url(); ?>" data-tm-bg-color="#3B5998"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#" data-tm-bg-color="#02B0E8"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" data-tm-bg-color="#4C75A3"><i class="fab fa-vk"></i></a></li>
                <li><a href="#" data-tm-bg-color="#D9CCB9"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#" data-tm-bg-color="#D71619"><i class="fab fa-google-plus"></i></a></li>
                <li><a href="#" data-tm-bg-color="#A4CA39"><i class="fab fa-android"></i></a></li>
                <li><a href="#" data-tm-bg-color="#4C75A3"><i class="fab fa-vk"></i></a></li>
              </ul> -->
            </div>
            <div class="col-lg-6">
              <h2 class="mt-0 mb-0">Interested in discussing?</h2>
              <p class="font-size-20">Active & Ready to use Contact Form!</p>
              <!-- Contact Form -->
              <form id="contact_form" name="contact_form" class="" action="<?= shop_url('send_message'); ?>" method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label><?= lang('name'); ?> <small>*</small></label>
                      <input name="name" id="name" class="form-control" type="text" placeholder="<?= lang('enter_name'); ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label><?= lang('email'); ?> <small>*</small></label>
                      <input name="email" id="email" class="form-control required email" type="email" placeholder="<?= lang('enter_email'); ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label><?= lang('subject'); ?> <small>*</small></label>
                      <input name="subject" id="subject" class="form-control required" type="text" placeholder="<?= lang('enter_subject'); ?>">
                    </div>
                  </div>
                  <!-- <div class="col-sm-6">
                    <div class="mb-3">
                      <label>Phone</label>
                      <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                    </div>
                  </div> -->
                </div>
                <div class="mb-3">
                  <label><?= lang('message'); ?></label>
                  <textarea name="message" id="message" class="form-control required" rows="5" placeholder="<?= lang('enter_message'); ?>"></textarea>
                </div>
                <div class="mb-3">
                  <!-- <input name="form_botcheck" class="form-control" type="hidden" value="" /> -->
                  <button type="submit" class="btn btn-flat btn-theme-colored1 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" data-loading-text="Please wait..."><?= lang('send_your_message'); ?></button>
                  <button type="reset" class="btn btn-flat btn-theme-colored3 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px"><?= lang('reset'); ?></button>
                </div>
              </form>
              <!-- Contact Form Validation-->
              <!-- <script>
                (function($) {
                  $("#contact_form").validate({
                    submitHandler: function(form) {
                      var form_btn = $(form).find('button[type="submit"]');
                      var form_result_div = '#form-result';
                      $(form_result_div).remove();
                      form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                      var form_btn_old_msg = form_btn.html();
                      form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                      $(form).ajaxSubmit({
                        dataType:  'json',
                        success: function(data) {
                          if( data.status == 'true' ) {
                            $(form).find('.form-control').val('');
                          }
                          form_btn.prop('disabled', false).html(form_btn_old_msg);
                          $(form_result_div).html(data.message).fadeIn('slow');
                          setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                        }
                      });
                    }
                  });
                })(jQuery);
              </script> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Divider -->
    <!-- Section: Contact -->
    <section>
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-md-12">
            <iframe src="<?= $shop_settings->map_link; ?>" data-tm-width="100%" height="600" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </section>
    <?php }  ?>
    <!-- end contact form -->
  </div>

  <!-- end main-content -->