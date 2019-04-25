-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Mar 2019 pada 06.44
-- Versi server: 5.6.39
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k8517903_gain_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_kasbank`
--

CREATE TABLE `account_kasbank` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `account` varchar(255) NOT NULL,
  `uraian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account_kasbank`
--

INSERT INTO `account_kasbank` (`id`, `bank`, `account`, `uraian`) VALUES
(1, 'BRI', 'SAL01', 'Saldo Awal'),
(2, 'BRI', 'K001', 'Drop KB'),
(3, 'KB', 'KK1001', 'Drop Kas Kecil 1'),
(5, 'KB', 'KK2001', 'Drop Kas Kecil 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_kasbesar`
--

CREATE TABLE `account_kasbesar` (
  `id` int(11) NOT NULL,
  `kas` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `area`
--

INSERT INTO `area` (`id`, `area`, `description`) VALUES
(1, 'Medan', 'Service Point'),
(2, 'Makassar', 'Basecamp'),
(3, 'Manado', 'Basecamp'),
(4, 'Jayapura', 'Basecamp'),
(5, 'Palembang', 'Basecamp'),
(6, 'Pekanbaru', 'Basecamp'),
(7, 'Lampung', 'Basecamp'),
(8, 'Batam', 'Basecamp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ba`
--

CREATE TABLE `ba` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `nomor_sr` varchar(255) DEFAULT NULL,
  `tgl_pelunasan` date DEFAULT NULL,
  `dana_pelunasan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `no_po` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `norek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id`, `bank`, `address`, `norek`) VALUES
(1, 'BRI', 'Jakarta', ''),
(2, 'MNC', 'Jakarta', '1233');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `customer`, `description`) VALUES
(1, 'BRI', 'Bank Rakyat Indonesia'),
(2, 'BSM', 'Bank Syariah Mandiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `finish_order_ba`
--

CREATE TABLE `finish_order_ba` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tgl_terima_ba` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `finish_order_ba`
--

INSERT INTO `finish_order_ba` (`id`, `order_id`, `tgl_terima_ba`) VALUES
(1, '1', '2019-03-04'),
(2, '2', '2019-03-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `finish_order_ba_po`
--

CREATE TABLE `finish_order_ba_po` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `tgl_terima_ba` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `finish_order_ba_po`
--

INSERT INTO `finish_order_ba_po` (`id`, `order_id`, `tgl_terima_ba`) VALUES
(1, '3', '2019-03-07'),
(2, '2', '2019-03-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_kerja`
--

CREATE TABLE `hasil_kerja` (
  `id` int(11) NOT NULL,
  `id_order` varchar(255) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `jenis_pekerjaan` varchar(255) DEFAULT NULL,
  `sn_modem` varchar(255) DEFAULT NULL,
  `adaptor` varchar(255) DEFAULT NULL,
  `sn_rft_lama` varchar(255) DEFAULT NULL,
  `sn_rft_baru` varchar(255) DEFAULT NULL,
  `sn_lnb` varchar(255) DEFAULT NULL,
  `hasil_xpoll_cn` varchar(255) DEFAULT NULL,
  `hasil_xpoll_cpi` varchar(255) DEFAULT NULL,
  `hasil_xpoll_asi` varchar(255) DEFAULT NULL,
  `hasil_xpoll_satelit` varchar(255) DEFAULT NULL,
  `pengukuran_listrik` varchar(255) DEFAULT NULL,
  `mounting_antena` varchar(255) DEFAULT NULL,
  `pic_noc` varchar(255) DEFAULT NULL,
  `pic_telkom` varchar(255) DEFAULT NULL,
  `tgl_pekerjaan` varchar(255) DEFAULT NULL,
  `keterangan_pekerjaan` varchar(255) DEFAULT NULL,
  `status_pekerjaan` varchar(255) DEFAULT NULL,
  `mail_to` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_kerja`
--

INSERT INTO `hasil_kerja` (`id`, `id_order`, `order_id`, `lokasi`, `teknisi`, `no_hp`, `jenis_pekerjaan`, `sn_modem`, `adaptor`, `sn_rft_lama`, `sn_rft_baru`, `sn_lnb`, `hasil_xpoll_cn`, `hasil_xpoll_cpi`, `hasil_xpoll_asi`, `hasil_xpoll_satelit`, `pengukuran_listrik`, `mounting_antena`, `pic_noc`, `pic_telkom`, `tgl_pekerjaan`, `keterangan_pekerjaan`, `status_pekerjaan`, `mail_to`) VALUES
(1, '1', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', 'abc', 'Budi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Done', NULL),
(2, '2', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/2', 'abc', 'Budi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Done', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_kerja_po`
--

CREATE TABLE `hasil_kerja_po` (
  `id` int(11) NOT NULL,
  `id_order` varchar(255) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `jenis_pekerjaan` varchar(255) DEFAULT NULL,
  `sn_modem` varchar(255) DEFAULT NULL,
  `adaptor` varchar(255) DEFAULT NULL,
  `sn_rft_lama` varchar(255) DEFAULT NULL,
  `sn_rft_baru` varchar(255) DEFAULT NULL,
  `sn_lnb` varchar(255) DEFAULT NULL,
  `hasil_xpoll_cn` varchar(255) DEFAULT NULL,
  `hasil_xpoll_cpi` varchar(255) DEFAULT NULL,
  `hasil_xpoll_asi` varchar(255) DEFAULT NULL,
  `hasil_xpoll_satelit` varchar(255) DEFAULT NULL,
  `pengukuran_listrik` varchar(255) DEFAULT NULL,
  `mounting_antena` varchar(255) DEFAULT NULL,
  `pic_noc` varchar(255) DEFAULT NULL,
  `pic_telkom` varchar(255) DEFAULT NULL,
  `tgl_pekerjaan` varchar(255) DEFAULT NULL,
  `keterangan_pekerjaan` varchar(255) DEFAULT NULL,
  `status_pekerjaan` varchar(255) DEFAULT NULL,
  `mail_to` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_kerja_po`
--

INSERT INTO `hasil_kerja_po` (`id`, `id_order`, `order_id`, `lokasi`, `teknisi`, `no_hp`, `jenis_pekerjaan`, `sn_modem`, `adaptor`, `sn_rft_lama`, `sn_rft_baru`, `sn_lnb`, `hasil_xpoll_cn`, `hasil_xpoll_cpi`, `hasil_xpoll_asi`, `hasil_xpoll_satelit`, `pengukuran_listrik`, `mounting_antena`, `pic_noc`, `pic_telkom`, `tgl_pekerjaan`, `keterangan_pekerjaan`, `status_pekerjaan`, `mail_to`) VALUES
(1, '3', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'ghi', 'Budi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Done', NULL),
(2, '2', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'def', 'Budi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Done', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `customer_to` varchar(100) DEFAULT NULL,
  `address_customer` varchar(255) DEFAULT NULL,
  `payment_to` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `address_payment` varchar(255) DEFAULT NULL,
  `aproved_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vat` double(2,1) DEFAULT NULL,
  `grand_total` double(100,0) DEFAULT NULL,
  `terbayar` varchar(255) NOT NULL,
  `tgl_terbayar` date DEFAULT NULL,
  `status_kuitansi` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `invoice`, `invoice_number`, `date_invoice`, `customer_to`, `address_customer`, `payment_to`, `bank`, `address_payment`, `aproved_by`, `position`, `vat`, `grand_total`, `terbayar`, `tgl_terbayar`, `status_kuitansi`) VALUES
(1, 'GAIN/SAT/III.19/INV-', '001', '2019-03-04', 'PT. SATKOMINDO', 'Jl. RS Fatmawati  No.1 RT.002 RW.008, Cilandak Barat', 'PT. Global Abadi Inti Nusantara', 'BRI', 'Jakarta', 'Kunthi', 'Direktur', 0.1, 1300000, 'Lunas', '2019-03-04', 'YES');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `orders` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `dana_kontrak` double(100,0) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sr_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `orders`, `invoice`, `dana_kontrak`, `date_invoice`, `site`, `description`, `sr_number`) VALUES
(1, '1', 'GAIN/SAT/III.19/INV-001', 1300000, '2019-03-04', 'abc', 'Instalasi Antena 1.8m', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail_po`
--

CREATE TABLE `invoice_detail_po` (
  `id` int(11) NOT NULL,
  `orders` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `dana_kontrak` double(100,0) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sr_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_detail_po`
--

INSERT INTO `invoice_detail_po` (`id`, `orders`, `invoice`, `dana_kontrak`, `date_invoice`, `site`, `description`, `sr_number`) VALUES
(1, '2', 'GAIN/SAT/III.19/INV-001', 10000000, '2019-03-07', 'def', 'Instalasi Antena 1.8m', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail_rembust`
--

CREATE TABLE `invoice_detail_rembust` (
  `id` int(11) NOT NULL,
  `idRembust` varchar(255) DEFAULT NULL,
  `invoice_rembust` varchar(255) DEFAULT NULL,
  `dana_rembust` double(100,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_detail_rembust`
--

INSERT INTO `invoice_detail_rembust` (`id`, `idRembust`, `invoice_rembust`, `dana_rembust`) VALUES
(1, '2', 'GAIN/SAT/III.19/INV-001A', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail_rembust_po`
--

CREATE TABLE `invoice_detail_rembust_po` (
  `id` int(11) NOT NULL,
  `idRembust` varchar(255) DEFAULT NULL,
  `invoice_rembust` varchar(255) DEFAULT NULL,
  `dana_rembust` double(100,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_po`
--

CREATE TABLE `invoice_po` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `customer_to` varchar(100) DEFAULT NULL,
  `address_customer` varchar(255) DEFAULT NULL,
  `payment_to` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `address_payment` varchar(255) DEFAULT NULL,
  `aproved_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vat` double(2,1) DEFAULT NULL,
  `grand_total` double(100,0) DEFAULT NULL,
  `terbayar` varchar(255) NOT NULL,
  `tgl_terbayar` date DEFAULT NULL,
  `nomor_inv_po` varchar(255) DEFAULT NULL,
  `status_kuitansi` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_po`
--

INSERT INTO `invoice_po` (`id`, `invoice`, `invoice_number`, `date_invoice`, `customer_to`, `address_customer`, `payment_to`, `bank`, `address_payment`, `aproved_by`, `position`, `vat`, `grand_total`, `terbayar`, `tgl_terbayar`, `nomor_inv_po`, `status_kuitansi`) VALUES
(1, 'GAIN/SAT/III.19/INV-', '001', '2019-03-07', 'PT. SATKOMINDO', 'Jl. RS Fatmawati  No.1 RT.002 RW.008, Cilandak Barat', 'PT. Global Abadi Inti Nusantara', 'MNC', 'Jakarta', 'Kunthi', 'Direktur', 0.1, 10000000, 'Lunas', '2019-03-07', 'sasdf', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_rembust`
--

CREATE TABLE `invoice_rembust` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `invoice_rembust` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `customer_to` varchar(100) DEFAULT NULL,
  `address_customer` varchar(255) DEFAULT NULL,
  `payment_to` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `address_payment` varchar(255) DEFAULT NULL,
  `aproved_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vat` double(2,1) DEFAULT NULL,
  `grand_total` double(100,0) DEFAULT NULL,
  `terbayar` varchar(255) NOT NULL,
  `tgl_terbayar` date DEFAULT NULL,
  `status_kuitansi` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_rembust`
--

INSERT INTO `invoice_rembust` (`id`, `invoice`, `invoice_rembust`, `invoice_number`, `date_invoice`, `customer_to`, `address_customer`, `payment_to`, `bank`, `address_payment`, `aproved_by`, `position`, `vat`, `grand_total`, `terbayar`, `tgl_terbayar`, `status_kuitansi`) VALUES
(1, '1', 'GAIN/SAT/III.19/INV-001A', '001', '2019-03-04', 'PT. SATKOMINDO', 'Jl. RS Fatmawati  No.1 RT.002 RW.008, Cilandak Barat', 'PT. Global Abadi Inti Nusantara', 'BRI', 'Jakarta', 'Kunthi', 'Direktur', 0.0, 200000, 'Lunas', '2019-03-04', 'YES');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_rembust_po`
--

CREATE TABLE `invoice_rembust_po` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `invoice_rembust` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `date_invoice` date DEFAULT NULL,
  `customer_to` varchar(100) DEFAULT NULL,
  `address_customer` varchar(255) DEFAULT NULL,
  `payment_to` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `address_payment` varchar(255) DEFAULT NULL,
  `aproved_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `vat` double(2,1) DEFAULT NULL,
  `grand_total` double(100,0) DEFAULT NULL,
  `terbayar` varchar(255) NOT NULL,
  `tgl_terbayar` date DEFAULT NULL,
  `nomor_inv_po` varchar(255) DEFAULT NULL,
  `status_kuitansi` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `job` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `job`
--

INSERT INTO `job` (`id`, `job`, `description`) VALUES
(1, 'Instalasi Antena 1.8m', 'Pemasangan antena & modem VSAT'),
(2, 'Corrective Maintenance', 'Troubleshooting Problem Komunikasi Vsat'),
(3, 'Relokasi', 'Pindah Lokasi ATM'),
(4, 'Dismantle', 'Pembongkaran antena & modem VSAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasbank`
--

CREATE TABLE `kasbank` (
  `id` int(11) NOT NULL,
  `id_invoice` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `tgl` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasbank`
--

INSERT INTO `kasbank` (`id`, `id_invoice`, `account`, `bank`, `uraian`, `tgl`, `debit`, `kredit`, `keterangan`) VALUES
(1, NULL, 'SAL01', 'BRI', NULL, '2019-03-04', '10000000', '0', ''),
(2, NULL, 'K001', 'BRI', NULL, '', '0', '5000000', ''),
(3, '1', 'PAID', 'BRI', 'PT. SATKOMINDO', '2019-03-04', '200000', '0', 'GAIN/SAT/III.19/INV-001A'),
(4, '1', 'PAID', 'BRI', 'PT. SATKOMINDO', '2019-03-04', '1430000', '0', 'GAIN/SAT/III.19/INV-001'),
(5, '1', 'PAID', 'MNC', 'PT. SATKOMINDO', '2019-03-07', '11000000', '0', 'GAIN/SAT/III.19/INV-001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasbesar`
--

CREATE TABLE `kasbesar` (
  `id` int(11) NOT NULL,
  `id_kasbank` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kas` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasbesar`
--

INSERT INTO `kasbesar` (`id`, `id_kasbank`, `account`, `bank`, `uraian`, `tgl`, `kas`, `debit`, `kredit`, `keterangan`) VALUES
(1, '2', 'K001', 'BRI', '', '0000-00-00', NULL, '5000000', '0', 'BRI'),
(2, NULL, 'KK1001', NULL, NULL, '2019-03-04', 'KK 1', '0', '4000000', ''),
(3, NULL, 'KK2001', NULL, NULL, '2019-03-07', 'KK 2', '0', '1000000', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kaskecil`
--

CREATE TABLE `kaskecil` (
  `id` int(11) NOT NULL,
  `id_rembust` varchar(255) DEFAULT NULL,
  `id_pelunasan` varchar(255) DEFAULT NULL,
  `id_kasbesar` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `kas` varchar(255) DEFAULT NULL,
  `tgl` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kaskecil`
--

INSERT INTO `kaskecil` (`id`, `id_rembust`, `id_pelunasan`, `id_kasbesar`, `account`, `uraian`, `site`, `kas`, `tgl`, `debit`, `kredit`, `keterangan`) VALUES
(1, NULL, NULL, '2', 'KK1001', NULL, NULL, 'KK 1', '2019-03-04', '4000000', '0', ''),
(2, '1', NULL, NULL, 'Non Rembust', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', 'abc', 'KK 1', '2019-03-04', '0', '300000', 'panjar paket'),
(3, '2', NULL, NULL, 'Rembust', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', 'abc', 'KK 1', '2019-03-04', '0', '200000', 'modif tiang'),
(4, NULL, '1', NULL, 'LN', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', 'abc', 'KK 1', '2019-03-04', '0', '150000', 'lunas paket'),
(5, NULL, NULL, '3', 'KK2001', NULL, NULL, 'KK 2', '2019-03-07', '1000000', '0', ''),
(6, '3', NULL, NULL, 'Non Rembust', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'ghi', 'KK 2', '2019-03-07', '0', '200000', 'panjar paket'),
(7, '4', NULL, NULL, 'Non Rembust', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'def', 'KK 2', '2019-03-07', '0', '200000', 'panjar paket'),
(8, '5', NULL, NULL, 'Non Rembust', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'abc', 'KK 2', '2019-03-07', '0', '200000', 'panjar paket'),
(9, NULL, '1', NULL, 'LN', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'ghi', 'KK 2', '2019-03-07', '0', '100000', 'lunas paket'),
(10, NULL, '2', NULL, 'LN', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'def', 'KK 2', '2019-03-07', '0', '100000', 'lunas paket'),
(11, '6', NULL, NULL, 'Non Rembust', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/2', 'abc', 'KK 1', '2019-03-07', '0', '200000', 'panjar paket'),
(12, NULL, '2', NULL, 'LN', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/2', 'abc', 'KK 1', '2019-03-07', '0', '100000', 'lunas paket'),
(13, '7', NULL, NULL, 'Non Rembust', 'R/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'nilo test 9 maret 2019', 'KK 1', '2019-03-17', '0', '150000', 'Beli Kabel'),
(14, '8', NULL, NULL, 'Rembust', 'R/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', 'nilo test 9 maret 2019', 'KK 1', '2019-03-17', '0', '150000', 'Beli Kabel listrik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuitansi_invoice`
--

CREATE TABLE `kuitansi_invoice` (
  `id` int(3) NOT NULL,
  `id_invoice` int(3) NOT NULL,
  `no_kuitansi` varchar(100) NOT NULL,
  `pembayaran` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kuitansi_invoice`
--

INSERT INTO `kuitansi_invoice` (`id`, `id_invoice`, `no_kuitansi`, `pembayaran`) VALUES
(1, 1, 'GAIN/SAT/III.19/KUI-001', 'Paket');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuitansi_invoice_po`
--

CREATE TABLE `kuitansi_invoice_po` (
  `id` int(3) NOT NULL,
  `id_invoice` int(3) NOT NULL,
  `no_kuitansi` varchar(100) NOT NULL,
  `pembayaran` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuitansi_invoice_po_rembust`
--

CREATE TABLE `kuitansi_invoice_po_rembust` (
  `id` int(3) NOT NULL,
  `id_invoice_rembust` int(3) NOT NULL,
  `no_kuitansi` varchar(100) NOT NULL,
  `pembayaran` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuitansi_invoice_rembust`
--

CREATE TABLE `kuitansi_invoice_rembust` (
  `id` int(3) NOT NULL,
  `id_invoice_rembust` int(3) NOT NULL,
  `no_kuitansi` varchar(100) NOT NULL,
  `pembayaran` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kuitansi_invoice_rembust`
--

INSERT INTO `kuitansi_invoice_rembust` (`id`, `id_invoice_rembust`, `no_kuitansi`, `pembayaran`) VALUES
(1, 1, 'GAIN/SAT/III.19/KUI-001A', 'reiumbust');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelunasan`
--

CREATE TABLE `pelunasan` (
  `id` int(11) NOT NULL,
  `Order_ID` varchar(100) DEFAULT NULL,
  `tgl_pelunasan` date DEFAULT NULL,
  `nominal` double(50,0) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `rekening` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelunasan`
--

INSERT INTO `pelunasan` (`id`, `Order_ID`, `tgl_pelunasan`, `nominal`, `deskripsi`, `rekening`) VALUES
(1, '1', '2019-03-04', 150000, 'lunas paket', 'KK 1'),
(2, '2', '2019-03-07', 100000, 'lunas paket', 'KK 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelunasan_po`
--

CREATE TABLE `pelunasan_po` (
  `id` int(11) NOT NULL,
  `Order_ID` varchar(100) DEFAULT NULL,
  `tgl_pelunasan` date DEFAULT NULL,
  `nominal` double(50,0) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `rekening` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelunasan_po`
--

INSERT INTO `pelunasan_po` (`id`, `Order_ID`, `tgl_pelunasan`, `nominal`, `deskripsi`, `rekening`) VALUES
(1, '3', '2019-03-07', 100000, 'lunas paket', 'KK 2'),
(2, '2', '2019-03-07', 100000, 'lunas paket', 'KK 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `Tlp` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `nilai_vat` double(1,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `kode`, `perusahaan`, `alamat`, `Tlp`, `vat`, `nilai_vat`) VALUES
(1, 'SAT', 'PT. SATKOMINDO', 'Jl. RS Fatmawati  No.1 RT.002 RW.008, Cilandak Barat', NULL, 'PPN 10%', 0.1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppn`
--

CREATE TABLE `ppn` (
  `id` int(11) NOT NULL,
  `PPN` varchar(255) DEFAULT NULL,
  `Deskripsi` double(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ppn`
--

INSERT INTO `ppn` (`id`, `PPN`, `Deskripsi`) VALUES
(1, 'Non PPN', 0.00),
(2, 'PPN 10%', 0.10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rembust`
--

CREATE TABLE `rembust` (
  `id` int(3) NOT NULL,
  `id_order` varchar(255) DEFAULT NULL,
  `Order_ID` varchar(255) DEFAULT NULL,
  `Tgl_request` varchar(255) DEFAULT NULL,
  `RembustID` varchar(255) DEFAULT NULL,
  `Site` varchar(255) DEFAULT NULL,
  `Deskripsi` varchar(255) DEFAULT NULL,
  `Dana_Rembust` double(50,0) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `Kas` varchar(255) DEFAULT NULL,
  `invoice_rembust` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rembust`
--

INSERT INTO `rembust` (`id`, `id_order`, `Order_ID`, `Tgl_request`, `RembustID`, `Site`, `Deskripsi`, `Dana_Rembust`, `status`, `Kas`, `invoice_rembust`) VALUES
(1, '1', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', '2019-03-04', 'Non Rembust', 'abc', 'panjar paket', 300000, 'Invoiced', 'KK 1', 'GAIN/SAT/III.19/INV-001'),
(2, '1', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/1', '2019-03-04', 'Rembust', 'abc', 'modif tiang', 200000, 'Invoiced', 'KK 1', 'GAIN/SAT/III.19/INV-001'),
(3, '3', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', '2019-03-07', 'Non Rembust', 'ghi', 'panjar paket', 200000, '', 'KK 2', 'GAIN/SAT/III.19/INV-001'),
(4, '2', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', '2019-03-07', 'Non Rembust', 'def', 'panjar paket', 200000, '', 'KK 2', 'GAIN/SAT/III.19/INV-001'),
(5, '1', 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', '2019-03-07', 'Non Rembust', 'abc', 'panjar paket', 200000, '', 'KK 2', 'GAIN/SAT/III.19/INV-001'),
(6, '2', 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/2', '2019-03-07', 'Non Rembust', 'abc', 'panjar paket', 200000, '', 'KK 1', NULL),
(7, '3', 'R/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', '2019-03-17', 'Non Rembust', 'nilo test 9 maret 2019', 'Beli Kabel', 150000, '', 'KK 1', NULL),
(8, '3', 'R/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/1', '2019-03-17', 'Rembust', 'nilo test 9 maret 2019', 'Beli Kabel listrik', 150000, '', 'KK 1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sr_number`
--

CREATE TABLE `sr_number` (
  `id` int(11) NOT NULL,
  `Order_ID` varchar(100) DEFAULT NULL,
  `sr_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sr_number`
--

INSERT INTO `sr_number` (`id`, `Order_ID`, `sr_number`) VALUES
(1, '1', 'abc'),
(2, '2', 'abc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sr_number_po`
--

CREATE TABLE `sr_number_po` (
  `id` int(11) NOT NULL,
  `Order_ID` varchar(100) DEFAULT NULL,
  `sr_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sr_number_po`
--

INSERT INTO `sr_number_po` (`id`, `Order_ID`, `sr_number`) VALUES
(1, '3', 'abc'),
(2, '2', 'abc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `jabatan` varchar(100) NOT NULL,
  `staff_create` varchar(25) NOT NULL,
  `staff_update` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id_staff`, `nama`, `password`, `jabatan`, `staff_create`, `staff_update`, `status`, `image`, `class`) VALUES
(1, 'Admin', '4dm1n', 'SA', '2019-03-02 00:00:00', '2019-03-04 03:33:05', 'Login', 'profile1.png', 'label-success label label-default'),
(6, 'Cus', 'cus', 'C', '2019-03-04 03:46:31', '', 'Log out', 'profile_user.jpg', 'label-default label label-danger'),
(12, 'Manager Operasional', 'managero', 'MO', '2019-03-05 02:03:06', '', 'Log out', 'manager.png', 'label-default label label-danger'),
(13, 'Admin Operasional', 'admino', 'AO', '2019-03-05 02:03:24', '', 'Log out', 'profile1.png', 'label-default label label-danger'),
(14, 'Manager Keuangan', 'managerk', 'MK', '2019-03-05 02:03:38', '', 'Log out', 'manager.png', 'label-default label label-danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `system` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `system`
--

INSERT INTO `system` (`id`, `system`, `description`) VALUES
(1, 'VSAT', 'VSAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `noUrut` int(3) DEFAULT NULL,
  `retails_po` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `system` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `start_progress` date DEFAULT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `dana_kontrak` double(50,0) DEFAULT NULL,
  `stop_progress` varchar(255) DEFAULT NULL,
  `tgl_ba_terima` varchar(255) DEFAULT NULL,
  `status_order` varchar(255) DEFAULT NULL,
  `req_dana` double(100,0) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `opsi` varchar(255) DEFAULT NULL,
  `hasil_kerja` varchar(255) DEFAULT NULL,
  `sr_number` varchar(100) DEFAULT NULL,
  `status_srnumber` varchar(2) DEFAULT NULL,
  `pelunasan` varchar(255) DEFAULT NULL,
  `status_invoice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `order_id`, `noUrut`, `retails_po`, `user`, `customer`, `site`, `job`, `system`, `area`, `start_progress`, `teknisi`, `dana_kontrak`, `stop_progress`, `tgl_ba_terima`, `status_order`, `req_dana`, `date_order`, `opsi`, `hasil_kerja`, `sr_number`, `status_srnumber`, `pelunasan`, `status_invoice`) VALUES
(1, 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/', 1, 'R', 'SAT', 'BRI', 'abc', 'Instalasi Antena 1.8m', 'VSAT', 'Makassar', '2019-03-04', 'Budi', 1300000, '2019-03-04', '2019-03-04', 'Finish Progress Order', NULL, '2019-03-04', 'Edit Hasil Kerja', 'Done', 'SR Number', '2', 'LUNAS', 'GAIN/SAT/III.19/INV-001'),
(2, 'R/SAT/Instalasi Antena 1.8m/VSAT/Makassar/19/III/', 2, 'R', 'SAT', 'BRI', 'abc', 'Instalasi Antena 1.8m', 'VSAT', 'Makassar', '2019-03-07', 'Budi', 1300000, '2019-03-07', '2019-03-07', 'Finish Progress Order', NULL, '2019-03-07', 'Edit Hasil Kerja', 'Done', 'SR Number', '2', 'LUNAS', ''),
(4, 'R/SAT/Corrective Maintenance/VSAT/Makassar/19/III/', 1, 'R', 'SAT', 'BRI', 'BRI ATM_TAKALAR_SPBU BRONTO NOMPO EX ALFAMART SAT TIKKOLA DG NGGALLE', 'Corrective Maintenance', 'VSAT', 'Makassar', '2019-03-14', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(5, 'R/SAT/Relokasi/VSAT/Palembang/19/III/', 1, 'R', 'SAT', 'BRI', 'PALEMBANG KAYUAGUNG PASAR INDRALAYA', 'Relokasi', 'VSAT', 'Palembang', '2019-01-03', 'Nata', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(7, 'R/SAT/Relokasi/VSAT/Palembang/19/III/', 2, 'R', 'SAT', 'BRI', 'ATM OFFSITE INDOMARET FAJAR BULAN TID 59415', 'Relokasi', 'VSAT', 'Palembang', '2019-03-13', 'Joko', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(8, 'R/SAT/Corrective Maintenance/VSAT/Makassar/19/III/', 2, 'R', 'SAT', 'BRI', 'BRI KANCA_MKS_TUAL_SAUM LAKI', 'Corrective Maintenance', 'VSAT', 'Makassar', '2019-03-13', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(9, 'R/SAT/Corrective Maintenance/VSAT/Manado/19/III/', 1, 'R', 'SAT', 'BRI', 'BRISAT_BRI UNIT MDO_TONDANO_NAMLEA', 'Corrective Maintenance', 'VSAT', 'Manado', '2019-03-12', 'Tomi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(10, 'R/SAT/Corrective Maintenance/VSAT/Jayapura/19/III/', 1, 'R', 'SAT', 'BRI', 'BRI ATM JYP_JAYAPURA_PELABUHAN JAYAPURA', 'Corrective Maintenance', 'VSAT', 'Jayapura', '2019-02-20', 'Amin', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(11, 'R/SAT/Corrective Maintenance/VSAT/Jayapura/19/III/', 2, 'R', 'SAT', 'BRI', 'BRI UNIT JYP_SORONG_FAKFAK', 'Corrective Maintenance', 'VSAT', 'Jayapura', '2019-02-20', 'Amin', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(12, 'R/SAT/Corrective Maintenance/VSAT/Manado/19/III/', 2, 'R', 'SAT', 'BRI', 'BRI ATM_MDO_TERNATE_KANTOR WALIKOTA', 'Corrective Maintenance', 'VSAT', 'Manado', '2019-03-12', 'Tomi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(13, 'R/SAT/Corrective Maintenance/VSAT/Batam/19/III/', 1, 'R', 'SAT', 'BSM', 'BSM ATM BTM_SWALAYAN ZOOM EX SPBU SUKABERENANG', 'Corrective Maintenance', 'VSAT', 'Batam', '2019-03-12', 'Usman', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(14, 'R/SAT/Relokasi/VSAT/Makassar/19/III/', 1, 'R', 'SAT', 'BRI', 'MAKASSAR PINRANG SPBU BRIPTU SUHERMAN TID 650230', 'Relokasi', 'VSAT', 'Makassar', '2019-02-27', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(15, 'R/SAT/Corrective Maintenance/VSAT/Makassar/19/III/', 3, 'R', 'SAT', 'BRI', 'BRI ATM_MAKASAR_AMBON_ASDP GALALA', 'Corrective Maintenance', 'VSAT', 'Makassar', '2019-03-06', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(16, 'R/SAT/Corrective Maintenance/VSAT/Makassar/19/III/', 4, 'R', 'SAT', 'BRI', 'BRI_ATM_MAKASAR_MASAMBA_SUMASANG', 'Corrective Maintenance', 'VSAT', 'Makassar', '2019-03-06', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, ''),
(17, 'R/SAT/Corrective Maintenance/VSAT/Makassar/19/III/', 5, 'R', 'SAT', 'BRI', 'BRI UNIT MKS_PABAENG-BAENG', 'Corrective Maintenance', 'VSAT', 'Makassar', '2019-03-04', 'Budi', 0, NULL, NULL, 'Progress Order', NULL, '2019-03-18', NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order_po`
--

CREATE TABLE `tbl_order_po` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `noUrut` int(3) DEFAULT NULL,
  `retails_po` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `system` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `start_progress` date DEFAULT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `dana_kontrak` double(50,0) DEFAULT NULL,
  `stop_progress` varchar(255) DEFAULT NULL,
  `tgl_ba_terima` varchar(255) DEFAULT NULL,
  `status_order` varchar(255) DEFAULT NULL,
  `req_dana` double(100,0) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `opsi` varchar(255) DEFAULT NULL,
  `hasil_kerja` varchar(255) DEFAULT NULL,
  `sr_number` varchar(100) DEFAULT NULL,
  `status_srnumber` varchar(2) DEFAULT NULL,
  `pelunasan` varchar(255) DEFAULT NULL,
  `status_invoice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_order_po`
--

INSERT INTO `tbl_order_po` (`id`, `order_id`, `noUrut`, `retails_po`, `user`, `customer`, `site`, `job`, `system`, `area`, `start_progress`, `teknisi`, `dana_kontrak`, `stop_progress`, `tgl_ba_terima`, `status_order`, `req_dana`, `date_order`, `opsi`, `hasil_kerja`, `sr_number`, `status_srnumber`, `pelunasan`, `status_invoice`) VALUES
(1, 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/', 1, 'PO', 'SAT', 'BRI', 'abc', 'Instalasi Antena 1.8m', 'VSAT', 'Medan', '2019-03-07', 'Budi', 10000000, '2019-03-07', NULL, 'Finish Progress Order', NULL, '2019-03-07', 'Hasil Kerja', NULL, NULL, NULL, NULL, 'GAIN/SAT/III.19/INV-001'),
(2, 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/', 1, 'PO', 'SAT', 'BRI', 'def', 'Instalasi Antena 1.8m', 'VSAT', 'Medan', '2019-03-07', 'Budi', 10000000, '2019-03-07', '2019-03-07', 'Finish Progress Order', NULL, '2019-03-07', 'Edit Hasil Kerja', 'Done', 'SR Number', '2', 'LUNAS', 'GAIN/SAT/III.19/INV-001'),
(3, 'PO/SAT/Instalasi Antena 1.8m/VSAT/Medan/19/III/', 1, 'PO', 'SAT', 'BRI', 'ghi', 'Instalasi Antena 1.8m', 'VSAT', 'Medan', '2019-03-07', 'Budi', 10000000, '2019-03-07', '2019-03-07', 'Finish Progress Order', NULL, '2019-03-07', 'Edit Hasil Kerja', 'Done', 'SR Number', '2', 'LUNAS', 'GAIN/SAT/III.19/INV-001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`id`, `teknisi`, `no_hp`) VALUES
(1, 'Budi', '082350555560'),
(2, 'Amin', '083836920890'),
(3, 'Tomi', '087777823469'),
(4, 'Nata', '081396213364'),
(5, 'Usman', '085264651204'),
(6, 'Joko', '085266666595'),
(7, 'Bambang', '081370284562'),
(8, 'Saefudin', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account_kasbank`
--
ALTER TABLE `account_kasbank`
  ADD PRIMARY KEY (`id`,`account`) USING BTREE;

--
-- Indeks untuk tabel `account_kasbesar`
--
ALTER TABLE `account_kasbesar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ba`
--
ALTER TABLE `ba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `finish_order_ba`
--
ALTER TABLE `finish_order_ba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `finish_order_ba_po`
--
ALTER TABLE `finish_order_ba_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_kerja`
--
ALTER TABLE `hasil_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_kerja_po`
--
ALTER TABLE `hasil_kerja_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_detail_po`
--
ALTER TABLE `invoice_detail_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_detail_rembust`
--
ALTER TABLE `invoice_detail_rembust`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_detail_rembust_po`
--
ALTER TABLE `invoice_detail_rembust_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_po`
--
ALTER TABLE `invoice_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_rembust`
--
ALTER TABLE `invoice_rembust`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice_rembust_po`
--
ALTER TABLE `invoice_rembust_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kasbank`
--
ALTER TABLE `kasbank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kasbesar`
--
ALTER TABLE `kasbesar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kaskecil`
--
ALTER TABLE `kaskecil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuitansi_invoice`
--
ALTER TABLE `kuitansi_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuitansi_invoice_po`
--
ALTER TABLE `kuitansi_invoice_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuitansi_invoice_po_rembust`
--
ALTER TABLE `kuitansi_invoice_po_rembust`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuitansi_invoice_rembust`
--
ALTER TABLE `kuitansi_invoice_rembust`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelunasan_po`
--
ALTER TABLE `pelunasan_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppn`
--
ALTER TABLE `ppn`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rembust`
--
ALTER TABLE `rembust`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sr_number`
--
ALTER TABLE `sr_number`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sr_number_po`
--
ALTER TABLE `sr_number_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`,`order_id`);

--
-- Indeks untuk tabel `tbl_order_po`
--
ALTER TABLE `tbl_order_po`
  ADD PRIMARY KEY (`id`,`order_id`);

--
-- Indeks untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account_kasbank`
--
ALTER TABLE `account_kasbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `account_kasbesar`
--
ALTER TABLE `account_kasbesar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ba`
--
ALTER TABLE `ba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `finish_order_ba`
--
ALTER TABLE `finish_order_ba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `finish_order_ba_po`
--
ALTER TABLE `finish_order_ba_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil_kerja`
--
ALTER TABLE `hasil_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil_kerja_po`
--
ALTER TABLE `hasil_kerja_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail_po`
--
ALTER TABLE `invoice_detail_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail_rembust`
--
ALTER TABLE `invoice_detail_rembust`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail_rembust_po`
--
ALTER TABLE `invoice_detail_rembust_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoice_po`
--
ALTER TABLE `invoice_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_rembust`
--
ALTER TABLE `invoice_rembust`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_rembust_po`
--
ALTER TABLE `invoice_rembust_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kasbank`
--
ALTER TABLE `kasbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kasbesar`
--
ALTER TABLE `kasbesar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kaskecil`
--
ALTER TABLE `kaskecil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kuitansi_invoice`
--
ALTER TABLE `kuitansi_invoice`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kuitansi_invoice_po`
--
ALTER TABLE `kuitansi_invoice_po`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuitansi_invoice_po_rembust`
--
ALTER TABLE `kuitansi_invoice_po_rembust`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuitansi_invoice_rembust`
--
ALTER TABLE `kuitansi_invoice_rembust`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelunasan_po`
--
ALTER TABLE `pelunasan_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ppn`
--
ALTER TABLE `ppn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rembust`
--
ALTER TABLE `rembust`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sr_number`
--
ALTER TABLE `sr_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sr_number_po`
--
ALTER TABLE `sr_number_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_order_po`
--
ALTER TABLE `tbl_order_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
