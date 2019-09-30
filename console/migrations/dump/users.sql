-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.50 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40000 ALTER TABLE `zip` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `token_proftest`, `is_proftest_active`, `token_fgtest`, `is_fgtest_active`, `token_btest`, `is_btest_active`)
VALUES (NULL, 'backend-user@synergy.ru', '', '$2y$13$ys6ws3NB0tKZ/MIb2OHNROrVXSwmPfmujy4nxMmVx6n0xwpfIOxdK', '$2y$13$ys6ws3NB0tKZ/MIb2OHNROrVXSwmPfmujy4nxMmVx6n0xwpfIOxdK', '10', '1541721600', '1541721600', NULL, '0', NULL, '0', NULL, '0');
/*!40000 ALTER TABLE `zip` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
