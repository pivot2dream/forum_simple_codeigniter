<?php

class Thread_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $data        = array();
    public $fields      = array();
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function get_all($start, $limit)
    {
        $sql = "SELECT a.*, b.name as category_name, b.slug as category_slug, c.date_add 
                FROM ".TBL_THREADS." a, ".TBL_CATEGORIES." b, ".TBL_POSTS." c 
                WHERE a.category_id = b.id AND a.id = c.thread_id 
                AND c.date_add = (SELECT MAX(date_add) FROM ".TBL_POSTS." WHERE thread_id = a.id LIMIT 1) 
                ORDER BY c.date_add DESC LIMIT ".$start.", ".$limit;
        return $this->db->query($sql)->result();
    }
    
    public function get_by_category($start, $limit, $cat_id)
    {
        $cat_string = "(";
        foreach ($cat_id as $key => $id) {
            if ($key == 0) {
                $cat_string .= " a.category_id = ".$id;
            } else {
                $cat_string .= " OR a.category_id = ".$id;
            }
        }
        $cat_string .= ")";
        
        $sql = "SELECT a.*, b.name as category_name, b.slug as category_slug, c.date_add 
                FROM ".TBL_THREADS." a, ".TBL_CATEGORIES." b, ".TBL_POSTS." c 
                WHERE a.category_id = b.id AND a.id = c.thread_id AND ".$cat_string." 
                AND c.date_add = (SELECT MAX(date_add) FROM ".TBL_POSTS." WHERE thread_id = a.id LIMIT 1) 
                ORDER BY c.date_add DESC LIMIT ".$start.", ".$limit;
        return $this->db->query($sql)->result();
    }
    
    public function get_total_by_category($cat_id)
    {
        $cat_string = "(";
        foreach ($cat_id as $key => $id) {
            if ($key == 0) {
                $cat_string .= " a.category_id = ".$id;
            } else {
                $cat_string .= " OR a.category_id = ".$id;
            }
        }
        $cat_string .= ")";
        
        $sql = "SELECT a.* FROM ".TBL_THREADS." a WHERE ".$cat_string;
        return $this->db->query($sql)->num_rows();
    }
    
    public function create()
    {
        $thread = $this->input->post('row');
        $post = $this->input->post('row_post');
        
        $this->fields = $thread;
        
        // check title
        if (strlen($thread['title']) == 0) {
            $this->error['title'] = 'Title cannot be empty';
        }
        
        // check slug
        if (strlen($thread['slug']) == 0) {
            $this->error['slug'] = 'Slug cannot be empty';
        } else {
            $slug_check = $this->db->get_where(TBL_THREADS, array('slug' => $thread['slug']));
            if ($slug_check->num_rows() > 0) {
                $this->error['role'] = 'Slug "'.$thread['slug'].'" already in use';
            }
        }

        // check category
        if ($thread['category_id'] == "0") {
            $this->error['category'] = 'Choose category';
        }
        
        // check post
        if (strlen($post['post']) == 0) {
            $this->error['post'] = 'Post cannot be empty';
        }
        
        if (count($this->error) == 0) {
            // insert into thread
            $thread['date_add']       = date("Y-m-d H:i:s");
            $thread['date_last_post'] = date("Y-m-d H:i:s");
            $this->db->insert(TBL_THREADS, $thread);
            // insert into post
            $post['thread_id'] = $this->db->insert_id();
            $post['author_id'] = $this->session->userdata('cibb_user_id');
            $post['date_add']  = date("Y-m-d H:i:s");
            $this->db->insert(TBL_POSTS, $post);
        } else {
            $this->error_count = count($this->error);
        }
    }
        
    public function get_posts($thread_id, $start, $limit)
    {
        $sql = "SELECT a.*, b.username, b.id as user_id FROM ".TBL_POSTS." a, ".TBL_USERS." b 
                WHERE a.thread_id = ".$thread_id." AND a.author_id = b.id 
                ORDER BY a.date_add ASC LIMIT ".$start.", ".$limit;
        return $this->db->query($sql)->result();
    }
    
    public function reply()
    {
        $row = $this->input->post('row');
        
        // check post
        if (strlen($row['post']) == 0) {
            $this->error['post'] = 'Post cannot be empty';
        }
        
        if (count($this->error) == 0) {
            $this->db->insert(TBL_POSTS, $row);
        } else {
            $this->error_count = count($this->error);
        }
    }
}
