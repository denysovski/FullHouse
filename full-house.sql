-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 16. bře 2024, 18:19
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `full-house`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `money` bigint(20) NOT NULL DEFAULT 5,
  `match1` int(11) DEFAULT NULL,
  `match2` int(11) DEFAULT NULL,
  `match3` int(11) DEFAULT NULL,
  `poprve` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`, `money`, `match1`, `match2`, `match3`, `poprve`) VALUES
(1, 3812118724826377402, '123456789012345', '1203', '2024-02-11 14:40:12', 200, NULL, NULL, NULL, NULL),
(2, 6092482621, 'ivosss', '12', '2024-01-31 17:14:43', 100, NULL, NULL, NULL, NULL),
(3, 63837, 'ddd', 'dddddd', '2024-01-31 17:16:59', 100, NULL, NULL, NULL, NULL),
(4, 74483221, 'd', 'ddddd', '2024-02-11 13:31:28', 300, NULL, NULL, NULL, NULL),
(5, 530657755, 'yes', 'yes', '2024-01-31 17:18:13', 100, NULL, NULL, NULL, NULL),
(6, 4533384847267287, 'ivos', '$2y$10$1VPSqd1pef3mSbg.MFij5e/PyC6NSbfiYah2VZjP/h8ygq0.XfNMu', '2024-01-31 17:22:09', 100, NULL, NULL, NULL, NULL),
(7, 356253154613, 'ahojda', '$2y$10$oTPRNOs3Dw.sKiCM3.RXHu4lfLKNAhtGW/AW4jilNpTKt5QX8Aq/6', '2024-02-01 19:31:32', 100, NULL, NULL, NULL, NULL),
(8, 50071097015671461, 'milan', '$2y$10$5TIG9TTUuqEC2Hh2yqRgh.Bqbb47A/TOydywB0UfRKfKCb4uP.JUu', '2024-03-16 17:09:47', 150, 2, 0, 1, 0),
(9, 4557, 'marv', '$2y$10$BZxACALyuEgbc0GHWP4rauZeSIHvYLLLaVFzfZeEvN6FZBS2sobga', '2024-02-01 19:36:47', 100, NULL, NULL, NULL, NULL),
(10, 9398, 'test', '$2y$10$brEzUP2U2NhjsJW8kQW5LOUBzp6T11ceuqegV7m0dKR7TAn6CquLi', '2024-02-01 19:37:50', 100, NULL, NULL, NULL, NULL),
(11, 11888, 'ivosdd', '$2y$10$C8//H0fWjj85C/3FKB7ek.rvmYAXv6ARWsOfBRutIpsuaX0gysYYe', '2024-02-01 19:48:48', 100, NULL, NULL, NULL, NULL),
(12, 156938815075018016, 'filip', '$2y$10$7d5nfH8iCCDxy24qdlOD0uR3PfDKvPLnWLOYZqr.4vG.rmieai3sy', '2024-02-01 19:51:05', 100, NULL, NULL, NULL, NULL),
(13, 409471385194916601, 'dd', '$2y$10$mCxbJ.ZR/ljV8/8/FTOIbeAvKpTTt8GLc29BJglNkT1kCsNW4ZVAi', '2024-02-11 14:39:48', 100, NULL, NULL, NULL, NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
