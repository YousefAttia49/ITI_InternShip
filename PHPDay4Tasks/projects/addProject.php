<?php

require_once "Project.php";

if(isset($_POST['add']))
{
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $budget      = $_POST['budget'];

    $project = new Project();
    $project->addProject($name, $description, $budget);

    header("Location: showProject.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Add Project</h2>

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
        <label class="form-label">Description</label>
        <input
            type="text"
            name="description"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Budget</label>
        <input
            type="number"
            name="budget"
            class="form-control"
            required
        >
    </div>

    <button
        type="submit"
        name="add"
        class="btn btn-success">
        Add Project
    </button>

    <a href="showProject.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
