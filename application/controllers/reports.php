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

  public function index()
  {
    $this->load->helper('form');
    $this->load->model('Week');

    $months = $this->Week->get_reports_months_for_select();

    $this->load->view('layout/header');
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'reports'
    ));
    $this->load->view('reports/index', array('months' => $months));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer', array('jsFiles' => array('/js/reports.js')));
  }

  public function horas_por_proyecto($year, $month)
  {
    $this->load->model('Week');

    if (!$year) {
      throw new Exception('Se requiere el año para poder generar este reporte.');
    }

    if (!$month) {
      throw new Exception('Se requiere el mes para poder generar este reporte.');
    }

    $month_name = $this->months_names[$month];
    $month_period = $this->Week->get_month_period_dates($month);

    $this->load->model('Reported_Hour');

    $report_rows = $this->Reported_Hour->get_cost_report($year, $month);

    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/begin_content', array(
      'rol' => $this->session->userdata('user')->rol,
      'permissions' => $GLOBALS['permissions'],
      'selected' => 'reports'
    ));
    $this->load->view('reports/horas_por_proyecto', array(
      'month_name' => $month_name,
      'month_period' => $month_period,
      'report_rows' => $report_rows
    ));
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
