-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 03:30 AM
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
  `role` varchar(30) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `staff_name`, `role`, `staff_id`, `department`) VALUES
('1', '1', '1', '1', '1', '1'),
('baodg_IT', '123456', 'Đinh Gia Bảo', 'Admin', 'ADM999', 'Phòng Bảo trì'),
('ducpa_IT', '123456', 'Phạm Anh Đức', 'Trưởng phòng', 'ADM666', 'Phòng IT'),
('huynq_IT', '123456', 'Nguyễn Quốc Huy', 'Admin', 'ADM158', 'Phòng IT'),
('test', '123456', 'test', '1', '1', '1'),
('truongpm_IT', '123456', 'Phùng Minh Trường', 'Admin', 'ADM589', 'Phòng IT');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `staff_id` varchar(50) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` varchar(50) NOT NULL,
  `worked` int(50) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`staff_id`, `staff_name`, `department`, `position`, `attendance_date`, `attendance_status`, `worked`) VALUES
('ST002', 'Tran Thi B', 'Phòng Kế toán', 'Nhân viên/Kỹ thuật viên', '0000-00-00', '0', 0),
('ST002', '', '', '', '2025-01-06', '0', 0),
('ST002', '', '', '', '2025-01-12', '0', 1),
('ST002', '', '', '', '2025-01-13', '0', 1),
('ST003', 'Pham Van C', 'Phòng Pháp lý', 'Trưởng phòng', '0000-00-00', '0', 0),
('ST003', '', '', '', '2025-01-12', '0', 1),
('ST003', '', '', '', '2025-01-13', '0', 1),
('ST005', 'Hoang Van E', 'Phòng Đào tạo Nội bộ', 'Nhân viên/Kỹ thuật viên', '0000-00-00', '0', 0),
('ST005', '', '', '', '2025-01-12', '0', 1),
('ST005', '', '', '', '2025-01-13', '0', 1),
('viet69.do', 'Trường', 'Phòng Kỹ thuật', 'Nhân viên/Kỹ thuật viên', '0000-00-00', '0', 0),
('viet69.do', '', '', '', '2025-01-12', '0', 1),
('viet69.do', '', '', '', '2025-01-13', '0', 1);

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
('ST001', 'Nguyen Van A', '2024-12-02', 'Nam', 'Phòng Thiết kế', 'Trưởng phòng', '', '', '', '2024-12-24', 'Đã nghỉ việc', '../HRM/Upload/ST001-Nguyen Van A.jpg'),
('ST002', 'Tran Thi B', '1985-09-20', 'Nam', 'Phòng Kế toán', 'Nhân viên/Kỹ thuật viên', '45 Tran Hung Dao, District 3', 'tranthib@gmail.com', '0923456789', '2022-05-15', 'Đang làm việc', '../HRM/Upload/ST002-Tran Thi B.jpg'),
('ST003', 'Pham Van C', '1992-12-10', 'Nam', 'Phòng Pháp lý', 'Trưởng phòng', '78 Nguyen Trai, District 5', 'phamvanc@gmail.com', '0934567890', '2021-07-20', 'Đang làm việc', '../HRM/Upload/ST003-Pham Van C.jpg'),
('ST005', 'Hoang Van E', '1995-06-18', 'Nam', 'Phòng Đào tạo Nội bộ', 'Nhân viên/Kỹ thuật viên', '56 Hai Ba Trung, District 2', 'hoangvane@gmail.com', '0956789012', '2019-02-01', 'Đang làm việc', '../HRM/Upload/ST005-Hoang Van E.jpg'),
('viet69.do', 'Trường', '0000-00-00', 'Nam', 'Phòng Kỹ thuật', 'Nhân viên/Kỹ thuật viên', '', '', '', '0000-00-00', 'Đang làm việc', '../HRM/Upload/viet69.do-Trường.jpg');

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
('1', '1', '1', 'Phòng Kế toán', '2024-11-06', 'Đã hoàn thành'),
('2', '2', '2', '2', '0000-00-00', '2'),
('20359', '1724', '12212', 'Phòng Marketing', '2024-12-12', 'Đã huỷ'),
('C001', 'Python Basics', 'John Doe', 'Phòng IT', '2025-01-15', 'Đã hoàn thành'),
('C002', 'Advanced Excel', 'Jane Smith', 'Phòng Sản xuất', '2025-02-10', 'Đang đào tạo'),
('C003', 'Data Analysis', 'Alan Turing', 'Phòng Nghiên cứu', '2025-03-05', 'Chưa bắt đầu'),
('C004', 'Digital Marketing', 'Marie Curie', 'Phòng Marketing', '2025-04-20', 'Đã hủy'),
('C005', 'Team Leadership', 'Elon Musk', 'Phòng IT', '2025-05-10', 'Đã hoàn thành'),
('Cx', 'Lập trình C', 'Nguyễn Văn A', 'Phòng IT', '2025-01-01', 'Đã kết thúc'),
('JS013', 'Javascript', 'Tester', 'Phòng IT', '2024-08-07', 'Chưa bắt đầu'),
('S001', 'Nguyen Van A', 'Phòng IT', 'Nhân viên', '0000-00-00', '8'),
('S002', 'Le Thi B', 'Phòng Sản xuất', 'Trưởng phòng', '0000-00-00', '7'),
('S003', 'Tran Van C', 'Phòng Nghiên cứu', 'Nhân viên', '0000-00-00', '9'),
('S004', 'Pham Thi D', 'Phòng Marketing', 'Nhân viên', '0000-00-00', '8'),
('S005', 'Hoang Van E', 'Phòng IT', 'Trưởng phòng', '0000-00-00', '6');

-- --------------------------------------------------------

--
-- Table structure for table `work_time`
--

CREATE TABLE `work_time` (
  `staff_id` varchar(10) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `position` varchar(50) NOT NULL,
  `workday` varchar(11) NOT NULL,
  `working_hours` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_time`
--

INSERT INTO `work_time` (`staff_id`, `staff_name`, `department`, `position`, `workday`, `working_hours`) VALUES
('35', 'Lê Hoàng Long', 'Phòng IT', 'Nhân viên/Kỹ thuật viên', '24', 'Full-time: 6h-14h'),
('36', 'Nguyễn Thị Hồng', 'Phòng IT', 'Nhân viên/Kỹ thuật viên', '24', 'Full-time: 14h-22h'),
('37', 'Nguyễn Văn Hùng', 'Phòng IT', 'Nhân viên/Kỹ thuật viên', '24', 'Part-time: 10h-14h'),
('38', 'Nguyễn Thị Hương', 'Phòng IT', 'Nhân viên/Kỹ thuật viên', '24', 'Part-time: 10h-14h'),
('S001', 'Nguyen Van A', 'Phòng IT', 'Nhân viên', '28', '8'),
('S002', 'Le Thi B', 'Phòng Sản xuất', 'Trưởng phòng', '20', '7'),
('S003', 'Tran Van C', 'Phòng Nghiên cứu', 'Nhân viên', '20', '9'),
('S004', 'Pham Thi D', 'Phòng Marketing', 'Nhân viên', '25', '8'),
('S005', 'Hoang Van E', 'Phòng IT', 'Trưởng phòng', '21', '6');

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
-- Indexes for table `work_time`
--
ALTER TABLE `work_time`
  ADD PRIMARY KEY (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
