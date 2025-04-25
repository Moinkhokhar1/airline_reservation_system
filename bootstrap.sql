-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 25, 2025 at 11:11 AM
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
-- Database: `bootstrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_seats`
--

CREATE TABLE `booked_seats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat` varchar(10) NOT NULL,
  `flight_date` date NOT NULL,
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_seats`
--

INSERT INTO `booked_seats` (`id`, `user_id`, `seat`, `flight_date`, `razorpay_payment_id`, `amount`, `created_at`) VALUES
(1, 6, 'C1', '2025-05-05', 'pay_QMoLjCrVapztLK', 2500, '2025-04-24 07:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_location` varchar(100) DEFAULT NULL,
  `to_location` varchar(100) DEFAULT NULL,
  `flight_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `user_id`, `from_location`, `to_location`, `flight_date`) VALUES
(1, 1, 'vadodara', 'delhi', '2025-04-22'),
(2, 4, 'Pune', 'Jaipur', '2025-04-25'),
(3, 1, 'Delhi', 'Mumbai', '2025-05-01'),
(4, 2, 'Chennai', 'Bangalore', '2025-05-03'),
(5, 3, 'Kolkata', 'Hyderabad', '2025-05-05'),
(6, 4, 'Ahmedabad', 'Pune', '2025-05-07'),
(7, 5, 'Jaipur', 'Goa', '2025-05-10'),
(8, 6, 'Mumbai', 'Delhi', '2025-05-02'),
(9, 7, 'Lucknow', 'Indore', '2025-05-04'),
(10, 8, 'Bangalore', 'Chennai', '2025-05-06'),
(11, 9, 'Pune', 'Ahmedabad', '2025-05-08'),
(12, 10, 'Hyderabad', 'Kolkata', '2025-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `seats`, `amount`, `created_at`) VALUES
(1, 'A1', 2500.00, '2025-04-25 14:27:22'),
(2, 'B2,B3', 5000.00, '2025-04-25 14:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_code` varchar(10) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `flight_id`, `seat_code`, `status`, `row`, `col`) VALUES
(1, 1, 'A1', 'available', 1, 1),
(2, 1, 'A2', 'available', 1, 2),
(3, 1, 'A3', 'booked', 1, 3),
(4, 1, 'A4', 'available', 1, 4),
(5, 1, 'A5', 'booked', 1, 5),
(6, 1, 'B1', 'available', 2, 1),
(7, 1, 'B2', 'booked', 2, 2),
(8, 1, 'B3', 'available', 2, 3),
(9, 1, 'B4', 'available', 2, 4),
(10, 1, 'B5', 'booked', 2, 5),
(11, 1, 'C1', 'available', 3, 1),
(12, 1, 'C2', 'booked', 3, 2),
(13, 1, 'C3', 'available', 3, 3),
(14, 1, 'C4', 'available', 3, 4),
(15, 1, 'C5', 'available', 3, 5),
(16, 1, 'D1', 'booked', 4, 1),
(17, 1, 'D2', 'available', 4, 2),
(18, 1, 'D3', 'available', 4, 3),
(19, 1, 'D4', 'booked', 4, 4),
(20, 1, 'D5', 'available', 4, 5),
(31, 1, 'E1', 'available', 5, 1),
(32, 1, 'E2', 'booked', 5, 2),
(33, 1, 'E3', 'available', 5, 3),
(34, 1, 'E4', 'available', 5, 4),
(35, 1, 'E5', 'booked', 5, 5),
(36, 1, 'F1', 'booked', 6, 1),
(37, 1, 'F2', 'available', 6, 2),
(38, 1, 'F3', 'available', 6, 3),
(39, 1, 'F4', 'booked', 6, 4),
(40, 1, 'F5', 'available', 6, 5),
(41, 1, 'G1', 'available', 7, 1),
(42, 1, 'G2', 'available', 7, 2),
(43, 1, 'G3', 'booked', 7, 3),
(44, 1, 'G4', 'available', 7, 4),
(45, 1, 'G5', 'booked', 7, 5),
(46, 1, 'H1', 'available', 8, 1),
(47, 1, 'H2', 'booked', 8, 2),
(48, 1, 'H3', 'available', 8, 3),
(49, 1, 'H4', 'booked', 8, 4),
(50, 1, 'H5', 'available', 8, 5),
(51, 1, 'I1', 'available', 9, 1),
(52, 1, 'I2', 'available', 9, 2),
(53, 1, 'I3', 'booked', 9, 3),
(54, 1, 'I4', 'booked', 9, 4),
(55, 1, 'I5', 'available', 9, 5),
(56, 1, 'J1', 'available', 10, 1),
(57, 1, 'J2', 'booked', 10, 2),
(58, 1, 'J3', 'available', 10, 3),
(59, 1, 'J4', 'available', 10, 4),
(60, 1, 'J5', 'booked', 10, 5),
(61, 1, 'K1', 'booked', 11, 1),
(62, 1, 'K2', 'available', 11, 2),
(63, 1, 'K3', 'available', 11, 3),
(64, 1, 'K4', 'booked', 11, 4),
(65, 1, 'K5', 'available', 11, 5),
(66, 1, 'L1', 'available', 12, 1),
(67, 1, 'L2', 'available', 12, 2),
(68, 1, 'L3', 'booked', 12, 3),
(69, 1, 'L4', 'available', 12, 4),
(70, 1, 'L5', 'booked', 12, 5),
(71, 1, 'M1', 'available', 13, 1),
(72, 1, 'M2', 'booked', 13, 2),
(73, 1, 'M3', 'available', 13, 3),
(74, 1, 'M4', 'available', 13, 4),
(75, 1, 'M5', 'booked', 13, 5),
(76, 1, 'N1', 'booked', 14, 1),
(77, 1, 'N2', 'available', 14, 2),
(78, 1, 'N3', 'booked', 14, 3),
(79, 1, 'N4', 'available', 14, 4),
(80, 1, 'N5', 'available', 14, 5),
(81, 1, 'O1', 'available', 15, 1),
(82, 1, 'O2', 'available', 15, 2),
(83, 1, 'O3', 'booked', 15, 3),
(84, 1, 'O4', 'available', 15, 4),
(85, 1, 'O5', 'booked', 15, 5),
(86, 2, 'A1', 'available', 1, 1),
(87, 2, 'A2', 'available', 1, 2),
(88, 2, 'A3', 'available', 1, 3),
(89, 2, 'A4', 'available', 1, 4),
(90, 2, 'A5', 'available', 1, 5),
(91, 2, 'B1', 'available', 2, 1),
(92, 2, 'B2', 'available', 2, 2),
(93, 2, 'B3', 'available', 2, 3),
(94, 2, 'B4', 'available', 2, 4),
(95, 2, 'B5', 'available', 2, 5),
(96, 2, 'C1', 'available', 3, 1),
(97, 2, 'C2', 'available', 3, 2),
(98, 2, 'C3', 'available', 3, 3),
(99, 2, 'C4', 'available', 3, 4),
(100, 2, 'C5', 'available', 3, 5),
(101, 2, 'D1', 'available', 4, 1),
(102, 2, 'D2', 'available', 4, 2),
(103, 2, 'D3', 'available', 4, 3),
(104, 2, 'D4', 'available', 4, 4),
(105, 2, 'D5', 'available', 4, 5),
(106, 2, 'E1', 'available', 5, 1),
(107, 2, 'E2', 'available', 5, 2),
(108, 2, 'E3', 'available', 5, 3),
(109, 2, 'E4', 'available', 5, 4),
(110, 2, 'E5', 'available', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, NULL, 'moinkhokhar2730vdr@gmail.com', 'asdfghjkl', '2025-04-22 08:56:28'),
(6, NULL, 'moin@gmail.com', '$2y$10$w0GOZKuUxybpUrXy6Xvrde5ntA0KagWCiiJjjQ1jwrrhX36efOyAC', '2025-04-24 07:14:06'),
(7, NULL, 'jeet@gmail.com', '$2y$10$vSi9DKF5ffAIK1Yt0KH5x.QT1EMAQpeI8aZQU817eZb6w93sapUFu', '2025-04-24 17:30:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_seats`
--
ALTER TABLE `booked_seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flight_id` (`flight_id`,`seat_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_seats`
--
ALTER TABLE `booked_seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
