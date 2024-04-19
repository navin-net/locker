<?php

defined('BASEPATH') or exit ('No direct script access allowed');

class Workshops extends MY_Controller
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
        $this->lang->admin_load('workshops', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('workshops_model');
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif';
        $this->allowed_file_size = '1024';
    }

        public function view($id = null)
    {
        // $this->sma->checkPermissions('index');
        $ev_details = $this->workshops_model->getEventByView($id);
        $ev_speaker = $this->workshops_model->getSpeakersBy_id($id);
        $ev_register = $this->workshops_model->getRegisterBy_id($id);
        $testing = $this->workshops_model->getTesting($id);
        // $this->sma->print_arrays($testing);
      
        if (!$id || !$ev_details) {
            $this->session->set_flashdata('error', lang('event_not_found'));
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->data['testing']          = $testing;
        $this->data['event']            = $ev_details;
        $this->data['event_speaker']    = $ev_speaker;
        $this->data['event_register']   = $ev_register;
       $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('workshops'), 'page' => lang('workshops')], ['link' => '#', 'page' => $ev_details->title]];
        $meta = ['page_title' => $ev_details->title, 'bc' => $bc]; 
        $this->page_construct('workshops/view', $meta, $this->data);
    }

    public function index()
    {
       
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('workshops'), 'page' => lang('workshops')], ['link' => '#', 'page' => lang('list_workshop_and_event')]];
        $meta = ['page_title' => lang('list_workshop_and_event'), 'bc' => $bc];
        $this->page_construct('workshops/index', $meta, $this->data);
    }


    
    public function getEvents()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('md_events')}.id,
        {$this->db->dbprefix('md_events')}.image,
          {$this->db->dbprefix('md_events')}.title,
        {$this->db->dbprefix('md_events')}.type ,
        {$this->db->dbprefix('md_events')}.location,
        {$this->db->dbprefix('md_events')}.start_date,
        {$this->db->dbprefix('md_events')}.end_date,
        CONCAT({$this->db->dbprefix('users')}.first_name,'',
        {$this->db->dbprefix('users')}.last_name) as created_by,
        {$this->db->dbprefix('md_events')}.status")
            ->from('md_events')
            // ->join('md_event_registers','md_event_registers.event_id=md_events.id','left')
            ->join('users', 'md_events.created_by=users.id')
            ->add_column('Actions',"<div class=\"text-center\"><a href='" . 
                admin_url('workshops/edit/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . 
                lang('edit_event') . "'><i class=\"fa fa-edit\"></i></a>
                <a href='" . admin_url('workshops/view/$1') . "'  class='tip' title='" . lang('view_event') ."'><i class=\"fa fa-eye\"></i></a>
                <a href='#' class='tip po' title='<b>" . lang('delete_event') . 
                "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('workshops/delete/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>",
                "{$this->db->dbprefix('md_events')}.id");
            $this->db->order_by('md_events.id','desc');
        echo $this->datatables->generate();
    }


    public function add()
    {
        $this->form_validation->set_rules('title', lang('title'), 'required');
        $this->form_validation->set_rules('type', lang('type'), 'required');
        $this->form_validation->set_rules('start_date', lang('start_date'), 'required');
        $this->form_validation->set_rules('end_date', lang('end_date'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'title' => $this->input->post('title'),
                'status' => $this->input->post('status'),
                'type' => $this->input->post('type'),
                'location' => $this->input->post('location'),
                'start_date' => $this->input->post('start_date') ? $this->sma->fld($this->input->post('start_date')) : null,
                'end_date' => $this->input->post('end_date') ? $this->sma->fld($this->input->post('end_date')) : null,
                'created_by' => $this->session->userdata('user_id'),
                'description'   => $this->input->post('description'),
                'created_at' => date('Y_m_d_H_i_s'),

            ];
            $speaker_id = $this->input->post('speaker_id');

            // $this->sma->print_arrays($data,$speaker_id);
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

            // $this->sma->print_arrays($data);


        } elseif ($this->input->post('add')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/index');
        }


        if ($this->form_validation->run() == true && $this->workshops_model->addEvent($data, $speaker_id)) {
            $this->session->set_flashdata('message', lang('add_event'));
            admin_redirect('workshops/index');
        } else {
            $this->data['speakers'] = $this->workshops_model->getSpeakerForEvent();
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'workshops/add', $this->data);
        }
    }

    public function edit($id = null)
    {
        $event_details     = $this->workshops_model->getEventByID($id);
        // $this->sma->print_arrays($event_details);
                $this->form_validation->set_rules('title', lang('title'), 'required');
         if ($this->form_validation->run() == true) {
    
            $data = [
                'title'        => $this->input->post('title'),
                'status'       => $this->input->post('status'),
                'type'         => $this->input->post('type'),
                'description'  => $this->input->post('description'),
                'location' => $this->input->post('location'),

                'start_date'        => $this->input->post('start_date') ? $this->sma->fld($this->input->post('start_date')) : null,
                'end_date'          => $this->input->post('end_date') ? $this->sma->fld($this->input->post('end_date')) : null,
                'updated_at' => date('Y_m_d_H_i_s'),
            ];
            $speaker_id = $this->input->post('speaker_id');


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
        } elseif ($this->input->post('edit')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/index');
        }

        if ($this->form_validation->run() == true && $this->workshops_model->updateEvent($id, $data,$speaker_id)) {
            $this->session->set_flashdata('message', lang('event_updated'));
            admin_redirect('workshops/index');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['eventSpeakers']  = $this->workshops_model->getEventSpeakerByID($event_id);
            $this->data['speakers'] = $this->workshops_model->getSpeakerForEvent();
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['event_details']    = $event_details;
            $this->load->view($this->theme . 'workshops/edit', $this->data);
        }
    }

  

     public function actions()
    {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty ($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->workshops_model->deleteEvent($id);
                    }
                    $this->session->set_flashdata('message', lang('event_delete'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('events'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $events = $this->workshops_model->getEventByID($id);
                        

                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'events_' . date('Y_m_d_H_i_s');
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

      public function delete($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        // if ($this->workshops_model->eventHasSpeaker($id)) {
        //     $this->sma->send_json(['error' => 1, 'msg' => lang('event_has_speaker')]);
        // }

        if ($this->workshops_model->deleteEvent($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('event_deleted')]);
        }
    }


    public function add_speaker()
    {
        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');

        $this->form_validation->set_rules('address', lang('address'), 'required');
       

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'company' => $this->input->post('company'),
                'dob'       => $this->input->post('dob'),
                'facebook' => $this->input->post('facebook'),
                'intagram' => $this->input->post('intagram'),
                'twitter' => $this->input->post('twitter'),
                'youtube' => $this->input->post('youtube'),
                'telegram' => $this->input->post('telegram'),
                'short_description' => $this->input->post('short_description'),
                'descriptions' => $this->input->post('descriptions'),
                'created_at' => date('Y_m_d_H_i_s'),
            ];

            // $this->sma->print_arrays($data);

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


        } elseif ($this->input->post('add_speaker')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/speakers');
        }

        if ($this->form_validation->run() == true && $this->workshops_model->addSpeaker($data)) {
            $this->session->set_flashdata('message', lang('speakers_added'));
            admin_redirect('workshops/speakers');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'workshops/add_speaker', $this->data);
        }
    }
    public function edit_speaker($id = null)
    {
        $speakers = $this->workshops_model->getSpeakerByID($id);
        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');

        $this->form_validation->set_rules('address', lang('address'), 'required');
       

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'company' => $this->input->post('company'),
                'dob'       => $this->input->post('dob'),
                'facebook' => $this->input->post('facebook'),
                'intagram' => $this->input->post('intagram'),
                'twitter' => $this->input->post('twitter'),
                'youtube' => $this->input->post('youtube'),
                'telegram' => $this->input->post('telegram'),
                'short_description' => $this->input->post('short_description'),
                'descriptions' => $this->input->post('descriptions'),
                'created_at' => date('Y_m_d_H_i_s'),
            ];

            // $this->sma->print_arrays($data);

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
        
        } elseif ($this->input->post('edit_speaker')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/speakers');
        }

        if ($this->form_validation->run() == true && $this->workshops_model->updateSpeaker($id, $data)) {
            $this->session->set_flashdata('message', lang('speakers_updated'));
            admin_redirect('workshops/speakers');
        } else {
            $this->data['error']    = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['speakers']    = $speakers;
            $this->load->view($this->theme . 'workshops/edit_speaker', $this->data);
        }



       
    }

    public function delete_speaker($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->workshops_model->speakerHasEvent($id)) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('speaker_has_event')]);
        }

        if ($this->workshops_model->deleteSpeaker($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('speaker_deleted')]);
        }
    }
    
    public function getSpeakers()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select('id,image,name,phone,email,address')
            ->from('md_speakers')
            ->add_column('Actions', "<div class=\"text-center\"><a href='" . admin_url('workshops/edit_speaker/$1') . "' data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_speaker') . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_speaker') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('workshops/delete_speaker/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>", 'id');
        $this->db->order_by('md_speakers.id','desc');
        echo $this->datatables->generate();
    }

    public function speaker_actions()
    {
        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty ($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->workshops_model->deleteSpeaker($id);
                    }
                    $this->session->set_flashdata('message', lang('speakers_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('speakers'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('phone'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('address'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('dob'));
                    $this->excel->getActiveSheet()->SetCellValue('G1', lang('facebook'));
                    $this->excel->getActiveSheet()->SetCellValue('H1', lang('intagram'));
                    $this->excel->getActiveSheet()->SetCellValue('I1', lang('twitter'));
                    $this->excel->getActiveSheet()->SetCellValue('J1', lang('youtube'));
                    $this->excel->getActiveSheet()->SetCellValue('K1', lang('telegram'));
                    $this->excel->getActiveSheet()->SetCellValue('L1', lang('short_description'));
                    $this->excel->getActiveSheet()->SetCellValue('M1', lang('descriptions'));



                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $speaker = $this->workshops_model->getSpeakerByID($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $speaker->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $speaker->phone);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $speaker->email);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $speaker->address);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $speaker->company);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $speaker->dob);
                        $this->excel->getActiveSheet()->SetCellValue('G' . $row, $speaker->facebook);
                        $this->excel->getActiveSheet()->SetCellValue('H' . $row, $speaker->intagram);
                        $this->excel->getActiveSheet()->SetCellValue('I' . $row, $speaker->twitter);
                        $this->excel->getActiveSheet()->SetCellValue('J' . $row, $speaker->youtube);
                        $this->excel->getActiveSheet()->SetCellValue('K' . $row, $speaker->telegram);
                        $this->excel->getActiveSheet()->SetCellValue('L' . $row, $speaker->short_description);
                        $this->excel->getActiveSheet()->SetCellValue('M' . $row, $speaker->descriptions);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'speakers_' . date('Y_m_d_H_i_s');
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

  
    public function getRegisters()
    {
        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('md_event_registers')}.id,
            {$this->db->dbprefix('md_event_registers')}.image,
            {$this->db->dbprefix('md_event_registers')}.name,
            {$this->db->dbprefix('md_events')}.title,
            {$this->db->dbprefix('md_events')}.end_date,
            {$this->db->dbprefix('md_event_registers')}.phone")
            ->from('md_event_registers')
            ->join('md_events', 'md_event_registers.event_id=md_events.id')
            ->add_column(
                'Actions',
                "<div class=\"text-center\"><a href='" . admin_url('workshops/edit_register/$1') . "'data-toggle='modal' data-target='#myModal' class='tip' title='" . lang('edit_register') . "'><i class=\"fa fa-edit\"></i></a> <a href='#' class='tip po' title='<b>" . lang('delete_register') . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('workshops/delete_register/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a></div>",
                "{$this->db->dbprefix('md_event_registers')}.id");
            $this->db->order_by('md_events.id','desc');
        echo $this->datatables->generate();
    }

    public function speakers()
    {
        $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
        $bc = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('system_settings'), 'page' => lang('workshops')], ['link' => '#', 'page' => lang('speakers')]];
        $meta = ['page_title' => lang('speakers'), 'bc' => $bc];
        $this->page_construct('workshops/speakers', $meta, $this->data);
    }

    public function registers()
    {
        $this->data['error']      = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['event_id'] = $this->site->getAllEvent();
        $this->data['warehouses'] = $this->site->getAllWarehouses();
        if ($this->input->post('start_date')) {
            $dt = 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
        } else {
            $dt = 'Till ' . $this->input->post('end_date');
        }
        $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('workshops/registers'), 'page' => lang('registers')], ['link' => '#', 'page' => lang('register_report')]];
        $bc = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('system_settings'), 'page' => lang('workshops')], ['link' => '#', 'page' => lang('registers')]];
        $meta = ['page_title' => lang('registers'), 'bc' => $bc];
        $this->page_construct('workshops/registers', $meta, $this->data);
    }


    public function add_register()
    {
        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('event_id', lang('event_id'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');
        $this->form_validation->set_rules('address', lang('address'), 'required');
     

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'event_id' => $this->input->post('event_id'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'company' => $this->input->post('company'),
                'dob' => $this->input->post('dob'),
                'intagram' => $this->input->post('intagram'),
                'twitter' => $this->input->post('twitter'),
                'description' => $this->input->post('description'),
                'created_at' => date('Y_m_d_H_i_s'),
            ];
            // $this->sma->print_arrays($data);

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


        } elseif ($this->input->post('add_register')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/registers');
        }

        if ($this->form_validation->run() == true && $this->workshops_model->addRegister($data)) {
            $this->session->set_flashdata('message', lang('Register_added'));
            admin_redirect('workshops/registers');
        } else {
            $this->data['events'] = $this->workshops_model->getEventForRegister();
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme . 'workshops/add_register', $this->data);
        }
    }

    public function edit_register($id = null)
    {
        $register = $this->workshops_model->getRegisterByID($id);
        // $this->sma->print_arrays($register);
        $this->form_validation->set_rules('name', lang('name'), 'required');
        $this->form_validation->set_rules('event_id', lang('event_id'), 'required');
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');
        $this->form_validation->set_rules('address', lang('address'), 'required');

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $this->input->post('name'),
                'event_id' => $this->input->post('event_id'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'company' => $this->input->post('company'),
                'dob' => $this->input->post('dob'),
                'intagram' => $this->input->post('intagram'),
                'twitter' => $this->input->post('twitter'),
                'description' => $this->input->post('description'),
                'updated_at' => date('Y_m_d_H_i_s'),


            ];

            // $this->sma->print_arrays($data);

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

        } elseif ($this->input->post('edit_register')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect('workshops/registers');
        }
        if ($this->form_validation->run() == true && $this->workshops_model->updateRegister($id, $data)) {
            $this->session->set_flashdata('message', lang('Register_Updated_Successful'));
            admin_redirect('workshops/registers');
        } else {
            $this->data['error'] = validation_errors() ? validation_errors() : $this->session->flashdata('error');
            $this->data['categories'] = $this->workshops_model->getEventForRegister();

            $this->data['modal_js'] = $this->site->modal_js();
            $this->data['register'] = $register;
            $this->load->view($this->theme . 'workshops/edit_register', $this->data);
        }
    }
    public function register_actions()
    {
        $this->data['event_id'] = $this->site->getAllEvent();
        $this->data['warehouses'] = $this->site->getAllWarehouses();
        if ($this->input->post('start_date')) {
            $dt = 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
        } else {
            $dt = 'Till ' . $this->input->post('end_date');
        }
        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty ($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $id) {
                        $this->workshops_model->deleteRegister($id);
                    }
                    $this->session->set_flashdata('message', lang('registers_deleted'));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                if ($this->input->post('form_action') == 'export_excel') {
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('registers'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('event'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('phone'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('address'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('G1', lang('dob'));
                    $this->excel->getActiveSheet()->SetCellValue('H1', lang('intagram'));
                    $this->excel->getActiveSheet()->SetCellValue('I1', lang('twitter'));
                    $this->excel->getActiveSheet()->SetCellValue('J1', lang('description'));
                  
                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $register = $this->workshops_model->getEventDetail($id);
                        // $this->sma->print_arrays($register);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $register->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $register->title);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $register->phone);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $register->email);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $register->address);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $register->company);
                        $this->excel->getActiveSheet()->SetCellValue('G' . $row, $register->dob);
                        $this->excel->getActiveSheet()->SetCellValue('H' . $row, $register->intagram);
                        $this->excel->getActiveSheet()->SetCellValue('I' . $row, $register->twitter);
                        $this->excel->getActiveSheet()->SetCellValue('J' . $row, $register->description);

                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                    $filename = 'register_' . date('Y_m_d_H_i_s');
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
    public function delete_register($id = null)
    {
        if (!$id) {
            $this->sma->send_json(['error' => 1, 'msg' => lang('id_not_found')]);
        }
        if ($this->workshops_model->deleteRegister($id)) {
            $this->sma->send_json(['error' => 0, 'msg' => lang('event_register_deleted')]);
        }
    }

    public function getRegister_reports($pdf = null, $xls = null)
    {
        $event_id = $this->input->get('event_id') ? $this->input->get('event_id') : null;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : null;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : null;
        $speaker_id = $this->input->get('speaker_id') ? $this->input->get('speaker_id') : null;
         if ($pdf || $xls) {
        $this->db->select($this->db->dbprefix('md_events'). '.title,' .
         $this->db->dbprefix('md_event_registers') . '.name, ' . 
            $this->db->dbprefix('md_event_registers') . '.phone, ' . 
            $this->db->dbprefix('md_event_registers') . '.email, ' . 
            $this->db->dbprefix('md_event_registers') . '.address',false)
                    ->from('md_event_registers')
                    ->join('md_events','md_event_registers.event_id = md_events.id','left')
            ->group_by('md_event_registers.id, md_event_registers.name')
            ->order_by('md_event_registers.name', 'asc');
            if ($event_id) {
                 $this->db->where($this->db->dbprefix('md_events') . '.id', $event_id);
            }
             $q = $this->db->get();
            if ($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $data[] = $row;
                }
            } else {
                $data = null;
            }
            if (!empty($data)) {
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle(lang('events_report'));
                $this->excel->getActiveSheet()->SetCellValue('A1', lang('title'));
                $this->excel->getActiveSheet()->SetCellValue('B1', lang('name'));
                $this->excel->getActiveSheet()->SetCellValue('C1', lang('phone'));
                $this->excel->getActiveSheet()->SetCellValue('D1', lang('email'));
                $this->excel->getActiveSheet()->SetCellValue('E1', lang('address'));
             

                $row  = 2;
                foreach ($data as $data_row) {
                    $this->excel->getActiveSheet()->SetCellValue('A' . $row, $data_row->title);
                    $this->excel->getActiveSheet()->SetCellValue('B' . $row, $data_row->name);
                    $this->excel->getActiveSheet()->SetCellValue('C' . $row, $data_row->phone);
                    $this->excel->getActiveSheet()->SetCellValue('D' . $row, $data_row->email);
                    $this->excel->getActiveSheet()->SetCellValue('E' . $row, $data_row->address);
                     // $pl   += $profit;
                    $row++;
                }
                $this->excel->getActiveSheet()->getStyle('B' . $row . ':F' . $row)->getBorders()
                    ->getTop()->setBorderStyle('medium');
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                $this->excel->getDefaultStyle()->getAlignment()->setVertical('center');
                $this->excel->getActiveSheet()->getStyle('C2:G' . $row)->getAlignment()->setWrapText(true);
                $filename = 'events_report';
                $this->load->helper('excel');
                create_excel($this->excel, $filename);
            }
            $this->session->set_flashdata('error', lang('nothing_found'));
            redirect($_SERVER['HTTP_REFERER']);
        }else{
    $this->load->library('datatables');
    $this->datatables
        ->select($this->db->dbprefix('md_event_registers') . '.id as cid, ' .
            $this->db->dbprefix('md_events'). '.title,' .
            $this->db->dbprefix('md_event_registers') . '.name, ' . 
            $this->db->dbprefix('md_event_registers') . '.phone, ' . 
            $this->db->dbprefix('md_event_registers') . '.email, ' . 
            $this->db->dbprefix('md_event_registers') . '.address',false)
                    ->from('md_event_registers')
                    ->join('md_events','md_event_registers.event_id = md_events.id','left');
        if ($event_id) {
                $this->datatables->where('md_event_registers.event_id', $event_id);
         }if ($start_date) {
        $this->datatables->where("md_events.start_date BETWEEN '$start_date' AND '$end_date'");
        }
        $this->datatables->group_by('md_event_registers.id, md_event_registers.name');
        $this->datatables->unset_column('cid');
        echo $this->datatables->generate();

}
    }

     public function register_reports()
    {
        // $this->sma->checkPermissions('products');
        $this->data['error']      = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['event_id'] = $this->site->getAllEvent();
        $this->data['warehouses'] = $this->site->getAllWarehouses();
        if ($this->input->post('start_date')) {
            $dt = 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
        } else {
            $dt = 'Till ' . $this->input->post('end_date');
        }
        $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('workshops/registers'), 'page' => lang('registers')], ['link' => '#', 'page' => lang('register_report')]];
        $meta = ['page_title' => lang('register_report'), 'bc' => $bc];
        $this->page_construct('workshops/register_reports', $meta, $this->data);
    }
    // public function getSpeakerTesting(){
    //     $event_id = $this->input->get('event_id') ? $this->input->get('event_id') : null;
    //     $speaker_id = $this->input->get('speaker_id') ? $this->input->get('speaker_id') : null;
    //     $this->load->library('datatables');
    //     $this->datatables
    //     ->select($this->db->dbprefix('md_speakers') . '.id as cid, ' .
    //         $this->db->dbprefix('md_speakers') . '.name, ' . 
    //         $this->db->dbprefix('md_speakers') . '.phone, ' . 
    //         $this->db->dbprefix('md_speakers') . '.email, ' . 
    //         $this->db->dbprefix('md_speakers') . '.address,' .
    //         '(CASE WHEN ' . $this->db->dbprefix('md_event_speakers') . 
    //         '.event_id IS NOT NULL THEN "Yes" ELSE "No" END) as status',false)
    //             ->from('md_speakers')
    //             ->join('md_event_speakers','md_speakers.id=md_event_speakers.speaker_id','left')
    //             ->join('md_events','md_event_speakers.event_id=md_events.id','left');
    //     if ($event_id) {
    //             $this->datatables->where('md_event_speakers.event_id', $event_id);
    //     }if ($speaker_id) {
    //         $this->datatables->where('md_event_speakers.speaker_id',$speaker_id);
    //     }
    //     $this->datatables->group_by('md_speakers.id,md_speakers.name');
    //     $this->datatables->unset_column('cid');
    //     echo $this->datatables->generate();
    // }
    //   public function speakerTesting_report()
    // {
    //     // $this->sma->checkPermissions('products');
    //     $this->data['error']      = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
    //     $this->data['event_id'] = $this->site->getAllEvent();
    //     $this->data['speaker_id'] = $this->site->getAllSpeaker();
        
    //     $bc   = [['link' => base_url(), 'page' => lang('home')], ['link' => admin_url('workshops/registers'), 'page' => lang('registers')], ['link' => '#', 'page' => lang('register_report')]];
    //     $meta = ['page_title' => lang('register_report'), 'bc' => $bc];
    //     $this->page_construct('workshops/speakerTesting_report', $meta, $this->data);
    // }





}