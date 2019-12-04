use `qatestlab`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tittle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `authors` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `book_id` int(11) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `authors_books` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_id` int(11) not null,
  `author_id` int(11) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;