<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function index()
  {
    if($this->session->userdata('logged_in')) {
      redirect('home');
    } else {
      redirect('auth/login');
    }
  }

  public function login()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'nombre de usuario', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'contraseña', 'trim|required|xss_clean|callback_validate_user');

    if (!$this->form_validation->run()) {
      $this->load->helper('form');

      $this->load->view('layout/header');
      $this->load->view('auth/login');
      $this->load->view('layout/footer');
    } else {
      redirect('home');
    }
  }

  public function validate_user($password)
  {
    $this->load->model('User');

    $username = $this->input->post('username');

    $user = $this->User->validate($username, $password);

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
      $this->form_validation->set_message('validate_user', 'Nombre de usuario o contraseña invalidos.');
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
