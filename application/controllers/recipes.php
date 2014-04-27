<?php

class Recipes extends CI_Controller {
	
	/**
	 * View a single receipe
	 * @param the id of the receipe to view
	 */	
	public function view($id)
	{
		$this->load->helper('url');
		$this->load->view('recipe_view');
	}
		
}