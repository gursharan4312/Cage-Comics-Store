CREATE DATABASE CAGESTORE;
USE CAGESTORE;

CREATE TABLE `comics` (
  `id` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `imageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comics` (`id`, `Name`, `Author`, `Description`, `price`, `imageURL`) VALUES
('1001', 'First Comic', 'Someone', '\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolo', 50.25, 'views/images/comicsCoverImages/comic1.jpeg'),
('1002', 'Second Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 40.25, 'views/images/comicsCoverImages/comic2.jpg'),
('1003', 'Third Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 20.25, 'views/images/comicsCoverImages/comic3.jpg'),
('1004', 'Fourth Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 100.88, 'views/images/comicsCoverImages/comic4.jpg'),
('1005', 'Fifth Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 50.99, 'views/images/comicsCoverImages/comic5.jpg'),
('1006', 'Sixth Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 15.55, 'views/images/comicsCoverImages/comic6.jpg'),
('1007', 'Seventh Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 52.22, 'views/images/comicsCoverImages/comic7.jpg'),
('1008', 'Eighth Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 49.99, 'views/images/comicsCoverImages/comic8.jpg'),
('1009', 'Nineth Comic', 'Someone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 10.01, 'views/images/comicsCoverImages/comic9.jpg');

CREATE TABLE `users` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`ID`, `Name`, `Email`, `phone`, `username`, `password`) VALUES
(1, 'Guest', 'guest12@gmail.com', '09876543210', '', ''),
(2, 'Gursharan Singh', 'gursharansingh4312@gmail,com', 'gursharan4312', 'gursharan', 'gursharan');

DELIMITER $$
CREATE PROCEDURE `getUser` (user VARCHAR(20))
BEGIN
  SELECT * from users where username=user;
END$$
