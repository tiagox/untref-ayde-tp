<?php

global $publicAccess, $permissions;

$publicAccess = array();
$publicAccess['auth']['index']        = true;
$publicAccess['auth']['login']        = true;
$publicAccess['auth']['logout']       = true;
$publicAccess['auth']['unauthorized'] = true;

$permissions = array();
$permissions['admin']['projects']['index']                 = true;
$permissions['admin']['projects']['add']                   = true;
$permissions['admin']['projects']['edit']                  = true;
$permissions['admin']['projects']['delete']                = true;
$permissions['admin']['report_hours']['index']             = false;
$permissions['admin']['report_hours']['get_user_data']     = false;
$permissions['admin']['reports']['index']                  = true;
$permissions['admin']['reports']['horas_por_proyecto']     = true;
$permissions['admin']['users']['index']                    = true;
$permissions['admin']['users']['add']                      = true;
$permissions['admin']['users']['edit']                     = true;
$permissions['admin']['users']['delete']                   = true;

$permissions['pmo']['projects']['index']                   = true;
$permissions['pmo']['projects']['add']                     = false;
$permissions['pmo']['projects']['edit']                    = false;
$permissions['pmo']['projects']['delete']                  = false;
$permissions['pmo']['report_hours']['index']               = false;
$permissions['pmo']['report_hours']['get_user_data']       = false;
$permissions['pmo']['reports']['index']                    = true;
$permissions['pmo']['reports']['horas_por_proyecto']       = true;
$permissions['pmo']['users']['index']                      = true;
$permissions['pmo']['users']['add']                        = false;
$permissions['pmo']['users']['edit']                       = false;
$permissions['pmo']['users']['delete']                     = false;

$permissions['manager']['projects']['index']               = false;
$permissions['manager']['projects']['add']                 = false;
$permissions['manager']['projects']['edit']                = false;
$permissions['manager']['projects']['delete']              = false;
$permissions['manager']['report_hours']['index']           = true;
$permissions['manager']['report_hours']['get_user_data']   = true;
$permissions['manager']['reports']['index']                = true;
$permissions['manager']['reports']['horas_por_proyecto']   = true;
$permissions['manager']['users']['index']                  = false;
$permissions['manager']['users']['add']                    = false;
$permissions['manager']['users']['edit']                   = false;
$permissions['manager']['users']['delete']                 = false;

$permissions['developer']['projects']['index']             = false;
$permissions['developer']['projects']['add']               = false;
$permissions['developer']['projects']['edit']              = false;
$permissions['developer']['projects']['delete']            = false;
$permissions['developer']['report_hours']['index']         = true;
$permissions['developer']['report_hours']['get_user_data'] = true;
$permissions['developer']['reports']['index']              = false;
$permissions['developer']['reports']['horas_por_proyecto'] = false;
$permissions['developer']['users']['index']                = false;
$permissions['developer']['users']['add']                  = false;
$permissions['developer']['users']['edit']                 = false;
$permissions['developer']['users']['delete']               = false;
