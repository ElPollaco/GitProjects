-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lis 2022, 08:35
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
-- Baza danych: `portiernia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klucze`
--

CREATE TABLE `klucze` (
  `Id` int(11) NOT NULL,
  `Id_pokoju` int(11) NOT NULL,
  `Nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Zajety` tinyint(1) NOT NULL,
  `Opis` varchar(1000) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klucze`
--

INSERT INTO `klucze` (`Id`, `Id_pokoju`, `Nazwa`, `Zajety`, `Opis`) VALUES
(1, 1, 'Klucz pokojowy właściciela', 1, 'Klucz do pokoju właściciela (tylko dla właścicieli hotelu)'),
(2, 2, 'Klucz biurowy', 0, 'Klucz do biura głównego właściciela (tylko dla właścicieli hotelu)'),
(3, 3, 'Klucz do magazynu (lewy)', 1, 'Klucz do magazynu'),
(4, 4, 'Klucz do magazynu (prawy)', 0, 'Klucz do magazynu'),
(5, 5, 'Klucz do pokoju konferencyjnego', 0, 'Klucz do pokoju konferencyjnego (w trakcie wyrabiania, obecnie niedostępny)'),
(6, 6, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego'),
(7, 7, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego'),
(8, 8, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego (zgubiony)'),
(9, 9, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego'),
(10, 10, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego'),
(11, 11, 'Klucz do pokoju hotelowego', 0, 'Klucz do pokoju hotelowego (wyłamany, trwa naprawa)');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `Id` int(11) NOT NULL,
  `Imię` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Stanowisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Id_klucza` int(11) DEFAULT NULL,
  `Miasto` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `Telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`Id`, `Imię`, `Nazwisko`, `Stanowisko`, `Id_klucza`, `Miasto`, `Telefon`) VALUES
(1, 'Kacper', 'Mysłowiec', 'Właściciel', 1, 'Ciechocinek', '789654123'),
(2, 'Jakub', 'Lampa', 'Klient', NULL, 'Katowice', '987654321'),
(3, 'Adam', 'Kruk', 'Klient', NULL, 'Elbląg', '747382443'),
(4, 'Barbara', 'Nowacka', 'Pracownik', 3, 'Poznań', '766454412'),
(5, 'Zenon', 'Zimbabwe', 'Klient', NULL, 'Gdańsk', '654565342');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pokoje`
--

CREATE TABLE `pokoje` (
  `Id` int(11) NOT NULL,
  `Nr_pokoju` varchar(3) COLLATE utf8_polish_ci NOT NULL,
  `Nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pokoje`
--

INSERT INTO `pokoje` (`Id`, `Nr_pokoju`, `Nazwa`) VALUES
(1, '1', 'Mieszkanie właściciela hotelu'),
(2, '2', 'Biuro właściciela'),
(3, '3A', 'Pokój magazynu nr 3 - część lewa'),
(4, '3B', 'Pokój magazynu nr 3 - część prawa'),
(5, '4', 'Pokój konferencyjny'),
(6, '5', 'Pokój hotelowy nr 5'),
(7, '6', 'Pokój hotelowy nr 6'),
(8, '7', 'Pokój hotelowy nr 7'),
(9, '8', 'Pokój hotelowy nr 8'),
(10, '9', 'Pokój hotelowy nr 9'),
(11, '10', 'Pokój hotelowy nr 10');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klucze`
--
ALTER TABLE `klucze`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Nr_pokoju` (`Id_pokoju`),
  ADD KEY `Nr_pokoju_2` (`Id_pokoju`),
  ADD KEY `Nr_pokoju_3` (`Id_pokoju`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Nr_klucza` (`Id_klucza`);

--
-- Indeksy dla tabeli `pokoje`
--
ALTER TABLE `pokoje`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nr_pokoju` (`Nr_pokoju`),
  ADD KEY `Nr_pokoju_2` (`Nr_pokoju`),
  ADD KEY `Nr_pokoju_3` (`Nr_pokoju`),
  ADD KEY `Nr_pokoju_4` (`Nr_pokoju`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klucze`
--
ALTER TABLE `klucze`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `osoby`
--
ALTER TABLE `osoby`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pokoje`
--
ALTER TABLE `pokoje`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD CONSTRAINT `osoby_ibfk_1` FOREIGN KEY (`Id_klucza`) REFERENCES `klucze` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
