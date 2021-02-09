-- --------------------------------------------------------
-- Host:                         81.31.151.15
-- Server version:               10.3.27-MariaDB-log - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for interna5_svagiaz
CREATE DATABASE IF NOT EXISTS `interna5_svagiaz` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `interna5_svagiaz`;

-- Dumping structure for table interna5_svagiaz.questions_table
CREATE TABLE IF NOT EXISTS `questions_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` tinytext DEFAULT NULL,
  `question_tipology` int(11) NOT NULL COMMENT '0 - economico-Finaziaria 1- clienti  2-formazione einnovazione  3- processi  4-Grafici performance 5-Correlazioni',
  `sub_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Dumping data for table interna5_svagiaz.questions_table: ~40 rows (approximately)
/*!40000 ALTER TABLE `questions_table` DISABLE KEYS */;
INSERT INTO `questions_table` (`id`, `question_text`, `question_tipology`, `sub_category`) VALUES
	(1, 'In azienda l\'assetto organizzativo (poteri e deleghe, flussi informativi e procedure operative) è formalizzato e rispettato', 0, 0),
	(2, 'Il processo di budgeting è formalizzato, con cadenza almeno annuale ', 0, 0),
	(3, 'Monitoriamo il margine di contribuzione e programmiamo azioni per migliorarlo', 0, 0),
	(4, 'Effettuiamo l\'analisi degli scostamenti budget vs consuntivo', 0, 0),
	(5, 'Controlliamo gli ordini in portafoglio in termini di copertura mensile', 0, 0),
	(6, 'Programmiamo azioni per ottimizzare l\'esposizione finanziaria', 0, 1),
	(7, 'Disponiamo di strumenti per prevedere le esigenze finanziarie dell\'azienda a 3/6 mesi', 0, 1),
	(8, 'Programmiamo azioni per ridurre il valore di magazzino', 0, 1),
	(9, 'L\'EBITDA è in linea o migliore della media del nostro settore', 0, 2),
	(10, 'Monitoriamo regolarmente la nostra quota di mercato', 0, 2),
	(11, 'Realizziamo periodicamente indagini di mercato sui prodotti o servizi della concorrenza', 1, 0),
	(12, 'Monitoriamo regolarmente il margine di contribuzione dei nostri prodotti/servizi', 1, 0),
	(13, 'Raccogliamo sistematicamente i suggerimenti dei clienti sui nostri prodotti o servizi', 1, 1),
	(14, 'Le informazioni raccolte dai clienti sono condivise ed utilizzate all’interno dell\'azienda', 1, 1),
	(15, 'Abbiamo un piano di marketing formalizzato, con tutte le attività definite per l’anno', 1, 2),
	(16, 'Abbiamo una strategia di comunicazione digitale (web/social) e gestiamo un database aggiornato dei nostri clienti', 1, 2),
	(17, 'Misuriamo regolarmente il ritorno economico delle azioni di marketing', 1, 2),
	(18, 'Marketing e Vendite collaborano regolarmente nella realizzazione del piano operativo', 1, 2),
	(19, 'Abbiamo personale dedicato al customer service', 1, 3),
	(20, 'Abbiamo procedure formalizzate per gestire i reclami da parte dei clienti', 1, 3),
	(21, 'Abbiamo un sistema per raccogliere i consigli dei dipendenti', 2, 0),
	(22, 'Abbiamo un basso livello di assenteismo e di turnover', 2, 0),
	(23, 'Abbiamo un programma di welfare aziendale e di valutazione del clima aziendale', 2, 0),
	(24, 'Investiamo con continuità sul miglioramento di prodotti e servizi per i nostri clienti', 2, 1),
	(25, 'Abbiamo brevetti di nostra proprietà / certificazioni', 2, 1),
	(26, 'Monitoriamo il fatturato dei nuovi prodotti e servizi in linea con gli obiettivi', 2, 1),
	(27, 'Abbiamo e rispettiamo la pianificazione di formazione tecnica del nostro personale', 2, 2),
	(28, 'Abbiamo un programma di sviluppo manageriale per i quadri ed i dirigenti', 2, 2),
	(29, 'Facciamo formazione sulle soft skills (comunicazione, intelligenza emozionale, gestione del tempo, etc.)', 2, 2),
	(30, 'Per la selezione del personale e per i piani di crescita professionale utilizziamo strumenti di analisi', 2, 2),
	(31, 'Monitoriamo regolarmente il numero e la percentuale delle consegne non conformi e in ritardo da parte dei nostri fornitori', 3, 0),
	(32, 'Abbiamo un sistema di valutazione e certificazione dei fornitori basato su indicatori qualitativi e quantitativi', 3, 0),
	(33, 'Monitoriamo l\'utilizzo della manodopera e l\'efficienza degli impianti', 3, 1),
	(34, 'Il piano di produzione è condiviso regolarmente con l\'area commerciale', 3, 1),
	(35, 'Abbiamo personale di back-up per ogni posizione critica del processo produttivo', 3, 1),
	(36, 'Monitoriamo il numero di azioni per la vendita del singolo venditore', 3, 2),
	(37, 'Monitoriamo la percentuale di conversione dei preventivi effettuati in contratti, e dei contatti in preventivi', 3, 2),
	(38, 'Il ciclo dell\'ordine (dal contratto all\'incasso) è standardizzato e conosciuto da tutti gli addetti al servizio commerciale', 3, 2),
	(39, 'Monitoriamo il costo per click della nostra attività online e la percentuale di conversione dei click in contatti', 3, 3),
	(40, 'Classifichiamo e monitoriamo le non conformità dei nostri prodotti/servizi verso i clienti ', 3, 4);
/*!40000 ALTER TABLE `questions_table` ENABLE KEYS */;

-- Dumping structure for table interna5_svagiaz.save_answer
CREATE TABLE IF NOT EXISTS `save_answer` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) DEFAULT NULL,
  `answer_questions` int(11) DEFAULT NULL,
  `question_tipology` int(1) DEFAULT NULL,
  `subcategory_question` int(1) DEFAULT NULL,
  `punteggio` int(1) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

-- Dumping data for table interna5_svagiaz.save_answer: ~120 rows (approximately)
/*!40000 ALTER TABLE `save_answer` DISABLE KEYS */;
INSERT INTO `save_answer` (`id_answer`, `id_question`, `answer_questions`, `question_tipology`, `subcategory_question`, `punteggio`, `id_user`) VALUES
	(81, 1, 2, 0, 0, 1, 66),
	(82, 2, 3, 0, 0, 2, 66),
	(83, 3, 4, 0, 0, 3, 66),
	(84, 4, 3, 0, 0, 2, 66),
	(85, 5, 4, 0, 0, 3, 66),
	(86, 6, 1, 0, 1, 0, 66),
	(87, 7, 4, 0, 1, 3, 66),
	(88, 8, 5, 0, 1, 4, 66),
	(89, 9, 3, 0, 2, 2, 66),
	(90, 10, 5, 0, 2, 4, 66),
	(91, 11, 2, 1, 0, 1, 66),
	(92, 12, 4, 1, 0, 3, 66),
	(93, 13, 3, 1, 1, 2, 66),
	(94, 14, 4, 1, 1, 3, 66),
	(95, 15, 4, 1, 2, 3, 66),
	(96, 16, 5, 1, 2, 4, 66),
	(97, 17, 5, 1, 2, 4, 66),
	(98, 18, 1, 1, 2, 0, 66),
	(99, 19, 3, 1, 3, 2, 66),
	(100, 20, 4, 1, 3, 3, 66),
	(101, 21, 3, 2, 0, 2, 66),
	(102, 22, 4, 2, 0, 3, 66),
	(103, 23, 3, 2, 0, 2, 66),
	(104, 24, 2, 2, 1, 1, 66),
	(105, 25, 5, 2, 1, 4, 66),
	(106, 26, 3, 2, 1, 2, 66),
	(107, 27, 4, 2, 2, 3, 66),
	(108, 28, 4, 2, 2, 3, 66),
	(109, 29, 1, 2, 2, 0, 66),
	(110, 30, 2, 2, 2, 1, 66),
	(111, 31, 3, 3, 0, 2, 66),
	(112, 32, 4, 3, 0, 3, 66),
	(113, 33, 5, 3, 1, 4, 66),
	(114, 34, 1, 3, 1, 0, 66),
	(115, 35, 5, 3, 1, 4, 66),
	(116, 36, 2, 3, 2, 1, 66),
	(117, 37, 4, 3, 2, 3, 66),
	(118, 38, 5, 3, 2, 4, 66),
	(119, 39, 1, 3, 3, 0, 66),
	(120, 40, 2, 3, 4, 1, 66),
	(121, 1, 5, 0, 0, 4, 60),
	(122, 2, 5, 0, 0, 4, 60),
	(123, 3, 5, 0, 0, 4, 60),
	(124, 4, 5, 0, 0, 4, 60),
	(125, 5, 5, 0, 0, 4, 60),
	(126, 6, 5, 0, 1, 4, 60),
	(127, 7, 5, 0, 1, 4, 60),
	(128, 8, 5, 0, 1, 4, 60),
	(129, 9, 5, 0, 2, 4, 60),
	(130, 10, 5, 0, 2, 4, 60),
	(131, 11, 5, 1, 0, 4, 60),
	(132, 12, 5, 1, 0, 4, 60),
	(133, 13, 5, 1, 1, 4, 60),
	(134, 14, 5, 1, 1, 4, 60),
	(135, 15, 5, 1, 2, 4, 60),
	(136, 16, 5, 1, 2, 4, 60),
	(137, 17, 5, 1, 2, 4, 60),
	(138, 18, 5, 1, 2, 4, 60),
	(139, 19, 5, 1, 3, 4, 60),
	(140, 20, 5, 1, 3, 4, 60),
	(141, 21, 5, 2, 0, 4, 60),
	(142, 22, 5, 2, 0, 4, 60),
	(143, 23, 5, 2, 0, 4, 60),
	(144, 24, 5, 2, 1, 4, 60),
	(145, 25, 5, 2, 1, 4, 60),
	(146, 26, 5, 2, 1, 4, 60),
	(147, 27, 5, 2, 2, 4, 60),
	(148, 28, 5, 2, 2, 4, 60),
	(149, 29, 4, 2, 2, 3, 60),
	(150, 30, 5, 2, 2, 4, 60),
	(151, 31, 5, 3, 0, 4, 60),
	(152, 32, 5, 3, 0, 4, 60),
	(153, 33, 5, 3, 1, 4, 60),
	(154, 34, 5, 3, 1, 4, 60),
	(155, 35, 5, 3, 1, 4, 60),
	(156, 36, 5, 3, 2, 4, 60),
	(157, 37, 5, 3, 2, 4, 60),
	(158, 38, 5, 3, 2, 4, 60),
	(159, 39, 5, 3, 3, 4, 60),
	(160, 40, 5, 3, 4, 4, 60),
	(161, 1, 3, 0, 0, 2, 63),
	(162, 2, 4, 0, 0, 3, 63),
	(163, 3, 4, 0, 0, 3, 63),
	(164, 4, 5, 0, 0, 4, 63),
	(165, 5, 5, 0, 0, 4, 63),
	(166, 6, 5, 0, 1, 4, 63),
	(167, 7, 5, 0, 1, 4, 63),
	(168, 8, 5, 0, 1, 4, 63),
	(169, 9, 5, 0, 2, 4, 63),
	(170, 10, 5, 0, 2, 4, 63),
	(171, 11, 5, 1, 0, 4, 63),
	(172, 12, 5, 1, 0, 4, 63),
	(173, 13, 5, 1, 1, 4, 63),
	(174, 14, 5, 1, 1, 4, 63),
	(175, 15, 5, 1, 2, 4, 63),
	(176, 16, 5, 1, 2, 4, 63),
	(177, 17, 5, 1, 2, 4, 63),
	(178, 18, 5, 1, 2, 4, 63),
	(179, 19, 5, 1, 3, 4, 63),
	(180, 20, 5, 1, 3, 4, 63),
	(181, 21, 5, 2, 0, 4, 63),
	(182, 22, 5, 2, 0, 4, 63),
	(183, 23, 5, 2, 0, 4, 63),
	(184, 24, 5, 2, 1, 4, 63),
	(185, 25, 5, 2, 1, 4, 63),
	(186, 26, 5, 2, 1, 4, 63),
	(187, 27, 5, 2, 2, 4, 63),
	(188, 28, 5, 2, 2, 4, 63),
	(189, 29, 5, 2, 2, 4, 63),
	(190, 30, 5, 2, 2, 4, 63),
	(191, 31, 5, 3, 0, 4, 63),
	(192, 32, 5, 3, 0, 4, 63),
	(193, 33, 5, 3, 1, 4, 63),
	(194, 34, 5, 3, 1, 4, 63),
	(195, 35, 5, 3, 1, 4, 63),
	(196, 36, 5, 3, 2, 4, 63),
	(197, 37, 5, 3, 2, 4, 63),
	(198, 38, 5, 3, 2, 4, 63),
	(199, 39, 5, 3, 3, 4, 63),
	(200, 40, 5, 3, 4, 4, 63);
/*!40000 ALTER TABLE `save_answer` ENABLE KEYS */;

-- Dumping structure for table interna5_svagiaz.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `regione` varchar(50) NOT NULL,
  `settore_attivita` varchar(50) NOT NULL,
  `fascia_dipendenti` varchar(50) NOT NULL,
  `ruolo` varchar(50) NOT NULL,
  `numero_telefono` varchar(15) NOT NULL DEFAULT '',
  `ragione_sociale` varchar(50) NOT NULL,
  `nr_anagrafiche` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1-attivo;0-disattivo',
  `livello` tinyint(4) DEFAULT NULL COMMENT '1-user; 2-admin; 3-superadmin',
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- Dumping data for table interna5_svagiaz.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_users`, `username`, `password`, `nome`, `cognome`, `email`, `regione`, `settore_attivita`, `fascia_dipendenti`, `ruolo`, `numero_telefono`, `ragione_sociale`, `nr_anagrafiche`, `status`, `livello`, `id_admin`) VALUES
	(1, 'simone.brancozzi@gmail.com', 'simone2$ds96@', 'Simone', 'Brancozzi', 'simone.brancozzi@gmail.com', 'Italia', 'Commercialista', '', '', '000', '00', 1000, 1, 3, NULL),
	(57, 'admin1', 'admin1', 'admin1', 'admin1', 'admin1@test.com', 'Italia', '', '', '', '0001', 'tesst23', 12, 1, 2, 1),
	(58, 'admin2', 'admin2', 'admin2', 'admin2', 'admin2@test.com', 'Italia', '', '', '', '', '', 30, 1, 2, 1),
	(59, 'mikelmikel', 'mikelmikel', 'mikel', 'prifti', 'mikel@prifti.comm', 'durres', '', '', '', '23423423', 'libra', 10, 0, 2, 1),
	(60, 'priftiprifti', 'priftiprifti', 'priftiprifti', 'priftiprifti', 'prifti@prifti.com', 'Durres', '', '', '', '23432423424', 'libra', 0, 0, 1, 59),
	(61, 'dilaverdilaver', 'dilaverdilaver', 'dilaver', 'dilaver', 'dila222ver@musa.com', 'asdsdasa', '', '', '', '234432342`', 'sadasdsad', NULL, 0, 1, 59),
	(62, 'user13', 'user13', 'user13', 'user13', 'user13@test.com', 'Italia3', '', '', '', '0003', 'test', 0, 1, 1, 57),
	(63, 'user2', 'user2', 'user2', 'user2', 'user2@test.com', 'Italia', '', '', '', '0001', 'tesst23', 12, 1, 1, 57),
	(64, 'user3', 'user3', 'user3', 'user3', 'user3@test.com', 'Italia', '', '', '', '0001', 'tesst23', 12, 1, 1, 57),
	(65, 'admin', 'admin', 'dilaver', 'musa', 'dilaver1@1musa.com', 'asddsaasd', '', '', '', '1435321213', 'asdsdadas', 1, 1, 2, 1),
	(66, 'simonetest', 'simonetest', 'simonetest', 'simonetest', 'simonetest@gmail.com', 'dasdasd', '', '', '', '42342343', 'dasdad', NULL, 1, 1, 65),
	(67, 'mikelprifti', 'mikelprifti', 'dd', 'dd', 'dila222ver@musa.com', 'DADA', '', '', '', '1111', 'dd', NULL, 0, 1, 57);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
