-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 08:47 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cspdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(25) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `name`) VALUES
(1, 'shopmanager', 'shopmanager1234', 'Shop Manager'),
(2, 'bookingmanager', 'bookingmanager1234', 'Booking Manager'),
(3, 'servicemanager', 'servicemanager1234', 'Service Manager'),
(5, 'billingmanager', 'billingmanager1234', 'Billing Manager'),
(6, 'complainmanager', 'complainmanager1234', 'Complain Manager'),
(7, 'usermanager', 'usermanager1234', 'User Manager');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `user_id` int(25) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `image`, `status`, `user_id`, `month`) VALUES
(10111, 'images/1607193468bill.jpg', ' Unpaid', 1, 'November'),
(10222, 'images/1607195404bill.jpg', ' Paid', 2, '  March'),
(10333, 'images/1607195423bill.jpg', ' Unpaid', 3, ' July');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(25) NOT NULL,
  `model` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL,
  `carNo` varchar(255) NOT NULL,
  `color` text NOT NULL,
  `charges_per_hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `model`, `capacity`, `availability`, `carNo`, `color`, `charges_per_hour`) VALUES
(1, 'COROLLA', '200', 'Yes', 'AJK4567', 'Black', 200),
(11, 'BMW', '5', 'No', 'LHR1780', 'White', 300),
(12, 'Mercedes Benz', '3', 'No', 'MB7K5', 'Matte Black', 400);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_item_id` int(11) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sum_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_id` int(25) NOT NULL,
  `type` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(25) NOT NULL,
  `trcode` int(11) NOT NULL,
  `comp_time` time NOT NULL,
  `comp_date` date NOT NULL,
  `complain_notificationStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `type`, `subject`, `detail`, `status`, `user_id`, `trcode`, `comp_time`, `comp_date`, `complain_notificationStatus`) VALUES
(10, 'Disturbance', 'Playing in Streets', 'Playing in StreetsPlaying in StreetsPlaying in StreetsPlaying in Streets', 'Addressed', 2, 72475, '07:42:35', '2020-11-29', 1),
(11, 'Disturbance', 'Playing in Streets', 'Playing in StreetsPlaying in StreetsPlaying in StreetsPlaying in Streets', 'Discharged', 2, 23324, '07:43:25', '2020-11-29', 1),
(12, 'Forced Entry', 'Robbery in house', 'Robbery in houseRobbery in houseRobbery in houseRobbery in house', 'Discharged', 6, 62283, '19:50:41', '2020-11-30', 0),
(13, 'Street Racing', 'Disturbance due to Racing on public streets. ', 'Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. ', 'Discharged', 1, 15920, '18:34:06', '2020-12-04', 1),
(14, 'Noise', 'Disturbance due to Racing on public streets. ', 'Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. Disturbance due to Racing on public streets. ', 'pending', 1, 97897, '18:35:02', '2020-12-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hired_service`
--

CREATE TABLE `hired_service` (
  `hired_service_id` int(25) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `user_id` int(25) NOT NULL,
  `service_id` int(25) NOT NULL,
  `request_time` time NOT NULL,
  `request_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unique_service_id` int(11) NOT NULL,
  `service_notificationStatus` int(25) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hired_service`
--

INSERT INTO `hired_service` (`hired_service_id`, `status`, `user_id`, `service_id`, `request_time`, `request_date`, `location`, `description`, `unique_service_id`, `service_notificationStatus`) VALUES
(1031, 'confirmed', 2, 2, '05:38:08', '2020-11-29', 'Office', 'Washroom Pipe leakage.', 258357, 0),
(1033, 'confirmed', 6, 2, '19:38:13', '2020-11-30', 'Home', 'Leakage', 933140, 0),
(1034, 'confirmed', 4, 17, '05:17:31', '2020-12-04', 'House# s-8, Street s-9, phase-3', 'Require cleaning before the function in my home.', 568690, 0),
(1035, 'confirmed', 4, 2, '05:32:13', '2020-12-04', 'dfghdfg', 'dfgdfghdfg', 623290, 0),
(1036, 'confirmed', 1, 32, '19:57:14', '2020-12-04', 'Main road, Fawara Chowk', 'Main road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle Broke', 292833, 1),
(1037, 'confirmed', 1, 23, '20:01:33', '2020-12-04', 'Main road, Fawara Chowk Vehicle Broke', 'Main road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle Broke', 541260, 1),
(1038, 'Pending', 1, 24, '20:01:59', '2020-12-04', 'Main road, Fawara Chowk Vehicle Broke', 'Main road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle Broke', 196392, 1),
(1039, 'Pending', 3, 38, '20:06:17', '2020-12-04', 'Main road, Fawara Chowk Vehicle Broke', 'Main road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle BrokeMain road, Fawara Chowk Vehicle Broke', 129838, 0),
(1040, 'confirmed', 1, 2, '20:20:46', '2020-12-04', 'YesYesYesYesYesYesYesYesYes', 'YesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYes', 19620, 1),
(1041, 'confirmed', 1, 23, '20:21:53', '2020-12-04', 'YesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYes', 'YesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesYesY', 85443, 1),
(1042, 'Pending', 1, 17, '20:24:25', '2020-12-04', 'CheckedCheckedCheckedCheckedCheckedChecked', 'CheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedCheckedChecked', 349090, 1),
(1043, 'Pending', 1, 38, '20:49:50', '2020-12-04', 'zsdgzsdgzsg', 'zsdgzsdgzsgzsdgzsdgzsgzsdgzsdgzsgzsdgzsdgzsgzsdgzsdgzsg', 418089, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(25) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_subtitle` varchar(255) NOT NULL,
  `notification_image` varchar(255) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `notification_subType` varchar(255) NOT NULL,
  `notification_status` int(25) NOT NULL,
  `notification_dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `notification_title`, `notification_subtitle`, `notification_image`, `notification_type`, `notification_subType`, `notification_status`, `notification_dateTime`) VALUES
(776, 'Your Order is in Pending', 'Tracking ID: 80617', 'assets/images/reserve_Notify.png', 'order', 'Pending', 1, '2020-12-08 16:13:54'),
(777, 'Your Order is in Process', 'Tracking ID: 80617', 'assets/images/reserve_Notify.png', 'order', 'Processed', 1, '2020-12-08 16:18:06'),
(778, 'Your Order is On the Way', 'Tracking ID: 80617', 'assets/images/reserve_Notify.png', 'order', 'onDelivery', 1, '2020-12-08 16:19:16'),
(779, 'Your Order is in Process', 'Tracking ID: 23906', 'assets/images/reserve_Notify.png', 'order', 'Processed', 1, '2020-12-08 17:06:10'),
(813, 'Your Booking Request is Confirmed', 'Tracking ID: 89699', 'assets/images/reserve_Notify.png', 'reserve', 'Confirmed', 1, '2020-12-08 18:43:19'),
(815, 'Thank You for Travelling with us!', 'Tracking ID: 42924', 'assets/images/reserve_Notify.png', 'reserve', 'Completed', 1, '2020-12-08 18:43:27'),
(816, 'Your Booking Request is Cancelled!', 'Tracking ID: 89699', 'assets/images/reserve_Notify.png', 'reserve', 'Cancelled', 1, '2020-12-08 18:45:06'),
(817, 'Thank You for Travelling with us!', 'Tracking ID: 23187', 'assets/images/reserve_Notify.png', 'reserve', 'Completed', 1, '2020-12-08 18:45:08'),
(818, 'Your Booking Request is Confirmed', 'Tracking ID: 52316', 'assets/images/reserve_Notify.png', 'reserve', 'Confirmed', 1, '2020-12-08 18:45:12'),
(819, 'Dear, SherazYour Order is in Pending', 'Tracking ID: 54977', 'assets/images/reserve_Notify.png', 'order', 'Pending', 1, '2020-12-08 19:58:26'),
(820, 'Dear, SherazYour Order is in Process', 'Tracking ID: 54977', 'assets/images/reserve_Notify.png', 'order', 'Processed', 1, '2020-12-08 20:01:28'),
(821, 'Your Booking Request is Confirmed', 'Tracking ID: 9316', 'assets/images/reserve_Notify.png', 'reserve', 'Confirmed', 1, '2020-12-08 20:04:47'),
(822, 'Thank You for Travelling with us!', 'Tracking ID: 52316', 'assets/images/reserve_Notify.png', 'reserve', 'Completed', 1, '2020-12-08 20:05:57'),
(823, 'Dear, SherazYour Order is in Pending', 'Tracking ID: 21324', 'assets/images/reserve_Notify.png', 'order', 'Pending', 1, '2020-12-08 20:25:54'),
(824, 'Dear, SherazYour Order is in Process', 'Tracking ID: 21324', 'assets/images/reserve_Notify.png', 'order', 'Processed', 1, '2020-12-08 20:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `unique_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_sum` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`unique_id`, `user_id`, `product_name`, `product_price`, `product_qty`, `product_sum`, `order_id`, `order_status`, `date_time`, `address`) VALUES
(134, 3, 'Kaly Channy', '180', '4', '720', '23906', 'Processed', '2020-12-07 21:47:45', 'House#123, Attock'),
(135, 3, 'Daal Masoor', '210', '3', '630', '23906', 'Processed', '2020-12-07 21:47:45', 'House#123, Attock'),
(136, 3, 'Coat-Large', '1500', '2', '3000', '23906', 'Processed', '2020-12-07 21:47:45', 'House#123, Attock'),
(137, 1, 'Potatoes', '20', '2', '40', '80617', 'onDelivery', '2020-12-08 16:13:51', 'House#499-C, Block V, Mehria Town, Attock'),
(138, 1, 'Pitza (Large)', '1000', '3', '3000', '80617', 'onDelivery', '2020-12-08 16:13:51', 'House#499-C, Block V, Mehria Town, Attock'),
(139, 1, 'Kaly Channy', '180', '3', '540', '54977', 'Processed', '2020-12-08 19:58:25', 'House#499-C, Block V, Mehria Town, Attock'),
(140, 1, 'Daal Mash', '175', '1', '175', '54977', 'Processed', '2020-12-08 19:58:25', 'House#499-C, Block V, Mehria Town, Attock'),
(141, 1, 'Kaly Channy', '180', '4', '720', '21324', 'Processed', '2020-12-08 20:25:51', 'House#499-C, Block V, Mehria Town, Attock'),
(142, 1, 'Pitza (Large)', '1000', '2', '2000', '21324', 'Processed', '2020-12-08 20:25:51', 'House#499-C, Block V, Mehria Town, Attock');

-- --------------------------------------------------------

--
-- Table structure for table `placed_orders`
--

CREATE TABLE `placed_orders` (
  `unique_id` int(25) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `checkout_time` datetime NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `notificationStatus` int(25) NOT NULL DEFAULT 0,
  `user_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_orders`
--

INSERT INTO `placed_orders` (`unique_id`, `order_id`, `order_status`, `checkout_time`, `delivery_address`, `notificationStatus`, `user_id`) VALUES
(1, '23906', 'Processed', '2020-12-07 21:47:45', 'House#123, Attock', 1, 3),
(2, '80617', 'onDelivery', '2020-12-08 16:13:51', 'House#499-C, Block V, Mehria Town, Attock', 1, 1),
(3, '54977', 'Processed', '2020-12-08 19:58:25', 'House#499-C, Block V, Mehria Town, Attock', 1, 1),
(4, '21324', 'Processed', '2020-12-08 20:25:51', 'House#499-C, Block V, Mehria Town, Attock', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `prodcat_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `image`, `description`, `prodcat_id`, `name`, `price`) VALUES
(1, 'images/1593941332Potatoes.jpg', 'Yummy Tasty Potatoes!!', 1, 'Potatoes', 20),
(1001, 'images/1593934782red-tomato-meteorite.jpg', 'Fresh Red and Tasty Tomatoes acquired from local Gardens!! 40 rupees per kg!', 1, 'Tomatoes', 40),
(1002, 'images/1595332761cucumber.png', 'Fresh and Tasty Cucumbers acquired from the rich fields of Punjab! 30 rupees per kg!', 1, 'Cucumber', 30),
(1004, 'images/1595403491APPLEapple.jpg', 'Tasty fresh apples picked from the Gardens of Sargodha,  Punjab, Pakistan!', 1, 'Apples', 120),
(1008, 'images/1595434142rango.jpg', 'Sweet, marvelous and delicious mangoes. None to be seen anywhere else.', 1, 'Mangoes', 120),
(1009, 'images/1595434196ra.jpg', 'Sweet, marvelous and delicious bananas. None to be seen anywhere else.', 1, 'Bananas', 120),
(1010, 'images/1595434235logo.jpg', 'Sweet, marvelous and delicious lyches. None to be seen anywhere else.', 1, 'Lyche', 200),
(1011, 'images/1595434267bottle.png', 'Sweet, marvelous and delicious jamans. None to be seen anywhere else.', 1, 'Jamans', 150),
(1012, 'images/1595435337angoor.jpg', 'justify-content: center;sweet grapesopopopopopop', 1, 'Grapes', 123),
(1014, 'images/1596018748Screenshot (8).png', 'DElicious,Fabulous, Marcvelous AArooo. Leny hen to bazar jao', 1, 'Aaroo', 150),
(1015, 'images/1596019442Screenshot (5).png', 'Just to tell u that I have to write description which I am writing this description is to be long enough so that I can check that the data table is presenting an issue or not.Just to tell u that I have to write description which I am writing this description is to be long enough so that I can check that the data table is presenting an issue or not.Just to tell u that I have to write description which I am writing this description is to be long enough so that I can check that the data table is presenting an issue or not.Just to tell u that I have to write description which I am writing this description is to be long enough so that I can check that the data table is presenting an issue or not.Just to tell u that I have to write description which I am writing this description is to be long enough so that I can check that the data table is presenting an issue or not.', 1, 'Khoobani', 120),
(1028, 'images/1605705334handawa.jpg', 'Sweet, Red, Fresh, Juicy and Delicious Water Mellon. Recently harvested.', 1, 'Water Mellon', 119),
(1029, 'images/16057732171592298863mangoes-cover-1.jpg', 'Sweetest, Delisiousest, Prettiest, Yellowest, Aango-Mangoes...', 1, 'Aango', 150),
(1030, 'images/1605786987channaKala.jpg', 'KalyChannyLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Kaly Channy', 180),
(1031, 'images/1605787042daalMash.jpg', 'Daal MashLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Daal Mash', 175),
(1032, 'images/1605787083SSsonf.jpg', 'Soanf Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Soanf', 430),
(1033, 'images/1605787140daalMasoor.jpg', 'Daal Masoor - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Daal Masoor', 210),
(1034, 'images/1605787198dalChanna.jpg', 'Daal Channa - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Daal Channa', 125),
(1035, 'images/1605787239lobyaSafed.jpg', 'Lobya Safed - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Lobya Safed', 145),
(1036, 'images/1605787288liptonTea.jpg', 'Lipton Tea - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Lipton Tea', 250),
(1037, 'images/1605787336supremeTea.jpg', 'Supreme Tea - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Supreme Tea', 240),
(1038, 'images/1605787387sugar.jpg', 'Sugar - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 5, 'Sugar', 98),
(1039, 'images/1605799810burger.jpg', 'Chicken Burger - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Chicken Burger', 70),
(1040, 'images/1605799852burger2.jpg', 'Beef Burger - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Beef Burger', 100),
(1041, 'images/1605799886deal1.jpg', 'Deal 1 - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Deal 1', 250),
(1042, 'images/1605799942donust.jpg', 'Donut - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Donut', 50),
(1043, 'images/1605799995fries.jpg', 'Potato Fries - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Potato Fries', 100),
(1044, 'images/1605800068nugget.jpg', 'Nugget - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Nugget', 100),
(1047, 'images/1605800154pitza.jpg', 'Pitza (Large) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 7, 'Pitza (Large)', 1000),
(1048, 'images/1605800248shirt1.jpg', 'Casual Shirt (Medium) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Shirt (Medium)', 750),
(1049, 'images/1605800392shirt4.jpg', 'Black two piece (Medium) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, '2-piece (Medium)', 4500),
(1050, 'images/1605800459shirt5.jpg', 'Maroon Coat (Large) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Coat-Large', 1500),
(1051, 'images/1605800549shirt6.jpg', 'Over-Coat (Medium) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Over-Coat(m)', 9500),
(1052, 'images/1605800680shoe5.jpg', 'Black Joggers (42) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Black Joggers', 4500),
(1053, 'images/1605800759shoe3.jpg', 'Skin Color Joggers(40) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Hiking Joggers', 7500),
(1054, 'images/1605800865carRefr.jpg', 'Refrigerator (Medium) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Refrigerator', 15000),
(1055, 'images/1605800956cattle.png', 'Electric Kettle - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Electric Kettle', 5000),
(1056, 'images/1605801017coffeMaker.jpg', 'Coffee Maker (Medium) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Coffee Maker(m)', 7000),
(1057, 'images/1605801048freezer.jpg', 'Deep Freezer - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Deep Freezer', 57000),
(1058, 'images/1605801081iron.jpg', 'Steam Iron  - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Steam Iron ', 7500),
(1059, 'images/1605801123Juicer.png', 'Juicer/Blender Set  - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Juicer Set', 11500),
(1060, 'images/1605801237oven.jpg', 'Microwave Oven 13x12x10  - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Microwave Oven', 32000),
(1061, 'images/1605801288washMachine.png', 'All in one Washing Machine  - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 8, 'Washing Machine', 23000),
(1062, 'images/1605808582shirt3.jpg', 'Grey Coat - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus consectetur nibh in molestie. Donec a arcu turpis. Proin quis facilisis purus, vel maximus nisl. Etiam euismod metus varius odio efficitur, quis fermentum enim tincidunt. Etiam volutpat urna a imperdiet dapibus. Vivamus metus magna, lacinia at bibendum sit amet, consequat eu elit. Suspendisse pulvinar tellus mauris, a convallis tellus ornare at.', 6, 'Grey Coat', 4500),
(1063, 'images/1607036736brown_leather.jpg', 'Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.', 6, 'Brown-Leather shoe', 6000),
(1064, 'images/1607036804carrot.jpg', 'Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.', 1, 'Carrot', 50),
(1065, 'images/1607036871juicer.png', 'Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.', 8, 'Jucier-Blender Set', 3500),
(1066, 'images/1607036925leg_piece.jpg', 'Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.', 7, 'Chicken Leg-piece', 75),
(1067, 'images/1607036977snacks.jpg', 'Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.Find the perfect Grocery Items stock photos and editorial news pictures from Getty Images. Select from 12483 premium Grocery Items of the highest quality.', 5, 'Lays Snacks-250mg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `prodcat_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`prodcat_id`, `name`, `status`) VALUES
(1, 'Fruits and Vegetables', 'Active'),
(5, 'Groceries', 'Active'),
(6, 'Shoes and Garments', 'Active'),
(7, 'Fast Foods', 'Active'),
(8, 'Home Appliances', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserve_id` int(25) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(25) NOT NULL,
  `car_id` int(25) NOT NULL,
  `location` varchar(255) NOT NULL,
  `res_code` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `with_driver` text NOT NULL,
  `res_charges` int(11) NOT NULL,
  `reserve_notificationStatus` int(25) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserve_id`, `status`, `user_id`, `car_id`, `location`, `res_code`, `start_date`, `start_time`, `end_date`, `end_time`, `with_driver`, `res_charges`, `reserve_notificationStatus`) VALUES
(165, 'Completed', 2, 1, 'ghdfgsdfg', 69979, '2020-12-04', '16:00:00', '2020-12-05', '01:00:00', 'Yes', 1800, 0),
(166, 'Confirmed', 2, 11, 'house', 10881, '2020-12-04', '17:00:00', '2020-12-05', '01:00:00', 'Yes', 2400, 0),
(168, 'Completed', 2, 1, 'household', 76187, '2020-12-04', '21:00:00', '2020-12-05', '01:00:00', 'No', 800, 0),
(170, 'Completed', 1, 11, 'househomeoffice', 77379, '2020-12-05', '19:00:00', '2020-12-08', '01:00:00', 'Yes', 16200, 1),
(171, 'Confirmed', 1, 1, 'fghsdftgh', 9316, '2020-12-05', '17:00:00', '2020-12-07', '14:00:00', 'Yes', 9000, 1),
(172, 'Cancelled', 1, 12, 'Nayya', 89699, '2020-12-05', '19:00:00', '2020-12-07', '01:00:00', 'Yes', 12000, 1),
(173, 'Completed', 1, 11, 'banna', 23187, '2020-12-05', '17:00:00', '2020-12-07', '01:00:00', 'Yes', 9600, 1),
(174, 'Completed', 1, 11, 'Home', 52316, '2020-12-05', '19:00:00', '2020-12-07', '01:00:00', 'Yes', 9000, 1),
(175, 'Completed', 1, 12, 'G-8 Centre', 42924, '2020-12-06', '03:00:00', '2020-12-08', '01:00:00', 'Yes', 18400, 1),
(176, 'Pending', 1, 1, 'Home', 62647, '2020-12-05', '03:00:00', '2020-12-07', '17:00:00', 'Yes', 12400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `availability` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `name`, `availability`) VALUES
(2, 'Plumber', 'No'),
(17, 'Janitor', 'No'),
(19, 'Carpenter', 'Yes'),
(23, 'Welder', 'No'),
(24, 'Gardener', 'Yes'),
(32, 'Mechanic', 'Yes'),
(38, 'Electrician', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `temp_res`
--

CREATE TABLE `temp_res` (
  `temp_res_id` int(11) NOT NULL,
  `endTime` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `startTime` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `carid` int(11) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `charges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `phase` varchar(255) NOT NULL,
  `streetNo` varchar(255) NOT NULL,
  `houseNo` varchar(255) NOT NULL,
  `fulladdress` varchar(255) NOT NULL,
  `contactNo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notificationStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `cnic`, `phase`, `streetNo`, `houseNo`, `fulladdress`, `contactNo`, `status`, `notificationStatus`) VALUES
(1, 'Sheraz Kamran', 'sheraz@gmail.com', 'sk1234', '16101-3922317-1', '3', '4A', '499-C', 'House No:499-C, street 4A, phase 3, Comsian Residential Colony, Attock City.', '03065736825', 'confirmed', 1),
(2, 'Ubaid Ur Rehman', 'ubaid@gmail.com', 'ub1234', '37101-3922317-1', '3', '5B', '599-B', 'House No:599-B, street 5B, phase 3, Comsian Residential Colony, Attock City.', '03141782799', 'pending', 1),
(3, 'Uzair Mubashir', 'uzair@gmail.com', 'uz1234', '37101-3181766-1', '6', '8D', '1799', 'House No:1799, street 8D, phase 6, Comsian Residential Colony, Attock City.', '03331214156', 'confirmed', 1),
(4, 'Usama', 'usama@gmail.com', 'us1234', '37101-1234567-9', '5', 'S9', 'H9', 'House No:H9, street S9, phase 5, Comsian Residential Colony, Attock City.', '999', 'pending', 1),
(6, 'Akram', 'akram@gmail.com', 'ak1234', '37102356465', 'P-7', 'S-8', 'H-9', 'House No H-9  ,Street  S-8, Phase  P-7, Comsian Residential Colony, Attock City.', '123456', 'cancelled', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_item_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hired_service`
--
ALTER TABLE `hired_service`
  ADD PRIMARY KEY (`hired_service_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_prodcat_id` (`prodcat_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`prodcat_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserve_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `temp_res`
--
ALTER TABLE `temp_res`
  ADD PRIMARY KEY (`temp_res_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hired_service`
--
ALTER TABLE `hired_service`
  MODIFY `hired_service_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1044;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=825;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `placed_orders`
--
ALTER TABLE `placed_orders`
  MODIFY `unique_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1068;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `prodcat_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserve_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `temp_res`
--
ALTER TABLE `temp_res`
  MODIFY `temp_res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `hired_service`
--
ALTER TABLE `hired_service`
  ADD CONSTRAINT `hired_service_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `hired_service_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_prodcat_id` FOREIGN KEY (`prodcat_id`) REFERENCES `product_category` (`prodcat_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
