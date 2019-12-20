-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2019 at 02:33 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfokol_presensigps`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminx`
--

CREATE TABLE `adminx` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `usernamex` varchar(15) NOT NULL DEFAULT '',
  `passwordx` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminx`
--

INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`) VALUES
('e4ea2f7dfb2e5c51e38998599e90afc2', 'admin', 'e9b690b66c32ca3237bb283e718f342a');

-- --------------------------------------------------------

--
-- Table structure for table `a_profil`
--

CREATE TABLE `a_profil` (
  `kd` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL,
  `lat_x` longtext NOT NULL,
  `lat_y` longtext NOT NULL,
  `alamat` longtext NOT NULL,
  `telp` longtext NOT NULL,
  `email` longtext NOT NULL,
  `filex` longtext NOT NULL,
  `alamat_googlemap` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `a_profil`
--

INSERT INTO `a_profil` (`kd`, `judul`, `postdate`, `lat_x`, `lat_y`, `alamat`, `telp`, `email`, `filex`, `alamat_googlemap`) VALUES
('e807f1fcf82d132f9bb018ca6738a19f', 'Sekolah XYZ', '2019-12-20 10:53:12', '-6.92192164918466', '110.2042543888092', 'Jl. Raya . . .', 'x', 'x', 'logo.jpg', 'Kendal');

-- --------------------------------------------------------

--
-- Table structure for table `barang_lokasi`
--

CREATE TABLE `barang_lokasi` (
  `kd` varchar(50) NOT NULL,
  `orang_kd` varchar(50) NOT NULL,
  `orang_kode` varchar(50) NOT NULL,
  `orang_nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `lat_x` varchar(100) NOT NULL,
  `lat_y` varchar(100) NOT NULL,
  `status` longtext NOT NULL,
  `filex` longtext NOT NULL,
  `alamat` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barang_lokasi`
--

INSERT INTO `barang_lokasi` (`kd`, `orang_kd`, `orang_kode`, `orang_nama`, `postdate`, `lat_x`, `lat_y`, `status`, `filex`, `alamat`) VALUES
('df6a2c7c691c3dea8d60241903737a41', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:42:11', 'xstrix6.9713002', '110.1508815', 'Stock kursi perlu ditambah lagi..', '378deca6c66b4c09f272176a56ff255fxstrix20191220114211.jpg', ', , , , , ,');

-- --------------------------------------------------------

--
-- Table structure for table `m_orang`
--

CREATE TABLE `m_orang` (
  `kd` varchar(50) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `filex1` longtext NOT NULL,
  `nip` varchar(100) NOT NULL,
  `usernamex` varchar(100) NOT NULL,
  `passwordx` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `hardware_kode` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_orang`
--

INSERT INTO `m_orang` (`kd`, `kode`, `nama`, `filex1`, `nip`, `usernamex`, `passwordx`, `postdate`, `jabatan`, `hardware_kode`) VALUES
('a5cbfff5e119130ee6a07137a4eba05d', '', 'Ace Sudarman', '', '19580123', '19580123', '8ead2bac19d2bd1e6c9695a2c5fffa30', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('3371df40623a80cd681e810dee241e85', '', 'Ade Firmansyah', '', '19871212', '19871212', '82c3a73a7cb5314dc988f26a53660b9d', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('5b816260589ca6ea644bb55ec031bd51', '', 'Agung Hermawan', '', '19820623', '19820623', 'bd83e5eed9f1790ca72eb509be668edf', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('989801312057d6be1c6ce7354730937d', '', 'ANINDYA TRI YUNITA', '', '19961029', '19961029', 'f886c33fa63efd2a5a061d66f0c2765a', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('ca6d9b7ed86910d82e587a349912d9e4', '', 'Aris Abdul Aziz', '', '19881228', '19881228', 'e71c9f148b22aa71d7e77e2c63eebcbb', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('ef1e59abfd5696b9f554df57d743f162', '', 'Asep Nugraha', '', '19720727', '19720727', '663c839b3df1e1c7248bbe2d264d889c', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('f4ed48ce9e5953912126d73b6a7719df', '', 'Dede Soleh Kurnia', '', '19790130', '19790130', 'dda7be0a9897c188b246c3d17213478d', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('91817fae258a613349a2b08c59e108b6', '', 'Devi Kurnia', '', '19910528', '19910528', 'd68e3847d3ac83f7e99f716c486a4cd0', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('57034d921ca51435d522462bd9f5568c', '', 'Eska Sri Rahayu', '', '19850717', '19850717', '565feaf045fa2e72bfa56cb12b7fafd4', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('ac9d41b596bf1a040dedae2a9d16d21f', '', 'Hana Paojiah Nurmilah', '', '19810717', '19810717', 'b200a91fc32d9f11146335d97ea33b00', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('9f9e3ed288c58c6bc4866eb21835be87', '', 'Hani Laili Kurnia', '', '19890709', '19890709', '8ceb74fc62719204809e2fda853900a5', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('24c104424c6802c34d173311ce2d0a99', '', 'Heris Mulyana Yogaswara', '', '19791222', '19791222', '23223c20b7e6b24d24eca05732928e0d', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('e1aa926a4e16aabfca97865ca983d9bd', '', 'Herna Novitasari', '', '19950630', '19950630', '272bf8e28e20e7051366e22d4f21942b', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('72aab51ffd1ee0834fedf15eb9aaa876', '', 'Hilda Septiani', '', '19900917', '19900917', '6b8d7da713865057e2f0f53d13c2db38', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('5fd71700fbc1b743aae9578e7663c242', '', 'Inta Ratna Priyantini', '', '19881212', '19881212', '2bb229fd1719076d7b2d8f615e12593d', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('7507c9fa938b6bcd42d3bfba9b7c2699', '', 'Jenal Mutakin', '', '19690516', '19690516', '3227f52481c66ed2f2beae0b7333dc64', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('850f47c256e2691ae460e78acdd73c04', '', 'Mohamad Faizal Adha', '', '19811008', '19811008', '165d5a01040b4f781a820032bcfdea34', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('372fc9ea334b9decd732f10d6ac26c26', '', 'Nurwana', '', '19810407', '19810407', '7150aac902e4409385b50ba21fd83772', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('fa4d7db10a5fed2879ae241ba3b543f5', '', 'Pia Amanda Nurhusni', '', '19881229', '19881229', '807f80febbb97605a8d6df553592661a', '2019-12-20 10:58:53', 'Guru BK', ''),
('3066a0edcbd71edf2c742165ffcce1f8', '', 'Popong Wawat Cahyawati', '', '19800818', '19800818', 'a7b49f0e10b6664fe8b67bc3b00a8bc2', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('b3cb8a8b849f31db1e62ec4a414e07f0', '', 'Putri Fitria Sundari', '', '19950302', '19950302', 'faeeb93d3b6590e4c42e8262ebaa5bbf', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('9e49ef828ac40a454cdc10914a3c7331', '', 'Retna Fauziah Adhityarini', '', '19930223', '19930223', '803a70142d37e2d60be0d0c29bc95bd9', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('283a2c57ee4a33e4a8d1051edb9c0d04', '', 'Ria Sefria Salsabila', '', '19920822', '19920822', '8d9c74498c7d809babde2c09c9254a21', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('778b2f17947d6412b02b578531c8acd1', '', 'Rizqi Lazuardi Gunawan', '', '19950713', '19950713', 'e57ac0ad702576feadf4a31afd2f64ac', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('2d853a57b718d23f9f10b30b6fed6815', '', 'Tuti Fitriyah', '', '19860610', '19860610', '2907dde07c9654effcb07999a29bfd69', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('e3388e74214a3ec0cd80b2a90aba5958', '', 'Ujang Aris Kadarisman', '', '19850209', '19850209', 'cc38a783297c6040f3fe071227e0d128', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('ea981c1ceaf6c084974ff6bc08f25154', '', 'Wida Damayanti', '', '19950204', '19950204', '77eae8c2ef9c414753b185828e01f178', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('1df4845c36ba958cedfefed62cac283f', '', 'Widi Widiyaningsih', '', '19940604', '19940604', 'c8aca15be5fd495b450e2fc245c59a62', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('e0254b7ad93e5e504f12e0a171c5fe2e', '', 'Wildan Rahman Hakim', '', '19920520', '19920520', '3c353eb3eca0e178dcfabd88d229e2cf', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('04665c90823b1a243f7a2fd44ca60236', '', 'Wiwin Karlina', '', '19810918', '19810918', '079bdb0f36f9696a248bc0883786d48b', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('a301dea1761ba50bf721ab7a913cefe0', '', 'Yoga Hendra Komara', '', '19861214', '19861214', '03bb20f3606443ef4c378bbb760fdb4f', '2019-12-20 10:58:53', 'Guru Mapel', ''),
('4db971c4404e106d8714675fa6d9fe2d', '', 'Agung Darusman', '', '19831113', '19831113', '2dfa6fdf619dd49d51ad1dc0df5a3441', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('785c9bee657be4d813c44d98573b7739', '', 'Asep Kusnadie Wiradinata', '', '19691214', '19691214', '93c269cd844a61ae1f9ddba20d85e4d4', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('4e0c0ab26dd50c02d3b65b5daaaf9f6a', '', 'Elly Garniaty', '', '19670726', '19670726', '92e59335fd00f01e1d11722be1def92b', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('0da2a70c31ed39610df0a07339bb24c2', '', 'Garnida Cristiandinata', '', '19600421', '19600421', '65dc2f58487448308bc17dc0bab81653', '2019-12-20 10:58:53', 'Petugas Keamanan', ''),
('34384a15400afa9396194fe1309f4397', '', 'Hendi Hardianto', '', '19900119', '19900119', 'ce53222e6e9b461b70e4d2ac8e6a0072', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('320c3d2669eb1774374056fd29e698fc', '', 'Iwa Kartiwa', '', '19630924', '19630924', '90d387e264b53190fc8ebf5c96422abf', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('2e76357a332c3907db9eb6d645f9b09d', '', 'Peni Susanty', '', '19810227', '19810227', 'b547042b5c837d81e5267f459713a3c5', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('200428a326c8d3339252295ea18ce810', '', 'WIKA NURKANTI', '', '19950531', '19950531', 'c71a87baeada6ee0374b474358830e79', '2019-12-20 10:58:53', 'Tenaga Administrasi Sekolah', ''),
('378deca6c66b4c09f272176a56ff255f', '', '1', '378deca6c66b4c09f272176a56ff255f-1.jpg', '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', '2019-12-20 11:41:09', '1', 'd4c392546f73b392');

-- --------------------------------------------------------

--
-- Table structure for table `m_waktu`
--

CREATE TABLE `m_waktu` (
  `kd` varchar(50) NOT NULL,
  `masuk_jam` varchar(2) NOT NULL,
  `masuk_menit` varchar(2) NOT NULL,
  `pulang_jam` varchar(2) NOT NULL,
  `pulang_menit` varchar(2) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_waktu`
--

INSERT INTO `m_waktu` (`kd`, `masuk_jam`, `masuk_menit`, `pulang_jam`, `pulang_menit`, `postdate`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', '18', '00', '09', '00', '2019-12-20 11:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `orang_login`
--

CREATE TABLE `orang_login` (
  `kd` varchar(50) NOT NULL,
  `orang_kd` varchar(50) NOT NULL,
  `orang_kode` varchar(50) NOT NULL,
  `orang_nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orang_login`
--

INSERT INTO `orang_login` (`kd`, `orang_kd`, `orang_kode`, `orang_nama`, `postdate`) VALUES
('ac1ebebfae4ac2ea0826bae73db08f37', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:26'),
('030ca82537fd17df442f729bfd599094', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:40'),
('2696a118ce82fa2ef82bc7eac856cd9c', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:45'),
('8a285733d226e23719e43e8c8e158132', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:50'),
('6751c24c8ecde4bc51454ee5499ecfef', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:54'),
('1f0dd0ab1a0b54ce53a7ea30257edec7', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `orang_lokasi`
--

CREATE TABLE `orang_lokasi` (
  `kd` varchar(50) NOT NULL,
  `orang_kd` varchar(50) NOT NULL,
  `orang_kode` varchar(50) NOT NULL,
  `orang_nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `lat_x` varchar(100) NOT NULL,
  `lat_y` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `hardware_kode` varchar(100) NOT NULL,
  `alamat` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orang_lokasi`
--

INSERT INTO `orang_lokasi` (`kd`, `orang_kd`, `orang_kode`, `orang_nama`, `postdate`, `lat_x`, `lat_y`, `status`, `hardware_kode`, `alamat`) VALUES
('3bbcc717e264e2ff6efc425c8f5e5631', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:43', 'xstrix6.9713002', '110.1508815', 'MASUK', 'd4c392546f73b392', ''),
('a07b6dfad86f7df9fff16ebda4a4c797', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20 11:41:53', 'xstrix6.9713002', '110.1508815', 'PULANG', 'd4c392546f73b392', ', , , , , ,');

-- --------------------------------------------------------

--
-- Table structure for table `orang_rekap`
--

CREATE TABLE `orang_rekap` (
  `kd` varchar(50) NOT NULL,
  `orang_kd` varchar(50) NOT NULL,
  `orang_nip` varchar(50) NOT NULL,
  `orang_nama` varchar(100) NOT NULL,
  `tglnya` date NOT NULL,
  `postdate_masuk` varchar(100) NOT NULL,
  `postdate_pulang` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `jml_jam` varchar(10) NOT NULL,
  `jml_menit` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orang_rekap`
--

INSERT INTO `orang_rekap` (`kd`, `orang_kd`, `orang_nip`, `orang_nama`, `tglnya`, `postdate_masuk`, `postdate_pulang`, `postdate`, `jml_jam`, `jml_menit`) VALUES
('e2bc037b97763aa663a7ce416a9ee589', 'a5cbfff5e119130ee6a07137a4eba05d', '19580123', 'Ace Sudarman', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('b116af5eb6185bf02af86c1349b7ca45', '3371df40623a80cd681e810dee241e85', '19871212', 'Ade Firmansyah', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('39a2c920374c2c73a191b34c686cadd0', '4db971c4404e106d8714675fa6d9fe2d', '19831113', 'Agung Darusman', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('9a93ebf65d6f7fb1dfe4665be4db7084', '5b816260589ca6ea644bb55ec031bd51', '19820623', 'Agung Hermawan', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('aff3f0b54c5b8a3a83156c3472e76937', '989801312057d6be1c6ce7354730937d', '19961029', 'ANINDYA TRI YUNITA', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('5d702c0e6bcad75b4538dea4cdb7b437', 'ca6d9b7ed86910d82e587a349912d9e4', '19881228', 'Aris Abdul Aziz', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('6ed464e4fb207aba37ca1be036c8fc43', '785c9bee657be4d813c44d98573b7739', '19691214', 'Asep Kusnadie Wiradinata', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('42cd7883a5e63075b84c95e9d369d07b', 'ef1e59abfd5696b9f554df57d743f162', '19720727', 'Asep Nugraha', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('e2df1c294a9cd69162d6d25b35951cbc', 'f4ed48ce9e5953912126d73b6a7719df', '19790130', 'Dede Soleh Kurnia', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('18af0271586e16df3505a8a153e3c7ad', '91817fae258a613349a2b08c59e108b6', '19910528', 'Devi Kurnia', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('99859c38c485d9151626145d3e98f304', '4e0c0ab26dd50c02d3b65b5daaaf9f6a', '19670726', 'Elly Garniaty', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('789a2865357d3a27141247d791975ec0', '57034d921ca51435d522462bd9f5568c', '19850717', 'Eska Sri Rahayu', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('05d63c734f31783d8daf567c6bf201bb', '0da2a70c31ed39610df0a07339bb24c2', '19600421', 'Garnida Cristiandinata', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('e9124fe418f69a9223a5ca47cc1295d2', 'ac9d41b596bf1a040dedae2a9d16d21f', '19810717', 'Hana Paojiah Nurmilah', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('b6c8f90723028e9fd0ac88265dc44d75', '9f9e3ed288c58c6bc4866eb21835be87', '19890709', 'Hani Laili Kurnia', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('63cd11625498f17cfe675e2c346721dc', '34384a15400afa9396194fe1309f4397', '19900119', 'Hendi Hardianto', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('fb27bb6cab09e1171edaac309dcc2bec', '24c104424c6802c34d173311ce2d0a99', '19791222', 'Heris Mulyana Yogaswara', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('88bec03adf48bd4ab92bec1c23294ed8', 'e1aa926a4e16aabfca97865ca983d9bd', '19950630', 'Herna Novitasari', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('f5cdcf14f68efa983b3da5012bece2d4', '72aab51ffd1ee0834fedf15eb9aaa876', '19900917', 'Hilda Septiani', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('661a3bd9644ff496e144cd680437ba11', '5fd71700fbc1b743aae9578e7663c242', '19881212', 'Inta Ratna Priyantini', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('13f840ffdc692e5f1eb0471e8b457103', '320c3d2669eb1774374056fd29e698fc', '19630924', 'Iwa Kartiwa', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('64d3f374bd7d06a44618771632dfafd9', '7507c9fa938b6bcd42d3bfba9b7c2699', '19690516', 'Jenal Mutakin', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('19d23912de0c2d1e773573919693f61e', '850f47c256e2691ae460e78acdd73c04', '19811008', 'Mohamad Faizal Adha', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('f341b52dd58efcb5cdf9bcdae363a93b', '372fc9ea334b9decd732f10d6ac26c26', '19810407', 'Nurwana', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('fbc1ae76d50212fbce112bf0dd031c3e', '2e76357a332c3907db9eb6d645f9b09d', '19810227', 'Peni Susanty', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('c21754acb7729b151cbd211b63844b2a', 'fa4d7db10a5fed2879ae241ba3b543f5', '19881229', 'Pia Amanda Nurhusni', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('01c2e7fe6b98614a9c70ffbd1aea0c8a', '3066a0edcbd71edf2c742165ffcce1f8', '19800818', 'Popong Wawat Cahyawati', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('ddb3e978ad95be0fe56f86c6085cf85d', 'b3cb8a8b849f31db1e62ec4a414e07f0', '19950302', 'Putri Fitria Sundari', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('11b55c371c257e2a3ee829f31b7ac86e', '9e49ef828ac40a454cdc10914a3c7331', '19930223', 'Retna Fauziah Adhityarini', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('72f6ec9de375a6a0c2b21451031c07a8', '283a2c57ee4a33e4a8d1051edb9c0d04', '19920822', 'Ria Sefria Salsabila', '0000-00-00', '', '', '2019-12-20 10:59:09', '0', '0'),
('bcbd14cb62c7b0f8db88a5c7028740dd', '378deca6c66b4c09f272176a56ff255f', '1', '1', '2019-12-20', '2019-12-20 11:41:43', '2019-12-20 11:41:53', '2019-12-20 11:42:44', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminx`
--
ALTER TABLE `adminx`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `a_profil`
--
ALTER TABLE `a_profil`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `barang_lokasi`
--
ALTER TABLE `barang_lokasi`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_orang`
--
ALTER TABLE `m_orang`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_waktu`
--
ALTER TABLE `m_waktu`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `orang_login`
--
ALTER TABLE `orang_login`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `orang_lokasi`
--
ALTER TABLE `orang_lokasi`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `orang_rekap`
--
ALTER TABLE `orang_rekap`
  ADD PRIMARY KEY (`kd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
