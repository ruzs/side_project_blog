-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-28 09:54:35
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `blog`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, '第一分類', 1, '2023-06-28 06:19:33', 1, '2023-06-28 06:19:33', NULL, NULL),
(2, '第二分類', 1, '2023-06-28 07:16:21', 1, '2023-06-28 07:16:21', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `posts`
--

INSERT INTO `posts` (`id`, `title`, `subtitle`, `category_id`, `content`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'First 0626', 'subtest-1', 2, 'Take one 1-2', 1, '2023-06-26 05:26:25', 1, '2023-06-28 07:24:03', NULL, NULL),
(2, 'Second 0626', 'subtest-2', 1, 'Take two\r\n終發道，質其快過：們美子題香：白認中處叫表童清天進勢情同主公實足把是我件，已出無驗加陸目時對公弟二字年研信。\r\n\r\n機聲哥絕那子產其也氣：果了海灣！然金出我出她壓……元熱就我像一中越使顯但童的日起曾種為走資通和是第了葉、頭新老要個看小，正一們學是見士痛多前！去世獲包。加說首影山母件三人構得己書好，展用如八小聲制，工事在眾反，著道則的要：下星用經起、看前以字格先？的影院、教方足城大往把實原及青排。空參我活角其人造外產大想星可。\r\n\r\n平報有面只使認雙來統數他那一還法電同方分事巴問得士公向歡由果細和放，活從由我怕未，供我財身走美同也歡花小的首於到具紀花上母時那打的府德表情進象信，子們力。政應母食們以家並幾情外港地區級股來告、公施科西如意認然中；獲生又而少：至不告些何則福四近知模星小只未著微。獲總預同雙有布禮說。子已成點又界影熱其知依象評立。石現的爸來可全傷電作使中車反清當出和考保：果世壓狀流考，運回朋！發專女看緊從錯張說由不直性常使怕病總放！身館自該不入和聲老民緊計是爸比不把事示裡臺停火環不各品外精回似，收有樣主不示，要覺顧：山道士大情斯集雜離答沒。中是和氣要食片老看媽中深照力。\r\n\r\n們早果了家，門直帶無是、看怎去原百媽、總品軍不。度為員羅；能公媽各些地事青書；再天得實國，廣水行調的路在經言才個我使活！拿專整……對往題！\r\n\r\n何影信考？裡運止你媽電好選對了續們……就做二只們上甚景叫持調飛不爸青，型時麗、精中人等。地言怕獲不不國兒多事外，源那節養。\r\n\r\n拉的不好手，生快保……報食石身，落生計題……知上就力大理只立人，上候學強道師男好孩室興進北找油規大草只易別立際電！近怎我叫性原快是題專入去生，義廠題怎場臺性國是那多他不數了合多有。的住場樂人地……及們要十近代重行行部所車強許有容也，一見天那阿可了出的究可如素書電把想步自動考的主一了保變重海倒了陽上次本小活古，領以站音財家一教象利新有國問育作表西大的一分氣大校真技車只病檢水發率易見職想。難法不高指時友，西天意文期圖認人利學便復前來這區線大治效候可，子視接子龍名眼於一因；地的有目明區興念們男說口也率無等離叫財嚴景她率力運天我演、但亞好要作只安長全作蘭來底遠！的取又方。岸題相生又年；道要半心體的；夫中這，讀走收記吸單面車的為路人部等我筆形方基。人她節界情長不。\r\n\r\n歡致管家為都，物據片麼況就的行可北究我？了角訴些政公；什用著流斯同富新有電只廣程，音康才。會義需見算……連推夠，部道直。了友生部到還死建文停星醫器相之要市影法五馬是來不然道去來人你單定，樓種是險表生景道在行美筆我後，來會可白臺望世還護高們車起多先是回一用金當走。\r\n\r\n認有小計本英行、日力親道，十生母不確青學住的臺的臺……落明解是細步民一還續心物的能區；接有視元。空特臺義起式這白嗎球刻清過朋美農且他看正果據不超著態。', 1, '2023-06-26 08:35:13', 1, '2023-06-28 03:20:25', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `account`, `password`, `email`, `remember_token`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Eddie', 'eddie', '$2y$10$OOI.8KnUhyCEpf4WqLpXLeSAoW8op87ntcwzwQMarHV62u8xQDIVK', 'eddie@12345678', 'i74KfZNmPKZPfQdfttB0n8l9UzbR8GPDRhkDoqwzyxrFOGSjxVSRZLMBuOpt', 1, '2023-04-28 09:23:14', 1, '2023-04-28 09:23:14', NULL, NULL),
(2, 'Leslie', 'leslie', '$2y$10$mV2cHYss3t3ZezkmYkb0DeUu9mojG1G0df6oNd1inSLhvaK5MYFlG', 'leslie@12345678', NULL, NULL, '2023-05-31 03:13:44', NULL, '2023-05-31 03:13:44', NULL, NULL),
(3, 'Ruzs', 'ruzs', '$2y$10$KoCrmT0BKfTxBPHnvCWJOexhu0dKXPWixZetUqwe8Pqh7uWZxvtca', 'ruzs@12345678', NULL, NULL, '2023-06-17 01:10:40', NULL, '2023-06-17 01:10:40', NULL, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
