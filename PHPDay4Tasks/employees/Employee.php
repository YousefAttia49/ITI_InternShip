<?php

require_once "../Database.php";

class Employee
{
    private $conn;
    private $table = "employees";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Show All Employees
    public function getAllEmployees()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->conn->query($sql);
    }

    // Add Employee
    public function addEmployee($name, $email, $age)
    {
        $sql = "INSERT INTO $this->table(name,email,age)
                VALUES('$name','$email','$age')";

        return $this->conn->query($sql);
    }

    // Get One Employee
    public function getEmployeeById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    // Update Employee
    public function updateEmployee($id, $name, $email, $age)
    {
        $sql = "UPDATE $this->table
                SET
                name='$name',
                email='$email',
                age='$age'
                WHERE id=$id";

        return $this->conn->query($sql);
    }

    // Delete Employee
    public function deleteEmployee($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";

        return $this->conn->query($sql);
    }
}
