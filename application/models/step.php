<?php

class Step extends DataMapper {

    var $has_one = array('ordering');
    var $has_many = array('ingredient');

	/**
	 * overloaded constructor
	 * @param the id from the database to instatiate
	 */
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}
