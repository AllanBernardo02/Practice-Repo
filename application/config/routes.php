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
$route['default_controller'] = 'example';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


#(:num) is integer  (:any) string or else

$route['example/hello/(:any)'] = 'example/hello/$1' ;// first "name" is a route name 2nd "name" is the name of the function
$route['example/variable'] = "example/pass_var";
$route['example/enter_data'] = "example/add_data";
$route['example/data'] = "example/display_data";
$route['example/update'] = "example/update_data";
$route['example/delete/(:num)'] = "example/delete/$1";
$route['example/where'] = "example/where_condition";
$route['example/like'] = "example/likewise";
$route['example/join'] = "example/joins";
$route['example/form'] = "example/create_form";
$route['example/displayform'] ="example/display_form";
$route['example/login'] ="example/login";
$route['example/trylogin'] ="example/login_logic";
$route['example/afterlog'] ="example/after_login";
$route['example/logout'] ="example/logout";
$route['example/register'] ="example/register";
$route['example/register_validation'] ="example/register_method";







