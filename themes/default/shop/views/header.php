<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <!-- Meta Tags -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta name="description" content="<?= $page_desc; ?>"/>
  <meta name="keywords" content="medical, clinic, dental, dental clinic, dental practice, dentist, dentistry, doctor, health, hospital,"/>
  <meta property="og:url" content="<?= isset($product) && !empty($product) ? site_url('product/' . $product->slug) : site_url(); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $page_title; ?>" />
  <meta property="og:description" content="<?= $page_desc; ?>" />
  <meta property="og:image" content="<?= isset($product) && !empty($product) ? base_url('assets/uploads/' . $product->image) : base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" />
  <!-- Page Title -->
  <title><?= $page_title; ?></title>
  <!-- Favicon and Touch Icons -->
  <link href="<?= $assets ?>/images/favicon.png" rel="shortcut icon" type="image/png">
 <!--  <link href="<?= $assets ?>/images/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="<?= $assets ?>/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
  <link href="<?= $assets ?>/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
  <link href="<?= $assets ?>/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144"> -->
  <!-- Stylesheet -->
  <link href="<?= $assets ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $assets ?>/css/animate.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $assets ?>/css/javascript-plugins-bundle.css" rel="stylesheet"/>
  <!-- CSS | menuzord megamenu skins -->
  <link href="<?= $assets ?>/js/menuzord/css/menuzord.css" rel="stylesheet"/>
  <!-- CSS | Main style file -->
  <link href="<?= $assets ?>/css/style-main.css" rel="stylesheet" type="text/css">
  <link id="menuzord-menu-skins" href="<?= $assets ?>/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
  <!-- CSS | Responsive media queries -->
  <link href="<?= $assets ?>/css/responsive.css" rel="stylesheet" type="text/css">
  <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
  <!-- CSS | Theme Color -->
  <link href="<?= $assets ?>/css/colors/theme-skin-color-set1.css" rel="stylesheet" type="text/css">
  <!-- external javascripts -->
  <script src="<?= $assets ?>/js/jquery.js"></script>
  <script src="<?= $assets ?>/js/popper.min.js"></script>
  <script src="<?= $assets ?>/js/bootstrap.min.js"></script>
  <script src="<?= $assets ?>/js/javascript-plugins-bundle.js"></script>
  <script src="<?= $assets ?>/js/menuzord/js/menuzord.js"></script>
  <!-- REVOLUTION STYLE SHEETS -->
  <link rel="stylesheet" type="text/css" href="<?= $assets ?>/js/revolution-slider/css/rs6.css">
  <link rel="stylesheet" type="text/css" href="<?= $assets ?>/js/revolution-slider/extra-rev-slider-shop.css">
  <!-- timeline-cp-responsive-vertical -->
  <link href="<?= $assets ?>/js/timeline-cp-responsive-vertical/timeline-cp-responsive-vertical.css" rel="stylesheet" type="text/css">
  <!-- timeline-cd-horizontal -->
  <link href="<?= $assets ?>/js/timeline-cd-horizontal/css/timeline-cd-horizontal.css" rel="stylesheet" type="text/css">
  <script src="<?= $assets ?>/js/timeline-cd-horizontal/js/timeline-cd-horizontal.js"></script>

  <!-- timeline-horizontal-vertical -->
  <link href="<?= $assets ?>/js/timeline-horizontal-vertical/css/timeline-horizontal-vertical.css" rel="stylesheet" type="text/css">
  <script src="<?= $assets ?>/js/timeline-horizontal-vertical/js/timeline-horizontal-vertical.min.js"></script>
  <script src="<?= $assets ?>/js/timeline-horizontal-vertical/js/custom.js"></script>

  <!-- timeline-cd-vertical -->
  <link href="<?= $assets ?>/js/timeline-cd-vertical/css/timeline-cd-vertical.css" rel="stylesheet" type="text/css">
  <script src="js/timeline-cd-vertical/js/timeline-cd-vertical.js"></script>
  <!-- REVOLUTION LAYERS STYLES -->
  <!-- REVOLUTION JS FILES -->
  <script src="<?= $assets ?>/js/revolution-slider/js/revolution.tools.min.js"></script>
  <script src="<?= $assets ?>/js/revolution-slider/js/rs6.min.js"></script>
  <script src="<?= $assets ?>/js/revolution-slider/extra-rev-slider-shop.js"></script>
  <!-- <style type="text/css">
    .image-fit {
      width: 200px;
      height: 300px;
      object-fit: scale-down;
    }
  </style> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Siemreap&display=swap" rel="stylesheet">
<style type="text/css">
  .entry-content{
    font-family: 'Siemreap';
  }
  body {
    font-family: 'Battambang';
  }
  h2 {
    font-family: 'Battambang';
  }
  h3 {
    font-family: 'Battambang';
  }
  h4 {
    font-family: 'Battambang';
  }
  h5 {
    font-family: 'Battambang';
  }
</style>
</head>

<style>
  .btn-hover{
    background-color: black;
  }

  .btn-hover:hover{
    background-color: orange !important;
  }

</style>

<body class="tm-container-1300px has-side-panel side-panel-right">
<!-- preloader -->
<div id="preloader">
  <div id="spinner">
    <div class="preloader-dot-loading">
      <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
    </div>
  </div>
  <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
</div>
<div class="side-panel-body-overlay"></div>

<div id="side-panel-container" class="dark" data-tm-bg-img="<?= $assets; ?>/images/side-push-bg.jpg">
  <div class="side-panel-wrap">
    <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>
    <img class="logo mb-50" src="<?= base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" alt="Logo">
    <p><?= lang('d_lastest_news'); ?></p>
    <div class="widget">
      <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('latest_news'); ?></h4>
      <div class="latest-posts">
        <?php foreach($last_news as $news){ ?>
        <article class="post clearfix pb-0 mb-10">
          <a class="post-thumb" href="<?= shop_url('news_details/'.$news->id); ?>"><img src="<?= ($news->image) ? base_url('assets/uploads/'.$news->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images"></a>
          <div class="post-right">
            <h5 class="post-title mt-0"><a href="<?= shop_url('news_details/'.$news->id); ?>"><?= $news->title; ?></a></h5>
            <p><?= $news->description ? substr($news->description, 0, 50).'...' : ''; ?></p>
          </div>
        </article>
      <?php } ?>
        
      </div>
    </div>

    <div class="widget">
      <h5 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?=
      lang('contact_info'); ?></h5>
      <div class="tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
        <ul>
          <li class="contact-name">
            <div class="icon"><i class="flaticon-contact-037-address"></i></div>
            <div class="text"><?= $shop_settings->contact_name; ?></div>
          </li>
          <li class="contact-phone">
            <div class="icon"><i class="flaticon-contact-042-phone-1"></i></div>
            <div class="text"><a href="tel:<?=$shop_settings->phone; ?>"><?= $shop_settings->phone; ?></a></div>
          </li>
          <li class="contact-email">
            <div class="icon"><i class="flaticon-contact-043-email-1"></i></div>
            <div class="text"><a href="mailto:<?= $shop_settings->email; ?>"><?= $shop_settings->email; ?></a></div>
          </li>
          <li class="contact-address">
            <div class="icon"><i class="flaticon-contact-047-location"></i></div>
            <div class="text"><?= $shop_settings->address; ?></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="wrapper" class="clearfix">
  <!-- Header -->
  <header id="header" class="header header-layout-type-header-2rows">
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-xl-auto header-top-left align-self-center text-center text-xl-start">
            <ul class="element contact-info">
              <li class="contact-phone"><i class="fa fa-phone font-icon sm-display-block"></i><?= $shop_settings->phone;  ?></li>
              <li class="contact-email"><i class="fa fa-envelope font-icon sm-display-block"></i> <?= $shop_settings->email;  ?></li>
              <li class="contact-address"><i class="fa fa-map font-icon sm-display-block"></i> <?= $shop_settings->address; ?></li>
            </ul>
          </div>
            <div class="col-xl-auto header-top-left align-self-center text-center text-xl-start">
                  <a href="<?= site_url('main/language/english'); ?>">
                    <img src="<?= base_url('assets/images/en.png'); ?>" class="language-img" style="width: 22px;">
                  </a>
                  <a href="<?= site_url('main/language/khmer'); ?>">
                    <img src="<?= base_url('assets/images/kh.png'); ?>" class="language-img" style="width: 22px; margin-left: 10px;">
                  </a>
            </div>
          <div class="col-xl-auto ms-xl-auto header-top-right align-self-center text-center text-xl-end">
            <div class="element pt-0 pb-0">
              <ul class="styled-icons icon-dark icon-theme-colored1 icon-circled clearfix">
                <li><a class="social-link" href="<?= $shop_settings->facebook; ?>" ><i class="fab fa-facebook"></i></a></li>
                <li><a class="social-link" href="<?= $shop_settings->twitter; ?>" ><i class="fab fa-twitter"></i></a></li>
                <li><a class="social-link" href="<?= $shop_settings->google_plus; ?>" ><i class="fab fa-google-plus"></i></a></li>
              </ul>
            </div>
            <div class="element pt-0 pt-lg-10 pb-0">
              <a href="<?= admin_url('login'); ?>" class="btn btn-theme-colored2 text-white btn-sm">
<i class='fas fa-sign-in-alt'></i></a>
            </div>
            <!-- <div class="element pt-0 pt-lg-10 pb-0">
              <a href="<?= base_url('themes/default/shop/views/pages/ajax-load/form-appiontment.php'); ?>" class="btn btn-theme-colored2 text-white btn-sm ajaxload-popup"><?= lang('make_an_appointment'); ?></a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav tm-enable-navbar-hide-on-scroll">
      <div class="header-nav-wrapper navbar-scrolltofixed">
        <div class="menuzord-container header-nav-container">
          <div class="container position-relative">
            <div class="row header-nav-col-row">
              <div class="col-sm-auto align-self-center">
                <a class="menuzord-brand site-brand" href="<?= base_url(); ?>">
                  <img class="logo-default logo-1x" src="<?= base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" alt="<?= $shop_settings->shop_name; ?>">
                  <img class="logo-default logo-2x retina" src="<?= base_url('assets/uploads/logos/'. $shop_settings->logo);?>" alt="<?= $shop_settings->shop_name; ?>">
                </a>
              </div>
              <div class="col-sm-auto ms-auto pr-0 align-self-center">
                <nav id="top-primary-nav" class="menuzord theme-color2" data-effect="fade" data-animation="none" data-align="right">
                  <ul id="main-nav" class="menuzord-menu">
                    <li class="<?= $m == 'main' && $v == 'index' ? 'active' : ''; ?> menu-item">
                      <a href="<?= site_url(); ?>"><?= lang('home'); ?></a>
                    </li>
                    <li class="menu-item <?= $m == 'shop' && $v == 'page' ? 'active' : ''; ?>"><a href="#"><?= lang('company'); ?></a>
                      <ul class="dropdown">
                        <?php foreach($pages as $page){ ?>
                        <li><a href="<?= shop_url('page/'.$page->slug); ?>"><?= lang($page->name); ?></a></li>
                        <?php } ?>
                      </ul>
                    </li>
                    <li class="menu-item <?= $m == 'shop' && $v == 'products' && $this->input->get('promo') != 'yes' ? 'active' : ''; ?>" style=""><a href="#"><?= lang('solution'); ?></a>
                      <div  class="megamenu megamenu-fullwidth megamenu-position-left" style="
  height: 350px;
  overflow: auto;"> 
                        <div class="megamenu-row">
                          <?php 
                            foreach($categories as $pc){
                           ?>
                          <div  class="col3">
                            <ul class="list-unstyled list-dashed">
                              <li class="menu-item">
                                <ul class="list-unstyled">
                                  <li class=""><a class=" tm-submenu-title" href="<?= shop_url('products?category='.$pc->slug); ?>"><span><?= $pc->name; ?></span> <span class="badge bg-danger"><?= lang('new'); ?></span></a></li>
                                   <?php if($pc->subcategories) {
                                      foreach($pc->subcategories as $sc){
                                     ?>
                                  <li><a href="<?= shop_url('products?category='.$sc->slug); ?>"><?= $sc->name; ?></a></li>
                                  <?php }} ?>
                                </ul>
                              </li>
                            </ul>
                          </div>
                          <?php } ?>
                        </div>
                      </div>  
                    </li>
                    
                    <li class="menu-item <?= $m == 'shop' && $v == 'partners' ? ' active' : '';  ?>">
                      <a href="#"><?= lang('partners'); ?></a>
                      <div  class="megamenu megamenu-fullwidth megamenu-position-left"style="height: 230px;overflow: auto;">
                        <div class="megamenu-row">
                          <?php 
                          $partners = array_chunk($our_partners, 5);
                          foreach($partners as $partner) { ?>
                          <div  class="col3">
                            <ul class="list-unstyled list-dashed">
                              <li class="menu-item">
                                <ul class="list-unstyled">
                                  <?php foreach($partner as $p) {?>
                                  <li><?= $p; ?></li>
                                  <?php }?>
                                </ul>
                              </li>
                            </ul>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </li>
                    <li class="menu-item <?= $m == 'shop' && $v == 'academy' ? ' active' : '';  ?>"><a href="<?= shop_url('academy'); ?>"><?= lang('workshop'); ?></a></li>
                    <li class="menu-item <?= $m == 'shop' && $v == 'news_event' ? ' active' : '';  ?>"><a href="<?= shop_url('news_event'); ?>"><?= lang('news_&_events'); ?></a></li>
                  </ul>
                </nav>
              </div>
              
              <div class="col-sm-auto align-self-center nav-side-icon-parent">
                <ul class="list-inline nav-side-icon-list">
                  <li class="hidden-mobile-mode"><a href="#" id="top-nav-search-btn"><i class="search-icon fa fa-search"></i></a>
                  </li>
                  <li class="hidden-mobile-mode">
                    <div id="side-panel-trigger" class="side-panel-trigger">
                      <a href="#">
                        <div class="hamburger-box">
                          <div class="hamburger-inner"></div>
                        </div>
                        </a>
                    </div>
                  </li>
                </ul>
                <div id="top-nav-search-form" class="clearfix">
                  <?= shop_form_open('products', 'id="product-search-form"'); ?>
                    <input type="text" name="query" id="product-search" value="" placeholder="<?= lang('search'); ?>" autocomplete="off" />
                  <?= form_close(); ?>
                  <a href="#" id="close-search-btn"><i class="fa fa-times"></i></a>
                </div>
              </div>
            </div>
            <div class="row header-nav-clone-col-row d-block d-xl-none">
               <div class="col-12">
                <nav id="top-primary-nav-clone" class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive" data-effect="slide" data-animation="none" data-align="right">
                 <ul id="main-nav-clone" class="menuzord-menu menuzord-right menuzord-indented scrollable">
                 </ul>
                </nav>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
