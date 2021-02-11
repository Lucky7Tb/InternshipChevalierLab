-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2021 at 11:40 AM
-- Server version: 10.4.17-MariaDB-log
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheva_song`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) UNSIGNED NOT NULL,
  `user_friend_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `user_friend_id`) VALUES
(4, 11, 13),
(5, 13, 11),
(16, 11, 12),
(17, 12, 11);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) UNSIGNED NOT NULL,
  `song_name` varchar(100) DEFAULT NULL,
  `song_url` varchar(255) DEFAULT NULL,
  `song_is_recommended` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `user_id`, `song_name`, `song_url`, `song_is_recommended`, `created_at`, `updated_at`) VALUES
(1, 11, 'Eminem Monster', 'https://www.youtube.com/watch?v=EHkozMIXZ8w', 1, '2021-02-05 23:58:45', '2021-02-05 23:58:46'),
(2, 11, 'Eminem - Not Afraid', 'https://www.youtube.com/watch?v=j5-yKhDd64s', 0, '2021-02-05 18:11:22', '2021-02-06 09:03:55'),
(19, 13, 'Lagu1', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 0, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(20, 13, 'Lagu2', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 1, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(21, 13, 'Lagu3', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 1, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(22, 12, 'AkuLagu5', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 1, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(23, 12, 'AkuLagu1', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 0, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(24, 12, 'AkuLagu2', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 0, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(25, 12, 'AkuLagu3', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 0, '2021-02-11 04:19:25', '2021-02-11 04:19:25'),
(26, 12, 'AkuLagu4', 'https://www.youtube.com/watch?v=L-gKceeb61Q&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=12', 1, '2021-02-11 04:19:25', '2021-02-11 04:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_profile` varchar(80) DEFAULT NULL,
  `unique_id` varchar(8) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `photo_profile`, `unique_id`, `created_at`, `updated_at`) VALUES
(11, 'Lucky7Tb', '$2y$10$jgsNTN03gjUGbfqAlc.Kh.7kjilGzXX1Qz32JOVQEVjMRtSHd6Ukq', 'Giyuu.jpg', '#FkG6Lzq', '2021-02-05 16:31:23', '2021-02-11 10:25:43'),
(12, 'tes', '$2y$10$arWavjIFbe07qIutbwAXCeryucolq.E.trRv8jj6v7oQErjva12yK', 'avatar.png', '#GGGGGGG', '2021-02-06 10:43:39', '2021-02-06 10:43:40'),
(13, 'lucky tri', '$2y$10$arWavjIFbe07qIutbwAXCeryucolq.E.trRv8jj6v7oQErjva12yK', 'avatar.png', '#FkA6Lzq', '2021-02-05 16:31:23', '2021-02-05 16:31:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_FRIENDS_TO_USERS` (`user_id`) USING BTREE,
  ADD KEY `FK2_FRIENDS_TO_USERS` (`user_friend_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `FK2_FRIENDS_TO_USERS` FOREIGN KEY (`user_friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FRIENDS_TO_USERS` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `FK_SONG_TO_USERS` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
