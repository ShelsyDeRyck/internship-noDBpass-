-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2024 at 01:16 PM
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
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `contact_person_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
