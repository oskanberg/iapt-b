<?php

class Json extends CI_Controller {

    //index.php/json/index
    /**
     * echos a JSON ob with all the catagories and recipe metadata.
     */
    public function index() {
        $cats =  new Category();
        $cats->get(); //get all categogies

        $categories = array();

		// iterate over each category and load all the data associted with it.
        foreach($cats as $cat) {

            $category_recipes = array();

            $cat->recipe->get();//get the receipes for this category
            
            //iterate over the recipes and load the all the data assoicated with them.
            foreach($cat->recipe as $rep ) {
                //load the data into a n array for the receipe	
                $recipe = array(
                    "id" => $rep->id,
                    "title" => $rep->title,
                    "type" => $rep->type,
                    "serves" => $rep->serves,
                    "image" => $rep->image_url
                    
                );
				//push the current receipes data on the array of catogray recipes.
                array_push($category_recipes,$recipe);
            }

			//store the data from the current category
            $category = array(
                "id" => $cat->id,
                "name" => $cat->name,
                "description" => $cat->description,
                "category_recipes" => $category_recipes//this the array of the recipes for the current category
            );

			//store the current categoriy.
            array_push($categories, $category);
        }

        $json = array(
                "categories" => $categories,
                "debug" => array(
                    "version" => "0.9.0",
                    "timestamp" => time()
                )
        );
		//wrap the data for the view
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
	                "step_order" => $step->step_order,
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
            "category_id" => $rep->category->id,
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

		//wrap the data for the view.
        $data['json'] = $json;
		
        //load the view with and render the json data.
        $this->load->view('json_view', $data);
    }
}