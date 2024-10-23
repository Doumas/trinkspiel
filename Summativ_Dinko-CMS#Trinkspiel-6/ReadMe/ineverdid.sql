-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 10. Dez 2021 um 21:01
-- Server-Version: 5.6.38
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ineverdid`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newGamePublic`
--

CREATE TABLE `newGamePublic` (
  `userId` int(11) NOT NULL,
  `title` varchar(29) NOT NULL,
  `question_0` varchar(159) NOT NULL,
  `question_1` varchar(159) NOT NULL,
  `question_2` varchar(159) NOT NULL,
  `question_3` varchar(159) NOT NULL,
  `question_4` varchar(159) NOT NULL,
  `question_5` varchar(159) NOT NULL,
  `question_6` varchar(159) NOT NULL,
  `question_7` varchar(159) NOT NULL,
  `question_8` varchar(159) NOT NULL,
  `question_9` varchar(159) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `newGamePublic`
--

INSERT INTO `newGamePublic` (`userId`, `title`, `question_0`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`, `question_7`, `question_8`, `question_9`, `date`) VALUES
(112, 'Trinkspiel', 'Ich habe noch nie gelogen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', 'Ich habe noch nie gesoffen', '2021-12-10 15:08:24'),
(112, 'Saufolympisch', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', '2021-12-10 15:10:37'),
(112, 'Saufolympisch', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', 'Ich hab noch nie Gesoffen', '2021-12-10 15:11:35'),
(112, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2021-12-10 17:26:54'),
(112, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2021-12-10 17:27:11'),
(112, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2021-12-10 17:27:51'),
(112, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2021-12-10 17:27:58'),
(113, 'Trinspiel', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', '2021-12-10 17:53:07'),
(113, 'Trinspiel', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', '2021-12-10 17:53:26'),
(113, 'Trinspiel', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', '2021-12-10 17:53:43'),
(113, 'Trinspiel', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', 'HOHOOHO', '2021-12-10 17:54:03'),
(113, 'letzter Test', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', 'Ich habe noch nie..', '2021-12-10 18:11:28'),
(114, 'Test Trinkspiel', 'Ich habe noch nie Dinko CMS Abgabe bestehen lassen', 'Ich habe noch nie Dinko gerade noch so bestehen lassen', 'Ich war noch nie so Froh den Dinko bestehen zu lassen', 'Beispiel 4', 'Beispiel 5', 'Beispiel 6', 'Beispiel 7', 'Beispiel 8', 'Beispiel 9', '10Beispiel 4', '2021-12-10 19:19:06');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE `question` (
  `id` varchar(249) NOT NULL,
  `question` varchar(249) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visibility` varchar(20) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`id`, `question`, `user_id`, `visibility`, `category`) VALUES
('50eba4c7bf', 'Ich war noch nie Bungeespringen.', 9, 'private', ''),
('474208f906', 'Ich bin noch nie auf einem Tier geritten.', 9, 'private', ''),
('f75cd3d56a', 'Ich bin noch nie l&auml;nger als ein Monat per Anhalter unterwegs gewesen.', 9, 'public', ''),
('79d5b8f7c7', 'Ich wurde noch nie festgenommen.', 9, 'public', ''),
('be6747b1a5', 'Ich war noch nie surfen.', 9, 'public', ''),
('3c4320a653', 'Ich hab&rsquo; noch nie einen Stromschlag bekommen.', 9, 'public', ''),
('73c28594f1', 'Ich hab&rsquo; noch nie N&auml;hte bekommen.', 9, 'public', ''),
('2113be5239', 'Ich war noch nie jagen.', 9, 'public', ''),
('470c0309ce', 'Ich war noch nie vegan.', 9, 'public', ''),
('a21bc5b362', 'Ich hab&rsquo; noch nie etwas geklaut.', 9, 'public', ''),
('c48ddfb842', 'Ich bin noch nie in Ohnmacht gefallen.', 9, 'public', ''),
('d77bc3ddd3', 'Ich hab&rsquo; mir noch nie einen Knochen gebrochen.', 9, 'public', ''),
('aeeef9bd8e', 'Ich hab&rsquo; noch nie mit einer Waffe geschossen.', 9, 'public', ''),
('be883b6a23', 'Ich hab&rsquo; noch nie ein Restaurant verlassen, ohne zu bezahlen.', 9, 'public', ''),
('ae451b1c4d', 'Ich hab&rsquo; mir noch nie einen Zahn abgebrochen.', 9, 'public', ''),
('a6b846a816', 'Ich hab&rsquo; noch nie in einem Lift getanzt.', 9, 'public', ''),
('6a30934c61', 'Ich hab&rsquo; noch nie von jemandem den Urlaub ruiniert.', 9, 'public', ''),
('31abbd41b3', 'Ich hab&rsquo; noch nie vor jemandem uriniert.', 9, 'public', ''),
('39cf615a24', 'Ich bin noch nie von einem Dach gesprungen.', 9, 'public', ''),
('5cc7cc07b2', 'Ich wurde noch nie beim Schummeln erwischt.', 9, 'public', ''),
('4aa7b43b4b', 'Ich hatte noch nie eine paranormale Begegnung.', 9, 'public', ''),
('07ab7b44ce', 'Ich wurde noch nie dabei erwischt, als ich mich in einen Film geschlichen habe.', 9, 'public', ''),
('f4f06ae6fc', 'Ich war noch nie Tiefseetauchen.', 9, 'public', ''),
('a72ed7a229', 'Ich hatte noch nie ein Baumhaus.', 9, 'public', ''),
('9fa17f96f1', 'Ich hab&rsquo; noch nie eine Brille ohne Sehst&auml;rke getragen.', 9, 'public', ''),
('623084e00c', 'Ich hab&rsquo; noch nie eine Di&auml;t gemacht.', 9, 'public', ''),
('9a3903577f', 'Ich war noch nie bei einer Modenschau.', 9, 'public', ''),
('ec161744c6', 'Ich hab&rsquo; noch nie etwas aus einem Restaurant mitgehen lassen.', 9, 'public', ''),
('1ac006a1f8', 'Ich hatte noch nie eine schlimme allergische Reaktion.', 9, 'public', ''),
('52fc7b3a89', 'Ich bin noch nie aufgewacht und konnte mich nicht bewegen.', 9, 'public', ''),
('1448958053', 'Ich war noch nie in einem Lift gefangen.', 9, 'public', ''),
('2f24262a04', 'Ich hab noch nie versp&auml;tet meine Abgabe abgegeben..', 9, 'private', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `statistic`
--

CREATE TABLE `statistic` (
  `questionId` varchar(11) NOT NULL,
  `positiv` int(249) NOT NULL DEFAULT '0',
  `negativ` int(249) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `statistic`
--

INSERT INTO `statistic` (`questionId`, `positiv`, `negativ`) VALUES
('12we12we12', 1, 0),
('12we12we12', 1, 0),
('6a30934c61', 10, 1),
('f4f06ae6fc', 7, 3),
('39cf615a24', 5, 0),
('c48ddfb842', 12, 2),
('73c28594f1', 6, 3),
('623084e00c', 8, 1),
('1448958053', 5, 1),
('79d5b8f7c7', 12, 3),
('31abbd41b3', 11, 0),
('52fc7b3a89', 10, 1),
('2113be5239', 10, 2),
('470c0309ce', 13, 3),
('4aa7b43b4b', 10, 3),
('d77bc3ddd3', 5, 2),
('a21bc5b362', 7, 2),
('3c4320a653', 12, 2),
('9fa17f96f1', 9, 1),
('aeeef9bd8e', 6, 2),
('a6b846a816', 10, 2),
('5cc7cc07b2', 9, 4),
('1ac006a1f8', 10, 4),
('ec161744c6', 9, 3),
('07ab7b44ce', 5, 1),
('be883b6a23', 8, 5),
('f75cd3d56a', 9, 5),
('9a3903577f', 8, 0),
('a72ed7a229', 8, 0),
('ae451b1c4d', 7, 3),
('be6747b1a5', 5, 3),
('50eba4c7bf', 4, 0),
('474208f906', 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `land` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwort` varchar(250) NOT NULL,
  `agb` varchar(10) NOT NULL,
  `onetimekey` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userid`, `gender`, `land`, `username`, `email`, `passwort`, `agb`, `onetimekey`, `time`) VALUES
(114, 'male', 'Deutschland', 'TestDummy', 'test@user.de', '$2y$10$WuRxV686tjCmipfLm2DBOupTqW3ltR0cf359fr9/nntaseZYgw05O', 'accept', '', '2021-12-10 19:16:01');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
