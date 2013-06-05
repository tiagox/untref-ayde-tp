<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('logged_in')) {
      redirect('auth/logout');
    }
  }

  public function index()
  {
    $this->load->view('layout/header', array('title' => 'Soluciones informaticas'));
    $this->load->view('layout/begin_content', array('selected' => 'reports'));
    $this->load->view('reports/index');
    $this->load->view('layout/end_content');
    $this->load->view('layout/footer');
  }

}
