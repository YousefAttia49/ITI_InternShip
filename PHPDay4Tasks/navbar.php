<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP CRUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            OOP CRUD
        </a>

        <div class="navbar-nav me-auto">

            <a class="nav-link" href="index.php">
                Home
            </a>

            <a class="nav-link" href="employees/showEmployee.php">
                Employees
            </a>

            <a class="nav-link" href="departments/showDepartment.php">
                Departments
            </a>

            <a class="nav-link" href="projects/showProject.php">
                Projects
            </a>

        </div>

        <div class="navbar-nav">
            <?php if (isset($_SESSION['user'])): ?>

                <span class="nav-link text-light">
                    Welcome, <?= htmlspecialchars($_SESSION['user']['name']); ?>
                </span>

                <a class="nav-link text-danger" href="logout.php">
                    Logout
                </a>

            <?php else: ?>

                <a class="nav-link" href="login.php">
                    Login
                </a>

                <a class="nav-link" href="register.php">
                    Register
                </a>

            <?php endif; ?>
        </div>

    </div>
</nav>

<div class="container mt-4">