<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addTag($data)
    {
        if ($this->db->insert('md_tags', $data)) {
            return true;
        }
        return false;
    }
    public function addTags($data)
    {
        if ($this->db->insert_batch('md_tags', $data)) {
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


    //CategoryNews

     public function getCategoryByID($id)
    {
        $query = $this->db->get_where('md_news_categories',['id' => $id]);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
     public function getCategoryByName($name)
    {
        $q = $this->db->get_where('md_news_categories', ['name' => $name], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
     public function updateCategory($id, $data)
    {
        if ($this->db->update('md_news_categories', $data, ['id' => $id])) {
            return true;
        }
        return false;
    }
        public function addCategory($data)
    {
        if ($this->db->insert('md_news_categories', $data)) {
            return true;
        }
        return false;
    }

    public function addCategorys($data)
    {
        if ($this->db->insert_batch('md_news_categories', $data)) {
            return true;
        }
        return false;
    }
       public function deleteCategory($id)
    {
        if ($this->db->delete('md_news_categories',['id' => $id])) {
            return true;
        }
        return false;
    }

    //////News
      public function getNewByID($id)
    {
        $query = $this->db->select("{$this->db->dbprefix('md_news')}.*,
            {$this->db->dbprefix('md_news_categories')}.name as category_name")
        ->from('md_news')
        ->join('md_news_categories','md_news.category_id=md_news_categories.id')
        ->where('md_news.id',$id)
        ->get();
        return $query->row();
    }

        public function getNewExport($id)
    {
        $query = $this->db->get_where('md_news',['id' => $id]);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
    

    public function getNewDetail($id){

        $this->db->select(
        $this->db->dbprefix('md_news') . '.*,' .
        // $this->db->dbprefix('md_tags') . '.name as name_tag,' .
        $this->db->dbprefix('md_news_categories') . '.name as category_name')
        ->join('md_news_tags','md_news.id=md_news_tags.news_id')
        ->join('md_tags','md_news_tags.tag_id=md_tags.id')
        ->join('md_news_categories','md_news.category_id=md_news_categories.id');
       $q = $this->db->get_where('md_news', ['md_news.id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }




    public function getNewsTageByID($news_id)
    {
        $news_tag = $this->db->select("{$this->db->dbprefix('md_tags')}.*")
        ->from('md_tags')
        ->join('md_news_tags','md_tags.id=md_news_tags.tag_id')
        ->where('md_news_tags.news_id',$news_id)
        ->get()
        ->result();
        return $news_tag;
        
    }


     public function getNewByName($title)
    {
        $q = $this->db->get_where('md_news', ['title' => $title], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
    


    public function updateNew($id, $data,$tag_id)
    {
        if ($this->db->update('md_news', $data,['id' => $id])) {

            $this->db->delete('md_news_tags',['news_id' =>$id]);
            foreach($tag_id as $tag){
               $this->db->insert('md_news_tags', array('tag_id'=> $tag, 'news_id' => $id));
            }

            return true;
        }
 
    }
    
    public function addNew($data,$tag_id)
    {
        
        if ($this->db->insert('md_news', $data)) {
            $news_id = $this->db->insert_id();  
            foreach ($tag_id as $tag) {
                $this->db->insert('md_news_tags',array('tag_id' => $tag,'news_id'=>$news_id));
            }
        }
        return true;
    }

    public function addNews($data)
    {
        if ($this->db->insert_batch('md_news', $data)) {
           $news_id = $this->db->insert_id();  
            foreach ($tag_id as $tag) {
                $this->db->insert('md_news_tags',array('tag_id' => $tag,'news_id'=>$news_id));
            }
        }
        return true;
    }
       public function deleteNew($id)
    {
        if ($this->db->delete('md_news',['id' => $id])) {
            return true;
        }
        return false;
    }

       public function NewsHasCategory($id)
    {
        $q = $this->db->get_where('md_news_categories', ['id' => $id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function NewsHastag($news_id)
    {
        $q = $this->db->get_where('md_news_tags', ['news_id' => $news_id], 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    public function getCategoryForNew() 
    {
        $query  = $this->db->select('*')
        ->from('md_news_categories')
        ->get()
        ->result();
        return $query;
    }
        public function getTagForNew() 
    {
        $query  = $this->db->select('*')
        ->from('md_tags')
        ->get()
        ->result();
        return $query;
    }

      public function getNewEx($id)
    {
        $query = $this->db->get_where('md_news',['id' => $id]);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
   
   
    public function getTagBy_id($id)
    {
        $this->db->select('md_tags.*');
        $this->db->join('md_news_tags','md_news.id=md_news_tags.news_id');
        $this->db->join('md_tags','md_news_tags.tag_id=md_tags.id');
        $this->db->where('md_news.id',$id);
        $query = $this->db->get('md_news');
        return $query->result();
    }

     public function getNewCategories($id){

        $this->db->select('md_news_categories.*');
        $this->db->join('md_news_categories','md_news.category_id=md_news_categories.id');
        $this->db->where('md_news.id',$id);
         $query = $this->db->get('md_news');
        return $query->result();
     
   

   }
 
  
    

    




    


   












   
    
}
