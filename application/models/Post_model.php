<?php
  class Post_model extends CI_Model{
    public function __construct(){
      $this->load->database();
    }

    public function get_posts($slug = FALSE){
      if($slug === FALSE) {
        // order posts by latest first. sort by ID in descending order.
        // 'DESC' = descending. 'ASC' = ascending.
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('posts');
        return $query->result_array();
      }

      $query = $this->db->get_where('posts', array('slug' => $slug));
      return $query->row_array();
    }

    public function create_post() {
      // url_title() function turns it into a slug
      // $this->input->post() is how to get the form values
      $slug = url_title($this->input->post('title'));

      $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'body' => $this->input->post('body'),
      );

      // table name is 'posts', passing in the $data array
      return $this->db->insert('posts', $data);
    }

    public function delete_post($id) {
      // where() function is comparing 'id' to $id to make sure they are the same
      $this->db->where('id', $id);
      // delete from table name 'posts'
      $this->db->delete('posts');
      return true;
    }

    public function update_post() {
      // url_title() function turns it into a slug
      // $this->input->post() is how to get the form values
      $slug = url_title($this->input->post('title'));

      $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'body' => $this->input->post('body'),
      );

      // where() function is comparing 'id' to $this->input->post('id') to make sure they are the same
      $this->db->where('id', $this->input->post('id'));
      // table name is 'posts', passing in the $data array
      return $this->db->update('posts', $data);
    }

  }