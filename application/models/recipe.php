#<?php

class Recipe extends DataMapper {

    // private $title;
    // private $type;
    //private $serves;
    //private $narrative_recipe;
    //private $segmented_recipe;
    //private $step_by_step_recipe;

    //arrays for storing relationships
    var $has_one = array('category');
    var $has_many = array('step');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public function get_format_narrative() {
        return $this->narrative_recipe;
    }

    public function get_format_segmented() {
        return $this->segmented_recipe;
    }

    public function get_format_step_by_step() {
        return $this->step_by_step_recipe;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_serves() {
        return $this->serves;
    }

    public function set_format_narrative(array $value) {
        return $this->narrative_recipe;
    }

    public function set_format_segmented(array $value) {
        return $this->segmented_recipe;
    }

    public function set_format_step_by_step(array $value) {
        return $this->step_by_step_recipe;
    }

    public function set_title($value) {
        $this->title = $value;
    }

    public function set_type($value) {
        $this->type = $value;
    }

    public function set_serves($value) {
        $this->serves = $value;
    }

}
