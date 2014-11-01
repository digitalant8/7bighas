-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2014 at 06:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `7bighas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_username` varchar(32) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_email`) VALUES
('manish', 'icarus', 'manish@digitalant.in'),
('positrix', 'icarus', 'positrix@digitalant.in');

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE IF NOT EXISTS `developers` (
  `dev_id` int(11) NOT NULL AUTO_INCREMENT,
  `dev_name` varchar(100) NOT NULL,
  `dev_email` varchar(50) DEFAULT NULL,
  `dev_address` varchar(255) DEFAULT NULL,
  `dev_street` varchar(255) DEFAULT NULL,
  `dev_city` varchar(30) DEFAULT NULL,
  `dev_state` varchar(2) DEFAULT NULL,
  `dev_phone` varchar(50) DEFAULT NULL,
  `dev_contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dev_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `developers`
--

INSERT INTO `developers` (`dev_id`, `dev_name`, `dev_email`, `dev_address`, `dev_street`, `dev_city`, `dev_state`, `dev_phone`, `dev_contact`) VALUES
(5, 'Dona Builders', 'donabuilders@gmail.com', 'Dona Towers', 'GS Road', 'Guwahati', 'as', '0361-2599087', ''),
(6, 'Abode Infrastructure Pvt Ltd', 'guwahati.mf@rebi.in', '1st Floor, R.P Bezbaruah Bahawan', 'MRD Road, Silpukhuri', 'Guwahati', 'as', '9435042761', '');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_alt` varchar(100) DEFAULT NULL,
  `photo_prop_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_alt`, `photo_prop_id`) VALUES
(18, 'Dona Presidency', 8);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `prop_user_id` int(11) NOT NULL,
  `prop_dev_id` int(11) DEFAULT NULL,
  `prop_name` varchar(100) NOT NULL,
  `prop_description` text,
  `prop_address` varchar(255) DEFAULT NULL,
  `prop_street` varchar(255) DEFAULT NULL,
  `prop_city` varchar(30) DEFAULT NULL,
  `prop_state` varchar(2) DEFAULT NULL,
  `prop_def_image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`prop_id`, `prop_user_id`, `prop_dev_id`, `prop_name`, `prop_description`, `prop_address`, `prop_street`, `prop_city`, `prop_state`, `prop_def_image_id`) VALUES
(8, 1, 5, 'Dona Presidency', 'Reputed developers Dona Builders are back with their new project Dona Presidency, located in the lush green locality of Dharandha on VIP road in Guwahati.<br><br>After the successful completion of the mega Mall and multiplex â€˜Dona Planetâ€™, the first of its kind in the North East regions which is unique and thriving to be the life of Guwahati. And now Dona Builders brings you â€˜Dona Presidencyâ€™, luxury homes to upgrade your lifestyle. Dona presidency combines modern living with the surreal landscape, connecting man to nature, luxury to comfort and that too in a prime location with peaceful privacy.<br><br><h3>Project Highlight</h3><ul><li>Luxurious large flats</li><li>2 minutes away from GS Road</li><li>Close to both International and Domestic Airports, via the highway linked to Shillong</li></ul><h3>Main Features</h3><ul><li>3 &amp; 4 BHK Apartments and 4 BHK Duplex Apartment and luxurious pent house</li><li>Stilt car parking for every flat</li><li>Garden for children</li><li>Grand entrance Lobby</li><li>Intercom services from security cabin to all the flats</li><li>Beautiful landscaped gardens with water fountain</li></ul><h3>Amenities â€“ External</h3><ul><li>Landscaped and turfed gardens, sheltered and private for residenst use</li><li>Attractive features to gardens</li><li>Stilt parking space to allocated flats</li><li>Lighting for Landscape and Car Park areas</li><li>Childrenâ€™s play garden with equipment</li><li>Ground and Terrace finishing as per modern techniques</li></ul><h3>General </h3><ul><li>Luxury passenger elevators with automatic doors</li><li>Marble / granite flooring to communal entrance halls</li><li>Marble / vitrified tile flooring in flats</li><li>Aluminium windows with mosquito nets</li><li>Health Club equipped with gym equipment</li><li>Concealed copper wiring</li><li>Common TV / Cable antenna</li><li>Telephone point in all rooms for each flat</li><li>Common rest room on the ground floors</li></ul><h3>Kitchen</h3><ul><li>Luxury walls with ceramic tile finish</li><li>Ceramic / Granite tile flooring</li><li>Glazed tiles above kitchen platform</li></ul><h3>Bathroom</h3><ul><li>Fully tiled luxury shower</li><li>Ceramic tile flooring and tiles walls</li><li>Concealed plumbing</li><li>Quality sanitary ware</li><li>Bathroom provided with shower and wash basin</li><li>Hot and cold water bath shower</li></ul><h3>Security and safety</h3><ul><li>Door viewers to apartment entrance</li><li>Doors with latch</li><li>Security personnel in the lobby of each building</li><li>Intercom telephone system in the entrance foyer connected to flats for security</li><li>Fire fighting systems in stair case and lobby on each floor</li></ul>', '', '', '', 'as', 18),
(10, 1, 6, 'Abode Grand', '<p>Abode&#39;s latest offering Abode Grand is an exclusive Resi-Commercial complex situated in the junction of Downtown Traffic Point on GS Road, opposite to Down Town Hospital, Guwahati</p>\r\n', 'Down Town Traffic Point', 'GS Road', 'Guwahati', 'as', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_prop_id` int(11) NOT NULL,
  `unit_name` varchar(100) DEFAULT NULL,
  `unit_desc` text,
  `unit_area` varchar(100) DEFAULT NULL,
  `unit_price` varchar(20) DEFAULT NULL,
  `unit_photo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_prop_id`, `unit_name`, `unit_desc`, `unit_area`, `unit_price`, `unit_photo_id`) VALUES
(3, 10, '3 Bedroom Flat (Type A)', '', '1405 sq ft', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `unit_features`
--

CREATE TABLE IF NOT EXISTS `unit_features` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_unit_id` int(11) NOT NULL,
  `feature_key` varchar(100) NOT NULL,
  `feature_value` varchar(100) NOT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `unit_features`
--

INSERT INTO `unit_features` (`feature_id`, `feature_unit_id`, `feature_key`, `feature_value`) VALUES
(1, 3, 'Living Room', '10''2'''' x 16''7'''''),
(2, 3, 'Dining Room', '10'' x 12'''),
(3, 3, 'Veranda (attached with Dinning)', '4''4'''' wide'),
(4, 3, 'Kitchen', '6'' x 10'''),
(5, 3, 'Master bedroom', '12''8'''' x 12''4'''''),
(6, 3, 'Toilet (with master bedroom)', '4''6'''' x 7'''),
(7, 3, 'Bedroom 2', '11'' x 13''11'''''),
(8, 3, 'Veranda (attached to bedroom 2)', '3''3'''' wide'),
(9, 3, 'Bedroom 3', '14''9'''' x 10''9'''''),
(10, 3, 'Toilet Common', '8'' x 5''');

-- --------------------------------------------------------

--
-- Table structure for table `unit_photos`
--

CREATE TABLE IF NOT EXISTS `unit_photos` (
  `unit_photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `unit_photo_alt` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`unit_photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `unit_photos`
--

INSERT INTO `unit_photos` (`unit_photo_id`, `unit_id`, `unit_photo_alt`) VALUES
(3, 3, '3 Bedroom Flat Type A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_realname` varchar(100) NOT NULL,
  `user_username` varchar(32) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_street` varchar(255) DEFAULT NULL,
  `user_city` varchar(30) DEFAULT NULL,
  `user_state` varchar(2) DEFAULT NULL,
  `user_phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_realname`, `user_username`, `user_password`, `user_email`, `user_address`, `user_street`, `user_city`, `user_state`, `user_phone`) VALUES
(1, 'Manish Choudhury', 'manish', 'icarus88', 'manishc8@gmail.com', 'House no 102', 'Dilip Hujuri Path, Dispur Sanchibalaya', 'Guwahati', 'as', '767-000-3113'),
(2, 'Vishnu Sharma', 'positrix', 'icarus88', 'manishchoudhury@gmail.com', 'House no 102', 'Dilip Hujuri Path, Dispur Sanchibalaya', 'Guwahati', 'as', '767-000-3113'),
(3, 'Dev Anand', 'dev', 'icarus88', 'devanand@gmail.com', 'Flat 103, Kusum Plaza', 'JC Das Road', 'Guwahati', 'as', '754-111-2342');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
