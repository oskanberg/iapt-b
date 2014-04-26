<?php

class Recipes extends CI_Controller {
		
	public function view($id)
	{
		$this->load->helper('url');
		$this->load->view('recipe_view');
	}
		
}