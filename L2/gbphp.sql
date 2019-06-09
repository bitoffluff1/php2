-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2019 г., 00:11
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `address` varchar(30) NOT NULL COMMENT 'путь к картинке',
  `name` varchar(40) NOT NULL DEFAULT 'Mango People T-shirt' COMMENT 'название товара',
  `price` decimal(10,0) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0 COMMENT 'Количество просмотров',
  `stock` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-нет в наличии,1- в наличии'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `address`, `name`, `price`, `count`, `stock`) VALUES
(1, 'img/product-1.jpg', 'Mango People T-shirt', '87', 2, '1'),
(2, 'img/product-2.jpg', 'Mango People Dress', '152', 2, '1'),
(3, 'img/product-3.jpg', 'Mango People Jacket', '42', 6, '1'),
(4, 'img/product-4.jpg', 'Mango People Top', '52', 2, '1'),
(5, 'img/product-5.jpg', 'Mango People Acces', '50', 0, '1'),
(6, 'img/product-6.jpg', 'Mango People Blazer', '52', 0, '1'),
(7, 'img/product-7.jpg', 'Mango People Pant', '102', 1, '1'),
(8, 'img/product-8.jpg', 'Mango People Sweater', '67', 0, '1'),
(19, 'img/product-like1.jpg', 'Mango People T-shirt', '42', 0, '1'),
(20, 'img/product-like2.jpg', 'Mango People T-shirt', '87', 0, '1'),
(24, 'img/product-like3.jpg', 'Mango People Sweater', '45', 0, '1'),
(26, 'img/product-like4.jpg', 'Mango People T-shirt', '104', 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата оформление заказа',
  `comments` text DEFAULT NULL COMMENT 'комментарии к заказу пользователя',
  `order_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'товары в заказе',
  `status` enum('inWork','sent') NOT NULL DEFAULT 'inWork' COMMENT 'статус заказа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `comments`, `order_items`, `status`) VALUES
(2, 14, '2019-05-28 12:44:49', 'Moskovskii 45', '{\"1\":{\"address\":\"img/product-1.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"52\",\"quantity\":2},\"2\":{\"address\":\"img/product-2.jpg\",\"name\":\"Mango People Dress\",\"price\":\"152\",\"quantity\":1},\"3\":{\"address\":\"img/product-3.jpg\",\"name\":\"Mango People Jacket\",\"price\":\"42\",\"quantity\":1}}', 'inWork'),
(3, 14, '2019-05-28 13:10:55', '', '{\"4\":{\"address\":\"img/product-4.jpg\",\"name\":\"Mango People Top\",\"price\":\"52\",\"quantity\":1},\"26\":{\"address\":\"img/product-like4.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"104\",\"quantity\":1},\"24\":{\"address\":\"img/product-like3.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"45\",\"quantity\":2}}', 'sent'),
(4, 17, '2019-05-28 13:32:49', '', '{\"20\":{\"address\":\"img/product-like2.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"87\",\"quantity\":1},\"19\":{\"address\":\"img/product-like1.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"42\",\"quantity\":2},\"7\":{\"address\":\"img/product-7.jpg\",\"name\":\"Mango People Pant\",\"price\":\"102\",\"quantity\":1}}', 'sent'),
(5, 14, '2019-05-29 20:43:46', '', '{\"2\":{\"address\":\"img/product-2.jpg\",\"name\":\"Mango People Dress\",\"price\":\"152\",\"quantity\":1},\"3\":{\"address\":\"img/product-3.jpg\",\"name\":\"Mango People Jacket\",\"price\":\"42\",\"quantity\":2},\"4\":{\"address\":\"img/product-4.jpg\",\"name\":\"Mango People Top\",\"price\":\"52\",\"quantity\":1}}', 'inWork');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата получения отзыва',
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `date`, `id_product`) VALUES
(1, 'Ann', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', '2019-05-19 13:15:43', NULL),
(2, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', '2019-05-19 13:21:57', NULL),
(3, 'Max', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-19 14:38:04', 2),
(4, 'Ivan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-19 14:42:34', 2),
(5, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta.', '2019-05-19 14:44:44', 2),
(6, 'Nic', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-23 21:58:10', 1),
(7, 'Sam', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas', '2019-05-23 22:33:19', NULL),
(8, 'Anonim', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas', '2019-05-29 13:15:38', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL DEFAULT 'anonim',
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата регистрации',
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `role`) VALUES
(11, 'anonim', 'admin', '81f63ec6f29d7d53bdce841ee7ffec6b', '2019-05-23 17:11:09', 'isAdmin'),
(14, 'anonim', 'Ann', '82d2ac33efb008f59b666edf4da8e918', '2019-05-25 20:32:47', NULL),
(15, 'anonim', 'Ivan', '88b5fd7aebba9bd79040db080aa88481', '2019-05-25 21:02:30', NULL),
(17, 'anonim', 'Helen', 'eb259ef37004b5c6381314da1a415d62', '2019-05-25 21:21:59', NULL),
(18, 'anonim', 'Main Admin', '870db4b0f7480dff28df6e071582db42', '2019-05-25 21:22:41', 'isAdmin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
