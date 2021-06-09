<?php
  class Users extends CI_Controller {

    // register user
    public function register() {
      $data['title'] = 'Register account';

      // (<thing to validate>, <readable version>, <rule>)
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
      $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

      if ($this->form_validation->run() === FALSE) {
        // if validation was unsuccessful...
        $this->load->view('templates/header');
        $this->load->view('users/register', $data);
        $this->load->view('templates/footer');
      } else {
        // if successful...
        // md5 encryption - not the strongest, but very easy
        $enc_password = md5($this->input->post('password'));
        
        $this->user_model->register($enc_password);

        // Set a message to display after the redirect
        // autoload('session') must be enabled for this to work
        // set_flashdata(<id>, <message>)
        $this->session->set_flashdata('user_registered', 'You are now registered and can log in.');

        redirect('users/login');
      }
    }

    // log in user
    public function login() {
      $data['title'] = 'Login to your account';

      // (<thing to validate>, <readable version>, <rule>)
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() === FALSE) {
        // if validation was unsuccessful...
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
      } else {
        // if successful...

        // get username
        $username = $this->input->post('username');

        // get and encrypt password
        $password = md5($this->input->post('password'));

        // model function will match usersname & password to ones stored in database
        // function will return the 'user_id' if login was successful
        $user_id = $this->user_model->login($username, $password);

        // if there is a user_id returned from the model function...
        if ($user_id) {
          // create session... 
          $user_data = array(
            'user_id' => $user_id,
            'username' => $username,
            'logged_in' => true
          );

          // store the $user_data array in session, so it can be accessed at any time
          $this->session->set_userdata($user_data);

          // Set a message to display after the redirect
          // autoload('session') must be enabled for this to work
          // set_flashdata(<id>, <message>)
          $this->session->set_flashdata('user_logged_in', 'You are now logged in.');
          redirect('posts');
        } else {
          // Set a message to display after the redirect
          // autoload('session') must be enabled for this to work
          // set_flashdata(<id>, <message>)
          $this->session->set_flashdata('login_failed', 'Username or password was incorrect. Please try again.');
          
          redirect('users/login');
        }
      }
    }

    // log user out
    public function logout() {
      // kill all user session data
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('username');

      // Set a message to display after the redirect
      // autoload('session') must be enabled for this to work
      // set_flashdata(<id>, <message>)
      $this->session->set_flashdata('user_logged_out', 'You have been logged out successfully.');

      redirect('users/login'); 
    }

    // check if username exists
    public function check_username_exists($username) {
      $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one.');

      if ($this->user_model->check_username_exists($username)) {
        return true;
      } else {
        return false;
      }
    }

    // check if email exists
    public function check_email_exists($email) {
      $this->form_validation->set_message('check_email_exists', 'That email is already registered to an account. Please use a different one.');

      if ($this->user_model->check_email_exists($email)) {
        return true;
      } else {
        return false;
      }
    }
  }