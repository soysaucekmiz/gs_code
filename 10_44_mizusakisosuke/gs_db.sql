-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 11 月 01 日 23:45
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
  `age` int(3) NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`, `age`, `image`) VALUES
(1, 'Jason Statham', 'jason@statham.com', '時速200kmで飛ばせば、遠距離じゃなくなる。', '2018-09-22 15:49:00', 51, ''),
(2, 'ひょっこりはん', 'hyoccori@han.com', 'はい、ひょっこりはん', '2018-09-22 16:02:43', 42, ''),
(3, 'ほっこりはん', 'hoccori@han.com', 'はい、ほっこりはん', '2018-09-22 16:08:45', 40, ''),
(5, 'ISSA', 'issa@dapump.com', 'Cmon Baby, America!', '2018-09-22 16:08:45', 43, ''),
(6, 'ジョナサン・ジョースター', 'jonathan@joestar.com', 'メメタァ', '2018-09-22 17:16:39', 18, ''),
(7, 'ジョセフ・ジョースター', 'joseph@joestar.com', '逃げるんだよぉ〜！', '2018-09-22 18:19:51', 23, ''),
(11, '麦茶太郎', 'mugicha@mugi.com', 'hogehoge', '2018-10-20 16:09:15', 0, 'upload/20181020160915d41d8cd98f00b204e9800998ecf8427e.jpg'),
(12, 'hatomugi ichiro', 'hatomugi@test.com', 'test test', '2018-10-20 16:15:09', 0, 'upload/20181020161509d41d8cd98f00b204e9800998ecf8427e.jpg'),
(13, 'hogehoge', 'hoge@hoge.com', 'aaaa', '2018-10-30 22:55:21', 0, 'upload/20181030225521d41d8cd98f00b204e9800998ecf8427e.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bmtag_bind`
--

CREATE TABLE IF NOT EXISTS `gs_bmtag_bind` (
`id` int(12) NOT NULL,
  `bm_id` int(12) NOT NULL,
  `tag_id` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(29, 72, 7),
(30, 99, 20),
(31, 100, 1),
(32, 101, 21),
(33, 102, 4),
(34, 103, 13),
(35, 104, 13),
(36, 105, 22),
(37, 106, 23),
(38, 107, 23),
(39, 108, 23),
(40, 109, 23),
(41, 110, 23),
(42, 111, 1),
(43, 112, 24),
(44, 113, 23),
(45, 114, 25),
(46, 115, 18),
(47, 116, 26),
(48, 117, 27),
(49, 118, 18),
(50, 119, 28),
(51, 120, 27),
(53, 122, 29),
(54, 123, 29),
(55, 124, 29),
(56, 124, 30),
(57, 124, 31),
(58, 124, 32),
(59, 124, 33),
(60, 125, 34),
(61, 125, 35),
(68, 127, 34),
(69, 127, 35),
(70, 127, 36),
(71, 127, 38),
(72, 128, 41),
(73, 128, 40),
(74, 128, 41),
(78, 130, 34),
(79, 130, 35),
(80, 130, 36),
(81, 130, 38),
(82, 131, 42),
(85, 131, 39),
(86, 131, 43),
(87, 131, 23),
(99, 135, 47),
(100, 135, 48),
(101, 135, 49),
(104, 137, 48),
(105, 137, 47),
(106, 137, 50),
(107, 113, 51),
(108, 138, 52),
(109, 138, 53),
(110, 138, 54),
(111, 139, 55),
(112, 139, 1),
(113, 121, 56),
(114, 121, 57),
(115, 121, 58);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bmtag_table`
--

CREATE TABLE IF NOT EXISTS `gs_bmtag_table` (
`id` int(12) NOT NULL,
  `tag_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(19, '仏教'),
(20, '物語'),
(21, 'カレンダー'),
(22, 'マーケティング'),
(23, '魚'),
(24, 'コーヒー'),
(25, '文学'),
(26, 'ミステリー'),
(27, '小説'),
(28, 'ロマンス'),
(29, 'preg'),
(30, 'split'),
(31, 'is'),
(32, 'so'),
(33, 'fine.'),
(34, 'do'),
(35, 'donki'),
(36, 'don'),
(37, 'quihote'),
(38, 'quihoute'),
(39, '牛'),
(40, '豚'),
(41, '鶏'),
(42, '羊'),
(43, '狐'),
(44, '米'),
(45, 'red'),
(46, 'blue'),
(47, 'yellow'),
(48, 'green'),
(49, 'gray'),
(50, 'white'),
(51, 'ネタ'),
(52, '赤'),
(53, '白'),
(54, '黄色'),
(55, 'IoT'),
(56, 'カーブ'),
(57, 'スライダー'),
(58, 'チェンジアップ');

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
  `comment` text COLLATE utf8_unicode_ci,
  `user_id` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `book`, `author`, `datetime`, `category`, `summary`, `comment`, `user_id`) VALUES
(70, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:29:13', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。', 1),
(71, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:30:29', '映画', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。', 1),
(72, 'スルメイカ', 'タコ', '2018-09-30 13:32:03', 'ベトナム', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', 'おいしいね。', 1),
(73, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:37:49', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。', 1),
(74, '仏教の全て', 'ゴータマ・シッダールタ', '2018-09-30 13:38:44', '仏教', '悟りの境地', 'ごいすー！', 1),
(75, 'マクベス', 'ウィリアム・シェイクスピア', '2018-09-30 13:39:38', '悲劇', '勇猛果敢だが小心な一面もある将軍マクベスが妻と謀って主君を暗殺し王位に就くが、内面・外面の重圧に耐えきれず錯乱して暴政を行い、貴族や王子らの復讐に倒れる。', '悲しいね。', 1),
(76, 'テスト登録1', '既存カテゴリ', '2018-10-02 01:52:43', 'カマキリ', '旧)既存: 戦略\r\n新)既存: カマキリ', 'hogehoge', 1),
(77, 'テスト登録2', '新規カテゴリ', '2018-10-02 01:54:16', '数学', '旧）映画->9\r\n新）数学->12予定', 'hogehoge', 1),
(78, 'テスト登録3', 'カテゴリNULL', '2018-10-02 01:55:30', '', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: NULL', 'bm_id: 78', 1),
(79, 'テスト登録4', '既存カテゴリ', '2018-10-02 01:57:27', '', 'bind_id: 14, \r\n旧tag_id:  4.戦略, \r\n新tag_id:  NULL', 'hogehoge', 1),
(80, 'テスト登録5', '新規カテゴリ', '2018-10-02 01:58:25', '美術', 'hogehoge', 'hogehoge', 1),
(81, 'テスト登録6', 'カテゴリNULL', '2018-10-02 01:58:50', '映画', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: 9.映画', 'bm_id: 81', 3),
(82, 'テスト登録7', '既存カテゴリ', '2018-10-02 01:59:17', 'ビジネス', 'hogehoge', 'hogehoge', 3),
(83, 'テスト登録8', '新規カテゴリ', '2018-10-02 02:00:50', '睡眠', 'hogehoge', 'hogehoge', 3),
(84, 'テスト登録9', 'カテゴリNULL', '2018-10-02 02:01:33', '麦茶', 'bind_id: NULL, 旧tag_id: NULL, 新tag_id: 13. 麦茶予定', 'hogehoge', 3),
(85, '空タグtest1', 'カテゴリNULL', '2018-10-04 01:29:14', 'パワー', 'old_bind: NULL, old_tag: NULL', 'new_bind: n+1, new_tag: k\r\nnew_bind: 18, new_tag: 5.パワー', 3),
(86, '空タグtest2', 'カテゴリNULL', '2018-10-04 01:30:17', '国際関係', 'old_bind: NULL, old_tag: NULL', 'new_bind: n+1, new_tag: n+1\r\nnew_bind: 19, new_tag: 14', 3),
(87, '空タグtest3', 'カテゴリNULL', '2018-10-04 01:31:05', '', 'old_bind: NULL, old_tag: NULL', 'new_bind: NULL, new_tag: NULL', 3),
(88, 'test1', 'tag_null', '2018-10-04 01:43:01', '', 'tag: null->null\r\nbind: null->null', 'tag: null->null\r\nbind: null->null\r\n一応ここを更新', 3),
(89, 'test2', 'tag_null', '2018-10-04 01:43:58', 'ジョブズ', 'tag: null->n+1\r\nbind: null->n+1', 'tag: null->15.ジョブズ予定\r\nbind: null->24', 3),
(90, 'test3', 'tag_null', '2018-10-04 01:44:42', '映画', 'tag: null->k\r\nbind: null->n+1', 'tag: null->9.映画\r\nbind: null->25', 3),
(91, 'test4', 'tag_k', '2018-10-04 01:47:04', '', 'tag: k->null\r\nbind: k->null', 'tag: 4.戦略->null\r\nbind: 20->null', 3),
(92, 'test5', 'tag_k', '2018-10-04 01:48:38', '戦略', 'tag: k->k\r\nbind: k->k', 'tag: 4.戦略->4.戦略\r\nbind: 21->21\r\n保存したよ', 3),
(93, 'tag6', 'tag_k', '2018-10-04 01:49:37', 'フェットチーネ', 'tag: k->n+1\r\nbind: k->k', 'tag: 4.戦略->16.フェットチーネ\r\nbind: 22->22', 3),
(94, 'test7', 'tag_k', '2018-10-04 01:50:37', 'カマキリ', 'tag: k->l\r\nbind: k->k', 'tag: 4.戦略->3.カマキリ\r\nbind: 23->23', 3),
(98, '村西さんの冒険', 'おれ', '2018-10-04 23:17:24', '冒険', 'アンビリーバブル', 'すごいよ', 2),
(99, '村西の全て', 'むらにし', '2018-10-04 23:37:03', '物語', 'すごいよ', '楽しい', 2),
(100, 'インターネットの全て', 'おれ', '2018-10-05 18:16:43', 'ビジネス', 'hogehoge', 'こんにちは', 2),
(101, 'カレンダー', 'あああ', '2018-10-05 18:17:10', 'カレンダー', 'ホゲホゲ\r\n', 'ｇじょｐらう', 2),
(102, 'TSUNAMI', 'ウィリアム・ウエストハム', '2018-10-05 19:11:33', '戦略', 'じゃぎおｐす', 'ｈぎおらぷｔ', 2),
(103, 'おいしい麦茶の作り方', '麦茶太郎', '2018-10-06 15:10:21', '麦茶', 'ああああ', 'おいしいよ', 2),
(104, '麦茶の極意', '麦茶一郎', '2018-10-06 15:10:37', '麦茶', 'グリオアプト式', 'ｇらいおぷTSE', 2),
(105, 'デジタル時代の基礎知識『ブランディング』 「顧客体験」で差がつく時代の新しいルール', '山口義宏', '2018-10-08 11:41:48', 'マーケティング', 'あああああ', 'hogehoge', 2),
(106, 'userこはだの本', 'こはだ', '2018-10-08 12:10:13', '魚', 'user_id: 1 こはだとしてログイン中', 'user_id: 3 えいひれとしてのセッション情報が残っていたらしく、user_id: 3で登録されてしまった', 3),
(107, 'こはだリベンジ', 'こはだ', '2018-10-08 12:11:32', '魚', 'user_id: 1 こはだとしてログイン中', '今度こそ頼む！', 1),
(108, 'えいひれだよ', 'えいひれ', '2018-10-08 12:13:43', '魚', 'user_id: 3 えいひれとしてログイン中', 'ホゲホゲ', 3),
(109, '甘エビの本', 'あまえび', '2018-10-08 13:05:00', '魚', 'さかなさかなさかなー', 'user_id: 5', 5),
(110, 'すごいあまえび', 'あまえび', '2018-10-08 13:05:55', '魚', 'あまい', 'あますぎる', 5),
(111, 'あまくない、あまえびの世界', 'あまえび一郎', '2018-10-08 13:06:45', 'ビジネス', 'ビジネスはね、あまくないんだよ', 'そうなんだ！', 5),
(112, '贅沢微糖', 'BOSS', '2018-10-08 16:26:48', 'コーヒー', '芳醇のコク', '糖類50%off', 1),
(113, 'すしざんまい', '木村清', '2018-10-08 16:28:09', '魚, ネタ', 'Sushi Zanmai is your happiness.', 'yes it is!', 1),
(114, '罪と罰', 'ドストエフスキー', '2018-10-08 16:29:46', '文学', '罪深いよ', 'そうだね', 1),
(115, 'ドンキホーテ', 'セルバンテス', '2018-10-08 16:30:44', '冒険', 'ド・ド・ド、ドンキ、ドン・キ、ホーテ', '♪♫♬', 1),
(116, 'モルグ街の殺人', 'エドガー・アラン・ポー', '2018-10-08 16:32:13', 'ミステリー', 'ひどい・・・事件だったね・・・', 'そうだね・・・', 1),
(117, 'オリバー・ツイスト', 'ディケンズ', '2018-10-08 16:33:23', '小説', 'こんにちは。', 'こんにちは。', 1),
(118, 'トム・ソーヤーの冒険', 'マーク・トゥエイン', '2018-10-08 16:34:30', '冒険', 'そいや、そいや', 'お祭りだい', 1),
(119, '若きウェルテルの悩み', 'ゲーテ', '2018-10-08 16:35:17', 'ロマンス', 'ウェルテル＝ゲーテ', 'ネタバレやめろし', 1),
(120, '戦争と平和', 'トルストイ', '2018-10-08 16:36:23', '小説', 'ナポレオンうざすぎワロタ', '冬将軍強すぎワロタ', 1),
(121, 'preg_split test', 'tester1', '2018-10-09 23:35:59', 'カーブ スライダー チェンジアップ', '空振り三振！', 'hogehoge', 3),
(122, 'preg_split test', 'preg taro', '2018-10-10 19:52:12', 'preg split is fine.', 'hogehoge', 'hogho', 3),
(123, 'preg_split test season 2', 'preg jiro', '2018-10-10 20:02:34', 'preg split is fine.', 'bonjour', 'ni hao', 3),
(124, 'preg_split test season 3', 'preg saburo', '2018-10-10 20:05:14', 'preg split is so fine.', 'bobobo bonjour', 'kokoko konnichiwa', 3),
(125, 'preg_split test season 3', 'preg saburo', '2018-10-10 20:07:49', 'do, donki, ', '予想：\r\ndo, donki, NULL', '', 3),
(127, 'preg_split test season 4', 'preg shiro', '2018-10-10 20:25:33', 'do, do do, donki, don quihoute', '予想\r\n1.do, 2.donki, 3.don, 4.quihoute', 'quihouteは新しいタグ', 3),
(128, '肉シリーズ', 'ブッチャー', '2018-10-10 22:46:43', '牛 羊 鶏', '牛 豚 鶏', '牛 豚 鶏', 3),
(130, 'ドンキホーテ', 'セルバンテス', '2018-10-10 22:54:26', 'do donki don quihoute', 'タグが重複すると表示されないのか？', '', 3),
(131, '肉シリーズ3', 'ブッチャー', '2018-10-10 22:57:01', '牛, 羊, 狐, 魚', 'origin: 羊, 豚, 鶏\r\nupdate: 牛, 羊, 狐, 魚', 'update\r\n牛 => tag:39, bind:NEW85\r\n羊 => tag:42, bind:82\r\n狐 => tag:NEW43, bind:NEW86\r\n魚 => tag:23, bind:NEW87\r\n\r\norigin\r\n羊 => tag:42, bind:82\r\n豚 => tag:40, bind:NULL(83)\r\n鶏 => tag:41, bind:NULL(84)', 3),
(135, 'update test', 'updater', '2018-10-14 20:10:57', 'gray, yellow, green', 'original: {red, blue, yellow}\r\nupdate1: {red, blue, yellow, green}\r\nupdate2: {gray, yellow, green}\r\n', 'bind\r\n{{97,135,45}\r\n{98,135,46}\r\n{99,135,47}}', 3),
(137, 'update test', 'updater', '2018-10-14 20:18:35', 'white, green, yellow', 'original = {red green yellow}', '', 1),
(138, 'TSUNAMI', 'hogehoge', '2018-10-17 23:10:47', '赤 白 黄色', 'きれいだな', 'ああああ', 3),
(139, 'IoTのすべて', 'IoT Taro', '2018-10-17 23:32:48', 'IoT ビジネス', 'IoTはね、すごいんだよ！', 'はえ〜そうなんだ〜', 3);

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
  `life_flg` int(1) NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`, `image`) VALUES
(1, 'こはだ2', 'kohada', 'kohada', 0, 0, NULL),
(2, 'しまあじ3', 'shimaaji', 'shimaaji', 0, 0, NULL),
(3, 'えいひれ管理者2', 'eihire', 'eihire', 0, 0, 'upload/20181101234020814d706df0d6924bca6d5e1e533600f9.png'),
(5, 'あまえび管理者2', 'amaebi', 'amaebi', 1, 0, NULL),
(6, 'あかがい', 'akagai', 'akagai', 0, 0, NULL),
(8, 'さば', 'saba', 'saba', 0, 0, NULL);

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
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `gs_bmtag_bind`
--
ALTER TABLE `gs_bmtag_bind`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `gs_bmtag_table`
--
ALTER TABLE `gs_bmtag_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
