<?php
  class User_model extends CI_Model {

    public function register($enc_password) {
      // User data array
      $data = array(
        'name' => $this->input->post('name'),
        'zipcode' => $this->input->post('zipcode'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $enc_password
      );

      // insert user
      return $this->db->insert('users', $data);
    }

    // log user in
    public function login($username, $password) {
      // validate - match 'username' column to $username that user entered
      $this->db->where('username', $username);
      $this->db->where('password', $password);

      $result = $this->db->get('users');

      // if numrows() == 1 then that means the validation passed.
      if ($result->num_rows() == 1) {
        // return the 'id' from the first row (0)
        return $result->row(0)->id;
      } else {
        return false;
      }
    }

    // Check username exists in database
    // pass in $username (what the user has tried to register with)
    public function check_username_exists($username) {
      
      // check table 'users' for collumn 'username' to see if it matches $username
      $query = $this->db->get_where('users', array('username' => $username));

      // if 'username' collumn has no entries with $username, return true.
      if (empty($query->row_array())) {
        return true;
      } else {
        return false;
      }
    }

    // Check email exists in database
    // pass in $email (what the user has tried to register with)
    public function check_email_exists($email) {
      
      // check table 'users' for collumn 'email' to see if it matches $email
      $query = $this->db->get_where('users', array('email' => $email));

      // if 'email' collumn has no entries with $email, return true.
      if (empty($query->row_array())) {
        return true;
      } else {
        return false;
      }
    }
  }