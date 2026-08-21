<?php

require_once "Department.php";

if(isset($_POST['add']))
{
    $name     = $_POST['name'];
    $location = $_POST['location'];
    $manager  = $_POST['manager'];

    $department = new Department();
    $department->addDepartment($name, $location, $manager);

    header("Location: showDepartment.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Add Department</h2>

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
        <label class="form-label">Location</label>
        <input
            type="text"
            name="location"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Manager</label>
        <input
            type="text"
            name="manager"
            class="form-control"
            required
        >
    </div>

    <button
        type="submit"
        name="add"
        class="btn btn-success">
        Add Department
    </button>

    <a href="showDepartment.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
