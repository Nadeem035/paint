<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'hildes';
$controller_exceptions = array('admin', 'affiliate', 'worker', 'painter');

$route['index'] = 'Hildes/index';
// $route['login'] = 'Hildes/login';
// $route['signup'] = 'Hildes/signup';
// $route['process-login'] = 'Hildes/process_login';
// $route['process-signup'] = 'Hildes/process_signup';
// $route['dashboard'] = 'Hildes/dashboard';
// $route['logout'] = 'Hildes/logout';

/*$route['affiliate-login'] = 'Hildes/affiliate_login';
$route['affiliate-signup'] = 'Hildes/affiliate_signup';
$route['process-affiliate-login'] = 'Hildes/process_affiliate_login';
$route['process-affiliate-signup'] = 'Hildes/process_affiliate_signup';

$route['worker-login'] = 'Hildes/worker_login';
$route['worker-signup'] = 'Hildes/worker_signup';
$route['process-worker-login'] = 'Hildes/process_worker_login';
$route['process-worker-signup'] = 'Hildes/process_worker_signup';

$route['dashboard'] = 'Hildes/dashboard';
$route['logout'] = 'Hildes/logout';
$route['index'] = 'Hildes/index';
$route['change-password'] = 'Hildes/change-password';
$route['search'] = 'Hildes/search';
$route['change-account-password'] = 'Hildes/change_account_password';*/

$route['admin/login'] = 'Admin/login';
$route['painter/login'] = 'Painter/login';
$route['affiliate/login'] = 'Affiliate/login';
$route['worker/login'] = 'Worker/login';

$route["lead"] = 'Hildes/lead';
$route["lead/(.*)"] = 'Hildes/lead/$1';
$route['post-lead'] = 'Hildes/post_lead';


// $route["projects/(.*)"] = 'Home/projects/$1';
// $route['admin'] = 'admin/login';
// $route['about'] = 'admin/';
// $route['(:any)'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
