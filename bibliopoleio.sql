-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 23 Φεβ 2012 στις 16:17:55
-- Έκδοση Διακομιστή: 5.5.16
-- Έκδοση PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `bibliopoleio`
--

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `biblia`
--

CREATE TABLE IF NOT EXISTS `biblia` (
  `biblia_id` int(5) NOT NULL AUTO_INCREMENT,
  `biblia_periodos` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_hmeromhnia` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_isbn` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_xrwma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_diastaseis` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_selides` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tomeisEidikotites_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_sxolia` longtext COLLATE utf8_unicode_ci,
  `biblia_eidosTitlou` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_eikonografimeno` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`biblia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Άδειασμα δεδομένων του πίνακα `biblia`
--

INSERT INTO `biblia` (`biblia_id`, `biblia_periodos`, `biblia_hmeromhnia`, `biblia_isbn`, `biblia_name`, `biblia_xrwma`, `biblia_diastaseis`, `biblia_selides`, `suggrafeis_id`, `tomeisEidikotites_id`, `biblia_sxolia`, `biblia_eidosTitlou`, `biblia_eikonografimeno`) VALUES
(1, '', '', '', 'asdasd', 'Ασπρόμαυρο', '', '', '79f39014bb6ecd7c4e79', '', '', 'Βιβλίο', 0),
(2, '', '', '', 'asdasdzxc', 'Ασπρόμαυρο', '', '', '79f39014bb6ecd7c4e79', '9', '', 'Βιβλίο', 0),
(3, '', '', '', 'adasdasdasd', 'Î‘ÏƒÏ€ÏÏŒÎ¼Î±Ï…ÏÎ¿', '', '', '79f39014bb6ecd7c4e79', '10_8', '', 'Î’Î¹Î²Î»Î¯Î¿', 0),
(4, '', '', '', 'qweqweqwe', 'Î‘ÏƒÏ€ÏÏŒÎ¼Î±Ï…ÏÎ¿', '', '', '79f39014bb6ecd7c4e79', '9_10_8_11', '', 'Î’Î¹Î²Î»Î¯Î¿', 0),
(5, '2010', '121223', '12as12', 'html', 'Î‘ÏƒÏ€ÏÏŒÎ¼Î±Ï…ÏÎ¿', '50x50', '60', '79f39014bb6ecd7c4e79', '11', '', 'Î’Î¹Î²Î»Î¯Î¿', 1),
(6, '2011', '15254', 'asdasd', 'css', 'Ασπρόμαυρο', '100x50', '100', '79f39014bb6ecd7c4e79', '9', '', 'Ερωτήσεις Πιστοποίησης', 1),
(7, '23123', '12321', 'asdasd', 'asdqqwe', 'Ασπρόμαυρο', '', '', '79f39014bb6ecd7c4e79', '', '', 'Βιβλίο', 0),
(8, '123', '123', 'asd', 'qweasdzxc', 'Ασπρόμαυρο', '', '', '79f39014bb6ecd7c4e79', '', '', 'Βιβλίο', 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `ekdotikoi`
--

CREATE TABLE IF NOT EXISTS `ekdotikoi` (
  `ekdotikoi_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ekdotikoi_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_epwnymo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_onoma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_dieuthinsi` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_tk` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_poli` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_stathero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_kinito` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_afm` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_doy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_sxolia` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ekdotikoi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `ekdotikoi`
--

INSERT INTO `ekdotikoi` (`ekdotikoi_id`, `ekdotikoi_name`, `ekdotikoi_epwnymo`, `ekdotikoi_onoma`, `ekdotikoi_dieuthinsi`, `ekdotikoi_tk`, `ekdotikoi_poli`, `ekdotikoi_stathero`, `ekdotikoi_kinito`, `ekdotikoi_email`, `ekdotikoi_afm`, `ekdotikoi_doy`, `ekdotikoi_sxolia`) VALUES
('157db857a3570d87d2cb', 'gkiourdas', 'gkiourdas', 'mosxos', 'asd', '12345', 'athina', '1234567890', '1234567890', '', '123456789', 'asd', '');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `paraggelies`
--

CREATE TABLE IF NOT EXISTS `paraggelies` (
  `paraggelies_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paraggelies_kataxwrisiDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_id` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ekdotikoi_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_paralaviWordDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_apostoliWordEkdDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_paralaviPdfDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_checkSuggrafeaDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_egkrisiPdf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_paralaviRahis` double(10,2) DEFAULT NULL,
  `paraggelies_aitisiTypografeioDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_isbn` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_aitisiEksofDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_paralaviEksofDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_apostoliEksofDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_paralaviBibDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_biblioAxia` double(10,2) DEFAULT NULL,
  `paraggelies_temaxia` int(5) DEFAULT NULL,
  `paraggelies_sxolia` longtext COLLATE utf8_unicode_ci,
  `paraggelies_kostosEktyposi` double(10,2) DEFAULT NULL,
  `paraggelies_kostosSyntFpa` double(10,2) DEFAULT NULL,
  `paraggelies_kostosFpa` double(10,2) DEFAULT NULL,
  `paraggelies_kostosMeFpa` double(10,2) DEFAULT NULL,
  `paraggelies_kostosSuggrafeas` double(10,2) DEFAULT NULL,
  `paraggelies_kostosSynolo` double(10,2) DEFAULT NULL,
  `paraggelies_kerdosTemaxio` double(10,2) DEFAULT NULL,
  `paraggelies_kerdosSyntTziros` double(10,2) DEFAULT NULL,
  `paraggelies_kerdosSyntKostos` double(10,2) DEFAULT NULL,
  `paraggelies_kerdosSynolo` double(10,2) DEFAULT NULL,
  `paraggelies_ektyposiSymfonDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_ypografiSuggrafeaDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_egkrisiKarantDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_apostoliLogistDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paraggelies_pliromiSuggrafeaDate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`paraggelies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `pwliseis`
--

CREATE TABLE IF NOT EXISTS `pwliseis` (
  `pwliseis_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pwliseis_apodeiksi` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwliseis_hmerominia` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biblia_id` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwliseis_pelatis` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwliseis_temaxia` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwliseis_timi` double(10,2) DEFAULT NULL,
  `pwliseis_telikiAxia` double(10,2) DEFAULT NULL,
  `pwliseis_tiposSynallagis` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pwliseis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `pwliseis`
--

INSERT INTO `pwliseis` (`pwliseis_id`, `pwliseis_apodeiksi`, `pwliseis_hmerominia`, `biblia_id`, `pwliseis_pelatis`, `pwliseis_temaxia`, `pwliseis_timi`, `pwliseis_telikiAxia`, `pwliseis_tiposSynallagis`) VALUES
('c4ca4238a0b923820dcc', '0001', '123', '3', 'babis mysta', '1', 13.00, 15.00, 'Πώληση');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `suggrafeis`
--

CREATE TABLE IF NOT EXISTS `suggrafeis` (
  `suggrafeis_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `suggrafeis_epwnymo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_onoma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_dieuthinsi` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_tk` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_poli` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_perioxi` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_stathero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_kinito` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_afm` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_doy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_fylo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggrafeis_hmer_gennisis` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`suggrafeis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `suggrafeis`
--

INSERT INTO `suggrafeis` (`suggrafeis_id`, `suggrafeis_epwnymo`, `suggrafeis_onoma`, `suggrafeis_dieuthinsi`, `suggrafeis_tk`, `suggrafeis_poli`, `suggrafeis_perioxi`, `suggrafeis_stathero`, `suggrafeis_kinito`, `suggrafeis_afm`, `suggrafeis_doy`, `suggrafeis_fylo`, `suggrafeis_email`, `suggrafeis_hmer_gennisis`) VALUES
('39b451e9ff791f2119c9', 'mysta', 'mpampis', 'asddf', '45789', 'thesaloniki', 'menemeni', '1234567890', '1234567980', '132465798', 'thesalonikis', 'Επιλέξτε', 'mysta@hotmail.com', '12/12/12'),
('79f39014bb6ecd7c4e79', 'kiriakou', 'ilias', 'sofokli', '57019', 'thessaloniki', 'peraia', '26732', '6936767584', '123456789', 'kalamarias', 'Αρρέν', 'call_me_liakos@hotmail.com', '1/6/88'),
('a384b6463fc216a5f8ec', 'qwert', 'asd', 'asd', 'asdf', 'asdf', 'asd', 'asd', 'asd', 'asd', 'sd', '', 'asd', '213');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
