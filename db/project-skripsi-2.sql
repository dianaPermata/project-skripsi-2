-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 04:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-skripsi-2`
--
CREATE DATABASE IF NOT EXISTS `project-skripsi-2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project-skripsi-2`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `penyakit_id` int(11) NOT NULL,
  `gejala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `penyakit_id`, `gejala_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21),
(22, 2, 22),
(23, 2, 23),
(24, 2, 24),
(25, 2, 25),
(26, 2, 26),
(27, 2, 27),
(28, 2, 28),
(29, 2, 29),
(30, 2, 30),
(31, 2, 31),
(32, 2, 32),
(33, 2, 33),
(34, 2, 3),
(35, 2, 4),
(36, 2, 8),
(37, 3, 34),
(38, 3, 35),
(39, 3, 36),
(40, 3, 37),
(41, 3, 38),
(42, 3, 39),
(43, 3, 40),
(44, 3, 41),
(45, 3, 42),
(46, 3, 10),
(47, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode`, `nama`) VALUES
(1, 'GP01', 'mengalami suasana hati yang terpuruk atau merasa sedih yang berlebihan'),
(2, 'GP02', 'mengalami insomnia atau tidur berlebihan '),
(3, 'GP03', 'mengalami penurunan atau peningkatan berat badan yang signifikan'),
(4, 'GP04', 'mengalami perubahan nafsu makan seperti tidak nafsu makan atau makan secara berlebihan '),
(5, 'GP05', 'kerap merasa rendah diri dan tidak berharga'),
(6, 'GP06', 'sering menyalahkan diri sendiri karena selalu memiliki rasa bersalah, dan merasa gagal'),
(7, 'GP07', 'sering menangis'),
(8, 'GP08', 'menarik diri dari lingkungan sekitar'),
(9, 'GP09', 'mengalami kehilangan minat melakukan aktivitas yang disukai'),
(10, 'GP10', 'kesulitan berpikir atau mengambil keputusan'),
(11, 'GP11', 'kehilangan semangat, motivasi, energi dan stamina yang hampir setiap hari'),
(12, 'GP12', 'selalu berpikir negatif secara terus menerus'),
(13, 'GP13', 'merasa hampa'),
(14, 'GP14', 'mudah marah dan tersinggung'),
(15, 'GP15', 'memiliki pikiran untuk bunuh diri atau menyakiti diri sendiri'),
(16, 'GP16', 'mengalami bicara dan gerak tubuh lebih lambat daripada biasanya'),
(17, 'GP17', 'mengalami kesulitan konsentrasi hampir setiap hari'),
(18, 'GP18', 'merasa gelisah atau khawatir'),
(19, 'GP19', 'mengalami nyeri otot'),
(20, 'GP20', 'gangguan pencernaan seperti mual, diare, atau sakit perut'),
(21, 'GP21', 'Mengalami sakit kepala atau migrain'),
(22, 'GP22', 'kesulitan tidur'),
(23, 'GP23', 'mengalami detak jantung terasa cepat dan tidak beraturan'),
(24, 'GP24', 'merokok atau mengonsumsi minuman beralkohol secara berlebihan'),
(25, 'GP25', 'mengalami kaki atau tangan dingin dan mengeluarkan keringat'),
(26, 'GP26', 'merasa gugup seperti menggigit kuku'),
(27, 'GP27', 'mengalami kesedihan dan menangis'),
(28, 'GP28', 'merasa punggung atau dada menjadi sakit'),
(29, 'GP29', 'mengalami pingsan'),
(30, 'GP30', 'mudah lupa'),
(31, 'GP31', 'mengalami frustasi'),
(32, 'GP32', 'mengalami kesulitan dalam berkonsentrasi'),
(33, 'GP33', 'mengalami lelah'),
(34, 'GP34', 'mengalami Halusinasi seperti mendengar, melihat, atau merasakan hal-hal yang sebenernya tidak ada'),
(35, 'GP35', 'kesulitan dalam mengorganisir pikiran sehingga menyebabkan percakapan sulit diikuti atau tidak masuk akal'),
(36, 'GP36', 'mengalami penurunan ekspresi emosi melalui ekpresi wajah, nada, suara atau gerakan'),
(37, 'GP37', 'mengalami delusi yaitu memiliki keyakinan yang kuat tetapi tidak berdasar pada kenyataan, seperti meyakini bahwa diri sendiri seperti nabi, meyakini diri sendiri seperti alien atau merasa diawasi oleh orang lain padahal pada kenyataan tidak seperti itu. '),
(38, 'GP38', 'apatis terhadap lingkungan sekitar. '),
(39, 'GP39', 'memiliki kecenderungan untuk berbicara sedikit atau menyampaikan sedikit substansi makna (poverty of content).'),
(40, 'GP40', 'merasa tidak ada kegembiraan atau kesenangan dari hidup atau aktivitas atau hubungan apapun (anhedonia)'),
(41, 'GP41', 'minat untuk melakukan interaksi sosial rendah/terbatas'),
(42, 'GP42', 'merasa berkurangnya motivasi untuk memulai dan mempertahankan aktivitas yang bertujuan,\r\nseperti kebersihan pribadi atau interaksi sosial\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `gejala_terpilih` text NOT NULL,
  `tanggal_konsultasi` date NOT NULL,
  `durasi_hubungan` int(11) NOT NULL,
  `penyebab_putus` text NOT NULL,
  `tanggal_putus` date DEFAULT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `userid`, `diagnosis`, `gejala_terpilih`, `tanggal_konsultasi`, `durasi_hubungan`, `penyebab_putus`, `tanggal_putus`, `solusi`) VALUES
(1, 1, 'Depresi', '1,2,3,6,7,13,14', '2024-07-09', 23, 'egois, selingkuh', '2024-07-09', ''),
(2, 1, 'Penyakit belum diketahui', '1,2,3,5,6,7,8,12,13,17,20', '2024-07-10', 12, 'egois', '2024-07-02', ''),
(3, 1, 'Depresi', '1,2,3,4,5,8,9,10,11,12,13,14', '2024-07-10', 12, 'egois', '2024-07-11', ''),
(4, 1, 'Depresi', '1,2,3,4,5,9,10,13,14,17', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-12', ''),
(5, 1, 'Depresi pasca putus cinta', '0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0', '2024-07-11', 20, 'Selingkuh, egois', '2024-06-30', ''),
(6, 1, 'Depresi pasca putus cinta', '1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0', '2024-07-11', 20, 'Selingkuh, egois', '2024-06-30', ''),
(7, 1, 'Depresi', '1,2,3,4,5,6,12', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-19', ''),
(8, 1, 'Depresi', '1,2,3,4,5,6,12', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-19', ''),
(9, 1, 'Stress', '3,4,18,19,20,21,29,30,31,33', '2024-07-11', 20, '30', '2024-07-12', ''),
(10, 1, 'Depresi', '1,2,3,4,5,7,8,9,10,11,12,13,14,15,16', '2024-07-11', 20, 'Selingkuh, egois', '2024-05-26', ''),
(11, 1, 'Depresi', '1,2,3,4,5,7,13', '2024-07-11', 20, 'egois', '2024-07-01', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. '),
(12, 1, 'Depresi', '1,2,3,4', '2024-07-11', 20, 'egois', '2024-07-05', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. , Kelola Stress dengan baik, Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit., Kelola stress dengan baik Tetap aktif secara sosial\r\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\r\n'),
(13, 1, 'Depresi', '1,2,3,4', '2024-07-11', 20, 'egois', '2024-06-30', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. , Kelola Stress dengan baik, Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit., Kelola stress dengan baik Tetap aktif secara sosial\r\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\r\n'),
(14, 1, 'Depresi', '1,2,3,4,5', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-26', ''),
(15, 1, 'Depresi', '1,2,3,4,5', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-26', ''),
(16, 1, 'Depresi', '1,2,3,5,7,9,10,11,12', '2024-07-11', 20, 'Selingkuh, egois', '2024-05-26', ''),
(17, 1, 'Depresi', '1,2,3,4', '2024-07-11', 20, 'Selingkuh, egois', '2024-07-03', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. \nKelola Stress dengan baik\nApabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\nKelola stress dengan baik Tetap aktif secara sosial\r\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\r\n'),
(18, 1, 'Depresi', '1,2,3,4', '2024-07-11', 20, 'egois', '2024-07-03', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. '),
(19, 1, 'Depresi', '1,2,3,4', '2024-07-11', 12, 'egois', '2024-06-30', ''),
(20, 1, 'Depresi', '1,2,3,4,5,6,7,8,9,10', '2024-07-12', 20, 'Selingkuh, egois', '2024-06-30', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. , Kelola Stress dengan baik, Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit., Kelola stress dengan baik Tetap aktif secara sosial\\r\\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\\r\\n'),
(21, 1, 'Depresi', '1,2,3,4,5,7,14,17', '2024-07-12', 20, 'Selingkuh, egois', '2024-07-01', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. , Kelola Stress dengan baik, Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit., Kelola stress dengan baik Tetap aktif secara sosial\\r\\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\\r\\n'),
(22, 1, 'Depresi', '1,2,3,4,5,7,11', '2024-07-12', 20, 'Selingkuh, egois', '2024-07-01', 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. , Kelola Stress dengan baik, Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit., Kelola stress dengan baik Tetap aktif secara sosial\\r\\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\\r\\n'),
(23, 1, 'Penyakit belum diketahui', '2,3,4,5,6,9,14,15,16,17,18,19,34,35,36,38,39,40,41,42', '2024-07-12', 20, 'Selingkuh, egois', '2024-07-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `kode`, `nama`, `deskripsi`) VALUES
(1, 'GM01', 'Depresi', 'Depresi adalah gangguan suasana hati (mood) yang ditandai dengan perasaan sedih yang mendalam dan kehilangan minat terhadap hal-hal yang disukai. Depresi bisa menyerang siapa saja, termasuk wanita dan pria.'),
(2, 'GM02', 'Stress', 'Stres adalah suatu bentuk tekanan fisik dan psikologis yang muncul saat menghadapi kondisi yang terasa berbahaya. Mudahnya, stress merupakan cara tubuh memberikan tanggapan atas ancaman, tekanan, dan tuntutan yang muncul. Saat merasakan adanya ancaman, sistem saraf akan memberikan respons dengan cara merilis aliran hormon kortisol dan adrenalin. Hormon - hormon ini bisa memicu munculnya reaksi pada tubuh, misalnya jantung yang berdetak lebih cepat, otot tubuh terasa menegang, napas memburu, dan tekanan darah yang mengalami peningkatan. '),
(3, 'GM03', 'Skizofernia', 'Skizofrenia adalah gangguan mental berat yang dapat memengaruhi tingkah laku, emosi, dan komunikasi. Pengidap gangguan kesehatan mental ini menunjukkan gejala psikosis, yaitu kesulitan membedakan antara kenyataan dengan pikiran pada diri sendiri.');

-- --------------------------------------------------------

--
-- Table structure for table `solusi`
--

CREATE TABLE `solusi` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `solusi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solusi`
--

INSERT INTO `solusi` (`id`, `kode`, `id_penyakit`, `solusi`) VALUES
(1, 'S01', 1, 'Untuk mencegah kekambuhan depresi dapat melakukan perawatan diri seperti : jaga kesehatan fisik dengan melakukan olahraga, makan makanan sehar, tidur yang cukup dan menghindari kebiasaan merokok atau mengonsumsi alkohol secara berlebihan. '),
(2, 'S02', 1, 'Kelola Stress dengan baik'),
(3, 'S03', 1, 'Apabila kesulitan dalam menghadapi perasaan atau merasa depresi yang berlebihan dan ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.'),
(4, 'S04', 1, 'Kelola stress dengan baik Tetap aktif secara sosial\r\nCari hobi dan aktivitas yang menyenangkan seperti membaca buku, melukis, atau berkebun.Batasi penggunaan sosial media, sebab terlalu banyak menghabiskan waktu di media sosial dapat menyebabkan perasaan tidak adanya dukungan dan tekanan untuk selalu membandingkan diri dengan orang lain.Jangan mengisolasi diri.Apabila kesulitan dalam menghadapi perasaan atau merasa depresi terlebih jika ada keinginan untuk mencelakai diri maupun orang lain. segera mencari bantuan professional yang nantinya psikologi akan melakukan psikoterapi atau terapis psikologis dan memberikan obat antidepresan untuk mengatasi depresi. Jika depresi parah akan menjalani perawatan di rumah sakit.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `usia` int(11) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password_user`, `usia`, `jenis_kelamin`) VALUES
(1, 'rara', 'rara@gmail.com', '$2y$10$h9ucQN7qD8Mz.xW0xxytqePq1xzGqum6f8ZfF.2M3BdF2tuoSYFpK', 18, 'Perempuan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyakit_id` (`penyakit_id`),
  ADD KEY `gejala_id` (`gejala_id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyakit_id` (`id_penyakit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `solusi`
--
ALTER TABLE `solusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`),
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`gejala_id`) REFERENCES `gejala` (`id`);

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `solusi`
--
ALTER TABLE `solusi`
  ADD CONSTRAINT `solusi_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
