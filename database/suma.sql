-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suma`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `bidang` varchar(128) NOT NULL,
  `turunan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `bidang`, `turunan`) VALUES
(1, 'Kepala Biro Pemerintahan & Otonomi Daerah', 'Utama', '-'),
(2, 'Kepala Bagian Pemerintahan', 'Pemerintahan', 'Kepala Utama'),
(3, 'Kepala Bagian Otonomi Daerah', 'Otonomi Daerah', 'Kepala Utama'),
(4, 'Kepala Bagian Kerja Sama', 'Kerja Sama', 'Kepala Utama'),
(5, 'Kepala Sub Bagian Administrasi Pemerintahan dan Fasilitas Penataan Wilayah', 'Pemerintahan', 'Kepala Bagian Pemerintahan'),
(6, 'Kepala Sub Bagian Pemerintahan Umum', 'Pemerintahan', 'Kepala Bagian Pemerintahan'),
(7, 'Kepala Sub Bagian Tata Usaha', 'Pemerintahan', 'Kepala Bagian Pemerintahan'),
(8, 'Staff Administrasi Pemerintahan dan Fasilitas Penataan Wilayah', 'Pemerintahan', 'Kepala Sub Bagian Administrasi Pemerintahan dan Fasilitas Penataan Wilayah'),
(9, 'Staff Pemerintahan Umum', 'Pemerintahan', 'Kepala Sub Bagian Pemerintahan Umum'),
(10, 'Staff Tata Usaha', 'Pemerintahan', 'Kepala Sub Bagian Tata Usaha'),
(11, 'Admin Aplikasi', 'Kelola Aplikasi', '-'),
(12, 'Kepala Sub Bagian Administrasi Kepala Daerah dan DPRD', 'Otonomi Daerah', 'Kepala Bagian Otonomi Daerah'),
(13, 'Kepala Sub Bagian Pengembangan Otonomi Daerah dan Penataan Urusan', 'Otonomi Daerah', 'Kepala Bagian Otonomi Daerah'),
(14, 'Kepala Sub Bagian Evaluasi dan Penyelenggaraan Pemerintahan', 'Otonomi Daerah', 'Kepala Bagian Otonomi Daerah'),
(15, 'Kepala Sub Bagian Kerja Sama Antar Pemerintah', 'Kerja Sama', 'Kepala Bagian Kerja Sama'),
(16, 'Kepala Sub Bagian Kerja Sama Badan Usaha/Swasta', 'Kerja Sama', 'Kepala Bagian Kerja Sama'),
(17, 'Kepala Sub Bagian Evaluasi Pelaksanaan Kerja Sama', 'Kerja Sama', 'Kepala Bagian Kerja Sama'),
(18, 'Staff Administrasi Kepala Daerah dan DPRD', 'Otonomi Daerah', 'Kepala Sub Bagian Administrasi Kepala Daerah dan DPRD'),
(19, 'Staff Pengembangan Otonomi Daerah dan Penataan Urusan', 'Otonomi Daerah', 'Kepala Sub Bagian Pengembangan Otonomi Daerah dan Penataan Urusan'),
(20, 'Staff Evaluasi dan Penyelenggaraan Pemerintahan', 'Otonomi Daerah', 'Kepala Sub Bagian Evaluasi dan Penyelenggaraan Pemerintahan'),
(21, 'Staff Kerja Sama Antar Pemerintah', 'Kerja Sama', 'Kepala Sub Bagian Kerja Sama Antar Pemerintah'),
(22, 'Staff Kerja Sama Badan Usaha/Swasta', 'Kerja Sama', 'Kepala Sub Bagian Kerja Sama Badan Usaha/Swasta'),
(23, 'Staff Evaluasi Pelaksanaan Kerja Sama', 'Kerja Sama', 'Kepala Sub Bagian Evaluasi Pelaksanaan Kerja Sama');

-- --------------------------------------------------------

--
-- Table structure for table `penerima_surat`
--

CREATE TABLE `penerima_surat` (
  `id` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `penerima` varchar(123) NOT NULL,
  `tanggalDiterima` date NOT NULL,
  `keterangan` text NOT NULL,
  `statusSurat` enum('Belum Dibaca','Sudah Dibaca','Sudah Diterima','Di Teruskan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerima_surat`
--

INSERT INTO `penerima_surat` (`id`, `id_surat`, `penerima`, `tanggalDiterima`, `keterangan`, `statusSurat`) VALUES
(1, 1, 'Kepala Utama', '2023-07-22', 'Mohon dihadiri', 'Di Teruskan'),
(2, 2, 'Kepala Utama', '2023-07-22', 'Mohon dihadiri pak', 'Di Teruskan'),
(3, 3, 'Kepala Utama', '2023-07-22', 'Mohon dihadiri pak', 'Di Teruskan'),
(4, 2, 'Kepala Bagian Kerja Sama', '2023-07-22', 'Di hadiri pak', 'Di Teruskan'),
(5, 3, 'Kepala Bagian Pemerintahan', '2023-07-22', 'Di hadiri pak', 'Di Teruskan'),
(6, 3, 'Kepala Bagian Otonomi Daerah', '2023-07-22', '', 'Belum Dibaca'),
(7, 2, 'Kepala Sub Bagian Kerja Sama Badan Usaha/Swasta', '2023-07-22', '', 'Belum Dibaca'),
(8, 2, 'Kepala Sub Bagian Evaluasi Pelaksanaan Kerja Sama', '2023-07-22', '', 'Belum Dibaca'),
(9, 3, 'Kepala Sub Bagian Administrasi Pemerintahan dan Fasilitas Penataan Wilayah', '2023-07-22', 'Mohon di hadiri ', 'Di Teruskan'),
(10, 3, 'Kepala Sub Bagian Pemerintahan Umum', '2023-07-22', '', 'Belum Dibaca'),
(11, 3, 'Abd. Samad H. Sampow, S.Sos', '2023-07-22', '', 'Belum Dibaca'),
(12, 3, 'Miftahul Ihsan, S.Sos., M.AP', '2023-07-22', '', 'Belum Dibaca'),
(13, 1, 'Kepala Bagian Pemerintahan', '2023-07-25', '', 'Belum Dibaca'),
(14, 4, 'Kepala Biro Pemerintahan & Otonomi Daerah', '2023-07-25', '', 'Di Teruskan'),
(15, 4, 'Kepala Bagian Pemerintahan', '2023-07-25', '', 'Belum Dibaca'),
(16, 4, 'Kepala Bagian Otonomi Daerah', '2023-07-25', '', 'Belum Dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `nomorSurat` varchar(128) NOT NULL,
  `pengirim` varchar(128) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `Keterangan` text NOT NULL,
  `file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `nomorSurat`, `pengirim`, `perihal`, `Keterangan`, `file`) VALUES
(1, '100.1.7/2157/Ro.Pem.Otda', 'Sekretariat Daerah', 'Ralat Undangan Rapat', 'Mohon di hadiri', 'ralat undangan rapat 10 juli 2023.pdf'),
(2, 'A-063/APPSU/VII/2023', 'Asosiasi Pemerintah Provinsi Seluruh Indonesia', 'Undangan menghadiri acara Pengukuhan Pengurus Aosiasi Diskominfo Provinsi Seluruh Indoneisa (ASKOMPSI)', 'Mohon dihadiri', 'Undangan Pengukuhan Pengurus ASKOMPSI.pdf'),
(3, '005/23.93/BID.IV', 'BAPPEDA', 'Undangan', 'Mohon dihadiri', 'Undangan Ranperkada P-RKPD Prov Sulteng .pdf'),
(4, '12354678', 'Sekretariat Daerah', 'Aslo', 'Mohon dihadiri', 'Undangan Ranperkada P-RKPD Prov Sulteng .pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `level` enum('Admin','Kepala Utama','Kepala Bagian','Kepala Sub Bagian','Staff') NOT NULL,
  `status` enum('Active','Block') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `id_jabatan`, `level`, `status`) VALUES
(1, 'admin', 'admin123', 'Admin Aplikasi Surat Masuk', 11, 'Admin', 'Active'),
(3, 'dahri', 'dahri', 'Drs. Dahri Saleh, M.Si', 1, 'Kepala Utama', 'Active'),
(4, 'dody', 'dody', 'Dody Setiawan, S.Stp., M.AP', 2, 'Kepala Bagian', 'Active'),
(5, 'dina', 'dina', 'Dina Mariany Mustaqim, S.STP., M.Si', 3, 'Kepala Bagian', 'Active'),
(6, 'azir', 'azir', 'Mohammad Azir, S.STP., M.Si', 4, 'Kepala Bagian', 'Active'),
(7, 'rizal', 'rizal', 'Muhammad Rizal, SE., MT', 5, 'Kepala Sub Bagian', 'Active'),
(8, 'hasna', 'hasna', 'Hasna Elam, S.Sos., M.AP', 6, 'Kepala Sub Bagian', 'Active'),
(9, 'uhrawi', 'uhrawi', 'Uhrawi, S.Kom., M.M', 7, 'Kepala Sub Bagian', 'Active'),
(10, 'rahmawaty', 'rahmawaty', 'Rahmawaty, SE., M.AP', 12, 'Kepala Sub Bagian', 'Active'),
(11, 'olivia', 'olivia', 'A. Olvia Surya Sandi, SP., M.Si', 13, 'Kepala Sub Bagian', 'Active'),
(12, 'ridwan', 'ridwan', 'Ridwan Abd. Rahim, S.STP', 14, 'Kepala Sub Bagian', 'Active'),
(13, 'irfan', 'irfan', 'Muhammad Irfan, S.Sos., M.Si', 15, 'Kepala Sub Bagian', 'Active'),
(14, 'sellywati', 'sellywati', 'Sellyawati, S.Sos', 16, 'Kepala Sub Bagian', 'Active'),
(15, 'dahlia', 'dahlia', 'Dahlia Nurdin, SH., M.Si', 17, 'Kepala Sub Bagian', 'Active'),
(16, 'samad', 'samad', 'Abd. Samad H. Sampow, S.Sos', 8, 'Staff', 'Active'),
(17, 'miftahul', 'miftahul', 'Miftahul Ihsan, S.Sos., M.AP', 8, 'Staff', 'Active'),
(18, 'siti', 'siti', 'Siti Husnah, SH., MM', 8, 'Staff', 'Active'),
(19, 'sucianti', 'sucianti', 'Sucianti, S.Sos', 8, 'Staff', 'Active'),
(20, 'reza', 'reza', 'Muh. Reza Mattemmu, S.ST', 8, 'Staff', 'Active'),
(21, 'firmansyah', 'firmansyah', 'Moh. Firmansyah Putra Kamaru, S.P.W.K', 8, 'Staff', 'Active'),
(22, 'ardi', 'ardi', 'Ardi, S.Hut', 8, 'Staff', 'Active'),
(23, 'junaidi', 'junaidi', 'Junaidi, S.Sos., M.AP', 9, 'Staff', 'Active'),
(24, 'desje', 'desje', 'Desje Mosey, SE', 9, 'Staff', 'Active'),
(25, 'arief', 'arief', 'Mohamad Arief Pratama, SH', 9, 'Staff', 'Active'),
(26, 'lis', 'lis', 'Lis Susanti, SH', 9, 'Staff', 'Active'),
(27, 'raihan', 'raihan', 'Raihan Dirga Putra Lamadjido', 9, 'Staff', 'Active'),
(28, 'rahmi', 'rahmi', 'Rahmi Talib A. Abbas, S.Pt., M.M', 10, 'Staff', 'Active'),
(29, 'muis', 'muis', 'Abd. Muis S. Rasul., SP', 10, 'Staff', 'Active'),
(30, 'sri', 'sri', 'Sri Agustina Rahim, SE', 10, 'Staff', 'Active'),
(31, 'fahri', 'fahri', 'Moh. Fahri Djafar. DM, SH', 10, 'Staff', 'Active'),
(32, 'murtin', 'murtin', 'Murtin, S.AP', 10, 'Staff', 'Active'),
(33, 'rahmat', 'rahmat', 'Rahmat, S.Sos', 10, 'Staff', 'Active'),
(34, 'supriono', 'supriono', 'Supriono, SH', 10, 'Staff', 'Active'),
(35, 'rivaldi', 'rivaldi', 'Rivaldi Vikriansyah, S.Pd', 10, 'Staff', 'Active'),
(36, 'marief', 'marief', 'Mohamad Arief, S.IP', 10, 'Staff', 'Active'),
(37, 'andri', 'andri', 'Andri, S.Kom', 10, 'Staff', 'Active'),
(38, 'fahrun', 'fahrun', 'Farhun Safrudin, S.IP', 10, 'Staff', 'Active'),
(39, 'yuliana', 'yuliana', 'Yuliana', 10, 'Staff', 'Active'),
(40, 'munifah', 'munifah', 'Munifah Putri Dianisari Ridwan Lamadjido', 10, 'Staff', 'Active'),
(41, 'fata', 'fara', 'Fara Aisyali', 10, 'Staff', 'Active'),
(42, 'ade', 'ade', 'Ade Amalia Arfan', 10, 'Staff', 'Active'),
(43, 'sevthin', 'sevthin', 'Sevthin Sriyunita, S.Sos', 18, 'Staff', 'Active'),
(44, 'noni', 'noni', 'Noni Dekater', 18, 'Staff', 'Active'),
(45, 'faradilah', 'faradilah', 'Faradilah, SE', 18, 'Staff', 'Active'),
(46, 'gede', 'gede', 'I Gede Susliyanto', 18, 'Staff', 'Active'),
(47, 'abdul', 'abdul', 'Abdul Aziz, SH', 19, 'Staff', 'Active'),
(48, 'amirudin', 'amirudin', 'Amirudin, S.Sos', 19, 'Staff', 'Active'),
(49, 'fidya', 'fidya', 'Fidya Kumaira, S.IP', 19, 'Staff', 'Active'),
(50, 'rizki', 'rizki', 'Muhamad Rizki Gunawan', 19, 'Staff', 'Active'),
(51, 'andi', 'andi', 'Andi Susitiarti Kemaladewi, S.IP', 19, 'Staff', 'Active'),
(52, 'leonardo', 'leonardo', 'Leonardo I. F. Siombo, S.STP', 20, 'Staff', 'Active'),
(53, 'maloto', 'maloto', 'Daeng Maloto', 20, 'Staff', 'Active'),
(54, 'riand', 'riand', 'Moh. Riand Muaz, SH', 20, 'Staff', 'Active'),
(55, 'jannah', 'jannah', 'Miftahul Jannah, SH', 20, 'Staff', 'Active'),
(56, 'tanzil', 'tanzil', 'Tanzil Nur Agus, S.STP', 21, 'Staff', 'Active'),
(57, 'sartika', 'sartika', 'Sartika, A.Md', 21, 'Staff', 'Active'),
(58, 'mansur', 'mansur', 'Andi Mansur Tombolotutu', 21, 'Staff', 'Active'),
(59, 'irsan', 'irsan', 'Irsan, SE', 21, 'Staff', 'Active'),
(60, 'ridwan2', 'ridwan2', 'Ridwan, ST', 21, 'Staff', 'Active'),
(61, 'mariam', 'mariam', 'Mariam, SP', 22, 'Staff', 'Active'),
(62, 'fitry', 'fitry', 'Fitry Wahyuni, SP', 22, 'Staff', 'Active'),
(63, 'annisa', 'annisa', 'Nur Annisa Haerun Sompah', 22, 'Staff', 'Active'),
(64, 'yusuf', 'yusuf', 'Nuralim Yusuf, S.Ak', 22, 'Staff', 'Active'),
(65, 'sufiati', 'sufiati', 'Sufiati, A.Md. Far., SH', 23, 'Staff', 'Active'),
(66, 'dwi', 'dwi', 'Dwi Oktafiani Pratiwi, S.I.Kom', 23, 'Staff', 'Active'),
(67, 'iftita', 'iftita', 'Iftita Anugraini Akasi', 23, 'Staff', 'Active'),
(68, 'mulyadin', 'mulyadin', 'Mulyadin', 23, 'Staff', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerima_surat`
--
ALTER TABLE `penerima_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penerima_surat`
--
ALTER TABLE `penerima_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penerima_surat`
--
ALTER TABLE `penerima_surat`
  ADD CONSTRAINT `penerima_surat_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
