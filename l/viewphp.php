<?php
/**
 * @author Ian
 * ViewPhp native php view engine 原生PHP模板引擎
 */
class ViewPhp implements View {
    
    public function __construct() {
    }
    
    /**
     * render view
     * @param unknown_type $tpl
     * @return string
     */
    protected function _render($tpl) {
        if (null === $tpl) {
            $tpl = __CONTROLLER__ . '.html';
        }
        ob_start ();
        ob_implicit_flush ( 0 );
        $file = APP . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $tpl;
        if (! file_exists ( $file )) {
            throw new Exception ( "template {$file} not exist" );
        }
        include $file;
        return ob_get_clean ();
    }
    
    public function assign($key, $value = null) {
        $this->$key = $value;
    }
    
    public function fetch($tpl) {
        return $this->_render ( $tpl );
    }
    
    public function display($tpl) {
        echo $this->fetch ( $tpl );
    }
    
    /**
     * 在模板中引入其它模板
     * @param unknown_type $tpl
     */
    public function import($tpl) {
        include APP . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $tpl;
    }
    
    /* public function __set($key, $value = null) {
		$this->$key = $value;
	} */
    
    public function __get($key) {
        if (! isset ( $this->$key )) {
            throw new Exception ( "Undefined property:ViewPhp::\${$key}" );
        }
        return $this->$key;
    }
}