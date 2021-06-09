<?php
  class Post_model extends CI_Model{
    public function __construct(){
      $this->load->database();
    }

    // set the parameters to be false by default
    public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE) {

      // if limit was passed in...
      if ($limit) {
        $this->db->limit($limit, $offset);
      }

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
        'user_id' => $this->session->userdata('user_id'),
        'post_image' => $post_image
      );

      // table name is 'posts', passing in the $data array
      return $this->db->insert('posts', $data);
    }

    public function update_post() {
      // url_title() function turns it into a slug
      // $this->input->post() is how to get the form values
      $slug = url_title($this->input->post('title'));

      $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'body' => $this->input->post('body'),
        'category_id' => $this->input->post('category_id')
      );

      // where() function is comparing 'id' to $this->input->post('id') to make sure they are the same
      $this->db->where('id', $this->input->post('id'));
      // table name is 'posts', passing in the $data array
      return $this->db->update('posts', $data);
    }

    public function delete_post($id) {

      // find image to delete too
      $image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
      // save the current working directory
      $cwd = getcwd();
      $image_file_path = $cwd."\\assets\\images\\posts\\";
      chdir($image_file_path);
      unlink($image_file_name);
      // restore previous working directory
      chdir($cwd);

      // where() function is comparing 'id' to $id to make sure they are the same
      $this->db->where('id', $id);

      // delete from table name 'posts'
      $this->db->delete('posts');

      return true;
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

    // Check post title exists in database
    // pass in $title (what the user has tried to register with)
    public function check_post_title_exists($title) {
      
      // check table 'posts' for collumn 'email' to see if it matches $email
      $query = $this->db->get_where('posts', array('title' => $title));

      // if 'title' collumn has no entries with $email, return true.
      if (empty($query->row_array())) {
        return true;
      } else {
        return false;
      }
    }

  }