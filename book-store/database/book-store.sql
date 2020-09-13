-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 02:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(29, 'Nuôi Con Không Phải Là Cuộc Chiến 2 (Trọn Bộ 3 Tập)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '319000', 0, 34, 'zjcaqp6e.jpg', '2020-09-06 00:00:00', '', '2020-09-06 00:00:00', '', 'active', 2, 1),
(30, 'Để Con Được Ốm (Tái Bản 2018)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n', '95000', 1, 37, 'duz5nawt.jpg', '2020-09-06 00:00:00', '', '2020-09-11 04:30:15', 'admin123a', 'active', 2, 1),
(31, '90% Trẻ Thông Minh Nhờ Cách Trò Chuyện Đúng Đắn Của Cha Mẹ', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n', '39000', 1, 31, '2m6zr0us.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 2, 1),
(32, 'Ăn Dặm Kiểu Nhật (Tái Bản 2018)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '149000', 0, 35, '017pkivn.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(33, 'Nuôi Con Không Phải Là Cuộc Chiến (Tái Bản 2020)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '99000', 0, 37, 'ue3fpgdm.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(34, 'Bác Sĩ Riêng Của Bé Yêu - Chào Con! Ba Mẹ Đã Sẵn Sàng (Tái Bản)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '95000', 0, 37, 'a0o9p8gn.jpg', '2020-09-06 00:00:00', '', '2020-09-06 00:00:00', '', 'active', 2, 1),
(35, 'Ăn Dặm Không Phải Là Cuộc Chiến (Tái Bản)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '219000', 0, 38, 'fcj2sh03.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(36, 'Thử Thách Trí Tuệ', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '89000', 0, 11, '7ug2b69f.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(37, 'Cách Khen, Cách Mắng, Cách Phạt Con', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '59000', 0, 35, 'e9kfx78q.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(38, 'Chờ Đến Mẫu Giáo Thì Đã Muộn', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '69000', 0, 30, 'y5t1pxg8.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 1),
(39, 'Bộ Luật Dân Sự (Hiện Hành)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '74000', 0, 18, '2pcq9wbu.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(40, 'Bộ Luật Lao Động (sửa đổi) Năm 2019', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.\r\n\r\nCuốn sách bao gồm lý thuyết cơ bản về chuyển động, những bức ảnh đẹp, những điều không nên làm và các tư thế yoga như tư thế đứng, ngồi, gập lưng, giữ thăng bằng cánh tay, tư thế phục hồi và bài tập thở yoga.', '65000', 0, 23, 'rpl6whgk.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(41, 'Bộ Luật Hình Sự Hiện Hành (Bộ Luật Năm 2015, Sửa Đổi, Bổ Sung Năm 2017)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '111000', 0, 0, '6xhepmrn.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(42, 'Bộ Luật Tố Tụng Hình Sự (Hiện Hành)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '96000', 0, 0, '0rngyxob.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 3, 2),
(43, 'Luật Đất Đai', '', '35000', 0, 0, '6uay4mwg.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(44, 'Luật Doanh Nghiệp (Hiện Hành)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '54000', 0, 23, '8gnpd7qz.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(45, 'Điệp Viên Hoàn Hảo X6 (Tái Bản)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '168000', 0, 26, 'lneodahq.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(46, 'Từ điển pháp luật Việt Nam', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '559000', 0, 41, '0yopumcw.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(47, 'Luật Kinh Doanh Bất Động Sản Và Văn Bản Hướng Dẫn Thi Hành', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '48000', 0, 0, 'metc9d1y.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(48, 'Luật Thương Mại', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '30000', 0, 0, 'wuyijhfq.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 2),
(49, 'Giáo Trình Kỹ Thuật Lập Trình C Căn Bản Và Nâng Cao', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '135000', 1, 25, '6wpm9450.jpg', '2020-09-06 00:00:00', '', '2020-09-11 04:30:23', 'admin123a', 'active', 2, 3),
(50, 'Giáo Trình Tự Học AutoCAD 2019 Thực Hành Bằng Hình Minh Họa (Kèm CD Bài Tập) (Tái bản năm 2020)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '110000', 0, 0, 'kn7jx1ur.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 3),
(51, 'Lập trình hướng đối tượng JAVA core dành cho người mới bắt đầu học lập trình', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '299000', 1, 37, 'mpyeoq3s.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 2, 3),
(52, 'Tin Học Văn Phòng, Tự Học Excel Bằng Hình Ảnh (Phiên Bản 2019-2016-2013)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '134000', 0, 20, 'oashfyrp.jpg', '2020-09-06 00:00:00', '', '2020-09-11 03:30:05', 'admin123a', 'active', 2, 3),
(53, 'Giáo Trình Thực Hành Microsoft Excel 2019 Căn Bản & Nâng Cao (Sách kèm theo CD Bài Tập)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '120000', 0, 8, 'hd6uismo.jpg', '2020-09-06 00:00:00', '', '2020-09-11 03:30:51', 'admin123a', 'active', 2, 3),
(54, 'Sách Luyện thi hội thi tin học trẻ với Scratch 3.0 bảng A1_Thi kỹ năng lập trình dành cho cấp Tiểu học', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '200000', 1, 5, 'jtf7b451.png', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 2, 3),
(55, 'Tự Học Photoshop CC Toàn Tập', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '120000', 0, 25, '4m5ac6np.jpg', '2020-09-06 00:00:00', '', '2020-09-11 12:30:30', 'admin123a', 'active', 2, 3),
(56, 'Tin Học Văn Phòng Microsoft Office Dành Cho Người Bắt Đầu Dùng Cho Các Phiên Bản 2019 -2016-2013', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '125000', 1, 25, 'd7g84bwc.jpg', '2020-09-06 00:00:00', '', '2020-09-11 04:30:24', 'admin123a', 'active', 2, 3),
(57, 'Sách Lập trình với Scratch 3.0 (Dành cho học sinh 8-14 tuổi)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '200000', 0, 5, '51zofru7.png', '2020-09-06 00:00:00', '', '2020-09-11 04:30:24', 'admin123a', 'active', 2, 3),
(58, 'Thực Hành Microsoft Word - Excel - PowerPoint 2016 Bằng Các Tuyệt Chiêu (Sách kèm theo CD Bài tập) (Tái bản năm 2020)', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '79000', 1, 12, 'gfar18m6.jpg', '2020-09-06 00:00:00', '', '2020-09-11 04:30:24', 'admin123a', 'active', 2, 3),
(59, 'Tự Học Nhanh Đồ Họa Trên Illustrator 8.0 Và 9.0', 'Rất nhiều người học cảm nhận cuốn sách hatha yoga này là một phần vô giá trong hành trình tập luyện yoga của họ. Tác giả Donna Farhi mang đến cho độc giả cái nhìn toàn diện về hành trình trải nghiệm yoga.\r\n\r\nTheo tác giả, yoga để cho các tư thế luyện tập đi vào cuộc sống của chúng ta thông qua các quy tắc như thở, tỏa, tập trung, hỗ trợ, sắp xếp và tham gia.', '30000', 1, 0, 'j83t2bqh.jpg', '2020-09-06 00:00:00', '', '2020-09-11 04:30:18', 'admin123a', 'active', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text DEFAULT NULL,
  `pictures` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) VALUES
('6bthcd3', 'admin123a', '[\"31\",\"49\"]', '[\"26,910\",\"101,250\"]', '[\"1\",\"1\"]', '[\"90% Trẻ Thông Minh Nhờ Cách Trò Chuyện Đúng Đắn Của Cha Mẹ\",\"Giáo Trình Kỹ Thuật Lập Trình C Căn Bản Và Nâng Cao\"]', '[\"2m6zr0us.jpg\",\"6wpm9450.jpg\"]', 0, '2020-09-12 11:27:38'),
('tx8h1z6', 'admin123a', '[\"31\",\"49\",\"51\"]', '[\"26,910\",\"101,250\",\"188,370\"]', '[\"1\",\"2\",\"1\"]', '[\"90% Trẻ Thông Minh Nhờ Cách Trò Chuyện Đúng Đắn Của Cha Mẹ\",\"Giáo Trình Kỹ Thuật Lập Trình C Căn Bản Và Nâng Cao\",\"Lập trình hướng đối tượng JAVA core dành cho người mới bắt đầu học lập trình\"]', '[\"2m6zr0us.jpg\",\"6wpm9450.jpg\",\"mpyeoq3s.jpg\"]', 0, '2020-09-13 12:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `showHome` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `showHome`, `ordering`) VALUES
(1, 'Bà mẹ - Em bé', 'pb5v1nj0.jpg', '2020-09-06 00:00:00', '', '2020-09-11 05:30:39', 'admin123a', 'active', 'active', 21),
(2, 'Chính Trị - Pháp Lý', 'mt8d0bsj.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:50', 'admin123a', 'active', 'active', 2),
(3, 'Công Nghệ Thông Tin', 'fl20qgxd.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:52', 'admin123a', 'active', 'active', 3),
(4, 'Giáo Khoa - Giáo Trình', '39yak8r1.jpg', '2020-09-06 00:00:00', '', '2020-09-11 05:30:56', 'admin123a', 'active', 'inactive', 2),
(5, 'Học Ngoại Ngữ', '25mf8poi.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(6, 'Khoa Học - Kỹ Thuật', '0yrjmfgh.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(7, 'Kiến Thức Tổng Hợp', '8cjymqvn.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(8, 'Lịch sử', 'jyr2wgas.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(9, 'Nông - Lâm - Ngư Nghiệp', 'trjv78yn.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(10, 'Tham Khảo', 'rzt1piou.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(11, 'Thường Thức - Gia Đình', '8zvb5apk.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(12, 'Tâm lý - Giới tính', 'o1wcryhm.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 'inactive', 2),
(13, 'Tôn Giáo - Tâm Linh', 'uowbincp.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(14, 'Văn Hóa - Địa Lý - Du Lịch', 'sxf0yldz.jpg', '2020-09-06 00:00:00', '', NULL, NULL, 'active', 'inactive', 2),
(15, 'Y Học', '4sjr9mhu.jpg', '2020-09-06 00:00:00', '', '0000-00-00 00:00:00', '', 'active', 'inactive', 2),
(16, 'Kinh Tế', 'swgj7k2p.png', '2020-09-06 00:00:00', '', '2020-09-10 11:30:19', 'admin123a', 'active', 'inactive', 2),
(17, 'Kỹ Năng Sống', '273d8smx.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:18', 'admin123a', 'active', 'inactive', 2),
(18, 'Thiếu Nhi', 'dybkw0qa.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:16', 'admin123a', 'active', 'inactive', 2),
(19, 'Văn Học', 'etydljp9.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:25', 'admin123a', 'active', 'inactive', 2),
(20, 'Truyện Tranh - Manga - Comic', 'g3qdepsa.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:38', 'admin123a', 'active', 'inactive', 2),
(21, 'Tạp Chí - Catalogue', '1gkslacp.jpg', '2020-09-06 00:00:00', '', '2020-09-10 11:30:38', 'admin123a', 'active', 'inactive', 2),
(22, 'Từ Điển', 'bdn32yao.jpg', '2020-09-06 00:00:00', '', '2020-09-11 12:30:58', 'admin123a', 'active', 'inactive', 2),
(23, 'Điện Ảnh - Nhạc - Họa', 't2cfq8a3.jpg', '2020-09-06 00:00:00', '', '2020-09-11 12:30:57', 'admin123a', 'active', 'inactive', 2);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `privilege_id` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`, `picture`) VALUES
(19, 'Admin', 1, '2013-11-11 00:00:00', 'admin', '2020-09-10 01:30:08', 'admin123a', 'active', 5, '1,2,3,4,5,6,7,8,9,10', ''),
(20, 'Manager', 1, '2013-11-07 00:00:00', 'admin', '2020-09-10 01:30:48', 'admin123a', 'active', 4, '1,2,3,4,6,7,8,9,10', ''),
(44, 'Seller1', 1, '2020-08-30 10:50:56', 'admin111', '2020-09-10 01:30:47', 'admin123a', 'active', 2, '', ''),
(56, '123', 0, '2020-09-10 02:30:08', 'admin123a', '2020-09-10 02:30:38', 'admin123a', 'inactive', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'admin', 'user', 'index'),
(2, 'Thay đổi status của người dùng', 'admin', 'user', 'status'),
(3, 'Cập nhật thông tin của người dùng', 'admin', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'admin', 'user', 'ajaxStatus'),
(5, 'Xóa một hoặc nhiều người dùng', 'admin', 'user', 'trash'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'admin', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'admin', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'admin', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'admin', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'admin', 'index', 'profile');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_ip` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `address` varchar(250) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `address`, `phone`, `group_id`) VALUES
(1, 'nvan', 'nvan@gmail.com', 'Nguyễn Văn An', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'admin111', '0000-00-00 00:00:00', NULL, 'inactive', 4, '', NULL, 19),
(2, 'nvb', 'nvb@gmail.com', 'Nguyễn Văn B', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '1', '2020-09-10 07:30:33', 'admin123a', '0000-00-00 00:00:00', NULL, 'inactive', 3, '', NULL, 2),
(3, 'nvc', 'nvc@gmail.com', 'Nguyễn Văn C', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '1', '2020-09-10 07:30:05', 'admin123a', '0000-00-00 00:00:00', NULL, 'inactive', 2, '', NULL, 3),
(4, 'admin', 'admin@gmail.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 'admin123a', '0000-00-00 00:00:00', NULL, 'inactive', 1, '', NULL, 19),
(6, 'nguyenvana2', 'lthlan55@gmail.com', 'Admin 3', '', '0000-00-00 00:00:00', NULL, '2020-09-10 07:30:01', 'admin123a', '2013-11-19 18:11:09', '127.0.0.1', 'active', 10, '', NULL, 19),
(7, 'nguyenvana4', 'lthlan56@gmail.com', '', '', '0000-00-00 00:00:00', NULL, '2020-09-10 07:30:08', 'admin123a', '2013-11-19 18:11:08', '127.0.0.1', 'inactive', 10, '', NULL, 18),
(8, 'nguyenvana12', 'lthlan541@gmail.com', 'Admin 3', '', '0000-00-00 00:00:00', NULL, '2020-09-10 07:30:01', 'admin123a', '2013-11-19 18:11:06', '127.0.0.1', 'active', 11, '', NULL, 20),
(11, 'admin01', 'admin01@gmail.com', NULL, '13559c78516a57e5325bbdf3990cdc5f', '2020-08-22 00:00:00', '1', '2020-09-10 07:30:43', 'admin123a', NULL, NULL, 'inactive', 22, '', NULL, 20),
(23, 'admin123a', 'mail123@gmail.com', 'Văn Duy', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2020-09-11 09:30:20', 'admin123a', '2020-09-06 22:09:10', '::1', 'active', 10, 'nhà tui ở TPHCM', 363136814, 19),
(25, 'admin123123', 'mail123123@gmail.com', NULL, 'e9ece777268bd856f7dedebb9c506331', '2020-09-09 09:18:02', 'admin123a', '2020-09-10 08:30:43', 'admin123a', NULL, NULL, 'inactive', 8, '', NULL, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
