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
-- Дамп данных таблицы testing-online-backup.finance_test_item: ~1 rows (приблизительно)
DELETE FROM `finance_test_item`;
/*!40000 ALTER TABLE `finance_test_item` DISABLE KEYS */;
INSERT INTO `finance_test_item` (`id`, `project_id`, `title`, `controller`, `description`) VALUES
	(1, 1, 'Тестирование в начале учебного года', NULL, '<p>С целью повышения финансовой грамотности населения и обеспечения информационной основы для реализации и корректировки образовательных программ в данной области, Некоммерческое партнерство «Сообщество профессионалов финансового рынка «САПФИР» и Университет Синергия предлагают пройти тест на определение текущего уровня финансовой грамотности.\r\n\r\n<p>Цель проведения тестирования — объективная оценка исходных (базовых) знаний, навыков и умений по базовым финансовым компетенциям на начало учебного года.\r\n\r\n<p>Знание ключевых финансовых понятий и умение их использовать на практике дает возможность человеку грамотно управлять денежными средствами: вести учет доходов и расходов, избегать излишней задолженности, планировать бюджет, создавать сбережения, ориентироваться в сложных продуктах, предлагаемых финансовыми институтами, и приобретать их на основе осознанного выбора, использовать накопительные и страховые инструменты');
/*!40000 ALTER TABLE `finance_test_item` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;