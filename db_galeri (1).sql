-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2024 pada 02.29
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_galeri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `id_album` int(11) UNSIGNED ZEROFILL NOT NULL,
  `namaalbum` varchar(250) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggaldibuat` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `LokasiFile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`id_album`, `namaalbum`, `deskripsi`, `tanggaldibuat`, `id_user`, `LokasiFile`) VALUES
(00000000001, 'otomotif', 'kendaraan bermesin\r\n', '2024-09-22', 0, ''),
(00000000002, 'otomotif', 'sejenisnya', '2024-09-22', 1, ''),
(00000000003, 'seni', 'sjahdglw', '2024-09-22', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_foto`
--

CREATE TABLE `gallery_foto` (
  `id_foto` int(11) NOT NULL,
  `judulfoto` varchar(250) DEFAULT NULL,
  `deskripsifoto` text DEFAULT NULL,
  `tanggalunggah` date DEFAULT NULL,
  `lokasifile` varchar(250) DEFAULT NULL,
  `id_album` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gallery_foto`
--

INSERT INTO `gallery_foto` (`id_foto`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `id_album`, `id_user`) VALUES
(2, 'mobil', 'dugati', '2024-09-22', '2101556584-2.jpg', 1, 0),
(3, 'mobil', 'dugati', '2024-09-22', '266522014-1.jpg', 2, 1),
(4, 'album', 'asdsadd', '2024-09-22', '244399230-3.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `id_komentar` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_foto` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isikomentar` text DEFAULT NULL,
  `tanggalkomentar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefoto`
--

CREATE TABLE `likefoto` (
  `id_like` int(11) UNSIGNED ZEROFILL NOT NULL,
  `id_foto` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggallike` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `likefoto`
--

INSERT INTO `likefoto` (`id_like`, `id_foto`, `id_user`, `tanggallike`) VALUES
(00000000001, 1, 0, '2024-09-22'),
(00000000002, 3, 1, '2024-09-22'),
(00000000003, 4, 3, '2024-09-22'),
(00000000004, 3, 3, '2024-09-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `namalengkap` varchar(250) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `namalengkap`, `alamat`) VALUES
(0000000001, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'abc@gmail.com', '', ''),
(0000000003, 'jono', 'ef9322a1a342a36856e9e8929b19437a', 'jono@gmail.com', 'muhammad jono', 'karenglor');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_foto` (`id_foto`,`id_user`);

--
-- Indeks untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_foto` (`id_foto`,`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `gallery_foto`
--
ALTER TABLE `gallery_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `id_komentar` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `id_like` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
