#<?php

class Recipe extends CI_Model {

    private $title;
    private $type;
    private $serves;
    private $narrative_recipe;
    private $segmented_recipe;
    private $step_by_step_recipe;

    function __construct($title, $type, $serves, $narrative_recipe, $segmented_recipe, $step_by_step_recipe) {
        parent::__construct();
        $this->title = $title;
        $this->type = $type;
        $this->serves = $serves;
        $this->narrative_recipe = $narrative_recipe;
        $this->segmented_recipe = $segmented_recipe;
        $this->step_by_step_recipe = $step_by_step_recipe;
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
