-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 03 2012 г., 04:03
-- Версия сервера: 5.5.25a
-- Версия PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yii_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`) VALUES
(1, 'This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', NULL, 2),
(2, 'sasdlfjsdlkfjksdfljsdfljl', 2, 1348072803, 'errer', 'sdkfjsldkfslkdf@dslkflskdf.ru', 'http://www.sdsflsdfk.ru', 1),
(3, 'kjhdfsjdfjkdhfjksdhfkj', 2, 1348073251, 'test2', 'test@mail.ru', 'http://www.sdsflsdfk.ru', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_img`
--

CREATE TABLE IF NOT EXISTS `tbl_img` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL COMMENT 'относительная ссылка на изображение',
  `tumb1` varchar(255) NOT NULL COMMENT 'относительная ссылка на большое превью',
  `tumb2` varchar(255) NOT NULL COMMENT 'относительная ссылка на малое превью',
  `user_id` int(15) NOT NULL,
  `create_date` int(12) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0-изображение, 1-аватар',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица учета всех изображений в системе включая аватары' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_key`
--

CREATE TABLE IF NOT EXISTS `tbl_key` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `key` varchar(255) NOT NULL,
  `create_date` int(12) NOT NULL,
  `type` int(2) NOT NULL COMMENT '0-код активации почты, 1-код изменения пароля',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tbl_key`
--

INSERT INTO `tbl_key` (`id`, `user_id`, `key`, `create_date`, `type`) VALUES
(1, 5, '03481d58be14c581670422657818f82c', 1345936415, 0),
(2, 6, '832a6702e902bf22cb65eea64373a8a5', 1345941107, 0),
(3, 7, '14ae5c0497604d4294a18c06b25373ff', 1345941237, 0),
(4, 8, 'ab68280747800ee558e9594cb5944031', 1345942284, 0),
(5, 9, '23ee1e03c35be20c6b55af3c0c3305db', 1350869264, 0),
(7, 10, '745ca0d95201acbd44550d88f0899bf3', 1350877185, 0),
(8, 10, '745ca0d95201acbd44550d88f0899bf3', 1350878474, 0),
(9, 10, '745ca0d95201acbd44550d88f0899bf3', 1350879097, 0),
(10, 10, '745ca0d95201acbd44550d88f0899bf3', 1350879313, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lookup`
--

CREATE TABLE IF NOT EXISTS `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'PostStatus', 1),
(2, 'Published', 2, 'PostStatus', 2),
(3, 'Archived', 3, 'PostStatus', 3),
(4, 'Pending Approval', 1, 'CommentStatus', 1),
(5, 'Approved', 2, 'CommentStatus', 2),
(6, 'user', 1, 'UserRank', 1),
(7, 'moderator', 2, 'UserRank', 2),
(8, 'admin', 3, 'UserRank', 3),
(9, 'active', 1, 'UserStatus', 1),
(10, 'blocked', 2, 'UserStatus', 2),
(11, 'hidden', 3, 'UserStatus', 3),
(12, 'Draft', 1, 'PageStatus', 1),
(13, 'Published', 2, 'PageStatus', 2),
(14, 'Archived', 3, 'PageStatus', 3),
(15, 'text', 1, 'MailType', 1),
(16, 'html', 2, 'MailType', 2),
(17, 'error', 1, 'SysMsgType', 1),
(18, 'notice', 2, 'SysMsgType', 2),
(19, 'success', 3, 'SysMsgType', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_mail`
--

CREATE TABLE IF NOT EXISTS `tbl_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `params` text NOT NULL,
  `hidden_copy` tinyint(4) NOT NULL DEFAULT '0',
  `create_date` int(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_mail`
--

INSERT INTO `tbl_mail` (`id`, `name`, `subject`, `body`, `params`, `hidden_copy`, `create_date`, `user_id`, `type`) VALUES
(2, 'RegNotifyMsg', 'welcome to our site', 'Hello!!!\r\nFor register finished go link:\r\n{link}\r\n\r\nIf you don''t register newermind and close leter', '', 0, 1344041177, 2, 1),
(3, 'pass forget', 'pass change', 'Hello!!! \r\n\r\nFor change the password go link: {link} \r\n\r\n\r\nIf you don''t register newermind and close leter', '', 0, 1350876710, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `update_date` int(12) NOT NULL,
  `user_id` int(15) NOT NULL,
  `menu_code` text NOT NULL,
  `status` int(2) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `name`, `update_date`, `user_id`, `menu_code`, `status`, `params`) VALUES
(1, 'Root Menu', 1344555467, 2, '[{"label":"Home","url":["post\\/index"]},{"label":"test page 1","url":["page\\/view?id=14"],"items":[{"label":"test page 1.1","url":["page\\/view?id=15"],"items":[{"label":"test page 1.1.1","url":["page\\/view?id=17"],"items":[]}]}]},{"label":"test page 2","url":["page\\/view?id=16"],"items":[]},{"label":"test page 3","url":["page\\/view?id=18"],"items":[{"label":"test page 3.1","url":["page\\/view?id=22"],"items":[{"label":"test page 3.1.1","url":["page\\/view?id=23"],"items":[]}]}]},{"label":"test page 4","url":["page\\/view?id=21"],"items":[]},{"label":"abaut","url":["page\\/view?id=29"],"items":[]}]', 2, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_options`
--

CREATE TABLE IF NOT EXISTS `tbl_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `create_date` int(12) NOT NULL,
  `update_date` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `urlname` varchar(255) NOT NULL COMMENT 'нестандартное имя для ЧПУ ',
  `status` int(2) NOT NULL COMMENT '1-черновик, 2-опубликована, 3-архивная',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keys` varchar(255) NOT NULL,
  `parent` int(15) NOT NULL DEFAULT '0' COMMENT 'родительская страница',
  `params` text NOT NULL COMMENT 'JSON строка дополнительных параметров',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `user_id`, `create_date`, `update_date`, `title`, `content`, `urlname`, `status`, `meta_title`, `meta_description`, `meta_keys`, `parent`, `params`) VALUES
(14, 2, 1343435566, 1343435566, 'test page 1', '<p>\r\n	test page 1</p>\r\n', '', 2, 'test page 1', 'test page 1', 'test page 1', 0, ''),
(15, 2, 1343435585, 1343435630, 'test page 1.1', '<p>\r\n	test page 1.1</p>\r\n', '', 2, 'test page 1.1', 'test page 1.1', 'test page 1.1', 14, ''),
(16, 2, 1343437613, 1343437613, 'test page 2', '<p>\r\n	test page 2</p>\r\n', 'test page 2', 2, 'test page 2', 'test page 2', 'test page 2', 0, ''),
(17, 2, 1343519683, 1343519683, 'test page 1.1.1', '<p>\r\n	test page 1.1.1</p>\r\n', 'test page 1.1.1', 2, 'test page 1.1.1', 'test page 1.1.1', 'test page 1.1.1', 15, ''),
(18, 2, 1343520327, 1343520327, 'test page 3', '<p>\r\n	test page 3</p>\r\n', 'test page 3', 2, 'test page 3', 'test page 3', 'test page 3', 0, ''),
(21, 2, 1343520697, 1343520697, 'test page 4', '<p>\r\n	test page 4</p>\r\n', 'test page 4', 2, 'test page 4', 'test page 4', 'test page 4', 0, ''),
(22, 2, 1343522343, 1343522343, 'test page 3.1', '<p>\r\n	test page 3.1</p>\r\n', 'test page 3.1', 2, 'test page 3.1', 'test page 3.1', 'test page 3.1', 18, ''),
(23, 2, 1343522438, 1343522438, 'test page 3.1.1', '<p>\r\n	test page 3.1.1</p>\r\n', 'test page 3.1.1', 2, 'test page 3.1.1', 'test page 3.1.1', 'test page 3.1.1', 22, ''),
(29, 2, 1344555467, 1344555467, 'abaut', '<p>\r\n	abaut</p>\r\n', 'abaut', 2, 'abaut', 'abaut', 'abaut', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
(1, 'Welcome!', 'This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\n\nFeel free to try this system by writing new posts and posting comments.', 'yii, blog', 2, 1230952187, 1230952187, 1),
(2, 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'test', 2, 1230952187, 1230952187, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_postcategories`
--

CREATE TABLE IF NOT EXISTS `tbl_postcategories` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_category` int(4) NOT NULL,
  `description` text NOT NULL,
  `create_date` int(11) NOT NULL,
  `valid` int(1) NOT NULL,
  `tooltip` varchar(255) NOT NULL,
  `position` int(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_postcategories`
--

INSERT INTO `tbl_postcategories` (`id`, `user_id`, `title`, `parent_category`, `description`, `create_date`, `valid`, `tooltip`, `position`, `url`) VALUES
(1, 22, 'Updates', 0, 'sadfgsdfgsadgasdf', 1314656094, 1, '', 0, '/post/index?cat=1314656094'),
(2, 22, 'TODO', 1, 'sdfsdfsdfsdfsdfs', 1314656356, 1, '', 0, '/post/index?cat=1314656356'),
(3, 22, 'Test', 0, 'there we posted test post', 1314793913, 1, '', 0, '/post/index?cat=1314793913'),
(4, 22, 'New Releases', 1, 'Information on new releases will be here', 1317378934, 1, '', 0, '/post/index?cat=1317378934'),
(5, 22, 'Test report', 3, 'In this category we publish test reports of users', 1317485842, 1, '', 0, '/post/index?cat=1317485842');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_sysmsg`
--

CREATE TABLE IF NOT EXISTS `tbl_sysmsg` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(15) NOT NULL,
  `create_date` int(12) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_sysmsg`
--

INSERT INTO `tbl_sysmsg` (`id`, `description`, `body`, `user_id`, `create_date`, `type`) VALUES
(1, 'Registration ok', 'Registration is success! Chek your mail for instruction.', 2, 1344120831, 3),
(2, 'Not activate email', 'Your email has not been activated, check up your E-mail box, You will find an activation code there', 2, 1345934333, 1),
(3, 'no activation key', 'Wrong activation key', 2, 1345989085, 1),
(4, 'change password code send', 'Link to change your password sent to your email', 2, 1350872339, 3),
(5, 'Incorrect email address for password recovery', 'Incorrect email address for password recovery', 2, 1350877123, 1),
(6, 'password was successfully changed', 'Password was successfully changed!', 2, 1350879249, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`) VALUES
(1, 'yii', 1),
(2, 'blog', 1),
(3, 'test', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '0-не подтвердил имейл или не подтвержден админом, 1-активен, 2-блокирован',
  `params` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'json строка с дополнительными параметрами пользователя если будет необходимо',
  `reg_date` int(12) NOT NULL,
  `rank` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user' COMMENT 'user, moderator, admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `email`, `status`, `params`, `reg_date`, `rank`) VALUES
(1, 'demo', '2e5c7db760a33498023813489cfadc0b', '28b206548469ce62182048fd9cf91760', 'webmaster@example.com', 1, '', 0, 'user'),
(2, 'root', '8a0ec0c4689cd569708e62efec3aafdb', '9af4f9e833210673edfe7bf940af4287', 'greegoriyan@mail.ru', 1, '', 0, 'admin'),
(10, 'test', '8efb786659629f95cb01518c166d7570', 'd0e9db6a4536260729d6252b0eadc07b', 'greeschenko@gmail.com', 1, '', 1350875950, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_rank`
--

CREATE TABLE IF NOT EXISTS `tbl_user_rank` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_user_rank`
--

INSERT INTO `tbl_user_rank` (`id`, `name`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_status`
--

CREATE TABLE IF NOT EXISTS `tbl_user_status` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_user_status`
--

INSERT INTO `tbl_user_status` (`id`, `name`) VALUES
(1, 'active'),
(2, 'blocked'),
(3, 'hidden');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
