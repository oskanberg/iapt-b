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
                    "version" => "0.9.0",
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
        
        $rep->ordering->get(); //get the steps assoicated with the model
        $orderings = array();
        
		//each recipe has a set of step orderings assoicated with it fetch each of those.
		foreach ($rep->ordering as $ordering) {
					
			$ordering->step->get(); //get the steps associated with each ordering
			$steps = array();    

	        /** iterate over the steps building nested to be converted to JSON */
	        foreach ($ordering->step as $step) { //get the ingredietns assoicated with each step.
	
	            $step->ingredient->get(); //get the ingredents for a step
	            $ingredients = array(); //all the ingredintes for a step array
	
	            foreach($step->ingredient as $in) {
	                $ingredient_data = array (
	                    "id" => $in->id,
	                    "name" => $in->name,
	                    "description" => $in->description,
	                    "link" => $in->link,
	                    "image" => $in->image_url
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

			$ordering->ordering_type->get();//get the ordering type narrative segmented etc
			
			$ordering_data = array (
			"id" => $ordering->id,
			"type" => $ordering->ordering_type->type,
			"steps" => $steps
			);
			
			array_push($orderings,$ordering_data);
		}
		$rep->category->get(); //get the catagory for the receipe

        $recipe = array(
            "id" => $rep->id,
            "title" => $rep->title,
            "category" => $rep->category->name,
            "serves" => $rep->serves,
            "image" => $rep->image_url,
            "orderings" => $orderings
        );

        $json = array(
            "recipe" => $recipe,
            "debug" => array(
                "version" => "0.9.0",
                "timestamp" => time()
                )
        );

        $data['json'] = $json;
        //load the view with and render the json data.
        $this->load->view('json_view', $data);
    }
}