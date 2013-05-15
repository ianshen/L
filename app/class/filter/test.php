<?php
/**
 * @author Administrator
 *
 */
class Filter_Test extends Filter {
    public function filt() {
        echo __METHOD__;
        Context::set ( 'filtest', 'hahahahah' );
    }
}
