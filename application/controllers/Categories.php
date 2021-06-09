<?php

  class categories extends CI_Controller {

    public function index() {

      $data['title'] = 'Categories' ;

      $data['categories'] = $this->category_model->get_categories() ;

      $this->load->view('templates/header');
      $this->load->view('categories/index', $data);
      $this->load->view('templates/footer');
    }

    public function create() {

      // check if user is logged in
      if (!$this->session->userdata('logged_in')) {
        $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
        redirect('users/login');
      }

      $data['title'] = 'Create category' ;

      $this->form_validation->set_rules('name', 'Name','required');

      if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
        $this->load->view('categories/create', $data);
        $this->load->view('templates/footer');
      } else {
        $this->category_model->create_category();

        // Set a message to display after the redirect
        // autoload('session') must be enabled for this to work
        // set_flashdata(<id>, <message>)
        $this->session->set_flashdata('caterogy_created', 'Your category has been created.');

        redirect('categories');
      } 
    }

    public function posts($id) {
    
      // id is coming from the slug apparently?
      // get the category and set it to 'name' ??
      $data['title'] = $this->category_model->get_category($id)->name;

      $data['posts'] = $this->post_model->get_posts_by_category($id);

      $this->load->view('templates/header');
      $this->load->view('posts/index', $data);
      $this->load->view('templates/footer');
    }

    public function delete($id) {

      // check if user is logged in
      if (!$this->session->userdata('logged_in')) {
        $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
        redirect('users/login');
      }

      // calling a model function 'delete_post' and passing the id of post to be deleted
      $this->category_model->delete_category($id);

      // Set a message to display after the redirect
      $this->session->set_flashdata('category_deleted', 'The category has been deleted.');

      // redirect to posts page once deletion has occurred
      redirect('categories');
    }
  }