<?php

include "../navbar.php";
require_once "Employee.php";

$employee = new Employee();
$employees = $employee->getAllEmployees();

?>

<h2 class="mb-3">Employees List</h2>

<a href="addEmployee.php" class="btn btn-success mb-3">
    Add Employee
</a>

<table class="table table-bordered table-striped">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php while($row = $employees->fetch_assoc()) { ?>

        <tr>

            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['age']; ?></td>

            <td>

                <a href="editEmployee.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <a href="deleteEmployee.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">
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
