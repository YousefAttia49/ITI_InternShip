<?php

include "../navbar.php";
require_once "Project.php";

$project = new Project();
$projects = $project->getAllProjects();

?>

<h2 class="mb-3">Projects List</h2>

<a href="addProject.php" class="btn btn-success mb-3">
    Add Project
</a>

<table class="table table-bordered table-striped">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Budget</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php while($row = $projects->fetch_assoc()) { ?>

        <tr>

            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['description']; ?></td>
            <td><?= $row['budget']; ?></td>

            <td>

                <a href="editProject.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <a href="deleteProject.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">
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
