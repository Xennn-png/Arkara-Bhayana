<?php
    include('../../config.php');

    $game = isset($_GET['game']) ? $_GET['game'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/main/overflow.css" />
    <link rel="stylesheet" href="/public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani"/>
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo"/>
    <title><?php echo htmlspecialchars($game); ?> - Artifact Sets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a237e;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #303f9f;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #3f51b5;
        }
        th {
            background-color: #283593;
            font-weight: bold;
        }
        .artifact-icon {
            width: 40px;
            height: 40px;
            vertical-align: middle;
            margin-right: 10px;
            border-radius: 5px;
        }
        .star {
            color: #ffd700;
        }
        .star-4 {
            color: #ff69b4;
        }
        .back-button {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <button class="back-button" onclick="goBack()">Kembali</button>
    <table id="artifactTable">
        <thead>
            <tr>
                <th>Set</th>
                <th>Rarity</th>
                <th>2-Piece Bonus</th>
                <th>4-Piece Bonus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                $dataFound = false;
                while ($row = $artifacts->fetch_assoc()):
                    if ($row['game'] === $game): 
                        $dataFound = true;?>
                        <td><img src="../../public/images/artifacts/<?php echo htmlspecialchars ($row['gambar']); ?>" alt="<?php echo htmlspecialchars ($row['nama']); ?>" class="artifact-icon"><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo str_repeat('★', $row['rarity']); ?></td>
                        <td><?php echo htmlspecialchars($row['2p']); ?></td>
                        <td><?php echo htmlspecialchars($row['4p']); ?></td>
                <?php 
                    endif;
                endwhile; 
                
                if (!$dataFound):?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>