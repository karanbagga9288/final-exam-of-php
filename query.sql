
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `entry` (
  `user_id` int(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `text` varchar(100) NOT NULL,
  `publish_date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `books` (`user_id`, `fullname`, `text`,`publish_date`, `email`, `title`) VALUES
(20045, 'karanbagga', 'uidgbdjdw', '555', 'bagga@gmail.com', 'fuhe'),
(20046, 'tananbagga', 'jebfhqoiwlifwh', '554', 'tanan@gmail.com', 'hcidf'),
(20048, 'manjubagga', 'jqwifhqwoifhwihi', '22', 'mannu@gmail.com', 'iudwu');


ALTER TABLE `entry`
  ADD PRIMARY KEY (`user_id`);

