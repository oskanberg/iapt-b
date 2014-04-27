<?php
/**
 * Created by PhpStorm.
 * User: Tim
 * Date: 16/03/14
 * Time: 20:16
 */

class category extends DataMapper {

    var $table = 'categories';

	//store datamapper relationships
    var $has_one = array();
    var $has_many = array('recipe');

	/**
	 * overloaded constructor
	 * @param the id from the database to instatiate
	 */
    function __construct($id = NULL) {
        parent::__construct($id);
    }
} 