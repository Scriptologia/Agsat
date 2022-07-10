-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 16 2022 г., 22:03
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `agsat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `baskets`
--

CREATE TABLE `baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `person` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `price` double(11,2) NOT NULL DEFAULT '0.00',
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `baskets`
--

INSERT INTO `baskets` (`id`, `person`, `products`, `price`, `is_closed`, `created_at`, `updated_at`) VALUES
(39, '{\"city\": \"одесса\", \"name\": \"Андрей Иванов\", \"post\": \"Отделение №70 (до 5 кг): просп. Небесной Сотни (ран.М.Жукова), 3а, кв.6 (ТЦ Успех)\", \"phone\": \"+73806754900\", \"street\": \"жуков\"}', '[{\"id\": 1, \"img\": \"/storage/products/03-17-52-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 1\", \"slug\": \"telefon-1\", \"count\": 6, \"price\": 1.12, \"skidka\": 12, \"curs_name\": \"Рубль\", \"in_basket\": 3, \"price_all\": 75, \"price_curs\": 25, \"category_id\": 20, \"category_slug\": \"telefoni\"}, {\"id\": 10, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 5\", \"slug\": \"telefon-5\", \"count\": 6, \"price\": 1.12, \"skidka\": 1.12, \"curs_name\": \"Рубль\", \"in_basket\": 1, \"price_all\": 28, \"price_curs\": 28, \"category_id\": 20, \"category_slug\": \"telefoni\"}]', 103.00, 1, '2022-01-19 16:50:50', '2022-01-20 13:21:40'),
(40, '{\"city\": \"одесса\", \"name\": \"Петр Петрович Петров\", \"post\": \"Почтомат \\\"Новая Почта\\\" №26256: ул. Жуковского, 36 (маг. \\\"Гурманъ\\\")\", \"phone\": \"+380963805189\", \"street\": \"жуков\"}', '[{\"id\": 15, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 8\", \"slug\": \"telefon-8\", \"count\": 6, \"price\": 1.12, \"skidka\": 1.12, \"curs_name\": \"Рубль\", \"in_basket\": 6, \"price_all\": 168, \"price_curs\": 28, \"category_id\": 20, \"category_slug\": \"telefoni\"}]', 168.00, 1, '2022-01-19 16:51:19', '2022-01-20 13:44:34'),
(41, '{\"city\": \"одесса\", \"name\": \"Карл Карлович2222\", \"post\": \"Почтомат \\\"Новая Почта\\\" №24792: ул. Генерала Бочарова, 7б, секция №4 (ТОЛЬКО ДЛЯ ЖИТЕЛЕЙ)\", \"phone\": \"+380963805189\", \"street\": \"бочар\"}', '[{\"id\": 1, \"img\": \"/storage/products/03-17-52-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 1\", \"slug\": \"telefon-1\", \"price\": 1.12, \"skidka\": 12, \"curs_name\": \"Рубль\", \"in_basket\": 3, \"price_all\": 75, \"price_curs\": 25, \"category_id\": 20, \"category_slug\": \"telefoni\"}]', 75.00, 0, '2022-01-20 17:34:00', '2022-01-20 17:34:00'),
(112, '{\"city\": \"одесса\", \"name\": \"Валентин Рожко111\", \"post\": \"Отделение №9 (до 30 кг): ул. Сегедская, 18\", \"phone\": \"+38(073) 80-67-555\", \"street\": \"сегедская\"}', '[{\"id\": 1, \"img\": \"/storage/products/03-17-52-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 1\", \"slug\": \"telefon-1\", \"price\": 1.12, \"skidka\": 12, \"curs_name\": \"Рубль\", \"in_basket\": 1, \"price_all\": 25, \"price_curs\": 25, \"category_id\": 20, \"category_slug\": \"telefoni\"}]', 25.00, 0, '2022-01-22 07:41:40', '2022-01-22 07:41:40'),
(115, '{\"city\": \"Антонівка (Вінницька обл.)\", \"name\": \"Петр\", \"post\": \"Пункт приймання - видачі ( до 30 кг): вул. Першотравнева, 1А\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Вінницька\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 1, \"img\": \"/storage/products/03-17-52-06-01-2022.jpg\", \"curs\": 25.01, \"name\": \"Телефон 1\", \"slug\": \"telefon-1\", \"price\": 1.12, \"skidka\": 12, \"curs_name\": \"Рубль\", \"in_basket\": 2, \"price_all\": 50, \"price_curs\": 25, \"category_id\": 20, \"category_slug\": \"telefoni\"}, {\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 150.00, 0, '2022-01-25 10:43:43', '2022-01-25 10:43:43'),
(116, '{\"city\": \"Бахів\", \"name\": \"Валентин\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Молодіжна, 8\", \"phone\": \"+38(073) 80-67-549\", \"region\": \"Волинська\", \"surname\": \"Рожко\", \"patronymico\": \"Николаевич\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 12:47:46', '2022-01-25 12:47:46'),
(117, '{\"city\": \"Балажер\", \"name\": \"Александр\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Гагаріна, 18\", \"phone\": \"+38(009) 63-69-852\", \"region\": \"Закарпатська\", \"surname\": \"Манолов\", \"patronymico\": \"Николаевич\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 12:48:09', '2022-01-25 12:48:09'),
(118, '{\"city\": \"Антонівка (Вінницька обл.)\", \"name\": \"Петр\", \"post\": \"Пункт приймання - видачі ( до 30 кг): вул. Першотравнева, 1А\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Вінницька\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:20:31', '2022-01-25 13:20:31'),
(119, '{\"city\": \"Білий Камінь (Чечельницький р-н)\", \"name\": \"Валентин\", \"post\": \"Пункт приймання - видачі (до 30 кг): вул. Правобережна, 22\", \"phone\": \"+38(073) 80-67-549\", \"region\": \"Вінницька\", \"surname\": \"Рожко\", \"patronymico\": \"Николаевич\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:26:30', '2022-01-25 13:26:30'),
(120, '{\"city\": \"Андріївка (Дніпропетровська обл.)\", \"name\": \"Петр\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Нова, 2\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Дніпропетровська\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:26:58', '2022-01-25 13:26:58'),
(121, '{\"city\": \"Андріївка (Дніпропетровська обл.)\", \"name\": \"Петр\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Нова, 2\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Дніпропетровська\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:29:31', '2022-01-25 13:29:31'),
(122, '{\"city\": \"Берека\", \"name\": \"Петр\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Корнева, 1\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Харківська\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:29:46', '2022-01-25 13:29:46'),
(123, '{\"city\": \"Аполлонівка\", \"name\": \"Петр\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Юбкіна, 59а\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Дніпропетровська\", \"surname\": \"Петров\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"price\": 100, \"skidka\": 0, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"price_all\": 100, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 100.00, 0, '2022-01-25 13:44:01', '2022-01-25 13:44:01'),
(126, '{\"city\": \"Бахів\", \"name\": \"Валентин\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. Молодіжна, 8\", \"phone\": \"+38(073) 80-67-549\", \"region\": \"Волинська\", \"surname\": \"Рожко\", \"patronymico\": \"Николаевич\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"count\": 4, \"price\": 100, \"skidka\": 0, \"service\": {\"id\": 1, \"curs\": 1, \"name\": \"Услуга 1\", \"price\": 100}, \"curs_name\": \"Гривня\", \"in_basket\": 1, \"isService\": true, \"price_all\": 200, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 200.00, 0, '2022-01-26 16:25:28', '2022-01-26 17:04:22'),
(128, '{\"city\": \"Великі Будки\", \"name\": \"Вася\", \"post\": \"Пункт приймання-видачі (до 30 кг): вул. 8 Березня, 5\", \"phone\": \"+38(096) 38-05-189\", \"region\": \"Сумська\", \"surname\": \"Пупкин\", \"patronymico\": \"Петрович\"}', '[{\"id\": 34, \"img\": \"/storage/products/03-17-51-06-01-2022.jpg\", \"curs\": 1, \"name\": \"Товар 1\", \"slug\": \"tovar-1\", \"count\": 4, \"price\": 100, \"skidka\": 0, \"service\": {\"id\": 1, \"curs\": 1, \"name\": \"Услуга 1\", \"price\": 100}, \"curs_name\": \"Гривня\", \"in_basket\": 2, \"isService\": true, \"price_all\": 400, \"price_curs\": 100, \"category_id\": 26, \"category_slug\": \"kategoriya-111\"}]', 400.00, 0, '2022-01-26 18:03:23', '2022-01-26 18:04:02'),
(129, '{\"name\":\"\\u0439\\u0446\\u0443\\u0439\\u0443\\u0439\",\"surname\":\"\\u0439\\u0446\\u0443\\u0439\\u0446\\u0443\",\"patronymico\":\"\\u0439\\u0446\\u0443\\u0439\\u0443\\u0439\",\"phone\":\"+38(023) 42-34-234\",\"region\":\"\\u0420\\u0456\\u0432\\u043d\\u0435\\u043d\\u0441\\u044c\\u043a\\u0430\",\"city\":\"\\u0411\\u0435\\u0440\\u0435\\u0437\\u043e\\u0432\\u0435 (\\u0420\\u0456\\u0432\\u043d\\u0435\\u043d\\u0441\\u044c\\u043a\\u0430 \\u043e\\u0431\\u043b.)\",\"post\":\"\\u0412\\u0456\\u0434\\u0434\\u0456\\u043b\\u0435\\u043d\\u043d\\u044f \\u21161 (\\u0434\\u043e 30 \\u043a\\u0433): \\u0432\\u0443\\u043b. \\u041f\\u0435\\u0440\\u0448\\u043e\\u0442\\u0440\\u0430\\u0432\\u043d\\u0435\\u0432\\u0430, 2\\u0411\"}', '[{\"id\":34,\"slug\":\"tovar-1\",\"name\":\"\\u0422\\u043e\\u0432\\u0430\\u0440 1\",\"category_id\":\"26\",\"category_slug\":\"kategoriya-111\",\"isService\":true,\"price\":100,\"skidka\":\"0.00\",\"price_all\":300,\"price_curs\":100,\"in_basket\":1,\"curs\":1,\"curs_name\":\"\\u0413\\u0440\\u0438\\u0432\\u043d\\u044f\",\"img\":\"\\/storage\\/products\\/03-17-51-06-01-2022.jpg\",\"service\":{\"id\":1,\"name\":\"\\u043f\\u0440\\u043e\\u0448\\u0438\\u0432\\u043a\\u0430\",\"price\":100,\"curs\":1}}]', 200.00, 0, '2022-01-27 14:25:12', '2022-01-27 14:25:12'),
(130, '{\"name\":\"\\u0410\\u043d\\u0434\\u0440\\u0435\\u0439\",\"surname\":\"\\u0418\\u0432\\u0430\\u043d\\u043e\\u0432\",\"patronymico\":\"\\u041d\\u0438\\u043a\\u043e\\u043b\\u0430\\u0435\\u0432\\u0438\\u0447\",\"phone\":\"+38(073) 80-67-549\",\"region\":\"\\u0414\\u043d\\u0456\\u043f\\u0440\\u043e\\u043f\\u0435\\u0442\\u0440\\u043e\\u0432\\u0441\\u044c\\u043a\\u0430\",\"city\":\"\\u0410\\u0432\\u0456\\u0430\\u0442\\u043e\\u0440\\u0441\\u044c\\u043a\\u0435\",\"post\":\"\\u0412\\u0456\\u0434\\u0434\\u0456\\u043b\\u0435\\u043d\\u043d\\u044f \\u21161: \\u0432\\u0443\\u043b. \\u0410\\u0435\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c, \\u0431\\u0443\\u0434.10,\\u043f\\u0440\\u0438\\u043c.91\"}', '[{\"id\":40,\"slug\":\"ustym-4k-ott-premium\",\"name\":\"Ustym 4K OTT Premium\",\"category_id\":{\"id\":25,\"category_id\":77,\"slug\":\"sputnikovie-resiveri-dvb-s2\",\"position\":1,\"name_ru\":\"\\u0421\\u043f\\u0443\\u0442\\u043d\\u0438\\u043a\\u043e\\u0432\\u044b\\u0435 \\u0440\\u0435\\u0441\\u0438\\u0432\\u0435\\u0440\\u044b (DVB - S2)\",\"description_ru\":null,\"tags_ru\":null,\"name_uk\":\"\\u041a\\u0430\\u0442\\u0435\\u0433\\u043e\\u0440\\u0438\\u044f 11\",\"description_uk\":null,\"tags_uk\":null,\"skidka\":0,\"filters\":null,\"img\":\"\\/storage\\/category\\/03-18-29-02-02-2022.png\",\"visible\":true,\"created_at\":\"2022-01-24T12:36:16.000000Z\",\"updated_at\":\"2022-02-08T20:45:30.000000Z\",\"pivot\":{\"product_id\":40,\"category_id\":25}},\"category_slug\":\"sputnikovie-resiveri-dvb-s2\",\"isService\":true,\"price\":75,\"skidka\":0,\"price_all\":2275,\"price_curs\":2175,\"in_basket\":1,\"curs\":29,\"curs_name\":\"\\u0414\\u043e\\u043b\\u043b\\u0430\\u0440\",\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-02-09-03-02-2022.jpg\",\"service\":{\"id\":1,\"name\":\"\\u041d\\u0430\\u0441\\u0442\\u0440\\u043e\\u0439\\u043a\\u0430 (\\u043e\\u0431\\u043d\\u043e\\u0432\\u043b\\u0435\\u043d\\u0438\\u0435 \\u041f\\u041e)\",\"price\":100,\"curs\":1}}]', 2275.00, 0, '2022-02-15 18:45:24', '2022-02-15 18:45:24'),
(131, '{\"name\":\"\\u0410\\u043d\\u0434\\u0440\\u0435\\u0439\",\"surname\":\"\\u0418\\u0432\\u0430\\u043d\\u043e\\u0432\",\"patronymico\":\"\\u041d\\u0438\\u043a\\u043e\\u043b\\u0430\\u0435\\u0432\\u0438\\u0447\",\"phone\":\"+38(073) 80-67-549\",\"region\":\"\\u0414\\u043d\\u0456\\u043f\\u0440\\u043e\\u043f\\u0435\\u0442\\u0440\\u043e\\u0432\\u0441\\u044c\\u043a\\u0430\",\"city\":\"\\u0410\\u0432\\u0456\\u0430\\u0442\\u043e\\u0440\\u0441\\u044c\\u043a\\u0435\",\"post\":\"\\u0412\\u0456\\u0434\\u0434\\u0456\\u043b\\u0435\\u043d\\u043d\\u044f \\u21161: \\u0432\\u0443\\u043b. \\u0410\\u0435\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c, \\u0431\\u0443\\u0434.10,\\u043f\\u0440\\u0438\\u043c.91\"}', '[{\"id\":40,\"slug\":\"ustym-4k-ott-premium\",\"name\":\"Ustym 4K OTT Premium\",\"category_id\":{\"id\":25,\"category_id\":77,\"slug\":\"sputnikovie-resiveri-dvb-s2\",\"position\":1,\"name_ru\":\"\\u0421\\u043f\\u0443\\u0442\\u043d\\u0438\\u043a\\u043e\\u0432\\u044b\\u0435 \\u0440\\u0435\\u0441\\u0438\\u0432\\u0435\\u0440\\u044b (DVB - S2)\",\"description_ru\":null,\"tags_ru\":null,\"name_uk\":\"\\u041a\\u0430\\u0442\\u0435\\u0433\\u043e\\u0440\\u0438\\u044f 11\",\"description_uk\":null,\"tags_uk\":null,\"skidka\":0,\"filters\":null,\"img\":\"\\/storage\\/category\\/03-18-29-02-02-2022.png\",\"visible\":true,\"created_at\":\"2022-01-24T12:36:16.000000Z\",\"updated_at\":\"2022-02-08T20:45:30.000000Z\",\"pivot\":{\"product_id\":40,\"category_id\":25}},\"category_slug\":\"sputnikovie-resiveri-dvb-s2\",\"isService\":true,\"price\":75,\"skidka\":0,\"price_all\":2275,\"price_curs\":2175,\"in_basket\":1,\"curs\":29,\"curs_name\":\"\\u0414\\u043e\\u043b\\u043b\\u0430\\u0440\",\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-02-09-03-02-2022.jpg\",\"service\":{\"id\":1,\"name\":\"\\u041d\\u0430\\u0441\\u0442\\u0440\\u043e\\u0439\\u043a\\u0430 (\\u043e\\u0431\\u043d\\u043e\\u0432\\u043b\\u0435\\u043d\\u0438\\u0435 \\u041f\\u041e)\",\"price\":100,\"curs\":1}}]', 2275.00, 0, '2022-02-15 18:45:44', '2022-02-15 18:45:44');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags_ru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags_uk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `skidka` float(11,2) NOT NULL DEFAULT '0.00',
  `filters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `slug`, `position`, `name_ru`, `description_ru`, `tags_ru`, `name_uk`, `description_uk`, `tags_uk`, `skidka`, `filters`, `img`, `visible`, `created_at`, `updated_at`) VALUES
(25, 77, 'sputnikovie-resiveri-dvb-s2', 1, 'Спутниковые ресиверы (DVB - S2)', NULL, NULL, 'Категория 11', NULL, NULL, 0.00, '[4]', '/storage/category/03-18-29-02-02-2022.png', 1, '2022-01-24 10:36:16', '2022-02-16 15:25:14'),
(27, NULL, 'smarttv-pristavki-i-aksessuari', 2, 'Smart-TV приставки и аксессуары', NULL, NULL, 'Android-приставки', NULL, NULL, 0.00, NULL, '/storage/category/06-37-58-03-02-2022.jpg', 1, '2022-01-28 19:59:25', '2022-02-14 18:07:11'),
(28, 77, 'efirnie-resiveri-dvb-t2', 1, 'Эфирные ресиверы (DVB - T2)', NULL, NULL, 'Спутниковые антенны', 'описание', NULL, 0.00, '[16]', '/storage/category/03-38-37-02-02-2022.png', 1, '2022-01-28 20:00:48', '2022-02-16 15:25:24'),
(29, 77, 'kabelnie-resiveri-dvb-c', 1, 'Кабельные ресиверы (DVB - C)', NULL, NULL, 'Спутниковые конверторы', NULL, NULL, 0.00, NULL, NULL, 1, '2022-01-28 20:03:20', '2022-02-08 18:45:39'),
(34, NULL, 'antenni', 4, 'Антенны', NULL, NULL, 'Антенны', NULL, NULL, 0.00, NULL, '/storage/category/03-38-37-02-02-2022.png', 1, '2022-01-31 19:14:15', '2022-02-14 18:16:03'),
(35, NULL, 'videonablyudenie', 3, 'Видеонаблюдение', NULL, NULL, 'Видеонаблюдение', NULL, NULL, 0.00, NULL, '/storage/category/05-41-30-04-02-2022.jpg', 1, '2022-01-31 19:17:03', '2022-02-14 18:08:31'),
(36, NULL, 'setevoe-oborudovanie', 5, 'Сетевое оборудование', NULL, NULL, 'Сетевое оборудование', NULL, NULL, 0.00, NULL, '/storage/category/05-34-43-04-02-2022.jpg', 1, '2022-01-31 19:21:42', '2022-02-14 18:15:59'),
(38, NULL, 'kabelnaia-produkcia', 7, 'Кабельная продукция', NULL, NULL, 'Кабельная продукция', NULL, NULL, 0.00, NULL, '/storage/category/05-36-35-04-02-2022.jpg', 1, '2022-01-31 19:31:35', '2022-02-14 18:32:47'),
(40, 80, 'androidpristavki', 1, 'Android-приставки', NULL, NULL, 'Android-приставки', NULL, NULL, 0.00, NULL, '/storage/category/06-37-58-03-02-2022.jpg', 1, '2022-02-02 08:26:51', '2022-02-08 17:23:17'),
(41, 75, 'antenni-efirnie-t2', 1, 'Антенны эфирные Т2', NULL, NULL, 'Антенны эфирные', NULL, NULL, 0.00, NULL, '/storage/category/06-39-44-03-02-2022.jpg', 1, '2022-02-03 16:39:57', '2022-02-08 16:51:42'),
(42, 78, 'marshrutizatori-routeri', 1, 'Маршрутизаторы, роутеры', NULL, NULL, 'Сетевое оборудование', NULL, NULL, 0.00, NULL, '/storage/category/05-34-43-04-02-2022.jpg', 1, '2022-02-04 15:31:32', '2022-02-08 17:05:00'),
(43, 79, 'kameri-videonablyudeniya-', 1, 'Камеры видеонаблюдения', NULL, NULL, 'Видеонаблюдение', NULL, NULL, 0.00, NULL, '/storage/category/05-41-30-04-02-2022.jpg', 1, '2022-02-04 15:41:45', '2022-02-08 17:18:47'),
(46, 80, 'linux-pristavki', 1, 'Linux приставки', NULL, NULL, 'Linux приставки', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:09:47', '2022-02-08 17:23:05'),
(47, 80, 'aeromishi-pulti-dlya-pristavok-', 1, 'Аэромыши, пульты для приставок', NULL, NULL, 'Аэромыши, пульты для приставок', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:10:42', '2022-02-08 17:23:27'),
(49, 78, 'marshrutizatori-routeri-4g-lte', 1, 'Маршрутизаторы, роутеры 4G, LTE', NULL, NULL, 'Маршрутизаторы, роутеры 4G, LTE', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:15:16', '2022-02-08 17:05:15'),
(50, 78, 'kommutatori-', 1, 'Коммутаторы', NULL, NULL, 'Коммутаторы', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:15:49', '2022-02-08 17:09:19'),
(51, 78, 'usb-wifi-adapteri', 1, 'USB Wi-Fi адаптеры', NULL, NULL, 'USB Wi-Fi адаптеры', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:16:37', '2022-02-08 17:07:20'),
(52, 78, 'aksessuari-setevoe', 1, 'Аксессуары', NULL, NULL, 'Аксессуары', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:17:34', '2022-02-08 17:08:59'),
(53, 79, 'registratori', 1, 'Регистраторы', NULL, NULL, 'Регистраторы', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:18:35', '2022-02-08 17:19:02'),
(54, 79, 'bloki-pitaniya', 1, 'Блоки питания', NULL, NULL, 'Блоки питания', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:19:02', '2022-02-08 17:19:19'),
(55, 79, 'kommutatori-poe', 1, 'Коммутаторы PoE', NULL, NULL, 'Коммутаторы PoE', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:19:25', '2022-02-08 17:19:57'),
(56, 79, 'aks', 1, 'Аксессуары для видеонаблюдения', NULL, NULL, 'Аксессуары для видеонаблюдения', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:19:58', '2022-02-08 17:20:40'),
(57, 76, 'kabel-televizionnii-75-om', 1, 'Кабель телевизионный 75 Ом', NULL, NULL, 'Кабель телевизионный 750м', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:32:36', '2022-02-08 17:36:25'),
(58, 76, 'kabel-50-om', 1, 'кабель 50 Ом', NULL, NULL, 'кабель 500м', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:32:51', '2022-02-08 17:36:16'),
(59, 76, 'kabel-vitaya-para', 1, 'Кабель витая пара (UTP, FTP)', NULL, NULL, 'Кабель витая пара (UTP, FTP)', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:33:21', '2022-02-08 16:54:52'),
(60, 75, 'antenni-sputnikovie', 1, 'Антенны спутниковые', NULL, NULL, 'Антенны спутниковые', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:35:15', '2022-02-08 16:52:12'),
(61, 75, 'antenni-komnatnie-t2', 1, 'Антенны комнатные Т2', NULL, NULL, 'Антенны комнатные Т2', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:36:53', '2022-02-08 16:52:04'),
(62, 75, 'antenni-gsm-4g', 1, 'Антенны GSM, 4G', NULL, NULL, 'Антенны GSM, 4G', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:37:19', '2022-02-08 16:52:40'),
(63, 75, 'usiliteli-vch-signala', 1, 'Усилители ВЧ сигнала', NULL, NULL, 'Усилители B4 сигнала', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:37:54', '2022-02-08 17:36:41'),
(64, 75, 'aksessuari-antenni', 1, 'Аксессуары', NULL, NULL, 'Аксессуары', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:38:17', '2022-02-08 16:53:16'),
(65, NULL, 'shnuri-razemi-perehodnik', 6, 'Шнуры, разъемы, переходники', NULL, NULL, 'Шнуры, разъемы, переходники', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:40:46', '2022-02-14 18:32:45'),
(66, 65, 'shnuri-razemi-perehodniki', 1, 'Шнуры, разъемы, переходники', NULL, NULL, 'Шнуры, разъемы, переходники', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:41:02', '2022-02-08 16:42:29'),
(67, NULL, 'kronshe', 8, 'Кронштейны и мультифиды', NULL, NULL, 'Кронштейны и мультифиры', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:43:37', '2022-02-14 18:15:54'),
(68, 67, 'kronshteini-i-multifidi', 1, 'Кронштейны и мультифиды', NULL, NULL, 'Кронштейны и мультифиры', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:43:51', '2022-02-08 17:35:40'),
(69, NULL, 'polki-pod-tv', 9, 'Полки под телевизоры', NULL, NULL, 'Полки под телевизор', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:44:23', '2022-02-14 18:15:51'),
(70, 69, 'polki-pod-televizori', 1, 'Полки под телевизоры', NULL, NULL, 'Полки под телевизор', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:44:34', '2022-02-08 17:36:57'),
(71, NULL, 'kommutatori', 10, 'Коммутаторы и переключатели, разветвители, диплексеры сигнала', NULL, NULL, 'Коммутаторы и переключатели, разветвители, диплексеры сигнала', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:44:56', '2022-02-14 18:15:48'),
(73, 87, 'pulti', 1, 'Пульты ДУ', NULL, NULL, 'Пульты Д/У', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 16:45:23', '2022-02-08 18:47:54'),
(74, 73, 'pulti-', 1, 'Пульты ДУ', NULL, NULL, 'Пульты Д/У', NULL, NULL, 0.00, NULL, '/storage/category/05-56-01-04-02-2022.jpg', 1, '2022-02-08 16:45:40', '2022-02-08 17:38:41'),
(75, 34, 'antenni-', 1, 'Антенны', NULL, NULL, 'Антенны', NULL, NULL, 0.00, NULL, '/storage/category/03-38-37-02-02-2022.png', 1, '2022-02-08 16:51:28', '2022-02-08 17:31:46'),
(76, 38, 'kabelnaya-produktsiya', 1, 'Кабельная продукция', NULL, NULL, 'Кабельная продукция', NULL, NULL, 0.00, NULL, '/storage/category/05-36-35-04-02-2022.jpg', 1, '2022-02-08 16:54:00', '2022-02-08 17:33:40'),
(77, NULL, 'resiveri', 1, 'Ресиверы', NULL, NULL, 'Ресиверы', NULL, NULL, 0.00, '[3]', '/storage/category/03-18-29-02-02-2022.png', 1, '2022-02-08 17:02:40', '2022-02-16 15:25:31'),
(78, 36, 'setevoe-oborudovanie1', 1, 'Сетевое оборудование', NULL, NULL, 'Сетевое оборудование', NULL, NULL, 0.00, NULL, '/storage/category/05-34-43-04-02-2022.jpg', 1, '2022-02-08 17:04:30', '2022-02-08 17:31:34'),
(79, 35, 'video', 1, 'Видеонаблюдение', NULL, NULL, 'Видеонаблюдение', NULL, NULL, 0.00, NULL, '/storage/category/05-41-30-04-02-2022.jpg', 1, '2022-02-08 17:18:18', '2022-02-08 17:31:28'),
(80, 27, 'smarttv-pristavki-i-aksessuari-', 1, 'Smart-TV приставки и аксессуары', NULL, NULL, 'Smart-TV приставки и аксессуары', NULL, NULL, 0.00, NULL, '/storage/category/06-37-58-03-02-2022.jpg', 1, '2022-02-08 17:21:25', '2022-02-08 17:31:21'),
(81, 80, 'aksessuari-', 1, 'Аксессуары', NULL, NULL, 'Аксессуары', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 17:24:00', '2022-02-08 17:24:16'),
(82, 85, 'pult', 1, 'Пульты', NULL, NULL, 'Пульты', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 17:26:54', '2022-02-08 18:46:32'),
(83, 85, 'bloki-pitaniya-dlya-tyunerov', 1, 'Блоки питания для тюнеров', NULL, NULL, 'Блоки питания для тюнеров', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 17:27:44', '2022-02-08 18:46:43'),
(84, 71, 'kommutatori-i-pereklyuchateli-razvetviteli-diplekseri-signala', 1, 'Коммутаторы и переключатели, разветвители, диплексеры сигнала', NULL, NULL, 'Коммутаторы и переключатели, разветвители, диплексеры сигнала', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 17:37:49', '2022-02-08 17:37:49'),
(85, 87, 'aksessuari-res', 1, 'Аксессуары', NULL, NULL, 'Аксессуары', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 17:43:26', '2022-02-08 18:47:13'),
(87, NULL, 'aksessua', 11, 'Аксессуары', NULL, NULL, 'Аксессуары', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 18:39:56', '2022-02-14 18:15:43'),
(88, 85, 'aksessuari-dlya-', 1, 'Аксессуары для видеонаблюден', NULL, NULL, 'Аксессуары для видеонаблюден', NULL, NULL, 0.00, NULL, NULL, 1, '2022-02-08 18:49:04', '2022-02-08 18:49:04');

-- --------------------------------------------------------

--
-- Структура таблицы `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 29, 39, NULL, NULL),
(4, 28, 39, NULL, NULL),
(7, 25, 40, NULL, NULL),
(11, 28, 43, NULL, NULL),
(14, 28, 46, NULL, NULL),
(16, 25, 46, NULL, NULL),
(17, 77, 46, NULL, NULL),
(21, 77, 38, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `socials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `time` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `text_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `text_uk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`, `phones`, `socials`, `time`, `text_ru`, `text_uk`, `created_at`, `updated_at`) VALUES
(2, 'Smart-telecom', '/storage/logo/09-05-10-03-01-2022.png', '[\"+380674170350\",\"+380949472718\",\"+380487439718\"]', '[{\"img\": \"/storage/socials/facebook.svg\", \"url\": \"http://facebook.ru\", \"name\": \"facebook\"}, {\"img\": \"/storage/socials/twitter.svg\", \"url\": \"http://twitter.ru\", \"name\": \"twitter\"}, {\"img\": \"/storage/socials/youtube.svg\", \"url\": \"http://youtube.com\", \"name\": \"youtube\"}]', '{\"to\":\"00:00\",\"end\":\"00:00\",\"from\":\"00:00\",\"start\":\"00:00\"}', '<p>ydhyntdjhn</p><p>dyfh</p><p>dfyhn</p><p>yhn</p><p>d</p>', '<p>ydhyntdjhn</p><p>dyfh</p><p>dfyhn</p><p>yhn</p><p>d</p>', '2021-12-19 17:36:39', '2022-01-28 20:48:13');

-- --------------------------------------------------------

--
-- Структура таблицы `curs`
--

CREATE TABLE `curs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curs` float(11,2) NOT NULL DEFAULT '0.00',
  `base` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `curs`
--

INSERT INTO `curs` (`id`, `name`, `slug`, `img`, `curs`, `base`, `created_at`, `updated_at`) VALUES
(16, 'Доллар', 'ru', NULL, 29.00, 0, '2021-12-06 17:18:27', '2022-02-03 16:21:35'),
(18, 'Гривна', 'grn', '/storage/images1/12-46-45-18-12-2021.jpg', 1.00, 1, '2021-12-06 17:22:05', '2022-02-03 16:21:41');

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filters`
--

INSERT INTO `filters` (`id`, `filter_id`, `slug`, `name_ru`, `name_uk`, `value_ru`, `value_uk`, `visible`, `created_at`, `updated_at`) VALUES
(3, NULL, 'proizvoditel', 'Производитель', 'ФильтрУ 3', NULL, NULL, 1, '2021-12-04 12:18:14', '2022-01-11 05:05:23'),
(4, NULL, 'pamyat', 'Память', 'ФильтрУ 4', NULL, NULL, 1, '2021-12-04 14:17:37', '2022-01-11 05:06:33'),
(16, NULL, 'chislo-vihodov', 'Число выходов', 'ФильтрУ 5', NULL, NULL, 1, '2021-12-04 15:09:23', '2022-01-11 05:07:33'),
(41, NULL, 'filtr-6', 'Фильтр 6', 'Фильтр 6', NULL, NULL, 1, '2021-12-07 13:34:37', '2021-12-07 13:34:37'),
(42, 41, 'pole-16', NULL, NULL, 'Поле 1', 'ПолеУ 1', 1, '2021-12-07 13:34:37', '2022-01-08 17:25:15'),
(46, 3, 'samsung', NULL, NULL, 'samsung', 'ПолеУ 1', 1, '2022-01-11 05:05:23', '2022-01-11 05:05:23'),
(47, 3, 'nokia', NULL, NULL, 'nokia', 'ПолеУ 1', 1, '2022-01-11 05:05:23', '2022-01-11 05:05:23'),
(48, 3, 'apple', NULL, NULL, 'apple', 'apple', 1, '2022-01-11 05:05:23', '2022-01-11 05:05:23'),
(50, 4, '2-gb', NULL, NULL, '2 ГБ', '2 ГБ', 1, '2022-01-11 05:06:34', '2022-01-11 05:06:34'),
(51, 4, '3-gb', NULL, NULL, '3 ГБ', '3 ГБ', 1, '2022-01-11 05:06:34', '2022-01-11 05:06:34'),
(52, 16, '1-vihod', NULL, NULL, '1 выход', '1 выход', 1, '2022-01-11 05:07:33', '2022-01-11 05:12:44'),
(53, 16, '2-vihoda', NULL, NULL, '2 выхода', '2 выхода', 1, '2022-01-11 05:07:33', '2022-01-11 05:12:44'),
(54, 16, '3-vihoda', NULL, NULL, '3 выхода', '3 выхода', 1, '2022-01-11 05:07:33', '2022-01-11 05:12:44'),
(55, 4, '4-gb', NULL, NULL, '4 ГБ', '3 ГБ', 1, '2022-02-08 17:45:39', '2022-02-08 17:45:39');

-- --------------------------------------------------------

--
-- Структура таблицы `filter_product`
--

CREATE TABLE `filter_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filter_product`
--

INSERT INTO `filter_product` (`id`, `filter_id`, `product_id`, `created_at`, `updated_at`) VALUES
(120, 47, 38, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_11_27_195011_create_categories_table', 1),
(2, '2021_12_02_074950_create_filters_table', 2),
(3, '2021_12_05_184125_create_curs_table', 3),
(4, '2021_12_05_182037_create_products_table', 4),
(5, '2021_12_02_080808_create_filter_product_table', 5),
(6, '2021_12_18_143532_create_resizes_table', 6),
(7, '2021_12_19_100554_create_sliders_table', 7),
(8, '2021_12_19_132608_create_companies_table', 8),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 9),
(10, '2014_10_12_000000_create_users_table', 10),
(11, '2021_12_22_074242_create_permissions_table', 11),
(12, '2021_12_22_074125_create_roles_table', 12),
(13, '2021_12_22_080411_create_permission_role_table', 13),
(14, '2022_01_16_144950_create_baskets_table', 14),
(15, '2022_01_21_110823_create_pages_table', 15),
(16, '2022_01_26_071755_create_services_table', 16),
(17, '2022_02_15_151839_create_category_product_table', 17);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags_ru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `tags_uk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `text_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `text_uk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `slug`, `name_ru`, `name_uk`, `description_ru`, `description_uk`, `tags_ru`, `tags_uk`, `text_ru`, `text_uk`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'stranitsa-1', 'О нас', 'Страница 1У', 'сео описание страницы 1', 'сео описание страницы 1У', '[\"смив\", \"врпвап\", \"вапв\"]', '[\"смив\", \"врпвап\", \"вапв\"]', NULL, '<p>впавы</p><p>апи</p><p>апи</p><p>&nbsp;</p><p>ы</p>', 1, '2022-01-21 11:59:01', '2022-02-03 21:25:05'),
(2, 'kontakti', 'Контакты', 'Контакты', NULL, NULL, NULL, NULL, '<p>&nbsp;</p><figure class=\"table\"><table><thead><tr><th><h4>Адрес:</h4></th><th><h4>Контакты:</h4></th><th><h4 style=\"text-align:right;\">График работы:</h4></th><th><h4>&nbsp;</h4></th></tr></thead><tbody><tr><td>ул. Одария 3, &nbsp;</td><td>(067)4170350</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Понедельник</span></td><td>Выходной</td></tr><tr><td>Радиорынок&nbsp;</td><td>(048)7439718</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Вторник</span></td><td>09:00-16:00</td></tr><tr><td>“Летучий Голландец”</td><td>(094)9472718</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Среда</span></td><td>09:00-16:00</td></tr><tr><td>Павильон №22</td><td>&nbsp;</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Четверг</span></td><td>09:00-16:00</td></tr><tr><td>г. Одесса, &nbsp;Украина</td><td>&nbsp;</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Пятница</span></td><td>09:00-16:00</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Суббота</span></td><td>09:00-16:00</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td><span style=\"background-color:rgb(255,255,255);color:rgb(85,85,85);\">Воскресенье</span></td><td>09:00-16:00</td></tr></tbody></table></figure><p>&nbsp;</p><p>&nbsp;</p>', '<p>Адрес:</p><p>Ул. Одария 3, Радиорынок “Летучий Голландец”</p><p>Павильон №22</p>', 0, '2022-01-28 19:41:44', '2022-02-09 18:40:45'),
(3, 'gla', 'Главная', 'Главная', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-28 19:44:07', '2022-01-28 19:53:46'),
(4, 'dosta', 'Доставка и оплата', 'Доставка и оплата', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-28 19:44:50', '2022-01-28 19:44:50'),
(5, 'rem', 'Ремонт и сервис', 'Ремонт и сервис', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-28 19:46:32', '2022-01-28 19:46:32');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(2, 'user:create', 'Создание пользователя', '2021-12-22 12:35:47', '2021-12-23 15:17:57'),
(3, 'user:update', 'Редактирование пользователя.', '2021-12-22 12:37:37', '2021-12-23 15:18:11'),
(5, 'user:delete', 'Удалять пользователя', '2021-12-24 17:34:55', '2021-12-24 17:34:55'),
(6, 'role:create', 'Создавать роль', '2021-12-24 17:35:25', '2021-12-24 17:35:25'),
(7, 'role:update', 'Обновлять роль', '2021-12-24 17:35:58', '2021-12-24 17:35:58'),
(8, 'role:delete', 'Удалять роль', '2021-12-24 17:36:20', '2021-12-24 17:36:20'),
(9, 'permission:create', 'Создавать права', '2021-12-24 17:36:55', '2021-12-24 17:36:55'),
(10, 'permission:update', 'Обновлять права', '2021-12-24 17:37:15', '2021-12-24 17:37:15'),
(11, 'permission:delete', 'Удалять права', '2021-12-24 17:37:44', '2021-12-24 17:37:44'),
(12, 'category:create', 'Создание категории', '2021-12-24 17:38:23', '2021-12-24 17:38:23'),
(13, 'category:update', 'Обновлять категорию', '2021-12-24 17:38:49', '2021-12-24 17:38:49'),
(14, 'category:delete', 'Удалять категорию', '2021-12-24 17:39:10', '2021-12-24 17:39:10'),
(15, 'product:create', 'Добавлять продукт', '2021-12-24 17:39:36', '2021-12-24 17:39:36'),
(16, 'product:update', 'Обновлять продукт', '2021-12-24 17:40:01', '2021-12-24 17:40:01'),
(17, 'product:delete', 'Удалять продукт', '2021-12-24 17:40:33', '2021-12-24 17:40:33'),
(18, 'filter:create', 'Создавать фильтр', '2021-12-24 17:41:05', '2021-12-24 17:41:05'),
(19, 'filter:update', 'Обновлять фильтр', '2021-12-24 17:41:29', '2021-12-24 17:41:29'),
(20, 'filter:delete', 'Удалять фильтр', '2021-12-24 17:41:49', '2021-12-24 17:41:49'),
(21, 'slider:create', 'Создавать слайдер', '2021-12-24 17:42:23', '2021-12-24 17:42:23'),
(22, 'slider:update', 'Обновлять слайдер', '2021-12-24 17:42:51', '2021-12-24 17:42:51'),
(23, 'slider:delete', 'Удалять слайдер', '2021-12-24 17:42:52', '2021-12-24 17:43:25'),
(24, 'curs:create', 'Создать валюту', '2021-12-24 17:44:06', '2021-12-24 17:44:06'),
(25, 'curs:update', 'Обновить валюту', '2021-12-24 17:44:37', '2021-12-24 17:44:37'),
(26, 'curs:delete', 'Удалить валюту', '2021-12-24 17:45:09', '2021-12-24 17:45:09'),
(27, 'resize:create', 'Создание размеров', '2021-12-24 17:46:06', '2021-12-24 17:46:06'),
(28, 'resize:update', 'Обновлять размер', '2021-12-24 17:47:21', '2021-12-24 17:47:21'),
(29, 'resize:delete', 'Удалять размер', '2021-12-24 17:47:55', '2021-12-24 17:47:55'),
(30, 'media:create', 'Создавать в медиа-редакторе', '2021-12-24 17:48:36', '2021-12-24 17:48:36'),
(31, 'media:delete', 'Удалять в медиа-редакторе', '2021-12-24 17:49:04', '2021-12-24 17:49:04'),
(32, 'company:create', 'Создавать компанию', '2021-12-24 17:50:09', '2021-12-24 17:50:09'),
(33, 'company:update', 'Обновлять компанию', '2021-12-24 17:50:33', '2021-12-24 17:50:33'),
(34, 'company:delete', 'Удалять компанию', '2021-12-24 17:50:59', '2021-12-24 17:50:59'),
(35, 'basket:create', 'Создание заказа', '2022-01-19 12:52:50', '2022-01-19 12:52:50'),
(36, 'basket:update', 'Редактировать заказ', '2022-01-19 12:53:22', '2022-01-19 12:53:22'),
(37, 'basket:delete', 'Удалить заказ', '2022-01-19 12:53:55', '2022-01-19 12:53:55'),
(38, 'page:create', 'Создать страницу', '2022-01-21 11:56:57', '2022-01-21 11:56:57'),
(39, 'page:update', 'Редактирование страницы', '2022-01-21 11:57:31', '2022-01-21 11:57:31'),
(40, 'page:delete', 'Удаление страницы', '2022-01-21 11:57:58', '2022-01-21 11:57:58'),
(41, 'service:create', 'Создавать доп.услугу', '2022-01-26 06:36:07', '2022-01-26 06:36:07'),
(42, 'service:update', 'Редактировать доп.услугу', '2022-01-26 06:36:39', '2022-01-26 06:36:39'),
(43, 'service:delete', 'Удалять доп.услугу', '2022-01-26 06:37:02', '2022-01-26 06:37:02');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, NULL, NULL),
(4, 5, 1, NULL, NULL),
(5, 6, 1, NULL, NULL),
(6, 7, 1, NULL, NULL),
(7, 8, 1, NULL, NULL),
(8, 9, 1, NULL, NULL),
(9, 10, 1, NULL, NULL),
(10, 11, 1, NULL, NULL),
(11, 12, 1, NULL, NULL),
(12, 13, 1, NULL, NULL),
(13, 14, 1, NULL, NULL),
(14, 15, 1, NULL, NULL),
(15, 16, 1, NULL, NULL),
(16, 17, 1, NULL, NULL),
(17, 18, 1, NULL, NULL),
(18, 19, 1, NULL, NULL),
(19, 20, 1, NULL, NULL),
(20, 21, 1, NULL, NULL),
(21, 22, 1, NULL, NULL),
(22, 23, 1, NULL, NULL),
(23, 24, 1, NULL, NULL),
(24, 25, 1, NULL, NULL),
(25, 26, 1, NULL, NULL),
(26, 27, 1, NULL, NULL),
(27, 28, 1, NULL, NULL),
(28, 29, 1, NULL, NULL),
(29, 30, 1, NULL, NULL),
(30, 31, 1, NULL, NULL),
(31, 32, 1, NULL, NULL),
(32, 33, 1, NULL, NULL),
(33, 34, 1, NULL, NULL),
(34, 2, 1, NULL, NULL),
(35, 2, 3, NULL, NULL),
(36, 3, 3, NULL, NULL),
(37, 5, 3, NULL, NULL),
(38, 6, 3, NULL, NULL),
(39, 7, 3, NULL, NULL),
(40, 8, 3, NULL, NULL),
(41, 12, 3, NULL, NULL),
(42, 13, 3, NULL, NULL),
(43, 14, 3, NULL, NULL),
(44, 15, 3, NULL, NULL),
(45, 16, 3, NULL, NULL),
(46, 17, 3, NULL, NULL),
(47, 18, 3, NULL, NULL),
(48, 19, 3, NULL, NULL),
(49, 20, 3, NULL, NULL),
(50, 21, 3, NULL, NULL),
(51, 22, 3, NULL, NULL),
(52, 23, 3, NULL, NULL),
(53, 24, 3, NULL, NULL),
(54, 25, 3, NULL, NULL),
(55, 26, 3, NULL, NULL),
(56, 27, 3, NULL, NULL),
(57, 28, 3, NULL, NULL),
(58, 29, 3, NULL, NULL),
(59, 30, 3, NULL, NULL),
(60, 31, 3, NULL, NULL),
(61, 32, 3, NULL, NULL),
(62, 33, 3, NULL, NULL),
(63, 34, 3, NULL, NULL),
(65, 35, 1, NULL, NULL),
(66, 36, 1, NULL, NULL),
(67, 37, 1, NULL, NULL),
(68, 38, 1, NULL, NULL),
(69, 39, 1, NULL, NULL),
(70, 40, 1, NULL, NULL),
(71, 41, 1, NULL, NULL),
(72, 42, 1, NULL, NULL),
(73, 43, 1, NULL, NULL),
(74, 38, 3, NULL, NULL),
(75, 39, 3, NULL, NULL),
(76, 40, 3, NULL, NULL),
(77, 41, 3, NULL, NULL),
(78, 42, 3, NULL, NULL),
(79, 43, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags_ru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `tags_uk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `text_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `text_uk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `count` int(11) NOT NULL DEFAULT '0',
  `price` float(11,2) NOT NULL DEFAULT '0.00',
  `curs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skidka` float(11,2) NOT NULL DEFAULT '0.00',
  `dop_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('product','page') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `slug`, `name_ru`, `name_uk`, `description_ru`, `description_uk`, `tags_ru`, `tags_uk`, `text_ru`, `text_uk`, `count`, `price`, `curs_id`, `skidka`, `dop_products`, `service_id`, `img`, `visible`, `type`, `created_at`, `updated_at`) VALUES
(38, 25, 'ustym-4k-pro', 'Ustym 4K Pro', 'Ustym 4K Pro', 'gggggggggggggggggggggggggkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 'gggggggggggggggggggggggggkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', NULL, NULL, '<h2 style=\"text-align:center;\"><strong>Технические характеристики uClan Ustym 4K PRO:</strong></h2><p>Комбинация 2-х тюнеров: спутниковый S2 или S2X и вход для наземного или кабельного цифрового ТВ T2/C</p><p>Многоядерный 64-битный (4x 1,6 ГГц) ARM Cortex A53 Hisilicon Hi3798MV200 процессор с 15000 DMIPS</p><p>Видеоускоритель: многоядерный высокопроизводительный графический процессор Mali-450</p><p>Для каналов спутникового ТВ (S2/S2X) применен чипсет: быстрый тюнер RDA5815m + Silabs Si2166-D60 демодулятор</p><p>Для каналов наземного и кабельного ТВ (DVBT2/C) применен чипсет: быстрый тюнер Maxlinear MXL608 + Altobeam ATBM7821 демодулятор</p><p>8 ГБ eMMC флеш память</p><p>1 ГБ оперативная память</p><p>4-х цифровой 7-cегментный фронтальный дисплей белого цвета</p><p>Высокоскоростная беспроводная сеть 300 Мбит WiFi (2 внешние антенны 5dbi)</p><p>Высокоскоростная проводная сеть 1Гбит (LAN)</p><h2 style=\"text-align:center;\"><strong>Технические особенности:</strong></h2><p>DualBoot (возможность выбора загрузки операционной системы)</p><p>Открытая операционная система ОС Linux Enigma2</p><p>Проприетарная операционная система ОС Linux Denys_OS</p><p>Полная поддержка HW MPEG-2, MPEG-4 AVC, H.264 и H.265 HEVC</p><p>Поддержка Multistream и T2MI</p><p>Совместимость с DiSEqC 1.0,1.1, 1.2 и 1.3 (USALS) и Unicable</p><p>1x HDTV 2.0a TX выход с HDCP 2,2 до 4K @ 60 Гц</p><p>Разрешающая способность видеовыхода: 4K / 2K UHD 2160p HDR, Full HD 1080p, 1080i, 720p, 576p, 576i и True 3D</p><p>HDR 10бит и HLG</p><p>Поддержка систем PAL / NTSC</p><p>Расширенный EPG и резервирование таймеров для программ в EPG</p><p>Поддержка XMLTV EPG в DVB режиме (электронный программный гид)</p><p>Скорость смены каналов меньше 1 секунды</p><p>Поддержка множества языковых аудидорожек</p><p>PIP HD и UHD (картинка в картинке)</p><p>Blindscan (слепой поиск каналов)</p><p>Поддержка Dolby Digital AC3, Dolby Digital Plus</p><p>Поддержка подключения к порталам (WEB mode/Simply API)</p><p>Поддержка подключения к IPTV серверам (.m3u .m3u8)</p><p>Поддержка подключения к WEB порталам</p><p>Поддержка XMLTV EPG в IPTV режимах (электронный программный гид)</p><p>Браузер Chromium с поддержкой мыши</p><p>Поддержка воспроизведения ffmpeq HW</p><p>WEB интерфейс для управления настройками</p><p>Воспроизведение 2160P медиа H.264 и H.265 HEVC</p><p>Запись и TIMESHIFT в один момент (опционально)</p><p>Онлайн обновление программного обеспечения</p><p>PVR запись передач (* необязательно)</p><p>Потребление 0,5 Вт в режиме ожидания</p><p>Адаптер питания 12в 2А</p><p>Размеры 220мм/125мм/40мм</p><p>CE сертификат&nbsp;</p>', '<h2 style=\"text-align:center;\"><strong>Технические характеристики uClan Ustym 4K PRO:</strong></h2><p>Комбинация 2-х тюнеров: спутниковый S2 или S2X и вход для наземного или кабельного цифрового ТВ T2/C</p><p>Многоядерный 64-битный (4x 1,6 ГГц) ARM Cortex A53 Hisilicon Hi3798MV200 процессор с 15000 DMIPS</p><p>Видеоускоритель: многоядерный высокопроизводительный графический процессор Mali-450</p><p>Для каналов спутникового ТВ (S2/S2X) применен чипсет: быстрый тюнер RDA5815m + Silabs Si2166-D60 демодулятор</p><p>Для каналов наземного и кабельного ТВ (DVBT2/C) применен чипсет: быстрый тюнер Maxlinear MXL608 + Altobeam ATBM7821 демодулятор</p><p>8 ГБ eMMC флеш память</p><p>1 ГБ оперативная память</p><p>4-х цифровой 7-cегментный фронтальный дисплей белого цвета</p><p>Высокоскоростная беспроводная сеть 300 Мбит WiFi (2 внешние антенны 5dbi)</p><p>Высокоскоростная проводная сеть 1Гбит (LAN)</p><h2 style=\"text-align:center;\"><strong>Технические особенности:</strong></h2><p>DualBoot (возможность выбора загрузки операционной системы)</p><p>Открытая операционная система ОС Linux Enigma2</p><p>Проприетарная операционная система ОС Linux Denys_OS</p><p>Полная поддержка HW MPEG-2, MPEG-4 AVC, H.264 и H.265 HEVC</p><p>Поддержка Multistream и T2MI</p><p>Совместимость с DiSEqC 1.0,1.1, 1.2 и 1.3 (USALS) и Unicable</p><p>1x HDTV 2.0a TX выход с HDCP 2,2 до 4K @ 60 Гц</p><p>Разрешающая способность видеовыхода: 4K / 2K UHD 2160p HDR, Full HD 1080p, 1080i, 720p, 576p, 576i и True 3D</p><p>HDR 10бит и HLG</p><p>Поддержка систем PAL / NTSC</p><p>Расширенный EPG и резервирование таймеров для программ в EPG</p><p>Поддержка XMLTV EPG в DVB режиме (электронный программный гид)</p><p>Скорость смены каналов меньше 1 секунды</p><p>Поддержка множества языковых аудидорожек</p><p>PIP HD и UHD (картинка в картинке)</p><p>Blindscan (слепой поиск каналов)</p><p>Поддержка Dolby Digital AC3, Dolby Digital Plus</p><p>Поддержка подключения к порталам (WEB mode/Simply API)</p><p>Поддержка подключения к IPTV серверам (.m3u .m3u8)</p><p>Поддержка подключения к WEB порталам</p><p>Поддержка XMLTV EPG в IPTV режимах (электронный программный гид)</p><p>Браузер Chromium с поддержкой мыши</p><p>Поддержка воспроизведения ffmpeq HW</p><p>WEB интерфейс для управления настройками</p><p>Воспроизведение 2160P медиа H.264 и H.265 HEVC</p><p>Запись и TIMESHIFT в один момент (опционально)</p><p>Онлайн обновление программного обеспечения</p><p>PVR запись передач (* необязательно)</p><p>Потребление 0,5 Вт в режиме ожидания</p><p>Адаптер питания 12в 2А</p><p>Размеры 220мм/125мм/40мм</p><p>CE сертификат&nbsp;</p>', 190, 90.00, 16, 0.00, '[38,40]', 1, '[{\"img\":\"\\/storage\\/products\\/ustym 4k pro\\/08-58-53-03-02-2022.jpg\",\"main\":true},{\"img\":\"\\/storage\\/products\\/ustym 4k pro\\/08-58-51-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/ustym 4k pro\\/08-58-49-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/ustym 4k pro\\/08-58-23-03-02-2022.jpg\",\"main\":false}]', 1, 'product', '2022-02-02 08:05:11', '2022-02-15 18:29:41'),
(39, 40, 'uclan-x96-max', 'uClan X96 max 2Gb/16Gb', 'uclan x96 Max', 'Обновленная модель X96Max с новым, более производительным процессором Amlogic S905X3, прямого наследника S905X2', 'обновленная модель X96Max с новым, более производительным процессором Amlogic S905X3, прямого наследника S905X2', NULL, NULL, '<p><strong>Android TV приставка uClan X96Max&nbsp;</strong>– это обновленная модель&nbsp;<strong>X96Max</strong>&nbsp;с новым, более производительным процессором&nbsp;Amlogic S905X3,&nbsp;прямого наследника S905X2. В&nbsp;новом чипе используется процессор ARM&nbsp;<strong>Cortex-A55</strong>,&nbsp;что&nbsp;существенно повышает производительность ,по сравнению с&nbsp;<strong>Cortex-A53</strong>, используемом в S905X2.</p><p>Процессор&nbsp;<strong>Amlogic S905X3</strong>&nbsp;с&nbsp;ядрами <strong>ARM Cortex-A55</strong>, также включает в себя графический&nbsp;процессор&nbsp;<strong>ARM G31 MP2</strong>, который обеспечивает хорошую производительность, а также декодирование видео 4K.&nbsp;Остальные технические характеристики также очень похожи на характеристики приставок с S905X2. В качестве базовой операционной системы используется&nbsp;<strong>Android 9.0.</strong></p><figure class=\"table\"><table><tbody><tr><td colspan=\"3\"><strong>uClan X96Max (S905X3)</strong></td></tr><tr><td>Процессор</td><td colspan=\"2\">Amlogic S905X3 64-разрядный четырехъядерный процессор ARM® Cortex™ A55 процессор</td></tr><tr><td>Графический процессор</td><td colspan=\"2\">G31™ MP2 GPU процессор</td></tr><tr><td>Память</td><td colspan=\"2\">LPDDR4: 2 ГБ&nbsp;</td></tr><tr><td>Флэш-память</td><td colspan=\"2\">EMMC: 16 ГБ</td></tr><tr><td>Wi-Fi</td><td colspan=\"2\">IEEE 802,11 a/b/g/n/ac; 2,4G/5G</td></tr><tr><td>Bluetooth</td><td colspan=\"2\">&nbsp;-</td></tr><tr><td>&nbsp;</td><td colspan=\"2\">&nbsp;</td></tr><tr><td rowspan=\"6\">I/O</td><td>1 * HDMI</td><td>HDMI 2,1, поддержка HDMI CEC, динамический HDR и 8 K x 4 K 24 Максимальное разрешение выхода</td></tr><tr><td>1 * AV OUT</td><td>Выход стандартного определения 480i/576i</td></tr><tr><td>2 * USB</td><td>1 * USB 3,0; 1 * USB 2,0</td></tr><tr><td>1 * ИК-ресивер</td><td>Дистанционный ресивер для подключения</td></tr><tr><td>1 * RJ45</td><td>Интерфейс Ethernet Поддержка 10/100Mbps или 1000Mbps</td></tr><tr><td>1 * TF карты</td><td>Поддержка 4 ГБ/8 ГБ/16 ГБ/32 ГБ/64 ГБ</td></tr><tr><td>Мощность</td><td colspan=\"2\">DC 5В/2A;</td></tr><tr><td colspan=\"3\">Программное обеспечение</td></tr><tr><td>OS</td><td colspan=\"2\">Android 9,0</td></tr><tr><td>Видео</td><td colspan=\"2\">-Amlogic Video Engine (AVE) с выделенными аппаратными декодерами и кодировщиками<br>-Поддержка мульти-видео декодера до 4x1080 P 60fps<br>-Поддержка нескольких \"защищенных\" сеансов декодирования видео и одновременное декодирование и кодирование<br>-Декодирование видео/изображения<br>-Профиль VP9-2 до 8 K x 4 K 24 fps<br>-H.265 HEVC MP-10 L5.1 до 8 K x 4 K 24 fps<br>-AVS2-P2 профиль до 8 K x 4 K 24 fps<br>-H.264 AVC HP L5.1 до 4 K x 2 K 30fps<br>-MPEG-4 ASP L5 до 1080 P 60 кадров в секунду (ISO-14496)<br>-WMV/VC-1 SP/MP/AP до 1080 P 60fps<br>-AVS-P16 (AVS +)/AVS-P2 JiZhun профиль до 1080 P 60fps<br>-MPEG-2 МП/HL до 1080 P 60 кадров в секунду (ISO-13818)<br>-MPEG-1 МП/HL до 1080 P 60 кадров в секунду (ISO-11172)<br>-RealVideo 8/9/10 до 1080 P 60fps<br>-Поддержка нескольких языков и нескольких форматов подзаголовка видео<br>-Декодирование неограниченного разрешения пикселей MJPEG и JPEG (ISO/IEC-10918)<br>-Поддержка эффектов JPEG thumbnail, scaling, rotation и transition<br>-Поддерживает *. mkv, *. wmv *. mpg, *. mpeg, *. dat, *. avi, *. mov *. iso, *. mp4, *. rm и *. jpg форматов файлов</td></tr><tr><td>Аудио</td><td colspan=\"2\">Поддерживает MP3, AAC, WMA, RM, FLAC, Ogg и программируемый с 7,1/5,1 вниз-смешивание<br>С низким энергопотреблением VAD<br>Встроенный Серийный Цифровой аудио SPDIF/IEC958 вход/выход и PCM вход/выход<br>3 встроенных порта TDM/PCM/I2S с режимом TDM/PCM до 384 кГц x 32 бит x 16 бит или 96 кГц x 32 бит x 32 бит и режим I2S до 384 кГц x 32 бит x 16ch<br>Цифровой микрофон PDM вход с программируемым CIC, LPF &amp; HPF, поддержка до 8 DMICs<br>Встроенный стерео аудио ЦАП<br>Поддерживает параллельный двойной аудио стерео выход канала с комбинацией аналога + PCM или I2S + PCM</td></tr><tr><td>Изображение</td><td colspan=\"2\">HD JPEG, BMP, GIF, PNG, TIF</td></tr><tr><td>Язык</td><td colspan=\"2\">Английский, французский, немецкий, испанский, итальянский и т. д.</td></tr><tr><td colspan=\"3\">&nbsp;</td></tr><tr><td>Онлайн</td><td colspan=\"2\">Просмотр все видео-сайтов, поддержка Netflix, Hulu, Flixster, Youtube и т. д.</td></tr><tr><td>Приложения</td><td colspan=\"2\">Приложения свободно загружаются в android market, amazon, app store и т. д.</td></tr><tr><td>Накопители</td><td colspan=\"2\">Локальное воспроизведение мультимедиа, Поддержка HDD, U Disck, tf-карты.</td></tr><tr><td>Общение</td><td colspan=\"2\">Поддержка SKYPE, MSN, facebook, twitter, QQ и т. д.</td></tr><tr><td>Другое</td><td colspan=\"2\">Поддержка электронной почты<br>Поддержка DLNA функции<br>Поддержка беспроводной мыши/клавиатуры 2,4G</td></tr></tbody></table></figure>', '<p><strong>Android TV приставка uClan X96Max&nbsp;</strong>– это обновленная модель&nbsp;<strong>X96Max</strong>&nbsp;с новым, более производительным процессором&nbsp;Amlogic S905X3,&nbsp;прямого наследника S905X2. В&nbsp;новом чипе используется процессор ARM&nbsp;<strong>Cortex-A55</strong>,&nbsp;что&nbsp;существенно повышает производительность ,по сравнению с&nbsp;<strong>Cortex-A53</strong>, используемом в S905X2.</p><p>Процессор&nbsp;<strong>Amlogic S905X3</strong>&nbsp;с&nbsp;ядрами <strong>ARM Cortex-A55</strong>, также включает в себя графический&nbsp;процессор&nbsp;<strong>ARM G31 MP2</strong>, который обеспечивает хорошую производительность, а также декодирование видео 4K.&nbsp;Остальные технические характеристики также очень похожи на характеристики приставок с S905X2. В качестве базовой операционной системы используется&nbsp;<strong>Android 9.0</strong>&nbsp;а в будущем ожидается обновление до&nbsp;<strong>Android Q</strong></p><p><strong>- 2/16GB, WIFI 2.4G, LAN 100M (без Bluetooth)</strong></p><p><strong>- 4/32GB, WIFI 2.4G + 5G, BT4.1, LAN&nbsp;100Mbps или 1000Mbps&nbsp;(опционально)</strong></p><p><strong>- 4/64GB, WIFI 2.4G + 5G, BT4.1, LAN 100Mbps или 1000Mbps&nbsp;(опционально)</strong></p><figure class=\"table\"><table><tbody><tr><td colspan=\"3\"><strong>uClan X96Max (S905X3)</strong></td></tr><tr><td>Процессор</td><td colspan=\"2\">Amlogic S905X3 64-разрядный четырехъядерный процессор ARM® Cortex™ A55 процессор</td></tr><tr><td>Графический процессор</td><td colspan=\"2\">G31™ MP2 GPU процессор</td></tr><tr><td>Память</td><td colspan=\"2\">LPDDR4: 2 ГБ/4 ГБ</td></tr><tr><td>Флэш-память</td><td colspan=\"2\">EMMC: 16/32/64 ГБ</td></tr><tr><td>Wi-Fi</td><td colspan=\"2\">IEEE 802,11 a/b/g/n/ac; 2,4G/5G</td></tr><tr><td>Bluetooth</td><td colspan=\"2\">BT для 4/32 модели; Поддержка голосового пульта дистанционного управления</td></tr><tr><td>&nbsp;</td><td colspan=\"2\">&nbsp;</td></tr><tr><td rowspan=\"6\">I/O</td><td>1 * HDMI</td><td>HDMI 2,1, поддержка HDMI CEC, динамический HDR и 8 K x 4 K 24 Максимальное разрешение выхода</td></tr><tr><td>1 * AV OUT</td><td>Выход стандартного определения 480i/576i</td></tr><tr><td>2 * USB</td><td>1 * USB 3,0; 1 * USB 2,0</td></tr><tr><td>1 * ИК-ресивер</td><td>Дистанционный ресивер для подключения</td></tr><tr><td>1 * RJ45</td><td>Интерфейс Ethernet Поддержка 10/100Mbps или 1000Mbps</td></tr><tr><td>1 * TF карты</td><td>Поддержка 4 ГБ/8 ГБ/16 ГБ/32 ГБ/64 ГБ</td></tr><tr><td>Мощность</td><td colspan=\"2\">DC 5В/2A;</td></tr><tr><td colspan=\"3\">Программное обеспечение</td></tr><tr><td>OS</td><td colspan=\"2\">Android 9,0</td></tr><tr><td>Видео</td><td colspan=\"2\">-Amlogic Video Engine (AVE) с выделенными аппаратными декодерами и кодировщиками<br>-Поддержка мульти-видео декодера до 4x1080 P 60fps<br>-Поддержка нескольких \"защищенных\" сеансов декодирования видео и одновременное декодирование и кодирование<br>-Декодирование видео/изображения<br>-Профиль VP9-2 до 8 K x 4 K 24 fps<br>-H.265 HEVC MP-10 L5.1 до 8 K x 4 K 24 fps<br>-AVS2-P2 профиль до 8 K x 4 K 24 fps<br>-H.264 AVC HP L5.1 до 4 K x 2 K 30fps<br>-MPEG-4 ASP L5 до 1080 P 60 кадров в секунду (ISO-14496)<br>-WMV/VC-1 SP/MP/AP до 1080 P 60fps<br>-AVS-P16 (AVS +)/AVS-P2 JiZhun профиль до 1080 P 60fps<br>-MPEG-2 МП/HL до 1080 P 60 кадров в секунду (ISO-13818)<br>-MPEG-1 МП/HL до 1080 P 60 кадров в секунду (ISO-11172)<br>-RealVideo 8/9/10 до 1080 P 60fps<br>-Поддержка нескольких языков и нескольких форматов подзаголовка видео<br>-Декодирование неограниченного разрешения пикселей MJPEG и JPEG (ISO/IEC-10918)<br>-Поддержка эффектов JPEG thumbnail, scaling, rotation и transition<br>-Поддерживает *. mkv, *. wmv *. mpg, *. mpeg, *. dat, *. avi, *. mov *. iso, *. mp4, *. rm и *. jpg форматов файлов</td></tr><tr><td>Аудио</td><td colspan=\"2\">Поддерживает MP3, AAC, WMA, RM, FLAC, Ogg и программируемый с 7,1/5,1 вниз-смешивание<br>С низким энергопотреблением VAD<br>Встроенный Серийный Цифровой аудио SPDIF/IEC958 вход/выход и PCM вход/выход<br>3 встроенных порта TDM/PCM/I2S с режимом TDM/PCM до 384 кГц x 32 бит x 16 бит или 96 кГц x 32 бит x 32 бит и режим I2S до 384 кГц x 32 бит x 16ch<br>Цифровой микрофон PDM вход с программируемым CIC, LPF &amp; HPF, поддержка до 8 DMICs<br>Встроенный стерео аудио ЦАП<br>Поддерживает параллельный двойной аудио стерео выход канала с комбинацией аналога + PCM или I2S + PCM</td></tr><tr><td>Изображение</td><td colspan=\"2\">HD JPEG, BMP, GIF, PNG, TIF</td></tr><tr><td>Язык</td><td colspan=\"2\">Английский, французский, немецкий, испанский, итальянский и т. д.</td></tr><tr><td colspan=\"3\">&nbsp;</td></tr><tr><td>Онлайн</td><td colspan=\"2\">Просмотр все видео-сайтов, поддержка Netflix, Hulu, Flixster, Youtube и т. д.</td></tr><tr><td>Приложения</td><td colspan=\"2\">Приложения свободно загружаются в android market, amazon, app store и т. д.</td></tr><tr><td>Накопители</td><td colspan=\"2\">Локальное воспроизведение мультимедиа, Поддержка HDD, U Disck, tf-карты.</td></tr><tr><td>Общение</td><td colspan=\"2\">Поддержка SKYPE, MSN, facebook, twitter, QQ и т. д.</td></tr><tr><td>Другое</td><td colspan=\"2\">Поддержка электронной почты<br>Поддержка DLNA функции<br>Поддержка беспроводной мыши/клавиатуры 2,4G</td></tr></tbody></table></figure>', 111, 36.00, 16, 0.00, NULL, 2, '[{\"img\":\"\\/storage\\/products\\/x96\\/09-04-31-03-02-2022.jpg\",\"main\":true},{\"img\":\"\\/storage\\/products\\/x96\\/09-04-26-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-56-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-53-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-03-03-02-2022.jpg\",\"main\":false}]', 1, 'product', '2022-02-02 08:26:15', '2022-02-03 16:12:43'),
(40, 25, 'ustym-4k-ott-premium', 'Ustym 4K OTT Premium', 'Ustym 4K OTT Premium', 'Новый продукт uClan Ustym 4K OTT Premium получил отлично зарекомендовавшее себя программное обеспечение Denys_OS. Приставка укомплектована новым, ярким пультом дистанционного управления uClan Premium v4.0', 'Новый продукт uClan Ustym 4K OTT Premium получил отлично зарекомендовавшее себя программное обеспечение Denys_OS. Приставка укомплектована новым, ярким пультом дистанционного управления uClan Premium v4.0', NULL, NULL, '<p>Новый продукт <strong>uClan Ustym 4K OTT </strong>Premium получил&nbsp;отлично зарекомендовавшее себя программное обеспечение <strong>Denys_OS</strong>. Приставка укомплектована новым, ярким пультом&nbsp;дистанционного управления <strong>uClan Premium v4.0</strong>. Данная модель предназначена для работы в сети интернет, и поддерживает все возможности предыдущих IPTV моделей компании uClan. Работа с интернет порталами, плейлистами, EPG&nbsp; из интернет, WEB интерфейс для управления настройками, широкие возможности гибких настроек пользователя позволят настроить бокс по своему вкусу. Устройство интересно также для операторов, предоставляющих услуги ОТТ. Сборка приставки произведена на одном из лидирующих предприятий КНР, собирающем ТВ боксы для лучших мировых брендов, и обеспечивает высочайшее качество исполнения.</p><h3><strong>4K UltraHD, H.265, 1ГБ ОЗУ/8ГБ Flash eMMC, Stalker, IPTV, WEB Browser, uClan Premium RCU v4.0:</strong></h3><p>С новым&nbsp;<strong>uClan Ustym 4K OTT Premium</strong>&nbsp;вы получите приставку на стабильной и быстрой операционной системе Linux с четырехъядерным 64-разрядным процессором и разрешением UltraHD 4K.&nbsp;С поддержкой порталов и веб-браузера Chromium!</p><p>Приставка характеризуется мощным аппаратным обеспечением и широким спектром развлекательных возможностей. Она поддерживает общие функции, которые должен иметь современный IPTV-бокс.</p><p>&nbsp;</p><h3><strong>Аппаратные средства и технологии внутри uClan Ustym 4K OTT Premium:</strong></h3><p>Аппаратное обеспечение содержит самое современное оборудование, с помощью которого вы можете удовлетворить практически все ваши требования для IPTV.&nbsp;Установлен 64-разрядный процессор Hisilicon, а также многоядерный графический процессор. Основная память объемом 1 гигабайт и флэш-память емкостью 8 гигабайт eMMC. Оборудование вместе с операционной системой на базе LINUX обеспечивает не только плавное воспроизведение контента 4K, но также феноменально быстрое время загрузки и быструю навигацию по многоязычным меню.</p><h3><strong>Основные характеристики:</strong></h3><p>- Hisilicon&nbsp;<strong>Hi3798MV200</strong></p><p>- Четырёхъядерный процессор 64 бит (4x 1,6 ГГц) 15000 DMIPS</p><p>- Многоядерный высокопроизводительный графический процессор</p><p>- 8Гб флэш-памяти eMMC</p><p>- ОЗУ 1 ГБ</p><p>- Быстрое время загрузки</p><p>- LAN Ethernet 100 Мбит/с</p><p>- HDMI 2.0a CEC</p><p>- 2 x USB 2.0 порта</p><p>- Инфракрасный приемник для скрытой установки</p><p>- Поддерживает HDMI CEC</p><p>-&nbsp;Обучаемый пульт <strong>uClan Premium RCU</strong> v4.0 ДУ&nbsp;с функцией виртуальной мыши</p><h3><strong>Список поставки:</strong></h3><p>- приставка uClan Ustym 4K OTT Premium</p><p>-&nbsp;программируемый пульт&nbsp;дистанционного&nbsp;управления uClan Premium RCU v4.0</p><p>- адаптер питания 12 вольт</p><p>- кабель HDMI</p><p>- ИК инфракрасный приемник</p><p>- Инструкция по эксплуатации (английский, польский, русский, украинский)</p><p>- 2 батареи</p>', '<p>Новый продукт <strong>uClan Ustym 4K OTT </strong>Premium получил&nbsp;отлично зарекомендовавшее себя программное обеспечение <strong>Denys_OS</strong>. Приставка укомплектована новым, ярким пультом&nbsp;дистанционного управления <strong>uClan Premium v4.0</strong>. Данная модель предназначена для работы в сети интернет, и поддерживает все возможности предыдущих IPTV моделей компании uClan. Работа с интернет порталами, плейлистами, EPG&nbsp; из интернет, WEB интерфейс для управления настройками, широкие возможности гибких настроек пользователя позволят настроить бокс по своему вкусу. Устройство интересно также для операторов, предоставляющих услуги ОТТ. Сборка приставки произведена на одном из лидирующих предприятий КНР, собирающем ТВ боксы для лучших мировых брендов, и обеспечивает высочайшее качество исполнения.</p><h3><strong>4K UltraHD, H.265, 1ГБ ОЗУ/8ГБ Flash eMMC, Stalker, IPTV, WEB Browser, uClan Premium RCU v4.0:</strong></h3><p>С новым&nbsp;<strong>uClan Ustym 4K OTT Premium</strong>&nbsp;вы получите приставку на стабильной и быстрой операционной системе Linux с четырехъядерным 64-разрядным процессором и разрешением UltraHD 4K.&nbsp;С поддержкой порталов и веб-браузера Chromium!</p><p>Приставка характеризуется мощным аппаратным обеспечением и широким спектром развлекательных возможностей. Она поддерживает общие функции, которые должен иметь современный IPTV-бокс.</p><p>&nbsp;</p><h3><strong>Аппаратные средства и технологии внутри uClan Ustym 4K OTT Premium:</strong></h3><p>Аппаратное обеспечение содержит самое современное оборудование, с помощью которого вы можете удовлетворить практически все ваши требования для IPTV.&nbsp;Установлен 64-разрядный процессор Hisilicon, а также многоядерный графический процессор. Основная память объемом 1 гигабайт и флэш-память емкостью 8 гигабайт eMMC. Оборудование вместе с операционной системой на базе LINUX обеспечивает не только плавное воспроизведение контента 4K, но также феноменально быстрое время загрузки и быструю навигацию по многоязычным меню.</p><h3><strong>Основные характеристики:</strong></h3><p>- Hisilicon&nbsp;<strong>Hi3798MV200</strong></p><p>- Четырёхъядерный процессор 64 бит (4x 1,6 ГГц) 15000 DMIPS</p><p>- Многоядерный высокопроизводительный графический процессор</p><p>- 8Гб флэш-памяти eMMC</p><p>- ОЗУ 1 ГБ</p><p>- Быстрое время загрузки</p><p>- LAN Ethernet 100 Мбит/с</p><p>- HDMI 2.0a CEC</p><p>- 2 x USB 2.0 порта</p><p>- Инфракрасный приемник для скрытой установки</p><p>- Поддерживает HDMI CEC</p><p>-&nbsp;Обучаемый пульт <strong>uClan Premium RCU</strong> v4.0 ДУ&nbsp;с функцией виртуальной мыши</p>', 111, 75.00, 16, 0.00, NULL, 1, '[{\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-02-09-03-02-2022.jpg\",\"main\":true},{\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-00-54-03-02-2022.png\",\"main\":false},{\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-01-02-03-02-2022.png\",\"main\":false},{\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-00-58-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/ustym 4k ott premium\\/09-00-28-03-02-2022.jpg\",\"main\":false}]', 1, 'product', '2022-02-02 08:43:54', '2022-02-03 08:17:43'),
(42, 25, 'uclan-b6-fullhd', 'uClan b6 full HD', 'uclan b6 fullhd', NULL, 'Спутниковый приемник uClan B6 Full HD выполнен на популярнейшем чипсете GX6605S, работает под управлением фирменного программного обеспечения. Также доступны прошивки от клона: OCTAGON SX8 HD ONE MAGIC.', NULL, NULL, '<p>Спутниковый ресивер <strong>uClan B6 Full HD</strong> - это самый популярный спутниковый тюнер начиная с 2017 года.</p><p>Помимо низкой цены устройство характеризует хорошее качество изображения как на SD, так и на HD каналах а также высокая чувствительность приёмного тракта входного тюнера.</p><p>Необходимо отметить, что приемник можно использовать как IPTV / OTT приставку, ссылки на плейлисты и сами плейлисты можно загружать с USB носителя, в .m3u формате.&nbsp;</p><p>Спутниковый приемник uClan B6 Full HD выполнен на популярнейшем чипсете GX6605S, работает под управлением фирменного программного обеспечения. Т</p><p>Разработчики программного обеспечения uClan реализовали в данной модели низшего ценового уровня множество нетипичных данному уровню приёмников функций, главное: большинство из них было реализовано первыми на рынке.</p><p>Именно поэтому множество любителей-экспериментаторов в течении нескольких лет пытаются комбинировать куски кода, используя ПО uClan B6 Full HD как базу для создания своих кустарных \"прошивок\".</p><p>Из типичных функций, здесь присутствует поддержка самых популярных типов USB-Wi-Fi адаптеров (чипсеты 5370/7601), поддержка USB-3G модемов, USB-LAN адаптеров и Dolby Digital AC3.&nbsp;Multistream потоки сканируются и работают без проблем.</p><p>Список типов поддерживаемых USB-LAN адаптеров:&nbsp;88772B, SR9800, SR9700, RD9700, RTL8152B, RTL8153</p><p>Несмотря на компактные габариты тюнера разработчикам удалось избежать перегрева устройства. Также производитель предусмотрел «скрытую»&nbsp;установку ресивера, для этого есть соответствующее крепление в комплекте поставки и выносной ИК-приемник.&nbsp;</p><p>Также отметим корректную работу приставки с «мотором», что, несомненно, порадует энтузиастов спутникового ТВ. Пользоваться ресивером не составит труда даже новичкам – залогом этого выступает удобное меню с поддержкой украинского и русского языков. Почитателей марки uClan (U2C) порадует удобный пульт дистанционного управления, в привычном уже для U2C стиле, что интересно: пульты моделей линеек B6 и Denys совместимы и работают отлично.</p><p>Прогрессивные мультимедийные возможности поддерживают воспроизведение видео с внешних USB накопителей, роликов с YouTube с качеством до 1080р, воспроизведение сетевых IPTV потоков, кинотеатров и IPTV.</p><h2><strong>Характеристики</strong></h2><figure class=\"table\"><table><tbody><tr><td><span style=\"color:rgb(93,93,93);\">Процессор</span></td><td><span style=\"color:rgb(93,93,93);\">NationalChip GX6605S</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">Разрешающая способность видеовыхода</span></td><td><span style=\"color:rgb(93,93,93);\">Full HD</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">WiFi (встроенный)</span></td><td><span style=\"color:rgb(93,93,93);\">Поддержка USB-WiFi</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">LAN Ethernet RJ45</span></td><td><span style=\"color:rgb(93,93,93);\">Без LAN</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">Антенный вход</span></td><td><span style=\"color:rgb(93,93,93);\">Один DVBS/S2 вход (спутниковый)</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">USB порты</span></td><td><span style=\"color:rgb(93,93,93);\">2x USB2.0 порта</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">Дисплей</span></td><td><span style=\"color:rgb(93,93,93);\">Без дисплея</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">CA картридер</span></td><td><span style=\"color:rgb(93,93,93);\">Нету CA картридер</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">Форматы видеосжатия</span></td><td><span style=\"color:rgb(93,93,93);\">H.264</span></td></tr><tr><td><span style=\"color:rgb(93,93,93);\">Поддержка форматов звука</span></td><td><span style=\"color:rgb(93,93,93);\">DD AC3</span></td></tr></tbody></table></figure>', '<p><strong>Спутниковый ресивер uClan B6 CA Full HD (старое название U2C B6 Full HD) - это самый популярный спутниковый тюнер начиная с 2017 года.</strong></p><p>Помимо низкой цены устройство характеризует хорошее качество изображения как на SD, так и на HD каналах а также высокая чувствительность приёемного тракта входного тюнера.</p><p>Необходимо отметить, что приемник можно использовать как IPTV / OTT приставку, ссылки на плейлисты и сами плейлисты можно загружать с USB носителя, в .m3u формате.&nbsp;</p><p>Спутниковый приемник uClan B6 Full HD выполнен на популярнейшем чипсете GX6605S, работает под управлением фирменного программного обеспечения. Также доступны прошивки от клона:&nbsp;OCTAGON SX8 HD ONE MAGIC.</p><p>Разработчики программного обеспечения uClan реализовали в данной модели низшего ценового уровня множество нетипичных данному уровню приёмников функций, главное: большинство из них было реализовано первыми на рынке.</p><p>Именно поэтому множество любителей-экспериментаторов в течении нескольких лет пытаются комбинировать куски кода, используя ПО uClan B6 Full HD как базу для создания своих кустарных \"прошивок\".</p><p>Из типичных функций, здесь присутствует поддержка самых популярных типов USB-Wi-Fi адаптеров (чипсеты 5370/7601), поддержка USB-3G модемов, USB-LAN адаптеров и Dolby Digital AC3.&nbsp;Multistream потоки сканируются и работают без проблем.</p><p>Список типов поддерживаемых USB-LAN адаптеров:&nbsp;<strong>88772B, SR9800, SR9700, RD9700, RTL8152B, RTL8153</strong></p><p>Несмотря на компактные габариты тюнера разработчикам удалось избежать перегрева устройства. Также производитель предусмотрел «скрытую»&nbsp;установку ресивера, для этого есть соответствующее крепление в комплекте поставки и выносной ИК-приемник.&nbsp;</p><p>Также отметим корректную работу приставки с «мотором», что, несомненно, порадует энтузиастов спутникового ТВ. Пользоваться ресивером не составит труда даже новичкам – залогом этого выступает удобное меню с поддержкой украинского и русского языков. Почитателей марки uClan (U2C) порадует удобный пульт дистанционного управления, в привычном уже для U2C стиле, что интересно: пульты моделей линеек B6 и Denys совместимы и работают отлично.</p><p>Прогрессивные мультимедийные возможности поддерживают воспроизведение видео с внешних USB накопителей, роликов с YouTube с качеством до 1080р, воспроизведение сетевых IPTV потоков, кинотеатров и IPTV.</p>', 11, 15.00, 16, 0.00, NULL, 1, '[{\"img\":\"\\/storage\\/products\\/uclan b6 ca full hd\\/09-52-31-03-02-2022.jpg\",\"main\":true},{\"img\":\"\\/storage\\/products\\/uclan b6 ca full hd\\/09-52-22-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/uclan b6 ca full hd\\/09-52-28-03-02-2022.jpg\",\"main\":false}]', 1, 'product', '2022-02-03 07:33:16', '2022-02-08 17:47:43'),
(43, 40, 'uclan-x96-max-4gb32gb', 'uClan X96 max 4Gb/32Gb', 'uClan X96 max 4Gb/32Gb', 'Android TV приставка uClan X96Max – это обновленная модель X96Max с новым, более производительным процессором Amlogic S905X3, прямого наследника S905X2', 'Android TV приставка uClan X96Max – это обновленная модель X96Max с новым, более производительным процессором Amlogic S905X3, прямого наследника S905X2', NULL, NULL, '<p><strong>Android TV приставка uClan X96Max&nbsp;</strong>– это обновленная модель&nbsp;<strong>X96Max</strong>&nbsp;с новым, более производительным процессором&nbsp;Amlogic S905X3,&nbsp;прямого наследника S905X2. В&nbsp;новом чипе используется процессор ARM&nbsp;<strong>Cortex-A55</strong>,&nbsp;что&nbsp;существенно повышает производительность ,по сравнению с&nbsp;<strong>Cortex-A53</strong>, используемом в S905X2.</p><p>Процессор&nbsp;<strong>Amlogic S905X3</strong>&nbsp;с&nbsp;ядрами <strong>ARM Cortex-A55</strong>, также включает в себя графический&nbsp;процессор&nbsp;<strong>ARM G31 MP2</strong>, который обеспечивает хорошую производительность, а также декодирование видео 4K.&nbsp;Остальные технические характеристики также очень похожи на характеристики приставок с S905X2. В качестве базовой операционной системы используется&nbsp;<strong>Android 9.0.</strong></p><h2><strong>Характеристики подробно:</strong></h2><figure class=\"table\"><table><tbody><tr><td colspan=\"9\"><strong>uClan X96Max (S905X3)</strong></td></tr><tr><td>Процессор</td><td colspan=\"8\">Amlogic S905X3 64-разрядный четырехъядерный процессор ARM® Cortex™ A55 процессор</td></tr><tr><td>Графический процессор</td><td colspan=\"8\">G31™ MP2 GPU процессор</td></tr><tr><td>Память</td><td colspan=\"8\">LPDDR4: 4 ГБ</td></tr><tr><td>Флэш-память</td><td colspan=\"8\">EMMC: 32 ГБ</td></tr><tr><td>Wi-Fi</td><td colspan=\"8\">IEEE 802,11 a/b/g/n/ac; 2,4G/5G</td></tr><tr><td>Bluetooth</td><td colspan=\"8\">BT для 4/32 модели; Поддержка голосового пульта дистанционного управления</td></tr><tr><td>&nbsp;</td><td colspan=\"8\">&nbsp;</td></tr><tr><td rowspan=\"6\">I/O</td><td colspan=\"2\">1 * HDMI</td><td colspan=\"6\">HDMI 2,1, поддержка HDMI CEC, динамический HDR и 8 K x 4 K 24 Максимальное разрешение выхода</td></tr><tr><td colspan=\"2\">1 * AV OUT</td><td colspan=\"6\">Выход стандартного определения 480i/576i</td></tr><tr><td colspan=\"2\">2 * USB</td><td colspan=\"6\">1 * USB 3,0; 1 * USB 2,0</td></tr><tr><td colspan=\"2\">1 * ИК-ресивер</td><td colspan=\"6\">Дистанционный ресивер для подключения</td></tr><tr><td colspan=\"2\">1 * RJ45</td><td colspan=\"6\">Интерфейс Ethernet Поддержка 10/100Mbps или 1000Mbps</td></tr><tr><td colspan=\"2\">1 * TF карты</td><td colspan=\"6\">Поддержка 4 ГБ/8 ГБ/16 ГБ/32 ГБ/64 ГБ</td></tr><tr><td>Мощность</td><td colspan=\"8\">DC 5В/2A;</td></tr><tr><td colspan=\"9\">Программное обеспечение</td></tr><tr><td>OS</td><td colspan=\"8\">Android 9,0</td></tr><tr><td>Видео</td><td colspan=\"8\">-Amlogic Video Engine (AVE) с выделенными аппаратными декодерами и кодировщиками<br>-Поддержка мульти-видео декодера до 4x1080 P 60fps<br>-Поддержка нескольких \"защищенных\" сеансов декодирования видео и одновременное декодирование и кодирование<br>-Декодирование видео/изображения<br>-Профиль VP9-2 до 8 K x 4 K 24 fps<br>-H.265 HEVC MP-10 L5.1 до 8 K x 4 K 24 fps<br>-AVS2-P2 профиль до 8 K x 4 K 24 fps<br>-H.264 AVC HP L5.1 до 4 K x 2 K 30fps<br>-MPEG-4 ASP L5 до 1080 P 60 кадров в секунду (ISO-14496)<br>-WMV/VC-1 SP/MP/AP до 1080 P 60fps<br>-AVS-P16 (AVS +)/AVS-P2 JiZhun профиль до 1080 P 60fps<br>-MPEG-2 МП/HL до 1080 P 60 кадров в секунду (ISO-13818)<br>-MPEG-1 МП/HL до 1080 P 60 кадров в секунду (ISO-11172)<br>-RealVideo 8/9/10 до 1080 P 60fps<br>-Поддержка нескольких языков и нескольких форматов подзаголовка видео<br>-Декодирование неограниченного разрешения пикселей MJPEG и JPEG (ISO/IEC-10918)<br>-Поддержка эффектов JPEG thumbnail, scaling, rotation и transition<br>-Поддерживает *. mkv, *. wmv *. mpg, *. mpeg, *. dat, *. avi, *. mov *. iso, *. mp4, *. rm и *. jpg форматов файлов</td></tr><tr><td>Аудио</td><td colspan=\"8\">Поддерживает MP3, AAC, WMA, RM, FLAC, Ogg и программируемый с 7,1/5,1 вниз-смешивание<br>С низким энергопотреблением VAD<br>Встроенный Серийный Цифровой аудио SPDIF/IEC958 вход/выход и PCM вход/выход<br>3 встроенных порта TDM/PCM/I2S с режимом TDM/PCM до 384 кГц x 32 бит x 16 бит или 96 кГц x 32 бит x 32 бит и режим I2S до 384 кГц x 32 бит x 16ch<br>Цифровой микрофон PDM вход с программируемым CIC, LPF &amp; HPF, поддержка до 8 DMICs<br>Встроенный стерео аудио ЦАП<br>Поддерживает параллельный двойной аудио стерео выход канала с комбинацией аналога + PCM или I2S + PCM</td></tr><tr><td>Изображение</td><td colspan=\"8\">HD JPEG, BMP, GIF, PNG, TIF</td></tr><tr><td>Язык</td><td colspan=\"8\">Английский, французский, немецкий, испанский, итальянский и т. д.</td></tr><tr><td colspan=\"9\">&nbsp;</td></tr><tr><td>Онлайн</td><td colspan=\"8\">Просмотр все видео-сайтов, поддержка Netflix, Hulu, Flixster, Youtube и т. д.</td></tr><tr><td>Приложения</td><td colspan=\"8\">Приложения свободно загружаются в android market, amazon, app store и т. д.</td></tr><tr><td>Накопители</td><td colspan=\"8\">Локальное воспроизведение мультимедиа, Поддержка HDD, U Disck, tf-карты.</td></tr><tr><td>Общение</td><td colspan=\"8\">Поддержка SKYPE, MSN, facebook, twitter, QQ и т. д.</td></tr><tr><td>Другое</td><td colspan=\"8\">Поддержка электронной почты<br>Поддержка DLNA функции<br>Поддержка беспроводной мыши/клавиатуры 2,4G</td></tr></tbody></table></figure>', '<p><strong>Android TV приставка uClan X96Max&nbsp;</strong>– это обновленная модель&nbsp;<strong>X96Max</strong>&nbsp;с новым, более производительным процессором&nbsp;Amlogic S905X3,&nbsp;прямого наследника S905X2. В&nbsp;новом чипе используется процессор ARM&nbsp;<strong>Cortex-A55</strong>,&nbsp;что&nbsp;существенно повышает производительность ,по сравнению с&nbsp;<strong>Cortex-A53</strong>, используемом в S905X2.</p><p>Процессор&nbsp;<strong>Amlogic S905X3</strong>&nbsp;с&nbsp;ядрами <strong>ARM Cortex-A55</strong>, также включает в себя графический&nbsp;процессор&nbsp;<strong>ARM G31 MP2</strong>, который обеспечивает хорошую производительность, а также декодирование видео 4K.&nbsp;Остальные технические характеристики также очень похожи на характеристики приставок с S905X2. В качестве базовой операционной системы используется&nbsp;<strong>Android 9.0</strong>&nbsp;а в будущем ожидается обновление до&nbsp;<strong>Android Q</strong></p><p><strong>- 2/16GB, WIFI 2.4G, LAN 100M (без Bluetooth)</strong></p><p><strong>- 4/32GB, WIFI 2.4G + 5G, BT4.1, LAN&nbsp;100Mbps или 1000Mbps&nbsp;(опционально)</strong></p><p><strong>- 4/64GB, WIFI 2.4G + 5G, BT4.1, LAN 100Mbps или 1000Mbps&nbsp;(опционально)</strong></p>', 1231, 46.00, 16, 0.00, NULL, 2, '[{\"img\":\"\\/storage\\/products\\/x96\\/09-04-31-03-02-2022.jpg\",\"main\":true},{\"img\":\"\\/storage\\/products\\/x96\\/09-04-26-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-04-29-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-56-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-53-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-04-40-03-02-2022.jpg\",\"main\":false},{\"img\":\"\\/storage\\/products\\/x96\\/09-05-03-03-02-2022.jpg\",\"main\":false}]', 1, 'product', '2022-02-03 15:49:20', '2022-02-03 16:20:15'),
(46, NULL, '11111111111', '11111111111', '11111111111', NULL, NULL, '[\"\\u043f\\u0438\"]', '[\"\\u043f\\u0438\"]', NULL, NULL, 2, 85.00, 18, 0.00, '[38]', 2, '[{\"img\":\"\\/storage\\/products\\/06-31-57-03-02-2022.png\",\"main\":true}]', 1, 'product', '2022-02-16 13:38:21', '2022-02-16 13:38:21');

-- --------------------------------------------------------

--
-- Структура таблицы `resizes`
--

CREATE TABLE `resizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `resizeMimeType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `resizes`
--

INSERT INTO `resizes` (`id`, `name`, `width`, `height`, `resizeMimeType`, `created_at`, `updated_at`) VALUES
(1, 'Товары', 1200, 800, 'image/jpeg', '2021-12-18 14:05:32', '2022-01-06 13:15:46'),
(3, 'Слайдер', 1400, 461, NULL, '2021-12-18 14:17:30', '2022-01-05 16:31:47'),
(4, 'Иконки', 50, 50, 'image/png', '2021-12-18 14:51:30', '2021-12-18 17:38:25'),
(6, 'logo_company', 239, 67, 'image/png', '2022-01-02 06:30:26', '2022-01-02 06:30:26'),
(7, 'Категории', 100, 100, NULL, '2022-01-03 18:00:42', '2022-01-03 18:00:42'),
(8, 'socials', 25, 25, NULL, '2022-01-04 07:30:30', '2022-01-04 07:30:30');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Супер администратор', 'superadmin', 'все права', '2021-12-22 14:43:33', '2021-12-22 14:47:02'),
(3, 'Администратор', 'admin', 'Все, кроме создания прав', '2021-12-24 17:59:04', '2021-12-24 17:59:04');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_ru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `text_uk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` double(11,2) NOT NULL DEFAULT '0.00',
  `curs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name_ru`, `name_uk`, `text_ru`, `text_uk`, `price`, `curs_id`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Настройка (обновление ПО)', 'Услуга 1', '<p>Загрузка актуального ПО и списка каналов на 4 популярных спутника:</p><p>&nbsp;• Amos 2/3/7 (4°W)</p><p>&nbsp;• Astra 4A (4.9°E)</p><p>&nbsp;• Hot Bird 13 B/C/E (13°E)</p><p>&nbsp;• ABS 1 (75°E)<br>&nbsp;</p>', '<p>Заголовок услуги 1</p><ol><li>татватва</li><li>автватват</li><li>автавит</li></ol>', 100.00, 18, 1, '2022-01-26 06:39:18', '2022-02-03 08:00:43'),
(2, 'Установка и настройка популярных приложений', 'Услуга 2', '<p>Установка популярных приложений для просмотра фильмов и онлайн видео (YouTube, MEGOGO, Oll.tv и др.), программ для просмотра IPTV ( без списка каналов), браузеров, проигрывателей &nbsp;и других приложений для комфортного пользования.</p>', '<p>Заголовок услуги 1</p><ol><li>апваираври</li><li>апива</li><li>иапиа</li><li>иап</li></ol>', 150.00, 18, 1, '2022-01-26 06:44:18', '2022-02-03 18:06:45');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `text`, `url`, `img`, `created_at`, `updated_at`) VALUES
(3, '111', 'http://smart-tele.com.ua/sputnikovie-resiveri-/ustym-4k-pro', '/storage/sliders/04-36-13-02-02-2022.jpg', '2022-01-05 14:39:17', '2022-02-02 14:36:27'),
(5, NULL, NULL, '/storage/sliders/04-36-12-02-02-2022.png', '2022-02-02 07:54:04', '2022-02-02 14:36:35'),
(6, NULL, NULL, '/storage/sliders/04-36-12-02-02-2022.jpg', '2022-02-02 07:54:37', '2022-02-02 14:36:41');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 3, 'Сергей', 'sergey@gmail.com', NULL, '$2y$10$ER9IJ1MYN.vpwLZMz3e8zutWRfVIgosKo84RdDYLwTRq5JmuPUW5G', NULL, '2021-12-23 08:30:45', '2022-01-20 09:00:43'),
(11, 1, 'alex', 'alex@mail.ru', NULL, '$2y$10$q.uRQ7IbnmwjOZ/vQ6IEHupQb06v7kyg7IEqkpTBmOcK1HrqlXoVK', NULL, '2021-12-23 17:26:19', '2022-01-20 09:01:50');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `curs`
--
ALTER TABLE `curs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filters_filter_id_foreign` (`filter_id`);

--
-- Индексы таблицы `filter_product`
--
ALTER TABLE `filter_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filter_product_filter_id_foreign` (`filter_id`),
  ADD KEY `filter_product_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_curs_foreign` (`curs_id`),
  ADD KEY `products_service_id_foreign` (`service_id`);

--
-- Индексы таблицы `resizes`
--
ALTER TABLE `resizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_curs_id_foreign` (`curs_id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT для таблицы `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `curs`
--
ALTER TABLE `curs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `filter_product`
--
ALTER TABLE `filter_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `resizes`
--
ALTER TABLE `resizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filters`
--
ALTER TABLE `filters`
  ADD CONSTRAINT `filters_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filter_product`
--
ALTER TABLE `filter_product`
  ADD CONSTRAINT `filter_product_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `filter_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_curs_foreign` FOREIGN KEY (`curs_id`) REFERENCES `curs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_curs_id_foreign` FOREIGN KEY (`curs_id`) REFERENCES `curs` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
