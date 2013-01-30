<?php

error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' );

date_default_timezone_set ( 'Asia/Shanghai' );
//定义关键目录
define ( 'ROOT', dirname ( __DIR__ ) );
define ( 'LIBS', ROOT . '/libs' );
define ( 'APP', __DIR__ );
require LIBS . '/app.php';

App::run ();
