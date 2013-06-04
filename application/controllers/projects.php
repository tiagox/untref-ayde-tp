<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    $this->load->model('Project');

    $projects = $this->Project->get_all();

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/navbar');
    $this->load->view('projects/index', array('projects' => $projects));
    $this->load->view('layout/footer');
  }

  public function add()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('active', 'estado', 'trim|required|xss_clean');
    $this->form_validation->set_rules('name', 'nombre', 'trim|required|xss_clean|callback_save_project');

    if ($this->form_validation->run()) {
      redirect('projects');
    }

    $this->load->helper('form');

    $status = array(
      '1' => 'Activo',
      '0' => 'Inactivo'
    );

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/navbar');
    $this->load->view('projects/add', array('status' => $status));
    $this->load->view('layout/footer');
  }

  public function save_project($name)
  {
    $this->load->model('Project');

    $active = $this->input->post('active');

    if ($this->Project->add($name, $active)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('save_project', 'Ocurrió un error al intentar guardar el projecto.');
      return FALSE;
    }
  }

}
