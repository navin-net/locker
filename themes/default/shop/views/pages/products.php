<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="<?= $assets; ?>images/bg/bg1.jpg">
      <div class="container pt-50 pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= lang('shop'); ?></h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="#" rel="home"><?= lang('home'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#"><?= lang('page'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= lang('shop'); ?></span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-3">
              <div class="widget">
                <h5 class="widget-title"><?= lang('brands'); ?></h5>
                  <select class="form-select" id="product-brand">
                    <option><?= lang('select_brand'); ?></option>
                    <option value="all-brands"><?= lang('all_brands'); ?></option>
                    <?php print_r(explode("-",$page_title)); ?>
                    <?php foreach($brands as $brand){ ?>
                    <option value="<?= $brand->slug; ?>"><?= $brand->name; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="widget">
                <h5 class="widget-title"><?= lang('categories'); ?></h5>
                <select class="form-select" name="product-category" id="product-category">
                  <option><?= lang('select_category') ?></option>
                  <option value="all-categories"><?= lang('all_categories'); ?></option>
                  <?php foreach($categories as $category){ ?>
                  <option value="<?= $category->slug; ?>"><?= $category->name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="widget">
                <h5 class="widget-title"><?= lang('price'); ?></h5>
                <div class="form-check">
                  
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="number" class="form-control" placeholder="<?= lang('min_price'); ?>" name="min-price" id="min-price">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <input type="number" class="form-control" placeholder="<?= lang('max_price'); ?>" name="max-price" id="max-price">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div id="gallery-holder-618422" class="isotope-layout grid-3 gutter-15 clearfix lightgallery-lightbox">
                <div class="isotope-layout-inner">
              <!-- Isotope Gallery Grid -->
              <div  id="results" ></div>
              <!-- End Isotope Gallery Grid -->
              <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-6">
                        <span class="page-info line-height-xl hidden-xs hidden-sm"></span>
                    </div>
                    <div class="col-md-6">
                        <div id="pagination" class="pagination-right"></div>
                    </div>
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
  