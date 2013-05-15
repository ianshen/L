<?php

class Controller_Index extends Controller_Abstract {
    
    public function init() {
    }
    
    public function run() {
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
        echo Config::get ( 'env.domain' );
        Context::set ( 'kkk', '123123' );
        echo Context::get ( 'kkk' );
        //数据库
        $db = Db::pool ( 'test' );
        //使用query方法操作数据
        $result = $db->query ( "select * from test1" );
        //print_r ( $result );
        

        //print_r ( Cache::$_pool );
        $mc = Cache::pool ( 'userinfo' );
        $mc->set ( 'haha', 'haaaaaaaaa' );
        print_r ( $mc->get ( 'haha' ) );
        $this->display ();
    }
}