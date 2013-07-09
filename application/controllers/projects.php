<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

  private $status = array(
      '1' => 'Activo',
      '0' => 'Inactivo'
    );

  public function index()
  {
    $this->load->model('Project');

    $projects = $this->Project->get_all();

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'projects'
    ));
    $this->load->view('projects/index', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'projects' => $projects
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/projects.js')));
  }

  public function add()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'nombre', 'trim|required|xss_clean');
    $this->form_validation->set_rules('active', 'estado', 'trim|required|xss_clean');

    if ($this->form_validation->run() && $this->save_project()) {
      redirect('projects');
    }

    $this->load->helper('form');

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'projects'
    ));
    $this->load->view('projects/add', array('status' => $this->status));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

  public function save_project()
  {
    $this->load->model('Project');

    $name = $this->input->post('name');
    $active = $this->input->post('active');

    if ($this->Project->add($name, $active)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('save_project', 'Ocurrió un error al intentar guardar el proyecto.');
      return FALSE;
    }
  }

  public function edit($id)
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('name', 'nombre', 'trim|required|xss_clean');
    $this->form_validation->set_rules('active', 'estado', 'trim|required|xss_clean');

    if ($this->form_validation->run() && $this->update_project()) {
      redirect('projects');
    }

    $this->load->model('Project');

    $project = $this->Project->get($id);

    $this->load->helper('form');

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'projects'
    ));
    $this->load->view('projects/edit', array(
      'status' => $this->status,
      'project' => $project
      )
    );
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

  public function update_project()
  {
    $this->load->model('Project');

    $id = $this->input->post('id');
    $name = $this->input->post('name');
    $active = $this->input->post('active');

    if ($this->Project->update($id, $name, $active)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('update_project', 'Ocurrió un error al intentar guardar el proyecto.');
      return FALSE;
    }
  }

  public function delete($id)
  {
    $this->load->model('Project');

    $this->Project->delete($id);

    redirect('projects');
  }

}
