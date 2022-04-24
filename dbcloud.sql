/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 5.7.33 : Database - db_cloudnine
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cloudnine` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_cloudnine`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pelanggan_id` bigint(20) unsigned NOT NULL,
  `title_message` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_petugas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_pelanggan_id_foreign` (`pelanggan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `message` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_03_22_094105_create_paket_jaringan_table',2),
(8,'2022_03_22_123713_create_area_table',3),
(9,'2022_03_22_160304_create_pelanggan_table',3),
(11,'2022_03_28_040812_create_pembayaran_table',4),
(12,'2022_04_03_144018_create_message_table',5),
(13,'2022_04_09_020850_create_perumahan_table',6);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` bigint(20) unsigned NOT NULL,
  `nama_pelanggan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perumahan_id` bigint(20) unsigned DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagihan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paket` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_modem` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sn_modem` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tv` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chip_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pemasangan` date NOT NULL,
  `tgl_tagihan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(4) DEFAULT NULL COMMENT '0=baru, 1=terverifikasi, 2=verivikasiditolak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `perumahan_pelanggan_id_foreign` (`perumahan_id`),
  CONSTRAINT `perumahan_pelanggan_id_foreign` FOREIGN KEY (`perumahan_id`) REFERENCES `perumahan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`perumahan_id`,`alamat`,`tagihan`,`paket`,`merk_modem`,`sn_modem`,`tv`,`sn`,`chip_id`,`tgl_pemasangan`,`tgl_tagihan`,`telp_hp`,`user_id`,`password`,`status`,`created_at`,`updated_at`) values 
(2204090285,'SLAMET SUPRIHATIN WIBOWO',16,'BLOK C3 NO 17','160000','10','','','0','0','0','2022-01-05','5','085265455020','admin@gmail.com','123456',1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204090718,'RUSTI PINEM',20,'BLOK A1 NO 22','170000','10',NULL,NULL,'0','0','0','2022-03-31','5','085272385966',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204091043,'BAHAR SUWARDI',10,'BLOK B NO 49','155000','10',NULL,NULL,'0','0','0','2021-06-30','5','081364671383',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204091459,'NATALIA',10,'BLOK B NO 40','155000','10',NULL,NULL,'0','0','0','2021-07-25','5','82288259954',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204091876,'ROISA MARTIN ',1,'BLOK A1 NO 20','210000','10',NULL,NULL,'1','0','0','2021-12-01','5','081364013886',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204091947,'RIAMA',20,'BLOK A1 NO 17','170000','10',NULL,NULL,'0','0','0','2022-02-24','5','081370795672',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204092054,'RAHMANIA PUTERI PHASINA',20,'BLOK D1 NO 03','170000','10',NULL,NULL,'0','0','0','2022-03-18','5','082283821980',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204092940,'HENNY THERESIA',10,'BLOK B NO 51','190000','15',NULL,NULL,'0','0','0','2021-09-08','5','081277798008',NULL,NULL,0,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204093401,'DIKKY RISKY FADILAH',10,'BLOK B NO 43','235000','20',NULL,NULL,'0','0','0','2021-06-20','5','0895802660207',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204094601,'MUHAMMAD AJIZAT',4,'BLOK B 20','140000','10','Huawei','12345678','1','202000123','1231232132','2022-04-09','5','082388890506','admin@gmail.com','123456',0,'2022-04-09 18:16:44','2022-04-10 02:53:43'),
(2204094861,'NELLY SUSANTI NAI',16,'BLOK C7 NO 21','160000','10',NULL,NULL,'0','0','0','2022-03-11','5','085376111664',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204095739,'RITA LEMBANG',1,'BLOK A1 NO 08','170000','10',NULL,NULL,'0','0','0','2021-07-03','5','085376963525',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204096415,'BUNGARAN IRIANTO SIMAMORA',20,'BLOK C3 NO 01','170000','10',NULL,NULL,'0','0','0','2022-02-13','5','081374723192',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204096913,'NUR KHASIDAH',1,'BLOK A10 NO 08','220000','10',NULL,NULL,'1','0','0','2021-08-01','5','081372004005',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204097043,'ISMEDIA',1,'BLOK A10 NO 19','210000','10',NULL,NULL,'1','0','0','2021-05-03','5','081277886721',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204097059,'RAHMA FITRI',10,'BLOK B NO 39 KOS TENGAH','155000','10',NULL,NULL,'0','0','0','2021-07-12','5','085272405919',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204097125,'NANA ALIYA',20,'BLOK D1 NO 06','220.000','10','','','1','','','2022-02-02','5','089622815561','','',1,'2022-04-09 04:31:39','2022-04-09 04:31:39'),
(2204097196,'ALFI ISTIQOMAH',20,'BLOK C3 NO 08','170000','10',NULL,NULL,'0','0','0','2022-03-25','5','087720686572',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204098196,'AGUS RAHMAT',1,'BLOK A1 NO 18','170000','10',NULL,NULL,'0','0','0','2021-08-07','5','082284878796',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204098415,'YUSMAINI SIREGAR',16,'BLOK C5 NO 16','160000','10',NULL,NULL,'0','0','0','2022-01-20','5','082135675037',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204099154,'JUNARDIN HENDRI SIMARMATA',16,'BLOK C5 NO 18','160000','10',NULL,NULL,'0','0','0','2022-01-22','5','081276882909',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204099458,'MULYADI RIZKI PUTRA',3,'BLOK C 10','141000','','','','0','','','2022-04-02','5','082117875570','','',0,'2022-04-09 18:15:53','2022-04-10 02:52:50'),
(2204099748,'TUTI DESWATI',16,'BLOK C5 NO 17','215000','10',NULL,NULL,'1','0','0','2022-01-20','5','082174313248',NULL,NULL,1,'2022-04-09 04:24:16','2022-04-09 04:24:16'),
(2204107125,'RISKY FIRDAUS',10,'BLOK B 40','140000','10','','','0','','','2022-04-10','5','082388890506','','',0,'2022-04-10 02:52:33','2022-04-10 02:52:33');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` bigint(20) unsigned NOT NULL,
  `jml_dibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan_dibayar` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `status_pembayaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `pembayaran_pelanggan_id_foreign` (`pelanggan_id`),
  CONSTRAINT `pembayaran_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`id_pembayaran`,`pelanggan_id`,`jml_dibayar`,`bulan_dibayar`,`tgl_pembayaran`,`status_pembayaran`,`log_petugas`,`created_at`,`updated_at`) values 
('TR2204122490',2204099748,'215000','1','2022-04-12 00:00:00','1','Mulyadi Rizki Putra','2022-04-12 11:08:44','2022-04-12 11:08:44'),
('TR2204125632',2204091043,'150000','1','2022-04-12 00:00:00','1','Mulyadi Rizki Putra','2022-04-12 11:03:07','2022-04-12 11:03:07'),
('TR2204125681',2204090285,'160000','2','2022-04-12 00:00:00','1','Mulyadi Rizki Putra','2022-04-12 09:45:53','2022-04-12 09:45:53'),
('TR2204128539',2204099748,'215000','2','2022-04-13 00:00:00','1','Mulyadi Rizki Putra','2022-04-12 11:17:58','2022-04-12 11:17:58'),
('TR2204129021',2204090718,'170000','3','2022-04-12 00:00:00','1','Mulyadi Rizki Putra','2022-04-12 10:12:13','2022-04-12 10:12:13');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `perumahan` */

DROP TABLE IF EXISTS `perumahan`;

CREATE TABLE `perumahan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_perumahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `perumahan` */

insert  into `perumahan`(`id`,`nama_perumahan`,`created_at`,`updated_at`) values 
(1,'BOTANIA','2022-04-09 02:43:42','2022-04-09 03:46:22'),
(2,'BUNGA RAYA','2022-04-09 03:41:15','2022-04-09 03:41:15'),
(3,'NADIM 1','2022-04-09 03:41:38','2022-04-09 03:41:38'),
(4,'NADIM 2','2022-04-09 03:41:44','2022-04-09 03:41:44'),
(5,'CLUSTER SAKURA','2022-04-09 03:41:53','2022-04-09 03:41:53'),
(6,'CLUSTER DAISY','2022-04-09 03:42:00','2022-04-09 03:42:00'),
(7,'CLUSTER SAFFRON','2022-04-09 03:42:08','2022-04-09 03:42:08'),
(8,'CLUSTER PEONY','2022-04-09 03:42:16','2022-04-09 03:42:16'),
(9,'CLUSTER VIOLET','2022-04-09 03:42:24','2022-04-09 03:42:24'),
(10,'BUANA VISTA 1','2022-04-09 03:42:31','2022-04-09 03:42:31'),
(11,'BUANA VISTA 2','2022-04-09 03:42:39','2022-04-09 03:42:39'),
(12,'BUANA VISTA 3','2022-04-09 03:42:45','2022-04-09 03:42:45'),
(13,'BUANA VISTA 4','2022-04-09 03:42:51','2022-04-09 03:42:51'),
(14,'REXVIN VILLAGE','2022-04-09 03:43:02','2022-04-09 03:43:02'),
(15,'GARDEN RAYA','2022-04-09 03:43:09','2022-04-09 03:43:09'),
(16,'BUKIT RAYA','2022-04-09 03:43:19','2022-04-09 03:43:19'),
(17,'THE HILL RESIDENCE','2022-04-09 03:43:28','2022-04-09 03:43:28'),
(18,'ODESSA','2022-04-09 03:44:02','2022-04-09 03:44:02'),
(19,'PESONA','2022-04-09 03:44:26','2022-04-09 03:44:26'),
(20,'BANDARA MAS','2022-04-09 02:33:30','2022-04-09 02:33:30'),
(21,'RULI KAMPUNG YASMIN','2022-04-09 03:44:35','2022-04-09 03:44:35');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`level`,`remember_token`,`created_at`,`updated_at`) values 
(3,'Mulyadi Rizki Putra','admin','admin@gmail.com',NULL,'$2y$10$41.ZEnQ.v.AHwowMRi9MxeIzAYWwAcY91j4ZP9Ql585Zsa6bQcBmS','0',NULL,'2022-03-30 05:51:21','2022-03-30 05:51:21'),
(4,'Risky Firdaus','owner','owner@gmail.com',NULL,'$2y$10$t5vGS/pEjw49wlETJyAcx.rJiFYHvoR6NGh8KOF7Nm.vWX92JHDaK','1',NULL,'2022-03-30 05:51:22','2022-03-30 05:51:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
