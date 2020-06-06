-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Jun 2020 pada 13.29
-- Versi Server: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_mahasiswa`
--

CREATE TABLE `calon_mahasiswa` (
  `id_daftar` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `asal_sekolah` varchar(25) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `prodi_pilihan` varchar(100) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `thn_lulus` varchar(50) NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon_mahasiswa`
--

INSERT INTO `calon_mahasiswa` (`id_daftar`, `nama`, `email`, `no_hp`, `asal_sekolah`, `ttl`, `alamat`, `prodi_pilihan`, `jk`, `thn_lulus`, `token`) VALUES
(8, 'Miawati', 'miawati.muda@gmail.com', '087652725712', 'SMK Gracika', '1998-12-12', 'Cideng', '0001', 'Perempuan', '2019', '557997168273619'),
(10, 'Melly Amalia', 'mellyamalia168@gmail.com', '089754542556', 'SMK 1 Sukra', '1998-12-12', 'Patrol', '0002', 'Perempuan', '2020', '987041815102803'),
(11, 'Rizky Alvin', 'rizkyalvin5@gmail.com', '089738728382', 'SMK 1 Cirebon', '1998-12-12', 'Pamengkang', '0001', 'Pria', '2020', '946781064616120'),
(12, 'Kristianto', 'kristiantorpl@gmail.com', '089738728382', 'SMK Al Irsyad Cirebon', '1998-08-08', 'plered', '0002', 'Pria', '2017', '110102199113390'),
(15, 'Farida TA', 'faridatrie3@gmail.com', '08990657546', 'SMK 1 Cirebon', '1999-12-08', 'kalitanjung barat', '0001', 'Perempuan', '2016', '761862213131383');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(6) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'TPA'),
(2, 'Komputer Dasar'),
(3, 'TPS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `nama` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `asal_sekolah` varchar(25) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `prodi_pilihan` varchar(100) NOT NULL,
  `nilai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` varchar(5) NOT NULL,
  `id_soal` varchar(11) NOT NULL,
  `id_camaba` varchar(25) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `tidak_dikerjakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` varchar(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `jurusan`) VALUES
('0001', 'Teknologi Informasi', 'Teknik Informatika'),
('0002', 'Sistem Informasi', 'Komputerisasi Akuntansi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id` int(6) NOT NULL,
  `id_prodi` int(6) NOT NULL,
  `id_fakultas` int(6) NOT NULL,
  `id_kategori` int(6) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `id_prodi`, `id_fakultas`, `id_kategori`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`) VALUES
(11, 1, 1, 1, 'Intermediari', 'Sales\r\n', 'Tidak susah\r\n\r\n', 'Cukup\r\n\r\n', 'Perantara\r\n', 'Terus terang\r\n', 'D', '2013-05-20 00:00:00'),
(12, 1, 1, 1, 'Sederhana\r\n', 'Kompleks\r\n\r\n', 'Simpel\r\n\r\n', 'Banyak', 'Tinggi', 'Mewah', 'A', '2020-05-14 00:00:00'),
(13, 1, 1, 1, 'Fantastis', 'Ampuh', 'Sakti', 'Bagus', 'Luar Biasa', 'Kesenangan', 'D', '2020-05-14 00:00:00'),
(14, 1, 1, 1, 'Mana yang tidak masuk kelompoknya ?', 'Akar', 'Batang', 'Daun', 'Buah', 'Cangkok', 'E', '2020-05-14 00:00:00'),
(15, 1, 1, 1, 'Semua mahasiswa Perguruan Tinggi memiliki Nomor Induk Mahasiswa. Andi seorang mahasiswa. Jadi,', 'Andi mungkin memiliki nomor induk mahasiswa', 'Belum tentu Andi memiliki nomor induk mahasiswa', 'Andi memiliki nomor induk mahasiswa', 'Andi tidak memiliki nomor induk mahasiswa', 'Tidak dapat ditarik kesimpulan', 'C', '2020-05-14 00:00:00'),
(16, 1, 1, 1, '<p>Sebagian orang yang berminat menjadi politikus hanya menginginkan harta dan tahta. Rosyid tidak berminat menjadi politikus.</p>', 'Rosyid tidak menginginkan harta dan tahta.', 'Tahta bukanlah keinginan Rosyid, tapi harta mungkin ya.', 'Rosyid menginginkan tahta tapi tidak berminat menjadi politikus.', 'Rosyid tidak ingin menjadi politikus karena sudah kaya dan punya tahta', 'Tidak dapat ditarik kesimpulan', 'C', '2020-06-05 10:40:18'),
(17, 2, 2, 2, 'Agar perangkat keras dapat berfungsi maka di perlukan …', 'Perangkat lunak', 'Perangkat tambahan', 'Perangkat keluaran', 'Perangkat keras', 'Perangkat masukan', 'A', '2020-05-14 00:00:00'),
(18, 2, 2, 2, 'Tombol … digunakan ketika komputer mengalami hang atau crash.', 'Remote', 'Remove', 'Reset', 'Replace', 'Reserve', 'C', '2020-05-14 00:00:00'),
(19, 2, 2, 2, 'Berikut ini adalah menu yang terdapat pada toolbar atas Microsoft Word, kecuali ...', 'Insert', 'Home', 'References', 'Data', 'Review', 'D', '2020-05-14 00:00:00'),
(27, 1, 1, 1, '<p>hlkHFadad</p>', 'a', 'b', 'c', 'd', 'e', 'B', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '2375ca7dc9ecde4c44d981b68befe65f', 'Administrator'),
(22, 'miawati.muda@gmail.com', '467ea22630138c422f379d5fd9e607c8', 'Mahasiswa'),
(24, 'mellyamalia168@gmail.com', 'a80d18869ea19f4663a61ba09035a958', 'Mahasiswa'),
(25, 'rizkyalvin5@gmail.com', '46183cc33489d90ecdfd8722a94969d4', 'Mahasiswa'),
(26, 'kristiantorpl@gmail.com', '71b8a05a852a9e25ad826d61f2063484', 'Mahasiswa'),
(29, 'faridatrie3@gmail.com', 'fce5769ffa88cd390b891d354153b814', 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calon_mahasiswa`
--
ALTER TABLE `calon_mahasiswa`
  MODIFY `id_daftar` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
