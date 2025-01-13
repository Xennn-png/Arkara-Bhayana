<?php
 include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/app/windows/desktop/explore-page/choose-game.css" />
    <link rel="stylesheet" href="../public/css/main/overflow.css" />
    <link rel="icon" href="./public/img/home/logo/logo.png" />
    <link rel="stylesheet" href="../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani" />
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo" />
    <link rel="stylesheet" href="../public/css/font-face/genshin-font.css">
    <link rel="stylesheet" href="../public/css/font-face/title-font.css">
    <link rel="stylesheet" href="../public/css/game-menu/menu.css">
    <title>Stage Game</title>
    <style>
    body {
        font-family: 'normal-font', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background: url(" ../public/images/background/background1.png") no-repeat center center;
        background-size:
            cover;
        background-attachment: fixed;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($games->num_rows > 0): ?>
        <?php while ($row = $games->fetch_assoc()): ?>
        <a href="./game/genshin.php?game=<?php echo htmlspecialchars($row['nama']); ?>" class="game-icon"
            data-bg="../public/images/background/game-background/genshin-impact.png">
            <img src="../public/images/logo-games/<?php echo htmlspecialchars ($row['logo']); ?>"
                alt="<?php echo htmlspecialchars($row['nama']); ?>" class="icon" />
            <div class="game-name"><?php echo htmlspecialchars($row['nama']); ?></div>
        </a>
        <?php endwhile; ?>
        <?php else: ?>
        <p>Tidak ada pilihan game yang tersedia.</p>
        <?php endif; ?>
        <a href="/views/app/windows/desktop/html/home/other/honkai-impact-page/honkai-page.html" class="game-icon"
            data-bg="../public/images/background/game-background/honkai-impact.webp">
            <img src="https://bit.ly/3MZIFoK" alt="Honkai Impact" class="icon" />
            <div class="game-name">Honkai Impact</div>
        </a>
        <a href="/views/app/windows/desktop/html/home/other/honkai-star-rail-page/hsr-page.html" class="game-icon"
            data-bg="../public/images/background/game-background/honkai-star-rail.webp">
            <img src="http://bit.ly/3Beo0uK" alt="Honkai: Star Rail" class="icon" />
            <div class="game-name">Honkai: Star Rail</div>
        </a>
        <a href="/views/app/windows/desktop/html/home/other/zzz-page/zzz-page.html" class="game-icon"
            data-bg="../public/images/background/game-background/zenless-zero.webp">
            <img src="https://bit.ly/4gCpOh4" alt="ZZZ" class="icon" />
            <div class="game-name">ZZZ</div>
        </a>
    </div>
    <!-- <img src=""> -->
    <h2 class="title-menu">game menu</h2>
    <p class="description-title">pilih game yang ingin kamu eksplorasi</p>
    <script src="../public/javascript/home.js"></script>

</body>

</html>