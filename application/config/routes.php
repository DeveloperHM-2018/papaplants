<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'UserHome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/////////////////////     Admin     /////////////////

$route['admin'] = 'admin/AdminAuth/admin';
$route['adminLogout'] = 'admin/AdminAuth/adminLogout';

$route['dashboard'] = 'admin/AdminHome/dashboard';
$route['banner'] = 'admin/AdminHome/banner';
$route['promoCode'] = 'admin/AdminHome/promoCode';
$route['category-featured/(:any)/(:any)'] = 'admin/AdminHome/categoryFeatured/$1/$2';
$route['setDeliveryCharges'] = 'admin/AdminHome/setDeliveryCharges';

//  =>  User

$route['activeUser'] = 'admin/AdminHome/activeUser';
$route['inactiveUser'] = 'admin/AdminHome/inactiveUser';
$route['userStatus/(:any)/(:any)'] = 'admin/AdminHome/userStatus/$1/$2';
$route['userDetails/(:any)'] = 'admin/AdminHome/userDetails/$1';

// => Orders

$route['recentOrders'] = 'admin/AdminHome/recentOrders';
$route['acceptOrder'] = 'admin/AdminHome/acceptOrder';
$route['cancelOrder'] = 'admin/AdminHome/cancelOrder';
$route['acceptedOrders'] = 'admin/AdminHome/acceptedOrders';
$route['dispatchOrder/(:any)/(:any)'] = 'admin/AdminHome/dispatchOrder/$1/$2';
$route['dispatchOrders'] = 'admin/AdminHome/dispatchOrders';
$route['completedOrders'] = 'admin/AdminHome/completedOrders';
$route['cancelOrders'] = 'admin/AdminHome/cancelOrders';
$route['allOrders'] = 'admin/AdminHome/allOrders';

// => Product

$route['categoryAll'] = 'admin/AdminProduct/categoryAll';
$route['categoryAdd'] = 'admin/AdminProduct/categoryAdd';
$route['subCategoryAll'] = 'admin/AdminProduct/subCategoryAll';
$route['subCategoryAdd'] = 'admin/AdminProduct/subCategoryAdd';

$route['getSubCategory'] = 'admin/AdminProduct/getSubCategory';
$route['productAll'] = 'admin/AdminProduct/productAll';
$route['productDetails'] = 'admin/AdminProduct/productDetails';
$route['productAdd'] = 'admin/AdminProduct/productAdd';
$route['productView'] = 'admin/AdminProduct/productView';
$route['productDelete'] = 'admin/AdminProduct/productDelete';
$route['getProductSubCategory'] = 'admin/AdminProduct/getProductSubCategory';
$route['productImageD/(:any)/(:any)'] = 'admin/AdminProduct/productImageD/$1/$2';


///////////////////// website   ///////////////////////

$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['checkout'] = 'UserHome/checkout';
$route['order-history'] = 'UserHome/order_history';
$route['profile'] = 'UserHome/profile';
$route['product'] = 'UserHome/product';
$route['product-details/(:any)/(:any)'] = 'UserHome/product_details/$1/$2';
$route['orderInvoice/(:any)'] = 'UserHome/orderInvoice/$1';
$route['orderDetails/(:any)'] = 'UserHome/orderDetails/$1';
$route['forgot-password'] = 'UserHome/forgot_password';
$route['search'] = 'UserHome/search';
$route['orders'] = 'UserHome/orders';
$route['booking-status'] = 'UserHome/booking_status';

$route['shipping-policy'] = 'UserHome/shipping_policy';
$route['contact'] = 'UserHome/contact';
$route['about'] = 'UserHome/about';
$route['term-condition'] = 'UserHome/term_condition';
$route['privacy-policy'] = 'UserHome/privacy_policy';
$route['shipping-policy'] = 'UserHome/shipping_policy';

$route['verify-registration'] = 'Auth/verify_registration';
$route['logout'] = 'Auth/logout';

/////////////////////  User API    ///////////////////////


$route['stateApi'] = 'UserApi/stateApi';
$route['cityApi/(:any)'] = 'UserApi/cityApi/$1';

$route['userSendOTP'] = 'UserApi/userSendOTP';
$route['userLogin'] = 'UserApi/userLogin';
$route['userProfileUpdate'] = 'UserApi/userProfileUpdate';
$route['userViewProfile'] = 'UserApi/userViewProfile';

$route['dashboardApi'] = 'UserApi/dashboardApi';
$route['brandList'] = 'UserApi/brandList';
$route['getSubCategory/(:any)'] = 'UserApi/getSubCategory/$1';
$route['getProduct/(:any)'] = 'UserApi/getProduct/$1';
$route['getBrandByProduct/(:any)'] = 'UserApi/getBrandByProduct/$1';
$route['searchProduct'] = 'UserApi/searchProduct';


$route['getDeliveryCharge'] = 'UserApi/getDeliveryCharge';
$route['getPromoCode'] = 'UserApi/getPromoCode';
$route['createOrder'] = 'UserApi/createOrder';
$route['orderTransactionStatus'] = 'UserApi/orderTransactionStatus';
$route['generatePaymentToken'] = 'UserApi/generatePaymentToken';
$route['orderHistory'] = 'UserApi/orderHistory';
