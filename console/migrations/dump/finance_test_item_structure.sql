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
-- Дамп данных таблицы testing-online-backup.finance_test_item_structure: ~9 rows (приблизительно)
DELETE FROM `finance_test_item_structure`;
/*!40000 ALTER TABLE `finance_test_item_structure` DISABLE KEYS */;
INSERT INTO `finance_test_item_structure` (`id`, `item_id`, `topic_id`, `ask_simple`, `ask_difficult`) VALUES
	(1, 1, 1, 1, 2),
	(2, 1, 2, 1, 1),
	(3, 1, 3, 1, 2),
	(4, 1, 4, 1, 2),
	(5, 1, 5, 1, 2),
	(6, 1, 6, 1, 1),
	(7, 1, 7, 2, 1),
	(8, 1, 8, 1, 2),
	(9, 1, 9, 1, 2);
/*!40000 ALTER TABLE `finance_test_item_structure` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
