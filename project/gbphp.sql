-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 03 2019 г., 16:40
-- Версия сервера: 8.0.15
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
  `count` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество просмотров',
  `stock` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2' COMMENT '1-нет в наличии,2- в наличии',
  `size` enum('XS','S','M','L','XL') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'XS' COMMENT 'размер одежды',
  `category` varchar(11) NOT NULL DEFAULT 'men' COMMENT 'категория одежды'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `address`, `name`, `price`, `count`, `stock`, `size`, `category`) VALUES
(1, 'img/product-1.jpg', 'Mango People T-shirt', '87', 4, '2', 'XS', 'men'),
(2, 'img/product-2.jpg', 'Mango People Dress', '152', 2, '2', 'S', 'men'),
(3, 'img/product-3.jpg', 'Mango People Jacket', '42', 6, '1', 'XL', 'men'),
(4, 'img/product-4.jpg', 'Mango People Top', '58', 4, '2', 'L', 'men'),
(5, 'img/product-5.jpg', 'Mango People Acces', '50', 0, '2', 'S', 'featured'),
(6, 'img/product-6.jpg', 'Mango People Blazer', '52', 0, '2', 'XS', 'men'),
(7, 'img/product-7.jpg', 'Mango People Pant', '102', 1, '2', 'M', 'featured'),
(8, 'img/product-8.jpg', 'Mango People Sweater', '67', 0, '2', 'XS', 'men'),
(19, 'img/product-like1.jpg', 'Mango People T-shirt', '42', 0, '2', 'M', 'women'),
(20, 'img/product-like2.jpg', 'Mango People T-shirt', '87', 0, '2', 'XS', 'women'),
(24, 'img/product-like3.jpg', 'Mango People Sweater', '45', 0, '2', 'S', 'women'),
(26, 'img/product-like4.jpg', 'Mango People T-shirt', '104', 0, '2', 'S', 'featured');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата оформление заказа',
  `comments` text COMMENT 'комментарии к заказу пользователя',
  `order_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'товары в заказе',
  `status` enum('inWork','sent') NOT NULL DEFAULT 'inWork' COMMENT 'статус заказа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `comments`, `order_items`, `status`) VALUES
(2, 14, 'Moskovskii 45', '{\"1\":{\"address\":\"img/product-1.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"52\",\"quantity\":2},\"2\":{\"address\":\"img/product-2.jpg\",\"name\":\"Mango People Dress\",\"price\":\"152\",\"quantity\":1},\"3\":{\"address\":\"img/product-3.jpg\",\"name\":\"Mango People Jacket\",\"price\":\"42\",\"quantity\":1}}', 'inWork'),
(3, 14, '', '{\"4\":{\"address\":\"img/product-4.jpg\",\"name\":\"Mango People Top\",\"price\":\"52\",\"quantity\":1},\"26\":{\"address\":\"img/product-like4.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"104\",\"quantity\":1},\"24\":{\"address\":\"img/product-like3.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"45\",\"quantity\":2}}', 'sent'),
(4, 17, '', '{\"20\":{\"address\":\"img/product-like2.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"87\",\"quantity\":1},\"19\":{\"address\":\"img/product-like1.jpg\",\"name\":\"Mango People T-shirt\",\"price\":\"42\",\"quantity\":2},\"7\":{\"address\":\"img/product-7.jpg\",\"name\":\"Mango People Pant\",\"price\":\"102\",\"quantity\":1}}', 'sent'),
(5, 14, '', '{\"2\":{\"address\":\"img/product-2.jpg\",\"name\":\"Mango People Dress\",\"price\":\"152\",\"quantity\":1},\"3\":{\"address\":\"img/product-3.jpg\",\"name\":\"Mango People Jacket\",\"price\":\"42\",\"quantity\":2},\"4\":{\"address\":\"img/product-4.jpg\",\"name\":\"Mango People Top\",\"price\":\"52\",\"quantity\":1}}', 'inWork');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата получения отзыва',
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `id_product`) VALUES
(1, 'Ann', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', NULL),
(2, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', NULL),
(3, 'Max', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', 2),
(4, 'Ivan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', 2),
(5, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta.', 2),
(6, 'Nic', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', 1),
(7, 'Sam', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas', NULL),
(8, 'Anonim', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL DEFAULT 'anonim',
  `login` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата регистрации',
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `role`) VALUES
(19, 'anonim', 'admin', '$2y$10$wgYN0mLYs9ZhPujDWdIeGeCadjaGlrLTBprSxIap8qOgxaph9wQGK', 'isAdmin'),
(20, 'anonim', 'Ann', '$2y$10$RLypXhOBTqT4t3Jt82ofL.ej/wgqckdiUBsBwSdSvc.zWM58yL8sK', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
