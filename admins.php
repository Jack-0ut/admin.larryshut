<?php
include('auth.php');
// include the database connection file
include('config.php');
include('templates/admin.html');

// Retrieve the list of admins
$result = mysqli_query($conn, "SELECT id, admin_name, admin_email, admin_phone FROM admins");
$admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Admins</h3>
        </div>
        <div class="col-2 text-right ml-auto">
            <a href="admins/add_admin.php" class="btn btn-primary">Add Admin</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['admin_name']; ?></td>
                    <td><?php echo $admin['admin_email']; ?></td>
                    <td><?php echo $admin['admin_phone']; ?></td>
                    <td>
                        <a href="admins/edit_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="admins/delete_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
