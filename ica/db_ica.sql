-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2018 at 02:18 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ica`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `u_name` tinytext NOT NULL,
  `u_email` tinytext NOT NULL,
  `u_password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_canclect`
--

CREATE TABLE `tbl_canclect` (
  `course_name` int(11) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_group` varchar(500) NOT NULL,
  `course_subname` varchar(500) NOT NULL,
  `les_time` varchar(500) NOT NULL,
  `les_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portfolio`
--

CREATE TABLE `tbl_portfolio` (
  `student_name` varchar(500) NOT NULL,
  `student_surname` varchar(500) NOT NULL,
  `course_name` varchar(500) NOT NULL,
  `course_level` varchar(500) NOT NULL,
  `stud_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_profile` blob NOT NULL,
  `staff_name` tinytext NOT NULL,
  `staff_surname` tinytext NOT NULL,
  `staff_subject` tinytext NOT NULL,
  `staff_email` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vacancy`
--

CREATE TABLE `tbl_vacancy` (
  `job_place` varchar(500) NOT NULL,
  `job_subject` varchar(500) NOT NULL,
  `job_type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
