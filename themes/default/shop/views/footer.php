<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<footer id="footer" class="footer section-typo-dark border-top-1px" data-tm-bg-color="#f7f7f7">
    <div class="footer-widget-area">
      <div class="container pt-90 pb-60">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
              <div class="thumb">
                <img alt="Logo" src="<?= base_url('assets/uploads/logos/'.$shop_settings->logo); ?>">
              </div>
              <div class="description"><?= $shop_settings->description; ?></div>
              <ul class="mb-30">
                <li class="contact-phone">
                  <div class="icon"><i class="flaticon-contact-042-phone-1"></i></div>
                  <div class="text"><a href="tel:<?= $shop_settings->phone; ?>"><?= $shop_settings->phone; ?></a></div>
                </li>
                <li class="contact-email">
                  <div class="icon"><i class="flaticon-contact-043-email-1"></i></div>
                  <div class="text"><a href="mailto:<?= $shop_settings->email; ?>"><?= $shop_settings->email; ?></a></div>
                </li>
                <li class="contact-website">
                  <div class="icon"><i class="flaticon-contact-035-website"></i></div>
                  <div class="text"><a  href="<?= $_SERVER['SERVER_NAME']; ?>"><?= $_SERVER['SERVER_NAME']; ?></a></div>
                </li>
                <li class="contact-address">
                  <div class="icon"><i class="flaticon-contact-047-location"></i></div>
                  <div class="text"><?= $shop_settings->address; ?></div>
                </li>
              </ul>
            </div>
            <ul class="styled-icons icon-dark icon-theme-colored1 icon-rounded clearfix">
              <li><a class="social-link" href="<?= $shop_settings->facebook; ?>" ><i class="fab fa-facebook"></i></a></li>
              <li><a class="social-link" href="<?= $shop_settings->twitter; ?>" ><i class="fab fa-twitter"></i></a></li>
              <li><a class="social-link" href="<?= $shop_settings->email; ?>" ><i class="fab fa-google-plus"></i></a></li>
              <li><a class="social-link" href="<?= $shop_settings->instagram; ?>" ><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget">
              <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('latest_news'); ?></h4>
              <div class="latest-posts">
                <?php foreach($last_news as $new){ ?>
                <article class="post clearfix pb-0 mb-20">
                  <a class="post-thumb" href="<?= shop_url('news_details/'.$new->id); ?>"><img src="<?= $new->image ? base_url('assets/uploads/'.$new->image) : base_url('assets/images/sma_no_image.png'); ?>" alt="images"></a>
                  <div class="post-right">
                    <h5 class="post-title mt-0"><a href="<?= shop_url('news_details/'.$new->id); ?>"><?= $new->title ? substr($new->title,0,50).' ...' : ''; ?></a></h5>
                    <span class="post-date">
                      <time class="entry-date" datetime="2021-05-15T06:10:26+00:00"><?= date('F d, Y',strtotime($new->created_at)); ?></time>
                    </span>
                  </div>
                </article>
              <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget widget_nav_menu">
              <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('services'); ?></h4>
              <ul>
                <?php foreach($pages as $page){ ?>
                <li><a href="<?= site_url('page/'.$page->slug); ?>"><?= $page->name; ?></a></li>
              <?php } ?>
                <!-- <li><a href="#">Services</a></li>
                <li><a href="#">Attorneys</a></li>
                <li><a href="#">Practice Arears</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li> -->
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget">
              <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?= lang('opening_hours'); ?></h4>
              <div class="opening-hours border-light">
                <ul>
                  <li class="clearfix"> <span> Friday - Saturday :  </span>
                    <div class="value"> 10.00 am - 6.00 pm </div>
                  </li>
                  <li class="clearfix"> <span> Monday - Thusday :</span>
                    <div class="value"> 8.00 am - 9.00 pm </div>
                  </li>
                  <li class="clearfix"> <span> Sunday : </span>
                    <div class="value"> Closed </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom" data-tm-bg-color="#eee">
        <div class="container">
          <div class="row pt-20 pb-20">
            <div class="col-sm-6">
              <div class="footer-paragraph">
                © <?= date("Y"); ?> <a href="https://igrowtech.biz/">iGrowTech</a> <?= lang('all_rights_reserved'); ?>.
              </div>
            </div>
            <!-- <div class="col-sm-6">
              <div class="footer-paragraph text-right">
                Site Template
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<script type="text/javascript">
    var m = '<?= $m; ?>', v = '<?= $v; ?>', products = {}, filters = <?= isset($filters) && !empty($filters) ? json_encode($filters) : '{}'; ?>, shop_color, shop_grid, sorting;

    var cart = <?= isset($cart) && !empty($cart) ? json_encode($cart) : '{}' ?>;
    var site = {base_url: '<?= base_url(); ?>', site_url: '<?= site_url('/'); ?>', shop_url: '<?= shop_url(); ?>', csrf_token: '<?= $this->security->get_csrf_token_name() ?>', csrf_token_value: '<?= $this->security->get_csrf_hash() ?>', settings: {display_symbol: '<?= $Settings->display_symbol; ?>', symbol: '<?= $Settings->symbol; ?>', decimals: <?= $Settings->decimals; ?>, thousands_sep: '<?= $Settings->thousands_sep; ?>', decimals_sep: '<?= $Settings->decimals_sep; ?>', order_tax_rate: false, products_page: <?= $shop_settings->products_page ? 1 : 0; ?>}, shop_settings: {private: <?= $shop_settings->private ? 1 : 0; ?>, hide_price: <?= $shop_settings->hide_price ? 1 : 0; ?>}}

    var lang = {};
    lang.page_info = '<?= lang('page_info'); ?>';
    lang.cart_empty = '<?= lang('empty_cart'); ?>';
    lang.item = '<?= lang('item'); ?>';
    lang.items = '<?= lang('items'); ?>';
    lang.unique = '<?= lang('unique'); ?>';
    lang.total_items = '<?= lang('total_items'); ?>';
    lang.total_unique_items = '<?= lang('total_unique_items'); ?>';
    lang.tax = '<?= lang('tax'); ?>';
    lang.shipping = '<?= lang('shipping'); ?>';
    lang.total_w_o_tax = '<?= lang('total_w_o_tax'); ?>';
    lang.product_tax = '<?= lang('product_tax'); ?>';
    lang.order_tax = '<?= lang('order_tax'); ?>';
    lang.total = '<?= lang('total'); ?>';
    lang.grand_total = '<?= lang('grand_total'); ?>';
    lang.reset_pw = '<?= lang('forgot_password?'); ?>';
    lang.type_email = '<?= lang('type_email_to_reset'); ?>';
    lang.submit = '<?= lang('submit'); ?>';
    lang.error = '<?= lang('error'); ?>';
    lang.add_address = '<?= lang('add_address'); ?>';
    lang.update_address = '<?= lang('update_address'); ?>';
    lang.fill_form = '<?= lang('fill_form'); ?>';
    lang.already_have_max_addresses = '<?= lang('already_have_max_addresses'); ?>';
    lang.send_email_title = '<?= lang('send_email_title'); ?>';
    lang.message_sent = '<?= lang('message_sent'); ?>';
    lang.add_to_cart = '<?= lang('add_to_cart'); ?>';
    lang.out_of_stock = '<?= lang('out_of_stock'); ?>';
    lang.x_product = '<?= lang('x_product'); ?>';
    lang.r_u_sure = '<?= lang('r_u_sure'); ?>';
    lang.x_reverted_back = "<?= lang('x_reverted_back'); ?>";
    lang.delete = '<?= lang('delete'); ?>';
    lang.line_1 = '<?= lang('line1'); ?>';
    lang.line_2 = '<?= lang('line2'); ?>';
    lang.city = '<?= lang('city'); ?>';
    lang.state = '<?= lang('state'); ?>';
    lang.postal_code = '<?= lang('postal_code'); ?>';
    lang.country = '<?= lang('country'); ?>';
    lang.phone = '<?= lang('phone'); ?>';
    lang.is_required = '<?= lang('is_required'); ?>';
    lang.okay = '<?= lang('okay'); ?>';
    lang.cancel = '<?= lang('cancel'); ?>';
    lang.email_is_invalid = '<?= lang('email_is_invalid'); ?>';
    lang.name = '<?= lang('name'); ?>';
    lang.full_name = '<?= lang('full_name'); ?>';
    lang.email = '<?= lang('email'); ?>';
    lang.subject = '<?= lang('subject'); ?>';
    lang.message = '<?= lang('message'); ?>';
    lang.required_invalid = '<?= lang('required_invalid'); ?>';

    update_mini_cart(cart);
</script>
<!-- end wrapper -->
<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script src="<?= $assets ?>scripts/general.js"></script>
<script src="<?= $assets ?>js/custom.js"></script>


</body>

</html>