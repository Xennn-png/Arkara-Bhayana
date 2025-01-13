<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genshin Impact Character Selector</title>
    <link rel="icon" href="../../public/img/home/logo/logo.png">
    <link rel="stylesheet" href="../../public/css/cursor/cursor.css">
    <meta content="arkara-bhayana" author="Ahmad Fashich Azzuhri Ramadhani"/>
    <meta content="arkara-bhayana" author="Muhammad Daffa Wibowo"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(45deg, #1d0e33, #300e33, #330e24);
        }
        h1, h2 {
            color: #ffffff;
            text-align: center;
        }
        .character-list, .party-team {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: center;
        }
        .character {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100px;
        }
        .character:hover {
            background-color: #f0f0f0;
        }
        .character img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        .character p {
            margin: 5px 0 0;
            font-size: 12px;
        }
        .party-team .character {
            background-color: #e6f7ff;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #elementalReactions {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }
        #elementalReactions h3 {
            margin-top: 0;
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
        position: fixed; 
        top: 20px; 
        left: 20px; 
        z-index: 1000; 
        }
        .back-button:hover {
        background-color: rgba(255, 255, 255, 0.3);
        }
        
    </style>
</head>
<body>
    <div class="container">
    <button class="back-button" onclick="goBack()">Kembali</button>
    <h1>Genshin Impact Character Selector</h1>
    <div class="character-list" id="characterList"></div>
    <h2>Party Team (Max 4)</h2>
    <div class="party-team" id="partyTeam"></div>
    <button onclick="resetParty()">Reset Party</button>
    <div id="elementalReactions">
        <h3>Potential Elemental Reactions:</h3>
        <p id="reactions"></p>
    </div>
    </div>

    <script>
        const characters = [
            { name: "Traveler (Anemo)", image: "https://rerollcdn.com/GENSHIN/Characters/Traveler%20(Anemo).png", element: "Anemo" },
            { name: "Traveler (Geo)", image: "https://rerollcdn.com/GENSHIN/Characters/Traveler%20(Geo).png", element: "Geo" },
            { name: "Traveler (Electro)", image: "https://rerollcdn.com/GENSHIN/Characters/Traveler%20(Electro).png", element: "Electro" },
            { name: "Traveler (Dendro)", image: "https://rerollcdn.com/GENSHIN/Characters/Traveler%20(Dendro).png", element: "Dendro" },
            { name: "Amber", image: "https://rerollcdn.com/GENSHIN/Characters/Amber.png", element: "Pyro" },
            { name: "Kaeya", image: "https://rerollcdn.com/GENSHIN/Characters/Kaeya.png", element: "Cryo" },
            { name: "Lisa", image: "https://rerollcdn.com/GENSHIN/Characters/Lisa.png", element: "Electro" },
            { name: "Barbara", image: "https://rerollcdn.com/GENSHIN/Characters/Barbara.png", element: "Hydro" },
            { name: "Diluc", image: "https://rerollcdn.com/GENSHIN/Characters/Diluc.png", element: "Pyro" },
            { name: "Razor", image: "https://rerollcdn.com/GENSHIN/Characters/Razor.png", element: "Electro" },
            { name: "Venti", image: "https://rerollcdn.com/GENSHIN/Characters/Venti.png", element: "Anemo" },
            { name: "Klee", image: "https://rerollcdn.com/GENSHIN/Characters/Klee.png", element: "Pyro" },
            { name: "Bennett", image: "https://rerollcdn.com/GENSHIN/Characters/Bennett.png", element: "Pyro" },
            { name: "Noelle", image: "https://rerollcdn.com/GENSHIN/Characters/Noelle.png" , element: "Geo"},
            { name: "Fischl", image: "https://rerollcdn.com/GENSHIN/Characters/Fischl.png", element: "Electro" },
            { name: "Sucrose", image: "https://rerollcdn.com/GENSHIN/Characters/Sucrose.png" , element: "Anemo"},
            { name: "Mona", image: "https://rerollcdn.com/GENSHIN/Characters/Mona.png", element: "Hydro" },
            { name: "Diona", image: "https://rerollcdn.com/GENSHIN/Characters/Diona.png", element: "Cryo" },
            { name: "Albedo", image: "https://rerollcdn.com/GENSHIN/Characters/Albedo.png", element: "Geo" },
            { name: "Ganyu", image: "https://rerollcdn.com/GENSHIN/Characters/Ganyu.png", element: "Cryo" },
            { name: "Xiao", image: "https://rerollcdn.com/GENSHIN/Characters/Xiao.png" , element: "Anemo"},
            { name: "Hu Tao", image: "https://rerollcdn.com/GENSHIN/Characters/Hu%20Tao.png", element: "Pyro" },
            { name: "Rosaria", image: "https://rerollcdn.com/GENSHIN/Characters/Rosaria.png", element: "Cryo" },
            { name: "Yanfei", image: "https://rerollcdn.com/GENSHIN/Characters/Yanfei.png", element: "Pyro" },
            { name: "Eula", image: "https://rerollcdn.com/GENSHIN/Characters/Eula.png", element: "Cryo" },
            { name: "Kazuha", image: "https://rerollcdn.com/GENSHIN/Characters/Kazuha.png" , element: "Anemo"},
            { name: "Ayaka", image: "https://rerollcdn.com/GENSHIN/Characters/Ayaka.png", element: "Cryo" },
            { name: "Sayu", image: "https://rerollcdn.com/GENSHIN/Characters/Sayu.png" , element: "Anemo"},
            { name: "Yoimiya", image: "https://rerollcdn.com/GENSHIN/Characters/Yoimiya.png" , element: "Pyro"},
            { name: "Aloy", image: "https://rerollcdn.com/GENSHIN/Characters/Aloy.png", element: "Cryo" },
            { name: "Sara", image: "https://rerollcdn.com/GENSHIN/Characters/Sara.png", element: "Electro" },
            { name: "Raiden Shogun", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/raiden_shogun/image.png?strip=all&quality=100", element: "Electro" },
            { name: "Kokomi", image: "https://rerollcdn.com/GENSHIN/Characters/Kokomi.png" , element: "Hydro"},
            { name: "Thoma", image: "https://rerollcdn.com/GENSHIN/Characters/Thoma.png" , element: "Pyro"},
            { name: "Gorou", image: "https://rerollcdn.com/GENSHIN/Characters/Gorou.png", element: "Geo" },
            { name: "Itto", image: "https://rerollcdn.com/GENSHIN/Characters/Itto.png", element: "Geo" },
            { name: "Yun Jin", image: "https://rerollcdn.com/GENSHIN/Characters/Yun%20Jin.png", element: "Geo" },
            { name: "Shenhe", image: "https://rerollcdn.com/GENSHIN/Characters/Shenhe.png", element: "Cryo" },
            { name: "Yae Miko", image: "https://rerollcdn.com/GENSHIN/Characters/Yae%20Miko.png", element: "Electro" },
            { name: "Ayato", image: "https://rerollcdn.com/GENSHIN/Characters/Ayato.png", element: "Hydro" },
            { name: "Yelan", image: "https://rerollcdn.com/GENSHIN/Characters/Yelan.png", element: "Hydro" },
            { name: "Kuki Shinobu", image: "https://rerollcdn.com/GENSHIN/Characters/Kuki%20Shinobu.png", element: "Electro" },
            { name: "Heizou", image: "https://rerollcdn.com/GENSHIN/Characters/Heizou.png", element: "Anemo"},
            { name: "Collei", image: "https://rerollcdn.com/GENSHIN/Characters/Collei.png" , element: "Dendro"},
            { name: "Tighnari", image: "https://rerollcdn.com/GENSHIN/Characters/Tighnari.png", element: "Dendro" },
            { name: "Dori", image: "https://rerollcdn.com/GENSHIN/Characters/Dori.png", element: "Electro" },
            { name: "Candace", image: "https://rerollcdn.com/GENSHIN/Characters/Candace.png" , element: "Hydro"},
            { name: "Cyno", image: "https://rerollcdn.com/GENSHIN/Characters/Cyno.png", element: "Electro" },
            { name: "Nilou", image: "https://rerollcdn.com/GENSHIN/Characters/Nilou.png", element: "Hydro" },
            { name: "Nahida", image: "https://rerollcdn.com/GENSHIN/Characters/Nahida.png", element: "Dendro" },
            { name: "Layla", image: "https://rerollcdn.com/GENSHIN/Characters/Layla.png", element: "Cryo" },
            { name: "Faruzan", image: "https://rerollcdn.com/GENSHIN/Characters/Faruzan.png", element: "Anemo"},
            { name: "Wanderer", image: "https://rerollcdn.com/GENSHIN/Characters/Wanderer.png", element: "Anemo" },
            { name: "Yaoyao", image: "https://rerollcdn.com/GENSHIN/Characters/Yaoyao.png" , element: "Dendro"},
            { name: "Alhaitham", image: "https://rerollcdn.com/GENSHIN/Characters/Alhaitham.png", element: "Dendro" },
            { name: "Dehya", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/dehya/image.png?strip=all&quality=75&w=256", element: "Pyro" },
            { name: "Mika", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/mika/image.png?strip=all&quality=100&w=140", element: "Cryo" },
            { name: "Baizhu", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/baizhu/image.png?strip=all&quality=100&w=140", element: "Dendro" },
            { name: "Kaveh", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/kaveh/image.png?strip=all&quality=100&w=140", element: "Dendro" },
            { name: "Kirara", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/kirara/image.png?strip=all&quality=100&w=140", element: "Dendro" },
            { name: "Lyney", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/lyney/image.png?strip=all&quality=100&w=140" , element: "Pyro"},
            { name: "Lynette", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/lynette/image.png?strip=all&quality=100&w=140", element: "Anemo" },
            { name: "Freminet", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/freminet/image.png?strip=all&quality=100&w=140", element: "Cryo" },
            { name: "Neuvillette", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/neuvillette/image.png?strip=all&quality=100&w=140", element: "Hydro" },
            { name: "Wriothesley", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/wriothesley/image.png?strip=all&quality=100&w=140", element: "Cryo" },
            { name: "Furina", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/furina/image.png?strip=all&quality=100&w=140", element: "Hydro" },
            { name: "Charlotte", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/charlotte/image.png?strip=all&quality=100&w=140", element: "Cryo" },
            { name: "Navia", image: "https://rerollcdn.com/GENSHIN/Characters/Navia.png", element: "Geo" },
            { name: "Chevreuse", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/chevreuse/image.png?strip=all&quality=100&w=140" , element: "Pyro"},
            { name: "Xianyun", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/xianyun/image.png?strip=all&quality=100&w=140", element: "Anemo" },
            { name: "Gaming", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/gaming/image.png?strip=all&quality=100&w=140", element: "Pyro" },
            { name: "Chiori", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/chiori/image.png?strip=all&quality=100&w=140" , element: "Geo"},
            { name: "Arlecchino", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/arlecchino/image.png?strip=all&quality=100&w=140", element: "Pyro"},
            { name: "Sethos", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/sethos/image.png?strip=all&quality=100&w=140", element: "Electro"},
            { name: "Clorinde", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/clorinde/image.png?strip=all&quality=100&w=140", element: "Electro"},
            { name: "Sigewine", image:"https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/sigewinne/image.png?strip=all&quality=100&w=140", element: "Hydro"},
            { name: "Emilie", image:"https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/emilie/image.png?strip=all&quality=100&w=140", element: "Dendro"},
            { name: "Mualani", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/mualani/image.png?strip=all&quality=100&w=140", element: "Hydro"},
            { name: "Kachina", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/kachina/image.png?strip=all&quality=100&w=140", element: "Geo"},
            { name: "Kinich", image: "https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/kinich/image.png?strip=all&quality=100&w=140", element: "Dendro"},
       
        ];

        const characterList = document.getElementById('characterList');
        const partyTeam = document.getElementById('partyTeam');
        const reactionsDisplay = document.getElementById('reactions');

        function createCharacterElement(character) {
            const div = document.createElement('div');
            div.className = 'character';
            div.innerHTML = `
                <img src="${character.image}" alt="${character.name}" onerror="this.src='/api/placeholder/80/80'">
                <p>${character.name}</p>
            `;
            div.onclick = () => addToParty(character);
            return div;
        }

        function addToParty(character) {
            if (partyTeam.children.length < 4) {
                const charElement = createCharacterElement(character);
                charElement.onclick = () => removeFromParty(charElement);
                partyTeam.appendChild(charElement);
                updateElementalReactions();
            } else {
                alert('Party is full! Remove a character before adding a new one.');
            }
        }

        function removeFromParty(element) {
            partyTeam.removeChild(element);
            updateElementalReactions();
        }

        function resetParty() {
            partyTeam.innerHTML = '';
            updateElementalReactions();
        }

        function updateElementalReactions() {
            const partyElements = Array.from(partyTeam.children).map(child => {
                const charName = child.querySelector('p').textContent;
                return characters.find(char => char.name === charName).element;
            });

            const reactions = calculateReactions(partyElements);
            reactionsDisplay.textContent = reactions.join(', ') || 'No reactions available with current party composition.';
        }

        function calculateReactions(elements) {
            const reactions = new Set();
            
            if (elements.includes('Pyro')) {
                if (elements.includes('Hydro')) reactions.add('Vaporize');
                if (elements.includes('Cryo')) reactions.add('Melt');
                if (elements.includes('Electro')) reactions.add('Overloaded');
                if (elements.includes('Dendro')) reactions.add('Burning');
                if (elements.includes('Geo')) reactions.add('Crystallize');
            }
            if (elements.includes('Hydro')) {
                if (elements.includes('Electro')) reactions.add('Electro-Charged');
                if (elements.includes('Cryo')) reactions.add('Freeze');
                if (elements.includes('Dendro')) reactions.add('Bloom');
                if (elements.includes('Geo')) reactions.add('Crystallize');
                if (elements.includes('Dendro') && elements.includes('Electro') ) {
                        reactions.add('Hyperbloom');
                    }
            }
            if (elements.includes('Electro')) {
                if (elements.includes('Cryo')) reactions.add('Superconduct');
                if (elements.includes('Dendro')) reactions.add('Quicken');
                if (elements.includes('Geo')) reactions.add('Crystallize');
                if (elements.includes('Hydro')) reactions.add('Electro-Charged');
                if (elements.includes('Dendro') && elements.includes('Hydro') ) {
                        reactions.add('Hyperbloom');
                    }
            }
            if (elements.includes('Anemo')) {
                if (elements.some(e => ['Pyro', 'Hydro', 'Electro', 'Cryo'].includes(e))) {
                    reactions.add('Swirl');
                }
            }
            if (elements.includes('Geo')) {
                if (elements.some(e => ['Pyro', 'Hydro', 'Electro', 'Cryo'].includes(e))) {
                    reactions.add('Crystallize');
                }
            }
            if (elements.includes('Cyro')) {
                if (elements.includes('Pyro')) reactions.add('Melt');
                if (elements.includes('Electro')) reactions.add('Superconduct');
                if (elements.includes('Hydro')) reactions.add('Freeze');
                if (elements.includes('Geo')) reactions.add('Crystallize');
            }
            if (elements.includes('Dendro')) {
                if (elements.includes('Electro')) reactions.add('Quicken');
                if (elements.includes('Pyro')) reactions.add('Burning');
                if (elements.includes('Hydro')) reactions.add('Bloom');
                if (elements.includes('Electro') && elements.includes('Hydro') ) {
                        reactions.add('Hyperbloom');
                    }
            }
            
            return Array.from(reactions);
        }

        characters.forEach(character => {
            characterList.appendChild(createCharacterElement(character));
        });

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>