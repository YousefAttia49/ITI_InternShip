<?php

require_once "Project.php";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $project = new Project();

    $project->deleteProject($id);
}

header("Location: showProject.php");
exit();

?>
