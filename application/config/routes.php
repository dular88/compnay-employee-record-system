<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'welcome/login';
$route['login_submit'] = 'welcome/login_submit';
$route['registration'] = 'welcome/index';
$route['company_add'] = 'welcome/company_add';
$route['logout'] = 'welcome/logout';
//////////Authenticated Route /////////////
$route['company_dashboard'] = 'CompanyController/company_dashboard';
$route['company_edit_data'] = 'CompanyController/company_edit_data';
$route['company_update'] = 'CompanyController/company_update';

$route['add_employee'] = 'CompanyController/add_employee_page';
$route['add_update_employee_data'] = 'CompanyController/add_update_employee_data';
$route['employee_list'] = 'CompanyController/employee_list';
$route['employee_list_data'] = 'CompanyController/employee_list_data';
$route['employee_edit_data'] = 'CompanyController/employee_edit_data';
$route['delete_employee_data'] = 'CompanyController/delete_employee_data';

