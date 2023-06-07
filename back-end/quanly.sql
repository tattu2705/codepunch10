-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 12:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanly`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenge`
--

CREATE TABLE `challenge` (
  `id` int(100) NOT NULL primary key,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `hint` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `challenge_file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `answer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `message` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenge`
--

INSERT INTO `challenge` (`id`, `title`, `hint`, `challenge_file`, `answer`, `message`) VALUES
(1, 'đoán ', 'google', 'file-64784262a0f762.36027463.txt', '4 con vịt', 'good job!'),
(2, 'Câu đố trẻ em', 'google', 'file-64793d8ea3b311.06792536.txt', 'Con tim', 'ok!'),
(3, 'abcd', 'không hint', 'file-647ca38b785692.02299752.txt', 'Con tim', 'good job!');

-- --------------------------------------------------------

--
-- Table structure for table `pass_challenge`
--

CREATE TABLE `pass_challenge` (
  `id` int(100) NOT NULL primary key,
  `student_id` int(100) DEFAULT NULL,
  `challenge_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pass_challenge`
--

INSERT INTO `pass_challenge` (`id`, `student_id`, `challenge_id`) VALUES
(1, 1, 1),
(5, 2, 1),
(8, 1, 2),
(9, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `id` int(30) NOT NULL primary key,
  `fileUpload` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`title`, `description`, `id`, `fileUpload`) VALUES
('Bài tập 1', 'Viết function add cộng 2 số với nhau', 1, 'file-6475d5900b5f13.83669481.rtf'),
('Bài tập 2', 'Đuổi hình bắt chữ', 2, 'file-6476c5358e0e86.54081678.docx');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL primary key,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `imgProfile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `username`, `password`, `name`, `email`, `phoneNumber`, `imgProfile`) VALUES
(1, 'student7', '79f551a5212e904070051d55491c0111', 'Hoang Van G', 'student7@example.com', '0123456789', 'IMG-64755edc52c490.52881132.png'),
(2, 'student1', 'a722c63db8ec8625af6cf71cb8c2d939', 'Nguyen Van A', 'student1@example.com', '987654321', 'default.png'),
(3, 'student2', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'Tran Thi B', 'student2@example.com', '123456789', 'default.png'),
(4, 'student3', '3afc79b597f88a72528e864cf81856d2', 'Le Hoang C', 'student3@example.com', '912345678', 'default.png'),
(5, 'student4', 'fc2921d9057ac44e549efaf0048b2512', 'Pham Thi D', 'student4@example.com', '965432107', 'default.png'),
(6, 'student5', 'd35f6fa9a79434bcd17f8049714ebfcb', 'Vo Van E', 'student5@example.com', '901234567', 'default.png'),
(7, 'student6', 'e9568c9ea43ab05188410a7cf85f9f5e', 'Nguyen Thi F', 'student6@example.com', '888123456', 'default.png'),
(8, 'student7', '8c96c3884a827355aed2c0f744594a52', 'Hoang Van G', 'student7@example.com', '898765432', 'default.png'),
(29, 'studentx', '79f551a5212e904070051d55491c0111', 'Nguyễn Thị L', 'nguyenthig@gmail.com', '0866146782', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phoneNumber` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `imgProfile` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL primary key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`username`, `password`, `name`, `email`, `phoneNumber`, `imgProfile`, `id`) VALUES
('tattu2705', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Tất Tú gv', 'tattupro2705@gmail.com', '0866146782', 'IMG-6475604a6c7e23.82046432.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenge`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pass_challenge`
--
ALTER TABLE `pass_challenge`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
