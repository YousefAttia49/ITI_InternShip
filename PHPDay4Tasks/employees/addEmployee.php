<?php

require_once "Employee.php";

if(isset($_POST['add']))
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $age   = $_POST['age'];

    $employee = new Employee();
    $employee->addEmployee($name, $email, $age);

    header("Location: showEmployee.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Add Employee</h2>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Age</label>
        <input
            type="number"
            name="age"
            class="form-control"
            required
        >
    </div>

    <button
        type="submit"
        name="add"
        class="btn btn-success">
        Add Employee
    </button>

    <a href="showEmployee.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
