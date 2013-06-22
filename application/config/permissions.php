<?php

global $publicAccess, $permissions;

$publicAccess = [
  'auth' => [
    'index'        => true,
    'login'        => true,
    'logout'       => true,
    'unauthorized' => true
  ]
];

$permissions = [
  'admin' => [
    'projects' => [
      'index'  => true,
      'add'    => true,
      'edit'   => true,
      'delete' => true
    ],
    'report_hours' => [
      'index'         => true,
      'get_user_data' => true
    ],
    'reports' => [
      'index'              => true,
      'horas_por_proyecto' => true
    ]
  ],
  'pmo' => [
    'projects' => [
      'index'  => true,
      'add'    => false,
      'edit'   => false,
      'delete' => false
    ],
    'report_hours' => [
      'index'         => false,
      'get_user_data' => false
    ],
    'reports' => [
      'index'              => true,
      'horas_por_proyecto' => true
    ]
  ],
  'manager' => [
    'projects' => [
      'index'  => false,
      'add'    => false,
      'edit'   => false,
      'delete' => false
    ],
    'report_hours' => [
      'index'         => true,
      'get_user_data' => true
    ],
    'reports' => [
      'index'              => true,
      'horas_por_proyecto' => true
    ]
  ],
  'developer' => [
    'projects' => [
      'index'  => false,
      'add'    => false,
      'edit'   => false,
      'delete' => false
    ],
    'report_hours' => [
      'index'         => true,
      'get_user_data' => true
    ],
    'reports' => [
      'index'              => false,
      'horas_por_proyecto' => false
    ]
  ]
];
