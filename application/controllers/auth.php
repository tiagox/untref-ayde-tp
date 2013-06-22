<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function index()
  {
    if($this->session->userdata('user')) {
      switch ($this->session->userdata('user')->rol) {
        case 'admin':
        case 'pmo':
          redirect('reports');
          break;
        case 'manager':
        case 'developer':
          redirect('report_hours');
          break;
      }
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
      redirect();
    }
  }

  public function validate_user($password)
  {
    $this->load->model('User');

    $username = $this->input->post('username');

    $user = $this->User->validate($username, $password);

    if($user) {
      $this->session->set_userdata('user', $user);
      return TRUE;
    } else {
      $this->form_validation->set_message('validate_user', 'Nombre de usuario o contraseña invalidos.');
      return FALSE;
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('user');
    session_destroy();
    redirect();
  }

  public function unauthorized()
  {
    $this->load->view('layout/header');
    $this->load->view('auth/unauthorized');
    $this->load->view('layout/footer');
  }

}
