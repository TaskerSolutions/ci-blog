<?php

Class Posts extends CI_Controller{
  
  Public function index($offset = 0) {

    // config for pagination
    $config['base_url'] = base_url() . 'posts/index';
    // count all the rows in the db posts table
    $config['total_rows'] = $this->db->count_all('posts'); 
    $config['per_page'] = 2;
    // uri segment is the segment that the pagination number will be
    // example: ciblog/segment1/segment2/segment3
    $config['uri_segment'] = 3;
    // add style to the pagination links
    $config['attributes'] = array('class' => 'page-link');

    // init pagination
    $this->pagination->initialize($config);

    // $data array is variables to be passed into the view
    // create variable 'title' inside array '$data'    
    $data['title'] = 'Latest Posts';

    // add to data array 
    $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
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

    // check if user is logged in
    if (!$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
      redirect('users/login');
    }

    $data['title'] = 'Create Post';  
    //print_r($data['title']);

    // add categories element to $data array
    //fetch categories from database using get_categories() function found in the post_model
    // could create a separate 'categories_model' if project were getting larger
    $data['categories'] = $this->post_model->get_categories();

    // setting rules for 'title' with name 'Title' and rule to set is 'required'
    $this->form_validation->set_rules('title', 'Title', 'required|callback_check_post_title_exists');
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
      $config['max_size'] = '4090';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      // ('upload') is the action to preform, ($config) is the variables
      $this->load->library('upload', $config);

      // check to see if file was uploaded
      if(!$this->upload->do_upload()) {
        // if not uploaded
        // @@@@@@@@@@@@@@@@@@@@ TODO: display errors... @@@@@@@@@@@
        $errors = array('error' => $this->upload->display_errors());
        // this will create a default image, if the user chooses not to upload one
        $post_image = 'noimage.png';
      } else {
        // if file is uploaded
        $data = array('upload_data' => $this->upload->data());
        // get the superglobal $_FILES
        // ['userfile'] is the name of the input in form
        // ['name'] = ?
        $post_image = $_FILES['userfile']['name'];
      }

      // call a model function to submit new post to database
      // pass $post_image into the model function
      $this->post_model->create_post($post_image);

        // Set a message to display after the redirect
        // autoload('session') must be enabled for this to work
        // set_flashdata(<id>, <message>)
        $this->session->set_flashdata('post_created', 'Your post has been created.');

      // could load 'success' view... $this->load->view('posts/success');
      // currently just redirecting to default posts view
      redirect('posts');
    }
  }

  public function edit($slug) {

    // check if user is logged in
    if (!$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
      redirect('users/login');
    }

    // edit function needs to get the post & display the form for editing it
    // get_posts() returns the whole array of posts.
    // get_posts($slug) returns the specific post that is being edited
    $data['post'] = $this->post_model->get_posts($slug);

    // check session user != user that created the post
    if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']) {
      redirect('posts');
    }

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

    // check if user is logged in
    if (!$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
      redirect('users/login');
    }
  
    $this->post_model->update_post();

    // Set a message to display after the redirect
    // autoload('session') must be enabled for this to work
    // set_flashdata(<id>, <message>)
    $this->session->set_flashdata('post_updated', 'Your post has been updated.');

    // redirect to posts page once update has occurred
    redirect('posts');
  }

  public function delete($id) {

    // check if user is logged in
    if (!$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('not_logged_in', 'You need to log in to do that.');
      redirect('users/login');
    }

    // calling a model function 'delete_post' and passing the id of post to be deleted
    $this->post_model->delete_post($id);

    // Set a message to display after the redirect
    // autoload('session') must be enabled for this to work
    // set_flashdata(<id>, <message>)
    $this->session->set_flashdata('post_deleted', 'Your post has been deleted.');

    // redirect to posts page once deletion has occurred
    redirect('posts');
  }

  // check if post title exists
  public function check_post_title_exists($title) {
    $this->form_validation->set_message('check_post_title_exists', 'There is already a post with that title. Please use a different one.');

    if ($this->post_model->check_post_title_exists($title)) {
      return true;
    } else {
      return false;
    }
  }

}