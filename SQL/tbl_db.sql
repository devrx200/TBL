-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 01:07 PM
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
-- Database: `tbl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `tittle`, `location`, `description`) VALUES
(69, 'Swift', 'gallery/1725706743_swfit.jpg', 'Car Avalible'),
(70, 'Toyota-Etios', 'gallery/1725706770_Toyota-Etios.jpg', 'Car Avalible'),
(71, 'xylo', 'gallery/1725706784_xylo.jpg', 'Car Avalible'),
(72, 'Innova', 'gallery/1725706811_innova1.jpg', 'Car Avalible'),
(73, 'Honda-City', 'gallery/1725706831_honda-city.jpg', 'Car Avalible'),
(74, 'Ertiga', 'gallery/1725706858_ertiga-image.jpg', 'Car Avalible'),
(75, 'Tempo-Traveller', 'gallery/1725710682_Tempo-Traveller.jpg', 'Tempo Avalible'),
(76, 'Cars', 'car-rent-2.png', 'asdasdfas'),
(77, 'Two way Taxi', 'images/gallery/car-rent-3.png', 'sdad'),
(78, 'Your Trusted Real Estate Partner in Raipur', '', 'At Makanwalaraipur, we are committed to providing exceptional real estate services tailored to meet your specific needs. With extensive experience in Raipur\'s real estate market, we specialize in helping clients buy, sell, and lease properties, ensuring a smooth and transparent process.');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `admin_name`, `email`, `mobile_no`, `username`, `password`, `profile_picture`, `created_at`) VALUES
(1, 'CBK Technologies', 'sarthiride@gmail.com', '9301323211', 'admin', '$2y$10$2JbAL2HvFT3eqTVsNZIWuuOnV8ydFrsinsfnQllx8Jy0CuLOCHRbm', 'Profile-admin.png', '2024-07-04 23:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `address`, `mobile`, `email`, `website_url`, `created_at`, `updated_at`) VALUES
(1, '123 Main St, Springfield', '1234567890', 'example@example.com', 'https://example.com', '2024-09-11 07:20:19', '2024-09-11 07:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `tittle`, `location`, `description`) VALUES
(69, 'Swift', 'gallery/1725706743_swfit.jpg', 'Car Avalible'),
(70, 'Toyota-Etios', 'gallery/1725706770_Toyota-Etios.jpg', 'Car Avalible'),
(71, 'xylo', 'gallery/1725706784_xylo.jpg', 'Car Avalible'),
(72, 'Innova', 'gallery/1725706811_innova1.jpg', 'Car Avalible'),
(73, 'Honda-City', 'gallery/1725706831_honda-city.jpg', 'Car Avalible'),
(74, 'Ertiga', 'gallery/1725706858_ertiga-image.jpg', 'Car Avalible'),
(75, 'Tempo-Traveller', 'gallery/1725710682_Tempo-Traveller.jpg', 'Tempo Avalible'),
(76, 'Cars', 'car-rent-2.png', 'asdasdfas'),
(77, 'Two way Taxi', 'images/gallery/car-rent-3.png', 'sdad');

-- --------------------------------------------------------

--
-- Table structure for table `help_requests`
--

CREATE TABLE `help_requests` (
  `id` int(11) NOT NULL,
  `help_id` varchar(225) NOT NULL,
  `help_name` varchar(255) NOT NULL,
  `help_email` varchar(255) NOT NULL,
  `help_mobile` varchar(15) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `error_page_url` varchar(255) NOT NULL,
  `screenshot_path` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `help_requests`
--

INSERT INTO `help_requests` (`id`, `help_id`, `help_name`, `help_email`, `help_mobile`, `website_url`, `error_page_url`, `screenshot_path`, `description`, `created_at`) VALUES
(1, 'AHI0000001', 'John Doe', 'john.doe@example.com', '9876543210', 'http://example.com', 'http://example.com/error', NULL, 'Test description', '2024-09-10 04:51:42'),
(2, 'AHI0000002', 'CBK Technologies', 'sarthiride@gmail.com', '9301323211', 'https://fitcabs.com/', 'https://fitcabs.com/service.php', 'Uploads/Screenshot 2024-09-11 155902.png', 'In contact page showing this error.', '2024-09-11 10:51:31'),
(3, 'AHI0000003', 'CBK Technologies', 'sarthiride@gmail.com', '9301323211', 'https://fitcabs.com/', 'https://fitcabs.com/contact.php', 'Uploads/Screenshot 2024-09-11 155902.png', 'In this page showing error.', '2024-09-11 10:58:42'),
(4, 'AHI0000004', 'CBK Technologies', 'sarthiride@gmail.com', '9301323211', 'https://fitcabs.com/', 'https://fitcabs.com/contact.php', 'Uploads/Screenshot 2024-09-11 155902.png', 'sdasdasdasda', '2024-09-11 11:00:47');

--
-- Triggers `help_requests`
--
DELIMITER $$
CREATE TRIGGER `before_insert_help_requests` BEFORE INSERT ON `help_requests` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE next_id INT;

    -- Get the maximum numeric part of the help_id
    SELECT COALESCE(MAX(CAST(SUBSTRING(help_id, 4) AS UNSIGNED)), 0) INTO max_id
    FROM help_requests;

    -- Increment the ID
    SET next_id = max_id + 1;

    -- Set the new help_id value with prefix 'AHI'
    SET NEW.help_id = CONCAT('AHI', LPAD(next_id, 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `name`, `mobile`, `email`, `subject`, `message`, `created_at`, `action`) VALUES
(1, 'John Doe', '9876543210', 'john.doe@example.com', 'Inquiry About Service', 'I would like more information about your services.', '2024-09-16 10:58:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `logo_icon`
--

CREATE TABLE `logo_icon` (
  `id` int(11) NOT NULL,
  `header_location` varchar(200) NOT NULL,
  `footer_location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo_icon`
--

INSERT INTO `logo_icon` (`id`, `header_location`, `footer_location`) VALUES
(1, 'images/logo-icon/—Pngtree—yellow car top view_14599687.png', 'images/logo-icon/pngegg (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `tittle`, `location`, `description`) VALUES
(22, 'Cars', 'images/service/banner-left.png', 'Fit Cabs Taxi Service offers convenient Outstation Round Trip services with comfortable rides, professional drivers, and affordable rates. Enjoy hassle-free round-trip journeys with well-maintained.'),
(23, 'caa', 'images/service/car-rent-4.png', 'cacac');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `tittle`, `location`) VALUES
(1, 'Book A Cab', 'slider/1725566830_carousel-1.jpg'),
(3, 'Cars', 'slider/1725603170_carousel-2.jpg'),
(4, 'One way Taxi', 'slider/1725632006_bg-banner.jpg'),
(5, 'One way Taxi', 'slider/1725632026_car-rent-2.png'),
(6, 'Two way Taxi', 'images/slider/carousel-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `youtube` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `youtube`, `facebook`, `twitter`, `instagram`) VALUES
(1, 'https://www.youtube.com/watch?v=wIKNZxdcZYQ', 'https://www.facebook.com/narendramodi/', 'https://x.com/narendramodi?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor', 'https://www.instagram.com/narendramodi/?hl=en');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_requests`
--
ALTER TABLE `help_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_icon`
--
ALTER TABLE `logo_icon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `help_requests`
--
ALTER TABLE `help_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logo_icon`
--
ALTER TABLE `logo_icon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
