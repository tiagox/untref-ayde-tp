<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_Hours extends CI_Controller {

  const HOURS_TOLERANCE_FACTOR = 2;

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    $this->load->helper('form');
    $this->load->model('Project');
    $this->load->model('User');

    if ($this->input->post()) {
      $this->load->model('Reported_Hour');

      $user_id = $this->input->post('user');

      $user = $this->User->get_by_id($user_id);

      $week_id = $this->input->post('week');

      $projects = $this->input->post('projects');

      if (array_sum($projects) <= $user->weekly_hours * self::HOURS_TOLERANCE_FACTOR) {
        foreach ($projects as $project_id => $hours) {
          if ($hours >= 0) {
            $this->Reported_Hour->save($project_id, $user_id, $week_id, $hours);
          }
        }

        $this->session->set_flashdata('success', 'Las horas fueron guardadas correctamente.');

        redirect('report_hours');
      } else {
        $this->session->set_flashdata('error', 'Superó el limite de horas reportadas por semana.');

        redirect('report_hours');
      }
    }

    $projects = $this->Project->get_all_active();

    $users = $this->User->parse_to_select($this->User->get_all());

    $this->load->model('Week');

    $weeks = $this->Week->parse_to_select($this->Week->get_all());

    $last_week = reset(array_keys($weeks));

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array('selected' => 'report_hours'));
    $this->load->view('report_hours/index', array(
      'users' => $users,
      'weeks' => $weeks,
      'last_week' => $last_week,
      'projects' => $projects
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/report_hours.js')));
  }

  public function get_user_data()
  {
    $user_id = intval($this->input->post('user_id'));

    $user_data = array();

    if ($user_id) {
      $this->load->model('Reported_Hour');

      $user_data = $this->Reported_Hour->get_all_by_user_id($user_id);

      $this->load->model('User');

      $user_data['weeklyHours'] = $this->User->get_by_id($user_id)->weekly_hours;
    }

    $this->load->view('layout/json', array('data' => $user_data));
  }

}
