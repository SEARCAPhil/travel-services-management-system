-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 09:37 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_username` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_username`, `account_password`, `id`) VALUES
('admin', '37cccc352263dd50403a1ba59b7e50ac6c1d37ec', 1),
('fmu', '5faf1beba0ef95da0923667a746f20ad4618f051', 3),
('icu', 'd96079a46aea0f789ad02f22379ca31a67012290', 4),
('mina', '353e8061f2befecb6818ba0c034c632fb0bcae1b', 9),
('kru', '6b75eb05bf669299e7e9ff0d74014ea0e719c24c', 10),
('gsu', '7364090208c3b75621233edc68618107b3e812e7', 11),
('msu', 'f9cb201bb20da1d2d432aa6ed3846de4e1ce7691', 12),
('tsu', '009bed17ab126b43cf3757cae76496e12a511837', 13),
('pdts', 'a6a01f5d350becacbef807e880b72af424c8a3b1', 14),
('geidd', '79896a291741251e0425de52d3dddb9b255c66bd', 15),
('hrmu', '80cf4a8de9a12684205bc8ec55e05205f6dfcbbc', 16),
('kmd', '5abda76ca56d1c0a2d197105282800375cbaaef5', 17),
('bic', '8b8747803f065de87e36437322ab4ed717a3ef47', 18),
('library', 'e3aac164f12d1a5ff6dfebc9ada1aeca15e0d57d', 19),
('iau', 'c78982093b935adb2c866b8b4b2a758a918f95d7', 20),
('od', 'a261fde5089ec5da197ab4cdb3598f794e61e537', 21),
('odda', '3425d709fce9b1c110d17584d4ed0a788f3234bf', 22),
('rdd', 'cf0deeb77a8898ac75aa906480b663cdbce0c10c', 23),
('asar', '40496ad2e49875d888852ec09e5bcc6f92b60d79', 24),
('atr', '2a31964ffbd0b56f679dcd5eee513421151d3769', 25),
('ahe', 'b2c63671f2a3d26aaec9985f787a818b2300cf47', 26),
('adr', 'c228a35900b79441ae99a91a7dfa9aa317711216', 27),
('agt', '1894922cb1dad582b5a74f29a401ff45005e09f9', 28),
('aaa', '4c31910d7a5f0cc40b39721754eb16012f5dea30', 29),
('arm', '2cfea8915a039b95c25b42f3a1579787349aa6f8', 30),
('apf', 'd65143a013f09e1ec2cce5e29c084109e5636d04', 31),
('als', '453d5189a6a7b2a778ea2a4856b7f25a9197cd79', 32),
('aan', 'a8efd6677803d5c04fafb4494ccdbaf2ce1b0df1', 33),
('aro', '16363872e4c6bb89f57593c85515e00d0a3d55cf', 34),
('adgm', '5f8903781fb46f987e62aa95018ff0ee50b7ef7a', 35),
('bsra', '8d34e9e20faf3840d3dc45cfb9a380dd7a55f69e', 36),
('bmb', '1c40a065eaed4eb005358c58fb777040ddcfd97b', 37),
('bps', '0e00c946c77cb8e02a163a39503281deebde831e', 38),
('ngr', 'ffb57a5cfdd1a0e8b041d635327f932a674ddb82', 39),
('cpt', '62fdb650bd129a7d5bd63308667d6fc047834196', 40),
('cbc', '4c37a71a9aee3c132604dd3616af1703f355b491', 41),
('cfa', '042a34bac7258f374051935394d94c2177c67e23', 42),
('cbm', 'd5705daaf9310c1aa2e8cb305886fdffefe78792', 43),
('dpd', 'feedb2020af9c9958591359332c4a513a5ec4ca1', 44),
('dcc', '52bbfe019019e34e1e2cfa75450e7471cbd5260e', 45),
('emu', 'd4ac23129aaa48874c44bed698ac308003ed230a', 46),
('edrj', '5a9e7754c6d902a2009d2e762d97e31f09865be0', 47),
('efg', 'fad9d7cc9e827e06a4f454f3d08a4978b6745e81', 48),
('emb', 'a803c3231513858a7962d5b99d2e4490d0678e02', 49),
('ecs', '6cc04d50d334ca38f80df00f802b3d8dada7a091', 50),
('egp', '63e3a7ca372705e364d68afc7dee666b83d91a8d', 51),
('ejvv', '78ca1240526b1296797af84c9e8de2b8207ee2b3', 52),
('eca', '8658da6ad1ec8a349cc75b8181fdfa830f1ea98c', 53),
('erl', 'ce25429f403fae792b7e2a239c1168499c2edcac', 54),
('epsb', 'c7a1e823ef37a17a6bac06e594857df5002ca19f', 55),
('fdc', '0ec090452b7b4e5cdcfecf2af2f9f37ecf879882', 56),
('gldc', 'e67914fd10b2331e847b5c6c89721259f8672955', 57),
('gcs', 'd06d46a22ab55473deb287e04caffcb386edb995', 58),
('gag', '669475b41564b2dc7402883d2954f45bc07e212b', 59),
('hmc', 'f595186747fa5d2a9841695abfc563b96dc28bfd', 60),
('ilb', '7ae52ada28d883b8a61d8a43468e3c804e7ed088', 61),
('ilp', '38a22ab7c5048c40247ba97014c7ed44dafceea5', 62),
('jbb', '3eab70ef198bce81d1412e48fb55cecfb1063b55', 63),
('jwtd', '17e9952d66d8223da56f41476a681a95364cfc4d', 64),
('jebm', 'a02874bedb4580e7741e41df8bd85bc7004f4bad', 65),
('jsl', 'df087ff1959269e0bd9db57a73448276b95cd5ea', 66),
('jkga', '12fdc8dd92130d207dcc1e5ae23aa8d436a1bffd', 67),
('jgv', '3c7c34c46e4fd03717a95181975d596484db4705', 68),
('jdab', '87e090c6d991660feb8dbc68991dc02fd04c1a47', 69),
('kmj', '3d198595066e1bb3e49cc4cc07b774f99647338c', 70),
('kjsv', '1fd38de814caa3d937a61686ad0227a86a491b9e', 71),
('lnm', '14f749884f5d52ad94cba57e4e12872ccfe78200', 72),
('llbd', '8d13ae2afa57de8101c19501049f44c69e456bd3', 73),
('lbs', '3b1f873daddca1226a1b5c9537a2a0103601b2ee', 74),
('lru', 'a82d1cde7abb480ef9d17f9a555383ab8e8b8504', 75),
('mers', 'c88f35441666c50e8bca9cb0b7e6de5c8df78c27', 76),
('mmbr', '5e48c317f47e137d110fd17b9e5f3ed53dfccb6d', 77),
('mobj', '0bb3410160bf77491fdb7eb4c7b12b7c2aaf46bf', 78),
('mba', '42b949030ad6ef4e86c1702803ded50b1d20b4fe', 79),
('mnm', '855b4b3c58a306d5d790906c96f1bd8273d514f8', 80),
('mchc', '620c8fd34be25ecd635242aa544b49aa3d94707a', 81),
('mcnc', '619fc3dee5a65e05ece02ef8edf4e8d166bd2345', 82),
('mcld', '1e12ed7dddde0b370f1f022e074180d6bc351c67', 83),
('mmje', '348896445d133398a6633c0f6260677e87c4aedc', 84),
('mmav', '1c1705439fa3568f3e9410dae1f5f0db83b6096b', 85),
('mtbf', '55280cb111deb1232810f07189d01e8470982e71', 86),
('mbalmanza', '37cccc352263dd50403a1ba59b7e50ac6c1d37ec', 87),
('mms', 'f596476e5692f7243ccb251eba753bc77a4a3e4c', 88),
('mvt', '9a43d724c03634b72dad6f340747c9e5f87fd638', 89),
('mus', 'ef9e308c743b3b7f4f1f3cfb2118612d532ba195', 90),
('marm', '7831cf3de29e20e49f441cc6369848f020734f6c', 91),
('mgd', '86d7b111cc9597080f18b6496da59bb9cf93be96', 92),
('maam', '24de523c97941cb6bda43003e42a546c9dfa8533', 93),
('mgt', 'c8312a9abdab2d828ebe373548a2235a8ff45e3d', 94),
('nml', '2c6866820fbfcad75942e28b8233fd8165324150', 95),
('nmp', '70b3feaf2978b3d60aad52945ec3b253db40d67d', 96),
('nbp', '51841bf364251e67f9dd4abb5ebd8a2833d5bc2f', 97),
('nts', 'c079c4adf811a76c12cb809170040257c0ce7834', 98),
('nea', '55a55f80b4f267b22206d7a2526999e0ac65c8ff', 99),
('pho', '9939cf5dc991ed7fc883196e5194291c279585b6', 100),
('rma', 'a22be885049d1a28a13fa38c6dafad85f0000c3d', 101),
('rbt', '7056f0c1d45784c8655ddd8576fd2a3c0e367b27', 102),
('rvr', '3869b872285a88950318f7d642e9336367366fd0', 103),
('rala', '04156b97da1d492d7995de07ed441ff324208510', 104),
('ram', '4a94b11aec3201ff58f20e36bcc64def81eb3a58', 105),
('rbl', '0bf1c8b7a6009642de43907ca99c2ba369e22a44', 106),
('rps', 'f8e7de2528bf11b26db8886a5a33cc76c38fed83', 107),
('rbb', '8f6bf61a64e457f6c0276e9fe57198518a9187ac', 108),
('rns', '1daa98455304b53d1f4bd41aadd0617be3b9d54d', 109),
('sglq', 'fb06bd30864255c9b0ae64a516ad0a0c81906a35', 110),
('smm', '9dcb3196a0181a69f8f58e93a1cf9c9c1a80759a', 111),
('vasl', '6116d8fb3454d72956ba42fd98c822c3f8920b99', 112),
('vhg', '333ea281974f6c1a2483ba409efc33ac495c9a85', 113),
('vrc', 'c810893b1db4d9ac592fdbc31a5b36d3c1088eed', 114),
('zar', '40f254dd82f1895497a877de676d4e5f89ad00a0', 115),
('scholar', '768eb84ba663ae8260fb667aa44fc77410423fef', 116),
('jda', 'e25f21b0729d57626d59b3149f2510287df887e8', 117),
('acc', '2eab260e896beb63114967459dbf8b4e03cca933', 118),
('ncm', '4d52fcf4fa50ed4ed0f7a17ae9e20dc067540945', 119),
('ear', 'fcdfeffcc45497ebe811c3397da55717bb7c61a7', 120),
('sms', 'e2156f7c3ea650d4bca4410922ea9d953ca75c10', 121),
('keq', '1e904c5e4eaf0f857d8e096edddb7673d5a24355', 122),
('badt', '131981d1c05b9d47c3a79b361656fd88c29729a1', 123),
('jtb', '198eae291d4911763bcf89d2d81a6223a0ce28aa', 124),
('msa', '49fba14f4e681f103a9ad8d2289a8ebeda3e54b0', 125),
('rad', 'cced855651736b7cc0b4e9ae18e62f327966585d', 126),
('luu', 'd9fe34f778d3a310124b5d1340265f5171f34794', 127),
('dam', 'b06a29c600bef8e7e92c66f98334ef05066ed218', 128),
('akma', '401f5c30d5ae8307c4dcf4d3972b944f6cd9fda3', 129),
('jkkas', '981e601c17a0ca9453530fed9837988c625572de', 130),
('mre', 'c4453fa094c124221b0aae6f841460dc4dae5c94', 131);

-- --------------------------------------------------------

--
-- Table structure for table `account_phone_book`
--

CREATE TABLE IF NOT EXISTS `account_phone_book` (
  `uid` int(11) NOT NULL,
`id` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email_add1` varchar(100) NOT NULL,
  `email_add2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_profile`
--

CREATE TABLE IF NOT EXISTS `account_profile` (
`id` int(11) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `profile_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `profile_age` int(3) DEFAULT NULL,
  `profile_address` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `resident_tel` varchar(255) NOT NULL,
  `office_tel` varchar(255) DEFAULT NULL,
  `profile_contact_number` varchar(255) DEFAULT NULL,
  `profile_email` varchar(255) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_profile`
--

INSERT INTO `account_profile` (`id`, `uid`, `profile_name`, `last_name`, `first_name`, `middle_name`, `profile_age`, `profile_address`, `fax`, `resident_tel`, `office_tel`, `profile_contact_number`, `profile_email`, `dept_id`, `position`, `profile_image`, `date_modified`) VALUES
(2, 1, 'Administrator', NULL, NULL, NULL, 0, 'mayondon', NULL, '', NULL, '093081865421', 'johnkenne@gmail', 3, 'administrator', '1.jpg', '2016-09-29 10:08:01'),
(4, 3, 'FMU', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 2, NULL, '3.jpg', '2016-09-29 10:08:01'),
(5, 4, 'ICU', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 3, 'Accounting Head', NULL, '2016-09-29 10:08:01'),
(25, 10, 'KRU', NULL, NULL, NULL, 21, 'dsfdsfdsfds dsfdsfdsfds dsfdsfdsfds', NULL, '', NULL, NULL, NULL, NULL, '', NULL, '2016-09-29 10:08:01'),
(27, 24, 'Adah Sofia A. Renovilla', 'Renovilla', 'Adah Sofia', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 8, NULL, NULL, '2016-09-29 10:08:01'),
(29, 25, 'Adoracion T. Robles', 'Robles', 'Adoracion', 'T', NULL, NULL, NULL, '', NULL, NULL, NULL, 21, NULL, NULL, '2016-09-29 10:08:01'),
(30, 26, 'Aldwin H. Escobin', 'Escobin', 'Aldwin', 'H', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(32, 27, 'Alicia D. Revilla', 'Revilla', 'Alicia', 'D', NULL, NULL, NULL, '', NULL, NULL, NULL, 22, NULL, NULL, '2016-09-29 10:08:01'),
(33, 28, 'Alvin G. Tallada', 'Tallada', 'Alvin', 'G', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(34, 29, 'Amy A. Antonio', 'Antonio', 'Amy', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(35, 30, 'Angelito R. Menguito', 'Menguito', 'Angelito', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(36, 31, 'Annalyn P. Flores', 'Flores', 'Annalyn', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(37, 32, 'Anthony L. Sarino', 'Sarino', 'Anthony', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, 13, NULL, NULL, '2016-09-29 10:08:01'),
(38, 33, 'Arlene A. Nadres', 'Nadres', 'Arlene', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 20, NULL, NULL, '2016-09-29 10:08:01'),
(39, 34, 'Arnel R. Oabina', 'Oabina', 'Arnel', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(40, 35, 'Avril DG. Madrid', 'Madrid', 'Avril', 'DG.', NULL, NULL, NULL, '', NULL, NULL, NULL, 20, NULL, NULL, '2016-09-29 10:08:01'),
(41, 36, 'Bernisse Sabina R. Almazan', 'Almazan', 'Bernisse Sabina', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(42, 37, 'Bessie M. Burgos', 'Burgos', 'Bessie', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 11, NULL, NULL, '2016-09-29 10:08:01'),
(43, 38, 'Blessie P. Saez', 'Saez', 'Blessie', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, 16, NULL, NULL, '2016-09-29 10:08:01'),
(45, NULL, 'Carmen Nyhria G. Rogel', 'Rogel', 'Carmen Nyhria', 'G.', NULL, NULL, NULL, '', NULL, NULL, NULL, 11, NULL, NULL, '2016-09-29 10:08:01'),
(46, 40, 'Carolina P. Tolentino', 'Tolentino', 'Carolina', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(47, 41, 'Charisse B. Constantino', 'Constantino', 'Charisse ', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(48, 42, 'Christian F. Agnes', 'Agnes', 'Christian', 'F.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(49, 43, 'Cirila B. Miranda', 'Miranda', 'Cirila', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(50, 44, 'Dennis P. Dizon', 'Dizon', 'Dennis', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(51, 45, 'Domisiano C. Cernero', 'Cernero', 'Domisian', 'C.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(52, 46, 'Edmund M. Ubaldo', 'Ubaldo', 'Edmund', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(53, 47, 'Eduardo D. Rodriguez Jr.', 'Rodriguez', 'Eduardo', 'D.', NULL, NULL, NULL, '', NULL, NULL, NULL, 22, NULL, NULL, '2016-09-29 10:08:01'),
(54, 48, 'Eidelmine Elizabeth F. Genosa', 'Genosa', 'Eidelmine Elizabeth', 'F.', NULL, NULL, NULL, '', NULL, NULL, NULL, 17, NULL, NULL, '2016-09-29 10:08:01'),
(55, 49, 'Elma M. Banzuela', 'Banzuela', 'Elma', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(56, 50, 'Elmer C. Suñaz', 'Sunaz', 'Elmer', 'C.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(57, 51, 'Elmer G. Pandanan', 'Pandanan', 'Elmer', 'G.', NULL, NULL, NULL, '', NULL, NULL, NULL, 8, NULL, NULL, '2016-09-29 10:08:01'),
(58, 52, 'Elton Jun V. Veloria', 'Veloria', 'Elton Jun', 'V.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(59, 53, 'Eriza C. Asilo', 'Asilo', 'Eriza', 'C.', NULL, NULL, NULL, '', NULL, NULL, NULL, 16, NULL, NULL, '2016-09-29 10:08:01'),
(60, 54, 'Estelita R. Lanzanas', 'Lanzanas', 'Estelita', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(61, 55, 'Eugene Philip S. Boone', 'Boone', 'Eugene Philip', 'S.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(62, 56, 'Fe D. dela Cruz', 'Dela Cruz', 'Fe', 'D.', NULL, NULL, NULL, '', NULL, NULL, NULL, 9, NULL, NULL, '2016-09-29 10:08:01'),
(63, 57, 'Gaspar L. de Chavez', 'De Chavez', 'Gaspar', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(64, 58, 'Gil C. Saguiguit Jr.', 'Saguiguit Jr.', 'Gil', 'C.', NULL, NULL, NULL, '', NULL, NULL, NULL, 8, NULL, NULL, '2016-09-29 10:08:01'),
(65, 59, 'Gilbert A. Gilbuena', 'Gilbuena', 'Gilbert', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(66, 60, 'Henry M. Custodio', 'Custodio', 'Henry', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 11, NULL, NULL, '2016-09-29 10:08:01'),
(67, 61, 'Imelda L. Batangantang', 'Batangantang', 'Imelda', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(68, 62, 'Irma L. Polintan', 'Polintan', 'Irma', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(69, 63, 'Jaime B. Buendia', 'Buendia', 'Jaime', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(70, 64, 'Jaymark Warren T. Dia', 'Dia', 'Jaymark Warren ', 'T.', NULL, NULL, NULL, '', NULL, NULL, NULL, 22, NULL, NULL, '2016-09-29 10:08:01'),
(71, 65, 'Jerrel Edric B. Mallari', 'Mallari', 'Jerrel Edric', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(72, 66, 'Jesselle S. Laranas', 'Laranas', 'Jesselle', 'S.', NULL, NULL, NULL, '', NULL, NULL, NULL, 16, NULL, NULL, '2016-09-29 10:08:01'),
(73, NULL, 'Joan Angelica O. Endencia', 'Endencia', 'Joan Angelica', 'O.', NULL, NULL, NULL, '', NULL, NULL, NULL, 12, NULL, NULL, '2016-09-29 10:08:01'),
(74, 67, 'John Kenneth G. Abella', 'Abella', 'John Kenneth', 'G.', NULL, NULL, NULL, '', NULL, '09308186542', NULL, 22, 'programmer', '67.jpg', '2016-10-27 10:26:13'),
(75, 68, 'Julita G. Ventenilla', 'Ventenilla', 'Julita', 'G.', NULL, NULL, NULL, '', NULL, NULL, NULL, 19, NULL, NULL, '2016-09-29 10:08:01'),
(76, 69, 'Junette Dawn A. Baculfo', 'Baculfo', 'Junette Dawn ', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(78, 70, 'Karen M. Javier', 'Javier', 'Karen ', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 2, NULL, NULL, '2016-09-29 10:08:01'),
(79, 71, 'Kristine Joy S. Villagracia', 'Villagracia', 'Kristine Joy ', 'S.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(80, 72, 'Lamberto N. Mariano', 'Mariano', 'Lamberto ', 'N.', NULL, NULL, NULL, '', NULL, NULL, NULL, 2, NULL, NULL, '2016-09-29 10:08:01'),
(81, 73, 'Leah Lyn D. Domingo', 'Domingo', 'Leah Lyn ', 'D.', NULL, NULL, NULL, '', NULL, NULL, NULL, 8, NULL, NULL, '2016-09-29 10:08:01'),
(83, NULL, 'Loise Ann Carandang', 'Carandang', 'Loise Ann ', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(84, 74, 'Lope B. Santos III', 'Santos III', 'Lop', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(85, 75, 'Lovely Grace R. Urriza', 'Urriza', 'Lovely Grace ', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, 17, NULL, NULL, '2016-09-29 10:08:01'),
(88, 77, 'Ma. Margaritha B. Romero', 'Romero', 'Ma. Margaritha ', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(89, 78, 'Ma. Obdulia B. Jolejole', 'Jolejole', 'Ma. Obdulia ', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 2, NULL, NULL, '2016-09-29 10:08:01'),
(90, 79, 'Maciste B. Alegre', 'Alegre', 'Maciste', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(91, 80, 'Malaya N. Montesur', 'Montesur', 'Malaya', 'N.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(93, 81, 'Maria Celeste H. Cadiz', 'Cadiz', 'Maria Celeste', 'H.', NULL, NULL, NULL, '', NULL, NULL, NULL, 12, NULL, NULL, '2016-09-29 10:08:01'),
(94, 82, 'Maria Cristeta N. Cuaresma', 'Cuaresma', 'Maria Cristeta', 'N.', NULL, NULL, NULL, '', NULL, NULL, NULL, 16, NULL, NULL, '2016-09-29 10:08:01'),
(95, 83, 'Maria Cristina L. Decena', 'Decena', 'Maria Cristina', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, 12, NULL, NULL, '2016-09-29 10:08:01'),
(96, 84, 'Maria Magdalena J. Ermino', 'Ermino', 'Maria Magdalena', 'J.', NULL, NULL, NULL, '', NULL, NULL, NULL, 2, NULL, NULL, '2016-09-29 10:08:01'),
(98, 85, 'Maria Monina Cecilia A. Villena', 'Villena', 'Maria Monina Cecilia', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 15, NULL, NULL, '2016-09-29 10:08:01'),
(99, 86, 'Maria Teresa Lourdes B. Ferino', 'Ferino', 'Maria Teresa Lourdes', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 8, NULL, NULL, '2016-09-29 10:08:01'),
(100, NULL, 'Maria Theresa M. Castro', 'Castro', 'Maria Theresa', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(101, 87, 'Maribel B. Almanza', 'Almanza', 'Maribel ', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(102, 125, 'Maricel S. Adique', 'Adique', 'Maricel ', 'S.', NULL, NULL, NULL, '', NULL, NULL, NULL, 15, NULL, NULL, '2016-09-29 10:08:01'),
(103, 89, 'Mariliza V. Ticsay', 'Ticsay', 'Mariliza ', 'V.', NULL, NULL, NULL, '', NULL, NULL, NULL, 20, NULL, NULL, '2016-09-29 10:08:01'),
(104, 90, 'Marites U. Suarez', 'Suarez', 'Marites', 'U.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(105, 91, 'Mary Ann R. Martinez', 'Martinez', 'Mary Ann', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, 21, NULL, NULL, '2016-09-29 10:08:01'),
(106, 92, 'Maylyn G. Desamparo', 'Desamparo', 'Maylyn', 'G.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(108, 93, 'Michael Angelo A. Manzano', 'Manzano', 'Michael Angelo', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(109, 94, 'Mina G. Talatala', 'Talatala', 'Mina', 'G.', NULL, NULL, NULL, '', NULL, NULL, NULL, 14, NULL, '94.jpg', '2016-09-29 10:08:01'),
(110, 95, 'Nancy L. de Leon', 'De Leon', 'Nancy ', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(111, 96, 'Natividad P. Salazar', 'Salazar', 'Natividad', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(114, 97, 'Nicolas B. Palacpac', 'Palacpac', 'Nicolas', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(115, 98, 'Nicolas T. Sapin', 'Sapin', 'T.', 'Nicolas', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(116, 99, 'Nova A. Ramos', 'Ramos', 'Nova', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 12, NULL, NULL, '2016-09-29 10:08:01'),
(118, 100, 'Paulito H. Opulencia', 'Opulencia', 'Paulito', 'H.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(119, 101, 'Ramil M. Alvarez', 'Alvarez', 'Ramil', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(120, 102, 'Renz B. Tabadero', 'Tabadero', 'Renz', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 22, NULL, NULL, '2016-09-29 10:08:01'),
(121, 103, 'Rheden V. Rebong', 'Rebong', 'Rheden', 'V.', NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(122, 104, 'Rhona Amor L. Abdon', 'Abdon', 'Rhona Amor ', 'l.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(123, 105, 'Ricardo A. Menorca', 'Menorca', 'Ricardo', 'a.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(124, 106, 'Rochella B. Lapitan', 'Lapitan', 'Rochell', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 11, NULL, NULL, '2016-09-29 10:08:01'),
(125, 107, 'Ronald P. Salazar', 'Salazar', 'Ronald', 'P.', NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(126, 108, 'Rosario B. Bantayan', 'Bantayan', 'Rosario', 'B.', NULL, NULL, NULL, '', NULL, NULL, NULL, 12, NULL, NULL, '2016-09-29 10:08:01'),
(128, 109, 'Ryan N. Sabado', 'Sabado', 'Ryan ', 'N.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(129, 110, 'Sarah Grace L. Quiñones', 'Quiñones', 'Sarah Grace', 'L.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(130, 111, 'Sophia M. Mercado', 'Mercado', 'Sophia', 'M.', NULL, NULL, NULL, '', NULL, NULL, NULL, 15, NULL, NULL, '2016-09-29 10:08:01'),
(131, NULL, 'Suzette Simondac', 'Simondac', 'Suzette', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(133, 112, 'Van Allen S. Limbaco', 'Limbaco', 'Van Allen ', 'S.', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(134, 113, 'Virginia H. Gomez', 'Gomez', 'Virginia', 'H.', NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(135, 114, 'Virginia R. Cardenas', 'Cardenas', 'Virginia', 'R.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(136, 115, 'Zacyl A. Rivera-Jalotjot', 'Rivera-Jalotjot', 'Zacyl', 'A.', NULL, NULL, NULL, '', NULL, NULL, NULL, 16, NULL, NULL, '2016-09-29 10:08:01'),
(138, 12, 'MSU', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 1, NULL, NULL, '2016-09-29 10:08:01'),
(139, 117, 'Aranzaso, Jojo D.', 'Aranzaso', 'Jojo', 'D', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(140, 118, 'Corpuz, Adriano Jr. C.', 'Corpuz', 'Adriano Jr.', 'C', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(141, 119, 'Milante, Nelson C.', 'Milante', 'Nelson', 'C', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-29 10:08:01'),
(142, 120, 'Raymundo, Edward A.', 'Raymundo', 'Edward', 'A', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(143, 121, 'Simon, Simon M.', 'Simon', 'Simon', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, 18, NULL, NULL, '2016-09-29 10:08:01'),
(144, 126, 'Renante Dumaraos', 'Dumaraos', 'Renante', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 19, NULL, NULL, '2016-09-29 10:08:01'),
(145, 127, 'Limuel Urriza', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 19, NULL, NULL, '2016-09-29 10:08:01'),
(146, 124, 'Jocelyn Bellin', 'Bellin', 'Jocelyn', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 9, NULL, NULL, '2016-09-29 10:08:01'),
(147, 128, 'Dexter Manset', 'Manset', 'Dexter', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(148, 129, 'Ana Christina Aquino', 'Aquino', 'Ana Christina', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 10, NULL, NULL, '2016-09-29 10:08:01'),
(149, 130, 'Joyce Kristienne Kamille Suarez', 'Suarez', 'Joyce Kristienne Kamille', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 3, NULL, NULL, '2016-09-29 10:08:01'),
(150, 131, 'Marian Estrellado', 'Estrellado', 'Marian', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 13, NULL, NULL, '2016-09-29 10:08:01'),
(151, 123, 'Bethel Ann Dannah A. Tamaño', 'Tamaño', 'Bethel Ann Dannah', 'A', NULL, NULL, NULL, '', NULL, NULL, NULL, 14, NULL, NULL, '2016-09-29 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_account`
--

CREATE TABLE IF NOT EXISTS `alumni_account` (
`id` int(11) NOT NULL,
  `ischo_id` int(11) DEFAULT NULL,
  `account_username` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni_account`
--

INSERT INTO `alumni_account` (`id`, `ischo_id`, `account_username`, `account_password`, `date_created`) VALUES
(81, NULL, 'jkga@searca.org', 'f6908f1e104646a', '2016-02-11 00:26:29'),
(82, NULL, 'jkga@searca.org', '2958fb36076119d', '2016-02-11 03:57:40'),
(83, NULL, 'jkga@searca.org', '4b7373a19a946e0', '2016-02-11 03:59:53'),
(84, NULL, 'jkga@searca.org', 'c72518a1662aa7c', '2016-02-24 07:03:05'),
(85, NULL, 'jkga@searca.org', '8e15ff7724fbe03', '2016-06-27 01:10:41'),
(86, NULL, '', '7cbdcf3a1be5a30', '2016-06-30 03:45:53'),
(87, 1416, '', '2dd7f231732fdc7', '2016-07-05 02:09:37'),
(88, 871, '', 'a8bb376986b1adc', '2016-07-07 07:21:47'),
(89, 1500, '', '80f4571b6ac16bc', '2016-07-27 01:42:55'),
(90, 1500, '', 'd3193c1004274f0', '2016-07-27 01:56:37'),
(91, 1500, '', '26f194c82320de8', '2016-07-27 02:00:38'),
(92, 1500, '', 'c0fb2726f8f0e8d', '2016-09-14 03:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `atr_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `atr_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atr_sys_privilege`
--

INSERT INTO `atr_sys_privilege` (`uid`, `priv`, `id`) VALUES
(29, 'user', 1),
(33, 'user', 2),
(35, 'user', 3),
(1, 'admin', 4),
(27, 'user', 5),
(28, 'user', 6),
(26, 'user', 7),
(32, 'user', 8),
(31, 'user', 9),
(30, 'user', 10),
(34, 'user', 11),
(24, 'user', 12),
(25, 'user', 13),
(18, 'user', 14),
(37, 'user', 15),
(38, 'user', 16),
(36, 'user', 17),
(41, 'user', 18),
(43, 'user', 19),
(42, 'user', 20),
(40, 'user', 21),
(45, 'user', 22),
(44, 'user', 23),
(53, 'user', 24),
(50, 'user', 25),
(47, 'user', 26),
(48, 'user', 27),
(51, 'user', 28),
(52, 'user', 29),
(49, 'user', 30),
(46, 'user', 31),
(55, 'user', 32),
(54, 'user', 33),
(56, 'user', 34),
(3, 'user', 35),
(59, 'user', 36),
(58, 'user', 37),
(15, 'user', 38),
(57, 'user', 39),
(11, 'user', 40),
(60, 'user', 41),
(16, 'user', 42),
(20, 'user', 43),
(4, 'user', 44),
(61, 'user', 45),
(62, 'user', 46),
(63, 'user', 47),
(69, 'user', 48),
(65, 'user', 49),
(68, 'user', 50),
(67, 'user', 51),
(66, 'user', 52),
(64, 'user', 53),
(71, 'user', 54),
(17, 'user', 55),
(70, 'user', 56),
(10, 'user', 57),
(74, 'user', 58),
(19, 'user', 59),
(73, 'user', 60),
(72, 'user', 61),
(75, 'user', 62),
(93, 'user', 63),
(91, 'user', 64),
(79, 'user', 65),
(87, 'user', 66),
(81, 'user', 67),
(83, 'user', 68),
(82, 'user', 69),
(76, 'user', 70),
(92, 'user', 71),
(94, 'user', 72),
(9, 'user', 73),
(85, 'user', 74),
(77, 'user', 75),
(84, 'user', 76),
(88, 'user', 77),
(80, 'user', 78),
(78, 'user', 79),
(12, 'user', 80),
(86, 'user', 81),
(90, 'admin', 82),
(89, 'user', 83),
(97, 'user', 84),
(99, 'user', 85),
(39, 'user', 86),
(95, 'user', 87),
(96, 'user', 88),
(98, 'user', 89),
(21, 'user', 90),
(22, 'user', 91),
(14, 'user', 92),
(100, 'user', 93),
(104, 'user', 94),
(105, 'user', 95),
(108, 'user', 96),
(106, 'user', 97),
(102, 'user', 98),
(23, 'user', 99),
(101, 'user', 100),
(109, 'user', 101),
(107, 'user', 102),
(103, 'user', 103),
(110, 'user', 104),
(111, 'user', 105),
(13, 'user', 106),
(112, 'user', 107),
(113, 'user', 108),
(114, 'user', 109),
(115, 'user', 110);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_monitoring_privilege`
--

CREATE TABLE IF NOT EXISTS `attendance_monitoring_privilege` (
`id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_monitoring_privilege`
--

INSERT INTO `attendance_monitoring_privilege` (`id`, `profile_id`, `pin`, `priv`, `status`) VALUES
(1, 74, '1234', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_alias` varchar(100) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_alias`, `is_active`) VALUES
(1, 'Management Services Unit', 'MSU', 0),
(2, 'Facilities Management Unit', 'FMU', 1),
(3, 'Accounting Unit', 'AcU', 1),
(8, 'Office of the Director', 'OD', 1),
(9, 'Office of the Deputy Director for Administration', 'ODD-A', 1),
(10, 'Project Development and Technical Services', 'PDTS', 1),
(11, 'Research and Development Department', 'RDD', 1),
(12, 'Training Unit', 'KMD-TU', 1),
(13, 'Treasury Services Unit', 'TSU', 1),
(14, 'Records and Archives', 'Records and Archives', 1),
(15, 'Biotechnology Information Center', 'KMD-BIC', 1),
(16, 'Graduate Education and Institutional Development Department', 'GEIDD', 1),
(17, 'Human Resource Management Unit', 'HRMU', 1),
(18, 'General Services Unit', 'GSU', 1),
(19, 'Internal Audit Unit', 'IAU', 1),
(20, 'Knowledge Resources Unit', 'KMD-KRU', 1),
(21, 'Planning and Budget Unit', 'PBU', 1),
(22, 'Information Technology Services Unit', 'ITSU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `appointment` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_ended` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `uid`, `pid`, `appointment`, `date_created`, `date_ended`, `active`) VALUES
(1, 112, 2, 'emergency', '2016-02-01', '2016-09-01', 1),
(2, 117, 2, 'contractual', '0000-00-00', '0000-00-00', 1),
(3, 118, 2, 'contractual', '0000-00-00', '0000-00-00', 1),
(4, 119, 2, 'contractual', '0000-00-00', '0000-00-00', 1),
(5, 120, 2, 'contractual', '0000-00-00', '0000-00-00', 1),
(6, 121, 2, 'contractual', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doc_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `doc_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_sys_privilege`
--

INSERT INTO `doc_sys_privilege` (`uid`, `priv`, `id`) VALUES
(1, 'admin', 1),
(3, 'user', 2),
(4, 'user', 3),
(10, 'user', 8),
(11, 'user', 9),
(12, 'user', 10),
(13, 'user', 11),
(15, 'user', 12),
(16, 'user', 13),
(17, 'user', 14),
(19, 'user', 15),
(20, 'user', 16),
(21, 'user', 17),
(22, 'user', 18),
(23, 'user', 19),
(94, 'admin', 20);

-- --------------------------------------------------------

--
-- Table structure for table `ischolar_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `ischolar_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ischolar_sys_privilege`
--

INSERT INTO `ischolar_sys_privilege` (`uid`, `priv`, `id`) VALUES
(1, 'admin', 1),
(3, 'user', 2),
(4, 'user', 3),
(5, 'user', 5),
(6, 'user', 6),
(67, 'admin', 20),
(115, 'admin', 21);

-- --------------------------------------------------------

--
-- Table structure for table `lis_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `lis_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lis_sys_privilege`
--

INSERT INTO `lis_sys_privilege` (`uid`, `priv`, `id`) VALUES
(1, 'admin', 1),
(3, 'user', 2),
(4, 'user', 3),
(5, 'user', 5),
(6, 'user', 6),
(7, 'user', 7),
(10, 'user', 8),
(11, 'user', 9),
(12, 'user', 10),
(13, 'user', 11),
(15, 'user', 12),
(16, 'user', 13),
(17, 'user', 14),
(19, 'user', 15),
(20, 'user', 16),
(21, 'user', 17),
(22, 'user', 18),
(23, 'user', 19),
(94, 'admin', 20);

-- --------------------------------------------------------

--
-- Table structure for table `mpts_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `mpts_sys_privilege` (
  `uid` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpts_sys_privilege`
--

INSERT INTO `mpts_sys_privilege` (`uid`, `priv`, `id`) VALUES
(1, 'admin', 1),
(3, 'user', 2),
(4, 'user', 3),
(10, 'user', 8),
(11, 'user', 9),
(12, 'user', 10),
(13, 'user', 11),
(15, 'user', 12),
(16, 'user', 13),
(17, 'user', 14),
(19, 'user', 15),
(20, 'user', 16),
(21, 'user', 17),
(22, 'user', 18),
(23, 'user', 19),
(94, 'user', 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `office`
--
CREATE TABLE IF NOT EXISTS `office` (
`office_id` int(11)
,`office_name` varchar(255)
,`alias` varchar(100)
,`active` int(11)
,`unit_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `office_tb`
--

CREATE TABLE IF NOT EXISTS `office_tb` (
`office_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `off_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_tb`
--

INSERT INTO `office_tb` (`office_id`, `dept_id`, `off_id`, `active`) VALUES
(1, 8, 1, 1),
(2, 8, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position`, `description`, `id`) VALUES
('MIS Assistant', 'EnCiPhErEd extension to any encrypted files.When it is ... BleepingComputer.com; Register to remove ads ... I have been affected by this Virus.', 1),
('driver', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rfp_sys_privilege`
--

CREATE TABLE IF NOT EXISTS `rfp_sys_privilege` (
  `dept_id` int(11) NOT NULL,
  `priv` enum('admin','user') NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfp_sys_privilege`
--

INSERT INTO `rfp_sys_privilege` (`dept_id`, `priv`, `id`) VALUES
(3, 'admin', 1),
(1, 'user', 2),
(2, 'user', 5),
(8, 'user', 6),
(9, 'user', 7),
(14, 'user', 8),
(22, 'user', 9),
(16, 'user', 10),
(21, 'user', 11);

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE IF NOT EXISTS `signatory` (
  `uid` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`uid`, `dept_id`, `priority`, `id`) VALUES
(4, 3, NULL, 1),
(25, 1, NULL, 2),
(25, 22, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `signatory_centerwide`
--

CREATE TABLE IF NOT EXISTS `signatory_centerwide` (
`signatory_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `recommend_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signatory_per_department`
--

CREATE TABLE IF NOT EXISTS `signatory_per_department` (
  `dept_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `unit`
--
CREATE TABLE IF NOT EXISTS `unit` (
`dept_name` varchar(255)
,`allias` varchar(100)
,`active` int(11)
,`off_id` int(11)
,`unit_id` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `office`
--
DROP TABLE IF EXISTS `office`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `office` AS select `office_tb`.`office_id` AS `office_id`,`department`.`dept_name` AS `office_name`,`department`.`dept_alias` AS `alias`,`office_tb`.`active` AS `active`,`office_tb`.`off_id` AS `unit_id` from (`department` left join `office_tb` on((`department`.`dept_id` = `office_tb`.`dept_id`))) where (`office_tb`.`active` = 1);

-- --------------------------------------------------------

--
-- Structure for view `unit`
--
DROP TABLE IF EXISTS `unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `unit` AS select `department`.`dept_name` AS `dept_name`,`department`.`dept_alias` AS `allias`,`office_tb`.`active` AS `active`,`office_tb`.`off_id` AS `off_id`,`office_tb`.`office_id` AS `unit_id` from (`department` left join `office_tb` on((`department`.`dept_id` = `office_tb`.`dept_id`))) where (`office_tb`.`active` = 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD KEY `username` (`account_username`);

--
-- Indexes for table `account_phone_book`
--
ALTER TABLE `account_phone_book`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `account_profile`
--
ALTER TABLE `account_profile`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uid_2` (`uid`), ADD KEY `uid` (`uid`), ADD KEY `dept_id` (`dept_id`), ADD FULLTEXT KEY `profile_name` (`profile_name`);

--
-- Indexes for table `alumni_account`
--
ALTER TABLE `alumni_account`
 ADD PRIMARY KEY (`id`), ADD KEY `ischo_id` (`ischo_id`);

--
-- Indexes for table `atr_sys_privilege`
--
ALTER TABLE `atr_sys_privilege`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_monitoring_privilege`
--
ALTER TABLE `attendance_monitoring_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`profile_id`), ADD KEY `uid_2` (`profile_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`dept_id`), ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `ischolar_sys_privilege`
--
ALTER TABLE `ischolar_sys_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `lis_sys_privilege`
--
ALTER TABLE `lis_sys_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `mpts_sys_privilege`
--
ALTER TABLE `mpts_sys_privilege`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `office_tb`
--
ALTER TABLE `office_tb`
 ADD PRIMARY KEY (`office_id`), ADD KEY `dept_id` (`dept_id`), ADD KEY `off_id` (`off_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfp_sys_privilege`
--
ALTER TABLE `rfp_sys_privilege`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`uid`), ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `signatory_centerwide`
--
ALTER TABLE `signatory_centerwide`
 ADD PRIMARY KEY (`signatory_id`);

--
-- Indexes for table `signatory_per_department`
--
ALTER TABLE `signatory_per_department`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `account_phone_book`
--
ALTER TABLE `account_phone_book`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `account_profile`
--
ALTER TABLE `account_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `alumni_account`
--
ALTER TABLE `alumni_account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `atr_sys_privilege`
--
ALTER TABLE `atr_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `attendance_monitoring_privilege`
--
ALTER TABLE `attendance_monitoring_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ischolar_sys_privilege`
--
ALTER TABLE `ischolar_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `lis_sys_privilege`
--
ALTER TABLE `lis_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `mpts_sys_privilege`
--
ALTER TABLE `mpts_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `office_tb`
--
ALTER TABLE `office_tb`
MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rfp_sys_privilege`
--
ALTER TABLE `rfp_sys_privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `signatory_centerwide`
--
ALTER TABLE `signatory_centerwide`
MODIFY `signatory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `signatory_per_department`
--
ALTER TABLE `signatory_per_department`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_phone_book`
--
ALTER TABLE `account_phone_book`
ADD CONSTRAINT `account_phone_book_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_profile`
--
ALTER TABLE `account_profile`
ADD CONSTRAINT `account_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `account_profile_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `attendance_monitoring_privilege`
--
ALTER TABLE `attendance_monitoring_privilege`
ADD CONSTRAINT `attendance_monitoring_privilege_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `account_profile` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `doc_sys_privilege`
--
ALTER TABLE `doc_sys_privilege`
ADD CONSTRAINT `doc_sys_privilege_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `office_tb`
--
ALTER TABLE `office_tb`
ADD CONSTRAINT `office_tb_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `office_tb_ibfk_2` FOREIGN KEY (`off_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `signatory`
--
ALTER TABLE `signatory`
ADD CONSTRAINT `signatory_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `signatory_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
