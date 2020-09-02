<?php
$title = 'List of users';
ob_start();
?>
<h1>Users <a href="index.php?ctrl=user&action=create" class="btn btn-success">Add User</a></h1>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->getId(); ?></td>
                        <td><?= $user->getName(); ?></td>
                        <td><?= $user->getEmail(); ?></td>
                        <td>
                            <a href="index.php?ctrl=user&action=edit&id=<?= $user->getId() ?>" class="btn btn-primary">
                                Edit
                            </a>
                            <a href="index.php?ctrl=user&action=delete&id=<?= $user->getId() ?>" class="btn btn-danger">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../template.php';
?>
