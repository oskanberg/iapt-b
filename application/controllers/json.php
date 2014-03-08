#<?php

class Json extends CI_Controller {

    // domain.com/json/
    public function index() {
        // return index of recipes?
    }

    // domain.com/json/recipe/<id>/<'segmented','narrative','step-by-step'>
    public function recipe($id, $format) {
        switch ($format) {
            case 'segmented':
                //
                break;
            case 'narrative':
                //
                break;
            case 'step-by-step':
                //
                break;
            default:
                // step-by-step?
                break;
        }
        // return array of data to be jsonified
    }
}

?>