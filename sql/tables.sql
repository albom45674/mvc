DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `login` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `name` text NOT NULL,
  `type` char(1) NOT NULL, 
  PRIMARY KEY  (`login`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
