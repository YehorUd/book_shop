CREATE TABLE `customers` (
  `pesel` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) not null,
  `password` varchar(20) not null,
  PRIMARY KEY (`pesel`) USING BTREE,
  UNIQUE KEY `uni_username` (`username`),
  UNIQUE KEY `uni_password` (`password`) USING BTREE
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `customers` (`pesel`, `username`, `password`)
VALUES 
('123456789', 'admin', 'admin123'),
('801230474', 'user', '123'),
('132815418', 'Hero', 'jadij2003'),
('918273948', 'Jadik', 'bryalem1983'),
('243218339', 'Bafjghe14', 'robotxx'),
('455830918', 'Boomu4', 'harakiri104'),
('361395770', 'Bulka23', 'Harijsto2000'),
('572085395', '2marvin2', 'hiruxoja41'),
('682578529', 'Holder772', 'pokemongovpl'),
('794820509', 'NumberOne', 'shabudabi1982');

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesel` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('Pending','Completed','Cancelled') COLLATE latin1_general_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `pesel` (`pesel`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`pesel`) REFERENCES `customers` (`pesel`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `order_items` (
  id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL,
  book_id int(11) COLLATE latin1_general_ci NOT NULL,
  quantity int(5) NOT NULL,
  price decimal(6,2) NOT NULL,
  PRIMARY KEY (id),
  KEY order_id (order_id),
  KEY book_id (book_id),
  FOREIGN KEY (order_id) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
ALTER TABLE order_items
ADD FOREIGN KEY (book_id) REFERENCES `books`(`book_isbn`);


CREATE TABLE `books` (
  `book_isbn` int(11) COLLATE latin1_general_ci NOT NULL,
  `book_title` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `book_author` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `book_categories` text COLLATE latin1_general_ci DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`book_isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_categories`, `book_price`) 

VALUES 
('64568', 'Sample 102', 'Sample Author 2', 'Test - updated', '1200.00'),
('978032194', 'Learning Mobile App Development', 'Jakob Iversen, Michael Eierman', 'Programming', '81.00'),
('978073031', 'Doing Good By Doing Good', 'Peter Baines', 'Programming', '12.00'),
('978111894', 'Programmable Logic Controllers', 'Dag H. Hanssen', 'Programming', '63.00'),
('978111802', 'Professional JavaScript for Web Developers, 3rd Edition', 'Nicholas C. Zakas', 'Programming', '15.00'),
('978144937', 'Learning Web App Development', 'Semmy Purewal', 'Programming', '20.00'),
('978032994', 'Among the Thugs', 'Bill Buford', 'Sport', '199.00'),
('978032995', 'The Game', 'Ken Dryden', 'Sport', '24.00'),
('978032996', 'The Natural', 'Bernard Malamud', 'Sport', '26.00'),
('978032997', 'Friday Night Lights: A Town, a Team, and a Dream', 'Buzz Bissinger', 'Sport', '89.00');