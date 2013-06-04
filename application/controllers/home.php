<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
    $this->load->view('layout/navbar');
    $this->load->view('home/index');
    $this->load->view('layout/footer');
  }
}
