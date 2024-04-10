<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Partners extends MY_Controller
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
        $this->lang->admin_load('partners', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('partners_model');
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif';
        $this->allowed_file_size = '1024';
    }

    public function getPartners()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id, image, name, phone, address')
            ->from('md_partners')
            ->add_column('Actions', "<div class=\"text-center\"><a href='" . admin_url('partners/edit_partner/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_partner') . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_partner') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('partners/delete_partner/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
             $this->db->order_by('md_partners.id','desc');
            echo $this->datatables->generate();
    }
    public function index()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('partners'), 'page' => lang('manage_suppliers_partners')], ['link' => '#', 'page' => lang('list_partners')]];
        $meta = ['page_title' => lang('partners'), 'bc' => $bc];
        $this->page_construct('partners/index', $meta, $this->data);
    }


    public function partner_actions()
    {
        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->partners_model->deletePartner($id);
                    }
                    $this->session->set_flashdata('message', lang('partner_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('partners'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('phone'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('address'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('telegram'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('website'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('facebook'));
                    $this->excel->getActiveSheet()->SetCellValue('G1', lang('twitter'));
                    $this->excel->getActiveSheet()->SetCellValue('H1', lang('intagram'));
                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $partner = $this->partners_model->getPartnerByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $partner->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $partner->phone);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $partner->address);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $partner->telegram);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $partner->website);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $partner->facebook);
                        $this->excel->getActiveSheet()->SetCellValue('G' . $row, $partner->twitter);
                        $this->excel->getActiveSheet()->SetCellValue('H' . $row, $partner->intagram);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'partners' . date('Y_m_d_H_i_s');
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




    public function add_partner()
    {

        $this->form_validation->set_rules('name', lang('partner_name'), 'required');
        $this->form_validation->set_rules('phone', lang('partner_phone'), 'required');
        $this->form_validation->set_rules('address', lang('address'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');
   

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'telegram' => $this->input->post('telegram'),
                'website' => $this->input->post('website'),
                'facebook' => $this->input->post('facebook'),
                'twitter' => $this->input->post('twitter'),
                'intagram' => $this->input->post('intagram'),
            ];

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
        } elseif ($this->input->post('add_partner')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('partners/index');
        }

        if ($this->form_validation->run() == true && $this->partners_model->addPartner($data)) {
            $this->session->set_flashdata('message', lang('partner_added'));
            admin_redirect('partners/index');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'partners/add_partner', $this->data);
        }
    }

    public function edit_partner($id = null)
    {

        $partner = $this->partners_model->getPartnerByID($id);
        $this->form_validation->set_rules('name', lang('partner_name'), 'required');
        $this->form_validation->set_rules('phone', lang('partner_phone'), 'required');
        $this->form_validation->set_rules('address', lang('address'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');
        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'telegram' => $this->input->post('telegram'),
                'website' => $this->input->post('website'),
                'facebook' => $this->input->post('facebook'),
                'twitter' => $this->input->post('twitter'),
                'intagram' => $this->input->post('intagram'),
            ];

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $this->Settings->iwidth;
                $config['max_height'] = $this->Settings->iheight;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = true;
                $config['width'] = $this->Settings->twidth;
                $config['height'] = $this->Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            }
        } elseif ($this->input->post('edit_partner')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('partners/index');
        }
        if ($this->form_validation->run() == true && $this->partners_model->updatePartner($id, $data)) {
            $this->session->set_flashdata('message', lang('partner_updated_successful'));
            admin_redirect('partners/index');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['partner'] = $partner;
            $this->load->view($this->theme . 'partners/edit_partner', $this->data);
        }
    }
    public function delete_partner($id = null)
    {

        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->partners_model->deletePartner($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('delete_partner')]);
        }
    }
    public function import_partners()
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
                    admin_redirect('partners/index');
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
                $keys   = ['name','phone','email','website','facebook','twitter','telegram','intagram','address'];
                $final  = [];
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }

                foreach ($final as $csv_ct) {
                    if (!$this->partners_model->getPartnerByName(trim($csv_ct['name']))) {
                        $data[] = [
                            'name'  => trim($csv_ct['name']),
                            'phone' => trim($csv_ct['phone']),
                            'email'  => trim($csv_ct['email']),
                            'website' => trim($csv_ct['website']),
                            'facebook'  => trim($csv_ct['facebook']),
                            'twitter' => trim($csv_ct['twitter']),
                            'telegram' => trim($csv_ct['telegram']),
                            'intagram'  => trim($csv_ct['intagram']),
                            'address' => trim($csv_ct['address']),
                        ];
                    }
                }
            }

            // $this->sma->print_arrays($data);
        }

        if ($this->form_validation->run() == true && $this->partners_model->addPartners($data)) {
            $this->session->set_flashdata('message', lang('partners_added'));
            admin_redirect('partners/index');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = [
                'name' => 'userfile',
                'id'   => 'userfile',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('userfile'),
            ];
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'partners/import_partners', $this->data);
        }
    }
}
