<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    redirect('auth/login');
  }

  public function login()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Nombre de usuario', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean|callback_validate_user');

    if($this->form_validation->run() === FALSE) {
      $this->load->helper('form');

      $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
      $this->load->view('login');
      $this->load->view('layout/footer');
    } else {
      redirect('home');
    }
  }

  public function validate_user($password)
  {
    $this->load->model('user','',TRUE);

    $username = $this->input->post('username');

    $user = $this->user->validate($username, $password);

    if($user) {
      $sess_array = array();

      foreach($user as $row) {

        $sess_array = array(
          'id' => $row->id,
          'username' => $row->username
        );

        $this->session->set_userdata('logged_in', $sess_array);
      }

      return TRUE;
    } else {
      $this->form_validation->set_message('validate_user', 'Invalid username or password');
      return FALSE;
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect();
  }

}
