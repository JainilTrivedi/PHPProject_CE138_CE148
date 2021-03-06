-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 03:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('superuser', 'superuser');

-- --------------------------------------------------------

--
-- Table structure for table `previousattempts`
--

CREATE TABLE `previousattempts` (
  `id` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `your_score` double DEFAULT NULL,
  `total_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `previousattempts`
--

INSERT INTO `previousattempts` (`id`, `correct_answers`, `student_id`, `quiz_id`, `your_score`, `total_marks`) VALUES
(2, 2, 1, 74, 33.33, 6),
(3, 0, 1, 75, 0, 10),
(4, 0, 1, 75, 0, 10),
(5, 2, 1, 78, 50, 4),
(6, 2, 1, 78, 50, 4),
(7, 2, 1, 74, 66.67, 6),
(8, 2, 1, 74, 66.67, 6),
(9, 2, 1, 78, 66.67, 4),
(10, 3, 1, 74, 100, 6),
(11, 3, 1, 74, 100, 6),
(12, 3, 1, 74, 100, 6),
(13, 3, 1, 74, 100, 6),
(14, 3, 1, 74, 100, 6),
(15, 3, 1, 74, 100, 6),
(16, 3, 1, 74, 100, 6),
(17, 3, 1, 74, 100, 6),
(18, 1, 1, 74, 33.33, 6),
(19, 1, 1, 74, 33.33, 6),
(20, 1, 1, 74, 33.33, 6),
(21, 1, 1, 74, 33.33, 6),
(22, 1, 1, 74, 33.33, 6),
(23, 1, 1, 74, 33.33, 6),
(24, 1, 1, 74, 33.33, 6),
(25, 2, 1, 74, 66.67, 6),
(26, 2, 1, 74, 66.67, 6),
(27, 2, 1, 74, 66.67, 6),
(28, 2, 1, 74, 66.67, 6),
(29, 2, 1, 74, 66.67, 6),
(30, 2, 1, 74, 66.67, 6),
(31, 2, 1, 74, 66.67, 6),
(32, 2, 1, 74, 66.67, 6),
(33, 2, 1, 74, 66.67, 6),
(34, 2, 1, 74, 66.67, 6),
(35, 2, 1, 74, 66.67, 6),
(36, 2, 1, 74, 66.67, 6),
(37, 2, 1, 74, 66.67, 6),
(38, 2, 1, 74, 66.67, 6),
(39, 2, 1, 74, 66.67, 6),
(40, 2, 1, 74, 66.67, 6),
(41, 2, 1, 74, 66.67, 6),
(42, 2, 1, 74, 66.67, 6),
(43, 2, 1, 74, 66.67, 6),
(44, 2, 1, 74, 66.67, 6),
(45, 2, 1, 74, 66.67, 6),
(46, 2, 1, 74, 66.67, 6),
(47, 2, 1, 74, 66.67, 6),
(48, 2, 1, 74, 66.67, 6),
(49, 2, 1, 74, 66.67, 6),
(50, 2, 1, 74, 66.67, 6);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `ques` varchar(2083) NOT NULL,
  `optionA` varchar(127) NOT NULL,
  `optionB` varchar(127) NOT NULL,
  `optionC` varchar(127) NOT NULL,
  `optionD` varchar(127) NOT NULL,
  `correct_option` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `ques`, `optionA`, `optionB`, `optionC`, `optionD`, `correct_option`) VALUES
(1, 74, 'PHP is used in?', 'android dev', 'ios dev', 'web dev', 'none of the above', 'c'),
(2, 74, 'End tag of PHP is ?', '</php>', '?>', '</?php>', '<?php>', 'b'),
(3, 74, 'Did u like the quiz', 'yes', '-', '-', 'no', 'a'),
(4, 75, 'What is your name?', 'Jainil', 'Dhruval', 'Vrundan', 'Harprit', 'b'),
(5, 75, 'What is your name?', 'Jainil', 'Dhruval', 'Vrundan', 'Harprit', 'c'),
(6, 75, 'What is your name?', 'Telusko', 'harry', 'Durgesh', 'Apoorva Sir', 'd'),
(7, 78, 'The term PHP is an acronym for PHP:_______________?', 'Hypertext Preprocessor', 'Hypertext multiprocessor', 'Hypertext markup Preprocessor', 'Hypertune Preprocessor', 'A'),
(8, 78, 'Who is founder of PHP?', 'Tim Berners-Lee', 'Brendan Eich', 'Guido van Rossum', 'Rasmus Lerdorf', 'D'),
(9, 78, 'In which year PHP was created ?', '1993', '1994', '1995', '1996', 'B'),
(10, 79, 'What is 1+1?', '2', '3', '0', '1', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(100) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `total_question` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `total_marks`, `total_question`, `teacher_id`, `subject_id`) VALUES
(74, 'PHP_1', 6, 3, 2, 1),
(75, 'PHP_2', 10, 3, 2, 2),
(78, 'QUIZ_3', 4, 3, 2, 1),
(79, 'Math1', 2, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `contact`, `email`, `username`, `password`) VALUES
(1, 'Harpritsinh', 'Yadav', '12345679', 'hjy@ddu', 'harprit123', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(1, 'PHP'),
(2, 'CSA'),
(3, 'Maths'),
(10, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_no` varchar(10) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `firstname`, `lastname`, `Email`, `Phone_no`, `username`, `password`) VALUES
(2, 'jai', 'tri', 'jt@ddu', '999', 'jnil', 'abc'),
(5, 'harprit', 'yadav2', 'teacher@ddu', '190909', 'harprit2', 'abcd'),
(7, 'abcd', 'abcd', 'abcd@ddu', '12899', 'hjy', 'abcd'),
(8, 'abcd', 'aa', 'abc@ddu', '190', 'hjy678', 'ab'),
(10, 'abcd', 'abcd', 'test@ddu', '1234567890', 'testddu', 'abcdAB1@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `previousattempts`
--
ALTER TABLE `previousattempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_quizid` (`quiz_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `previousattempts`
--
ALTER TABLE `previousattempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `previousattempts`
--
ALTER TABLE `previousattempts`
  ADD CONSTRAINT `fk_quizid` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `previousattempts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
