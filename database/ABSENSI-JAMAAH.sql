/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - data_absensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`data_absensi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `data_absensi`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `jamaah_id` bigint(11) NOT NULL,
  `kegiatan_id` bigint(11) DEFAULT NULL,
  `kehadiran` enum('Hadir','Izin','Alpha') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `penerobos` varchar(255) DEFAULT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `dibuat_oleh` bigint(11) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`jamaah_id`,`kegiatan_id`,`kehadiran`,`keterangan`,`penerobos`,`tanggal_kegiatan`,`dibuat_oleh`,`dibuat_pada`,`diubah_pada`) values 
(1,1,2,'Alpha',NULL,'Irvan','2023-12-11',0,'2023-12-10 15:23:39','2023-12-11 00:40:59'),
(2,2,2,'Alpha',NULL,'Irvan','2023-12-11',0,'2023-12-10 15:23:39','2023-12-11 00:41:02'),
(3,3,2,'Alpha',NULL,'Irvan','2023-12-11',0,'2023-12-10 15:23:39','2023-12-11 00:41:02'),
(4,4,2,'Hadir',NULL,'Irvan','2023-12-11',0,'2023-12-10 15:23:39','2023-12-11 13:01:09'),
(5,1,2,'Alpha',NULL,'Irvan','2023-12-10',0,'2023-12-10 15:23:39','2023-12-14 11:09:32'),
(6,2,2,'Alpha',NULL,'Irvan','2023-12-10',0,'2023-12-10 15:23:39','2023-12-14 11:09:33'),
(7,3,2,'Alpha',NULL,'Irvan','2023-12-10',0,'2023-12-10 15:23:39','2023-12-14 11:09:34'),
(8,4,2,'Alpha',NULL,'Irvan','2023-12-10',0,'2023-12-10 15:23:39','2023-12-14 11:09:36');

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `id` bigint(20) NOT NULL,
  `nama_pengguna` varchar(75) DEFAULT NULL,
  `username` varchar(75) NOT NULL,
  `telepon` bigint(20) NOT NULL,
  `email` varchar(75) NOT NULL,
  `provinsi` varchar(75) DEFAULT NULL,
  `kota` varchar(75) DEFAULT NULL,
  `kecamatan` varchar(75) DEFAULT NULL,
  `desa` varchar(75) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `role` varchar(20) NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `dihapus_pada` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `akun` */

insert  into `akun`(`id`,`nama_pengguna`,`username`,`telepon`,`email`,`provinsi`,`kota`,`kecamatan`,`desa`,`password`,`role`,`dibuat_pada`,`diubah_pada`,`dihapus_pada`) values 
(6410896282210479,'Admin POS','Admin',807952365,'admin@gmail.com','JAWA TENGAH','KOTA SEMARANG','GUNUNG PATI','GUNUNGPATI','$2y$12$eF1WkQt0DOMV7u8z6HbNzufgrSxC4TLDMW.yRk5hCmK/M5EETVrFi','Admin','2023-06-08 10:01:31','2023-09-18 08:29:17',NULL),
(7392511986664469,NULL,'aa',0,'ada@ada',NULL,NULL,NULL,'','$2y$12$2BgEydbUmSE7k3pjgIYc6O4UPrVuDx9D5RRaTLPJ0JRPb/c1VYnVu','Admin','2023-06-08 16:36:21','2023-06-09 14:24:24',NULL);

/*Table structure for table `daftar_kegiatan` */

DROP TABLE IF EXISTS `daftar_kegiatan`;

CREATE TABLE `daftar_kegiatan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(255) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_kegiatan` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `daftar_kegiatan` */

insert  into `daftar_kegiatan`(`id`,`nama_kegiatan`,`dibuat_oleh`,`dibuat_pada`,`diubah_pada`,`status_kegiatan`) values 
(1,'Sambung Kelompok',0,'2023-11-03 23:17:30','2023-11-05 23:17:56',1),
(2,'Sambung Sub',0,'2023-11-03 23:18:40','2023-11-05 23:21:35',1),
(3,'Sambung Pagi',0,'2023-11-13 00:57:15','2023-11-22 08:15:40',1),
(4,'Susulan Text Amanatan',0,'2023-11-16 15:43:31','2023-11-20 23:13:22',0);

/*Table structure for table `data_jamaah` */

DROP TABLE IF EXISTS `data_jamaah`;

CREATE TABLE `data_jamaah` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code_unik` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `kelamin` varchar(15) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `tmpt_lahir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` int(15) NOT NULL DEFAULT 62,
  `kategori` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_data` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `data_jamaah` */

insert  into `data_jamaah`(`id`,`code_unik`,`nama_lengkap`,`kelamin`,`tgl_lahir`,`tmpt_lahir`,`alamat`,`no_telepon`,`kategori`,`status`,`dibuat_oleh`,`dibuat_pada`,`diubah_pada`,`status_data`) values 
(1,'92929928-SAID','Said',NULL,'1994-06-01','kaka','',62,'lansia','pendatang',2147483647,'2023-11-16 16:20:49','2023-11-23 21:34:36',1),
(2,'29938499-YUAR','yuar',NULL,'2008-02-16','Demak','',62,'umum','pribumi',2147483647,'2023-11-16 16:23:01','2023-11-23 21:34:40',1),
(3,'20080218-ALYY','frixwith',NULL,'2008-02-18','Kalimantan','',62,'umum','pendatang',2147483647,'2023-11-16 16:24:40','2023-11-23 21:34:40',1),
(4,'20050503-BF6Z','Irvanda',NULL,'2005-05-03','Semarang','',62,'remaja','pribumi',2147483647,'2023-11-16 16:30:16','2023-11-23 21:34:43',0);

/*Table structure for table `data_masjid` */

DROP TABLE IF EXISTS `data_masjid`;

CREATE TABLE `data_masjid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_masjid` varchar(255) NOT NULL,
  `kyai_kelompok` varchar(255) NOT NULL,
  `penrobos` varchar(255) NOT NULL,
  `alamat_masjid` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `dibuat_oleh` int(11) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `data_masjid` */

insert  into `data_masjid`(`id`,`nama_masjid`,`kyai_kelompok`,`penrobos`,`alamat_masjid`,`status`,`dibuat_oleh`,`dibuat_pada`,`diubah_pada`) values 
(1,'Al-Manshurin','Slamet Riyadi','Triyono','Jl. Puncak Sari, Tambak Aji, Ngaliyan, Semarang',0,2147483647,'2023-11-20 23:00:44','2023-11-23 21:32:31');

/*Table structure for table `saran_tanggapan` */

DROP TABLE IF EXISTS `saran_tanggapan`;

CREATE TABLE `saran_tanggapan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `code_user` varchar(255) NOT NULL,
  `saran` text DEFAULT NULL,
  `tanggapan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saran_tanggapan` */

insert  into `saran_tanggapan`(`id`,`code_user`,`saran`,`tanggapan`,`dibuat_pada`,`diubah_pada`) values 
(1,'20000125-IDR2','<p>iya</p>\r\n',NULL,'2023-12-10 19:14:24','2023-12-10 19:14:24'),
(2,'20000125-IDR2','<p>oke</p>\r\n',NULL,'2023-12-10 19:14:34','2023-12-10 19:14:34'),
(3,'20000125-IDR2','<p>oke</p>\r\n',NULL,'2023-12-10 19:14:43','2023-12-10 19:14:43'),
(4,'20000125-IDR2','<p>oke</p>\r\n',NULL,'2023-12-10 19:14:54','2023-12-10 19:14:54'),
(5,'20000125-IDR2','<p>oke</p>\r\n',NULL,'2023-12-10 19:15:17','2023-12-10 19:15:17'),
(6,'20000125-IDR2','<p>siap</p>\r\n',NULL,'2023-12-10 19:15:24','2023-12-10 19:15:24'),
(7,'20000125-IDR2','<p>siap</p>\r\n',NULL,'2023-12-10 19:15:36','2023-12-10 19:15:36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
