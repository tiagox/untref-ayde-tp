<?php

class Cli extends CI_Controller {

  public function send_reminder()
  {
    if ($this->input->is_cli_request()) {
      $this->load->model('User');

      $users = $this->User->get_reporter_users();

      $this->load->library('email');

      foreach ($users as $user) {
        $this->email->from('tiagox@gmail.com', 'Santiago Rojo');
        $this->email->to($user->username);
        $this->email->cc('tiagox@gmail.com');
        $this->email->subject('Reporte de Costos - Recordatorio');
        $this->email->message($user->name . ', por favor reporte las horas trabajadas de la semana anterior al sistema.

Muchas gracias.

--
Soluciones informáticas');
        if ($this->email->send()) {
          print('El usuario ' . $user->username . ' fue notificado con exito.' . PHP_EOL);
        } else {
          print('Hubo un error al notificar al usuario ' . $user->username . PHP_EOL);
        }
      }
    }
  }

}
