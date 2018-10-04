-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 10 月 04 日 23:26
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE IF NOT EXISTS `gs_an_table` (
`id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`, `age`) VALUES
(1, 'Jason Statham', 'jason@statham.com', '時速200kmで飛ばせば、遠距離じゃなくなる。', '2018-09-22 15:49:00', 51),
(2, 'ひょっこりはん', 'hyoccori@han.com', 'はい、ひょっこりはん', '2018-09-22 16:02:43', 42),
(3, 'ほっこりはん', 'hoccori@han.com', 'はい、ほっこりはん', '2018-09-22 16:08:45', 40),
(5, 'ISSA', 'issa@dapump.com', 'Cmon Baby, America!', '2018-09-22 16:08:45', 43),
(6, 'ジョナサン・ジョースター', 'jonathan@joestar.com', 'メメタァ', '2018-09-22 17:16:39', 18),
(7, 'ジョセフ・ジョースター', 'joseph@joestar.com', '逃げるんだよぉ〜！', '2018-09-22 18:19:51', 23);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bmtag_bind`
--

CREATE TABLE IF NOT EXISTS `gs_bmtag_bind` (
`id` int(12) NOT NULL,
  `bm_id` int(12) NOT NULL,
  `tag_id` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bmtag_bind`
--

INSERT INTO `gs_bmtag_bind` (`id`, `bm_id`, `tag_id`) VALUES
(8, 70, 1),
(9, 71, 9),
(10, 73, 8),
(11, 74, 19),
(12, 76, 3),
(13, 77, 12),
(15, 80, 10),
(16, 82, 1),
(17, 83, 11),
(18, 85, 5),
(19, 86, 14),
(21, 92, 4),
(22, 93, 16),
(23, 94, 3),
(24, 89, 15),
(25, 90, 9),
(28, 98, 18),
(29, 72, 7);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bmtag_table`
--

CREATE TABLE IF NOT EXISTS `gs_bmtag_table` (
`id` int(12) NOT NULL,
  `tag_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bmtag_table`
--

INSERT INTO `gs_bmtag_table` (`id`, `tag_name`) VALUES
(1, 'ビジネス'),
(2, 'フォカッチャ'),
(3, 'カマキリ'),
(4, '戦略'),
(5, 'パワー'),
(7, 'ベトナム'),
(8, 'new'),
(9, '映画'),
(10, '美術'),
(11, '睡眠'),
(12, '数学'),
(13, '麦茶'),
(14, '国際関係'),
(15, 'ジョブズ'),
(16, 'フェットチーネ'),
(17, '防衛'),
(18, '冒険'),
(19, '仏教');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE IF NOT EXISTS `gs_bm_table` (
`id` int(12) NOT NULL,
  `book` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `category` text COLLATE utf8_unicode_ci,
  `summary` text COLLATE utf8_unicode_ci,
  `comment` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `book`, `author`, `datetime`, `category`, `summary`, `comment`) VALUES
(70, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:29:13', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。'),
(71, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:30:29', '映画', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。'),
(72, 'スルメイカ', 'タコ', '2018-09-30 13:32:03', 'ベトナム', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', 'おいしいね。'),
(73, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:37:49', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。'),
(74, '仏教の全て', 'ゴータマ・シッダールタ', '2018-09-30 13:38:44', '仏教', '悟りの境地', 'ごいすー！'),
(75, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:39:38', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。'),
(76, 'テスト登録1', '既存カテゴリ', '2018-10-02 01:52:43', 'カマキリ', '旧)既存: 戦略\r\n新)既存: カマキリ', 'hogehoge'),
(77, 'テスト登録2', '新規カテゴリ', '2018-10-02 01:54:16', '数学', '旧）映画->9\r\n新）数学->12予定', 'hogehoge'),
(78, 'テスト登録3', 'カテゴリNULL', '2018-10-02 01:55:30', '', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: NULL', 'bm_id: 78'),
(79, 'テスト登録4', '既存カテゴリ', '2018-10-02 01:57:27', '', 'bind_id: 14, \r\n旧tag_id:  4.戦略, \r\n新tag_id:  NULL', 'hogehoge'),
(80, 'テスト登録5', '新規カテゴリ', '2018-10-02 01:58:25', '美術', 'hogehoge', 'hogehoge'),
(81, 'テスト登録6', 'カテゴリNULL', '2018-10-02 01:58:50', '映画', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: 9.映画', 'bm_id: 81'),
(82, 'テスト登録7', '既存カテゴリ', '2018-10-02 01:59:17', 'ビジネス', 'hogehoge', 'hogehoge'),
(83, 'テスト登録8', '新規カテゴリ', '2018-10-02 02:00:50', '睡眠', 'hogehoge', 'hogehoge'),
(84, 'テスト登録9', 'カテゴリNULL', '2018-10-02 02:01:33', '麦茶', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: 13. 麦茶予定', 'hogehoge'),
(85, '空タグtest1', 'カテゴリNULL', '2018-10-04 01:29:14', 'パワー', 'old_bind: NULL, old_tag: NULL', 'new_bind: n+1, new_tag: k\r\nnew_bind: 18, new_tag: 5.パワー'),
(86, '空タグtest2', 'カテゴリNULL', '2018-10-04 01:30:17', '国際関係', 'old_bind: NULL, old_tag: NULL', 'new_bind: n+1, new_tag: n+1\r\nnew_bind: 19, new_tag: 14'),
(87, '空タグtest3', 'カテゴリNULL', '2018-10-04 01:31:05', '', 'old_bind: NULL, old_tag: NULL', 'new_bind: NULL, new_tag: NULL'),
(88, 'test1', 'tag_null', '2018-10-04 01:43:01', '', 'tag: null->null\r\nbind: null->null', 'tag: null->null\r\nbind: null->null\r\n一応ここを更新'),
(89, 'test2', 'tag_null', '2018-10-04 01:43:58', 'ジョブズ', 'tag: null->n+1\r\nbind: null->n+1', 'tag: null->15.ジョブズ予定\r\nbind: null->24'),
(90, 'test3', 'tag_null', '2018-10-04 01:44:42', '映画', 'tag: null->k\r\nbind: null->n+1', 'tag: null->9.映画\r\nbind: null->25'),
(91, 'test4', 'tag_k', '2018-10-04 01:47:04', '', 'tag: k->null\r\nbind: k->null', 'tag: 4.戦略->null\r\nbind: 20->null'),
(92, 'test5', 'tag_k', '2018-10-04 01:48:38', '戦略', 'tag: k->k\r\nbind: k->k', 'tag: 4.戦略->4.戦略\r\nbind: 21->21\r\n保存したよ'),
(93, 'tag6', 'tag_k', '2018-10-04 01:49:37', 'フェットチーネ', 'tag: k->n+1\r\nbind: k->k', 'tag: 4.戦略->16.フェットチーネ\r\nbind: 22->22'),
(94, 'test7', 'tag_k', '2018-10-04 01:50:37', 'カマキリ', 'tag: k->l\r\nbind: k->k', 'tag: 4.戦略->3.カマキリ\r\nbind: 23->23'),
(98, '村西さんの冒険', 'おれ', '2018-10-04 23:17:24', '冒険', 'アンビリーバブル', 'すごいよ');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE IF NOT EXISTS `gs_user_table` (
`id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'こはだ2', 'what is this?', 'hogehoge', 0, 0),
(2, 'しまあじ2', 'what is this?', 'hogehoge', 0, 1),
(3, 'えいひれ', 'hogehoge', 'hogehoge', 1, 0),
(5, 'あまえび', 'hogehoge', 'hogehoge', 1, 0),
(6, 'あかがい', 'hogehoge', 'hogehoge', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_bmtag_bind`
--
ALTER TABLE `gs_bmtag_bind`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_bmtag_table`
--
ALTER TABLE `gs_bmtag_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `gs_bmtag_bind`
--
ALTER TABLE `gs_bmtag_bind`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `gs_bmtag_table`
--
ALTER TABLE `gs_bmtag_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
