<?php
    include('../../config.php');

    $game = isset($_GET['game']) ? $_GET['game'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($game); ?> - Elemen dan Resonansi Elemental</title>
    <link rel="stylesheet" href="../../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani"/>
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #fefbfb;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: url("../../public/images/background/background2.jpg");
            background-size: cover;
            background-attachment: fixed;
        }
        h1, h2 {
            color: #fefbfb;
            text-align: center;
        }
        .element, .resonance {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .element h2, .resonance h3 {
            color: #fefbfb;
            display: flex;
            align-items: center;
        }
        .element-icon {
            width: 50px;
            height: 50px;
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
        }
        .resonance {
            background: linear-gradient(45deg, #1d0e33, #300e33, #330e24);
        }
        .resonance-icons {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }
        .resonance-icons img {
            width: 30px;
            height: 30px;
            margin-right: 5px;
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
    <h1>Elemen dan Resonansi Elemental <?php echo htmlspecialchars($game); ?></h1>
    
    <h2>Elemen-elemen</h2>
    
    <?php 
    $dataFound = false;
    while ($row = $elements->fetch_assoc()): ?>
        <?php if ($row['game'] === $game): ?>
            <div class="element">
                <h2>
                    <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>" class="element-icon">
                    <?php echo htmlspecialchars($row['nama']); ?> (<?php echo htmlspecialchars($row['type']); ?>)
                </h2>
                <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
            </div>
            <?php $dataFound = true; ?>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php if (!$dataFound): ?>
        <p>Data tidak tersedia</p>
    <?php endif; ?>

    <h2>Resonansi Elemental</h2>
    <p>Resonansi Elemental adalah efek bonus yang didapatkan ketika menggunakan kombinasi karakter dengan elemen tertentu dalam tim. Berikut adalah beberapa Resonansi Elemental di <?php echo htmlspecialchars($game); ?>:</p>

    <?php 
    $dataFoundd = false;
    while ($row = $resonansis->fetch_assoc()): ?>
        <?php if ($row['game'] === $game): ?>
            <div class="resonance">
                <div class="resonance-icons">
                    <img src="<?php echo htmlspecialchars(explode(',', $row['gambar'])[0]); ?>" alt="<?php echo htmlspecialchars($row['type']); ?>" class="element-icon">
                    <img src="<?php echo htmlspecialchars(explode(',', $row['gambar'])[1]); ?>" alt="<?php echo htmlspecialchars($row['type']); ?>" class="element-icon">
                </div>
                <h3><?php echo htmlspecialchars($row['nama']); ?> (<?php echo htmlspecialchars($row['type']); ?>)</h3>
                <p>Efek: <?php echo htmlspecialchars($row['deskripsi']); ?></p>
            </div>
            <?php $dataFoundd = true; ?>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php if (!$dataFoundd): ?>
        <p>Data tidak tersedia</p>
    <?php endif; ?>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>