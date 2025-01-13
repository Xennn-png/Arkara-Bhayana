<?php
// Start the session
session_start();
include('../config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get input values
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if username or email already exists
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If user already exists, show an error message
        $error_message = "Username or email already exists.";
    } else {
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $insert_query)) {
            // Registration successful, set success message in session
            $_SESSION['success_message'] = "Registration successful! You can now log in.";
            // Redirect after setting the message
            $success_redirect = true;
        } else {
            $error_message = "Error registering user: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Arkara Bhayana</title>
    <link rel="stylesheet" href="../public/css/loginregister/login.css">
    <link rel="stylesheet" href="../public/css/main/background-video.css" />
    <link rel="stylesheet" href="../public/css/main/overflow.css" />
    <link rel="stylesheet" href="../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani"/>
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo"/>
    <link rel="stylesheet" href="../public/css/font-face/genshin-font.css">
</head>
<body>
    <div class="background-video-container" id="background-video-container">
        <video
            autoplay
            muted
            loop
            class="background-video"
            id="background-video"
            width="100%"
            height="100%"
        >
            <source
                src="../public/videos/sangonomiya-kokomi-galaxy-stars-genshin-impact-moewalls-com.mp4"
                type="video/mp4"
            />
            Your browser does not support the video tag.
        </video>
    <div class="login-container">
        <h2>Registrasi</h2>

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Silakan ketik nama kamu disini" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Silakan ketik email kamu disini" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Silakan ketik password kamu disini" required>

            <button type="submit">Registrasi</button>
        </form>

        <p>Sudah memiliki akun? <a href="./login.php" class="register-link">Login Sekarang!</a></p>
    </div>
    </div>

    <?php if (isset($success_redirect) && $success_redirect): ?>
        <script>
            alert('Registrasi sukses!.');
            window.location.href = 'login.php';
        </script>
    <?php endif; ?>

    <script src="../public/javascript/function-href.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>