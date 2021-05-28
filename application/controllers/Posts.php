<?php

Class Posts extends CI_Controller{
  
  Public function index() {
    // $data array is variables to be passed into the view
    // create variable 'title' inside array '$data'    
    $data['title'] = 'Latest Posts';

    // add to data array 
    $data['posts'] = $this->post_model->get_posts();
    //print_r($data['posts']);

    // load the views - header, page and footer
    // automatically looks in views folder...
    $this->load->view('templates/header');
    // page name & pass the $data array
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug = NULL) {
    $data['post'] = $this->post_model->get_posts($slug);

    if (empty($data['post'])) {
      show_404();
    }

    $data['title'] = $data['post']['title'];
    //print_r($data['title']);

    $this->load->view('templates/header');
    $this->load->view('posts/view', $data);
    $this->load->view('templates/footer');
  }

  public function create() {
    $data['title'] = 'Create Post';  
    //print_r($data['title']);

    // setting rules for 'title' with name 'Title' and rule to set is 'required'
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    // check if form has been submitted correctly
    if ($this->form_validation->run() === FALSE) {
      // if it doesn't run, load the basic form template
      $this->load->view('templates/header');
      $this->load->view('posts/create', $data);
      $this->load->view('templates/footer');
    } else {
      // if form has been submitted & validation passes...
      // call a model function to submit new post to database
      $this->post_model->create_post();
      // load 'success' view
      //$this->load->view('posts/success');
      // redirecting to default posts view
      redirect('posts');
    }
  }

  public function delete($id) {
    // calling a model function 'delete_post' and passing the id of post to be deleted
    $this->post_model->delete_post($id);
    // redirect to posts page once deletion has occurred
    redirect('posts');
  }

  public function edit($slug) {
    // edit function needs to get the post & display the form for editing it
    $data['post'] = $this->post_model->get_posts($slug);

    if (empty($data['post'])) {
      show_404();
    }

    $data['title'] = 'Edit post';
    //print_r($data['title']);

    $this->load->view('templates/header');
    $this->load->view('posts/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update() {
    $this->post_model->update_post();
    // redirect to posts page once update has occurred
    redirect('posts');
  }

}