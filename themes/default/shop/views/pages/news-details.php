<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Start main-content -->
  <div class="main-content-area">

    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets ?>images/bg/bg1.jpg">
      <div class="container pt-50 pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= lang('news'); ?></h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="<?= base_url(); ?>" rel="home"><?= lang('home'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#"><?= lang('pages'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= lang('news_detail'); ?></span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-lg-9 order-lg-2">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="entry-header mb-30">
                  <div class="post-thumb thumb"> <img src="<?= $news_detail->image ? base_url('assets/uploads/'.$news_detail->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images" class="img-responsive img-fullwidth"> </div>
                  <h2><?= $news_detail->title; ?></h2>
                  <div class="entry-meta mt-0">
                    <span class="mb-10 text-gray-darkgray mr-10 font-size-13"><i class="far fa-calendar-alt mr-10 text-theme-colored1"></i> <?= date('F d, Y', strtotime($news_detail->created_at)); ?></span>
                  </div>
                </div>
                <div class="entry-content">
                  <p><?= $news_detail->description; ?></p>

                  <!-- <blockquote class="tm-sc-blockquote blockquote-style6  border-left-theme-colored quote-icon-theme-colored">
                    <p >Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.</p>
                    <footer><cite >Someone famous</cite></footer>
                  </blockquote> -->
                 <!--  <h5>Parturient tortor tortor sed tellus molestie neque</h5>
                  <p>Habitasse justo, sed justo. Senectus morbi, fermentum magna id tortor. Lacinia sociis morbi erat ultricies dictumst condimentum dictum nascetur? Vitae litora erat penatibus nam lorem. Euismod tempus, mollis leo tempus? Semper est cursus viverra senectus lectus feugiat id! Odio porta nibh dictumst nulla taciti lacus nam est praesent.</p> -->


                  <!-- <h5>Porta tellus aliquam ligula sollicitudin</h5>
                  <p>Ultrices conubia vehicula malesuada. Eros commodo a duis accumsan vestibulum adipiscing hendrerit lobortis viverra non justo?</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                    <li>Vestibulum auctor dapibus neque.</li>
                    <li>Habitant aliquam taciti tellus leo class.</li>
                    <li>Vitae litora erat penatibus nam lorem</li>
                  </ul> -->
                </div>
              </article>

              <!-- <div class="comment-box mt-30">
                <h3>Leave a Comment</h3>
                <form role="form" id="comment-form">
                <div class="row">
                  <div class="col-6 pt-0 pb-0">
                    <div class="mb-3">
                      <input type="text" class="form-control" required name="contact_name" id="contact_name" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                      <input type="text" required class="form-control" name="contact_email2" id="contact_email2" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                      <input type="text" placeholder="Enter Website" required class="form-control" name="subject">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <textarea class="form-control" required name="contact_message2" id="contact_message2"  placeholder="Enter Message" rows="7"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <button type="submit" class="btn btn-theme-colored1 btn-round m-0" data-loading-text="Please wait...">Submit</button>
                    </div>
                  </div>
                </div>
                </form>
              </div> -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <!-- <div class="widget">
                <h5 class="widget-title">Search box</h5>
                <form role="search" method="get" class="search-form" action="http://pc1/projects/wp/unittest/">
                  <input type="search" class="form-control search-field" placeholder="Search &hellip;" value="" name="s" />
                  <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </form>
              </div> -->
              <div class="widget">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('latest_news'); ?></h4>
                <div class="latest-posts">
                  <?php foreach($last_news_detail as $news){ ?>
                  <article class="post clearfix pb-0 mb-20">
                    <a class="post-thumb" href="<?= shop_url('news_details/'.$news->id); ?>"><img src="<?= $news->image ? base_url('assets/uploads/'.$news->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images"></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="<?= shop_url('news_details/'.$news->id); ?>"><?= substr($news->title, 0,50).'...'; ?></a></h5>
                      <span class="post-date">
                        <time class="entry-date" datetime="<?= date('F d, Y', strtotime($news->created_at)); ?>"><?= date('F d, Y', strtotime($news->created_at)); ?></time>
                      </span>
                    </div>
                  </article>
                  <?php } ?>
                </div>
              </div>

              <div class="widget widget_archive">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('archives'); ?></h4>
                <ul>
                  <?php foreach($achives as $ac){ ?>
                  <li><a href="<?= shop_url('news_event?achieve='. date('Y-m',strtotime($ac->created_at))); ?>"><?= date('F Y',strtotime($ac->created_at)); ?></a></li>
                  <?php } ?>
                  <!-- <li><a href='#'>February 2021</a></li> -->
                </ul>
              </div>
              
              <div class="widget widget_categories">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('categories'); ?></h4>
                <ul>
                  <?php foreach($cate_news as $category){ ?>
                  <li class="cat-item"><a href="<?= shop_url('news_event?category='.$category->slug); ?>"><?= $category->name; ?></a> </li>
                  <?php } ?>
                  <!-- <li class="cat-item"><a href="#">Grief and loss</a> </li>
                  <li class="cat-item"><a href="#">Uncategorized</a> </li> -->
                </ul>
              </div>
              <div class="widget widget_tag_cloud">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('tags'); ?></h4>
                <div class="tagcloud">
                <?php 
                if(!empty($tags)){
                foreach($tags as $tag){ ?>
                  <a href="#" class="tag-cloud-link"><?= $tag->name; ?></a>
                <?php } }else{ ?>
                  <p>No tags</p>
                <?php }?>
                </div>
              </div>
              <div class="widget widget_text text-center">
                <div class="textwidget">
                  <div class="section-typo-light bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40"> <img class="size-full wp-image-800 aligncenter" src="<?= $assets; ?>images/headphone-128.png" alt="images" width="128" height="128" />
                  <h4><?= lang('online_help'); ?>!</h4>
                  <h5><?= $shop_settings->phone; ?></h5>
                  </div>
                </div>
              </div>
              <!-- <div class="widget widget-brochure-box clearfix">
                <a class="brochure-box brochure-box-theme-colored1" href="<?= base_url('assets/uploads/pdf/Career_Path_Syllabus_-_Foundations.pdf'); ?>">
                  <i class="far fa-file-word brochure-icon"></i>
                  <h5 class="text">Download PDF</h5>
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->