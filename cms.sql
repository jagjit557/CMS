-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2022 at 07:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `isbn` text NOT NULL,
  `publisher` text NOT NULL,
  `proof` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `id` int(11) NOT NULL,
  `book` int(11) NOT NULL,
  `author_name` text NOT NULL,
  `author_affiliation` text NOT NULL,
  `author_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE `conferences` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `conference_name` text NOT NULL,
  `venue` text NOT NULL,
  `scope` text NOT NULL COMMENT 'Nat or Intl',
  `month` text NOT NULL,
  `year` int(11) NOT NULL,
  `proof` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conferences`
--

INSERT INTO `conferences` (`id`, `title`, `conference_name`, `venue`, `scope`, `month`, `year`, `proof`, `active`) VALUES
(2, 'Testing', 'Conference for testing', 'GNE College ', 'International', 'August', 2020, 'proofs/proof-2022-06-06-06-42-04-629d859ce2867.jpeg', 1),
(3, 'Conference testing', 'India coal crisis', 'workshop, GNDEC', 'National', 'April', 2022, 'proofs/proof-2022-06-06-06-55-45-629d88d110b1f.jpeg', 0),
(7, 'new conf 2', 'new conf 2', 'conf v', 'National', 'February', 2021, 'proofs/proof-2022-06-06-07-23-27-629d8f4f99a60.jpg', 1),
(8, 'ABC', 'Test Conference ', 'SCD ', 'National', 'October', 2020, 'proofs/proof-2022-06-06-07-31-11-629d911f182b3.jpeg', 0),
(9, 'Testing', 'First conf.', 'Ludhiana', 'International', 'June', 2022, 'proofs/proof-2022-06-07-10-49-41-629f112590511.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conference_authors`
--

CREATE TABLE `conference_authors` (
  `id` int(11) NOT NULL,
  `conference` int(11) NOT NULL,
  `author_name` text NOT NULL,
  `author_affiliation` text NOT NULL,
  `author_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conference_authors`
--

INSERT INTO `conference_authors` (`id`, `conference`, `author_name`, `author_affiliation`, `author_type`) VALUES
(1, 2, 'jonson', 'GNDEC', 'Teacher'),
(2, 3, 'Jagjit Singh', 'GNDEC', 'Student'),
(6, 7, 'new auth 2', 'new aff 2', 'Student'),
(7, 8, 'Jagjit Singh', 'SCD Govt. college', 'Student'),
(8, 9, 'Un known', 'GNDEC', 'Teacher'),
(9, 9, 'abc', 'gne', 'Student'),
(10, 9, 'xyz', 'GNE', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `expert_talk`
--

CREATE TABLE `expert_talk` (
  `id` int(11) NOT NULL,
  `topic` text NOT NULL,
  `event` text NOT NULL,
  `date` date NOT NULL,
  `venue` text NOT NULL,
  `proof` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_talk`
--

INSERT INTO `expert_talk` (`id`, `topic`, `event`, `date`, `venue`, `proof`, `active`) VALUES
(2, 'g-20', 'hfasg', '2022-05-30', 'GNE College', 'proofs/proof-2022-06-07-10-51-39-629f119bc84c1.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expert_talk_faculty`
--

CREATE TABLE `expert_talk_faculty` (
  `id` int(11) NOT NULL,
  `expert_talk` int(11) NOT NULL,
  `author_name` text NOT NULL,
  `author_affiliation` text NOT NULL,
  `author_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_talk_faculty`
--

INSERT INTO `expert_talk_faculty` (`id`, `expert_talk`, `author_name`, `author_affiliation`, `author_type`) VALUES
(1, 2, 'jywfu', 'gne', 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `journal_name` text NOT NULL,
  `volume` text NOT NULL,
  `issue` text NOT NULL,
  `issn` text NOT NULL,
  `month` text NOT NULL,
  `year` int(11) NOT NULL,
  `scope` text NOT NULL COMMENT 'National or Intl',
  `proof` text NOT NULL,
  `indexing` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `journal_name`, `volume`, `issue`, `issn`, `month`, `year`, `scope`, `proof`, `indexing`, `active`) VALUES
(2, 'un-titled ', 'un-named', 'Non ', 'Climate change', '35237', 'November', 2021, 'National', 'proofs/proof-2022-06-06-06-46-41-629d86b1804fe.jpg', 'SCI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `journal_authors`
--

CREATE TABLE `journal_authors` (
  `id` int(11) NOT NULL,
  `journal` int(11) NOT NULL,
  `author_name` text NOT NULL,
  `author_affiliation` text NOT NULL,
  `author_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_authors`
--

INSERT INTO `journal_authors` (`id`, `journal`, `author_name`, `author_affiliation`, `author_type`) VALUES
(1, 2, 'Arwinder singh', 'GNE ', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `for_id` int(11) NOT NULL,
  `by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `for_id`, `by_id`) VALUES
(19, 'NEW_CONFERENCE', 8, 2),
(20, 'NEW_EXPERTTALK', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `type`, `active`) VALUES
(1, 'admin', 'admin', 'admin@gndec.ac.in', 'admin', 'Admin', 1),
(2, 'Jagjit', 'Singh', 'jagjitsidhu557@gmail.com', 'Jagjit@123', 'Student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_authors_book` (`book`);

--
-- Indexes for table `conferences`
--
ALTER TABLE `conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_authors`
--
ALTER TABLE `conference_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_authors_conference` (`conference`);

--
-- Indexes for table `expert_talk`
--
ALTER TABLE `expert_talk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_talk_faculty`
--
ALTER TABLE `expert_talk_faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expert_talk_faculty_et` (`expert_talk`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_authors`
--
ALTER TABLE `journal_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_authors_journal` (`journal`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `byuserid` (`by_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conferences`
--
ALTER TABLE `conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `conference_authors`
--
ALTER TABLE `conference_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expert_talk`
--
ALTER TABLE `expert_talk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expert_talk_faculty`
--
ALTER TABLE `expert_talk_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journal_authors`
--
ALTER TABLE `journal_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_book` FOREIGN KEY (`book`) REFERENCES `books` (`id`);

--
-- Constraints for table `conference_authors`
--
ALTER TABLE `conference_authors`
  ADD CONSTRAINT `conference_authors_conference` FOREIGN KEY (`conference`) REFERENCES `conferences` (`id`);

--
-- Constraints for table `expert_talk_faculty`
--
ALTER TABLE `expert_talk_faculty`
  ADD CONSTRAINT `expert_talk_faculty_et` FOREIGN KEY (`expert_talk`) REFERENCES `expert_talk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_authors`
--
ALTER TABLE `journal_authors`
  ADD CONSTRAINT `journal_authors_journal` FOREIGN KEY (`journal`) REFERENCES `journals` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `byuserid` FOREIGN KEY (`by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
