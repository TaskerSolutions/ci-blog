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
    // this is getting the single post
    $data['post'] = $this->post_model->get_posts($slug);
    $post_id = $data['post']['id'];
    // add 'comments' to $data array (this passes the comments into the view)
    $data['comments'] = $this->comments_model->get_comments($post_id);

    if (empty($data['post'])) {
      show_404();
    }

    $data['title'] = $data['post']['title'];
    //print_r($data['title']);

    $data['categories'] = $this->post_model->get_categories();

    $this->load->view('templates/header');
    $this->load->view('posts/view', $data);
    $this->load->view('templates/footer');
  }

  public function create() {
    $data['title'] = 'Create Post';  
    //print_r($data['title']);

    // add categories element to $data array
    //fetch categories from database using get_categories() function found in the post_model
    // could create a separate 'categories_model' if project were getting larger
    $data['categories'] = $this->post_model->get_categories();

    // setting rules for 'title' with name 'Title' and rule to set is 'required'
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    // TODO: run a check to see if title/slug have been used before
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    // check if form has been submitted correctly
    if ($this->form_validation->run() === FALSE) {
      // if it doesn't run, load the basic form template
      $this->load->view('templates/header');
      $this->load->view('posts/create', $data);
      $this->load->view('templates/footer');
    } else {
      // if form has been submitted & validation passes...

      // upload image $config array
      $config['upload_path'] = './assets/images/posts';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '40960';
      $config['max_width'] = '10000';
      $config['max_height'] = '10000';

      // ('upload') is the action to preform, ($config) is the variables
      $this->load->library('upload', $config);

      // check to see if file was uploaded
      if(!$this->upload->do_upload()) {
        // if not uploaded
        // TODO: check for and display errors...
        // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $errors = array('error' => $this->upload->display_errors());
        // this will create a default image, if the user chooses not to upload one
        $post_image = 'noimage.png';
      } else {
        // if file is uploaded
        $date = array('upload_date' => $this->upload->data());
        // get the superglobal $_FILES
        // ['userfile'] is the name of the input in form
        // ['name'] = ?
        $post_image = $_FILES['userfile']['name'];
      }

      // call a model function to submit new post to database
      // pass $post_image into the model function
      $this->post_model->create_post($post_image);

      // could load 'success' view... $this->load->view('posts/success');
      // currently just redirecting to default posts view
      redirect('posts');
    }
  }

  public function edit($slug) {
    // edit function needs to get the post & display the form for editing it
    $data['post'] = $this->post_model->get_posts($slug);

    if (empty($data['post'])) {
      show_404();
    }

    $data['title'] = 'Edit post';
    //print_r($data['title']);

    // add categories element to $data array
    $data['categories'] = $this->post_model->get_categories();

    $this->load->view('templates/header');
    $this->load->view('posts/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update() {
  
    $this->post_model->update_post();
    // redirect to posts page once update has occurred
    redirect('posts');
  }

  public function delete($id) {
    // calling a model function 'delete_post' and passing the id of post to be deleted
    $this->post_model->delete_post($id);
    // redirect to posts page once deletion has occurred
    redirect('posts');
  }

}