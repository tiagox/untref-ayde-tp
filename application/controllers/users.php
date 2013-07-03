<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  private $roles = array(
      'developer' => 'Desarrollador',
      'manager' => 'Lider de proyecto',
      'pmo' => 'PMO',
      'admin' => 'Administrador',
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
      'roles' => $this->roles,
      'users' => $users
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/users.js')));
  }

  public function add()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'nombre de usuario', 'trim|valid_email|required|xss_clean');
    $this->form_validation->set_rules('password', 'contraseña', 'trim|required|xss_clean');
    $this->form_validation->set_rules('name', 'nombre', 'trim|required|xss_clean');
    $this->form_validation->set_rules('salary', 'sueldo', 'trim|numeric|required|xss_clean');
    $this->form_validation->set_rules('rol', 'rol', 'trim|required|xss_clean');
    $this->form_validation->set_rules('weekly_hours', 'horas semanales', 'trim|numeric|required|xss_clean');
    $this->form_validation->set_rules('entry_date', 'horas semanales', 'trim|required|xss_clean|callback_save_user');

    if ($this->form_validation->run()) {
      redirect('users');
    }

    $this->load->helper('form');

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'users'
    ));
    $this->load->view('users/add', array('roles' => $this->roles));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/users-add.js')));
  }

  public function save_user($entry_date)
  {
    $this->load->model('User');

    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $name = $this->input->post('name');
    $salary = $this->input->post('salary');
    $rol = $this->input->post('rol');
    $weekly_hours = $this->input->post('weekly_hours');

    if ($this->User->add($username, $password, $name, $salary, $rol, $weekly_hours, $entry_date)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('save_user', 'Ocurrió un error al intentar guardar el usuario.');
      return FALSE;
    }
  }

  public function edit($id)
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'nombre de usuario', 'trim|valid_email|required|xss_clean');
    $this->form_validation->set_rules('password', 'contraseña', 'trim|xss_clean');
    $this->form_validation->set_rules('name', 'nombre', 'trim|required|xss_clean');
    $this->form_validation->set_rules('salary', 'sueldo', 'trim|numeric|required|xss_clean');
    $this->form_validation->set_rules('rol', 'rol', 'trim|required|xss_clean');
    $this->form_validation->set_rules('weekly_hours', 'horas semanales', 'trim|numeric|required|xss_clean');
    $this->form_validation->set_rules('entry_date', 'horas semanales', 'trim|required|xss_clean');
    $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean|callback_update_user');

    if ($this->form_validation->run()) {
      redirect('users');
    }

    $this->load->model('User');

    $user = $this->User->get($id);

    $this->load->helper('form');

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'users'
    ));
    $this->load->view('users/edit', array(
      'roles' => $this->roles,
      'user' => $user
      )
    );
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/users-edit.js')));
  }

  public function update_user($id)
  {
    $this->load->model('User');

    $username = $this->input->post('username');
    $password = $this->input->post('password') ?: null;
    $name = $this->input->post('name');
    $salary = $this->input->post('salary');
    $rol = $this->input->post('rol');
    $weekly_hours = $this->input->post('weekly_hours');
    $entry_date = $this->input->post('entry_date');

    if ($this->User->update($id, $username, $password, $name, $salary, $rol, $weekly_hours, $entry_date)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('update_user', 'Ocurrió un error al intentar guardar el usuario.');
      return FALSE;
    }
  }

  public function delete($id)
  {
    $this->load->model('User');

    $this->User->delete($id);

    redirect('users');
  }

}
