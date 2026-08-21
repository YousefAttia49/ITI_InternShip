<?php

require_once "../Database.php";

class Department
{
    private $conn;
    private $table = "departments";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Show All Departments
    public function getAllDepartments()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->conn->query($sql);
    }

    // Add Department
    public function addDepartment($name, $location, $manager)
    {
        $sql = "INSERT INTO $this->table(name,location,manager)
                VALUES('$name','$location','$manager')";

        return $this->conn->query($sql);
    }

    // Get One Department
    public function getDepartmentById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    // Update Department
    public function updateDepartment($id, $name, $location, $manager)
    {
        $sql = "UPDATE $this->table
                SET
                name='$name',
                location='$location',
                manager='$manager'
                WHERE id=$id";

        return $this->conn->query($sql);
    }

    // Delete Department
    public function deleteDepartment($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";

        return $this->conn->query($sql);
    }
}
