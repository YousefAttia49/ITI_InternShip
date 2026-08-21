<?php

include "../navbar.php";
require_once "Department.php";

$department = new Department();
$departments = $department->getAllDepartments();

?>

<h2 class="mb-3">Departments List</h2>

<a href="addDepartment.php" class="btn btn-success mb-3">
    Add Department
</a>

<table class="table table-bordered table-striped">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Manager</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php while($row = $departments->fetch_assoc()) { ?>

        <tr>

            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['location']; ?></td>
            <td><?= $row['manager']; ?></td>

            <td>

                <a href="editDepartment.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <a href="deleteDepartment.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">
                    Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </tbody>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
