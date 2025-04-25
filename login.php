<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Escape inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User is found, start session and set user_id
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user;  // Assuming 'id' is the column for user ID

        // Redirect to dashboard or wherever you want
        header("Location: index.html");
        exit;
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('background.jpg');
            background-image: url('background.jpg');
            background-size: cover; /* Ensures the image covers the entire viewport */
            background-position: center center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            height: 100vh; /* Ensures full viewport height */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h3 class="text-center mb-4">Login</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div>
                <h8><a href="register.php">Don't have an account?</a></h8>
            </div><br>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional for alerts, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
