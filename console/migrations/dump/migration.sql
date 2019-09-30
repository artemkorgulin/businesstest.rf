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
-- Дамп данных таблицы testing-online-backup.migration: ~12 rows (приблизительно)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1503995685),
	('m170829_082753_create_user_table', 1503995687),
	('m170829_112024_create_finance_topics_table', 1504005798),
	('m170829_123457_create_finance_questions_table', 1504010564),
	('m170829_140848_create_finance_answers_table', 1504016032),
	('m170830_104618_create_region_table', 1504092109),
	('m170830_115656_create_postal_table', 1504094947),
	('m170830_121622_create_organization_table', 1504103714),
	('m170904_125601_create_user_profile_table', 1504530071),
	('m170904_135920_create_finance_test_item_table', 1504534890),
	('m170905_064457_create_finance_test_log_table', 1504606478),
	('m170907_074336_upload_initial_dump', 1504770275);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
