<?php

//$config['mailpath'] = '/usr/sbin/sendmail';
$config['protocol'] = 'smtp';
$config['smtp_auth'] = TRUE;
$config['smtp_host'] = 'mail.secoweb.com.mx';
$config['smtp_port'] = '2525';
$config['smtp_user'] = 'sistemas@secoweb.com.mx';
$config['smtp_pass'] = 'IXR_pdGxNvI?';
$config['mailtype'] = 'html';
$config['validate'] = 'TRUE';
$config['wordwrap'] = FALSE;
$config['crlf'] = '\r\n';
$config['newline'] = '\r\n';
/*
 * Aqui iria el correo del desarrollador en la fase de pruebas o 
 * el correo del dueño del sitio en la fase de produccion asi que 
 * hay que utilizar estas keys para enviar los correos en lugara de
 * poner directamente el email en cada controller.
 */
$config['to_name'] = 'Hellohouse';
$config['to_email'] = 'hgjuanramon@gmail.com';

/**
 * example
 * 
 * $this->config->load('email', TRUE);
 * $email_config = $this->config->item('email');
 * echo $email_config['to_name'];
 */