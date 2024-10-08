-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2023 lúc 10:29 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laptopmvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staffs`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `staffs`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Khanh', 'pung28@p', '0963395619', '28052003'),
(4, 'Khanhs', '0963395619', '0523608504', 's'),
(5, 'Linh', 'linh@a', '123456', '8888');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `amount` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Acer'),
(3, 'Asus');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `dob`, `phone`, `address`) VALUES
(1, 'Dương Việt Hoàng', '2023-03-17', '963395619424', 'Minh Khai'),
(2, 'Phạm Việt Dũng', '2023-03-13', '013456789', 'Biệt phủ Hà Đông'),
(3, 'Nguyễn Phúc Nhật Thành', '2023-03-11', '0523608504', 'pungss');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `price` varchar(255) NOT NULL,
  `color` varchar(15) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `cpu` varchar(255) NOT NULL,
  `described` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `products` (`id`, `name`, `product_image`, `price`, `color`, `ram`, `cpu`, `described`, `release_date`, `cate_id`) VALUES
(4, 'Acer Nitro 5 Eagle', 'uploaded/asus-rog-strix-gaming-g513ih-r7-hn015w-notelapcopy.jpg', '25.000.000', 'Blue', '', '', 'nice xu', '2023-04-20', 1),
(5, 'Acer Nitro 5 Tiger', 'uploaded/hp-15s-fq2662tu-i3-6k795pa-180123-093817-600x600.jpg', '30.000.000', 'Pink', '', '', 'aaa', '2023-04-13', 1),
(6, 'Acer Nitro 5 Shark', 'uploaded/dell-vostro-5410-i5-11320h-8gb-512gb-office-h-s-600x600.jpg', '30.000.000', 'Red Blue', '', '', 'aaa', '2023-04-13', 1),
(14, 'Asus 1', 'uploaded/acer-aspire-a514-54-511g-i5-nxa28sv009-(14).jpg', '15.000.000', 'Red', '', '', 'nice xu', '2023-03-31', 3),
(25, 'Asus 1', 'uploaded/apple-macbook-air-2020-mgn63saa-(69).jpg', '15.000.000', 'Blue', '', '', 'aaa', '2023-04-20', 3),
(26, 'Acer Nitro 5 Shark', 'uploaded/acer-travelmate-b3-tmb311-31-c2hb-nxvnfsv006-(22).jpg', '15.000.000', 'Blue', '', '', 'aaa', '2023-04-06', 3),
(27, 'Asus 2', 'uploaded/vi-vn-asus-rog-strix-gaming-g513ih-r7-hn015w-1.jpg', '123456', 'Blue', '', '', 'aaa', '2023-04-15', 3),
(28, 'Asus TUF Gaming F15', 'uploaded/asus tuf gaming.png', '15.000.000', 'Black', '8 GB (1 thanh 8 GB), DDR4, 2933 MHz', 'Intel, Core i5, 10300H', 'ssssssss', '2023-03-30', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `staffs`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `bill_details_ibfk_2` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `staffs`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Các ràng buộc cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  ADD CONSTRAINT `bill_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
