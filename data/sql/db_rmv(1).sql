-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2014 at 04:10 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_rmv`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount_due`
--

CREATE TABLE IF NOT EXISTS `amount_due` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) unsigned NOT NULL,
  `deposit_due_date` date NOT NULL,
  `paid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0 -none, 1 - paid',
  `order_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_amount_due_orders_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cabins`
--

CREATE TABLE IF NOT EXISTS `cabins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deck_number` int(11) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `cruise_id` int(11) unsigned NOT NULL,
  `is_active` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_cabins_cruises_id` (`cruise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cabins`
--

INSERT INTO `cabins` (`id`, `deck_number`, `name`, `description`, `cruise_id`, `is_active`) VALUES
(5, 2, 'KB1', '', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cabins_promo`
--

CREATE TABLE IF NOT EXISTS `cabins_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `cabin_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cabins_promo_inventory_cruise_id` (`cabin_id`),
  KEY `FK_cabins_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `sex` tinyint(4) NOT NULL COMMENT '0-male, 1-fermail',
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `country_id` int(11) unsigned NOT NULL,
  `zip` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clients_countries_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `sex`, `email`, `phone`, `dob`, `address`, `address2`, `city`, `state`, `country_id`, `zip`) VALUES
(4, 'Taras', 'Ilyin', 0, 'tavai89@gmail.com', '+380999031920', '1989-01-22', 'asdasd', 'asdasd', 'Kharkov', 'AZ', 2, '1123123');

-- --------------------------------------------------------

--
-- Table structure for table `core_config_data`
--

CREATE TABLE IF NOT EXISTS `core_config_data` (
  `id` int(11) unsigned NOT NULL,
  `option` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'country_id',
  `code` varchar(4) CHARACTER SET utf8 NOT NULL COMMENT 'country_code',
  `country_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `currency` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `search_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_bin AVG_ROW_LENGTH=68 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `country_name`, `currency`, `search_name`) VALUES
(1, 'AF', 'AFGHANISTAN', NULL, 'afghanistan'),
(2, 'AX', 'AALAND ISLANDS', NULL, 'aalandislands'),
(3, 'AL', 'ALBANIA', NULL, 'albania'),
(4, 'DZ', 'ALGERIA', NULL, 'algeria'),
(5, 'AS', 'AMERICAN SAMOA', NULL, 'americansamoa'),
(6, 'AD', 'ANDORRA', NULL, 'andorra'),
(7, 'AO', 'ANGOLA', NULL, 'angola'),
(8, 'AI', 'ANGUILLA', NULL, 'anguilla'),
(9, 'AQ', 'ANTARCTICA', NULL, 'antarctica'),
(10, 'AG', 'ANTIGUA AND BARBUDA', NULL, 'antiguaandbarbuda'),
(11, 'AR', 'ARGENTINA', NULL, 'argentina'),
(12, 'AM', 'ARMENIA', NULL, 'armenia'),
(13, 'AW', 'ARUBA', NULL, 'aruba'),
(14, 'AU', 'AUSTRALIA', NULL, 'australia'),
(15, 'AT', 'AUSTRIA', NULL, 'austria'),
(16, 'AZ', 'AZERBAIJAN', NULL, 'azerbaijan'),
(17, 'BS', 'BAHAMAS', 'USD', 'bahamas'),
(18, 'BH', 'BAHRAIN', NULL, 'bahrain'),
(19, 'BD', 'BANGLADESH', NULL, 'bangladesh'),
(20, 'BB', 'BARBADOS', NULL, 'barbados'),
(21, 'BY', 'BELARUS', NULL, 'belarus'),
(22, 'BE', 'BELGIUM', NULL, 'belgium'),
(23, 'BZ', 'BELIZE', NULL, 'belize'),
(24, 'BJ', 'BENIN', NULL, 'benin'),
(25, 'BM', 'BERMUDA', NULL, 'bermuda'),
(26, 'BT', 'BHUTAN', NULL, 'bhutan'),
(27, 'BO', 'BOLIVIA', NULL, 'bolivia'),
(28, 'BA', 'BOSNIA AND HERZEGOVINA', NULL, 'bosniaandherzegovina'),
(29, 'BW', 'BOTSWANA', NULL, 'botswana'),
(30, 'BV', 'BOUVET ISLAND', NULL, 'bouvetisland'),
(31, 'BR', 'BRAZIL', NULL, 'brazil'),
(32, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', NULL, 'britishindianoceanterritory'),
(33, 'BN', 'BRUNEI DARUSSALAM', NULL, 'bruneidarussalam'),
(34, 'BG', 'BULGARIA', NULL, 'bulgaria'),
(35, 'BF', 'BURKINA FASO', NULL, 'burkinafaso'),
(36, 'BI', 'BURUNDI', NULL, 'burundi'),
(37, 'KH', 'CAMBODIA', NULL, 'cambodia'),
(38, 'CM', 'CAMEROON', NULL, 'cameroon'),
(39, 'CA', 'CANADA', NULL, 'canada'),
(40, 'CV', 'CAPE VERDE', NULL, 'capeverde'),
(41, 'KY', 'CAYMAN ISLANDS', NULL, 'caymanislands'),
(42, 'CF', 'CENTRAL AFRICAN REPUBLIC', NULL, 'centralafricanrepublic'),
(43, 'TD', 'CHAD', NULL, 'chad'),
(44, 'CL', 'CHILE', NULL, 'chile'),
(45, 'CN', 'CHINA', NULL, 'china'),
(46, 'CX', 'CHRISTMAS ISLAND', NULL, 'christmasisland'),
(47, 'CC', 'COCOS (KEELING) ISLANDS', NULL, 'cocos(keeling)islands'),
(48, 'CO', 'COLOMBIA', NULL, 'colombia'),
(49, 'KM', 'COMOROS', NULL, 'comoros'),
(50, 'CG', 'CONGO', NULL, 'congo'),
(51, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', NULL, 'congothedemocraticrepublicofthe'),
(52, 'CK', 'COOK ISLANDS', NULL, 'cookislands'),
(53, 'CR', 'COSTA RICA', NULL, 'costarica'),
(54, 'CI', 'COTE D''IVOIRE', NULL, 'coted''ivoire'),
(55, 'HR', 'CROATIA', NULL, 'croatia'),
(56, 'CU', 'CUBA', NULL, 'cuba'),
(57, 'CY', 'CYPRUS', NULL, 'cyprus'),
(58, 'CZ', 'CZECH REPUBLIC', NULL, 'czechrepublic'),
(59, 'DK', 'DENMARK', 'DKK', 'denmark'),
(60, 'DJ', 'DJIBOUTI', NULL, 'djibouti'),
(61, 'DM', 'DOMINICA', NULL, 'dominica'),
(62, 'DO', 'DOMINICAN REPUBLIC', NULL, 'dominicanrepublic'),
(63, 'EC', 'ECUADOR', NULL, 'ecuador'),
(64, 'EG', 'EGYPT', NULL, 'egypt'),
(65, 'SV', 'EL SALVADOR', NULL, 'elsalvador'),
(66, 'GQ', 'EQUATORIAL GUINEA', NULL, 'equatorialguinea'),
(67, 'ER', 'ERITREA', NULL, 'eritrea'),
(68, 'EE', 'ESTONIA', NULL, 'estonia'),
(69, 'ET', 'ETHIOPIA', NULL, 'ethiopia'),
(70, 'FK', 'FALKLAND ISLANDS (MALVINAS)', NULL, 'falklandislands(malvinas)'),
(71, 'FO', 'FAROE ISLANDS', NULL, 'faroeislands'),
(72, 'FJ', 'FIJI', NULL, 'fiji'),
(73, 'FI', 'FINLAND', NULL, 'finland'),
(74, 'FR', 'FRANCE', NULL, 'france'),
(75, 'GF', 'FRENCH GUIANA', NULL, 'frenchguiana'),
(76, 'PF', 'FRENCH POLYNESIA', NULL, 'frenchpolynesia'),
(77, 'TF', 'FRENCH SOUTHERN TERRITORIES', NULL, 'frenchsouthernterritories'),
(78, 'GA', 'GABON', NULL, 'gabon'),
(79, 'GM', 'GAMBIA', NULL, 'gambia'),
(80, 'GE', 'GEORGIA', NULL, 'georgia'),
(81, 'DE', 'GERMANY', NULL, 'germany'),
(82, 'GH', 'GHANA', NULL, 'ghana'),
(83, 'GI', 'GIBRALTAR', NULL, 'gibraltar'),
(84, 'GR', 'GREECE', NULL, 'greece'),
(85, 'GL', 'GREENLAND', NULL, 'greenland'),
(86, 'GD', 'GRENADA', NULL, 'grenada'),
(87, 'GP', 'GUADELOUPE', NULL, 'guadeloupe'),
(88, 'GU', 'GUAM', NULL, 'guam'),
(89, 'GT', 'GUATEMALA', NULL, 'guatemala'),
(90, 'GN', 'GUINEA', NULL, 'guinea'),
(91, 'GW', 'GUINEA-BISSAU', NULL, 'guineabissau'),
(92, 'GY', 'GUYANA', NULL, 'guyana'),
(93, 'HT', 'HAITI', NULL, 'haiti'),
(94, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', NULL, 'heardislandandmcdonaldislands'),
(95, 'VA', 'HOLY SEE (VATICAN CITY STATE)', NULL, 'holysee(vaticancitystate)'),
(96, 'HN', 'HONDURAS', NULL, 'honduras'),
(97, 'HK', 'HONG KONG', NULL, 'hongkong'),
(98, 'HU', 'HUNGARY', NULL, 'hungary'),
(99, 'IS', 'ICELAND', NULL, 'iceland'),
(100, 'IN', 'INDIA', 'INR', 'india'),
(101, 'ID', 'INDONESIA', NULL, 'indonesia'),
(102, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', NULL, 'iranislamicrepublicof'),
(103, 'IQ', 'IRAQ', NULL, 'iraq'),
(104, 'IE', 'IRELAND', NULL, 'ireland'),
(105, 'IL', 'ISRAEL', NULL, 'israel'),
(106, 'IT', 'ITALY', 'EUR', 'italy'),
(107, 'JM', 'JAMAICA', NULL, 'jamaica'),
(108, 'JP', 'JAPAN', NULL, 'japan'),
(109, 'JO', 'JORDAN', NULL, 'jordan'),
(110, 'KZ', 'KAZAKHSTAN', NULL, 'kazakhstan'),
(111, 'KE', 'KENYA', NULL, 'kenya'),
(112, 'KI', 'KIRIBATI', NULL, 'kiribati'),
(113, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', NULL, 'koreademocraticpeople''srepublicof'),
(114, 'KR', 'KOREA, REPUBLIC OF', NULL, 'korearepublicof'),
(115, 'KW', 'KUWAIT', NULL, 'kuwait'),
(116, 'KG', 'KYRGYZSTAN', NULL, 'kyrgyzstan'),
(117, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', NULL, 'laopeople''sdemocraticrepublic'),
(118, 'LV', 'LATVIA', NULL, 'latvia'),
(119, 'LB', 'LEBANON', NULL, 'lebanon'),
(120, 'LS', 'LESOTHO', NULL, 'lesotho'),
(121, 'LR', 'LIBERIA', NULL, 'liberia'),
(122, 'LY', 'LIBYAN ARAB JAMAHIRIYA', NULL, 'libyanarabjamahiriya'),
(123, 'LI', 'LIECHTENSTEIN', NULL, 'liechtenstein'),
(124, 'LT', 'LITHUANIA', NULL, 'lithuania'),
(125, 'LU', 'LUXEMBOURG', NULL, 'luxembourg'),
(126, 'MO', 'MACAO', NULL, 'macao'),
(127, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', NULL, 'macedoniatheformeryugoslavrepublicof'),
(128, 'MG', 'MADAGASCAR', NULL, 'madagascar'),
(129, 'MW', 'MALAWI', NULL, 'malawi'),
(130, 'MY', 'MALAYSIA', 'MYR', 'malaysia'),
(131, 'MV', 'MALDIVES', NULL, 'maldives'),
(132, 'ML', 'MALI', NULL, 'mali'),
(133, 'MT', 'MALTA', NULL, 'malta'),
(134, 'MH', 'MARSHALL ISLANDS', NULL, 'marshallislands'),
(135, 'MQ', 'MARTINIQUE', NULL, 'martinique'),
(136, 'MR', 'MAURITANIA', NULL, 'mauritania'),
(137, 'MU', 'MAURITIUS', NULL, 'mauritius'),
(138, 'YT', 'MAYOTTE', NULL, 'mayotte'),
(139, 'MX', 'MEXICO', NULL, 'mexico'),
(140, 'FM', 'MICRONESIA, FEDERATED STATES OF', NULL, 'micronesiafederatedstatesof'),
(141, 'MD', 'MOLDOVA, REPUBLIC OF', NULL, 'moldovarepublicof'),
(142, 'MC', 'MONACO', NULL, 'monaco'),
(143, 'MN', 'MONGOLIA', NULL, 'mongolia'),
(144, 'MS', 'MONTSERRAT', NULL, 'montserrat'),
(145, 'MA', 'MOROCCO', NULL, 'morocco'),
(146, 'MZ', 'MOZAMBIQUE', NULL, 'mozambique'),
(147, 'MM', 'MYANMAR', NULL, 'myanmar'),
(148, 'NA', 'NAMIBIA', NULL, 'namibia'),
(149, 'NR', 'NAURU', NULL, 'nauru'),
(150, 'NP', 'NEPAL', NULL, 'nepal'),
(151, 'NL', 'NETHERLANDS', NULL, 'netherlands'),
(152, 'AN', 'NETHERLANDS ANTILLES', NULL, 'netherlandsantilles'),
(153, 'NC', 'NEW CALEDONIA', NULL, 'newcaledonia'),
(154, 'NZ', 'NEW ZEALAND', NULL, 'newzealand'),
(155, 'NI', 'NICARAGUA', NULL, 'nicaragua'),
(156, 'NE', 'NIGER', NULL, 'niger'),
(157, 'NG', 'NIGERIA', NULL, 'nigeria'),
(158, 'NU', 'NIUE', NULL, 'niue'),
(159, 'NF', 'NORFOLK ISLAND', NULL, 'norfolkisland'),
(160, 'MP', 'NORTHERN MARIANA ISLANDS', NULL, 'northernmarianaislands'),
(161, 'NO', 'NORWAY', NULL, 'norway'),
(162, 'OM', 'OMAN', NULL, 'oman'),
(163, 'PK', 'PAKISTAN', NULL, 'pakistan'),
(164, 'PW', 'PALAU', NULL, 'palau'),
(165, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', NULL, 'palestinianterritoryoccupied'),
(166, 'PA', 'PANAMA', NULL, 'panama'),
(167, 'PG', 'PAPUA NEW GUINEA', NULL, 'papuanewguinea'),
(168, 'PY', 'PARAGUAY', NULL, 'paraguay'),
(169, 'PE', 'PERU', NULL, 'peru'),
(170, 'PH', 'PHILIPPINES', 'USD', 'philippines'),
(171, 'PN', 'PITCAIRN', NULL, 'pitcairn'),
(172, 'PL', 'POLAND', NULL, 'poland'),
(173, 'PT', 'PORTUGAL', NULL, 'portugal'),
(174, 'PR', 'PUERTO RICO', NULL, 'puertorico'),
(175, 'QA', 'QATAR', NULL, 'qatar'),
(176, 'RE', 'REUNION', NULL, 'reunion'),
(177, 'RO', 'ROMANIA', NULL, 'romania'),
(178, 'RU', 'RUSSIAN FEDERATION', NULL, 'russianfederation'),
(179, 'RW', 'RWANDA', NULL, 'rwanda'),
(180, 'SH', 'SAINT HELENA', NULL, 'sainthelena'),
(181, 'KN', 'SAINT KITTS AND NEVIS', NULL, 'saintkittsandnevis'),
(182, 'LC', 'SAINT LUCIA', NULL, 'saintlucia'),
(183, 'PM', 'SAINT PIERRE AND MIQUELON', NULL, 'saintpierreandmiquelon'),
(184, 'VC', 'SAINT VINCENT AND THE GRENADINES', NULL, 'saintvincentandthegrenadines'),
(185, 'WS', 'SAMOA', NULL, 'samoa'),
(186, 'SM', 'SAN MARINO', NULL, 'sanmarino'),
(187, 'ST', 'SAO TOME AND PRINCIPE', NULL, 'saotomeandprincipe'),
(188, 'SA', 'SAUDI ARABIA', NULL, 'saudiarabia'),
(189, 'SN', 'SENEGAL', NULL, 'senegal'),
(190, 'CS', 'SERBIA AND MONTENEGRO', NULL, 'serbiaandmontenegro'),
(191, 'SC', 'SEYCHELLES', NULL, 'seychelles'),
(192, 'SL', 'SIERRA LEONE', NULL, 'sierraleone'),
(193, 'SG', 'SINGAPORE', NULL, 'singapore'),
(194, 'SK', 'SLOVAKIA', NULL, 'slovakia'),
(195, 'SI', 'SLOVENIA', NULL, 'slovenia'),
(196, 'SB', 'SOLOMON ISLANDS', NULL, 'solomonislands'),
(197, 'SO', 'SOMALIA', NULL, 'somalia'),
(198, 'ZA', 'SOUTH AFRICA', NULL, 'southafrica'),
(199, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', NULL, 'southgeorgiaandthesouthsandwichislands'),
(200, 'ES', 'SPAIN', 'EUR', 'spain'),
(201, 'LK', 'SRI LANKA', NULL, 'srilanka'),
(202, 'SD', 'SUDAN', NULL, 'sudan'),
(203, 'SR', 'SURIcode', NULL, 'suricode'),
(204, 'SJ', 'SVALBARD AND JAN MAYEN', NULL, 'svalbardandjanmayen'),
(205, 'SZ', 'SWAZILAND', NULL, 'swaziland'),
(206, 'SE', 'SWEDEN', NULL, 'sweden'),
(207, 'CH', 'SWITZERLAND', NULL, 'switzerland'),
(208, 'SY', 'SYRIAN ARAB REPUBLIC', NULL, 'syrianarabrepublic'),
(209, 'TW', 'TAIWAN, PROVINCE OF CHINA', NULL, 'taiwanprovinceofchina'),
(210, 'TJ', 'TAJIKISTAN', NULL, 'tajikistan'),
(211, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', NULL, 'tanzaniaunitedrepublicof'),
(212, 'TH', 'THAILAND', NULL, 'thailand'),
(213, 'TL', 'TIMOR-LESTE', NULL, 'timorleste'),
(214, 'TG', 'TOGO', NULL, 'togo'),
(215, 'TK', 'TOKELAU', NULL, 'tokelau'),
(216, 'TO', 'TONGA', NULL, 'tonga'),
(217, 'TT', 'TRINIDAD AND TOBAGO', NULL, 'trinidadandtobago'),
(218, 'TN', 'TUNISIA', NULL, 'tunisia'),
(219, 'TR', 'TURKEY', NULL, 'turkey'),
(220, 'TM', 'TURKMENISTAN', NULL, 'turkmenistan'),
(221, 'TC', 'TURKS AND CAICOS ISLANDS', NULL, 'turksandcaicosislands'),
(222, 'TV', 'TUVALU', NULL, 'tuvalu'),
(223, 'UG', 'UGANDA', NULL, 'uganda'),
(224, 'UA', 'UKRAINE', NULL, 'ukraine'),
(225, 'AE', 'UNITED ARAB EMIRATES', NULL, 'unitedarabemirates'),
(226, 'GB', 'UNITED KINGDOM', NULL, 'unitedkingdom'),
(227, 'US', 'UNITED STATES', 'USD', 'unitedstates'),
(228, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', NULL, 'unitedstatesminoroutlyingislands'),
(229, 'UY', 'URUGUAY', NULL, 'uruguay'),
(230, 'UZ', 'UZBEKISTAN', NULL, 'uzbekistan'),
(231, 'VU', 'VANUATU', NULL, 'vanuatu'),
(232, 'VE', 'VENEZUELA', NULL, 'venezuela'),
(233, 'VN', 'VIET NAM', NULL, 'vietnam'),
(234, 'VG', 'VIRGIN ISLANDS, BRITISH', NULL, 'virginislandsbritish'),
(235, 'VI', 'VIRGIN ISLANDS, U.S.', NULL, 'virginislandsus'),
(236, 'WF', 'WALLIS AND FUTUNA', NULL, 'wallisandfutuna'),
(237, 'EH', 'WESTERN SAHARA', NULL, 'westernsahara'),
(238, 'YE', 'YEMEN', NULL, 'yemen'),
(239, 'ZM', 'ZAMBIA', NULL, 'zambia'),
(240, 'ZW', 'ZIMBABWE', NULL, 'zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE IF NOT EXISTS `credit_cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_on_cc` varchar(64) NOT NULL,
  `type` varchar(64) NOT NULL,
  `card_number` int(18) unsigned NOT NULL,
  `card_expiry_date` date NOT NULL,
  `csv_number` varchar(16) NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_credit_cards_clients_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cruises`
--

CREATE TABLE IF NOT EXISTS `cruises` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `country_id` int(11) unsigned DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_cruises_countries_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cruises`
--

INSERT INTO `cruises` (`id`, `name`, `description`, `start_date`, `end_date`, `country_id`, `is_active`) VALUES
(5, 'Cruise to Botswana', 'Description Cruise to Botswana', '2014-02-10', '2014-03-12', 29, 1),
(12, 'Cruice to Algeria', '', '2014-05-01', '2014-06-02', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cruise_promo`
--

CREATE TABLE IF NOT EXISTS `cruise_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `cruise_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cruise_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_details`
--

CREATE TABLE IF NOT EXISTS `email_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `message` text NOT NULL,
  `action` int(11) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `email_details`
--

INSERT INTO `email_details` (`id`, `name`, `header`, `footer`, `message`, `action`, `template`) VALUES
(3, 'test', '&lt;div style=&quot;background:grey;text-align:center;width:100%;color:white;&quot;&gt;&lt;h2&gt;Header&lt;/h2&gt;&lt;/div&gt;', '&lt;div style=&quot;background:grey;text-align:center;width:100%;color:white;&quot;&gt;&lt;h3&gt;Footer&lt;/h3&gt;&lt;/div&gt;', '&lt;span style=&quot;color:black;&quot;&gt;##hello##&lt;span&gt;&lt;span &nbsp;style=&quot;color:red;&quot;&gt;##user-name##&lt;/span&gt;', 0, 'module/Sendmail/view/template/templates/email-template.phtml'),
(4, 'restore-password', 'Reservation Manager', 'Copyright&amp;copy; 2014', '<p>Welcome to&nbsp;<strong>Reservation Manager</strong>,&nbsp;<br />\r\nDear ##firstName## ##lastName##, You has been registered on our site.</p>', 4, 'module/Sendmail/view/template/templates/reservation.phtml'),
(6, 'template1', 'Reservation Manager', 'Copyright&amp;copy; 2014', 'some text', 0, 'module/Sendmail/view/template/templates/base-template.phtml'),
(7, 'add-user', 'Reservation Manager', 'Copyright&amp;copy; 2014', 'Welcome to <strong>Reservation Manager</strong>!<br />\r\nDear ##firstName## ##lastName##,&nbsp;You has been registered on our site.<br />\r\n&nbsp;', 1, 'module/Sendmail/view/template/templates/add-user.phtml'),
(8, 'edit-user', 'Reservation Manager', 'Copyright&amp;copy; 2014', 'Welcome to&nbsp;<strong>Reservation Manager</strong>!<br />\r\nDear ##firstName## ##lastName##,&nbsp;You profile&nbsp;has been updated ##date##.', 2, 'module/Sendmail/view/template/templates/edit-user.phtml'),
(9, 'reservation', 'Reservation Manager', 'Copyright&amp;copy; 2014', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;', 3, 'module/Sendmail/view/template/templates/restore-password.phtml');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `min_days` int(11) NOT NULL,
  `is_active` tinyint(2) unsigned NOT NULL,
  `resort_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events_promo`
--

CREATE TABLE IF NOT EXISTS `events_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_events_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_category_promo`
--

CREATE TABLE IF NOT EXISTS `event_category_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `event_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_event_category_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `event_category_promo`
--

INSERT INTO `event_category_promo` (`id`, `promo_id`, `event_category_id`) VALUES
(6, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_rooms_promo`
--

CREATE TABLE IF NOT EXISTS `event_rooms_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `event_room_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_event_rooms_promo_inventory_event_id` (`event_room_id`),
  KEY `FK_event_rooms_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_cruise`
--

CREATE TABLE IF NOT EXISTS `inventory_cruise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_id` int(11) unsigned NOT NULL COMMENT 'avp_cruise_id',
  `suite_id` int(11) unsigned NOT NULL COMMENT 'avp_suite_id',
  `cruise_name` varchar(128) NOT NULL,
  `deck_number` int(11) unsigned NOT NULL,
  `suite_name` varchar(128) NOT NULL,
  `total_available` int(11) unsigned NOT NULL DEFAULT '0',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `net_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `notes` text,
  `promo_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_cruise_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `inventory_cruise`
--

INSERT INTO `inventory_cruise` (`id`, `cruise_id`, `suite_id`, `cruise_name`, `deck_number`, `suite_name`, `total_available`, `date_from`, `date_to`, `net_price`, `gross_price`, `notes`, `promo_id`) VALUES
(5, 7, 15, 'Western Caribbean Cruise', 1, 'Oceanview Stateroom (H)', 2, '2014-04-17', '2014-04-19', 200.00, 400.00, '', NULL),
(6, 7, 15, 'Western Caribbean Cruise', 2, 'Oceanview Stateroom (H)', 20, '2014-05-31', '2014-06-20', 100.00, 200.00, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_event`
--

CREATE TABLE IF NOT EXISTS `inventory_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) unsigned DEFAULT NULL COMMENT 'avp_event_id',
  `resort_id` int(11) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `event_name` varchar(128) NOT NULL,
  `hotel_name` varchar(128) NOT NULL,
  `room_category` varchar(255) NOT NULL,
  `total_available` int(11) NOT NULL DEFAULT '0',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `net_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `promo_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_event_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `inventory_event`
--

INSERT INTO `inventory_event` (`id`, `event_id`, `resort_id`, `room_id`, `event_name`, `hotel_name`, `room_category`, `total_available`, `date_from`, `date_to`, `net_price`, `gross_price`, `promo_id`) VALUES
(3, 74, 23, 36, 'Cupids Caribbean Kiss', 'CALIENTE CARIBE', 'Seacliff Room', 22, '2014-04-17', '2014-04-18', 300.00, 200.00, NULL),
(7, 73, 20, 16, 'Hedo Kamasutra Week 2014 ', 'Hedonism II', 'Garden View Nude (GVN)', 2, '2014-04-19', '2014-04-27', 300.00, 400.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_excursion`
--

CREATE TABLE IF NOT EXISTS `inventory_excursion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resort_id` int(11) unsigned NOT NULL COMMENT 'avp_resort_id',
  `supplier_name` varchar(64) NOT NULL,
  `number_available` int(11) unsigned NOT NULL DEFAULT '0',
  `net_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `hotel_name` varchar(128) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `inventory_excursion`
--

INSERT INTO `inventory_excursion` (`id`, `resort_id`, `supplier_name`, `number_available`, `net_price`, `gross_price`, `hotel_name`, `name`) VALUES
(2, 20, 'supplier 1', 11, 55.00, 100.00, 'Hedonism II', 'excursion 1 edit'),
(3, 24, 'supplier 1', 10, 50.00, 100.00, 'Temptation Resort Cancun', 'excursion 1'),
(4, 20, 'supplier 1', 10, 50.00, 100.00, 'Hedonism II', 'excursion 2');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_hotels`
--

CREATE TABLE IF NOT EXISTS `inventory_hotels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resort_id` int(11) NOT NULL COMMENT 'avp_resort_id',
  `room_id` int(11) NOT NULL COMMENT 'avp_room_id',
  `hotel_name` varchar(128) NOT NULL,
  `room_category` varchar(255) NOT NULL,
  `number_available` int(11) unsigned NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `net_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `notes` text,
  `promo_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_hotels_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `inventory_hotels`
--

INSERT INTO `inventory_hotels` (`id`, `resort_id`, `room_id`, `hotel_name`, `room_category`, `number_available`, `date_from`, `date_to`, `net_price`, `gross_price`, `notes`, `promo_id`) VALUES
(4, 20, 14, 'Hedonism II', 'Garden View Regular (GVR)', 12, '2014-09-01', '2014-09-30', 12.00, 40.00, '', NULL),
(5, 20, 16, 'Hedonism II', 'Garden View Nude (GVN)', 20, '2014-05-31', '2014-07-31', 100.00, 150.00, '', NULL),
(10, 20, 19, 'Hedonism II', 'Garden View Nude Jacuzzi', 12, '2014-05-07', '2014-05-22', 22.00, 33.00, '', 23);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE IF NOT EXISTS `inventory_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `linked_to` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0 -all, 1 - resort, 2 - event, 3 - cruise, 4 - resort name, 5 -event category, 6 -event name, 7- cruise name ',
  `number_available` int(11) unsigned NOT NULL DEFAULT '0',
  `net_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `resort_id` int(11) unsigned DEFAULT NULL,
  `event_id` int(11) unsigned DEFAULT NULL,
  `cruise_id` int(11) unsigned DEFAULT NULL,
  `event_category_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_item_inventory_cruise_id` (`cruise_id`),
  KEY `FK_inventory_item_inventory_event_id` (`event_id`),
  KEY `FK_inventory_item_inventory_hotels_id` (`resort_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1489 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`id`, `name`, `linked_to`, `number_available`, `net_price`, `gross_price`, `resort_id`, `event_id`, `cruise_id`, `event_category_id`) VALUES
(8, 'Test All', 0, 1, 1.00, 2.00, NULL, NULL, NULL, NULL),
(9, 'Test All Resorts', 1, 23, 12233.00, 1222334.00, NULL, NULL, NULL, NULL),
(10, 'Test All Events', 2, 12, 300.00, 400.00, NULL, NULL, NULL, NULL),
(11, 'Test All Cruises', 3, 562, 4000.00, 5000.00, NULL, NULL, NULL, NULL),
(12, 'Test Resort Name', 4, 45, 500.00, 600.00, 24, NULL, NULL, NULL),
(13, 'Test Event Category', 5, 11, 500.00, 700.00, NULL, NULL, NULL, 1),
(14, 'Test Event Name', 6, 334, 600.00, 800.00, NULL, 71, NULL, NULL),
(15, 'Test Cruise Name', 7, 52, 100.00, 200.00, NULL, NULL, 7, NULL),
(16, 'Some itventory item', 7, 10, 5.00, 3.00, NULL, NULL, 12, NULL),
(17, 'TravelGuard Trip Insurance', 0, 2000000, 50.00, 105.00, NULL, NULL, NULL, NULL),
(18, 'Hedonism II Item', 4, 10, 50.00, 100.00, 20, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_promo`
--

CREATE TABLE IF NOT EXISTS `inventory_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_names` varchar(64) DEFAULT NULL,
  `linke_to` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0- all, 1- Resort, 2 - Event, 3-Cruise, 4 - Resort Name, 5 - Event Category, 6 - Cruise Name, 7 - Event Name, 8- Room Category, 9 - Event Room Category, 10 Cabin',
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '0- deactive, 1 active',
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `promo_code` varchar(32) DEFAULT NULL,
  `discount_type` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '0 - dollars, 1 -percents',
  PRIMARY KEY (`id`),
  UNIQUE KEY `promo_code` (`promo_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=3276 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `inventory_promo`
--

INSERT INTO `inventory_promo` (`id`, `promo_names`, `linke_to`, `is_active`, `date_from`, `date_to`, `discount`, `image`, `description`, `promo_code`, `discount_type`) VALUES
(22, 'test', 2, 1, '2014-04-18', '2014-04-26', 10.00, NULL, '', 'promo', 1),
(23, 'tests', 0, 1, '2014-04-11', '2014-04-26', 21.00, NULL, '', 'dscs', 0),
(31, 'promo room category', 8, 1, '2014-04-03', '2014-04-30', 20.00, NULL, '', 'promo room category', 0),
(32, 'ertgretgr', 5, 1, '2014-04-03', '2014-04-18', 12.00, NULL, '', 'regre', 0),
(33, 'test resort', 8, 1, '2014-04-10', '2014-04-26', 0.00, NULL, '', 'fghngfhnghn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transfer`
--

CREATE TABLE IF NOT EXISTS `inventory_transfer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resort_id` int(11) unsigned NOT NULL COMMENT 'avp_resort_id',
  `hotel_name` varchar(128) DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `net_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `gross_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `date_from` date DEFAULT NULL,
  `supplier_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `inventory_transfer`
--

INSERT INTO `inventory_transfer` (`id`, `resort_id`, `hotel_name`, `date_to`, `net_price`, `gross_price`, `date_from`, `supplier_name`) VALUES
(1, 20, 'Hedonism II', '2014-04-26', 20.00, 300.00, '2014-04-20', 'test'),
(3, 24, 'Temptation Resort Cancun', '2014-04-24', 0.00, 0.00, '2014-04-26', 'erfef'),
(4, 26, 'Hedonism II', '2014-05-15', 20.00, 25.00, '2014-05-06', 'tests');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE IF NOT EXISTS `itinerary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day` int(11) unsigned NOT NULL,
  `port_location` varchar(128) NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `activity` text,
  `cruise_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_itinerary_cruises_id` (`cruise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`id`, `day`, `port_location`, `arrival_time`, `departure_time`, `activity`, `cruise_id`) VALUES
(1, 1, 'test', '22:22:00', '23:59:00', 'dasdsad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) unsigned NOT NULL COMMENT 'FIT, GROUP, Cruise',
  `contact_person` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `flight_going_away` varchar(64) DEFAULT NULL,
  `flight_return_home` varchar(64) DEFAULT NULL,
  `no_of_person` int(11) unsigned NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `room_category` varchar(255) DEFAULT NULL,
  `travel_from` date NOT NULL,
  `travel_to` date NOT NULL,
  `room_rate` int(11) unsigned DEFAULT NULL,
  `rooms_required` int(11) unsigned NOT NULL,
  `deposit_due_amount` decimal(10,2) unsigned NOT NULL,
  `deposit_due_amount2` decimal(10,2) unsigned DEFAULT NULL,
  `deposit_due_amount3` decimal(10,2) DEFAULT NULL,
  `deposit_due_date` date DEFAULT NULL,
  `deposit_due_date2` date DEFAULT NULL,
  `deposit_due_date3` date DEFAULT NULL,
  `transfer_amount` decimal(10,2) unsigned DEFAULT NULL,
  `trip_insurance_cost` decimal(10,2) unsigned DEFAULT NULL,
  `flight_amount` decimal(10,2) unsigned DEFAULT NULL,
  `room_total_amount` decimal(10,2) unsigned NOT NULL,
  `discount_amount` decimal(10,2) unsigned DEFAULT NULL,
  `merchant_fee` decimal(10,2) unsigned DEFAULT NULL,
  `total_amount` decimal(10,2) unsigned NOT NULL,
  `mailing_address` text NOT NULL,
  `billing_address` text NOT NULL,
  `name_on_cc` varchar(50) DEFAULT NULL,
  `type_of_card` tinyint(4) unsigned DEFAULT NULL COMMENT '1 - master card, 2 - visa',
  `card_number` varchar(50) DEFAULT NULL,
  `csv_number` varchar(50) DEFAULT NULL,
  `card_expity_date` date DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `passanger_details`
--

CREATE TABLE IF NOT EXISTS `passanger_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `age` tinyint(4) unsigned DEFAULT NULL,
  `order_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_passanger_details_orders_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `resource_id` int(11) unsigned NOT NULL,
  `permission` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '0 - deny, 1 - allow',
  PRIMARY KEY (`id`),
  KEY `FK_permissions_resource_id` (`resource_id`),
  KEY `FK_permissions_role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=409 AUTO_INCREMENT=301 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `resource_id`, `permission`) VALUES
(163, 1, 125, 1),
(164, 1, 126, 1),
(165, 1, 127, 1),
(166, 1, 128, 1),
(167, 1, 129, 1),
(168, 1, 130, 1),
(169, 1, 131, 1),
(170, 1, 132, 1),
(171, 1, 133, 1),
(172, 1, 134, 1),
(173, 1, 135, 1),
(174, 1, 136, 1),
(175, 1, 137, 1),
(176, 1, 138, 1),
(177, 1, 139, 1),
(178, 1, 140, 1),
(179, 1, 141, 1),
(180, 1, 142, 1),
(181, 1, 143, 1),
(182, 1, 144, 1),
(183, 1, 145, 1),
(184, 1, 146, 1),
(185, 1, 147, 1),
(187, 1, 149, 1),
(188, 1, 150, 1),
(189, 1, 151, 1),
(190, 1, 152, 1),
(191, 1, 153, 1),
(192, 1, 154, 1),
(193, 1, 155, 1),
(194, 1, 156, 1),
(195, 1, 157, 1),
(196, 1, 158, 1),
(197, 1, 159, 1),
(198, 1, 160, 1),
(199, 1, 161, 1),
(200, 1, 162, 1),
(201, 1, 163, 1),
(202, 1, 164, 1),
(203, 1, 165, 1),
(204, 1, 166, 1),
(205, 1, 167, 1),
(206, 1, 168, 1),
(207, 1, 169, 1),
(208, 1, 170, 1),
(209, 1, 171, 1),
(210, 1, 172, 1),
(211, 1, 173, 1),
(212, 1, 174, 1),
(213, 1, 175, 1),
(214, 1, 176, 1),
(215, 1, 177, 1),
(216, 1, 178, 1),
(217, 1, 179, 1),
(218, 1, 180, 1),
(219, 1, 181, 1),
(220, 1, 182, 1),
(221, 1, 183, 1),
(222, 1, 184, 1),
(223, 1, 185, 1),
(224, 1, 186, 1),
(225, 1, 187, 1),
(226, 1, 188, 1),
(227, 1, 189, 1),
(228, 1, 190, 1),
(229, 1, 191, 1),
(230, 1, 192, 1),
(231, 1, 193, 1),
(232, 1, 194, 1),
(233, 1, 195, 1),
(234, 1, 196, 1),
(235, 1, 197, 1),
(236, 1, 198, 1),
(237, 1, 199, 1),
(238, 1, 200, 1),
(239, 1, 201, 1),
(240, 1, 202, 1),
(241, 1, 203, 1),
(242, 1, 204, 1),
(243, 1, 205, 1),
(244, 1, 206, 1),
(245, 1, 207, 1),
(246, 1, 208, 1),
(247, 1, 209, 1),
(248, 1, 210, 1),
(249, 1, 211, 1),
(250, 1, 212, 1),
(251, 1, 213, 1),
(252, 1, 214, 1),
(253, 1, 215, 1),
(254, 1, 216, 1),
(255, 1, 217, 1),
(256, 1, 218, 1),
(257, 1, 219, 1),
(258, 1, 220, 1),
(259, 1, 221, 1),
(260, 1, 222, 1),
(261, 1, 223, 1),
(262, 1, 224, 1),
(263, 1, 225, 1),
(264, 1, 226, 1),
(265, 1, 227, 1),
(266, 1, 228, 1),
(267, 1, 229, 1),
(268, 1, 230, 1),
(269, 1, 231, 1),
(270, 1, 232, 1),
(271, 1, 233, 1),
(272, 1, 234, 1),
(273, 1, 235, 1),
(274, 2, 125, 1),
(275, 2, 126, 1),
(276, 2, 127, 1),
(278, 2, 129, 1),
(279, 2, 130, 1),
(280, 2, 131, 1),
(281, 2, 132, 1),
(285, 1, 236, 1),
(291, 1, 237, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE IF NOT EXISTS `ports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  `things_to_do` text,
  `do_not_miss` text,
  `cruise_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ports_cruises_id` (`cruise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id`, `name`, `description`, `things_to_do`, `do_not_miss`, `cruise_id`) VALUES
(3, 'Port 1', 'Description ...', 'Things To Do ...', 'Do Not Miss ...', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(3) unsigned NOT NULL COMMENT '1 - FIT, 2 GROUP, 3 CRuise',
  `flight` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1 -yes, 0-no',
  `departure_rom` varchar(64) DEFAULT NULL,
  `departure_to` varchar(64) DEFAULT NULL,
  `return_from` varchar(64) DEFAULT NULL,
  `return_to` varchar(64) DEFAULT NULL,
  `total_cost` decimal(19,2) NOT NULL,
  `appli_discount` decimal(10,2) DEFAULT NULL,
  `promo_id` int(11) unsigned DEFAULT NULL,
  `final_cost` decimal(19,2) NOT NULL,
  `payment_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1 -full, 0 -deposit',
  `deposit_amoun` decimal(19,2) NOT NULL,
  `deposit_method` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0 -Due, Rcvd',
  `balans_after_deposit` decimal(19,2) unsigned NOT NULL,
  `next_payment_due` decimal(19,2) unsigned DEFAULT NULL,
  `due_date1` date DEFAULT NULL,
  `final_payment_due` decimal(19,2) unsigned DEFAULT NULL,
  `due_date2` date DEFAULT NULL,
  `client_notes` text,
  `admin_notes` text,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `flight_total_cost` decimal(19,2) unsigned NOT NULL DEFAULT '0.00',
  `no_of_days` int(11) unsigned NOT NULL DEFAULT '0',
  `room_required` int(11) unsigned NOT NULL DEFAULT '1',
  `room_rate` decimal(19,2) unsigned NOT NULL DEFAULT '0.00',
  `status` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '1 - Open Balance, 2- Closed Balance, 0 - Canceled',
  PRIMARY KEY (`id`),
  KEY `FK_reservation_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `type`, `flight`, `departure_rom`, `departure_to`, `return_from`, `return_to`, `total_cost`, `appli_discount`, `promo_id`, `final_cost`, `payment_type`, `deposit_amoun`, `deposit_method`, `balans_after_deposit`, `next_payment_due`, `due_date1`, `final_payment_due`, `due_date2`, `client_notes`, `admin_notes`, `date_from`, `date_to`, `flight_total_cost`, `no_of_days`, `room_required`, `room_rate`, `status`) VALUES
(5, 1, 0, NULL, NULL, NULL, NULL, 2627.00, 0.00, NULL, 2627.00, 0, 525.40, 0, 2101.60, 1050.80, '2014-05-02', 1050.80, '2014-05-02', NULL, NULL, '2014-09-01', '2014-09-30', 0.00, 0, 1, 0.00, 1),
(6, 2, 0, NULL, NULL, NULL, NULL, 2.00, 0.00, NULL, 2.00, 1, 2.00, 0, 0.00, 0.00, '2014-05-02', 0.00, '2014-05-02', 'pain in my ass ', 'holy crap ', '2014-05-02', '2014-05-02', 0.00, 0, 1, 0.00, 1),
(7, 1, 0, NULL, NULL, NULL, NULL, 1162.00, 0.00, NULL, 1162.00, 1, 1162.00, 0, 0.00, 0.00, '2014-05-04', 0.00, '2014-05-04', '', '', '2014-09-01', '2014-09-30', 0.00, 0, 1, 0.00, 0),
(8, 2, 0, NULL, NULL, NULL, NULL, 3202.00, 0.00, NULL, 3202.00, 1, 3202.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-04-19', '2014-04-27', 0.00, 0, 1, 0.00, 1),
(9, 1, 0, NULL, NULL, NULL, NULL, 1267.00, 0.00, NULL, 1267.00, 0, 506.80, 0, 760.20, 0.00, '2014-05-06', 760.20, '2014-05-31', '', '', '2014-09-01', '2014-09-30', 0.00, 0, 1, 0.00, 1),
(10, 3, 0, NULL, NULL, NULL, NULL, 3905.00, 0.00, NULL, 3905.00, 1, 3905.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-05-31', '2014-06-20', 0.00, 0, 1, 0.00, 1),
(11, 2, 0, NULL, NULL, NULL, NULL, 3202.00, 0.00, NULL, 3202.00, 1, 3202.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-04-19', '2014-04-27', 0.00, 0, 1, 0.00, 1),
(12, 2, 0, NULL, NULL, NULL, NULL, 3202.00, 0.00, NULL, 3202.00, 1, 3202.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-04-19', '2014-04-27', 0.00, 0, 1, 0.00, 0),
(13, 2, 0, NULL, NULL, NULL, NULL, 3202.00, 0.00, NULL, 3202.00, 1, 3202.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-04-19', '2014-04-27', 0.00, 0, 1, 0.00, 0),
(14, 2, 0, NULL, NULL, NULL, NULL, 202.00, 0.00, NULL, 202.00, 1, 202.00, 0, 0.00, 0.00, '2014-05-06', 0.00, '2014-05-06', '', '', '2014-04-17', '2014-04-18', 0.00, 0, 1, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_cruise_cabin`
--

CREATE TABLE IF NOT EXISTS `reservation_cruise_cabin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cabin_id` int(11) unsigned NOT NULL,
  `reservation_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reservation_cruise_cabin_inventory_cruise_id` (`cabin_id`),
  KEY `FK_reservation_cruise_cabin_reservation_id` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reservation_cruise_cabin`
--

INSERT INTO `reservation_cruise_cabin` (`id`, `cabin_id`, `reservation_id`) VALUES
(1, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_event_room`
--

CREATE TABLE IF NOT EXISTS `reservation_event_room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_room_id` int(11) unsigned NOT NULL,
  `reservation_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reservation_event_room_inventory_event_id` (`event_room_id`),
  KEY `FK_reservation_event_room_reservation_id` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservation_event_room`
--

INSERT INTO `reservation_event_room` (`id`, `event_room_id`, `reservation_id`) VALUES
(1, 7, 11),
(2, 7, 12),
(3, 7, 13),
(4, 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_item`
--

CREATE TABLE IF NOT EXISTS `reservation_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) unsigned NOT NULL,
  `item_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reservation_item_inventory_item_id` (`item_id`),
  KEY `FK_reservation_item_reservation_id` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `reservation_item`
--

INSERT INTO `reservation_item` (`id`, `reservation_id`, `item_id`) VALUES
(5, 5, 8),
(6, 5, 17),
(7, 6, 8),
(8, 7, 8),
(9, 8, 8),
(10, 9, 8),
(11, 9, 17),
(12, 10, 17),
(13, 11, 8),
(14, 12, 8),
(15, 13, 8),
(16, 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_resort_room`
--

CREATE TABLE IF NOT EXISTS `reservation_resort_room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) unsigned NOT NULL,
  `reservation_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reservation_resort_room_inventory_hotels_id` (`room_id`),
  KEY `FK_reservation_resort_room_reservation_id` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reservation_resort_room`
--

INSERT INTO `reservation_resort_room` (`id`, `room_id`, `reservation_id`) VALUES
(1, 4, 5),
(2, 4, 7),
(3, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_travellers`
--

CREATE TABLE IF NOT EXISTS `reservation_travellers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `traveller_id` int(11) unsigned NOT NULL,
  `reservation_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reservation_travellers_reservation_id` (`reservation_id`),
  KEY `FK_reservation_travellers_travellers_id` (`traveller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2730 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `reservation_travellers`
--

INSERT INTO `reservation_travellers` (`id`, `traveller_id`, `reservation_id`) VALUES
(7, 57, 5),
(8, 58, 5),
(9, 61, 6),
(10, 62, 6),
(11, 64, 7),
(12, 65, 7),
(13, 66, 8),
(14, 67, 9),
(15, 68, 10),
(16, 69, 10),
(17, 70, 11),
(18, 71, 12),
(19, 72, 13),
(20, 73, 14);

-- --------------------------------------------------------

--
-- Table structure for table `resorts`
--

CREATE TABLE IF NOT EXISTS `resorts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `country_id` int(11) unsigned NOT NULL,
  `description` text,
  `is_active` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_resorts_countries_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `resorts`
--

INSERT INTO `resorts` (`id`, `name`, `country_id`, `description`, `is_active`) VALUES
(2, 'Test', 39, 'www', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resort_promo`
--

CREATE TABLE IF NOT EXISTS `resort_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `resort_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_resort_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1638 AUTO_INCREMENT=238 ;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `name`) VALUES
(125, 'users'),
(126, 'users-add'),
(127, 'users-edit'),
(128, 'users-delete'),
(129, 'profile'),
(130, 'profile-save'),
(131, 'login'),
(132, 'logout'),
(133, 'acl'),
(134, 'acl-add'),
(135, 'acl-edit'),
(136, 'acl-delete'),
(137, 'clients'),
(138, 'clients-add'),
(139, 'clients-edit'),
(140, 'clients-delete'),
(141, 'clients-item'),
(142, 'restore'),
(143, 'sendmail'),
(144, 'sendmail-add'),
(145, 'sendmail-edit'),
(146, 'sendmail-delete'),
(147, 'sendmail-item'),
(149, 'orders'),
(150, 'orders-add'),
(151, 'orders-edit'),
(152, 'orders-delete'),
(153, 'invoice'),
(154, 'invoice-add'),
(155, 'invoice-edit'),
(156, 'invoice-delete'),
(157, 'orders-ajax-cruises'),
(158, 'orders-ajax-events'),
(159, 'orders-ajax-resorts'),
(160, 'orders-ajax-resort-rooms'),
(161, 'orders-ajax-cruise-cabins'),
(162, 'orders-ajax-event-rooms'),
(163, 'orders-ajax-resort-room'),
(164, 'orders-ajax-cruise-cabin'),
(165, 'orders-ajax-event-room'),
(166, 'orders-ajax-items'),
(167, 'sales-objects'),
(168, 'hotels'),
(169, 'hotels-add'),
(170, 'hotels-edit'),
(171, 'hotels-delete'),
(172, 'rooms'),
(173, 'rooms-add'),
(174, 'rooms-edit'),
(175, 'rooms-delete'),
(176, 'cruises'),
(177, 'cruises-add'),
(178, 'cruises-edit'),
(179, 'cruises-delete'),
(180, 'cabins'),
(181, 'cabins-add'),
(182, 'cabins-edit'),
(183, 'cabins-delete'),
(184, 'ports'),
(185, 'ports-add'),
(186, 'ports-edit'),
(187, 'ports-delete'),
(188, 'itineraries'),
(189, 'itineraries-add'),
(190, 'itineraries-edit'),
(191, 'itineraries-delete'),
(192, 'events'),
(193, 'events-add'),
(194, 'events-edit'),
(195, 'events-delete'),
(196, 'ajax-resorts-item'),
(197, 'ajax-cruises-item'),
(198, 'resources'),
(199, 'imgupload'),
(200, 'inventory-resort-rooms'),
(201, 'inventory-resort-rooms-add'),
(202, 'inventory-resort-rooms-edit'),
(203, 'inventory-resort-rooms-delete'),
(204, 'inventory-event-rooms'),
(205, 'inventory-event-rooms-add'),
(206, 'inventory-event-rooms-edit'),
(207, 'inventory-event-rooms-delete'),
(208, 'inventory-cruise-cabins'),
(209, 'inventory-cruise-cabins-add'),
(210, 'inventory-cruise-cabins-edit'),
(211, 'inventory-cruise-cabins-delete'),
(212, 'inventory-transfers'),
(213, 'inventory-transfers-add'),
(214, 'inventory-transfers-edit'),
(215, 'inventory-transfers-delete'),
(216, 'inventory-excursions'),
(217, 'inventory-excursions-add'),
(218, 'inventory-excursions-edit'),
(219, 'inventory-excursions-delete'),
(220, 'inventory-items'),
(221, 'inventory-items-add'),
(222, 'inventory-items-edit'),
(223, 'inventory-items-delete'),
(224, 'inventory-promos'),
(225, 'inventory-promos-add'),
(226, 'inventory-promos-edit'),
(227, 'inventory-promos-delete'),
(228, 'inventory-ajax-cruise-cabins'),
(229, 'inventory-ajax-resort-rooms'),
(230, 'inventory-ajax-event-rooms'),
(231, 'inventory-ajax-cruises'),
(232, 'inventory-ajax-events'),
(233, 'inventory-ajax-resorts'),
(234, 'inventory-ajax-evevnt-categories'),
(235, 'inventory-ajax-promo-linkedto'),
(236, 'sendmail-foo'),
(237, 'orders-ajax');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - enable, 0 - disable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `is_active`) VALUES
(1, 'Administrator', 1),
(2, 'Guest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text,
  `resort_id` int(11) unsigned NOT NULL,
  `price` float(19,2) unsigned NOT NULL,
  `is_active` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_rooms_resorts_id` (`resort_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `resort_id`, `price`, `is_active`) VALUES
(1, 'Test Room', '', 2, 225.22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_promo`
--

CREATE TABLE IF NOT EXISTS `rooms_promo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rooms_promo_inventory_hotels_id` (`room_id`),
  KEY `FK_rooms_promo_inventory_promo_id` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rooms_promo`
--

INSERT INTO `rooms_promo` (`id`, `promo_id`, `room_id`) VALUES
(5, 31, 4),
(6, 33, 4),
(7, 33, 5);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `code` varchar(4) CHARACTER SET utf8 NOT NULL,
  `country_id` int(11) unsigned NOT NULL,
  `search_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_country to state` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AVG_ROW_LENGTH=172 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `code`, `country_id`, `search_name`) VALUES
(1, 'Alabama', 'AL', 227, 'alabama'),
(2, 'Alaska', 'AK', 227, 'alaska'),
(3, 'Arizona', 'AZ', 227, 'arizona'),
(4, 'Arkansas', 'AR', 227, 'arkansas'),
(5, 'California', 'CA', 227, 'california'),
(6, 'Colorado', 'CO', 227, 'colorado'),
(7, 'Connecticut', 'CT', 227, 'connecticut'),
(8, 'Delaware', 'DE', 227, 'delaware'),
(9, 'Florida', 'FL', 227, 'florida'),
(10, 'Georgia', 'GA', 227, 'georgia'),
(11, 'Hawaii', 'HI', 227, 'hawaii'),
(12, 'Idaho', 'ID', 227, 'idaho'),
(13, 'Illinois', 'IL', 227, 'illinois'),
(14, 'Indiana', 'IN', 227, 'indiana'),
(15, 'Iowa', 'IA', 227, 'iowa'),
(16, 'Kansas', 'KS', 227, 'kansas'),
(17, 'Kentucky', 'KY', 227, 'kentucky'),
(18, 'Louisiana', 'LA', 227, 'louisiana'),
(19, 'Maine', 'ME', 227, 'maine'),
(20, 'Maryland', 'MD', 227, 'maryland'),
(21, 'Massachusetts', 'MA', 227, 'massachusetts'),
(22, 'Michigan', 'MI', 227, 'michigan'),
(23, 'Minnesota', 'MN', 227, 'minnesota'),
(24, 'Mississippi', 'MS', 227, 'mississippi'),
(25, 'Missouri', 'MO', 227, 'missouri'),
(26, 'Montana', 'MT', 227, 'montana'),
(27, 'Nebraska', 'NE', 227, 'nebraska'),
(28, 'Nevada', 'NV', 227, 'nevada'),
(29, 'New Hampshire', 'NH', 227, 'newhampshire'),
(30, 'New Jersey', 'NJ', 227, 'newjersey'),
(31, 'New Mexico', 'NM', 227, 'newmexico'),
(32, 'New York', 'NY', 227, 'newyork'),
(33, 'North Carolina', 'NC', 227, 'northcarolina'),
(34, 'North Dakota', 'ND', 227, 'northdakota'),
(35, 'Ohio', 'OH', 227, 'ohio'),
(36, 'Oklahoma', 'OK', 227, 'oklahoma'),
(37, 'Oregon', 'OR', 227, 'oregon'),
(38, 'Pennsylvania', 'PA', 227, 'pennsylvania'),
(39, 'Rhode Island', 'RI', 227, 'rhodeisland'),
(40, 'South Carolina', 'SC', 227, 'southcarolina'),
(41, 'South Dakota', 'SD', 227, 'southdakota'),
(42, 'Tennessee', 'TN', 227, 'tennessee'),
(43, 'Texas', 'TX', 227, 'texas'),
(44, 'Utah', 'UT', 227, 'utah'),
(45, 'Vermont', 'VT', 227, 'vermont'),
(46, 'Virginia', 'VA', 227, 'virginia'),
(47, 'Washington', 'WA', 227, 'washington'),
(48, 'Washington, D.C.', 'DC', 227, 'washingtondc'),
(49, 'West Virginia', 'WV', 227, 'westvirginia'),
(50, 'Wisconsin', 'WI', 227, 'wisconsin'),
(51, 'Wyoming', 'WY', 227, 'wyoming'),
(53, 'Alberta', 'AB', 39, 'alberta'),
(54, 'British Columbia', 'BC', 39, 'britishcolumbia'),
(55, 'New Brunswick', 'NB', 39, 'newbrunswick'),
(56, 'Newfoundland', 'NF', 39, 'newfoundland'),
(57, 'Nova Scotia', 'NS', 39, 'novascotia'),
(58, 'Manitoba', 'MB', 39, 'manitoba'),
(59, 'Northwest Territories', 'NT', 39, 'northwestterritories'),
(60, 'Nunavut', 'NU', 39, 'nunavut'),
(61, 'Ontario', 'ON', 39, 'ontario'),
(62, 'Prince Edward Island', 'PE', 39, 'princeedwardisland'),
(63, 'Quebec', 'QC', 39, 'quebec'),
(64, 'Saskatchewan', 'SK', 39, 'saskatchewan'),
(65, 'Yukon Territory', 'YT', 39, 'yukonterritory'),
(69, 'Aguascalientes', 'AGU', 139, 'aguascalientes'),
(70, 'Baja California', 'BCN', 139, 'bajacalifornia'),
(71, 'Baja California Sur', 'BCS', 139, 'bajacaliforniasur'),
(72, 'Campeche', 'CAM', 139, 'campeche'),
(73, 'Chiapas', 'CHP', 139, 'chiapas'),
(74, 'Chihuahua', 'CHH', 139, 'chihuahua'),
(75, 'Coahuila', 'COA', 139, 'coahuila'),
(76, 'Colima', 'COL', 139, 'colima'),
(77, 'Durango', 'DUR', 139, 'durango'),
(78, 'Guanajuato', 'GUA', 139, 'guanajuato'),
(79, 'Guerrero', 'GRO', 139, 'guerrero'),
(80, 'Hidalgo', 'HID', 139, 'hidalgo'),
(81, 'Jalisco', 'JAL', 139, 'jalisco'),
(82, 'Mexico State', 'MEX', 139, 'mexicostate'),
(83, 'MichoacГЎn', 'MIC', 139, 'michoacan'),
(84, 'Morelos', 'MOR', 139, 'morelos'),
(85, 'Nayarit', 'NAY', 139, 'nayarit'),
(86, 'Nuevo LeГіn', 'NLE', 139, 'nuevoleon'),
(87, 'Oaxaca', 'OAX', 139, 'oaxaca'),
(88, 'Puebla', 'PUE', 139, 'puebla'),
(89, 'QuerГ©taro', 'QUE', 139, 'queretaro'),
(90, 'Quintana Roo', 'ROO', 139, 'quintanaroo'),
(91, 'San Luis PotosГ­', 'SLP', 139, 'sanluispotosi'),
(92, 'Sinaloa', 'SIN', 139, 'sinaloa'),
(94, 'Sonora', 'SON', 139, 'sonora'),
(95, 'Tabasco', 'TAB', 139, 'tabasco'),
(96, 'Tamaulipas', 'TAM', 139, 'tamaulipas'),
(97, 'Tlaxcala', 'TLA', 139, 'tlaxcala'),
(98, 'Veracruz', 'VER', 139, 'veracruz'),
(99, 'YucatГЎn', 'YUC', 139, 'yucatan'),
(100, 'Zacatecas', 'ZAC', 139, 'zacatecas');

-- --------------------------------------------------------

--
-- Table structure for table `travellers`
--

CREATE TABLE IF NOT EXISTS `travellers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `zip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=252 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `travellers`
--

INSERT INTO `travellers` (`id`, `name`, `dob`, `phone`, `email`, `address`, `city`, `state`, `country`, `zip`) VALUES
(1, 'Josh Alen', NULL, '3352225222', 'josh@alen.com', 'Test str', 'city', 'State ', 'AFGHANISTAN', '3352'),
(2, 'Josh Alen', NULL, '33522', 'ghh@alen.com', 'qqq', 'www', 'eeee', 'AFGHANISTAN', '2121212'),
(3, 'Josh Alen', NULL, '33522', 'ghh@alen.com', 'qqq', 'www', 'eeee', 'AFGHANISTAN', '2121212'),
(4, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(5, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(6, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(7, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(8, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(9, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(10, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(11, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(12, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(13, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(14, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(15, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(16, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(17, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(18, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(19, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(20, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(21, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(22, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(23, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(24, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(25, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(26, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(27, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(28, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(29, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(30, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(31, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(32, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(33, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(34, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(35, 'asdas', NULL, 'asdasd', 'dasdasd@das.com', 'asdasd', 'asdasd', 'asdasd', 'AALAND ISLANDS', 'asdasdasd'),
(36, 'asdasd', '2014-05-02', '', '', NULL, NULL, NULL, NULL, NULL),
(37, 'asdasdsa', NULL, '231321', 'asdasdasd@das.com', 'asdas', 'dasdad', 'asdasda', 'AALAND ISLANDS', 'asdasdasd'),
(38, 'asdasda', '2014-05-15', '', '', NULL, NULL, NULL, NULL, NULL),
(39, 'asdasdsa', NULL, '231321', 'asdasdasd@das.com', 'asdas', 'dasdad', 'asdasda', 'AALAND ISLANDS', 'asdasdasd'),
(40, 'asdasda', '2014-05-15', '', '', NULL, NULL, NULL, NULL, NULL),
(41, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(42, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(43, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(44, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(45, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(46, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(47, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(48, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(49, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(50, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(51, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(52, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(53, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(54, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(55, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(56, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(57, 'Josh Alen', NULL, '3332255', 'josh@alen.com', 'Test str', 'tessd', 'asdasd', 'AFGHANISTAN', '211212'),
(58, 'Mari Alen', '2014-05-14', '', 'malen@fff.com', NULL, NULL, NULL, NULL, NULL),
(59, 'Sarge Rhoden', NULL, '416 400 4575', 'sarge.rhoden@gmail.com', '123 Lane', 'Toronto', 'Ontatio', 'CANADA', 'l1b1c1'),
(60, 'Ladydee Rhoden', '2014-05-02', '', '', NULL, NULL, NULL, NULL, NULL),
(61, 'darlene harding ', NULL, '4163991212 ', 'darlene@darleneharding.com', '123 main st ', 'bramoton', 'on', 'CANADA', 'l5r2k4 '),
(62, 'sarge rhoden', '2014-05-02', '', '', NULL, NULL, NULL, NULL, NULL),
(63, 'Paul Testicles', NULL, '603-662-4971', 'rick@buzzinkshop.com', '54 Main Street', 'Concord', 'NH', 'UNITED STATES', '03307'),
(64, 'test', NULL, '', 'admin@gmail.com', '', '', '', 'AZERBAIJAN', ''),
(65, 'test2', '2014-05-06', '', 'test2@mail.ru', NULL, NULL, NULL, NULL, NULL),
(66, 'Traveller 1', NULL, '', 'traveller@gmail.com', '', '', '', 'ALBANIA', 'code1'),
(67, 'Traveller Resort', NULL, '', 'traveller-resort@gmail.com', '', '', '', 'ALGERIA', ''),
(68, 'Traveller Cruise', NULL, '', 'traveller-cruise@gmail.com', '', '', '', 'ALBANIA', ''),
(69, 'Traveller Cruise 2', '1977-05-04', '', '', NULL, NULL, NULL, NULL, NULL),
(70, 'Traveller Event 2', NULL, '', 'traveller-2@gmail.com', '', '', '', 'ALBANIA', ''),
(71, 'Traveller Event 2', NULL, '', 'traveller-2@gmail.com', '', '', '', 'ALBANIA', ''),
(72, 'Traveller Event 2', NULL, '', 'traveller-2@gmail.com', '', '', '', 'ALBANIA', ''),
(73, 'John Smith', NULL, '', 'john-smith-1@gmail.com', '', '', '', 'BARBADOS', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `address` text,
  `role_id` int(11) unsigned DEFAULT NULL,
  `is_active` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0 - disable, 1 -  enable',
  PRIMARY KEY (`id`),
  KEY `FK_users_role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `first_name`, `last_name`, `phone`, `address`, `role_id`, `is_active`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webcodekeeper@gmail.com', 'Pavel', 'Usachev', '12123123123', '', 1, 1),
(2, 'guest', '084e0343a0486ff05530df6c705c8bb4', 'webcodekeeper@hotmail.com', 'Guest', 'Guest', '380930604821', NULL, 2, 1),
(3, 'John', 'e10adc3949ba59abbe56e057f20f883e', 'webcodekeeper@gmail.com', 'Joch', 'Smith', '1234567889', 'test str', 1, 1),
(4, 'asdadasdadasd', 'd41d8cd98f00b204e9800998ecf8427e', 'aewdasdasD@sadhvhamsdh.com', '', '', '', '', 2, 1),
(7, 'ilmor', 'fa6b17b00c1cafc9857c4e9e57839f99', 'tavai89@gmail.com', 'Taras', 'Ilyin', '380999031920', 'asdads', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amount_due`
--
ALTER TABLE `amount_due`
  ADD CONSTRAINT `FK_amount_due_orders_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cabins`
--
ALTER TABLE `cabins`
  ADD CONSTRAINT `FK_cabins_cruises_id` FOREIGN KEY (`cruise_id`) REFERENCES `cruises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cabins_promo`
--
ALTER TABLE `cabins_promo`
  ADD CONSTRAINT `FK_cabins_promo_inventory_cruise_id` FOREIGN KEY (`cabin_id`) REFERENCES `inventory_cruise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cabins_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_clients_countries_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD CONSTRAINT `FK_credit_cards_clients_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cruises`
--
ALTER TABLE `cruises`
  ADD CONSTRAINT `FK_cruises_countries_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cruise_promo`
--
ALTER TABLE `cruise_promo`
  ADD CONSTRAINT `FK_cruise_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events_promo`
--
ALTER TABLE `events_promo`
  ADD CONSTRAINT `FK_events_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_category_promo`
--
ALTER TABLE `event_category_promo`
  ADD CONSTRAINT `FK_event_category_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_rooms_promo`
--
ALTER TABLE `event_rooms_promo`
  ADD CONSTRAINT `FK_event_rooms_promo_inventory_event_id` FOREIGN KEY (`event_room_id`) REFERENCES `inventory_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_event_rooms_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_cruise`
--
ALTER TABLE `inventory_cruise`
  ADD CONSTRAINT `FK_inventory_cruise_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `inventory_event`
--
ALTER TABLE `inventory_event`
  ADD CONSTRAINT `FK_inventory_event_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `inventory_hotels`
--
ALTER TABLE `inventory_hotels`
  ADD CONSTRAINT `FK_inventory_hotels_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `FK_itinerary_cruises_id` FOREIGN KEY (`cruise_id`) REFERENCES `cruises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passanger_details`
--
ALTER TABLE `passanger_details`
  ADD CONSTRAINT `FK_passanger_details_orders_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `FK_permissions_resource_id` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_permissions_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `FK_ports_cruises_id` FOREIGN KEY (`cruise_id`) REFERENCES `cruises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_reservation_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_cruise_cabin`
--
ALTER TABLE `reservation_cruise_cabin`
  ADD CONSTRAINT `FK_reservation_cruise_cabin_inventory_cruise_id` FOREIGN KEY (`cabin_id`) REFERENCES `inventory_cruise` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_reservation_cruise_cabin_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_event_room`
--
ALTER TABLE `reservation_event_room`
  ADD CONSTRAINT `FK_reservation_event_room_inventory_event_id` FOREIGN KEY (`event_room_id`) REFERENCES `inventory_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reservation_event_room_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_item`
--
ALTER TABLE `reservation_item`
  ADD CONSTRAINT `FK_reservation_item_inventory_item_id` FOREIGN KEY (`item_id`) REFERENCES `inventory_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reservation_item_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_resort_room`
--
ALTER TABLE `reservation_resort_room`
  ADD CONSTRAINT `FK_reservation_resort_room_inventory_hotels_id` FOREIGN KEY (`room_id`) REFERENCES `inventory_hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reservation_resort_room_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_travellers`
--
ALTER TABLE `reservation_travellers`
  ADD CONSTRAINT `FK_reservation_travellers_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reservation_travellers_travellers_id` FOREIGN KEY (`traveller_id`) REFERENCES `travellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resorts`
--
ALTER TABLE `resorts`
  ADD CONSTRAINT `FK_resorts_countries_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resort_promo`
--
ALTER TABLE `resort_promo`
  ADD CONSTRAINT `FK_resort_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `FK_rooms_resorts_id` FOREIGN KEY (`resort_id`) REFERENCES `resorts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms_promo`
--
ALTER TABLE `rooms_promo`
  ADD CONSTRAINT `FK_rooms_promo_inventory_hotels_id` FOREIGN KEY (`room_id`) REFERENCES `inventory_hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rooms_promo_inventory_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `inventory_promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
