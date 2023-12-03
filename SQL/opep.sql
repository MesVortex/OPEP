
CREATE TABLE `category` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(50)
);

-- --------------------------------------------------------

CREATE TABLE `panier` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `userID` int(11) ,
  FOREIGN KEY (`userID`) REFERENCES `user` (`user_id`)
);

-- --------------------------------------------------------

CREATE TABLE `panierxplante` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `panierID` int(11) ,
  `planteID` int(11) ,
  FOREIGN KEY (`planteID`) REFERENCES `plante` (`plant_id`) ,
  FOREIGN KEY (`panierID`) REFERENCES `panier` (`id`)
);

-- --------------------------------------------------------

CREATE TABLE `plante` (
  `plant_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) ,
  `price` int(11) ,
  `category_id` int(11) ,
  `img_url` varchar(500) ,
  FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
);

-- --------------------------------------------------------

CREATE TABLE `role` (
  `role_id` int(11) ,
  `admin` tinyint(1) 
);

-- --------------------------------------------------------

CREATE TABLE `user` (
  `user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_FirstName` varchar(50) ,
  `user_Lastname` varchar(50) ,
  `Email` varchar(100) ,
  `Password` varchar(50) ,
  `user_role` int(11),
  FOREIGN KEY (`user_role`) REFERENCES `role` (`role_id`)
);