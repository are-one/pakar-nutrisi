-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Agu 2022 pada 15.22
-- Versi server: 5.7.24
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakar_nutrisi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ahli_gizi`
--

CREATE TABLE `ahli_gizi` (
  `id_ahli` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ahli_gizi`
--

INSERT INTO `ahli_gizi` (`id_ahli`, `username`, `password`, `email`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
(1, 'admin', '$2y$13$qKIsNsSlTErdiFsAwNiiz.SmnY5FLu84ir1mDboZHe4kbAHgu7LtK', 'ahli123@gmail.com', 'Ahli Gizi', 'alamat', 'L', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id_diagnosis` int(11) NOT NULL,
  `hasil_diagnosis` text,
  `kondisi` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `pasien_id` int(11) NOT NULL,
  `penyakit_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diagnosis`
--

INSERT INTO `diagnosis` (`id_diagnosis`, `hasil_diagnosis`, `kondisi`, `created_at`, `pasien_id`, `penyakit_id`) VALUES
(7, NULL, NULL, '2022-08-02 14:51:33', 1, 'P03'),
(8, NULL, NULL, '2022-08-02 15:01:59', 1, 'P03'),
(9, NULL, NULL, '2022-08-02 15:03:23', 1, 'P03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `usia_kandungan` varchar(10) DEFAULT NULL,
  `pertambahan_bb` int(11) DEFAULT NULL,
  `hb` varchar(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ahli_gizi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `username`, `password`, `email`, `nama`, `alamat`, `umur`, `usia_kandungan`, `pertambahan_bb`, `hb`, `status`, `ahli_gizi_id`) VALUES
(1, 'pasien1', '$2y$13$0AclVbxgTlhoUGdDaZe7xOh66T4OXe00VFKrBpJakovN.ZwBOh9DG', 'admin@gmail.com', 'Nama orang', 'Kendari', '19', '12', 5, '11', '1', 1),
(3, 'pasien2', '$2y$13$OawPrtzGOb9p7MLxF.OufevaWRqWM5lMDYPjLat7zDngzUNV.cFN2', 'pasien2@gmail.com', 'Pasien2', 'Alamat pasien2', '32', '3', 3, '3', '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengobatan`
--

CREATE TABLE `pengobatan` (
  `id_pengobatan` char(10) NOT NULL,
  `pengobatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengobatan`
--

INSERT INTO `pengobatan` (`id_pengobatan`, `pengobatan`) VALUES
('2', 'Pengobatan 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` char(10) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`) VALUES
('P01', 'Anemia Berat'),
('P02', 'Anemia Sedang'),
('P03', 'Anemia Ringan'),
('P04', 'Normal'),
('P05', 'Hipertensi Ringan'),
('P06', 'Hipertensi Sedang'),
('P07', 'Hipertensi Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit_has_pengobatan`
--

CREATE TABLE `penyakit_has_pengobatan` (
  `penyakit_id` char(10) NOT NULL,
  `pengobatan_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyakit_has_pengobatan`
--

INSERT INTO `penyakit_has_pengobatan` (`penyakit_id`, `pengobatan_id`) VALUES
('P03', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ahli_gizi`
--
ALTER TABLE `ahli_gizi`
  ADD PRIMARY KEY (`id_ahli`);

--
-- Indeks untuk tabel `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id_diagnosis`),
  ADD KEY `fk_diagnosis_pasien1_idx` (`pasien_id`),
  ADD KEY `fk_diagnosis_penyakit1_idx` (`penyakit_id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_pasien_ahli_gizi1_idx` (`ahli_gizi_id`);

--
-- Indeks untuk tabel `pengobatan`
--
ALTER TABLE `pengobatan`
  ADD PRIMARY KEY (`id_pengobatan`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indeks untuk tabel `penyakit_has_pengobatan`
--
ALTER TABLE `penyakit_has_pengobatan`
  ADD PRIMARY KEY (`penyakit_id`,`pengobatan_id`),
  ADD KEY `fk_penyakit_has_pengobatan_pengobatan1_idx` (`pengobatan_id`),
  ADD KEY `fk_penyakit_has_pengobatan_penyakit1_idx` (`penyakit_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ahli_gizi`
--
ALTER TABLE `ahli_gizi`
  MODIFY `id_ahli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id_diagnosis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `fk_diagnosis_pasien1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id_pasien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diagnosis_penyakit1` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `fk_pasien_ahli_gizi1` FOREIGN KEY (`ahli_gizi_id`) REFERENCES `ahli_gizi` (`id_ahli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penyakit_has_pengobatan`
--
ALTER TABLE `penyakit_has_pengobatan`
  ADD CONSTRAINT `fk_penyakit_has_pengobatan_pengobatan1` FOREIGN KEY (`pengobatan_id`) REFERENCES `pengobatan` (`id_pengobatan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penyakit_has_pengobatan_penyakit1` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
