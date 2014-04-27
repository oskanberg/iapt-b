<?php

class Ordering extends DataMapper {

    //arrays for storing relationships
    var $has_one = array('recipe','ordering_type');
    var $has_many = array('step');

	/**
	 * overloaded constructor
	 * @param the id from the database to instatiate
	 */
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}