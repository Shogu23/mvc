<?php

require_once __DIR__ . '/../model/UserManager.php';

class HomeController {
	
	/**
	*	Home Page 
	*/
	public function index() {
		$userManager = new UserManager();
		$users = $userManager->getUsers();

		require __DIR__ . '/../view/home/index.php';
	}
}