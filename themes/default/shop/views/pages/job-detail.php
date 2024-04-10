<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets; ?>/images/bg/bg1.jpg">
      <div class="container pt-50 pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Job Details 1</h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="#" rel="home">Home</a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#">Pages</a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active">Page Title</span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="p-30 bg-white-fa border-1px">
              <div class="row">
                <div class="col-md-4">
                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">
                    <div class="icon-box-wrapper">
                      <div class="icon-wrapper">
                        <a class="icon icon-type-font-icon"><i class="far fa-calendar-alt"></i></a>
                      </div>
                      <div class="icon-text">
                        <h5 class="icon-box-title mt-0 mb-0">Date Posted</h5>
                        <div class="content mt-0"><a href="tel:+123.456.7890"><?= date('d F Y', strtotime($career->start_date)); ?></a></div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">
                    <div class="icon-box-wrapper">
                      <div class="icon-wrapper">
                        <a class="icon icon-type-font-icon"><i class="far fa-money-bill-alt"></i></a>
                      </div>
                      <div class="icon-text">
                        <h5 class="icon-box-title mt-0 mb-0">Offered Salary</h5>
                        <div class="content mt-0"><a href="tel:+123.456.7890">$10000 - $13000</a></div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">
                    <div class="icon-box-wrapper">
                      <div class="icon-wrapper">
                        <a class="icon icon-type-font-icon"><i class="fas fa-briefcase"></i></a>
                      </div>
                      <div class="icon-text">
                        <h5 class="icon-box-title mt-0 mb-0">Job Title</h5>
                        <div class="content mt-0"><a href="tel:+123.456.7890"><?= $career->job_title; ?></a></div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">
                    <div class="icon-box-wrapper">
                      <div class="icon-wrapper">
                        <a class="icon icon-type-font-icon"><i class="far fa-building"></i></a>
                      </div>
                      <div class="icon-text">
                        <h5 class="icon-box-title mt-0 mb-0">Industry</h5>
                        <div class="content mt-0"><a href="tel:+123.456.7890">Development</a></div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">
                    <div class="icon-box-wrapper">
                      <div class="icon-wrapper">
                        <a class="icon icon-type-font-icon"><i class="fas fa-user-graduate"></i></a>
                      </div>
                      <div class="icon-text">
                        <h5 class="icon-box-title mt-0 mb-0">Qualifications</h5>

                        <div class="content mt-0"><a href="tel:+123.456.7890">Degree</a></div>

                      </div>

                      <div class="clearfix"></div>

                    </div>

                  </div>

                </div>

                <div class="col-md-4">

                  <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate mb-30">

                    <div class="icon-box-wrapper">

                      <div class="icon-wrapper">

                        <a class="icon icon-type-font-icon"><i class="far fa-user"></i></a>

                      </div>

                      <div class="icon-text">

                        <h5 class="icon-box-title mt-0 mb-0">Gender</h5>

                        <div class="content mt-0"><a href="tel:+123.456.7890">Male</a></div>

                      </div>

                      <div class="clearfix"></div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <hr>

            <h3><?= $career->job_title; ?></h3>

            <p><?= $career->job_description; ?></p>


            <h5 class="mt-30">Requirments:</h5>

            <div class="tm-sc-unordered-list list-style2">

              <ul>

                <li>Create an Attractive Product</a></li>

                <li>Useful Studio Services</li>

                <li>Modern Design Trends</li>

                <li>Meet our Community</li>

              </ul>

            </div>

          </div>

          <div class="col-md-3">

            <div class="text-center">

              <a class="btn btn-theme-colored1 btn-round mb-30" href="#">Apply for the job</a>

              <p class="">An easy way to apply for this job. Use the following social media.</p>

              <div class="row mb-30">

                <div class="col"><a data-tm-bg-color="#3b5998" class="btn btn-theme-colored1 btn-round btn-sm" href="#">Facebook</a></div>

                <div class="col"><a data-tm-bg-color="#007ab9" class="btn btn-theme-colored1 btn-round btn-sm" href="#">Linkedin</a></div>

              </div>

              <div class="widget widget_text">

                <div class="textwidget">

                  <div class="section-typo-light bg-theme-colored1 text-center mb-md-40 p-30 pt-40 pb-40"> <img class="size-full wp-image-800 aligncenter" src="<?= $assets; ?>images/headphone-128.png" alt="images" width="128" height="128" />
                  <h4 style="text-align: center;">Online Help!</h4>
                  <h5 style="text-align: center;">+(123) 456-78-90</h5>
                  </div>
                </div>
              </div>
              <!-- Google Map HTML Codes -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843149788316!2d144.9537131159042!3d-37.81714274201087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sbn!2sbd!4v1583760510840!5m2!1sbn!2sbd" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Job Apply Form -->
    <section class="divider parallax layer-overlay overlay-white-9" data-tm-bg-img="<?= $assets ?>/images/bg/bg1.jpg">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 offset-md-3 bg-lightest-transparent p-30 pt-10">
            <h3 class="text-center text-theme-colored1 mb-20">Apply Now</h3>
            <form id="job_apply_form" name="job_apply_form" action="includes/job.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Name <small>*</small></label>
                    <input name="form_name" type="text" placeholder="Enter Name" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="form_email">Email <small>*</small></label>
                    <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Sex <small>*</small></label>
                    <select name="form_sex" class="form-control required">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Job Post <small>*</small></label>
                    <select name="form_post" class="form-control required">
                      <option value="Finance Manager">Finance Manager</option>
                      <option value="Area Manager">Area Manager</option>
                      <option value="Country Manager">Country Manager</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label>Message <small>*</small></label>
                <textarea id="form_message" name="form_message" class="form-control required" rows="5" placeholder="Your cover letter/message sent to the employer"></textarea>
              </div>
              <div class="mb-3">
                <label>C/V Upload</label>
                <input name="form_attachment" class="file" type="file" multiple data-show-upload="false" data-show-caption="true">
                <small>Maximum upload file size: 12 MB</small>
              </div>
              <div class="mb-3">
                <input name="form_botcheck" class="form-control" type="hidden" value="" />
                <button type="submit" class="btn btn-block btn-theme-colored1 mt-20 pt-10 pb-10" data-loading-text="Please wait...">Apply Now</button>
              </div>
            </form>
            <!-- Job Form Validation-->
            <!-- Contact Form Validation-->
            <script>
              (function($) {

                $("#job_apply_form").validate({

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
            </script>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- end main-content -->