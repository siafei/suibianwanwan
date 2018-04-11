<?php 
namespace vendor\bootstrap ;

// 引入帮助函数
require_once '../vendor/bootstrap/help.php' ;


// 定义常量
define('ROOT_PATH',  str_replace('/vendor/bootstrap','',dirname(__FILE__)));
defined('VENDOR_PATH')   or define('VENDOR_PATH',ROOT_PATH.'/app');
defined('VENDOR_PATH')   or define('VENDOR_PATH',ROOT_PATH.'/vendor');
defined('CONTROLLER_PATH')   or define('CONTROLLER_PATH',ROOT_PATH.'/app/Controller');



// 注册自动加载函数
spl_autoload_register('autoload');













 ?>