-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 04:23 PM
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
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggaldibuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggaldibuat`, `userid`) VALUES
(18, 'Hewan', 'Hewan adalah organisme eukariotik multiseluler yang membentuk kerajaan biologi Animalia. Dengan sedikit pengecualian, hewan mengonsumsi bahan organik, menghirup oksigen, dapat bergerak, bereproduksi secara seksual, dan tumbuh dari bola sel yang berongga, blastula, selama fase perkembangan embrio.', '2024-02-13', 1),
(19, 'Pemandangan Alam', 'Pemandangan alam yang indah', '2024-02-13', 1),
(27, 'Pakaian Wanita', 'pakaian ya', '2024-02-13', 1),
(28, 'Bunga', 'Bunga', '2024-02-22', 1),
(29, 'makanan', 'makanan', '2024-02-22', 1),
(30, 'Walpaper', 'Walpaper', '2024-02-22', 1),
(31, 'Minuman', 'Minuman', '2024-02-22', 1),
(32, 'Buah', 'Buah-Buahan', '2024-02-23', 1),
(33, 'Elektronik', 'Hp, laptop, tv, kulkas dan barang elektronik lainnya', '2024-02-24', 1),
(34, 'Pakaian Cowo', 'barang barang cowo', '2024-02-24', 1),
(35, 'Buku', 'Buku - buku', '2024-02-24', 1),
(37, 'karakter', 'gambar orang', '2024-02-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dislikefoto`
--

CREATE TABLE `dislikefoto` (
  `dislikeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggaldislike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dislikefoto`
--

INSERT INTO `dislikefoto` (`dislikeid`, `fotoid`, `userid`, `tanggaldislike`) VALUES
(13, 28, 4, '2024-03-07'),
(56, 29, 1, '2024-03-15'),
(63, 35, 1, '2024-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(1, 'Leopard', 'mirip macan kan ', '2024-02-13', 'foto1707789504.jpg', 18, 1),
(3, 'Kura - Kura', 'Kura kura nya lagi berenang', '2024-02-13', 'foto1707789698.jpg', 18, 1),
(5, 'kuda putih', 'kuda putih', '2024-02-13', 'foto1707790091.jpg', 18, 1),
(6, 'Kucing', 'Daisiy Lucu Banget', '2024-02-13', 'foto1707790472.jpg', 18, 1),
(7, 'Lorong Hutan', 'Jalanan Hutan Yang Indah', '2024-02-13', 'foto1707790882.jpg', 30, 1),
(8, 'Matahari Terbit', 'Cantik banget Pemandangannya', '2024-02-13', 'foto1707790956.jpg', 19, 1),
(9, 'Koala ', 'Koalanya lagi bobo\r\n', '2024-02-15', 'foto1707962841.jpg', 18, 1),
(10, 'Bunga ', 'Taman bunga dekat danau', '2024-02-22', 'foto1708590843.jpg', 28, 1),
(11, 'Anggur', 'Anggur ungu dan anggur hijau', '2024-02-23', 'foto1708674812.jpg', 32, 1),
(13, 'Mawar biru', 'Bunga Mawar Biru', '2024-02-25', 'foto1708862091.jpg', 28, 1),
(14, 'Burung Kecil', 'Kayak Burung gereja\r\n', '2024-02-26', 'foto1709786544.jpg', 18, 1),
(15, 'Gunung ', 'Gunung salju\r\n', '2024-02-26', 'foto1708961059.jpg', 30, 1),
(16, 'Salju', 'Salju Putih', '2024-02-26', 'foto1708963790.jpg', 19, 5),
(17, 'lebah', 'Lebah madu\r\n', '2024-02-26', 'foto1708961529.jpg', 18, 5),
(18, 'strawberry fruit', 'Buah Strawberry', '2024-02-26', 'foto1708961646.jpg', 32, 5),
(19, 'Bunga Tulip', 'Bunga tulip kuning', '2024-02-26', 'foto1708961767.jpg', 28, 5),
(20, 'Kue', 'Kuenya pecah huuu', '2024-02-26', 'foto1708961940.jpg', 29, 5),
(21, 'Penampakan Alam', 'Cantik bangettt', '2024-02-26', 'foto1708962113.jpg', 19, 5),
(22, 'kuda coklat', 'kuda', '2024-02-26', 'foto1708962205.jpg', 18, 5),
(23, 'Butterfly', 'Kupu-kupu biru\r\n', '2024-02-26', 'foto1708962337.jpg', 18, 5),
(24, 'Cat', 'Kucing putih', '2024-02-26', 'foto1708962445.jpg', 18, 5),
(25, 'Pasir', 'Pasir di pantai bali\r\n', '2024-02-26', 'foto1708962543.jpg', 19, 5),
(27, 'Persahabatan', 'persahabatan dari kecil', '2024-02-26', 'foto1708962798.jpg', 37, 5),
(28, 'sad', 'Yahh ice cream nya jatuh', '2024-02-26', 'foto1708962891.jpg', 37, 5),
(29, 'Berolahraga', 'Yoga guys ', '2024-02-26', 'foto1708963020.jpg', 37, 5),
(30, 'Marriage', 'Pernikahan kita\r\n', '2024-02-26', 'foto1708963150.jpg', 37, 5),
(31, '2 Orang', 'hiksss', '2024-02-26', 'foto1708963248.jpg', 37, 5),
(32, 'Berries', 'buah rasberry dan bluberry\r\n', '2024-02-26', 'foto1708963384.jpg', 32, 5),
(33, 'bunga', 'bunga lucu', '2024-03-06', 'foto1709734418.jpg', 30, 1),
(34, 'Burung', 'Burung', '2024-03-07', 'foto1709780843.jpg', 18, 4),
(35, 'kuda coklat', 'kuda coklat\r\n', '2024-03-07', 'foto1709782035.jpg', 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`) VALUES
(85, 1, 1, 'kayak macan iyakan', '2024-02-13'),
(86, 9, 1, 'imut', '2024-02-15'),
(88, 7, 1, 'cantik', '2024-02-15'),
(89, 7, 1, 'lucu\r\n', '2024-02-22'),
(90, 7, 1, 'dh lh okey', '2024-02-22'),
(95, 8, 1, 'cantik', '2024-02-23'),
(96, 8, 1, 'beautiful', '2024-02-23'),
(97, 8, 1, 'indah', '2024-02-23'),
(99, 8, 1, 'lucuu', '2024-02-23'),
(100, 8, 1, 'jrengg', '2024-02-23'),
(101, 8, 1, 'kiyowo', '2024-02-23'),
(102, 8, 1, 'indah', '2024-02-23'),
(103, 8, 1, 'ih', '2024-02-23'),
(104, 8, 1, 'capekkk', '2024-02-23'),
(110, 6, 1, 'kucing lucu', '2024-02-24'),
(117, 8, 4, 'indah nya', '2024-02-26'),
(118, 10, 1, 'mawar pink', '2024-02-26'),
(119, 11, 1, 'pasti asem', '2024-02-26'),
(120, 11, 1, 'f', '2024-02-26'),
(121, 11, 1, 'g', '2024-02-26'),
(122, 11, 1, 'j', '2024-02-26'),
(126, 3, 1, 'w', '2024-02-26'),
(127, 3, 1, 'w', '2024-02-26'),
(128, 3, 1, 'w', '2024-02-26'),
(129, 3, 1, 'w', '2024-02-26'),
(130, 27, 1, 'ish ga malu', '2024-02-27'),
(131, 27, 1, 'cewe pun gitu', '2024-02-27'),
(132, 27, 1, 'apanya', '2024-02-27'),
(133, 27, 1, 'waw', '2024-02-27'),
(136, 24, 1, 'lucuu', '2024-02-27'),
(138, 16, 6, 'cantik banget ya', '2024-02-28'),
(139, 9, 6, 'memang koala tukang tidur wkwk', '2024-02-28'),
(140, 23, 6, 'cantik banget kupu-kupunya', '2024-02-28'),
(144, 3, 6, 'g', '2024-02-28'),
(145, 3, 6, 'p', '2024-02-28'),
(146, 9, 6, 'g', '2024-02-28'),
(147, 9, 6, ',', '2024-02-28'),
(148, 9, 6, ',', '2024-02-28'),
(149, 18, 1, 'ih enak nya', '2024-02-29'),
(151, 5, 1, 'ish ', '2024-02-29'),
(154, 32, 1, 'ihhh', '2024-03-01'),
(155, 32, 1, 'pasti asem', '2024-03-01'),
(159, 14, 1, 'ihhh', '2024-03-01'),
(165, 32, 1, 'kkkkkkkk', '2024-03-01'),
(166, 32, 1, 'lllllll', '2024-03-01'),
(168, 23, 1, 'iiiiiiiii', '2024-03-01'),
(169, 23, 1, 'o', '2024-03-01'),
(171, 6, 1, 'pasti asem', '2024-03-01'),
(172, 6, 1, 'l', '2024-03-01'),
(173, 6, 1, 'k', '2024-03-01'),
(174, 32, 1, 'ih', '2024-03-01'),
(176, 24, 1, 'a', '2024-03-01'),
(177, 24, 1, 'a', '2024-03-01'),
(178, 24, 1, 'a', '2024-03-01'),
(179, 24, 1, 'a', '2024-03-01'),
(180, 23, 1, 'ijjj', '2024-03-04'),
(184, 23, 1, 'cantik ya', '2024-03-04'),
(185, 11, 1, 'enak kali', '2024-03-04'),
(186, 28, 4, 'kasian banget wkwk', '2024-03-07'),
(187, 20, 4, 'enaknya', '2024-03-07'),
(188, 20, 4, 'wih', '2024-03-07'),
(189, 35, 1, 'ihhh', '2024-03-07'),
(190, 29, 1, 'ih', '2024-03-08'),
(191, 35, 1, 'bagus sketsa nya', '2024-03-11'),
(193, 29, 1, 'hihihihi', '2024-03-16'),
(194, 35, 1, 'hihihihi', '2024-03-16'),
(195, 19, 1, 'hihihi', '2024-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(219, 1, 1, '2024-02-13'),
(221, 8, 1, '2024-02-13'),
(224, 7, 1, '2024-02-13'),
(231, 6, 1, '2024-02-24'),
(233, 9, 1, '2024-02-25'),
(237, 10, 1, '2024-02-25'),
(238, 13, 1, '2024-02-26'),
(239, 13, 4, '2024-02-26'),
(240, 8, 4, '2024-02-26'),
(242, 11, 1, '2024-02-26'),
(243, 16, 5, '2024-02-26'),
(245, 27, 1, '2024-02-27'),
(246, 24, 1, '2024-02-27'),
(247, 32, 1, '2024-02-27'),
(248, 31, 1, '2024-02-27'),
(249, 16, 1, '2024-02-27'),
(250, 1, 6, '2024-02-28'),
(251, 10, 6, '2024-02-28'),
(252, 32, 6, '2024-02-28'),
(253, 16, 6, '2024-02-28'),
(254, 24, 6, '2024-02-28'),
(255, 9, 6, '2024-02-28'),
(256, 31, 6, '2024-02-28'),
(257, 23, 6, '2024-02-28'),
(258, 15, 6, '2024-02-28'),
(259, 8, 6, '2024-02-28'),
(261, 18, 1, '2024-02-29'),
(262, 5, 1, '2024-02-29'),
(263, 22, 1, '2024-02-29'),
(264, 21, 1, '2024-03-01'),
(265, 25, 1, '2024-03-01'),
(266, 17, 1, '2024-03-01'),
(267, 3, 1, '2024-03-01'),
(268, 23, 1, '2024-03-04'),
(278, 33, 1, '2024-03-07'),
(280, 33, 4, '2024-03-07'),
(360, 35, 4, '2024-03-11'),
(364, 14, 1, '2024-03-12'),
(367, 19, 5, '2024-03-15'),
(370, 19, 1, '2024-03-16'),
(371, 34, 4, '2024-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`) VALUES
(1, 'ibna', 'p', 'ibna@gmai.com', 'ibna aini', 'jalan'),
(4, 'bibah', '111', 'bibah@gmail.com', 'nurhabibah syahfitri', 'jalan'),
(5, 'kayla', 'sangwoosuamiku', 'kaylaputrimedan08@gmail.com', 'kayla putri', 'medan'),
(6, 'sindi', '111', 'Sindi@gmail.com', 'sindi amelia', 'jalan deo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `dislikefoto`
--
ALTER TABLE `dislikefoto`
  ADD PRIMARY KEY (`dislikeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `dislikefoto`
--
ALTER TABLE `dislikefoto`
  MODIFY `dislikeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dislikefoto`
--
ALTER TABLE `dislikefoto`
  ADD CONSTRAINT `dislikefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dislikefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
