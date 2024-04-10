<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Careers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
//careers
     public function getCareerByJobtitle($job_title)
    {
        $q = $this->db->get_where('md_careers', ['job_title' => $job_title], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
     public function updateCareers($id, $data = [])
    {
        if ($this->db->update('md_careers', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }
        public function addCareer($data)
    {
        if ($this->db->insert('md_careers', $data)) {
            return true;
        }
        return false;
    }

    public function addCareers($data)
    {
        if ($this->db->insert_batch('md_careers', $data)) {
            return true;
        }
        return false;
    }


       public function getCareerByID($id)
    {
        $q = $this->db->get_where('md_careers', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
           public function deleteCareer($id)
    {
        if ($this->db->delete('md_careers',['id' => $id])) {
            return true;
        }
        return false;
    }
}
