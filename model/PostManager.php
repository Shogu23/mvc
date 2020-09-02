<?php

require_once __DIR__ . '/Post.php';

/**
*	It's the manager of the Post class.
*	All database operations (SELECT INSERT, UPDATE, DELETE, will be performed here)
*/
class PostManager {
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO('mysql:host=localhost;dbname=forcebook', 'charles', '4321');
	}

	private function rowToPost(array $row): Post {
		$post = new Post();
        $post->setId($row['id']);
        $post->setContent($row['content']);
		$post->setCreatedBy($row['createdBy']);
        $post->setCreatedAt(new DateTime($row['createdAt']));

		return $post;
	}

	/**
	*	Create an post in the database
	*/
	public function createPost(Post $post) {		
		$stmt = $this->pdo->prepare('INSERT INTO `post` (`name`, `email`) VALUES (:name, :email)');
		$stmt->bindValue(':name', $post->getName(), PDO::PARAM_STR);
		$stmt->bindValue(':email', $post->getEmail(), PDO::PARAM_STR);
		$stmt->execute();
		$post->setId($this->pdo->lastInsertId());
	}

	/**
	*	Update an post in the database
	*/
	public function updatePost(Post $post) {		
		$stmt = $this->pdo->prepare('UPDATE post SET name=:name, email=:email WHERE id = :id');
		$stmt->bindValue(':id', $post->getId(), PDO::PARAM_INT);
		$stmt->bindValue(':name', $post->getName(), PDO::PARAM_STR);
		$stmt->bindValue(':email', $post->getEmail(), PDO::PARAM_STR);
		$stmt->execute();
	}

	/**
	*	Get one post from the database
	*	Return an instance of Post or null if not exists
	*/
	public function getPost(int $id): ?Post {
		$stmt = $this->pdo->prepare('SELECT * FROM post WHERE id=:id');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch();
		if($row) {
			return $this->rowToPost($row);
		} else {
			return null;
		}
	}

	/**
	*	Get all posts from database
	*	Return an array of Post
	*/
	public function getPosts(): array {
		$stmt = $this->pdo->query('SELECT * FROM post ORDER BY name');
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$classPosts = [];
		foreach($rows as $row) {
			$post = $this->rowToPost($row);
			$classPosts[] = $post;
		}

		return $classPosts;
	} 	

		/**
	*	Delete an post in the database
	*/
	public function deletePost(Post $post) {
		
		$stmt = $this->pdo->prepare('DELETE FROM post WHERE id=:id');
		$stmt->bindValue(':id', $post->getId(), PDO::PARAM_INT);
		$stmt->execute();
	}
	
}