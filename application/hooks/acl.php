<?php


/**
 * @author Santiago Rojo.
 */
class Acl
{

  function checkAccess()
  {
    $CI =& get_instance();
    $CI->load->library('session');

    $routing =& load_class('Router');

    $class = $routing->fetch_class();
    $method = $routing->fetch_method();

    $baseURL = $GLOBALS['CFG']->config['base_url'];

    require_once(__DIR__ . '/../config/permissions.php');


    if (isset($publicAccess[$class][$method]) &&
        $publicAccess[$class][$method]) {
      return;
    }

    if (!$CI->session->userdata('user')) {
      header('Location: ' . $baseURL . 'auth/login');
    }

    $rol = $CI->session->userdata('user')->rol;

    if (isset($permissions[$rol][$class][$method]) &&
        !$permissions[$rol][$class][$method]) {
        header('Location: ' . $baseURL . 'auth/unauthorized');
    }
  }

}
