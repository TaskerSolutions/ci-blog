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

}