-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2024 at 08:57 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educational_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Alex', 'Johnson', 'alex.johnson@example.com', '$2y$10$XwSY8FLL7vCTT4NddNhFR.cdCDcYWqEjjV/GBYUMG9/6OohEBa2QO '),
(2, 'Emma', 'Brown', 'emma.brown@example.com', '$2y$10$lKXi36M10zZQ1qCMstPRk.RPxo7n1fEsB0QMAual4eyqlIhx6T/T6');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`) VALUES
(1, 'Innovatech BVBA', 'Kerkstraat 108, 9050 Gentbrugge'),
(2, 'Techlogix NV', 'Grensstraat 45, 3010 Kessel-Lo'),
(3, 'DevSolutions CVBA', 'Stationsstraat 32, 1700 Dilbeek'),
(4, 'NetCorp SA', 'Rue de l’Industrie 25, 1040 Etterbeek'),
(5, 'Dataflow BVBA', 'Veldkant 33, 2550 Kontich'),
(6, 'CloudNetics NV', 'Dendermondestraat 44, 2018 Antwerpen'),
(7, 'GreenTech Solutions CVBA', 'Rue du Commerce 67, 1000 Bruxelles'),
(8, 'Codenomic SA', 'Wetstraat 1, 1040 Etterbeek'),
(9, 'Logiware BVBA', 'Avenue des Arts 3, 1210 Saint-Josse-ten-Noode'),
(10, 'ThinkBig NV', 'Boulevard du Régent 47, 1000 Bruxelles');

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`id`, `first_name`, `last_name`, `email`, `phone`, `company_id`) VALUES
(1, 'Pieter', 'De Smet', 'pieter.desmet@innovatech.be', '0486 12 34 56', 1),
(2, 'Eva', 'Janssens', 'eva.janssens@techlogix.be', '0485 23 45 67', 2),
(3, 'Tom', 'Willems', 'tom.willems@devsolutions.be', '0475 34 56 78', 3),
(4, 'Lara', 'Peeters', 'lara.peeters@netcorp.be', '0466 45 67 89', 4),
(5, 'Simon', 'Maes', 'simon.maes@dataflow.be', '0477 56 78 90', 5),
(6, 'Emma', 'Claes', 'emma.claes@cloudnetics.be', '0488 65 78 91', 6),
(7, 'Noah', 'Van Dyck', 'noah.vandyck@greentech.be', '0499 76 89 02', 7),
(8, 'Louise', 'Hermans', 'louise.hermans@codenomic.be', '0487 87 90 12', 8),
(9, 'Lucas', 'Martens', 'lucas.martens@logiware.be', '0486 98 01 23', 9),
(10, 'Zoë', 'Jacobs', 'zoe.jacobs@thinkbig.be', '0475 09 12 34', 10);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `description` text,
  `duration` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `duration`, `location`) VALUES
(1, 'Introduction to Programming', 'This course introduces the fundamental concepts of programming using Python.', '10 weeks', 'Online'),
(2, 'Web Development Basics', 'Learn the basics of web development to build your first website using HTML, CSS, and JavaScript.', '8 weeks', 'New York'),
(3, 'Data Analysis with Python', 'Dive into data analysis with Python. Learn how to use Pandas, NumPy, and Matplotlib for data processing and visualization.', '12 weeks', 'Online'),
(4, 'Machine Learning Fundamentals', 'An introductory course to the fundamentals of machine learning and artificial intelligence.', '14 weeks', 'San Francisco'),
(5, 'Front-end Frameworks', 'Explore modern front-end frameworks such as React, Vue, and Angular to create dynamic web applications.', '8 weeks', 'Online'),
(6, 'Back-end Development with Node.js', 'Learn how to build scalable back-end systems using Node.js and Express.', '10 weeks', 'Boston'),
(7, 'Cloud Computing Essentials', 'Understand the basics of cloud computing and how to deploy applications in the cloud.', '6 weeks', 'Online'),
(8, 'Cybersecurity Fundamentals', 'Get to know the basics of cybersecurity, including how to protect against cyber attacks and secure networks.', '8 weeks', 'Washington D.C.'),
(9, 'UX/UI Design Principles', 'Discover the principles of user experience and user interface design to create intuitive and user-friendly designs.', '10 weeks', 'Online'),
(10, 'Project Management for Tech Projects', 'Learn the fundamentals of project management specifically tailored for technology projects.', '8 weeks', 'Seattle');

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

CREATE TABLE `course_teacher` (
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `company_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `contact_person_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `company_id`, `address`, `contact_person_id`, `student_id`, `start_date`, `end_date`) VALUES
(1, 1, 'Kerkstraat 108, 9050 Gentbrugge', 1, 1, '2024-05-01', '2024-08-01'),
(2, 2, 'Grensstraat 45, 3010 Kessel-Lo', 2, 2, '2024-05-15', '2024-08-15'),
(3, 3, 'Stationsstraat 32, 1700 Dilbeek', 3, 3, '2024-06-01', '2024-09-01'),
(4, 4, 'Rue de l’Industrie 25, 1040 Etterbeek', 4, 4, '2024-06-15', '2024-09-15'),
(5, 5, 'Veldkant 33, 2550 Kontich', 5, 5, '2024-07-01', '2024-10-01'),
(6, 6, 'Dendermondestraat 44, 2018 Antwerpen', 6, 6, '2024-07-15', '2024-10-15'),
(7, 7, 'Rue du Commerce 67, 1000 Bruxelles', 7, 7, '2024-08-01', '2024-11-01'),
(8, 8, 'Wetstraat 1, 1040 Etterbeek', 8, 8, '2024-08-15', '2024-11-15'),
(9, 9, 'Avenue des Arts 3, 1210 Saint-Josse-ten-Noode', 9, 9, '2024-09-01', '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `type` enum('soft','hard') NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `type`, `description`) VALUES
(1, 'Teamwork', 'soft', 'The ability to work effectively and harmoniously in a team.'),
(2, 'Communication', 'soft', 'Effective verbal and written communication skills.'),
(3, 'Problem-solving', 'soft', 'The ability to identify and resolve problems quickly and efficiently.'),
(4, 'Adaptability', 'soft', 'The ability to adjust to new conditions and environments.'),
(5, 'Leadership', 'soft', 'The ability to lead and manage teams effectively.'),
(6, 'Programming', 'hard', 'Proficiency in programming languages such as Python, Java, or C++.'),
(7, 'Web Development', 'hard', 'Skills in developing websites using HTML, CSS, JavaScript, and backend technologies.'),
(8, 'Data Analysis', 'hard', 'The ability to analyze data sets to find trends and insights.'),
(9, 'Cloud Computing', 'hard', 'Knowledge of cloud services and deployment models.'),
(10, 'Cybersecurity', 'hard', 'Understanding of cybersecurity principles and measures to protect data.');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `study_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `course_id`, `date_of_birth`, `study_year`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', NULL, '2019-01-09', 1),
(2, 'Jane', 'Smith', 'jane.smith@example.com', NULL, '2014-12-28', 2),
(3, 'Emily', 'Jones', 'emily.jones@example.com', NULL, '2017-11-19', 1),
(4, 'Daniel', 'Lee', 'daniel.lee@example.com', NULL, '2004-06-25', 3),
(5, 'Laura', 'White', 'laura.white@example.com', NULL, '2008-09-24', 4),
(6, 'Ethan', 'Harris', 'ethan.harris@example.com', NULL, '2010-03-24', 2),
(7, 'Madison', 'Clark', 'madison.clark@example.com', NULL, '2004-12-11', 1),
(8, 'Alex', 'Robinson', 'alex.robinson@example.com', NULL, '2014-01-15', 4),
(9, 'Isabella', 'Rodriguez', 'isabella.rodriguez@example.com', NULL, '2015-05-26', 3),
(10, 'Jacob', 'Walker', 'jacob.walker@example.com', NULL, '2014-11-16', 4),
(11, 'Ava', 'Perez', 'ava.perez@example.com', NULL, '2008-03-14', 1),
(12, 'Mason', 'Hall', 'mason.hall@example.com', NULL, '2016-05-14', 2),
(13, 'Mia', 'Young', 'mia.young@example.com', NULL, '2017-04-04', 1),
(14, 'Benjamin', 'Allen', 'benjamin.allen@example.com', NULL, '2017-03-14', 3),
(15, 'Charlotte', 'Sanchez', 'charlotte.sanchez@example.com', NULL, '2014-03-30', 4),
(16, 'Jack', 'Wright', 'jack.wright@example.com', NULL, '2019-08-15', 2),
(17, 'Lily', 'King', 'lily.king@example.com', NULL, '2015-05-23', 1),
(18, 'Logan', 'Scott', 'logan.scott@example.com', NULL, '2018-02-06', 3),
(19, 'Zoe', 'Adams', 'zoe.adams@example.com', NULL, '2004-05-09', 4),
(20, 'Luke', 'Baker', 'luke.baker@example.com', NULL, '2007-06-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `academic_year` varchar(9) DEFAULT NULL,
  `grade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Michael', 'Taylor', 'michael.taylor@example.com', '$2y$10$NEL/4tO/snjhKEMOwAQ.N.ky4SLfAhETYIjdTr5NsygePo1W02uba'),
(2, 'Sophia', 'Martinez', 'sophia.martinez@example.com', '$2y$10$cXEbPIxoVyaWmYI8QqdkK.bU6C3q9qGexsjALlLUhMcvPeZM2ZNci'),
(3, 'James', 'Wilson', 'james.wilson@example.com', '$2y$10$rfHzWUBlcQcO7IfeWNmxxexvN5PGBMci6bEptbKRLg3EiEv/AG7UO'),
(4, 'Olivia', 'Davis', 'olivia.davis@example.com', '$2y$10$qUYK7FiQuQ1et4GoFShwt.DBK9Jy2iPEgKDJJmIvfd37gox/A/nXW'),
(5, 'William', 'Anderson', 'william.anderson@example.com', '$2y$10$Gfks8a4yvCINgb0UEIzqtOASuycUAValf8E5iuykK62.VeOQ5O7D6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id` (`company_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD PRIMARY KEY (`course_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `fk_company_id` (`company_id`),
  ADD KEY `fk_contact_person_id` (`contact_person_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD CONSTRAINT `course_teacher_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `internships`
--
ALTER TABLE `internships`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `fk_new_contact_person_id` FOREIGN KEY (`contact_person_id`) REFERENCES `contact_person` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `fk_student_course_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_student_course_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_grades_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
