<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }

        if (!$this->Owner) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect('admin');
        }
        $this->lang->admin_load('news', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('news_model');
        $this->upload_path        = 'assets/uploads/';
        $this->thumbs_path        = 'assets/uploads/thumbs/';
        $this->image_types        = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif';
        $this->allowed_file_size  = '1024';
    }

        public function view($id = null)
        {
        
        $this->sma->checkPermissions('index');
        $new_details = $this->news_model->getNewExport($id);
        $tag_details = $this->news_model->getTagBy_id($id);
        $categorynew_details    = $this->news_model->getNewCategories($id);
        // $this->sma->print_arrays($categorynew_details);
        if (!$id || !$new_details) {
            $this->session->set_flashdata('error', lang('event_not_found'));
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->data['categories']      = $categorynew_details;
        $this->data['tags']            = $tag_details;
        $this->data['news']            = $new_details;
        $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('news'), 'page' => lang('news')], ['link' => '#', 'page' => $new_details->title]];
        $meta = ['page_title' => $new_details->title, 'bc' => $bc]; 
        $this->page_construct('news/view', $meta, $this->data);
        }


    public function add_tag()
    {
        $this->form_validation->set_rules('name', lang('tag_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'name'        => $this->input->post('name'),
            ];
        } elseif ($this->input->post('add_tag')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/tags');
        }

        if ($this->form_validation->run() == true && $this->news_model->addTag($data)) {
            $this->session->set_flashdata('message', lang('tag_added'));
            admin_redirect('news/tags');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/add_tag', $this->data);
        }
    }
    public function tag_actions()
    {
        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->news_model->deleteTag($id);
                    }
                    $this->session->set_flashdata('message', lang('tags_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('tags'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $tag = $this->news_model->getTagByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $tag->name);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'tags_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang('no_record_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_tag($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->news_model->tagHasNews($id)) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('tag_has_news')]);
        }

        if ($this->news_model->deleteTag($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('tag_deleted')]);
        }
    }
    public function edit_tag($id = null)
    {
        $tag_details     = $this->news_model->getTagByID($id);

        $this->form_validation->set_rules('name', lang('tag_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'name'        => $this->input->post('name'),
            ];
        } elseif ($this->input->post('edit_tag')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/tags');
        }

        if ($this->form_validation->run() == true && $this->news_model->updateTag($id, $data)) {
            $this->session->set_flashdata('message', lang('tag_updated'));
            admin_redirect('news/tags');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['tag']    = $tag_details;
            $this->load->view($this->theme . 'news/edit_tag', $this->data);
        }
    }
    public function import_tags()
    {
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang('upload_file'), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (isset($_FILES['userfile'])) {
                $this->load->library('upload');
                $config['upload_path']   = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size']      = $this->allowed_file_size;
                $config['overwrite']     = true;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    die("helo");
                    admin_redirect('news/tags');
                }

                $csv = $this->upload->file_name;

                $arrResult = [];
                $handle    = fopen('files/' . $csv, 'r');
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ',')) !== false) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys   = ['name'];
                $final  = [];
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }

                foreach ($final as $csv_ct) {
                    if (!$this->news_model->getTagByName(trim($csv_ct['name']))) {
                        $data[] = [
                            'name'  => trim($csv_ct['name']),
                        ];
                    }
                }
            }

            // $this->sma->print_arrays($data);
        }

        if ($this->form_validation->run() == true && $this->news_model->addTags($data)) {
            $this->session->set_flashdata('message', lang('tags_added'));
            admin_redirect('news/tags');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = [
                'name' => 'userfile',
                'id'   => 'userfile',
                'type'  => 'text',
                'value'                       => $this->form_validation->set_value('userfile'),
            ];
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/import_tags', $this->data);
        }
    }
    public function getTags()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id,name')
            ->from('md_tags')
            ->add_column('Actions', "<div class=\"text-center\"><a href='" . admin_url('news/edit_tag/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_tag') . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_tag') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('news/delete_tag/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
            $this->db->order_by('md_tags.id','desc');
        echo $this->datatables->generate();
    }

    public function tags()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc                  = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('system_settings'), 'page' => lang('news')], ['link' => '#', 'page' => lang('tags')]];
        $meta                = ['page_title' => lang('tags'), 'bc' => $bc];
        $this->page_construct('news/tags', $meta, $this->data);
    }

    // new
    public function index()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc                  = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('news'), 'page' => lang('news')], ['link' => '#', 'page' => lang('list_new')]];
        $meta                = ['page_title' => lang('list_new'), 'bc' => $bc];
        $this->page_construct('news/index', $meta, $this->data);
    }




    public function getNew()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('md_news')}.id,
        {$this->db->dbprefix('md_news')}.image,
        {$this->db->dbprefix('md_news')}.title,
        {$this->db->dbprefix('md_news_categories')}.name,
        CONCAT({$this->db->dbprefix('users')}.first_name,'',
        {$this->db->dbprefix('users')}.last_name) as created_by,
        {$this->db->dbprefix('md_news')}.status")
            ->from('md_news')
            ->join('md_news_categories', 'md_news.category_id=md_news_categories.id','left')
            ->join('users', 'md_news.created_by=users.id')
            ->add_column('Actions',"<div class=\"text-center\"><a href='" . admin_url('news/edit_new/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_new') . "'><i class=\"fa fa-edit\"></i></a>  <a href='" . admin_url('news/view/$1') . "'  class='tip' title='" . lang('view_event') ."'><i class=\"fa fa-eye\"></i></a>
                <a href='#' class='tip po' title='<b>" . lang('delete_new') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('news/delete_new/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>",
                "{$this->db->dbprefix('md_news')}.id"
            );
             $this->db->order_by('md_news.id','desc');
        echo $this->datatables->generate();
    }
    public function add_new()
    {

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('category_id', 'category_id', 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'category_id'           => $this->input->post('category_id'),
                'title'                 => $this->input->post('title'),
                'status'                => $this->input->post('status'),
                'description'           => $this->input->post('description'),
                'created_by'            => $this->session->userdata('user_id'),
                'created_at' => date('Y_m_d_H_i_s'),

            ];
            $tag_id = $this->input->post('tag_id');

            // $this->sma->print_arrays($tag_id);

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path']   = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size']      = $this->allowed_file_size;
                $config['max_width']     = $this->Settings->iwidth;
                $config['max_height']    = $this->Settings->iheight;
                $config['overwrite']     = false;
                $config['encrypt_name']  = true;
                $config['max_filename']  = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo         = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library']  = 'gd2';
                $config['source_image']   = $this->upload_path . $photo;
                $config['new_image']      = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width']          = $this->Settings->twidth;
                $config['height']         = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
        } elseif ($this->input->post('add_new')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/index');
        }
        if ($this->form_validation->run() == true && $this->news_model->addNew($data, $tag_id)) {
            $this->session->set_flashdata('message', lang('news_category_add_successful'));
            admin_redirect('news/index');
        } else {
            $this->data['categories']   = $this->news_model->getCategoryForNew();
            $this->data['tags'] = $this->news_model->getTagForNew();
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/add_new', $this->data);
        }
    }
    public function edit_new($id = null)
    {

        $new_details = $this->news_model->getNewByID($id);
        // $this->sma->print_arrays($new_details,$tag_id);
        $this->form_validation->set_rules('title', lang('title'), 'required');
        $this->form_validation->set_rules('category_id', lang('category_id'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'category_id'           => $this->input->post('category_id'),
                'title'                 => $this->input->post('title'),
                'status'                => $this->input->post('status'),
                'description'           => $this->input->post('description'),
                'created_by'            => $this->session->userdata('user_id'),
                'updated_at'            => date('Y_m_d_H_i_s'),
            ];

            $tag_id = $this->input->post('tag_id');
            // $this->sma->print_arrays($data,$tag_id);

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path']   = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size']      = $this->allowed_file_size;
                $config['max_width']     = $this->Settings->iwidth;
                $config['max_height']    = $this->Settings->iheight;
                $config['overwrite']     = false;
                $config['encrypt_name']  = true;
                $config['max_filename']  = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo         = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library']  = 'gd2';
                $config['source_image']   = $this->upload_path . $photo;
                $config['new_image']      = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width']          = $this->Settings->twidth;
                $config['height']         = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
            // $this->sma->print_arrays($data,$tag_id);

        } elseif ($this->input->post('edit_new')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/index');
        }

        if ($this->form_validation->run() == true && $this->news_model->updateNew($id, $data, $tag_id)) {
            $this->session->set_flashdata('message', lang('news_updated'));
            admin_redirect('news/index');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['tags'] = $this->news_model->getTagForNew();

            $this->data['newsTags']  = $this->news_model->getNewsTageByID($id);
            $this->data['categories']   = $this->news_model->getCategoryForNew();
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['new_details']    = $new_details;

            $this->load->view($this->theme . 'news/edit_new', $this->data);
        }
    }
    public function delete_new($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->news_model->deleteNew($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('new_deleted')]);
        }
    }
    public function new_action()
    {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->news_model->deleteNew($id);
                    }
                    $this->session->set_flashdata('message', lang('new_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('news'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('category_name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('title'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('status'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('description'));
                    // $this->excel->getActiveSheet()->SetCellValue('E1', lang('name_tag'));

                      $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $news = $this->news_model->getNewDetail($id);
                        // $categories = $this->news_model->getCategoryByID($id);
                    $this->excel->getActiveSheet()->SetCellValue('A' . $row, $news->category_name);
                    $this->excel->getActiveSheet()->SetCellValue('B' . $row, $news->title);
                    $this->excel->getActiveSheet()->SetCellValue('C' . $row, $news->status);
                    $this->excel->getActiveSheet()->SetCellValue('D' . $row, $news->description);
                    // $this->excel->getActiveSheet()->SetCellValue('E' . $row, $news->name_tag);


                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'news_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang('no_record_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
     public function import_news()
    {
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang('upload_file'), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (isset($_FILES['userfile'])) {
                $this->load->library('upload');
                $config['upload_path']   = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size']      = $this->allowed_file_size;
                $config['overwrite']     = true;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect('news/index');
                }

                $csv = $this->upload->file_name;

                $arrResult = [];
                $handle    = fopen('files/' . $csv, 'r');
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ',')) !== false) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys   = ['title', 'category_id', 'status','description','created_by'];
                $final  = [];
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
        // $new_details = $this->news_model->getNewByID($id);

                foreach ($final as $csv_ct) {
                    if (!$this->news_model->getNewExport(trim($csv_ct['id']))) {
                        $data[] = [
                            'title'  => trim($csv_ct['title']),
                            'category_id'  => trim($csv_ct['category_id']),
                            'status'   => trim($csv_ct['status']),
                            'description'   => trim($csv_ct['description']),
                            'created_by'  => trim($csv_ct['created_by']),
                        ];
                    }
                }
            }

            // $this->sma->print_arrays($data);
        }

        if ($this->form_validation->run() == true && !empty($data) && $this->news_model->addNews($data)) {
            $this->session->set_flashdata('message', lang('news_added'));
            admin_redirect('news/index');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = [
                'name' => 'userfile',
                'id'                          => 'userfile',
                'type'                        => 'text',
                'value'                       => $this->form_validation->set_value('userfile'),
            ];
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/import_news', $this->data);
        }
    }





    public function categories()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc                  = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('news'), 'page' => lang('news')], ['link' => '#', 'page' => lang('categories')]];
        $meta                = ['page_title' => lang('categories'), 'bc' => $bc];
        $this->page_construct('news/categories', $meta, $this->data);
    }
    public function getCategories()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id,image,name,slug')
            ->from('md_news_categories')
            ->add_column('Actions', "<div class=\"text-center\"><a href='" . admin_url('news/edit_category/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_category') . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_category') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('news/delete_category/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');

        echo $this->datatables->generate();
    }
    public function add_category()
    {

        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('slug', lang('slug'), 'required');
        $this->form_validation->set_rules('description', lang('description'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'name'          => $this->input->post('name'),
                'slug'         => $this->input->post('slug'),
                'description'       => $this->input->post('description'),

            ];

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path']   = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size']      = $this->allowed_file_size;
                $config['max_width']     = $this->Settings->iwidth;
                $config['max_height']    = $this->Settings->iheight;
                $config['overwrite']     = false;
                $config['encrypt_name']  = true;
                $config['max_filename']  = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo         = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library']  = 'gd2';
                $config['source_image']   = $this->upload_path . $photo;
                $config['new_image']      = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width']          = $this->Settings->twidth;
                $config['height']         = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
        } elseif ($this->input->post('add_category')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/categories');
        }

        if ($this->form_validation->run() == true && $this->news_model->addCategory($data)) {
            $this->session->set_flashdata('message', lang('news_category_add_successful'));
            admin_redirect('news/categories');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/add_category', $this->data);
        }
    }

    public function edit_category($id = null)
    {

        $category = $this->news_model->getCategoryByID($id);
        // $this->sma->print_arrays($category);
        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('slug', lang('slug'), 'required');
        $this->form_validation->set_rules('description', lang('description'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'name'            => $this->input->post('name'),
                'slug'           => $this->input->post('slug'),
                'description'         => $this->input->post('description'),
            ];

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path']   = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size']      = $this->allowed_file_size;
                $config['max_width']     = $this->Settings->iwidth;
                $config['max_height']    = $this->Settings->iheight;
                $config['overwrite']     = false;
                $config['encrypt_name']  = true;
                $config['max_filename']  = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo         = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library']  = 'gd2';
                $config['source_image']   = $this->upload_path . $photo;
                $config['new_image']      = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width']          = $this->Settings->twidth;
                $config['height']         = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
        } elseif ($this->input->post('edit_category')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('news/categories');
        }
        if ($this->form_validation->run() == true && $this->news_model->updateCategory($id, $data)) {
            $this->session->set_flashdata('message', lang('news_category_updated_successful'));
            admin_redirect('news/categories');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['category']    = $category;
            $this->load->view($this->theme . 'news/edit_category', $this->data);
        }
    }
       public function delete_category($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }


        if ($this->news_model->deleteCategory($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('deleteCategory')]);
        }
    }

    public function import_categorys()
    {
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang('upload_file'), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (isset($_FILES['userfile'])) {
                $this->load->library('upload');
                $config['upload_path']   = 'files/';
                $config['allowed_types'] = 'csv';
                $config['max_size']      = $this->allowed_file_size;
                $config['overwrite']     = true;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect('news/categories');
                }

                $csv = $this->upload->file_name;

                $arrResult = [];
                $handle    = fopen('files/' . $csv, 'r');
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ',')) !== false) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys   = ['name', 'slug', 'description'];
                $final  = [];
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }

                foreach ($final as $csv_ct) {
                    if (!$this->news_model->getCategoryByName(trim($csv_ct['name']))) {
                        $data[] = [
                            'name'  => trim($csv_ct['name']),
                            'slug'  => trim($csv_ct['slug']),
                            'description'   => trim($csv_ct['description']),
                        ];
                    }
                }
            }

            // $this->sma->print_arrays($data);
        }

        if ($this->form_validation->run() == true && !empty($data) && $this->news_model->addCategorys($data)) {
            $this->session->set_flashdata('message', lang('categorys_added'));
            admin_redirect('news/categories');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = [
                'name' => 'userfile',
                'id'                          => 'userfile',
                'type'                        => 'text',
                'value'                       => $this->form_validation->set_value('userfile'),
            ];
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'news/import_categorys', $this->data);
        }
    }
     public function category_actions()
    {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->news_model->deleteCategory($id);
                    }
                    $this->session->set_flashdata('message', lang('categorys_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('categorys'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('slug'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('description'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $category = $this->news_model->getCategoryByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $category->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $category->slug);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $category->description);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'categorys_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', lang('no_record_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

   











}
