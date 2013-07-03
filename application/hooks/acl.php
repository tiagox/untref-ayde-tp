<?php

require_once(__DIR__ . '/../config/permissions.php');

/**
 * @author Santiago Rojo.
 */
class Acl
{

  function checkAccess()
  {
    $CI =& get_instance();
    $CI->load->library('session');

    if ($CI->input->is_cli_request()) {
      return;
    }

    $routing =& load_class('Router');

    $class = $routing->fetch_class();
    $method = $routing->fetch_method();

    $baseURL = $GLOBALS['CFG']->config['base_url'];

    if (isset($GLOBALS['publicAccess'][$class][$method]) &&
        $GLOBALS['publicAccess'][$class][$method]) {
      return;
    }

    if (!$CI->session->userdata('user')) {
      header('Location: ' . $baseURL . 'auth/login');
    }

    $rol = $CI->session->userdata('user')->rol;

    if (isset($GLOBALS['permissions'][$rol][$class][$method]) &&
        !$GLOBALS['permissions'][$rol][$class][$method]) {
        header('Location: ' . $baseURL . 'auth/unauthorized');
    }
  }

}
