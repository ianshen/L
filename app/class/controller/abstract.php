<?php

class Controller_Abstract extends Controller {
    
    public function filters() {
        $filters = array_merge ( App::$filters, $this->filters );
        $filters = array_keys ( $filters, 1 );
        return $filters;
    }

}