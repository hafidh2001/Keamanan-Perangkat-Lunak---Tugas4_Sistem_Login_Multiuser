-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 10:22 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keamanan_perangkat_lunak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(5) NOT NULL,
  `id_user` int(8) NOT NULL,
  `time_log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `id_user`, `time_log`) VALUES
(7, 25, '2021-09-27 02:04:55'),
(8, 25, '2021-09-27 02:05:04'),
(9, 26, '2021-09-27 02:05:31'),
(10, 25, '2021-09-27 02:05:56'),
(11, 27, '2021-09-27 02:09:56'),
(12, 27, '2021-09-27 02:10:06'),
(13, 25, '2021-09-27 02:10:27'),
(14, 26, '2021-09-27 02:10:55'),
(15, 27, '2021-09-27 02:11:22'),
(16, 25, '2021-09-27 02:20:43'),
(17, 27, '2021-09-27 02:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reset_password`
--

CREATE TABLE `tb_reset_password` (
  `id` int(5) NOT NULL,
  `code` varchar(50) NOT NULL,
  `id_user` int(8) NOT NULL,
  `otp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','FREE','PREMIUM') NOT NULL,
  `verification` enum('YES','NO') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `email`, `password`, `level`, `verification`, `created_at`) VALUES
(14, 'admin2001', 'admin@gmail.com', '$2y$10$2kONkgDlxQGFAcl9Pro5kO157043YTgolAikHTWWFPmwOwGX062Hm', 'ADMIN', 'YES', '2021-09-26 18:34:49'),
(15, 'elon.musk092', 'elon.musk@gmail.com', '$2y$10$DV/P.BrX6kJuwZNt.v6tYe9K/iY8qz4RrAOpSBQALPiL9W7RNCZ96', 'FREE', 'NO', '2021-09-26 18:36:23'),
(16, 'jack.ma17912', 'jack.ma@gmail.com', '$2y$10$Xh2HTXn0yttPF5f.9iUvBeLh3uSU1azxRjgPpuqTwf.jOMJwr.BLq', 'FREE', 'NO', '2021-09-26 18:37:32'),
(17, 'steve.jobs7282', 'steve.jobs@gmail.com', '$2y$10$x.6QBM.0L06bECMr78.c2emqgxTYbDV7ULppVXfot5F7rBmT3Eycm', 'FREE', 'NO', '2021-09-26 18:38:23'),
(18, 'mark.zuckerberg76123', 'mark.zuckerberg@gmail.com', '$2y$10$xzkPbNT4rDu00eIofWerMO98CRoSYbgYSHpHvEUJSWI9l8z6YHGFe', 'FREE', 'NO', '2021-09-26 18:39:52'),
(19, 'jeff.bezos7676', 'jeff.bezos@gmail.com', '$2y$10$vlM8cZ1l4pp7P37gwOSKz.yhxAP6soewxCqhH.BG4GlQUzMysPmqa', 'FREE', 'NO', '2021-09-26 18:40:46'),
(20, 'bill.gates8890', 'bill.gates@gmail.com', '$2y$10$FMXFwc8xkctxDd/BtkzDj.LP/mQNc6Sw5DiDdTTG1a8RjBTAmeXS6', 'FREE', 'NO', '2021-09-26 18:42:10'),
(21, 'kenneth.thompson5525', 'kenneth.thompson@gmail.com', '$2y$10$bPtkDjxAREwbMdtkARb1v.ZhVUp2WKIi9r0VpmpMDHkmfQg9l098S', 'FREE', 'NO', '2021-09-26 18:43:20'),
(22, 'tim.berners_lee7612', 'tim.berners_lee@gmail.com', '$2y$10$l3jwuRW5pdYS20WJrJ8Fd.PbRR1CYgjE0thoTe4D0v1qHqz2FFk52', 'FREE', 'NO', '2021-09-26 18:44:44'),
(23, 'martin.cooper6785', 'martin.cooper@gmail.com', '$2y$10$n4Srs5t3o5ki/QJN.1s0gegOJukfpEemamJ0t8zHjfo6R1DJ97ige', 'FREE', 'NO', '2021-09-26 18:46:54'),
(24, 'norman.abramson5465', 'norman.abramson@gmail.com', '$2y$10$p.VYHC3.tajaXJW/WaHtDOqG4MNeLuwEYzA9OBuWbhXeSg8Pu8QGK', 'FREE', 'NO', '2021-09-26 18:48:04'),
(25, 'fauzan2001', 'fauzan@gmail.com', '$2y$10$jjbyZksy2VYpNv2G3J2osuhS/mSOXs1Sgtv9WZV17cu5hOleV4iWe', 'PREMIUM', 'YES', '2021-09-26 18:50:09'),
(26, 'ahmad2001', 'ahmad@gmail.com', '$2y$10$/Uy4ZZ0RLvJ6xmiHZISxUOpabu0P.1q8iPhmVg/ardUzMeOC2fgsi', 'FREE', 'YES', '2021-09-26 18:50:09'),
(27, 'hafidh2001', 'hafidhfauzan2@gmail.com', '$2y$10$tioCxCd0wZ0uKVZeEzXkye9Jr7PV/9PoDmBXVq8lUv4DJvHMdxoSW', 'FREE', 'YES', '2021-09-26 20:22:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD CONSTRAINT `log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  ADD CONSTRAINT `reset_password` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
