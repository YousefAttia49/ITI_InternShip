<?php

require_once "Employee.php";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $employee = new Employee();

    $employee->deleteEmployee($id);
}

header("Location: showEmployee.php");
exit();

?>
