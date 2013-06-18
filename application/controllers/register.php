<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'mail de usuario', 'trim|required|xss_clean');
    $this->form_validation->set_rules('name', 'nombre de usuario', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'contraseña', 'trim|required|xss_clean|callback_validate_user');

$this->form_validation->run();
      $this->load->helper('form');

      $this->load->view('layout/header');
      $this->load->view('layout/begin_content', array('selected' => 'register'));
      $this->load->view('register/index');
      $this->load->view('layout/end_content');
      $this->load->view('layout/footer');

  }

  public function validate_user($password)
  {
    $this->load->model('User');

    $username = $this->input->post('username');
    $name = $this->input->post('name');
    $salary = $this->input->post('salary');
    $rol = $this->input->post('rol');

    $user = $this->User->register($username, $password, $name, $salary, $rol);

    if($user) {
      $this->form_validation->set_message('validate_user', 'Usuario registrado.');
      return false;
    } else {
      $this->form_validation->set_message('validate_user', 'Nombre de usuario o contraseña invalidos.');
      return FALSE;
    }
  }

}
