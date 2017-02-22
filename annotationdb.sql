-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Feb 22, 2017 alle 09:53
-- Versione del server: 10.1.16-MariaDB
-- Versione PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annotationdb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annotation`
--

CREATE TABLE `annotation` (
  `TimeStamp` float NOT NULL,
  `UserId` int(11) NOT NULL,
  `NameVideo` text NOT NULL,
  `TypeVideo` text NOT NULL,
  `Value` float NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `annotation`
--

INSERT INTO `annotation` (`TimeStamp`, `UserId`, `NameVideo`, `TypeVideo`, `Value`, `id`) VALUES
(0.19671, 1, 'vid1.ogg', 'valence', 0, 158),
(0.695193, 1, 'vid1.ogg', 'valence', 0, 159),
(0.945155, 1, 'vid1.ogg', 'valence', -0.328042, 160),
(1.1952, 1, 'vid1.ogg', 'valence', 0.293651, 161),
(1.44526, 1, 'vid1.ogg', 'valence', 0.330688, 162),
(1.94537, 1, 'vid1.ogg', 'valence', -0.216931, 163),
(2.19694, 1, 'vid1.ogg', 'valence', 0.156085, 164),
(2.6954, 1, 'vid1.ogg', 'valence', 0.386243, 165),
(37.9607, 1, 'vid1.ogg', 'valence', 0.386243, 166),
(37.9607, 1, 'vid1.ogg', 'valence', 0.399471, 167),
(37.9607, 1, 'vid1.ogg', 'valence', 0.399471, 168),
(38.323, 1, 'vid1.ogg', 'valence', -0.391534, 169),
(38.5735, 1, 'vid1.ogg', 'valence', 0.187831, 170),
(39.0732, 1, 'vid1.ogg', 'valence', -0.521164, 171),
(39.3237, 1, 'vid1.ogg', 'valence', 0.563492, 172),
(39.3865, 1, 'vid1.ogg', 'valence', 0.5, 173),
(0.185112, 1, 'vid2.ogg', 'arousal', 0, 174),
(0.685332, 1, 'vid2.ogg', 'arousal', 0, 175),
(1.18789, 1, 'vid2.ogg', 'arousal', 0.296296, 176),
(1.4384, 1, 'vid2.ogg', 'arousal', -0.460317, 177),
(1.68966, 1, 'vid2.ogg', 'arousal', -0.0608466, 178),
(2.18126, 1, 'vid2.ogg', 'arousal', 0.343915, 179),
(2.43174, 1, 'vid2.ogg', 'arousal', 0.333333, 180),
(2.68227, 1, 'vid2.ogg', 'arousal', 0.367725, 181),
(2.93395, 1, 'vid2.ogg', 'arousal', 0.383598, 182),
(18.9577, 1, 'vid2.ogg', 'arousal', 0.375661, 183),
(18.9577, 1, 'vid2.ogg', 'arousal', 0.359788, 184),
(18.9577, 1, 'vid2.ogg', 'arousal', 0.359788, 185),
(19.273, 1, 'vid2.ogg', 'arousal', -0.441799, 186),
(19.7742, 1, 'vid2.ogg', 'arousal', 0.140212, 187),
(19.8613, 1, 'vid2.ogg', 'arousal', 0.169312, 188),
(0.184698, 1, 'vid2.ogg', 'valence', 0, 189),
(0.434978, 1, 'vid2.ogg', 'valence', 0, 190),
(10.235, 1, 'vid2.ogg', 'valence', 0, 191),
(10.235, 1, 'vid2.ogg', 'valence', 0, 192),
(10.235, 1, 'vid2.ogg', 'valence', 0, 193),
(10.5583, 1, 'vid2.ogg', 'valence', 0, 194),
(11.0588, 1, 'vid2.ogg', 'valence', 0.285714, 195),
(11.3095, 1, 'vid2.ogg', 'valence', -0.021164, 196),
(11.5619, 1, 'vid2.ogg', 'valence', 0.306878, 197),
(11.8128, 1, 'vid2.ogg', 'valence', 0.335979, 198),
(12.3135, 1, 'vid2.ogg', 'valence', 0.383598, 199),
(19.0962, 1, 'vid2.ogg', 'valence', 0.383598, 200),
(19.0962, 1, 'vid2.ogg', 'valence', 0.383598, 201),
(19.0962, 1, 'vid2.ogg', 'valence', 0.383598, 202),
(19.3058, 1, 'vid2.ogg', 'valence', -0.613757, 203),
(19.5585, 1, 'vid2.ogg', 'valence', 0.0634921, 204),
(19.8613, 1, 'vid2.ogg', 'valence', -0.0846561, 205),
(19.8613, 1, 'vid2.ogg', 'valence', -0.0846561, 206);

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'alfa'),
(2, 'beta'),
(3, 'delta'),
(4, 'gamma');

-- --------------------------------------------------------

--
-- Struttura della tabella `relgroupvideo`
--

CREATE TABLE `relgroupvideo` (
  `fk_idvideo` int(11) NOT NULL,
  `fk_idgroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `relgroupvideo`
--

INSERT INTO `relgroupvideo` (`fk_idvideo`, `fk_idgroup`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `userAdmin`
--

CREATE TABLE `userAdmin` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `userAdmin`
--

INSERT INTO `userAdmin` (`id`, `nome`, `password`) VALUES
(1, 'vittorio.cuculo', 'Paul.Ekman');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fk_idgroup` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `fk_idgroup`, `name`, `surname`, `email`) VALUES
(1, 1, '', '', ''),
(2, 1, '', '', ''),
(3, 1, '', '', ''),
(4, 2, '', '', ''),
(5, 2, '', '', ''),
(6, 1, '', '', ''),
(7, 2, '', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `videos`
--

INSERT INTO `videos` (`id`, `name`) VALUES
(1, 'vid1.ogg'),
(2, 'vid2.ogg'),
(3, 'vid3.ogg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `annotation`
--
ALTER TABLE `annotation`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `relgroupvideo`
--
ALTER TABLE `relgroupvideo`
  ADD PRIMARY KEY (`fk_idvideo`,`fk_idgroup`);

--
-- Indici per le tabelle `userAdmin`
--
ALTER TABLE `userAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `annotation`
--
ALTER TABLE `annotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT per la tabella `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `userAdmin`
--
ALTER TABLE `userAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT per la tabella `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
