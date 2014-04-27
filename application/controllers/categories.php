<?php

class Categories extends CI_Controller {
	
	/**
	 * display the all categories view
	 * 
	 */	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('categories_view');
	}
		
}