<?php
$title = 'Home';
ob_start();
?>
<h1>Hello there 👋</h1>
<h2>Welcome to the next social network!</h2>
<?php foreach($users as $user) { ?>
	<h3><?= $user->getName(); ?> has joined us!</h3> 
<?php } ?>
<?php
$content = ob_get_clean();
require __DIR__ . '/../template.php';
?>
