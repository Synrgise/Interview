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
(5,'¥cÖ/[0w’.jßEßVÙ','\"´i[dÿ‹b<ìùHUð'),
(6,'F \r1˜²4N6Š<','F \r1˜²4N6Š<'),
(7,'³¡\0•Á†cçØ[Ðämw','ÈÇmT½q<G<Ñ’Ix '),
(8,'³¡\0•Á†cçØ[Ðämw','ÈÇmT½q<G<Ñ’Ix '),
(9,'tÌ÷°YK½‡µùÔKQ^','¯]wÝBÖPglVŸÁ¹žì'),
(10,'4ÎP\"´cÍoOŽ0\\M','­—BqÁ1;èÉy»†'),
(11,'zÓD ‡‚|= àj_Á','»Á f\0 :û„Tžüzâa'),
(12,'× +Ÿ V\'ÆŠV•ÒÉ(','•rm]¾UÆ/Õ17ÔÂ×'),
(13,'•¤ð0†“Ù_ªŸ¦g–Ù','ï<lX\rŽi)Ï~N7Á'),
(14,'f½R-½æ‚™*ÛAã','êpü‘9|ÿÓÿˆŒ<'),
(15,'6N›ì±<k“•>îŸ2J','Ëz;D/ÞÕQ¡Ô¶¨¨'),
(16,'F \r1˜²4N6Š<','\'rWK<>vÈ·½-Ñ‘öv'),
(17,'F \r1˜²4N6Š<','‹°HõOA:ýµâí®HU/'),
(18,'F \r1˜²4N6Š<',' vd»u0ŽGò–£r¿Ã'),
(19,'ÚÙWkB–§ŽÅŸ¹©€Íøì','ÿ¼;ôŠlºÜq*eþ\nÌQ'),
(20,'ÚÙWkB–§ŽÅŸ¹©€Íøì','ÿ¼;ôŠlºÜq*eþ\nÌQ'),
(21,'ÚÙWkB–§ŽÅŸ¹©€Íøì','@–Ð„CkpØ3kºŒ.'),
(22,'ÚÙWkB–§ŽÅŸ¹©€Íøì','@–Ð„CkpØ3kºŒ.'),
(23,'ÚÙWkB–§ŽÅŸ¹©€Íøì','@–Ð„CkpØ3kºŒ.'),
(24,'ÚÙWkB–§ŽÅŸ¹©€Íøì','@–Ð„CkpØ3kºŒ.'),
(25,'F \r1˜²4N6Š<','3{²«–6Í:Šº †ä€'),
(26,'F \r1˜²4N6Š<','3{²«–6Í:Šº †ä€');
