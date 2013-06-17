<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_Hours extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    if ($this->input->post()) {
      $this->load->model('Reported_Hour');

      $user_id = $this->input->post('user');
      $week_id = $this->input->post('week');

      $projects = $this->input->post('projects');

      foreach ($projects as $project_id => $hours) {
        if ($hours >= 0) {
          $this->Reported_Hour->save($project_id, $user_id, $week_id, $hours);
        }
      }

      redirect('home');
    }

    $this->load->helper('form');
    $this->load->model('Project');

    $projects = $this->Project->get_all_active();

    $this->load->model('User');

    $users = $this->User->parse_to_select($this->User->get_all());

    $this->load->model('Week');

    $weeks = $this->Week->parse_to_select($this->Week->get_all());

    $last_week = reset(array_keys($weeks));

    $this->load->model('Reported_Hour');

    $reported_hours = $this->Reported_Hour->parse_to_select($this->Reported_Hour->get_all());

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/begin_content', array('selected' => 'report_hours'));
    $this->load->view('report_hours/index', array(
      'users' => $users,
      'weeks' => $weeks,
      'last_week' => $last_week,
      'projects' => $projects,
      'reported_hours' => $reported_hours
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
