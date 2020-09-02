<?php
$title = 'Edit an user';
ob_start();
?>
<div class="card">
    <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success" name="save" value="Save">
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../template.php';
?>