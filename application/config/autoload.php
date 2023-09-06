<?php
defined('BASEPATH') or exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('email', 'database', 'session', 'table', 'upload', 'user_agent', 'form_validation', 'cart', 'encrypt');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'common_helper',    'layout_helper', 'form', 'product_helper', 'html', 'date');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('CommonModal');
