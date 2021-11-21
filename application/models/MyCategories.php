<?php
class MyCategories extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
	public function get_categories($parent = NULL)
	{
        $query = $this->db->get_where('categories', array('parent' => $parent));
        return $query->result_array();
	}
}