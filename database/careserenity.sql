-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2024 at 10:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careserenity`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int NOT NULL,
  `acc_pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_join_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
);

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_pass`, `acc_email`, `role`, `acc_join_date`, `question`, `answer`) VALUES
(1, '$2y$10$Uz..v7.OStW4UKCPaQABQ.iUI53nJNIsoNZpwaJLnAxilAhGNNmom', 'ls_foundation@gamil.com', 'org', '2024-09-18', 'What was your first job?', 'BA'),
(2, '$2y$10$7j101WPp0njTpkWnnUYZKu/cb.yMzn0BidyusNwQnbocy9geRZiOe', 'as@gmail.com', 'user', '2024-09-18', 'What was your first job?', 'BA');

-- --------------------------------------------------------

--
-- Table structure for table `admin_list`
--

CREATE TABLE `admin_list` (
  `admin_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `admin_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_contact` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_priyority` int DEFAULT NULL,
  `admin_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int NOT NULL,
  `orphan_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `request_date` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '0 = pending, 1 = approved, 2 = rejected',
  `issued_date` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `income` float DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `children` int DEFAULT NULL,
  `livingEnvironment` varchar(255) DEFAULT NULL,
  `expectations` varchar(255) DEFAULT NULL,
  `additionalInfo` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`adoption_id`, `orphan_id`, `acc_id`, `request_date`, `status`, `issued_date`, `email`, `phone`, `occupation`, `income`, `maritalStatus`, `reason`, `children`, `livingEnvironment`, `expectations`, `additionalInfo`) VALUES
(1, 2, 2, '20-09-24', NULL, NULL, 'ahad@gmail.com', '1234', 'sadaw', 2341, 'single', 'awew', 0, 'fh', 'fg', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `post_id` int NOT NULL,
  `viewer_acc_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `comment_date` date NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `post_id` int NOT NULL,
  `likes` int DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `post_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `published` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int NOT NULL,
  `outgoing_msg_id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `incoming_msg_id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `msg` text COLLATE utf8mb4_general_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE `contact_message` (
  `msg_id` int NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_contact` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` int NOT NULL,
  `msg_content` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sending_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_registerd` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int NOT NULL,
  `donor_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_orphan_id` int DEFAULT NULL,
  `receiver_type` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `donor_email` varchar(100) NOT NULL,
  `card_no` varchar(20) DEFAULT NULL,
  `card_cvc` varchar(10) DEFAULT NULL,
  `card_exp_month` varchar(12) DEFAULT NULL,
  `card_exp_year` year DEFAULT NULL,
  `bkash_no` varchar(15) DEFAULT NULL,
  `Bkash_trans` varchar(20) DEFAULT NULL,
  `amount` float NOT NULL,
  `receiving_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `donations_orphan`
--

CREATE TABLE `donations_orphan` (
  `orphan_id` int NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int NOT NULL,
  `uploader_id` int NOT NULL,
  `img_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img_reacts` int NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `like_handle`
--

CREATE TABLE `like_handle` (
  `post_id` int NOT NULL,
  `viewer_acc_id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `local_orphan_guardian`
--

CREATE TABLE `local_orphan_guardian` (
  `guardian_id` int NOT NULL,
  `guardian_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_contact` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_location` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
);

--
-- Dumping data for table `local_orphan_guardian`
--

INSERT INTO `local_orphan_guardian` (`guardian_id`, `guardian_name`, `guardian_contact`, `guardian_location`) VALUES
(1, 'Abdur Rahman', '1234', 'Dhaka'),
(2, 'a', '123', 'barisal');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int NOT NULL,
  `user_id` int NOT NULL,
  `org_id` int DEFAULT NULL,
  `orphan_id` int DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = unseen, 1 = seen',
  `content` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `org_id`, `orphan_id`, `is_read`, `content`, `amount`, `date`) VALUES
(1, 1, 1, 2, 1, 'Adoption Request', NULL, '2024-09-20 06:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `org_list`
--

CREATE TABLE `org_list` (
  `org_id` int NOT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `acc_id` int NOT NULL,
  `org_description` text,
  `org_email` varchar(255) DEFAULT NULL,
  `org_phone` varchar(255) DEFAULT NULL,
  `org_website` varchar(255) DEFAULT NULL,
  `org_logo` varchar(255) DEFAULT NULL,
  `established` varchar(255) DEFAULT NULL,
  `org_location` varchar(255) DEFAULT NULL,
  `org_vision` varchar(255) DEFAULT NULL,
  `org_reviews` decimal(2,2) DEFAULT NULL
);

--
-- Dumping data for table `org_list`
--

INSERT INTO `org_list` (`org_id`, `org_name`, `acc_id`, `org_description`, `org_email`, `org_phone`, `org_website`, `org_logo`, `established`, `org_location`, `org_vision`, `org_reviews`) VALUES
(1, 'Little Spirituas Foundation', 1, 'It;s a description', 'ls_foundation@gmail.com', '934214', 'ls.ww.co', 'LittleSpirituasFoundation_d63a4.png', '2024-09-19', 'Bangladesh', 'Being lost is our vision', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `orphan_list`
--

CREATE TABLE `orphan_list` (
  `orphan_id` int NOT NULL,
  `org_id` int DEFAULT NULL,
  `guardian_id` int DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `since` varchar(255) DEFAULT NULL,
  `family_status` varchar(255) DEFAULT NULL,
  `physical_condition` varchar(255) DEFAULT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `medical_history` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `favorite_food` varchar(255) DEFAULT NULL,
  `favorite_game` varchar(255) DEFAULT NULL,
  `skills` text,
  `dreams` text,
  `problems` text,
  `other_comments` text,
  `orphan_image` varchar(255) DEFAULT NULL,
  `adoption_status` int NOT NULL,
  `removed_status` int NOT NULL
);

--
-- Dumping data for table `orphan_list`
--

INSERT INTO `orphan_list` (`orphan_id`, `org_id`, `guardian_id`, `first_name`, `last_name`, `age`, `gender`, `religion`, `date_of_birth`, `since`, `family_status`, `physical_condition`, `education_level`, `medical_history`, `hobby`, `favorite_food`, `favorite_game`, `skills`, `dreams`, `problems`, `other_comments`, `orphan_image`, `adoption_status`, `removed_status`) VALUES
(1, 1, 1, 'Maisha Maliha', 'Neha', 25, 'female', 'muslim', '2024-09-04', '2024-09-19', 'unknow', 'good', 'senior_high_school', 'none', 'footbal', 'Tea', 'Football', 'sing', 'footballer', 'none', 'none', 'Neha_66ebef6242bc5.jpg', 0, 0),
(2, 1, 2, 'x', 'y', 9, 'male', 'buddha', '2024-09-02', '2024-09-19', 'abondoned', 'deaf', 'elementary', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'y_66ebf5db2b234.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acc_id` int NOT NULL,
  `user_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_NID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `child_adopted` int NOT NULL
);

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`user_id`, `user_name`, `acc_id`, `user_birth`, `user_contact`, `user_gender`, `user_NID`, `user_address`, `user_website`, `user_job`, `user_location`, `user_image`, `child_adopted`) VALUES
(1, 'Anayatul Ahad Shoikot', 2, '2024-09-18', '019731234432', 'male', '0813247308123', 'Mirpur - 6', 'shoikot-ahad.free.nf', 'Student', 'Bangladesh', 'AnayatulAhadShoikot_b7fb8.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `admin_list`
--
ALTER TABLE `admin_list`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `acc_id` (`acc_id`),
  ADD KEY `orphan_id` (`orphan_id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `contact_message`
--
ALTER TABLE `contact_message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `donations_orphan`
--
ALTER TABLE `donations_orphan`
  ADD PRIMARY KEY (`orphan_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Indexes for table `like_handle`
--
ALTER TABLE `like_handle`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `local_orphan_guardian`
--
ALTER TABLE `local_orphan_guardian`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orphan_id` (`orphan_id`);

--
-- Indexes for table `org_list`
--
ALTER TABLE `org_list`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `orphan_list`
--
ALTER TABLE `orphan_list`
  ADD PRIMARY KEY (`orphan_id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_list`
--
ALTER TABLE `admin_list`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_orphan_guardian`
--
ALTER TABLE `local_orphan_guardian`
  MODIFY `guardian_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `org_list`
--
ALTER TABLE `org_list`
  MODIFY `org_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orphan_list`
--
ALTER TABLE `orphan_list`
  MODIFY `orphan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_list`
--
ALTER TABLE `admin_list`
  ADD CONSTRAINT `admin_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `org_list` (`org_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `org_list`
--
ALTER TABLE `org_list`
  ADD CONSTRAINT `org_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_list`
--
ALTER TABLE `user_list`
  ADD CONSTRAINT `user_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
