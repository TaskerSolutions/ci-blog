<?php
class comments extends CI_Controller {

  public function create($post_id) {
    $slug = $this->input->post('slug');
    // need to get the current post, incase form validation fails, and need to reload it
    $data['post'] = $this->post_model->get_posts($slug);

    // getting the 'name' field = 'name'
    // readable version = 'Name'
    // rules = 'required'
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('email', 'Email', 'valid_email');
    $this->form_validation->set_rules('comment', 'Comment', 'required');

    if ($this->form_validation->run() === FALSE) {
      // if validation fails... reload the view
       $this->load->view('templates/header');
       $this->load->view('posts/view', $data);
       $this->load->view('templates/footer');
    } else {
      // if validation succeeds...
      $this->comments_model->create_comment($post_id);
      redirect('posts/'.$slug);
    }
  }
}