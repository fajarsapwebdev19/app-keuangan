-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for keuangan
CREATE DATABASE IF NOT EXISTS `keuangan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `keuangan`;

-- Dumping structure for table keuangan.pemasukan
CREATE TABLE IF NOT EXISTS `pemasukan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `keterangan` char(200) DEFAULT NULL,
  `sumber` char(200) DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`id_user`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table keuangan.pemasukan: ~0 rows (approximately)

-- Dumping structure for table keuangan.pengeluaran
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `keterangan` char(200) DEFAULT NULL,
  `keperluan_untuk` char(200) DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_pengeluaran` (`id_user`),
  CONSTRAINT `fk_user_pengeluaran` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table keuangan.pengeluaran: ~0 rows (approximately)

-- Dumping structure for table keuangan.personal_data
CREATE TABLE IF NOT EXISTS `personal_data` (
  `id` int NOT NULL,
  `nama` char(200) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tempat_lahir` char(200) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table keuangan.personal_data: ~2 rows (approximately)
INSERT INTO `personal_data` (`id`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `create_date`, `modified_date`) VALUES
	(1, 'Fajar Saputra', 'L', 'Tangerang', '2001-12-19', '2023-04-06 08:16:56', NULL),
	(2, 'Nurhayati', 'P', 'Pangandaran', '2001-04-08', '2023-04-06 08:17:41', NULL);

-- Dumping structure for table keuangan.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` char(200) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table keuangan.roles: ~2 rows (approximately)
INSERT INTO `roles` (`role_id`, `role_name`, `create_date`, `modified_date`) VALUES
	(1, 'Admin', '2023-04-06 08:18:30', NULL),
	(2, 'Users', '2023-04-06 08:18:43', NULL);

-- Dumping structure for table keuangan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL,
  `personal_id` int NOT NULL,
  `role_id` int NOT NULL,
  `username` char(200) DEFAULT NULL,
  `pass` char(200) DEFAULT NULL,
  `status_account` enum('y','n') DEFAULT NULL,
  `token` char(200) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personal` (`personal_id`),
  KEY `fk_role` (`role_id`),
  CONSTRAINT `fk_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_data` (`id`),
  CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table keuangan.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `personal_id`, `role_id`, `username`, `pass`, `status_account`, `token`, `create_date`, `modified_date`) VALUES
	(1, 1, 1, 'fajarsapwebdev19', 'neglasarikeren', 'y', '3031336132562483006042023022229', '2023-04-06 08:19:23', NULL),
	(2, 2, 2, 'nurhy', 'pangandaranpride', 'y', NULL, '2023-04-06 08:20:17', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
