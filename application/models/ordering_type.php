#<?php

class Ordering_type extends DataMapper {

    //arrays for storing relationships
    var $has_one = array();
    var $has_many = array('ordering');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}