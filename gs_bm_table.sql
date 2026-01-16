-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2026 年 1 月 09 日 22:14
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `yoneken_db1`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` text NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `name`, `url`, `comment`, `date`) VALUES
(1, 'Newtype CHRONICLE「ファイブスター物語 Since 2013」 (カドカワムック)', 'https://www.amazon.co.jp/Newtype-CHRONICLE%E3%80%8C%E3%83%95%E3%82%A1%E3%82%A4%E3%83%96%E3%82%B9%E3%82%BF%E3%83%BC%E7%89%A9%E8%AA%9E-Since-2013%E3%80%8D-%E3%82%AB%E3%83%89%E3%82%AB%E3%83%AF%E3%83%A0%E3%83%83%E3%82%AF/dp/4041170281/ref=zg_bs_g_books_d_sccl_1/358-2176720-1700709?psc=1', '「月刊ニュータイプ」記事で振り返る「ファイブスター物語」', '2026-01-10 02:11:14'),
(2, 'BARFOUT! バァフアウト! 2026年2月号 FEBRUARY 2026 VOLUME 365 浜辺美波×目黒 蓮', 'https://www.amazon.co.jp/BARFOUT-%E3%83%90%E3%82%A1%E3%83%95%E3%82%A2%E3%82%A6%E3%83%88-2026%E5%B9%B42%E6%9C%88%E5%8F%B7-FEBRUARY-%E6%B5%9C%E8%BE%BA%E7%BE%8E%E6%B3%A2%C3%97%E7%9B%AE%E9%BB%92/dp/4344955005/ref=zg_bs_g_books_d_sccl_2/358-2176720-1700709?psc=1', 'CULTURE MAGAZINE FROM SHIMOKITAZAWA, TOKYO BARFOUT! バァフアウト! 2026年2月号 FEBRUARY 2026 VOLUME 365', '2026-01-10 02:15:44'),
(3, '勝負眼 「押し引き」を見極める思考と技術', 'https://www.amazon.co.jp/%E5%8B%9D%E8%B2%A0%E7%9C%BC-%E3%80%8C%E6%8A%BC%E3%81%97%E5%BC%95%E3%81%8D%E3%80%8D%E3%82%92%E8%A6%8B%E6%A5%B5%E3%82%81%E3%82%8B%E6%80%9D%E8%80%83%E3%81%A8%E6%8A%80%E8%A1%93-%E8%97%A4%E7%94%B0-%E6%99%8B/dp/4163920471/ref=zg_bs_g_books_d_sccl_3/358-2176720-1700709?psc=1', '●2026年、「勝負」に勝ちたいビジネスパーソン必読の1冊!', '2026-01-10 02:15:44'),
(4, '2026年用共通テスト予想問題パック', 'https://www.amazon.co.jp/2026%E5%B9%B4%E7%94%A8%E5%85%B1%E9%80%9A%E3%83%86%E3%82%B9%E3%83%88%E4%BA%88%E6%83%B3%E5%95%8F%E9%A1%8C%E3%83%91%E3%83%83%E3%82%AF-%EF%BC%BA%E4%BC%9A%E7%B7%A8%E9%9B%86%E9%83%A8/dp/4865317007/ref=zg_bs_g_books_d_sccl_4/358-2176720-1700709?psc=1', '◎本番直前の最終チェックに最適！', '2026-01-10 02:15:44'),
(5, 'たまごっちパラダイス パーフェクト ガイド', 'https://www.amazon.co.jp/%E3%81%9F%E3%81%BE%E3%81%94%E3%81%A3%E3%81%A1%E3%83%91%E3%83%A9%E3%83%80%E3%82%A4%E3%82%B9-%E3%83%91%E3%83%BC%E3%83%95%E3%82%A7%E3%82%AF%E3%83%88-%E3%82%AC%E3%82%A4%E3%83%89-%E5%B0%8F%E5%AD%A6%E9%A4%A8/dp/4092274394/ref=zg_bs_g_books_d_sccl_5/358-2176720-1700709?psc=1', '新発売!たまごっちパラダイスが丸わかり!', '2026-01-10 02:15:44'),
(6, 'a', 'http://akahon.jp', 'a', '2026-01-10 04:24:15'),
(7, 'ヨネケン', 'http://akahon.jp', 'aaa', '2026-01-10 04:24:27');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
