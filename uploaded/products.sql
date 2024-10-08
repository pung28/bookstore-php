-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2023 lúc 03:51 PM
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
  `described` varchar(9999) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `products` (`id`, `name`, `product_image`, `price`, `color`, `ram`, `cpu`, `described`, `cate_id`) VALUES
(29, 'Laptop gaming MSI Katana GF66 12UDK 814VN', '', '25.990.000', 'Red', '16GB(8GBx2)DDR4-3200Mhz', 'Intel Core i7-12650H (upto 4.7GHz, 24MB)', 'MSI Katana GF66 được trang bị bộ vi xử lý Intel Core i7-12650H với xung nhịp cơ bản là 2.3GHz có thể nâng cấp lên đến 4.7GHz. Mọi thao tác từ văn phòng cơ bản đến thiết kế nâng cao đều không thể làm khó được chiếc laptop này. Kết hợp cùng VGA NVIDIA GeForce RTX 3050 Ti đem lại trải nghiệm đồ họa đẹp mắt với tốc độ xử lý mượt mà trên mọi khung hình. Laptop MSI gaming có thể đáp ứng mọi yêu cầu khắc nghiệt của người dùng ở bất kỳ tựa game cấu hình cao như là FPS, MOBA,...', 4);

--
-- Chỉ mục cho các bảng đã đổ
--

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
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
