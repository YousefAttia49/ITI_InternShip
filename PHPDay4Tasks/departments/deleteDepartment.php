<?php

require_once "Department.php";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $department = new Department();

    $department->deleteDepartment($id);
}

header("Location: showDepartment.php");
exit();

?>
