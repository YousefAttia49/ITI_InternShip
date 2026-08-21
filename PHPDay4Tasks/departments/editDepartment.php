<?php

require_once "Department.php";

$department = new Department();

$id = $_GET['id'];

$data = $department->getDepartmentById($id);

if(isset($_POST['update']))
{
    $name     = $_POST['name'];
    $location = $_POST['location'];
    $manager  = $_POST['manager'];

    $department->updateDepartment($id, $name, $location, $manager);

    header("Location: showDepartment.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Edit Department</h2>

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
        <label class="form-label">Location</label>
        <input
            type="text"
            name="location"
            class="form-control"
            value="<?= $data['location']; ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Manager</label>
        <input
            type="text"
            name="manager"
            class="form-control"
            value="<?= $data['manager']; ?>"
            required>
    </div>

    <button
        type="submit"
        name="update"
        class="btn btn-primary">
        Update Department
    </button>

    <a href="showDepartment.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
