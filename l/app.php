<?php

/**
 * @author Ian
 * App核心类
 * 
 */
class App {
    
    public static $filters = array ();
    /**
     * controller_prefix
     * controller_default默认控制器
     * filter_on开启过滤器
     * view_engine渲染引擎
     * db_ms_on启用主从数据库
     * @var unknown_type
     */
    public static $settings = array (
        'controller_prefix' => 'Controller', 
        'controller_default' => 'index', 
        'controller' => 'index', 
        'filter_on' => 0, 
        'view_engine' => 'ViewPhp', 
        'db_ms_on' => 0, 
        'db_cnf' => 'db', 
        'cache_cnf' => 'cache' 
    );
    
    public static function init(array $settings = array()) {
        /*
         * init $settings
        */
        if (! empty ( $settings )) {
            self::$settings = array_merge ( self::$settings, $settings );
        }
        spl_autoload_register ( 'App::autoload' );
        
        Db::init ( self::$settings ['db_cnf'], self::$settings ['db_ms_on'] );
        Cache::init ( self::$settings ['cache_cnf'] );
    }
    
    public static function run() {
        self::dispatch ();
    }
    
    public static function parseUrl() {
    
    }
    public static function dispatch() {
        $pathinfo = self::$settings ['controller_default'];
        if (isset ( $_SERVER ['PATH_INFO'] )) {
            $pathinfo = rawurldecode ( $_SERVER ['PATH_INFO'] );
        }
        //print_r($_SERVER);
        //url映射到controller，/aaa/bbb/ccc===Controller_Aaa_Bbb_Ccc===controller/aaa/bbb/ccc.php
        $controller = trim ( $pathinfo, '/' );
        define ( '__CONTROLLER__', $controller );
        $controller = explode ( '/', $controller );
        $controller = array_map ( 'ucfirst', $controller );
        $controller = implode ( '_', $controller );
        self::$settings ['controller'] = self::$settings ['controller_prefix'] . '_' . $controller;
        if (self::autoload ( self::$settings ['controller'] ) !== true) {
            throw new Exception ( '404' );
        }
        $controller_obj = new self::$settings ['controller'] ();
        /* //run filters
        if (self::$settings ['filter_on']) {
            $filters = $controller_obj->filters ();
            if (! empty ( $filters )) {
                foreach ( $filters as $filter ) {
                    if (! ($cls = new $filter ()) instanceof Filter) {
                        throw new Exception ( "filter $filter must be subclass of Filter" );
                    }
                    $cls->filt ();
                }
            }
        } */
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