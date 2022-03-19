CREATE DATABASE db_api_rest_php;
USE db_api_rest_php;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `user`, `password`, `status`) VALUES
('1', 'Test01', 'admin', 'admin', '1'),
('2', 'Test02', 'admin02', 'admin02', '1');