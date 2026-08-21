<?php

require_once "Project.php";

$project = new Project();

$id = $_GET['id'];

$data = $project->getProjectById($id);

if(isset($_POST['update']))
{
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $budget      = $_POST['budget'];

    $project->updateProject($id, $name, $description, $budget);

    header("Location: showProject.php");
    exit();
}

include "../navbar.php";
?>

<h2 class="mb-4">Edit Project</h2>

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
        <label class="form-label">Description</label>
        <input
            type="text"
            name="description"
            class="form-control"
            value="<?= $data['description']; ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Budget</label>
        <input
            type="number"
            name="budget"
            class="form-control"
            value="<?= $data['budget']; ?>"
            required>
    </div>

    <button
        type="submit"
        name="update"
        class="btn btn-primary">
        Update Project
    </button>

    <a href="showProject.php" class="btn btn-secondary">
        Back
    </a>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
