-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2020 at 09:48 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `integration`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `diminishEntryStockQuantities`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `diminishEntryStockQuantities` (`qty` INT, `s_i` INT, `art_id` INT, `deliv_art` INT)  BEGIN
  DECLARE qtyB INT;
  DECLARE curQty INT;
  DECLARE curId INT;
  DECLARE del BOOLEAN;

  WHILE (qty > 0) DO
    SET del = FALSE;
    SET curQty = (SELECT quantity FROM Entry_Stock WHERE store_id = s_i AND quantity > 0 AND article_id = art_id ORDER BY id ASC LIMIT 1);
    SET curId = (SELECT id FROM Entry_Stock WHERE store_id = s_i AND quantity > 0 AND article_id = art_id ORDER BY id ASC LIMIT 1);
       
    SET qtyB = curQty - qty;
        
    IF qtyB <= 0 THEN SET qtyB = 0, del = TRUE;
    ELSE SET qtyB = ABS(qtyB);
    END IF;
        
    UPDATE Entry_Stock SET quantity = qtyB, deleted = del WHERE id = curId;
    
    INSERT INTO articles_requisitioned_delivery(article_requisitioned_id, quantity, deliverer_store_id, entry_stock_id, delivered_at) VALUES(deliv_art, qty, s_i, curId, CURDATE());
    SET qty = qty - curQty;
  END WHILE;
END$$

DROP PROCEDURE IF EXISTS `payInvoice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `payInvoice` (`i_id` INT, `amount` DOUBLE)  BEGIN
  DECLARE i INT DEFAULT 0;
  DECLARE curId INT;
  DECLARE totalRows INT;
  DECLARE rest DOUBLE;
  DECLARE tot DOUBLE;
  DECLARE paid DOUBLE;

  SET totalRows = (SELECT COUNT(*) FROM sells WHERE invoice_id = i_id AND payment < total);

  WHILE (i < totalRows AND amount > 0) DO
    SELECT id, (total - payment) as a, total, payment INTO curId, rest, tot, paid FROM sells 
    WHERE invoice_id = i_id AND payment < total LIMIT 1;
   
    IF (amount > rest) THEN 
    	UPDATE sells SET payment = payment + rest WHERE id = curId;
      SET amount = amount - rest;
    ELSE 
      IF (tot < (paid + amount)) THEN
        UPDATE sells SET payment = tot WHERE id = curId;
        SET amount = (paid + amount) - tot;
      ELSE
        UPDATE sells SET payment = (paid + amount) WHERE id = curId;
        SET amount = 0;
      END IF;

    END IF;

    
    SET i = i + 1;
  END WHILE;

  IF (amount > 0) THEN
  	UPDATE sells SET deposit = amount WHERE id = curId;
  END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `article_mp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(40) DEFAULT NULL,
  `stock_securite` int(11) DEFAULT NULL,
  `unite_mesure` varchar(30) DEFAULT NULL,
  `categorie_id` int(30) UNSIGNED DEFAULT NULL,
  `entreprise_id` int(30) UNSIGNED DEFAULT NULL,
  `prix_de_vente_gros` double DEFAULT NULL,
  `prix_detail` double DEFAULT NULL,
  `prix_de_vente_casse` double DEFAULT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`article_mp_id`),
  KEY `entreprise_id` (`entreprise_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `Articles_ibfk_4` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_mp_id`, `designation`, `stock_securite`, `unite_mesure`, `categorie_id`, `entreprise_id`, `prix_de_vente_gros`, `prix_detail`, `prix_de_vente_casse`, `store_id`) VALUES
(17, 'Bonbon', 200, 'Paquets', 8, 1, 20, 54, 44, 2),
(18, 'Chewing-gum', 130, 'Paquets', 8, 1, 20, 54, 44, 1),
(19, 'Galettes', 430, 'Kilogrammes', 8, 1, 41, 41.9, 37.9, 2),
(21, 'Bonbon Obama', 60, 'Pces', 2, 1, 30, 20, 10, 1),
(22, 'Biscuit glucose', 59, 'Pces', 2, 1, 200, 150, 100, 1),
(24, 'Tablette Motema', 65, 'Pces', 2, 1, 200, 150, 100, 2),
(26, 'Motema', 54, 'Pces', 2, 1, 200, 150, 100, 2),
(27, 'Nouveau article', 39, 'Pces', 2, 1, 0, 0, 0, 2),
(28, 'Beignet', 300, 'paquet', 8, 1, 30, 89, 38, 2),
(29, 'CPanel', 80, 'Chipset', 2, 1, 0, 0, 0, 2),
(30, 'Swingum', 65, 'paquet', 8, 1, 650, 780, 500, 2),
(31, 'Samsung Galaxy 8', 30, 'NOthing', 9, 2, 10, 30, 60, 6);

-- --------------------------------------------------------

--
-- Table structure for table `articles_requisitioned`
--

DROP TABLE IF EXISTS `articles_requisitioned`;
CREATE TABLE IF NOT EXISTS `articles_requisitioned` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `requisition_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_AR_Requisition` (`requisition_id`),
  KEY `FK_AR_Articles` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles_requisitioned`
--

INSERT INTO `articles_requisitioned` (`id`, `article_id`, `quantity`, `requisition_id`) VALUES
(67, 21, 30, 71),
(68, 22, 43, 71),
(74, 18, 34, 75),
(75, 21, 76, 75),
(77, 24, 359, 78),
(87, 27, 300, 82),
(88, 17, 45, 84),
(89, 26, 6, 84),
(90, 24, 78, 85),
(91, 27, 10, 86);

--
-- Triggers `articles_requisitioned`
--
DROP TRIGGER IF EXISTS `Articles_Requisitioned_Update`;
DELIMITER $$
CREATE TRIGGER `Articles_Requisitioned_Update` AFTER UPDATE ON `articles_requisitioned` FOR EACH ROW BEGIN
  UPDATE Requisitions SET status = 'pending' WHERE id = NEW.requisition_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `articles_requisitioned_delivery`
--

DROP TABLE IF EXISTS `articles_requisitioned_delivery`;
CREATE TABLE IF NOT EXISTS `articles_requisitioned_delivery` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_requisitioned_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `deliverer_store_id` int(10) UNSIGNED NOT NULL,
  `delivered_at` date NOT NULL,
  `entry_stock_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ARD_Article_Requisitioned` (`article_requisitioned_id`),
  KEY `FK_ARD_Stores` (`deliverer_store_id`),
  KEY `FK_ARD_Entry_Stock` (`entry_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles_requisitioned_delivery`
--

INSERT INTO `articles_requisitioned_delivery` (`id`, `article_requisitioned_id`, `quantity`, `deliverer_store_id`, `delivered_at`, `entry_stock_id`) VALUES
(33, 77, 359, 2, '2020-03-05', 47),
(34, 87, 300, 2, '2020-03-05', 51),
(35, 89, 6, 2, '2020-03-05', 52),
(36, 88, 45, 2, '2020-03-05', 49);

-- --------------------------------------------------------

--
-- Table structure for table `articles_sells`
--

DROP TABLE IF EXISTS `articles_sells`;
CREATE TABLE IF NOT EXISTS `articles_sells` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(30) UNSIGNED NOT NULL,
  `article_id` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(9,2) NOT NULL,
  `amount_reduced` double UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_AS_Invoices` (`invoice_id`),
  KEY `FK_AS_Articles` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `articles_sells`
--

INSERT INTO `articles_sells` (`id`, `invoice_id`, `article_id`, `quantity`, `price`, `amount_reduced`) VALUES
(1, 1, 22, 1, 200.00, NULL),
(2, 2, 22, 1, 200.00, NULL),
(3, 3, 18, 5, 54.00, NULL),
(4, 3, 22, 3, 100.00, NULL),
(5, 22, 22, 1, 200.00, NULL),
(6, 24, 22, 1, 200.00, NULL),
(7, 26, 22, 1, 200.00, NULL),
(8, 29, 22, 1, 150.00, NULL),
(9, 31, 22, 1, 200.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles_sells_details`
--

DROP TABLE IF EXISTS `articles_sells_details`;
CREATE TABLE IF NOT EXISTS `articles_sells_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_sell_id` int(10) UNSIGNED NOT NULL,
  `entry_stock_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_articles`
--

DROP TABLE IF EXISTS `cart_articles`;
CREATE TABLE IF NOT EXISTS `cart_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(9,2) NOT NULL,
  `firm_id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CA_Articles` (`article_id`),
  KEY `FK_CA_firms` (`firm_id`),
  KEY `FK_CA_Clients` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cart_articles`
--

INSERT INTO `cart_articles` (`id`, `article_id`, `quantity`, `price`, `firm_id`, `invoice_id`) VALUES
(1, 22, 1, 200.00, 1, 1),
(2, 18, 1, 44.00, 1, 2),
(3, 22, 1, 100.00, 1, 2),
(4, 18, 3, 44.00, 1, 3),
(5, 21, 2, 20.00, 1, 3),
(6, 22, 4, 100.00, 1, 3),
(7, 22, 1, 200.00, 1, 5),
(8, 18, 2, 54.00, 1, 6),
(9, 22, 2, 100.00, 1, 6),
(10, 22, 1, 200.00, 1, 7),
(11, 18, 1, 44.00, 1, 8),
(12, 18, 1, 44.00, 1, 9),
(13, 22, 1, 100.00, 1, 9),
(14, 22, 3, 100.00, 1, 10),
(15, 22, 1, 200.00, 1, 16),
(16, 22, 1, 200.00, 1, 17),
(17, 22, 1, 200.00, 1, 18),
(18, 22, 1, 150.00, 1, 19),
(19, 22, 1, 200.00, 1, 20),
(20, 22, 1, 200.00, 1, 21),
(21, 22, 1, 200.00, 1, 23),
(22, 22, 1, 200.00, 1, 25),
(23, 22, 1, 150.00, 1, 28),
(24, 22, 1, 200.00, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `cart_services`
--

DROP TABLE IF EXISTS `cart_services`;
CREATE TABLE IF NOT EXISTS `cart_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) UNSIGNED NOT NULL,
  `price` float(9,2) NOT NULL,
  `delay` int(11) UNSIGNED NOT NULL,
  `shop_id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(15) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CS_Services` (`service_id`),
  KEY `FK_CS_Counters` (`shop_id`),
  KEY `FK_CS_Clients` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cart_services`
--

INSERT INTO `cart_services` (`id`, `service_id`, `price`, `delay`, `shop_id`, `invoice_id`) VALUES
(1, 1, 250.00, 2, 1, 4),
(2, 1, 250.00, 2, 1, 11),
(3, 1, 400.00, 1, 1, 12),
(4, 1, 500.00, 1, 1, 14),
(5, 1, 500.00, 1, 1, 15),
(6, 1, 250.00, 2, 1, 27),
(7, 1, 500.00, 1, 1, 32),
(8, 1, 250.00, 1, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `cash_outing`
--

DROP TABLE IF EXISTS `cash_outing`;
CREATE TABLE IF NOT EXISTS `cash_outing` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` float(9,2) NOT NULL,
  `proof` text NOT NULL,
  `reason` text NOT NULL,
  `insertion_date` datetime NOT NULL,
  `user_id` int(30) UNSIGNED NOT NULL,
  `counter_id` int(11) UNSIGNED DEFAULT NULL,
  `shop_id` int(10) UNSIGNED DEFAULT NULL,
  `cash_outing_reason_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CO_Users` (`user_id`),
  KEY `FK_CO_Counters` (`counter_id`),
  KEY `FK_CO_Shops` (`shop_id`),
  KEY `FK_CO_CashOuting` (`cash_outing_reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cash_outing`
--

INSERT INTO `cash_outing` (`id`, `amount`, `proof`, `reason`, `insertion_date`, `user_id`, `counter_id`, `shop_id`, `cash_outing_reason_id`) VALUES
(1, 129.90, 'GHJ?6098', 'I agree that i have received this amount.', '2020-03-16 14:55:12', 1, 2, 1, 2),
(2, 19000.00, 'F7HSJKDOUGLASCOSTA', 'A very interesting thing i want to write. But i may take a long time to be achieved. I\'m very glad to finish this small task so that a attack big ones. Thanks baba God for your protection because i couldn\'t still alive without you.', '2020-03-17 07:44:22', 1, 2, 1, 4),
(3, 20.00, 'UF8847FDJS', 'Rien a signaler', '2020-03-18 20:01:23', 1, NULL, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cash_outing_reasons`
--

DROP TABLE IF EXISTS `cash_outing_reasons`;
CREATE TABLE IF NOT EXISTS `cash_outing_reasons` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` text NOT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ER_Shops` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cash_outing_reasons`
--

INSERT INTO `cash_outing_reasons` (`id`, `designation`, `shop_id`) VALUES
(2, 'Something here', 1),
(4, 'Add another thing for test', 1),
(5, 'Nourriture du chef d\'agence', 1),
(6, 'Pay transport', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories_a`
--

DROP TABLE IF EXISTS `categories_a`;
CREATE TABLE IF NOT EXISTS `categories_a` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `moyenne_conservation` varchar(50) DEFAULT NULL,
  `periode_critique` int(10) UNSIGNED DEFAULT NULL,
  `firm_id` int(11) UNSIGNED NOT NULL,
  `type_category_depot` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `firm_id` (`firm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_a`
--

INSERT INTO `categories_a` (`id`, `designation`, `moyenne_conservation`, `periode_critique`, `firm_id`, `type_category_depot`) VALUES
(2, 'Appareils Electroniques', 'Carton', 60, 1, 'Raw material'),
(6, 'Ornément', 'Plastique', 30, 1, 'Commodity'),
(7, 'Electroménagers', 'NBDNBDS', 50, 1, 'Commodity'),
(8, 'Alimentation', 'Congélateur', 90, 1, 'Commodity'),
(9, 'Appareils électroniques', 'Nothing', 50, 2, 'Commodity');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Clients_Firm` (`firm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `phone`, `email`, `firm_id`) VALUES
(5, 'Domeshow Emmanuell', 'Goma, Birere', '3764483', 'dome@gmail.com', 1),
(6, 'Jonathan Nsengiyunva', 'Kingombé', '376434763', 'john@gmail.com', 1),
(7, 'Leonard PAPALA', 'Goma, Birere', '243975938256', 'leonard@gmail.com', 1),
(8, 'Joseph MATABARO', 'Kingombé', '376448343', 'joseph@gmail.com', 1),
(9, 'Peldron KOMOMBO', 'Buheneeee', '37644833', 'komombo@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `closures`
--

DROP TABLE IF EXISTS `closures`;
CREATE TABLE IF NOT EXISTS `closures` (
  `amount_due` float(9,2) NOT NULL COMMENT 'du francais montant_du',
  `delivered_amount` float(9,2) UNSIGNED NOT NULL,
  `solde` float(9,2) UNSIGNED NOT NULL,
  `receiver_id` int(15) UNSIGNED NOT NULL,
  `observation` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `doer_id` int(10) UNSIGNED NOT NULL,
  `counter_id` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FK_CL_Receivers` (`receiver_id`),
  KEY `FK_CL_Doers` (`doer_id`),
  KEY `FK_CL_Counters` (`counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='du francais cloture' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `closures_debts`
--

DROP TABLE IF EXISTS `closures_debts`;
CREATE TABLE IF NOT EXISTS `closures_debts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` date NOT NULL,
  `amount` float(9,2) NOT NULL COMMENT 'du francais montant_du',
  `receiver_id` int(15) NOT NULL,
  `closure_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Auparavant versement' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `level` enum('1','2') COLLATE utf8_unicode_ci DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_id` (`shop_id`,`designation`),
  KEY `FK_Counter_Firm` (`firm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `designation`, `shop_id`, `firm_id`, `level`) VALUES
(1, 'Terroriste', 1, 1, '1'),
(2, 'Les cons', 1, 1, '2'),
(3, 'Kitenge', 1, 1, '2'),
(4, 'Cilu Counter A', 3, 2, '1'),
(5, 'Cilu Counter B', 3, 2, '2'),
(6, 'Cilu Counter C', 4, 2, '2'),
(7, 'Cilu Counter D', 4, 2, '1');

--
-- Triggers `counters`
--
DROP TRIGGER IF EXISTS `Counter_User_Delete`;
DELIMITER $$
CREATE TRIGGER `Counter_User_Delete` BEFORE DELETE ON `counters` FOR EACH ROW BEGIN
	DELETE FROM Users
	WHERE role="counter" AND entity_id=OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

DROP TABLE IF EXISTS `debts`;
CREATE TABLE IF NOT EXISTS `debts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float(9,2) NOT NULL,
  `invoice_id` int(30) UNSIGNED NOT NULL,
  `given_at` date NOT NULL,
  `status` varchar(3) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_C_Clients` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `debts_payments`
--

DROP TABLE IF EXISTS `debts_payments`;
CREATE TABLE IF NOT EXISTS `debts_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `amount_payed` float(9,2) UNSIGNED NOT NULL,
  `counter_id` int(11) NOT NULL,
  `user_id` int(15) UNSIGNED NOT NULL,
  `debt_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `deposits_out_of_deposit`
--

DROP TABLE IF EXISTS `deposits_out_of_deposit`;
CREATE TABLE IF NOT EXISTS `deposits_out_of_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'du francais code_recep',
  `source` varchar(255) NOT NULL COMMENT 'du francais provenance',
  `reason` text NOT NULL COMMENT 'du francais motif',
  `amount` float(20,3) NOT NULL COMMENT 'du francais montant',
  `store_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Du francais versement_hv' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `entry_stock`
--

DROP TABLE IF EXISTS `entry_stock`;
CREATE TABLE IF NOT EXISTS `entry_stock` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` double UNSIGNED NOT NULL,
  `inserted_at` date NOT NULL,
  `expiry_date` date NOT NULL,
  `bar_code` text COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `initial_quantity` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ES_Articles` (`article_id`),
  KEY `FK_ES_Stores` (`store_id`),
  KEY `FK_ES_Fournisseurs` (`fournisseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entry_stock`
--

INSERT INTO `entry_stock` (`id`, `fournisseur_id`, `quantity`, `unit_price`, `inserted_at`, `expiry_date`, `bar_code`, `article_id`, `store_id`, `deleted`, `initial_quantity`, `invoice_number`) VALUES
(37, NULL, 43, 29, '2020-02-26', '2020-05-22', '09J32N45', 18, 1, 0, 0, NULL),
(38, NULL, 98, 90, '2020-02-26', '2020-08-29', '09J32N44', 18, 1, 0, 0, NULL),
(39, NULL, 57, 86, '2020-02-26', '2021-05-21', 'POUPEEPOPULAR', 22, 1, 0, 0, NULL),
(40, NULL, 0, 6, '2020-02-27', '2020-02-14', '8K9V52S', 18, 2, 1, 0, NULL),
(41, NULL, 0, 7, '2020-02-27', '2020-02-22', 'F5H7AZ0', 21, 2, 1, 0, NULL),
(42, NULL, 87, 90, '2020-02-26', '2020-08-29', '09J32N44', 18, 1, 0, 0, NULL),
(43, NULL, 21, 90, '2020-02-26', '2020-08-29', '09J32N44', 18, 1, 0, 0, NULL),
(44, NULL, 500, 67, '2020-02-28', '2020-02-28', 'O98QHNEU', 21, 1, 0, 500, NULL),
(46, NULL, 9, 183, '2020-02-28', '2020-02-28', 'TEST', 21, 1, 0, 9, NULL),
(47, NULL, 42, 45, '2020-03-02', '2020-03-31', '767544', 24, 2, 0, 760, 'FAC4637434'),
(48, NULL, 650, 500, '2020-03-02', '2020-03-31', '6482322', 19, 2, 0, 650, 'Y83FFZ993'),
(49, NULL, 405, 430, '2020-03-02', '2020-03-31', '74223232', 17, 2, 0, 450, 'FAC5468232'),
(50, NULL, 5, 750, '2020-03-02', '2020-03-31', '6543232', 24, 2, 0, 10, 'FAC897432'),
(51, NULL, 670, 500, '2020-03-02', '2020-03-31', '3424242', 27, 2, 0, 670, 'FAC897432'),
(52, NULL, 34, 550, '2020-03-02', '2020-03-31', '675454323', 26, 2, 0, 40, 'FAC56437823'),
(53, NULL, 100, 650, '2020-03-02', '2020-03-25', '7546544', 28, 2, 0, 100, 'FAC56437823'),
(54, NULL, 56, 35.6, '2020-03-04', '2020-03-03', '253GZ5', 21, 1, 0, 56, NULL),
(55, NULL, 359, 45, '2020-03-05', '2020-03-31', '767544', 24, 1, 0, 359, NULL),
(56, NULL, 347, 45, '2020-03-05', '2020-03-31', '767544', 31, 1, 0, 359, NULL);

--
-- Triggers `entry_stock`
--
DROP TRIGGER IF EXISTS `Entry_Stock_History_Update`;
DELIMITER $$
CREATE TRIGGER `Entry_Stock_History_Update` AFTER UPDATE ON `entry_stock` FOR EACH ROW BEGIN
  IF NEW.quantity < OLD.quantity THEN
    INSERT INTO Entry_Stock_History (entry_stock_id, quantity, inserted_at) VALUES(NEW.id, (OLD.quantity - NEW.quantity), CURDATE());
  END IF ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `entry_stock_history`
--

DROP TABLE IF EXISTS `entry_stock_history`;
CREATE TABLE IF NOT EXISTS `entry_stock_history` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `entry_stock_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `inserted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ESH_Entry_Stock` (`entry_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entry_stock_history`
--

INSERT INTO `entry_stock_history` (`id`, `entry_stock_id`, `quantity`, `inserted_at`) VALUES
(36, 42, 32, '2020-02-28 00:00:00'),
(37, 38, 531, '2020-02-28 00:00:00'),
(38, 37, 125, '2020-02-28 00:00:00'),
(39, 38, 59, '2020-02-28 00:00:00'),
(40, 42, 16, '2020-02-28 00:00:00'),
(41, 42, 396, '2020-02-28 00:00:00'),
(42, 37, 123, '2020-02-28 00:00:00'),
(43, 38, 45, '2020-02-28 00:00:00'),
(44, 42, 4, '2020-02-28 00:00:00'),
(45, 43, 28, '2020-02-28 00:00:00'),
(46, 39, 8, '2020-02-28 00:00:00'),
(47, 37, 4, '2020-02-28 00:00:00'),
(48, 41, 9, '2020-02-28 00:00:00'),
(49, 40, 2, '2020-03-03 00:00:00'),
(50, 39, 2, '2020-03-04 00:00:00'),
(51, 47, 359, '2020-03-05 00:00:00'),
(52, 47, 359, '2020-03-05 00:00:00'),
(53, 51, 300, '2020-03-05 00:00:00'),
(54, 52, 6, '2020-03-05 00:00:00'),
(55, 49, 45, '2020-03-05 00:00:00'),
(56, 56, 12, '2020-03-07 00:00:00'),
(57, 50, 5, '2020-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float(9,2) NOT NULL,
  `details` text NOT NULL,
  `outing_date` date NOT NULL,
  `user_id` int(15) UNSIGNED NOT NULL,
  `counter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

DROP TABLE IF EXISTS `factories`;
CREATE TABLE IF NOT EXISTS `factories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firm_id` (`firm_id`,`designation`),
  UNIQUE KEY `store_id` (`store_id`),
  KEY `FK_Factory_Factory` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `designation`, `address`, `firm_id`, `type`, `parent`, `store_id`) VALUES
(1, 'Domeshow\'s Factory', 'Saga plage 2', 1, 'Produit Fini', 1, 1),
(2, 'Séchage', 'Plage de Goma', 1, 'Produit Semi-Fini', 1, 2),
(3, 'Cilu Factory A', 'Magano Nord', 2, 'Produit Semi-fini', NULL, 4),
(4, 'Cilu Factory B', 'Magano Nord-Est', 2, 'Produit Fini', 3, 5);

--
-- Triggers `factories`
--
DROP TRIGGER IF EXISTS `Factory_User_Delete`;
DELIMITER $$
CREATE TRIGGER `Factory_User_Delete` BEFORE DELETE ON `factories` FOR EACH ROW BEGIN
	DELETE FROM Users
	WHERE role="factory" AND entity_id=OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_articles_outing`
--

DROP TABLE IF EXISTS `faulty_articles_outing`;
CREATE TABLE IF NOT EXISTS `faulty_articles_outing` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `done_at` date NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_AO_Articles` (`article_id`),
  KEY `FK_AO_Stores` (`store_id`),
  KEY `FK_A0_Users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faulty_articles_outing`
--

INSERT INTO `faulty_articles_outing` (`id`, `article_id`, `store_id`, `done_at`, `reason`, `quantity`, `user_id`, `expiry_date`) VALUES
(34, 22, 1, '2020-02-05', 'Ma raison à moi', 30, 1, '2020-02-14'),
(44, 21, 1, '2020-02-22', 'Internal consumption', 70, 1, '2020-02-29'),
(45, 22, 1, '2020-02-22', 'Internal consumption', 15, 1, '2020-02-29'),
(46, 22, 1, '2020-03-04', 'Internal consumption', 2, 1, '2021-05-21'),
(47, 24, 2, '2020-03-07', 'Expiry date is attempted, casse...', 5, 2, '2020-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

DROP TABLE IF EXISTS `firms`;
CREATE TABLE IF NOT EXISTS `firms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `register_num` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rccm_num` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tax_num` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` date NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FM_Id_FK` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `name`, `register_num`, `national_id`, `rccm_num`, `tax_num`, `physical_address`, `phone`, `email`, `website`, `created_at`, `logo`, `status`, `owner_id`) VALUES
(1, 'Naledi Services', '94HJJG-DHOHIO', 'DOAHG-DGOIH', 'APG-PCH', 'DYP0', 'Quartier Birere, Goma, Nord-Kivu, Congo', '0999999999', 'matjeremiah@gmail.com', 'https://mbiza.com', '2020-02-14', 'assets/logo/145ee8313d6a4a779286a5225deb22ed.jpeg', 'active', 1),
(2, 'CILU', '8920', '29UG-DOGUOZ-23', 'APG-PCH-HJ22', 'JODH976-0980223', 'Lukala', '0893399999', 'cilu@cilu.org', 'https://cilu.com', '2020-03-04', 'assets/logo/d69e84f4a40169df27edbb485ba1c6c0.jpeg', 'active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `fournisseur_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone_number` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `personne_de_contact` varchar(30) NOT NULL,
  `firm_id` int(11) NOT NULL,
  PRIMARY KEY (`fournisseur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fournisseurs`
--

INSERT INTO `fournisseurs` (`fournisseur_id`, `nom`, `email`, `phone_number`, `address`, `personne_de_contact`, `firm_id`) VALUES
(1, 'Yesu ni jibu', 'yesunijibu@gmail.com', '0987812348', 'Quartier Mabanga Avenue Virunga 07', 'Josaphat Imani', 1),
(2, 'La beauté', 'etslabeaute@gmail.com', '0987812348', 'Quartier Katindo', 'Domeshow Code', 1),
(3, 'Silimu', 'silimu@gmail.com', '0987802348', 'Quartier Himbi N°25', 'Domeshow Code Génie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `incomes_out_of_deposit`
--

DROP TABLE IF EXISTS `incomes_out_of_deposit`;
CREATE TABLE IF NOT EXISTS `incomes_out_of_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'du francais code_recep',
  `source` varchar(255) NOT NULL COMMENT 'du francais provenance',
  `reason` text NOT NULL COMMENT 'du francais motif',
  `amount` float(20,3) UNSIGNED NOT NULL COMMENT 'du francais montant',
  `shop_id` int(10) UNSIGNED NOT NULL,
  `insertion_date` datetime NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_IOD_Shops` (`shop_id`),
  KEY `FK_IOD_Users` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Du francais versement_hv' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `incomes_out_of_deposit`
--

INSERT INTO `incomes_out_of_deposit` (`id`, `source`, `reason`, `amount`, `shop_id`, `insertion_date`, `receiver_id`) VALUES
(1, 'TMB Ville', 'Parce qu\'ils nous aiment tellement', 129.900, 1, '2020-03-16 13:24:12', 1),
(3, 'Magasin De Luxe', 'Because i love Jesus so much', 129.900, 1, '2020-03-16 13:33:08', 1),
(4, 'Inconnue', 'Rien a specifier', 200.000, 1, '2020-03-18 20:00:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED NOT NULL,
  `date_sell` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `amount_reduced` double UNSIGNED DEFAULT NULL,
  `editor_id` int(10) UNSIGNED NOT NULL,
  `reducer_id` int(10) UNSIGNED DEFAULT NULL,
  `counter_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client_id`, `date_sell`, `type`, `invoice_number`, `amount_reduced`, `editor_id`, `reducer_id`, `counter_id`) VALUES
(1, 5, '2020-03-19', 'queue', '75942627', NULL, 6, NULL, 2),
(2, 7, '2020-03-18', 'queue', '57674232', NULL, 6, NULL, 2),
(3, 8, '2020-03-18', 'queue', '71401748', NULL, 6, NULL, 2),
(4, 9, '2020-03-18', 'queue', '88352941', NULL, 6, NULL, 2),
(5, 6, '2020-03-19', 'queue', '60804585', NULL, 6, NULL, 2),
(6, 6, '2020-03-19', 'queue', '62989256', NULL, 6, NULL, 2),
(7, 6, '2020-03-19', 'queue', '16592118', NULL, 6, NULL, 2),
(8, 9, '2020-03-19', 'queue', '76232376', NULL, 6, NULL, 2),
(9, 5, '2020-03-19', 'queue', '37865546', NULL, 6, NULL, 2),
(10, 5, '2020-03-19', 'queue', '65117043', NULL, 6, NULL, 2),
(11, 9, '2020-03-19', 'queue', '73699296', NULL, 6, NULL, 2),
(12, 5, '2020-03-19', 'queue', '36920752', NULL, 6, NULL, 2),
(13, 5, '2020-03-19', 'cash', '36388360', NULL, 6, NULL, 2),
(14, 5, '2020-03-19', 'queue', '37391816', NULL, 6, NULL, 2),
(15, 5, '2020-03-19', 'queue', '72111899', NULL, 6, NULL, 2),
(16, 6, '2020-03-19', 'queue', '73698407', NULL, 6, NULL, 2),
(17, 9, '2020-03-19', 'queue', '47775666', NULL, 6, NULL, 2),
(18, 6, '2020-03-19', 'queue', '51862368', NULL, 6, NULL, 2),
(19, 9, '2020-03-19', 'queue', '67886544', NULL, 6, NULL, 2),
(20, 9, '2020-03-19', 'queue', '85067048', NULL, 6, NULL, 2),
(21, 9, '2020-03-19', 'queue', '45053272', NULL, 6, NULL, 2),
(22, 9, '2020-03-19', 'credit', '19585596', NULL, 6, NULL, 2),
(23, 5, '2020-03-19', 'queue', '11979246', NULL, 6, NULL, 2),
(24, 5, '2020-03-19', 'credit', '63038140', NULL, 6, NULL, 2),
(25, 5, '2020-03-19', 'queue', '10579386', NULL, 6, NULL, 2),
(26, 5, '2020-03-19', 'credit', '45822084', NULL, 6, NULL, 2),
(27, 9, '2020-03-19', 'queue', '55078936', NULL, 6, NULL, 2),
(28, 5, '2020-03-19', 'queue', '66397804', NULL, 6, NULL, 2),
(29, 5, '2020-03-19', 'credit', '55192702', NULL, 6, NULL, 2),
(30, 8, '2020-03-19', 'queue', '35900409', NULL, 6, NULL, 2),
(31, 8, '2020-03-19', 'credit', '57148951', NULL, 6, NULL, 2),
(32, 8, '2020-03-19', 'queue', '50193202', NULL, 6, NULL, 2),
(33, 8, '2020-03-19', 'cash', '11739270', NULL, 6, NULL, 2),
(34, 6, '2020-03-19', 'queue', '64637091', NULL, 6, NULL, 2),
(35, 6, '2020-03-19', 'credit', '11338421', NULL, 6, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `outing_account`
--

DROP TABLE IF EXISTS `outing_account`;
CREATE TABLE IF NOT EXISTS `outing_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` text NOT NULL,
  `dispo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`, `photo`) VALUES
(1, 'Josaphat', 'Imani', 'josaphat.imani97@gmail.com', '0829034567', '@josaphat.imani97', '0f22cccde2ed8a81d594569a08837de15a818bc1', NULL),
(2, 'Josaphat', 'Ndabo', 'vikdi@gmail.com', '0999999997', 'jer323', '0f22cccde2ed8a81d594569a08837de15a818bc1', NULL),
(3, 'Mathaus', 'Doe', 'matjeremiah@gmail.com', '0970070334', '@mat', '0f22cccde2ed8a81d594569a08837de15a818bc1', NULL),
(4, 'Masombo', 'Guillain', 'masambo@gmail.com', '0829034227', '@masambo', '0f22cccde2ed8a81d594569a08837de15a818bc1', NULL),
(5, 'Mathaus', 'Muyenga', 'mbiza@mbiza.org', '0999993399', '@mbiza', '0f22cccde2ed8a81d594569a08837de15a818bc1', NULL),
(6, 'Emmanuel', 'MASIKILIZANO', 'domeshowenmmanuel@gmail.com', '243975938256', 'dome', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL);

--
-- Triggers `owners`
--
DROP TRIGGER IF EXISTS `Owner_Firm_Delete`;
DELIMITER $$
CREATE TRIGGER `Owner_Firm_Delete` BEFORE DELETE ON `owners` FOR EACH ROW BEGIN
	DELETE FROM Firms
	WHERE owner_id=OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

DROP TABLE IF EXISTS `pending`;
CREATE TABLE IF NOT EXISTS `pending` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `sell_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total` double NOT NULL,
  `payment` double NOT NULL DEFAULT 0,
  `deposit` double NOT NULL DEFAULT 0,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`id`, `article_id`, `sell_type`, `quantity`, `unit_price`, `total`, `payment`, `deposit`, `invoice_id`, `user_id`) VALUES
(1, 22, 'wholesale', 1, 150, 150, 0, 0, 1, 6),
(2, 22, 'retail', 1, 200, 200, 0, 0, 2, 6),
(3, 22, 'retail', 1, 200, 200, 0, 0, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

DROP TABLE IF EXISTS `productions`;
CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` double NOT NULL,
  `prod_date` datetime DEFAULT current_timestamp(),
  `factory_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `product_Id_FK_` (`product_id`),
  KEY `factories_id__FK_` (`factory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productions`
--

INSERT INTO `productions` (`id`, `product_id`, `quantity`, `prod_date`, `factory_id`, `status`) VALUES
(4, 12, 900, '2020-03-02 07:44:50', 1, 'pending'),
(5, 15, 530, '2020-03-07 11:55:23', 3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

DROP TABLE IF EXISTS `production_details`;
CREATE TABLE IF NOT EXISTS `production_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `production_id` int(10) UNSIGNED DEFAULT NULL,
  `articles_used` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `articles_quantity` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_used` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_quantity` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tools_used` text COLLATE utf8_unicode_ci NOT NULL,
  `tools_quantity` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productions_Id_FK_` (`production_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `production_details`
--

INSERT INTO `production_details` (`id`, `production_id`, `articles_used`, `articles_quantity`, `products_used`, `products_quantity`, `tools_used`, `tools_quantity`) VALUES
(4, 4, '', '', '', '', '3,4', '23,34'),
(5, 5, '31', '12', '14', '11', '7', '4');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `measure_unit` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `factory_id` int(10) UNSIGNED NOT NULL,
  `articles_used` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_used` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `Pr_Id_FK` (`factory_id`),
  KEY `Product_Store_4` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `designation`, `measure_unit`, `factory_id`, `articles_used`, `description`, `products_used`, `store_id`, `quantity`) VALUES
(12, 'Bonbons', 'Heures', 1, '19,21,22', '                              ', '', 1, 900),
(13, 'Bonbons B', 'Inches', 1, '18,21,22', '                              ', '12', 1, 0),
(14, 'Pain', 'Kg', 3, '', 'Optionnel', '', 4, 139),
(15, 'Sucre', 'Kg', 3, '31', 'Optionnel', '14', 4, 830),
(16, ',mvf', 'jhgf', 1, '21', '                              ', '12,13', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quote_price`
--

DROP TABLE IF EXISTS `quote_price`;
CREATE TABLE IF NOT EXISTS `quote_price` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `purchasing_price` double NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Q_Suppliers` (`supplier_id`),
  KEY `FK_Q_Articles` (`article_id`),
  KEY `FK_Q_Firms` (`firm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quote_price`
--

INSERT INTO `quote_price` (`id`, `supplier_id`, `article_id`, `purchasing_price`, `firm_id`) VALUES
(1, 2, 24, 500, 1),
(2, 2, 24, 560, 1),
(3, 1, 19, 670, 1),
(4, 1, 26, 650, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `since` date NOT NULL,
  `until` date DEFAULT NULL,
  `cdf` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `since`, `until`, `cdf`) VALUES
(10, '2020-02-25', '2020-03-01', 1670),
(11, '2020-03-02', '2020-03-01', 6678),
(12, '2020-03-02', '2020-03-02', 7890),
(13, '2020-03-02', '2020-03-02', 567),
(14, '2020-03-02', '2020-03-02', 789),
(15, '2020-03-02', '2020-03-04', 7500),
(16, '2020-03-04', NULL, 1700);

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
CREATE TABLE IF NOT EXISTS `requisitions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `inserted_at` date NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `store_id_to` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_RQ_User` (`user_id`),
  KEY `FK_RQ_Stores` (`store_id`),
  KEY `FK_RQ_Stores_2` (`store_id_to`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `user_id`, `inserted_at`, `status`, `store_id`, `store_id_to`) VALUES
(71, 1, '2020-02-28', 'confirmed', 1, 2),
(75, 1, '2020-03-03', 'confirmed', 1, 2),
(78, 1, '2020-03-04', 'confirmed', 1, 2),
(82, 1, '2020-03-05', 'confirmed', 1, 2),
(84, 1, '2020-03-05', 'approved', 1, 2),
(85, 1, '2020-03-05', 'pending', 1, 1),
(86, 1, '2020-03-05', 'pending', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_tb`
--

DROP TABLE IF EXISTS `requisition_tb`;
CREATE TABLE IF NOT EXISTS `requisition_tb` (
  `requisition_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(250) NOT NULL,
  `store_id` int(11) NOT NULL,
  `status` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`requisition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_tb`
--

INSERT INTO `requisition_tb` (`requisition_id`, `amount`, `store_id`, `status`, `created_at`) VALUES
(1, '2470', 1, 'pending', '2020-02-26 16:45:44'),
(2, '78510', 1, 'pending', '2020-02-26 16:47:31'),
(3, '136880', 1, 'approved', '2020-02-26 17:02:55'),
(4, '34700', 1, 'pending', '2020-02-27 10:37:37'),
(5, '1120', 1, 'pending', '2020-02-27 14:00:04'),
(6, '3360', 1, 'pending', '2020-02-27 16:48:44'),
(7, '2240', 1, 'pending', '2020-02-29 00:43:12'),
(8, '0', 1, 'pending', '2020-02-29 01:40:59'),
(9, '0', 2, 'pending', '2020-03-02 11:05:14'),
(10, '30000', 2, 'pending', '2020-03-02 11:06:26'),
(11, '0', 2, 'pending', '2020-03-02 11:56:43'),
(12, '158970', 2, 'pending', '2020-03-03 09:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `sell_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total` double NOT NULL,
  `payment` double NOT NULL DEFAULT 0,
  `deposit` double NOT NULL DEFAULT 0,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` text NOT NULL,
  `normal_price` float(20,2) NOT NULL,
  `clients_price` float(20,2) NOT NULL,
  `charity_price` float(20,2) NOT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_shop` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `designation`, `normal_price`, `clients_price`, `charity_price`, `shop_id`) VALUES
(1, 'Web Application', 500.00, 400.00, 250.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services_sells`
--

DROP TABLE IF EXISTS `services_sells`;
CREATE TABLE IF NOT EXISTS `services_sells` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `delay` int(10) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SS_Invoices` (`invoice_id`),
  KEY `FK_SS_Services` (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_sells`
--

INSERT INTO `services_sells` (`id`, `service_id`, `invoice_id`, `delay`, `price`) VALUES
(1, 1, 4, 1, 250),
(2, 1, 13, 1, 400),
(3, 1, 33, 1, 500),
(4, 1, 35, 1, 250);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firm_id` (`firm_id`,`designation`),
  UNIQUE KEY `store_id` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `designation`, `address`, `firm_id`, `description`, `store_id`) VALUES
(1, 'Magasin de luxe 56', 'Magano Nord-Est', 1, 'Long description here', 1),
(2, 'My new shop', 'Address', 1, '', NULL),
(3, 'Cilu Shop A', 'Magano Nord', 2, '', 6),
(4, 'Cilu Shop B', 'Quartier birere avenue luvungu', 2, '', 7);

--
-- Triggers `shops`
--
DROP TRIGGER IF EXISTS `Shop_User_Delete`;
DELIMITER $$
CREATE TRIGGER `Shop_User_Delete` BEFORE DELETE ON `shops` FOR EACH ROW BEGIN
	DELETE FROM Users
	WHERE role="shop" AND entity_id=OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `firm_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firm_id` (`firm_id`,`designation`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `designation`, `address`, `firm_id`, `description`, `type`) VALUES
(1, 'Store dénis', 'Mon adresse', 1, 'Big descr', 'Merchandise'),
(2, 'Store 2', 'My adress', 1, NULL, 'Raw Materials'),
(3, 'Virunga Store', 'Quartier birere avenue luvungu', 1, 'Depot pour matiere premiere', 'Raw Materials'),
(4, 'Cilu Store A', 'Quartier birere avenue luvungu', 2, '', 'Raw Materials'),
(5, 'Cilu Store B', 'Quartier birere avenue luvungu', 2, '', 'Raw Materials'),
(6, 'Cilu Store C', 'Quartier birere avenue luvungu', 2, '', 'Merchandise'),
(7, 'Cilu Store D', 'Quartier birere avenue luvungu', 2, '', 'Merchandise');

--
-- Triggers `stores`
--
DROP TRIGGER IF EXISTS `Store_User_Delete`;
DELIMITER $$
CREATE TRIGGER `Store_User_Delete` BEFORE DELETE ON `stores` FOR EACH ROW BEGIN
	DELETE FROM Users
	WHERE role="store" AND entity_id=OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `store_requisitions`
--

DROP TABLE IF EXISTS `store_requisitions`;
CREATE TABLE IF NOT EXISTS `store_requisitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requisition_no` int(11) NOT NULL DEFAULT 0,
  `article_name` varchar(250) NOT NULL,
  `quantity_requested` int(11) NOT NULL,
  `purchasing_price` varchar(50) NOT NULL,
  `supplier_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
CREATE TABLE IF NOT EXISTS `tools` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `measure_unit` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` double NOT NULL,
  `factory_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TOOLS_Id_FK` (`factory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `designation`, `measure_unit`, `unit_price`, `factory_id`) VALUES
(3, 'Main d\'oeuvre', 'Heures', 100, 1),
(4, 'Other tool', 'Litres', 1, 1),
(5, 'The last one', 'Inches', 3, 1),
(6, 'Groupe', 'Litre', 1, 1),
(7, 'Groupe', 'Litre', 1800, 3),
(8, 'Tracteur', 'Litre', 3000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`,`entity_id`,`firm_id`),
  KEY `FK_Users_Firm` (`firm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `phone`, `role`, `entity_id`, `email`, `status`, `firm_id`, `photo`) VALUES
(1, 'Samuel', 'Muyenga', '@jeno28', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0999999999', 'shops', 1, 'johnkasimbo@gmail.com', 1, 1, 'assets/users/6bf853b67d21adc914ea05bd66a18341.jpeg'),
(2, 'Mulemba', 'Papy', '@jud', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0970070322', 'stores', 1, 'jud@gmail.com', 1, 1, 'assets/users/6bf853b67d21adc914ea05bd66a18341.jpeg'),
(5, 'Bulenda', 'Melanie', '@melanie', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0970270322', 'factories', 1, 'melanie@gmail.com', 1, 1, 'assets/users/6bf853b67d21adc914ea05bd66a18341.jpeg'),
(6, 'Kabuya', 'Mesina', '@counter1', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0970072234', 'counters', 2, 'kubu@gmail.com', 1, 1, 'assets/users/0df76f79d7c4ebd51b1ccab20d8b9ca8.jpeg'),
(7, 'Cilu User A', 'Imani', '@counter2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0970070111', 'counters', 4, 'a@cilu.org', 1, 2, 'assets/users/98523b929e5b8870630d6b49981d27c5.jpeg'),
(8, 'Cilu User B', 'Nathan', '@cilub', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0970070332', 'shops', 3, 'b@cilu.org', 1, 2, 'assets/users/245b546356c2902e1b409cb1cead3c97.jpeg'),
(9, 'Cilu User C', 'Muyenga', '@ciluc', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0970070338', 'factories', 3, 'c@cilu.org', 1, 2, 'assets/users/7ddbd6a2054d1496c98819ef191c4400.jpeg'),
(10, 'Cilu User D', 'Muyenga', '@cilud', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0970070311', 'stores', 6, 'd@cilu.org', 1, 2, 'assets/users/4e95f21f3dbee4cacad0a5130f4ff2f5.jpeg'),
(11, 'Cilu User E', 'Doe', '@cilue', '0f22cccde2ed8a81d594569a08837de15a818bc1', '0829034522', 'stores', 4, 'e@cilu.org', 1, 2, 'assets/users/a9956d60d4ec7b50149b7186bad92768.jpeg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `Articles_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `firms` (`id`),
  ADD CONSTRAINT `Articles_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories_a` (`id`),
  ADD CONSTRAINT `Articles_ibfk_4` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `articles_requisitioned`
--
ALTER TABLE `articles_requisitioned`
  ADD CONSTRAINT `FK_AR_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_mp_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AR_Requisition` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articles_sells`
--
ALTER TABLE `articles_sells`
  ADD CONSTRAINT `FK_AS_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_mp_id`),
  ADD CONSTRAINT `FK_AS_Invoices` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `cart_articles`
--
ALTER TABLE `cart_articles`
  ADD CONSTRAINT `FK_CA_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_mp_id`),
  ADD CONSTRAINT `FK_CA_Firms` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`),
  ADD CONSTRAINT `FK_CA_Invoices` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `FK_CS_Invoices` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `cart_services`
--
ALTER TABLE `cart_services`
  ADD CONSTRAINT `FK_CS_Counters` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `FK_CS_Services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `cash_outing`
--
ALTER TABLE `cash_outing`
  ADD CONSTRAINT `FK_CO_CashOuting` FOREIGN KEY (`cash_outing_reason_id`) REFERENCES `cash_outing_reasons` (`id`),
  ADD CONSTRAINT `FK_CO_Counters` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`),
  ADD CONSTRAINT `FK_CO_Shops` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `FK_CO_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cash_outing_reasons`
--
ALTER TABLE `cash_outing_reasons`
  ADD CONSTRAINT `FK_ER_Shops` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `categories_a`
--
ALTER TABLE `categories_a`
  ADD CONSTRAINT `categories_a_ibfk_1` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`);

--
-- Constraints for table `closures`
--
ALTER TABLE `closures`
  ADD CONSTRAINT `FK_CL_Counters` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`),
  ADD CONSTRAINT `FK_CL_Doers` FOREIGN KEY (`doer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_CL_Receivers` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `FK_C_Clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `entry_stock`
--
ALTER TABLE `entry_stock`
  ADD CONSTRAINT `FK_ES_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_mp_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ES_Stores` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `factories`
--
ALTER TABLE `factories`
  ADD CONSTRAINT `FK_Factory_Factory` FOREIGN KEY (`parent`) REFERENCES `factories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Factory_Firm` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Factory_Store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `firms`
--
ALTER TABLE `firms`
  ADD CONSTRAINT `FM_Id_FK` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incomes_out_of_deposit`
--
ALTER TABLE `incomes_out_of_deposit`
  ADD CONSTRAINT `FK_IOD_Shops` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `FK_IOD_Users` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `factories_id__FK_` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`),
  ADD CONSTRAINT `product_Id_FK_` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `production_details`
--
ALTER TABLE `production_details`
  ADD CONSTRAINT `productions_Id_FK_` FOREIGN KEY (`production_id`) REFERENCES `productions` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Pr_Id_FK` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`),
  ADD CONSTRAINT `Product_Store_4` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `FK_RQ_Stores` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_RQ_Stores_2` FOREIGN KEY (`store_id_to`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_RQ_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `Fk_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `FK_Shop_Firm` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Shop_Store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `FK_Store_Firm` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `TOOLS_Id_FK` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_Firm` FOREIGN KEY (`firm_id`) REFERENCES `firms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
