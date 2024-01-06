<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// main pages
$route['products'] = 'home/products';
$route['products/(:any)'] = 'home/products/$1';
$route['products/(:any)/(:any)'] = 'home/products/$1/$2';
$route['about'] = 'home/about';
$route['contact'] = 'home/contact';
// additional pages
$route['product-description/(:any)'] = 'home/product_description/$1';
$route['product-category/(:any)'] = 'home/product_category/$1';
$route['cart'] = 'home/cart';
$route['checkout'] = 'home/checkout';
$route['login'] = 'home/login';
$route['all-products'] = 'home/all_products';

$route['about-us'] = 'Home/about';
$route['dashboard'] = 'Home/dashboard';
$route['checkout_payment'] = 'Home/checkout_payment';
$route['contact-us'] = 'Home/contact_us';

$route['faq'] = 'Home/faq';

$route['Logout'] = 'Home/logout';

$route['term-and-conditions'] = 'Home/policy/5';
$route['privacy-policy'] = 'Home/policy/1';
$route['shipping-and-delivery-policy'] = 'Home/policy/2';
$route['return-and-refund-policy'] = 'Home/policy/4';
$route['Admin_Dashboard'] = 'Admin_Dashboard/index';
$route['admin'] = 'admin/index';

$route['(:any)'] = 'home/product_description/$1';
