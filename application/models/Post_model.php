<?php
  class Post_model extends CI_Model{
    public function __construct(){
      $this->load->database();
    }

    public function get_posts($slug = FALSE){
      if($slug === FALSE) {
        // order posts by latest first. sort by ID in descending order.
        // 'DESC' = descending. 'ASC' = ascending.
        // must define which table 'id' is coming from as both tables contain 'id'
        $this->db->order_by('posts.id', 'DESC');

        // join() is required to join the two tables from the db
        // (catgetoies) = table name
        // (categories.id) = categories table & id column
        // (posts.category_id) = posts table & category_id column
        $this->db->join('categories', 'categories.id = posts.category_id');

        $query = $this->db->get('posts');
        return $query->result_array();
      }

      $query = $this->db->get_where('posts', array('slug' => $slug));
      return $query->row_array();
    }

    public function create_post($post_image) {
      // url_title() function turns it into a slug
      // $this->input->post() is how to get the form values
      $slug = url_title($this->input->post('title'));

      $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'body' => $this->input->post('body'),
        'category_id' => $this->input->post('category_id'),
        'post_image' => $post_image
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

    public function update_post($post_image) {
      // url_title() function turns it into a slug
      // $this->input->post() is how to get the form values
      $slug = url_title($this->input->post('title'));

      $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'body' => $this->input->post('body'),
        'category_id' => $this->input->post('category_id'),
        'post_image' => $post_image
      );

      // where() function is comparing 'id' to $this->input->post('id') to make sure they are the same
      $this->db->where('id', $this->input->post('id'));
      // table name is 'posts', passing in the $data array
      return $this->db->update('posts', $data);
    }

    public function get_categories() {
      $this->db->order_by('id');
      // get db table with name 'categories' and store it in $query
      $query = $this->db->get('categories');
      // return the result as an array
      return $query->result_array();
    }

    public function get_posts_by_category($category_id) {
      $this->db->order_by('posts.id', 'DESC');

      // join() is required to join the two tables from the db
      // (catgetoies) = table name
      // (categories.id) = categories table & id column
      // (posts.category_id) = posts table & category_id column
      $this->db->join('categories', 'categories.id = posts.category_id');

      // using get_where() to only get posts from specific category
      // checking if category_id is == the id that is being passed in
      $query = $this->db->get_where('posts', array('category_id' => $category_id));
      return $query->result_array();
    }

  }