<?php

/**
 * @author Ian
 * config 配置读取类
 */
class Config {
    
    public static $config = array ();
    
    public static function load($file) {
        $dir = APP . DIRECTORY_SEPARATOR . 'conf';
        $filename = $dir . DIRECTORY_SEPARATOR . $file . '.php';
        if (! is_file ( $filename )) {
            throw new Exception ( "file $filename not exists or something" );
        }
        self::$config [$file] = include ($filename);
    }
    
    public static function get($key = null) {
        if (! $key) {
            throw new Exception ( 'parameter $key is empty' );
        }
        if (false !== strpos ( $key, '.' )) {
            list ( $file, $path ) = explode ( '.', $key, 2 );
            unset ( $path );
        } else {
            $file = $key;
        }
        if (! isset ( self::$config [$file] )) {
            self::load ( $file );
        }
        $config = self::$config;
        $keys = explode ( '.', $key );
        foreach ( $keys as $key ) {
            if (! isset ( $config [$key] )) {
                throw new Exception ( "key:{$key} is not set in config" );
            }
            //isset("$string") bug still here
            /* if (! is_array ( $res [$key] )) {
				$res = $res [$key];
				break;
			} */
            $config = $config [$key];
        }
        return $config;
    }
}