<?php
class Categories extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mycategories');
        $this->load->helper('url_helper');
    }

    public function index($parent = NULL)
    {
        $data['categories'] = $this->mycategories->get_categories($parent);
        $data['title'] = 'Category Selector';

        $this->load->view('templates/header', $data);
        $this->load->view('Categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($parent = NULL)
    {
        $data['categories'] = $this->mycategories->get_categories($parent);
		echo json_encode($data['categories']);
    }
}