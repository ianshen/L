<?php

error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' );

date_default_timezone_set ( 'Asia/Shanghai' );

//定义关键目录
define ( 'ROOT', dirname ( __DIR__ ) );
define ( 'L', ROOT . '/l' );
define ( 'APP', __DIR__ );

require L . '/app.php';

App::init ( array (
    'filter_on' => 0 
) );
App::run ();
