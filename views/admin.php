<?php
// Start the session
session_start();
include('../config.php');
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get input values
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch user data
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if ($password == $user['password']) {
            // Set session variables
            $_SESSION['user'] = $user;

            // Redirect to homepage or dashboard
            header('Location: ../dashboard/index.php');
            exit();
        } else {
            $error_message = "Password incorrect.";
        }
    } else {
        $error_message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arkara Bhayana</title>
    <link rel="stylesheet" href="../public/css/loginregister/login.css">
    <link rel="stylesheet" href="../public/css/main/background-video.css" />
    <link rel="stylesheet" href="../public/css/main/overflow.css" />
    <link rel="stylesheet" href="../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani" />
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo" />
    <link rel="stylesheet" href="../public/css/font-face/genshin-font.css">
</head>

<body>
    <div class="background-video-container" id="background-video-container">
        <video autoplay muted loop class="background-video" id="background-video" width="100%" height="100%">
            <source src="../public/videos/sangonomiya-kokomi-galaxy-stars-genshin-impact-moewalls-com.mp4"
                type="video/mp4" />
            Your browser does not support the video tag.
        </video>
        <div class="login-container">
            <h2>Admin Login</h2>

            <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Silakan ketik email kamu disini" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Silakan ketik password kamu disini"
                    required>

                <button type="submit">Login</button>
            </form>
            <p>Ingin kembali ke Web Pengunjung? <a href="./login.php" class="register-link"><br>Login sebagai Pengunjung
                    Sekarang!</a></p>
        </div>
    </div>
    <script src="../public/javascript/function-href.js"></script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>