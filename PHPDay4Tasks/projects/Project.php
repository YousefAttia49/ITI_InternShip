<?php

require_once "../Database.php";

class Project
{
    private $conn;
    private $table = "projects";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Show All Projects
    public function getAllProjects()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->conn->query($sql);
    }

    // Add Project
    public function addProject($name, $description, $budget)
    {
        $sql = "INSERT INTO $this->table(name,description,budget)
                VALUES('$name','$description','$budget')";

        return $this->conn->query($sql);
    }

    // Get One Project
    public function getProjectById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    // Update Project
    public function updateProject($id, $name, $description, $budget)
    {
        $sql = "UPDATE $this->table
                SET
                name='$name',
                description='$description',
                budget='$budget'
                WHERE id=$id";

        return $this->conn->query($sql);
    }

    // Delete Project
    public function deleteProject($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";

        return $this->conn->query($sql);
    }
}
