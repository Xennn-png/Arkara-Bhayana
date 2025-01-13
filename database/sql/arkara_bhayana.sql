-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 03:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arkara_bhayana`
--

-- --------------------------------------------------------

--
-- Table structure for table `artifacts`
--

CREATE TABLE `artifacts` (
  `id` int(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `rarity` int(255) NOT NULL,
  `2p` varchar(255) NOT NULL,
  `4p` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artifacts`
--

INSERT INTO `artifacts` (`id`, `game`, `gambar`, `nama`, `rarity`, `2p`, `4p`) VALUES
(1, 'Genshin Impact', 'adventurer.png', 'Adventurer', 1, 'Max HP increased by 1,000.', 'Opening chest regenerates 30% Max HP over 5s.');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `va` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL,
  `element` varchar(255) NOT NULL,
  `region` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `game`, `gambar`, `nama`, `va`, `deskripsi`, `element`, `region`) VALUES
(1, 'Genshin Impact', 'https://act-webstatic.hoyoverse.com/upload/contentweb/2022/07/22/b51565c6f1298e534e90b6e63332e9c1_4240077663550682265.png', 'Jean', 'SUOKA Yoshitsugu (JP)', 'Jean Gunnhildr adalah karakter Anemo yang dapat dimainkan di Genshin Impact. Kakak perempuan Barbara , dan keturunan Klan Gunnhildr yang bergengsi , Jean adalah Penjabat Grand Master dari Knights of Favonius . Dia selalu sibuk menangani kerusuhan di Mondstadt dan bekerja tanpa lelah untuk menjaga Kota Kebebasan.', 'Anemo', 'Mondstadt'),
(2, 'Genshin Impact', 'https://act-webstatic.hoyoverse.com/upload/contentweb/2022/07/22/930f3ce55517e3c711a962c82e4639c0_8691377287489555826.png', 'Xiao', 'SUOKA Yoshitsugu (JP)', 'Xiao is the last remaining member of the Yakshas, an ancient group of Adepti tasked with protecting Liyue from demonic forces. His Anemo vision grants him swift and deadly combat abilities.', 'Anemo', 'Liyue'),
(3, 'Genshin Impact', 'https://act-webstatic.hoyoverse.com/upload/contentweb/2022/07/22/fdcbc9ef8859b7077d92ae38d925e15e_4430297517104014075.png', 'Raiden Shogun', 'SUOKA Yoshitsugu (JP)', 'Raiden Shogun, also known as the Electro Archon, governs Inazuma in pursuit of eternity. Her immense power controls the region and the storms surrounding it.', 'Electro', 'Inazuma'),
(4, 'Genshin Impact', 'https://act-webstatic.hoyoverse.com/upload/contentweb/2022/10/26/fe684624008db25ac4b44ea4704f9ba0_3756826627935711351.png', 'Nahida', 'SUOKA Yoshitsugu (JP)', 'Nahida, also known as Lesser Lord Kusanali, is the current Dendro Archon. Despite her young appearance, she is wise and revered in Sumeru for her deep connection to knowledge.', 'Dendro', 'Sumeru'),
(5, 'Genshin Impact', 'https://webstatic.hoyoverse.com/upload/op-public/2023/09/14/a542b56a05524520a116d57372fa6d3c_208786747272956585.png', 'Neuvillette', 'SUOKA Yoshitsugu (JP)', 'Neuvillette, the Chief Justice of Fontaine, is known for his impartiality and dedication to the law. His Hydro vision represents his deep connection to the waters of Fontaine.', 'Hydro', 'Fontaine'),
(6, 'Genshin Impact', 'https://webstatic.hoyoverse.com/upload/op-public/2023/01/09/1f3bc8199884ff93a04e713809e4aef3_3593570822868469375.png', 'Iansan', 'SUOKA Yoshitsugu (JP)', 'Iansan is a young girl from Natlan, known for her fiery personality. She uses her Pyro vision to showcase her passion in both battle and everyday life.', 'Dendro', 'Natlan');

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` int(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elements`
--

INSERT INTO `elements` (`id`, `game`, `gambar`, `nama`, `deskripsi`, `type`) VALUES
(1, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_pyro.png', 'Pyro', 'Elemen Pyro dikenal dengan kekuatan api yang menghancurkan. Karakter Pyro sering memiliki serangan area yang kuat dan dapat membakar musuh.', 'Api'),
(2, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_hydro.png', 'Hydro', 'Elemen Hydro menggunakan kekuatan air. Karakter Hydro biasanya memiliki kemampuan penyembuhan dan kontrol massa yang baik.', 'Air'),
(3, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_anemo.png', 'Anemo', 'Elemen Anemo memanipulasi angin. Karakter Anemo sering memiliki mobilitas tinggi dan kemampuan untuk menggabungkan elemen lain.', 'Angin'),
(4, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_electro.png', 'Electro', 'Elemen Electro menggunakan kekuatan listrik. Karakter Electro biasanya memiliki serangan cepat dan kemampuan untuk menghasilkan energi partikel.', 'Petir'),
(5, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_dendro.png', 'Dendro', 'Elemen Dendro berhubungan dengan tumbuhan. Karakter Dendro memiliki kemampuan untuk menciptakan reaksi unik dengan elemen lain.', 'Tumbuhan'),
(6, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_cryo.png', 'Cryo', 'Elemen Cryo menggunakan kekuatan es. Karakter Cryo sering memiliki kemampuan untuk membekukan musuh dan mengurangi kecepatan mereka.', 'Es'),
(7, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_geo.png', 'Geo', 'Elemen Geo berhubungan dengan batu dan tanah. Karakter Geo biasanya memiliki pertahanan yang kuat dan kemampuan untuk menciptakan konstruksi.\r\n\r\n', 'Tanah');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `nama`, `logo`, `banner`) VALUES
(2, 'Genshin Impact', 'genshin.jpg', 'banner-1.webp, banner-2.webp, banner-3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `resonansis`
--

CREATE TABLE `resonansis` (
  `id` int(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resonansis`
--

INSERT INTO `resonansis` (`id`, `game`, `gambar`, `nama`, `deskripsi`, `type`) VALUES
(1, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_pyro.png, https://rerollcdn.com/GENSHIN/UI/element_pyro.png', 'Fervent Flames', 'Meningkatkan serangan sebesar 25%. Mengurangi waktu yang dibutuhkan untuk terkena efek Cryo sebesar 40%.', 'Pyro'),
(2, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_hydro.png, https://rerollcdn.com/GENSHIN/UI/element_hydro.png', 'Soothing Water', 'Meningkatkan HP maksimum sebesar 25%. Meningkatkan efektivitas penyembuhan sebesar 30%.', 'Hydro'),
(3, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_anemo.png, https://rerollcdn.com/GENSHIN/UI/element_anemo.png', 'Impetuous Winds', 'Mengurangi konsumsi Stamina sebesar 15%. Meningkatkan kecepatan gerakan sebesar 10%. Mengurangi waktu cooldown skill sebesar 5%.', 'Anemo'),
(4, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_electro.png, https://rerollcdn.com/GENSHIN/UI/element_electro.png', 'High Voltage', 'Reaksi Electro-Charged, Superconduct, dan Overloaded menghasilkan partikel Elemental tambahan. Memiliki kesempatan 100% untuk menghasilkan partikel tambahan setiap 5 detik.', 'Electro'),
(5, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_dendro.png, https://rerollcdn.com/GENSHIN/UI/element_dendro.png', 'Sprawling Greenery', 'Meningkatkan Elemental Mastery sebesar 50. Setelah memicu reaksi Dendro, semua anggota tim mendapatkan 30 Elemental Mastery tambahan selama 6 detik.', 'Dendro'),
(6, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_cryo.png, https://rerollcdn.com/GENSHIN/UI/element_cryo.png', 'Shattering Ice', 'Meningkatkan CRIT Rate sebesar 15% terhadap musuh yang terkena efek Cryo atau Frozen.', 'Cryo'),
(7, 'Genshin Impact', 'https://rerollcdn.com/GENSHIN/UI/element_geo.png, https://rerollcdn.com/GENSHIN/UI/element_geo.png', 'Enduring Rock', 'Meningkatkan ketahanan terhadap gangguan sebesar 40%. Serangan yang dilindungi oleh perisai meningkatkan kekuatan serangan sebesar 15%.', 'Geo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(221) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `profile_picture`, `bio`) VALUES
(1, 'Fashich', 'fashich@gmail.com', 'fashich123', 'admin', NULL, NULL),
(3, 'Yan Gans', 'yandex@gmail.com', 'yan12345', 'member', NULL, NULL),
(9, 'nabila', 'nabila.23204@mhs.unesa.ac.id', 'nabila123', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE `weapons` (
  `id` int(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rarity` int(255) NOT NULL,
  `attack` int(255) NOT NULL,
  `secondary` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`id`, `game`, `gambar`, `nama`, `type`, `rarity`, `attack`, `secondary`, `status`) VALUES
(1, 'Genshin Impact', 'A Thousand Floating Dreams.png', 'A Thousand Floating Dreams', 'catalyst', 5, 542, 'Elemental Mastery', 'Wish');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artifacts`
--
ALTER TABLE `artifacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resonansis`
--
ALTER TABLE `resonansis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artifacts`
--
ALTER TABLE `artifacts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resonansis`
--
ALTER TABLE `resonansis`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
