-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 06:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) NOT NULL,
  `naslov` varchar(128) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(64) NOT NULL,
  `kategorija` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '13.06.2023.', 'Hrvatska je prije 10 godina ušla u EU, no što je s ostalim susjednim državama?', 'Gledajući arhivu tekstova i poruka od prije deset godina, kada je Hrvatska ulazila u EU, nailazimo na izjave kako je to povijesni događaj i za Hrvatsku, i za Europsku uniju, ali i za područje zapadnog Balkana jer dokazuje da je postizanje cilja punopravnog članstva moguće. Govorilo se, a i vjerovalo, da će nakon Hrvatske proces biti nastavljen te da će put koji je Hrvatska prošla od 2000. godine do 1. srpnja 2013. slijediti i susjedne države. Otprilike se vjerovalo da će oko deset godina proći dok još neka zemlja regije nakon Hrvatske ne uđe u EU. Za neke je spominjanje jednog desetljeća za sljedeće proširenje EU prema zapadnom Balkanu bilo nerealno, ali za mnoge je to bilo tada predugo jer se računalo da će sve proći znatno brže.\r\n\r\nDeset godina je prošlo od...\r\n\r\n', 'Gledajući arhivu tekstova i poruka od prije deset godina, kada je Hrvatska ulazila u EU, nailazimo na izjave kako je to povijesni događaj i za Hrvatsku, i za Europsku uniju, ali i za područje zapadnog Balkana jer dokazuje da je postizanje cilja punopravnog članstva moguće. Govorilo se, a i vjerovalo, da će nakon Hrvatske proces biti nastavljen te da će put koji je Hrvatska prošla od 2000. godine do 1. srpnja 2013. slijediti i susjedne države. Otprilike se vjerovalo da će oko deset godina proći dok još neka zemlja regije nakon Hrvatske ne uđe u EU. Za neke je spominjanje jednog desetljeća za sljedeće proširenje EU prema zapadnom Balkanu bilo nerealno, ali za mnoge je to bilo tada predugo jer se računalo da će sve proći znatno brže.\r\n\r\nDeset godina je prošlo od...\r\n\r\n', 'politique1.jpg', 'politika', 0),
(2, '13.06.2023.', 'Putinov bjeloruski poslušnik se hvali: ‘Nuklearno oružje je stiglo, a 10 puta jače je od hirošime!\'', 'Bjelorusija je počela dobivati taktičko nuklearno oružje od Rusije, izjavio je bjeloruski autokrat Aleksandar Lukašenko. Bjeloruski predsjednik rekao je za rusku državnu televiziju da njegova zemlja preuzima isporuku oružja te istaknuo da su neka od njih tri puta snažnija od atomskih bombi koje su SAD bacile na Hirošimu i Nagasaki 1945. godine.\r\n\r\n\"Imamo projektile i bombe koje smo dobili od Rusije\", rekao je on u intervjuu, kako prenosi Sky News.\r\n\r\nOve izjave uslijedile su nakon što je Lukašenko, kako se čini, proturječio ruskom kolegi i savezniku Vladimiru Putinu u vezi upotrebe nuklearnog oružja koje će biti raspoređeno u Bjelorusiji.\r\n\r\nNaime, ruski čelnik je naglasio da će Moskva zadržati kontrolu nad upotrebom svojeg taktičkog oružja u Bjelorusiji, da bi potom Lukašenko izjavio kako neće oklijevati koristiti ga i bez Putinova dopuštenja ukoliko se Bjelorusija suoči s agresijom.', 'Nove izjave Aleksandra Lukašenka dolaze nakon što je Lukašenko, kako se čini, proturječi Putinu u vezi s upotrebom isporučenog oružja', 'politique2.webp', 'politika', 0),
(3, '13.06.2023.', 'Ovo je još jedan primjer vijesti', 'Slobodno promijenite ovaj dio', 'Također slobodno promijenite i ovaj dio', 'politique3.jpg', 'politika', 0),
(4, '14.06.2023.', 'Pumpaju cijene jer to mogu, od kupca traže i da plati proviziju ', 'Ponuda je manja od potražnje pa prodavatelj može što želi - napumpati cijenu, ali i proviziju za agenciju prebaciti na kupca. U Splitu traže najviše za stanove, više i od Zagreba i Dubrovnika, najjeftiniji je Osijek', 'Ponuda je manja od potražnje pa prodavatelj može što želi - napumpati cijenu, ali i proviziju za agenciju prebaciti na kupca. U Splitu traže najviše za stanove, više i od Zagreba i Dubrovnika, najjeftiniji je OsijekPonuda je manja od potražnje pa prodavatelj može što želi - napumpati cijenu, ali i proviziju za agenciju prebaciti na kupca. U Splitu traže najviše za stanove, više i od Zagreba i Dubrovnika, najjeftiniji je Osijek', 'immobilier1.jpg', 'nekretnine', 0),
(5, '14.06.2023.', 'Što sve ima Horvatinčić: Stan prodaje za 8 milijuna eura, a veći je od nogometnog terena', 'Od mnogih tvrtki samo dvije su mu u plusu. Agencija kaže kako se već javljaju kupci za penthouse na zagrebačkom Cvjetnom trgu', 'Od mnogih tvrtki samo dvije su mu u plusu. Agencija kaže kako se već javljaju kupci za penthouse na zagrebačkom Cvjetnom trguOd mnogih tvrtki samo dvije su mu u plusu. Agencija kaže kako se već javljaju kupci za penthouse na zagrebačkom Cvjetnom trguOd mnogih tvrtki samo dvije su mu u plusu. Agencija kaže kako se već javljaju kupci za penthouse na zagrebačkom Cvjetnom trguOd mnogih tvrtki samo dvije su mu u plusu. Agencija kaže kako se već javljaju kupci za penthouse na zagrebačkom Cvjetnom trgu', 'immobilier2.jpg', 'nekretnine', 0),
(6, '14.06.2023.', 'Ovo je još jedan primjer vijesti', 'Slobodno promijenite ovaj dio', 'Također slobodno promijenite i ovaj dio', 'immobilier3.webp', 'nekretnine', 0),
(17, '20.06.2023.', 'Posljednji unos', 'Posljednji unosPosljednji unosPosljednji unos', 'Posljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unosPosljednji unos', 'Mockup poster.png', 'politika', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
