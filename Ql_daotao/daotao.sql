-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 29, 2024 lúc 06:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qldaotao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daotao`
--

CREATE TABLE `daotao` (
  `Id` varchar(10) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Trainer` varchar(50) NOT NULL,
  `Date` date DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `daotao`
--

INSERT INTO `daotao` (`Id`, `Name`, `Trainer`, `Date`, `Department`, `Status`) VALUES
('11101', 'Công Nghệ Thông Tin', 'Triệu Đình Mạnh', '0000-00-00', 'VP 1 cửa', 'Đang đào tạo'),
('11103', 'Kinh Tế', 'Lã Phong Lâm', '0000-00-00', 'Phòng gddt', 'Đang đào tạo');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `daotao`
--
ALTER TABLE `daotao`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
