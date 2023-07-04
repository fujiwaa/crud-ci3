-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jan 2023 pada 14.05
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `table_user`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat_dosen` varchar(225) NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nama_dosen`, `jenis_kelamin`, `alamat_dosen`, `nip`) VALUES
(1, 'Firman Asharudin, M.Kom', 'Pria', 'Jl. Palagan', '15.01.2892'),
(2, 'Hastari Utama, M.Kom', 'Pria', 'Jl. Palagan', '15.01.2901'),
(3, 'Ahlihi Masruro, M.Kom', 'Pria', 'Jl. Tajem', '15.01.2905'),
(4, 'Dwi Rahayu', 'Wanita', 'Jl. Ambarukmo', '18.01.2819'),
(5, 'Farid', 'Pria', 'Jl. Tambakboyo', '15.01.8620'),
(97, 'Hanif Al Fatta, M.Kom', 'Pria', 'Jl. Magelang', '15.02.2922'),
(98, 'Barka Satya, M.Kom', 'Pria', 'Jl. Prambanan', '15.01.2952'),
(99, 'Firman, M.Kom', 'Pria', 'Jl. Kaliurang', '15.01.2793');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fakultas`
--

CREATE TABLE `tb_fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `id_dekan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_fakultas`
--

INSERT INTO `tb_fakultas` (`id`, `nama`, `id_dekan`) VALUES
(1, 'Fakultas Ilmu Komputer', 97);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(128) NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matkul`
--

INSERT INTO `tb_matkul` (`id`, `id_dosen`, `kode_matkul`, `nama_matkul`, `id_prodi`) VALUES
(1, 1, 'DT01', 'Perancangan Web 2', 1),
(2, 1, 'DT02', 'Pengolahan Basis Data', 1),
(3, 1, 'DT03', 'Struktur Data', 1),
(4, 1, 'DT04', 'Multimedia', 1),
(5, 1, 'DT05', 'Success Skill', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `nama_prodi` varchar(128) NOT NULL,
  `kaprodi` int(15) NOT NULL,
  `sekprodi` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `id_fakultas`, `nama_prodi`, `kaprodi`, `sekprodi`) VALUES
(1, 1, 'D3 Teknik Informatika', 98, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rps`
--

CREATE TABLE `tb_rps` (
  `id` int(11) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `tanggal_berlaku` date NOT NULL,
  `tanggal_disusun` date NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_pembuat` int(11) NOT NULL,
  `revisi` varchar(5) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `bobot_sks` varchar(10) NOT NULL,
  `detail_penilaian` varchar(128) NOT NULL,
  `gambaran_umum` text NOT NULL,
  `capaian` text NOT NULL,
  `prasyarat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rps`
--

INSERT INTO `tb_rps` (`id`, `nomor`, `tanggal_berlaku`, `tanggal_disusun`, `id_matkul`, `id_pembuat`, `revisi`, `semester`, `bobot_sks`, `detail_penilaian`, `gambaran_umum`, `capaian`, `prasyarat`) VALUES
(16, 'RPS-DT02', '2023-01-22', '2023-01-22', 2, 2, '00', '3', '24', '<p>d;oskaldjas</p>', '<p>dlkjsaldjaslk</p>', '<p>lkdsjalkdjas</p>', '<p>ldjsalkdjaslq</p>'),
(19, 'RPS-DT03', '2023-01-23', '2023-01-23', 3, 3, '00', '3', '24', '<p>jdsankjdsakj</p>', '<p>kdjsakdah</p>', '<p>dksajhdkjash</p>', '<p>dsahdjkashkj</p>'),
(22, 'RPS-DT04', '2023-01-23', '2023-01-23', 4, 4, '00', '3', '24', '<p>ldjsalkjasdlk</p>', '<p>ldjsalkjdaslkj</p>', '<p>lkdjslkjdalkjdkl</p>', '<p>jkldsjdlkasjlkasjd</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rps_detail`
--

CREATE TABLE `tb_rps_detail` (
  `id` int(11) NOT NULL,
  `id_rps` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `kemampuan_akhir` text NOT NULL,
  `indikator` text NOT NULL,
  `topik` text NOT NULL,
  `aktivitas_pembelajaran` text NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `penilaian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rps_detail`
--

INSERT INTO `tb_rps_detail` (`id`, `id_rps`, `minggu`, `kemampuan_akhir`, `indikator`, `topik`, `aktivitas_pembelajaran`, `waktu`, `penilaian`) VALUES
(1, 1, 1, 'Memahami komponen penyusun perangkat komputer dan troubleshooting perangkat komputer', 'Mahasiswa mengetahui tentang RPS dan kontrak pelajar', 'Perkenalan dan penjelasan RPS', 'Mahasiswa dapat mengetahui rencana pembelajaran dan kontrak belajar untuk satu semester', '100 menit', 'Praktikum (1%)'),
(2, 13, 1, 'dsadas', 'dadasasfas', 'dsadas', 'adasda', 'dasasd', 'asdas'),
(3, 13, 2, 'dsadas', 'dadasasfas', 'dsadas', 'adasda', 'dasasd', 'asdas'),
(4, 13, 3, 'dsadas', 'dadasasfas', 'dsadas', 'adasda', 'dasasd', 'asdas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rps_tugas`
--

CREATE TABLE `tb_rps_tugas` (
  `id` int(11) NOT NULL,
  `id_rps` int(11) NOT NULL,
  `tugas` varchar(128) NOT NULL,
  `kemampuan_akhir` varchar(128) NOT NULL,
  `waktu` varchar(128) NOT NULL,
  `bobot` varchar(10) NOT NULL,
  `kriteria_penilaian` varchar(255) NOT NULL,
  `indikator_penilaian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rps_tugas`
--

INSERT INTO `tb_rps_tugas` (`id`, `id_rps`, `tugas`, `kemampuan_akhir`, `waktu`, `bobot`, `kriteria_penilaian`, `indikator_penilaian`) VALUES
(1, 13, 'sadasda', 'dsadasdas', 'dsadasdassd', 'saadasdas', 'dasdassda', 'dasdasdas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rps_unit_pembelajaran`
--

CREATE TABLE `tb_rps_unit_pembelajaran` (
  `id` int(11) NOT NULL,
  `id_rps` int(11) NOT NULL,
  `kemampuan_akhir` text NOT NULL,
  `indikator` text NOT NULL,
  `bahan_kajian` text NOT NULL,
  `metode_pembelajaran` text NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `metode_penilaian` varchar(255) NOT NULL,
  `bahan_ajar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rps_unit_pembelajaran`
--

INSERT INTO `tb_rps_unit_pembelajaran` (`id`, `id_rps`, `kemampuan_akhir`, `indikator`, `bahan_kajian`, `metode_pembelajaran`, `waktu`, `metode_penilaian`, `bahan_ajar`) VALUES
(1, 0, 'Memahami komponen penyusun perangkat komputer dan troubleshooting perangkat komputer', '<p>a) Mahasiswa mampu mengidentifikasi perangkat komputer.&nbsp;</p><p>b) Melakukan troubleshooting pada instalasi komputer.&nbsp;</p><p>c) Merakit komponen komputer. </p>', '<p>1. Pengenalan komponen PC, alat dan standar keamanan.&nbsp;</p><p>2. Perakitan komputer.&nbsp;</p><p>3.Troubleshooting</p>', 'Praktikum, presentasi, kelompok', '400 menit praktikum, 200 menit Tugas mandiri', 'Hasil kegiatan Praktikum, presentasi', 'Asem'),
(2, 0, 'Memahami komponen penyusun perangkat komputer dan troubleshooting perangkat komputer', '<p>a) Mahasiswa mampu mengidentifikasi perangkat komputer.&nbsp;</p><p>b) Melakukan troubleshooting pada instalasi komputer.&nbsp;</p><p>c) Merakit komponen komputer. </p>', '<p>1. Pengenalan komponen PC, alat dan standar keamanan.&nbsp;</p><p>2. Perakitan komputer.&nbsp;</p><p>3.Troubleshooting</p>', 'Praktikum, presentasi, kelompok', '400 menit praktikum, 200 menit Tugas mandiri', 'Hasil kegiatan Praktikum, presentasi', 'Asem'),
(3, 13, 'dasdasdasda', 'dasdasfdsaf', 'asdasdas', 'dsadasd', 'dsadasdas', 'dasdasd', 'assdad'),
(4, 13, 'dasdasdasda', 'dasdasfdsaf', 'asdasdas', 'dsadasd', 'dsadasdas', 'dasdasd', 'assdad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `id_dosen`) VALUES
(8, 'Administrator', 'admin@email.com', 'default.jpg', '$2y$10$UajxTlR1bXwtJ4HB61n0YOgUOGhiDHYoy1Ai/KK4citTh85jpKIBy', 1, 1, 1674649822, 0),
(9, 'Firman Asharudin', 'dosen@email.com', 'default.jpg', '$2y$10$XJp1hopVYJ9dqKFmoQ763.LPOvvoZnh9U6SLOxVpjjlwIxRoJlqc6', 2, 1, 1674649838, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_akses_menu`
--

CREATE TABLE `user_akses_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_akses_menu`
--

INSERT INTO `user_akses_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(5, 2, 3),
(6, 2, 2),
(7, 3, 2),
(8, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(5, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(6, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(7, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 0),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `tb_rps`
--
ALTER TABLE `tb_rps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_rps_detail`
--
ALTER TABLE `tb_rps_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_rps_tugas`
--
ALTER TABLE `tb_rps_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_rps_unit_pembelajaran`
--
ALTER TABLE `tb_rps_unit_pembelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_rps`
--
ALTER TABLE `tb_rps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_rps_detail`
--
ALTER TABLE `tb_rps_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_rps_tugas`
--
ALTER TABLE `tb_rps_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_rps_unit_pembelajaran`
--
ALTER TABLE `tb_rps_unit_pembelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
