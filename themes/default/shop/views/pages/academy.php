
  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets; ?>/images/bg/bg1.jpg">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= lang('workshop'); ?></h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="#" rel="home"><?= lang('home'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#"><?= lang('pages'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= lang('workshop'); ?></span>
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
              <div class="col-lg-6">
                <h3 class="text-center mt-70 mb-20 text-theme-colored1"><?= lang('workshop'); ?></h3>
                <div class="tm-timeline-responsive-vertical-cp">
                  <?php
                  $x = 1;
                   foreach($events as $event){
                  ?>
                  <div class="timeline__block">
                    <div class="timeline__midpoint timeline__midpoint--highlight"></div>
                    <div class="timeline__content timeline__content--<?= ($x % 2 == 0) ? 'left' : 'right'; ?>">
                      <div class="timeline__year">
                        <p><?= date('d F Y', strtotime($event->start_date)); ?></p>
                      </div>
                      <div class="timeline__text--<?= ($x % 2 == 0) ? 'left' : 'right'; ?>">
                        <div class="timeline-content">
                          <h4><?= $event->title; ?></h4>
                          <p><?= $event->description; ?></p>
                        </div>
                      </div>
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
    </section>
  </div>

  <!-- end main-content -->


