<?php

class Categories extends CI_Controller {
		
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('categories_view');
	}
		
}