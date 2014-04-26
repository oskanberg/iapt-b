<?php

class Recipes extends CI_Controller {
		
	public function view($id)
	{
		$this->load->view('recipe_view');
	}
		
}