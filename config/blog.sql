-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 02:40 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`) VALUES
(1, 'Business', 1),
(2, 'Technology', 1),
(4, 'Entertainment', 1),
(5, 'Sport', 0);

-- --------------------------------------------------------

--
-- Table structure for table `count_views`
--

CREATE TABLE `count_views` (
  `post_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `view_per_month` int(11) NOT NULL,
  `total_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `count_views`
--

INSERT INTO `count_views` (`post_id`, `month`, `year`, `view_per_month`, `total_views`) VALUES
(15, 11, 2019, 1, 1),
(19, 11, 2019, 3, 3),
(22, 11, 2019, 2, 2),
(23, 11, 2019, 1, 1),
(20, 11, 2019, 1, 1),
(24, 11, 2019, 4, 4),
(14, 11, 2019, 2, 2),
(11, 2, 2018, 1, 1),
(12, 11, 2019, 1, 1),
(13, 11, 2019, 1, 1),
(16, 11, 2019, 2, 2),
(21, 11, 2019, 1, 1),
(25, 11, 2019, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `content`, `category_id`, `user_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(11, 'post 1', 'this is post number 1                  \r\n                \r\n                \r\n                \r\n                \r\n             ', 1, 4, 0, '2019-11-10 20:49:28', '2019-11-11 04:05:55'),
(12, 'post 2', 'this is post number 2                  \r\n                \r\n             ', 1, 4, 0, '2019-11-10 20:49:42', '2019-11-10 20:50:03'),
(13, 'post 3', 'this is post number 3                  \r\n                \r\n                \r\n             ', 2, 4, 0, '2019-11-10 20:49:54', '2019-11-10 21:03:56'),
(14, 'post 4', 'post number 4\r\n                \r\n             ', 1, 4, 0, '2019-11-10 21:04:23', '2019-11-10 21:04:28'),
(15, 'post 5', 'post number 5\r\n                  \r\n                \r\n             ', 1, 4, 0, '2019-11-10 23:05:28', '2019-11-10 23:05:45'),
(16, 'post 6', 'thiss is post number 6                  \r\n                \r\n             ', 1, 4, 0, '2019-11-11 00:47:57', '2019-11-11 02:41:07'),
(19, 'post 7', 'news                  \r\n                \r\n             ', 1, 4, 0, '2019-11-11 02:40:49', '2019-11-11 04:06:07'),
(20, 'post 8', 'post 8\r\n                  \r\n             ', 1, 4, 0, '2019-11-11 04:05:46', '2019-11-11 04:05:46'),
(21, 'post 9', 'post 9\r\n                  \r\n             ', 2, 4, 0, '2019-11-11 04:06:18', '2019-11-11 04:06:18'),
(22, 'post 10', 'post 10', 2, 4, 0, '2019-11-11 04:06:31', '2019-11-11 04:06:31'),
(23, 'post 11', 'post 11                  \r\n                \r\n                \r\n             ', 1, 4, 0, '2019-11-11 04:06:41', '2019-11-11 10:18:41'),
(24, 'post 12', 'post 12\r\n\r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n             ', 1, 4, 0, '2019-11-12 04:25:08', '2019-11-12 07:01:39'),
(25, 'test post', 'a test post', 4, 7, 0, '2019-11-12 06:12:06', '2019-11-12 06:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`post_id`, `tag_id`) VALUES
(11, 17),
(12, 19),
(13, 21),
(14, 19),
(16, 21),
(16, 19),
(11, 21),
(23, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(17, 'famous_people'),
(19, 'hot_news'),
(21, 'new_tag');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `total_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `total_view`) VALUES
(3, 'md5pass', 'abc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(4, 'tn0805', 'tn0805@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 20),
(7, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 1),
(12, 'anhngoc', 'cobetihon@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(13, 'river', 'river@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `count_views`
--
ALTER TABLE `count_views`
  ADD KEY `fk_count_post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD KEY `fk_post_id` (`post_id`),
  ADD KEY `fk_tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `count_views`
--
ALTER TABLE `count_views`
  ADD CONSTRAINT `fk_count_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
