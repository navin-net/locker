<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Careers extends MY_Controller
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
        $this->lang->admin_load('careers', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('careers_model');
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->digital_upload_path = 'assets/uploads/pdf/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'pdf';
        $this->image_file_types = 'jpg|jpeg|png';
        $this->allowed_file_size = '1024';
    }

    public function index()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('careers'), 'page' => lang('manage_careers')], ['link' => '#', 'page' => lang('list_careers')]];
        $meta = ['page_title' => lang('careers'), 'bc' => $bc];
        $this->page_construct('careers/index', $meta, $this->data);
    }
    public function getCareers()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id, job_title, position, location, start_date, end_date')
            ->from('md_careers')
            ->add_column('Actions', "<div class=\"text-center\"><a href='" . admin_url('careers/edit_career/$1') .
                "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_career') . "
             '><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_career') . "
             </b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='"
                . admin_url('careers/delete_career/$1') . "'>" . lang('i_m_sure') .
                "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
            $this->db->order_by('md_careers.id','desc');

        echo $this->datatables->generate();
    }
    public function add_career()
    {
        $this->form_validation->set_rules('job_title', lang('job_title'), 'required');
        $this->form_validation->set_rules('position', lang('position'), 'required');
        $this->form_validation->set_rules('location', lang('location'), 'required');

        if ($this->form_validation->run() == true) {


            $data = [
                'job_title'     => $this->input->post('job_title'),
                'position'      => $this->input->post('position'),
                'location'      => $this->input->post('location'),
                'start_date'    => date('Y_m_d_H_i_s'),
                // 'start_date'    => $this->input->post('start_date') ? $this->sma->fld($this->input->post('start_date')) : null,
                'end_date'      => $this->input->post('end_date') ? $this->sma->fld($this->input->post('end_date')) : null,
            ];

            // 

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->digital_file_types;
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
                $file = $this->upload->file_name;
                $data['file'] = $file;
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
            $this->sma->print_arrays($data);
        } elseif ($this->input->post('add_career')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('careers/index');
        }

        if ($this->form_validation->run() == true && $this->careers_model->addCareer($data)) {
            $this->session->set_flashdata('message', lang('careers_added'));
            admin_redirect('careers/index');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'careers/add_career', $this->data);
        }
    }

    public function edit_career($id = null)
    {

        $career = $this->careers_model->getCareerByID($id);
        $this->form_validation->set_rules('job_title', lang('job_title'), 'required');
        $this->form_validation->set_rules('position', lang('position'), 'required');
        $this->form_validation->set_rules('location', lang('location'), 'required');
        $this->form_validation->set_rules('start_date', lang('start_date'), 'required');
        $this->form_validation->set_rules('end_date', lang('end_date'), 'required');
        if ($this->form_validation->run() == true) {
            $data = [
                'job_title'     => $this->input->post('job_title'),
                'position'      => $this->input->post('position'),
                'location'      => $this->input->post('location'),
                'start_date'    => $this->input->post('start_date') ? $this->sma->fld($this->input->post('start_date')) : null,
                'end_date'      => $this->input->post('end_date') ? $this->sma->fld($this->input->post('end_date')) : null,
            ];


            // debug
            // $this->sma->print_arrays($data);

            if ($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->digital_file_types;
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
                $file = $this->upload->file_name;
                $data['file'] = $file;
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
        } elseif ($this->input->post('edit_careers')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('careers/index');
        }
        if ($this->form_validation->run() == true && $this->careers_model->updateCareers($id, $data)) {
            $this->session->set_flashdata('message', lang('careers_updated_successful'));
            admin_redirect('careers/index');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['career'] = $career;
            $this->load->view($this->theme . 'careers/edit_career', $this->data);
        }
    }

    public function career_actions()
    {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->careers_model->deleteCareer($id);
                    }
                    $this->session->set_flashdata('message', lang('careers_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('careers'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('job_title'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('position'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('location'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('start_date'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('end_date'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $career = $this->careers_model->getCareerByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $career->job_title);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $career->position);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $career->location);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $career->start_date);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $career->end_date);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'careers_' . date('Y_m_d_H_i_s');
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



    public function delete_career($id = null)
    {

        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->careers_model->deleteCareer($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('careers_hasbeen_deleted')]);
        }
    }

    public function import_careers()
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
                    admin_redirect('careers/index');
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
                $keys   = ['job_title','position','location','end_date','start_date'];
                $final  = [];
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }

                foreach ($final as $csv_ct) {
                    if (!$this->careers_model->getCareerByJobtitle(trim($csv_ct['job_title']))) {
                        $data[] = [
                            'job_title'  => trim($csv_ct['job_title']),
                            'position' => trim($csv_ct['position']),
                            'location'  => trim($csv_ct['location']),
                            'end_date'  => trim($csv_ct['end_date']),
                                 'start_date'    => date('Y_m_d_H_i_s'),
                          
                        ];
                    }
                }
            }

            // $this->sma->print_arrays($data);
        }

        if ($this->form_validation->run() == true && $this->careers_model->addCareers($data)) {
            $this->session->set_flashdata('message', lang('careers_added'));
            admin_redirect('careers/index');
        } else {
            $this->data['error']    = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = [
                'name' => 'userfile',
                'id'   => 'userfile',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('userfile'),
            ];
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'careers/import_careers', $this->data);
        }
    }
}
