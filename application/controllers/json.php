#<?php

class Json extends CI_Controller {

    //index.php/json/index
    /**
     * echos a JSON ob with all the catagories and recipe metadata.
     */
    public function index() {
        $cats =  new Category();
        $cats->get(); //get all

        $categories = array();

        foreach($cats as $cat) {

            $category_recipes = array();

            $cat->recipe->get();
            foreach($cat->recipe as $rep ) {
                $recipe = array(
                    "id" => $rep->id,
                    "title" => $rep->title,
                    "type" => $rep->type,
                    "serves" => $rep->serves
                );
                array_push($category_recipes,$recipe);
            }

            $category = array(
                "id" => $cat->id,
                "name" => $cat->name,
                "description" => $cat->description,
                "category_recipes" => $category_recipes
            );

            array_push($categories, $category);
        }

        $json = array(
                "categories" => $categories,
                "debug" => array(
                    "version" => "0.0.1",
                    "timestamp" => time()
                )
        );

        $data['json'] = $json;
        //load the view with and render the json data.
        $this->load->view('json_view', $data);
    }

    /**
     * @param $id the id of the recipe to return
     *
     * echo's a JSON ob for the receipe.
     */
    public function recipe($id) {

        $rep =  new Recipe();
        $rep->where('id', $id)->get(); //load the model data

        $rep->step->get(); //get the steps assoicated with the model
        $steps = array();

        /** iterate over the steps building nested to be converted to JSON */
        foreach ($rep->step as $step) { //get the ingredietns assoicated with each step.

            $step->ingredient->get(); //get the ingredents for a step
            $ingredients = array(); //all the ingredintes for a step array

            foreach($step->ingredient as $in) {
                $ingredient_data = array (
                    "id" => $in->id,
                    "name" => $in->name,
                    "description" => $in->description,
                    "link" => $in->link
                );

                array_push($ingredients,$ingredient_data); //push the current ingredient data into the list of ingredinetns.
            }

            $step_data = array (
                "id" => $step->id,
                "operation" => $step->operation,
                "ingredients" => $ingredients //ingredients array
            );

            array_push($steps,$step_data);
        }

        $recipe = array(
            "id" => $rep->id,
            "title" => $rep->title,
            "type" => $rep->type,
            "serves" => $rep->serves,
            "narrative" => $rep->narrative_recipe,
            "segmented" => $rep->segmented_recipe,
            "step_by_step" => $rep->step_by_step_recipe,
            "steps" => $steps
        );

        $json = array(
            "recipe" => $recipe,
            "debug" => array(
                "version" => "0.0.1",
                "timestamp" => time()
                )
        );

        $data['json'] = $json;
        //load the view with and render the json data.
        $this->load->view('json_view', $data);
    }
}