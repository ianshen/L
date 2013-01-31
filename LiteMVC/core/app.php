<?php

/**
 * @author Ian
 * App核心类
 * 
 */
class App {
	
	public static function init(array $settings = array()) {
	
	}
	
	public static function run() {
		spl_autoload_register ( 'App::autoload' );
		$c = new Controller_Index ();
	}
	
	public static function parseUrl() {
	
	}
	public static function dispatch() {
	
	}
	/**
	 * @param string $class
	 */
	public static function autoload($class) {
		$class = strtolower ( $class );
		$dir = (false === strpos ( $class, '_' )) ? LIBS : APP . DIRECTORY_SEPARATOR . 'classes';
		$file = $dir . DIRECTORY_SEPARATOR . strtr ( $class, '_', '.' ) . '.php';
		if (file_exists ( $file )) {
			include $file;
		}
		
		return (class_exists ( $class, false ) || interface_exists ( $class, false ));
	}
}