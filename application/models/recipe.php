#<?php

class Recipe extends DataMapper {

    //arrays for storing relationships
    var $has_one = array('category');
    var $has_many = array('step');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}
