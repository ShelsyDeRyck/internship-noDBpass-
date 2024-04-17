-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2024 at 01:46 PM
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
(10, 'ThinkBig NV', 'Boulevard du Régent 47, 1000 Bruxelles'),
(11, 'CloudNetics NV2131', 'Dendermondestraat 44, 2018 Antwerpen');

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
(10, 'Zoë', 'Jacobs', 'zoe.jacobs@thinkbig.be', '0475 09 12 34', 10),
(11, 'Emma', 'Claes', 'emma.claes@cloudnetics.be', '0488 65 78 91', 11);

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
-- Table structure for table `course_skill`
--

CREATE TABLE `course_skill` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

CREATE TABLE `course_teacher` (
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_teacher`
--

INSERT INTO `course_teacher` (`course_id`, `teacher_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(1, 5),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `company_id` int(11) NOT NULL,
  `contact_person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `company_id`, `contact_person_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `internship_student`
--

CREATE TABLE `internship_student` (
  `id` int(11) NOT NULL,
  `internship_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `about` text,
  `scope` text,
  `feedback` text,
  `employment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internship_student`
--

INSERT INTO `internship_student` (`id`, `internship_id`, `student_id`, `start_date`, `end_date`, `about`, `scope`, `feedback`, `employment`) VALUES
(1, 3, 8, '2024-01-15', '2023-12-13', 'EcoTech werkt aan duurzame technologische oplossingen in energiebeheer.', 'Implementeer een slim energiebeheersysteem.', 'Groen denken, geweldig in teamverband, soms te detailgericht.', 'Aangenomen als projectleider in duurzaamheid.'),
(2, 9, 11, '2023-10-14', '2024-02-21', 'CloudConnect specialiseert zich in cloud storage oplossingen voor multinationals.', 'Implementeer een veilige en schaalbare cloud opslagdienst.', 'Sterk analytisch vermogen, kan sneller besluiten nemen.', 'Aangenomen als cloud engineer.'),
(3, 8, 14, '2023-10-26', '2023-12-18', 'VirtualMarket creëert virtuele marktplaatsen voor digitale economieën.', 'Creëer een augmented reality interface voor online winkelen.', 'Creatief en technisch bekwaam, moet werken aan punctualiteit.', 'Aangenomen als ontwikkelaar voor AR-commerce systemen.'),
(4, 2, 15, '2023-09-14', '2024-03-20', 'CyberSecure biedt geavanceerde beveiligingsoplossingen voor bedrijfsdata.', 'Versterk de netwerkbeveiliging tegen potentiële cyberaanvallen.', 'Zeer betrouwbaar in beveiligingsmanagement, moet teamwork vaardigheden verbeteren.', 'Aangenomen als hoofd van IT-security.'),
(5, 10, 4, '2024-01-04', '2023-12-17', 'SmartSolutions focust op softwareontwikkeling en projectbeheer.', 'Manage een team dat een intern bedrijfsnetwerk opzet.', 'Heeft een goede grip op netwerkbeveiliging, kan efficiënter werken.', 'Aangenomen als netwerkbeheerder.'),
(6, 1, 3, '2024-01-01', '2024-02-25', 'TechAdvancers biedt consultancy voor cybersecurity en risicomanagement.', 'Versterk de IT-infrastructuur tegen cyberaanvallen.', 'Uitstekend in probleemoplossing, moet nog werken aan documentatie.', 'Aangenomen als cybersecurity consultant.'),
(7, 1, 6, '2023-11-25', '2023-12-24', 'NextGen Leaders is een consultancybureau in de gezondheidszorgtechnologie.', 'Ontwikkel een patiëntvolgsysteem voor ziekenhuizen.', 'Gedreven en methodisch, uitstekend in klantinteracties.', 'Aangenomen als systeemanalist.'),
(8, 4, 9, '2023-11-11', '2023-11-20', 'FinTech Revolution innoveert financiële technologieën voor banken.', 'Ontwikkel nieuwe algoritmen voor high-frequency trading.', 'Zeer intelligent, soms te snel in besluitvorming.', 'Aangenomen als algoritme ontwikkelaar.'),
(9, 6, 16, '2024-01-08', '2024-03-23', 'DataDriven Insights biedt data-analyse diensten voor marketing doeleinden.', 'Analyseer consumentendata om marketingstrategieën te verbeteren.', 'Data-savvy, moet zijn vaardigheden in real-time data processing verbeteren.', 'Aangenomen als data analist.'),
(10, 9, 10, '2023-12-23', '2024-02-03', 'Robotix focust op robotica oplossingen voor industriële automatisering.', 'Ontwerp een prototype voor een automatische assemblagelijn.', 'Technisch zeer bekwaam, moet werken aan soft skills.', 'Aangenomen als robotica ingenieur.'),
(11, 8, 2, '2023-10-24', '2023-10-21', 'Innovatie Hub, gericht op AI en automatisering voor kleine bedrijven.', 'Implementeer machine learning modellen voor klantsegmentatie.', 'Moet werken aan communicatieve vaardigheden, maar technisch sterk.', 'Aangenomen als junior AI-specialist.'),
(12, 7, 1, '2023-11-22', '2023-10-28', 'Priceless-IT is een innovatief IT-bedrijf dat gespecialiseerd is in cloudoplossingen.', 'Ontwikkel een geautomatiseerd data-analyse systeem.', 'Zeer leergierig en proactief, neemt regelmatig het initiatief.', 'Aangenomen als data-analist.'),
(13, 5, 5, '2024-02-18', '2023-10-26', 'CodeCrafters specialiseert zich in webontwikkeling en e-commerce oplossingen.', 'Bouw en onderhoud webshops voor verschillende klanten.', 'Sterk in coderen, moet meer aandacht besteden aan testing.', 'Aangenomen als full-stack webontwikkelaar.'),
(14, 7, 17, '2023-12-16', '2024-01-27', 'EcoSolutions ontwikkelt ecologische producten voor duurzaam wonen.', 'Ontwikkel nieuwe biologisch afbreekbare materialen.', 'Innovatief en duurzaam, kan efficiënter werken onder druk.', 'Aangenomen als productontwikkelaar in duurzaamheid.'),
(15, 3, 18, '2024-02-07', '2023-10-20', 'TechPioneers is een startup gericht op de nieuwste technologieën in AI.', 'Implementeer AI om bedrijfsprocessen te automatiseren.', 'AI-expert, moet beter leren omgaan met ongestructureerde data.', 'Aangenomen als AI consultant.'),
(16, 7, 20, '2024-01-04', '2024-02-03', 'AutoTech innoveert in de automobielindustrie met focus op elektrische voertuigen.', 'Ontwerp een systeem voor autonome navigatie in elektrische auto\'s.', 'Technisch sterk, moet communicatievaardigheden verbeteren.', 'Aangenomen als ingenieur in autonome systemen.'),
(17, 10, 7, '2023-12-23', '2024-03-25', 'VirtualTech speelt in op virtual reality toepassingen voor educatie.', 'Creëer een VR-trainingssysteem voor scholen.', 'Innovatief en creatief, moet technische vaardigheden verbeteren.', 'Aangenomen als VR content developer.'),
(18, 1, 12, '2023-12-06', '2023-10-09', 'GreenPlanet innovatie in duurzame landbouwtechnologieën.', 'Ontwikkel een AI-gestuurd systeem voor precisielandbouw.', 'Uitstekend in innovatie, moet communicatie met teamleden verbeteren.', 'Aangenomen als specialist in AI en landbouwtechnologieën.'),
(19, 2, 13, '2023-09-14', '2024-02-21', 'QuantumComputing levert geavanceerde berekeningen voor wetenschappelijk onderzoek.', 'Bouw een simulatieplatform voor kwantummechanica experimenten.', 'Heeft diepgaand technisch inzicht, soms te perfectionistisch.', 'Aangenomen als onderzoeker in kwantumcomputing.'),
(20, 4, 19, '2024-02-04', '2024-02-15', 'HealthInnovate specialiseert zich in technologische gezondheidsoplossingen.', 'Ontwikkel apps om patiënten te monitoren en te managen.', 'Goed in gezondheidstechnologie, moet medische kennis verbreden.', 'Aangenomen als ontwikkelaar van medische toepassingen.');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `type` enum('soft','hard') NOT NULL,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `type`, `description`, `status`) VALUES
(1, 'Teamwork', 'soft', 'The ability to work effectively and harmoniously in a team.', 'active'),
(2, 'Communication', 'soft', 'Effective verbal and written communication skills.', 'active'),
(3, 'Problem-solving', 'soft', 'The ability to identify and resolve problems quickly and efficiently.', 'active'),
(4, 'Adaptability', 'soft', 'The ability to adjust to new conditions and environments.', 'active'),
(5, 'Leadership', 'soft', 'The ability to lead and manage teams effectively.', 'active'),
(6, 'Programming', 'hard', 'Proficiency in programming languages such as Python, Java, or C++.', 'active'),
(7, 'Web Development', 'hard', 'Skills in developing websites using HTML, CSS, JavaScript, and backend technologies.', 'active'),
(8, 'Data Analysis', 'hard', 'The ability to analyze data sets to find trends and insights.', 'active'),
(9, 'Cloud Computing', 'hard', 'Knowledge of cloud services and deployment models.', 'active'),
(10, 'Cybersecurity', 'hard', 'Understanding of cybersecurity principles and measures to protect data.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `skill_student`
--

CREATE TABLE `skill_student` (
  `id` int(11) NOT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `grade` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `study_year` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `study_year`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '2019-01-09', '2023-2024'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '2014-12-28', '2023-2024'),
(3, 'Emily', 'Jones', 'emily.jones@example.com', '2017-11-19', '2023-2024'),
(4, 'Daniel', 'Lee', 'daniel.lee@example.com', '2004-06-25', '2023-2024'),
(5, 'Laura', 'White', 'laura.white@example.com', '2008-09-24', '2023-2024'),
(6, 'Ethan', 'Harris', 'ethan.harris@example.com', '2010-03-24', '2023-2024'),
(7, 'Madison', 'Clark', 'madison.clark@example.com', '2004-12-11', '2023-2024'),
(8, 'Alex', 'Robinson', 'alex.robinson@example.com', '2014-01-15', '2023-2024'),
(9, 'Isabella', 'Rodriguez', 'isabella.rodriguez@example.com', '2015-05-26', '2023-2024'),
(10, 'Jacob', 'Walker', 'jacob.walker@example.com', '2014-11-16', '2023-2024'),
(11, 'Ava', 'Perez', 'ava.perez@example.com', '2008-03-14', '2023-2024'),
(12, 'Mason', 'Hall', 'mason.hall@example.com', '2016-05-14', '2023-2024'),
(13, 'Mia', 'Young', 'mia.young@example.com', '2017-04-04', '2023-2024'),
(14, 'Benjamin', 'Allen', 'benjamin.allen@example.com', '2017-03-14', '2023-2024'),
(15, 'Charlotte', 'Sanchez', 'charlotte.sanchez@example.com', '2014-03-30', '2023-2024'),
(16, 'Jack', 'Wright', 'jack.wright@example.com', '2019-08-15', '2023-2024'),
(17, 'Lily', 'King', 'lily.king@example.com', '2015-05-23', '2023-2024'),
(18, 'Logan', 'Scott', 'logan.scott@example.com', '2018-02-06', '2023-2024'),
(19, 'Zoe', 'Adams', 'zoe.adams@example.com', '2004-05-09', '2023-2024'),
(20, 'Luke', 'Baker', 'luke.baker@example.com', '2007-06-11', '2023-2024');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(9, 5),
(10, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(16, 8),
(17, 9),
(18, 9),
(19, 10),
(20, 10);

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
  MODIFY course_id INT AUTO_INCREMENT PRIMARY KEY;

--
-- Indexes for table `course_skill`
--
ALTER TABLE `course_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `course_skill`
--
ALTER TABLE `course_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `skill_id` (`skill_id`);

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
  ADD KEY `fk_company_id` (`company_id`),
  ADD KEY `fk_contact_person_id` (`contact_person_id`);

--
-- Indexes for table `internship_student`
--
ALTER TABLE `internship_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internship_id` (`internship_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_student`
--
ALTER TABLE `skill_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill_id` (`skill_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;  

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_skill`
--
ALTER TABLE `course_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `internship_student`
--
ALTER TABLE `internship_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill_student`
--
ALTER TABLE `skill_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `course_skill`
--
ALTER TABLE `course_skill`
  ADD CONSTRAINT `course_skill_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD CONSTRAINT `course_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `internships`
--
ALTER TABLE `internships`
  ADD CONSTRAINT `fk_internship_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `fk_internship_contact_person_id` FOREIGN KEY (`contact_person_id`) REFERENCES `contact_person` (`id`);

--
-- Constraints for table `internship_student`
--
ALTER TABLE `internship_student`
  ADD CONSTRAINT `internship_student_ibfk_1` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `internship_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skill_student`
--
ALTER TABLE `skill_student`
  ADD CONSTRAINT `skill_student_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
  ADD CONSTRAINT `skill_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `fk_student_course_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
