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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['login'] = 'main/login';
$route['scholarship/registration-form'] = 'website/registration_form/index';
$route['scholarship/registration-form/success-registration'] = 'website/registration_form/success_registration';
$route['admin/dashboard'] = 'portal/admin_portal/main/index';
$route['admin/scholarship-approval'] = 'portal/admin_portal/scholar_request/index';
$route['admin/scholarship-approval/scholar-information'] = 'portal/admin_portal/scholar_request/scholar_information';
$route['admin/scholars-record'] = 'portal/admin_portal/student_record/index';
$route['admin/student-record/details'] = 'portal/admin_portal/student_record/student_information';
$route['admin/account-management'] = 'portal/admin_portal/account_management/index';
$route['admin/account-management/account-list'] = 'portal/admin_portal/account_management/account_list';
$route['admin/church-schedule'] = 'portal/admin_portal/church_schedule/index';
$route['admin/late-rules-setup'] = 'portal/admin_portal/late_rules/index';
$route['admin/attendance-record'] = 'portal/admin_portal/attendance_record/index';
$route['admin/attendance-record/manage-record'] = 'portal/admin_portal/attendance_record/manage_attendance';



// Student Portal
$route['student/dashboard'] = 'portal/student_portal/main/index';
$route['student/my-profile'] = 'portal/student_portal/main/myProfile';
$route['student/attendance'] = 'portal/student_portal/student_attendance/index';


// Scholarship Closed
$route['scholarship-closed'] = 'main/scholarship_closed';



$route['default_controller'] = 'main';
$route['404_override'] = 'main/page404';
$route['(:any)'] = 'main/index/$1';
$route['translate_uri_dashes'] = FALSE;
