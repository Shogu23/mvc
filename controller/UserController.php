<?php

require_once __DIR__ . '/../model/UserManager.php';
require_once __DIR__ . '/../controller/Controller.php';

class UserController extends Controller {
	
	/**
	*	List of all users
	*/
	public function index() {
		$userManager = new UserManager();
		$users = $userManager->getUsers();

		require __DIR__ . '/../view/user/index.php';
	}

	/**
	*	Display a form to create an user and save it in database
	*/
	public function create() {
		$email = null;
		$name = null;
		$errors = [];

		if(isset($_POST['email']) && isset($_POST['name'])) {
			$errors = $this->validateForm();
			// Form is valid, do the INSERT
			if (count($errors) === 0) {
				$user = new User();
				$user->setName($_POST['name']);
				$user->setName($_POST['email']);
				$userManager = new UserManager();
				$userManager->createUser($user);
				$this->redirect('index.php?ctrl=user&action=index');
			}
		}

	}

	/**
	*	Display a form to edit an user and save it in the database
	*/
	public function edit() {
		//1. Select the user
		$id = $_GET['id'] ?? null;
		$userManager = new UserManager();
		$user = $userManager->getUser($id);

		//Form has been submitted
		if(isset($_POST['name']) && isset($_POST['email'])) {
			//3b. Check the validity of datas
			$user->setName($_POST['name']);
			$user->setEmail($_POST['email']);
			$userManager->updateUser($user);
		}

		//2. Prepare the form
		$name = $user->getName();
		$email = $user->getEmail();

		//3. Display the form
		require __DIR__ . '/../view/user/edit.php';
	}

	/**
	*	Delete the user in the database
	*/
	public function delete() {
		if (!isset($_GET['id'])){
			$this->redirect('index.php?ctrl=user&action=index');
		}

		$userManager = new UserManager();
		$user = $userManager->getUser($_GET['id']);

		if ($user != null) {
			$userManager->deleteUser($user);
		}
		
		$this->redirect('index.php?ctrl=user&action=index');
	}

	
	private function validateForm(): array
	{
		$errors = [];
		if (empty($_POST['email'])) {
			$errors[] = 'The email is mandatory';
		}
		if (empty($_POST['name'])) {
			$errors[] = 'The name is mandatory';
		}

		return $errors;
	}
}