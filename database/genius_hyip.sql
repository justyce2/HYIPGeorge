-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 01:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genius_hyip`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_processes`
--

CREATE TABLE `account_processes` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_processes`
--

INSERT INTO `account_processes` (`id`, `icon`, `title`, `details`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-exchange-alt', 'Get Profit', 'Repellendus consequuntur vel nam numquam labore reiciendis rem neque eveniet, dicta molestias.', '2022-02-21 04:29:32', '2022-03-16 09:15:15'),
(2, 'fas fa-user-check', 'Purchase Investment Plan', 'Repellendus consequuntur vel nam numquam labore reiciendis rem neque eveniet, dicta molestias.', '2022-02-21 04:29:57', '2022-03-16 09:14:16'),
(3, 'fas fa-user-plus', 'Create Account', 'Repellendus consequuntur vel nam numquam labore reiciendis rem neque eveniet, dicta molestias.', '2022-02-21 04:30:19', '2022-03-16 09:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 0,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `role_id`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01629552892', 0, 'nB8Hlzch1649567593.jpg', '$2y$10$NSxBfIBeDdxRjisT83p/0uN4GN4LcbYvKzuazAfyekwPffExwBUpO', 1, 'nL2JkhiOxuTHj3UXgkaULKuDTC7e292XrNTeSkn8gjnulpc17HoYyw9Cp4hW', '2018-02-28 23:27:08', '2022-04-10 05:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `admin_languages`
--

CREATE TABLE `admin_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_languages`
--

INSERT INTO `admin_languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 1, 'En', '1603880510hWH6gk7S.json', '1603880510hWH6gk7S', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_conversations`
--

CREATE TABLE `admin_user_conversations` (
  `id` int(191) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ticket_number` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_conversations`
--

INSERT INTO `admin_user_conversations` (`id`, `user_id`, `ticket_number`, `subject`, `message`, `attachment`, `created_at`, `updated_at`) VALUES
(23, 50, '#TKT461018', 'Money transfer issue', 'Can you please check my ticket?', 'm0xSBr1p1649328495.png', '2022-04-07 10:48:15', '2022-04-07 10:48:15'),
(24, 86, '#TKT945871', 'Money sending issue', 'i can not send money.', 'qSXnthRq1649579766.jpg', '2022-04-10 08:36:06', '2022-04-10 08:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_messages`
--

CREATE TABLE `admin_user_messages` (
  `id` int(191) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conversation_id` int(191) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_messages`
--

INSERT INTO `admin_user_messages` (`id`, `user_id`, `conversation_id`, `message`, `photo`, `created_at`, `updated_at`) VALUES
(44, 50, 23, 'Can you please check my ticket?', 'm0xSBr1p1649328495.png', '2022-04-07 10:48:15', '2022-04-07 10:48:15'),
(45, 50, 23, 'Can you again check?', 'RLcBMrlm1649479805.png', '2022-04-09 04:50:05', '2022-04-09 04:50:05'),
(46, 86, 24, 'i can not send money.', 'qSXnthRq1649579766.jpg', '2022-04-10 08:36:06', '2022-04-10 08:36:06'),
(47, 86, 24, 'please hurry up.', 'wqA2cc6q1649579811.jpg', '2022-04-10 08:36:51', '2022-04-10 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `final_amount` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance_transfers`
--

INSERT INTO `balance_transfers` (`id`, `user_id`, `receiver_id`, `transaction_no`, `cost`, `amount`, `final_amount`, `status`, `created_at`, `updated_at`) VALUES
(58, 50, 51, 'n92c1648544356', 0, 10, NULL, 1, '2022-03-29 08:59:16', '2022-03-29 08:59:16'),
(59, 50, 51, 'yXFi1648545067', 0, 20, NULL, 1, '2022-03-29 09:11:07', '2022-03-29 09:11:07'),
(60, 50, 51, 'drGU1648545083', 0, 50, NULL, 1, '2022-03-29 09:11:23', '2022-03-29 09:11:23'),
(61, 86, 51, 'j9Ck1649581424', 0, 100, NULL, 1, '2022-04-10 09:03:44', '2022-04-10 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(191) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `details`, `photo`, `source`, `views`, `status`, `meta_tag`, `meta_description`, `tags`, `created_at`) VALUES
(24, 6, 'CRYPTO.COM APP LISTS IDEX (IDEX)', 'cryptocom-app-lists-idex-idex', 'IDEX (IDEX) is now listed in the Crypto.com App, joining the growing list of 250+ supported cryptocurrencies and stablecoins, including Bitcoin (BTC), Ether (ETH), Polkadot (DOT), Chainlink (LINK), VeChain (VET), USD Coin (USDC), and Crypto.org Coin (CRO). IDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading. IDEX is an Ethereum token that powers the IDEX decentralised exchange. IDEX holders can stake tokens in order to help secure the protocol and earn rewards. Crypto.com App users can now purchase IDEX at true cost with USD, EUR, GBP, and 20+ fiat currencies, and spend it at over 80 million merchants globally using the Crypto.com Visa Card.\r\n\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\n\r\nIDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading', 'nMI5Kv5P1647402900.jpg', 'www.geniusocean.com', 55, 1, 'Ethereum', NULL, 'DEX,exchanges,Ethereum', '2019-01-03 06:03:37'),
(29, 7, 'The First Margin Trading Race of 2022 Has Landed!', 'the-first-margin-trading-race-of-2022-has-landed', 'The Crypto.com Exchange’s first Margin Trading Race of 2022 is locked, loaded, and ready to go! If you haven’t Margin traded in a while, it’s time to shake off the dust. Here’s why: the first 500 users who Margin trade at least USD 100 of any pair will score USD 50 in CRO and the chance to win tickets to a PSG vs Real Madrid Champions League game. New and existing users with a Margin Trading account who have not made a Margin trade since 1 November 2021 are eligible for this campaign. Campaign Period: 14 January 2022 at 08:00 UTC - 26 January 2022 at 00:00 UTC How to participate: Sign in or sign up to the Crypto.com Exchange Open a Margin Wallet (if you are new to Margin Trading) Margin trade at least USD 100 of any pair (FAQ, How-to video) Register for the campaign here. The first 500 eligible users who Margin trade at least USD 100 during the Campaign Period will win a share of USD 25,000 in CRO. Among the winners, three lucky traders will each receive one pair of tickets to the PSG vs Real Madrid Champions League game on 15 February 2022 at Paris Saint-Germain’s homeground, Le Parc des Princes! <> What is Margin Trading? Margin Trading allows users to amplify their trading profits through borrowed funds during both up and down market movements. Users can access up to 3x leverage for eligible pairs. The Crypto.com Coin (CRO) powers Margin Trading with additional utility, offering preferential interest rates—as low as 0.008% per day—to users who stake CRO. Check out our step-by-step video guides on How to Set Up Your Margin Trading Account and Use your Margin Trading Account.\r\n\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\nUseful Links: Join us on Telegram to connect with our community. Refer to this FAQ for the latest list of supported margin trading pairs. Refer to this Margin Trading FAQ for more details about borrowing limits, and interest rates. Notes: In addition to the following rules, please refer to the Official Rules for Sweepstakes for further rules regarding eligibility. The Margin Trading Campaign is offered by Crypto.com to Crypto.com Exchange users. Any trades that are executed through bad trading practices in Crypto.com’s absolute opinion, including but not limited to wash trades, false trading, self-dealing, or trades that display any attributes of market manipulation (“Disqualified Trades”) will not be counted towards the transaction volume of the participant. The links provided above to helpful information are for reference only. The Reward will be paid in CRO and will be credited into the winners’ Crypto.com Exchange CRO Wallet within 30 days after the Reward Period ends. The Paris Saint-Germain tickets will be e-mailed to the winners’ Crypto.com E-mail address 3-5 days prior to the game. Winners may be required to prove eligibility including proof of age, residence, and identity, which may include submitting a copy of his/her passport or similar government issued identification to collect the e-tickets. Crypto.com is not responsible for paying any additional fees associated with the redemption or usage of the prizes e.g including but not limited to personal expenses, taxes, etc. Margin trading geo-restrictions apply, please refer to this list for the excluded jurisdictions. The eligibility of participants will be verified by Crypto.com after the campaign ends and the lucky draw results will be published. Crypto.com reserves the right to cancel or amend the campaign rules at our sole discretion. All personal data collected is used strictly for verification purposes only. By accepting the prize, winners agree to the Privacy Notice of Crypto.com, which is published at crypto.com/en/privacy/global.html.', '73oKoC6W1647403134.jpg', 'winners agree to the Privacy Notice of Crypto.com', 1, 1, NULL, NULL, 'verification,Crypto', '2022-03-16 03:58:54'),
(30, 5, 'RUNE Exclusive Campaign Winner Announcement', 'rune-exclusive-campaign-winner-announcement', 'We’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token. Congratulations to all the winners! You will soon receive an email from us. Part 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool) The top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE. *RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE) Users can be rewarded for both Part 1 and Part 2 of the campaign. For more information about the promotion, please visit our blog. Note: The eligibility of participants will be verified by Crypto.com after the campaign ends.\r\n<br><br>\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\n<br>\r\nWe’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token. Congratulations to all the winners! You will soon receive an email from us. Part 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool) The top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE. *RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE) Users can be rewarded for both Part 1 and Part 2 of the campaign. For more information about the promotion, please visit our blog. Note: The eligibility of participants will be verified by Crypto.com after the campaign ends.', 'D0trrRpB1647403318.jpg', 'genius', 20, 1, NULL, NULL, NULL, '2022-03-16 04:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(191) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`) VALUES
(2, 'Support', 'support'),
(3, 'Tickets', 'tickets'),
(4, 'Transactions', 'transactions'),
(5, 'Withdraw', 'withdraw'),
(6, 'Deposit', 'deposit'),
(7, 'Wallet', 'wallet');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `photo`, `created_at`, `updated_at`) VALUES
(6, 'mSnEyUep1649491997.png', '2022-04-09 06:50:21', '2022-04-09 08:13:17'),
(7, 'pMbcAFKR1649491987.png', '2022-04-09 06:50:24', '2022-04-09 08:13:07'),
(8, 'Py0hxvZJ1649491978.png', '2022-04-09 06:52:16', '2022-04-09 08:12:58'),
(9, 'vd011rjK1649492005.png', '2022-04-09 08:13:25', '2022-04-09 08:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `messurement` varchar(255) DEFAULT NULL,
  `is_money` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `title`, `photo`, `count`, `messurement`, `is_money`, `created_at`, `updated_at`) VALUES
(1, 'Deposit', 'wheNFyi41649484116.png', '235', 'm', 0, '2022-02-20 22:56:47', '2022-04-09 06:01:56'),
(3, 'Total Wallet', 'eTnFB2l61649484081.png', '30', '+', 0, '2022-02-20 23:15:03', '2022-04-09 06:01:21'),
(4, 'Happy Users', 'uwPHA7kw1649483866.png', '58', 'k', 0, '2022-02-20 23:16:18', '2022-04-09 06:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` int(11) NOT NULL,
  `postcode_required` tinyint(4) NOT NULL DEFAULT 0,
  `is_eu` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso2`, `iso3`, `phone_code`, `postcode_required`, `is_eu`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Andorra', 'AD', 'AND', 376, 0, 0, 0, NULL, NULL),
(2, 'United Arab Emirates', 'AE', 'ARE', 971, 0, 0, 0, NULL, NULL),
(3, 'Afghanistan', 'AF', 'AFG', 93, 0, 0, 0, NULL, NULL),
(4, 'Antigua and Barbuda', 'AG', 'ATG', 1268, 0, 0, 0, NULL, NULL),
(5, 'Anguilla', 'AI', 'AIA', 1264, 0, 0, 0, NULL, NULL),
(6, 'Albania', 'AL', 'ALB', 355, 0, 0, 0, NULL, NULL),
(7, 'Armenia', 'AM', 'ARM', 374, 0, 0, 0, NULL, NULL),
(8, 'Angola', 'AO', 'AGO', 244, 0, 0, 0, NULL, NULL),
(9, 'Antarctica', 'AQ', 'ATA', 672, 0, 0, 0, NULL, NULL),
(10, 'Argentina', 'AR', 'ARG', 54, 0, 0, 0, NULL, NULL),
(11, 'American Samoa', 'AS', 'ASM', 1684, 0, 0, 0, NULL, NULL),
(12, 'Austria', 'AT', 'AUT', 43, 0, 0, 0, NULL, NULL),
(13, 'Australia', 'AU', 'AUS', 61, 0, 0, 0, NULL, NULL),
(14, 'Aruba', 'AW', 'ABW', 297, 0, 0, 0, NULL, NULL),
(15, 'Åland Islands', 'AX', 'ALA', 0, 0, 0, 0, NULL, NULL),
(16, 'Azerbaijan', 'AZ', 'AZE', 994, 0, 0, 0, NULL, NULL),
(17, 'Bosnia and Herzegovina', 'BA', 'BIH', 387, 0, 0, 0, NULL, NULL),
(18, 'Barbados', 'BB', 'BRB', 1246, 0, 0, 0, NULL, NULL),
(19, 'Bangladesh', 'BD', 'BGD', 880, 0, 0, 0, NULL, NULL),
(20, 'Belgium', 'BE', 'BEL', 32, 0, 0, 0, NULL, NULL),
(21, 'Burkina Faso', 'BF', 'BFA', 226, 0, 0, 0, NULL, NULL),
(22, 'Bulgaria', 'BG', 'BGR', 359, 0, 0, 0, NULL, NULL),
(23, 'Bahrain', 'BH', 'BHR', 973, 0, 0, 0, NULL, NULL),
(24, 'Burundi', 'BI', 'BDI', 257, 0, 0, 0, NULL, NULL),
(25, 'Benin', 'BJ', 'BEN', 229, 0, 0, 0, NULL, NULL),
(26, 'Saint Barthélemy', 'BL', 'BLM', 0, 0, 0, 0, NULL, NULL),
(27, 'Bermuda', 'BM', 'BMU', 1441, 0, 0, 0, NULL, NULL),
(28, 'Brunei Darussalam', 'BN', 'BRN', 673, 0, 0, 0, NULL, NULL),
(29, 'Bolivia', 'BO', 'BOL', 591, 0, 0, 0, NULL, NULL),
(30, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', 0, 0, 0, 0, NULL, NULL),
(31, 'Brazil', 'BR', 'BRA', 55, 0, 0, 0, NULL, NULL),
(32, 'Bahamas', 'BS', 'BHS', 1242, 0, 0, 0, NULL, NULL),
(33, 'Bhutan', 'BT', 'BTN', 975, 0, 0, 0, NULL, NULL),
(34, 'Bouvet Island', 'BV', 'BVT', 44, 0, 0, 0, NULL, NULL),
(35, 'Botswana', 'BW', 'BWA', 267, 0, 0, 0, NULL, NULL),
(36, 'Belarus', 'BY', 'BLR', 375, 0, 0, 0, NULL, NULL),
(37, 'Belize', 'BZ', 'BLZ', 501, 0, 0, 0, NULL, NULL),
(38, 'Canada', 'CA', 'CAN', 1, 0, 0, 0, NULL, NULL),
(39, 'Cocos (Keeling) Islands', 'CC', 'CCK', 61, 0, 0, 0, NULL, NULL),
(40, 'Congo (Democratic Republic of the)', 'CD', 'COD', 243, 0, 0, 0, NULL, NULL),
(41, 'Central African Republic', 'CF', 'CAF', 236, 0, 0, 0, NULL, NULL),
(42, 'Congo', 'CG', 'COG', 242, 0, 0, 0, NULL, NULL),
(43, 'Switzerland', 'CH', 'CHE', 41, 0, 0, 0, NULL, NULL),
(44, 'Ivory Coast', 'CI', 'CIV', 225, 0, 0, 0, NULL, NULL),
(45, 'Cook Islands', 'CK', 'COK', 682, 0, 0, 0, NULL, NULL),
(46, 'Chile', 'CL', 'CHL', 56, 0, 0, 0, NULL, NULL),
(47, 'Cameroon', 'CM', 'CMR', 237, 0, 0, 0, NULL, NULL),
(48, 'China', 'CN', 'CHN', 86, 0, 0, 0, NULL, NULL),
(49, 'Colombia', 'CO', 'COL', 57, 0, 0, 0, NULL, NULL),
(50, 'Costa Rica', 'CR', 'CRI', 506, 0, 0, 0, NULL, NULL),
(51, 'Cuba', 'CU', 'CUB', 53, 0, 0, 0, NULL, NULL),
(52, 'Cape Verde', 'CV', 'CPV', 238, 0, 0, 0, NULL, NULL),
(53, 'Curaçao', 'CW', 'CUW', 0, 0, 0, 0, NULL, NULL),
(54, 'Christmas Island', 'CX', 'CXR', 61, 0, 0, 0, NULL, NULL),
(55, 'Cyprus', 'CY', 'CYP', 357, 0, 0, 0, NULL, NULL),
(56, 'Czech Republic', 'CZ', 'CZE', 420, 0, 0, 0, NULL, NULL),
(57, 'Germany', 'DE', 'DEU', 49, 0, 0, 0, NULL, NULL),
(58, 'Djibouti', 'DJ', 'DJI', 253, 0, 0, 0, NULL, NULL),
(59, 'Denmark', 'DK', 'DNK', 45, 0, 0, 0, NULL, NULL),
(60, 'Dominica', 'DM', 'DMA', 1767, 0, 0, 0, NULL, NULL),
(61, 'Dominican Republic', 'DO', 'DOM', 1809, 0, 0, 0, NULL, NULL),
(62, 'Algeria', 'DZ', 'DZA', 213, 0, 0, 0, NULL, NULL),
(63, 'Ecuador', 'EC', 'ECU', 593, 0, 0, 0, NULL, NULL),
(64, 'Estonia', 'EE', 'EST', 372, 0, 0, 0, NULL, NULL),
(65, 'Egypt', 'EG', 'EGY', 20, 0, 0, 0, NULL, NULL),
(66, 'Western Sahara', 'EH', 'ESH', 0, 0, 0, 0, NULL, NULL),
(67, 'Eritrea', 'ER', 'ERI', 291, 0, 0, 0, NULL, NULL),
(68, 'Spain', 'ES', 'ESP', 34, 0, 0, 0, NULL, NULL),
(69, 'Ethiopia', 'ET', 'ETH', 251, 0, 0, 0, NULL, NULL),
(70, 'Finland', 'FI', 'FIN', 358, 0, 0, 0, NULL, NULL),
(71, 'Fiji', 'FJ', 'FJI', 679, 0, 0, 0, NULL, NULL),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 500, 0, 0, 0, NULL, NULL),
(73, 'Micronesia (Federated States of)', 'FM', 'FSM', 691, 0, 0, 0, NULL, NULL),
(74, 'Faroe Islands', 'FO', 'FRO', 298, 0, 0, 0, NULL, NULL),
(75, 'France', 'FR', 'FRA', 33, 0, 0, 0, NULL, NULL),
(76, 'Gabon', 'GA', 'GAB', 241, 0, 0, 0, NULL, NULL),
(77, 'United Kingdom', 'GB', 'GBR', 44, 1, 0, 0, NULL, NULL),
(78, 'Grenada', 'GD', 'GRD', 1473, 0, 0, 0, NULL, NULL),
(79, 'Georgia', 'GE', 'GEO', 995, 0, 0, 0, NULL, NULL),
(80, 'French Guiana', 'GF', 'GUF', 594, 0, 0, 0, NULL, NULL),
(81, 'Guernsey', 'GG', 'GGY', 0, 0, 0, 0, NULL, NULL),
(82, 'Ghana', 'GH', 'GHA', 233, 0, 0, 0, NULL, NULL),
(83, 'Gibraltar', 'GI', 'GIB', 350, 0, 0, 0, NULL, NULL),
(84, 'Greenland', 'GL', 'GRL', 299, 0, 0, 0, NULL, NULL),
(85, 'Gambia', 'GM', 'GMB', 220, 0, 0, 0, NULL, NULL),
(86, 'Guinea', 'GN', 'GIN', 224, 0, 0, 0, NULL, NULL),
(87, 'Guadeloupe', 'GP', 'GLP', 590, 0, 0, 0, NULL, NULL),
(88, 'Equatorial Guinea', 'GQ', 'GNQ', 240, 0, 0, 0, NULL, NULL),
(89, 'Greece', 'GR', 'GRC', 30, 0, 0, 0, NULL, NULL),
(90, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 44, 0, 0, 0, NULL, NULL),
(91, 'Guatemala', 'GT', 'GTM', 502, 0, 0, 0, NULL, NULL),
(92, 'Guam', 'GU', 'GUM', 1671, 0, 0, 0, NULL, NULL),
(93, 'Guinea-Bissau', 'GW', 'GNB', 245, 0, 0, 0, NULL, NULL),
(94, 'Guyana', 'GY', 'GUY', 592, 0, 0, 0, NULL, NULL),
(95, 'Hong Kong', 'HK', 'HKG', 852, 0, 0, 0, NULL, NULL),
(96, 'Heard Island and McDonald Islands', 'HM', 'HMD', 44, 0, 0, 0, NULL, NULL),
(97, 'Honduras', 'HN', 'HND', 504, 0, 0, 0, NULL, NULL),
(98, 'Croatia (Hrvatska)', 'HR', 'HRV', 385, 0, 0, 0, NULL, NULL),
(99, 'Haiti', 'HT', 'HTI', 509, 0, 0, 0, NULL, NULL),
(100, 'Hungary', 'HU', 'HUN', 36, 0, 0, 0, NULL, NULL),
(101, 'Indonesia', 'ID', 'IDN', 62, 0, 0, 0, NULL, NULL),
(102, 'Ireland', 'IE', 'IRL', 353, 0, 0, 0, NULL, NULL),
(103, 'Israel', 'IL', 'ISR', 972, 0, 0, 0, NULL, NULL),
(104, 'Isle of Man', 'IM', 'IMN', 0, 0, 0, 0, NULL, NULL),
(105, 'India', 'IN', 'IND', 91, 0, 0, 0, NULL, NULL),
(106, 'British Indian Ocean Territory', 'IO', 'IOT', 0, 0, 0, 0, NULL, NULL),
(107, 'Iraq', 'IQ', 'IRQ', 964, 0, 0, 0, NULL, NULL),
(108, 'Iran (Islamic Republic of)', 'IR', 'IRN', 98, 0, 0, 0, NULL, NULL),
(109, 'Iceland', 'IS', 'ISL', 354, 0, 0, 0, NULL, NULL),
(110, 'Italy', 'IT', 'ITA', 39, 0, 0, 0, NULL, NULL),
(111, 'Jersey', 'JE', 'JEY', 0, 0, 0, 0, NULL, NULL),
(112, 'Jamaica', 'JM', 'JAM', 1876, 0, 0, 0, NULL, NULL),
(113, 'Jordan', 'JO', 'JOR', 962, 0, 0, 0, NULL, NULL),
(114, 'Japan', 'JP', 'JPN', 81, 0, 0, 0, NULL, NULL),
(115, 'Kenya', 'KE', 'KEN', 254, 0, 0, 0, NULL, NULL),
(116, 'Kyrgyzstan', 'KG', 'KGZ', 996, 0, 0, 0, NULL, NULL),
(117, 'Cambodia', 'KH', 'KHM', 855, 0, 0, 0, NULL, NULL),
(118, 'Kiribati', 'KI', 'KIR', 686, 0, 0, 0, NULL, NULL),
(119, 'Comoros', 'KM', 'COM', 269, 0, 0, 0, NULL, NULL),
(120, 'Saint Kitts and Nevis', 'KN', 'KNA', 1869, 0, 0, 0, NULL, NULL),
(121, 'Korea (Democratic People\'s Republic of)', 'KP', 'PRK', 850, 0, 0, 0, NULL, NULL),
(122, 'Korea (Republic of)', 'KR', 'KOR', 82, 0, 0, 0, NULL, NULL),
(123, 'Kuwait', 'KW', 'KWT', 965, 0, 0, 0, NULL, NULL),
(124, 'Cayman Islands', 'KY', 'CYM', 1345, 0, 0, 0, NULL, NULL),
(125, 'Kazakhstan', 'KZ', 'KAZ', 7, 0, 0, 0, NULL, NULL),
(126, 'Lao People\'s Democratic Republic', 'LA', 'LAO', 856, 0, 0, 0, NULL, NULL),
(127, 'Lebanon', 'LB', 'LBN', 961, 0, 0, 0, NULL, NULL),
(128, 'Saint Lucia', 'LC', 'LCA', 1758, 0, 0, 0, NULL, NULL),
(129, 'Liechtenstein', 'LI', 'LIE', 423, 0, 0, 0, NULL, NULL),
(130, 'Sri Lanka', 'LK', 'LKA', 94, 0, 0, 0, NULL, NULL),
(131, 'Liberia', 'LR', 'LBR', 231, 0, 0, 0, NULL, NULL),
(132, 'Lesotho', 'LS', 'LSO', 266, 0, 0, 0, NULL, NULL),
(133, 'Lithuania', 'LT', 'LTU', 370, 0, 0, 0, NULL, NULL),
(134, 'Luxembourg', 'LU', 'LUX', 352, 0, 0, 0, NULL, NULL),
(135, 'Latvia', 'LV', 'LVA', 371, 0, 0, 0, NULL, NULL),
(136, 'Libya', 'LY', 'LBY', 218, 0, 0, 0, NULL, NULL),
(137, 'Morocco', 'MA', 'MAR', 212, 0, 0, 0, NULL, NULL),
(138, 'Monaco', 'MC', 'MCO', 377, 0, 0, 0, NULL, NULL),
(139, 'Moldova (Republic of)', 'MD', 'MDA', 373, 0, 0, 0, NULL, NULL),
(140, 'Montenegro', 'ME', 'MNE', 382, 0, 0, 0, NULL, NULL),
(141, 'Saint Martin (French part)', 'MF', 'MAF', 0, 0, 0, 0, NULL, NULL),
(142, 'Madagascar', 'MG', 'MDG', 261, 0, 0, 0, NULL, NULL),
(143, 'Marshall Islands', 'MH', 'MHL', 692, 0, 0, 0, NULL, NULL),
(144, 'Macedonia', 'MK', 'MKD', 389, 0, 0, 0, NULL, NULL),
(145, 'Mali', 'ML', 'MLI', 223, 0, 0, 0, NULL, NULL),
(146, 'Myanmar', 'MM', 'MMR', 95, 0, 0, 0, NULL, NULL),
(147, 'Mongolia', 'MN', 'MNG', 976, 0, 0, 0, NULL, NULL),
(148, 'Macau', 'MO', 'MAC', 853, 0, 0, 0, NULL, NULL),
(149, 'Northern Mariana Islands', 'MP', 'MNP', 1670, 0, 0, 0, NULL, NULL),
(150, 'Martinique', 'MQ', 'MTQ', 596, 0, 0, 0, NULL, NULL),
(151, 'Mauritania', 'MR', 'MRT', 222, 0, 0, 0, NULL, NULL),
(152, 'Montserrat', 'MS', 'MSR', 1664, 0, 0, 0, NULL, NULL),
(153, 'Malta', 'MT', 'MLT', 356, 0, 0, 0, NULL, NULL),
(154, 'Mauritius', 'MU', 'MUS', 230, 0, 0, 0, NULL, NULL),
(155, 'Maldives', 'MV', 'MDV', 960, 0, 0, 0, NULL, NULL),
(156, 'Malawi', 'MW', 'MWI', 265, 0, 0, 0, NULL, NULL),
(157, 'Mexico', 'MX', 'MEX', 52, 0, 0, 0, NULL, NULL),
(158, 'Malaysia', 'MY', 'MYS', 60, 0, 0, 0, NULL, NULL),
(159, 'Mozambique', 'MZ', 'MOZ', 258, 0, 0, 0, NULL, NULL),
(160, 'Namibia', 'NA', 'NAM', 264, 0, 0, 0, NULL, NULL),
(161, 'New Caledonia', 'NC', 'NCL', 687, 0, 0, 0, NULL, NULL),
(162, 'Niger', 'NE', 'NER', 227, 0, 0, 0, NULL, NULL),
(163, 'Norfolk Island', 'NF', 'NFK', 672, 0, 0, 0, NULL, NULL),
(164, 'Nigeria', 'NG', 'NGA', 234, 0, 0, 0, NULL, NULL),
(165, 'Nicaragua', 'NI', 'NIC', 505, 0, 0, 0, NULL, NULL),
(166, 'Netherlands', 'NL', 'NLD', 31, 0, 0, 0, NULL, NULL),
(167, 'Norway', 'NO', 'NOR', 47, 0, 0, 0, NULL, NULL),
(168, 'Nepal', 'NP', 'NPL', 977, 0, 0, 0, NULL, NULL),
(169, 'Nauru', 'NR', 'NRU', 674, 0, 0, 0, NULL, NULL),
(170, 'Niue', 'NU', 'NIU', 683, 0, 0, 0, NULL, NULL),
(171, 'New Zealand', 'NZ', 'NZL', 64, 0, 0, 0, NULL, NULL),
(172, 'Oman', 'OM', 'OMN', 968, 0, 0, 0, NULL, NULL),
(173, 'Panama', 'PA', 'PAN', 507, 0, 0, 0, NULL, NULL),
(174, 'Peru', 'PE', 'PER', 51, 0, 0, 0, NULL, NULL),
(175, 'French Polynesia', 'PF', 'PYF', 689, 0, 0, 0, NULL, NULL),
(176, 'Papua New Guinea', 'PG', 'PNG', 675, 0, 0, 0, NULL, NULL),
(177, 'Philippines', 'PH', 'PHL', 63, 0, 0, 0, NULL, NULL),
(178, 'Pakistan', 'PK', 'PAK', 92, 0, 0, 0, NULL, NULL),
(179, 'Poland', 'PL', 'POL', 48, 0, 0, 0, NULL, NULL),
(180, 'Saint Pierre and Miquelon', 'PM', 'SPM', 508, 0, 0, 0, NULL, NULL),
(181, 'Pitcairn', 'PN', 'PCN', 870, 0, 0, 0, NULL, NULL),
(182, 'Puerto Rico', 'PR', 'PRI', 1, 0, 0, 0, NULL, NULL),
(183, 'Palestine, State of', 'PS', 'PSE', 0, 0, 0, 0, NULL, NULL),
(184, 'Portugal', 'PT', 'PRT', 351, 0, 0, 0, NULL, NULL),
(185, 'Palau', 'PW', 'PLW', 680, 0, 0, 0, NULL, NULL),
(186, 'Paraguay', 'PY', 'PRY', 595, 0, 0, 0, NULL, NULL),
(187, 'Qatar', 'QA', 'QAT', 974, 0, 0, 0, NULL, NULL),
(188, 'Reunion', 'RE', 'REU', 262, 0, 0, 0, NULL, NULL),
(189, 'Romania', 'RO', 'ROU', 40, 0, 0, 0, NULL, NULL),
(190, 'Serbia', 'RS', 'SRB', 381, 0, 0, 0, NULL, NULL),
(191, 'Russian Federation', 'RU', 'RUS', 7, 0, 0, 0, NULL, NULL),
(192, 'Rwanda', 'RW', 'RWA', 250, 0, 0, 0, NULL, NULL),
(193, 'Saudi Arabia', 'SA', 'SAU', 966, 0, 0, 0, NULL, NULL),
(194, 'Solomon Islands', 'SB', 'SLB', 677, 0, 0, 0, NULL, NULL),
(195, 'Seychelles', 'SC', 'SYC', 248, 0, 0, 0, NULL, NULL),
(196, 'Sudan', 'SD', 'SDN', 249, 0, 0, 0, NULL, NULL),
(197, 'Sweden', 'SE', 'SWE', 46, 0, 0, 0, NULL, NULL),
(198, 'Singapore', 'SG', 'SGP', 65, 0, 0, 0, NULL, NULL),
(199, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 290, 0, 0, 0, NULL, NULL),
(200, 'Slovenia', 'SI', 'SVN', 386, 0, 0, 0, NULL, NULL),
(201, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 0, 0, 0, 0, NULL, NULL),
(202, 'Slovakia', 'SK', 'SVK', 421, 0, 0, 0, NULL, NULL),
(203, 'Sierra Leone', 'SL', 'SLE', 232, 0, 0, 0, NULL, NULL),
(204, 'San Marino', 'SM', 'SMR', 378, 0, 0, 0, NULL, NULL),
(205, 'Senegal', 'SN', 'SEN', 221, 0, 0, 0, NULL, NULL),
(206, 'Somalia', 'SO', 'SOM', 252, 0, 0, 0, NULL, NULL),
(207, 'Suriname', 'SR', 'SUR', 597, 0, 0, 0, NULL, NULL),
(208, 'South Sudan', 'SS', 'SSD', 0, 0, 0, 0, NULL, NULL),
(209, 'Sao Tome and Principe', 'ST', 'STP', 239, 0, 0, 0, NULL, NULL),
(210, 'El Salvador', 'SV', 'SLV', 503, 0, 0, 0, NULL, NULL),
(211, 'Sint Maarten (Dutch part)', 'SX', 'SXM', 0, 0, 0, 0, NULL, NULL),
(212, 'Syrian Arab Republic', 'SY', 'SYR', 963, 0, 0, 0, NULL, NULL),
(213, 'Swaziland', 'SZ', 'SWZ', 268, 0, 0, 0, NULL, NULL),
(214, 'Turks and Caicos Islands', 'TC', 'TCA', 1649, 0, 0, 0, NULL, NULL),
(215, 'Chad', 'TD', 'TCD', 235, 0, 0, 0, NULL, NULL),
(216, 'French Southern Territories', 'TF', 'ATF', 44, 0, 0, 0, NULL, NULL),
(217, 'Togo', 'TG', 'TGO', 228, 0, 0, 0, NULL, NULL),
(218, 'Thailand', 'TH', 'THA', 66, 0, 0, 0, NULL, NULL),
(219, 'Tajikistan', 'TJ', 'TJK', 992, 0, 0, 0, NULL, NULL),
(220, 'Tokelau', 'TK', 'TKL', 690, 0, 0, 0, NULL, NULL),
(221, 'Timor-Leste', 'TL', 'TLS', 670, 0, 0, 0, NULL, NULL),
(222, 'Turkmenistan', 'TM', 'TKM', 993, 0, 0, 0, NULL, NULL),
(223, 'Tunisia', 'TN', 'TUN', 216, 0, 0, 0, NULL, NULL),
(224, 'Tonga', 'TO', 'TON', 676, 0, 0, 0, NULL, NULL),
(225, 'Turkey', 'TR', 'TUR', 90, 0, 0, 0, NULL, NULL),
(226, 'Trinidad and Tobago', 'TT', 'TTO', 1868, 0, 0, 0, NULL, NULL),
(227, 'Tuvalu', 'TV', 'TUV', 688, 0, 0, 0, NULL, NULL),
(228, 'Taiwan', 'TW', 'TWN', 886, 0, 0, 0, NULL, NULL),
(229, 'Tanzania, United Republic of', 'TZ', 'TZA', 255, 0, 0, 0, NULL, NULL),
(230, 'Ukraine', 'UA', 'UKR', 380, 0, 0, 0, NULL, NULL),
(231, 'Uganda', 'UG', 'UGA', 256, 0, 0, 0, NULL, NULL),
(232, 'United States Minor Outlying Islands', 'UM', 'UMI', 44, 0, 0, 0, NULL, NULL),
(233, 'United States of America', 'US', 'USA', 1, 0, 0, 0, NULL, NULL),
(234, 'Uruguay', 'UY', 'URY', 598, 0, 0, 0, NULL, NULL),
(235, 'Uzbekistan', 'UZ', 'UZB', 998, 0, 0, 0, NULL, NULL),
(236, 'Vatican City State', 'VA', 'VAT', 39, 0, 0, 0, NULL, NULL),
(237, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1784, 0, 0, 0, NULL, NULL),
(238, 'Venezuela', 'VE', 'VEN', 58, 0, 0, 0, NULL, NULL),
(239, 'Virgin Islands (British)', 'VG', 'VGB', 1284, 0, 0, 0, NULL, NULL),
(240, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1340, 0, 0, 0, NULL, NULL),
(241, 'Viet Nam', 'VN', 'VNM', 84, 0, 0, 0, NULL, NULL),
(242, 'Vanuatu', 'VU', 'VUT', 678, 0, 0, 0, NULL, NULL),
(243, 'Wallis and Futuna', 'WF', 'WLF', 681, 0, 0, 0, NULL, NULL),
(244, 'Samoa', 'WS', 'WSM', 685, 0, 0, 0, NULL, NULL),
(245, 'Yemen', 'YE', 'YEM', 967, 0, 0, 0, NULL, NULL),
(246, 'Mayotte', 'YT', 'MYT', 262, 0, 0, 0, NULL, NULL),
(247, 'South Africa', 'ZA', 'ZAF', 27, 0, 0, 0, NULL, NULL),
(248, 'Zambia', 'ZM', 'ZMB', 260, 0, 0, 0, NULL, NULL),
(249, 'Zimbabwe', 'ZW', 'ZWE', 263, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(191) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`) VALUES
(1, 'USD', '$', 1, 1),
(4, 'BDT', '৳', 82.92649841308594, 0),
(6, 'EUR', '€', 0.864870011806488, 0),
(8, 'NGN', '₦', 410.94, 0),
(9, 'INR', '₹', 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposit_number`, `user_id`, `amount`, `currency_id`, `txnid`, `method`, `charge_id`, `status`, `created_at`, `updated_at`) VALUES
(133, 'EJdyfqHt5KGy', 50, 100, 1, '1XA5772180710523D', 'paypal', NULL, 'complete', '2022-04-05 06:17:08', '2022-04-05 06:17:30'),
(134, 'jjzUVSakJEj9', 50, 100, 1, 'txn_3Kl5iJJlIV5dN9n71gyvOLa2', 'stripe', 'ch_3Kl5iJJlIV5dN9n71zhYxjEm', 'complete', '2022-04-05 06:18:03', '2022-04-05 06:18:03'),
(135, 'oIyioanTocuz', 50, 1.3513513513514, 9, '8a7252352d38470a99c9f98952aa4e03', 'instamojo', NULL, 'complete', '2022-04-05 06:19:44', '2022-04-05 06:19:44'),
(136, 'HWkX8iwcn4zU', 50, 1.3513513513514, 9, '20220405111212800110168405703598437', 'paytm', NULL, 'complete', '2022-04-05 06:19:59', '2022-04-05 06:20:09'),
(137, '1AmWjnxkNeUJ', 50, 1.3513513513514, NULL, 'order_JFZdBipfRZtSVe', 'razorpay', NULL, 'complete', '2022-04-05 06:20:53', '2022-04-05 06:20:53'),
(138, 'bugVq4Bz0tAd', 50, 100, 1, NULL, 'flutterwave', NULL, 'complete', '2022-04-05 06:22:30', '2022-04-05 06:22:59'),
(139, 'dKpYLU0b4sVf', 86, 100, 1, 'txn_3KmveNJlIV5dN9n71rFC0Wr3', 'stripe', 'ch_3KmveNJlIV5dN9n71z9kIS84', 'complete', '2022-04-10 07:57:34', '2022-04-10 07:57:34'),
(140, 'LYNDTrU8HRJM', 86, 100, 1, 'txn_3KmveNJlIV5dN9n71chzauDD', 'stripe', 'ch_3KmveNJlIV5dN9n71z5n3O8m', 'complete', '2022-04-10 07:57:34', '2022-04-10 07:57:34'),
(141, 'gIKbWTpxyU90', 86, 100, 1, 'txn_3KmwYBJlIV5dN9n71JCFWfUK', 'stripe', 'ch_3KmwYBJlIV5dN9n71q67Fuid', 'complete', '2022-04-10 08:55:15', '2022-04-10 08:55:15'),
(142, 'fcif756jcQDT', 86, 1000, 1, '9LB83562WH396282D', 'paypal', NULL, 'complete', '2022-04-10 08:55:38', '2022-04-10 08:56:10'),
(143, 'SGH2cQnpgglj', 86, 1.3513513513514, 9, '20220410111212800110168467703609966', 'paytm', NULL, 'complete', '2022-04-10 08:58:01', '2022-04-10 08:58:28'),
(144, 'YuF2SQTz6whJ', 86, 1.3513513513514, NULL, 'order_JHb0k1w7m1sYGN', 'razorpay', NULL, 'complete', '2022-04-10 08:59:51', '2022-04-10 08:59:51'),
(145, 'zA0ZENpiih3X', 86, 100, 1, NULL, 'authorize.net', NULL, 'complete', '2022-04-10 09:01:24', '2022-04-10 09:01:24'),
(146, 'Jy8RrmpqgqKe', 86, 100, 1, NULL, 'flutterwave', NULL, 'complete', '2022-04-10 09:01:51', '2022-04-10 09:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_body` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`) VALUES
(3, 'Withdraw', 'Your withdraw is completed successfully.', '<p>Hello {customer_name},<br>Your withdraw is completed successfully.</p><p>Thank You<br></p>', 1),
(4, 'Deposti', 'You have invested successfully.', '<p>Hello {customer_name},<br>You have deposited successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `details`, `status`) VALUES
(1, 'Right my front it wound cause fully', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 1),
(3, 'Man particular insensible celebrated', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 1),
(4, 'Qui ducimus praesentium ullam voluptatem?', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 0),
(5, 'Sunt soluta laborum dolore voluptas natus?', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n\r\n Facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 0),
(6, 'Possimus expedita dolorum fugit mollitia, optio quo?', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `details`, `icon`) VALUES
(8, 'Daily Profit', 'DAILY PROFIT. You can make profit every day with our investment proposals!', 'fas fa-cog'),
(9, 'Special Security', 'Your deposits are insured by our Special Trust Fund. Your deposits are safe.', 'fas fa-cog'),
(10, 'Extreme Support', 'Our specialists are available around the clock to help you. Please let us know your questions.', 'fas fa-cog'),
(11, 'Limitless Investment', 'INVESTING WITHOUT BORDERS. You can invest in our company from anywhere in the world.', 'fas fa-cog');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_family`, `font_value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Rubik', 'Rubik', 0, '2021-09-07 22:34:28', '2022-03-03 09:24:36'),
(2, 'Roboto', 'Roboto', 0, '2021-09-07 22:35:10', '2022-03-03 09:24:36'),
(3, 'New Tegomin', 'New+Tegomin', 0, '2021-09-07 22:35:23', '2022-03-03 09:24:36'),
(5, 'Open Sans', 'Open+Sans', 0, '2021-09-07 22:44:49', '2022-03-03 09:24:36'),
(11, 'Manrope', 'Manrope', 1, '2022-03-03 09:24:26', '2022-03-03 09:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `generalsettings`
--

CREATE TABLE `generalsettings` (
  `id` int(191) NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loader` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_loader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_talkto` tinyint(1) NOT NULL DEFAULT 1,
  `talkto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_language` tinyint(1) NOT NULL DEFAULT 1,
  `is_loader` tinyint(1) NOT NULL DEFAULT 1,
  `map_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disqus` tinyint(1) NOT NULL DEFAULT 0,
  `disqus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_contact` tinyint(1) NOT NULL DEFAULT 0,
  `is_faq` tinyint(1) NOT NULL DEFAULT 0,
  `is_maintain` tinyint(4) NOT NULL DEFAULT 0,
  `maintain_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_of` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_status` tinyint(4) NOT NULL DEFAULT 0,
  `smtp_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_smtp` tinyint(1) NOT NULL DEFAULT 0,
  `is_currency` tinyint(1) NOT NULL DEFAULT 0,
  `currency_format` tinyint(1) NOT NULL DEFAULT 0,
  `subscribe_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribe_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(1) NOT NULL DEFAULT 0,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verification_email` tinyint(1) NOT NULL DEFAULT 0,
  `withdraw_fee` double NOT NULL DEFAULT 0,
  `withdraw_charge` double NOT NULL DEFAULT 0,
  `is_affilate` tinyint(1) NOT NULL DEFAULT 1,
  `affilate_charge` double NOT NULL DEFAULT 0,
  `affilate_banner` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_string` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gap_limit` int(11) NOT NULL DEFAULT 300,
  `isWallet` tinyint(4) NOT NULL DEFAULT 0,
  `affilate_new_user` int(11) NOT NULL DEFAULT 0,
  `affilate_user` int(11) NOT NULL DEFAULT 0,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pm` tinyint(4) DEFAULT 0,
  `cc_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_transfer` tinyint(4) NOT NULL DEFAULT 0,
  `twilio_account_sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_status` tinyint(4) NOT NULL DEFAULT 0,
  `nexmo_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_status` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor` tinyint(4) NOT NULL DEFAULT 0,
  `kyc` tinyint(4) NOT NULL DEFAULT 0,
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_fixed` double DEFAULT NULL,
  `transfer_percentage` double DEFAULT NULL,
  `transfer_min` double DEFAULT NULL,
  `transfer_max` double DEFAULT NULL,
  `fixed_request_charge` double DEFAULT NULL,
  `percentage_request_charge` double DEFAULT NULL,
  `minimum_request_money` double DEFAULT NULL,
  `maximum_request_money` double DEFAULT NULL,
  `module_section` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `logo`, `favicon`, `loader`, `admin_loader`, `banner`, `title`, `header_email`, `header_phone`, `footer`, `copyright`, `colors`, `is_talkto`, `talkto`, `is_language`, `is_loader`, `map_key`, `is_disqus`, `disqus`, `is_contact`, `is_faq`, `is_maintain`, `maintain_text`, `day_of`, `withdraw_status`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_user`, `smtp_pass`, `from_email`, `from_name`, `is_smtp`, `is_currency`, `currency_format`, `subscribe_success`, `subscribe_error`, `error_title`, `error_text`, `error_photo`, `breadcumb_banner`, `is_admin_loader`, `currency_code`, `currency_sign`, `is_verification_email`, `withdraw_fee`, `withdraw_charge`, `is_affilate`, `affilate_charge`, `affilate_banner`, `secret_string`, `gap_limit`, `isWallet`, `affilate_new_user`, `affilate_user`, `footer_logo`, `pm_account`, `is_pm`, `cc_api_key`, `balance_transfer`, `twilio_account_sid`, `twilio_auth_token`, `twilio_default_number`, `twilio_status`, `nexmo_key`, `nexmo_secret`, `nexmo_default_number`, `nexmo_status`, `two_factor`, `kyc`, `menu`, `transfer_fixed`, `transfer_percentage`, `transfer_min`, `transfer_max`, `fixed_request_charge`, `percentage_request_charge`, `minimum_request_money`, `maximum_request_money`, `module_section`) VALUES
(1, 'Oky5D8721647410759.png', '16393007481563335660service-icon-1.png', '5monWltX1641808745.gif', '33CiUFaI1641808748.gif', '1563350277herobg.jpg', 'Hyip Investment Platform', 'Info@example.com', '0123 456789', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae', 'COPYRIGHT © 2019. All Rights Reserved By <a href=\"http://geniusocean.com/\">GeniusOcean.com</a>', '#0ba026', 0, '<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5bc2019c61d0b77092512d03/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>', 1, 1, 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8', 1, 'newspaper-7', 1, 1, 0, NULL, 'Sun , Tue , Wed , Sat', 1, 'smtp.gmail.com', '587', 'tls', 'ahmmedafzal4@gmail.com', 'ndsspebiafprmlue', 'ahmmedafzal4@gmail.com', 'GeniusOcean', 1, 1, 1, 'You are subscribed Successfully.', 'This email has already been taken.', 'OOPS ! ... PAGE NOT FOUND', 'THE PAGE YOU ARE LOOKING FOR MIGHT HAVE BEEN REMOVED, HAD ITS NAME CHANGED, OR IS TEMPORARILY UNAVAILABLE.', '16392899281561878540404.png', '4oHWW9wP1647317756.png', 1, 'USD', '$', 1, 5, 5, 1, 5, '16406712051566471347add.jpg', 'ZzsMLGKe162CfA5EcG6j', 3000, 1, 5, 5, '1A7mierj1647410758.png', 'U36807958', 1, 'cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a', 1, 'ACb87cec0c7d04b80d78bf1647edf8f67f', 'ee60fb893d6e7a2db56e5748e5eab8a3', '01976814812', 1, 'ba9111b8', 'cgxbAg4KnE80bcKx', '01976814812', 1, 0, 1, '{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"\\/\",\"target\":\"self\"},\"About\":{\"title\":\"About\",\"dropdown\":\"no\",\"href\":\"\\/about\",\"target\":\"self\"},\"Plans\":{\"title\":\"Plans\",\"dropdown\":\"no\",\"href\":\"\\/plans\",\"target\":\"self\"},\"Blog\":{\"title\":\"Blog\",\"dropdown\":\"no\",\"href\":\"\\/blogs\",\"target\":\"self\"}}', 1, 0.8, 10, 1000, 1, 0.3, 1000, 5000, 'Invest , Transfer & Request , Deposits , Payouts');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invests`
--

CREATE TABLE `invests` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `profit_amount` double DEFAULT NULL,
  `hold_amount` double DEFAULT NULL,
  `profit` double NOT NULL DEFAULT 0,
  `lifetime_return` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 == ''yes'',\r\n0 == ''no''',
  `profit_repeat` int(11) DEFAULT NULL,
  `capital_back` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 == ''yes'',\r\n0 == ''no''',
  `payment_status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 == ''pending'',\r\n1 == ''running'',\r\n2 == ''completed''',
  `profit_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invests`
--

INSERT INTO `invests` (`id`, `transaction_no`, `charge_id`, `user_id`, `plan_id`, `currency_id`, `method`, `amount`, `profit_amount`, `hold_amount`, `profit`, `lifetime_return`, `profit_repeat`, `capital_back`, `payment_status`, `status`, `profit_time`, `created_at`, `updated_at`) VALUES
(15, 'TJaf1649139885', 'ch_3Kl5oqJlIV5dN9n70T2Bp936', 50, 4, 1, 'stripe', 10, 0.3, NULL, 0, 0, 1, 1, 'completed', 1, '2022-04-05 06:24:48', '2022-04-05 06:24:48', '2022-04-05 06:24:48'),
(16, 'aOwJ1649139979', 'ch_3Kl5qMJlIV5dN9n71Wht5yxu', 50, 2, 1, 'stripe', 50, 2.5, NULL, 0, 0, 1, 1, 'completed', 1, '2022-04-05 07:26:22', '2022-04-05 06:26:22', '2022-04-05 06:26:22'),
(17, 'gCQP1649140750', NULL, 50, 4, 1, 'paypal', 10, 0.3, NULL, 0, 0, 1, 1, 'completed', 1, '2022-04-12 06:39:10', '2022-04-05 06:39:10', '2022-04-05 06:39:44'),
(18, 'UKab1649143778', NULL, 50, 4, 1, 'authorize.net', 10, 0.3, NULL, 0, 0, 1, 1, 'completed', 1, '2022-04-12 07:29:40', '2022-04-05 07:29:40', '2022-04-05 07:29:40'),
(19, 'gE8oj9OuYQCg', NULL, 50, 4, 9, 'paytm', 10, 0.3, 0.3, 0.3, 0, 1, 1, 'completed', 1, '2022-04-10 17:34:49', '2022-04-05 07:34:49', '2022-04-06 08:56:46'),
(21, 'W5AA1649147649', NULL, 50, 4, 1, 'flutterwave', 10, 0.3, NULL, 0, 0, 1, 1, 'pending', 0, '2022-04-12 08:34:09', '2022-04-05 08:34:09', '2022-04-05 08:34:09'),
(22, 'wGGm1649147650', NULL, 50, 4, 1, 'flutterwave', 10, 0.3, NULL, 0, 0, 1, 1, 'pending', 0, '2022-04-12 08:34:10', '2022-04-05 08:34:10', '2022-04-05 08:34:10'),
(23, 'uPUy1649147676', NULL, 50, 4, 1, 'flutterwave', 10, 0.3, NULL, 0, 0, 1, 1, 'completed', 0, '2022-04-12 08:34:36', '2022-04-05 08:34:36', '2022-04-05 08:35:34'),
(25, 'GlcK1MSaBb5F', NULL, 86, 6, 1, 'Main Wallet', 100, 7, NULL, 0, 1, 1, 1, 'completed', 1, '2023-04-10 07:38:26', '2022-04-10 07:38:26', '2022-04-10 07:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_forms`
--

CREATE TABLE `kyc_forms` (
  `id` int(11) NOT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `required` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kyc_forms`
--

INSERT INTO `kyc_forms` (`id`, `user_type`, `type`, `label`, `name`, `required`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 'Full Name', 'full_name', 1, '2022-03-06 06:08:28', '2022-03-06 06:08:28'),
(10, 1, 2, 'NID', 'nid', 1, '2022-03-06 06:08:38', '2022-03-06 06:08:38'),
(11, 1, 3, 'Present Address', 'present_address', 1, '2022-03-06 06:08:51', '2022-03-06 06:08:51'),
(12, 1, 3, 'Parmanent Address', 'parmanent_address', 1, '2022-03-06 06:09:04', '2022-03-06 06:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `rtl`, `is_default`, `language`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'EN', '1636017050KyjRNauw', '1636017050KyjRNauw.json', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_schedules`
--

CREATE TABLE `manage_schedules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_schedules`
--

INSERT INTO `manage_schedules` (`id`, `name`, `time`, `created_at`, `updated_at`) VALUES
(3, 'Hour', '1', '2022-03-23 09:30:46', '2022-03-23 09:30:46'),
(4, 'Day', '24', '2022-03-23 09:31:01', '2022-03-23 09:31:01'),
(5, 'Week', '168', '2022-03-23 09:31:30', '2022-03-23 09:31:30'),
(6, 'Month', '720', '2022-03-23 09:31:44', '2022-03-23 09:31:44'),
(7, 'Year', '8760', '2022-03-23 09:32:17', '2022-03-23 09:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `title`, `subtitle`, `photo`, `facebook`, `twitter`, `linkedin`) VALUES
(2, 'Ervin Kim', 'CEO of Apple', '1561539258comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(3, 'Ervin Kim', 'CEO of Apple', '1561539242comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(4, 'Ervin Kim', 'CEO of Apple', '1561539231comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(5, 'Ervin Kim', 'CEO of Apple', '1561539222comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(6, 'Ervin Kim', 'CEO of Apple', '1561539213comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(7, 'Ervin Kim', 'CEO of Apple', '1561539184comment2.png', 'https://www.facebook.com', NULL, 'https://www.linkedin.com'),
(8, 'Ervin Kim', 'CEO of Apple', '1561539197comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(9, 'Ervin Kim', 'CEO of Apple', '1561539345comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `money_requests`
--

CREATE TABLE `money_requests` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 == success\r\n0 == pending',
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_requests`
--

INSERT INTO `money_requests` (`id`, `transaction_no`, `user_id`, `receiver_id`, `receiver_name`, `cost`, `amount`, `status`, `details`, `created_at`, `updated_at`) VALUES
(1, 'hSxZ1642569099', 50, 51, 'GeniusOcean', 9, 1000, 1, 'I send a request for money.', '2022-01-18 23:11:39', '2022-01-19 22:56:47'),
(2, 'jh591642655716', 51, 50, 'dark loard', 4, 1000, 1, 'kichu teka deo', '2022-01-19 23:15:16', '2022-01-19 23:18:33'),
(3, 'W9Tx1646131416', 50, 62, 'Dark Loard', 1.3, 100, 0, NULL, '2022-03-01 10:43:36', '2022-03-01 10:43:36'),
(4, 'XrGx1646287582', 63, 50, 'dark loard', 1.15, 50, 1, NULL, '2022-03-03 06:06:22', '2022-03-03 06:42:20'),
(5, 'HJ6n1649239804', 50, 51, 'GeniusOcean', 1.3, 100, 0, NULL, '2022-04-06 10:10:04', '2022-04-06 10:10:04'),
(6, '0jAj1649239874', 50, 51, 'GeniusOcean', 1.3, 100, 0, NULL, '2022-04-06 10:11:14', '2022-04-06 10:11:14'),
(7, 'x3uF1649310714', 51, 50, 'dark loard', 1.3, 100, 1, NULL, '2022-04-07 05:51:54', '2022-04-07 06:09:34'),
(8, 'UThQ1649577138', 86, 51, 'GeniusOcean', 1.3, 100, 1, 'fsdfdfdsfds fdsfdsfdasf sdasd fdsfsdfd fadf dsf', '2022-04-10 07:52:18', '2022-04-10 09:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(191) NOT NULL,
  `order_id` int(191) UNSIGNED DEFAULT NULL,
  `user_id` int(191) DEFAULT NULL,
  `vendor_id` int(191) DEFAULT NULL,
  `product_id` int(191) DEFAULT NULL,
  `conversation_id` int(191) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `order_id`, `user_id`, `vendor_id`, `product_id`, `conversation_id`, `is_read`, `created_at`, `updated_at`) VALUES
(124, NULL, 53, NULL, NULL, NULL, 0, '2022-03-01 03:08:46', '2022-03-01 03:08:46'),
(125, NULL, 54, NULL, NULL, NULL, 0, '2022-03-01 03:19:49', '2022-03-01 03:19:49'),
(126, NULL, 55, NULL, NULL, NULL, 0, '2022-03-01 03:21:00', '2022-03-01 03:21:00'),
(127, NULL, 56, NULL, NULL, NULL, 0, '2022-03-01 03:22:42', '2022-03-01 03:22:42'),
(128, NULL, 57, NULL, NULL, NULL, 0, '2022-03-01 03:26:18', '2022-03-01 03:26:18'),
(129, NULL, 58, NULL, NULL, NULL, 0, '2022-03-01 03:33:24', '2022-03-01 03:33:24'),
(130, NULL, 59, NULL, NULL, NULL, 0, '2022-03-01 03:36:19', '2022-03-01 03:36:19'),
(131, NULL, 60, NULL, NULL, NULL, 0, '2022-03-01 04:07:33', '2022-03-01 04:07:33'),
(132, NULL, 61, NULL, NULL, NULL, 0, '2022-03-01 04:09:59', '2022-03-01 04:09:59'),
(133, NULL, 62, NULL, NULL, NULL, 0, '2022-03-01 04:13:22', '2022-03-01 04:13:22'),
(134, NULL, 63, NULL, NULL, NULL, 0, '2022-03-02 04:26:52', '2022-03-02 04:26:52'),
(135, NULL, 66, NULL, NULL, NULL, 0, '2022-03-03 09:52:55', '2022-03-03 09:52:55'),
(136, NULL, 67, NULL, NULL, NULL, 0, '2022-03-03 10:16:29', '2022-03-03 10:16:29'),
(137, NULL, 68, NULL, NULL, NULL, 0, '2022-03-03 10:23:49', '2022-03-03 10:23:49'),
(138, NULL, 69, NULL, NULL, NULL, 0, '2022-03-03 10:29:45', '2022-03-03 10:29:45'),
(139, NULL, 71, NULL, NULL, NULL, 0, '2022-03-06 11:17:33', '2022-03-06 11:17:33'),
(140, NULL, 71, NULL, NULL, NULL, 0, '2022-03-06 11:17:33', '2022-03-06 11:17:33'),
(141, NULL, 74, NULL, NULL, NULL, 0, '2022-03-13 09:42:47', '2022-03-13 09:42:47'),
(142, NULL, 76, NULL, NULL, NULL, 0, '2022-03-14 04:09:26', '2022-03-14 04:09:26'),
(143, NULL, 78, NULL, NULL, NULL, 0, '2022-03-14 04:23:20', '2022-03-14 04:23:20'),
(144, NULL, 85, NULL, NULL, NULL, 0, '2022-03-23 06:22:09', '2022-03-23 06:22:09'),
(145, 1, NULL, NULL, NULL, NULL, 0, '2022-03-31 06:25:36', '2022-03-31 06:25:36'),
(146, 2, NULL, NULL, NULL, NULL, 0, '2022-03-31 06:35:42', '2022-03-31 06:35:42'),
(147, 5, NULL, NULL, NULL, NULL, 0, '2022-03-31 10:37:22', '2022-03-31 10:37:22'),
(148, 7, NULL, NULL, NULL, NULL, 0, '2022-03-31 10:45:41', '2022-03-31 10:45:41'),
(149, 8, NULL, NULL, NULL, NULL, 0, '2022-03-31 11:08:16', '2022-03-31 11:08:16'),
(150, 9, NULL, NULL, NULL, NULL, 0, '2022-03-31 11:09:31', '2022-03-31 11:09:31'),
(151, 12, NULL, NULL, NULL, NULL, 0, '2022-03-31 11:27:27', '2022-03-31 11:27:27'),
(152, 13, NULL, NULL, NULL, NULL, 0, '2022-04-04 09:56:26', '2022-04-04 09:56:26'),
(153, 14, NULL, NULL, NULL, NULL, 0, '2022-04-04 09:58:09', '2022-04-04 09:58:09'),
(154, 15, NULL, NULL, NULL, NULL, 0, '2022-04-05 06:24:48', '2022-04-05 06:24:48'),
(155, 16, NULL, NULL, NULL, NULL, 0, '2022-04-05 06:26:22', '2022-04-05 06:26:22'),
(156, 17, NULL, NULL, NULL, NULL, 0, '2022-04-05 06:39:44', '2022-04-05 06:39:44'),
(157, 18, NULL, NULL, NULL, NULL, 0, '2022-04-05 07:29:40', '2022-04-05 07:29:40'),
(158, 19, NULL, NULL, NULL, NULL, 0, '2022-04-05 07:35:04', '2022-04-05 07:35:04'),
(159, 20, NULL, NULL, NULL, NULL, 0, '2022-04-05 07:40:31', '2022-04-05 07:40:31'),
(160, 23, NULL, NULL, NULL, NULL, 0, '2022-04-05 08:35:34', '2022-04-05 08:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` tinyint(1) NOT NULL DEFAULT 0,
  `footer` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_tag`, `meta_description`, `header`, `footer`, `status`) VALUES
(1, 'About Us', 'about', '<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 1</font><br></h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" style=\"font-family: \" 51);\"=\"\"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, 1, 0, 0),
(2, 'Privacy & Policy', 'privacy', '<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2>Title number 1</h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" 51);\"=\"\" style=\"font-family: \"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 'test,test1,test2,test3', 'Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagesettings`
--

CREATE TABLE `pagesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_success` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_btn_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_blog` tinyint(1) NOT NULL DEFAULT 1,
  `pricing_plan` tinyint(1) NOT NULL DEFAULT 0,
  `plan_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_percentage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_bg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagesettings`
--

INSERT INTO `pagesettings` (`id`, `contact_success`, `contact_email`, `contact_title`, `contact_text`, `side_title`, `side_text`, `street`, `phone`, `fax`, `email`, `site`, `hero_title`, `hero_subtitle`, `hero_btn_url`, `hero_link`, `hero_photo`, `review_blog`, `pricing_plan`, `plan_title`, `plan_subtitle`, `blog_subtitle`, `blog_title`, `blog_text`, `faq_title`, `faq_subtitle`, `about_photo`, `about_title`, `about_text`, `about_link`, `about_details`, `footer_top_photo`, `footer_top_title`, `footer_top_text`, `banner_title`, `banner_text`, `banner_link1`, `banner_link2`, `app_banner`, `start_title`, `start_text`, `start_photo`, `feature_title`, `feature_text`, `team_title`, `team_text`, `brand_title`, `brand_text`, `brand_photo`, `referral_banner`, `referral_title`, `referral_text`, `referral_percentage`, `profit_banner`, `profit_title`, `profit_text`, `call_title`, `call_subtitle`, `call_link`, `call_bg`) VALUES
(1, 'Success! Thanks for contacting us, we will get back to you shortly.', 'demo@example.com', '<h4 class=\"subtitle\" style=\"margin-bottom: 6px; font-weight: 600; line-height: 28px; font-size: 28px; text-transform: uppercase;\">WE\'D LOVE TO</h4><h2 class=\"title\" style=\"margin-bottom: 13px;font-weight: 600;line-height: 50px;font-size: 40px;color: #1f71d4;text-transform: uppercase;\">HEAR FROM YOU</h2>', '<span style=\"color: rgb(119, 119, 119);\">Send us a message and we\' ll respond as soon as possible</span><br>', 'Get in Touch with US', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, quia nesciunt fuga magni.', '134 Fifth Ave, New York, NY 12004, United States', '+0123456789', '00 000 000 000', 'admin@geniusocean.com', 'https://geniusocean.com/', 'Invest for Future in Stable Platform.', 'Non, et temporibus dolore, modi, ex voluptates quod repudiandae optio dolorum mollitia nesciunt iure. Maiores odio ipsam deserunt eum? Ad, a quasi?', 'http://localhost/geniushyip/', 'https://www.youtube.com/watch?v=lG-J1QC8cKY&ab_channel=EsoGolpoKoriPrime', 'lBfcORQ81648377715.png', 1, 1, 'Best Investment Packages', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.', 'Latest Blog', 'Our Latest News & Tips', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.', 'Frequently Asked Questions', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga.', 'RMq9Jgzq1647419025.png', 'Know About Us', 'Eius modi soluta, sunt nulla odio deserunt aliquam tenetur commodi esse eveniet repellendus culpa neque? Molestiae officia architecto laborum ipsam.\r\n<br><br>\r\nQuis debitis at dolorem dolorum quae? Cum possimus natus esse molestias quaerat quo tempore harum, velit doloremque, facere labore assumenda sed explicabo. Temporibus illum, aliquid, voluptatem sint culpa fugit consequuntur in animi magni rerum distinctio sed ut libero incidunt sapiente.', 'https://www.google.com/', '<h4>Quibusdam at sunt molestias et iusto eos rerum minima facere</h4>\r\n<br>\r\nAmet error praesentium perspiciatis harum ratione vitae ipsam accusamus, rem rerum. Molestias explicabo laborum sint voluptate totam incidunt repellendus dignissimos ipsam adipisci. Placeat consequuntur, iure quibusdam at sunt molestias et iusto eos rerum minima facere, dolores tempore. Accusamus quo omnis nam natus, temporibus eaque labore. Quasi architecto vitae veniam laudantium. Voluptates, incidunt.\r\n<br><br>\r\n<h4>Quibusdam at sunt molestias et iusto eos rerum minima facere</h4>\r\n<br>\r\nAmet error praesentium perspiciatis harum ratione vitae ipsam accusamus, rem rerum. Molestias explicabo laborum sint voluptate totam incidunt repellendus dignissimos ipsam adipisci. Placeat consequuntur, iure quibusdam at sunt molestias et iusto eos rerum minima facere, dolores tempore. Accusamus quo omnis nam natus, temporibus eaque labore. Quasi architecto vitae veniam laudantium. Voluptates, incidunt.', '1639561929call-to-action-bg.jpg', 'GET STARTED TODAY WITH BITCOIN', 'Open account for free and start trading Bitcoins!', '<h4 class=\"subtitle\" style=\"font-weight: 600; line-height: 1.2381; font-size: 24px; color: rgb(31, 113, 212);\">More convenient than others</h4>', '<h2 class=\"title\" style=\"font-weight: 600; line-height: 60px; font-size: 50px; color: rgb(23, 34, 44);\">Find Value &amp; Build confidence</h2>', 'https://www.google.com/', 'https://www.google.com/', 'gFNRbRDL1645425298.png', 'We have some easy steps!', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.', '5qujwiIP1649491285.png', 'Why Choose US', 'Deserunt hic consequatur ex placeat! atque repellendus inventore', 'Our Expert Members', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.', 'Our Payment Gateway', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni', '2YHwEVzE1649492380.png', '7GPJdP0V1648371266.png', 'Refer your friend and earn money', 'Our referral program was created as an additional way for our investors to make money. By attracting new investors to join us, our members are getting an additional source of income. The referral program has three levels of participation, with the following percentage accordingly: 5%, 2% and 1%.', '[\"05\",\"07\",\"09\"]', 'Wr22L2EJ1648373077.png', 'Quick Profit Calculate', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.', 'Are You Convenced', 'Let\'s Get started with us', 'https://www.google.com/', '#400768');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `photo`, `created_at`, `updated_at`) VALUES
(2, 'LL6ZfKxN1649489611.png', '2022-04-09 07:33:31', '2022-04-09 07:33:31'),
(3, 'd0Skf6Cg1649489615.png', '2022-04-09 07:33:35', '2022-04-09 07:33:35'),
(4, 'YQdx4Anl1649489620.png', '2022-04-09 07:33:40', '2022-04-09 07:33:40'),
(5, 'FCqczG9Y1649489623.png', '2022-04-09 07:33:43', '2022-04-09 07:33:43'),
(6, 'iCNPpAfs1649489626.png', '2022-04-09 07:33:46', '2022-04-09 07:33:46'),
(7, 'c6lRCwhW1649489630.png', '2022-04-09 07:33:50', '2022-04-09 07:33:50'),
(8, 'K4Z5jrqj1649489683.png', '2022-04-09 07:34:43', '2022-04-09 07:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(191) NOT NULL,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `status` int(191) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `currency_id`, `status`) VALUES
(6, NULL, NULL, NULL, 'Flutter Wave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '[\"1\"]', 1),
(8, NULL, NULL, NULL, 'Authorize.Net', 'automatic', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"sandbox_check\":1,\"text\":\"Pay Via Authorize.Net\"}', 'authorize.net', '[\"1\"]', 1),
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', '[\"8\"]', 1),
(10, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"test_jePgBjaRV5rUdzWc44rb2fUxgM2dM9\",\"text\":\"Pay with Mollie Payment.\"}', 'mollie', '[\"1\",\"6\"]', 1),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', '[\"8\"]', 1),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', '[\"9\"]', 1),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', '[\"8\"]', 1),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', '[\"1\"]', 1),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', '[\"1\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `manage_schedule_id` int(11) DEFAULT NULL,
  `schedule_hour` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `min_amount` double DEFAULT NULL,
  `max_amount` double DEFAULT NULL,
  `fixed_amount` double DEFAULT NULL,
  `invest_type` enum('fixed','range') NOT NULL,
  `profit_percentage` double DEFAULT NULL,
  `captial_return` tinyint(4) NOT NULL DEFAULT 0,
  `lifetime_return` tinyint(4) NOT NULL DEFAULT 0,
  `profit_repeat` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `manage_schedule_id`, `schedule_hour`, `title`, `subtitle`, `min_amount`, `max_amount`, `fixed_amount`, `invest_type`, `profit_percentage`, `captial_return`, `lifetime_return`, `profit_repeat`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 24, 'Premium', 'Most Popular', NULL, NULL, 200, 'fixed', 5, 1, 1, NULL, 1, '2022-03-24 08:35:02', '2022-04-06 06:13:36'),
(2, 3, 1, 'Basic', 'Most Popular', 50, 500, NULL, 'range', 5, 1, 0, 10, 1, '2022-03-24 08:46:00', '2022-04-06 06:13:22'),
(4, 5, 168, 'Professional', 'Most Popular', 10, 200, NULL, 'range', 3, 1, 0, 3, 1, '2022-03-30 06:14:11', '2022-04-06 06:13:05'),
(5, 6, 720, 'Gold', 'Most Popular', NULL, NULL, 500, 'fixed', 11, 1, 0, 10, 1, '2022-03-31 06:37:42', '2022-04-06 06:12:50'),
(6, 7, 8760, 'Broonze', 'Most Popular', 100, 300, NULL, 'range', 7, 1, 1, NULL, 1, '2022-03-31 06:38:34', '2022-04-06 06:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `commission_type` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `commission_type`, `level`, `percent`, `created_at`, `updated_at`) VALUES
(10, 'invest', 1, 3, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(11, 'invest', 2, 2, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(12, 'invest', 3, 1, '2022-02-01 21:59:02', '2022-02-01 21:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `referral_bonuses`
--

CREATE TABLE `referral_bonuses` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `amount` decimal(20,10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral_bonuses`
--

INSERT INTO `referral_bonuses` (`id`, `from_user_id`, `to_user_id`, `percentage`, `level`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(4, 69, 50, NULL, NULL, '5.0000000000', 'Register', '2022-03-03 10:29:45', '2022-03-03 10:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `photo`, `title`, `subtitle`, `details`) VALUES
(5, 'IEhrEpaG1647412802.jpg', 'Emerrik Aubameyang', 'This is one of the best ...', 'Odit voluptate incidunt animi ratione tempore facere, dignissimos quibusdam molestiae  blanditiis. A exercitationem nobis explicabo veniam laboriosam necessitatibus nulla optio nisi obcaecati.'),
(6, 'ditmDMT71647412723.jpg', 'Maximilian John Smilga', 'This is one of the best ...', 'Odit voluptate incidunt animi ratione tempore facere, dignissimos quibusdam molestiae  blanditiis. A exercitationem nobis explicabo veniam laboriosam necessitatibus nulla optio nisi obcaecati.'),
(9, '8BLn3Mfw1647412854.jpg', 'Maximilian John Smilga', 'This is one of the best ...', 'Odit voluptate incidunt animi ratione tempore facere, dignissimos quibusdam molestiae  blanditiis. A exercitationem nobis explicabo veniam laboriosam necessitatibus nulla optio nisi obcaecati.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(9, 'Staff', 'Menu Builder , Manage Customers , Loan Management , DPS Management , FDR Management , Transactions , Manage Blog , General Setting , Message , Manage Roles , Manage Staff , Fonts , Menupage Setting , Subscribers', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seotools`
--

CREATE TABLE `seotools` (
  `id` int(10) UNSIGNED NOT NULL,
  `google_analytics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seotools`
--

INSERT INTO `seotools` (`id`, `google_analytics`, `meta_keys`) VALUES
(1, '<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-137437974-1\"></script>  <script>    window.dataLayer = window.dataLayer || [];    function gtag(){dataLayer.push(arguments);}    gtag(\'js\', new Date());    gtag(\'config\', \'UA-137437974-1\');  </script>', 'Genius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,Sea');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`) VALUES
(15, 'HIGH LIQUIDITY', 'Fast access to high liquidity orderbook</br>\r\nfor top currency pairs', '1639476836high-liquidity.png'),
(16, 'COST EFFICIENCY', 'Reasonable trading fees for takers</br>\r\nand all market makers', '1639476885cost-efficiency.png'),
(17, 'MOBILE APP', 'Trading via our Mobile App, Available</br>\r\nin Play Store & App Store', '1639476911mobile-app.png'),
(18, 'PAYMENT OPTIONS', 'Popular methods: Visa, MasterCard,</br>\r\nbank transfer, cryptocurrency', '1639476937payment-options.png'),
(19, 'WORLD COVERAGE', 'Providing services in 99% countries</br>\r\naround all the globe', '1639476969world-coverage.png'),
(20, 'STRONG SECURITY', 'Protection against DDoS attacks,</br>\r\nfull data encryption', '1639476998strong-security.png');

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitemap_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialsettings`
--

CREATE TABLE `socialsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_status` tinyint(4) NOT NULL DEFAULT 1,
  `g_status` tinyint(4) NOT NULL DEFAULT 1,
  `t_status` tinyint(4) NOT NULL DEFAULT 1,
  `l_status` tinyint(4) NOT NULL DEFAULT 1,
  `d_status` tinyint(4) NOT NULL DEFAULT 1,
  `f_check` tinyint(10) DEFAULT NULL,
  `g_check` tinyint(10) DEFAULT NULL,
  `fclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `facebook`, `gplus`, `twitter`, `linkedin`, `dribble`, `f_status`, `g_status`, `t_status`, `l_status`, `d_status`, `f_check`, `g_check`, `fclient_id`, `fclient_secret`, `fredirect`, `gclient_id`, `gclient_secret`, `gredirect`) VALUES
(1, 'https://www.facebook.com/', 'https://plus.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://dribbble.com/', 1, 0, 1, 1, 0, 1, 1, '503140663460329', 'f66cd670ec43d14209a2728af26dcc43', 'https://localhost/crypto/auth/facebook/callback', '904681031719-sh1aolu42k7l93ik0bkiddcboghbpcfi.apps.googleusercontent.com', 'yGBWmUpPtn5yWhDAsXnswEX3', 'http://localhost/marketplace/auth/google/callback');

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_providers`
--

INSERT INTO `social_providers` (`id`, `user_id`, `provider_id`, `provider`, `created_at`, `updated_at`) VALUES
(3, 17, '102485372716947456487', 'google', '2019-06-19 17:06:00', '2019-06-19 17:06:00'),
(4, 18, '109955884428371086401', 'google', '2019-06-19 17:17:04', '2019-06-19 17:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(191) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'ahmmedafzal4@gmail.com'),
(2, 'imtiaze93@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instra_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `photo`, `fb_link`, `twitter_link`, `instra_link`, `linkedin_link`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'Robot Smith', 'rJ0I4EWo1649493238.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:33:58', '2022-04-09 08:33:58'),
(2, 'Erling Haland', '2GUQgYzD1649493260.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:34:20', '2022-04-09 08:34:20'),
(3, 'Emerrik Aubameyang', 'qDmibZdd1649493287.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:34:47', '2022-04-09 08:34:47'),
(4, 'Alexandar Lucifer', 'laADMWrp1649493324.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:35:24', '2022-04-09 08:35:24'),
(5, 'Jennifer Lopez', 'W2UUOvxO1649493377.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:36:17', '2022-04-09 08:36:17'),
(6, 'Erling Haland', 'tH9ZVwsH1649493417.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:36:57', '2022-04-09 08:36:57'),
(7, 'Afnan Putin', 'xDq9bsnF1649493446.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:37:26', '2022-04-09 08:37:26'),
(9, 'John Abraham', 'mgWVeDMN1649493781.jpg', 'https://www.google.com/', NULL, 'https://www.google.com/', 'https://www.google.com/', NULL, '2022-04-09 08:43:01', '2022-04-09 08:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL DEFAULT 0,
  `receiver_id` int(11) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `type` enum('Deposit','Payout','Referral Bonus','Send Money','Receive Money','Invest','Interest Money','Request Money') NOT NULL,
  `profit` enum('plus','minus') DEFAULT NULL,
  `txnid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `receiver_id`, `email`, `amount`, `type`, `profit`, `txnid`, `created_at`, `updated_at`) VALUES
(117, 50, NULL, 'user@gmail.com', 10, 'Send Money', 'minus', 'n92c1648544356', '2022-03-29 08:59:16', '2022-03-29 08:59:16'),
(118, 51, NULL, 'genius@gmail.com', 10, 'Receive Money', 'plus', 'n92c1648544356', '2022-03-29 08:59:16', '2022-03-29 08:59:16'),
(119, 50, NULL, 'user@gmail.com', 20, 'Send Money', 'minus', 'yXFi1648545067', '2022-03-29 09:11:07', '2022-03-29 09:11:07'),
(120, 51, NULL, 'genius@gmail.com', 20, 'Receive Money', 'plus', 'yXFi1648545067', '2022-03-29 09:11:07', '2022-03-29 09:11:07'),
(121, 50, NULL, 'user@gmail.com', 50, 'Send Money', 'minus', 'drGU1648545083', '2022-03-29 09:11:23', '2022-03-29 09:11:23'),
(122, 51, NULL, 'genius@gmail.com', 50, 'Receive Money', 'plus', 'drGU1648545083', '2022-03-29 09:11:23', '2022-03-29 09:11:23'),
(123, 50, NULL, 'user@gmail.com', 50, 'Deposit', 'plus', 'fWY3us6N0zYl', '2022-03-29 10:41:10', '2022-03-29 10:41:10'),
(124, 50, NULL, 'user@gmail.com', 200, 'Invest', NULL, '9i7c1648708540', '2022-03-31 06:35:42', '2022-03-31 06:35:42'),
(125, 50, NULL, 'user@gmail.com', 50, 'Invest', NULL, 'rBYi1648723026', '2022-03-31 10:37:22', '2022-03-31 10:37:22'),
(126, 50, NULL, 'user@gmail.com', 50, 'Invest', NULL, '3mgz1648723526', '2022-03-31 10:45:41', '2022-03-31 10:45:41'),
(127, 50, NULL, 'user@gmail.com', 50, 'Invest', NULL, 'u9DP1648724868', '2022-03-31 11:08:16', '2022-03-31 11:08:16'),
(128, 50, NULL, 'user@gmail.com', 60, 'Invest', NULL, 'I4HC1648724956', '2022-03-31 11:09:31', '2022-03-31 11:09:31'),
(129, 50, NULL, 'user@gmail.com', 60, 'Invest', NULL, 'QRyayxudhnzr', '2022-03-31 11:27:27', '2022-03-31 11:27:27'),
(130, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'Zv3dRKx8KujH', '2022-04-04 09:56:26', '2022-04-04 09:56:26'),
(131, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'xYaMwDOJQmkN', '2022-04-04 09:58:09', '2022-04-04 09:58:09'),
(132, 50, NULL, 'user@gmail.com', 100, 'Deposit', 'plus', 'EJdyfqHt5KGy', '2022-04-05 06:17:37', '2022-04-05 06:17:37'),
(133, 50, NULL, 'user@gmail.com', 100, 'Deposit', 'plus', 'jjzUVSakJEj9', '2022-04-05 06:18:03', '2022-04-05 06:18:03'),
(134, 50, NULL, 'user@gmail.com', 1.3513513513514, 'Deposit', 'plus', 'oIyioanTocuz', '2022-04-05 06:19:44', '2022-04-05 06:19:44'),
(135, 50, NULL, 'user@gmail.com', 1.3513513513514, 'Deposit', 'plus', 'HWkX8iwcn4zU', '2022-04-05 06:20:09', '2022-04-05 06:20:09'),
(136, 50, NULL, 'user@gmail.com', 1.3513513513514, 'Deposit', 'plus', '1AmWjnxkNeUJ', '2022-04-05 06:20:53', '2022-04-05 06:20:53'),
(137, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'TJaf1649139885', '2022-04-05 06:24:48', '2022-04-05 06:24:48'),
(138, 50, NULL, 'user@gmail.com', 50, 'Invest', NULL, 'aOwJ1649139979', '2022-04-05 06:26:22', '2022-04-05 06:26:22'),
(139, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'gCQP1649140750', '2022-04-05 06:39:44', '2022-04-05 06:39:44'),
(140, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'UKab1649143778', '2022-04-05 07:29:40', '2022-04-05 07:29:40'),
(141, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'gE8oj9OuYQCg', '2022-04-05 07:35:04', '2022-04-05 07:35:04'),
(142, 50, NULL, 'user@gmail.com', 37000, 'Invest', NULL, 'order_JFazRrgBKj931v', '2022-04-05 07:40:31', '2022-04-05 07:40:31'),
(143, 50, NULL, 'user@gmail.com', 10, 'Invest', NULL, 'uPUy1649147676', '2022-04-05 08:35:34', '2022-04-05 08:35:34'),
(144, 51, NULL, 'genius@gmail.com', 101.3, 'Request Money', 'plus', '0jAj1649239874', '2022-04-06 10:11:14', '2022-04-06 10:11:14'),
(145, 50, NULL, 'user@gmail.com', 101.3, 'Request Money', 'plus', 'x3uF1649310714', '2022-04-07 05:51:55', '2022-04-07 05:51:55'),
(146, 50, NULL, 'user@gmail.com', 100, 'Request Money', 'minus', 'x3uF1649310714', '2022-04-07 06:09:34', '2022-04-07 06:09:34'),
(147, 51, NULL, 'genius@gmail.com', 100, 'Request Money', 'plus', 'x3uF1649310714', '2022-04-07 06:09:34', '2022-04-07 06:09:34'),
(148, 86, NULL, 'user@gmail.com', 100, 'Invest', NULL, 'GlcK1MSaBb5F', '2022-04-10 07:38:26', '2022-04-10 07:38:26'),
(149, 51, NULL, 'genius@gmail.com', 101.3, 'Request Money', 'plus', 'UThQ1649577138', '2022-04-10 07:52:18', '2022-04-10 07:52:18'),
(150, 86, NULL, 'user@gmail.com', 100, 'Deposit', 'plus', 'dKpYLU0b4sVf', '2022-04-10 07:57:34', '2022-04-10 07:57:34'),
(151, 86, NULL, 'user@gmail.com', 100, 'Deposit', 'plus', 'LYNDTrU8HRJM', '2022-04-10 07:57:34', '2022-04-10 07:57:34'),
(152, 86, NULL, 'user@gmail.com', 55.65, 'Payout', 'minus', 'lLoiJbt7ar2R', '2022-04-10 08:02:01', '2022-04-10 08:02:01'),
(153, 86, NULL, 'user@gmail.com', 24.5, 'Payout', 'minus', 'Sd103i3lATtV', '2022-04-10 08:53:55', '2022-04-10 08:53:55'),
(154, 86, NULL, 'user@gmail.com', 100, 'Deposit', 'plus', 'gIKbWTpxyU90', '2022-04-10 08:55:15', '2022-04-10 08:55:15'),
(155, 86, NULL, 'user@gmail.com', 1000, 'Deposit', 'plus', 'fcif756jcQDT', '2022-04-10 08:56:14', '2022-04-10 08:56:14'),
(156, 86, NULL, 'user@gmail.com', 1.3513513513514, 'Deposit', 'plus', 'SGH2cQnpgglj', '2022-04-10 08:58:28', '2022-04-10 08:58:28'),
(157, 86, NULL, 'user@gmail.com', 1.3513513513514, 'Deposit', 'plus', 'YuF2SQTz6whJ', '2022-04-10 08:59:51', '2022-04-10 08:59:51'),
(158, 86, NULL, 'user@gmail.com', 100, 'Send Money', 'minus', 'j9Ck1649581424', '2022-04-10 09:03:44', '2022-04-10 09:03:44'),
(159, 51, NULL, 'genius@gmail.com', 100, 'Receive Money', 'plus', 'j9Ck1649581424', '2022-04-10 09:03:44', '2022-04-10 09:03:44'),
(160, 51, NULL, 'genius@gmail.com', 100, 'Request Money', 'minus', 'UThQ1649577138', '2022-04-10 09:05:49', '2022-04-10 09:05:49'),
(161, 86, NULL, 'user@gmail.com', 100, 'Request Money', 'plus', 'UThQ1649577138', '2022-04-10 09:05:49', '2022-04-10 09:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_provider` tinyint(10) NOT NULL DEFAULT 0,
  `status` tinyint(10) NOT NULL DEFAULT 0,
  `verification_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `balance` double NOT NULL DEFAULT 0,
  `interest_balance` double NOT NULL DEFAULT 0,
  `affilate_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` tinyint(1) NOT NULL DEFAULT 0,
  `twofa` tinyint(4) NOT NULL DEFAULT 0,
  `go` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 == ''pending''\r\n1 == ''approve''\r\n2 == ''rejected''',
  `kyc_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banned` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 === banned\r\n0 === active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `photo`, `zip`, `city`, `address`, `phone`, `fax`, `email`, `password`, `remember_token`, `is_provider`, `status`, `verification_link`, `email_verified`, `balance`, `interest_balance`, `affilate_code`, `referral_id`, `twofa`, `go`, `verified`, `details`, `kyc_status`, `kyc_info`, `kyc_reject_reason`, `is_banned`, `created_at`, `updated_at`) VALUES
(51, 'GeniusOcean', NULL, NULL, NULL, NULL, 'Dhaka', NULL, NULL, 'genius@gmail.com', '$2y$10$cVTbIj4iQGqsUgwEwOMtoOcPXd.BY9lWFaFMu1/xAJHcBom.Q.B8K', 'CJDRQQE3VnvqvGc0mly69P3kieWhsJvE6iaOnQdKrRJpLg9DwranpZgtlnoc', 0, 0, '759f1706acfd7bc23f6b95ae35d0fd8e', 'Yes', 2284.7, 0, '3266dcfa238c067719a09f1eabc4e1b3', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2022-04-10 09:05:49'),
(63, 'Ambarish Das', NULL, NULL, NULL, NULL, NULL, '0123456789', NULL, 'ambarish@gmail.com', '$2y$10$uVA/7gFBnoUm0flNd.IMZuOa6YvvXXLQhkeZlepFYrq.s/vb6iUta', NULL, 0, 0, 'f4140ec145c0257fa6931b1faa901362', 'Yes', 2146.95, 0, '344e1bf59d2683dcb2a05e9056dd15a3', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL),
(69, 'Farhad Hossian', NULL, NULL, NULL, NULL, NULL, '0123456789', NULL, 'farhad@gmail.com', '$2y$10$uZEnB1cIkM7VxQMuhtHODeUfV7O5ILlWOCiTm0sUJno.zpsyThNx6', NULL, 0, 0, '6991609f5323207bf9e4f7520cf09ee0', 'Yes', 5, 0, '9da22c4a94a7d94934e841238557b79f', 50, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, NULL),
(86, 'Jenifer', NULL, '1649579858team8.jpg', '1230', 'Dhaka', 'road-04', '0123456789', '0900000', 'user@gmail.com', '$2y$10$LqhGTU515S1spyxHNEyYpO90oahOwFkh9x5XQHmq3qEJnSKwZA.VS', 'vIDdxJcahMt1YpRHRkNcI5tzv4wCkBV43tbG5xW2qI4VRwGcYa1v5VjilDAR', 0, 0, '759f1706acfd7bc23f6b95ae35d0fd8e', 'Yes', 3505.9527027028, 0, '3266dcfa238c067719a09f1eabc4e1b3', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2022-04-10 09:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `order_id` int(191) NOT NULL DEFAULT 0,
  `withdraw_id` int(191) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Invest','Payout','Withdraw') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `user_id`, `order_id`, `withdraw_id`, `is_read`, `created_at`, `updated_at`, `type`) VALUES
(76, 50, 2, 0, 0, '2022-03-31 06:35:42', '2022-03-31 06:35:42', 'Invest'),
(77, 50, 5, 0, 0, '2022-03-31 10:37:22', '2022-03-31 10:37:22', 'Invest'),
(78, 50, 7, 0, 0, '2022-03-31 10:45:41', '2022-03-31 10:45:41', 'Invest'),
(79, 50, 8, 0, 0, '2022-03-31 11:08:16', '2022-03-31 11:08:16', 'Invest'),
(80, 50, 9, 0, 0, '2022-03-31 11:09:31', '2022-03-31 11:09:31', 'Invest'),
(81, 50, 12, 0, 0, '2022-03-31 11:27:27', '2022-03-31 11:27:27', 'Invest'),
(82, 50, 13, 0, 0, '2022-04-04 09:56:26', '2022-04-04 09:56:26', 'Invest'),
(83, 50, 14, 0, 0, '2022-04-04 09:58:09', '2022-04-04 09:58:09', 'Invest'),
(84, 50, 15, 0, 0, '2022-04-05 06:24:48', '2022-04-05 06:24:48', 'Invest'),
(85, 50, 16, 0, 0, '2022-04-05 06:26:22', '2022-04-05 06:26:22', 'Invest'),
(86, 50, 17, 0, 0, '2022-04-05 06:39:44', '2022-04-05 06:39:44', 'Invest'),
(87, 50, 18, 0, 0, '2022-04-05 07:29:40', '2022-04-05 07:29:40', 'Invest'),
(88, 50, 19, 0, 0, '2022-04-05 07:35:04', '2022-04-05 07:35:04', 'Invest'),
(89, 50, 20, 0, 0, '2022-04-05 07:40:31', '2022-04-05 07:40:31', 'Invest'),
(90, 50, 23, 0, 0, '2022-04-05 08:35:34', '2022-04-05 08:35:34', 'Invest');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `subscription_number` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_plan_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `subscription_number`, `txnid`, `user_id`, `bank_plan_id`, `currency_id`, `price`, `method`, `days`, `status`, `created_at`, `updated_at`) VALUES
(18, 'jIVw1644993862', '3137234', 50, 6, 1, 100, 'flutterwave', 100, 'completed', '2022-02-16 00:44:22', '2022-02-16 00:44:53'),
(19, 'vreF1646111014', NULL, 62, 6, 1, 100, 'paypal', 100, 'pending', '2022-03-01 05:03:34', '2022-03-01 05:03:34'),
(20, 'yeTi1646111315', '2adbacc97c6246998aa69d90aab5375e', 62, 6, 9, 1.3513513513514, 'instamojo', 100, 'completed', '2022-03-01 05:08:35', '2022-03-01 05:08:35'),
(21, 'ZII41646111557', 'txn_3KYO0qJlIV5dN9n71WhB4b5r', 62, 6, 9, 1.3513513513514, 'stripe', 100, 'pending', '2022-03-01 05:12:39', '2022-03-01 05:12:39'),
(22, 'pG6M1646111589', NULL, 62, 6, 9, 1.3513513513514, 'paypal', 100, 'pending', '2022-03-01 05:13:09', '2022-03-01 05:13:09'),
(23, 'vMpW1646111619', NULL, 62, 6, 9, 1.3513513513514, 'paypal', 100, 'pending', '2022-03-01 05:13:39', '2022-03-01 05:13:39'),
(24, 'bKo41646111907', '56004648YH063573D', 62, 6, 9, 1.3513513513514, 'paypal', 100, 'completed', '2022-03-01 05:18:27', '2022-03-01 05:19:38'),
(25, 'JKPP1646112310', '97P17095MP529492Y', 62, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-01 05:25:10', '2022-03-01 05:25:24'),
(26, 'O65E1646112794', NULL, 62, 6, 9, 1.3513513513514, 'authorize.net', 100, 'pending', '2022-03-01 05:33:16', '2022-03-01 05:33:16'),
(27, 'AanR1646825572', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2022-03-09 11:32:53', '2022-03-09 11:32:53'),
(28, 'SIoo1646825881', NULL, 50, 6, 1, 100, 'mollie', 100, 'completed', '2022-03-09 11:38:02', '2022-03-09 11:38:02'),
(29, 'Rnkb1646826036', '26W28613JS034702K', 50, 6, 9, 1.3513513513514, 'paypal', 100, 'completed', '2022-03-09 11:40:36', '2022-03-09 11:41:06'),
(30, 'hGPy1646884602', NULL, 50, 6, 1, 100, 'mollie', 100, 'completed', '2022-03-10 03:56:43', '2022-03-10 03:56:43'),
(31, 'd9U61646885817', NULL, 50, 6, 9, 100, 'paypal', 100, 'pending', '2022-03-10 04:16:57', '2022-03-10 04:16:57'),
(32, '6qyx1646885923', NULL, 50, 6, 9, 100, 'paypal', 100, 'pending', '2022-03-10 04:18:43', '2022-03-10 04:18:43'),
(33, 'WMv71646885953', NULL, 50, 6, 1, 100, 'paypal', 100, 'pending', '2022-03-10 04:19:13', '2022-03-10 04:19:13'),
(34, 'FAU01646885997', NULL, 50, 6, 6, 100, 'paypal', 100, 'pending', '2022-03-10 04:19:57', '2022-03-10 04:19:57'),
(35, 'e5Jc1646886604', '20220310111212800110168503203512219', 50, 6, 9, 100, 'paytm', 100, 'completed', '2022-03-10 04:30:04', '2022-03-10 04:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` int(191) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `user_id` int(191) DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `fee` float DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `type` enum('user','vendor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `currency_id`, `txnid`, `user_id`, `method`, `address`, `reference`, `amount`, `fee`, `details`, `created_at`, `updated_at`, `status`, `type`) VALUES
(34, 4, 'I2yjifJtBXf0', 50, 'Nagad', NULL, NULL, 12.0589, 0.198971, '01636676884', '2022-03-29 10:02:36', '2022-03-29 10:02:36', 'pending', 'user'),
(35, 4, 'lLoiJbt7ar2R', 86, 'Nagad', NULL, NULL, 54.8076, 0.840202, 'gdftgdfgdfg df', '2022-04-10 14:02:01', '2022-04-10 14:02:01', 'pending', 'user'),
(36, 4, 'Sd103i3lATtV', 86, 'Nagad', NULL, NULL, 24.1177, 0.379854, NULL, '2022-04-10 14:53:55', '2022-04-10 14:53:55', 'pending', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `min_amount` double DEFAULT NULL,
  `max_amount` double DEFAULT NULL,
  `fixed` double DEFAULT 0,
  `percentage` double DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `currency_id`, `name`, `photo`, `min_amount`, `max_amount`, `fixed`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 'Stripe', 'h2WulL4x1648456337.png', 50, 500, 2, 2, 1, '2022-03-28 08:32:17', '2022-03-28 09:22:29'),
(9, 9, 'Razorpay', '0D76Kxp91648456603.jpg', 100, 300, 3, 2, 1, '2022-03-28 08:36:43', '2022-03-28 09:22:56'),
(10, 1, 'Payoneer', 'rn9vTcJN1648456648.jpg', 30, 150, 2, 1.5, 1, '2022-03-28 08:37:28', '2022-03-28 09:22:42'),
(11, 4, 'Nagad', 'i2LJ0HZj1648456692.jpg', 1000, 10000, 1.5, 1.5, 1, '2022-03-28 08:38:12', '2022-03-28 09:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_processes`
--
ALTER TABLE `account_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_languages`
--
ALTER TABLE `admin_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`),
  ADD UNIQUE KEY `countries_iso2_unique` (`iso2`),
  ADD UNIQUE KEY `countries_iso3_unique` (`iso3`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generalsettings`
--
ALTER TABLE `generalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invests`
--
ALTER TABLE `invests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_schedules`
--
ALTER TABLE `manage_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_requests`
--
ALTER TABLE `money_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagesettings`
--
ALTER TABLE `pagesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seotools`
--
ALTER TABLE `seotools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialsettings`
--
ALTER TABLE `socialsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_processes`
--
ALTER TABLE `account_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_languages`
--
ALTER TABLE `admin_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `generalsettings`
--
ALTER TABLE `generalsettings`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invests`
--
ALTER TABLE `invests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `manage_schedules`
--
ALTER TABLE `manage_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `money_requests`
--
ALTER TABLE `money_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pagesettings`
--
ALTER TABLE `pagesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seotools`
--
ALTER TABLE `seotools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
