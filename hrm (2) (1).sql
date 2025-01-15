-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 09:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `staff_name`, `role`, `staff_id`, `department`) VALUES
('Admin', '123456', 'Địt mẹ mày', 'Nhân viên/Kỹ thuật viên', 'DMM141', 'Phòng Thiết kế'),
('baodg', '123456', 'Đinh Gia Bảo', 'Admin', 'ADM999', 'Phòng Bảo trì'),
('ducpa', '123456', 'Phạm Anh Đức', 'Trưởng phòng', 'ADM666', 'Phòng IT'),
('huynq', '123456', 'Nguyễn Quốc Huy', 'Admin', 'ADM158', 'Phòng IT'),
('truongpm', '123456', 'Phùng Minh Trường', 'Admin', 'ADM589', 'Phòng IT');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `staff_id` varchar(10) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` int(50) NOT NULL,
  `worked` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`staff_id`, `staff_name`, `department`, `position`, `attendance_date`, `attendance_status`, `worked`) VALUES
('ST005', '', '', '', '2025-01-13', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` varchar(10) NOT NULL,
  `department` varchar(30) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salarygrade`
--

CREATE TABLE `salarygrade` (
  `staff_id` varchar(50) NOT NULL,
  `allowance` int(11) DEFAULT 0,
  `salary_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_scale`
--

CREATE TABLE `salary_scale` (
  `level` int(11) NOT NULL,
  `coefficient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_scale`
--

INSERT INTO `salary_scale` (`level`, `coefficient`) VALUES
(1, 200),
(2, 400),
(3, 600),
(4, 800),
(5, 1000),
(7, 20000000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(10) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(5) NOT NULL,
  `department` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `dob`, `gender`, `department`, `position`, `address`, `email`, `phone`, `start_date`, `status`, `profile_image`) VALUES
('ST001', 'Nguyễn Văn A', '1990-01-01', 'Nam', 'Phòng Kế toán', 'Nhân viên', 'Hà Nội', 'nva@gmail.com', '0123456789', '2020-01-01', 'Đang làm việc', 'default.png'),
('ST002', 'Trần Thị B', '1992-02-02', 'Nữ', 'Phòng Nhân sự', 'Nhân viên', 'Hải Phòng', 'ttb@gmail.com', '0987654321', '2021-02-02', 'Đang làm việc', 'default.png'),
('ST003', 'Phạm Văn C', '1991-03-03', 'Nam', 'Phòng IT', 'Trưởng phòng', 'Đà Nẵng', 'pvc@gmail.com', '0321654987', '2019-03-03', 'Đang làm việc', 'default.png'),
('ST004', 'Lê Văn D', '1988-04-04', 'Nam', 'Phòng Kỹ thuật', 'Nhân viên', 'TP.HCM', 'lvd@gmail.com', '0789456123', '2022-04-04', 'Đang làm việc', 'default.png'),
('ST005', 'Hoàng Thị E', '1995-05-05', 'Nữ', 'Phòng Đào tạo', 'Nhân viên', 'Cần Thơ', 'hte@gmail.com', '0567891234', '2023-05-05', 'Đang làm việc', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `department` varchar(30) NOT NULL,
  `course_date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`course_id`, `course_name`, `trainer`, `department`, `course_date`, `status`) VALUES
('1', '1', '3', 'Phòng Kế toán', '2024-12-10', 'Đang đào tạo'),
('20359', '1724', '12212', 'Phòng Marketing', '2024-12-12', 'Đã huỷ'),
('C001', 'Kỹ năng lãnh đạo', 'Nguyễn Văn A', 'Quản lý', '2024-01-10', 'Đã hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `work_days`
--

CREATE TABLE `work_days` (
  `staff_id` varchar(50) NOT NULL,
  `work_date` date NOT NULL,
  `status` enum('Present','Absent','Leave') DEFAULT 'Present',
  `remarks` varchar(255) DEFAULT NULL,
  `worked` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`staff_id`,`attendance_date`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `salarygrade`
--
ALTER TABLE `salarygrade`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk` (`salary_level`);

--
-- Indexes for table `salary_scale`
--
ALTER TABLE `salary_scale`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `work_days`
--
ALTER TABLE `work_days`
  ADD PRIMARY KEY (`staff_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salarygrade`
--
ALTER TABLE `salarygrade`
  ADD CONSTRAINT `fk` FOREIGN KEY (`salary_level`) REFERENCES `salary_scale` (`level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salarygrade_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `work_days`
--
ALTER TABLE `work_days`
  ADD CONSTRAINT `work_days_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
