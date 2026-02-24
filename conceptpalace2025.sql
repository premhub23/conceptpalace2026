-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2026 at 05:00 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conceptpalace2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_id`),
  UNIQUE KEY `customers_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ansil`
--

DROP TABLE IF EXISTS `ansil`;
CREATE TABLE IF NOT EXISTS `ansil` (
  `ansil_id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ansil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ansil`
--

INSERT INTO `ansil` (`ansil_id`, `image_name`, `image_path`, `uploaded_at`) VALUES
(1, 'anime face 2', 'assets/ansil/anime face 2.jpg', '2026-02-15 04:00:00'),
(2, 'BackCharacters', 'assets/ansil/BackCharacters.jpg', '2026-02-15 04:00:00'),
(3, 'BackCharacters_1', 'assets/ansil/BackCharacters_1.jpg', '2026-02-15 04:00:00'),
(4, 'BackCharacters_2', 'assets/ansil/BackCharacters_2.jpg', '2026-02-15 04:00:00'),
(5, 'Brice in action', 'assets/ansil/Brice in action.jpg', '2026-02-15 04:00:00'),
(6, 'BRICE2', 'assets/ansil/BRICE2.jpg', '2026-02-15 04:00:00'),
(7, 'Girl Go Green', 'assets/ansil/Girl Go Green.jpg', '2026-02-15 04:00:00'),
(8, 'Howling Colour', 'assets/ansil/Howling Colour.jpg', '2026-02-15 04:00:00'),
(9, 'Howling', 'assets/ansil/Howling', '2026-02-15 04:00:00'),
(10, 'Meagan', 'assets/ansil/Meagan.png', '2026-02-15 04:00:00'),
(11, 'New Beginnings', 'assets/ansil/New Beginnings.jpg', '2026-02-15 04:00:00'),
(12, 'Panel 3', 'assets/ansil/Panel 3.jpg', '2026-02-15 04:00:00'),
(13, 'Panel-4', 'assets/ansil/Panel-4.jpg', '2026-02-15 04:00:00'),
(14, 'Pointing 2', 'assets/ansil/Pointing 2', '2026-02-15 04:00:00'),
(15, 'PropThor', 'assets/ansil/PropThor', '2026-02-15 04:00:00'),
(16, 'Shooter', 'assets/ansil/Shooter.jpg', '2026-02-15 04:00:00'),
(17, 'Superhero girl character', 'assets/ansil/Superhero girl character.jpg', '2026-02-15 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` int(11) NOT NULL,
  `First Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `First Name`, `Last Name`, `Bio`, `email`) VALUES
(1, 'Premchand', 'Budhooram', 'Premchand Budhooram is a radio announcer and amateur artist from Saint Vincent and the Greanadines.', 'prem1234'),
(2, 'Ansil', 'Quow', 'Ansil Quow is a multimedia artist and an animator from Saint Vincent and the Grenadines.', 'ansil1234'),
(3, 'Jonathan ', 'Providence', 'Jonathan Providence is a multimedia and comic book artist from Saint Vincent and the Grenadines.', 'Jonathan123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `customers_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `type`) VALUES
(101, 'tote bag', 'bag'),
(102, 'T-Shirt', 'T-Shirt'),
(103, 'Lunch Box', 'lunch box');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `contact_id` int(11) NOT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jonathan`
--

DROP TABLE IF EXISTS `jonathan`;
CREATE TABLE IF NOT EXISTS `jonathan` (
  `jonathan_id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`jonathan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jonathan`
--

INSERT INTO `jonathan` (`jonathan_id`, `image_name`, `image_path`, `uploaded_at`) VALUES
(1, 'IMG_20190805_075741_626', 'assets/jonathan/IMG_20190805_075741_626.jpg', '2026-02-14 04:00:00'),
(2, 'IMG_20190805_075743_533', 'assets/jonathan/IMG_20190805_075743_533.jpg', '2026-02-14 04:00:00'),
(3, 'IMG_20190805_075745_213', 'assets/jonathan/IMG_20190805_075745_213.jpg', '2026-02-14 04:00:00'),
(4, 'IMG_20190805_075746_910', 'assets/jonathan/IMG_20190805_075746_910.jpg', '2026-02-14 04:00:00'),
(5, 'IMG_20190805_075748_950', 'assets/jonathan/IMG_20190805_075748_950.jpg', '2026-02-14 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

DROP TABLE IF EXISTS `news_events`;
CREATE TABLE IF NOT EXISTS `news_events` (
  `news_events_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `news_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`news_events_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`news_events_id`, `title`, `body`, `news_path`, `date`, `created`) VALUES
(1, 'St Vincent and the Grenadines donates to Art Museum of the Americas', 'WASHINGTON, USA – The Mission of Saint Vincent and the Grenadines to the Organization of American States (OAS) Friday donated a painting by artist Calvert Jones to the Art Museum of the Americas, the Caribbean country’s first donation to the permanent collection of the OAS museum in Washington, DC. OAS secretary-general Luis Almagro said that the aesthetic and content diversity of modern and contemporary Caribbean arts, “presents a free and unrestricted creative expression that exemplifies the OAS mandate of More Rights for More People, in the form of More Art for More People, helping to pave the way for a deeper dialogue among the peoples of our Member States.” For her part, the permanent representative of St Vincent and the Grenadines, Louanne Gilchrist, said the donation “marks a milestone for us, as it promotes the visibility of our small island developing state and manifests the creative genius of our people, evidenced in the work of Jones. The painting itself is a representation of the vulnerability of our islands, but it is also an embodiment of the resilience of our people,” the Caribbean diplomat added. Ambassador Gilchrist read words from the artist Jones in which he explained that he was inspired by the eruptions of La Soufriere Volcano to create his work. “I have aptly titled this work ‘The Prayers of Spring,’ a beacon of the coming of spring, the season of new life, fruitfulness, hope and faith in God,” Jones said. The Art Museum of the Americas is the oldest museum in the United States of modern and contemporary art from Latin America and the Caribbean and contains one of the world’s most important collections of works by artists from the Western Hemisphere.\r\n\r\nSource: caribbeannewsglobal.com', 'assets/news/St Vincent and the Grenadines donates to Art Museum of the Americas.txt', '2025-11-01', '2025-11-01 04:00:00.000000'),
(2, 'St Vincent exploring designs for state-of-the art theme park', 'Fans of the Pirates of the Caribbean franchise will know that Wallilabou Bay in St Vincent and the Grenadines was one of the locations used to film the Hollywood blockbuster, Pirates of the Caribbean: The Curse of the Black Pearl (2003). This year St Vincent and the Grenadines will conceptualise designs for a Pirates of the Caribbean themed park at Wallilabou. Minister of Tourism Carlos James announced this at a State of Tourism 2024 conference on Tuesday. James explained that the design concept will take into account the themed movie Pirates of the Caribbean and that they are looking at scouting lands closest to the beach where they could look at further developing to accommodate a state-of-the-art theme park, restaurant, a full-on area, a pool and beach access for persons coming by sea. He said this is something St Vincent and the Grenadines has long been calling for and will finally start the design concept for that product this year with hopes of implementing in the year 2025. The tourism minister stated it is important that St Vincent and the Grenadines looks at how it could further develop the island’s tourism product offering, ensure the right services and sites that are of a quality of standard so that persons visiting the destination can see the true benefit of the product. St Vincent and the Grenadines in general wants to attract more movie production sets to the island. To achieve this, St Vincent and the Grenadines will establish a National Film Commission under the auspices of the National Cultural Foundation supported by the Department of Culture. He noted that Warner Music Group concluded a shoot in SVG recently, and producers for a reality TV series are currently scouting the island as a production base for one of their seasons.\r\n\r\nSource: caribbean.loopnews.com', '', '2025-11-03', '2025-11-03 04:00:00.000000'),
(3, 'One of SVGs leading artists signs international deal', 'Local Creative Calvert Jones continues to push the boundaries and his latest move has seen him sign with Elizabeth Sloane, a business development and deal origination firm with operations in the Caribbean and West Africa. Jones is known locally, regionally and internationally through his brand of art “Tropical Realism”. He is a self-taught visual artist and entrepreneur who in November 2016 gifted Prince Harry with a portrait and most recently this week, Jamaican superstar Andrae “Popcaan” Sutherland received a piece from Jones depicting the dancehall artiste and his mother whom he fondly refers to as “Miss Rhona”. On Monday, Jones, said he signed a deal with Elizabeth Sloane that will assist him with Business Development Services specifically as it relates to Intellectual Property (IP) syndication. Jones said the company has worked with names like UNESCO, British Council and Mastercard and while it is a boutique firm, Elizabeth Sloane is an extremely professional organisation with a global reputation. He said he first learnt of Elizabeth Sloane when he was contacted by Melanie Wynter, Managing Director of Elizabeth Sloane to purchase a print “of my most prized painting” which is dubbed “The Last Colonial Meal”. Calvert Jones is an entrepreneur and self-taught Visual artist. His professional career spans photography, videography, graphic design, interior design, and fine art. He also serves as a Director of Invest SVG. Calvert is the son of Sandra and Sidney Jones. He grew up in the rural village of Cedars, St. Vincent and the Grenadines, this meant a forty-minute daily commute to capital Kingstown for school. These trips cemented in his mind the imagery necessary to stimulate his creative potential. He sold his first piece of artwork at the age of twelve.\r\n\r\nSource: onenewsstvincent.com', '', '2025-11-03', '2025-11-07 04:00:00.000000'),
(4, 'Everything Vincy Expo Plus to showcase SVG’s diverse Industries', 'The 2023 edition of Everything Vincy Expo Plus is about showcasing what St Vincent and the Grenadines (SVG) has to offer says Chairman of Invest SVG Anthony Regisford.\r\n\r\nThis year, the Everything Vincy Expo will run from October 26 to 29 and will be held at the tarmac of the decommissioned ET Joshua Airport at Arnos Vale.\r\n\r\nThere is a website, everythingvincy.com and according to Regisford, the expo speaks directly to the government’s push towards building a many sided economy that can move the country forward.\r\n\r\nAn overview of the 2023 expo says it will showcase an extensive array of industries including agriculture, technology, fashion and art.\r\n\r\nThere will be traditional music and dance by local talent while persons will be able to meet with industry leaders and entrepreneurs. The event will feature a fashion show where local designers will showcase their apparel through runway presentations while there will be a “carefully curated” art exhibition.\r\n\r\nThe opening ceremony takes place at 10 a.m. on Thursday October 26 and the expo hours will be between 9 a.m. and 8 p.m. A gala event will take place on October 27 from 7 p.m. while the art exhibition runs from October 26 to 29. There will also be workshops.\r\n\r\nSpeaking at the launch on Wednesday, Regisford said Invest SVG has an important role to play in local business promotion and as a result, the agency is going to double down on their export promotion and marketing mandate.\r\n\r\nHe noted that the organisation was given this mandate and it is true to say, that they have not yet structured themselves in way they can fully push the throttle forward and make a meaningful difference in export promotion.\r\n\r\n“…And, we are going to strengthen the export promotion and marketing area,” Regisford stressed while noting also that digital and financial literacy is important.', '', '2026-02-11', '2026-02-11 04:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `status` enum('Pending','Completed','Cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orders_id`),
  KEY `customer_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_items_id`),
  UNIQUE KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `payment_method` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `orders_id` (`orders_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premchand`
--

DROP TABLE IF EXISTS `premchand`;
CREATE TABLE IF NOT EXISTS `premchand` (
  `premchand_id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`premchand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `premchand`
--

INSERT INTO `premchand` (`premchand_id`, `image_name`, `image_path`, `uploaded_at`) VALUES
(1, 'Dragon_Inks', 'assets/premchand/Dragon_Inks.jpg', '2026-02-16 00:00:00'),
(2, 'Erupting_Island_Volcano_Inks', 'assets/premchand/Erupting_Island_Volcano_Inks.jpg', '2026-02-16 00:00:00'),
(3, 'Manticore_Inks', 'assets/premchand/Manticore_Inks.jpg', '2026-02-16 00:00:00'),
(4, 'Ogre_Inks', 'assets/premchand/Ogre_Inks.jpg', '2026-02-16 00:00:00'),
(5, 'School_Friends_Colour_Pencils_Version_1', 'assets/premchand/School_Friends_Colour_Pencils_Version_1.jpg', '2026-02-16 00:00:00'),
(6, 'School_Friends_Colour_Pencils_Version_2', 'assets/premchand/School_Friends_Colour_Pencils_Version_2.jpg', '2026-02-16 00:00:00'),
(7, 'School_Girl_Colour_Pencils_Version_1', 'assets/premchand/School_Girl_Colour_Pencils_Version_1.jpg', '2026-02-16 00:00:00'),
(8, 'School_Girl_Colour_Pencils_Version_2', 'assets/premchand/School_Girl_Colour_Pencils_Version_2.jpg', '2026-02-16 00:00:00'),
(9, 'School_Girl_Colour_Pencils_Version_3', 'assets/premchand/School_Girl_Colour_Pencils_Version_3', '2026-02-16 00:00:00'),
(10, 'School_Girl_Five_Point_Turnarond_Sketch', 'assets/premchand/School_Girl_Five_Point_Turnarond_Sketch', '2026-02-16 00:00:00'),
(11, 'Soldier_Uniforms_Inks', 'assets/premchand/Soldier_Uniforms_Inks.jpg', '2026-02-16 00:00:00'),
(12, 'Sports_Car_Inks', 'assets/premchand/Sports_Car_Inks', '2026-02-16 00:00:00'),
(13, 'The_Stalker_Colour_Markers', 'assets/premchand/The_Stalker_Colour_Markers.jpg', '2026-02-16 00:00:00'),
(14, 'The_Stalker_Colour_Pencils', 'assets/premchand/The_Stalker_Colour_Pencils.jpg', '2026-02-16 00:00:00'),
(15, 'Unicorn_Inks', 'assets/premchand/Unicorn_Inks.jpg', '2026-02-16 00:00:00'),
(16, 'Waterfall_Inks', 'assets/premchand/Waterfall_Inks.jpg', '2026-02-16 00:00:00'),
(17, 'Wrestler_Inks', 'assets/premchand/Wrestler_Inks.jpg', '2026-02-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `quantity`, `category`, `image`, `created`) VALUES
(1, 'archer tote bag by ansil', 'A custom made tote bag featuring an archer by Ansil Quow.', '24.99', 5, 'hand bag', 'archer tote bag by ansil.jpg', '2026-02-09 12:04:00'),
(2, 'dog men t-shirt by jonathan', 'Dog Men T-Shirt by Jonathan Providence', '19.99', 15, 'T-Shirt', 'dog men t-shirt by jonathan.png', '2026-02-09 12:05:00'),
(3, 'manticore t-shirt by premchand', 'A manticore T-Shirt by Premchand Budhooram', '9.99', 30, 'T-Shirt', 'manticore t-shirt by premchand.png', '2026-02-09 00:00:00'),
(4, 'ogre t-shirt by premchand', 'An ogre T-shirt by Premchand Budhooram', '9.99', 30, 'T-Shirt', 'ogre t-shirt by premchand.png', '2026-02-09 00:00:00'),
(5, 'shooter lunch box by ansil', 'Shooter Lunch Box by Ansil Quow', '49.99', 10, 'lunch box', 'shooter lunch box by ansil.jpg', '2026-02-09 00:00:00'),
(6, 'superhero girl character t-shirt by ansil', 'Superhero Girl T-Shirt by Ansil Quow', '19.99', 25, 'T-Shirt', 'superhero girl character t-shirt by ansil.png', '2026-02-09 00:00:00'),
(7, 'thor t-shirt by ansil', 'Thor T-Shirt by Ansil Quow', '19.99', 20, 'T-Shirt', 'thor t-shirt by ansil.png', '2026-02-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `shipping_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `shipping _code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_date` datetime NOT NULL,
  `delvered_date` timestamp NOT NULL,
  PRIMARY KEY (`shipping_id`),
  UNIQUE KEY `orders_id` (`orders_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8_unicode_ci DEFAULT 'user',
  `reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`, `role`, `reset_token`, `reset_expires`, `created_at`) VALUES
(1, 'Premchand', 'Budhooram', 'budhoorampremchand@gmail.com\r\n', 'adminprem26', 'admin1234', 'admin', NULL, NULL, '2026-02-17 04:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orders_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
