-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 07 2023 г., 15:39
-- Версия сервера: 5.6.51
-- Версия PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blogweb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `page` int(10) NOT NULL,
  `email` varchar(110) NOT NULL,
  `comment` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `status`, `page`, `email`, `comment`, `created_date`) VALUES
(1, 0, 10, 'root@mail.root', 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', '2023-06-05 11:22:53'),
(3, 1, 10, 'root@mail.root', '<p>Мой блог - это блог сделанный с целью обучения аудитории на платформе YouTube и заработка доволнительной кармы)).</p>', '2023-06-05 11:28:52');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `id_topic` int(12) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `title`, `img`, `content`, `status`, `id_topic`, `created_date`) VALUES
(1, 15, 'TestFunc', '1683286618_RobloxScreenShot20221016_205031637.png', '<p>test Function add post</p>', 0, 1, '2023-04-24 08:57:05'),
(2, 15, 'testaddfunc', '0', '<p>testfunc</p>', 1, 1, '2023-04-24 09:00:39'),
(3, 3, 'testtreefunck', 'RobloxScreenShot20221016_205031637.png', '<p>testtreefunck</p>', 1, 1, '2023-04-24 09:02:38'),
(4, 15, 'testPublich', 'RobloxScreenShot20221016_205031637.png', '<p>dwegffegfhtgnjtghfrehgtrg</p>', 1, 1, '2023-04-26 11:02:07'),
(5, 15, 'TestPublish2', 'RobloxScreenShot20221016_205031637.png', '<p>TestPublish2</p>', 0, 1, '2023-04-26 11:04:48'),
(6, 15, 'fhdhderg', 'RobloxScreenShot20221016_205031637.png', '<p>gfggfggr</p>', 0, 1, '2023-04-26 11:19:59'),
(7, 15, 'TestFunki', '', '<p>TestFunkiimg</p>', 1, 1, '2023-04-28 09:48:47'),
(8, 15, 'TestFunki2', '', '<p>TestFunki2</p>', 0, 1, '2023-04-28 09:49:58'),
(9, 15, 'TestFuncImg4', '', '<p>TestFuncImg4</p>', 0, 2, '2023-04-28 09:53:31'),
(10, 15, 'Проверка функции вывода проверки на количество символов. Это просто текст', '1684408993_images2.png', '<p>Проверка функции вывода проверки на количество символов. Это просто текст</p>', 1, 6, '2023-05-16 17:22:03'),
(11, 15, 'Php курсы. Помогают ли они?', '1684407629_images1.png', '<p>Статья о курсах по php.</p>', 1, 6, '2023-05-18 13:59:50'),
(12, 15, 'Фото png или jpg?', '1684407695_images3.png', '<p>Статья о форматах фото.</p>', 1, 6, '2023-05-18 14:01:35');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(12) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(1, 'php8', 'programm laungvich'),
(2, 'html5', 'giper-text'),
(4, 'JavaScript', 'JavaScript'),
(5, 'Sql', 'Sql lang for database SQL'),
(6, 'Top topics', 'Категория для вывода статей в сайд бар, топовых статей.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created`) VALUES
(1, 1, 'Andrei', 'upd@gmail.ri', '5555', '2022-12-27 08:38:18'),
(2, 0, 'Klim', 'klim@mail.ru', '1111', '2022-12-27 08:52:05'),
(3, 1, 'Some', 'som@mail.ru', '12345', '2022-12-29 10:53:46'),
(4, 1, '44', 'for4@test.com', '4444', '2023-01-09 14:48:27'),
(11, 0, 'emptyemail', 'email@mail.com', '$2y$10$kL3/zp.MrlLgnwA0yCMb9.lPhapJ70nBYRI9vLOBEKElebHKMdoCC', '2023-03-09 15:34:55'),
(14, 0, 'Func', 'Func@mail.func', '$2y$10$lF3WUCA0l1cpZYEmS8A5vu3JuGocvtRalLMIrotAc9I28NOri3glq', '2023-03-24 08:42:21'),
(15, 1, 'root', 'root@mail.root', '$2y$10$GF8ow1c13xVzY8pjtRH1he6AnZq2E8TskdeDAbdd/3aYbt2X0YCI.', '2023-03-28 16:05:06'),
(16, 1, 'root2', 'root2@mail.root2', '$2y$10$KyCZTciFlwLoY8Dyo07wVOlsH4YQCximI8SN7MMF6i02bFT0D.yu.', '2023-05-09 09:24:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_topic` (`id_topic`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
