-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 09:37 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csiaccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `UserName` varchar(100) NOT NULL,
  `userPassword` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`UserName`, `userPassword`, `email`) VALUES
('fdas', '$argon2id$v=19$m=1024,t=2,p=2$cU5tclJCYi5GOUpJMTYuMQ$4003ze/c3oOOtyJtE6aAXN7lAz3tzywexqFdUiOIom0', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$NHlUZkU0aFNQaTFkdUp2eQ$2k5CfNuJfaITFQe7tS1dQHHgp0CHn+YLrL6OWUtrFfg', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$aVJ0dUlnLkVyazFJbmxwag$E78KH1d3zIc1BNwZgT0zsDrr2oEtzW8ls8GJzTnz+OE', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$T2Rva1d2R2N5R2pwWGkueg$wRWPWfqwt2iaI3tZmYS89nvC2u8l8BvPmPiQJGvv39I', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$U0hTRTBvNzZCT2ZxWG1ZWg$ierWKBTRxWxI0eLORNUu5J6MFPR86iGK5w9CEyqvBao', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$a1R2MmNnLjlyLkY2T3hXSg$/qYui/Ap6RDjd0IJ4VXhcBIbxZV+7UQvd9Xbz7NnP+M', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$NVVaMm02YXV5d1g3ZzNQbw$L3D9AsHeA1bdnCEVoXWieTOWTwdM5hKqdG9rTV1HsGw', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$VWZybkNRcXdlTlJVS2QxMA$US3ircBCnUBriiVR+qjv4UejEHP6oW4SeaxhjcWYdz0', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$bWZGdk95UjJnVWtLS25XLw$ZbutXdJjVLVRbpohIvtpzYCCOIC77wgg5XLcW27taCE', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$RFQyVUxWVkRTM1hoei9uNw$fo/OpBi91BAVJkuY2227o1d0L3B2coWBtSlFHQ7mM94', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$dzFxa3c1OTFtd08yaGtnZg$igQIQooxkdKB2FnlMi1pD9DkB161HfXo8iwXfJ4H2GM', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$R2xEaUNXaWNNcTBreDRQSw$iVLuiNJKJqZZKgCh6TgHdLw4RoxKfNQ3Ekx7J4wu9Gk', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$UlNoa2d0UG5KM2FHTk93Vg$PsZwaJnPVyq+Me/2t4QdGRKR6j8B67dYcAKH2B5wexQ', ''),
('admin', '$argon2id$v=19$m=1024,t=2,p=2$OEp1a1ZDS1NuanVmYXVSRg$pX6iFCT2p4SQxNwuGR7ZadHI7e6LBWBVCffQM6QHNOQ', ''),
('Presentatino', '$argon2id$v=19$m=1024,t=2,p=2$aFRwVFhXM2QwV3VtWlZ1Mw$kqB9BZIU5cVopRiL3PlGHxkwWgXMxzrxjAD9PrOITp8', ''),
('462CSI', '$argon2id$v=19$m=1024,t=2,p=2$dHh4S0NDVjNxWEtYMzlxMA$h8aeqOPyvzXcCrC8WefB6u3Ov+bxp6khKI6Ez1LPGgk', 'collinswitzer@gmail.com'),
('Ah', '$argon2id$v=19$m=1024,t=2,p=2$djFwVnV1Q2VLWVdJRWZjUQ$vNKH37roMuiW0xWMHdDutO4TSv16Ip+51Sk+vhWLS0g', 'collinswitzer@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
