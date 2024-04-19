<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Workshops_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addSpeaker($data)
    {
        if ($this->db->insert('md_speakers', $data)) {
            return true;
        }
        return false;
    }
    public function addSpeakers($data)
    {
        if ($this->db->insert_batch('md_speakers', $data)) {
            return true;
        }
        return false;
    }

    public function getSpeakerByID($id)
    {
        $query = $this->db->get_where('md_speakers',['id' => $id]);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function updateSpeaker($id, $data)
    {
        if($this->db->update('md_speakers',$data,['id' => $id])) {
            return true;
        }
        return false;
    }




    

    public function SpeakerHasEvent($speaker_id)
    {
        $q = $this->db->get_where('md_event_speakers', ['speaker_id' => $speaker_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
    public function deleteSpeaker($id)
    {
        if($this->db->delete('md_speakers',['id' => $id])) {
            return true;
        }
        return false;
    }


  public function addRegister($data)
    {
        if ($this->db->insert('md_event_registers', $data)) {
            return true;
        }
        return false;
    }
    public function addRegisters($data)
    {
        if ($this->db->insert_batch('md_event_registers', $data)) {
            return true;
        }
        return false;
    }
     public function getRegisterByID($id)
    {
        $query = $this->db->get_where('md_event_registers',['id' => $id]);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }


       public function updateRegister($id, $data = [])
    {
        if ($this->db->update('md_event_registers', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }
    public function deleteRegister($id)
    {
        if($this->db->delete('md_event_registers',['id' => $id])) {
            return true;
        }
        return false;
    }
      public function getEventForRegister() 
    {
        $query  = $this->db->select('*')
        ->from('md_events')
        ->get()
        ->result();
        return $query;
    }
    public function getSpeakerForEvent() 
    {
        $query  = $this->db->select('*')
        ->from('md_speakers')
        ->get()
        ->result();
        return $query;
    }
     
    public function addEvent($data,$speaker_id)
    {
        
        if ($this->db->insert('md_events', $data)) {
            $event_id = $this->db->insert_id();  
            foreach ($speaker_id as $speaker) {
                $this->db->insert('md_event_speakers',array('speaker_id' => $speaker,'event_id'=>$event_id));
            }
        }
        return true;
    }
     public function addEvents($data)
    {
        if ($this->db->insert_batch('md_events', $data)) {
           $event_id = $this->db->insert_id();  
            foreach ($speaker_id as $speaker) {
                $this->db->insert('md_event_speakers',array('speaker_id' => $speaker,'event_id'=>$event_id));
            }
        }
        return true;
    }
 
      public function getEventByID($id)
    {
        $this->db->select($this->db->dbprefix('md_events') . '.*,' .
            $this->db->dbprefix('md_event_registers') . '.name as name_register,')
            // ->join('md_event_speakers', 'md_events.id=md_event_speakers.event_id')
            ->join('md_event_registers','md_events.id=md_event_registers.event_id');
            // ->join('md_speakers', 'md_event_speakers.speaker_id=md_speakers.id');
        $q = $this->db->get_where('md_events', ['md_events.id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }





    public function updateEvent($id, $data,$speaker_id)
    {
        if ($this->db->update('md_events', $data,['id' => $id])) {

            $this->db->delete('md_event_speakers',['event_id' =>$id]);
            foreach($speaker_id as $speaker){
               $this->db->insert('md_event_speakers', array('speaker_id'=> $speaker, 'event_id' => $id));
            }

            return true;
        }
 
    }
    public function getEventSpeakerByID($event_id)
    {
        $event_speaker = $this->db->select("{$this->db->dbprefix('md_speakers')}.*")
        ->from('md_speakers')
        ->join('md_event_speakers','md_speakers.id=md_event_speakers.speaker_id')
        ->where('md_event_speakers.event_id',$event_id)
        ->get()
        ->result();
        return $event_speaker;
    }
     public function eventHasSpeaker($event_id)
    {
        $q = $this->db->get_where('md_event_speakers', ['event_id' => $event_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
    public function deleteEvent($id)
    {
        if($this->db->delete('md_events',['id' => $id])) {
            return true;
        }
        return false;
    }



    public function getRegisterBy_id($id)
    {
        $this->db->select('md_event_registers.name as rname');
        $this->db->join('md_event_registers','md_events.id=md_event_registers.event_id');
        $this->db->where('md_events.id',$id);
        $query = $this->db->get('md_events');
        return $query->result();
    }


    public function getTesting($id)
    {
        $this->db->select('count(name) as total_register', false);
        $this->db->join('md_event_registers','md_events.id=md_event_registers.event_id');
        if ($id) {
            $this->db->where('md_events.id', $id);
        }
        $q = $this->db->get('md_events');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }










    public function getSpeakersBy_id($id) {
        // $this->db->select('md_speakers.name as sname,phone');
        $this->db->select('*');
        $this->db->join('md_event_speakers','md_events.id = md_event_speakers.event_id');
        $this->db->join('md_speakers','md_event_speakers.speaker_id = md_speakers.id');
        $this->db->where('md_events.id', $id);
        $query = $this->db->get('md_events');
        return $query->result();

    }
        public function getEventByView($id)
    {
        $q = $this->db->get_where('md_events', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getEventDetail($id){

        $this->db->select(
        $this->db->dbprefix('md_event_registers') . '.*,' .
        $this->db->dbprefix('md_events') . '.title')
        ->join('md_events','md_event_registers.event_id=md_events.id');
       $q = $this->db->get_where('md_event_registers', ['md_event_registers.id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
  
    




    

 

}