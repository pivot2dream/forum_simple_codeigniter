<?php

class Thread extends CI_Controller {
    public $data         = array();
    public $page_config  = array();
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('thread_model');
        $this->load->model('user_model');
        $this->user_model->check_role();
    }
    
    public function index($start = 0)
    {
        // set pagination
        $this->load->library('pagination');
        $this->page_config['base_url']    = site_url('thread/index/');
        $this->page_config['uri_segment'] = 3;
        $this->page_config['total_rows']  = $this->db->count_all(TBL_THREADS);;
        $this->page_config['per_page']    = 10;
        
        $this->set_pagination();
        
        $this->pagination->initialize($this->page_config);
        
        $this->data['type']    = 'index';
        $this->data['page']    = $this->pagination->create_links();
        $this->data['threads'] = $this->thread_model->get_all($start, $this->page_config['per_page']);
        $this->data['title']   = 'Index '.CIBB_TITLE;

        $this->load->model('admin_model');
        $this->data['categories'] = $this->admin_model->category_get_all();

        $this->load->view('header', $this->data);
        $this->load->view('thread/index');
        $this->load->view('footer');
    }
    
    public function create()
    {
        if (!$this->session->userdata('cibb_user_id')) {
            redirect('user/join');
        } else if ($this->session->userdata('thread_create') == 0) {
            redirect('thread');
        }
        if ($this->input->post('btn-create')) {
            $this->thread_model->create();
            if ($this->thread_model->error_count != 0) {
                $this->data['error']    = $this->thread_model->error;
            } else {
                $this->session->set_userdata('tmp_success_new', 1);
                redirect('thread/talk/'.$this->thread_model->fields['slug']);
            }
        }
        $this->load->model('admin_model');
        $this->data['categories'] = $this->admin_model->category_get_all();
        $this->data['title']  = ' Thread Create '.CIBB_TITLE;
        $this->load->view('header', $this->data);
        $this->load->view('thread/create');
        $this->load->view('footer');
    }
    
    public function set_pagination()
    {
        $this->page_config['first_link']         = '&lsaquo; First';
        $this->page_config['first_tag_open']     = '<li>';
        $this->page_config['first_tag_close']    = '</li>';
        $this->page_config['last_link']          = 'Last &raquo;';
        $this->page_config['last_tag_open']      = '<li>';
        $this->page_config['last_tag_close']     = '</li>';
        $this->page_config['next_link']          = 'Next &rsaquo;';
        $this->page_config['next_tag_open']      = '<li>';
        $this->page_config['next_tag_close']     = '</li>';
        $this->page_config['prev_link']          = '&lsaquo; Prev';
        $this->page_config['prev_tag_open']      = '<li>';
        $this->page_config['prev_tag_close']     = '</li>';
        $this->page_config['cur_tag_open']       = '<li class="active"><a href="javascript://">';
        $this->page_config['cur_tag_close']      = '</a></li>';
        $this->page_config['num_tag_open']       = '<li>';
        $this->page_config['num_tag_close']      = '</li>';
    }
    
    public function talk($slug, $start = 0)
    {
        if ($this->input->post('btn-post')) {
            if (!$this->session->userdata('cibb_user_id')) {
                redirect('user/join');
            } else if ($this->session->userdata('thread_create') == 0) {
                redirect('thread');
            }
            
            
            $this->thread_model->reply();
            if ($this->thread_model->error_count != 0) {
                $this->data['error']    = $this->thread_model->error;
            } else {
                $this->session->set_userdata('tmp_success', 1);
                redirect('thread/talk/'.$slug.'/'.$start);
            }
        }
        
        $tmp_success_new = $this->session->userdata('tmp_success_new');
        if ($tmp_success_new != NULL) {
            // new thread created
            $this->session->unset_userdata('tmp_success_new');
            $this->data['tmp_success_new'] = 1;
        }
        
        $tmp_success = $this->session->userdata('tmp_success');
        if ($tmp_success != NULL) {
            // new post on a thread created
            $this->session->unset_userdata('tmp_success');
            $this->data['tmp_success'] = 1;
        }
        
        $thread = $this->db->get_where(TBL_THREADS, array('slug' => $slug))->row();
        
        // set pagination
        $this->load->library('pagination');
        $this->page_config['base_url']    = site_url('thread/talk/'.$slug);
        $this->page_config['uri_segment'] = 4;
        $this->page_config['total_rows']  = $this->db->get_where(TBL_POSTS, array('thread_id' => $thread->id))->num_rows();
        $this->page_config['per_page']    = 10;
        
        $this->set_pagination();
        
        $this->pagination->initialize($this->page_config);
        
        $posts  = $this->thread_model->get_posts($thread->id, $start, $this->page_config['per_page']);
        //$this->thread_model->get_posts_threaded($thread->id, $start, $this->page_config['per_page']);
        $this->load->model('admin_model');
        $this->data['cat']    = $this->admin_model->category_get_all_parent($thread->category_id, 0);
        
        $this->data['categories']    = $this->admin_model->category_get_all();
        $this->data['title']  = $thread->title.' :: Thread '.CIBB_TITLE;
        $this->data['page']   = $this->pagination->create_links();
        $this->data['thread'] = $thread;
        $this->data['posts']  = $posts;
        
        $this->load->view('header', $this->data);
        $this->load->view('thread/talk');
        $this->load->view('footer');
    }
    
    public function category($slug, $start = 0)
    {
        $category = $this->db->get_where(TBL_CATEGORIES, array('slug' => $slug))->row();
        $this->load->model('admin_model');
        $this->data['cat']    = $this->admin_model->category_get_all_parent($category->id, 0);
        $this->data['thread'] = $category;
        
        $cat_id = array();
        $child_cat = $this->admin_model->category_get_all($category->id);
        $cat_id[0] = $category->id;
        foreach ($child_cat as $cat) {
            $cat_id[] = $cat['id'];
        }
        $this->load->model('admin_model');
        $this->data['categories'] = $this->admin_model->category_get_all();
        
        // set pagination
        $this->load->library('pagination');
        $this->page_config['base_url']    = site_url('thread/category/'.$slug);
        $this->page_config['uri_segment'] = 4;
        $this->page_config['total_rows']  = $this->thread_model->get_total_by_category($cat_id);
        $this->page_config['per_page']    = 10;
        
        $this->set_pagination();
        
        $this->pagination->initialize($this->page_config);
        
        $this->data['page']    = $this->pagination->create_links();
        
        $this->data['threads'] = $this->thread_model->get_by_category($start, $this->page_config['per_page'], $cat_id);
        
        $this->data['type']    = 'category';
        $this->data['title']   = 'Category :: '.$category->name.CIBB_TITLE;
        $this->load->view('header', $this->data);
        $this->load->view('thread/index');
        $this->load->view('footer');
    }
}
