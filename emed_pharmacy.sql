-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 10:37 AM
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
-- Database: `emed_pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Medicines'),
(2, 'Health Essentials'),
(3, 'Medical Devices');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Price`) VALUES
(1, 2, 12, 1, 90.00),
(2, 2, 16, 1, 800.00),
(3, 3, 13, 1, 2500.00),
(4, 3, 14, 1, 500.00),
(5, 4, 13, 1, 2500.00),
(6, 4, 14, 1, 500.00),
(7, 5, 11, 1, 120.00),
(8, 6, 11, 1, 120.00),
(9, 7, 14, 1, 500.00),
(10, 8, 13, 1, 2500.00),
(11, 8, 14, 1, 500.00),
(12, 9, 13, 1, 2500.00),
(13, 10, 13, 1, 2500.00),
(14, 11, 9, 1, 150.00),
(15, 11, 15, 1, 300.00),
(16, 12, 13, 1, 2500.00),
(18, 14, 18, 2, 100.00),
(19, 15, 18, 2, 100.00),
(20, 16, 18, 2, 100.00),
(24, 20, 30, 2, 50.00),
(25, 21, 31, 2, 50.00),
(26, 22, 32, 2, 50.00),
(27, 23, 33, 2, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `OrderDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `TotalAmount`, `Status`, `OrderDate`) VALUES
(2, 2, 890.00, 'Pending', '2025-08-22 02:57:10'),
(3, 2, 3000.00, 'Pending', '2025-08-22 02:57:25'),
(4, 2, 3000.00, 'Pending', '2025-08-22 03:20:43'),
(5, 2, 120.00, 'Pending', '2025-08-22 03:20:57'),
(6, 2, 120.00, 'Pending', '2025-08-22 03:23:24'),
(7, 2, 500.00, 'Pending', '2025-08-22 03:23:36'),
(8, 2, 3000.00, 'Pending', '2025-08-22 03:25:22'),
(9, 2, 2500.00, 'Pending', '2025-08-22 03:25:49'),
(10, 2, 2500.00, 'Pending', '2025-08-22 03:25:54'),
(11, 2, 450.00, 'Pending', '2025-08-22 03:27:31'),
(12, 2, 2500.00, 'Pending', '2025-08-22 03:28:36'),
(14, 5, 200.00, 'Pending', '2025-09-03 02:58:11'),
(15, 5, 200.00, 'Pending', '2025-09-03 02:58:33'),
(16, 5, 200.00, 'Pending', '2025-09-03 03:00:08'),
(20, 1, 100.00, '', '2025-09-03 15:06:43'),
(21, 1, 100.00, 'Pending', '2025-09-03 15:13:39'),
(22, 1, 100.00, '', '2025-09-03 15:17:07'),
(23, 1, 100.00, '', '2025-09-03 15:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `PrescriptionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `UploadDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`PrescriptionID`, `UserID`, `FilePath`, `Status`, `UploadDate`) VALUES
(1, 5, 'prescription.png', 'Pending', '2025-09-03 02:44:13'),
(2, 5, 'prescription.png', 'Pending', '2025-09-03 02:45:17'),
(3, 5, 'dummy.png', 'Approved', '2025-09-03 11:27:16'),
(4, 2, '1756926965_p2.png', 'Pending', '2025-09-04 00:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Image`, `Price`, `Stock`, `CategoryID`) VALUES
(9, 'Paracetamol Tablets', 'Pain relief and fever reducer', 'paracetamol.jpg', 150.00, 100, 1),
(10, 'Vitamin C Capsules', 'Boosts immunity and energy', 'vitamin_c.jpg', 200.00, 80, 1),
(11, 'Cough Syrup', 'Relief from cough and sore throat', 'cough_syrup.jpg', 120.00, 60, 2),
(12, 'Hand Sanitizer', 'Antibacterial hand cleaner', 'hand_sanitizer.jpg', 90.00, 150, 2),
(13, 'Blood Pressure Monitor', 'Digital BP monitoring device', 'bp_monitor.jpg', 2500.00, 20, 3),
(14, 'Diabetes Test Strips', 'Glucose monitoring strips', 'diabetes_strips.jpg', 500.00, 40, 3),
(15, 'Multivitamin Tablets', 'Daily essential vitamins', 'multivitamin.jpg', 300.00, 70, 1),
(16, 'First Aid Kit', 'Basic medical emergency supplies', 'first_aid_kit.jpg', 800.00, 25, 2),
(17, 'bandage', 'bandage', 'uploads/admin1.png', 16.00, 10, 1),
(18, 'Paracetamol', 'Painkiller', NULL, 120.00, 50, 1),
(19, 'UnitTestProduct', 'Temporary test description', NULL, 99.99, 10, 1),
(26, 'UnitTestProduct', 'Temporary test product', NULL, 99.99, 10, 1),
(30, 'TempProduct', 'Temporary product for test', NULL, 50.00, 10, 1),
(31, 'TempProduct', 'Temporary product for test', NULL, 50.00, 10, 1),
(32, 'TempProduct', 'Temporary product for test', NULL, 50.00, 10, 1),
(33, 'TempProduct', 'Temporary product for test', NULL, 50.00, 10, 1),
(34, 'Test Medicine', 'Sample description for test product', NULL, 150.00, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Customer','Admin') NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Email`, `Password`, `Role`) VALUES
(1, 'Admin User', 'admin@emed.com', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8hF6vl4QIXUMiC0aiW6R3PbC1C2d2a', 'Admin'),
(2, 'Shaza Faizer', 'shazafaizer20@gmail.com', '$2y$10$JdvGvQj8kegs4obF8fCs8O.mmuUC9uCYA.na5nW6i4NsVJ/0QtYU6', 'Customer'),
(3, 'Admin', 'admin@pharmacy.com', '$2y$10$bmUvT0EgAtmCRajz2W0qG.9WGRTIR5jiePyVfSaU8cZ6BJLEl0WbS', 'Admin'),
(4, 'hud', 'hudha@gmail.com', '$2y$10$OinjqHeZE8aXo1IsaZnvRu6e5Jx4u1W6rEkq2N7vANyXsv4UPqxTe', 'Customer'),
(5, 'Test User', 'testuser@example.com', '$2y$10$jl7NOQH3ApjMk0iAv5jO5O3B09t7mBDvjLgjwJ2lZ8vHpq/vkefi6', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`PrescriptionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `PrescriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
