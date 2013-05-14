<?php

/**
 * @author Ian
 * App核心类
 * 
 */
class App {
    
    public static $controller_prefix = 'Controller';
    public static $controller_default = 'index';
    public static $controller = 'index';
    
    public static function init(array $settings = array()) {
    
    }
    
    public static function run() {
        spl_autoload_register ( 'App::autoload' );
        self::dispatch ();
    }
    
    public static function parseUrl() {
    
    }
    public static function dispatch() {
        $pathinfo = self::$controller_default;
        if (isset ( $_SERVER ['PATH_INFO'] )) {
            $pathinfo = rawurldecode ( $_SERVER ['PATH_INFO'] );
        }
        //print_r($_SERVER);
        //url映射到controller，/aaa/bbb/ccc===Controller_Aaa_Bbb_Ccc===controller/aaa/bbb/ccc.php
        $controller = trim ( $pathinfo, '/' );
        $controller = explode ( '/', $controller );
        $controller = array_map ( 'ucfirst', $controller );
        $controller = implode ( '_', $controller );
        self::$controller = self::$controller_prefix . '_' . $controller;
        if (self::autoload ( self::$controller ) !== true) {
            throw new Exception ();
        }
        $controller_obj = new self::$controller ();
        $controller_obj->run ();
    }
    /**
     * @param string $class
     */
    public static function autoload($class) {
        $class = strtolower ( $class );
        $dir = (false === strpos ( $class, '_' )) ? L : APP . DIRECTORY_SEPARATOR . 'class';
        $file = $dir . DIRECTORY_SEPARATOR . strtr ( $class, '_', DIRECTORY_SEPARATOR ) . '.php';
        if (file_exists ( $file )) {
            include $file;
        }
        
        return (class_exists ( $class, false ) || interface_exists ( $class, false ));
    }
}