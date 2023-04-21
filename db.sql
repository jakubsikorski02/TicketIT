-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Kwi 2023, 21:59
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `reservations`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `booked`
--

CREATE TABLE `booked` (
  `booked_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `booked`
--

INSERT INTO `booked` (`booked_id`, `user_id`, `schedule_id`, `seat_id`) VALUES
(1, 15, 34, 1),
(2, 15, 34, 12),
(3, 15, 34, 5),
(4, 15, 34, 3),
(5, 15, 34, 2),
(6, 15, 34, 4),
(7, 15, 34, 14),
(8, 15, 34, 27),
(9, 15, 37, 13),
(10, 15, 43, 1),
(11, 15, 43, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cinema_hall`
--

CREATE TABLE `cinema_hall` (
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `cinema_hall`
--

INSERT INTO `cinema_hall` (`hall_id`, `hall_name`) VALUES
(1, 'Hall A'),
(2, 'Hall B'),
(3, 'Hall C');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `director` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`movie_id`, `director`, `title`, `year`, `description`, `genre`, `duration`, `poster`) VALUES
(1, 'Christopher Nolan', 'Inception', 2010, 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.', 'Science Fiction', 148, 'inception.png'),
(2, 'Quentin Tarantino', 'Pulp Fiction', 1994, 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'Crime', 154, 'pulp-fiction.png'),
(3, 'Greta Gerwig', 'Little Women', 2019, 'Four sisters come of age in America in the aftermath of the Civil War.', 'Drama', 135, 'little-women.png'),
(4, 'Christopher Nolan', 'The Dark Knight', 2008, 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'Action', 152, 'the-dark-knight.png'),
(5, 'George Lucas', 'Star Wars', 1977, 'A young farm boy joins a rebellion against an evil empire that has taken over the galaxy.', 'Science Fiction', 121, 'star-wars.png'),
(6, 'Todd Phillips', 'Joker', 2019, 'A failed stand-up comedian turns to a life of crime and chaos in Gotham City, becoming the infamous Joker.', 'Thriller', 122, 'joker.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `hour` time DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `hall_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `date`, `hour`, `movie_id`, `hall_id`) VALUES
(13, '2023-04-13', '13:00:00', 1, 1),
(14, '2023-04-13', '16:30:00', 2, 1),
(15, '2023-04-14', '18:15:00', 3, 1),
(16, '2023-04-14', '20:45:00', 2, 2),
(17, '2023-04-15', '14:30:00', 3, 3),
(18, '2023-04-15', '17:00:00', 3, 2),
(19, '2023-04-16', '13:00:00', 1, 1),
(20, '2023-04-16', '16:30:00', 1, 1),
(21, '2023-04-16', '18:15:00', 3, 2),
(22, '2023-04-17', '20:45:00', 3, 1),
(23, '2023-04-17', '14:30:00', 3, 3),
(24, '2023-04-17', '17:00:00', 3, 1),
(25, '2023-04-18', '13:00:00', 1, 1),
(26, '2023-04-18', '16:30:00', 2, 1),
(27, '2023-04-18', '18:15:00', 3, 1),
(28, '2023-04-18', '20:45:00', 2, 2),
(29, '2023-04-18', '14:30:00', 3, 3),
(30, '2023-04-19', '17:00:00', 3, 2),
(31, '2023-04-19', '13:00:00', 1, 1),
(32, '2023-04-19', '16:30:00', 1, 1),
(33, '2023-04-19', '18:15:00', 3, 2),
(34, '2023-04-20', '20:45:00', 3, 1),
(35, '2023-04-20', '14:30:00', 3, 3),
(36, '2023-04-20', '17:00:00', 3, 1),
(37, '2023-04-20', '13:00:00', 1, 1),
(38, '2023-04-20', '16:30:00', 2, 1),
(39, '2023-04-20', '18:15:00', 3, 1),
(40, '2023-04-20', '20:45:00', 4, 2),
(41, '2023-04-20', '14:30:00', 5, 3),
(42, '2023-04-20', '17:00:00', 6, 2),
(43, '2023-04-21', '13:00:00', 1, 1),
(44, '2023-04-21', '16:30:00', 2, 1),
(45, '2023-04-21', '18:15:00', 3, 2),
(46, '2023-04-21', '20:45:00', 4, 1),
(47, '2023-04-21', '14:30:00', 5, 3),
(48, '2023-04-21', '17:00:00', 6, 1),
(49, '2023-04-22', '13:00:00', 1, 1),
(50, '2023-04-22', '16:30:00', 2, 1),
(51, '2023-04-22', '18:15:00', 3, 1),
(52, '2023-04-22', '20:45:00', 4, 2),
(53, '2023-04-22', '14:30:00', 5, 3),
(54, '2023-04-22', '17:00:00', 6, 2),
(55, '2023-04-23', '13:00:00', 1, 1),
(56, '2023-04-23', '16:30:00', 2, 1),
(57, '2023-04-23', '20:45:00', 3, 1),
(58, '2023-04-23', '14:30:00', 4, 3),
(59, '2023-04-23', '17:00:00', 5, 1),
(60, '2023-04-23', '17:00:00', 6, 1),
(61, '2023-04-24', '13:00:00', 1, 1),
(62, '2023-04-24', '16:30:00', 2, 2),
(63, '2023-04-24', '18:15:00', 3, 3),
(64, '2023-04-24', '20:45:00', 4, 1),
(65, '2023-04-24', '14:30:00', 5, 2),
(66, '2023-04-24', '17:00:00', 6, 3),
(67, '2023-04-25', '13:00:00', 1, 3),
(68, '2023-04-25', '16:30:00', 2, 1),
(69, '2023-04-25', '18:15:00', 3, 2),
(70, '2023-04-25', '20:45:00', 4, 3),
(71, '2023-04-25', '14:30:00', 5, 1),
(72, '2023-04-25', '17:00:00', 6, 2),
(73, '2023-04-26', '13:00:00', 1, 2),
(74, '2023-04-26', '16:30:00', 2, 3),
(75, '2023-04-26', '18:15:00', 3, 1),
(76, '2023-04-26', '20:45:00', 4, 2),
(77, '2023-04-26', '14:30:00', 5, 3),
(78, '2023-04-26', '17:00:00', 6, 1),
(79, '2023-04-27', '13:00:00', 1, 1),
(80, '2023-04-27', '16:30:00', 2, 3),
(81, '2023-04-27', '18:15:00', 3, 2),
(82, '2023-04-27', '20:45:00', 4, 1),
(83, '2023-04-27', '14:30:00', 5, 3),
(84, '2023-04-27', '17:00:00', 6, 2),
(85, '2023-04-28', '13:00:00', 1, 1),
(86, '2023-04-28', '16:30:00', 2, 2),
(87, '2023-04-28', '18:15:00', 3, 3),
(88, '2023-04-28', '20:45:00', 4, 1),
(89, '2023-04-28', '14:30:00', 5, 2),
(90, '2023-04-28', '17:00:00', 6, 3),
(91, '2023-04-29', '13:00:00', 1, 2),
(92, '2023-04-29', '16:30:00', 2, 3),
(93, '2023-04-29', '18:15:00', 3, 1),
(94, '2023-04-29', '20:45:00', 4, 2),
(95, '2023-04-29', '14:30:00', 5, 3),
(96, '2023-04-29', '17:00:00', 6, 1),
(97, '2023-04-30', '13:00:00', 1, 3),
(98, '2023-04-30', '16:30:00', 2, 1),
(99, '2023-04-30', '18:15:00', 3, 2),
(100, '2023-04-30', '20:45:00', 4, 3),
(101, '2023-04-30', '14:30:00', 5, 1),
(102, '2023-04-30', '17:00:00', 6, 2),
(103, '2023-05-01', '13:00:00', 1, 3),
(104, '2023-05-01', '16:30:00', 2, 2),
(105, '2023-05-01', '18:15:00', 3, 1),
(106, '2023-05-01', '20:45:00', 4, 3),
(107, '2023-05-01', '14:30:00', 5, 2),
(108, '2023-05-01', '17:00:00', 6, 1),
(109, '2023-05-02', '13:00:00', 1, 1),
(110, '2023-05-02', '16:30:00', 2, 2),
(111, '2023-05-02', '18:15:00', 3, 3),
(112, '2023-05-02', '20:45:00', 4, 1),
(113, '2023-05-02', '14:30:00', 5, 2),
(114, '2023-05-02', '17:00:00', 6, 3),
(115, '2023-05-03', '13:00:00', 1, 1),
(116, '2023-05-03', '16:30:00', 2, 3),
(117, '2023-05-03', '18:15:00', 3, 2),
(118, '2023-05-03', '20:45:00', 4, 1),
(119, '2023-05-03', '14:30:00', 5, 3),
(120, '2023-05-03', '17:00:00', 6, 2),
(121, '2023-05-04', '13:00:00', 1, 2),
(122, '2023-05-04', '16:30:00', 2, 1),
(123, '2023-05-04', '18:15:00', 3, 3),
(124, '2023-05-04', '20:45:00', 4, 2),
(125, '2023-05-04', '14:30:00', 5, 1),
(126, '2023-05-04', '17:00:00', 6, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `row_number` int(11) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL,
  `hall_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `seats`
--

INSERT INTO `seats` (`seat_id`, `row_number`, `seat_number`, `hall_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 2, 1, 1),
(11, 2, 2, 1),
(12, 2, 3, 1),
(13, 2, 4, 1),
(14, 2, 5, 1),
(15, 2, 6, 1),
(16, 2, 7, 1),
(17, 2, 8, 1),
(18, 2, 9, 1),
(19, 3, 1, 1),
(20, 3, 2, 1),
(21, 3, 3, 1),
(22, 3, 4, 1),
(23, 3, 5, 1),
(24, 3, 6, 1),
(25, 3, 7, 1),
(26, 3, 8, 1),
(27, 3, 9, 1),
(28, 1, 1, 2),
(29, 1, 2, 2),
(30, 1, 3, 2),
(31, 1, 4, 2),
(32, 1, 5, 2),
(33, 1, 6, 2),
(34, 1, 7, 2),
(35, 1, 8, 2),
(36, 1, 9, 2),
(37, 2, 1, 2),
(38, 2, 2, 2),
(39, 2, 3, 2),
(40, 2, 4, 2),
(41, 2, 5, 2),
(42, 2, 6, 2),
(43, 2, 7, 2),
(44, 2, 8, 2),
(45, 2, 9, 2),
(46, 3, 1, 2),
(47, 3, 2, 2),
(48, 3, 3, 2),
(49, 3, 4, 2),
(50, 3, 5, 2),
(51, 3, 6, 2),
(52, 3, 7, 2),
(53, 3, 8, 2),
(54, 3, 9, 2),
(55, 4, 1, 2),
(56, 4, 2, 2),
(57, 4, 3, 2),
(58, 4, 4, 2),
(59, 4, 5, 2),
(60, 4, 6, 2),
(61, 4, 7, 2),
(62, 4, 8, 2),
(63, 4, 9, 2),
(64, 1, 1, 3),
(65, 1, 2, 3),
(66, 1, 3, 3),
(67, 1, 4, 3),
(68, 1, 5, 3),
(69, 1, 6, 3),
(70, 1, 7, 3),
(71, 1, 8, 3),
(72, 1, 9, 3),
(73, 2, 1, 3),
(74, 2, 2, 3),
(75, 2, 3, 3),
(76, 2, 4, 3),
(77, 2, 5, 3),
(78, 2, 6, 3),
(79, 2, 7, 3),
(80, 2, 8, 3),
(81, 2, 9, 3),
(82, 3, 1, 3),
(83, 3, 2, 3),
(84, 3, 3, 3),
(85, 3, 4, 3),
(86, 3, 5, 3),
(87, 3, 6, 3),
(88, 3, 7, 3),
(89, 3, 8, 3),
(90, 3, 9, 3),
(91, 4, 1, 3),
(92, 4, 2, 3),
(93, 4, 3, 3),
(94, 4, 4, 3),
(95, 4, 5, 3),
(96, 4, 6, 3),
(97, 4, 7, 3),
(98, 4, 8, 3),
(99, 4, 9, 3),
(100, 5, 1, 3),
(101, 5, 2, 3),
(102, 5, 3, 3),
(103, 5, 4, 3),
(104, 5, 5, 3),
(105, 5, 6, 3),
(106, 5, 7, 3),
(107, 5, 8, 3),
(108, 5, 9, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `role`) VALUES
(1, 'test@test.com', 'test', '$2y$10$Vm/UM9IVq5ezFuESW6RlYeLrnvQDJloJ2PSx/a7HKhPG9hOO/6eGS', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`booked_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indeksy dla tabeli `cinema_hall`
--
ALTER TABLE `cinema_hall`
  ADD PRIMARY KEY (`hall_id`);

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indeksy dla tabeli `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `cinema_id` (`hall_id`);

--
-- Indeksy dla tabeli `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `hall_id` (`hall_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `booked`
--
ALTER TABLE `booked`
  MODIFY `booked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `cinema_hall`
--
ALTER TABLE `cinema_hall`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT dla tabeli `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`),
  ADD CONSTRAINT `booked_ibfk_3` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`);

--
-- Ograniczenia dla tabeli `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `cinema_hall` (`hall_id`);

--
-- Ograniczenia dla tabeli `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`hall_id`) REFERENCES `cinema_hall` (`hall_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
