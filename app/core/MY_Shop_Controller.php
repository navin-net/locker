<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Shop_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->Settings = $this->site->get_setting();

        if (file_exists(APPPATH . 'controllers' . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . 'Shop.php')) {
            define('SHOP', 1);
            $this->load->shop_model('shop_model');
            $this->load->library('Tec_cart', '', 'cart');
            $this->shop_settings = $this->shop_model->getShopSettings();
            if ($shop_language = get_cookie('shop_language', true)) {
                $this->config->set_item('language', $shop_language);
                $this->lang->admin_load('sma', $shop_language);
                $this->lang->shop_load('shop', $shop_language);
                $this->Settings->user_language = $shop_language;
            } else {
                $this->config->set_item('language', $this->Settings->language);
                $this->lang->admin_load('sma', $this->Settings->language);
                $this->lang->shop_load('shop', $this->Settings->language);
                $this->Settings->user_language = $this->Settings->language;
            }

            $this->theme = $this->Settings->theme . '/shop/views/';
            if (is_dir(VIEWPATH . $this->Settings->theme . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . 'assets')) {
                $this->data['assets'] = base_url() . 'themes/' . $this->Settings->theme . '/shop/assets/';
            } else {
                $this->data['assets'] = base_url() . 'themes/default/shop/assets/';
            }

            if ($selected_currency = get_cookie('shop_currency', true)) {
                $this->Settings->selected_currency = $selected_currency;
            } else {
                $this->Settings->selected_currency = $this->Settings->default_currency;
            }
            $this->default_currency          = $this->shop_model->getCurrencyByCode($this->Settings->default_currency);
            $this->data['default_currency']  = $this->default_currency;
            $this->selected_currency         = $this->shop_model->getCurrencyByCode($this->Settings->selected_currency);
            $this->data['selected_currency'] = $this->selected_currency;

            $this->loggedIn             = $this->sma->logged_in();
            $this->data['loggedIn']     = $this->loggedIn;
            $this->loggedInUser         = $this->site->getUser();
            $this->data['loggedInUser'] = $this->loggedInUser;
            $this->Staff                = null;
            $this->data['Staff']        = $this->Staff;
            if ($this->loggedIn) {
                $this->Customer         = $this->sma->in_group('customer') ? true : null;
                $this->data['Customer'] = $this->Customer;
                $this->Supplier         = $this->sma->in_group('supplier') ? true : null;
                $this->data['Supplier'] = $this->Supplier;
                $this->Staff            = (!$this->sma->in_group('customer') && !$this->sma->in_group('supplier')) ? true : null;
                $this->data['Staff']    = $this->Staff;
            } else {
                $this->config->load('hybridauthlib');
            }

            if ($sd = $this->shop_model->getDateFormat($this->Settings->dateformat)) {
                $dateFormats = [
                    'js_sdate'    => $sd->js,
                    'php_sdate'   => $sd->php,
                    'mysq_sdate'  => $sd->sql,
                    'js_ldate'    => $sd->js . ' hh:ii',
                    'php_ldate'   => $sd->php . ' H:i',
                    'mysql_ldate' => $sd->sql . ' %H:%i',
                ];
            } else {
                $dateFormats = [
                    'js_sdate'    => 'mm-dd-yyyy',
                    'php_sdate'   => 'm-d-Y',
                    'mysq_sdate'  => '%m-%d-%Y',
                    'js_ldate'    => 'mm-dd-yyyy hh:ii:ss',
                    'php_ldate'   => 'm-d-Y H:i:s',
                    'mysql_ldate' => '%m-%d-%Y %T',
                ];
            }
            $this->dateFormats         = $dateFormats;
            $this->data['dateFormats'] = $dateFormats;
        } else {
            define('SHOP', 0);
        }

        $this->customer = $this->warehouse = $this->customer_group = false;
        if ($this->session->userdata('company_id')) {
            $this->customer       = $this->site->getCompanyByID($this->session->userdata('company_id'));
            $this->customer_group = $this->shop_model->getCustomerGroup($this->customer->customer_group_id);
        } elseif ($this->shop_settings->warehouse) {
            $this->warehouse = $this->site->getWarehouseByID($this->shop_settings->warehouse);
        }

        $this->m                    = strtolower($this->router->fetch_class());
        $this->v                    = strtolower($this->router->fetch_method());
        $this->data['m']            = $this->m;
        $this->data['v']            = $this->v;
        $this->Settings->indian_gst = false;
        if ($this->Settings->invoice_view > 0) {
            $this->Settings->indian_gst = $this->Settings->invoice_view == 2 ? true : false;
            $this->Settings->format_gst = true;
            $this->load->library('gst');
        }
    }

    public function page_construct($page, $data = [])
    {
        if (SHOP) {
            $data['message']  = $data['message']  ?? $this->session->flashdata('message');
            $data['error']    = $data['error']    ?? $this->session->flashdata('error');
            $data['warning']  = $data['warning']  ?? $this->session->flashdata('warning');
            $data['reminder'] = $data['reminder'] ?? $this->session->flashdata('reminder');

            $data['Settings']           = $this->Settings;
            $data['shop_settings']      = $this->shop_settings;
            $data['currencies']         = $this->shop_model->getAllCurrencies();
            $data['pages']              = $this->shop_model->getAllPages();
            $data['brands']             = $this->shop_model->getAllBrands();
            $partners                   =  $this->shop_model->getPartnersForHeader();

            foreach($partners as $p){
                 $y[] = $p->name;
            }
            $data['our_partners']       = $y;
            $data['last_news']          = $this->shop_model->getLastNews();
            $categories                 = $this->shop_model->getAllCategories();
            foreach ($categories as $category) {
                $cat                = $category;
                $cat->subcategories = $this->shop_model->getSubCategories($category->id);
                $cats[]             = $cat;
            }
            $data['categories'] = $cats;
            $data['cart']       = $this->cart->cart_data(true);

            if (!$this->loggedIn && $this->Settings->captcha) {
                $this->load->helper('captcha');
                $vals = [
                    'img_path'    => './assets/captcha/',
                    'img_url'     => base_url('assets/captcha/'),
                    'img_width'   => 210,
                    'img_height'  => 34,
                    'word_length' => 5,
                    'colors'      => ['background' => [255, 255, 255], 'border' => [204, 204, 204], 'text' => [102, 102, 102], 'grid' => [204, 204, 204]],
                ];
                $cap     = create_captcha($vals);
                $capdata = [
                    'captcha_time' => $cap['time'],
                    'ip_address'   => $this->input->ip_address(),
                    'word'         => $cap['word'],
                ];

                $query = $this->db->insert_string('captcha', $capdata);
                $this->db->query($query);
                $data['image']   = $cap['image'];
                $data['captcha'] = ['name' => 'captcha',
                    'id'                   => 'captcha',
                    'type'                 => 'text',
                    'class'                => 'form-control',
                    'required'             => 'required',
                    'placeholder'          => lang('type_captcha'),
                ];
            }

            $data['isPromo']       = $this->shop_model->isPromo();
            $data['side_featured'] = $this->shop_model->getFeaturedProducts(4, false);
            $data['wishlist']      = $this->shop_model->getWishlist(true);
            $data['info']          = $this->shop_model->getNotifications();
            $data['ip_address']    = $this->input->ip_address();
            $data['page_desc']     = isset($data['page_desc']) && !empty($data['page_desc']) ? $data['page_desc'] : $this->shop_settings->description;
            $this->session->unset_userdata('error');
            $this->session->unset_userdata('message');
            $this->session->unset_userdata('warning');
            $this->session->unset_userdata('reminder');
            $this->load->view($this->theme . 'header', $data);
            $this->load->view($this->theme . $page, $data);
            $this->load->view($this->theme . 'footer');
        }
    }
}
