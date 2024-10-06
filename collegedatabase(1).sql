-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 06, 2024 at 08:16 PM
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
(2, '1990-12-24', 40, 'IT', 'Male', 'Chennai', '9845938751', 'view/images/ajith.jpg'),
(3, '1985-04-05', 30, 'ECE', 'Male', 'Chennai', '9834091873', 'view/images/siva.jpg'),
(4, '1982-05-22', 40, 'ECE', 'Male', 'Chennai', '9283401928', 'view/images/vijay.jpg'),
(5, '1983-11-06', 40, 'CSE', 'Male', 'Chennai', '9812093478', 'view/images/suriya.jpg'),
(6, '1981-11-09', 30, 'MECH', 'Female', 'Chennai', '9012672378', 'view/images/shruthi.jpg'),
(7, '1957-08-25', 70, 'EEE', 'Male', 'Chennai', '6901297845', 'view/images/kamal.jpg'),
(8, '1983-11-28', 35, 'CIVIL', 'Male', 'Chennai', '8921309456', 'view/images/dhanush.jpg'),
(9, '1988-11-27', 40, 'IT', 'Male', 'Chennai', '932485643', 'view/images/ravi.jpg'),
(10, '1982-05-20', 35, 'ECE', 'Female', 'Mumbai', '709123845', 'view/images/shreya.webp'),
(11, '1949-05-23', 78, 'ECE', 'Male', 'Mumbai', '7012985039', 'view/images/amitah.jpg'),
(12, '1983-03-22', 45, 'MECH', 'Male', 'Chennai', '9012672398', 'view/images/antony.jpg');

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
(2, 'AJITH', 'KUMAR', 'ajith@gmail.com', 'QWppdGhAMTIz', '1', 'student'),
(3, 'SIVA', 'KARTHIKEYAN', 'siva@gmail.com', 'U2l2YUAxMjM=', '1', 'student'),
(4, 'VIJAY', 'JOSEPH', 'vijay@gmail.com', 'VmlqYXlAMTIz', '1', 'student'),
(5, 'SURIYA', 'SIVAKUMAR', 'suriya@gmail.com', 'U3VyaXlhQDEyMw==', '1', 'student'),
(6, 'SHRUTHI', 'HASAN', 'shruthi@gmail.com', 'U2hydXRoaUAxMjM=', '1', 'student'),
(7, 'KAMAL', 'HASAN', 'kamal@gmail.com', 'S2FtYWxAMTIz', '1', 'student'),
(8, 'DHANUSH', 'DON', 'dhanush@gmail.com', 'RGhhbnVzaEAxMjM=', '1', 'student'),
(9, 'JEYAM', 'RAVI', 'ravi@gmail.com', 'UmF2aUAxMjM=', '1', 'student'),
(10, 'SHREYA', 'LAVANYA', 'shreya@gmail.com', 'U2hyZXlhQDEyMw==', '1', 'student'),
(11, 'AMITAH', 'BACHAN', 'amitah@gmail.com', 'QW1pdGFoQDEyMw==', '1', 'student'),
(12, 'VIJAY', 'ANTONY', 'antony@gmail.com', 'VmlqYXlAMTIz', '1', 'student');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
