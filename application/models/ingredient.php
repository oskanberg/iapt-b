#<?php

class Ingredient extends CI_Model {

    private $name;
    private $description;
    private $link;

    function __construct($name, $description, $link) {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_link() {
        return $this->link;
    }

    public function set_name($value) {
        $this->name = $value;
    }

    public function set_description($value) {
        $this->description = $value;
    }

    public function set_link($value) {
        $this->link = $value;
    }
}
