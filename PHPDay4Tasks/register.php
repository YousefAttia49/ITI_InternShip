<?php
require_once 'auth.php';
require_once 'Database.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name            = trim($_POST['name'] ?? '');
    $email           = strtolower(trim($_POST['email'] ?? ''));
    $password        = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        $db   = new Database();
        $conn = $db->connect();

        $check  = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($check);

        if ($result->num_rows > 0) {
            $error = 'This email is already registered.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(name, email, password)
                    VALUES('$name','$email','$hashed')";

            $conn->query($sql);

            $_SESSION['success'] = 'Account created successfully. You can now log in.';
            header('Location: login.php');
            exit;
        }
    }
}

include 'navbar.php';
?>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Register</h2>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Create Account</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Already have an account? <a href="login.php">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
