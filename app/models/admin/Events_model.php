<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Events_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addEvent($data)
    {  
    	// $this->sma->print_arrays($data);
        if ($this->db->insert('md_speakers',$data)) {
            return true;
        }

        die('failed');
        return false;
    }

    public function addEvents($data)
    {
        if ($this->db->insert_batch('md_speakers', $data)) {
            return true;
        }
        return false;
    }

    public function getTagByID($id)
    {
    	$query = $this->db->get_where('md_tags',['id' => $id]);
    	if($query->num_rows() > 0) {
    		return $query->row();
    	}
    	return false;
    }

    public function updateTag($id, $data)
    {
    	if($this->db->update('md_tags',$data,['id' => $id])) {
    		return true;
    	}
    	return false;
    }

    public function tagHasNews($tag_id)
    {
        $q = $this->db->get_where('md_news_tags', ['tag_id' => $tag_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function deleteTag($id)
    {
    	if($this->db->delete('md_tags',['id' => $id])) {
    		return true;
    	}
    	return false;
    }

    public function getTagByName($name)
    {
        $q = $this->db->get_where('md_tags', ['name' => $name], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    
}
