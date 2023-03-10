<?php
include('auth.php');
include('templates/admin.html');
include('config.php');
// Retrieve the list of rooms and services
$services = mysqli_query($conn, "SELECT * FROM services");

// fetch services as an associative array
$services = mysqli_fetch_all($services, MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Services</h3>
        </div>
        <div class="col-2 text-right ml-auto">
            <a href="services/add_service.php" class="btn btn-primary">Add Service</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['name']; ?></td>
                    <td><?php echo $service['price']; ?></td>
                    <td>
                        <a href="services/edit_service.php?id=<?php echo $service['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="services/delete_service.php?id=<?php echo $service['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>