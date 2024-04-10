<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Partners_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
  public function getPartnerByID($id)
    {
        $q = $this->db->get_where('md_partners', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

     public function getPartnerByName($name)
    {
        $q = $this->db->get_where('md_partners', ['name' => $name], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
     public function updatePartner($id, $data = [])
    {
        if ($this->db->update('md_partners', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }
    public function addPartner($data)
    {
        if ($this->db->insert('md_partners', $data)) {
            return true;
        }
        return false;
    }

    public function addPartners($data)
    {
        if ($this->db->insert_batch('md_partners', $data)) {
            return true;
        }
        return false;
    }
 

       public function deletePartner($id)
    {
        if ($this->db->delete('md_partners',['id' => $id])) {
            return true;
        }
        return false;
    }
}
    