<?php include('../../config.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ./login.php");
    exit;
}

$user_email = $_SESSION['user']['email'];

$data = null;
if ($users->num_rows > 0) {
    while ($row = $users->fetch_assoc()) {
        if ($row['email'] === $user_email) {
            $data = $row;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $id = $_POST['id'];
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $bio = htmlspecialchars(trim($_POST['bio']));

    $profile_picture = $data['profile_picture'];
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_picture'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, ALLOWED_EXTENSIONS) && $fileSize <= MAX_FILE_SIZE) {
            $newFileName = uniqid('profile_', true) . '.' . $fileExt;
            $destination = UPLOAD_DIR . $newFileName;
            if (move_uploaded_file($fileTmp, $destination)) {
                $profile_picture = $newFileName;
            } else {
                $error = "Gagal mengunggah file.";
            }
        } else {
            $error = "Format file tidak valid atau ukuran file melebihi batas.";
        }
    }

    if (!isset($error)) {
        $stmt = $conn->prepare("UPDATE users SET profile_picture = ?, username = ?, email = ?, bio = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $profile_picture, $username, $email, $bio, $id);
        if ($stmt->execute()) {
            $message = 'Data berhasil diperbarui';
        } else {
            $error = 'Gagal memperbarui data ke database';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Arkara Bhayana</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Profile View -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6" id="profileView">
                <h2 class="text-2xl font-bold mb-4">Your Profile</h2>
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200">
                            <?php if (!empty($data['profile_picture'])): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($data['profile_picture']); ?>"
                                alt="Profile Picture" class="w-full h-full object-cover">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <p class="mb-2"><strong>Username:</strong> <?php echo htmlspecialchars($data['username']); ?>
                        </p>
                        <p class="mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
                        <p class="mb-2"><strong>password:</strong> <?php echo htmlspecialchars($data['password']); ?>
                        </p>
                        <p class="mb-4"><strong>Bio:</strong>
                            <?php if (!empty($data['bio'])): ?>
                            <?php echo nl2br(htmlspecialchars($data['bio'])); ?>
                            <?php else: ?>
                            <span class="text-gray-500">Belum ada bio</span>
                            <?php endif; ?>
                        </p>
                        <button onclick="toggleView('editForm')"
                            class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Edit Data</button>
                        <form method="POST" class="inline">
                            <button onclick="backLogin()" type="submit" name="logout"
                                class="bg-red-500 text-white px-4 py-2 rounded">Log
                                Out</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div id="editForm" class="bg-white rounded-lg shadow-md p-6" style="display: none;">
                <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Profile Picture</label>
                        <input type="file" name="profile_picture" accept="image/*" class="w-full">
                        <p class="text-sm text-gray-500 mt-1">Maksimum ukuran file: 5MB. Format yang diperbolehkan: JPG,
                            JPEG, PNG, GIF</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($data['username']); ?>"
                            class="w-full px-3 py-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>"
                            class="w-full px-3 py-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Bio</label>
                        <textarea name="bio" class="w-full px-3 py-2 border rounded" rows="4"
                            placeholder="Tuliskan bio Anda di sini..."><?php echo htmlspecialchars($data['bio'] ?? ''); ?></textarea>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" name="update_profile" class="bg-green-500 text-white px-4 py-2 rounded">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="toggleView('profileView')"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function toggleView(showId) {
        const profileView = document.getElementById('profileView');
        const editForm = document.getElementById('editForm');

        if (showId === 'editForm') {
            profileView.style.display = 'none';
            editForm.style.display = 'block';
        } else {
            profileView.style.display = 'block';
            editForm.style.display = 'none';
        }
    }

    function backLogin() {
        window.location.href = "../login.php";
    }
    window.onload = function() {
        <?php if (isset($message)): ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: "<?php echo $message; ?>",
        }).then(function() {
            window.location.href = window.location.href;
        });
        <?php elseif (isset($error)): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "<?php echo $error; ?>",
        }).then(function() {
            window.location.href = window.location.href;
        });
        <?php endif; ?>
    }
    </script>
</body>

</html>