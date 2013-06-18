<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

  private $months_names = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
  );

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array('selected' => 'reports'));
    $this->load->view('reports/index');
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

  public function horas_por_proyecto()
  {
    $this->load->model('Week');

    $month = $this->Week->get_last_closed_month();
    $month_name = $this->months_names[$month];
    $month_period = $this->Week->get_month_period_dates($month);

    $this->load->model('Reported_Hour');

    $report_rows = $this->Reported_Hour->get_cost_report($month);

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/begin_content', array('selected' => 'reports'));
    $this->load->view('reports/horas_por_proyecto', array(
      'month_name' => $month_name,
      'month_period' => $month_period,
      'report_rows' => $report_rows
      )
    );
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
