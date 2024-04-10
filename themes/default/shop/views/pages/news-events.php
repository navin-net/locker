<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets ?>images/bg/bg1.jpg">

      <div class="container">

        <div class="section-content">

          <div class="row">

            <div class="col-md-12 text-center">

              <h2 class="title"><?= lang('news_&_events'); ?></h2>

              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="#" rel="home"><?= lang('home'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#"><?= lang('pages'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= lang('news_&_events'); ?></span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: vertical-timeline -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-lg-3">
              </div>
              <div class="col-lg-3">
              </div>
            </div>
            <div class="row mb-50">
              <div class="col-lg-12">
                <h3 class="text-center mt-70 mb-20 text-theme-colored1"><?= lang('news'); ?></h3>
                <div class="tm-timeline-horizontal-vertical"
                  data-tm-mode="vertical"
                  data-tm-vertical-start-position="right"
                  data-tm-vertical-trigger="250px"
                  >
                  <div class="timeline__wrap">
                    <div class="timeline__items">
                      <?php foreach($news as $new){ ?>
                      <div class="timeline__item">
                        <div class="timeline__content">
                          <h4><?= $new->title; ?></h4>
                          <p><?= $new->description; ?></p>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row bg-silver-light mb-50">
              <div class="col-lg-12">
                <h3 class="text-center mt-70 mb-20 text-theme-colored1"><?= lang('events'); ?></h3>
                <div class="tm-timeline-vertical cd-timeline js-cd-timeline">
                  <div class="cd-timeline__container">
                    <?php 
                    $x = 1;
                    foreach($events as $event){ ?>
                    <div class="cd-timeline__block js-cd-block <?= ($x % 2 == 0) ? '' : 'cd-timeline__block-reverse'; ?>">
                      <div class="cd-timeline__img js-cd-img d-flex align-items-center justify-content-center <?= ($x % 2 == 0) ? 'bg-theme-colored1' : 'bg-theme-colored2'; ?>"><i class="fas fa-atom text-white font-size-19"></i></div>
                      <div class="cd-timeline__content js-cd-content">
                        <p><?= $event->description; ?></p>
                      </div>
                      <div class="cd-timeline__date js-cd-date">
                        <h4><?= $event->title; ?></h4>
                      </div>
                    </div>
                    <?php 
                    $x++;
                  } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->