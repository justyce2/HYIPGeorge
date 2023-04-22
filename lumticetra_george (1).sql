-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2023 at 03:41 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumticetra_george`
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
(1, 'fas fa-exchange-alt', 'Get Profit', 'Withdraw your profit at the end of the investment period', '2022-02-21 04:29:32', '2022-12-27 16:39:20'),
(2, 'fas fa-user-check', 'Purchase Investment Plan', 'Make your first deposit after registration', '2022-02-21 04:29:57', '2022-12-27 16:38:45'),
(3, 'fas fa-user-plus', 'Create Account', 'Its easy, Just choose a plan and you will be redirected to out registration page.', '2022-02-21 04:30:19', '2022-12-27 16:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '0',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `role_id`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Drjacksoneuroconsult@gmail.com', '01629552892', 0, 'nB8Hlzch1649567593.jpg', '$2y$10$tq2galrX6vYu2qHkjVpXSOpZJz1ZvZF07UyubtkYUSpCC.A6tUiGW', 1, 'p1Qu4DhPi48zGKOe8Svt76LnzITyQDAiQDC7zslWOvKs63cmDYBZSUWUhDFI', '2018-02-28 23:27:08', '2023-01-07 16:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `admin_languages`
--

CREATE TABLE `admin_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_languages`
--

INSERT INTO `admin_languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 1, 'En', '1603880510hWH6gk7S.json', '1603880510hWH6gk7S', 0, NULL, NULL),
(23, 0, 'BN', '1649840015gHLfDWu0.json', '1649840015gHLfDWu0', 0, NULL, NULL);

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
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `views` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `meta_tag` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `details`, `photo`, `source`, `views`, `status`, `meta_tag`, `meta_description`, `tags`, `created_at`) VALUES
(24, 6, 'CRYPTO.COM APP LISTS IDEX (IDEX)', 'cryptocom-app-lists-idex-idex', 'IDEX (IDEX) is now listed in the Crypto.com App, joining the growing list of 250+ supported cryptocurrencies and stablecoins, including Bitcoin (BTC), Ether (ETH), Polkadot (DOT), Chainlink (LINK), VeChain (VET), USD Coin (USDC), and Crypto.org Coin (CRO). IDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading. IDEX is an Ethereum token that powers the IDEX decentralised exchange. IDEX holders can stake tokens in order to help secure the protocol and earn rewards. Crypto.com App users can now purchase IDEX at true cost with USD, EUR, GBP, and 20+ fiat currencies, and spend it at over 80 million merchants globally using the Crypto.com Visa Card.\r\n\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\n\r\nIDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading', 'nMI5Kv5P1647402900.jpg', 'www.geniusocean.com', 102, 1, 'Ethereum', NULL, 'DEX,exchanges,Ethereum', '2019-01-03 06:03:37'),
(29, 7, 'The First Margin Trading Race of 2022 Has Landed!', 'the-first-margin-trading-race-of-2022-has-landed', 'The Crypto.com Exchange’s first Margin Trading Race of 2022 is locked, loaded, and ready to go! If you haven’t Margin traded in a while, it’s time to shake off the dust. Here’s why: the first 500 users who Margin trade at least USD 100 of any pair will score USD 50 in CRO and the chance to win tickets to a PSG vs Real Madrid Champions League game. New and existing users with a Margin Trading account who have not made a Margin trade since 1 November 2021 are eligible for this campaign. Campaign Period: 14 January 2022 at 08:00 UTC - 26 January 2022 at 00:00 UTC How to participate: Sign in or sign up to the Crypto.com Exchange Open a Margin Wallet (if you are new to Margin Trading) Margin trade at least USD 100 of any pair (FAQ, How-to video) Register for the campaign here. The first 500 eligible users who Margin trade at least USD 100 during the Campaign Period will win a share of USD 25,000 in CRO. Among the winners, three lucky traders will each receive one pair of tickets to the PSG vs Real Madrid Champions League game on 15 February 2022 at Paris Saint-Germain’s homeground, Le Parc des Princes! <> What is Margin Trading? Margin Trading allows users to amplify their trading profits through borrowed funds during both up and down market movements. Users can access up to 3x leverage for eligible pairs. The Crypto.com Coin (CRO) powers Margin Trading with additional utility, offering preferential interest rates—as low as 0.008% per day—to users who stake CRO. Check out our step-by-step video guides on How to Set Up Your Margin Trading Account and Use your Margin Trading Account.\r\n\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\nUseful Links: Join us on Telegram to connect with our community. Refer to this FAQ for the latest list of supported margin trading pairs. Refer to this Margin Trading FAQ for more details about borrowing limits, and interest rates. Notes: In addition to the following rules, please refer to the Official Rules for Sweepstakes for further rules regarding eligibility. The Margin Trading Campaign is offered by Crypto.com to Crypto.com Exchange users. Any trades that are executed through bad trading practices in Crypto.com’s absolute opinion, including but not limited to wash trades, false trading, self-dealing, or trades that display any attributes of market manipulation (“Disqualified Trades”) will not be counted towards the transaction volume of the participant. The links provided above to helpful information are for reference only. The Reward will be paid in CRO and will be credited into the winners’ Crypto.com Exchange CRO Wallet within 30 days after the Reward Period ends. The Paris Saint-Germain tickets will be e-mailed to the winners’ Crypto.com E-mail address 3-5 days prior to the game. Winners may be required to prove eligibility including proof of age, residence, and identity, which may include submitting a copy of his/her passport or similar government issued identification to collect the e-tickets. Crypto.com is not responsible for paying any additional fees associated with the redemption or usage of the prizes e.g including but not limited to personal expenses, taxes, etc. Margin trading geo-restrictions apply, please refer to this list for the excluded jurisdictions. The eligibility of participants will be verified by Crypto.com after the campaign ends and the lucky draw results will be published. Crypto.com reserves the right to cancel or amend the campaign rules at our sole discretion. All personal data collected is used strictly for verification purposes only. By accepting the prize, winners agree to the Privacy Notice of Crypto.com, which is published at crypto.com/en/privacy/global.html.', '73oKoC6W1647403134.jpg', 'winners agree to the Privacy Notice of Crypto.com', 57, 1, NULL, NULL, 'verification,Crypto', '2022-03-16 03:58:54'),
(30, 5, 'RUNE Exclusive Campaign Winner Announcement', 'rune-exclusive-campaign-winner-announcement', 'We’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token. Congratulations to all the winners! You will soon receive an email from us. Part 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool) The top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE. *RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE) Users can be rewarded for both Part 1 and Part 2 of the campaign. For more information about the promotion, please visit our blog. Note: The eligibility of participants will be verified by Crypto.com after the campaign ends.\r\n<br><br>\r\n<h4>Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!</h4>\r\n<br>\r\nWe’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token. Congratulations to all the winners! You will soon receive an email from us. Part 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool) The top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE. *RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE) Users can be rewarded for both Part 1 and Part 2 of the campaign. For more information about the promotion, please visit our blog. Note: The eligibility of participants will be verified by Crypto.com after the campaign ends.', 'D0trrRpB1647403318.jpg', 'genius', 71, 1, NULL, NULL, NULL, '2022-03-16 04:01:58');

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
(6, 'nIVdLaQo1672143357.png', '2022-04-09 06:50:21', '2022-12-27 17:15:57'),
(7, 'q4Qg2XAF1672143339.jpg', '2022-04-09 06:50:24', '2022-12-27 17:15:39'),
(8, 'Fsr6tATu1672143310.png', '2022-04-09 06:52:16', '2022-12-27 17:15:10'),
(9, 'eVoZXmVE1672143430.png', '2022-04-09 08:13:25', '2022-12-27 17:17:10');

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
  `is_money` tinyint(4) NOT NULL DEFAULT '0',
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
  `postcode_required` tinyint(4) NOT NULL DEFAULT '0',
  `is_eu` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
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
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposit_number`, `user_id`, `amount`, `currency_id`, `txnid`, `method`, `charge_id`, `status`, `created_at`, `updated_at`) VALUES
(156, 'JBOW67UvZ1M8', 102, 20000, 1, 'Dfgbjjdgvv', 'Manual', NULL, 'complete', '2023-01-08 15:50:17', '2023-01-10 01:54:09'),
(157, 'QvO0LZL0Dhbr', 104, 10000, 1, 'Dggcyhffghh', 'Manual', NULL, 'complete', '2023-01-10 00:40:15', '2023-01-10 18:11:58'),
(158, 'C5XDbp9r0XaV', 104, 5000, 1, 'Tuebeobj', 'Manual', NULL, 'complete', '2023-01-10 01:34:18', '2023-01-10 01:53:19'),
(159, 'qcrZL61UlOob', 107, 12000, 1, 'Tttouvyhg', 'Manual', NULL, 'complete', '2023-01-10 21:50:05', '2023-01-11 21:55:58'),
(160, '0Bcivq8VC9Ro', 102, 10000, 1, 'Ttlllirops', 'Manual', NULL, 'complete', '2023-01-11 13:35:41', '2023-01-11 21:55:27'),
(161, 'FQEvHCfeKOXQ', 111, 10000, 1, 'Ttbbsibsj', 'Manual', NULL, 'complete', '2023-01-12 03:53:36', '2023-01-12 04:37:45'),
(162, '7G5nooXli6L0', 111, 10000, 1, 'Ttbbsibsj', 'Manual', NULL, 'complete', '2023-01-12 03:53:38', '2023-01-12 04:38:18'),
(163, 'zQbQUhIxnzNP', 106, 500, 1, '234567', 'Manual', NULL, 'pending', '2023-02-06 17:40:55', '2023-02-06 17:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext COLLATE utf8_unicode_ci,
  `email_body` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`) VALUES
(3, 'Withdraw', 'Your withdraw is completed successfully.', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n<!--[if gte mso 9]>\r\n<xml>\r\n  <o:OfficeDocumentSettings>\r\n    <o:AllowPNG/>\r\n    <o:PixelsPerInch>96</o:PixelsPerInch>\r\n  </o:OfficeDocumentSettings>\r\n</xml>\r\n<![endif]-->\r\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->\r\n  <title></title>\r\n  \r\n    <style type=\"text/css\">\r\n      @media only screen and (min-width: 620px) {\r\n  .u-row {\r\n    width: 600px !important;\r\n  }\r\n  .u-row .u-col {\r\n    vertical-align: top;\r\n  }\r\n\r\n  .u-row .u-col-50 {\r\n    width: 300px !important;\r\n  }\r\n\r\n  .u-row .u-col-100 {\r\n    width: 600px !important;\r\n  }\r\n\r\n}\r\n\r\n@media (max-width: 620px) {\r\n  .u-row-container {\r\n    max-width: 100% !important;\r\n    padding-left: 0px !important;\r\n    padding-right: 0px !important;\r\n  }\r\n  .u-row .u-col {\r\n    min-width: 320px !important;\r\n    max-width: 100% !important;\r\n    display: block !important;\r\n  }\r\n  .u-row {\r\n    width: 100% !important;\r\n  }\r\n  .u-col {\r\n    width: 100% !important;\r\n  }\r\n  .u-col > div {\r\n    margin: 0 auto;\r\n  }\r\n}\r\nbody {\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\ntable,\r\ntr,\r\ntd {\r\n  vertical-align: top;\r\n  border-collapse: collapse;\r\n}\r\n\r\np {\r\n  margin: 0;\r\n}\r\n\r\n.ie-container table,\r\n.mso-container table {\r\n  table-layout: fixed;\r\n}\r\n\r\n* {\r\n  line-height: inherit;\r\n}\r\n\r\na[x-apple-data-detectors=\'true\'] {\r\n  color: inherit !important;\r\n  text-decoration: none !important;\r\n}\r\n\r\ntable, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } #u_content_text_4 a { color: #f1c40f; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 25% !important; } #u_content_text_3 .v-container-padding-padding { padding: 10px 20px 20px !important; } #u_content_button_1 .v-size-width { width: 65% !important; } #u_content_text_2 .v-container-padding-padding { padding: 20px 20px 60px !important; } #u_content_text_4 .v-container-padding-padding { padding: 60px 20px !important; } #u_content_heading_2 .v-container-padding-padding { padding: 30px 10px 0px !important; } #u_content_heading_2 .v-text-align { text-align: center !important; } #u_content_social_1 .v-container-padding-padding { padding: 10px 10px 10px 98px !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 20px 30px !important; } #u_content_text_5 .v-text-align { text-align: center !important; } }\r\n    </style>\r\n  \r\n  \r\n\r\n<!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->\r\n\r\n</head>\r\n\r\n<body class=\"clean-body u_body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #000000;color: #000000\">\r\n  <!--[if IE]><div class=\"ie-container\"><![endif]-->\r\n  <!--[if mso]><div class=\"mso-container\"><![endif]-->\r\n  <table id=\"u_body\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #000000;width:100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n  <tbody>\r\n  <tr style=\"vertical-align: top\">\r\n    <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n    <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"center\" style=\"background-color: #000000;\"><![endif]-->\r\n    \r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"height: 100%;width: 100% !important;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_image_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:120px 10px 100px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n  <tr>\r\n    <td class=\"v-text-align\" style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">\r\n      \r\n      <img align=\"center\" border=\"0\" src=\"images/image-6.png\" alt=\"Logo\" title=\"Logo\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 47%;max-width: 272.6px;\" width=\"272.6\" class=\"v-src-width v-src-max-width\"/>\r\n      \r\n    </td>\r\n  </tr>\r\n</table>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-image: url(\'images/image-7.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-image: url(\'images/image-7.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:60px 10px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 20px; line-height: 34px;\"><strong><span style=\"line-height: 34px; font-size: 20px;\">Hello {customer_name},</span></strong></span></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_3\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 100px 20px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 16px; line-height: 27.2px;\"><br>Your withdraw is completed successfully.</p><p>Thank You<br></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_button_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->\r\n<div class=\"v-text-align\" align=\"center\">\r\n  <!--[if mso]><v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"https://www.unlayer.com\" style=\"height:39px; v-text-anchor:middle; width:290px;\" arcsize=\"10.5%\"  stroke=\"f\" fillcolor=\"#000000\"><w:anchorlock/><center style=\"color:#FFFFFF;font-family:\'Open Sans\',sans-serif;\"><![endif]-->  \r\n   <!-- <a href=\"https://www.unlayer.com\" target=\"_blank\" class=\"v-button v-size-width\" style=\"box-sizing: border-box;display: inline-block;font-family:\'Open Sans\',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #000000; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:50%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;\">\r\n      <span style=\"display:block;padding:10px 20px;line-height:120%;\"><span style=\"font-size: 16px; line-height: 19.2px;\"><strong><span style=\"line-height: 19.2px; font-size: 16px;\">Verify Email</span></strong></span></span>\r\n    </a>->\r\n  <!--[if mso]></center></v:roundrect><![endif]-->\r\n</div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n   <!-- <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:20px 100px 60px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 16px; line-height: 27.2px;\">Big Tech is a free voice, video, and text chat app that’s </span><span style=\"font-size: 16px; line-height: 27.2px;\">used by tens of millions of people. Lorem ipsum is </span><span style=\"font-size: 16px; line-height: 27.2px;\">dolor sit amet, consec tetur.</span></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>-->\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #000000;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #000000;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_text_4\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:60px 80px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"color: #ffffff; line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\">Need help? <a rel=\"noopener\" href=\"https://www.fxdailiesinvetment.com\" target=\"_blank\">Contact our support team</a> , send us a mail to <a rel=\"noopener\" href=\"support@fxdailiesinvetment.com\" target=\"_blank\">support@fxdailiesinvetment.com</a>.</p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-image: url(\'images/image-5.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-image: url(\'images/image-5.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"300\" style=\"background-color: #f1c40f;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_heading_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:30px 10px 0px 50px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <h1 class=\"v-text-align\" style=\"margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: \'Rubik\',sans-serif; font-size: 22px;\"><div>\r\n<div><strong>FX DAILIES INVESTMENT</strong></div>\r\n</div></h1>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_social_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 10px 30px 50px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n<div align=\"left\">\r\n  <div style=\"display: table; max-width:140px;\">\r\n  <!--[if (mso)|(IE)]><table width=\"140\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"border-collapse:collapse;\" align=\"left\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:140px;\"><tr><![endif]-->\r\n  \r\n    \r\n    <!--[if (mso)|(IE)]><td width=\"32\" style=\"width:32px; padding-right: 15px;\" valign=\"top\"><![endif]-->\r\n    <table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"32\" height=\"32\" style=\"width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px\">\r\n      <tbody><tr style=\"vertical-align: top\"><td align=\"left\" valign=\"middle\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n        <a href=\"https://facebook.com/\" title=\"Facebook\" target=\"_blank\">\r\n          <img src=\"https://fxdailiesinvestment.com/assets/images/image-1.png\" alt=\"Facebook\" title=\"Facebook\" width=\"32\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important\">\r\n        </a>\r\n      </td></tr>\r\n    </tbody></table>\r\n    <!--[if (mso)|(IE)]></td><![endif]-->\r\n    \r\n    <!--[if (mso)|(IE)]><td width=\"32\" style=\"width:32px; padding-right: 15px;\" valign=\"top\"><![endif]-->\r\n    <table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"32\" height=\"32\" style=\"width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px\">\r\n      <tbody><tr style=\"vertical-align: top\"><td align=\"left\" valign=\"middle\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n        <a href=\"https://instagram.com/\" title=\"Instagram\" target=\"_blank\">\r\n          <img src=\"https://fxdailiesinvestment.com/assets/images/image-2.png\" alt=\"Instagram\" title=\"Instagram\" width=\"32\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important\">\r\n        </a>\r\n      </td></tr>\r\n    </tbody></table>\r\n    <!--[if (mso)|(IE)]></td><![endif]-->\r\n    \r\n    <!--[if (mso)|(IE)]><td width=\"32\" style=\"width:32px; padding-right: 0px;\" valign=\"top\"><![endif]-->\r\n    <table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"32\" height=\"32\" style=\"width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px\">\r\n      <tbody><tr style=\"vertical-align: top\"><td align=\"left\" valign=\"middle\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n        <a href=\"https://linkedin.com/\" title=\"LinkedIn\" target=\"_blank\">\r\n          <img src=\"https://fxdailiesinvestment.com/assets/images/image-2.png\" alt=\"LinkedIn\" title=\"LinkedIn\" width=\"32\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important\">\r\n        </a>\r\n      </td></tr>\r\n    </tbody></table>\r\n    <!--[if (mso)|(IE)]></td><![endif]-->\r\n    \r\n    \r\n    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n  </div>\r\n</div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"300\" style=\"background-color: #f1c40f;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_text_5\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:31px 50px 30px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: right; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\">Staffelseestraße , 81477 München, Germany</p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-image: url(\'images/image-4.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\">\r\n      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-image: url(\'images/image-4.png\');background-repeat: no-repeat;background-position: center top;background-color: transparent;\"><![endif]-->\r\n      \r\n<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #000000;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->\r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #000000;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 140%;\">Staffelseestraße , 81477 München, German</p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->\r\n    </td>\r\n  </tr>\r\n  </tbody>\r\n  </table>\r\n  <!--[if mso]></div><![endif]-->\r\n  <!--[if IE]></div><![endif]-->\r\n</body>\r\n\r\n</html>', 1),
(4, 'Deposit', 'You have invested successfully.', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n\r\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->\r\n  <title></title>\r\n  \r\n    <style type=\"text/css\">\r\n      @media only screen and (min-width: 620px) {\r\n  .u-row {\r\n    width: 600px !important;\r\n  }\r\n  .u-row .u-col {\r\n    vertical-align: top;\r\n  }\r\n\r\n  .u-row .u-col-50 {\r\n    width: 300px !important;\r\n  }\r\n\r\n  .u-row .u-col-100 {\r\n    width: 600px !important;\r\n  }\r\n\r\n}\r\n\r\n@media (max-width: 620px) {\r\n  .u-row-container {\r\n    max-width: 100% !important;\r\n    padding-left: 0px !important;\r\n    padding-right: 0px !important;\r\n  }\r\n  .u-row .u-col {\r\n    min-width: 320px !important;\r\n    max-width: 100% !important;\r\n    display: block !important;\r\n  }\r\n  .u-row {\r\n    width: 100% !important;\r\n  }\r\n  .u-col {\r\n    width: 100% !important;\r\n  }\r\n  .u-col > div {\r\n    margin: 0 auto;\r\n  }\r\n}\r\nbody {\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\ntable,\r\ntr,\r\ntd {\r\n  vertical-align: top;\r\n  border-collapse: collapse;\r\n}\r\n\r\np {\r\n  margin: 0;\r\n}\r\n\r\n.ie-container table,\r\n.mso-container table {\r\n  table-layout: fixed;\r\n}\r\n\r\n* {\r\n  line-height: inherit;\r\n}\r\n\r\na[x-apple-data-detectors=\'true\'] {\r\n  color: inherit !important;\r\n  text-decoration: none !important;\r\n}\r\n\r\ntable, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } #u_content_text_4 a { color: #f1c40f; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 25% !important; } #u_content_text_3 .v-container-padding-padding { padding: 10px 20px 20px !important; } #u_content_button_1 .v-size-width { width: 65% !important; } #u_content_text_2 .v-container-padding-padding { padding: 20px 20px 60px !important; } #u_content_text_4 .v-container-padding-padding { padding: 60px 20px !important; } #u_content_heading_2 .v-container-padding-padding { padding: 30px 10px 0px !important; } #u_content_heading_2 .v-text-align { text-align: center !important; } #u_content_social_1 .v-container-padding-padding { padding: 10px 10px 10px 98px !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 20px 30px !important; } #u_content_text_5 .v-text-align { text-align: center !important; } }\r\n    </style>\r\n  \r\n  \r\n\r\n<!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->\r\n\r\n</head>\r\n\r\n<body class=\"clean-body u_body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #000000;color: #000000\">\r\n  <!--[if IE]><div class=\"ie-container\"><![endif]-->\r\n  <!--[if mso]><div class=\"mso-container\"><![endif]-->\r\n  <table id=\"u_body\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #000000;width:100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n  <tbody>\r\n  <tr style=\"vertical-align: top\">\r\n    <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n   \r\n    \r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">\r\n     \r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"height: 100%;width: 100% !important;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_image_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:120px 10px 100px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n  <tr>\r\n    <td class=\"v-text-align\" style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">\r\n      \r\n      <img align=\"center\" border=\"0\" src=\"https://fxdailiesinvestment.com/assets/images/iywM1cwT1672147727.png\" alt=\"Logo\" title=\"Logo\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 47%;max-width: 272.6px;\" width=\"272.6\" class=\"v-src-width v-src-max-width\"/>\r\n      \r\n    </td>\r\n  </tr>\r\n</table>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n   \r\n     \r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:60px 10px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 20px; line-height: 34px;\"><strong><span style=\"line-height: 34px; font-size: 20px;\">Hello {customer_name},</span></strong></span></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_3\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 100px 20px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 16px; line-height: 27.2px;\">You have deposited successfully.</p><p>Transaction amount:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_button_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n \r\n<div class=\"v-text-align\" align=\"center\">\r\n  \r\n</div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n   \r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%; background-repeat: no-repeat;background-position: center top;background-color: transparent;\">\r\n   \r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_heading_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:30px 10px 0px 50px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <h1 class=\"v-text-align\" style=\"margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: \'Rubik\',sans-serif; font-size: 22px;\"><div>\r\n<div><strong>FX DAILIES INVESTMENT</strong></div>\r\n</div></h1>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n\r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_text_5\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:31px 50px 30px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: right; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\">Staffelseestraße , 81477 München, Germany</p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->\r\n    </td>\r\n  </tr>\r\n  </tbody>\r\n  </table>\r\n  <!--[if mso]></div><![endif]-->\r\n  <!--[if IE]></div><![endif]-->\r\n</body>\r\n\r\n</html>', 1);
INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`) VALUES
(5, 'Invest', 'Your Investment is Completed Successfully.', '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n\r\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->\r\n  <title></title>\r\n  \r\n    <style type=\"text/css\">\r\n      @media only screen and (min-width: 620px) {\r\n  .u-row {\r\n    width: 600px !important;\r\n  }\r\n  .u-row .u-col {\r\n    vertical-align: top;\r\n  }\r\n\r\n  .u-row .u-col-50 {\r\n    width: 300px !important;\r\n  }\r\n\r\n  .u-row .u-col-100 {\r\n    width: 600px !important;\r\n  }\r\n\r\n}\r\n\r\n@media (max-width: 620px) {\r\n  .u-row-container {\r\n    max-width: 100% !important;\r\n    padding-left: 0px !important;\r\n    padding-right: 0px !important;\r\n  }\r\n  .u-row .u-col {\r\n    min-width: 320px !important;\r\n    max-width: 100% !important;\r\n    display: block !important;\r\n  }\r\n  .u-row {\r\n    width: 100% !important;\r\n  }\r\n  .u-col {\r\n    width: 100% !important;\r\n  }\r\n  .u-col > div {\r\n    margin: 0 auto;\r\n  }\r\n}\r\nbody {\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\ntable,\r\ntr,\r\ntd {\r\n  vertical-align: top;\r\n  border-collapse: collapse;\r\n}\r\n\r\np {\r\n  margin: 0;\r\n}\r\n\r\n.ie-container table,\r\n.mso-container table {\r\n  table-layout: fixed;\r\n}\r\n\r\n* {\r\n  line-height: inherit;\r\n}\r\n\r\na[x-apple-data-detectors=\'true\'] {\r\n  color: inherit !important;\r\n  text-decoration: none !important;\r\n}\r\n\r\ntable, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } #u_content_text_4 a { color: #f1c40f; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 25% !important; } #u_content_text_3 .v-container-padding-padding { padding: 10px 20px 20px !important; } #u_content_button_1 .v-size-width { width: 65% !important; } #u_content_text_2 .v-container-padding-padding { padding: 20px 20px 60px !important; } #u_content_text_4 .v-container-padding-padding { padding: 60px 20px !important; } #u_content_heading_2 .v-container-padding-padding { padding: 30px 10px 0px !important; } #u_content_heading_2 .v-text-align { text-align: center !important; } #u_content_social_1 .v-container-padding-padding { padding: 10px 10px 10px 98px !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 20px 30px !important; } #u_content_text_5 .v-text-align { text-align: center !important; } }\r\n    </style>\r\n  \r\n  \r\n\r\n<!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->\r\n\r\n</head>\r\n\r\n<body class=\"clean-body u_body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #000000;color: #000000\">\r\n  <!--[if IE]><div class=\"ie-container\"><![endif]-->\r\n  <!--[if mso]><div class=\"mso-container\"><![endif]-->\r\n  <table id=\"u_body\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #000000;width:100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n  <tbody>\r\n  <tr style=\"vertical-align: top\">\r\n    <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">\r\n   \r\n    \r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">\r\n     \r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"height: 100%;width: 100% !important;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_image_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:120px 10px 100px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n  <tr>\r\n    <td class=\"v-text-align\" style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">\r\n      \r\n      <img align=\"center\" border=\"0\" src=\"https://fxdailiesinvestment.com/assets/images/iywM1cwT1672147727.png\" alt=\"Logo\" title=\"Logo\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 47%;max-width: 272.6px;\" width=\"272.6\" class=\"v-src-width v-src-max-width\"/>\r\n      \r\n    </td>\r\n  </tr>\r\n</table>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n   \r\n     \r\n<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:60px 10px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 20px; line-height: 34px;\"><strong><span style=\"line-height: 34px; font-size: 20px;\">Hello {customer_name},</span></strong></span></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_3\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 100px 20px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: center; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-size: 16px; line-height: 27.2px;\"><br>Your invest successfully completed.</p><p>Thank You<br></p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_button_1\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n \r\n<div class=\"v-text-align\" align=\"center\">\r\n  \r\n</div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n<table id=\"u_content_text_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n   \r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n\r\n<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">\r\n  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">\r\n    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%; background-repeat: no-repeat;background-position: center top;background-color: transparent;\">\r\n   \r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_heading_2\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:30px 10px 0px 50px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <h1 class=\"v-text-align\" style=\"margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: \'Rubik\',sans-serif; font-size: 22px;\"><div>\r\n<div><strong>FX DAILIES INVESTMENT</strong></div>\r\n</div></h1>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n\r\n<div class=\"u-col u-col-50\" style=\"max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;\">\r\n  <div style=\"background-color: #f1c40f;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">\r\n  <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->\r\n  \r\n<table id=\"u_content_text_5\" style=\"font-family:\'Open Sans\',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n  <tbody>\r\n    <tr>\r\n      <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:31px 50px 30px 10px;font-family:\'Open Sans\',sans-serif;\" align=\"left\">\r\n        \r\n  <div class=\"v-text-align\" style=\"line-height: 170%; text-align: right; word-wrap: break-word;\">\r\n    <p style=\"font-size: 14px; line-height: 170%;\">Staffelseestraße , 81477 München, Germany</p>\r\n  </div>\r\n\r\n      </td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->\r\n  </div>\r\n</div>\r\n<!--[if (mso)|(IE)]></td><![endif]-->\r\n      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n\r\n\r\n    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->\r\n    </td>\r\n  </tr>\r\n  </tbody>\r\n  </table>\r\n  <!--[if mso]></div><![endif]-->\r\n  <!--[if IE]></div><![endif]-->\r\n</body>\r\n\r\n</html>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '0'
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
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `details`, `icon`) VALUES
(8, 'Daily Profit', 'DAILY PROFIT. You can make profit every day with our investment proposals!', 'fas fa-cog'),
(9, 'Special Security', 'Your deposits are insured by our Special Trust Fund. Your deposits are safe.', 'fas fa-cog'),
(10, 'Extreme Support', 'Our specialists are available around the clock to help you. Please let us know your questions.', 'fas fa-cog'),
(11, 'Limitless Investment', 'INVESTING WITHOUT BORDERS. You can invest in our company from anywhere in the world. We focus on Forex Trading, Crypto Mining, Agricultural Development and Real Estates', 'fas fa-cog'),
(12, 'Registered Company', '<p><span style=\"font-family:Asap, sans-serif;text-align:right;\">We are a certified company which conducts absolutely legal activities in the legal field. We are certified and safe.</span><br></p>', 'fas fa-moon'),
(13, 'Quick Withdrawal', 'Request withdrawal  at any time and paid  fast, no delays no question asked', 'fas fa-moon');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
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
  `header_email` text COLLATE utf8mb4_unicode_ci,
  `header_phone` text COLLATE utf8mb4_unicode_ci,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_talkto` tinyint(1) NOT NULL DEFAULT '1',
  `talkto` text COLLATE utf8mb4_unicode_ci,
  `is_language` tinyint(1) NOT NULL DEFAULT '1',
  `is_loader` tinyint(1) NOT NULL DEFAULT '1',
  `map_key` text COLLATE utf8mb4_unicode_ci,
  `is_disqus` tinyint(1) NOT NULL DEFAULT '0',
  `disqus` longtext COLLATE utf8mb4_unicode_ci,
  `is_contact` tinyint(1) NOT NULL DEFAULT '0',
  `is_faq` tinyint(1) NOT NULL DEFAULT '0',
  `is_maintain` tinyint(4) NOT NULL DEFAULT '0',
  `maintain_text` text COLLATE utf8mb4_unicode_ci,
  `day_of` longtext COLLATE utf8mb4_unicode_ci,
  `withdraw_status` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_smtp` tinyint(1) NOT NULL DEFAULT '0',
  `is_currency` tinyint(1) NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0',
  `subscribe_success` text COLLATE utf8mb4_unicode_ci,
  `subscribe_error` text COLLATE utf8mb4_unicode_ci,
  `error_title` text COLLATE utf8mb4_unicode_ci,
  `error_text` text COLLATE utf8mb4_unicode_ci,
  `error_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(1) NOT NULL DEFAULT '0',
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verification_email` tinyint(1) NOT NULL DEFAULT '0',
  `withdraw_fee` double NOT NULL DEFAULT '0',
  `withdraw_charge` double NOT NULL DEFAULT '0',
  `is_affilate` tinyint(1) NOT NULL DEFAULT '1',
  `affilate_charge` double NOT NULL DEFAULT '0',
  `affilate_banner` text COLLATE utf8mb4_unicode_ci,
  `secret_string` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gap_limit` int(11) NOT NULL DEFAULT '300',
  `isWallet` tinyint(4) NOT NULL DEFAULT '0',
  `affilate_new_user` int(11) NOT NULL DEFAULT '0',
  `affilate_user` int(11) NOT NULL DEFAULT '0',
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pm` tinyint(4) DEFAULT '0',
  `cc_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_transfer` tinyint(4) NOT NULL DEFAULT '0',
  `twilio_account_sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_status` tinyint(4) NOT NULL DEFAULT '0',
  `nexmo_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_status` tinyint(4) NOT NULL DEFAULT '0',
  `two_factor` tinyint(4) NOT NULL DEFAULT '0',
  `kyc` tinyint(4) NOT NULL DEFAULT '0',
  `menu` text COLLATE utf8mb4_unicode_ci,
  `transfer_fixed` double DEFAULT NULL,
  `transfer_percentage` double DEFAULT NULL,
  `transfer_min` double DEFAULT NULL,
  `transfer_max` double DEFAULT NULL,
  `fixed_request_charge` double DEFAULT NULL,
  `percentage_request_charge` double DEFAULT NULL,
  `minimum_request_money` double DEFAULT NULL,
  `maximum_request_money` double DEFAULT NULL,
  `module_section` longtext COLLATE utf8mb4_unicode_ci,
  `phone_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `logo`, `favicon`, `loader`, `admin_loader`, `banner`, `title`, `header_email`, `header_phone`, `footer`, `copyright`, `colors`, `is_talkto`, `talkto`, `is_language`, `is_loader`, `map_key`, `is_disqus`, `disqus`, `is_contact`, `is_faq`, `is_maintain`, `maintain_text`, `day_of`, `withdraw_status`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_user`, `smtp_pass`, `from_email`, `from_name`, `is_smtp`, `is_currency`, `currency_format`, `subscribe_success`, `subscribe_error`, `error_title`, `error_text`, `error_photo`, `breadcumb_banner`, `is_admin_loader`, `currency_code`, `currency_sign`, `is_verification_email`, `withdraw_fee`, `withdraw_charge`, `is_affilate`, `affilate_charge`, `affilate_banner`, `secret_string`, `gap_limit`, `isWallet`, `affilate_new_user`, `affilate_user`, `footer_logo`, `pm_account`, `is_pm`, `cc_api_key`, `balance_transfer`, `twilio_account_sid`, `twilio_auth_token`, `twilio_default_number`, `twilio_status`, `nexmo_key`, `nexmo_secret`, `nexmo_default_number`, `nexmo_status`, `two_factor`, `kyc`, `menu`, `transfer_fixed`, `transfer_percentage`, `transfer_min`, `transfer_max`, `fixed_request_charge`, `percentage_request_charge`, `minimum_request_money`, `maximum_request_money`, `module_section`, `phone_code`, `latitude`, `longitude`) VALUES
(1, 'iywM1cwT1672147727.png', 'Yo7c3v0R1650180806.png', '5monWltX1641808745.gif', '33CiUFaI1641808748.gif', '1563350277herobg.jpg', 'FX Dailies Investment', 'Info@example.com', '0123 456789', 'FX Dailies Investment is a leading German-based wealth creation management provider, offering a range of flexible products and investment solutions through our newly improved online platform. \r\nWe strongly believe in the value of advice and only offer our products through qualified financial advisers. Together with advisers, we help hundreds of thousands of customers like you who look after their money and achieve their financial goals. Our goal is to provide our investors with a reliable source of high income, while minimizing any possible risks and offering a high-quality service, allowing us to automate and simplify the relations between the investors and the trustees.', 'COPYRIGHT © 2019. All Rights Reserved By <a href=\"http://fxdailiesinvestment.com/\">fxdailiesinvestment.com</a>', '#dd560e', 0, '<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5bc2019c61d0b77092512d03/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>', 1, 0, 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8', 0, 'fxdailiesinvestment', 1, 1, 0, 'Website under Maintenance ', 'Wed', 1, 'smtppro.zoho.com', '587', 'tls', 'support@fxdailiesinvestment.com', 'Dr.jackson2022', 'support@fxdailiesinvestment.com', 'FX Dailies Investment', 1, 1, 0, 'You are subscribed Successfully.', 'This email has already been taken.', 'OOPS ! ... PAGE NOT FOUND', 'THE PAGE YOU ARE LOOKING FOR MIGHT HAVE BEEN REMOVED, HAD ITS NAME CHANGED, OR IS TEMPORARILY UNAVAILABLE.<script>alert(\'ok\')</script>', '16392899281561878540404.png', '4oHWW9wP1647317756.png', 0, 'USD', '$', 0, 5, 5, 1, 5, '16406712051566471347add.jpg', 'ZzsMLGKe162CfA5EcG6j', 3000, 1, 5, 5, '2oe5PRfj1672147735.png', 'U36807958', 1, 'cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a', 1, 'ACb87cec0c7d04b80d78bf1647edf8f67f', 'ee60fb893d6e7a2db56e5748e5eab8a3', '01976814812', 1, 'ba9111b8', 'cgxbAg4KnE80bcKx', '01976814812', 1, 0, 0, '{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"\\/\",\"target\":\"self\"},\"About\":{\"title\":\"About\",\"dropdown\":\"no\",\"href\":\"\\/about\",\"target\":\"self\"},\"Plans\":{\"title\":\"Plans\",\"dropdown\":\"no\",\"href\":\"\\/plans\",\"target\":\"self\"},\"Blog\":{\"title\":\"Blog\",\"dropdown\":\"no\",\"href\":\"\\/blogs\",\"target\":\"self\"}}', 1, 0.8, 10, 1000, 1, 0.3, 1000, 5000, '', '+880', '0', '0');

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
  `txnid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `coin_amount` double DEFAULT NULL,
  `profit_amount` double DEFAULT NULL,
  `hold_amount` double DEFAULT NULL,
  `profit` double NOT NULL DEFAULT '0',
  `lifetime_return` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 == ''yes'',\r\n0 == ''no''',
  `profit_repeat` int(11) DEFAULT NULL,
  `capital_back` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 == ''yes'',\r\n0 == ''no''',
  `capital_sent` tinyint(4) DEFAULT '0',
  `payment_status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 == ''pending'',\r\n1 == ''running'',\r\n2 == ''completed''',
  `profit_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invests`
--

INSERT INTO `invests` (`id`, `transaction_no`, `charge_id`, `txnid`, `user_id`, `plan_id`, `currency_id`, `method`, `amount`, `coin_amount`, `profit_amount`, `hold_amount`, `profit`, `lifetime_return`, `profit_repeat`, `capital_back`, `capital_sent`, `payment_status`, `status`, `profit_time`, `created_at`, `updated_at`) VALUES
(44, '5ner1673177977', NULL, NULL, 103, 7, 1, 'manual', 5500, NULL, 55, NULL, 55, 0, 1, 1, 1, 'pending', 1, '2023-01-18 04:00:10', '2023-01-08 16:39:37', '2023-01-11 04:00:11'),
(45, '0zUK1673293674', NULL, NULL, 105, 8, 1, 'Manual', 200, NULL, 16, NULL, 16, 0, 1, 1, 1, 'pending', 1, '2023-01-24 04:00:13', '2023-01-10 00:47:54', '2023-01-17 04:00:13'),
(46, 'oFfnYWAzzpIh', NULL, NULL, 102, 7, 1, 'Main Wallet', 10000, NULL, 1000, NULL, 0, 0, 0, 1, 0, 'completed', 1, '2023-01-18 12:40:14', '2023-01-11 12:40:14', '2023-01-11 12:40:14'),
(47, 'iqhcRHSmnRRt', NULL, NULL, 102, 4, 1, 'Main Wallet', 5000, NULL, 150, NULL, 450, 0, 3, 1, 1, 'completed', 1, '2023-01-18 04:00:13', '2023-01-11 12:41:39', '2023-01-17 04:00:13'),
(48, '9eAAbL62UGvZ', NULL, NULL, 102, 8, 1, 'Main Wallet', 4000, NULL, 320, 320, 0, 0, 1, 1, 0, 'completed', 1, '2023-01-28 04:00:16', '2023-01-11 12:47:09', '2023-01-21 04:00:16'),
(49, 'HAMKY8wpWVRm', NULL, NULL, 102, 8, 1, 'Main Wallet', 900, NULL, 72, 72, 0, 0, 1, 1, 0, 'completed', 1, '2023-01-27 04:00:18', '2023-01-11 12:49:09', '2023-01-20 04:00:18'),
(50, 'eiwI1673433621', NULL, NULL, 106, 7, 1, 'Manual', 5000, NULL, 500, NULL, 0, 0, 0, 1, 0, 'pending', 0, '2023-01-18 15:40:21', '2023-01-11 15:40:21', '2023-01-11 15:40:21'),
(51, 'FHt21673458984', NULL, NULL, 110, 7, 1, 'Manual', 10000, NULL, 1000, 2000, 7000, 0, 9, 1, 1, 'pending', 1, '2023-04-23 02:00:11', '2023-01-11 22:43:04', '2023-04-16 02:00:11'),
(52, 'g7Z81673481570', NULL, NULL, 111, 7, 6, 'Manual', 11562.431190223, NULL, 1156.2431190223, NULL, 0, 0, 0, 1, 0, 'pending', 0, '2023-01-19 04:59:30', '2023-01-12 04:59:30', '2023-01-12 04:59:30'),
(53, 'VNmC1673482367', NULL, NULL, 111, 7, 1, 'Manual', 5000, NULL, 500, 500, 4000, 0, 9, 1, 1, 'pending', 1, '2023-04-23 02:00:11', '2023-01-12 05:12:47', '2023-04-16 02:00:11'),
(54, 'sWcE1673483893', NULL, NULL, 111, 7, 1, 'Manual', 5000, NULL, 500, NULL, 0, 0, 0, 1, 0, 'pending', 0, '2023-01-19 05:38:13', '2023-01-12 05:38:13', '2023-01-12 05:38:13'),
(55, 'SYTkSGZPAwgD', NULL, NULL, 111, 7, 1, 'Main Wallet', 5000, NULL, 500, 500, 4500, 0, 10, 1, 1, 'completed', 1, '2023-04-29 02:00:17', '2023-01-12 12:12:30', '2023-04-22 02:00:17'),
(56, 'txK0BQaKQvXz', NULL, NULL, 111, 7, 1, 'Main Wallet', 10000, NULL, 1000, 1000, 9000, 0, 10, 1, 1, 'completed', 1, '2023-04-28 02:00:14', '2023-01-12 15:58:07', '2023-04-21 02:00:14');

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
  `required` tinyint(4) NOT NULL DEFAULT '0',
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
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
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
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
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
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 == success\r\n0 == pending',
  `details` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `order_id`, `user_id`, `vendor_id`, `product_id`, `conversation_id`, `is_read`, `created_at`, `updated_at`) VALUES
(165, NULL, 89, NULL, NULL, NULL, 0, '2022-04-16 07:39:58', '2022-04-16 07:39:58'),
(166, NULL, 91, NULL, NULL, NULL, 0, '2022-04-16 07:46:33', '2022-04-16 07:46:33'),
(167, NULL, 92, NULL, NULL, NULL, 0, '2023-01-01 18:57:58', '2023-01-01 18:57:58'),
(168, NULL, 93, NULL, NULL, NULL, 0, '2023-01-07 17:09:36', '2023-01-07 17:09:36'),
(169, NULL, 94, NULL, NULL, NULL, 0, '2023-01-07 17:09:38', '2023-01-07 17:09:38'),
(170, NULL, 95, NULL, NULL, NULL, 0, '2023-01-07 17:09:39', '2023-01-07 17:09:39'),
(171, NULL, 96, NULL, NULL, NULL, 0, '2023-01-07 17:09:40', '2023-01-07 17:09:40'),
(172, NULL, 97, NULL, NULL, NULL, 0, '2023-01-07 17:16:12', '2023-01-07 17:16:12'),
(173, NULL, 98, NULL, NULL, NULL, 0, '2023-01-07 18:10:17', '2023-01-07 18:10:17'),
(174, NULL, 99, NULL, NULL, NULL, 0, '2023-01-08 02:53:55', '2023-01-08 02:53:55'),
(175, NULL, 100, NULL, NULL, NULL, 0, '2023-01-08 03:11:00', '2023-01-08 03:11:00'),
(176, NULL, 101, NULL, NULL, NULL, 0, '2023-01-08 11:58:43', '2023-01-08 11:58:43'),
(177, NULL, 102, NULL, NULL, NULL, 0, '2023-01-08 15:25:49', '2023-01-08 15:25:49'),
(178, NULL, 103, NULL, NULL, NULL, 0, '2023-01-08 16:37:26', '2023-01-08 16:37:26'),
(179, NULL, 104, NULL, NULL, NULL, 0, '2023-01-10 00:37:09', '2023-01-10 00:37:09'),
(180, NULL, 105, NULL, NULL, NULL, 0, '2023-01-10 00:44:17', '2023-01-10 00:44:17'),
(181, NULL, 106, NULL, NULL, NULL, 0, '2023-01-10 13:37:06', '2023-01-10 13:37:06'),
(182, NULL, 107, NULL, NULL, NULL, 0, '2023-01-10 21:48:48', '2023-01-10 21:48:48'),
(183, NULL, 108, NULL, NULL, NULL, 0, '2023-01-11 12:20:39', '2023-01-11 12:20:39'),
(184, NULL, 109, NULL, NULL, NULL, 0, '2023-01-11 12:20:39', '2023-01-11 12:20:39'),
(185, NULL, 110, NULL, NULL, NULL, 0, '2023-01-11 22:29:50', '2023-01-11 22:29:50'),
(186, NULL, 111, NULL, NULL, NULL, 0, '2023-01-12 03:47:27', '2023-01-12 03:47:27'),
(187, NULL, 112, NULL, NULL, NULL, 0, '2023-01-14 02:24:32', '2023-01-14 02:24:32'),
(188, NULL, 113, NULL, NULL, NULL, 0, '2023-02-02 05:17:11', '2023-02-02 05:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header` tinyint(1) NOT NULL DEFAULT '0',
  `footer` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_tag`, `meta_description`, `header`, `footer`, `status`) VALUES
(1, 'About Us', 'about', 'FX Dailies Investment is a leading German-based wealth management provider, offering a range of flexible products and investment solutions through our newly improved online platform. We strongly believe in the value of advice and only offer our products through qualified financial advisers. Together with advisers, we help hundreds of thousands of customers like you look after their money and achieve their financial goals. Our goal is to provide our investors with a reliable source of high income, while minimizing any possible risks and offering a high-quality service, allowing us to automate and simplify the relations between the investors and the trustees. We work towards increasing your profit margin by profitable investment. We look forward to you being part of our community. With our easy-to-use online platform, you’ll have more control over your financial position. You and your financial adviser can manage your investments online, react more quickly to market developments and alter your asset choice whenever you want. Financial Forex Robot Investment is a distinctive investment company offering our investors access to high-growth investment opportunities in Crypto markets and other services. We implement best practices of trading Crypto through our operations while offering flexibility in our investment plans.\r\n\r\nOur company benefits from an extensive network of global clients. Financial Forex Robot Investment Company, we emphasize understanding our client’s requirements and providing suitable solutions to meet their investment criteria. Our aim is to utilize our expert knowledge which will benefit our clients and the users of our services. Our company believes that when a team outperforms expectations, excellence becomes a reality. Legal address: Staffelseestraße , 81477 München, Germany', NULL, NULL, 1, 0, 1),
(2, 'Privacy & Policy', 'privacy', '<h3>Title number 1</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<br>\r\n<h3>Title number 2</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br>\r\n<h3>Title number 3</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br>\r\n<h3>Title number 4</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'test,test1,test2,test3', 'Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 1, 1),
(4, 'Support', 'support', '<h3>Title number 1</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<br>\r\n<h3>Title number 2</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br>\r\n<h3>Title number 3</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br>\r\n<h3>Title number 4</h3>\r\n<br>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pagesettings`
--

CREATE TABLE `pagesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_success` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_title` text COLLATE utf8mb4_unicode_ci,
  `contact_text` text COLLATE utf8mb4_unicode_ci,
  `side_title` text COLLATE utf8mb4_unicode_ci,
  `side_text` text COLLATE utf8mb4_unicode_ci,
  `street` text COLLATE utf8mb4_unicode_ci,
  `phone` text COLLATE utf8mb4_unicode_ci,
  `fax` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `site` text COLLATE utf8mb4_unicode_ci,
  `login_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_subtitle` text COLLATE utf8mb4_unicode_ci,
  `hero_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_btn_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_blog` tinyint(1) NOT NULL DEFAULT '1',
  `pricing_plan` tinyint(1) NOT NULL DEFAULT '0',
  `plan_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_subtitle` text COLLATE utf8mb4_unicode_ci,
  `blog_subtitle` text COLLATE utf8mb4_unicode_ci,
  `blog_title` text COLLATE utf8mb4_unicode_ci,
  `blog_text` text COLLATE utf8mb4_unicode_ci,
  `faq_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_subtitle` text COLLATE utf8mb4_unicode_ci,
  `about_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text COLLATE utf8mb4_unicode_ci,
  `about_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_details` longtext COLLATE utf8mb4_unicode_ci,
  `footer_top_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text COLLATE utf8mb4_unicode_ci,
  `banner_text` text COLLATE utf8mb4_unicode_ci,
  `banner_link1` text COLLATE utf8mb4_unicode_ci,
  `banner_link2` text COLLATE utf8mb4_unicode_ci,
  `app_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_text` text COLLATE utf8mb4_unicode_ci,
  `start_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_text` text COLLATE utf8mb4_unicode_ci,
  `brand_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_text` text COLLATE utf8mb4_unicode_ci,
  `brand_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_text` text COLLATE utf8mb4_unicode_ci,
  `referral_percentage` text COLLATE utf8mb4_unicode_ci,
  `profit_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_text` text COLLATE utf8mb4_unicode_ci,
  `call_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_bg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagesettings`
--

INSERT INTO `pagesettings` (`id`, `contact_success`, `contact_email`, `contact_title`, `contact_text`, `side_title`, `side_text`, `street`, `phone`, `fax`, `email`, `site`, `login_banner`, `login_title`, `login_subtitle`, `hero_title`, `hero_subtitle`, `hero_btn_url`, `hero_link`, `hero_photo`, `review_blog`, `pricing_plan`, `plan_title`, `plan_subtitle`, `blog_subtitle`, `blog_title`, `blog_text`, `faq_title`, `faq_subtitle`, `about_photo`, `about_title`, `about_text`, `about_link`, `about_details`, `footer_top_photo`, `footer_top_title`, `footer_top_text`, `banner_title`, `banner_text`, `banner_link1`, `banner_link2`, `app_banner`, `start_title`, `start_text`, `start_photo`, `feature_title`, `feature_text`, `team_title`, `team_text`, `brand_title`, `brand_text`, `brand_photo`, `referral_banner`, `referral_title`, `referral_text`, `referral_percentage`, `profit_banner`, `profit_title`, `profit_text`, `call_title`, `call_subtitle`, `call_link`, `call_bg`) VALUES
(1, 'Success! Thanks for contacting us, we will get back to you shortly.', 'support@fxdailiesinvestment..com', '<h4 class=\"subtitle\" style=\"margin-bottom: 6px; font-weight: 600; line-height: 28px; font-size: 28px; text-transform: uppercase;\">WE\'D LOVE TO</h4><h2 class=\"title\" style=\"margin-bottom: 13px;font-weight: 600;line-height: 50px;font-size: 40px;color: #1f71d4;text-transform: uppercase;\">HEAR FROM YOU</h2>', '<span style=\"color: rgb(119, 119, 119);\">Send us a message and we\' ll respond as soon as possible</span><br>', 'Get in Touch with US', 'feel&nbsp; free to send us&nbsp; a message', '134 Fifth Ave, New York, NY 12004, United States', '+0123456789', '00 000 000 000', 'support@fxdailiesinvestment.com', 'https://fxdailiesinvestment.com/', 'CkzTngcE1649742892.png', 'Turn Your ideas into Reality', 'Change your lifestyle signing up here. Invest and easily earn money for much better life', 'FX Dailies Investment', 'A reliable company to invest and make money', '/user/register', 'https://www.youtube.com/watch?v=ssxVFdnSgeM', 'CUwFcfMK1672494040.png', 1, 1, 'Best Investment Packages', '<p style=\"text-align:left;\">Take a look at our best investment plans where you will get the best profits.</p>', 'Latest Blog', 'Our Latest News & Tips', '<span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;font-size:18px;text-align:center;\">You will get all the latest news and investment tips in our website. Keep an eye on our Latest News to be in touch.</span>', 'Frequently Asked Questions', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga.', 'jOh5HZs81672485313.jpg', 'Know About Us', '<span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\">FX Dailies Investment is a leading German-based wealth creation management provider, offering a range of flexible products and investment solutions through our newly improved online platform. We strongly believe in the value of advice and only offer our products through qualified financial advisers. Together with advisers, we help hundreds of thousands of customers like you who look after their money and achieve their financial goals. Our goal is to provide our investors with a reliable source of high income, while minimizing any possible risks and offering a high-quality service, allowing us to automate and simplify the relations between the investors and the trustees.</span><br>', '/about', '<p><span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\">FX Dailies Investment</span><span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\"> is a leading German-based wealth creation management provider, offering a range of flexible products and investment solutions through our newly improved online platform. We strongly believe in the value of advice and only offer our products through qualified financial advisers. Together with advisers, we help hundreds of thousands of customers like you who look after their money and achieve their financial goals. Our goal is to provide our investors with a reliable source of high income, while minimizing any possible risks and offering a high-quality service, allowing us to automate and simplify the relations between the investors and the trustees. We work towards increasing your profit margin by profitable investment. We look forward to you being part of our community. With our easy-to-use online platform, you’ll have more control over your financial position. You and your financial adviser can manage your investments online, react more quickly to market developments and alter your asset choice whenever you want. FX Dailies Investment is a distinctive investment company offering our investors access to high-growth investment opportunities in Crypto markets and other services. We implement best practices of trading Crypto through our operations while offering flexibility in our investment plans. </span></p><p><span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\">Our company benefits from an extensive network of global clients.</span><span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\">FX Dailies</span><span style=\"color:rgb(98,108,132);font-family:Asap, sans-serif;\">  Investment Company, we emphasize understanding our client’s requirements and providing suitable solutions to meet their investment criteria. Our aim is to utilize our expert knowledge which will benefit our clients and the users of our services. Our company believes that when a team outperforms expectations, excellence becomes a reality. Legal address: Staffelseestraße , 81477 München, Germany</span></p>', '1639561929call-to-action-bg.jpg', 'GET STARTED TODAY WITH BITCOIN', 'Open account for free and start trading Bitcoins!', '<h4 class=\"subtitle\" style=\"font-weight: 600; line-height: 1.2381; font-size: 24px; color: rgb(31, 113, 212);\">More convenient than others</h4>', '<h2 class=\"title\" style=\"font-weight: 600; line-height: 60px; font-size: 50px; color: rgb(23, 34, 44);\">Find Value &amp; Build confidence</h2>', 'https://www.google.com/', 'https://www.google.com/', 'gFNRbRDL1645425298.png', 'We have some easy steps!', 'We have some easy steps!', 'UfpPEXVu1672486096.jpg', 'Why Choose US', '<span style=\"color:rgb(0,0,0);font-family:Asap, sans-serif;font-size:18px;text-align:center;\">We will utilize your money providing a source of high income while minimizing the any possibility of risk in a very secure way</span>', 'Our Top Investors', '<div><div><div><p style=\"text-align:center;font-size:18px;font-style:inherit;\">Take a look at our top investor who finds us secure and reliable.</p></div></div></div>', 'Our Payment Gateway', 'We accept all major cryptocurrencies and fiat payment methods to make your investment process easier with our platform.', 'YV0hJp1G1672150898.png', '/tmp/phpf30552', 'Refer your friend and earn money', 'Our referral program was created as an additional way for our investors to make money. By attracting new investors to join us, our members are getting an additional source of income. The referral program has one level of participation, with the following percentage accordingly: 10%.', '[\"10\"]', 'Cgjl1nD91672485723.png', 'Quick Profit Calculate', '<span style=\"font-family:Asap, sans-serif;font-size:18px;text-align:center;\">You must know the calculation before investing in any plan, so you never make mistakes. Check the calculation and you will get as our calculator says.</span><br>', 'Are You Ready!', 'Let\'s Get started with us', '/user/register', '#400768');

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

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(191) NOT NULL,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `status` int(191) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `currency_id`, `status`) VALUES
(6, NULL, NULL, NULL, 'Flutter Wave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '[\"1\"]', 0),
(8, NULL, NULL, NULL, 'Authorize.Net', 'automatic', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"sandbox_check\":1,\"text\":\"Pay Via Authorize.Net\"}', 'authorize.net', '[\"1\"]', 0),
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', '[\"8\"]', 0),
(10, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"test_jePgBjaRV5rUdzWc44rb2fUxgM2dM9\",\"text\":\"Pay with Mollie Payment.\"}', 'mollie', '[\"1\",\"6\"]', 0),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', '[\"8\"]', 0),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', '[\"9\"]', 0),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', '[\"8\"]', 0),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', '[\"1\"]', 0),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', '[\"1\"]', 0),
(24, NULL, NULL, NULL, 'CoinPayment', 'automatic', '{\"secret_string\":\"ZzsMLGKe162CfA5EcG6j\",\"coin_public_key\":\"ff615d014796ad3f89ea77116909fd3950013d1c77392339d0df418c64e6468e\",\"coin_private_key\":\"867F6E405d0f745b8a13d5296442c6cac438048e58CAc91BC7E6Ae961DfD1FFD\",\"text\":\"Pay via your Coin Payment account.\"}', 'coinPayment', '[\"1\"]', 0),
(27, 'Pay  with Bitcoin', 'Bitcoin', '<p><span style=\"font-weight: bolder;\">Please send money to this BTC address.</span></p><p><span style=\"font-weight: bolder;\">Enter Transaction Ref below , if no transaction ref was generated, enter date here<br></span><b>bc1qfgdl775qgf9ymxx3mmxy4ldf4vstx8y0fkvven</b><br></p>', NULL, 'manual', NULL, NULL, '0', 1);

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
  `captial_return` tinyint(4) NOT NULL DEFAULT '0',
  `lifetime_return` tinyint(4) NOT NULL DEFAULT '0',
  `profit_repeat` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `manage_schedule_id`, `schedule_hour`, `title`, `subtitle`, `min_amount`, `max_amount`, `fixed_amount`, `invest_type`, `profit_percentage`, `captial_return`, `lifetime_return`, `profit_repeat`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 24, 'Premium', 'Most Popular', NULL, NULL, 200, 'fixed', 5, 1, 1, NULL, 0, '2022-03-24 08:35:02', '2022-12-27 01:58:23'),
(2, 3, 1, 'Basic', 'Most Popular', 50, 500, NULL, 'range', 5, 1, 0, 10, 0, '2022-03-24 08:46:00', '2022-12-27 01:58:29'),
(4, 4, 24, 'Gold Plan (Long Term)', 'For 40 Days / 120 Returns', 5000, 50000, NULL, 'range', 3, 1, 0, 3, 1, '2022-03-30 06:14:11', '2023-01-10 18:26:29'),
(5, 6, 720, 'Premium Plan', 'For 28 Days / 2.5 Returns', 39999, 90000, NULL, 'range', 70, 1, 0, 3, 1, '2022-03-31 06:37:42', '2023-01-10 18:33:06'),
(6, 4, 24, 'Star Plan', 'For 30 Days / 60p Returns', 15000, 30000, NULL, 'range', 2, 1, 0, 1, 1, '2022-03-31 06:38:34', '2023-01-10 18:36:28'),
(7, 5, 168, 'Silver Plan', 'For 14 Days / 21p Returns', 5000, 14999, NULL, 'range', 10, 1, 0, 14, 1, '2022-04-17 07:34:36', '2023-01-10 18:40:32'),
(8, 5, 168, 'Starter Plan', 'For 7 Days / 1 Returns', 100, 4999, NULL, 'range', 8, 1, 0, 1, 1, '2022-04-17 07:35:08', '2023-01-07 18:32:09'),
(9, 7, 8760, 'Yearly Plan', 'For 365 Days / with a bonus of  Mercedez Benz sedans.', 15000, 1000000, NULL, 'range', 1095, 1, 0, 0, 1, '2022-04-17 07:36:59', '2023-01-10 18:44:47');

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
(13, 'invest', 1, 10, '2022-12-27 18:05:49', '2022-12-27 18:05:49');

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
(7, 100, 99, NULL, NULL, 5.0000000000, 'Register', '2023-01-08 03:11:00', '2023-01-08 03:11:00'),
(8, 111, 102, NULL, NULL, 5.0000000000, 'Register', '2023-01-12 03:47:27', '2023-01-12 03:47:27'),
(9, 112, 102, NULL, NULL, 5.0000000000, 'Register', '2023-01-14 02:24:32', '2023-01-14 02:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `photo`, `title`, `subtitle`, `details`) VALUES
(6, 'mHGNqiWr1672148696.jpg', 'Maximilian John', 'This is one of the best ...', '\"I regret making\" comments saying Bitcoin is a fraud, Dimon said in an interview with Fox Business Network. \" The Blockchain is real. you can have crypto yen and dollars and stuff like that'),
(9, 'pcUU2TmU1672148676.jpg', 'John Smilga bully', 'This is one of the best ...', 'This is a serious paying investment program, and always pays instantly! Sent me payment  without any problems thanks for the support');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seotools`
--

CREATE TABLE `seotools` (
  `id` int(10) UNSIGNED NOT NULL,
  `google_analytics` text COLLATE utf8mb4_unicode_ci,
  `meta_keys` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seotools`
--

INSERT INTO `seotools` (`id`, `google_analytics`, `meta_keys`) VALUES
(1, '<script></script>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text,
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
  `f_status` tinyint(4) NOT NULL DEFAULT '1',
  `g_status` tinyint(4) NOT NULL DEFAULT '1',
  `t_status` tinyint(4) NOT NULL DEFAULT '1',
  `l_status` tinyint(4) NOT NULL DEFAULT '1',
  `d_status` tinyint(4) NOT NULL DEFAULT '1',
  `f_check` tinyint(10) DEFAULT NULL,
  `g_check` tinyint(10) DEFAULT NULL,
  `fclient_id` text COLLATE utf8mb4_unicode_ci,
  `fclient_secret` text COLLATE utf8mb4_unicode_ci,
  `fredirect` text COLLATE utf8mb4_unicode_ci,
  `gclient_id` text COLLATE utf8mb4_unicode_ci,
  `gclient_secret` text COLLATE utf8mb4_unicode_ci,
  `gredirect` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `facebook`, `gplus`, `twitter`, `linkedin`, `dribble`, `f_status`, `g_status`, `t_status`, `l_status`, `d_status`, `f_check`, `g_check`, `fclient_id`, `fclient_secret`, `fredirect`, `gclient_id`, `gclient_secret`, `gredirect`) VALUES
(1, 'https://www.facebook.com/', 'https://plus.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://dribbble.com/', 1, 0, 1, 1, 0, 1, 1, '503140663460329', 'f66cd670ec43d14209a2728af26dcc43', 'https://localhost/crypto/auth/facebook/callback', '904681031719-sh1aolu42k7l93ik0bkiddcboghbpcfi.apps.googleusercontent.com', 'yGBWmUpPtn5yWhDAsXnswEX3', 'http://localhost/marketplace/auth/google/callback');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `status`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 1, 'fab fa-facebook-f', 'https://www.facebook.com/', '2022-04-24 09:53:35', '2022-04-24 09:53:35'),
(2, 'Twitter', 1, 'fab fa-twitter', 'https://twitter.com/', '2022-04-24 09:54:37', '2022-04-24 09:54:37'),
(3, 'Linkedin', 1, 'fab fa-linkedin-in', 'https://www.linkedin.com/', '2022-04-24 09:55:23', '2022-04-24 10:03:21');

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
(4, 'Alexandar: $15,000', '0PaqedGv1672486769.png', '#', '#', '#', '#', NULL, '2022-04-09 08:35:24', '2022-12-31 16:39:29'),
(5, 'TRANT1997 : $24,000', 'ciS6ESNp1672486740.png', '#', '#', '#', '#', NULL, '2022-04-09 08:36:17', '2022-12-31 16:39:00'),
(6, 'Pascal28 : $45,000', 'a0xhJB4O1672486713.png', '#', '#', '#', '#', NULL, '2022-04-09 08:36:57', '2022-12-31 16:38:33'),
(7, 'Afnan : $55000', 'Jst2TNW81672486675.png', NULL, NULL, NULL, NULL, NULL, '2022-04-09 08:37:26', '2022-12-31 16:37:55'),
(9, 'Abraham: $60000', 'WlVgwtCa1672486638.png', NULL, NULL, NULL, NULL, NULL, '2022-04-09 08:43:01', '2022-12-31 16:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL DEFAULT '0',
  `receiver_id` int(11) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `type` enum('Deposit','Payout','Referral Bonus','Send Money','Receive Money','Invest','Interest Money','Request Money','Payout Rejected') NOT NULL,
  `profit` enum('plus','minus') DEFAULT NULL,
  `txnid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `receiver_id`, `email`, `amount`, `type`, `profit`, `txnid`, `created_at`, `updated_at`) VALUES
(186, 104, NULL, 'akossiwapascal@gmail.com', 5000, 'Deposit', 'plus', 'C5XDbp9r0XaV', '2023-01-10 01:53:19', '2023-01-10 01:53:19'),
(187, 102, NULL, 'marshaustin218@gmail.com', 20000, 'Deposit', 'plus', 'JBOW67UvZ1M8', '2023-01-10 01:54:09', '2023-01-10 01:54:09'),
(188, 104, NULL, 'akossiwapascal@gmail.com', 10000, 'Deposit', 'plus', 'QvO0LZL0Dhbr', '2023-01-10 18:11:58', '2023-01-10 18:11:58'),
(189, 103, NULL, 'testing@gmail.com', 55, 'Interest Money', 'plus', '25E8XDcxC6Xs', '2023-01-11 04:00:11', '2023-01-11 04:00:11'),
(190, 102, NULL, 'marshaustin218@gmail.com', 10000, 'Invest', NULL, 'oFfnYWAzzpIh', '2023-01-11 12:40:14', '2023-01-11 12:40:14'),
(191, 102, NULL, 'marshaustin218@gmail.com', 5000, 'Invest', NULL, 'iqhcRHSmnRRt', '2023-01-11 12:41:39', '2023-01-11 12:41:39'),
(192, 102, NULL, 'marshaustin218@gmail.com', 4000, 'Invest', NULL, '9eAAbL62UGvZ', '2023-01-11 12:47:09', '2023-01-11 12:47:09'),
(193, 102, NULL, 'marshaustin218@gmail.com', 900, 'Invest', NULL, 'HAMKY8wpWVRm', '2023-01-11 12:49:09', '2023-01-11 12:49:09'),
(194, 102, NULL, 'marshaustin218@gmail.com', 10000, 'Deposit', 'plus', '0Bcivq8VC9Ro', '2023-01-11 21:55:27', '2023-01-11 21:55:27'),
(195, 107, NULL, 'uchechukwuiwuanyanwu908@gmail.com', 12000, 'Deposit', 'plus', 'qcrZL61UlOob', '2023-01-11 21:55:58', '2023-01-11 21:55:58'),
(196, 102, NULL, 'marshaustin218@gmail.com', 5, 'Referral Bonus', 'plus', 'SvSlNCA9MFHl', '2023-01-12 03:47:27', '2023-01-12 03:47:27'),
(197, 111, NULL, 'michaelkelvin8900@gmail.com', 5, 'Referral Bonus', 'plus', 'kYcACcZAVWrf', '2023-01-12 03:47:27', '2023-01-12 03:47:27'),
(198, 111, NULL, 'michaelkelvin8900@gmail.com', 10000, 'Deposit', 'plus', 'FQEvHCfeKOXQ', '2023-01-12 04:37:45', '2023-01-12 04:37:45'),
(199, 111, NULL, 'michaelkelvin8900@gmail.com', 10000, 'Deposit', 'plus', '7G5nooXli6L0', '2023-01-12 04:38:18', '2023-01-12 04:38:18'),
(200, 111, NULL, 'michaelkelvin8900@gmail.com', 5000, 'Invest', NULL, 'SYTkSGZPAwgD', '2023-01-12 12:12:30', '2023-01-12 12:12:30'),
(201, 111, NULL, 'michaelkelvin8900@gmail.com', 10000, 'Invest', NULL, 'txK0BQaKQvXz', '2023-01-12 15:58:07', '2023-01-12 15:58:07'),
(202, 102, NULL, 'marshaustin218@gmail.com', 150, 'Interest Money', 'plus', 'S3TU4vPMAxzM', '2023-01-13 04:00:18', '2023-01-13 04:00:18'),
(203, 102, NULL, 'marshaustin218@gmail.com', 5, 'Referral Bonus', 'plus', 'cTaH8yyMJEqs', '2023-01-14 02:24:32', '2023-01-14 02:24:32'),
(204, 112, NULL, 'd12001300@gmail.com', 5, 'Referral Bonus', 'plus', 'qbk6hp37VkIa', '2023-01-14 02:24:32', '2023-01-14 02:24:32'),
(205, 86, NULL, 'user@gmail.com', 1031, 'Payout', 'minus', 'hdUDYS6aIoRQ', '2023-01-14 04:35:17', '2023-01-14 04:35:17'),
(206, 86, NULL, 'user@gmail.com', 1031, 'Payout', 'minus', '812TuZ0ZzLBI', '2023-01-14 04:35:19', '2023-01-14 04:35:19'),
(207, 102, NULL, 'marshaustin218@gmail.com', 300, 'Interest Money', 'plus', '0gQ1MZS29IPO', '2023-01-15 04:00:13', '2023-01-15 04:00:13'),
(208, 102, NULL, 'marshaustin218@gmail.com', 450, 'Interest Money', 'plus', 'O9qqLKBzCnCh', '2023-01-17 04:00:13', '2023-01-17 04:00:13'),
(209, 105, NULL, 'rebeccaekenta18@gmail.com', 16, 'Interest Money', 'plus', 'ziZLC23tFa90', '2023-01-17 04:00:13', '2023-01-17 04:00:13'),
(210, 111, NULL, 'michaelkelvin8900@gmail.com', 1000, 'Interest Money', 'plus', '2G7VdtH3oy4H', '2023-01-20 04:00:18', '2023-01-20 04:00:18'),
(211, 111, NULL, 'michaelkelvin8900@gmail.com', 500, 'Interest Money', 'plus', 'D0EC0j4shp1a', '2023-01-20 04:00:18', '2023-01-20 04:00:18'),
(212, 111, NULL, 'michaelkelvin8900@gmail.com', 500, 'Interest Money', 'plus', 'BFI26hFjOGq0', '2023-01-20 04:00:18', '2023-01-20 04:00:18'),
(213, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'hJQ7znQ777WQ', '2023-01-26 04:00:16', '2023-01-26 04:00:16'),
(214, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'G6G0XNOJdgON', '2023-01-26 04:00:16', '2023-01-26 04:00:16'),
(215, 111, NULL, 'michaelkelvin8900@gmail.com', 2000, 'Interest Money', 'plus', 'Yrsk3vk5XGdv', '2023-01-27 04:00:26', '2023-01-27 04:00:26'),
(216, 111, NULL, 'michaelkelvin8900@gmail.com', 1000, 'Interest Money', 'plus', 'ng827isenlK2', '2023-01-27 04:00:26', '2023-01-27 04:00:26'),
(217, 111, NULL, 'michaelkelvin8900@gmail.com', 1000, 'Interest Money', 'plus', 'K3JzMy5oXPEj', '2023-01-27 04:00:27', '2023-01-27 04:00:27'),
(218, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'oTyamokvp5j0', '2023-02-02 04:00:16', '2023-02-02 04:00:16'),
(219, 110, NULL, 'robertbjoure@gmail.com', 2000, 'Interest Money', 'plus', 'QF78bJ6WuKbg', '2023-02-02 04:00:16', '2023-02-02 04:00:16'),
(220, 111, NULL, 'michaelkelvin8900@gmail.com', 3000, 'Interest Money', 'plus', 'UY2kDswHPR1v', '2023-02-04 04:00:15', '2023-02-04 04:00:15'),
(221, 111, NULL, 'michaelkelvin8900@gmail.com', 1500, 'Interest Money', 'plus', 'EI6s0hIZmdTE', '2023-02-04 04:00:15', '2023-02-04 04:00:15'),
(222, 111, NULL, 'michaelkelvin8900@gmail.com', 1500, 'Interest Money', 'plus', 'TRzBkNHVmdj1', '2023-02-04 04:00:16', '2023-02-04 04:00:16'),
(223, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'lwxEM2MY7iL9', '2023-02-10 04:00:21', '2023-02-10 04:00:21'),
(224, 110, NULL, 'robertbjoure@gmail.com', 3000, 'Interest Money', 'plus', 'LTpfdYWAGvua', '2023-02-10 04:00:21', '2023-02-10 04:00:21'),
(225, 111, NULL, 'michaelkelvin8900@gmail.com', 4000, 'Interest Money', 'plus', 'HRxhAGIePVIK', '2023-02-11 04:00:22', '2023-02-11 04:00:22'),
(226, 111, NULL, 'michaelkelvin8900@gmail.com', 2000, 'Interest Money', 'plus', 'RZhBDAdO3PaX', '2023-02-11 04:00:23', '2023-02-11 04:00:23'),
(227, 111, NULL, 'michaelkelvin8900@gmail.com', 2000, 'Interest Money', 'plus', '4qfsQyoknXOS', '2023-02-11 04:00:23', '2023-02-11 04:00:23'),
(228, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'Mm6q0YmtwTQd', '2023-02-17 04:00:21', '2023-02-17 04:00:21'),
(229, 110, NULL, 'robertbjoure@gmail.com', 4000, 'Interest Money', 'plus', '4V1rCPCc5Ol8', '2023-02-17 04:00:21', '2023-02-17 04:00:21'),
(230, 111, NULL, 'michaelkelvin8900@gmail.com', 5000, 'Interest Money', 'plus', '7XOOeyvJqTSO', '2023-02-19 04:00:16', '2023-02-19 04:00:16'),
(231, 111, NULL, 'michaelkelvin8900@gmail.com', 2500, 'Interest Money', 'plus', 'fG4WjcRPou7t', '2023-02-19 04:00:16', '2023-02-19 04:00:16'),
(232, 111, NULL, 'michaelkelvin8900@gmail.com', 2500, 'Interest Money', 'plus', '5Dtkns0a9qyT', '2023-02-19 04:00:16', '2023-02-19 04:00:16'),
(233, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', '2yAbKyJUS6hq', '2023-02-25 04:00:15', '2023-02-25 04:00:15'),
(234, 110, NULL, 'robertbjoure@gmail.com', 5000, 'Interest Money', 'plus', '6WKAfrwcIfUJ', '2023-02-25 04:00:15', '2023-02-25 04:00:15'),
(235, 111, NULL, 'michaelkelvin8900@gmail.com', 6000, 'Interest Money', 'plus', 'tPHrqd3olRIN', '2023-02-26 04:00:21', '2023-02-26 04:00:21'),
(236, 111, NULL, 'michaelkelvin8900@gmail.com', 3000, 'Interest Money', 'plus', 'RvKzNmTCb6u5', '2023-02-26 04:00:21', '2023-02-26 04:00:21'),
(237, 111, NULL, 'michaelkelvin8900@gmail.com', 3000, 'Interest Money', 'plus', 'eXVzYE2nIRkG', '2023-02-26 04:00:21', '2023-02-26 04:00:21'),
(238, 111, NULL, 'michaelkelvin8900@gmail.com', 7000, 'Interest Money', 'plus', '3KCNrtY6wwAO', '2023-03-29 02:00:13', '2023-03-29 02:00:13'),
(239, 111, NULL, 'michaelkelvin8900@gmail.com', 3500, 'Interest Money', 'plus', '0FscOi2HisHP', '2023-03-29 02:00:13', '2023-03-29 02:00:13'),
(240, 111, NULL, 'michaelkelvin8900@gmail.com', 3500, 'Interest Money', 'plus', 'gflBtV983MpV', '2023-03-29 02:00:13', '2023-03-29 02:00:13'),
(241, 110, NULL, 'robertbjoure@gmail.com', 1000, 'Interest Money', 'plus', 'cwmgg7rZWtxP', '2023-03-29 02:00:13', '2023-03-29 02:00:13'),
(242, 110, NULL, 'robertbjoure@gmail.com', 6000, 'Interest Money', 'plus', 'x65QYxEnYYJd', '2023-03-29 02:00:13', '2023-03-29 02:00:13'),
(243, 111, NULL, 'michaelkelvin8900@gmail.com', 1000, 'Interest Money', 'plus', '6JUFpKvfZUvi', '2023-04-13 02:00:16', '2023-04-13 02:00:16'),
(244, 111, NULL, 'michaelkelvin8900@gmail.com', 8000, 'Interest Money', 'plus', 'SODBlEb6CWYp', '2023-04-13 02:00:16', '2023-04-13 02:00:16'),
(245, 111, NULL, 'michaelkelvin8900@gmail.com', 500, 'Interest Money', 'plus', '5qrSsSRhEq3U', '2023-04-15 02:00:11', '2023-04-15 02:00:11'),
(246, 111, NULL, 'michaelkelvin8900@gmail.com', 4000, 'Interest Money', 'plus', '3TW79ooiFiVL', '2023-04-15 02:00:11', '2023-04-15 02:00:11'),
(247, 111, NULL, 'michaelkelvin8900@gmail.com', 500, 'Interest Money', 'plus', 'BEehwNI7Nfqs', '2023-04-16 02:00:11', '2023-04-16 02:00:11'),
(248, 111, NULL, 'michaelkelvin8900@gmail.com', 4000, 'Interest Money', 'plus', 'zUsSv7dGXeWT', '2023-04-16 02:00:11', '2023-04-16 02:00:11'),
(249, 110, NULL, 'robertbjoure@gmail.com', 2000, 'Interest Money', 'plus', 'ygXCzxDKk4lB', '2023-04-16 02:00:11', '2023-04-16 02:00:11'),
(250, 110, NULL, 'robertbjoure@gmail.com', 7000, 'Interest Money', 'plus', 'mB59V63Ra7VS', '2023-04-16 02:00:11', '2023-04-16 02:00:11'),
(251, 111, NULL, 'michaelkelvin8900@gmail.com', 1000, 'Interest Money', 'plus', 'DFKFNleHzQHf', '2023-04-21 02:00:14', '2023-04-21 02:00:14'),
(252, 111, NULL, 'michaelkelvin8900@gmail.com', 9000, 'Interest Money', 'plus', 'DFFTJ8SnC3gg', '2023-04-21 02:00:14', '2023-04-21 02:00:14'),
(253, 111, NULL, 'michaelkelvin8900@gmail.com', 500, 'Interest Money', 'plus', 'brBNU4t2gsSB', '2023-04-22 02:00:18', '2023-04-22 02:00:18'),
(254, 111, NULL, 'michaelkelvin8900@gmail.com', 4500, 'Interest Money', 'plus', 'DGsNUbw6ILq7', '2023-04-22 02:00:18', '2023-04-22 02:00:18');

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
  `is_provider` tinyint(10) NOT NULL DEFAULT '0',
  `status` tinyint(10) NOT NULL DEFAULT '0',
  `verification_link` text COLLATE utf8mb4_unicode_ci,
  `email_verified` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `balance` double NOT NULL DEFAULT '0',
  `interest_balance` double NOT NULL DEFAULT '0',
  `affilate_code` text COLLATE utf8mb4_unicode_ci,
  `referral_id` tinyint(1) NOT NULL DEFAULT '0',
  `twofa` tinyint(4) NOT NULL DEFAULT '0',
  `go` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `kyc_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 == ''pending''\r\n1 == ''approve''\r\n2 == ''rejected''',
  `kyc_info` longtext COLLATE utf8mb4_unicode_ci,
  `kyc_reject_reason` text COLLATE utf8mb4_unicode_ci,
  `is_banned` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 === banned\r\n0 === active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `photo`, `zip`, `city`, `address`, `phone`, `fax`, `email`, `password`, `remember_token`, `is_provider`, `status`, `verification_link`, `email_verified`, `balance`, `interest_balance`, `affilate_code`, `referral_id`, `twofa`, `go`, `verified`, `details`, `kyc_status`, `kyc_info`, `kyc_reject_reason`, `is_banned`, `created_at`, `updated_at`) VALUES
(86, 'Jenifer', NULL, '1673651028up-mail.php7', '1230', 'Dhaka', 'road-04', '0123456789', '0900000', 'user@gmail.com', '$2y$10$NSxBfIBeDdxRjisT83p/0uN4GN4LcbYvKzuazAfyekwPffExwBUpO', 'dLQOebLQgnGCXdad2DeWmxl2JtubuV6EyBmhD7Ubp9ihvqDEyXaTUXBpqFtM', 0, 0, '759f1706acfd7bc23f6b95ae35d0fd8e', 'Yes', 7438, 0.3, '3266dcfa238c067719a09f1eabc4e1b4', 0, 0, NULL, 1, NULL, 1, '{\"full_name\":[\"Dark Loard\",\"text\"],\"nid\":[\"sSHjM9SA1649656607.jpg\",\"file\"],\"present_address\":[\"road-04\",\"textarea\"],\"parmanent_address\":[\"d\",\"textarea\"]}', NULL, 0, NULL, '2023-01-14 04:35:19'),
(97, 'Williams Helga', 'Williams', NULL, NULL, NULL, NULL, '09078953242', NULL, 'williamshelga101@gmail.com', '$2y$10$hMOqPK/hxANHp9ycIYxg3u91Pt3c3rLgp5eoF67WlhGO8dhcxZcSW', 'Dc3MGhspyLlfGfq9lYt9Bg0b913LwbTx1Fs8a00je06uxD7aVv7iUKgSl0rq', 0, 0, '99403c2c0f223ee42a0db085da1a7ae7', 'Yes', 0, 0, '7b86a4c320bfc8b0f46c5986789c7f79', 0, 0, NULL, 0, NULL, 0, '{\"full_name\":[\"Williams\",\"text\"],\"nid\":[\"76LOKxZq1673094564.png\",\"file\"],\"present_address\":[\"122 uba\",\"textarea\"],\"parmanent_address\":[\"123 Uba\",\"textarea\"]}', NULL, 0, '2023-01-07 17:16:12', '2023-01-07 17:29:24'),
(101, 'jet123', 'jetattorneys', NULL, NULL, NULL, NULL, '09865409877', NULL, 'jetattorneys@yahoo.com', '$2y$10$4yl.QVPSgsq6sbn7wtkhp.oQlns5YaqZe2l8BIv67ec.V0cp75AVC', NULL, 0, 0, '9c987a2941ec5de3cc92db680eed88ea', 'Yes', 0, 0, 'bc59dae97f67f46b2ca6d2149e614b87', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-08 11:58:43', '2023-01-08 11:58:43'),
(102, 'Austin Marsh', 'Marsh11', NULL, NULL, NULL, NULL, 'marshaustin218@gmail.com', NULL, 'marshaustin218@gmail.com', '$2y$10$EHO9AY5NwJ2KeBRM7phj6.CTuZ11e.6P4aTAQXXWnWmoNUx90qNNm', 'ACUuHbxnr27xiM6pTjHOy1MtpmsynwyJLoDhHpKgzhkFivJm6d9DQE7JHd5r', 0, 0, '83508ed1ac2d86f0ede2de6521fa80b0', 'Yes', 15110, 900, '9dba51e51c64322df66accbc89203eb9', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-08 15:25:49', '2023-01-17 04:00:13'),
(103, 'Testing', 'Testing', NULL, NULL, NULL, NULL, '09078953242', NULL, 'testing@gmail.com', '$2y$10$r7lckDTVd5EnZQ5dKRTYRux54NYRaQacre912o0A9Wj1R7LLazrSK', '10eKgjX3DeOf9htHZwKcU5yDNFPgVFzVIOtCwUeLwtc1HSPZRHShgT2Tzsv9', 0, 0, '86036f67fff3cd6ef00eac26ef8526d7', 'Yes', 5500, 55, '384d21105c75fb880d4807fcf179f1dd', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-08 16:37:26', '2023-01-11 04:00:11'),
(104, 'Austin Marsh', 'Marsh01', NULL, NULL, NULL, NULL, 'marshaustin218@gmail.com', NULL, 'akossiwapascal@gmail.com', '$2y$10$csFKWcfhHTBpYY1Hy/eTRORdZNQgCubE7jFCb0WBtbZwVTmuA9a5e', NULL, 0, 0, '61d0709c4de9980c6123a9a4e851fcfa', 'Yes', 15000, 0, '4e7a1abfcd06876c0d6c8c8136ab47f3', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-10 00:37:09', '2023-01-10 18:11:58'),
(105, 'Rebi', 'Adaobi', NULL, NULL, NULL, NULL, '88865499', NULL, 'rebeccaekenta18@gmail.com', '$2y$10$WMJhEzU.CV2DeJl4STaOAOH3qyVAgQakM1S360NKshkJ5JmMym.fG', NULL, 0, 0, '327beec444d65416ba7173dcf90e4fd7', 'Yes', 200, 16, '1df389d9a1a800be989e42e747b182dc', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-10 00:44:17', '2023-01-17 04:00:13'),
(106, 'Justice Chinemelum Clement', 'justyce', NULL, NULL, NULL, NULL, '2347062487290', NULL, 'justicechinemelum@gmail.com', '$2y$10$ojZ1.VvUiIaQMjyV.HiQ4e1Hvkxa92ZeRsx7hrOb7tvgC7lH485ZK', 'V2DfcRUCSwj2IkksT1IjCjtXJJrs1WidRjoTM9os86ORRyMe4JWAJ03EpM1N', 0, 0, 'ba63637655f6bcdc82253f52b62a12c9', 'Yes', 0, 0, 'f2991c986d5c36bfb30bef76aca85315', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-10 13:37:06', '2023-01-10 15:01:20'),
(107, 'Romero Thomas', 'Thomas90', NULL, NULL, NULL, NULL, 'marshaustin218@gmail.com', NULL, 'uchechukwuiwuanyanwu908@gmail.com', '$2y$10$yK10TOOf4HRMoMG/x3FJpO3JsdnARGR/nYDEcWgb1ZRQv1NbK5xqW', NULL, 0, 0, '9fcc703f7e5756360880dcbe9c453eb2', 'Yes', 12000, 0, '2d51a96518ec603264fbd04072457bd1', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-10 21:48:48', '2023-01-11 21:55:58'),
(108, 'Ejike', 'Ejykeman', NULL, NULL, NULL, NULL, '08037918394', NULL, 'ejikejosephegbejimba@gmail.com', '$2y$10$b8DLpEk/5ClzasEqvnoyvePsvHdUlPm33Q8sLWhUmYlozO2CSMHdO', NULL, 0, 0, 'd80d492570b66190fe8656d50b8ba981', 'Yes', 0, 0, 'da0eef870e90e56662153c24041ddc56', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-11 12:20:39', '2023-01-11 12:20:39'),
(109, 'Ejike', 'Ejykeman', NULL, NULL, NULL, NULL, '08037918394', NULL, 'ejikejosephegbejimba@gmail.com', '$2y$10$baRdvrm898PrZkkTGLg1PuqLpRZiSIeZFKkl6Q2O7SKOhU45nsW2G', NULL, 0, 0, 'd80d492570b66190fe8656d50b8ba981', 'Yes', 0, 0, 'da0eef870e90e56662153c24041ddc56', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-11 12:20:39', '2023-01-11 12:20:39'),
(110, 'Robert Bjoure', 'Robert', NULL, NULL, NULL, NULL, '+60 16-504 4870', NULL, 'robertbjoure@gmail.com', '$2y$10$UuFWATaGaL5.9TBm38QIQOs7CVZXu7ncfPO.bDCwPaq2lDYg78w.6', NULL, 0, 0, 'fed5717fbc213da0342568d65dc2c246', 'Yes', 10000, 36000, '8205ffda5c6e08dd3864a1608e464be0', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-11 22:29:50', '2023-04-16 02:00:11'),
(111, 'Michael', 'Michaelkelvin', NULL, NULL, NULL, NULL, '0815 470 6966', NULL, 'michaelkelvin8900@gmail.com', '$2y$10$xRVVoeUE7qeZbUH96o48COgNTfnLhxmQN6Ny54O8cNCH9zPe2LORm', 'JXxGqlhxh87a5Yt6a9fITtrZR4oIXoucYsT6Vi5gGyD8UsF8qmYMZRucPquL', 0, 0, 'e454b98b637e75a0361f50af0f49ba55', 'Yes', 25005, 89000, 'e4fa5c3a30b0cff35a81683667694288', 102, 0, NULL, 0, NULL, 0, '{\"full_name\":[\"Michaelkelvin\",\"text\"],\"nid\":[\"EI8SeYGE1673477475.jpg\",\"file\"],\"present_address\":[\"Texas\",\"textarea\"],\"parmanent_address\":[\"Texas\",\"textarea\"]}', NULL, 0, '2023-01-12 03:47:27', '2023-04-22 02:00:18'),
(112, 'David Brady', 'davidchavis', NULL, NULL, NULL, NULL, '8107565917', NULL, 'd12001300@gmail.com', '$2y$10$/MboOlvnFUQ7.1qnFpYLh.I184vVpLN/WAXTT1nAM4oBl1Jh/OEpW', NULL, 0, 0, 'c43a4646e5f31af73ab09a9ffe1fc23c', 'Yes', 5, 0, 'efd716b044e99e09e5872db1d98b9c94', 102, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-01-14 02:24:32', '2023-01-14 02:24:32'),
(113, 'yemasoy', 'yemasoy', '1675297054plot.php7', NULL, NULL, NULL, 'yemasoy', NULL, 'yemasoy511@ezgiant.com', '$2y$10$QPb7x0c23.NRk5ch2sxwBune8Tugjxafcm/vZrZWOEZZpWrL.T8LW', NULL, 0, 0, '8d420d83ad26c05f43ffb70b2ebce929', 'Yes', 0, 0, '4996d36e3136aa2943ec15a7f6d5f75c', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2023-02-02 05:17:11', '2023-02-02 05:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `order_id` int(191) NOT NULL DEFAULT '0',
  `withdraw_id` int(191) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Invest','Payout','Withdraw') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` float DEFAULT NULL,
  `fee` float DEFAULT '0',
  `details` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `type` enum('user','vendor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `currency_id`, `txnid`, `user_id`, `method`, `address`, `reference`, `amount`, `fee`, `details`, `created_at`, `updated_at`, `status`, `type`) VALUES
(39, 1, 'hdUDYS6aIoRQ', 86, 'Cryptocurrency', NULL, NULL, 1000, 31, '19GF9JMmd2CyHgWZro4ene8wheF9Hfibm9', '2023-01-14 05:35:17', '2023-01-14 05:35:17', 'pending', 'user'),
(40, 1, '812TuZ0ZzLBI', 86, 'Cryptocurrency', NULL, NULL, 1000, 31, '19GF9JMmd2CyHgWZro4ene8wheF9Hfibm9', '2023-01-14 05:35:19', '2023-01-14 05:35:19', 'pending', 'user');

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
  `fixed` double DEFAULT '0',
  `percentage` double DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `currency_id`, `name`, `photo`, `min_amount`, `max_amount`, `fixed`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(9, 9, 'Razorpay', '0D76Kxp91648456603.jpg', 100, 300, 3, 2, 1, '2022-03-28 08:36:43', '2022-03-28 09:22:56'),
(10, 1, 'Payoneer', 'rn9vTcJN1648456648.jpg', 30, 150, 2, 1.5, 1, '2022-03-28 08:37:28', '2022-03-28 09:22:42'),
(12, 1, 'Cryptocurrency', 'nC1emWrx1672146827.png', 100, 50000, 1, 3, 1, '2022-12-27 18:13:03', '2022-12-27 18:13:47');

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
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_languages`
--
ALTER TABLE `admin_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pagesettings`
--
ALTER TABLE `pagesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seotools`
--
ALTER TABLE `seotools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
