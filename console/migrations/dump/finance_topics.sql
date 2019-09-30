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
-- Дамп данных таблицы testing-online-backup.finance_topics: ~9 rows (приблизительно)
DELETE FROM `finance_topics`;
/*!40000 ALTER TABLE `finance_topics` DISABLE KEYS */;
INSERT INTO `finance_topics` (`id`, `name`, `heading`) VALUES
	(1, 'Деньги', 'Деньги'),
	(2, 'Личные финансы', 'Личные финансы'),
	(3, 'Банковская система', 'Банковская система'),
	(4, 'Рынок ценных бумаг', 'Рынок ценных бумаг'),
	(5, 'Инвестиции', 'Инвестиции'),
	(6, 'Риски', 'Риски'),
	(7, 'Страхование', 'Страхование'),
	(8, 'Налоги', 'Государственный бюджет'),
	(9, 'Пенсионная система', 'Пенсионная система');
/*!40000 ALTER TABLE `finance_topics` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
