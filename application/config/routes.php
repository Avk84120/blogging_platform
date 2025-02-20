<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
//$route['default_controller'] = 'auth/register'; // Default route to login
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth Routes
//$routes->get('auth/register', 'Auth::register');
//$routes->post('auth/register', 'Auth::register'); // if using POST for form submission


$route['register'] = 'auth/register';  // Route for user registration
$route['login'] = 'auth/login';  // Route for user login
$route['logout'] = 'auth/logout';  // Route for user logout

// Blog Routes
$route['blogs/create'] = 'blogs/create';  
$route['blogs/manage'] = 'blogs/manage';  
$route['blogs/edit/(:num)'] = 'blogs/edit/$1'; 
$route['blogs/delete/(:num)'] = 'blogs/delete/$1';  

// Post Routes
//$route['posts/create'] = 'posts/create';  
$route['posts/create/(:num)'] = 'posts/create/$1';
$route['posts/manage'] = 'posts/manage';  
$route['posts/edit/(:num)'] = 'posts/edit/$1';  
$route['posts/delete/(:num)'] = 'posts/delete/$1';  
$route['posts/list/(:num)'] = 'posts/list/$1';  

// Comment Routes
$route['comments/manage'] = 'comments/manage';  
$route['comments/approve/(:num)'] = 'comments/approve/$1';  
$route['comments/reject/(:num)'] = 'comments/reject/$1';  
$route['comments/delete/(:num)'] = 'comments/delete/$1';  
