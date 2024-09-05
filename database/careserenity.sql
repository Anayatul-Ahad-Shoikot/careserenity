-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 05:29 PM
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
-- Database: `careserenity`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(30) NOT NULL,
  `acc_pass` varchar(255) NOT NULL,
  `acc_email` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL,
  `acc_join_date` date NOT NULL,
  `question` varchar(120) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_pass`, `acc_email`, `role`, `acc_join_date`, `question`, `answer`) VALUES
(1000, 'ls_foundation', '1000', 'ls_foundation@gamil.com', 'org', '2023-12-02', NULL, NULL),
(1002, 'AAS_charity', '$2y$10$6a3PrdrwxXnjyTGy5kNP1eedusq2C19za/e4h05PWlb3oxY9v1j6G', 'AAS_charity.org@gmail.com', 'org', '2023-12-03', 'What was your first job?', 'baker'),
(1003, 'ShomajSeba', '1003', 'shomajseba@example.com', 'org', '2011-09-15', NULL, NULL),
(1004, 'DhakaFoundation', '1004', 'dhakafoundation@example.com', 'org', '2010-05-20', NULL, NULL),
(1005, 'RuralEmpower', '1005', 'rural_empower@example.com', 'org', '2012-12-03', NULL, NULL),
(1006, 'GrameenHelp', '$2y$10$NnttPd7VAa2DPozxHkiW5eYe72Nc/vYoYeMWXt6ycQpjHraPlpSQK', 'grameenhelp@example.com', 'org', '2013-07-28', NULL, NULL),
(1007, 'ShishuKalyan', '$2y$10$W9IX4DQrA09qV7wJN5bBtOMzXyeGU0g9jqoVUXzQNDp9LxmgJ.gwe', 'shishukalyan@example.com', 'org', '2014-11-10', NULL, NULL),
(1008, 'ProjonmoSathi', '$2y$10$vWzPIgTNeMho.a9GJP0G2ewsxOpfZTbd86.Oontd8BPP4pcBSWxPi', 'projonmosathi@example.com', 'org', '2015-06-22', NULL, NULL),
(1009, 'JibonSonglap', '$2y$10$B7xHI06bKM3LYkGews.IIuF6JlPkYBJbmOJYdeIh/7O55WKdZ95.6', 'jibonsonglap@example.com', 'org', '2016-09-05', NULL, NULL),
(1010, 'NariShakti', '$2y$10$3kfdL83JxDWgJCBkousbJOeejbC2aCano6TJa3yxGv.gqV5G.spem', 'narishakti@example.com', 'org', '2017-12-18', NULL, NULL),
(1011, 'AgroVista', '$2y$10$fe0.D3g177cbRbz7cI/WouugIx8eui5X8CJftXHpVN0.VWUT4ANH6', 'agrovista@example.com', 'org', '2018-08-30', NULL, NULL),
(1012, 'SustainableBD', '$2y$10$fHPsmqW1XGwkXRp9hWdjKe5JdhgUwHOxmTTZzZn27Cfg8ws75fhRW', 'sustainablebd@example.com', 'org', '2019-10-12', NULL, NULL),
(1013, 'admin1', 'admin1', 'admin1@gmail.com', 'admin', '2023-12-07', NULL, NULL),
(1024, 'ahad', '$2y$10$ZzGlxDX2zV/j9xJ/myxb0.I4k4d7da6hHkuQLGVcvod.p/CijtIlG', 'ahad@gmail.com', 'user', '2024-06-28', 'What was your childhood nickname?', 'shiku'),
(1025, 'sowrin', 'sowrin123', 'sowrin@gmail.com', 'user', '2024-07-01', NULL, NULL),
(1028, 'shoikot', '123', 'shoikot@gmail.com', 'user', '2024-07-26', NULL, NULL),
(1030, 'pata', '$2y$10$CL3tIoGXxprKp7HFVCEoVe2veD3a7bPPRGg6WlfFb9pL4inEUqPki', 'paro@gmail.com', 'user', '2024-07-28', 'What is your favorite book?', 'pata'),
(1031, 'abc', '$2y$10$MBCp2bB36056Bs33SRKK2OFb6Oa622dBx8R5BnGNqUthV0W616Hzq', 'abc@gmail.com', 'user', '2024-08-24', 'What was your biggest lost?', 'queen');

-- --------------------------------------------------------

--
-- Table structure for table `admin_list`
--

CREATE TABLE `admin_list` (
  `admin_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `admin_contact` varchar(30) DEFAULT NULL,
  `admin_priyority` int(11) DEFAULT NULL,
  `admin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_list`
--

INSERT INTO `admin_list` (`admin_id`, `acc_id`, `admin_name`, `admin_contact`, `admin_priyority`, `admin_image`) VALUES
(1, 1013, 'Ahad Shoikot', '0197333798', 1, 'img/011-212-107.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int(11) NOT NULL,
  `orphan_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `request_date` date DEFAULT current_timestamp(),
  `status` varchar(15) DEFAULT 'pending',
  `issued_date` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `income` float DEFAULT NULL,
  `maritalStatus` varchar(30) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `children` int(5) DEFAULT NULL,
  `livingEnvironment` varchar(100) DEFAULT NULL,
  `expectations` varchar(100) DEFAULT NULL,
  `additionalInfo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `post_id` int(11) NOT NULL,
  `viewer_acc_name` varchar(30) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`post_id`, `viewer_acc_name`, `comment`, `comment_date`) VALUES
(57, 'shoikot', 'adwW', '2024-07-26'),
(58, 'ahad', 'Allah may help them.', '2024-07-28'),
(58, 'abc', 'awd', '2024-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `post_id` int(11) NOT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_likes`
--

INSERT INTO `blog_likes` (`post_id`, `likes`) VALUES
(57, 1),
(58, 3),
(59, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `post_title` varchar(30) DEFAULT NULL,
  `post_content` text NOT NULL,
  `post_category` enum('child','old') NOT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `published` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `acc_id`, `post_title`, `post_content`, `post_category`, `post_image`, `published`) VALUES
(57, 1013, 'This is Admin Post', 'this is admin post', 'child', 'ThisisAdminPost_657f31a6e37c6.jpg', '2023-12-17'),
(58, 1024, 'Gaza needs help', 'This is blog/post content. This is blog/post content. This is blog/post content. This is blog/post content. This is blog/post content. This is blog/post content. This is blog/post content. This is blog/post content. ', '', 'Gazaneedshelp_66a61c89889ad.jpg', '2024-07-28'),
(59, 1031, 'a', 'a', '', 'a_66ca1f530db3c.png', '2024-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(5) NOT NULL,
  `outgoing_msg_id` varchar(8) NOT NULL,
  `incoming_msg_id` varchar(8) NOT NULL,
  `msg` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `outgoing_msg_id`, `incoming_msg_id`, `msg`, `timestamp`, `is_read`) VALUES
(68, '8001', '5004', 'hi', '2024-08-06 10:37:07', 0),
(69, '8001', '5003', 'hello', '2024-08-06 10:37:07', 0),
(70, '8001', '5002', 'hiii again', '2024-08-06 10:37:55', 0),
(71, '8001', '5000', NULL, '2024-08-06 10:37:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE `contact_message` (
  `msg_id` int(5) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_contact` varchar(11) NOT NULL,
  `sender_id` int(5) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `sending_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_registerd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_message`
--

INSERT INTO `contact_message` (`msg_id`, `sender_name`, `sender_email`, `sender_contact`, `sender_id`, `msg_content`, `sending_time`, `is_registerd`) VALUES
(1, 'Safe Haven Orphanage', '', '01537500500', 8001, 'test text message.', '2024-08-01 07:38:18', 1),
(2, 'a', 'a@gmail.com', 'a', 0, 'a', '2024-08-25 04:42:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_orphan_id` int(11) DEFAULT NULL,
  `receiver_type` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `donor_email` varchar(100) NOT NULL,
  `card_no` varchar(20) DEFAULT NULL,
  `card_cvc` varchar(10) DEFAULT NULL,
  `card_exp_month` varchar(12) DEFAULT NULL,
  `card_exp_year` year(4) DEFAULT NULL,
  `bkash_no` varchar(15) DEFAULT NULL,
  `Bkash_trans` varchar(20) DEFAULT NULL,
  `amount` float NOT NULL,
  `receiving_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donor_id`, `receiver_id`, `receiver_orphan_id`, `receiver_type`, `payment_method`, `donor_email`, `card_no`, `card_cvc`, `card_exp_month`, `card_exp_year`, `bkash_no`, `Bkash_trans`, `amount`, `receiving_date`) VALUES
(27, 5000, 8001, 0, 'organization', 'card', 'ahad@gmail.com', '3425436', '324324', 'JUNE', '2026', NULL, NULL, 560, '2024-07-29 03:31:35'),
(28, 5004, 8001, 0, 'organization', 'card', 'pata123@gmail.com', '4444', '3333', 'February', '2030', NULL, NULL, 180, '2024-07-29 05:14:37'),
(29, 5000, 8001, 0, 'organization', 'bkash', 'ahad@gmail.com', NULL, NULL, NULL, NULL, '23432', 'sG7EF77', 7620, '2024-08-25 20:12:00'),
(30, 5000, 8001, 0, 'organization', 'card', 'ahad@gmail.com', '12', '6543713', 'August', '2023', NULL, NULL, 4790, '2024-08-25 20:13:29'),
(31, 5000, 8001, 56, 'organization', 'card', 'ahad@gmail.com', '12', '6543713', 'August', '2023', NULL, NULL, 47, '2024-08-25 20:15:12'),
(32, 5005, 8001, 57, 'orphan', 'card', 'abc@gmail.com', '11112222', '11112222', '10', '2035', NULL, NULL, 25, '2024-08-25 20:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `donations_orphan`
--

CREATE TABLE `donations_orphan` (
  `orphan_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `img_title` varchar(100) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `img_reacts` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`img_id`, `uploader_id`, `img_title`, `img_path`, `img_reacts`) VALUES
(7, 1000, 'dsfgvsd', '1702399476.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `like_handle`
--

CREATE TABLE `like_handle` (
  `post_id` int(11) NOT NULL,
  `viewer_acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_handle`
--

INSERT INTO `like_handle` (`post_id`, `viewer_acc_id`) VALUES
(57, 1024),
(58, 1024),
(58, 1002),
(58, 1031);

-- --------------------------------------------------------

--
-- Table structure for table `local_orphan_guardian`
--

CREATE TABLE `local_orphan_guardian` (
  `guardian_id` int(11) NOT NULL,
  `guardian_name` varchar(30) DEFAULT NULL,
  `guardian_contact` varchar(30) DEFAULT NULL,
  `guardian_location` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_orphan_guardian`
--

INSERT INTO `local_orphan_guardian` (`guardian_id`, `guardian_name`, `guardian_contact`, `guardian_location`) VALUES
(1, 'Farhana Ahmed', '0324325436', 'Madani avenew, Notun bazar, Dh'),
(2, 'bahar uddin', '213214', 'banani'),
(3, 'Rubina Hasan', '+8801973336001', 'mirpur -2'),
(4, 'Abdul Rahman', '+8801712345678', 'Dhaka'),
(5, 'Fatima Akhtar', '+8801812345679', 'Rajshahi'),
(6, 'Kamal Hossain', '+8801912345680', 'Rangpur'),
(7, 'Nasreen Begum', '+8802012345681', 'Chittagong'),
(8, 'Aisha Khan', '+8802112345682', 'Sylhet'),
(9, 'Rafiq Ahmed', '+8802212345683', 'Khulna'),
(10, 'Sultana Begum', '+8802312345684', 'Barisal'),
(11, 'Ahmed Ali', '+8802412345685', 'Gazipur'),
(12, 'Farhana Akter', '+8802512345686', 'Mymensingh'),
(13, 'Kabir Rahman', '+8802612345687', 'Jessore'),
(14, 'Sadia Islam', '+8802712345688', 'Dhaka'),
(15, 'Mizanur Rahman', '+8802812345689', 'Rajshahi'),
(16, 'Laila Begum', '+8802912345690', 'Rangpur'),
(17, 'Anwar Hossain', '+8803012345691', 'Chittagong'),
(18, 'Sara Khan', '+8803112345692', 'Sylhet'),
(19, 'Habib Ahmed', '+8803212345693', 'Khulna'),
(20, 'Nusrat Jahan', '+8803312345694', 'Barisal'),
(21, 'Khalilur Rahman', '+8803412345695', 'Gazipur'),
(22, 'Rubi Akter', '+8803512345696', 'Mymensingh'),
(23, 'Jamal Khan', '+8803612345697', 'Jessore'),
(24, 'Shahida Begum', '+8803712345698', 'Dhaka'),
(25, 'Iqbal Hossain', '+8803812345699', 'Rajshahi'),
(26, 'Rina Akhtar', '+8803912345700', 'Rangpur'),
(27, 'Kamrun Nahar', '+8804012345701', 'Chittagong'),
(28, 'Hasan Ahmed', '+8804112345702', 'Sylhet'),
(29, 'Rahima Begum', '+8804212345703', 'Khulna'),
(30, 'Mominur Rahman', '+8804312345704', 'Barisal'),
(31, 'Nazma Akter', '+8804412345705', 'Gazipur'),
(32, 'Asad Khan', '+8804512345706', 'Mymensingh'),
(33, 'Nahid Hossain', '+8804612345707', 'Jessore'),
(34, 'Ayesha Begum', '+8804712345708', 'Dhaka'),
(35, 'Salim Ahmed', '+8804812345709', 'Rajshahi'),
(36, 'Safia Akhtar', '+8804912345710', 'Rangpur'),
(37, 'Rahim Khan', '+8805012345711', 'Chittagong'),
(38, 'Rahim Khan', '+8805012345711', 'Chittagong'),
(39, 'Safia Begum', '+8804912345710', 'Rangpur'),
(40, 'Xafor Iquebal', '01973336001', 'Bshabo, Dhaka-1216'),
(41, 'Nizamuddin', '01711404674', 'mirpur-2, dhaka-1216'),
(42, '', '0324325436', 'Madani avenew, Notun bazar, Dh'),
(43, 'n', 'n', 'n'),
(44, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `orphan_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `content` varchar(100) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `org_id`, `orphan_id`, `is_read`, `content`, `amount`, `date`) VALUES
(34, 5000, 8001, NULL, 1, 'adoption', NULL, '2024-07-29 03:25:19'),
(35, 5000, 8001, NULL, 1, 'donation', NULL, '2024-07-29 03:31:35'),
(36, 5004, 8001, NULL, 1, 'donation', NULL, '2024-07-29 05:14:37'),
(37, 5000, 8001, NULL, 0, 'Donation: 7620 Tk sent to Safe Haven Orphanage via Bkash.', NULL, '2024-08-25 20:12:00'),
(38, 5000, 8001, NULL, 0, 'Donation: 4790 Tk sent to Safe Haven Orphanage  via card.', NULL, '2024-08-25 20:13:29'),
(39, 5000, 8001, NULL, 0, 'Donation: 47 Tk sent to Safe Haven Orphanage  via card.', NULL, '2024-08-25 20:15:12'),
(40, 5005, 8001, NULL, 0, 'Donation: 25 Tk sent to Safe Haven Orphanage  via card.', NULL, '2024-08-25 20:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `org_list`
--

CREATE TABLE `org_list` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(30) DEFAULT 'Set organization name',
  `acc_id` int(11) NOT NULL,
  `org_description` text DEFAULT 'N / A',
  `org_email` varchar(30) DEFAULT 'N / A',
  `org_phone` varchar(20) DEFAULT '+880',
  `org_website` varchar(30) DEFAULT 'N / A',
  `org_logo` varchar(255) DEFAULT 'org.png',
  `established` date DEFAULT NULL,
  `org_location` varchar(30) DEFAULT 'N / A',
  `org_vision` varchar(30) DEFAULT 'N / A',
  `org_reviews` decimal(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `org_list`
--

INSERT INTO `org_list` (`org_id`, `org_name`, `acc_id`, `org_description`, `org_email`, `org_phone`, `org_website`, `org_logo`, `established`, `org_location`, `org_vision`, `org_reviews`) VALUES
(8000, 'Shetus best charity', 1000, 'Care, care and care. nothing else is found here', 'ela@g.com', '0324325436', 'LittleSproutsFoundation.org', 'LittleSproutsFoundation_656c039da12d5.jpg', '2023-10-26', 'Madani avenew, Notun bazar, Dh', 'To save childer life .', NULL),
(8001, 'Safe Haven Orphanage', 1002, 'Care, care and care. nothing else is found here', 'info@safehaven.org', '+880112233445', 'SafeHavenOrphanage.com', 'SafeHavenOrphanage_656ccaf3a3e45.jpg', '2023-12-09', 'Khulna', 'To save childer life', NULL),
(8002, 'ShomajSeba', 1003, 'Shomaj Seba is committed to improving the lives of orphaned children and elderly people in rural areas. They provide essential support and services to both segments of society.', 'shomajseba@example.com', '+8801812345679', 'www.shomajseba.org', 'ShomajSeba_65703538d3cc7.jpg', '1991-11-12', 'Rajshahi', 'Creating a better future for o', NULL),
(8003, 'DhakaFoundation', 1004, 'Care, care and care. nothing else is found here', 'dhakafoundation@example.com', '+8801712345678', 'www.dhakafoundation.org', 'DhakaFoundation_657034a53c5c9.png', '2000-02-12', 'Dhaka', 'Empower every orphan and elder', NULL),
(8004, 'RuralEmpower', 1005, 'Rural Empowerment Society works tirelessly to support orphaned children and the elderly in rural communities. They aim to create a loving and caring environment for both groups.', 'rural_empower@example.com', '+8801912345680', 'www.ruralempower.org', 'RuralEmpower_6570355e2b267.jpg', '2007-05-19', 'Dhaka', 'Empowering orphans and the eld', NULL),
(8005, 'GrameenHelp', 1006, 'Grameen Help is dedicated to providing assistance and care to orphaned children and elderly individuals in impoverished areas. They aim to uplift both segments of society through various support programs.', 'grameenhelp@example.com', '+8802012345681', 'www.grameenhelp.org', 'GrameenHelp_6570357b96922.jpeg', '2000-09-20', 'Chittagong', 'Uplifting lives: Orphans and e', NULL),
(8006, 'ShishuKalyan', 1007, 'Shishu Kalyan focuses on the welfare of orphaned children, providing them with love, care, and educational support. They also extend their support to the elderly for a better quality of life.', 'shishukalyan@example.com', '+8802112345682', 'www.shishukalyan.org', 'ShishuKalyan_6570359c67f0e.jpg', '1999-01-01', 'Sylhet', 'Ensuring a bright future for o', NULL),
(8007, 'ProjonmoSathi', 1008, 'Projonmo Sathi aims to support orphaned children and the elderly by providing education and essential services. They envision a society where both segments thrive and live happily.', 'projonmosathi@example.com', '+8802212345683', 'www.projonmosathi.org', 'ProjonmoSathi_657035c99790f.jpg', '2013-12-11', 'Khulna', 'Empowering orphans and elders ', NULL),
(8008, 'JibonSonglap', 1009, 'Jibon Songlap works towards creating awareness and providing support for orphaned children and the elderly.', 'jibonsonglap@example.com', '+8802312345684', 'www.jibonsonglap.org', 'JibonSonglap_657035e5b0ad9.png', '2001-02-06', 'Barisal', 'Supporting mental well-being f', NULL),
(8009, 'NariShakti', 1010, 'Nari Shakti focuses on empowering orphaned girls and elderly women, providing education and support for their well-being. They aim for a society where both segments are respected and empowered.', 'narishakti@example.com', '+8802412345685', 'www.narishakti.org', 'NariShakti_657035fd804c2.jpeg', '2013-12-07', 'Dhaka', 'Empowering orphaned girls and ', NULL),
(8010, 'AgroVista', 1011, 'Agro Vista is committed to supporting orphaned children and the elderly by promoting sustainable farming and livelihoods. They envision a future where both segments thrive in harmony with nature.', 'agrovista@example.com', '+8802512345686', 'www.agrovista.org', 'AgroVista_6570362b6a4fa.jpeg', '2007-01-28', 'Mymensingh', 'Sustainable support for orphan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orphan_list`
--

CREATE TABLE `orphan_list` (
  `orphan_id` int(11) NOT NULL,
  `org_id` int(30) DEFAULT NULL,
  `guardian_id` int(11) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT 'N / A',
  `religion` varchar(15) DEFAULT 'N / A',
  `date_of_birth` date DEFAULT NULL,
  `since` date DEFAULT NULL,
  `family_status` varchar(30) DEFAULT 'N / A',
  `physical_condition` varchar(30) DEFAULT 'N / A',
  `education_level` varchar(30) DEFAULT 'N / A',
  `medical_history` varchar(100) DEFAULT 'N / A',
  `hobby` varchar(30) DEFAULT 'N / A',
  `favorite_food` varchar(30) DEFAULT 'N / A',
  `favorite_game` varchar(30) DEFAULT 'N / A',
  `skills` text DEFAULT 'N / A',
  `dreams` text DEFAULT 'N / A',
  `problems` text DEFAULT 'N / A',
  `other_comments` text DEFAULT 'N / A',
  `orphan_image` varchar(255) DEFAULT 'default_image.png',
  `adoption_status` enum('0','1') NOT NULL DEFAULT '0',
  `removed_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orphan_list`
--

INSERT INTO `orphan_list` (`orphan_id`, `org_id`, `guardian_id`, `first_name`, `last_name`, `age`, `gender`, `religion`, `date_of_birth`, `since`, `family_status`, `physical_condition`, `education_level`, `medical_history`, `hobby`, `favorite_food`, `favorite_game`, `skills`, `dreams`, `problems`, `other_comments`, `orphan_image`, `adoption_status`, `removed_status`) VALUES
(52, 8002, 1, 'Abdur', 'Rahim', 10, 'male', 'muslim', '2023-12-09', '2023-12-04', 'past Away', 'good', 'primary_school', 'Allergy to Dust', 'playing marble', 'Ice Cream', 'Cricket', 'N/A', 'N/A', 'Laugh too much', 'All okay', '862-06540774en_Masterfile.jpg', '0', '0'),
(53, 8001, 2, 'Anayatul', 'Shoikot', 12, 'male', 'hindu', '2023-12-22', '2023-12-04', 'past Away', 'deaf', 'junior_high_school', 'None', 'Gamming', 'Ice Cream', 'Badminton', 'xyz', 'A good House Wife ', 'overthinking ', 'All okay', 'Shoikot_656d88af00193.jpeg', '0', '1'),
(54, 8001, 3, 'Shorifa', 'Rani', 2, 'male', 'buddha', '2023-12-11', '2023-12-04', 'unknow', 'blind', 'elementary', 'None', 'Gamming', 'Ice Cream', 'Badminton', 'xyz', 'A good House Wife ', 'overthinking ', 'All okay', 'Rani_656d88d7267b4.jpeg', '0', '1'),
(55, 8001, 38, 'Zahid', 'Rahman', 10, 'male', 'muslim', '2023-12-03', '2023-12-06', 'abondoned', 'good', 'primary_school', '', '', '', '', '', '', '', '', 'img_2505.jpg', '0', '0'),
(56, 8001, 40, 'Maisha Maliha ', 'Neha', 23, 'female', 'muslim', '2023-11-28', '2023-12-15', 'other', 'good', 'secondary_school', 'Major Accident occures at the age of 19', 'Baking', 'Cake', 'Badmintion ', 'Making Cake', 'To be a good beker', 'N/A', 'N/A', 'Neha_657c3f9496606.jpg', '0', '0'),
(57, 8001, 41, 'Nihan', 'Ashraf', 9, 'male', 'hindu', '2023-11-28', '2023-12-15', 'past Away', 'blind', 'primary_school', 'None', 'Gamming', 'Fast Food', 'Cricket', 'Singing Skills', 'Full Stack Developer', 'overthinking ', 'Loves exploring new things', 'Ashraf_657c4040389a2.jpg', '0', '0'),
(58, 8001, 42, 'Anayatul', 'Shoikot', 1, '', '', '0000-00-00', '2023-12-16', '', '', '', '', '', '', '', '', '', '', '', 'Shoikot_657e0198c0cfb.jpeg', '0', '0'),
(59, 8001, 43, 'xyz', 'abc', 12, 'female', 'other', '2023-12-16', '2023-12-16', 'past Away', 'autistic', 'senior_high_school', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'girl-dos-300x300.jpg', '0', '0'),
(60, 8001, 44, '', '', 0, NULL, NULL, '0000-00-00', '2024-07-30', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '_66a876a14d257.', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) DEFAULT 'Set your name first',
  `acc_id` int(11) NOT NULL,
  `user_birth` date DEFAULT NULL,
  `user_contact` varchar(30) DEFAULT '+880',
  `user_gender` enum('Male','Female','Other') DEFAULT NULL,
  `user_NID` varchar(30) DEFAULT 'N / A',
  `user_address` varchar(30) DEFAULT 'N / A',
  `user_website` varchar(30) DEFAULT 'N / A',
  `user_job` varchar(30) DEFAULT 'N / A',
  `user_location` varchar(30) DEFAULT 'Bangladesh',
  `user_image` varchar(255) DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`user_id`, `user_name`, `acc_id`, `user_birth`, `user_contact`, `user_gender`, `user_NID`, `user_address`, `user_website`, `user_job`, `user_location`, `user_image`) VALUES
(5000, 'Anayatul Ahad Shoikot', 1024, '2024-06-10', '+880 1973336001', 'Male', '2143564732434', 'Mirpur - 02', 'ahadExP.com', 'Student', 'Dhaka', 'AnayatulAhadShoikot_667e508ee8b43.jpg'),
(5001, 'Sabrina Zaman', 1025, '2021-03-14', '+880 1473430047', 'Female', '344039732434', 'Uttar badda, Dhaka-1212', 'sab.co', 'Student', 'Dhaka', 'user.jpg'),
(5002, 'Jannatul Ferdous Kakon', 1028, '2024-07-14', '+880 1956053954', 'Female', '34403998364132', 'Mirpur - 6, Dhaka', 'N / A', 'Student', 'Bangladesh', 'k.jpg'),
(5004, 'Set your name first', 1030, NULL, '+880', NULL, 'N / A', 'N / A', 'N / A', 'N / A', 'Bangladesh', 'user.png'),
(5005, 'ABC ABC', 1031, '2002-11-30', '01973336001', 'Male', 'N / A', 'Mirpur-2', 'careserenity-org.free.nf', 'Student', 'Dhaka', 'ABCABC_66ca185fb28ec.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `user_name` (`acc_name`);

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
  ADD KEY `orphan_id` (`orphan_id`),
  ADD KEY `acc_id` (`acc_id`);

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
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `acc_id` (`acc_id`);

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
  ADD KEY `donations_ibfk_1` (`donor_id`);

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
  ADD PRIMARY KEY (`orphan_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `guardian_id` (`guardian_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1032;

--
-- AUTO_INCREMENT for table `admin_list`
--
ALTER TABLE `admin_list`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `contact_message`
--
ALTER TABLE `contact_message`
  MODIFY `msg_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `local_orphan_guardian`
--
ALTER TABLE `local_orphan_guardian`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `org_list`
--
ALTER TABLE `org_list`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8011;

--
-- AUTO_INCREMENT for table `orphan_list`
--
ALTER TABLE `orphan_list`
  MODIFY `orphan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5006;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_list`
--
ALTER TABLE `admin_list`
  ADD CONSTRAINT `admin_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adoptions_ibfk_3` FOREIGN KEY (`acc_id`) REFERENCES `user_list` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD CONSTRAINT `blog_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `user_list` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donations_orphan`
--
ALTER TABLE `donations_orphan`
  ADD CONSTRAINT `donations_orphan_ibfk_1` FOREIGN KEY (`orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`uploader_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_handle`
--
ALTER TABLE `like_handle`
  ADD CONSTRAINT `like_handle_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `org_list` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_5` FOREIGN KEY (`orphan_id`) REFERENCES `orphan_list` (`orphan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org_list`
--
ALTER TABLE `org_list`
  ADD CONSTRAINT `org_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orphan_list`
--
ALTER TABLE `orphan_list`
  ADD CONSTRAINT `orphan_list_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `org_list` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orphan_list_ibfk_2` FOREIGN KEY (`guardian_id`) REFERENCES `local_orphan_guardian` (`guardian_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_list`
--
ALTER TABLE `user_list`
  ADD CONSTRAINT `user_list_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
