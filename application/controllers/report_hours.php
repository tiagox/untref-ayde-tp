<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_Hours extends CI_Controller {

  const HOURS_TOLERANCE_FACTOR = 2;

  public function index()
  {
    $this->load->helper('form');
    $this->load->model('Project');

    if ($this->input->post()) {
      $this->load->model('Reported_Hour');

      $user = $this->session->userdata('user');

      $week_id = $this->input->post('week');

      $projects = $this->input->post('projects');

      if (array_sum($projects) <= $user->weekly_hours * self::HOURS_TOLERANCE_FACTOR) {
        foreach ($projects as $project_id => $hours) {
          if ($hours >= 0) {
            $this->Reported_Hour->save($project_id, $user->id, $week_id, $hours);
          }
        }

        $this->session->set_flashdata('success', 'Las horas fueron guardadas correctamente.');

        redirect('report_hours');
      } else {
        $this->session->set_flashdata('error', 'Superó el limite de horas reportadas por semana.');

        redirect('report_hours');
      }
    }

    $this->load->model('Week');
    $weeks = $this->Week->parse_to_select($this->Week->get_weeks_to_report());
    $last_week = reset(array_keys($weeks));

    $projects = $this->Project->get_all_active();

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'report_hours'
    ));
    $this->load->view('report_hours/index', array(
      'weeks' => $weeks,
      'last_week' => $last_week,
      'projects' => $projects
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/report_hours.js')));
  }

  public function get_user_data()
  {
    $user_id = intval($this->session->userdata('user')->id);

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
