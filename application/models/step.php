#<?php

class Step extends DataMapper {

    var $has_one = array('recipe');
    var $has_many = array('ingredient');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}
