-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 06:17 PM
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
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `staff_name`, `role`) VALUES
('baodg_IT', '123456', 'Đinh Gia Bảo', 'Admin'),
('ducpa_IT', '123456', 'Phạm Anh Đức', 'Trưởng phòng'),
('huynq_IT', '123456', 'Nguyễn Quốc Huy', 'Admin'),
('test', '123456', 'test', '1'),
('truongpm_IT', '123456', 'Phùng Minh Trường', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `staff_id` varchar(50) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_status` varchar(20) NOT NULL,
  `worked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`staff_id`, `checkin_date`, `checkin_status`, `worked`) VALUES
('ST001', '0000-00-00', '', 0),
('ST001', '2024-12-31', 'Có mặt', 1),
('ST001', '2025-01-14', '', 0),
('ST002', '2024-12-31', 'Vắng', 0),
('ST002', '2025-01-07', 'Vắng', 0),
('ST002', '2025-01-08', 'Test', 0),
('ST003', '2025-02-02', 'Có mặt', 1),
('ST004', '2024-12-30', 'Có mặt', 1),
('ST004', '2025-01-13', 'Vắng', 0),
('ST004', '2025-01-15', 'Có mặt', 1),
('ST004', '2025-01-16', 'Có mặt', 1),
('ST004', '2025-01-17', 'Có mặt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_date` date NOT NULL,
  `course_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_date`, `course_status`) VALUES
('C001', 'Python Basics', '2025-01-15', 'Đã hoàn thành'),
('C002', 'Advanced Excel', '2025-02-10', 'Đang đào tạo'),
('C003', 'Data Analysis', '2025-03-05', 'Chưa bắt đầu'),
('C004', 'Digital Marketing', '2025-04-20', 'Đã hủy'),
('C005', 'Team Leadership', '2024-11-05', 'Đã hủy'),
('Cx', 'Lập trình C', '2025-01-01', 'Đã kết thúc'),
('JS013', 'Javascript', '2024-08-07', 'Chưa bắt đầu');

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

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department`, `floor`, `status`) VALUES
('1', '1', '6', 'Đang hoạt động'),
('2', '2', '2', 'Dừng hoạt động'),
('D001', 'Phòng Nhân sự', 'Tầng 3', 'Đang hoạt động'),
('D002', 'Phòng Kỹ thuật', 'Tầng 2', 'Đang hoạt động'),
('D003', 'Phòng Kế toán', 'Tầng 4', 'Đang hoạt động'),
('D004', 'Phòng Marketing', 'Tầng 5', 'Dừng hoạt động'),
('D005', 'Phòng Bảo trì', 'Tầng 1', 'Đang hoạt động'),
('D006', 'Phòng Sản xuất', 'Tầng 2', 'Đang hoạt động'),
('D007', 'Phòng Thiết kế', 'Tầng 3', 'Đang hoạt động'),
('D008', 'Phòng IT', 'Tầng 4', 'Đang hoạt động'),
('D009', 'Phòng Nghiên cứu', 'Tầng 5', 'Dừng hoạt động'),
('D010', 'Phòng Pháp lý', 'Tầng 2', 'Đang hoạt động'),
('D014', 'Phòng Đào tạo Nội bộ', 'Tầng 5', 'Dừng hoạt động');

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `staff_id` varchar(10) NOT NULL,
  `penalty` varchar(20) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`staff_id`, `penalty`, `reason`) VALUES
('ST001', 'Sa thải', 'Huỷ hoại tài sản công ty');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_level` varchar(10) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_level`, `salary`) VALUES
('Bậc 1', 180000),
('Bậc 2', 220000),
('Bậc 3', 250000),
('Bậc 4', 280000),
('Bậc 5', 300000);

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
  `salary_level` varchar(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `dob`, `gender`, `department`, `position`, `address`, `email`, `phone`, `start_date`, `salary_level`, `status`, `profile_image`) VALUES
('ST001', 'Nguyen Van Anh', '2024-12-02', 'Nam', 'Phòng Thiết kế', 'Giám đốc', '', '', '', '2024-12-24', 'Bậc 3', 'Đã nghỉ việc', '../HRM/Upload/ST001-Nguyen Van A.jpg'),
('ST002', 'Tran Thi B', '1985-09-20', 'Nam', 'Phòng Kế toán', 'Nhân viên/Kỹ thuật viên', '45 Tran Hung Dao, District 3', 'tranthib@gmail.com', '0923456789', '2022-05-15', 'Bậc 3', 'Đang làm việc', '../HRM/Upload/ST002-Tran Thi B.jpg'),
('ST003', 'Pham Van C', '1992-12-10', 'Nam', 'Phòng Pháp lý', 'Trưởng phòng', '78 Nguyen Trai, District 5', 'phamvanc@gmail.com', '0934567890', '2021-07-20', 'Bậc 2', 'Đang làm việc', '../HRM/Upload/ST003-Pham Van C.jpg'),
('ST004', 'Nguyen Xuan Son', '1997-04-28', 'Nam', 'Phòng Sản xuất', 'Trưởng phòng', 'Nam Định', 'sonnx@vff.vn', '0123456789', '2024-12-22', 'Bậc 5', 'Đang làm việc', '../HRM/Upload/ST004-Nguyen Xuan Son.jpg'),
('ST005', 'Hoang Van E', '1995-06-18', 'Nam', 'Phòng Đào tạo Nội bộ', 'Nhân viên/Kỹ thuật viên', '56 Hai Ba Trung, District 2', 'hoangvane@gmail.com', '0956789012', '2019-02-01', 'Bậc 4', 'Đang làm việc', '../HRM/Upload/ST005-Hoang Van E.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `course_id` varchar(10) NOT NULL,
  `staff_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`course_id`, `staff_id`) VALUES
('C005', 'ST003');

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
  ADD PRIMARY KEY (`staff_id`,`checkin_date`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`) USING BTREE;

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_level`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `department` (`department`) USING BTREE;

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`course_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `Disciple` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`department`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
