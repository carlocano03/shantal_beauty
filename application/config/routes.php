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

//ADMINISTRATOR PORTAL
$route['admin/dashboard'] = 'admin_portal/main/index';
$route['admin/login'] = 'admin_portal/login/index';

$route['admin/reseller-application'] = 'admin_portal/main/reseller_application';
$route['admin/reseller-application/information'] = 'admin_portal/main/reseller_application_info';
$route['admin/reseller-account'] = 'admin_portal/main/reseller_account';
$route['admin/reseller-account/information'] = 'admin_portal/main/reseller_account_info';
$route['admin/user-account'] = 'admin_portal/main/user_account';
$route['admin/product-management'] = 'admin_portal/main/product_management';
$route['admin/product-management/stock-in'] = 'admin_portal/main/stock_in';
$route['admin/account-management'] = 'admin_portal/main/account_management';
$route['admin/voucher'] = 'admin_portal/main/voucher';
$route['admin/pending-orders'] = 'admin_portal/main/pending_orders';
$route['admin/list-orders'] = 'admin_portal/main/list_orders';
$route['admin/order-details'] = 'admin_portal/main/order_details';
$route['admin/manage-news'] = 'admin_portal/main/manage_news';
$route['admin/manage-news/add-form'] = 'admin_portal/main/news_add_form';
$route['admin/manage-news/view'] = 'admin_portal/main/view_news';



$route['reseller'] = 'reseller/main/index';
$route['reseller/dashboard'] = 'reseller/dashboard/index';
$route['reseller/inventory'] = 'reseller/dashboard/inventory';
$route['reseller/inventory/product-information'] = 'reseller/dashboard/product_information';
$route['reseller/voucher-creation'] = 'reseller/dashboard/voucher_creation';
$route['reseller/my-commission'] = 'reseller/dashboard/my_commission';
$route['reseller/my-commission/order-details'] = 'reseller/dashboard/order_details';


$route['products'] = 'main/products';
$route['news'] = 'main/news';
$route['news/news-detail'] = 'main/news_detail';



$route['shop'] = 'shop/main/index';
$route['shop/best-sellers'] = 'shop/main/best_sellers';
$route['shop/sales-offers'] = 'shop/main/sales_offers';

$route['shop/product-details'] = 'shop/main/product_details';
$route['shop/checkout'] = 'shop/main/checkout';
$route['shop/profile'] = 'shop/main/profile';
$route['shop/wishlist'] = 'shop/main/wishlist';



$route['default_controller'] = 'main';
$route['404_override'] = 'main/page404';
$route['(:any)'] = 'main/index/$1';
$route['translate_uri_dashes'] = FALSE;