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
    $this->load->helper('form');
    $this->load->model('Project');

    $projects = $this->Project->get_all_active();

    $weeks = array(
      '1' => '27/05/2013 - 31/05/2013'
    );
    $last_week = '1';

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/begin_content', array('selected' => 'report_hours'));
    $this->load->view('report_hours/index', array(
      'weeks' => $weeks,
      'last_week' => $last_week,
      'projects' => $projects
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
