-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2021 at 11:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE `accounts_tbl` (
  `uid` int(11) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`uid`, `lname`, `fname`, `email`, `phone_number`) VALUES
(5, 'Akugbe', 'Stephen', 'harkugbeosaz', '0909'),
(6, 'Akugbe', 'Stephen', 'harkugbeosaz@gmail.com', '09092373298'),
(7, 'Akugbe', 'Samuel', 'sakugbe@gmail.com', '08087899987'),
(9, 'Akugbe', 'Samuel', 'akugbestephen3@gmail.com', '07041165200');

-- --------------------------------------------------------

--
-- Table structure for table `application_status_tbl`
--

CREATE TABLE `application_status_tbl` (
  `id` int(11) NOT NULL,
  `application_status` varchar(40) NOT NULL,
  `remarks` text NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_status_tbl`
--

INSERT INTO `application_status_tbl` (`id`, `application_status`, `remarks`, `active`) VALUES
(1, 'incomplete', 'Application yet to be submitted', 1),
(2, 'submitted', 'Application submitted', 1),
(3, 'reviewed', 'Application reviewed but no action taken yet', 1),
(4, 'shortlisted', 'Application reviewed and applicant to move to the next stage', 1),
(5, 'not shortlisted', 'Application reviewed and applicant cannot move to the next stage', 1),
(6, 'selected for interview', 'Applicant invited for physical interview', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_of_degree`
--

CREATE TABLE `class_of_degree` (
  `degree_id` int(10) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `degree_abbr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_of_degree`
--

INSERT INTO `class_of_degree` (`degree_id`, `degree`, `degree_abbr`) VALUES
(1, 'First Class', '1st Class'),
(2, 'Second Class Honours (Upper Division)', '2:1'),
(3, 'Second Class Honours (Lower Division)', '2:2'),
(4, 'Third Class', '3rd Class'),
(5, 'Distinction', ''),
(6, 'Upper Credit', 'Upper Credit'),
(7, 'Lower Credit', 'Lower Credit'),
(8, 'Pass', 'Pass'),
(9, 'Other', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countryid` smallint(6) NOT NULL,
  `country` varchar(150) NOT NULL,
  `countrycode` char(10) NOT NULL,
  `phoneCode` char(19) NOT NULL,
  `nationality` varchar(150) NOT NULL,
  `currency` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 121856 kB; InnoDB free: 121856 kB; InnoDB free:';

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countryid`, `country`, `countrycode`, `phoneCode`, `nationality`, `currency`) VALUES
(1, 'Andorra, Principality Of', 'AD', '376', '', ''),
(2, 'United Arab Emirates', 'AE', '971', '', ''),
(3, 'Afghanistan, Islamic State Of', 'AF', '93', '', ''),
(4, 'Antigua And Barbuda', 'AG', '1-268', '', ''),
(5, 'Anguilla', 'AI', '1-264', '', ''),
(6, 'Albania', 'AL', '355', '', ''),
(7, 'Armenia', 'AM', '374', '', ''),
(8, 'Netherlands Antilles', 'AN', '599', '', ''),
(9, 'Angola', 'AO', '244', '', ''),
(10, 'Antarctica', 'AQ', '672', '', ''),
(11, 'Argentina', 'AR', '54', '', ''),
(12, 'American Samoa', 'AS', '1-684', '', ''),
(13, 'Austria', 'AT', '43', '', ''),
(14, 'Australia', 'AU', '61', '', ''),
(15, 'Aruba', 'AW', '297', '', ''),
(16, 'Azerbaidjan', 'AZ', '994', '', ''),
(17, 'Bosnia-Herzegovina', 'BA', '387', '', ''),
(18, 'Barbados', 'BB', '1-246', '', ''),
(19, 'Bangladesh', 'BD', '880', '', ''),
(20, 'Belgium', 'BE', '32', '', ''),
(21, 'Burkina Faso', 'BF', '226', '', ''),
(22, 'Bulgaria', 'BG', '359', '', ''),
(23, 'Bahrain', 'BH', '973', '', ''),
(24, 'Burundi', 'BI', '257', '', ''),
(25, 'Benin', 'BJ', '229', '', ''),
(26, 'Bermuda', 'BM', '1-441', '', ''),
(27, 'Brunei Darussalam', 'BN', '673', '', ''),
(28, 'Bolivia', 'BO', '591', '', ''),
(29, 'Brazil', 'BR', '55', '', ''),
(30, 'Bahamas', 'BS', '1-242', '', ''),
(31, 'Bhutan', 'BT', '975', '', ''),
(32, 'Bouvet Island', 'BV', '55', '', ''),
(33, 'Botswana', 'BW', '267', '', ''),
(34, 'Belarus', 'BY', '375', '', ''),
(35, 'Belize', 'BZ', '501', '', ''),
(36, 'Canada', 'CA', '1', '', ''),
(37, 'Cocos (Keeling) Islands', 'CC', '61', '', ''),
(38, 'Central African Republic', 'CF', '236', '', ''),
(39, 'Congo, The Democratic Republic', 'CD', '243', '', ''),
(40, 'Congo', 'CG', '242', '', ''),
(41, 'Switzerland', 'CH', '41', '', ''),
(42, 'Ivory Coast (Cote D\'Ivoire)', 'CI', '225', '', ''),
(43, 'Cook Islands', 'CK', '682', '', ''),
(44, 'Chile', 'CL', '56', '', ''),
(45, 'Cameroon', 'CM', '237', '', ''),
(46, 'China', 'CN', '86', '', ''),
(47, 'Colombia', 'CO', '57', '', ''),
(48, 'Costa Rica', 'CR', '506', '', ''),
(49, 'Former Czechoslovakia', 'CS', '420', '', ''),
(50, 'Cuba', 'CU', '53', '', ''),
(51, 'Cape Verde', 'CV', '238', '', ''),
(52, 'Christmas Island', 'CX', '53', '', ''),
(53, 'Cyprus', 'CY', '357', '', ''),
(54, 'Czech Republic', 'CZ', '420', '', ''),
(55, 'Germany', 'DE', '49', '', ''),
(56, 'Djibouti', 'DJ', '253', '', ''),
(57, 'Denmark', 'DK', '45', '', ''),
(58, 'Dominica', 'DM', '1-767', '', ''),
(59, 'Dominican Republic', 'DO', '1-809', '', ''),
(60, 'Algeria', 'DZ', '213', '', ''),
(61, 'Ecuador', 'EC', '593', '', ''),
(62, 'Estonia', 'EE', '372', '', ''),
(63, 'Egypt', 'EG', '20', '', ''),
(64, 'Western Sahara', 'EH', '212', '', ''),
(65, 'Eritrea', 'ER', '291', '', ''),
(66, 'Spain', 'ES', '34', '', ''),
(67, 'Ethiopia', 'ET', '251', '', ''),
(68, 'Finland', 'FI', '358', '', ''),
(69, 'Fiji', 'FJ', '679', '', ''),
(70, 'Falkland Islands', 'FK', '500', '', ''),
(71, 'Micronesia', 'FM', '691', '', ''),
(72, 'Faroe Islands', 'FO', '298', '', ''),
(73, 'France', 'FR', '33', '', ''),
(74, 'France (European Territory)', 'FX', '', '', ''),
(75, 'Gabon', 'GA', '241', '', ''),
(76, 'Great Britain', 'GB', '44', '', ''),
(77, 'Grenada', 'GD', '1-473', '', ''),
(78, 'Georgia', 'GE', '995', '', ''),
(79, 'French Guyana', 'GF', '594', '', ''),
(80, 'Ghana', 'GH', '233', '', ''),
(81, 'Gibraltar', 'GI', '350', '', ''),
(82, 'Greenland', 'GL', '299', '', ''),
(83, 'Gambia', 'GM', '220', '', ''),
(84, 'Guinea', 'GN', '224', '', ''),
(85, 'USA Government', 'GOV', '', '', ''),
(86, 'Guadeloupe (French)', 'GP', '590', '', ''),
(87, 'Equatorial Guinea', 'GQ', '240', '', ''),
(88, 'Greece', 'GR', '30', '', ''),
(89, 'S. Georgia & S. Sandwich Isls.', 'GS', '500', '', ''),
(90, 'Guatemala', 'GT', '502', '', ''),
(91, 'Guam (USA)', 'GU', '1-671', '', ''),
(92, 'Guinea Bissau', 'GW', '245', '', ''),
(93, 'Guyana', 'GY', '592', '', ''),
(94, 'Hong Kong', 'HK', '852', '', ''),
(95, 'Heard And Mcdonald Islands', 'HM', '', '', ''),
(96, 'Honduras', 'HN', '504', '', ''),
(97, 'Croatia', 'HR', '385', '', ''),
(98, 'Haiti', 'HT', '509', '', ''),
(99, 'Hungary', 'HU', '36', '', ''),
(100, 'Indonesia', 'ID', '62', '', ''),
(101, 'Ireland', 'IE', '353', '', ''),
(102, 'Israel', 'IL', '972', '', ''),
(103, 'India', 'IN', '91', '', ''),
(104, 'British Indian Ocean Territory', 'IO', '246', '', ''),
(105, 'Iraq', 'IQ', '964', '', ''),
(106, 'Iran', 'IR', '98', '', ''),
(107, 'Iceland', 'IS', '354', '', ''),
(108, 'Italy', 'IT', '39', '', ''),
(109, 'Jamaica', 'JM', '1-876', '', ''),
(110, 'Jordan', 'JO', '962', '', ''),
(111, 'Japan', 'JP', '81', '', ''),
(112, 'Kenya', 'KE', '254', '', ''),
(113, 'Kyrgyz Republic (Kyrgyzstan)', 'KG', '996', '', ''),
(114, 'Cambodia, Kingdom Of', 'KH', '855', '', ''),
(115, 'Kiribati', 'KI', '686', '', ''),
(116, 'Comoros', 'KM', '269', '', ''),
(117, 'Saint Kitts & Nevis Anguilla', 'KN', '1-869', '', ''),
(118, 'North Korea', 'KP', '850', '', ''),
(119, 'South Korea', 'KR', '82', '', ''),
(120, 'Kuwait', 'KW', '965', '', ''),
(121, 'Cayman Islands', 'KY', '1-345', '', ''),
(122, 'Kazakhstan', 'KZ', '7', '', ''),
(123, 'Laos', 'LA', '856', '', ''),
(124, 'Lebanon', 'LB', '961', '', ''),
(125, 'Saint Lucia', 'LC', '1-758', '', ''),
(126, 'Liechtenstein', 'LI', '423', '', ''),
(127, 'Sri Lanka', 'LK', '94', '', ''),
(128, 'Liberia', 'LR', '231', '', ''),
(129, 'Lesotho', 'LS', '266', '', ''),
(130, 'Lithuania', 'LT', '370', '', ''),
(131, 'Luxembourg', 'LU', '352', '', ''),
(132, 'Latvia', 'LV', '371', '', ''),
(133, 'Libya', 'LY', '218', '', ''),
(134, 'Morocco', 'MA', '212', '', ''),
(135, 'Monaco', 'MC', '377', '', ''),
(136, 'Moldavia', 'MD', '373', '', ''),
(137, 'Madagascar', 'MG', '261', '', ''),
(138, 'Marshall Islands', 'MH', '692', '', ''),
(139, 'Macedonia', 'MK', '389', '', ''),
(140, 'Mali', 'ML', '223', '', ''),
(141, 'Myanmar', 'MM', '95', '', ''),
(142, 'Mongolia', 'MN', '976', '', ''),
(143, 'Macau', 'MO', '853', '', ''),
(144, 'Northern Mariana Islands', 'MP', '1-670', '', ''),
(145, 'Martinique (French)', 'MQ', '596', '', ''),
(146, 'Mauritania', 'MR', '222', '', ''),
(147, 'Montserrat', 'MS', '1-664', '', ''),
(148, 'Malta', 'MT', '356', '', ''),
(149, 'Mauritius', 'MU', '230', '', ''),
(150, 'Maldives', 'MV', '960', '', ''),
(151, 'Malawi', 'MW', '265', '', ''),
(152, 'Mexico', 'MX', '52', '', ''),
(153, 'Malaysia', 'MY', '60', '', ''),
(154, 'Mozambique', 'MZ', '258', '', ''),
(155, 'Namibia', 'NA', '264', '', ''),
(156, 'New Caledonia (French)', 'NC', '687', '', ''),
(157, 'Niger', 'NE', '227', '', ''),
(158, 'Norfolk Island', 'NF', '672', '', ''),
(159, 'Nigeria', 'NG', '234', 'Nigerian', ''),
(160, 'Nicaragua', 'NI', '505', '', ''),
(161, 'Netherlands', 'NL', '31', '', ''),
(162, 'Norway', 'NO', '47', '', ''),
(163, 'Nepal', 'NP', '977', '', ''),
(164, 'Nauru', 'NR', '674', '', ''),
(165, 'Niue', 'NU', '683', '', ''),
(166, 'New Zealand', 'NZ', '64', '', ''),
(167, 'Oman', 'OM', '968', '', ''),
(168, 'Panama', 'PA', '507', '', ''),
(169, 'Peru', 'PE', '51', '', ''),
(170, 'Polynesia (French)', 'PF', '689', '', ''),
(171, 'Papua New Guinea', 'PG', '675', '', ''),
(172, 'Philippines', 'PH', '63', '', ''),
(173, 'Pakistan', 'PK', '92', '', ''),
(174, 'Poland', 'PL', '48', '', ''),
(175, 'Saint Pierre And Miquelon', 'PM', '508', '', ''),
(176, 'Pitcairn Island', 'PN', '64', '', ''),
(177, 'Puerto Rico', 'PR', '1-787', '', ''),
(178, 'Portugal', 'PT', '351', '', ''),
(179, 'Palau', 'PW', '680', '', ''),
(180, 'Paraguay', 'PY', '595', '', ''),
(181, 'Qatar', 'QA', '974', '', ''),
(182, 'Reunion (Ffrench)', 'RE', '262', '', ''),
(183, 'Romania', 'RO', '40', '', ''),
(184, 'Russian Federation', 'RU', '7', '', ''),
(185, 'Rwanda', 'RW', '250', '', ''),
(186, 'Saudi Arabia', 'SA', '966', '', ''),
(187, 'Solomon Islands', 'SB', '677', '', ''),
(188, 'Seychelles', 'SC', '248', '', ''),
(189, 'Sudan', 'SD', '249', '', ''),
(190, 'Sweden', 'SE', '46', '', ''),
(191, 'Singapore', 'SG', '65', '', ''),
(192, 'Saint Helena', 'SH', '290', '', ''),
(193, 'Slovenia', 'SI', '386', '', ''),
(194, 'Svalbard And Jan Mayen Islands', 'SJ', '47', '', ''),
(195, 'Slovak Republic', 'SK', '421', '', ''),
(196, 'Sierra Leone', 'SL', '232', '', ''),
(197, 'San Marino', 'SM', '378', '', ''),
(198, 'Senegal', 'SN', '221', '', ''),
(199, 'Somalia', 'SO', '252', '', ''),
(200, 'Suriname', 'SR', '597', '', ''),
(201, 'Saint Tome (Sao Tome) And Principe', 'ST', '239', '', ''),
(202, 'Former USSR', 'SU', '', '', ''),
(203, 'El Salvador', 'SV', '503', '', ''),
(204, 'Syria', 'SY', '963', '', ''),
(205, 'Swaziland', 'SZ', '268', '', ''),
(206, 'Turks And Caicos Islands', 'TC', '1-649', '', ''),
(207, 'Chad', 'TD', '235', '', ''),
(208, 'French Southern Territories', 'TF', '', '', ''),
(209, 'Togo', 'TG', '228', '', ''),
(210, 'Thailand', 'TH', '66', '', ''),
(211, 'Tadjikistan', 'TJ', '992', '', ''),
(212, 'Tokelau', 'TK', '690', '', ''),
(213, 'Turkmenistan', 'TM', '993', '', ''),
(214, 'Tunisia', 'TN', '216', '', ''),
(215, 'Tonga', 'TO', '676', '', ''),
(216, 'East Timor', 'TP', '670', '', ''),
(217, 'Turkey', 'TR', '90', '', ''),
(218, 'Trinidad And Tobago', 'TT', '1-868', '', ''),
(219, 'Tuvalu', 'TV', '688', '', ''),
(220, 'Taiwan', 'TW', '886', '', ''),
(221, 'Tanzania', 'TZ', '255', '', ''),
(222, 'Ukraine', 'UA', '380', '', ''),
(223, 'Uganda', 'UG', '256', '', ''),
(224, 'United Kingdom', 'UK', '44', '', ''),
(225, 'Usa Minor Outlying Islands', 'UM', '1', '', ''),
(226, 'United States', 'US', '1', '', ''),
(227, 'Uruguay', 'UY', '598', '', ''),
(228, 'Uzbekistan', 'UZ', '998', '', ''),
(229, 'Holy See (Vatican City State)', 'VA', '379', '', ''),
(230, 'Saint Vincent & Grenadines', 'VC', '1-784', '', ''),
(231, 'Venezuela', 'VE', '58', '', ''),
(232, 'Virgin Islands (British)', 'VG', '1-284', '', ''),
(233, 'Virgin Islands (USA)', 'VI', '1-340', '', ''),
(234, 'Vietnam', 'VN', '84', '', ''),
(235, 'Vanuatu', 'VU', '678', '', ''),
(236, 'Wallis And Futuna Islands', 'WF', '681', '', ''),
(237, 'Samoa', 'WS', '685', '', ''),
(238, 'Yemen', 'YE', '967', '', ''),
(239, 'Mayotte', 'YT', '262', '', ''),
(240, 'Yugoslavia', 'YU', '38', '', ''),
(241, 'South Africa', 'ZA', '27', '', ''),
(242, 'Zambia', 'ZM', '260', '', ''),
(243, 'Zaire', 'ZR', '243', '', ''),
(244, 'Zimbabwe', 'ZW', '263', '', ''),
(252, 'Nagorno-Karabakh', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `currentstafflist`
-- (See below for the actual view)
--
CREATE TABLE `currentstafflist` (
`id` int(11)
,`idno` varchar(50)
,`title` varchar(50)
,`sname` varchar(50)
,`fname` varchar(50)
,`mname` varchar(50)
,`gender` varchar(50)
,`dob` varchar(50)
,`maidenname` varchar(50)
,`mstatus` varchar(30)
,`religion` varchar(60)
,`address1` varchar(100)
,`address2` varchar(100)
,`state` varchar(50)
,`phoneno` varchar(100)
,`email` varchar(100)
,`nationality` varchar(70)
,`stateoforigin` varchar(50)
,`lga` varchar(50)
,`hometown` varchar(100)
,`dresume` date
,`unit` varchar(100)
,`post` varchar(70)
,`dept` varchar(40)
,`specialization` varchar(150)
,`category` varchar(50)
,`subcategory` varchar(50)
,`employmenttype` varchar(30)
,`employmentstatus` varchar(50)
,`sallev` varchar(50)
,`dutypost` int(11)
,`dutypay` varchar(50)
,`special` double
,`bank` varchar(50)
,`baccount` double
,`nhf` varchar(50)
,`nhfno` varchar(50)
,`pfa` varchar(50)
,`pfano` varchar(50)
,`modifiedat` datetime
,`appno` int(11)
,`grosspay` int(40)
,`peradres1` varchar(255)
,`peradres2` varchar(255)
,`peradres3` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dpid` int(50) NOT NULL,
  `dept` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(50) NOT NULL,
  `actiondate` datetime NOT NULL,
  `staffid` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dpid`, `dept`, `status`, `actiondate`, `staffid`) VALUES
(1, 1, 'Admin', 1, '2020-08-10 01:40:00', ''),
(2, 2, 'Software', 1, '2020-08-20 00:00:00', ''),
(3, 3, 'Maintenance', 1, '2020-08-20 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `educational_history_tbl`
--

CREATE TABLE `educational_history_tbl` (
  `educ_hist_id` int(10) NOT NULL,
  `applicant_id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `location` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `course` varchar(255) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `class_of_degree` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educational_history_tbl`
--

INSERT INTO `educational_history_tbl` (`educ_hist_id`, `applicant_id`, `vacancy_id`, `institution`, `location`, `start_date`, `end_date`, `course`, `degree`, `class_of_degree`) VALUES
(1, 1, '5', 'University of Benin', 'Edo', '2020-09-01', '2020-09-30', 'Computer Science', 'Bsc. Computer Science', 'Second Class Honours (Upper Division)'),
(2, 1, '5', 'University of Benin', 'Kaduna', '2020-09-30', '2020-10-11', 'Software Engineering', 'Msc. Computer Science', 'Distinction'),
(216, 3, '9', 'Federal Polytechnic, Ado Ekiti', 'Ado Ekiti', '2016-01-01', '2018-10-15', 'Electrical Engineering', 'HND', 'Distinction'),
(217, 5, '3', 'University of Benin', 'Benin City', '2014-05-24', '2018-04-23', 'Agricultural Engineering', 'B.Eng', 'Second Class Honours (Upper Division)'),
(221, 2, '6', 'University of Benin', 'Benin City', '2020-09-01', '2020-10-11', 'Computer Sciences', 'Bsc', 'Second Class Honours (Upper Division)'),
(222, 2, '6', 'University of Benin', 'Benin', '2020-07-01', '2020-09-02', 'Computer Sciences', 'Bsc', 'Second Class Honours (Lower Division)'),
(223, 2, '6', 'University of Benin', 'Edo State', '2020-09-01', '2020-10-23', 'Computer Sciences', 'Msc', 'First Class'),
(225, 4, '8', 'Ekiti State University', 'Ado Ekiti', '2014-09-13', '2019-10-22', 'Computer Science', 'Bsc.', 'Second Class Honours (Upper Division)'),
(231, 7, 'V20-09-002', '', '', '0000-00-00', '0000-00-00', '', '', 'Class of degree'),
(233, 6, 'V-20-09-001', '', '', '0000-00-00', '0000-00-00', '', '', 'Class of degree'),
(235, 8, '1', '', '', '0000-00-00', '0000-00-00', '', '', 'Class of degree'),
(236, 10, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(237, 9, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(238, 9, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(239, 10, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(240, 9, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(241, 9, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(242, 11, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(243, 11, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(244, 12, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(245, 12, 'V-20-09-001', 'University of Sunderland', 'Benin City', '2015-10-01', '2020-11-06', 'Computer Science', 'BSc', 'Second Class Honours (Upper Division)'),
(246, 13, 'V-20-09-002', 'University of Benin', 'Benin City', '2019-08-06', '2020-11-29', 'Computer Science', 'Bsc.', 'Second Class Honours (Upper Division)');

-- --------------------------------------------------------

--
-- Table structure for table `eligibility_passmark`
--

CREATE TABLE `eligibility_passmark` (
  `id` int(11) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `passmark` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eligibility_passmark`
--

INSERT INTO `eligibility_passmark` (`id`, `vacancy_id`, `passmark`) VALUES
(0, '1', 0),
(0, 'V-20-09-001', 2),
(0, 'V-20-09-002', 3),
(0, 'V-20-09-003', 4);

-- --------------------------------------------------------

--
-- Table structure for table `eligibility_questions_tbl`
--

CREATE TABLE `eligibility_questions_tbl` (
  `question_id` int(11) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `question` text NOT NULL,
  `expected_answer` int(2) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eligibility_questions_tbl`
--

INSERT INTO `eligibility_questions_tbl` (`question_id`, `vacancy_id`, `question`, `expected_answer`, `type`) VALUES
(5, 'V-20-09-003', 'Do you have a COREN certification?', 1, 'Compulsory'),
(6, 'V-20-09-003', 'Do you have PMP certification?', 1, 'Compulsory'),
(7, 'V-20-09-003', 'Do you have experience working with solar power engineering?', 1, 'Compulsory'),
(8, 'V-20-09-003', 'Can you resume with us immediately?', 1, 'Advantage'),
(9, 'V-20-09-003', 'Do you have any experience working with CAD tools?', 1, 'Compulsory'),
(10, 'V-20-09-001', 'Do you have PMP certification?', 1, 'Compulsory'),
(11, 'V-20-09-001', 'Do you have any experience using CAD tools?', 1, 'Compulsory'),
(12, 'V-20-09-001', 'Do you have any experience managing projects', 1, 'Advantage'),
(13, 'V-20-09-002', 'Have you ever worked with a team on a project?', 1, 'Compulsory'),
(14, 'V-20-09-002', 'Have you ever developed a website with wordpress', 1, 'Compulsory'),
(15, 'V-20-09-002', 'Can you design a plugin for a wordpress site?', 1, 'Compulsory'),
(16, 'V-20-09-002', 'Have you ever worked with a javascript library or framework?', 1, 'Advantage');

-- --------------------------------------------------------

--
-- Table structure for table `eligibility_responses`
--

CREATE TABLE `eligibility_responses` (
  `id` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `qid` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `response` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eligibility_responses`
--

INSERT INTO `eligibility_responses` (`id`, `uid`, `qid`, `vacancy_id`, `response`) VALUES
(213, 6, 5, 'V-20-09-003', '1'),
(214, 6, 6, 'V-20-09-003', '1'),
(215, 6, 7, 'V-20-09-003', '1'),
(216, 6, 8, 'V-20-09-003', '1'),
(217, 6, 9, 'V-20-09-003', '1'),
(228, 6, 10, 'V-20-09-001', '1'),
(229, 6, 11, 'V-20-09-001', '1'),
(230, 6, 12, 'V-20-09-001', '1'),
(231, 6, 13, 'V-20-09-002', '1'),
(232, 6, 14, 'V-20-09-002', '1'),
(233, 6, 15, 'V-20-09-002', '1'),
(234, 6, 16, 'V-20-09-002', '1');

-- --------------------------------------------------------

--
-- Table structure for table `employmentcategory`
--

CREATE TABLE `employmentcategory` (
  `id` int(11) NOT NULL,
  `typ` int(50) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(50) NOT NULL,
  `actiondate` datetime NOT NULL,
  `staffid` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employmentcategory`
--

INSERT INTO `employmentcategory` (`id`, `typ`, `type`, `status`, `actiondate`, `staffid`) VALUES
(1, 1, 'Technical', 1, '2020-08-10 01:41:00', ''),
(2, 2, 'Non-Technical', 1, '2020-08-10 01:42:00', ''),
(3, 3, 'Casual', 1, '2020-08-22 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `employmenttype`
--

CREATE TABLE `employmenttype` (
  `id` int(11) NOT NULL,
  `typ` int(50) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(50) NOT NULL,
  `actiondate` datetime NOT NULL,
  `staffid` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employmenttype`
--

INSERT INTO `employmenttype` (`id`, `typ`, `type`, `status`, `actiondate`, `staffid`) VALUES
(1, 1, 'Regular', 1, '2020-08-10 01:43:00', ''),
(2, 2, 'Intern', 1, '2020-08-10 01:44:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `full` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `full`, `gender`) VALUES
(1, 'Male', 'M'),
(2, 'Female', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `interview_panelists_tbl`
--

CREATE TABLE `interview_panelists_tbl` (
  `id` int(10) NOT NULL,
  `panel_id` int(10) NOT NULL,
  `staff_id` varchar(12) NOT NULL,
  `staff_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interview_panelists_tbl`
--

INSERT INTO `interview_panelists_tbl` (`id`, `panel_id`, `staff_id`, `staff_name`) VALUES
(7, 4, 'PN/2020/001', 'Mrs Aboyade Opeyemi '),
(8, 4, 'PN/2014/003', 'Mr Anyasodo Timothy '),
(10, 4, 'external1', 'Dcns.  Aboyade'),
(16, 6, 'PN/2014/002', 'Dr Aboyade Akinwale '),
(19, 7, 'PN/2020/001', 'Mrs Aboyade Opeyemi '),
(20, 7, 'PN/2014/003', 'Mr Anyasodo Timothy '),
(21, 7, 'external1', 'Dcns.  Aboyade'),
(22, 7, 'PN/2019/004', 'Mr Ilogho Fredrick '),
(30, 5, 'external1', 'Oluyole Samson'),
(31, 5, 'PN/2014/004', ' Ipadeola Adeola  '),
(32, 5, 'PN/2017/003', 'Mr Onogu Williams '),
(33, 5, 'PN/2019/001', ' Sunday Isaac  ');

-- --------------------------------------------------------

--
-- Table structure for table `interview_panels_tbl`
--

CREATE TABLE `interview_panels_tbl` (
  `panel_id` int(11) NOT NULL,
  `panel_name` varchar(50) NOT NULL,
  `interview_date` date NOT NULL,
  `venue` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interview_panels_tbl`
--

INSERT INTO `interview_panels_tbl` (`panel_id`, `panel_name`, `interview_date`, `venue`, `status`) VALUES
(5, 'Panel C', '2020-12-23', 'Data centre hub', 1),
(6, 'Panel D', '2020-12-12', 'Manager\'s Office', 1),
(7, 'Panel B', '2020-12-12', 'Conference Room', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_applicants_tbl`
--

CREATE TABLE `job_applicants_tbl` (
  `job_app_id` int(10) NOT NULL,
  `applicant_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `vacancy_category_id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `employment_type` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `other_name` varchar(30) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(30) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `state_of_origin` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `alt_phone_number` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_of_residence` varchar(50) NOT NULL,
  `cv_upload` varchar(100) NOT NULL,
  `application_message` text NOT NULL,
  `application_date` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `submit_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_applicants_tbl`
--

INSERT INTO `job_applicants_tbl` (`job_app_id`, `applicant_id`, `uid`, `vacancy_category_id`, `vacancy_id`, `employment_type`, `department_id`, `position_id`, `title`, `surname`, `first_name`, `other_name`, `sex`, `dob`, `marital_status`, `nationality`, `state_of_origin`, `lga`, `hometown`, `phone_number`, `alt_phone_number`, `email`, `street`, `city`, `state_of_residence`, `cv_upload`, `application_message`, `application_date`, `status`, `submit_status`) VALUES
(1, 1, 4, 2, '5', 1, 1, 2, 'Title', 'Akugbe', 'Samuel', 'Osalumense', 'Male', '1997-06-25', 'Single', 'Nigeria', 'Edo', 'Esan Central', 'Opoji', '09092373298', '07041156200', 'akugbestephen3@gmail.com', '16, Remi Alao Street, Iyana Iyesi', 'Ota', 'Ogun', 'CV_Akugbe_Stephen (1).pdf', 'I need a job', '2020-09-08', 'Not Shortlisted', 'submitted'),
(2, 2, 4, 1, '6', 1, 3, 4, 'Dr', 'Akugbe', 'Samuel', 'Ajimobi', 'Male', '1997-06-26', 'Married', 'Australia', 'Edo', 'Esan Central', 'lkeduru', '09092373298', '07041156200', 'Oluwajuwonsamuel9@gmail.com', 'University of Benin, Ugbowo campus, Benin  city', 'Benin', 'Edo', 'Stephen CV.pdf', 'I want a job like this today', '2020-09-16', '', 'submitted'),
(3, 3, 4, 2, '9', 1, 3, 4, 'Mr', 'Akugbe', 'Samuel', 'Osalumense', 'Male', '2000-09-01', 'Single', 'Nigeria', 'Edo', 'Oredo', 'hometown', '09092373298', '09093207440', 'sakugbe@gmail.com', 'University of Benin, Ugbowo campus, Benin  city', 'Ado Ekiti', 'Ekiti', 'Stephen CV.pdf', 'I hope to usefully apply my engineering skillls to move the company forward and aslo develop my capacity and capabilities as an engineer', '2020-09-15', 'Shortlisted', 'submitted'),
(4, 4, 4, 2, '8', 1, 2, 3, 'Mr', 'Akugbe', 'Samuel', 'Oreoluwa', 'Male', '1998-06-22', 'Single', 'Nigeria', 'Ekiti', 'Ijero', 'Omuo Ekiti', '09092373298', '07041165200', 'akugbestephen3@gmail.com', '25, NTA road, beside UBA, ', 'Ado Ekiti', 'Ekiti', 'CertificateOfCompletion_Succeeding in Web Development_ Full Stack and Front End.pdf', 'I hope to work to achieve the goals of the organization while also developing my skills and contributing immensely to the growth of the organization.', '2020-09-15', 'incomplete', 'incomplete'),
(5, 5, 4, 1, '3', 1, 1, 1, 'Engr', 'Akugbe', 'Samuel', 'Osazua', 'Male', '1991-09-07', 'Married', 'Ecuador', 'Edo', 'Esan Central', 'Irrua', '09092373298', '', 'sakugbe@gmail.com', 'University of Benin, Ugbowo campus, Benin  city', 'Benin', 'Edo', 'CertificateOfCompletion_Succeeding in Web Development_ Full Stack and Front End.pdf', 'I hope to be taken into the organization, I will give my best at all times.', '2020-09-15', 'Shortlisted', 'submitted'),
(7, 7, 4, 3, 'V20-09-002', 2, 2, 3, 'Title', 'Akugbe', 'Samuel', 'Osazua', 'Male', '0000-00-00', 'Single', 'Nigeria', 'Cross River', 'Ogoja', '', '07060505020', '', 'akugbestephen3@gmail.com', '', '', 'state of residence', '7.pdf', '', '2020-09-25', '', 'incomplete'),
(8, 8, 4, 1, '1', 2, 1, 1, 'Title', 'Akugbe', 'Samuel', 'Osazua', 'Male', '0000-00-00', 'Marital Status', 'Select Nationality', 'state of origin', '', '', '07060505020', '', 'akugbestephen3@gmail.com', '', '', 'state of residence', '', '', '2020-09-26', '', 'incomplete'),
(9, 9, 6, 1, 'V-20-09-001', 1, 3, 5, 'Mr', 'Akugbe', 'Stephen', 'Osalumense', 'Male', '2020-11-06', 'Single', 'Nigeria', 'Edo', 'Esan Central', 'Irrua', '09092373298', '', 'harkugbeosaz@gmail.com', '16, Remi Alao street', 'Iyana Iyesi', 'Ogun', '9.pdf', 'I want to apply for this job...', '2020-11-06', 'shortlisted', 'submitted'),
(19, 13, 6, 2, 'V-20-09-002', 2, 2, 3, 'Mrs', 'Akugbe', 'Salome', 'Osatohanmen', 'Female', '2020-11-06', 'Single', 'Nigeria', 'Edo', 'Esan Central', 'Benin', '09092373298', '09092373298', 'harkugbeosaz@gmail.com', 'University of Benin, Ugbowo campus, Benin  city', 'Benin City', 'Edo', '13.pdf', 'I want to learn web development', '2020-11-06', '', 'submitted');

-- --------------------------------------------------------

--
-- Table structure for table `job_users`
--

CREATE TABLE `job_users` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `other_name` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_users`
--

INSERT INTO `job_users` (`id`, `uid`, `fname`, `lname`, `other_name`, `email`, `phone_number`, `image`, `password`, `date_created`, `token`, `token_expire`, `active`) VALUES
(4, 4, 'Samuel', 'Akugbe', 'Osazua', 'akugbestephen3@gmail.com', '07060505020', 'pic.png', 'b9bcb399b44700d0300bf9e63f079443622b424a', '2020-08-31 21:55:00', '', '2020-10-01 00:22:15', 1),
(5, 5, 'Samuel', 'Akugbe', '', 'stephenforbiz@gmail.com', '', '', 'b9bcb399b44700d0300bf9e63f079443622b424a', '2020-08-31 21:57:07', '6529fe53ec50b509067d', '2020-10-01 00:22:15', 0),
(6, 6, 'Stephen', 'Akugbe', 'Osalumense', 'harkugbeosaz@gmail.com', '09092373298', '', 'b9bcb399b44700d0300bf9e63f079443622b424a', '2020-10-01 11:23:31', '', '2020-10-02 09:22:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_vacancy_tbl`
--

CREATE TABLE `job_vacancy_tbl` (
  `id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `vacancy_category_id` int(10) NOT NULL,
  `employment_type` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `job_summary` text NOT NULL,
  `experience_level` text NOT NULL,
  `salary` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `creation_date` date NOT NULL,
  `closing_date` date NOT NULL,
  `job_location` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_vacancy_tbl`
--

INSERT INTO `job_vacancy_tbl` (`id`, `vacancy_id`, `vacancy_category_id`, `employment_type`, `department_id`, `post_id`, `job_summary`, `experience_level`, `salary`, `status`, `creation_date`, `closing_date`, `job_location`) VALUES
(1, '1', 1, 2, 1, 1, 'summary extended', 'experience', 'salary increased', 'Active', '2020-08-04', '2020-12-05', 'Minna, Niger State'),
(2, '2', 1, 2, 1, 1, 'summary', 'experience', 'salary', 'Active', '2020-08-20', '2020-08-26', 'Yola, Adamawa State'),
(3, '3', 1, 1, 1, 1, 'summary', 'experience', 'salary', 'Active', '2020-08-11', '2020-10-22', 'Makurdi, Benue State'),
(4, '4', 2, 2, 1, 2, 'job summery includes keeping the labs clean', 'Minimum experience level', 'Between 50 to 60k minimum', 'Active', '0000-00-00', '2020-09-01', 'Gombe, Gombe State'),
(5, '5', 2, 1, 1, 2, 'sdffqasd', 'adafoadf', 'adfadf', 'Active', '0000-00-00', '2020-09-30', 'Abeokuta, Ogun State'),
(6, '6', 1, 1, 3, 4, 'In need of an engineer with a minimum of 3 years experience to augment the services of our in-house engineers', 'Intermediate level experience', 'Between 70 to 80k', 'Active', '0000-00-00', '2020-09-30', 'Ota, Ogun State'),
(7, '7', 2, 2, 1, 3, 'job summary', 'exps levels', 'between 100k to 150k', 'Active', '0000-00-00', '2020-09-06', 'Ikeja, Lagos State'),
(8, '8', 2, 1, 2, 3, 'job summary', 'experienced programmer', '50k', 'Active', '0000-00-00', '2020-10-23', 'Enugu, Enugu State'),
(9, '9', 2, 1, 3, 4, 'summary of the job', 'experience level', 'salary range', 'Active', '2020-09-01', '2020-09-30', 'Nyanya, Abuja '),
(10, 'V-20-09-001', 1, 1, 3, 5, 'An engineer is needed to fill a role as senior engineer in this organization', 'At least 5 years experience in the engineering field', 'Above 200k', 'Active', '2020-09-23', '2020-12-17', 'Gwagwalada, Abuja'),
(12, 'V-20-09-002', 2, 2, 2, 3, 'A paid internship opportunity for fresh graduates and corp members', 'Intermediate experience in web development', 'Between 10k to 15k based on experience', 'Active', '2020-09-23', '2020-12-24', 'Okota, Lagos State'),
(17, 'V-20-09-003', 2, 1, 2, 1, 'Summary', 'Exp level', 'Salary', 'Active', '2020-09-27', '2020-12-25', 'Gwagwalada, Abuja');

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE `lga` (
  `lga_id` mediumint(10) UNSIGNED NOT NULL DEFAULT 0,
  `state_id` int(11) NOT NULL DEFAULT 0,
  `lga_name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`lga_id`, `state_id`, `lga_name`) VALUES
(1, 1, 'Aba North'),
(2, 1, 'Aba South'),
(3, 1, 'Arochukwu'),
(4, 1, 'Bende'),
(5, 1, 'Ikwuano'),
(6, 1, 'Isiala-Ngwa North'),
(7, 1, 'Isiala-Ngwa South'),
(8, 1, 'Isikwuato'),
(9, 1, 'Nneochi'),
(10, 1, 'Obi-Ngwa'),
(11, 1, 'Ohafia'),
(12, 1, 'Osisioma'),
(13, 1, 'Ugwunagbo'),
(14, 1, 'Ukwa East'),
(15, 1, 'Ukwa West'),
(16, 1, 'Umuahia North'),
(17, 1, 'Umuahia South'),
(18, 2, 'Demsa'),
(19, 2, 'Fufore'),
(20, 2, 'Genye'),
(21, 2, 'Girei'),
(22, 2, 'Gombi'),
(23, 2, 'guyuk'),
(24, 2, 'Hong'),
(25, 2, 'Jada'),
(26, 2, 'Jimeta'),
(27, 2, 'Lamurde'),
(28, 2, 'Madagali'),
(29, 2, 'Maiha'),
(30, 2, 'Mayo Belwa'),
(31, 2, 'Michika'),
(32, 2, 'Mubi North'),
(33, 2, 'Mubi South'),
(34, 2, 'Numan'),
(35, 2, 'Shelleng'),
(36, 2, 'Song'),
(37, 2, 'Toungo'),
(38, 2, 'Yola'),
(39, 3, 'Abak'),
(40, 3, 'Eastern-Obolo'),
(41, 3, 'Eket'),
(42, 3, 'Ekpe-Atani'),
(43, 3, 'Essien-Udim'),
(44, 3, 'Esit Ekit'),
(45, 3, 'Etim-Ekpo'),
(46, 3, 'Etinam'),
(47, 3, 'Ibeno'),
(48, 3, 'Ibesikp-Asitan'),
(49, 3, 'Ibiono-Ibom'),
(50, 3, 'Ika'),
(51, 3, 'Ikono'),
(52, 3, 'Ikot-Abasi'),
(53, 3, 'Ikot-Ekpene'),
(54, 3, 'Ini'),
(55, 3, 'Itu'),
(56, 3, 'Mbo'),
(57, 3, 'Mkpae-Enin'),
(58, 3, 'Nsit-Ibom'),
(59, 3, 'Nsit-Ubium'),
(60, 3, 'Obot-Akara'),
(61, 3, 'Okobo'),
(62, 3, 'Onna'),
(63, 3, 'Oron'),
(64, 3, 'Oro-Anam'),
(65, 3, 'Udung-Uko'),
(66, 3, 'Ukanefun'),
(67, 3, 'Uru Offong Oruko'),
(68, 3, 'Uruan'),
(69, 3, 'Uquo Ibene'),
(70, 3, 'Uyo'),
(71, 4, 'Aguata'),
(72, 4, 'Anambra'),
(73, 4, 'Anambra West'),
(74, 4, 'Anocha'),
(75, 4, 'Awka- North'),
(76, 4, 'Awka-South'),
(77, 4, 'Ayamelum'),
(78, 4, 'Dunukofia'),
(79, 4, 'Ekwusigo'),
(80, 4, 'Idemili-North'),
(81, 4, 'Idemili-South'),
(82, 4, 'Ihiala'),
(83, 4, 'Njikoka'),
(84, 4, 'Nnewi-North'),
(85, 4, 'Nnewi-South'),
(86, 4, 'Ogbaru'),
(87, 4, 'Onisha North'),
(88, 4, 'Onitsha South'),
(89, 4, 'Orumba North'),
(90, 4, 'Orumba South'),
(91, 4, 'Oyi'),
(92, 5, 'Alkaleri'),
(93, 5, 'Bauchi'),
(94, 5, 'Bogoro'),
(95, 5, 'Damban'),
(96, 5, 'Darazo'),
(97, 5, 'Dass'),
(98, 5, 'Gamawa'),
(99, 5, 'Ganjuwa'),
(100, 5, 'Giade'),
(101, 5, 'Itas/Gadau'),
(102, 5, 'Jama\'are'),
(103, 5, 'Katagum'),
(104, 5, 'Kirfi'),
(105, 5, 'Misau'),
(106, 5, 'Ningi'),
(107, 5, 'Shira'),
(108, 5, 'Tafawa-Balewa'),
(109, 5, 'Toro'),
(110, 5, 'Warji'),
(111, 5, 'Zaki'),
(112, 6, 'Brass'),
(113, 6, 'Ekerernor'),
(114, 6, 'Kolokuma/Opokuma'),
(115, 6, 'Nembe'),
(116, 6, 'Ogbia'),
(117, 6, 'Sagbama'),
(118, 6, 'Southern-Ijaw'),
(119, 6, 'Yenegoa'),
(120, 6, 'Kembe'),
(121, 7, 'Ado'),
(122, 7, 'Agatu'),
(123, 7, 'Apa'),
(124, 7, 'Buruku'),
(125, 7, 'Gboko'),
(126, 7, 'Guma'),
(127, 7, 'Gwer-East'),
(128, 7, 'Gwer-West'),
(129, 7, 'Katsina-Ala'),
(130, 7, 'Konshisha'),
(131, 7, 'Kwande'),
(132, 7, 'Logo'),
(133, 7, 'Makurdi'),
(134, 7, 'Obi'),
(135, 7, 'Ogbadibo'),
(136, 7, 'Ohimini'),
(137, 7, 'Oju'),
(138, 7, 'Okpokwu'),
(139, 7, 'Otukpo'),
(140, 7, 'Tarkar'),
(141, 7, 'Vandeikya'),
(142, 7, 'Ukum'),
(143, 7, 'Ushongo'),
(144, 8, 'Abadan'),
(145, 8, 'Askira-Uba'),
(146, 8, 'Bama'),
(147, 8, 'Bayo'),
(148, 8, 'Biu'),
(149, 8, 'Chibok'),
(150, 8, 'Damboa'),
(151, 8, 'Dikwa'),
(152, 8, 'Gubio'),
(153, 8, 'Guzamala'),
(154, 8, 'Gwoza'),
(155, 8, 'Hawul'),
(156, 8, 'Jere'),
(157, 8, 'Kaga'),
(158, 8, 'Kala/Balge'),
(159, 8, 'Kukawa'),
(160, 8, 'Konduga'),
(161, 8, 'Kwaya-Kusar'),
(162, 8, 'Mafa'),
(163, 8, 'Magumeri'),
(164, 8, 'Maiduguri'),
(165, 8, 'Marte'),
(166, 8, 'Mobbar'),
(167, 8, 'Monguno'),
(168, 8, 'Ngala'),
(169, 8, 'Nganzai'),
(170, 8, 'Shani'),
(171, 9, 'Abi'),
(172, 9, 'Akamkpa'),
(173, 9, 'Akpabuyo'),
(174, 9, 'Bakassi'),
(175, 9, 'Bekwara'),
(176, 9, 'Biasi'),
(177, 9, 'Boki'),
(178, 9, 'Calabar-Municipal'),
(179, 9, 'Calabar-South'),
(180, 9, 'Etunk'),
(181, 9, 'Ikom'),
(182, 9, 'Obantiku'),
(183, 9, 'Ogoja'),
(184, 9, 'Ugep North'),
(185, 9, 'Yakurr'),
(186, 9, 'Yala'),
(187, 10, 'Aniocha North'),
(188, 10, 'Aniocha South'),
(189, 10, 'Bomadi'),
(190, 10, 'Burutu'),
(191, 10, 'Ethiope East'),
(192, 10, 'Ethiope West'),
(193, 10, 'Ika North East'),
(194, 10, 'Ika South'),
(195, 10, 'Isoko North'),
(196, 10, 'Isoko South'),
(197, 10, 'Ndokwa East'),
(198, 10, 'Ndokwa West'),
(199, 10, 'Okpe'),
(200, 10, 'Oshimili North'),
(201, 10, 'Oshimili South'),
(202, 10, 'Patani'),
(203, 10, 'Sapele'),
(204, 10, 'Udu'),
(205, 10, 'Ughilli North'),
(206, 10, 'Ughilli South'),
(207, 10, 'Ukwuani'),
(208, 10, 'Uvwie'),
(209, 10, 'Warri Central'),
(210, 10, 'Warri North'),
(211, 10, 'Warri South'),
(212, 11, 'Abakaliki'),
(213, 11, 'Ofikpo North'),
(214, 11, 'Ofikpo South'),
(215, 11, 'Ebonyi'),
(216, 11, 'Ezza North'),
(217, 11, 'Ezza South'),
(218, 11, 'ikwo'),
(219, 11, 'Ishielu'),
(220, 11, 'Ivo'),
(221, 11, 'Izzi'),
(222, 11, 'Ohaukwu'),
(223, 11, 'Ohaozara'),
(224, 11, 'Onicha'),
(225, 12, 'Akoko Edo'),
(226, 12, 'Egor'),
(227, 12, 'Esan Central'),
(228, 12, 'Esan North East'),
(229, 12, 'Esan South East'),
(230, 12, 'Esan West'),
(231, 12, 'Etsako-Central'),
(232, 12, 'Etsako-West'),
(233, 12, 'Igueben'),
(234, 12, 'Ikpoba-Okha'),
(235, 12, 'Oredo'),
(236, 12, 'Orhionmwon'),
(237, 12, 'Ovia North East'),
(238, 12, 'Ovia South West'),
(239, 12, 'owan east'),
(240, 12, 'Owan West'),
(241, 12, 'Umunniwonde'),
(242, 13, 'Ado Ekiti'),
(243, 13, 'Aiyedire'),
(244, 13, 'Efon'),
(245, 13, 'Ekiti-East'),
(246, 13, 'Ekiti-South West'),
(247, 13, 'Ekiti West'),
(248, 13, 'Emure'),
(249, 13, 'Ido Osi'),
(250, 13, 'Ijero'),
(251, 13, 'Ikere'),
(252, 13, 'Ikole'),
(253, 13, 'Ilejemeta'),
(254, 13, 'Irepodun/Ifelodun'),
(255, 13, 'Ise Orun'),
(256, 13, 'Moba'),
(257, 13, 'Oye'),
(258, 14, 'Aninri'),
(259, 14, 'Awgu'),
(260, 14, 'Enugu East'),
(261, 14, 'Enugu North'),
(262, 14, 'Enugu South'),
(263, 14, 'Ezeagu'),
(264, 14, 'Igbo Etiti'),
(265, 14, 'Igbo Eze North'),
(266, 14, 'Igbo Eze South'),
(267, 14, 'Isi Uzo'),
(268, 14, 'Nkanu East'),
(269, 14, 'Nkanu West'),
(270, 14, 'Nsukka'),
(271, 14, 'Oji-River'),
(272, 14, 'Udenu'),
(273, 14, 'Udi'),
(274, 14, 'Uzo Uwani'),
(275, 15, 'Akko'),
(276, 15, 'Balanga'),
(277, 15, 'Billiri'),
(278, 15, 'Dukku'),
(279, 15, 'Funakaye'),
(280, 15, 'Gombe'),
(281, 15, 'Kaltungo'),
(282, 15, 'Kwami'),
(283, 15, 'Nafada/Bajoga'),
(284, 15, 'Shomgom'),
(285, 15, 'Yamltu/Deba'),
(286, 16, 'Ahiazu-Mbaise'),
(287, 16, 'Ehime-Mbano'),
(288, 16, 'Ezinihtte'),
(289, 16, 'Ideato North'),
(290, 16, 'Ideato South'),
(291, 16, 'Ihitte/Uboma'),
(292, 16, 'Ikeduru'),
(293, 16, 'Isiala-Mbano'),
(294, 16, 'Isu'),
(295, 16, 'Mbaitoli'),
(296, 16, 'Ngor-Okpala'),
(297, 16, 'Njaba'),
(298, 16, 'Nkwerre'),
(299, 16, 'Nwangele'),
(300, 16, 'obowo'),
(301, 16, 'Oguta'),
(302, 16, 'Ohaji-Eggema'),
(303, 16, 'Okigwe'),
(304, 16, 'Onuimo'),
(305, 16, 'Orlu'),
(306, 16, 'Orsu'),
(307, 16, 'Oru East'),
(308, 16, 'Oru West'),
(309, 16, 'Owerri Municipal'),
(310, 16, 'Owerri North'),
(311, 16, 'Owerri West'),
(312, 17, 'Auyu'),
(313, 17, 'Babura'),
(314, 17, 'Birnin Kudu'),
(315, 17, 'Birniwa'),
(316, 17, 'Bosuwa'),
(317, 17, 'Buji'),
(318, 17, 'Dutse'),
(319, 17, 'Gagarawa'),
(320, 17, 'Garki'),
(321, 17, 'Gumel'),
(322, 17, 'Guri'),
(323, 17, 'Gwaram'),
(324, 17, 'Gwiwa'),
(325, 17, 'Hadejia'),
(326, 17, 'Jahun'),
(327, 17, 'Kafin Hausa'),
(328, 17, 'Kaugama'),
(329, 17, 'Kazaure'),
(330, 17, 'Kirikasanuma'),
(331, 17, 'Kiyawa'),
(332, 17, 'Maigatari'),
(333, 17, 'Malam Maduri'),
(334, 17, 'Miga'),
(335, 17, 'Ringim'),
(336, 17, 'Roni'),
(337, 17, 'Sule Tankarkar'),
(338, 17, 'Taura'),
(339, 17, 'Yankwashi'),
(340, 18, 'Birnin-Gwari'),
(341, 18, 'Chikun'),
(342, 18, 'Giwa'),
(343, 18, 'Gwagwada'),
(344, 18, 'Igabi'),
(345, 18, 'Ikara'),
(346, 18, 'Jaba'),
(347, 18, 'Jema\'a'),
(348, 18, 'Kachia'),
(349, 18, 'Kaduna North'),
(350, 18, 'Kagarko'),
(351, 18, 'Kajuru'),
(352, 18, 'Kaura'),
(353, 18, 'Kauru'),
(354, 18, 'Koka/Kawo'),
(355, 18, 'Kubah'),
(356, 18, 'Kudan'),
(357, 18, 'Lere'),
(358, 18, 'Makarfi'),
(359, 18, 'Sabon Gari'),
(360, 18, 'Sanga'),
(361, 18, 'Sabo'),
(362, 18, 'Tudun-Wada/Makera'),
(363, 18, 'Zango-Kataf'),
(364, 18, 'Zaria'),
(365, 19, 'Ajingi'),
(366, 19, ' Albasu'),
(367, 19, 'Bagwai'),
(368, 19, 'Bebeji'),
(369, 19, 'Bichi'),
(370, 19, 'Bunkure'),
(371, 19, 'Dala'),
(372, 19, 'Dambatta'),
(373, 19, 'Dawakin Kudu'),
(374, 19, 'Dawakin Tofa'),
(375, 19, 'Doguwa'),
(376, 19, 'Fagge'),
(377, 19, 'Gabasawa'),
(378, 19, 'Garko'),
(379, 19, 'Garun-Mallam'),
(380, 19, 'Gaya'),
(381, 19, 'Gezawa'),
(382, 19, 'Gwale'),
(383, 19, 'Gwarzo'),
(384, 19, 'Kabo'),
(385, 19, 'Kano Municipal'),
(386, 19, 'Karaye'),
(387, 19, 'Kibiya'),
(388, 19, 'Kiru'),
(389, 19, 'Kumbotso'),
(390, 19, 'Kunchi'),
(391, 19, 'Kura'),
(392, 19, 'Madobi'),
(393, 19, 'Makoda'),
(394, 19, 'Minjibir'),
(395, 19, 'Nasarawa'),
(396, 19, 'Rano'),
(397, 19, 'Rimin Gado'),
(398, 19, 'Rogo'),
(399, 19, 'Shanono'),
(400, 19, 'Sumaila'),
(401, 19, 'Takai'),
(402, 19, 'Tarauni'),
(403, 19, 'Tofa'),
(404, 19, 'Tsanyawa'),
(405, 19, 'Tudun Wada'),
(406, 19, 'Ngogo'),
(407, 19, 'Warawa'),
(408, 19, 'Wudil'),
(409, 20, 'Bakori'),
(410, 20, 'Batagarawa'),
(411, 20, 'Batsari'),
(412, 20, 'Baure'),
(413, 20, 'Bindawa'),
(414, 20, 'Charanchi'),
(415, 20, 'Danja'),
(416, 20, 'Danjume'),
(417, 20, 'Dan-Musa'),
(418, 20, 'Daura'),
(419, 20, 'Dutsi'),
(420, 20, 'Dutsinma'),
(421, 20, 'Faskari'),
(422, 20, 'Funtua'),
(423, 20, 'Ingara'),
(424, 20, 'Jibia'),
(425, 20, 'Kafur'),
(426, 20, 'Kaita'),
(427, 20, 'Kankara'),
(428, 20, 'Kankia'),
(429, 20, 'Katsina'),
(430, 20, 'Kurfi'),
(431, 20, 'Kusada'),
(432, 20, 'Mai Adua'),
(433, 20, 'Malumfashi'),
(434, 20, 'Mani'),
(435, 20, 'Mashi'),
(436, 20, 'Matazu'),
(437, 20, 'Musawa'),
(438, 20, 'Rimi'),
(439, 20, 'Sabuwa'),
(440, 20, 'Safana'),
(441, 20, 'Sandamu'),
(442, 20, 'Zango'),
(443, 21, 'Aleira'),
(444, 21, 'Arewa'),
(445, 21, 'Argungu'),
(446, 21, 'Augie'),
(447, 21, 'Bagudo'),
(448, 21, 'Birnin-Kebbi'),
(449, 21, 'Bumza'),
(450, 21, 'Dandi'),
(451, 21, 'Danko'),
(452, 21, 'Fakai'),
(453, 21, 'Gwandu'),
(454, 21, 'Jega'),
(455, 21, 'Kalgo'),
(456, 21, 'Koko-Besse'),
(457, 21, 'Maiyama'),
(458, 21, 'Ngaski'),
(459, 21, 'Sakaba'),
(460, 21, 'Shanga'),
(461, 21, 'Suru'),
(462, 21, 'Wasagu'),
(463, 21, 'Yauri'),
(464, 21, 'Zuru'),
(465, 22, 'Adavi'),
(466, 22, 'Ajaokuta'),
(467, 22, 'Ankpa'),
(468, 22, 'Bassa'),
(469, 22, 'Dekina'),
(470, 22, 'Ibaji'),
(471, 22, 'Idah'),
(472, 22, 'Igalamela'),
(473, 22, 'Ijumu'),
(474, 22, 'Kabba/Bunu'),
(475, 22, 'Kogi'),
(476, 22, 'Lokoja'),
(477, 22, 'Mopa-Muro-Mopi'),
(478, 22, 'Ofu'),
(479, 22, 'Ogori/Magongo'),
(480, 22, 'Okehi'),
(481, 22, 'Okene'),
(482, 22, 'Olamaboro'),
(483, 22, 'Omala'),
(484, 22, 'Oyi'),
(485, 22, 'Yagba-East'),
(486, 22, 'Yagba-West'),
(487, 23, 'Asa'),
(488, 23, 'Baruten'),
(489, 23, 'Edu'),
(490, 23, 'Ekiti'),
(491, 23, 'Ifelodun'),
(492, 23, 'Ilorin East'),
(493, 23, 'Ilorin South'),
(494, 23, 'Ilorin West'),
(495, 23, 'Irepodun'),
(496, 23, 'Isin'),
(497, 23, 'Kaiama'),
(498, 23, 'Moro'),
(499, 23, 'Offa'),
(500, 23, 'Oke-Ero'),
(501, 23, 'Oyun'),
(502, 23, 'Pategi'),
(503, 24, 'Agege'),
(504, 24, 'Ajeromi-Ifelodun'),
(505, 24, 'Alimosho'),
(506, 24, 'Amuwo-Odofin'),
(507, 24, 'Apapa'),
(508, 24, 'Badagry'),
(509, 24, 'Epe'),
(510, 24, 'Eti-Osa'),
(511, 24, 'Ibeju-Lekki'),
(512, 24, 'Ifako-Ijaiye'),
(513, 24, 'Ikeja'),
(514, 24, 'Ikorodu'),
(515, 24, 'Kosofe'),
(516, 24, 'Lagos-Island'),
(517, 24, 'Lagos-Mainland'),
(518, 24, 'Mushin'),
(519, 24, 'Ojo'),
(520, 24, 'Oshodi-Isolo'),
(521, 24, 'Shomolu'),
(522, 24, 'Suru-Lere'),
(523, 25, 'Akwanga'),
(524, 25, 'Awe'),
(525, 25, 'Doma'),
(526, 25, 'Karu'),
(527, 25, 'Keana'),
(528, 25, 'Keffi'),
(529, 25, 'Kokona'),
(530, 25, 'Lafia'),
(531, 25, 'Nassarawa'),
(532, 25, 'Nassarawa Eggor'),
(533, 25, 'Obi'),
(534, 25, 'Toto'),
(535, 25, 'Wamba'),
(536, 26, 'Agaie'),
(537, 26, 'Agwara'),
(538, 26, 'Bida'),
(539, 26, 'Borgu'),
(540, 26, 'Bosso'),
(541, 26, 'Chanchaga'),
(542, 26, 'Edati'),
(543, 26, 'Gbako'),
(544, 26, 'Gurara'),
(545, 26, 'Katcha'),
(546, 26, 'Kontagora'),
(547, 26, 'Lapai'),
(548, 26, 'Lavum'),
(549, 26, 'Magama'),
(550, 26, 'Mariga'),
(551, 26, 'Mashegu'),
(552, 26, 'Mokwa'),
(553, 26, 'Muya'),
(554, 26, 'Paikoro'),
(555, 26, 'Rafi'),
(556, 26, 'Rajau'),
(557, 26, 'Shiroro'),
(558, 26, 'Suleja'),
(559, 26, 'Tafa'),
(560, 26, 'Wushishi'),
(561, 27, 'Abeokuta -North'),
(562, 27, 'Abeokuta -South'),
(563, 27, 'Ado-Odu/Ota'),
(564, 27, 'Yewa-North'),
(565, 27, 'Yewa-South'),
(566, 27, 'Ewekoro'),
(567, 27, 'Ifo'),
(568, 27, 'Ijebu East'),
(569, 27, 'Ijebu North'),
(570, 27, 'Ijebu North-East'),
(571, 27, 'Ijebu-Ode'),
(572, 27, 'Ikenne'),
(573, 27, 'Imeko-Afon'),
(574, 27, 'Ipokia'),
(575, 27, 'Obafemi -Owode'),
(576, 27, 'Odeda'),
(577, 27, 'Odogbolu'),
(578, 27, 'Ogun-Water Side'),
(579, 27, 'Remo-North'),
(580, 27, 'Shagamu'),
(581, 28, 'Akoko-North-East'),
(582, 28, 'Akoko-North-West'),
(583, 28, 'Akoko-South-West'),
(584, 28, 'Akoko-South-East'),
(585, 28, 'Akure- South'),
(586, 28, 'Akure-North'),
(587, 28, 'Ese-Odo'),
(588, 28, 'Idanre'),
(589, 28, 'Ifedore'),
(590, 28, 'Ilaje'),
(591, 28, 'Ile-Oluji-Okeigbo'),
(592, 28, 'Irele'),
(593, 28, 'Odigbo'),
(594, 28, 'Okitipupa'),
(595, 28, 'Ondo-West'),
(596, 28, 'Ondo East'),
(597, 28, 'Ose'),
(598, 28, 'Owo'),
(599, 29, 'Atakumosa'),
(600, 29, 'Atakumosa East'),
(601, 29, 'Ayeda-Ade'),
(602, 29, 'Ayedire'),
(603, 29, 'Boluwaduro'),
(604, 29, 'Boripe'),
(605, 29, 'Ede'),
(606, 29, 'Ede North'),
(607, 29, 'Egbedore'),
(608, 29, 'Ejigbo'),
(609, 29, 'Ife'),
(610, 29, 'Ife East'),
(611, 29, 'Ife North'),
(612, 29, 'Ife South'),
(613, 29, 'Ifedayo'),
(614, 29, 'Ifelodun'),
(615, 29, 'Ila'),
(616, 29, 'Ilesha'),
(617, 29, 'Ilesha-West'),
(618, 29, 'Irepodun'),
(619, 29, 'Irewole'),
(620, 29, 'Isokun'),
(621, 29, 'Iwo'),
(622, 29, 'Obokun'),
(623, 29, 'Odo-Otin'),
(624, 29, 'Ola Oluwa'),
(625, 29, 'Olorunda'),
(626, 29, 'Ori-Ade'),
(627, 29, 'Orolu'),
(628, 29, 'Osogbo'),
(629, 30, 'Afijio'),
(630, 30, 'Akinyele'),
(631, 30, 'Atiba'),
(632, 30, 'Atisbo'),
(633, 30, 'Egbeda'),
(634, 30, 'Ibadan-Central'),
(635, 30, 'Ibadan-North-East'),
(636, 30, 'Ibadan-North-West'),
(637, 30, 'Ibadan-South-East'),
(638, 30, 'Ibadan-South-West'),
(639, 30, 'Ibarapa-Central'),
(640, 30, 'Ibarapa-East'),
(641, 30, 'Ibarapa-North'),
(642, 30, 'Ido'),
(643, 30, 'Ifedayo'),
(644, 30, 'Ifeloju'),
(645, 30, 'Irepo'),
(646, 30, 'Iseyin'),
(647, 30, 'Itesiwaju'),
(648, 30, 'Iwajowa'),
(649, 30, 'Kajola'),
(650, 30, 'Lagelu'),
(651, 30, 'Odo-Oluwa'),
(652, 30, 'Ogbomoso-North'),
(653, 30, 'Ogbomosho-South'),
(654, 30, 'Olorunsogo'),
(655, 30, 'Oluyole'),
(656, 30, 'Ona-Ara'),
(657, 30, 'Orelope'),
(658, 30, 'Ori-Ire'),
(659, 30, 'Oyo East'),
(660, 30, 'Oyo West'),
(661, 30, 'saki east'),
(662, 30, 'Saki West'),
(663, 30, 'Surulere'),
(664, 31, 'Barkin Ladi'),
(665, 31, 'Bassa'),
(666, 31, 'Bokkos'),
(667, 31, 'Jos-East'),
(668, 31, 'Jos-South'),
(669, 31, 'Jos-North'),
(670, 31, 'Kanam'),
(671, 31, 'Kanke'),
(672, 31, 'Langtang North'),
(673, 31, 'Langtang South'),
(674, 31, 'Mangu'),
(675, 31, 'Mikang'),
(676, 31, 'Pankshin'),
(677, 31, 'Quan\'pan'),
(678, 31, 'Riyom'),
(679, 31, 'Shendam'),
(680, 31, 'Wase'),
(681, 32, 'Abua/Odual'),
(682, 32, 'Ahoada East'),
(683, 32, 'Ahoada West'),
(684, 32, 'Akukutoru'),
(685, 32, 'Andoni'),
(686, 32, 'Asari-Toro'),
(687, 32, 'Bonny'),
(688, 32, 'Degema'),
(689, 32, 'Eleme'),
(690, 32, 'Emuoha'),
(691, 32, 'Etche'),
(692, 32, 'Gokana'),
(693, 32, 'Ikwerre'),
(694, 32, 'Khana'),
(695, 32, 'Obio/Akpor'),
(696, 32, 'Ogba/Egbama/Ndoni'),
(697, 32, 'Ogu/Bolo'),
(698, 32, 'Okrika'),
(699, 32, 'Omuma'),
(700, 32, 'Opobo/Nkoro'),
(701, 32, 'Oyigbo'),
(702, 32, 'Port-Harcourt'),
(703, 32, 'Tai'),
(704, 33, 'Binji'),
(705, 33, 'Bodinga'),
(706, 33, 'Dange-Shuni'),
(707, 33, 'Gada'),
(708, 33, 'Goronyo'),
(709, 33, 'Gudu'),
(710, 33, 'Gwadabawa'),
(711, 33, 'Illela'),
(712, 33, 'Isa'),
(713, 33, 'Kebbe'),
(714, 33, 'Kware'),
(715, 33, 'Raba'),
(716, 33, 'Sabon-Birni'),
(717, 33, 'Shagari'),
(718, 33, 'Silame'),
(719, 33, 'Sokoto North'),
(720, 33, 'Sokoto South'),
(721, 33, 'Tambuwal'),
(722, 33, 'Tanzaga'),
(723, 33, 'Tureta'),
(724, 33, 'Wamakko'),
(725, 33, 'Wurno'),
(726, 33, 'Yabo'),
(727, 34, 'Ardo Kola'),
(728, 34, 'Bali'),
(729, 34, 'Donga'),
(730, 34, 'Gashaka'),
(731, 34, 'Gassol'),
(732, 34, 'Ibi'),
(733, 34, 'Jalingo'),
(734, 34, 'Karim-Lamido'),
(735, 34, 'Kurmi'),
(736, 34, 'Lau'),
(737, 34, 'Sardauna'),
(738, 34, 'Takuni'),
(739, 34, 'Ussa'),
(740, 34, 'Wukari'),
(741, 34, 'Yarro'),
(742, 34, 'Zing'),
(743, 35, 'Bade'),
(744, 35, 'Bursali'),
(745, 35, 'Damaturu'),
(746, 35, 'Fuka'),
(747, 35, 'Fune'),
(748, 35, 'Geidam'),
(749, 35, 'Gogaram'),
(750, 35, 'Gujba'),
(751, 35, 'Gulani'),
(752, 35, 'Jakusko'),
(753, 35, 'Karasuwa'),
(754, 35, 'Machina'),
(755, 35, 'Nangere'),
(756, 35, 'Nguru'),
(757, 35, 'Potiskum'),
(758, 35, 'Tarmua'),
(759, 35, 'Yunisari'),
(760, 35, 'Yusufari'),
(761, 36, 'Anka'),
(762, 36, 'Bakure'),
(763, 36, 'Bukkuyum'),
(764, 36, 'Bungudo'),
(765, 36, 'Gumi'),
(766, 36, 'Gusau'),
(767, 36, 'Isa'),
(768, 36, 'Kaura-Namoda'),
(769, 36, 'Kiyawa'),
(770, 36, 'Maradun'),
(771, 36, 'Marau'),
(772, 36, 'Shinkafa'),
(773, 36, 'Talata-Mafara'),
(774, 36, 'Tsafe'),
(775, 36, 'Zurmi'),
(776, 9, 'Obudu'),
(777, 37, 'Abaji'),
(778, 37, 'Bwari'),
(779, 37, 'Gwagwalada'),
(780, 37, 'Kuje'),
(781, 37, 'Kwali'),
(782, 37, 'Municipal'),
(783, 12, 'Etsako-East'),
(784, 16, 'Ahiazu-Mbaise'),
(785, 38, 'Foreign'),
(786, 18, 'Kaduna South'),
(787, 16, 'Aboh-Mbaise'),
(788, 9, 'Odukpani');

-- --------------------------------------------------------

--
-- Table structure for table `maritalstatus`
--

CREATE TABLE `maritalstatus` (
  `id` int(11) NOT NULL,
  `mstatus_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mstatus` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `maritalstatus`
--

INSERT INTO `maritalstatus` (`id`, `mstatus_id`, `mstatus`) VALUES
(1, '1', 'Single'),
(2, '2', 'Married'),
(3, '3', 'Widowed'),
(4, '4', 'Divorced'),
(5, '5', 'Seperated');

-- --------------------------------------------------------

--
-- Table structure for table `panelist_group_tbl`
--

CREATE TABLE `panelist_group_tbl` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(11) NOT NULL,
  `staff_title` varchar(10) NOT NULL,
  `staff_fname` varchar(40) NOT NULL,
  `staff_othername` varchar(60) NOT NULL,
  `date_created` date NOT NULL,
  `panelist_group` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdata`
--

CREATE TABLE `pdata` (
  `id` int(11) NOT NULL,
  `idno` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `maidenname` varchar(50) DEFAULT NULL,
  `mstatus` varchar(30) NOT NULL,
  `religion` varchar(60) DEFAULT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `phoneno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nationality` varchar(70) DEFAULT NULL,
  `stateoforigin` varchar(50) DEFAULT NULL,
  `lga` varchar(50) DEFAULT NULL,
  `hometown` varchar(100) DEFAULT NULL,
  `dresume` date NOT NULL,
  `unit` varchar(100) NOT NULL,
  `post` varchar(70) DEFAULT NULL,
  `dept` varchar(40) NOT NULL,
  `specialization` varchar(150) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `subcategory` varchar(50) DEFAULT NULL,
  `employmenttype` varchar(30) NOT NULL,
  `employmentstatus` varchar(50) DEFAULT NULL,
  `sallev` varchar(50) DEFAULT NULL,
  `dutypost` int(11) DEFAULT NULL,
  `dutypay` varchar(50) DEFAULT NULL,
  `special` double DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `baccount` double DEFAULT NULL,
  `nhf` varchar(50) DEFAULT NULL,
  `nhfno` varchar(50) DEFAULT NULL,
  `pfa` varchar(50) DEFAULT NULL,
  `pfano` varchar(50) DEFAULT NULL,
  `modifiedat` datetime NOT NULL,
  `appno` int(11) DEFAULT NULL,
  `grosspay` int(40) NOT NULL,
  `peradres1` varchar(255) NOT NULL,
  `peradres2` varchar(255) NOT NULL,
  `peradres3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdata`
--

INSERT INTO `pdata` (`id`, `idno`, `title`, `sname`, `fname`, `mname`, `gender`, `dob`, `maidenname`, `mstatus`, `religion`, `address1`, `address2`, `state`, `phoneno`, `email`, `nationality`, `stateoforigin`, `lga`, `hometown`, `dresume`, `unit`, `post`, `dept`, `specialization`, `category`, `subcategory`, `employmenttype`, `employmentstatus`, `sallev`, `dutypost`, `dutypay`, `special`, `bank`, `baccount`, `nhf`, `nhfno`, `pfa`, `pfano`, `modifiedat`, `appno`, `grosspay`, `peradres1`, `peradres2`, `peradres3`) VALUES
(35, 'protergia1', 'MRS', 'ABOYADE', 'MARYLE', 'OLADUNNILE', 'Male', '2020-04-15', 'MAS', 'Single', 'Muslim', '103,  Borno way (By Kano st.) Oyingbo,', 'canaancity', '24', '08035354986', 'maryaboyade@gmail.com', 'Nigeria', 'Edo', 'Oredo', 'Ebutte Metta.', '2020-04-09', '', '', '', '', '', '', 'Part time', 'Not Active', 'CUTSS07/01', NULL, '15000', 30, 'SGB', 22222222278, 'CUTSS07/0188', 'CUTSS07/0188', 'CUTSS07/0177', 'CUTSS07/0177', '0000-00-00 00:00:00', 15, 67, '', '', ''),
(36, 'protergia2', 'MR', 'OLATOKUN', 'ADESHINA', 'MICHAEL', 'Male', '2020-06-15', 'Mary', 'Single', 'Christian', '103,  Borno way (By Kano st.) Oyingbo,', 'canaancity', 'Lagos', '08035354986', 'michaeladeshina015@gmail.com', 'Nigeria', 'Ogun', 'Yewa-North', 'Ebutte Metta.', '2020-06-09', '', 'Programmer', '', '', '', '', 'Regular', 'Active', 'CUTSS07/01', NULL, '15000', 693.41, 'CMFB', 200101001464, '1234', '1234', 'TRUSTFUND', 'PEN200035053462', '0000-00-00 00:00:00', 0, 5000, '103,  Borno way (By Kano st.) Oyingbo,', 'Lagos', 'Ebutte Metta.'),
(206, 'PN/2014/001', 'Mr', 'O\'DEJI', 'AYODEJI', '', 'Male', '', '', 'Married', 'Christian', '', '', 'FCT', '', 'deji@protergiaenergy.com', 'Nigeria', 'Oyo', 'Select Lga', '', '2014-03-12', '', 'CEO', '', '', '', '', 'Regular', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(207, 'PN/2014/002', 'Dr', 'Aboyade', 'Akinwale', '', 'Male', '1977-04-05', '', 'Married', 'Christian', '', '', '', '', 'wale@protergiaenergy.com', 'Nigeria', 'Oyo', 'Afijio', '', '2014-03-12', 'Director', 'Director', '', '', 'Technical', 'Technical', 'Consultant', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(208, 'PN/2014/003', 'Mr', 'Anyasodo', 'Timothy', '', 'Male', '1991-01-24', '', 'Single', 'Christian', 'Anthony Ozodinobi Street, John Chukwu Crescent, Wuye', '', '', '07038709862', 'timothy@protergiaenergy.com', 'Nigeria', 'Imo', 'Owerri North', 'Umuallum-Uratta', '2014-03-12', '', 'Accountant', '', '', 'Non Technical', 'Non Technical', 'Regular', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '508', 'Anthony Ozodinobi Street, John Chukwu Crescent, Wuye', ''),
(209, 'PN/2014/004', NULL, 'Ipadeola', 'Adeola ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '2020-06-23', '', '', '', NULL, '', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-18 00:07:09', NULL, 0, '', '', ''),
(210, 'PN/2015/001', NULL, 'Etim', 'Asa ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(211, 'PN/2015/002', NULL, 'Igho', 'Ovie ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(212, 'PN/2015/003', NULL, 'Chata', 'Sunny ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(213, 'PN/2016/001', NULL, 'Yakubu', 'Daniel ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(214, 'PN/2016/002', NULL, '', 'Anita', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(215, 'PN/2017/001', NULL, 'Baka', 'David ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(216, 'PN/2017/002', NULL, 'Onuegbu', 'Obinna ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(217, 'PN/2017/003', 'Mr', 'Onogu', 'Williams', '', 'Male', '', '', 'Single', 'Christian', '', '', '', '', 'williams@protergiaenergy.com', '', '', '', '', '0000-00-00', '', 'Technician', 'Operations', '', 'Technical', 'Technical', 'Regular', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(218, 'PN/2017/004', NULL, 'Olanipekun', 'Bayo ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(219, 'PN/2017/005', NULL, 'Nsoffor', 'Anaeze ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(221, 'PN/2017/007', NULL, 'Savia', 'Vivian ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(222, 'PN/2018/001', NULL, 'Ugboji', 'Peter ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(223, 'PN/2018/002', NULL, 'Eko', 'Juliana ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(224, 'PN/2018/003', NULL, '', 'Abraham', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(225, 'PN/2018/004', NULL, 'Uhuegbu', 'Kosi ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(226, 'PN/2018/005', NULL, 'Ukawuba', 'Onyedikachi ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(227, 'PN/2019/001', NULL, 'Sunday', 'Isaac ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(228, 'PN/2019/002', NULL, 'Obi', 'Sandra ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(229, 'PN/2019/003', NULL, 'Tomizu', 'Uche ', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, '0000-00-00', '', NULL, '', NULL, NULL, NULL, '', 'Not Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(230, 'PN/2019/004', 'Mr', 'Ilogho', 'Fredrick', '', 'Male', '', '', 'Single', 'Christian', '', '', '', '', 'sales@protergiaenergy.com', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '', '', ''),
(231, 'PN/2020/001', 'Mrs', 'Aboyade', 'Opeyemi', '', 'Female', '1981-11-01', '', '', 'Christian', 'E1 Duplex1', 'Canaan City, Canaan land , kilometre 10', 'Ogun', '09024424040', 'opeyemi@protergiaenergy.com', 'Nigeria', 'Oyo', 'Afijio', '', '2020-04-04', '', 'Manager', 'Admin', '', 'Non Technical', 'Non Technical', 'Regular', 'Active', '', NULL, NULL, 0, 'GTB', 111520527, '', '', '', '', '0000-00-00 00:00:00', NULL, 0, '', 'Ogun State, Nigeria', 'Ota'),
(234, 'protergiaprog1', '', 'Ojesanmi', 'Adesiju', '', 'male', '', '', '', 'Christian', 'E1 Duplex1', 'Ota', 'Ogun', '09024424040', 'festorium10@gmail.com', 'Nigeria', 'Oyo', 'Afijio', '', '2020-07-08', '', 'Technician', '', '', 'Technical', 'Electrical', 'Regular', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '2020-07-31 10:26:32', NULL, 0, '', '', ''),
(235, 'protergiaprog2', '', 'Akugbe', 'Stephen', '', 'male', '', '', '', 'Christian', 'E1 Duplex1', 'Ota', 'Ogun', '09024424040', 'akugbestephen3@gmail.com', 'Nigeria', 'Edo', 'Ishan', '', '2020-07-03', '', 'Technician', '', '', 'Technical', 'Electrical', 'Regular', 'Active', '', NULL, NULL, 0, '', 0, '', '', '', '', '2020-07-31 17:01:11', NULL, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `typ` int(50) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(50) NOT NULL,
  `actiondate` datetime NOT NULL,
  `staffid` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `typ`, `type`, `status`, `actiondate`, `staffid`) VALUES
(1, 1, 'Engineer 1', 1, '2020-08-10 01:51:00', ''),
(2, 2, 'Administrative Assistant', 1, '2020-08-10 01:52:00', ''),
(3, 3, 'Programmer', 1, '2020-08-20 00:00:00', ''),
(4, 4, 'Engineer 2', 1, '2020-08-20 00:00:00', ''),
(5, 5, 'Senior Engineer', 1, '2020-09-23 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications_tbl`
--

CREATE TABLE `qualifications_tbl` (
  `id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `qualification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualifications_tbl`
--

INSERT INTO `qualifications_tbl` (`id`, `vacancy_id`, `qualification`) VALUES
(1, '3', 'qual1'),
(2, '3', 'qual2'),
(3, '3', 'qual3'),
(7, '4', 'qual1'),
(8, '4', 'qual2'),
(9, '4', 'qual3'),
(10, '4', 'qual1'),
(11, '4', 'qual2'),
(12, '4', 'qual3'),
(13, '4', 'job_qualification1'),
(14, '4', 'job_qualification changed'),
(17, '5', 'kjsdh'),
(18, '5', 'adsda'),
(19, '5', 'lksdjkf'),
(20, '5', 'new qualification'),
(21, '4', 'Minimum OND certificate'),
(22, '1', 'Added qualification'),
(23, '1', 'Another qualification'),
(24, '1', 'Simple qualification'),
(25, '1', 'sdc'),
(26, '6', 'OND, HND, or B.Sc.'),
(27, '7', 'qualification1'),
(28, '7', 'qualification2'),
(29, '7', 'qualification3'),
(30, '8', 'Minimum second class honours upper division in Computer science'),
(31, '9', 'Minimum quallification'),
(32, '9', 'another qualification'),
(33, '9', 'Minimum quallification'),
(34, '9', 'another qualification'),
(35, '2', 'Here is one qualification'),
(36, '2', 'Here is another qualification'),
(40, 'V-20-09-001', 'Must have at least 3 years experience working as an engineer and at least 2 years as a project manager.'),
(41, 'V-20-09-001', 'Must possess an M.Eng or any related certificate from a recognized institution'),
(49, 'V-20-09-002', 'Must have completed a degree in Computer Science or any related field'),
(50, 'V-20-09-002', 'Must be experienced in web development using HTML, CSS, Angular JS and PHP'),
(63, 'V-20-09-003', 'qualification '),
(64, 'V-20-09-003', 'qualification 2'),
(65, 'V-20-09-003', 'qualification 3');

-- --------------------------------------------------------

--
-- Table structure for table `referees_tbl`
--

CREATE TABLE `referees_tbl` (
  `ref_id` int(10) NOT NULL,
  `applicant_id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `title` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `other_names` varchar(60) NOT NULL,
  `organization` varchar(150) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referees_tbl`
--

INSERT INTO `referees_tbl` (`ref_id`, `applicant_id`, `vacancy_id`, `title`, `surname`, `other_names`, `organization`, `designation`, `phone_number`, `email`) VALUES
(3, 1, '5', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'akugbephilip@gmail.com'),
(4, 1, '5', 'Engr', 'Akugbe', 'Phillips', 'Confidence Business', 'Owner', '08034060644', 'akugbephilip@yahoo.com'),
(60, 3, '6', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'Oluwajuwonsamuel9@gmail.com'),
(61, 3, '6', 'Mrs', 'Aboyade', 'M', 'Molad eKonsult', 'CEO', '09098976543', 'moladekonsult@gmail.com'),
(135, 3, '9', 'Mr', 'Akugbe', 'Stephen', 'Confidence Technologies', 'CEO', '07041165200', 'sakugbe@gmail.com'),
(136, 5, '3', 'Mrs', 'Akugbe', 'M', 'God\'s Blessings stores', 'Owner', '08028105759', 'akugbem@gmail.com'),
(138, 2, '6', 'Mr', 'Akugbe', 'Stephen', 'Business Consulting Limited', 'Business Consultant', '08038909320', 'akugbestephen3@gmail.com'),
(140, 4, '8', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'confidence_centre@yahoo.com'),
(146, 7, 'V20-09-002', 'Title', '', '', '', '', '', ''),
(148, 6, 'V-20-09-001', 'Title', '', '', '', '', '', ''),
(150, 8, '1', 'Title', '', '', '', '', '', ''),
(151, 10, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(152, 10, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(153, 9, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(154, 9, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(155, 9, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(156, 9, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(157, 11, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(158, 11, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(159, 12, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(160, 12, 'V-20-09-001', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'sakugbe@gmail.com'),
(161, 13, 'V-20-09-002', 'Mr', 'Akugbe', 'Phillip', 'Confidence Technologies', 'CEO', '08034060620', 'confidence_centre@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` smallint(6) NOT NULL,
  `state_name` varchar(20) NOT NULL DEFAULT '',
  `state_code` varchar(2) NOT NULL,
  `countrycode` varchar(5) NOT NULL DEFAULT '159',
  `countryid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `state_code`, `countrycode`, `countryid`) VALUES
(1, 'Abia', 'AB', 'NG', 0),
(2, 'Adamawa', 'AD', 'NG', 0),
(3, 'Akwa Ibom', 'AK', 'NG', 0),
(4, 'Anambra', 'AN', 'NG', 0),
(5, 'Bauchi', 'BA', 'NG', 0),
(6, 'Bayelsa', 'BY', 'NG', 0),
(7, 'Benue', 'BN', 'NG', 0),
(8, 'Borno', 'BO', 'NG', 0),
(9, 'Cross River', 'CR', 'NG', 0),
(10, 'Delta', 'DT', 'NG', 0),
(11, 'Ebonyi', 'EB', 'NG', 0),
(12, 'Edo', 'ED', 'NG', 0),
(13, 'Ekiti', 'EK', 'NG', 0),
(14, 'Enugu', 'EN', 'NG', 0),
(15, 'Gombe', 'GM', 'NG', 0),
(16, 'Imo', 'IM', 'NG', 0),
(17, 'Jigawa', 'JG', 'NG', 0),
(18, 'Kaduna', 'KD', 'NG', 0),
(19, 'Kano', 'KN', 'NG', 0),
(20, 'Katsina', 'KT', 'NG', 0),
(21, 'Kebbi', 'KB', 'NG', 0),
(22, 'Kogi', 'KG', 'NG', 0),
(23, 'Kwara', 'KW', 'NG', 0),
(24, 'Lagos', 'LA', 'NG', 0),
(25, 'Nasarawa', 'NS', 'NG', 0),
(26, 'Niger', 'NG', 'NG', 0),
(27, 'Ogun', 'OG', 'NG', 0),
(28, 'Ondo', 'OD', 'NG', 0),
(29, 'Osun', 'OS', 'NG', 0),
(30, 'Oyo', 'OY', 'NG', 0),
(31, 'Plateau', 'PT', 'NG', 0),
(32, 'Rivers', 'RV', 'NG', 0),
(33, 'Sokoto', 'SK', 'NG', 0),
(34, 'Taraba', 'TR', 'NG', 0),
(35, 'Yobe', 'YB', 'NG', 0),
(36, 'Zamfara', 'ZF', 'NG', 0),
(37, 'FCT', 'FC', 'NG', 0),
(38, 'Foreign', '', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions_tbl`
--

CREATE TABLE `subscriptions_tbl` (
  `id` int(20) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  `location_id` varchar(10) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions_tbl`
--

INSERT INTO `subscriptions_tbl` (`id`, `dept_id`, `location_id`, `email`) VALUES
(1, '0', '0', ''),
(2, '0', '0', 'akugbestephen3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `titleid` int(11) NOT NULL,
  `fulltitle` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `titlestatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`titleid`, `fulltitle`, `title`, `titlestatus`) VALUES
(1, 'MR', 'Mr', 1),
(2, 'MRS', 'Mrs', 1),
(3, 'MISS', 'Miss', 1),
(4, 'DOCTOR', 'Dr', 1),
(9, 'ENGINEER', 'Engr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy_desc_tbl`
--

CREATE TABLE `vacancy_desc_tbl` (
  `desc_id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `job_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy_desc_tbl`
--

INSERT INTO `vacancy_desc_tbl` (`desc_id`, `vacancy_id`, `job_description`) VALUES
(1, '1', 'desc1'),
(2, '1', 'desc2'),
(3, '1', 'desc3'),
(7, '2', 'desc1'),
(8, '2', 'desc2'),
(9, '2', 'desc3'),
(10, '2', 'desc3'),
(13, '3', 'desc1'),
(14, '3', 'desc2'),
(15, '3', 'desc3'),
(16, '4', 'desc1'),
(17, '4', 'desc2'),
(18, '4', 'desc3'),
(19, '4', 'desc1'),
(20, '4', 'desc2'),
(21, '4', 'desc3'),
(23, '4', 'desc2'),
(24, '4', 'desc3'),
(25, '4', 'job_description1'),
(26, '4', 'job_description2'),
(27, '4', 'job_description3'),
(28, '4', 'job_description changed'),
(29, '5', 'adada'),
(30, '5', 'adfaf'),
(31, '5', 'adfadf'),
(32, '5', 'new job desc'),
(33, '4', 'Keep the labs clean'),
(34, '1', 'New description'),
(35, '6', 'Manage the project execution(s) through project completion ensuring compliance with the proposed solution and project business case.'),
(36, '6', 'Assist or lead in developing supplier/vendor/subcontractor strategy for service delivery.'),
(37, '7', 'Description1'),
(38, '7', 'Description2'),
(39, '7', 'Description3'),
(40, '8', 'Must be good with javascript, Angular and Node.js are added advantages'),
(41, '8', 'Adequate knowledge of OOP concepts'),
(42, '9', 'job description'),
(43, '9', 'Description'),
(44, '9', 'job description'),
(45, '9', 'Description'),
(46, '6', 'Ensure successful transition from Project to Product by providing onsite support.'),
(47, '6', 'Provide regular status updates to management while managing contractors, and vendors with a variety of personality types and professional backgrounds.'),
(51, 'V-20-09-001', 'Co-ordinate construction activities from start to finish and submit reports to the organization'),
(52, 'V-20-09-001', 'Engineer must be certified in project management or any related field'),
(53, 'V-20-09-001', 'Use of CAD tools is an added advantage'),
(63, 'V-20-09-001', 'PMP certification is an added advantage'),
(66, 'V-20-09-002', 'Create web applications for the company'),
(67, 'V-20-09-002', 'Modify and maintain existing codebase'),
(80, 'V-20-09-003', 'job desc'),
(81, 'V-20-09-003', 'job desc2'),
(82, 'V-20-09-003', 'job desc3');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy_tbl`
--

CREATE TABLE `vacancy_tbl` (
  `id` int(10) NOT NULL,
  `vacancy_id` int(12) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workexperience_tbl`
--

CREATE TABLE `workexperience_tbl` (
  `wk_exp_id` int(10) NOT NULL,
  `applicant_id` int(10) NOT NULL,
  `vacancy_id` varchar(12) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `position_held` varchar(255) NOT NULL,
  `reason_for_leaving` text NOT NULL,
  `salary` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workexperience_tbl`
--

INSERT INTO `workexperience_tbl` (`wk_exp_id`, `applicant_id`, `vacancy_id`, `organization`, `start_date`, `end_date`, `position_held`, `reason_for_leaving`, `salary`) VALUES
(3, 1, '5', '4ITAFRICA', '2020-04-13', '2020-10-19', 'Social Media Manager', 'End of contract', '1000'),
(4, 1, '4', 'Business company', '2020-09-01', '2020-11-12', 'Social Media ', 'End of contract reason', '10000000'),
(143, 3, '9', 'Colad Construction', '2020-09-01', '2020-09-30', 'Junior Engineer', 'Junior Engineer', '10000'),
(144, 5, '3', 'Benin Construction Ltd', '2019-05-24', '2020-07-23', 'Maintenance Engineer', 'Movement to a new location', '40,000'),
(147, 2, '6', '4ITAFRICA', '2020-04-13', '2020-10-16', 'Social Media Manager', 'Social Media Manager', '19000'),
(148, 2, '6', 'Business', '2020-05-03', '2020-09-30', 'Social Manager', 'Social Manager', '50000'),
(150, 4, '8', 'Confidence Technologies', '0000-00-00', '2020-10-31', 'Junior web developer', 'Junior web developer', '10000'),
(156, 7, 'V20-09-002', '', '0000-00-00', '0000-00-00', '', '', ''),
(158, 6, 'V-20-09-001', '', '0000-00-00', '0000-00-00', '', '', ''),
(160, 8, '1', '', '0000-00-00', '0000-00-00', '', '', ''),
(161, 10, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(162, 9, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(163, 10, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(164, 9, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(165, 9, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(166, 9, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(167, 11, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(168, 11, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(169, 12, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(170, 12, 'V-20-09-001', 'Molad eKonsult', '2020-07-01', '2020-11-06', 'Web Developer', 'Still part of the team', '10000'),
(171, 13, 'V-20-09-002', '4ITAFRICA', '2020-11-06', '2020-11-06', 'Social Media Manager', 'Social Media Manager', '1000');

-- --------------------------------------------------------

--
-- Structure for view `currentstafflist`
--
DROP TABLE IF EXISTS `currentstafflist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `currentstafflist`  AS SELECT `pdata`.`id` AS `id`, `pdata`.`idno` AS `idno`, `pdata`.`title` AS `title`, `pdata`.`sname` AS `sname`, `pdata`.`fname` AS `fname`, `pdata`.`mname` AS `mname`, `pdata`.`gender` AS `gender`, `pdata`.`dob` AS `dob`, `pdata`.`maidenname` AS `maidenname`, `pdata`.`mstatus` AS `mstatus`, `pdata`.`religion` AS `religion`, `pdata`.`address1` AS `address1`, `pdata`.`address2` AS `address2`, `pdata`.`state` AS `state`, `pdata`.`phoneno` AS `phoneno`, `pdata`.`email` AS `email`, `pdata`.`nationality` AS `nationality`, `pdata`.`stateoforigin` AS `stateoforigin`, `pdata`.`lga` AS `lga`, `pdata`.`hometown` AS `hometown`, `pdata`.`dresume` AS `dresume`, `pdata`.`unit` AS `unit`, `pdata`.`post` AS `post`, `pdata`.`dept` AS `dept`, `pdata`.`specialization` AS `specialization`, `pdata`.`category` AS `category`, `pdata`.`subcategory` AS `subcategory`, `pdata`.`employmenttype` AS `employmenttype`, `pdata`.`employmentstatus` AS `employmentstatus`, `pdata`.`sallev` AS `sallev`, `pdata`.`dutypost` AS `dutypost`, `pdata`.`dutypay` AS `dutypay`, `pdata`.`special` AS `special`, `pdata`.`bank` AS `bank`, `pdata`.`baccount` AS `baccount`, `pdata`.`nhf` AS `nhf`, `pdata`.`nhfno` AS `nhfno`, `pdata`.`pfa` AS `pfa`, `pdata`.`pfano` AS `pfano`, `pdata`.`modifiedat` AS `modifiedat`, `pdata`.`appno` AS `appno`, `pdata`.`grosspay` AS `grosspay`, `pdata`.`peradres1` AS `peradres1`, `pdata`.`peradres2` AS `peradres2`, `pdata`.`peradres3` AS `peradres3` FROM `pdata` WHERE `pdata`.`employmentstatus` = 'Active' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `application_status_tbl`
--
ALTER TABLE `application_status_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_of_degree`
--
ALTER TABLE `class_of_degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_history_tbl`
--
ALTER TABLE `educational_history_tbl`
  ADD PRIMARY KEY (`educ_hist_id`);

--
-- Indexes for table `eligibility_questions_tbl`
--
ALTER TABLE `eligibility_questions_tbl`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `eligibility_responses`
--
ALTER TABLE `eligibility_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employmentcategory`
--
ALTER TABLE `employmentcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employmenttype`
--
ALTER TABLE `employmenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview_panelists_tbl`
--
ALTER TABLE `interview_panelists_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview_panels_tbl`
--
ALTER TABLE `interview_panels_tbl`
  ADD PRIMARY KEY (`panel_id`);

--
-- Indexes for table `job_applicants_tbl`
--
ALTER TABLE `job_applicants_tbl`
  ADD PRIMARY KEY (`job_app_id`);

--
-- Indexes for table `job_users`
--
ALTER TABLE `job_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_vacancy_tbl`
--
ALTER TABLE `job_vacancy_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panelist_group_tbl`
--
ALTER TABLE `panelist_group_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdata`
--
ALTER TABLE `pdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications_tbl`
--
ALTER TABLE `qualifications_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referees_tbl`
--
ALTER TABLE `referees_tbl`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `subscriptions_tbl`
--
ALTER TABLE `subscriptions_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`titleid`);

--
-- Indexes for table `vacancy_desc_tbl`
--
ALTER TABLE `vacancy_desc_tbl`
  ADD PRIMARY KEY (`desc_id`);

--
-- Indexes for table `workexperience_tbl`
--
ALTER TABLE `workexperience_tbl`
  ADD PRIMARY KEY (`wk_exp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `application_status_tbl`
--
ALTER TABLE `application_status_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_of_degree`
--
ALTER TABLE `class_of_degree`
  MODIFY `degree_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `educational_history_tbl`
--
ALTER TABLE `educational_history_tbl`
  MODIFY `educ_hist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `eligibility_questions_tbl`
--
ALTER TABLE `eligibility_questions_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `eligibility_responses`
--
ALTER TABLE `eligibility_responses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `employmentcategory`
--
ALTER TABLE `employmentcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employmenttype`
--
ALTER TABLE `employmenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interview_panelists_tbl`
--
ALTER TABLE `interview_panelists_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `interview_panels_tbl`
--
ALTER TABLE `interview_panels_tbl`
  MODIFY `panel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_applicants_tbl`
--
ALTER TABLE `job_applicants_tbl`
  MODIFY `job_app_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job_users`
--
ALTER TABLE `job_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_vacancy_tbl`
--
ALTER TABLE `job_vacancy_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `panelist_group_tbl`
--
ALTER TABLE `panelist_group_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdata`
--
ALTER TABLE `pdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qualifications_tbl`
--
ALTER TABLE `qualifications_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `referees_tbl`
--
ALTER TABLE `referees_tbl`
  MODIFY `ref_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `subscriptions_tbl`
--
ALTER TABLE `subscriptions_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vacancy_desc_tbl`
--
ALTER TABLE `vacancy_desc_tbl`
  MODIFY `desc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `workexperience_tbl`
--
ALTER TABLE `workexperience_tbl`
  MODIFY `wk_exp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
