#<?php

class Step extends DataMapper {

    var $has_one = array('recipe');
    var $has_many = array('ingredient');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public function get_ingredients() {
        return $this->ingredients;
    }

    public function get_operation() {
        return $this->operation;
    }

    public function set_ingredients(array $value) {
        $this->ingredients = $value;
    }

    public function set_operation($value) {
        $this->operation = $value;
    }

}
