-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2024 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Talk&Tunes`
--

-- --------------------------------------------------------

--
-- Table structure for table `Artist`
--

CREATE TABLE `Artist` (
  `ArtistID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Artist`
--

INSERT INTO `Artist` (`ArtistID`, `Name`) VALUES
(1, 'Djo'),
(2, 'The Local Train'),
(4, 'Habib Wahid'),
(10, 'Travis Scott'),
(11, 'AP Dhillon'),
(12, 'Tame Impala'),
(13, 'The Weeknd'),
(14, 'Artic Monkeys'),
(15, 'Lana Del Rey');

-- --------------------------------------------------------

--
-- Table structure for table `ChatMessage`
--

CREATE TABLE `ChatMessage` (
  `ChatRoomID` int(11) NOT NULL,
  `SenderName` varchar(50) NOT NULL,
  `msgVal` text NOT NULL,
  `MessageTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ChatMessage`
--

INSERT INTO `ChatMessage` (`ChatRoomID`, `SenderName`, `msgVal`, `MessageTime`) VALUES
(1, 'Sumonta', 'Hello', '2024-04-26 00:00:00'),
(1, 'Sumonta', 'yoo', '2024-04-27 20:32:24'),
(1, 'tim', 'Hi', '2024-04-27 20:32:37'),
(1, 'tim', 'wsg bro', '2024-04-27 20:33:21'),
(1, 'Sumonta', 'chillin\r\n', '2024-04-27 20:33:32'),
(1, 'tim', 'peace', '2024-04-27 20:34:50'),
(1, 'Sumonta', 'ight g\r\n', '2024-04-27 20:57:24'),
(1, 'Sumonta', 'bruh', '2024-04-27 21:03:26'),
(1, 'tim', 'All good', '2024-04-27 21:16:37'),
(1, 'tim', 'giv me vbuck', '2024-04-28 12:59:02'),
(1, 'Sumonta', 'no', '2024-04-28 12:59:13'),
(1, 'Sumonta', 'hello', '2024-04-28 17:04:14'),
(1, 'tim', 'hiii', '2024-04-28 17:04:20'),
(5, 'Sumonta', 'Hello', '2024-04-28 19:50:11'),
(5, 'virat', 'How are you?\r\n', '2024-04-28 19:50:17'),
(5, 'Sumonta', 'im fine wbu', '2024-04-28 19:51:17'),
(5, 'virat', 'same here', '2024-04-28 19:51:22'),
(5, 'Sumonta', 'noo', '2024-04-29 12:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `ChatRoom`
--

CREATE TABLE `ChatRoom` (
  `chatRoomID` int(11) NOT NULL,
  `Username1` varchar(50) NOT NULL,
  `Username2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ChatRoom`
--

INSERT INTO `ChatRoom` (`chatRoomID`, `Username1`, `Username2`) VALUES
(1, 'Sumonta', 'tim'),
(5, 'virat', 'Sumonta');

-- --------------------------------------------------------

--
-- Table structure for table `COMPRISES`
--

CREATE TABLE `COMPRISES` (
  `PlaylistID` int(11) NOT NULL,
  `SongID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `COMPRISES`
--

INSERT INTO `COMPRISES` (`PlaylistID`, `SongID`) VALUES
(1, 2),
(1, 5),
(1, 6),
(2, 1),
(2, 23),
(2, 24),
(2, 25),
(3, 1),
(3, 23),
(3, 24),
(3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `Follow`
--

CREATE TABLE `Follow` (
  `followID` int(11) NOT NULL,
  `FollowerName` varchar(50) DEFAULT NULL,
  `FollowingName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Follow`
--

INSERT INTO `Follow` (`followID`, `FollowerName`, `FollowingName`) VALUES
(5, 'tim', 'Sumonta'),
(6, 'Sumonta', 'tim'),
(7, 'virat', 'Sumonta'),
(8, 'virat', 'tim');

-- --------------------------------------------------------

--
-- Table structure for table `OF`
--

CREATE TABLE `OF` (
  `SongID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `OF`
--

INSERT INTO `OF` (`SongID`, `ArtistID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 2),
(6, 4),
(7, 5),
(8, 5),
(9, 6),
(10, 2),
(11, 2),
(12, 1),
(13, 7),
(14, 8),
(15, 8),
(16, 9),
(17, 10),
(18, 10),
(19, 10),
(20, 10),
(21, 10),
(22, 11),
(23, 12),
(24, 13),
(25, 14),
(26, 15);

-- --------------------------------------------------------

--
-- Table structure for table `Playlist`
--

CREATE TABLE `Playlist` (
  `PlaylistID` int(11) NOT NULL,
  `PlaylistName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Playlist`
--

INSERT INTO `Playlist` (`PlaylistID`, `PlaylistName`) VALUES
(1, 'Vibes'),
(2, 'Chill');

-- --------------------------------------------------------

--
-- Table structure for table `SearchHistory`
--

CREATE TABLE `SearchHistory` (
  `srcHistoryID` int(11) NOT NULL,
  `Data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SearchHistory`
--

INSERT INTO `SearchHistory` (`srcHistoryID`, `Data`) VALUES
(1, 'local'),
(2, 'l'),
(3, 'a'),
(4, 'hab'),
(5, 'lo'),
(6, 'local'),
(7, 'lo'),
(8, 'local'),
(9, 'wahid'),
(10, 'go'),
(11, 'local'),
(12, 'the local train'),
(13, 'local'),
(14, 'the'),
(15, 'the'),
(16, 'choo lo'),
(17, 'wahid'),
(18, 'train'),
(19, 'End'),
(20, 'Train'),
(21, 'End'),
(22, 'end'),
(23, 'choo'),
(25, 'the local'),
(26, 'moina');

-- --------------------------------------------------------

--
-- Table structure for table `Song`
--

CREATE TABLE `Song` (
  `SongID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Artist` varchar(50) NOT NULL,
  `Album` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Song`
--

INSERT INTO `Song` (`SongID`, `Name`, `Artist`, `Album`) VALUES
(1, 'End of Beginning', 'Djo', 'End of Beginning'),
(2, 'Aaoge Tum Kabhi', 'The Local Train', 'Aaoge Tum Kabhi'),
(5, 'Choo Lo', 'The Local Train', 'Choo Lo'),
(6, 'Moina Go', 'Habib Wahid', 'Moina Go'),
(21, 'Skeletons', 'Travis Scott', 'Skeletons'),
(22, 'With You', 'AP Dhillon', 'With You'),
(23, 'Borderline', 'Tame Impala', 'Borderline'),
(24, 'After Hours', 'The Weeknd', 'After Hours'),
(25, 'I Wanna Be Yours', 'Artic Monkeys', 'I Wanna Be Yours'),
(26, 'Summertime Sadness', 'Lana Del Rey', 'Summertime Sadness');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `email`, `password`) VALUES
(1, 'Sumonta', 'sumonta@gmail.com', 'Sumonta'),
(2, 'tim', 'david@gmail.com', 'david'),
(3, 'virat', 'virat@gmail.com', 'kohli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Artist`
--
ALTER TABLE `Artist`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indexes for table `ChatMessage`
--
ALTER TABLE `ChatMessage`
  ADD KEY `chatroomID` (`ChatRoomID`);

--
-- Indexes for table `ChatRoom`
--
ALTER TABLE `ChatRoom`
  ADD PRIMARY KEY (`chatRoomID`);

--
-- Indexes for table `COMPRISES`
--
ALTER TABLE `COMPRISES`
  ADD PRIMARY KEY (`PlaylistID`,`SongID`),
  ADD KEY `playlist_` (`PlaylistID`),
  ADD KEY `song_` (`SongID`);

--
-- Indexes for table `Follow`
--
ALTER TABLE `Follow`
  ADD PRIMARY KEY (`followID`);

--
-- Indexes for table `OF`
--
ALTER TABLE `OF`
  ADD KEY `ArtistID` (`ArtistID`),
  ADD KEY `song` (`SongID`);

--
-- Indexes for table `Playlist`
--
ALTER TABLE `Playlist`
  ADD PRIMARY KEY (`PlaylistID`,`PlaylistName`);

--
-- Indexes for table `SearchHistory`
--
ALTER TABLE `SearchHistory`
  ADD PRIMARY KEY (`srcHistoryID`);

--
-- Indexes for table `Song`
--
ALTER TABLE `Song`
  ADD PRIMARY KEY (`SongID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`,`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Artist`
--
ALTER TABLE `Artist`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ChatRoom`
--
ALTER TABLE `ChatRoom`
  MODIFY `chatRoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Follow`
--
ALTER TABLE `Follow`
  MODIFY `followID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Playlist`
--
ALTER TABLE `Playlist`
  MODIFY `PlaylistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SearchHistory`
--
ALTER TABLE `SearchHistory`
  MODIFY `srcHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Song`
--
ALTER TABLE `Song`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ChatMessage`
--
ALTER TABLE `ChatMessage`
  ADD CONSTRAINT `chatroomID` FOREIGN KEY (`ChatRoomID`) REFERENCES `ChatRoom` (`chatRoomID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
