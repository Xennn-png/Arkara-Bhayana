<?php
    include('../../config.php');

    $game = isset($_GET['game']) ? $_GET['game'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../public/img/home/logo/logo.png">
    <link rel="stylesheet" href="../../public/css/main/overflow.css" />
    <link rel="stylesheet" href="../../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani"/>
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo"/>
    <title><?php echo htmlspecialchars($game); ?> - Character Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background: linear-gradient(45deg, #1d0e33, #300e33, #330e24);
            overflow: hidden;
        }
        .container {
            display: flex;
            height: 100vh;
            background: url('https://example.com/genshin-background.jpg') no-repeat center center;
            background-size: cover;
        }
        .sidebar {
            width: 200px;
            background: linear-gradient(45deg, #1d0e33, #300e33, #330e24);
            color: white;
            padding: 20px;
            position: relative;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
            height: 100%;
            box-sizing: border-box;
            margin-top: 70px;
        }
        .sidebar.closed {
            transform: translateX(-200px);
        }
        .hamburger {
            position: fixed;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            padding: 5px 10px;
            cursor: pointer;
            z-index: 10;
        }
        .region-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: rgba(214, 176, 239, 0.8);
            color: rgb(2, 2, 2);
            border: none;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .region-btn:hover {
            background-color: rgba(214, 176, 239, 1);
        }
        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        .header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            color: rgb(255, 255, 255);
            align-items: center;
        }
        .character-info {
            display: flex;
            padding: 20px;
            flex-grow: 1;
            position: relative;
        }
        .character-image {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .character-image img {
            max-width: 100%;
            max-height: 50vh;
            object-fit: contain;
        }
        .character-details {
            width: 50%;
            padding: 20px;
            background-color: rgba(214, 176, 239, 0.8);
            border-radius: 10px;
            max-height: 50vh;
            overflow-y: auto;
        }
        .character-list-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            position: relative;
        }
        .character-list {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            overflow-x: auto;
            max-width: calc(100% - 100px);
            scroll-behavior: smooth;
            padding: 0 10px;
        }
        .character-list::-webkit-scrollbar {
            height: 8px;
        }
        .character-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        .character-list::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 4px;
        }
        .character-icon {
            flex: 0 0 60px;
            width: 60px;
            height: 60px;
            margin: 0 5px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .character-icon:hover {
            transform: scale(1.1);
        }
        .character-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .nav-arrow {
            font-size: 24px;
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
        .nav-arrow.left {
            left: 0;
        }
        .nav-arrow.right {
            right: 0;
        }
        .nav-arrow:hover {
            background-color: rgba(0,0,0,0.7);
        }
        .download-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="hamburger" id="hamburger">☰</button>
        <div class="sidebar closed" id="sidebar">
            <h3>Regions</h3>
            <?php 
            $regions = [];
            if ($characters->num_rows > 0): ?>
                <?php while ($row = $characters->fetch_assoc()): ?>
                    <?php 
                    if (!in_array($row['region'], $regions)): 
                        $regions[] = $row['region']; ?>
                        <button class="region-btn" data-region="<?php echo htmlspecialchars($row['region']); ?>">
                            <?php echo htmlspecialchars($row['region']); ?>
                        </button>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No regions available.</p>
            <?php endif; ?>
        </div>

        <div class="content">
            <div class="header">
                <h1 id="character-name"></h1>
                <button class="download-btn">Download</button>
            </div>
            <div class="character-info">
                <div class="character-image">
                    <img id="character-img">
                </div>
                <div class="character-details">
                    <h2 id="character-title"></h2>
                    <p id="character-va"></p>
                    <p id="character-description"></p>
                </div>
            </div>
            <div class="character-list-container">
                <button class="nav-arrow left" id="leftArrow">&lt;</button>
                <div id="character-list" class="character-list">
                    <!-- Characters will be dynamically inserted here -->
                </div>
                <button class="nav-arrow right" id="rightArrow">&gt;</button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        document.getElementById("hamburger").addEventListener("click", () => {
            document.getElementById("sidebar").classList.toggle("closed");
        });

        // Region Selection
        document.querySelectorAll(".region-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const region = this.dataset.region;
                const characterList = document.getElementById("character-list");
                characterList.innerHTML = '';

                // Ambil data karakter dari server
                fetch(`./get_characters.php?region=${region}`)
                    .then(response => response.json())
                    .then(data => {
                        // Loop untuk menampilkan karakter
                        data.forEach(character => {
                            const icon = document.createElement("div");
                            icon.classList.add("character-icon");
                            icon.innerHTML = `<img src="${character.image}" alt="${character.name}">`;
                            icon.addEventListener("click", () => displayCharacter(character));
                            characterList.appendChild(icon);
                        });

                        // Tampilkan karakter pertama setelah data dimuat
                        if (data.length > 0) {
                            displayCharacter(data[0]);
                        }
                    })
                    .catch(error => console.error('Error fetching characters:', error));
            });
        });

        // Display Character Info
        function displayCharacter(character) {
            document.getElementById("character-name").textContent = character.name;
            document.getElementById("character-img").src = character.image;
            document.getElementById("character-img").alt = character.name;
            document.getElementById("character-title").textContent = character.name;
            document.getElementById("character-va").textContent = "VA: " + character.va;
            document.getElementById("character-description").textContent = character.description;
        }

        // Arrows for Character List Navigation
        document.getElementById("leftArrow").addEventListener("click", () => {
            document.getElementById("character-list").scrollBy({ left: -100, behavior: "smooth" });
        });
        document.getElementById("rightArrow").addEventListener("click", () => {
            document.getElementById("character-list").scrollBy({ left: 100, behavior: "smooth" });
        });

        // Automatically open the "Mondstadt" region when the page loads
        window.addEventListener("load", () => {
            const mondstadtBtn = document.querySelector('.region-btn[data-region="Mondstadt"]');
            if (mondstadtBtn) {
                mondstadtBtn.click(); // Simulate a click on the Mondstadt button
            }
        });
    </script>
</body>
</html>
