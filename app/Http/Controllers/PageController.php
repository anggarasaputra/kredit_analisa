<?php

namespace App\Http\Controllers;

class PageController extends Controller {
	protected $layout;
	protected $view_dir = 'privacy.';

	function __construct()
	{
		view()->share('html', ['title' => 'GO-Kredit.com']);
		$this->layout = view('templates.html.layout');
	}

	public function privacy_policy()
	{
		$this->layout->pages 	= view($this->view_dir . 'policy');
		return $this->layout;
	}
}