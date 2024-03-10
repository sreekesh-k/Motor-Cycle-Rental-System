-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2024 at 07:39 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motorcycle_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

DROP TABLE IF EXISTS `bike`;
CREATE TABLE IF NOT EXISTS `bike` (
  `bike_id` int NOT NULL AUTO_INCREMENT,
  `bike_name` varchar(40) NOT NULL,
  `model_year` year NOT NULL,
  `img_url` text NOT NULL,
  `perhour_cost` int NOT NULL,
  `engine_cc` varchar(10) NOT NULL,
  `bhp` varchar(10) NOT NULL,
  `torque` varchar(10) NOT NULL,
  `transmission` varchar(20) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  PRIMARY KEY (`bike_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`bike_id`, `bike_name`, `model_year`, `img_url`, `perhour_cost`, `engine_cc`, `bhp`, `torque`, `transmission`, `is_available`) VALUES
(1, 'Royal Enfield Himalayan', '2023', 'https://assets.otocapital.in/prod/granite-black-royal-enfield-himalayan-image.jpeg', 42, '411 cc', '24.5 bhp', '32 Nm', '6 speed', 0),
(2, 'Honda Hornet 2.0', '2021', 'https://etimg.etb2bimg.com/photo/103142815.cms', 28, '184.4 cc', '17.03 bhp', '15.9 Nm', '5 speed', 1),
(3, 'Honda CB300R', '2022', 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/162507/cb300r-2023-right-side-view.jpeg?isig=0', 38, '300 cc', '30.7', '27.5 Nm', '6 speed', 0),
(4, 'Suzuki V-Storm SX', '2023', 'https://sunstatemotorcycles.com.au/wp-content/uploads/2023/02/V-STROM_SX_M3_YU1_Right-e1669340640275-730x490-1.jpg', 35, '249 cc', '26.1 bhp', '22.2 Nm', '6 speed', 0),
(5, 'Suzuki Gixxer SF 250', '2021', 'https://motobike.in/wp-content/uploads/2020/12/Suzuki-Gixxer-SF-250-Metallic-Matte-Black.jpg', 35, '249 cc', '13.4 bhp', '13.8 Nm', '5 speed', 0),
(6, 'TVS Apache RTR 160 4V', '2020', 'https://www.tvsmotor.com/tvs-apache/-/media/Brand-Pages-Webp/RTR-160-4V/Desktop/Concept-750x536.webp', 28, '160 cc', '17.31 bhp', '14.73 Nm', '5 speed', 0),
(7, 'Honda CB Unicorn 150', '2018', 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/49459/unicorn-right-side-view.png?isig=0', 25, '150 cc', '12 bhp', '13 Nm', '5 speed', 0),
(8, 'Hero Xpulse 200 4V', '2019', 'https://www.bigbikerentals.com/wp-content/uploads/2022/02/hero-xpulse-200-4v-red-colour.jpg.webp', 30, '199.9 cc', '18.9 bhp', '17.35 Nm', '5 speed', 0),
(9, 'Yamaha MT 15', '2023', 'https://imgd.aeplcdn.com/664x374/n/cw/ec/95105/left-side-view.jpeg?q=80', 28, '149 cc', '18.1 bhp', '14.1 Nm', '6 speed', 0),
(10, 'Suzuki Gixxer', '2020', 'https://imgd.aeplcdn.com/664x374/n/cw/ec/1/versions/suzuki-gixxer-single-channel-abs---bs-vi1676628003141.jpg?q=80', 27, '155 cc', '13.4 bhp', '13.8 Nm', '5 speed', 0),
(11, 'Royal Enfield Classic 350', '2021', 'https://www.royalenfield.com/content/dam/royal-enfield/classic-350/colors/studio-shots/dual-channel/dark-stealth-black/new/01-dark-stealth-black.jpg', 40, '350 cc', '20 bhp', '27 Nm', '5 speed', 0),
(12, 'Royal Enfield Scram 411', '2023', 'https://cdn.dealerspike.com/imglib/v1/800x600/imglib/trimsdb/19546881-0-120876731.png', 45, '411 cc', '24.3 bhp ', '32 Nm', '6 speed', 0),
(13, 'Honda CB 200 X', '2023', 'https://imgd.aeplcdn.com/664x374/n/cw/ec/157629/cb200x-right-side-view.png?isig=0&q=80', 30, '180 cc', '17.03 bhp', '15.9 Nm', '6 speed', 0),
(14, 'Yamaha FZ V3', '2020', 'https://imgd.aeplcdn.com/664x374/n/cw/ec/49494/fz-right-side-view.png?isig=0&q=80', 26, '149 cc', '12.2 bhp', '13.3 Nm', '5 speed', 0),
(15, 'Royal Enfield Bullet 350', '2018', 'https://www.otocapital.in/_next/image?url=https%3A%2F%2Fassets.otocapital.in%2Fprod%2Fblack-royal-enfield-bullet-x350-image.webp&w=1536&q=75', 39, '350 cc', '20 bhp', '27 Nm', '5 speed', 1),
(16, 'Bajaj Dominar 400', '2022', 'https://cdn.bajajauto.com/-/media/assets/bajajauto/360degreeimages/bikes/dominar/dominar400-green/00.png', 43, '373 cc', '39.42 bhp', '35 Nm', '6 speed', 0),
(17, 'Royal Enfield Intercepter 650', '2023', 'https://www.royalenfield.com/content/dam/royal-enfield/united-kingdom/motorcycles/interceptor/colours/studio-shots/new/baker-express/side-view.png', 50, '647.95 cc', '47 bhp', '52 Nm', '6 speed', 0),
(18, 'Bajaj Pulser 200 NS', '2020', 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/58025/pulsar-ns-right-side-view-2.png?isig=0', 30, '199.5 cc', '24.13 bhp', '18.74 Nm', '5 speed', 0),
(19, 'KTM 390 Duke', '2022', 'https://imgd.aeplcdn.com/424x424/n/cw/ec/129747/duke-390-left-front-three-quarter.png?isig=0&q=80', 45, '373.27 cc', '42.9 bhp ', '37 Nm', '6 speed', 0),
(20, 'Honda CB 350RS', '2021', 'https://akm-img-a-in.tosshub.com/indiatoday/images/story/202102/Honda_CB350_RS_Black_with_Pear_0_1200x768.jpeg?size=1200:675', 38, '348 cc', '20.78 bhp', '30 Nm', '6 speed', 0),
(21, 'Yamaha R15 V4', '2023', 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/101027/right-side-view1.jpeg?isig=0', 30, '155 cc', '18.1 bhp', '14.2 Nm', '6 speed', 0),
(22, 'Bajaj Dominar 250', '2022', 'https://5.imimg.com/data5/SELLER/Default/2023/8/336919826/UO/KI/YK/3535906/bajaj-motorcycle-dominar-250.png', 35, '248.8 cc', '26.63 bhp', '23.5 Nm', '6 speed', 0),
(23, 'KTM 250 Duke', '2023', 'https://imgd.aeplcdn.com/1280x720/n/cw/ec/129745/250-duke-left-front-three-quarter.gif?isig=0', 35, '248.76 cc', '30.57 bhp', '25 Nm', '6 speed', 0),
(24, 'Honda Hness CB350', '2021', 'https://carbonracing.in/cdn/shop/collections/images--95_grande.jpg?v=1605685297', 40, '348 cc', '20.78 bhp', '30 Nm', '6 speed', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
