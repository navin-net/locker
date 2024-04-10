<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<body class="tm-container-1300px">
<div id="wrapper" class="clearfix">
  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: home -->
    <section id="home" class="divider parallax section-fullscreen layer-overlay overlay-dark-8" data-tm-bg-img="<?= $assets; ?>images/bg/bg1.jpg">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="text-center mb-20"><a href="#" class=""><img alt="images" src="<?= base_url('assets/uploads/logos/'.$shop_settings->logo);?>" style="width: 300px;"></a></div>
                <h4 class="text-theme-colored1 mt-0 pt-10"> Login</h4>
                <p class="text-white">This page login for admin.</p>
                <?php $u = mt_rand(); ?>
                <?= form_open('login', 'class="validate"'); ?>
                  <div class="row">
                    <div class="mb-3 col-md-12">
                      <label class="text-white" for="username<?= $u; ?>"><?= lang('identity'); ?></label>
                      <input id="username<?= $u; ?>" name="identity" class="form-control" type="text" required placeholder="<?= lang('email'); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-md-12">
                      <label class="text-white" for="password<?= $u; ?>"><?= lang('password'); ?></label>
                      <input id="password<?= $u; ?>" name="password" class="form-control" type="password" placeholder="<?= lang('password'); ?>">
                    </div>
                  </div>
                  <?php
        if ($Settings->captcha) {
            ?>
            <div class="form-group">
            <div class="form-group text-center">
                    <span class="captcha-image"><?= $image; ?></span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <a href="<?= admin_url('auth/reload_captcha'); ?>" class="reload-captcha text-blue">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </span>
                        <?= form_input($captcha); ?>
                    </div>
                </div>
            </div>
            <?php
        } /* echo $recaptcha_html; */
        ?>
                  <div class="checkbox mt-15">
                    <label for="form_checkbox">
                      <input id="form_checkbox" name="form_checkbox" type="checkbox">
                      Remember me </label>
                  </div>
                  <div class="mb-3 tm-sc-button mt-10">
                    <button type="submit" class="btn btn-success"><?= lang('login'); ?></button>
                  </div>
                  <div class="clearfix pt-15">
                    <a class="text-theme-colored1 font-weight-600 font-size-14" href="#">Forgot Your Password?</a>
                  </div>
                  <!-- <div class="clearfix tm-sc-button pt-10">
                    <a href="#" target="_self" class="btn btn-theme-colored1" data-tm-bg-color="#3b5998"> Login facebook </a>
                    <a href="#" target="_self" class="btn btn-theme-colored1" data-tm-bg-color="#00acee"> Login with twitter </a>
                  </div>
 -->             <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->

  <!-- Footer -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->
</body>
