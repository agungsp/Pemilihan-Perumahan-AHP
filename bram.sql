/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.1.30-MariaDB : Database - bram
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bram` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bram`;

/*Table structure for table `masterdevelopers` */

DROP TABLE IF EXISTS `masterdevelopers`;

CREATE TABLE `masterdevelopers` (
  `IdDeveloper` int(11) NOT NULL AUTO_INCREMENT,
  `IdWilayah` int(11) DEFAULT NULL,
  `KodeDeveloper` varchar(25) DEFAULT NULL,
  `NamaDeveloper` varchar(50) DEFAULT NULL,
  `Alamat` varchar(1000) DEFAULT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  `IdUserCreate` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `IdUserUpdate` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdDeveloper`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `masterdevelopers` */

insert  into `masterdevelopers`(`IdDeveloper`,`IdWilayah`,`KodeDeveloper`,`NamaDeveloper`,`Alamat`,`NoTelp`,`IdUserCreate`,`created_at`,`IdUserUpdate`,`updated_at`) values 
(1,3,'CPTR','Ciputra Property','Surabaya','0867 1537 3521',1,'2019-09-08 05:52:16',1,'2019-09-08 05:52:16');

/*Table structure for table `masterfasilitass` */

DROP TABLE IF EXISTS `masterfasilitass`;

CREATE TABLE `masterfasilitass` (
  `IdFasilitas` int(11) DEFAULT NULL,
  `NamaFasilitas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `masterfasilitass` */

/*Table structure for table `masterkriterias` */

DROP TABLE IF EXISTS `masterkriterias`;

CREATE TABLE `masterkriterias` (
  `IdKriteria` int(11) NOT NULL AUTO_INCREMENT,
  `KodeKriteria` varchar(25) DEFAULT NULL,
  `NamaKriteria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdKriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `masterkriterias` */

insert  into `masterkriterias`(`IdKriteria`,`KodeKriteria`,`NamaKriteria`) values 
(1,'K001','Harga'),
(2,'K002','Akses'),
(3,'K003','Sertifikat'),
(4,'K004','Fasilitas'),
(5,'K005','Tipe');

/*Table structure for table `masterperumahans` */

DROP TABLE IF EXISTS `masterperumahans`;

CREATE TABLE `masterperumahans` (
  `IdPerumahan` int(11) NOT NULL AUTO_INCREMENT,
  `IdDeveloper` int(11) DEFAULT NULL,
  `KodePerumahan` varchar(25) DEFAULT NULL,
  `NamaPerumahan` varchar(100) DEFAULT NULL,
  `Alamat` varchar(1000) DEFAULT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  `Fax` varchar(15) DEFAULT NULL,
  `IdMUserCreate` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `IdMUserUpdate` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdPerumahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `masterperumahans` */

insert  into `masterperumahans`(`IdPerumahan`,`IdDeveloper`,`KodePerumahan`,`NamaPerumahan`,`Alamat`,`NoTelp`,`Fax`,`IdMUserCreate`,`created_at`,`IdMUserUpdate`,`updated_at`) values 
(1,1,'CPTR-001','Ciputara Satu lagi','Surabaya Brow','0871 5252 61917','',1,'2019-09-24 14:20:39',1,'2019-09-24 14:57:46');

/*Table structure for table `masterrumahs` */

DROP TABLE IF EXISTS `masterrumahs`;

CREATE TABLE `masterrumahs` (
  `IdRumah` int(11) NOT NULL AUTO_INCREMENT,
  `IdPerumahan` int(11) DEFAULT NULL,
  `KodeRumah` varchar(25) DEFAULT NULL,
  `NamaRumah` varchar(100) DEFAULT NULL,
  `IsKeamanan` tinyint(1) DEFAULT NULL,
  `IsTempatIbadah` tinyint(1) DEFAULT NULL,
  `IsTaman` tinyint(1) DEFAULT NULL,
  `IsMarket` tinyint(1) DEFAULT NULL,
  `IsOlahraga` tinyint(1) DEFAULT NULL,
  `FasilitasLain` text,
  `Harga` decimal(20,2) DEFAULT NULL,
  `Akses` decimal(10,2) DEFAULT NULL,
  `Sertifikat` varchar(10) DEFAULT NULL,
  `Tipe` int(5) DEFAULT NULL,
  `LuasTanah` decimal(10,2) DEFAULT NULL,
  `GambarRumah` varchar(1000) DEFAULT NULL,
  `GambarRumahTumb` varchar(1000) DEFAULT NULL,
  `GambarDenah` varchar(1000) DEFAULT NULL,
  `GambarDenahTumb` varchar(1000) DEFAULT NULL,
  `IdUserCreate` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `IdUserUpdate` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdRumah`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `masterrumahs` */

insert  into `masterrumahs`(`IdRumah`,`IdPerumahan`,`KodeRumah`,`NamaRumah`,`IsKeamanan`,`IsTempatIbadah`,`IsTaman`,`IsMarket`,`IsOlahraga`,`FasilitasLain`,`Harga`,`Akses`,`Sertifikat`,`Tipe`,`LuasTanah`,`GambarRumah`,`GambarRumahTumb`,`GambarDenah`,`GambarDenahTumb`,`IdUserCreate`,`created_at`,`IdUserUpdate`,`updated_at`) values 
(3,1,'CPTR-001-001','blok AE-17',1,1,0,0,0,'',970000000.00,15.00,'SHM',54,111.00,'http://localhost/storage/CPTR-001-001.jpg','http://localhost/storage/CPTR-001-001_tumb.jpg','http://localhost/storage/CPTR-001-001_denah.jpg','http://localhost/storage/CPTR-001-001_denah_tumb.jpg',1,'2019-09-27 14:50:34',3,'2019-11-04 14:23:32'),
(4,1,'CPTR-001-002','Coba Cuy',1,1,1,1,1,'',290000000.00,10.00,'SHM',58,NULL,'http://localhost/storage/CPTR-001-002.jpg','http://localhost/storage/CPTR-001-002_tumb.jpg','http://localhost/storage/CPTR-001-002_denah.jpg','http://localhost/storage/CPTR-001-002_denah_tumb.jpg',1,'2019-10-29 16:37:02',1,'2019-10-29 16:37:02'),
(6,1,'CPTR-001-003','Coba Cuy New',1,1,1,1,1,'-',10000000.00,5.00,'SHM',120,NULL,'http://localhost/storage/CPTR-001-003.jpg','http://localhost/storage/CPTR-001-003_tumb.jpg','http://localhost/storage/CPTR-001-003_denah.jpg','http://localhost/storage/CPTR-001-003_denah_tumb.jpg',3,'2019-11-02 15:46:49',3,'2019-11-02 15:46:49');

/*Table structure for table `masterusers` */

DROP TABLE IF EXISTS `masterusers`;

CREATE TABLE `masterusers` (
  `IdMUser` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(25) DEFAULT NULL,
  `NamaUser` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdMUser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `masterusers` */

insert  into `masterusers`(`IdMUser`,`Username`,`NamaUser`,`Password`,`created_at`,`updated_at`) values 
(1,'agungsp','Agung Setyo Pribadi','aa26277dcfe9aaf06a589151e5575a51','2019-08-25 00:34:04','2019-08-25 00:34:04'),
(3,'bram','Bramantyas Manggala','e4fa3adecabcf036f6f95da68bfe76bb','2019-11-02 15:01:21','2019-11-02 15:01:21');

/*Table structure for table `masterwilayahs` */

DROP TABLE IF EXISTS `masterwilayahs`;

CREATE TABLE `masterwilayahs` (
  `IdWilayah` int(11) NOT NULL AUTO_INCREMENT,
  `KodeWilayah` varchar(25) DEFAULT NULL,
  `NamaWilayah` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdWilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `masterwilayahs` */

insert  into `masterwilayahs`(`IdWilayah`,`KodeWilayah`,`NamaWilayah`) values 
(1,'SBYPST','SURABAYA PUSAT'),
(2,'SBYTMR','SURABAYA TIMUR'),
(3,'SBYBRT','SURABAYA BARAT'),
(4,'SBYUTR','SURABAYA UTARA'),
(5,'SBYSTN','SURABAYA SELATAN');

/*Table structure for table `getdeveloperview` */

DROP TABLE IF EXISTS `getdeveloperview`;

/*!50001 DROP VIEW IF EXISTS `getdeveloperview` */;
/*!50001 DROP TABLE IF EXISTS `getdeveloperview` */;

/*!50001 CREATE TABLE  `getdeveloperview`(
 `IdDeveloper` int(11) ,
 `IdWilayah` int(11) ,
 `KodeDeveloper` varchar(25) ,
 `NamaDeveloper` varchar(50) ,
 `Alamat` varchar(1000) ,
 `NoTelp` varchar(15) ,
 `IdUserCreate` int(11) ,
 `created_at` datetime ,
 `IdUserUpdate` int(11) ,
 `updated_at` datetime ,
 `NamaWilayah` varchar(50) 
)*/;

/*Table structure for table `getnomorperumahanperdeveloper` */

DROP TABLE IF EXISTS `getnomorperumahanperdeveloper`;

/*!50001 DROP VIEW IF EXISTS `getnomorperumahanperdeveloper` */;
/*!50001 DROP TABLE IF EXISTS `getnomorperumahanperdeveloper` */;

/*!50001 CREATE TABLE  `getnomorperumahanperdeveloper`(
 `IdDeveloper` int(11) ,
 `IdWilayah` int(11) ,
 `KodeDeveloper` varchar(25) ,
 `NamaDeveloper` varchar(50) ,
 `Alamat` varchar(1000) ,
 `NoTelp` varchar(15) ,
 `IdUserCreate` int(11) ,
 `created_at` datetime ,
 `IdUserUpdate` int(11) ,
 `updated_at` datetime ,
 `NomorPerumahan` bigint(21) 
)*/;

/*Table structure for table `getnomorrumahperperumahan` */

DROP TABLE IF EXISTS `getnomorrumahperperumahan`;

/*!50001 DROP VIEW IF EXISTS `getnomorrumahperperumahan` */;
/*!50001 DROP TABLE IF EXISTS `getnomorrumahperperumahan` */;

/*!50001 CREATE TABLE  `getnomorrumahperperumahan`(
 `IdPerumahan` int(11) ,
 `IdDeveloper` int(11) ,
 `KodePerumahan` varchar(25) ,
 `NamaPerumahan` varchar(100) ,
 `Alamat` varchar(1000) ,
 `NoTelp` varchar(15) ,
 `Fax` varchar(15) ,
 `IdMUserCreate` int(11) ,
 `created_at` datetime ,
 `IdMUserUpdate` int(11) ,
 `updated_at` datetime ,
 `NomorRumah` bigint(21) 
)*/;

/*Table structure for table `getviewnilaistandar` */

DROP TABLE IF EXISTS `getviewnilaistandar`;

/*!50001 DROP VIEW IF EXISTS `getviewnilaistandar` */;
/*!50001 DROP TABLE IF EXISTS `getviewnilaistandar` */;

/*!50001 CREATE TABLE  `getviewnilaistandar`(
 `IdRumah` int(11) ,
 `IdPerumahan` int(11) ,
 `KodeRumah` varchar(25) ,
 `NamaRumah` varchar(100) ,
 `IsKeamanan` tinyint(1) ,
 `IsTempatIbadah` tinyint(1) ,
 `IsTaman` tinyint(1) ,
 `IsMarket` tinyint(1) ,
 `IsOlahraga` tinyint(1) ,
 `FasilitasLain` text ,
 `Harga` decimal(20,2) ,
 `Akses` decimal(10,2) ,
 `Sertifikat` varchar(10) ,
 `Tipe` int(5) ,
 `LuasTanah` decimal(10,2) ,
 `GambarRumah` varchar(1000) ,
 `GambarRumahTumb` varchar(1000) ,
 `GambarDenah` varchar(1000) ,
 `GambarDenahTumb` varchar(1000) ,
 `IdUserCreate` int(11) ,
 `created_at` datetime ,
 `IdUserUpdate` int(11) ,
 `updated_at` datetime ,
 `N_Harga` int(1) ,
 `N_Akses` int(1) ,
 `N_Sertifikat` int(1) ,
 `N_Fasilitas` int(1) ,
 `N_Tipe` int(1) 
)*/;

/*Table structure for table `getviewperumahan` */

DROP TABLE IF EXISTS `getviewperumahan`;

/*!50001 DROP VIEW IF EXISTS `getviewperumahan` */;
/*!50001 DROP TABLE IF EXISTS `getviewperumahan` */;

/*!50001 CREATE TABLE  `getviewperumahan`(
 `IdPerumahan` int(11) ,
 `IdDeveloper` int(11) ,
 `KodePerumahan` varchar(25) ,
 `NamaPerumahan` varchar(100) ,
 `Alamat` varchar(1000) ,
 `NoTelp` varchar(15) ,
 `Fax` varchar(15) ,
 `IdMUserCreate` int(11) ,
 `created_at` datetime ,
 `IdMUserUpdate` int(11) ,
 `updated_at` datetime ,
 `KodeDeveloper` varchar(25) ,
 `NamaDeveloper` varchar(50) 
)*/;

/*Table structure for table `getviewrumah` */

DROP TABLE IF EXISTS `getviewrumah`;

/*!50001 DROP VIEW IF EXISTS `getviewrumah` */;
/*!50001 DROP TABLE IF EXISTS `getviewrumah` */;

/*!50001 CREATE TABLE  `getviewrumah`(
 `IdRumah` int(11) ,
 `IdPerumahan` int(11) ,
 `KodeRumah` varchar(25) ,
 `NamaRumah` varchar(100) ,
 `IsKeamanan` tinyint(1) ,
 `IsTempatIbadah` tinyint(1) ,
 `IsTaman` tinyint(1) ,
 `IsMarket` tinyint(1) ,
 `IsOlahraga` tinyint(1) ,
 `FasilitasLain` text ,
 `Harga` decimal(20,2) ,
 `Akses` decimal(10,2) ,
 `Sertifikat` varchar(10) ,
 `Tipe` int(5) ,
 `LuasTanah` decimal(10,2) ,
 `GambarRumah` varchar(1000) ,
 `GambarRumahTumb` varchar(1000) ,
 `GambarDenah` varchar(1000) ,
 `GambarDenahTumb` varchar(1000) ,
 `IdUserCreate` int(11) ,
 `created_at` datetime ,
 `IdUserUpdate` int(11) ,
 `updated_at` datetime ,
 `KodePerumahan` varchar(25) ,
 `NamaPerumahan` varchar(100) 
)*/;

/*View structure for view getdeveloperview */

/*!50001 DROP TABLE IF EXISTS `getdeveloperview` */;
/*!50001 DROP VIEW IF EXISTS `getdeveloperview` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getdeveloperview` AS select `m`.`IdDeveloper` AS `IdDeveloper`,`m`.`IdWilayah` AS `IdWilayah`,`m`.`KodeDeveloper` AS `KodeDeveloper`,`m`.`NamaDeveloper` AS `NamaDeveloper`,`m`.`Alamat` AS `Alamat`,`m`.`NoTelp` AS `NoTelp`,`m`.`IdUserCreate` AS `IdUserCreate`,`m`.`created_at` AS `created_at`,`m`.`IdUserUpdate` AS `IdUserUpdate`,`m`.`updated_at` AS `updated_at`,`wil`.`NamaWilayah` AS `NamaWilayah` from (`masterdevelopers` `m` left join `masterwilayahs` `wil` on((`wil`.`IdWilayah` = `m`.`IdWilayah`))) */;

/*View structure for view getnomorperumahanperdeveloper */

/*!50001 DROP TABLE IF EXISTS `getnomorperumahanperdeveloper` */;
/*!50001 DROP VIEW IF EXISTS `getnomorperumahanperdeveloper` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getnomorperumahanperdeveloper` AS select `m`.`IdDeveloper` AS `IdDeveloper`,`m`.`IdWilayah` AS `IdWilayah`,`m`.`KodeDeveloper` AS `KodeDeveloper`,`m`.`NamaDeveloper` AS `NamaDeveloper`,`m`.`Alamat` AS `Alamat`,`m`.`NoTelp` AS `NoTelp`,`m`.`IdUserCreate` AS `IdUserCreate`,`m`.`created_at` AS `created_at`,`m`.`IdUserUpdate` AS `IdUserUpdate`,`m`.`updated_at` AS `updated_at`,count(`v`.`IdDeveloper`) AS `NomorPerumahan` from (`masterdevelopers` `m` left join `masterperumahans` `v` on((`m`.`IdDeveloper` = `v`.`IdDeveloper`))) group by `m`.`IdDeveloper` */;

/*View structure for view getnomorrumahperperumahan */

/*!50001 DROP TABLE IF EXISTS `getnomorrumahperperumahan` */;
/*!50001 DROP VIEW IF EXISTS `getnomorrumahperperumahan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getnomorrumahperperumahan` AS select `m`.`IdPerumahan` AS `IdPerumahan`,`m`.`IdDeveloper` AS `IdDeveloper`,`m`.`KodePerumahan` AS `KodePerumahan`,`m`.`NamaPerumahan` AS `NamaPerumahan`,`m`.`Alamat` AS `Alamat`,`m`.`NoTelp` AS `NoTelp`,`m`.`Fax` AS `Fax`,`m`.`IdMUserCreate` AS `IdMUserCreate`,`m`.`created_at` AS `created_at`,`m`.`IdMUserUpdate` AS `IdMUserUpdate`,`m`.`updated_at` AS `updated_at`,count(`v`.`IdPerumahan`) AS `NomorRumah` from (`masterperumahans` `m` left join `masterrumahs` `v` on((`m`.`IdPerumahan` = `v`.`IdPerumahan`))) group by `m`.`IdPerumahan` */;

/*View structure for view getviewnilaistandar */

/*!50001 DROP TABLE IF EXISTS `getviewnilaistandar` */;
/*!50001 DROP VIEW IF EXISTS `getviewnilaistandar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getviewnilaistandar` AS select `rmh`.`IdRumah` AS `IdRumah`,`rmh`.`IdPerumahan` AS `IdPerumahan`,`rmh`.`KodeRumah` AS `KodeRumah`,`rmh`.`NamaRumah` AS `NamaRumah`,`rmh`.`IsKeamanan` AS `IsKeamanan`,`rmh`.`IsTempatIbadah` AS `IsTempatIbadah`,`rmh`.`IsTaman` AS `IsTaman`,`rmh`.`IsMarket` AS `IsMarket`,`rmh`.`IsOlahraga` AS `IsOlahraga`,`rmh`.`FasilitasLain` AS `FasilitasLain`,`rmh`.`Harga` AS `Harga`,`rmh`.`Akses` AS `Akses`,`rmh`.`Sertifikat` AS `Sertifikat`,`rmh`.`Tipe` AS `Tipe`,`rmh`.`LuasTanah` AS `LuasTanah`,`rmh`.`GambarRumah` AS `GambarRumah`,`rmh`.`GambarRumahTumb` AS `GambarRumahTumb`,`rmh`.`GambarDenah` AS `GambarDenah`,`rmh`.`GambarDenahTumb` AS `GambarDenahTumb`,`rmh`.`IdUserCreate` AS `IdUserCreate`,`rmh`.`created_at` AS `created_at`,`rmh`.`IdUserUpdate` AS `IdUserUpdate`,`rmh`.`updated_at` AS `updated_at`,if((`rmh`.`Harga` <= 800000000),3,if((`rmh`.`Harga` <= 1000000000),2,if((`rmh`.`Harga` > 1000000000),1,0))) AS `N_Harga`,if((`rmh`.`Akses` <= 10),3,if((`rmh`.`Akses` <= 30),2,if((`rmh`.`Akses` > 30),1,0))) AS `N_Akses`,if((`rmh`.`Sertifikat` = 'SHM'),2,if((`rmh`.`Sertifikat` = 'SHGB'),1,0)) AS `N_Sertifikat`,if(((`rmh`.`IsKeamanan` = 1) and (`rmh`.`IsTempatIbadah` = 1) and (`rmh`.`IsTaman` = 1) and (`rmh`.`IsMarket` = 1) and (`rmh`.`IsOlahraga` = 1)),3,if(((`rmh`.`IsKeamanan` = 1) and (`rmh`.`IsTempatIbadah` = 1) and (`rmh`.`IsTaman` = 1) and (`rmh`.`IsMarket` = 0) and (`rmh`.`IsOlahraga` = 0)),2,if(((`rmh`.`IsKeamanan` = 1) and (`rmh`.`IsTempatIbadah` = 1) and (`rmh`.`IsTaman` = 0) and (`rmh`.`IsMarket` = 0) and (`rmh`.`IsOlahraga` = 0)),1,0))) AS `N_Fasilitas`,if((`rmh`.`Tipe` > 50),3,if((`rmh`.`Tipe` <= 50),2,if((`rmh`.`Tipe` <= 30),1,0))) AS `N_Tipe` from `masterrumahs` `rmh` */;

/*View structure for view getviewperumahan */

/*!50001 DROP TABLE IF EXISTS `getviewperumahan` */;
/*!50001 DROP VIEW IF EXISTS `getviewperumahan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getviewperumahan` AS select `m`.`IdPerumahan` AS `IdPerumahan`,`m`.`IdDeveloper` AS `IdDeveloper`,`m`.`KodePerumahan` AS `KodePerumahan`,`m`.`NamaPerumahan` AS `NamaPerumahan`,`m`.`Alamat` AS `Alamat`,`m`.`NoTelp` AS `NoTelp`,`m`.`Fax` AS `Fax`,`m`.`IdMUserCreate` AS `IdMUserCreate`,`m`.`created_at` AS `created_at`,`m`.`IdMUserUpdate` AS `IdMUserUpdate`,`m`.`updated_at` AS `updated_at`,`dev`.`KodeDeveloper` AS `KodeDeveloper`,`dev`.`NamaDeveloper` AS `NamaDeveloper` from (`masterperumahans` `m` left join `masterdevelopers` `dev` on((`m`.`IdDeveloper` = `dev`.`IdDeveloper`))) */;

/*View structure for view getviewrumah */

/*!50001 DROP TABLE IF EXISTS `getviewrumah` */;
/*!50001 DROP VIEW IF EXISTS `getviewrumah` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getviewrumah` AS select `m`.`IdRumah` AS `IdRumah`,`m`.`IdPerumahan` AS `IdPerumahan`,`m`.`KodeRumah` AS `KodeRumah`,`m`.`NamaRumah` AS `NamaRumah`,`m`.`IsKeamanan` AS `IsKeamanan`,`m`.`IsTempatIbadah` AS `IsTempatIbadah`,`m`.`IsTaman` AS `IsTaman`,`m`.`IsMarket` AS `IsMarket`,`m`.`IsOlahraga` AS `IsOlahraga`,`m`.`FasilitasLain` AS `FasilitasLain`,`m`.`Harga` AS `Harga`,`m`.`Akses` AS `Akses`,`m`.`Sertifikat` AS `Sertifikat`,`m`.`Tipe` AS `Tipe`,`m`.`LuasTanah` AS `LuasTanah`,`m`.`GambarRumah` AS `GambarRumah`,`m`.`GambarRumahTumb` AS `GambarRumahTumb`,`m`.`GambarDenah` AS `GambarDenah`,`m`.`GambarDenahTumb` AS `GambarDenahTumb`,`m`.`IdUserCreate` AS `IdUserCreate`,`m`.`created_at` AS `created_at`,`m`.`IdUserUpdate` AS `IdUserUpdate`,`m`.`updated_at` AS `updated_at`,`perum`.`KodePerumahan` AS `KodePerumahan`,`perum`.`NamaPerumahan` AS `NamaPerumahan` from (`masterrumahs` `m` left join `masterperumahans` `perum` on((`m`.`IdPerumahan` = `perum`.`IdPerumahan`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
