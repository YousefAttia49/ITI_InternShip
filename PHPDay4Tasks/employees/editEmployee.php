<?php

require_once "Employee.php";

$employee = new Employee();

$id = $_GET['id'];

$data = $employee->getEmployeeById($id);

if(isset($_POST['update']))
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $age   = $_POST['age'];

    $employee->updateEmployee($id, $name, $email, $age);

    header("Location: showEmployee.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Edit Employee</h2>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="<?= $data['name']; ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            value="<?= $data['email']; ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Age</label>
        <input
            type="number"
            name="age"
            class="form-control"
            value="<?= $data['age']; ?>"
            required>
    </div>

    <button
        type="submit"
        name="update"
        class="btn btn-primary">
        Update Employee
    </button>

    <a href="showEmployee.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
