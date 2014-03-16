#<?php

class Ingredient extends DataMapper {

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
     */

    function __construct($id = NULL)
    {
       //$this->name = $name;
       //$this->description = $description;
       //$this->link = $link;
       parent::__construct($id);
    }
}
