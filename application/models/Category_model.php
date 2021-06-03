<?php
  class Category_model extends CI_Model{
    public function __construct(){
      $this->load->database();
    }

    public function create_category() {
      $data = array(
        // grab input from 'name' field of html form
        'name' => $this->input->post('name')
      );

      // table name is 'categories', passing in the $data array
      return $this->db->insert('categories', $data);
    }

    public function get_categories() {
      $this->db->order_by('id');
      // get db table with name 'categories' and store it in $query
      $query = $this->db->get('categories');
      // return the result as an array
      return $query->result_array();
    }

    public function get_category($id) {
      // in categories table, is 'id' column == $id variable?
      $query = $this->db->get_where('categories', array('id' => $id));

      // fetch the row
      return $query->row();
    }
  }