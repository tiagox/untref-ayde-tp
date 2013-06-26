<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  private $roles = array(
      'admin' => 'Administrador',
      'pmo' => 'PMO',
      'manager' => 'Lider de proyecto',
      'developer' => 'Desarrollador',
    );

  public function index()
  {
    $this->load->model('User');

    $users = $this->User->get_all();

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'users'
    ));
    $this->load->view('users/index', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'users' => $users
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
