<?php

Class Pages extends CI_Controller{
  // default for $page variable is 'home'
  Public function view($page = 'home') {
    // check if file exists. if not show error page
    // APPPATH is Code Igniter constant that gives path to application folder
    if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
      // show_404() is a Code Igniter function to load 404 error
      show_404();
    }

    // $data array is variables to be passed into the view
    // create variable 'title' inside array '$data'
    // ucfirst() function capitalizes the first letter of value of '$page'
    $data['title'] = ucfirst($page);

    // load the views - header, page and footer
    // automatically looks in views folder...
    $this->load->view('templates/header');
    // page name & pass the $data array
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer');

  }
}