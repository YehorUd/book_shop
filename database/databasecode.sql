CREATE TABLE `customers` (
  `pesel` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) not null,
  `password` varchar(20) not null,
  PRIMARY KEY (`pesel`) USING BTREE,
  UNIQUE KEY `uni_username` (`username`),
  UNIQUE KEY `uni_password` (`password`) USING BTREE
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `customers` (`pesel`, `username`, `password`)
VALUES 
('12345', 'admin', 'admin123'),
('123455', 'user', '123');


CREATE TABLE `orders`(
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(6,2) NOT NULL,
  `pesel` int(11) unsigned NOT NULL,
  PRIMARY KEY (`order_id`) USING BTREE,
  KEY `transaction_pesel` (`pesel`),
 CONSTRAINT `transaction_pesel` FOREIGN KEY (`pesel`) 
 REFERENCES `customers` (`pesel`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `orders` (`order_id`, `price`, `pesel`)
VALUES 
(1, '40.00', '123455'),
(2, '123', '123455');

CREATE TABLE `order_items` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `order_items` (`order_id`, `book_isbn`, `item_price`, `quantity`) VALUES
(1, '978-1-118-94924-5', '20.00', 1),
(1, '978-1-44937-019-0', '20.00', 1);

CREATE TABLE `books` (
  `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `book_title` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `book_author` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `book_categories` text COLLATE latin1_general_ci DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_categories`, `book_price`) 

VALUES ('64568', 'Sample 102', 'Sample Author 2', 'Test - updated', '1200.00'),
('978-0-321-94786-4', 'Learning Mobile App Development', 'Jakob Iversen, Michael Eierman', 'Programming', '20.00'),
('978-0-7303-1484-4', 'Doing Good By Doing Good', 'Peter Baines', 'Programming', '20.00'),
('978-1-118-94924-5', 'Programmable Logic Controllers', 'Dag H. Hanssen', 'Programming', '20.00'),
('978-1-1180-2669-4', 'Professional JavaScript for Web Developers, 3rd Edition', 'Nicholas C. Zakas', 'Programming', '20.00'),
('978-1-44937-019-0', 'Learning Web App Development', 'Semmy Purewal', 'Programming', '20.00');
