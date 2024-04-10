  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" data-tm-bg-img="images/bg/bg1.jpg">
      <div class="container pt-50 pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= lang('product_details'); ?></h2>
              <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                <div class="breadcrumbs">
                  <span><a href="#" rel="home"><?= lang('home'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span><a href="#"><?= lang('pages'); ?></a></span>
                  <span><i class="fa fa-angle-right"></i></span>
                  <span class="active"><?= lang('product_details'); ?></span>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="section-content">
          <div class="product-single">
            <div class="row">
              <div class="col-md-6">
                <div class="product-image-slider lightgallery-lightbox">
                  <div class="tm-owl-thumb-carousel" data-nav="true" data-slider-id="1">
                    <?php

                    if(!empty($images)){

                     foreach ($images as $img) {
                     echo '<div data-thumb="'. base_url('assets/uploads/thumbs/'.$img->photo).'">
                      <a class="lightgallery-trigger" data-exthumbimage="'. base_url('assets/uploads/thumbs/'.$img->photo).'" data-src="'. base_url('assets/uploads/thumbs/'.$img->photo).'" title="Product 1" href="'. base_url('assets/uploads/thumbs/'.$img->photo).'"><img class="img-fullwidth" src="'. base_url('assets/uploads/thumbs/'.$img->photo).'" alt="images"></a>
                    </div>';
                     }} else{
                      echo '<div data-thumb="'. base_url('assets/uploads/'.$product->image).'">
                      <a class="lightgallery-trigger" data-exthumbimage="'. base_url('assets/uploads/'.$product->image).'" data-src="'. base_url('assets/uploads/'.$product->image).'" title="'.$product->name.'" href="'. base_url('assets/uploads/'.$product->image).'"><img class="img-fullwidth" src="'. base_url('assets/uploads/'.$product->image).'" alt="images"></a>
                    </div>';
                     }

                      ?>
                  </div>
                  
                  <ul class="tm-owl-thumbs" data-slider-id="1">
                   <?php
                   if(!empty($images)){
                   foreach($images as $img){ ?>
                    <li class="tm-owl-thumb-item"><img src="<?= base_url('assets/uploads/thumbs/'.$img->photo); ?>" alt="images"></li>
                    <?php
                     }}else{
                   ?>
                   <li class="tm-owl-thumb-item"><img src="<?= base_url('assets/uploads/'.$product->image); ?>" alt="<?= $product->name; ?>"></li>
                 <?php } ?>
                  </ul>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="product-summary">
                  <h2 class="product-title mt-0"><?= $product->name; ?></h2>
                  <div class="product-rating">
                    <!-- <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span></div> -->
                    <!-- <a href="#reviews" class="review-link" rel="nofollow">(<span class="count">1</span> customer review)</a> -->
                  </div>
                  <p class="price"><?= $this->sma->convertMoney($product->price); ?></p>
                  <!-- <span class="amount"><span class="currency-symbol">£</span>42.00</span> – <span class="amount"><span class="currency-symbol">£</span>45.00</span> -->
                  <div class="short-description">
                    <p><?= $product->details; ?></p>
                    <!-- <p><strong>Size &amp; Fit</strong><br>
                    The model (height 6′) is perfect for you</p>
                    <p><strong>Material &amp; Care</strong><br>
                    100% Genuine<br>
                    Machine-wash</p> -->
                  </div>
                  <div class="product_meta">
                    <span class="sku_wrapper"><?= lang('brand'); ?>: <span class="sku" data-o_content="woo-hoodie"><?= $brand->name; ?></span></span>
                    <span class="posted_in"><?= lang('category'); ?>: <a href="<?= shop_url('products?category='.$category->slug); ?>" rel="tag"><?= $category->name; ?></a></span>
                    <?php
                      if(!empty($product->subcategory_id)){
                     ?>
                     <span class="posted_in"><?= lang('subcategory'); ?>: <a href="<?= shop_url('products?category='.$subcategory->slug); ?>" rel="tag"><?= $subcategory->name; ?></a></span>
                   <?php } ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-60">
                <div class="horizontal-tab product-tab">
                  <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="nav-item">
                      <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc-content" role="tab" aria-controls="desc-content" aria-selected="true"><strong><?= lang('description'); ?></strong></button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link" id="addinfo-tab" data-bs-toggle="tab" data-bs-target="#addinfo-content" role="tab" aria-controls="addinfo-content" aria-selected="true"><strong><?= lang('aditional_infomation'); ?></strong></button>
                    </li>
                    <!-- <li class="nav-item">
                      <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-content" role="tab" aria-controls="reviews-content" aria-selected="true"><strong>Reviews</strong></button>
                    </li> -->
                  </ul>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-20" id="desc-content" role="tabpanel" aria-labelledby="desc-tab">
                      <p><?= $product->product_details; ?></p>
                    </div>
                    <div class="tab-pane fade p-20" id="addinfo-content" role="tabpanel" aria-labelledby="addinfo-tab">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th><?= lang('code'); ?></th>
                            <td><p><?= $product->code; ?></p></td>
                          </tr>
                          <tr>
                            <th><?= lang('type'); ?></th>
                            <td><p><?= $product->type; ?></p></td>
                          </tr>
                          <tr>
                            <th><?= lang('unit'); ?></th>
                            <td><p><?= $unit->name; ?></p></td>
                          </tr>
                          <tr>
                            <th>Brand</th>
                            <td><p><?= $brand->name; ?></p></td>
                          </tr>
                          <!-- <tr>
                            <th>Color</th>
                            <td><p>Black</p></td>
                          </tr>
                          <tr>
                            <th>Size</th>
                            <td><p>Large, Medium</p></td>
                          </tr>
                          <tr>
                            <th>Weight</th>
                            <td><?= $product->weight; ?></td>
                          </tr>
                          <tr>
                            <th>Dimensions</th>
                            <td>16 x 22 x 123 cm</td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>
                    <!-- <div class="tab-pane fade p-20" id="reviews-content" role="tabpanel" aria-labelledby="reviews-tab">
                      <ol class="product-reviews">
                        <li class="review">
                          <div class="d-flex">
                            <div class="flex-shrink-0"><img class="thumb img-circle mr-3" alt="images" src="<?= $assets ?>images/shop/author.jpg" width="75"></div>
                            <div class="flex-grow-1 ps-3">
                              <ul class="review-meta list-inline">
                                <li>
                                  <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span></div>
                                </li>
                                <li>
                                  <h5 class="review-heading"><span class="author">Tom Joe</span> <small>– Mar 15, 2021</small></h5>
                                </li>
                              </ul>
                              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                          </div>
                        </li>
                        <li class="review">
                          <div class="d-flex">
                            <div class="flex-shrink-0"><img class="thumb img-circle mr-3" alt="images" src="<?= $assets; ?>images/shop/author.jpg" width="75"></div>
                            <div class="flex-grow-1 ps-3">
                              <ul class="review-meta list-inline">
                                <li>
                                  <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span></div>
                                </li>
                                <li>
                                  <h5 class="review-heading"><span class="author">Tom Joe</span> <small>– Mar 15, 2021</small></h5>
                                </li>
                              </ul>
                              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                          </div>
                        </li>
                      </ol>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <?php if(!empty($other_products)){  ?>
            <div class="col-md-12 mt-60">
              <h4 class="mb-30"><?= lang('related_products'); ?></h4>
              <div class="tm-sc-gallery tm-sc-gallery-grid">
                <!-- Isotope Gallery Grid -->
                <div id="gallery-holder-618422" class="isotope-layout grid-4 gutter-15 clearfix lightgallery-lightbox">
                  <div class="isotope-layout-inner">
                    <!-- Isotope Item Start -->
                    <?php foreach($other_products as $other_pro){ ?>
                    <div class="isotope-item cat1 cat3">
                      <div class="isotope-item-inner">
                        <div class="product">
                          <div class="product-header">
                            <div class="thumb image-swap">
                              <a href="<?= shop_url('product/'.$other_pro->slug); ?>"><img src="<?= base_url('assets/uploads/'.$other_pro->image); ?>" class="product-main-image img-responsive img-fullwidth" width="300" height="300" alt="product"></a>
                              <a href="<?= shop_url('product/'.$other_pro->slug); ?>"><img src="<?= base_url('assets/uploads/'.$other_pro->image); ?>" class="product-hover-image img-responsive img-fullwidth" alt="product"></a>
                            </div>
                            <div class="product-button-holder">
                              <ul class="shop-icons">
                                <li class="item"><a href="#" class="button btn-quickview" title="Product quick view"></a></li>
                                <!-- <li class="item"><a href="shop-cart.html" class="button tm-btn-add-to-cart">Add to cart</a></li> -->
                              </ul>
                            </div>
                          </div>
                          <div class="product-details">
                            <span class="product-categories"><a href="#" rel="tag">Music</a></span>
                            <h5 class="product-title"><a href="<?= shop_url('product/'.$other_pro->slug); ?>"><?= $other_pro->name; ?></a></h5>
                            <span class="price">
                              <?= $other_pro->promotion ? '<del><span class="amount"><span class="currency-symbol">£</span>18.00</span></del>' : '<ins><span class="amount"><span class="currency-symbol">£</span>16.00</span></ins>'; ?>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                    <!-- Isotope Item End -->
                  </div>
                </div>
                <!-- End Isotope Gallery Grid -->
              </div>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
