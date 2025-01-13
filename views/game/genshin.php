<?php
    include('../../config.php');
    $game = isset($_GET['game']) ? $_GET['game'] : '';
    $data = null;
    if ($games->num_rows > 0) {
        while ($row = $games->fetch_assoc()) {
            if ($row['nama'] === $game) {
                $data = $row;
                break;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($game); ?></title>
    <link rel="stylesheet" href="../../public/css/genshin/beranda.css">
    <link rel="stylesheet" href="../../public/css/font-face/genshin-font.css">
    <link rel="stylesheet" href="../../public/css/cursor/cursor.css">
    <link rel="stylesheet" href="../../public/css/font-face/title-font.css">
    <link rel="stylesheet" href="../../public/img/home/logo/logo.png">
    <link rel="stylesheet" href="../../public/css/main/footer.css" />
    <style>
    body {
        overflow-y: visible;
    }

    body::webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body>
    <header>
        <img src="../../public/images/logo/logo.png" class="logo" id="logo-arkara" alt="logo-arkara-bhayana"
            draggable="false" width="80px" height="auto">
        <nav>
            <a href="about.html">About</a>
            <a href="profile.php">
                <img src="../../public/images/profiles/profile.webp" alt="profile" width="75px" height="75px"
                    class="profile">
            </a>
            <div class="hamburger" onclick="toggleMenu()">☰</div>
        </nav>
    </header>

    <div class="banner-container">
        <div class="banner-slider">
            <?php if ($data): ?>
            <?php $banners = explode(',', $data['banner']); ?>
            <?php foreach ($banners as $banner): ?>
            <div class="slide">
                <img src="../../public/images/banner/<?php echo htmlspecialchars(trim($banner)); ?>" alt="Banner"
                    draggable="false">
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Banner game tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content -->
    <section class="features">
        <div class="wish"><a href="#">Wish
            </a>
        </div>
        <div class=" character"><a
                href="./characters.php?game=<?php echo htmlspecialchars($data['nama']); ?>">Characters</a>
        </div>
        <div class="map"><a href="https://act.hoyolab.com/ys/app/interactive-map/index.html">Map</a></div>
        <div class="weapon"><a href="./weapons.php?game=<?php echo htmlspecialchars($data['nama']); ?>">Weapons</a>
        </div>
        <div class="artifact"><a
                href="./artifacts.php?game=<?php echo htmlspecialchars($data['nama']); ?>">Artifacts</a></div>
        <div class="element"><a href="./elements.php?game=<?php echo htmlspecialchars($data['nama']); ?>">Elements</a>
        </div>
        <div class="try-party"><a href="./try-party.php?game=<?php echo htmlspecialchars($data['nama']); ?>">Try
                Party</a></div>
        <div class="tgc-genshin"><a href="#">TGC Card</a></div>
        <div class="world"><a href="#">World</a></div>
    </section>
    <br><br><br>
    <!-- Footer -->
    <footer>
        <a href="#">FAQ</a>
        <a href="#">CS</a>
        <div class="social-media">
            <a href="#">Instagram</a>
            <a href="#">TikTok</a>
            <a href="#">LinkedIn</a>
            <a href="#">YouTube</a>
            <a href="#">Discord</a>
            <a href="#">GitHub</a>
        </div>
    </footer>

    <script>
    function toggleMenu() {
        document.querySelector('nav').classList.toggle('open');
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.banner-slider');

        // Reset posisi slider setelah animasi selesai
        slider.addEventListener('animationend', function() {
            slider.style.animation = 'none';
            slider.offsetHeight; // Trigger reflow
            slider.style.animation = null;
        });
    });
    </script>
</body>

</html>