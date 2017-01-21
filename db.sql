-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2016 at 05:45 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cheapfli_transport_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `Name` varchar(70) DEFAULT NULL,
  `Code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`Name`, `Code`) VALUES
('Afghanistan', 'AF'),
('Aland Islands', 'AX'),
('Albania', 'AL'),
('Algeria', 'DZ'),
('American Samoa', 'AS'),
('Andorra', 'AD'),
('Angola', 'AO'),
('Anguilla', 'AI'),
('Antarctica', 'AQ'),
('Antigua and Barbuda', 'AG'),
('Argentina', 'AR'),
('Armenia', 'AM'),
('Aruba', 'AW'),
('Australia', 'AU'),
('Austria', 'AT'),
('Azerbaijan', 'AZ'),
('Bahamas', 'BS'),
('Bahrain', 'BH'),
('Bangladesh', 'BD'),
('Barbados', 'BB'),
('Belarus', 'BY'),
('Belgium', 'BE'),
('Belize', 'BZ'),
('Benin', 'BJ'),
('Bermuda', 'BM'),
('Bhutan', 'BT'),
('Bolivia, Plurinational State of', 'BO'),
('Bonaire, Sint Eustatius and Saba', 'BQ'),
('Bosnia and Herzegovina', 'BA'),
('Botswana', 'BW'),
('Bouvet Island', 'BV'),
('Brazil', 'BR'),
('British Indian Ocean Territory', 'IO'),
('Brunei Darussalam', 'BN'),
('Bulgaria', 'BG'),
('Burkina Faso', 'BF'),
('Burundi', 'BI'),
('Cambodia', 'KH'),
('Cameroon', 'CM'),
('Canada', 'CA'),
('Cape Verde', 'CV'),
('Cayman Islands', 'KY'),
('Central African Republic', 'CF'),
('Chad', 'TD'),
('Chile', 'CL'),
('China', 'CN'),
('Christmas Island', 'CX'),
('Cocos (Keeling) Islands', 'CC'),
('Colombia', 'CO'),
('Comoros', 'KM'),
('Congo', 'CG'),
('Congo, the Democratic Republic of the', 'CD'),
('Cook Islands', 'CK'),
('Costa Rica', 'CR'),
('Cote d''Ivoire', 'CI'),
('Croatia', 'HR'),
('Cuba', 'CU'),
('Curacao', 'CW'),
('Cyprus', 'CY'),
('Czech Republic', 'CZ'),
('Denmark', 'DK'),
('Djibouti', 'DJ'),
('Dominica', 'DM'),
('Dominican Republic', 'DO'),
('Ecuador', 'EC'),
('Egypt', 'EG'),
('El Salvador', 'SV'),
('Equatorial Guinea', 'GQ'),
('Eritrea', 'ER'),
('Estonia', 'EE'),
('Ethiopia', 'ET'),
('Falkland Islands (Malvinas)', 'FK'),
('Faroe Islands', 'FO'),
('Fiji', 'FJ'),
('Finland', 'FI'),
('France', 'FR'),
('French Guiana', 'GF'),
('French Polynesia', 'PF'),
('French Southern Territories', 'TF'),
('Gabon', 'GA'),
('Gambia', 'GM'),
('Georgia', 'GE'),
('Germany', 'DE'),
('Ghana', 'GH'),
('Gibraltar', 'GI'),
('Greece', 'GR'),
('Greenland', 'GL'),
('Grenada', 'GD'),
('Guadeloupe', 'GP'),
('Guam', 'GU'),
('Guatemala', 'GT'),
('Guernsey', 'GG'),
('Guinea', 'GN'),
('Guinea-Bissau', 'GW'),
('Guyana', 'GY'),
('Haiti', 'HT'),
('Heard Island and McDonald Islands', 'HM'),
('Holy See (Vatican City State)', 'VA'),
('Honduras', 'HN'),
('Hong Kong', 'HK'),
('Hungary', 'HU'),
('Iceland', 'IS'),
('India', 'IN'),
('Indonesia', 'ID'),
('Iran, Islamic Republic of', 'IR'),
('Iraq', 'IQ'),
('Ireland', 'IE'),
('Isle of Man', 'IM'),
('Israel', 'IL'),
('Italy', 'IT'),
('Jamaica', 'JM'),
('Japan', 'JP'),
('Jersey', 'JE'),
('Jordan', 'JO'),
('Kazakhstan', 'KZ'),
('Kenya', 'KE'),
('Kiribati', 'KI'),
('Korea, Democratic People''s Republic of', 'KP'),
('Korea, Republic of', 'KR'),
('Kuwait', 'KW'),
('Kyrgyzstan', 'KG'),
('Lao People''s Democratic Republic', 'LA'),
('Latvia', 'LV'),
('Lebanon', 'LB'),
('Lesotho', 'LS'),
('Liberia', 'LR'),
('Libya', 'LY'),
('Liechtenstein', 'LI'),
('Lithuania', 'LT'),
('Luxembourg', 'LU'),
('Macao', 'MO'),
('Macedonia, the Former Yugoslav Republic of', 'MK'),
('Madagascar', 'MG'),
('Malawi', 'MW'),
('Malaysia', 'MY'),
('Maldives', 'MV'),
('Mali', 'ML'),
('Malta', 'MT'),
('Marshall Islands', 'MH'),
('Martinique', 'MQ'),
('Mauritania', 'MR'),
('Mauritius', 'MU'),
('Mayotte', 'YT'),
('Mexico', 'MX'),
('Micronesia, Federated States of', 'FM'),
('Moldova, Republic of', 'MD'),
('Monaco', 'MC'),
('Mongolia', 'MN'),
('Montenegro', 'ME'),
('Montserrat', 'MS'),
('Morocco', 'MA'),
('Mozambique', 'MZ'),
('Myanmar', 'MM'),
('Namibia', 'NA'),
('Nauru', 'NR'),
('Nepal', 'NP'),
('Netherlands', 'NL'),
('New Caledonia', 'NC'),
('New Zealand', 'NZ'),
('Nicaragua', 'NI'),
('Niger', 'NE'),
('Nigeria', 'NG'),
('Niue', 'NU'),
('Norfolk Island', 'NF'),
('Northern Mariana Islands', 'MP'),
('Norway', 'NO'),
('Oman', 'OM'),
('Pakistan', 'PK'),
('Palau', 'PW'),
('Palestine, State of', 'PS'),
('Panama', 'PA'),
('Papua New Guinea', 'PG'),
('Paraguay', 'PY'),
('Peru', 'PE'),
('Philippines', 'PH'),
('Pitcairn', 'PN'),
('Poland', 'PL'),
('Portugal', 'PT'),
('Puerto Rico', 'PR'),
('Qatar', 'QA'),
('Reunion', 'RE'),
('Romania', 'RO'),
('Russian Federation', 'RU'),
('Rwanda', 'RW'),
('Saint Barthelemy', 'BL'),
('Saint Helena, Ascension and Tristan da Cunha', 'SH'),
('Saint Kitts and Nevis', 'KN'),
('Saint Lucia', 'LC'),
('Saint Martin (French part)', 'MF'),
('Saint Pierre and Miquelon', 'PM'),
('Saint Vincent and the Grenadines', 'VC'),
('Samoa', 'WS'),
('San Marino', 'SM'),
('Sao Tome and Principe', 'ST'),
('Saudi Arabia', 'SA'),
('Senegal', 'SN'),
('Serbia', 'RS'),
('Seychelles', 'SC'),
('Sierra Leone', 'SL'),
('Singapore', 'SG'),
('Sint Maarten (Dutch part)', 'SX'),
('Slovakia', 'SK'),
('Slovenia', 'SI'),
('Solomon Islands', 'SB'),
('Somalia', 'SO'),
('South Africa', 'ZA'),
('South Georgia and the South Sandwich Islands', 'GS'),
('South Sudan', 'SS'),
('Spain', 'ES'),
('Sri Lanka', 'LK'),
('Sudan', 'SD'),
('Suriname', 'SR'),
('Svalbard and Jan Mayen', 'SJ'),
('Swaziland', 'SZ'),
('Sweden', 'SE'),
('Switzerland', 'CH'),
('Syrian Arab Republic', 'SY'),
('Taiwan, Province of China', 'TW'),
('Tajikistan', 'TJ'),
('Tanzania, United Republic of', 'TZ'),
('Thailand', 'TH'),
('Timor-Leste', 'TL'),
('Togo', 'TG'),
('Tokelau', 'TK'),
('Tonga', 'TO'),
('Trinidad and Tobago', 'TT'),
('Tunisia', 'TN'),
('Turkey', 'TR'),
('Turkmenistan', 'TM'),
('Turks and Caicos Islands', 'TC'),
('Tuvalu', 'TV'),
('Uganda', 'UG'),
('Ukraine', 'UA'),
('United Arab Emirates', 'AE'),
('United Kingdom', 'GB'),
('United States', 'US'),
('United States Minor Outlying Islands', 'UM'),
('Uruguay', 'UY'),
('Uzbekistan', 'UZ'),
('Vanuatu', 'VU'),
('Venezuela, Bolivarian Republic of', 'VE'),
('Viet Nam', 'VN'),
('Virgin Islands, British', 'VG'),
('Virgin Islands, U.S.', 'VI'),
('Wallis and Futuna', 'WF'),
('Western Sahara', 'EH'),
('Yemen', 'YE'),
('Zambia', 'ZM'),
('Zimbabwe', 'ZW'),
('', '');

-- --------------------------------------------------------

--
-- Table structure for table `Lookups`
--

CREATE TABLE `Lookups` (
  `ID` int(11) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `SubType` varchar(50) DEFAULT NULL,
  `Value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Lookups`
--

INSERT INTO `Lookups` (`ID`, `Type`, `SubType`, `Value`) VALUES
(1, 'Transport Type', NULL, 'Airplane'),
(2, 'Transport Type', NULL, 'Truck'),
(3, 'Transport Type', NULL, 'Bakkie'),
(4, 'Transport Type', NULL, 'Motor Bike'),
(5, 'Transport Type', NULL, 'Car'),
(6, 'Transport Type', NULL, 'Mini Bus'),
(7, 'Transport Type', NULL, 'Bus'),
(8, 'Transport Type', NULL, 'Bicycle'),
(9, 'Transport Type', NULL, 'Van'),
(10, 'Transport Type', NULL, 'Ship'),
(11, 'Transport Type', NULL, 'Boat'),
(12, 'Transport Type', NULL, 'Fairy'),
(13, 'User Type', NULL, 'Ride Finders'),
(14, 'User Type', NULL, 'Ride Offerors'),
(15, 'User Type', NULL, 'Both'),
(16, 'Transport Type Combo', 'Air', 'Airplane, Train, Truck, Bakkie or Van'),
(17, 'Transport Type Combo', 'Ship', 'Ship, Train, Truck, Bakkie Or Van'),
(18, 'Transport Type Combo', 'Fairy', 'Fairy, Train, Truck, Bakkie Or Van'),
(19, 'Who Does The Driving', NULL, 'We Drive'),
(20, 'Who Does The Driving', NULL, 'You Drive'),
(21, 'Who Does The Driving', '', 'You Decide'),
(22, 'SendType', NULL, 'Send'),
(23, 'SendType', NULL, 'Receive');

-- --------------------------------------------------------

--
-- Table structure for table `OfferAShipment`
--

CREATE TABLE `OfferAShipment` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `BiddingEndDate` datetime DEFAULT NULL,
  `PickUpPoint` varchar(500) DEFAULT NULL,
  `PickUpLatitude` float(10,6) DEFAULT NULL,
  `PickUpLongitude` float(10,6) DEFAULT NULL,
  `PickUpDate` datetime DEFAULT NULL,
  `PickUpDateFlexibleByXDays` int(11) NOT NULL,
  `DropOffPoint` varchar(500) DEFAULT NULL,
  `DropOffLatitude` float(10,6) DEFAULT NULL,
  `DropOffLongitude` float(10,6) DEFAULT NULL,
  `DropOffDate` datetime DEFAULT NULL,
  `DropOffDateFlexibleByXDays` int(11) NOT NULL,
  `Directions` varchar(1000) NOT NULL,
  `Distance` varchar(50) NOT NULL,
  `DurationOfTrip` varchar(50) NOT NULL,
  `TransportWhat` varchar(500) DEFAULT NULL,
  `TransportOfWhatPicture` varchar(350) DEFAULT NULL,
  `TypeOfTransport` varchar(50) DEFAULT NULL,
  `Tons` decimal(30,2) DEFAULT NULL,
  `CubicMeters` decimal(30,2) DEFAULT NULL,
  `AwardBidTo` varchar(50) DEFAULT NULL,
  `AwardBidAmount` decimal(16,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OfferAShipment`
--

INSERT INTO `OfferAShipment` (`id`, `Username`, `BiddingEndDate`, `PickUpPoint`, `PickUpLatitude`, `PickUpLongitude`, `PickUpDate`, `PickUpDateFlexibleByXDays`, `DropOffPoint`, `DropOffLatitude`, `DropOffLongitude`, `DropOffDate`, `DropOffDateFlexibleByXDays`, `Directions`, `Distance`, `DurationOfTrip`, `TransportWhat`, `TransportOfWhatPicture`, `TypeOfTransport`, `Tons`, `CubicMeters`, `AwardBidTo`, `AwardBidAmount`) VALUES
(97, 'admin', '2016-03-03 00:00:00', 'Gauteng, South Africa', -26.270760, 28.112268, '2015-12-10 00:00:00', 0, 'Harare, Zimbabwe', -17.825167, 31.033510, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Gauteng++South+Africa/Harare++Zimbabwe', '1,129 km', '13 hours 7 mins', 'Testing Food', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(98, 'admin', '2016-03-03 00:00:00', 'Gauteng, Vereeniging, South Africa', -26.596931, 27.901464, '2015-12-10 00:00:00', 0, 'Gauteng, Sandton, South Africa', -26.107567, 28.056702, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Gauteng++Vereeniging++South+Africa/Gauteng++Sandton++South+Africa', '70.9 km', '1 hour 5 mins', 'Testing Car Tires', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(99, 'admin', '2016-03-03 00:00:00', 'Cape Town, South Africa', -33.924870, 18.424055, '2015-12-10 00:00:00', 0, 'Karoo, South Africa', -32.581921, 25.147530, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Cape+Town++South+Africa/Karoo++South+Africa', '738 km', '7 hours 17 mins', 'Containers', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(100, 'admin', '2016-03-03 00:00:00', 'Sasolburg, South Africa', -26.810190, 27.827724, '2015-12-10 00:00:00', 0, 'Cape Town, South Africa', -33.924870, 18.424055, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Sasolburg++South+Africa/Cape+Town++South+Africa', '1,333 km', '12 hours 43 mins', 'Testing Balls', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(101, 'admin', '2016-03-03 00:00:00', 'Tigerburg, South Africa', -33.849998, 18.583332, '2015-12-10 00:00:00', 0, 'Durban, South Africa', -29.858681, 31.021839, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Tigerburg++South+Africa/Durban++South+Africa', '1,624 km', '15 hours 37 mins', 'Testing Shoes', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(102, 'admin', '2016-03-03 00:00:00', 'Sasolburg,  South Africa', -26.810190, 27.827724, '2015-12-10 00:00:00', 0, 'Karoo, South Africa', -32.581921, 25.147530, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Sasolburg+++South+Africa/Karoo++South+Africa', '835 km', '8 hours 1 min', 'Testing Popcorn', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(103, 'admin', '2016-03-03 00:00:00', 'Cape Town, South Africa', -33.924870, 18.424055, '2015-12-10 00:00:00', 0, 'Gauteng, South Africa', -26.270760, 28.112268, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Cape+Town++South+Africa/Gauteng++South+Africa', '1,404 km', '13 hours 13 mins', 'Testing Containers', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(104, 'admin', '2016-03-03 00:00:00', 'Gauteng, South Africa', -26.270760, 28.112268, '2015-12-10 00:00:00', 0, 'Durban, South Africa', -29.858681, 31.021839, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Gauteng++South+Africa/Durban++South+Africa', '555 km', '5 hours 24 mins', 'Testing Books', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(105, 'admin', '0000-00-00 00:00:00', '1 Strand Street\r\nCape Town\r\n\r\nSouth Africa\r\nAfrica', -33.920551, 18.421015, '0000-00-00 00:00:00', 0, 'Paio Pires\r\n\r\nPortugal', 38.626690, -9.081355, '0000-00-00 00:00:00', 0, 'http://www.google.com/maps/dir/1+Strand+Street++Cape+Town++++South+Africa++Africa/Paio+Pires++++Portugal', '12,936 km', '7 days 8 hours', '', '', '', '0.00', '0.00', NULL, NULL),
(106, 'admin', '2016-01-21 00:00:00', '2 Strand Street\r\n\r\nCape Town\r\n\r\n\r\nSouth Africa', -33.920551, 18.421013, '2016-01-22 00:00:00', 2, '2 Strand Street\r\n\r\nCape Town\r\n\r\n\r\nSouth Afica', -33.920551, 18.421013, '2016-01-23 00:00:00', 3, 'http://www.google.com/maps/dir/2+Strand+Street++++Cape+Town++++++South+Africa/2+Strand+Street++++Cape+Town++++++South+Afica', '1 m', '1 min', 'Popcorn', '', 'Car', '4.00', '5.00', NULL, NULL),
(107, 'admin', '2016-03-03 00:00:00', 'Guateng, South Africa', -26.270760, 28.112268, '2015-12-10 00:00:00', 0, 'Cape Town,  South Africa', -33.924870, 18.424055, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Guateng++South+Africa/Cape+Town+++South+Africa', '1,403 km', '13 hours 20 mins', 'testing baby cots', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(108, 'admin', '2016-03-03 00:00:00', 'Johannesburg, Gauteng, South Africa', -26.204103, 28.047304, '2015-12-10 00:00:00', 0, 'Cape Town, Western Cape, South Africa', -33.924870, 18.424055, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Johannesburg++Gauteng++South+Africa/Cape+Town++Western+Cape++South+Africa', '1,398 km', '13 hours 20 mins', 'Testing Mail', '', 'Testing Airoplane', '0.00', '0.00', NULL, NULL),
(109, 'admin', '2016-03-03 00:00:00', 'Three Sisters, South Africa', -31.887190, 23.088230, '2015-12-10 00:00:00', 0, 'Gordons Bay, South Africa', -34.151466, 18.872972, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Three+Sisters++South+Africa/Gordons+Bay++South+Africa', '537 km', '5 hours 38 mins', 'Testing Pies', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(110, 'admin', '2016-03-03 00:00:00', 'Vanderbijlpark, Gauteng, South Africa', -26.703421, 27.807695, '2015-12-10 00:00:00', 0, 'Harare, Zimbabwe', -17.825167, 31.033510, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Vanderbijlpark++Gauteng++South+Africa/Harare++Zimbabwe', '1,195 km', '13 hours 42 mins', 'Testing People', '', 'Testing Buss', '0.00', '0.00', NULL, NULL),
(111, 'admin', '2016-03-03 00:00:00', 'Stellenbosch, South AFrica', -33.932106, 18.860151, '2015-12-10 00:00:00', 0, 'Pretoria, Gauteng, South Africa', -25.747868, 28.229271, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Stellenbosch++South+AFrica/Pretoria++Gauteng++South+Africa', '1,438 km', '13 hours 34 mins', 'Students', '', 'Testing Bus', '0.00', '0.00', NULL, NULL),
(112, 'admin', '2016-03-03 00:00:00', 'Klien Karoo, South Africa', -33.578903, 22.197994, '2015-12-10 00:00:00', 0, 'Gauteng, South Africa', -26.270760, 28.112268, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Klien+Karoo++South+Africa/Gauteng++South+Africa', '1,125 km', '10 hours 30 mins', 'Testing Sheep', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(113, 'admin', '2016-03-03 00:00:00', 'Randfontien, South Africa', -26.199150, 27.678684, '2015-12-10 00:00:00', 0, 'Krugers Dorp, South Africa', -26.096321, 27.807695, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Randfontien++South+Africa/Krugers+Dorp++South+Africa', '19.2 km', '27 mins', 'Testing Mielies', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(114, 'admin', '2016-03-03 00:00:00', 'Poland\r\nWarsaw', 52.229675, 21.012230, '2015-12-10 00:00:00', 0, 'Germany\r\nBerlin', 52.520008, 13.404954, '2015-12-10 00:00:00', 0, 'http://www.google.com/maps/dir/Poland++Warsaw/Germany++Berlin', '572 km', '5 hours 19 mins', 'Testing Potatoes', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(127, 'admin', '2016-03-03 00:00:00', 'Durban, South Africa', -29.858681, 31.021839, '2015-12-01 00:00:00', 0, 'Gauteng, South Africa', -26.270760, 28.112268, '2015-12-01 00:00:00', 0, 'http://www.google.com/maps/dir/Durban++South+Africa/Gauteng++South+Africa', '555 km', '5 hours 24 mins', 'Testing Porch Cars', '', 'Testing Truck', '0.00', '0.00', NULL, NULL),
(128, 'admin', '2016-03-03 00:00:00', 'Santon, South Africa', -26.107567, 28.056702, '2015-12-14 00:00:00', 0, 'Pietermaritsburg, South Africa', -29.600607, 30.379412, '2015-12-14 00:00:00', 0, 'http://www.google.com/maps/dir/Santon++South+Africa/Pietermaritsburg++South+Africa', '510 km', '4 hours 58 mins', 'Testing Truck', '', 'Testing Gold', '0.00', '0.00', NULL, NULL),
(129, 'admin', '2016-03-03 00:00:00', 'Seattle', 47.606209, -122.332069, '2015-12-31 00:00:00', 0, 'Cape Town', -33.924870, 18.424055, '2015-12-31 00:00:00', 0, 'http://www.google.com/maps/dir/Seattle/Cape+Town', '16424.922', 'Contains Flight or Ship Trip', 'Testing Shipment', '', 'Testing Ship', '0.00', '0.00', NULL, NULL),
(130, 'admin1', '2016-03-03 00:00:00', 'Durban\r\nSouth Africa', -29.858681, 31.021839, '2016-01-06 00:00:00', 0, 'Gauteng\r\nSouth Africa', -26.270760, 28.112268, '2016-01-05 00:00:00', 0, 'http://www.google.com/maps/dir/Durban++South+Africa/Gauteng++South+Africa', '555 km', '5 hours 24 mins', 'Mielies', '', 'Truck', '3.00', '30.00', NULL, NULL),
(131, 'admin1', '2016-03-03 00:00:00', 'Durban\r\nSouth Africa', -29.858681, 31.021839, '2016-01-05 00:00:00', 0, 'Gauteng\r\nSouth Africa', -26.270760, 28.112268, '2016-01-05 00:00:00', 0, 'http://www.google.com/maps/dir/Durban++South+Africa/Gauteng++South+Africa', '555 km', '5 hours 24 mins', 'Mielies', '', 'Truck', '7.00', '30.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `OfferAShipmentBid`
--

CREATE TABLE `OfferAShipmentBid` (
  `id` int(11) NOT NULL,
  `OfferAShipmentID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Bid` decimal(12,2) DEFAULT NULL,
  `Selected` int(11) NOT NULL,
  `Watch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OfferAShipmentBid`
--

INSERT INTO `OfferAShipmentBid` (`id`, `OfferAShipmentID`, `Username`, `Bid`, `Selected`, `Watch`) VALUES
(1, 128, 'admin1', '97.78', 0, 1),
(2, 128, 'admin2', '177.00', 0, 1),
(18, 105, 'admin2', '111.00', 0, 1),
(26, 127, 'admin2', NULL, 0, 1),
(28, 127, 'Ster', '50000.00', 0, 1),
(30, 129, 'admin1', NULL, 0, 0),
(31, 130, 'admin2', '99.00', 0, 1),
(32, 131, 'admin2', '100.00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `OfferAShipmentMessages`
--

CREATE TABLE `OfferAShipmentMessages` (
  `ID` int(11) NOT NULL,
  `OfferAShipment` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `FromUsername` varchar(75) DEFAULT NULL,
  `ToUsername` varchar(75) DEFAULT NULL,
  `Message` mediumtext,
  `SentOrReceived` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OfferAShipmentMessages`
--

INSERT INTO `OfferAShipmentMessages` (`ID`, `OfferAShipment`, `Date`, `FromUsername`, `ToUsername`, `Message`, `SentOrReceived`) VALUES
(62, 129, '2015-12-24 15:16:39', 'admin1', 'admin', ' 1\r\n2\r\n3', 'Sent'),
(64, 129, '2015-12-24 15:31:39', 'admin1', 'admin', ' 123', 'Received'),
(66, 129, '2015-12-24 17:08:30', 'admin1', 'admin', ' qwe', 'Received'),
(67, 129, '2015-12-24 17:09:31', 'admin1', 'admin', ' qwer', 'Sent'),
(68, 129, '2015-12-24 17:10:40', 'admin1', 'admin', ' qwerty', 'Received'),
(69, 129, '2015-12-24 17:22:03', 'admin1', 'admin', '  123', 'Sent'),
(70, 129, '2015-12-24 17:22:33', 'admin1', 'admin', ' 1234', 'Received'),
(71, 129, '2015-12-24 17:23:04', 'admin1', 'admin', ' 12345', 'Sent'),
(72, 129, '2015-12-24 17:24:15', 'admin1', 'admin', '  qwe', 'Sent'),
(73, 129, '2015-12-24 17:43:50', 'admin1', 'admin', ' ', 'Received'),
(74, 129, '2015-12-24 18:01:43', 'admin1', 'admin', ' to admin from admin1', 'Received'),
(75, 129, '2015-12-24 18:02:49', 'admin1', 'admin', ' reply', 'Sent'),
(76, 129, '2015-12-24 21:48:12', 'admin1', 'admin', '  test', 'Sent'),
(77, 129, '2015-12-24 21:48:56', 'admin1', 'admin', ' bla', 'Received'),
(78, 129, '2016-01-04 22:46:22', 'admin1', 'admin', ' testme1', 'Received'),
(79, 129, '2016-01-04 22:47:08', 'admin1', 'admin', '  testme2', 'Sent'),
(80, 129, '2016-01-05 21:39:10', 'Ster', 'admin', ' Hello\r\n\r\nI am really cheap so please accept my offer....\r\n\r\nLOL', 'Received'),
(81, 129, '2016-01-05 21:43:28', 'Ster', 'admin', ' Hello\r\n\r\nI am really cheap so please accept my offer....\r\n\r\nLOL', 'Received'),
(82, 129, '2016-01-05 21:44:40', 'Ster', 'admin', ' ola\r\n\r\nhowzit bru\r\n\r\nalmost bed time', 'Received'),
(83, 129, '2016-01-05 22:00:32', 'Ster', 'admin', ' ola\r\n\r\nhowzit bru\r\n\r\nalmost bed time', 'Received'),
(84, 129, '2016-01-05 22:01:13', 'Ster', 'admin', ' hello\r\n\r\n123\r\n\r\nabc', 'Received'),
(85, 129, '2016-01-06 17:54:24', 'admin1', 'admin', ' test1', 'Received'),
(86, 129, '2016-01-06 17:58:16', 'admin1', 'admin', ' test2', 'Received'),
(87, 129, '2016-01-06 18:10:23', 'admin1', 'admin', ' test2 ', 'Received'),
(88, 129, '2016-01-06 18:10:56', 'admin1', 'admin', ' test3', 'Received'),
(89, 129, '2016-01-06 18:19:46', 'admin1', 'admin', ' test4', 'Received'),
(90, 129, '2016-01-06 18:51:33', 'admin1', 'admin', ' test5', 'Received'),
(91, 129, '2016-01-06 19:41:37', 'admin1', 'admin', ' test5', 'Received'),
(92, 128, '2016-01-08 20:03:17', 'admin1', 'admin', '  i see you watching my listing #128', 'Sent');

-- --------------------------------------------------------

--
-- Table structure for table `OfferTransport`
--

CREATE TABLE `OfferTransport` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `HomeLocation` varchar(500) DEFAULT NULL,
  `TransportType` varchar(50) DEFAULT NULL,
  `TransportPicture` varchar(500) DEFAULT NULL,
  `WhoDoesTheDriving` varchar(50) DEFAULT NULL,
  `ChargingPerDay` decimal(30,2) DEFAULT NULL,
  `ChargingPerHalfDay` decimal(30,2) DEFAULT NULL,
  `ChargingCoverCharge` decimal(30,2) DEFAULT NULL,
  `ChargingPerCubicMeterPerKm` decimal(30,2) DEFAULT NULL,
  `CurrentLocation` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OfferTransport`
--

INSERT INTO `OfferTransport` (`id`, `Username`, `HomeLocation`, `TransportType`, `TransportPicture`, `WhoDoesTheDriving`, `ChargingPerDay`, `ChargingPerHalfDay`, `ChargingCoverCharge`, `ChargingPerCubicMeterPerKm`, `CurrentLocation`) VALUES
(1, 'admin', 'TW136NR\r\nLondon\r\nUnited Kingdom', 'Bicycle', '[{"name":"files\\/21945_294880517064_5886587_n_01quxv0e.jpg","usrName":"21945_294880517064_5886587_n.jpg","size":7590,"type":"image\\/jpeg","thumbnail":"files\\/th21945_294880517064_5886587_n_iwtsuay0.jpg","thumbnail_type":"image\\/jpeg","thumbnail_size":7590,"searchStr":"21945_294880517064_5886587_n.jpg,!:sStrEnd"}]', 'We Drive', '101.11', '51.22', '100.33', '11.44', 'United Kingdom\r\nLondon\r\nTW13 6SA'),
(2, 'admin', 'Lisbon\r\nPortugal', 'Boat', '[{"name":"files\\/ebay_uhkn5mms.jpg","usrName":"ebay.jpg","size":14609,"type":"image\\/jpeg","thumbnail":"files\\/thebay_6rr202uh.jpg","thumbnail_type":"image\\/jpeg","thumbnail_size":14609,"searchStr":"ebay.jpg,!:sStrEnd"}]', 'We Drive', '100.00', '50.00', '500.00', '500.00', 'Porto\r\nPortugal');

-- --------------------------------------------------------

--
-- Table structure for table `OfferTransportMessages`
--

CREATE TABLE `OfferTransportMessages` (
  `ID` int(11) NOT NULL,
  `OfferARideID` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `FromUsername` varchar(75) DEFAULT NULL,
  `ToUsername` varchar(75) DEFAULT NULL,
  `Message` mediumtext,
  `SentOrReceived` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Hash` varchar(50) NOT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Active` int(11) NOT NULL,
  `Verified` int(11) NOT NULL,
  `Rating` decimal(5,2) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  `Address` varchar(350) DEFAULT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `Surname` varchar(100) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `PersonalIdentificationDocumentType` varchar(30) NOT NULL,
  `PersonalIdentificationNumber` varchar(50) NOT NULL,
  `CompanyName` varchar(30) NOT NULL,
  `CompanyIdentificationNumber` varchar(50) NOT NULL,
  `CompanyTaxOrVatNo` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Hash`, `Password`, `Active`, `Verified`, `Rating`, `Email`, `Mobile`, `UserType`, `Address`, `FirstName`, `Surname`, `DateOfBirth`, `PersonalIdentificationDocumentType`, `PersonalIdentificationNumber`, `CompanyName`, `CompanyIdentificationNumber`, `CompanyTaxOrVatNo`, `Country`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, 0, '0.00', 'tony@tbs-online.co.za\r\n\r\n', '073', NULL, NULL, 'admin', 'admin', NULL, '', '', '', '', '', ''),
(3, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'Admin1', 1, 0, '0.00', 'tony19760619@msn.com', '123', 'Ride Offerors', '17 karl kielblock\r\nCape Town\r\nSouth Africa', 'tw136nr', 'Pomp Man', '2015-11-08', '', '', '', '', '', ''),
(29, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'ASDqwe1', 1, 0, '0.00', 'tony19760619@gmail.com\r\n', '07473161001', 'Load Offerer', '5 Riverdale Road\r\nHanworth', 'Antonio', 'Silva', '1976-06-19', 'Passport', '', '', '', '', 'South Africa'),
(30, 'Ster', '426588ef9af1ef0dcb8ec7174c94106c', 'Ster123', 1, 0, '0.00', 'marilia1978ster@gmail.com', '', 'All of the above', '7 Koos Ave', 'Maria', 'Joana', '0000-00-00', 'None', '', '', '', '', 'United Kingdom'),
(31, '123', '202cb962ac59075b964b07152d234b70', 'User12', 0, 0, '0.00', '123@123.com', '07775881445', 'All of the above', '5 Riverdale Road', 'Antonio', 'Silva', '1976-06-19', 'None', '', 'Cheap Flight Tickets', '', '', 'South Africa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lookups`
--
ALTER TABLE `Lookups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `OfferAShipment`
--
ALTER TABLE `OfferAShipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `OfferAShipmentBid`
--
ALTER TABLE `OfferAShipmentBid`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `OfferALoadID` (`OfferAShipmentID`,`Username`);

--
-- Indexes for table `OfferAShipmentMessages`
--
ALTER TABLE `OfferAShipmentMessages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `OfferTransport`
--
ALTER TABLE `OfferTransport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `OfferTransportMessages`
--
ALTER TABLE `OfferTransportMessages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `hashindex` (`Hash`),
  ADD UNIQUE KEY `usernameindex` (`Username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Lookups`
--
ALTER TABLE `Lookups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `OfferAShipment`
--
ALTER TABLE `OfferAShipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `OfferAShipmentBid`
--
ALTER TABLE `OfferAShipmentBid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `OfferAShipmentMessages`
--
ALTER TABLE `OfferAShipmentMessages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `OfferTransport`
--
ALTER TABLE `OfferTransport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `OfferTransportMessages`
--
ALTER TABLE `OfferTransportMessages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;