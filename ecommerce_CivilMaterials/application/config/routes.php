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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//---------------------------------------------START ADMIN ROUTES---------------------------------------------//
$route['admin-login']=$route['default_controller'].'/adminLogin';
$route['admin-user-list']=$route['default_controller'].'/user_total_page';
$route['admin-user-approval']=$route['default_controller'].'/user_approval_page';
$route['admin-vendor-list']=$route['default_controller'].'/vendor_total_page';
$route['admin-vendor-approval']=$route['default_controller'].'/vendor_approval_page';
$route['user-order-list']=$route['default_controller'].'/admin_user';
$route['dashboard']=$route['default_controller'].'/dashboard_page';
$route['admin-user']=$route['default_controller'].'/user_page';
$route['admin-vendor']=$route['default_controller'].'/vendor_page';
$route['add-slider']=$route['default_controller'].'/slider_page';
$route['brand-master']=$route['default_controller'].'/Master_Brand';
$route['category-master']=$route['default_controller'].'/Master_Category';
$route['size-master']=$route['default_controller'].'/Master_Size';
$route['product-list']=$route['default_controller'].'/product_list_page';
$route['admin-logout']=$route['default_controller'].'/A_logout_sessionDestroy';
//-----------------------------------------------END ADMIN ROUTES----------------------------------------------//


//-----------------------------------------------START HOME ROUTES---------------------------------------------//
$route['home']=$route['default_controller'].'/index';
$route['about']=$route['default_controller'].'/about_page';
$route['shop']=$route['default_controller'].'/shop_page';
$route['contact']=$route['default_controller'].'/contact_page';
$route['cart']=$route['default_controller'].'/cart_page';
$route['checkout']=$route['default_controller'].'/checkout_page';
$route['myAccount']=$route['default_controller'].'/account_page';
$route['wishlist']=$route['default_controller'].'/wishlist_page';
$route['signIn']=$route['default_controller'].'/signin_page';
$route['register']=$route['default_controller'].'/register_page';
$route['user-signOut']=$route['default_controller'].'/U_logout_sessionDestroy';
//------------------------------------------------END HOME ROUTES----------------------------------------------//


//------------------------------------------------START VENDOR ROUTES------------------------------------------//
$route['dashboard-page']=$route['default_controller'].'/dashboard';
$route['vendor-add-product']=$route['default_controller'].'/add_product_page';
$route['vendor-view-product']=$route['default_controller'].'/view_product_page';
$route['vendor-logout']=$route['default_controller'].'/V_logout_sessionDestroy';
$route['vendor-order-list']=$route['default_controller'].'/vendor_neworderlist';
$route['vendor-order-history']=$route['default_controller'].'/vendor_orderhistory';

//-------------------------------------------------END VENDOR ROUTES--------------------------------------------//