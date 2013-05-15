<?php

class Controller_Aaa_bbb_ccc extends Controller_Abstract {
    
    public function run() {
        echo __METHOD__;
        $this->assign ( 'str', '#%这是测试模板字符串变量%%' );
        $this->assign ( 'nums', array (
            0, 
            1, 
            2, 
            3, 
            4, 
            5 
        ) );
        $this->assign ( 'name', 'ianshen' );
        $this->display ();
    }
}