<?php

class Ingredient extends DataMapper { //is not a CI model but a datamapper model

    //arrays for storing relationships
    var $has_one = array();
    var $has_many = array('step');

    var $validation = array(
        'name' => array(
            // name is required, and cannot be more than 255 characters long.
            'rules' => array('required', 'max_length' => 255),
            'label' => 'Ingredient'
        ),
        'description' => array(
            'rules' => array('required', 'max_length' => 1023),//this length has been chosen at random think about lencht more later.
            'label' => 'Description'
        ),
        'link' => array(
            'rules' => array('required', 'max_length' => 1023),//this length has been chosen at random think about lencht more later.
            'label' => 'Link'
        )
    );

    /**
     * default order is to sort by name various other ordering can be achived by setting he detault ordering as such:
     * var $default_order_by = array('name', 'id' => 'desc');
	 * @param the id of the ingredient.
     */
    function __construct($id = NULL)
    {
       parent::__construct($id);
    }
}
