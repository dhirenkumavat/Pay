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
$route['default_controller'] = 'Admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard'] = 'admin/dashboard';
$route['logout'] = 'admin/logout';
$route['add_brand'] = 'admin/add_brand';
$route['index'] = 'admin/index';
$route['active_brand_list'] = 'admin/active_brand_list';
$route['inactive_brand_list'] = 'admin/inactive_brand_list';
$route['outlet_list'] = 'admin/outlet_list';
$route['add_outlet'] = 'admin/add_outlet';
$route['add_country'] = 'admin/add_country';
$route['add_state'] = 'admin/add_state';
$route['add_city'] = 'admin/add_city';
$route['video_list'] = 'admin/video_list';
$route['add_video'] = 'admin/add_video';
$route['user_list'] = 'admin/user_list';
$route['view_googlemap'] = 'admin/view_googlemap';
$route['country_list'] = 'admin/country_list';
$route['state_list'] = 'admin/state_list';
$route['city_list'] = 'admin/city_list';
$route['search_moonid'] = 'admin/search_moonid';
$route['notification'] = 'admin/notification';

# REST API Routes

$route['user']['post']     = 'user/register';
$route['user']['post']     = 'user/login';
