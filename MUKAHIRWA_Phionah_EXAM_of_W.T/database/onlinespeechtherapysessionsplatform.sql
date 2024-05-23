-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 04:38 PM
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
-- Database: `onlinespeechtherapysessionsplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `TherapistID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Status` enum('Scheduled','Rescheduled','Canceled') DEFAULT NULL,
  `ReasonForAppointment` varchar(333) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`AppointmentID`, `TherapistID`, `ClientID`, `AppointmentDate`, `StartTime`, `EndTime`, `Status`, `ReasonForAppointment`) VALUES
(1, 1, 2, '2024-05-15', '09:00:00', '10:00:00', 'Scheduled', 'Review progress and set goals'),
(2, 1, 2, '2024-05-20', '09:00:00', '10:00:00', 'Scheduled', 'Follow-up session'),
(3, 2, 1, '2024-05-17', '10:00:00', '11:00:00', 'Scheduled', 'Initial assessment'),
(4, 2, 3, '2024-05-22', '10:00:00', '11:00:00', 'Scheduled', 'Discuss therapy plan');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `MedicalHistory` text DEFAULT NULL,
  `InsuranceDetails` varchar(255) DEFAULT NULL,
  `EmergencyContact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `UserID`, `DateOfBirth`, `MedicalHistory`, `InsuranceDetails`, `EmergencyContact`) VALUES
(1, 2, '1990-05-15', 'History of speech delay', 'ABC Insurance Company', 'Mary Smith - 987654321'),
(2, 4, '1985-10-20', 'No significant medical history', 'XYZ Insurance Company', 'John Brown - 789123456'),
(3, 1, '2000-03-10', 'History of stuttering', 'DEF Insurance Company', 'Jane Wilson - 654987321');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `ExerciseID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `DifficultyLevel` enum('Easy','Medium','Hard') DEFAULT NULL,
  `AudioFile` varchar(255) DEFAULT NULL,
  `ImageOrVideo` varchar(255) DEFAULT NULL,
  `Instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`ExerciseID`, `Name`, `Description`, `DifficultyLevel`, `AudioFile`, `ImageOrVideo`, `Instructions`) VALUES
(1, 'Articulation Exercise', 'Practice pronouncing specific sounds', 'Medium', 'audio1.mp3', 'image1.jpg', 'Repeat each sound 10 times'),
(2, 'Fluency Exercise', 'Practice speaking smoothly without stuttering', 'Medium', 'audio2.mp3', 'image2.jpg', 'Read aloud passages slowly'),
(3, 'Language Exercise', 'Improve vocabulary and grammar skills', 'Hard', 'audio3.mp3', 'image3.jpg', 'Complete sentence completion exercises');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `SessionID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `TherapistID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `FeedbackContent` varchar(500) DEFAULT NULL,
  `FeedbackDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `SessionID`, `ClientID`, `TherapistID`, `Rating`, `FeedbackContent`, `FeedbackDate`) VALUES
(4, 1, 2, 1, 5, 'Great session, made significant progress!', '2024-05-03'),
(5, 2, 2, 1, 4, 'Very helpful, looking forward to the next session.', '2024-05-10'),
(6, 3, 1, 2, 3, 'The therapist was very knowledgeable and professional.', '2024-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `NotificationType` varchar(50) DEFAULT NULL,
  `NotificationContent` text DEFAULT NULL,
  `IsRead` tinyint(1) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `NotificationType`, `NotificationContent`, `IsRead`, `Timestamp`) VALUES
(1, 2, 'AppointmentReminder', 'You have an appointment scheduled for tomorrow at 9:00 AM.', 0, '2024-05-16 14:28:08'),
(2, 4, 'NewMessage', 'You have received a new message from your therapist.', 0, '2024-05-16 14:28:08'),
(3, 1, 'AppointmentCanceled', 'Your appointment scheduled for next week has been canceled.', 0, '2024-05-16 14:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `TherapistID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `PaymentStatus` enum('Paid','Pending') DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `TransactionID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `ClientID`, `TherapistID`, `Amount`, `PaymentDate`, `PaymentStatus`, `PaymentMethod`, `TransactionID`) VALUES
(1, 2, 1, 50.00, '2024-05-01', 'Paid', 'Credit Card', '1234567890'),
(2, 2, 1, 50.00, '2024-05-08', 'Paid', 'Credit Card', '0987654321'),
(3, 3, 2, 60.00, '2024-05-05', 'Paid', 'PayPal', '5432109876');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SessionID` int(11) NOT NULL,
  `TherapistID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `DurationMinutes` int(11) DEFAULT NULL,
  `SessionNotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SessionID`, `TherapistID`, `ClientID`, `Date`, `StartTime`, `EndTime`, `DurationMinutes`, `SessionNotes`) VALUES
(1, 1, 2, '2024-05-03', '09:00:00', '10:00:00', 60, 'Worked on articulation exercises'),
(2, 1, 2, '2024-05-10', '09:00:00', '10:00:00', 60, 'Reviewed progress and assigned new exercises'),
(3, 2, 3, '2024-05-05', '10:00:00', '11:00:00', 60, 'Conducted language assessment'),
(4, 2, 1, '2024-05-12', '10:00:00', '11:00:00', 60, 'Introduced fluency techniques');

-- --------------------------------------------------------

--
-- Table structure for table `therapistavailabilities`
--

CREATE TABLE `therapistavailabilities` (
  `Availability_id` int(11) NOT NULL,
  `TherapistId` int(11) DEFAULT NULL,
  `Day_of_week` varchar(20) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapistavailabilities`
--

INSERT INTO `therapistavailabilities` (`Availability_id`, `TherapistId`, `Day_of_week`, `Start_time`, `End_time`) VALUES
(1, 1, 'Monday', '09:00:00', '17:00:00'),
(2, 1, 'Tuesday', '10:00:00', '18:00:00'),
(3, 2, 'Wednesday', '08:00:00', '16:00:00'),
(4, 2, 'Thursday', '09:30:00', '17:30:00'),
(5, 3, 'Friday', '11:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `TherapistID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `ExperienceYears` int(11) DEFAULT NULL,
  `Availability` varchar(255) DEFAULT NULL,
  `LicenseNumber` varchar(50) DEFAULT NULL,
  `Certification` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapists`
--

INSERT INTO `therapists` (`TherapistID`, `UserID`, `Specialization`, `ExperienceYears`, `Availability`, `LicenseNumber`, `Certification`) VALUES
(1, 1, 'Speech Therapy', 5, 'Monday-Friday, 9:00 AM - 5:00 PM', 'SLP12345', 'ASHA Certified'),
(2, 3, 'Pediatric Speech Therapy', 8, 'Tuesday, Thursday, Saturday, 10:00 AM - 3:00 PM', 'SLP54321', 'ASHA Certified');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'mukahirwa', 'phionah', 'PHIONA09', 'mukahirwaphionah@gmail.com', '0785976635', '$2y$10$.TziT0H1/1TE8xy5toHQluSewCicAX8M0glt3O4321ca6xCJSehWW', '2024-05-16 14:18:33', '34567', 0),
(2, 'dushimimana', 'valentine', 'valentine03', 'valentdushime@gmail.com', '0788999999', '$2y$10$n2leI.a1YMpaf3bOFPzLU.bm3xHQUsK1.TDsWnc74YQOO9GBzPZvm', '2024-05-16 14:19:29', '234567', 0),
(3, 'umuhoza', 'alice', 'alicemhz', 'aliceumuhoza@gmail.com', '0785976635', '$2y$10$ldwHCcgjP3B8mnN0AFX/Ney6TgigPHW6Bv.kflG23i5lvksVNB6by', '2024-05-16 14:20:20', '222111', 0),
(4, 'hafasha', 'theo', 'theofile', 'hafashatheo@gmail.com', '073678987654', '$2y$10$zL42icVw/KpMz3heigv.oOeri5ZDJukC2EH9WpCp8bW6FShxqqbda', '2024-05-16 14:21:24', '234567', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `TherapistID` (`TherapistID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`ExerciseID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `SessionID` (`SessionID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `TherapistID` (`TherapistID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `TherapistID` (`TherapistID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `TherapistID` (`TherapistID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `therapistavailabilities`
--
ALTER TABLE `therapistavailabilities`
  ADD PRIMARY KEY (`Availability_id`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`TherapistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `ExerciseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `therapistavailabilities`
--
ALTER TABLE `therapistavailabilities`
  MODIFY `Availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `TherapistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`TherapistID`) REFERENCES `therapists` (`TherapistID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`SessionID`) REFERENCES `sessions` (`SessionID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`TherapistID`) REFERENCES `therapists` (`TherapistID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`TherapistID`) REFERENCES `therapists` (`TherapistID`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`TherapistID`) REFERENCES `therapists` (`TherapistID`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `therapists`
--
ALTER TABLE `therapists`
  ADD CONSTRAINT `therapists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
