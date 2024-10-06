-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 06, 2024 at 08:29 AM
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
-- Database: `collegedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `r_user_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(25) NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `location` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `photo_location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`r_user_id`, `dob`, `age`, `department`, `gender`, `location`, `phone_number`, `photo_location`) VALUES
(13, '1986-04-25', 40, 'IT', 'Male', 'Chennai', '91893400129', ''),
(14, '1986-04-25', 40, 'IT', 'Male', 'Chennai', '91893400129', 'view/images/beam.jpg'),
(15, '1986-04-25', 40, 'IT', 'Male', 'Chennai', '91893400129', 'view/images/amitah.jpg'),
(16, '1986-04-25', 40, 'IT', 'Male', 'Chennai', '91893400129', 'view/images/dhanush.jpg'),
(17, '1986-04-25', 40, 'IT', 'Male', 'Chennai', '91893400129', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active_status` enum('1','0') NOT NULL,
  `user_type` enum('student','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_name`, `last_name`, `email`, `password`, `active_status`, `user_type`) VALUES
(1, 'WILFREN', 'M', 'wilfren@gmail.com', 'V2lsZnJlbkAxMjM=', '1', 'admin'),
(2, 'VIJAY', 'KUMAR', 'vijay@gmail.com', 'VmlqYXlAMTIz', '', 'student'),
(3, 'AJITH', 'KUMAR', 'ajith@gmail.com', 'QWppdGhAMTIz', '', 'student'),
(4, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(5, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(6, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(7, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(8, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(9, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(10, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(11, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(12, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(13, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '', 'student'),
(14, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '1', 'student'),
(15, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '1', 'student'),
(16, 'SURYA', 'KUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '1', 'student'),
(17, 'SURYA', 'KUMARI', 'suriyakumari@gmail.com', 'U3VyaXlhQDEyMw==', '1', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
