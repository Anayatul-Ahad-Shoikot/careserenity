-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2024 at 08:09 AM
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
(2, '$2y$10$7j101WPp0njTpkWnnUYZKu/cb.yMzn0BidyusNwQnbocy9geRZiOe', 'as@gmail.com', 'user', '2024-09-18', 'What was your first job?', 'BA'),
(3, '$2y$10$xViiOlzApwTZfKcAP/UW7.FOvDEqTthL.hZUPLRe3WJgiuZfYuY0O', 'dhakafoundation@gmail.com', 'org', '2024-09-23', 'What was your first job?', 'BAA'),
(5, '$2y$10$i4M3XevXvUOHTEyyI28iZ.hSQiMCbrQFkkHhHZnpQZlDxThCKVaV6', 'meva@gmail.com', 'user', '2024-09-23', 'What was your biggest lost?', 'ahad');

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
  `status` int DEFAULT '0' COMMENT '0 = pending, 1 = approved, 2 = rejected',
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
  `additionalInfo` varchar(255) DEFAULT NULL,
  `user_delete` int NOT NULL DEFAULT '0' COMMENT ' 1 = user delete',
  `org_delete` int NOT NULL DEFAULT '0' COMMENT ' 1 = organization delete'
);

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`adoption_id`, `orphan_id`, `acc_id`, `request_date`, `status`, `issued_date`, `email`, `phone`, `occupation`, `income`, `maritalStatus`, `reason`, `children`, `livingEnvironment`, `expectations`, `additionalInfo`, `user_delete`, `org_delete`) VALUES
(7, 2, 2, '22-09-24', 0, NULL, 'as@gmail.com', '01973360001', 'Software Eng.', 2134130, 'single', 'dbrdcd', 0, 'Good and healthy environment', 'I hope i will take care of my child as best i can.', 'none', 0, 0),
(8, 1, 2, '22-09-24', 1, '22-09-24', 'awd@gmail.com', '01973360001', '123424', 1234210, 'divorced', '123', 123, '123', '123', '123', 0, 0),
(9, 3, 5, '23-09-24', 0, NULL, 'meva@gmail.com', '2132545234', 'Student', 234254, 'single', 'None', 0, 'none', 'none', 'none', 0, 0);

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

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`post_id`, `viewer_acc_name`, `comment`, `comment_date`) VALUES
(1, 'Little Spirituas Foundation', 'awd', '2024-09-21'),
(1, 'Anayatul Ahad Shoikot', 'awdwffeafe', '2024-09-21'),
(2, 'Set Your Organization name', 'awd', '2024-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `post_id` int NOT NULL,
  `likes` int DEFAULT '0'
);

--
-- Dumping data for table `blog_likes`
--

INSERT INTO `blog_likes` (`post_id`, `likes`) VALUES
(1, 2),
(2, 2),
(3, 0);

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

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `acc_id`, `post_title`, `post_content`, `post_category`, `post_image`, `published`) VALUES
(1, 1, 'Porshce, The best brand', 'Porshce 911 turbo_s is one of the best sport car made ever in world. I want to buy it in future.', 'adoption', 'PorshceThebestbrand_1cafe.jpg', '2024-09-21'),
(2, 1, 'adbcd', 'abcfd', 'seminars', 'adbcd_371d7.jpg', '2024-09-23'),
(3, 5, 'Save GAZA', 'save GAZA, GAZA is destroyed very badly.', 'problems', 'SaveGAZA_c057e.jpg', '2024-09-23');

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
  `card_cvc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `card_exp_month` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `card_exp_year` varchar(255) DEFAULT NULL,
  `bkash_no` varchar(15) DEFAULT NULL,
  `Bkash_trans` varchar(20) DEFAULT NULL,
  `amount` float NOT NULL,
  `receiving_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donor_id`, `receiver_id`, `receiver_orphan_id`, `receiver_type`, `payment_method`, `donor_email`, `card_no`, `card_cvc`, `card_exp_month`, `card_exp_year`, `bkash_no`, `Bkash_trans`, `amount`, `receiving_date`) VALUES
(1, 2, 1, 2, 'orphan', 'bkash', 'meva@gmail.com', NULL, NULL, NULL, NULL, '233984902347', '3243254', 4900, '2024-09-23 07:44:50'),
(2, 2, 2, 3, 'orphan', 'card', 'meva@gmail.com', '13435', '123435', 'january', '2024', NULL, NULL, 1000, '2024-09-23 07:48:29');

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

--
-- Dumping data for table `like_handle`
--

INSERT INTO `like_handle` (`post_id`, `viewer_acc_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 5);

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
(2, 'a', '123', 'barisal'),
(3, 'Mozammel Mia', '023432523321', 'Rampura. dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `org_id` int DEFAULT '0',
  `orphan_id` int DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = unseen, 1 = seen',
  `content` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float(5,2) DEFAULT '0.00',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `org_id`, `orphan_id`, `is_read`, `content`, `amount`, `date`) VALUES
(5, 1, 0, 2, 1, 'Adoption Request Sent for x y.', 0.00, '2024-09-21 03:55:43'),
(6, 0, 1, 2, 1, 'Anayatul Ahad Shoikot Requested adoption for x y.', 0.00, '2024-09-21 03:55:43'),
(7, 0, 1, 2, 1, 'You approved x y for adoption.', 0.00, '2024-09-21 03:56:40'),
(8, 1, 0, 2, 1, 'Adoption request for x y has been approved!', 0.00, '2024-09-21 03:56:40'),
(9, 0, 1, 2, 1, 'You rejected x y for adoption.', 0.00, '2024-09-21 04:00:55'),
(10, 1, 0, 2, 1, 'Adoption request for x y has been rejected!', 0.00, '2024-09-21 04:00:55'),
(11, 0, 1, 2, 1, 'You approved x y for adoption.', 0.00, '2024-09-21 04:01:08'),
(12, 1, 0, 2, 1, 'Adoption request for x y has been approved!', 0.00, '2024-09-21 04:01:08'),
(13, 0, 1, 2, 1, 'You rejected x y for adoption.', 0.00, '2024-09-21 05:49:29'),
(14, 1, 0, 2, 1, 'Adoption request for x y has been rejected!', 0.00, '2024-09-21 05:49:29'),
(15, 1, 0, 2, 1, 'Adoption Request Sent for x y.', 0.00, '2024-09-22 19:21:51'),
(16, 0, 1, 2, 1, 'Anayatul Ahad Shoikot Requested adoption for x y.', 0.00, '2024-09-22 19:21:51'),
(17, 1, 0, 1, 1, 'Adoption Request Sent for Maisha Maliha Neha.', 0.00, '2024-09-22 19:22:31'),
(18, 0, 1, 1, 1, 'Anayatul Ahad Shoikot Requested adoption for Maisha Maliha Neha.', 0.00, '2024-09-22 19:22:31'),
(19, 0, 1, 1, 1, 'You approved Maisha Maliha Neha for adoption.', 0.00, '2024-09-22 19:33:56'),
(20, 1, 0, 1, 1, 'Adoption request for Maisha Maliha Neha has been approved!', 0.00, '2024-09-22 19:33:56'),
(21, 2, 0, 3, 0, 'Adoption Request Sent for Zahid Rahman.', 0.00, '2024-09-23 07:43:44'),
(22, 0, 2, 3, 0, 'Mehbuba Prova Requested adoption for Zahid Rahman.', 0.00, '2024-09-23 07:43:44'),
(23, 2, 1, 0, 0, 'Donation: 4900 Tk sent to x y belongs to Little Spirituas Foundation via Bkash.', 0.00, '2024-09-23 07:44:50'),
(24, 2, 2, 0, 0, 'Donation: 1000 Tk sent to Zahid Rahman belongs to Dhaka Foundation via card.', 0.00, '2024-09-23 07:48:29');

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
(1, 'Little Spirituas Foundation', 1, 'It;s a description', 'ls_foundation@gmail.com', '934214', 'ls.ww.co', 'LittleSpirituasFoundation_d63a4.png', '2024-09-19', 'Bangladesh', 'Being lost is our vision', '0.00'),
(2, 'Dhaka Foundation', 3, 'The best Charity for orphans', 'dhakafoundation@gmail.com', '3243432332', 'Dfoundation.com', 'DhakaFoundation_56144.jpg', '1997-07-04', 'Badda', 'The best Charity for orphans', '0.00');

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
  `adoption_status` int NOT NULL DEFAULT '0' COMMENT '0 = unadopted, 1 = adopted',
  `removed_status` int NOT NULL DEFAULT '0' COMMENT '1 = removed'
);

--
-- Dumping data for table `orphan_list`
--

INSERT INTO `orphan_list` (`orphan_id`, `org_id`, `guardian_id`, `first_name`, `last_name`, `age`, `gender`, `religion`, `date_of_birth`, `since`, `family_status`, `physical_condition`, `education_level`, `medical_history`, `hobby`, `favorite_food`, `favorite_game`, `skills`, `dreams`, `problems`, `other_comments`, `orphan_image`, `adoption_status`, `removed_status`) VALUES
(1, 1, 1, 'Maisha Maliha', 'Neha', 25, 'female', 'muslim', '2024-09-04', '2024-09-19', 'unknow', 'good', 'senior_high_school', 'none', 'footbal', 'Tea', 'Football', 'sing', 'footballer', 'none', 'none', 'Neha_66ebef6242bc5.jpg', 1, 0),
(2, 1, 2, 'x', 'y', 9, 'male', 'buddha', '2024-09-02', '2024-09-19', 'abondoned', 'deaf', 'elementary', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'y_66ebf5db2b234.jpg', 0, 0),
(3, 2, 3, 'Zahid', 'Rahman', 10, 'male', 'buddha', '2024-09-21', '2024-09-23', 'lost', 'blind', 'kindergarten', 'Good', 'Drawing', 'Roast', 'Cricket', 'Sing', 'Painter', 'None', 'None', 'Rahman_66f114fe721bc.jpeg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `seminar_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `seminar_date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `guest` varchar(255) DEFAULT NULL,
  `type` enum('online','offline') NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `org_id` int NOT NULL,
  `visibility` tinyint(1) DEFAULT '0' COMMENT ' 0 = visible, 1 = invisible',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `seminars`
--

INSERT INTO `seminars` (`seminar_id`, `title`, `banner`, `description`, `seminar_date`, `subject`, `guest`, `type`, `location`, `org_id`, `visibility`, `created_at`) VALUES
(1, 'j', 'bg.jpg', 'k', '2024-09-12', 'j', 'k', 'offline', 'gduiegug', 1, 0, '2024-09-21 07:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_participants`
--

CREATE TABLE `seminar_participants` (
  `seminar_id` int NOT NULL,
  `participant_id` int NOT NULL
);

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
  `child_adopted` int NOT NULL DEFAULT '0'
);

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`user_id`, `user_name`, `acc_id`, `user_birth`, `user_contact`, `user_gender`, `user_NID`, `user_address`, `user_website`, `user_job`, `user_location`, `user_image`, `child_adopted`) VALUES
(1, 'Anayatul Ahad Shoikot', 2, '2024-09-18', '019731234432', 'male', '0813247308123', 'Mirpur - 6', 'shoikot-ahad.free.nf', 'Student', 'Bangladesh', 'AnayatulAhadShoikot_b7fb8.jpg', 0),
(2, 'Mehbuba Prova', 5, '2024-09-14', '329432572434', 'female', '38423847230847320', 'Road 1', 'N/ A', 'Software Eng.', 'Dhaka', 'MehbubaProva_1ef3c.png', 0);

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
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `receiver_orphan_id` (`receiver_orphan_id`);

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
  ADD PRIMARY KEY (`notification_id`);

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
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`seminar_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD KEY `participant_id` (`participant_id`),
  ADD KEY `seminar_id` (`seminar_id`);

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
  MODIFY `acc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_list`
--
ALTER TABLE `admin_list`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `local_orphan_guardian`
--
ALTER TABLE `local_orphan_guardian`
  MODIFY `guardian_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `org_list`
--
ALTER TABLE `org_list`
  MODIFY `org_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orphan_list`
--
ALTER TABLE `orphan_list`
  MODIFY `orphan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `seminar_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `user_list` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `org_list` (`org_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `donations_ibfk_3` FOREIGN KEY (`receiver_orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `org_list`
--
ALTER TABLE `org_list`
  ADD CONSTRAINT `org_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `seminars`
--
ALTER TABLE `seminars`
  ADD CONSTRAINT `seminars_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `org_list` (`org_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD CONSTRAINT `seminar_participants_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `user_list` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `seminar_participants_ibfk_2` FOREIGN KEY (`seminar_id`) REFERENCES `seminars` (`seminar_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_list`
--
ALTER TABLE `user_list`
  ADD CONSTRAINT `user_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
