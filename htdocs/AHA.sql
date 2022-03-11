-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 9 月 07 日 04:37
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `AHA`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `ID` int(50) NOT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL COMMENT 'password_hash()',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `create_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO `admin` (`ID`, `admin`, `password`, `is_deleted`, `create_date_time`, `updated_date_time`) VALUES

-- --------------------------------------------------------

--
-- テーブルの構造 `comp_questions_list`
--

CREATE TABLE `comp_questions_list` (
  `ID` int(50) NOT NULL,
  `players_ID` int(50) NOT NULL,
  `questions_ID` int(100) NOT NULL,
  `create_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `players_list`
--

CREATE TABLE `players_list` (
  `ID` int(11) NOT NULL,
  `player` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `create_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `players_list`
--

INSERT INTO `players_list` (`ID`, `player`, `password`, `is_deleted`, `create_date_time`, `updated_date_time`) VALUES

-- --------------------------------------------------------

--
-- テーブルの構造 `questions_list`
--

CREATE TABLE `questions_list` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `before_png` varchar(128) NOT NULL,
  `after_png` varchar(128) NOT NULL,
  `answer_png` varchar(128) NOT NULL,
  `explanation` varchar(128) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `create_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `questions_list`
--

INSERT INTO `questions_list` (`id`, `title`, `difficulty`, `before_png`, `after_png`, `answer_png`, `explanation`, `is_deleted`, `create_date_time`, `updated_date_time`) VALUES

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `comp_questions_list`
--
ALTER TABLE `comp_questions_list`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `players_list`
--
ALTER TABLE `players_list`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `questions_list`
--
ALTER TABLE `questions_list`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルのAUTO_INCREMENT `comp_questions_list`
--
ALTER TABLE `comp_questions_list`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `players_list`
--
ALTER TABLE `players_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルのAUTO_INCREMENT `questions_list`
--
ALTER TABLE `questions_list`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
