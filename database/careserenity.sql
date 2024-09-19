-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2024 at 11:44 AM
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
  `acc_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_join_date` date NOT NULL,
  `question` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `admin_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `admin_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_contact` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_priyority` int DEFAULT NULL,
  `admin_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_list`
--

INSERT INTO `admin_list` (`admin_id`, `acc_id`, `admin_name`, `admin_contact`, `admin_priyority`, `admin_image`) VALUES
(1, 1013, 'Ahad Shoikot', '0197333798', 1, 'img/011-212-107.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `post_id` int NOT NULL,
  `viewer_acc_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
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
  `post_id` int NOT NULL,
  `likes` int DEFAULT '0'
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
  `post_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `post_title` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `post_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `post_category` enum('child','old') COLLATE utf8mb4_general_ci NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `published` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
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
  `chat_id` int NOT NULL,
  `outgoing_msg_id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `incoming_msg_id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `msg` text COLLATE utf8mb4_general_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint NOT NULL DEFAULT '0'
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
  `msg_id` int NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_contact` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` int NOT NULL,
  `msg_content` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sending_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_registerd` int NOT NULL
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `orphan_id` int NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `post_id` int NOT NULL,
  `viewer_acc_id` int NOT NULL
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
  `guardian_id` int NOT NULL,
  `guardian_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_contact` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian_location` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `notification_id` int NOT NULL,
  `user_id` int NOT NULL,
  `org_id` int DEFAULT NULL,
  `orphan_id` int DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `content` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
-- Table structure for table `other_orgs`
--

CREATE TABLE `other_orgs` (
  `org_id` int NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_description` text,
  `org_contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int NOT NULL,
  `seminar_id` int NOT NULL,
  `acc_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `seminar_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `guest` varchar(255) DEFAULT NULL,
  `type` enum('online','offline') NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `org_id` int NOT NULL,
  `visibility` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seminar_participants`
--

CREATE TABLE `seminar_participants` (
  `participant_id` int NOT NULL,
  `seminar_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `seminar_participants`
--
DELIMITER $$
CREATE TRIGGER `validate_participant_role` BEFORE INSERT ON `seminar_participants` FOR EACH ROW BEGIN
    DECLARE role_type ENUM('organization', 'participant');

    -- Get the role of the participant
    SELECT role INTO role_type
    FROM accounts
    WHERE acc_id = NEW.participant_id;

    -- Check if the role is 'participant'
    IF role_type != 'participant' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Only participants can join seminars.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int NOT NULL,
  `user_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Set your name first',
  `acc_id` int NOT NULL,
  `user_birth` date DEFAULT NULL,
  `user_contact` varchar(30) COLLATE utf8mb4_general_ci DEFAULT '+880',
  `user_gender` enum('Male','Female','Other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_NID` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'N / A',
  `user_address` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'N / A',
  `user_website` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'N / A',
  `user_job` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'N / A',
  `user_location` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Bangladesh',
  `user_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'user.png'
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
-- Indexes for table `other_orgs`
--
ALTER TABLE `other_orgs`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD KEY `seminar_id` (`seminar_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`seminar_id`);

--
-- Indexes for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD PRIMARY KEY (`participant_id`,`seminar_id`),
  ADD KEY `seminar_id` (`seminar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `other_orgs`
--
ALTER TABLE `other_orgs`
  MODIFY `org_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `seminar_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`seminar_id`) REFERENCES `seminars` (`seminar_id`),
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`);

--
-- Constraints for table `seminar_participants`
--
ALTER TABLE `seminar_participants`
  ADD CONSTRAINT `seminar_participants_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seminar_participants_ibfk_2` FOREIGN KEY (`seminar_id`) REFERENCES `seminars` (`seminar_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
