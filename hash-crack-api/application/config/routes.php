<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Admin';
$route['(?i)login'] = 'Admin/login';
$route['(?i)register'] = 'Admin/register';
$route['(?i)logout'] = 'Admin/logout';
$route['(?i)api'] = 'Admin/get';
$route['(?i)api/(:any)'] = 'Admin/get/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
