-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2019, 15:37
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `quiz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `id` int(3) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `a` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `b` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `c` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `d` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correct` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `all_answers` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`id`, `question`, `a`, `b`, `c`, `d`, `correct`, `all_answers`, `correct_answers`) VALUES
(89, 'What does stand for?', 'Personal Hypertext Processor', 'Private Home Page', 'PHP: Hypertext Preprocessor', 'Private Hypertext Protocol', 'c', 27, 0),
(90, 'PHP server scripts are surrounded by delimiters, which?', '&lt;script&gt;...&lt;/script&gt;', '&lt;&amp;&gt;...&lt;/&amp;&gt;', '&lt;?php&gt;...&lt;/?&gt;', '&lt;?php...?&gt;', 'd', 29, 0),
(91, 'How do you write &quot;Hello World&quot; in PHP', 'Document.Write(&quot;Hello World&quot;);', 'echo &quot;Hello World&quot;;', '&quot;Hello World&quot;;', 'cout&lt;&lt;HelloWorld;', 'b', 28, 0),
(92, 'All variables in PHP start with which symbol?', '$', '!', '&amp;', '@', 'a', 29, 8),
(93, 'What is the correct way to end a PHP statement?', '&lt;/php&gt;', ';', 'New line', '.', 'b', 31, 0),
(94, 'The PHP syntax is most similar to:', 'Perl and C', 'VBScript', 'JavaScript', 'Java', 'a', 25, 5),
(95, 'How do you get information from a form that is submitted using the &quot;get&quot; method?', 'Request.Form;', 'Request.QueryString;', '$_GET[];', '$GET[];', 'c', 29, 0),
(96, 'What is the correct way to include the file &quot;time.inc&quot; ?', ' &lt;!-- include file=&quot;time.inc&quot; --&gt;', ' &lt;?php include file=&quot;time.inc&quot;; ?&gt;', ' &lt;?php include:&quot;time.inc&quot;; ?&gt;', ' &lt;?php include &quot;time.inc&quot;; ?&gt;', 'd', 29, 0),
(97, 'What is the correct way to create a function in PHP?', 'new_function myFunction()', 'function myFunction()', 'create myFunction()', 'var function=myFunction()', 'b', 27, 0),
(98, 'What is the correct way to open the file &quot;time.txt&quot; as readable?', 'fopen(&quot;time.text&quot;,&quot;r&quot;);', 'open(&quot;time.text&quot;);', 'open(&quot;time.text&quot;,&quot;read&quot;);', 'fopen(&quot;time.text&quot;,&quot;r+&quot;);', 'a', 35, 5),
(99, 'Which superglobal variable holds information about headers, paths, and script locations?', '$_GET', '$_POST', '$_SERVER', '$_GLOBALS', 'c', 27, 0),
(100, 'What is the correct way to add 1 to the $count variable?', 'count++;', '++count', '$count++;', '$count=+1', 'c', 28, 0),
(101, 'What is a correct way to add a comment in PHP?', '/*...*/', '&lt;comment&gt;...&lt;/comment&gt;', '&lt;!---...---&gt;', '*/.../*', 'a', 28, 5),
(102, 'Which one of these variables has an illegal name?', '$my-Var', '$my_Var', '$myVar', '$myvar', 'a', 28, 5),
(103, 'How do you create a cookie in PHP?', 'createcookie', 'makecookie()', 'setcookie()', '$_SESSION=&gt;cookie()', 'c', 31, 0),
(107, 'pytanie', 'a', 'b', 'c', 'odpowiedz', 'a', 9, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0,
  `all_answers` int(3) NOT NULL,
  `correct_answers` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `admin`, `all_answers`, `correct_answers`) VALUES
(51, 'AAAAA', '$2y$10$5AblaCHSH.STXcWv3weERuRYjG/6MzO3hVlMIbsVFiCGedPGF.VVa', 0, 20, 15),
(54, '1', '$2y$10$5nmAYs/9EIMUHWSBsvdouup8.Y8uyMnAp7PUTVyQJRqzd5TFGfUqG', 0, 0, 0),
(55, 'piotr', '$2y$10$jgk/AhRAZ3C9L8Q7VZC/WeuewOgPPDilNgcMkPVJV19onic2KQUBe', 0, 0, 0),
(62, 'admin', '$2y$10$3iLTJfJHXybrVydPZR6q3OLraxZc1lzTSDHn2c9mth5rP/mrA6kBm', 1, 60, 25),
(64, 'artur', '$2y$10$1k7nOs4gRKfQLl1a.Ps/1utPhgx5OJytF7bEoQ84A1TRtsQbS.9kK', 0, 20, 7),
(66, 'test', '$2y$10$2zn6g7bxnWDCwDIWtxkP1O9omE7N4mKSEqPpCiuQq8UwoHWhP/DsO', 0, 20, 8);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
