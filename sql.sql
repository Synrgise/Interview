/*
SQLyog - Free MySQL GUI v5.02
Host - 5.7.11 : Database - synrgise
*********************************************************************
Server version : 5.7.11
*/


create database if not exists `synrgise`;

USE `synrgise`;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `message_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `message` varchar(200) DEFAULT NULL,
  `seen` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

insert into `messages` values 
(1,25,'Welcome,Thank you for signup start managing your tasks today','F'),
(2,26,'Welcome,Thank you for signup start managing your tasks today','F');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `settings_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `settings` varchar(200) DEFAULT NULL,
  `seen` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert into `settings` values 
(1,25,'you are now able to update your profile within the settings tab','F'),
(2,26,'you are now able to update your profile within the settings tab','T');

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `task_id` int(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `body` varchar(200) NOT NULL,
  `complete` enum('T','F') NOT NULL,
  `due_date` date DEFAULT NULL,
  `user_id` int(50) NOT NULL,
  `publish` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tasks` */

insert into `tasks` values 
(3,'Task 33','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua','F','2020-12-14',6,'F'),
(4,'Task 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua','F','2020-12-14',6,'F'),
(5,'Task 5','LLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua','F','2020-12-14',6,'F');

/*Table structure for table `updates` */

DROP TABLE IF EXISTS `updates`;

CREATE TABLE `updates` (
  `update_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `updates` varchar(200) DEFAULT NULL,
  `seen` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `updates` */

insert into `updates` values 
(1,25,'We have added a new unpublish feature which you are sure to enjoy','F'),
(2,26,'We have added a new unpublish feature which you are sure to enjoy','T');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert into `users` values 
(1,'siviwe','ceevee'),
(2,'yanga','vellemm'),
(3,'yanga','liohchx'),
(4,'yanga','liohchx'),
(5,'�c�/[0w�.j�E�V�','\"�i[d��b<��HU�'),
(6,'F \r1��4N6�<','F \r1��4N6�<'),
(7,'��\0���c��[Џ�mw','��mT��q<G<ђIx�'),
(8,'��\0���c��[Џ�mw','��mT��q<G<ђIx�'),
(9,'t���YK�����KQ^','�]w��B�PglV�����'),
(10,'4�P\"�c�oO�0\\M','��Bq�1;��y��'),
(11,'z�D ���|= �j_�','��� f\0 :��T��z�a'),
(12,'נ+��V\'ƊV���(','�rm]�U�/�17���'),
(13,'���0���_���g��','�<lX\r�i)�~N7�'),
(14,'f�R-���*ېA�','�p��9|�����<'),
(15,'6N��<k��>�2J','�z;D/��Q�Զ��'),
(16,'F \r1��4N6�<','\'rWK<>vȷ�-ё�v'),
(17,'F \r1��4N6�<','��H�OA:����HU/'),
(18,'F \r1��4N6�<',' vd�u0�G�r��'),
(19,'��WkB���ş������','��;�l��q*e�\n�Q'),
(20,'��WkB���ş������','��;�l��q*e�\n�Q'),
(21,'��WkB���ş������','@�ЄCkp�3k��.'),
(22,'��WkB���ş������','@�ЄCkp�3k��.'),
(23,'��WkB���ş������','@�ЄCkp�3k��.'),
(24,'��WkB���ş������','@�ЄCkp�3k��.'),
(25,'F \r1��4N6�<','3{���6�:�����'),
(26,'F \r1��4N6�<','3{���6�:�����');
