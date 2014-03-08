#<?php

class Step extends CI_Model {

    private $ingredients;
    private $operation;

    function __construct($ingredients, $operation) {
        parent::__construct();
        $this->ingredients = $ingredients;
        $this->operation = $operation;
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
