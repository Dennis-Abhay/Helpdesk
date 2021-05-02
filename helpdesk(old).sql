-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 12:58 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `hd_ticket`
--

CREATE TABLE `hd_ticket` (
  `ticket_id` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `completed_at` datetime NOT NULL,
  `incident_tag` varchar(100) NOT NULL,
  `impact_level` varchar(100) NOT NULL,
  `urgency` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hd_ticket`
--

INSERT INTO `hd_ticket` (`ticket_id`, `subject`, `content`, `status`, `username`, `agent`, `category`, `created_at`, `updated_at`, `completed_at`, `incident_tag`, `impact_level`, `urgency`, `priority`) VALUES
(5, 'Mail Delivery Failure', 'Mail Delivery Failure', 'open', 'admin@admin.com', 'admin', 'High', '2021-04-24 12:19:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'High', 'High', 'High');

-- --------------------------------------------------------

--
-- Table structure for table `hd_tick_messages`
--

CREATE TABLE `hd_tick_messages` (
  `message_id` int(11) NOT NULL,
  `ticket_id` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hd_tick_messages`
--

INSERT INTO `hd_tick_messages` (`message_id`, `ticket_id`, `content`, `username`, `message_date`) VALUES
(1, '5', 'How may I assist u?', 'admin', '2021-04-24 18:02:41'),
(2, '5', 'It was bad', 'admin@admin.com', '2021-04-24 13:27:50'),
(3, '5', 'Mail Delivery Failure', 'admin@admin.com', '2021-04-24 12:19:24'),
(4, '5', 'Hello', 'admin', '2021-04-24 18:05:58'),
(5, '5', 'It is okay', 'admin', '2021-04-24 18:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `hd_user`
--

CREATE TABLE `hd_user` (
  `hd_admin` varchar(20) NOT NULL,
  `hd_staff` varchar(20) NOT NULL,
  `hd_user` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `profileimg` varchar(100) NOT NULL DEFAULT 'img/avatar1.png',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hd_user`
--

INSERT INTO `hd_user` (`hd_admin`, `hd_staff`, `hd_user`, `username`, `password`, `firstname`, `lastname`, `bio`, `emailaddress`, `address1`, `address2`, `state`, `city`, `country`, `profileimg`, `created_on`) VALUES
('', 'true', '', 'admin', 'admin', 'Conrad', 'Thomas', 'Something', 'conradjoye@gmail.com', '67, Ondo Street', 'Old Bodija', 'Choose...', 'Ibadan', 'Nigeria', 'img/admin@admin.com.png', '2021-04-24 13:01:15'),
('', '', 'true', 'admin@admin.com', 'admin', 'Conrad', 'Thomas', 'Something', 'conradjoye@gmail.com', '67, Ondo Street', 'Old Bodija', 'Choose...', 'Ibadan', 'Nigeria', 'img/admin@admin.com.png', '2021-04-24 13:01:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hd_ticket`
--
ALTER TABLE `hd_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `hd_tick_messages`
--
ALTER TABLE `hd_tick_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `hd_user`
--
ALTER TABLE `hd_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hd_ticket`
--
ALTER TABLE `hd_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hd_tick_messages`
--
ALTER TABLE `hd_tick_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
