-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lis 2022, 13:02
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tabelka grupowa`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grupa c`
--

CREATE TABLE `grupa c` (
  `Drużyna` varchar(100) NOT NULL,
  `Flaga` varchar(100) NOT NULL,
  `Rozegrane Mecze` int(11) NOT NULL,
  `Wygrane` int(11) NOT NULL,
  `Remisy` int(11) NOT NULL,
  `Przegrane` int(11) NOT NULL,
  `Strzelone bramki` int(11) NOT NULL,
  `Stracone bramki` int(11) NOT NULL,
  `Różnica bramek` int(11) NOT NULL,
  `Punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `grupa c`
--

INSERT INTO `grupa c` (`Drużyna`, `Flaga`, `Rozegrane Mecze`, `Wygrane`, `Remisy`, `Przegrane`, `Strzelone bramki`, `Stracone bramki`, `Różnica bramek`, `Punkty`) VALUES
('Arabia Saudyjska', 'arabia.jpg', 0, 0, 0, 0, 0, 0, 0, 0),
('Argentyna', 'argentyna.jpg', 0, 0, 0, 0, 0, 0, 0, 0),
('Meksyk', 'meksyk.jpg', 0, 0, 0, 0, 0, 0, 0, 0),
('Polska', 'polska.jpg', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mecze`
--

CREATE TABLE `mecze` (
  `ID` int(11) NOT NULL,
  `Drużyna 1` varchar(100) NOT NULL,
  `Drużyna 2` varchar(100) NOT NULL,
  `Stadion` varchar(100) NOT NULL,
  `Godzina` datetime NOT NULL,
  `Wynik` varchar(3) DEFAULT NULL,
  `Komentarz` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `mecze`
--

INSERT INTO `mecze` (`ID`, `Drużyna 1`, `Drużyna 2`, `Stadion`, `Godzina`, `Wynik`, `Komentarz`) VALUES
(1, 'Argentyna', 'Arabia Saudyjska', 'Lusail Stadium', '2022-11-22 11:00:00', '', ''),
(2, 'Meksyk', 'Polska', 'Stadium 974', '2022-11-22 17:00:00', '', ''),
(3, 'Meksyk', 'Argentyna', 'Education City Stadium', '2022-11-26 14:00:00', '', ''),
(4, 'Polska', 'Arabia Saudyjska', 'Lusail Stadium', '2022-11-26 20:00:00', '', ''),
(5, 'Polska', 'Argentyna', 'Stadium 974', '2022-11-30 20:00:00', '', ''),
(6, 'Arabia Saudyjska', 'Meksyk', 'Lusail Stadium', '2022-11-30 20:00:00', '', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `grupa c`
--
ALTER TABLE `grupa c`
  ADD PRIMARY KEY (`Drużyna`);

--
-- Indeksy dla tabeli `mecze`
--
ALTER TABLE `mecze`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Drużyna 1` (`Drużyna 1`),
  ADD KEY `Drużyna 2` (`Drużyna 2`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `mecze`
--
ALTER TABLE `mecze`
  ADD CONSTRAINT `mecze_ibfk_1` FOREIGN KEY (`Drużyna 1`) REFERENCES `grupa c` (`Drużyna`),
  ADD CONSTRAINT `mecze_ibfk_2` FOREIGN KEY (`Drużyna 2`) REFERENCES `grupa c` (`Drużyna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
