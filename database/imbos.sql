-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2024 pada 04.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imbos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` char(36) NOT NULL,
  `guru_id` char(36) NOT NULL,
  `kelas_id` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_details`
--

CREATE TABLE `absensi_details` (
  `id` char(36) NOT NULL,
  `absensi_id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_gurus`
--

CREATE TABLE `absensi_gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `email`, `foto`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('9c84a566-a710-4061-ab76-edf2cea0e49c', 'admin', 'Admin User', 'admin@example.com', 'foto_alumni/1721750778.jpg', NULL, '$2y$12$lgjl6DOfTCAX1xWPSnNuP.s/z4D3CUw24mJ/uQT/n8R4W0U5l0MfS', NULL, '2024-07-13 22:34:06', '2024-07-13 22:34:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumnis`
--

CREATE TABLE `alumnis` (
  `id` char(36) NOT NULL,
  `nama_alumni` varchar(255) NOT NULL,
  `jenis_perguruan_tinggi_id` char(36) DEFAULT NULL,
  `nama_universitas` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumnis`
--

INSERT INTO `alumnis` (`id`, `nama_alumni`, `jenis_perguruan_tinggi_id`, `nama_universitas`, `foto`, `status`, `created_at`, `updated_at`) VALUES
('9c97a25d-4ec9-4476-9aa3-9efa062f0acb', 'Afkar Dzaki Asyrof', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Sekolah Tinggi Pertanahan Nasional - D-IV Pertanahan', 'foto_alumni/1721750778.jpg', 1, '2024-07-23 09:06:20', '2024-07-23 09:39:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritas`
--

CREATE TABLE `beritas` (
  `id` char(36) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kategori_id` char(36) NOT NULL,
  `author_id` char(36) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `beritas`
--

INSERT INTO `beritas` (`id`, `judul_berita`, `isi_berita`, `foto`, `kategori_id`, `author_id`, `status`, `file`, `created_at`, `updated_at`) VALUES
('9c9a9c14-830e-481b-a4d7-f03ef25084bb', 'Lorem ipsum odor amet, consectetuer adipiscing elit', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Magna cursus magnis tempor bibendum lacus; orci potenti sollicitudin. Mus class suscipit libero fusce iaculis mattis cras egestas sodales. Nibh ipsum lectus interdum varius efficitur vestibulum varius ante? Commodo donec hendrerit vitae sodales posuere finibus senectus. Lobortis nulla porta convallis habitasse lacinia finibus eu vehicula cursus. Molestie ad velit turpis nisl quis quam commodo. Gravida bibendum litora curabitur libero tincidunt tincidunt elit a. Duis imperdiet id nullam penatibus suscipit.</p><p><br></p><p>Non magna at semper; fermentum finibus eget senectus. Cras ad efficitur condimentum penatibus facilisi. Nisi augue donec bibendum facilisi laoreet odio? Bibendum natoque vivamus fringilla etiam at etiam fringilla. Volutpat laoreet elit lacus elit tellus erat lectus aenean. Ridiculus pulvinar ligula lobortis dis; facilisis et blandit purus. Eros suscipit vulputate magna duis facilisis efficitur quis. Montes malesuada ridiculus phasellus iaculis, sit tincidunt platea. Nostra faucibus arcu maximus duis malesuada.</p><p><br></p><p>Neque himenaeos senectus blandit faucibus nec sagittis inceptos quisque. Ex quis lacus velit eget platea curabitur himenaeos. Tellus porta nisi dui natoque fusce. Non dignissim ornare sociosqu; montes tincidunt sem. Nunc aptent molestie eros vehicula porttitor. Quisque nulla mus molestie purus neque scelerisque ac.</p>', 'fotos/R3Q0NBYaw5R6iGiZfJ3cZDxeRZPMAnTambijJKGy.jpg', '3d86f3be-2847-4d60-93fd-e7a9533d801a', '9c84a566-a710-4061-ab76-edf2cea0e49c', 1, NULL, '2024-07-24 20:36:15', '2024-07-24 20:36:15'),
('9c9aa28f-3b29-4e3d-8a84-da751824d9df', 'Gravida bibendum litora curabitur libero tincidunt tincidunt elit a', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Magna cursus magnis tempor bibendum lacus; orci potenti sollicitudin. Mus class suscipit libero fusce iaculis mattis cras egestas sodales. Nibh ipsum lectus interdum varius efficitur vestibulum varius ante? Commodo donec hendrerit vitae sodales posuere finibus senectus. Lobortis nulla porta convallis habitasse lacinia finibus eu vehicula cursus. Molestie ad velit turpis nisl quis quam commodo. Gravida bibendum litora curabitur libero tincidunt tincidunt elit a. Duis imperdiet id nullam penatibus suscipit.</p><p><img src=\"http://127.0.0.1:8000/storage/gambar_berita/RE59gkHrgtL5OpeM1wL3oY4lYT3qSLQJmu52OY10.jpg\" style=\"width: 100%;\"><br></p><p>Non magna at semper; fermentum finibus eget senectus. Cras ad efficitur condimentum penatibus facilisi. Nisi augue donec bibendum facilisi laoreet odio? Bibendum natoque vivamus fringilla etiam at etiam fringilla. Volutpat laoreet elit lacus elit tellus erat lectus aenean. Ridiculus pulvinar ligula lobortis dis; facilisis et blandit purus. Eros suscipit vulputate magna duis facilisis efficitur quis. Montes malesuada ridiculus phasellus iaculis, sit tincidunt platea. Nostra faucibus arcu maximus duis malesuada.</p><p><br></p><p>Neque himenaeos senectus blandit faucibus nec sagittis inceptos quisque. Ex quis lacus velit eget platea curabitur himenaeos. Tellus porta nisi dui natoque fusce. Non dignissim ornare sociosqu; montes tincidunt sem. Nunc aptent molestie eros vehicula porttitor. Quisque nulla mus molestie purus neque scelerisque ac.</p>', 'fotos/cUR32v306zKVDdN6OMn7IPLTqF6BDcmF5B6fDd39.jpg', '03d13901-aa69-4233-a973-def0dd514c93', '9c84a566-a710-4061-ab76-edf2cea0e49c', 1, NULL, '2024-07-24 20:54:21', '2024-07-24 20:59:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gurus`
--

CREATE TABLE `gurus` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `mata_pelajaran_id` char(36) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `foto_sampul` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `motto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gurus`
--

INSERT INTO `gurus` (`id`, `nama`, `nip`, `mata_pelajaran_id`, `tempat_lahir`, `tanggal_lahir`, `foto`, `foto_sampul`, `password`, `motto`, `created_at`, `updated_at`) VALUES
('9c99aa91-0259-4361-80d8-2a0e7af72b79', 'M.Kosim Ali, M.Pd', '13100303', '71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', NULL, NULL, 'fotos/QPnZQUyTkx1yOBhNsp7RIoVrP8npY7Dwcp00FXem.jpg', NULL, '$2y$12$99VSNPmXUPGIk8Ar6kqPA.lMq0cPc.o2q8m1wXF9c3Lvv4AY8dQbq', NULL, '2024-07-24 09:20:55', '2024-07-24 09:27:43'),
('9c99adcf-7b21-4b09-a80d-02d0f6ae8cfe', 'Aridan Fahri, M.Pd', '13100304', '93e136c7-a3d3-4658-9f18-9c54ca8a4e20', NULL, NULL, 'fotos/yVraz2uwIazBnk0xKiCbk3o0MN8PJ1EG35PmywiH.jpg', NULL, '$2y$12$cqinLDb8AOykCoFTVeqbv.FwfQ2ZTfOISMDSPAG3NlTxIClD9xaHa', NULL, '2024-07-24 09:29:59', '2024-07-24 09:29:59'),
('9c99ae45-83e0-42b9-a35f-7acde74b0fbe', 'Wildan Amadi, M.Pd', '13100305', '1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', NULL, NULL, 'fotos/PFAAXHMTfQsNIyBI3s6shkbGtOQCReffqeeq5IiY.jpg', NULL, '$2y$12$GQ8m57YgLXYeAmcKoOpFOOFyuHNe.rcEasPEtiC/nNygG94Hctjlu', NULL, '2024-07-24 09:31:17', '2024-07-24 09:31:17'),
('9c99ae86-25c6-4e6e-ac1d-dc517af8b353', 'Niro SAS, M.Pd', '13100306', '462d7204-80b5-4f40-8ead-69a411a99668', NULL, NULL, 'fotos/8b3PcIswYP8CizJgKX2gm9UcPEv1So2TiNFoSaMT.jpg', NULL, '$2y$12$VxgCJW0G/72ztQP2MN3fe.33rhLA1RyxvSKh3VpwwYkrD7wdsvtHW', NULL, '2024-07-24 09:31:59', '2024-07-24 09:31:59'),
('9c99af0b-aacf-42c6-9863-74e3fc96686d', 'Afrizal Halim, S.Si', '13100307', '93e136c7-a3d3-4658-9f18-9c54ca8a4e20', NULL, NULL, 'fotos/AZVJtGlybqfiNLfDBhYYrDNKT6iQ3UgVtoN8rMU0.jpg', NULL, '$2y$12$Q2bkevJrsWWZO9Kti1mvY.E2.X0bCIaF2ZGzmxDNY3Q3TXTfbiLAC', NULL, '2024-07-24 09:33:27', '2024-07-24 09:33:44'),
('9c99af89-a48e-42f1-a8c7-4a28e47b5b34', 'Afifah Thurrifqoh, S.Pd', '13100308', '71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', NULL, NULL, 'fotos/MvEAX3goV6GC8siLh8OqWnhNkgSGTCIPMoPSArCA.jpg', NULL, '$2y$12$9YFbEQdGiuJ0zOvpKmBUXuuOBC1/xJ1HtU.yETkx7JHbZlOzSrqbi', NULL, '2024-07-24 09:34:49', '2024-07-24 09:35:06'),
('9c99afea-360d-4c09-bf4f-37e14ec66b74', 'Faradila Tsani, S.Pd', '13100309', '1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', NULL, NULL, 'fotos/fSffM79yONTZEgTDAqqGMY4HRtX4e1JRXbPGr4pE.jpg', NULL, '$2y$12$ntgajbDxbwSocxdZ.LY/au77FccSXC6d1YYbtLeAN8wj6BZUX4lZG', NULL, '2024-07-24 09:35:52', '2024-07-24 09:35:52'),
('9c99b057-567b-42cc-9678-9663f87bae1d', 'Sri Nur Hidayah, S.Pd', '13100310', '0ba1c675-b081-4175-9f09-773e4dc51ed3', NULL, NULL, NULL, NULL, '$2y$12$Fdqb25wXKCXfeXhoENI1Q.x..nWqu1NAMUH2XrOaejeA9UGcQvNwO', NULL, '2024-07-24 09:37:04', '2024-07-24 09:37:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_perguruan_tinggis`
--

CREATE TABLE `jenis_perguruan_tinggis` (
  `id` char(36) NOT NULL,
  `nama_jenis_pt` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_perguruan_tinggis`
--

INSERT INTO `jenis_perguruan_tinggis` (`id`, `nama_jenis_pt`, `status`, `created_at`, `updated_at`) VALUES
('0e014732-6779-4883-80e3-994b1e28d15f', 'PTS (Perguruan Tinggi Swasta)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'PTN (Perguruan Tinggi Negeri)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('8bb88f3a-428b-453d-998c-bba0264195d1', 'PTK (Perguruan Tinggi Kedinasan)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('b06855b8-2183-42a3-973a-1000266e5ebc', 'PTKIN (Perguruan Tinggi Islam Negeri)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_beritas`
--

CREATE TABLE `kategori_beritas` (
  `id` char(36) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_beritas`
--

INSERT INTO `kategori_beritas` (`id`, `nama_kategori`, `status`, `created_at`, `updated_at`) VALUES
('03d13901-aa69-4233-a973-def0dd514c93', 'Sekolah', 1, '2024-07-23 10:37:08', '2024-07-24 20:33:27'),
('3d86f3be-2847-4d60-93fd-e7a9533d801a', 'Bimbel', 1, '2024-07-24 20:33:38', '2024-07-24 20:33:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` char(36) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `tingkat_kelas` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat_kelas`, `status`, `created_at`, `updated_at`) VALUES
('05554a12-e80f-4c94-be4e-cde866b1f324', 'XII D', 'XII', 1, '2024-07-24 09:41:40', '2024-07-24 09:41:40'),
('247e8c31-65eb-4ff8-8cd9-539cd8f16c47', 'Kedinasan', 'XII', 1, '2024-07-24 09:42:03', '2024-07-24 09:42:03'),
('25e59917-08d7-4d14-ac92-43ba07e48412', 'XI B', 'XI', 1, '2024-07-24 09:40:14', '2024-07-24 09:40:14'),
('3215b530-024e-4ce1-9f57-88e62bae0820', 'XI A', 'XI', 1, '2024-07-17 10:03:05', '2024-07-17 10:03:05'),
('5c913451-a32a-447a-8880-0f388975f9cf', 'XII A', 'XII', 1, '2024-07-24 09:41:07', '2024-07-24 09:41:07'),
('a053b96e-f927-4388-bc9a-4ec08eacc417', 'XII C', 'XII', 1, '2024-07-24 09:41:30', '2024-07-24 09:41:30'),
('b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'XI C', 'XI', 1, '2024-07-24 09:40:26', '2024-07-24 09:40:26'),
('d83c60c0-bef9-4b05-888d-550e2a100845', 'XII B', 'XII', 1, '2024-07-24 09:41:21', '2024-07-24 09:41:21'),
('f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'XI D', 'XI', 1, '2024-07-24 09:40:36', '2024-07-24 09:40:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentars`
--

CREATE TABLE `komentars` (
  `id` char(36) NOT NULL,
  `berita_id` char(36) NOT NULL,
  `nama_komentator` varchar(255) NOT NULL,
  `isi_komentar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` char(36) NOT NULL,
  `namaMataPelajaran` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `opsi_test_tps` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `namaMataPelajaran`, `status`, `opsi_test_tps`, `created_at`, `updated_at`) VALUES
('0ba1c675-b081-4175-9f09-773e4dc51ed3', 'Tes Potensi Skolastik (PBM)', 'Aktif', 1, '2024-07-17 10:02:26', '2024-07-17 10:02:26'),
('1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', 'Literasi B.Indo', 'Aktif', 0, '2024-07-17 10:01:48', '2024-07-17 10:01:48'),
('462d7204-80b5-4f40-8ead-69a411a99668', 'Literasi B.Ing', 'Aktif', 0, '2024-07-17 10:01:53', '2024-07-17 10:01:53'),
('47a487cb-d6bf-4cf2-8b85-af427e37b64a', 'Tes Potensi Skolastik (PU)', 'Aktif', 1, '2024-07-17 10:02:03', '2024-07-17 10:02:03'),
('71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', 'Penalaran Matematika', 'Aktif', 0, '2024-07-17 10:01:42', '2024-07-17 10:01:42'),
('93e136c7-a3d3-4658-9f18-9c54ca8a4e20', 'Tes Potensi Skolastik (PK)', 'Aktif', 1, '2024-07-17 10:02:11', '2024-07-17 10:02:11'),
('f1272bd5-4d6f-4547-8e0c-de379c8682be', 'Tes Potensi Skolastik (PPU)', 'Aktif', 1, '2024-07-17 10:02:18', '2024-07-17 10:02:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_14_053009_add_username_to_users_table', 2),
(5, '2024_07_14_053214_create_admins_table', 3),
(6, '2024_07_15_061649_create_mata_pelajarans_table', 4),
(7, '2024_07_15_123415_create_gurus_table', 5),
(8, '2024_07_16_005741_modify_columns_nullable_in_gurus_table', 6),
(9, '2024_07_16_012748_create_kelas_table', 6),
(10, '2024_07_16_024747_create_program_bimbels_table', 6),
(11, '2024_07_16_025909_modify_icon_program_nullable_in_program_bimbels_table', 6),
(12, '2024_07_16_031744_create_siswas_table', 6),
(13, '2024_07_16_033059_add_foto_siswa_to_siswas_table', 6),
(14, '2024_07_16_034831_make_siswa_columns_nullable', 6),
(15, '2024_07_16_035538_create_tahun_pelajarans_table', 6),
(16, '2024_07_16_053956_create_tryouts_table', 6),
(17, '2024_07_16_060317_create_nilais_table', 6),
(18, '2024_07_18_014717_add_password_to_gurus_table', 7),
(19, '2024_07_18_020815_create_absensi_gurus_table', 8),
(20, '2024_07_19_073428_add_foto_sampul_to_gurus_table', 9),
(21, '2024_07_19_095454_create_absensis_table', 9),
(22, '2024_07_19_141220_remove_materi_from_absensis_table', 10),
(23, '2024_07_19_142530_add_timestamps_to_absensi_details_table', 11),
(24, '2024_07_22_165602_add_opsi_test_tps_to_mata_pelajarans_table', 12),
(25, '2024_07_22_185956_add_tanggal_to_tryouts_table', 13),
(26, '2024_07_22_192112_create_sertifikat_tryouts_table', 14),
(27, '2024_07_22_193811_add_tryout_id_to_sertifikat_tryouts_table', 15),
(28, '2024_07_23_155858_create_alumnis_table', 16),
(29, '2024_07_23_161124_create_jenis_perguruan_tinggis_table', 17),
(30, '2024_07_23_161944_modify_jenis_perguruan_tinggi_column_in_alumnis_table', 18),
(31, '2024_07_23_171719_create_testimonials_table', 19),
(32, '2024_07_23_173353_create_kategori_beritas_table', 20),
(33, '2024_07_23_174211_create_beritas_table', 21),
(34, '2024_07_23_180235_create_komentars_table', 22),
(35, '2024_07_23_181212_create_tanggapan_komentars_table', 23),
(36, '2024_07_24_105119_add_foto_to_admins_table', 24),
(37, '2024_07_24_142406_add_motto_to_gurus_table', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilais`
--

CREATE TABLE `nilais` (
  `id` char(36) NOT NULL,
  `tryout_id` char(36) NOT NULL,
  `mata_pelajaran_id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_bimbels`
--

CREATE TABLE `program_bimbels` (
  `id` char(36) NOT NULL,
  `nama_program` varchar(255) NOT NULL,
  `deskripsi_program` text NOT NULL,
  `icon_program` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_bimbels`
--

INSERT INTO `program_bimbels` (`id`, `nama_program`, `deskripsi_program`, `icon_program`, `status`, `created_at`, `updated_at`) VALUES
('a45a91f7-8425-4ed7-a222-261fb2786898', 'Bimbel Plus', 'Bimbel Plus', NULL, 1, '2024-07-17 10:04:10', '2024-07-24 09:42:55'),
('b688ecce-149f-4ff0-bf65-1b023f8ab24d', 'Bimbel Kedinasan', 'Bimbel Kedinasan', NULL, 1, '2024-07-24 09:42:48', '2024-07-24 09:42:48'),
('fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Bimbel UTBK', 'Bimbel UTBK', NULL, 1, '2024-07-24 09:42:32', '2024-07-24 09:42:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_tryouts`
--

CREATE TABLE `sertifikat_tryouts` (
  `id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `no_sertifikat` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tryout_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KN8G3o2b6vWynLTLxPoHxTuU848FpahRBeBTGCyH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXRwajVHcVA0aDRhNElmY05nRHU5azRDRXhUVnRObElPcXNWV0FZWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fX0=', 1721958458);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` char(36) NOT NULL,
  `kelas_id` char(36) NOT NULL,
  `program_bimbel_id` char(36) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmpt_lahir` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `nis` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `kelas_id`, `program_bimbel_id`, `nama_siswa`, `tgl_lahir`, `tmpt_lahir`, `no_hp`, `foto_siswa`, `nis`, `password`, `status`, `created_at`, `updated_at`) VALUES
('9c9c6cc4-6b6c-4c4a-b943-d8fca99f2860', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Abdurrahman Rais', NULL, NULL, NULL, NULL, 23001, '$2y$12$rRZwk.pE977N6QcYdcOap.0Rrb9p37RDVo06NbadV3L8TNFUCanyy', 1, '2024-07-25 18:15:36', '2024-07-25 18:15:36'),
('9c9c6cc4-c19c-496d-96b5-731e3ed1966d', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aldhy Ansyah', NULL, NULL, NULL, NULL, 23009, '$2y$12$XkKorl4b2cO.uevm7Fmkx.380N0G/dpDfXC5Tk9S1wqJgzP1IiiDi', 1, '2024-07-25 18:15:36', '2024-07-25 18:15:36'),
('9c9c6cc5-160e-4fa9-9b67-4a29c7a17b18', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Anang Fadilah', NULL, NULL, NULL, NULL, 23012, '$2y$12$Nvf/cefRnuFbZbmMEMcVXuPlQJE/ZSJA/fn9ItThuKqnx8vbOZtMy', 1, '2024-07-25 18:15:36', '2024-07-25 18:15:36'),
('9c9c6cc5-6a17-465e-9b98-09ffa6a40b9e', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Arrassy Aulia Akbar Purwadinata', NULL, NULL, NULL, NULL, 23018, '$2y$12$syRGiaW11jiA4S5aNuMuVepABzDtppzgpZMDHhegj1780gdNOYWeG', 1, '2024-07-25 18:15:37', '2024-07-25 18:15:37'),
('9c9c6cc5-bd4a-4113-9d32-88d2ec0ec71e', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Bagus Satrio', NULL, NULL, NULL, NULL, 23026, '$2y$12$ki30OXy4DgZl2U7UiKqy2O/Kfv1b5850GpzbjaE1Ay2q7lmdPpqIy', 1, '2024-07-25 18:15:37', '2024-07-25 18:15:37'),
('9c9c6cc6-114c-4b77-9992-5542780bd8ec', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Daffa Fairuz Akif', NULL, NULL, NULL, NULL, 23029, '$2y$12$cZeOeiViwxY2n05AoG1TEejIXnKP4fvPaA9OF56Wfae78VMO7djzG', 1, '2024-07-25 18:15:37', '2024-07-25 18:15:37'),
('9c9c6cc6-64b5-4a7e-9b94-2a38ec9b901d', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Devanda Azril Dwiyoga', NULL, NULL, NULL, NULL, 23030, '$2y$12$6/RCwkkjCjaM2ku8BNzqM..YUEdnAIecRQCth7qfdgr7KgCnLz16m', 1, '2024-07-25 18:15:37', '2024-07-25 18:15:37'),
('9c9c6cc6-b8f9-4640-ac15-3405798cfa48', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Falih Azam Zain', NULL, NULL, NULL, NULL, 23037, '$2y$12$t6nbPPRp5M4S0PGZm1kv0uASCC.4GvS2K7g8Uu.bJbN23d4Hx3eKS', 1, '2024-07-25 18:15:37', '2024-07-25 18:15:37'),
('9c9c6cc7-0c2d-433f-9579-2b1d52c2c16f', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ferdy Rizky Gunawan', NULL, NULL, NULL, NULL, 23040, '$2y$12$x9UrX5qaRDL.cV8jvb985uj8apUksijnFiFSE3iR1gboAc4me6/dS', 1, '2024-07-25 18:15:38', '2024-07-25 18:15:38'),
('9c9c6cc7-609c-4119-99ec-38f600b30618', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ishaq Eka Pratama', NULL, NULL, NULL, NULL, 23044, '$2y$12$uNdKak7.lAw0WLCYQO6u5O6MK//2MCOlnJbqdBBtYmWCb7Z6CsBYi', 1, '2024-07-25 18:15:38', '2024-07-25 18:15:38'),
('9c9c6cc7-b5ac-4502-ba8d-6cf03041aac9', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Mifta Yoga Fahreza', NULL, NULL, NULL, NULL, 23054, '$2y$12$682qC9c8YDLt2HfxnTC.Ue3j0tT0SJ1AJtpNMb46GOjT0nqXnobTe', 1, '2024-07-25 18:15:38', '2024-07-25 18:15:38'),
('9c9c6cc8-0989-4d47-8c46-b01ae01f8f91', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muammar Ramafikhar Dinata', NULL, NULL, NULL, NULL, 23060, '$2y$12$hnz360kb7Szrabd539GGZ.yx2lA.PeZ4VsMxAxsuwN5zHFN5WOPTS', 1, '2024-07-25 18:15:38', '2024-07-25 18:15:38'),
('9c9c6cc8-5df5-4d41-874f-a33eec670c51', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Abdul Rozaq', NULL, NULL, NULL, NULL, 23101, '$2y$12$Hr5oWtD3Mz95/eSLj2ynFOgdLC4OV281CxA4GzZD/fTeO6HZg228u', 1, '2024-07-25 18:15:39', '2024-07-25 18:15:39'),
('9c9c6cc8-b143-4a5e-9ef5-a074c7b103b7', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Fardan Algifary', NULL, NULL, NULL, NULL, 23063, '$2y$12$TsAdhZjIsuMW9pXmZNbhUOty6J7UHZZhbhZDKoodzbIFob4Gmtjfe', 1, '2024-07-25 18:15:39', '2024-07-25 18:15:39'),
('9c9c6cc9-0629-479d-a3e6-900e58c335f6', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Musab Sadid Al Anshori', NULL, NULL, NULL, NULL, 23065, '$2y$12$mZdC9ATOJBsRsgd2uilYre2WRBc0BXBsSAWYmGqd6KSTyFRVM1Xxq', 1, '2024-07-25 18:15:39', '2024-07-25 18:15:39'),
('9c9c6cc9-5a79-41a0-a238-2c7dc7d4026d', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Noval Fahrian Irsyad', NULL, NULL, NULL, NULL, 23072, '$2y$12$KpMrjLBUSH9H4lUt09A3f./K3tsSjky84LfG8Aq4dCYxTM97P63Je', 1, '2024-07-25 18:15:39', '2024-07-25 18:15:39'),
('9c9c6cc9-b10d-4278-af80-3160ba8b1670', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Revan Deska Nugraha', NULL, NULL, NULL, NULL, 23078, '$2y$12$0oaB.x8YCA3ZJITVjBlMSuE2B59bwRAYrQMpBOFlsgP23q/K22CV2', 1, '2024-07-25 18:15:39', '2024-07-25 18:15:39'),
('9c9c6cca-05f9-4beb-8ea2-c0f45c976253', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Syafiq Abdullah Zhafir', NULL, NULL, NULL, NULL, 23085, '$2y$12$YUuhoW06/xJKlTaLi8WMVOKJK768nCmi4dcNw2aqe37x7fGeTrMli', 1, '2024-07-25 18:15:40', '2024-07-25 18:15:40'),
('9c9c6cca-59f9-4aca-ad89-f452e1f8c9db', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Tabah Saputra', NULL, NULL, NULL, NULL, 23087, '$2y$12$rLRJKYjWJ9U.oRRQjJPADemc.N/QJ/exENZoF7U9ZhHhL6VrTyXUi', 1, '2024-07-25 18:15:40', '2024-07-25 18:15:40'),
('9c9c6cca-aea2-4775-b3d0-e6380d6feeb3', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Yudhistira Bintang Alifiano Putra', NULL, NULL, NULL, NULL, 23092, '$2y$12$bjD9MTFQVVGsd1GA0VsD3ui75pXzpW/9qV94OAB5EzX15LZHfLQ/i', 1, '2024-07-25 18:15:40', '2024-07-25 18:15:40'),
('9c9c6ccb-036b-41e7-8f07-29fc32ac5c18', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zakki Bintang Jauhari', NULL, NULL, NULL, NULL, 23095, '$2y$12$zl4KCB6x8gLMWBlrBSdiTOVy2Nbu13tGt3pIBUrHpijMnQ/T3jIUq', 1, '2024-07-25 18:15:40', '2024-07-25 18:15:40'),
('9c9c6ccb-57c6-428f-a85c-189b84af2017', '3215b530-024e-4ce1-9f57-88e62bae0820', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zulfa Yanuar', NULL, NULL, NULL, NULL, 23098, '$2y$12$wXVIMmcaSe8wZyJ8tLWPFuDXnI2SG3W7NTv6BZs3KGb5LLLd8NSzW', 1, '2024-07-25 18:15:40', '2024-07-25 18:15:40'),
('9c9c6ccb-ac3e-4bf8-997e-a172ba27e8d7', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'A. Zhafran Atthariq', NULL, NULL, NULL, NULL, 23002, '$2y$12$J9Tivmu75WXrhwE9DJs6cuAZh45YAxq/sT6u8JoPVVUQ.oHMIz.66', 1, '2024-07-25 18:15:41', '2024-07-25 18:15:41'),
('9c9c6ccc-004c-47c2-8e5b-c351af3cabd2', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Akmal Atha Malik', NULL, NULL, NULL, NULL, 23007, '$2y$12$wkhHcWT4rfxdORqM7IWxyu16UI3ghYCdkKdfKY3BoGzNHMRkS6JXa', 1, '2024-07-25 18:15:41', '2024-07-25 18:15:41'),
('9c9c6ccc-54b7-4b26-8dad-80e8efc88ce3', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Alexandro Exchel Zanet', NULL, NULL, NULL, NULL, 23010, '$2y$12$K28b7oi0zLaipUxaCtdGLOiABh9EOqnEP02L/OHkb9lq6eLseAh6u', 1, '2024-07-25 18:15:41', '2024-07-25 18:15:41'),
('9c9c6ccc-a81a-4e45-97b2-42592dc8ef44', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Asyraf Fairuz Dzaky', NULL, NULL, NULL, NULL, 23020, '$2y$12$VBWHoOx/0mi/o6i18qjYyezAJRHdgjn0rzPkhh9VX6.TAWvN94qBC', 1, '2024-07-25 18:15:41', '2024-07-25 18:15:41'),
('9c9c6ccc-fc85-4b36-a7dd-2d602323283d', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aufar Robbani', NULL, NULL, NULL, NULL, 23022, '$2y$12$xgzcmtbxE/Z1VIAXKCcbw.VJzo.7nZ/iGbw.QHYZiD7f65Uwnj5Em', 1, '2024-07-25 18:15:42', '2024-07-25 18:15:42'),
('9c9c6ccd-502c-45be-b164-5024a41e3865', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Daffa Abiyu Fajri', NULL, NULL, NULL, NULL, 23028, '$2y$12$PxCoAPE4E7xncAkHuOUrnuXrTs4SMt/1Tv2sXAnO2.4kYoKx/1t6e', 1, '2024-07-25 18:15:42', '2024-07-25 18:15:42'),
('9c9c6ccd-a4e3-457e-ab90-37cb109877d9', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Fachry Alfaridzi', NULL, NULL, NULL, NULL, 23034, '$2y$12$OjbFhQuCKGmWvVYdHePPYOjmOg49ffXMJBeL2PnTiqfXFRIZlKOKe', 1, '2024-07-25 18:15:42', '2024-07-25 18:15:42'),
('9c9c6ccd-f91d-4456-a324-436c2213bbd6', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Faiz Zakwan Benzeena', NULL, NULL, NULL, NULL, 23036, '$2y$12$UP4PMVJ7EtJe7du5PYP2FuCoZ18oCU3Q4o1ED9bQw9KeySF8tAZNG', 1, '2024-07-25 18:15:42', '2024-07-25 18:15:42'),
('9c9c6cce-4dcd-4512-b2c7-641b70871f10', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Fauzan Zauzal Mawadi', NULL, NULL, NULL, NULL, 23039, '$2y$12$ai0NfiQGS4EbsFpWLuUatuSpjyhAaa7lYQxVxivhjDXPhhjIFgT5O', 1, '2024-07-25 18:15:42', '2024-07-25 18:15:42'),
('9c9c6cce-a43b-4620-bdca-a53ad2fcfe43', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ilham Surya Purnomo', NULL, NULL, NULL, NULL, 23043, '$2y$12$NX2hCSb/eH9vRkWxeh6em.PsFNfdFfIWar2huc2CkFcrqldYf3L6e', 1, '2024-07-25 18:15:43', '2024-07-25 18:15:43'),
('9c9c6cce-f8bd-4adc-982c-45141e0003c6', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Kevin Ananda Putra', NULL, NULL, NULL, NULL, 23047, '$2y$12$S5iyUlfORYdh/XiUcJZsUeScc.jqGx6KLJ7OaMc/TRU16FzKEYPUe', 1, '2024-07-25 18:15:43', '2024-07-25 18:15:43'),
('9c9c6ccf-4cd2-49cf-8649-096c2e87194b', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Hadid Al Farisi', NULL, NULL, NULL, NULL, 23053, '$2y$12$sQ15VJM.sZYSND3Uda2Y7ecHJk39V1VAVfVyy0pOpT5vEcSBfhjWi', 1, '2024-07-25 18:15:43', '2024-07-25 18:15:43'),
('9c9c6ccf-a329-4e64-af5e-5676f2353769', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhamad Rafli', NULL, NULL, NULL, NULL, 23061, '$2y$12$R584EeNJBd9Yf7VyIcXcUO5/aP.vD9re1sP0xlGvrLlIrCgMmD3/.', 1, '2024-07-25 18:15:43', '2024-07-25 18:15:43'),
('9c9c6ccf-f769-40db-ad53-d8be41ad8af8', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Azzam Firdaus', NULL, NULL, NULL, NULL, 23062, '$2y$12$cZX9H7filuQpyd9Kx1LZG.I9bbiN.ItGKkwjOugQK7zCtfcuPHXXy', 1, '2024-07-25 18:15:43', '2024-07-25 18:15:43'),
('9c9c6cd0-4b3e-4d84-8ceb-69fee7944fd1', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Hasby Ashshidqy', NULL, NULL, NULL, NULL, 23064, '$2y$12$A.QTmo8pGjIeJjqz0yxCyO3kC8BwpT4j6BJ.vvRERoW7OpNOlzr3C', 1, '2024-07-25 18:15:44', '2024-07-25 18:15:44'),
('9c9c6cd0-a022-4fed-9593-ac03cd44e8ea', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Thariq Azzuhkruf', NULL, NULL, NULL, NULL, 23055, '$2y$12$Qqe3fxuVEWUnAgD3wVeOTOJqLkUrxupiZUxw//RHVzbgrUrMY/Zh6', 1, '2024-07-25 18:15:44', '2024-07-25 18:15:44'),
('9c9c6cd0-f45e-4ae3-82c2-ce28df301bf7', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nabil Musyafa', NULL, NULL, NULL, NULL, 23066, '$2y$12$UceKuPezYoPeL4YsvHyTY.kutroAmQpzgsqTi/wL/wT8wXQj2iXMS', 1, '2024-07-25 18:15:44', '2024-07-25 18:15:44'),
('9c9c6cd1-47d5-491d-947e-99ce101b6a10', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Rafly Putra Satria', NULL, NULL, NULL, NULL, 23075, '$2y$12$viyRxG/OlVJ5c4etgJb1xe6y8EHb0Fcq9uhc1h50RkE4DFgyHTzxa', 1, '2024-07-25 18:15:44', '2024-07-25 18:15:44'),
('9c9c6cd1-9c6f-4446-a8cd-e20541d6f5b1', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Sayyid Muhammad Husein', NULL, NULL, NULL, NULL, 23080, '$2y$12$1R/Pw6hXzn5zQmyd0Yjg0O1obfQSOPHDsUM0w6VUT91vGC.VcB/lK', 1, '2024-07-25 18:15:45', '2024-07-25 18:15:45'),
('9c9c6cd1-ef69-458a-99cc-a6f9e3af3427', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Shadewa Putra Alsirih', NULL, NULL, NULL, NULL, 23081, '$2y$12$IuFntgYiphCsRNh47E0QY.45rXnFdUsD.uPnMFdUs9PseDrgDXzTm', 1, '2024-07-25 18:15:45', '2024-07-25 18:15:45'),
('9c9c6cd2-42a0-4934-b73d-258775a9c219', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Vicky Brilyan Aquarista', NULL, NULL, NULL, NULL, 23090, '$2y$12$Wv8mMEbP7G3AWwKmclYL1.UZsPogI442khNoo8wr1G7b91H2caz6u', 1, '2024-07-25 18:15:45', '2024-07-25 18:15:45'),
('9c9c6cd2-95cb-4c1f-b0f4-93459192ba89', '25e59917-08d7-4d14-ac92-43ba07e48412', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zakiy Pratama Putra Paksi', NULL, NULL, NULL, NULL, 23094, '$2y$12$wzwp8Ur9QmTXpEduittyI.32Ut.K3lO/m/re0bMCGJQdN7v7SzZu6', 1, '2024-07-25 18:15:45', '2024-07-25 18:15:45'),
('9c9c6cd2-ea3e-4fb4-836b-913d921a3782', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Adhwa Nadiya Silmi', NULL, NULL, NULL, NULL, 23003, '$2y$12$21TNK8r9bwUImheoMPyHcupsEr.egCdguFTlE9yvK8KuzzLYq1ttm', 1, '2024-07-25 18:15:45', '2024-07-25 18:15:45'),
('9c9c6cd3-4015-46da-88df-2db85fe31bc8', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Adilla Ajeng Pangestuti', NULL, NULL, NULL, NULL, 23004, '$2y$12$Ea.uMQjahmVXQdKgPMWvSezkRaXQLj4eXgPqkT0RYoYs5LZwvr9sC', 1, '2024-07-25 18:15:46', '2024-07-25 18:15:46'),
('9c9c6cd3-9337-457a-ba70-0599b2427ed0', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aisha Mahesa Ranee', NULL, NULL, NULL, NULL, 23006, '$2y$12$1RV65JV8bLY/E0hmVoft1.4PKgdf.MhprwVkDXfgcWA1vWITLjJuG', 1, '2024-07-25 18:15:46', '2024-07-25 18:15:46'),
('9c9c6cd3-e7a3-470c-b4f6-f8792a7f8c7c', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Al Lodia Malaika Putri', NULL, NULL, NULL, NULL, 23008, '$2y$12$Uf7fcNAShIbEvHNNqZJZk.Otq4fl/0XKoFgUUezdSvx4NyuuE9Z9G', 1, '2024-07-25 18:15:46', '2024-07-25 18:15:46'),
('9c9c6cd4-3ab6-4e0f-bcfb-db251533d7c3', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Anggun Prasetia Utami', NULL, NULL, NULL, NULL, 23013, '$2y$12$h1ZcGbm22l483ju3eLzzvOTgliGp5CoyMZdwfB8JCAop/4pAIJg26', 1, '2024-07-25 18:15:46', '2024-07-25 18:15:46'),
('9c9c6cd4-8e9c-4f4b-80c7-235142b88ee9', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Annisa Wahdania Alhuda', NULL, NULL, NULL, NULL, 23015, '$2y$12$j9kZ7WYa4fAmiMCPseaPie7p.UWzRLna98Ci/jeub7OAabP/SUzoW', 1, '2024-07-25 18:15:47', '2024-07-25 18:15:47'),
('9c9c6cd4-e15f-4263-8b9a-bc11628c2bdf', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Anriannisa Kayla Bilqis', NULL, NULL, NULL, NULL, 23016, '$2y$12$6WogqDCBpv2UCLjxbYojguEPVUUuboQC3aWwB9yhHifkMlVkatDBi', 1, '2024-07-25 18:15:47', '2024-07-25 18:15:47'),
('9c9c6cd5-3608-4b3b-9e3c-88400cedb5b0', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Asma Kurnia Putri', NULL, NULL, NULL, NULL, 23019, '$2y$12$Nu4O.qXmY.dcMaTaglItPuLMhfPIODGxOpDHNPdw4UG7u6xQVDDLW', 1, '2024-07-25 18:15:47', '2024-07-25 18:15:47'),
('9c9c6cd5-8a82-4794-a176-9334f86d59c5', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Azizah Putri Damar Salsabila', NULL, NULL, NULL, NULL, 23024, '$2y$12$elUs1x.sbbsHfvMVV8r9UeTi0FR4ZFVmojpRIeTMv8EB2mm1RAmNW', 1, '2024-07-25 18:15:47', '2024-07-25 18:15:47'),
('9c9c6cd5-ddfa-4335-a1fe-4e80a71220d4', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Azka Amalina Ahmad', NULL, NULL, NULL, NULL, 23025, '$2y$12$TVa6s/NashOO91ghwtbkzOD8NEE9mvId5WmFaMNZbSsLEuybvoZ02', 1, '2024-07-25 18:15:47', '2024-07-25 18:15:47'),
('9c9c6cd6-328e-4b0a-8bdc-cbfc0d9e4e86', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Diani Syah Dia Wati', NULL, NULL, NULL, NULL, 23031, '$2y$12$/c5ECIsG.IPzFAIexpe2Q.Iu3YCqBRBSmzXVglq/kLGdoi/ja4KGu', 1, '2024-07-25 18:15:48', '2024-07-25 18:15:48'),
('9c9c6cd6-85bd-468c-af6b-d76d92da9823', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Dinar Ilmi', NULL, NULL, NULL, NULL, 23032, '$2y$12$Go/bNGFnJXbuonM3eTZqGOWEK6NncZlq.hYCxBUbLSn4Rk6aa2ZxS', 1, '2024-07-25 18:15:48', '2024-07-25 18:15:48'),
('9c9c6cd6-d8b3-445e-ad3a-2c7dd3d70fc3', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Fadia Larasati', NULL, NULL, NULL, NULL, 23035, '$2y$12$BJFYl3mW0c7.V2Olt5VAsucgRJGgUsBzxyCJH7ShUihK5Tcs7t23C', 1, '2024-07-25 18:15:48', '2024-07-25 18:15:48'),
('9c9c6cd7-2d9d-48ac-b08a-a7e584da8d8b', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Hanifa Amru As Syarif', NULL, NULL, NULL, NULL, 23042, '$2y$12$AxcrfgI3bFtMku/TC8lZ1e76BhCgKJGp/PuLBr0CzOcoKQFi8oHOO', 1, '2024-07-25 18:15:48', '2024-07-25 18:15:48'),
('9c9c6cd7-812c-4610-a62f-51df33e3187d', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Kayla Syifaa Jovira', NULL, NULL, NULL, NULL, 23046, '$2y$12$1sM.mvNwFRkDGTW1fpn5quZIW1JO1GoKPKfQm.ZmPkks4qUJKEvhi', 1, '2024-07-25 18:15:48', '2024-07-25 18:15:48'),
('9c9c6cd7-d578-4fee-9196-1078bd20e407', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Lulu Huwaidah Hibatullah', NULL, NULL, NULL, NULL, 23050, '$2y$12$ngNrLtpgZY1VP.RlAuWj3eSTTWjfUJUI43MHTbY9ZQeEM1ktlx0Q6', 1, '2024-07-25 18:15:49', '2024-07-25 18:15:49'),
('9c9c6cd8-2a11-43e6-be8c-66d6b2517f5b', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Lutfia Afifah', NULL, NULL, NULL, NULL, 23051, '$2y$12$S7SLE5EZYWJNf2Am/9a29uYPxoM3bXiPveV0Trr7DxkosV44VQ/wS', 1, '2024-07-25 18:15:49', '2024-07-25 18:15:49'),
('9c9c6cd8-7f89-47b0-aee2-d0ba1d75a662', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Marsha Ulva', NULL, NULL, NULL, NULL, 23056, '$2y$12$tYxsZnXJvB6DoBwn0grMZ.FhUU3VQDPG.T7JaEDrKYIkpYG8AzKoS', 1, '2024-07-25 18:15:49', '2024-07-25 18:15:49'),
('9c9c6cd8-d3ef-4b98-a446-38e9f2973a3d', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Mega Silvi Aulia', NULL, NULL, NULL, NULL, 23058, '$2y$12$Ny6tF8dV8ep5rQsZZQ0G9.gF6CK.dOtzYbO7cHGnBgeGzqgDhEIlG', 1, '2024-07-25 18:15:49', '2024-07-25 18:15:49'),
('9c9c6cd9-2932-4981-85bb-5d2ed36cdbd9', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nasywa Nurfadiyah Adlianty', NULL, NULL, NULL, NULL, 23067, '$2y$12$3pLCwsveq2/VJsyVliUg8.FGlRpaqJRFITPwTeCv/QOdMXmwyOCqS', 1, '2024-07-25 18:15:50', '2024-07-25 18:15:50'),
('9c9c6cd9-7c7a-498a-ae7c-bab797a58085', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Naurah Salsabila Calya', NULL, NULL, NULL, NULL, 23069, '$2y$12$xjudNpBFLcH67UqAM/dbluM8DiRASzOuLSm0Rgfs3PXxotJN0ysfG', 1, '2024-07-25 18:15:50', '2024-07-25 18:15:50'),
('9c9c6cd9-d0a0-4ae6-99a6-e3c2cef4eed5', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nesya Athifah Kirana', NULL, NULL, NULL, NULL, 23071, '$2y$12$y8RU0umkHKrbejh471IsTOMPM9a.Lm6/ZzHz0i84jEYlDpPTTRcLC', 1, '2024-07-25 18:15:50', '2024-07-25 18:15:50'),
('9c9c6cda-23a9-4975-b36a-4a4e66c35334', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Qunaita Madinatul Ghozy As Syahadah', NULL, NULL, NULL, NULL, 23074, '$2y$12$NbhjUTiaK8t6Ih4cI/x5fOHtg5XV9SrLo6O/MgvAhsB3o.oaRWY6G', 1, '2024-07-25 18:15:50', '2024-07-25 18:15:50'),
('9c9c6cda-781a-46d0-bbfd-1bcde2a7f8d8', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Restu Komala Dewi', NULL, NULL, NULL, NULL, 23077, '$2y$12$3AC8avPtHN8PKmtxdl1tjOh.K7ua0rx3LqReIomjzxFrS7NlT/Gxq', 1, '2024-07-25 18:15:50', '2024-07-25 18:15:50'),
('9c9c6cda-cff3-447b-ae01-d453b6ff403a', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Salwa Khalila Putri', NULL, NULL, NULL, NULL, 23079, '$2y$12$0Cs0FB/fwVWRmeQMxnVKae2om/hBWCnsXEXlSb3t/SCUT00ckSzZW', 1, '2024-07-25 18:15:51', '2024-07-25 18:15:51'),
('9c9c6cdb-244f-454a-9966-b3bc8f3139c1', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Sofi Azahra', NULL, NULL, NULL, NULL, 23084, '$2y$12$VCCUW89erjAQs4lZ3LF5R.85nmsvqt.1eLup/jrAYBZzig.a3GTxO', 1, '2024-07-25 18:15:51', '2024-07-25 18:15:51'),
('9c9c6cdb-7896-4c57-bc29-0b992f18bd7e', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Tazkiya Sabila Hasanah', NULL, NULL, NULL, NULL, 23088, '$2y$12$MnvzE5Wx3OsL.DnT1DCU2O/05AmTdDoYq4Cn3wjXuKE4CKOft4sbi', 1, '2024-07-25 18:15:51', '2024-07-25 18:15:51'),
('9c9c6cdb-cc53-4790-9f75-c4ee513c4948', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Yayang Althofunnisa', NULL, NULL, NULL, NULL, 23091, '$2y$12$swVCE48Co/10ja79mFGhfexktMIZjSvZeHBN/4UGhe/Xm8CeDAkHS', 1, '2024-07-25 18:15:51', '2024-07-25 18:15:51'),
('9c9c6cdc-2097-4e97-94d6-7b71fa9af73b', 'b8c7d0b4-6aad-4246-a122-2ee46a79cf5b', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zevia Dwi Amanda', NULL, NULL, NULL, NULL, 23096, '$2y$12$GZcbQUmp/w5tcfLpDNMBzeZyx41YLEF8ts.NtG0mbpb.r9T1nxyoO', 1, '2024-07-25 18:15:51', '2024-07-25 18:15:51'),
('9c9c6cdc-72bb-4241-9cfc-2d4fdec3993a', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aghnia Nur Zalfia', NULL, NULL, NULL, NULL, 23005, '$2y$12$/P8yRLOntS5ZHl.XxPXEZ.e/5r5pW6GIOOLckNJR7MwSTFlR3Ma4e', 1, '2024-07-25 18:15:52', '2024-07-25 18:15:52'),
('9c9c6cdc-c61a-44a7-8ca7-82a38c0bb392', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Alfira Nikeisha Qurrotu\'Ain', NULL, NULL, NULL, NULL, 23011, '$2y$12$nGt0OUidxKjJ4JzO9oJYpO8zhbqiVfi2o3lemFV2hZVBqgfvf31ya', 1, '2024-07-25 18:15:52', '2024-07-25 18:15:52'),
('9c9c6cdd-1a76-4b40-b853-bf8e9686d1e2', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aliya Rifka Assalwa', NULL, NULL, NULL, NULL, 23100, '$2y$12$RpbQu2FP1gzS7K/kng3iJu.BZt1FKrjseyoh6kakNeLCWPWeE8/q.', 1, '2024-07-25 18:15:52', '2024-07-25 18:15:52'),
('9c9c6cdd-6f52-4e52-9505-ed342dfcab6b', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Annisa Nur Azizah', NULL, NULL, NULL, NULL, 23014, '$2y$12$h4umIXHlHaGA/XBI5DMQ9uo0ZcuspukRqxNsGyjIKQb.1djVy5Nzi', 1, '2024-07-25 18:15:52', '2024-07-25 18:15:52'),
('9c9c6cdd-c3c2-49ac-87f8-b6a6b162016e', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Arjania Mara Shofia', NULL, NULL, NULL, NULL, 23017, '$2y$12$XmnCEDyGCq9xvDU9dBSl3OHlRKAC9BnSwx2jfG3a0DMr25QUeWTd6', 1, '2024-07-25 18:15:53', '2024-07-25 18:15:53'),
('9c9c6cde-1862-4dbe-9402-6c47effa1faf', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aufa Ashika Rahman', NULL, NULL, NULL, NULL, 23021, '$2y$12$jfr4NRtB70rxhOE/gT63jeugNJtK4Ri2Stp0an6Cj0zTRt6QRp6he', 1, '2024-07-25 18:15:53', '2024-07-25 18:15:53'),
('9c9c6cde-6ecc-47c6-9776-7d111523f61e', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aulia Azzahra', NULL, NULL, NULL, NULL, 23023, '$2y$12$RK8z5rEF2Y6Uwfg63.SgOepxseOaSYYbB1BlolZC.XQcoPZKwI5dC', 1, '2024-07-25 18:15:53', '2024-07-25 18:15:53'),
('9c9c6cde-c348-4771-bb25-f5aecca48ae1', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Chasya Fatihah Khairunnisa', NULL, NULL, NULL, NULL, 23027, '$2y$12$FqpPVC6bpdwGQc.FxFBs1uYa9bIV6TjptYhty6UjhiNrAns0sMfCG', 1, '2024-07-25 18:15:53', '2024-07-25 18:15:53'),
('9c9c6cdf-17ad-491a-8c72-e3e185b5e7de', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Elsa Nuri Fadhilah', NULL, NULL, NULL, NULL, 23033, '$2y$12$EwgRrFTOa71g4QeOfIp7Ku5Aw6ht5f0.Fv2JiwO0vn9S.UPKcM0Wu', 1, '2024-07-25 18:15:53', '2024-07-25 18:15:53'),
('9c9c6cdf-6b2c-4847-b7b3-c9b59e702f30', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Faridah Nafiah', NULL, NULL, NULL, NULL, 23038, '$2y$12$5BJAy7Khb2sCmDcsq7KLBejPyG8MoMTLk4uZ84i0rugt5t3rmzqZK', 1, '2024-07-25 18:15:54', '2024-07-25 18:15:54'),
('9c9c6cdf-c020-4edb-a24d-35817bd8ce9e', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Gebby Viola Priska', NULL, NULL, NULL, NULL, 23041, '$2y$12$51nb70rpzZqRQShsslsK/uMIIBLkGGVGSRIJZrDGu4IeiDzgBvWSu', 1, '2024-07-25 18:15:54', '2024-07-25 18:15:54'),
('9c9c6ce0-1461-4a0e-a870-b9ed54d4af99', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Kayla Humaira', NULL, NULL, NULL, NULL, 23045, '$2y$12$2lxvY2/B6ASjg7zEP9WC6.cW6f/x7dgX69S3K8ZXSYC6lB8LpMK0K', 1, '2024-07-25 18:15:54', '2024-07-25 18:15:54'),
('9c9c6ce0-699b-4bed-83a3-9f1d103feba7', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Lintang Azzahra', NULL, NULL, NULL, NULL, 23048, '$2y$12$4wNAwqLIM722Wq3KvIkI4Osj9Kpn1TXFgCt/hsmb68U17CMPQLvDm', 1, '2024-07-25 18:15:54', '2024-07-25 18:15:54'),
('9c9c6ce0-bd60-488c-8c1d-6aea23dcd19d', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Lovely Veoriyola Dawina', NULL, NULL, NULL, NULL, 23049, '$2y$12$rNvr8M9JHTaONtMlHSLs1erDbr3bVJTVPKrUhHOPTLO/fRnwNGfIu', 1, '2024-07-25 18:15:54', '2024-07-25 18:15:54'),
('9c9c6ce1-1026-4e13-878e-c3d8090e80e8', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Luthfiya Adriyani Mufida', NULL, NULL, NULL, NULL, 23052, '$2y$12$F5QbWjPdn3g2vaRGww5wmuE/Sb.qeJfeQ7riiZ2nVYyBuEhbnwVeu', 1, '2024-07-25 18:15:55', '2024-07-25 18:15:55'),
('9c9c6ce1-6389-4953-84bb-995da253ea6f', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Meca Althafunisa', NULL, NULL, NULL, NULL, 23057, '$2y$12$GPKeQI5qgVPQcTxWn3qFru4CU0Qpv9wx30LslAxNUf6v0.GJukeKa', 1, '2024-07-25 18:15:55', '2024-07-25 18:15:55'),
('9c9c6ce1-b7d3-43e8-afd5-5338d3a01298', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Meivie Sheril Azalea Fachsya', NULL, NULL, NULL, NULL, 23059, '$2y$12$1cjyhYzZkeOHr1rd0N9OSuiTqSA2lbrxGFv1utSFd4H7Z0wqSBX9m', 1, '2024-07-25 18:15:55', '2024-07-25 18:15:55'),
('9c9c6ce2-0c8a-44d0-8682-f4163267c479', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Naurah Nazhifah', NULL, NULL, NULL, NULL, 23068, '$2y$12$.uVz5HxBbv2Weeo7krAr/eTGZQCNncy7ZcAMkAuJlyq7qMF7XTa4m', 1, '2024-07-25 18:15:55', '2024-07-25 18:15:55'),
('9c9c6ce2-6088-4a40-a1df-bf699a86ebf7', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Neisya Fitra Maulida', NULL, NULL, NULL, NULL, 23070, '$2y$12$uZVSLtSXLvRJ.7l/FBTmVuu80nen1X7zrTfFgnhzk3gyx9j9AKsdO', 1, '2024-07-25 18:15:56', '2024-07-25 18:15:56'),
('9c9c6ce2-b4b8-4fb1-a687-b6eb1509f785', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nesa Amalia', NULL, NULL, NULL, NULL, 23099, '$2y$12$HGNzKAs2PqBuPw5bZVGxtetVWGUH3tIAhpig31uLiDbIFwAkS0b5m', 1, '2024-07-25 18:15:56', '2024-07-25 18:15:56'),
('9c9c6ce3-098c-4d82-9037-f962deaee0b2', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Qonita Afiyah Nadhira', NULL, NULL, NULL, NULL, 23073, '$2y$12$CjeEdWlU4NyYwn.caLXASuyii/LtThRdgUHmp1e1AgmCDDIGik8K2', 1, '2024-07-25 18:15:56', '2024-07-25 18:15:56'),
('9c9c6ce3-5da2-410d-90dc-8fc18ec54de6', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Raisya Deitra Anindia', NULL, NULL, NULL, NULL, 23076, '$2y$12$tQlXIWmL2qJg.zyxv0Bit..MRv59fW7nmV9oAK.lUPRbuQaOT/LMC', 1, '2024-07-25 18:15:56', '2024-07-25 18:15:56'),
('9c9c6ce3-b2b2-4db5-abee-4c47e72dff2e', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Shilla Reva Lensa', NULL, NULL, NULL, NULL, 23082, '$2y$12$BMKlf69zCZNNOfzW6gKu1.FpkA0YlhCe6YGBstHmx70dpWTa46m4W', 1, '2024-07-25 18:15:56', '2024-07-25 18:15:56'),
('9c9c6ce4-06ca-4d94-b10b-78d455e5dfef', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Sifa Awaliya', NULL, NULL, NULL, NULL, 23083, '$2y$12$RvXuZAlvpd4j7KWoIbE6Uu87sifaJIQYVvoc62X03Ks.sLjgXruTu', 1, '2024-07-25 18:15:57', '2024-07-25 18:15:57'),
('9c9c6ce4-5c0d-4263-8df3-13ce1fc36e99', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Syakila Firdausi Ahla', NULL, NULL, NULL, NULL, 23086, '$2y$12$ieplTPBJcMCWjhKm5NbPb.eKhRT6yU00Wt3aSOnyRlGcpKD7ekNcq', 1, '2024-07-25 18:15:57', '2024-07-25 18:15:57'),
('9c9c6ce4-b017-43f2-9886-b3ba63b665b7', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Vanizza Afrizal', NULL, NULL, NULL, NULL, 23089, '$2y$12$WV9m7n8ule5AD4Ixa0/M0ugS5j6lYZc..A1ZJQEy8hzwmS3.tQHv2', 1, '2024-07-25 18:15:57', '2024-07-25 18:15:57'),
('9c9c6ce5-0380-4a07-990e-41b4178f641f', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zahratussiva', NULL, NULL, NULL, NULL, 23093, '$2y$12$DFkOPZm6GwgLUUdxrpuKm.zeKVDJyA8bo24UXoaX1hRWmPtYbI66m', 1, '2024-07-25 18:15:57', '2024-07-25 18:15:57'),
('9c9c6ce5-57df-49a9-844e-22c8cdcb443d', 'f9d930c5-9b36-4738-9a18-1dbd5a6a12c8', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zhafira Azzahra', NULL, NULL, NULL, NULL, 23097, '$2y$12$vDpk2miUARwVmcHheV7C1OfcU4QS5iJzLs6DZ6Ms6EIIc41pYuUiW', 1, '2024-07-25 18:15:58', '2024-07-25 18:15:58'),
('9c9c6ce5-ad30-4a2f-b6e0-0719a94b2b22', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Aditya Surya Pratama', NULL, NULL, NULL, NULL, 22003, '$2y$12$Yi5ADtOT8wWEkFyXhxZDSOqQGNtdUY2291BmQlh.ZqzxZV8XtZo4C', 1, '2024-07-25 18:15:58', '2024-07-25 18:15:58'),
('9c9c6ce5-fff6-405d-b0e6-d9ac82ccf905', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ahmad Fakhrial Aziiz', NULL, NULL, NULL, NULL, 22007, '$2y$12$ZjWSMdLjEuAxFZvb7kwBBuSmJpNKwbn/81j7r.VjbKhop5xact/H.', 1, '2024-07-25 18:15:58', '2024-07-25 18:15:58'),
('9c9c6ce6-54ab-4471-8d56-81b16919570e', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ahmad Khadavi Cody', NULL, NULL, NULL, NULL, 22008, '$2y$12$7LuDBVNQ.oK7mEX8JMQi3.Qg2tV9BREfzPD1fRYE3ghym4MN/eFQq', 1, '2024-07-25 18:15:58', '2024-07-25 18:15:58'),
('9c9c6ce6-a883-4eb1-8e08-6a850038f1cc', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ahmad Raihan', NULL, NULL, NULL, NULL, 22009, '$2y$12$5jj6p3H0fEyTTmPq22ccdOf9r1R3kk.r.nuq3R36jhSylvabh51Fi', 1, '2024-07-25 18:15:58', '2024-07-25 18:15:58'),
('9c9c6ce6-fd44-4c75-b19e-1d65e1664408', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Anggira Diransyah', NULL, NULL, NULL, NULL, 22017, '$2y$12$Ojp15AYtx8nVOEB4WthFHu1Tcq/OrCLYmoMzGPLrdi0QADZMyYrim', 1, '2024-07-25 18:15:59', '2024-07-25 18:15:59'),
('9c9c6ce7-521b-4d6c-a093-6017f0756fcf', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Bagus Erlangga Mahyudi', NULL, NULL, NULL, NULL, 22023, '$2y$12$U05TopLX605Ez9HpvskPQehou2JNNj99GEYCNKyEs3v/ChNiqTewi', 1, '2024-07-25 18:15:59', '2024-07-25 18:15:59'),
('9c9c6ce7-a5dd-4539-b25a-0c46aca31c6d', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Juan Rafli Birrulwaalidayn', NULL, NULL, NULL, NULL, 22049, '$2y$12$rleqC.O0jYZaSFkF1.rLP.PvovSY/Tf4yzSHHmGN12LxBii4ttUuG', 1, '2024-07-25 18:15:59', '2024-07-25 18:15:59'),
('9c9c6ce7-f99b-4f65-857c-36c23ef97da9', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Faiz Hibaturrahman', NULL, NULL, NULL, NULL, 22056, '$2y$12$zW0VqvwXQ39GTu91oG.GwuCbJHI6GCOQoNbKU6Rsex/tEHG/qr9uG', 1, '2024-07-25 18:15:59', '2024-07-25 18:15:59'),
('9c9c6ce8-4d7b-4793-832c-5548e7228bc6', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Muharam Al Munawar', NULL, NULL, NULL, NULL, 22059, '$2y$12$y/Fv7vMzOKsiBOIf2oNWduMcLDj.CYPWWvExLJp0U65rqU20qO3aS', 1, '2024-07-25 18:15:59', '2024-07-25 18:15:59'),
('9c9c6ce8-a3ec-48b3-b525-112736838103', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhamad Rocky Ridwansyah', NULL, NULL, NULL, NULL, 22065, '$2y$12$/DWGw71vthERW1oTGDYEg.R/FVlfBLUZPUrbrHZ6Gaiin5ErD2u4a', 1, '2024-07-25 18:16:00', '2024-07-25 18:16:00'),
('9c9c6ce8-f975-479e-b738-c47664c679c9', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Ammar Ashari', NULL, NULL, NULL, NULL, 22066, '$2y$12$p0ZCre7ICygcCXQpHUA0POQKU85M4Dd4cjrT/DzXGar5P1H0cfrMm', 1, '2024-07-25 18:16:00', '2024-07-25 18:16:00'),
('9c9c6ce9-5140-48c3-aa65-d986ad2a2911', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Fadhil Antarun', NULL, NULL, NULL, NULL, 22071, '$2y$12$LSdjQG2LGbcmn0qAf1BEWeCAoT5kU61Nob8xImN3Sr5wDFeIYMw42', 1, '2024-07-25 18:16:00', '2024-07-25 18:16:00'),
('9c9c6ce9-a43e-43c1-936d-f0ce255e5881', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Ibnu Habibi', NULL, NULL, NULL, NULL, 22077, '$2y$12$KyLWhV07NpC/TudQVD./J.I1a5sSh/3deibWVEt52x.E6DGJ02E9W', 1, '2024-07-25 18:16:00', '2024-07-25 18:16:00'),
('9c9c6ce9-f891-44f8-ae21-69ede7d0adbe', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Rafid Dzakwan', NULL, NULL, NULL, NULL, 22079, '$2y$12$T6ZRUO3Bclcv/zaoRIQUquYnWaiVYyRZnePDFfOlR1E.NCdvOE5U.', 1, '2024-07-25 18:16:01', '2024-07-25 18:16:01'),
('9c9c6cea-4bac-4b36-a67f-2554151692e4', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Rakha Fadli', NULL, NULL, NULL, NULL, 22128, '$2y$12$FCN02P3txx7v4IZ0wbEzYeVjP6UNc28QFr26uQjd/qM1uvOk8q/aS', 1, '2024-07-25 18:16:01', '2024-07-25 18:16:01'),
('9c9c6cea-a26d-49bf-86ff-ace41e0beabd', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Najwan Jundulloh', NULL, NULL, NULL, NULL, 22088, '$2y$12$UD0dJNrRekUEsG0CqVHIdOiSwjrjkCmtvCm/xyVgEAZCLSDzbzdmK', 1, '2024-07-25 18:16:01', '2024-07-25 18:16:01'),
('9c9c6cea-f7f1-4072-8162-c933b38a9899', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Revaldo Rudiannanda', NULL, NULL, NULL, NULL, 22104, '$2y$12$oDsW53QDDXt2InOLFeim/eSGhW7e34WnZjm.7ebeUHUk0CRQQ4QTa', 1, '2024-07-25 18:16:01', '2024-07-25 18:16:01'),
('9c9c6ceb-4d31-4d26-bc90-a33b4b40ad69', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Syaikhul Akbar', NULL, NULL, NULL, NULL, 22114, '$2y$12$uS20eFupcpOIRisifI9ZFOR9GwyS76wh8HtlCCeR51JDo7Ex8ke5m', 1, '2024-07-25 18:16:01', '2024-07-25 18:16:01'),
('9c9c6ceb-a219-495d-af57-718c4f706555', '5c913451-a32a-447a-8880-0f388975f9cf', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Yohan Yovandi', NULL, NULL, NULL, NULL, 22121, '$2y$12$hiZ2qLuQAQGJQzjdmDdO5ejDGk.kSwcrX4ZE/y7.7dDr8BBco25Am', 1, '2024-07-25 18:16:02', '2024-07-25 18:16:02'),
('9c9c6ceb-f8e4-4367-b5c7-d6a803912165', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Dimas Abi Wibowo', NULL, NULL, NULL, NULL, 22028, '$2y$12$tbNThJp3g58Mds2ZsIBaU.KfRqCo6rlDXZt0babjdcwmtO3mYSqLS', 1, '2024-07-25 18:16:02', '2024-07-25 18:16:02'),
('9c9c6cec-4ee7-4df4-b308-65af8f43cf64', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Erino Ibnu Zhafran', NULL, NULL, NULL, NULL, 22032, '$2y$12$.4VkIxDw5eRZ3hoIMrrZquAKJ4969f4P8cbdqmsfKMM/U95ngabma', 1, '2024-07-25 18:16:02', '2024-07-25 18:16:02'),
('9c9c6cec-a3b7-4028-afd3-e38a4023cbd2', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Faisal Yusuf Qordhowi', NULL, NULL, NULL, NULL, 22034, '$2y$12$HWHLbH1zSOVV77qfx9dvKOWEpxEKT2tsyewlmnnIWQg9ROIzEFolq', 1, '2024-07-25 18:16:02', '2024-07-25 18:16:02'),
('9c9c6cec-f930-4ee9-875c-187babb3888e', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Hafidzon Galih Pratama', NULL, NULL, NULL, NULL, 22042, '$2y$12$lXi5qZzDkp.XqtkqGL2j8eIZsEoUCmb0bFbVfN1PnqxBwGKILYt3a', 1, '2024-07-25 18:16:03', '2024-07-25 18:16:03'),
('9c9c6ced-4d1f-439a-96fb-90eec5198f82', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Hatta Marwa Bakti', NULL, NULL, NULL, NULL, 22045, '$2y$12$6tijN26LQcaqMFGboEm5Oe8Id3eh1Acen.OIqn5hd2lBpOwgi8c2C', 1, '2024-07-25 18:16:03', '2024-07-25 18:16:03'),
('9c9c6ced-a18b-4f8f-b296-a3e2cca2c0a4', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Haidar Al Faruq', NULL, NULL, NULL, NULL, 22058, '$2y$12$x7RhNSbxFONzFo66J.h.TewvtXRNfURpo.bDElNpv9nqOtOTXzeDe', 1, '2024-07-25 18:16:03', '2024-07-25 18:16:03'),
('9c9c6ced-f77f-4561-9172-8e41a5fac615', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'M. Rafi Alfarel', NULL, NULL, NULL, NULL, 22060, '$2y$12$gqb6mSYhI5Klo4BZ1s7QO.tIKxyVlaNJd0n3U8JySlyUoT.m3RwVS', 1, '2024-07-25 18:16:03', '2024-07-25 18:16:03'),
('9c9c6cee-4b04-4a27-a8eb-439c9e2759ab', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhamad Hafiz Nuril Qolbi', NULL, NULL, NULL, NULL, 22075, '$2y$12$Fbu0ij1.HyfDCqhfOzKlwePuYLoLKe6Q51woNdTRVvCe0titS/wqa', 1, '2024-07-25 18:16:03', '2024-07-25 18:16:03'),
('9c9c6cee-9eda-4775-99fa-43beb711d6cb', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Daniyal Karama', NULL, NULL, NULL, NULL, 22067, '$2y$12$Vb/YMa4BGOTNQ0iDeJsyzeCVykDO3PRwSooNwVXMFzUOJsdPzrCO2', 1, '2024-07-25 18:16:04', '2024-07-25 18:16:04'),
('9c9c6cee-f3aa-4440-95c3-39e17ade7948', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Daud Ayubi', NULL, NULL, NULL, NULL, 22068, '$2y$12$GzTLsJTrgUfxS/aqeu8KWe.xXICbmaDb3zX2dFiO2Ln2fLqzNx2Fq', 1, '2024-07-25 18:16:04', '2024-07-25 18:16:04'),
('9c9c6cef-4a36-4725-97e5-81f2430b1319', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Dzaki', NULL, NULL, NULL, NULL, 22069, '$2y$12$Vjtl79Pc3JaY9lteU8PVkuINdzMwsLIklk0lFZLbDTzLJaaQTmNV2', 1, '2024-07-25 18:16:04', '2024-07-25 18:16:04'),
('9c9c6cef-a287-42f6-8a93-452b741c5fd3', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Fachry Azka', NULL, NULL, NULL, NULL, 22070, '$2y$12$yMcxlYBnh8Dm/R6Crne9Je2xQTXJMTmqG22ZhMVD1kbTrC/RjWM0q', 1, '2024-07-25 18:16:04', '2024-07-25 18:16:04'),
('9c9c6cef-f663-4879-b7ab-f38ef3454f64', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Muhammad Hafizh Fadhilah', NULL, NULL, NULL, NULL, 22074, '$2y$12$oktquodjQSU78foW4F8aUOFhPnwM0rgCZZJy9BLpi8hSvpFALKPf.', 1, '2024-07-25 18:16:04', '2024-07-25 18:16:04'),
('9c9c6cf0-49f7-47aa-b8f6-971e885f71a8', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Mumtaz Ibadurrahman Ats Tsalits', NULL, NULL, NULL, NULL, 22082, '$2y$12$iKFE16s3bRX9dXnuoJKmw.th6.UYfHiQHbmFcgpfwjXq1gaH0DXFe', 1, '2024-07-25 18:16:05', '2024-07-25 18:16:05'),
('9c9c6cf0-9d94-4158-9880-b51f0f8344b4', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nabill Havitz Al-Ayubi', NULL, NULL, NULL, NULL, 22085, '$2y$12$TJFdipv9GmV5kMTbkiMmee02UiLHvvVZHEq4Wa2IA2nnUK3dTjBo2', 1, '2024-07-25 18:16:05', '2024-07-25 18:16:05'),
('9c9c6cf0-f416-4c85-9965-0f16681bd97a', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Raihan Afreza Ramadhan', NULL, NULL, NULL, NULL, 22099, '$2y$12$OVV/y0MTBzC6rztL5MBSO.ig5ibGgvHPA6Oq0Uh4OdbrKddCA1KCW', 1, '2024-07-25 18:16:05', '2024-07-25 18:16:05'),
('9c9c6cf1-4de8-4b67-a1fe-05a1f0ebc393', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Reifki Wardana', NULL, NULL, NULL, NULL, 22103, '$2y$12$FG3RS2fJ89LeUUjriDd0ceJrJCT0k7eWRFSEeyC7c3To34NbluoBG', 1, '2024-07-25 18:16:05', '2024-07-25 18:16:05'),
('9c9c6cf1-a120-41a2-a194-f5e37ef21ea4', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Reza Rizqian Irsyad', NULL, NULL, NULL, NULL, 22105, '$2y$12$DAWehMm0EjtUUNYN7twwluVwBwmnOYfKSsGdBVo8Jz7IXpfses/Be', 1, '2024-07-25 18:16:06', '2024-07-25 18:16:06'),
('9c9c6cf1-f399-4608-84d3-518a4197afa4', 'd83c60c0-bef9-4b05-888d-550e2a100845', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Tahta Yudhistira', NULL, NULL, NULL, NULL, 22117, '$2y$12$en.oTKG0bZKZ21PYLfZsNO0O7H2HICiUm2PzBTEUqR47ogRl56mgO', 1, '2024-07-25 18:16:06', '2024-07-25 18:16:06'),
('9c9c6cf2-46af-40af-b23f-58a46e6f6568', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Afifah Daniyah Syamila', NULL, NULL, NULL, NULL, 22005, '$2y$12$swjYO8LUmSvlIDsdAlYf.etMx5rFOh7xkTQ2du1dPqLTupLthLIMe', 1, '2024-07-25 18:16:06', '2024-07-25 18:16:06'),
('9c9c6cf2-9c5e-4572-977b-abdb766a0980', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Agies Melsya Rahmadani', NULL, NULL, NULL, NULL, 22006, '$2y$12$ktucXRfT9Q4tr/wlt/IUNOaH3o/J7QHzS9ozK8ZPSVeH4toRvVPEC', 1, '2024-07-25 18:16:06', '2024-07-25 18:16:06'),
('9c9c6cf2-f1dc-4888-a2ab-15900f674186', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ajeng Dwi Prameswari', NULL, NULL, NULL, NULL, 22010, '$2y$12$CwK4HUGkTCj6MZoGqF5ZReQBYDdGaaMSN1Jzq4Ck50Vl1VE4aRvJ.', 1, '2024-07-25 18:16:06', '2024-07-25 18:16:06'),
('9c9c6cf3-46b9-4a21-a800-b0da5dd9a3e8', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Alya Mukhbita', NULL, NULL, NULL, NULL, 22012, '$2y$12$3Zfb/eYh.octj/arSF5ocOV7qYaOuK4hxDE5UjOJSqytblDgbBFUK', 1, '2024-07-25 18:16:07', '2024-07-25 18:16:07'),
('9c9c6cf3-9a56-41a7-831b-373087c40f03', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Alyaa Rosyaadah', NULL, NULL, NULL, NULL, 22013, '$2y$12$unkiwpYFRcF8IjaFnap7IuUgPXF36iRvQ6vhuFkw8bYehcJ6NDcIe', 1, '2024-07-25 18:16:07', '2024-07-25 18:16:07'),
('9c9c6cf3-ef09-4e33-93b1-3528f07dd7df', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Azarine Zuleika Syah', NULL, NULL, NULL, NULL, 22020, '$2y$12$TVQXJOg6D9qnBe07muvL4.3iu8D7NPFWW/vK.7QnLCRWDYFGvhwL6', 1, '2024-07-25 18:16:07', '2024-07-25 18:16:07'),
('9c9c6cf4-4446-4e0e-b57a-ee8c176e40ad', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Bintang Noerwasqitha', NULL, NULL, NULL, NULL, 22024, '$2y$12$IuSplsTZPpWl9chObuyZpeVvf4/c99cDLS1ftstma4wlDApUVEj8.', 1, '2024-07-25 18:16:07', '2024-07-25 18:16:07'),
('9c9c6cf4-99a3-423c-acf4-ca112184bb93', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Chairunnisa Putri Andira', NULL, NULL, NULL, NULL, 22025, '$2y$12$KEUrlK8sp9YmkdE2Qkx5f.BK1xOAL2fB60ZzTaLOzXOyy2Wc/VPBi', 1, '2024-07-25 18:16:08', '2024-07-25 18:16:08'),
('9c9c6cf4-ee96-4240-89c2-e78bc1f4dd29', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Fazhra Batrisyia Al Hadi', NULL, NULL, NULL, NULL, 22037, '$2y$12$JgSV.RMEjVftds2BbX6IRugTe8zcxESQaGiQIo5U9CK2phkYfDOlu', 1, '2024-07-25 18:16:08', '2024-07-25 18:16:08'),
('9c9c6cf5-4443-4d6c-b33c-d3519c2c69e6', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Fherischa Oktaviana Putri', NULL, NULL, NULL, NULL, 22038, '$2y$12$bngyM35HoPHOLBkTHBdhze6swSazLA3Vb5jQbxeTDPGOx3rUn7VXq', 1, '2024-07-25 18:16:08', '2024-07-25 18:16:08'),
('9c9c6cf5-9894-4641-b340-8097a5522fb3', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Hana Najla Mufidah', NULL, NULL, NULL, NULL, 22043, '$2y$12$zPz46HTDFuurNmSpOTtYseMbEGskDm2VxrgDAr4/BaDjQQFIyCM7y', 1, '2024-07-25 18:16:08', '2024-07-25 18:16:08'),
('9c9c6cf5-eef6-4810-832a-8c8b7736e3b4', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Iftita Cahyani Suwahyono', NULL, NULL, NULL, NULL, 22048, '$2y$12$wElb/QTUUHm7NRjVdNymcOCyRTuzDaMT5yhqxwxdI0oASUryySbdS', 1, '2024-07-25 18:16:08', '2024-07-25 18:16:08'),
('9c9c6cf6-4354-478e-b98b-98a1b2e30111', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Kayla Althafunnisa', NULL, NULL, NULL, NULL, 22050, '$2y$12$7ovjUBSsYQKJ8VxK0ntwYe7CNT0lzTsJ4JbVh/iOh2GrpKmMH0I0i', 1, '2024-07-25 18:16:09', '2024-07-25 18:16:09'),
('9c9c6cf6-9577-44c7-83b9-ae13f9cca17e', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Kayla Oktavia', NULL, NULL, NULL, NULL, 22051, '$2y$12$7OziCfjKEDUUX5a1AycSFeJAdHvV8WyigKQM32BFEKtaEDiqfbeUS', 1, '2024-07-25 18:16:09', '2024-07-25 18:16:09'),
('9c9c6cf6-e8eb-419c-8282-b658caff5ed1', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Khoirun Nisa Rahman', NULL, NULL, NULL, NULL, 22053, '$2y$12$H5IRnzFFQV0X9zkR5YRt/.3CV9nDc4Znr3P3K0PXF8RuXsNsCjO0a', 1, '2024-07-25 18:16:09', '2024-07-25 18:16:09'),
('9c9c6cf7-3ca6-4470-ad88-5e7affdb8bc5', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nafsa Nazila Qurota A\'yun', NULL, NULL, NULL, NULL, 22087, '$2y$12$T8v3IK36AqywbKVh4nndkufvCOMbHMNk1TA4Fzgbjliu6KeS7BO4a', 1, '2024-07-25 18:16:09', '2024-07-25 18:16:09'),
('9c9c6cf7-93d9-414a-a79f-973557b1a2fa', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nashita Aynara', NULL, NULL, NULL, NULL, 22089, '$2y$12$qJSzv2p/Tm0f/6Dc.FeoPuAN1pK37Os3cyL9YaDXFNCiqgNwDJjuq', 1, '2024-07-25 18:16:09', '2024-07-25 18:16:09'),
('9c9c6cf7-e7ef-4a18-9c39-cbaa02ed0d8c', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Naura Nadya Shofi', NULL, NULL, NULL, NULL, 22090, '$2y$12$TNX.4DErz9qC5c9tsxFpt./fNMYmyE8cpGVMPdax7j1dCuFL9LqMe', 1, '2024-07-25 18:16:10', '2024-07-25 18:16:10'),
('9c9c6cf8-3bf1-452f-8881-424ec32e185e', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nur Khasanah', NULL, NULL, NULL, NULL, 22129, '$2y$12$oTJ7T5LooFGRX4vYe1vGM..W0H1/T1XL9U..wkigNZ0JfUG9QWdkG', 1, '2024-07-25 18:16:10', '2024-07-25 18:16:10'),
('9c9c6cf8-9001-4b98-a319-138d8fa6518c', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Pinkan Shepianti Ivanka', NULL, NULL, NULL, NULL, 22095, '$2y$12$klZB8OGQhtzCGv6byupP4.tLjmGHjx0fk.x4twxn2h0mCbnwlbKTW', 1, '2024-07-25 18:16:10', '2024-07-25 18:16:10'),
('9c9c6cf8-e49f-4ac0-a321-40412f687b33', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Putri Amaliatul Husna', NULL, NULL, NULL, NULL, 22096, '$2y$12$198GCxwXO6k82QhGeKv2Jutt5oxylRHCzhff45MAueMSsZGXjq8gq', 1, '2024-07-25 18:16:10', '2024-07-25 18:16:10'),
('9c9c6cf9-3bd6-4fe9-bb8a-d2e8256b1969', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Qisti Aulia', NULL, NULL, NULL, NULL, 22097, '$2y$12$QQObY/1BDvNwWyWLdqSC..h8i0hfVFUvK0JYjrP.X.zSspVQRaWWa', 1, '2024-07-25 18:16:11', '2024-07-25 18:16:11'),
('9c9c6cf9-8f6f-4f2b-a7ce-0f7ac048bd09', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Rahadatul \'Aisyi', NULL, NULL, NULL, NULL, 22098, '$2y$12$U4XrGCmTzwfjcuizBxg.6eGkvL4x1WojiCsj/pgTwXJrlfWoSOj/O', 1, '2024-07-25 18:16:11', '2024-07-25 18:16:11'),
('9c9c6cf9-e328-4494-86ff-dbedcd9bba41', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Sakinah Farhana Al-Qisthi', NULL, NULL, NULL, NULL, 22108, '$2y$12$3MNkoT1BoMj.Jg/gFDGUQORqlIsNDcWc/DRbm8kqW5N2a2aw1fYGq', 1, '2024-07-25 18:16:11', '2024-07-25 18:16:11'),
('9c9c6cfa-396e-4a80-8eae-9a5a760c937b', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Salsabila Rahma Zavi', NULL, NULL, NULL, NULL, 22109, '$2y$12$OX9/YeLvci7DW6NuJxQ3n.Oc7/1seUaiUxUK3Kq9dGJ5A2GpLJhDy', 1, '2024-07-25 18:16:11', '2024-07-25 18:16:11'),
('9c9c6cfa-8ca7-4715-852d-1722bf273fa3', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Shidqia Husna Azzahra', NULL, NULL, NULL, NULL, 22113, '$2y$12$D5T0OHuXL6ii3jBBn2xvDeuwpUUoQSDOT/uai0udHv2xZHBUxLncu', 1, '2024-07-25 18:16:11', '2024-07-25 18:16:11'),
('9c9c6cfa-e27c-42f3-b892-32bdc3118cad', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Syifa Allya Jayanti', NULL, NULL, NULL, NULL, 22116, '$2y$12$sc5mhP6QLsDzmyLo5TVqS.jCSPVYFwUUKQrcByPODwrWr.x42kheC', 1, '2024-07-25 18:16:12', '2024-07-25 18:16:12'),
('9c9c6cfb-368e-4288-a89f-714ba4bd3688', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Tiara Azizah Rahma', NULL, NULL, NULL, NULL, 22120, '$2y$12$mzEEcBwLra7HioZBBmDckOgqiKvvqKIJfU9i4bMlm.uCbZFBbwkUe', 1, '2024-07-25 18:16:12', '2024-07-25 18:16:12'),
('9c9c6cfb-8bbc-4985-b8a4-8fe2f3834683', 'a053b96e-f927-4388-bc9a-4ec08eacc417', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zafira Al Zahwa', NULL, NULL, NULL, NULL, 22123, '$2y$12$7gPZB0PaFCtP.IXb3GWdCOqUkJgje/458A.wgs6WlVLzdxmjRMBeW', 1, '2024-07-25 18:16:12', '2024-07-25 18:16:12'),
('9c9c6cfb-dfae-4d3d-9df8-ca9e1497f7e2', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Amanda Asfa Awliyawati', NULL, NULL, NULL, NULL, 22014, '$2y$12$R98vhfXF4TzFAWHqZWCzquDWUDq7ZKND8haacGhV5i10VHFYcAYUO', 1, '2024-07-25 18:16:12', '2024-07-25 18:16:12'),
('9c9c6cfc-32e9-4200-8a38-781786caa864', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Amirah Labibah Alhusna', NULL, NULL, NULL, NULL, 22015, '$2y$12$M6x5HBYpv43ege.DjPUT4.lXjUxmAYoXbP3rMzLb.s6r4rjQ6ytCu', 1, '2024-07-25 18:16:12', '2024-07-25 18:16:12'),
('9c9c6cfc-8980-48d4-8ffa-a6b79af6b4cf', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Amrina Cannesya', NULL, NULL, NULL, NULL, 22016, '$2y$12$5ylsNYKkjstNproesXEZqO201yw7walTIBdG1nzvvUptb4U5bKHuy', 1, '2024-07-25 18:16:13', '2024-07-25 18:16:13'),
('9c9c6cfc-e01e-4f31-8098-859ddef5be9b', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Arsyafida Pahlawanidya Mustika', NULL, NULL, NULL, NULL, 22018, '$2y$12$4q6uqG3D0XbHm2L7lkhbt.iOAilzEK3AXYbSfLOzMHIPdSnCMQR7e', 1, '2024-07-25 18:16:13', '2024-07-25 18:16:13'),
('9c9c6cfd-33fa-471d-bf8e-4565028efc1b', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Assyifa Nurullaili Salsabila', NULL, NULL, NULL, NULL, 22019, '$2y$12$2UtI3Oe4qKCkKTZ6QCvsBO7yrreqXO4MZuDX4M.wRBfVihmV4ACxu', 1, '2024-07-25 18:16:13', '2024-07-25 18:16:13');
INSERT INTO `siswas` (`id`, `kelas_id`, `program_bimbel_id`, `nama_siswa`, `tgl_lahir`, `tmpt_lahir`, `no_hp`, `foto_siswa`, `nis`, `password`, `status`, `created_at`, `updated_at`) VALUES
('9c9c6cfd-8763-42b3-81a6-3f05d5907dfb', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Cindy Rabilia Prasasti', NULL, NULL, NULL, NULL, 22026, '$2y$12$6y.Nhu.jIHjYJqWFCMZtu.bx74Yq1xMYtFnIV3EAzrTPdE5dcSwFu', 1, '2024-07-25 18:16:13', '2024-07-25 18:16:13'),
('9c9c6cfd-db02-4146-94c3-84c59b7330ca', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Dzikrina Khansa Asy Syahida', NULL, NULL, NULL, NULL, 22029, '$2y$12$wPxO/PH6cgKx7nZMFPRSMOu.f8PiXimEXPuFHiOLSmrMUMLhGAlRa', 1, '2024-07-25 18:16:14', '2024-07-25 18:16:14'),
('9c9c6cfe-307b-4a03-ae0d-50e18f6958be', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Emylia Putri', NULL, NULL, NULL, NULL, 22031, '$2y$12$qTVfekG0YaQ0TNnbXF5xP.AReNaWzdfhQTTKY4gF/f0v/QjD5w9ru', 1, '2024-07-25 18:16:14', '2024-07-25 18:16:14'),
('9c9c6cfe-8398-427a-b9d2-24d564d1392e', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Farah Nur Salsabila', NULL, NULL, NULL, NULL, 22035, '$2y$12$Who5uZ2Heaty92E/835nGe1Itfn8G6TAcvPqSz/lDuYri0xuhhrzi', 1, '2024-07-25 18:16:14', '2024-07-25 18:16:14'),
('9c9c6cfe-d7a6-49c0-b94e-5ef2368c5995', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Gerry Rahmawati', NULL, NULL, NULL, NULL, 22039, '$2y$12$QTOfYcwJXOZPRwujgZMOae1ryms3gLY1DD81PLx4GJfMhhCwJFMQS', 1, '2024-07-25 18:16:14', '2024-07-25 18:16:14'),
('9c9c6cff-2d20-48f8-8ed7-7592386be51e', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ghaisani Venara Janeeta', NULL, NULL, NULL, NULL, 22040, '$2y$12$e.lle5.nDC3wuisGs54DKuX0bDxD0.iY11kdPuj78J0bcWzeVxVkC', 1, '2024-07-25 18:16:14', '2024-07-25 18:16:14'),
('9c9c6cff-8036-4fef-935f-eeab28a1354f', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ghefira Afifah Az Zahra', NULL, NULL, NULL, NULL, 22041, '$2y$12$HD5jfTicppNg53/mb0LuBOA1q5V4FePz27iMPHP5R3Wl3r80TbAPG', 1, '2024-07-25 18:16:15', '2024-07-25 18:16:15'),
('9c9c6cff-d667-4dbf-a059-a3bec91a6355', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Hannadia Hafydda', NULL, NULL, NULL, NULL, 22044, '$2y$12$mE5pCo23jrkYREsxtUi0FOlwjrbO2iDj4H92fUvO5ut49uKyEkxGK', 1, '2024-07-25 18:16:15', '2024-07-25 18:16:15'),
('9c9c6d00-2df9-437a-ad33-fa41e113309b', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Keyzia Alya Mukthabita', NULL, NULL, NULL, NULL, 22052, '$2y$12$DVePeWpVylI2JWfWwSz81enmzSuUNZ5LwQUUwLDrN11XbxjbovpS6', 1, '2024-07-25 18:16:15', '2024-07-25 18:16:15'),
('9c9c6d00-8324-4fbb-8bc4-0a16b478c470', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Mazia Asma Humaida', NULL, NULL, NULL, NULL, 22062, '$2y$12$U2IWzRmBtgkB5Wz6mTF7quRISRCfSgenT3bmRK7S7DIHFwtd30AZK', 1, '2024-07-25 18:16:15', '2024-07-25 18:16:15'),
('9c9c6d00-d6b9-4895-9606-6541f3abbc5b', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Mufida Afya Rahma', NULL, NULL, NULL, NULL, 22063, '$2y$12$jF.7soOPOXs.7wsKRJZ9uehXukQN0W3wYhdV9/JIZ2F6cKoiD2wxK', 1, '2024-07-25 18:16:16', '2024-07-25 18:16:16'),
('9c9c6d01-2a76-414c-ab0c-c7eb9ada2b24', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Mutia Bilqist Asror', NULL, NULL, NULL, NULL, 22083, '$2y$12$0jyld2fWopiwvf77HvgKuOdQ8mFDO6iBiLJCvzefMisWTePruzSiS', 1, '2024-07-25 18:16:16', '2024-07-25 18:16:16'),
('9c9c6d01-8042-4463-9aec-5b3777a2ebcd', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nadia Raisa Shafira', NULL, NULL, NULL, NULL, 22086, '$2y$12$/9JdWA361ncpzraCzRf7AeU.6Z.ChD0qCGqwwFCeuTLwG46fBL14S', 1, '2024-07-25 18:16:16', '2024-07-25 18:16:16'),
('9c9c6d01-d60a-465a-85e5-d8c52d61c11c', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nayla Mardhia Rachmani', NULL, NULL, NULL, NULL, 22091, '$2y$12$qck47XUD.1oa1S.PEoeciep4HPPPNXGXOXVgetou/ramzcWDSv0Ly', 1, '2024-07-25 18:16:16', '2024-07-25 18:16:16'),
('9c9c6d02-2a95-4522-a1c4-8a6363f52f03', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Naysilla Keyzha Aurelly', NULL, NULL, NULL, NULL, 22092, '$2y$12$LXbXvWs4jIboWt4cevBDBu4ByTs51RLyf4fwJDiQHtlNGzDa01a1.', 1, '2024-07-25 18:16:16', '2024-07-25 18:16:16'),
('9c9c6d02-7e0a-46c9-a429-7c0c66889b56', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Nazwa Ardelia Putri', NULL, NULL, NULL, NULL, 22093, '$2y$12$dArRem6ILBusn1jT.QifDOtuxeGr0jeRgRuWbDjgLUIoykcxDXfnq', 1, '2024-07-25 18:16:17', '2024-07-25 18:16:17'),
('9c9c6d02-d55b-413a-bcfc-727037c80cfd', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Oryza Kinanti Aditia', NULL, NULL, NULL, NULL, 22094, '$2y$12$Ttrcdmt0sxrr5WlnOf246eWrA6PPfL6ajN3EH7SLzXMrivNLmCpDy', 1, '2024-07-25 18:16:17', '2024-07-25 18:16:17'),
('9c9c6d03-2baf-4519-a69c-19302484a922', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Rara Fika Apriliza', NULL, NULL, NULL, NULL, 22101, '$2y$12$u3A0Ezv5cUTOCCKabyIMVeCZGvQkcEmoLSi4tC91/OhJPySDDo2Vi', 1, '2024-07-25 18:16:17', '2024-07-25 18:16:17'),
('9c9c6d03-8501-4d5f-b48c-ad3bbbb4cde9', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Razwa Auryn Dianri', NULL, NULL, NULL, NULL, 22102, '$2y$12$ziwX2wIoXyrivyR/mAujuuPZhglCDI9mcLizPH6OIdEu.mMBcjtMy', 1, '2024-07-25 18:16:17', '2024-07-25 18:16:17'),
('9c9c6d03-d820-4d34-8fff-60d71d061ef0', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Ribbi Fayyaza', NULL, NULL, NULL, NULL, 22106, '$2y$12$E7/OviR90zUGrQjX4.WwLemNKu9IdeR8MZYOW753kRxO8uhYKcr8.', 1, '2024-07-25 18:16:17', '2024-07-25 18:16:17'),
('9c9c6d04-2bac-46df-84cd-ba2592a289c0', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Roro Ajeng Cahyani', NULL, NULL, NULL, NULL, 22107, '$2y$12$Edm3MMNc8hZk8Jg8vRgTnuSHAMmDvL9mx90hA6/h/EeegeWYWjshS', 1, '2024-07-25 18:16:18', '2024-07-25 18:16:18'),
('9c9c6d04-816d-4313-8125-350df4a633f8', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Salsabila Ramadhaniyah', NULL, NULL, NULL, NULL, 22110, '$2y$12$.J0czaK6of2gCxUwJ90hvOoTvNmPeyxALQfiDZLWWwsTzuvrOHSJO', 1, '2024-07-25 18:16:18', '2024-07-25 18:16:18'),
('9c9c6d04-d6cd-4735-9cb4-3384e5f38a30', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Satin Ainani', NULL, NULL, NULL, NULL, 22112, '$2y$12$wa3dj3hcNhstnq9UwNQ3quIPUnHER0OpEwp3Xk/W1Ih9A4I39QBsq', 1, '2024-07-25 18:16:18', '2024-07-25 18:16:18'),
('9c9c6d05-2a4a-4c5b-a52b-8995a398e5b0', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Tasya Wulandari', NULL, NULL, NULL, NULL, 22118, '$2y$12$9IDStaf3UINNB1F4VPl4t..zED9Gz.exljX18YFUcJcKmGMiwZxfq', 1, '2024-07-25 18:16:18', '2024-07-25 18:16:18'),
('9c9c6d05-7e82-4965-b804-0903d258b2bf', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Yuliana Putri Rahmawati', NULL, NULL, NULL, NULL, 22122, '$2y$12$182i3cL63hTYjyXX6kwjweGOQjBqPyQLtPI7mES/0jkVFHPXf7r6.', 1, '2024-07-25 18:16:19', '2024-07-25 18:16:19'),
('9c9c6d05-d195-4ca0-9ec7-e583fe2da15d', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zalva Nurhidayah', NULL, NULL, NULL, NULL, 22125, '$2y$12$AXGvaHpZJlS.ALjS9h9DiOwcRjq2I.OaZxds9baa.17BVSvFJ4nSC', 1, '2024-07-25 18:16:19', '2024-07-25 18:16:19'),
('9c9c6d06-2592-4fa9-952f-ea0b0c0afd01', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zaqia Ranisa Sukma', NULL, NULL, NULL, NULL, 22126, '$2y$12$ZB42zZT6VLx.2DbggYMZG.L59EOLHaLq3NQ8QMXX9usHZEipt0bTi', 1, '2024-07-25 18:16:19', '2024-07-25 18:16:19'),
('9c9c6d06-78bc-4d21-a284-4f19735db917', '05554a12-e80f-4c94-be4e-cde866b1f324', 'fa0803cf-dfa4-4172-bcfe-ee049e2f6f27', 'Zuleika Amelia Florean', NULL, NULL, NULL, NULL, 22127, '$2y$12$juyySEBCejKbLi/xxLd/vODeCC9jUuawm6YazVY98WKhrDlLoxHGu', 1, '2024-07-25 18:16:19', '2024-07-25 18:16:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_pelajarans`
--

CREATE TABLE `tahun_pelajarans` (
  `id` char(36) NOT NULL,
  `nama_tahun_pelajaran` varchar(255) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_pelajarans`
--

INSERT INTO `tahun_pelajarans` (`id`, `nama_tahun_pelajaran`, `semester`, `status`, `created_at`, `updated_at`) VALUES
('88ccc4c0-d59c-4409-8808-f14099ddfedb', '2024/2025', '1', 1, '2024-07-24 10:00:54', '2024-07-24 10:00:59'),
('ba5041ef-3f87-4d38-9881-81bd2584e4ae', '2024/2025', '2', 1, '2024-07-24 10:01:08', '2024-07-24 10:01:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan_komentars`
--

CREATE TABLE `tanggapan_komentars` (
  `id` char(36) NOT NULL,
  `komentar_id` char(36) NOT NULL,
  `author_id` char(36) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` char(36) NOT NULL,
  `alumni_id` char(36) NOT NULL,
  `rating` int(11) NOT NULL,
  `isi_testimonial` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `alumni_id`, `rating`, `isi_testimonial`, `status`, `created_at`, `updated_at`) VALUES
('c7844778-eae5-447c-b5ca-33e8d624a4ee', '9c97a25d-4ec9-4476-9aa3-9efa062f0acb', 4, 'oke banget', 1, '2024-07-23 10:21:03', '2024-07-23 10:21:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tryouts`
--

CREATE TABLE `tryouts` (
  `id` char(36) NOT NULL,
  `tahun_pelajaran_id` char(36) NOT NULL,
  `nama_tryout` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tryouts`
--

INSERT INTO `tryouts` (`id`, `tahun_pelajaran_id`, `nama_tryout`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
('183030f9-f09a-46f0-b76e-a72963fb8370', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TO 2', NULL, 1, '2024-07-24 10:04:09', '2024-07-24 10:04:09'),
('d8b0e46d-7dc0-4956-8831-9c131d0d71c8', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TO 1', NULL, 1, '2024-07-24 10:04:01', '2024-07-24 10:04:01'),
('e04417ca-c8f3-4ddd-ba08-0a7cdcc59085', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TO 3', NULL, 1, '2024-07-24 10:04:15', '2024-07-24 10:04:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_guru_id_foreign` (`guru_id`),
  ADD KEY `absensis_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `absensi_details`
--
ALTER TABLE `absensi_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_details_absensi_id_foreign` (`absensi_id`),
  ADD KEY `absensi_details_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `absensi_gurus`
--
ALTER TABLE `absensi_gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beritas_kategori_id_foreign` (`kategori_id`),
  ADD KEY `beritas_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gurus_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indeks untuk tabel `jenis_perguruan_tinggis`
--
ALTER TABLE `jenis_perguruan_tinggis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_beritas`
--
ALTER TABLE `kategori_beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komentars_berita_id_foreign` (`berita_id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilais_tryout_id_foreign` (`tryout_id`),
  ADD KEY `nilais_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `nilais_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `program_bimbels`
--
ALTER TABLE `program_bimbels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sertifikat_tryouts`
--
ALTER TABLE `sertifikat_tryouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sertifikat_tryouts_no_sertifikat_unique` (`no_sertifikat`),
  ADD KEY `sertifikat_tryouts_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `siswas_program_bimbel_id_foreign` (`program_bimbel_id`);

--
-- Indeks untuk tabel `tahun_pelajarans`
--
ALTER TABLE `tahun_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggapan_komentars`
--
ALTER TABLE `tanggapan_komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanggapan_komentars_komentar_id_foreign` (`komentar_id`),
  ADD KEY `tanggapan_komentars_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_alumni_id_foreign` (`alumni_id`);

--
-- Indeks untuk tabel `tryouts`
--
ALTER TABLE `tryouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tryouts_tahun_pelajaran_id_foreign` (`tahun_pelajaran_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_gurus`
--
ALTER TABLE `absensi_gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `absensi_details`
--
ALTER TABLE `absensi_details`
  ADD CONSTRAINT `absensi_details_absensi_id_foreign` FOREIGN KEY (`absensi_id`) REFERENCES `absensis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_details_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD CONSTRAINT `beritas_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beritas_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_beritas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD CONSTRAINT `komentars_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilais_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilais_tryout_id_foreign` FOREIGN KEY (`tryout_id`) REFERENCES `tryouts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat_tryouts`
--
ALTER TABLE `sertifikat_tryouts`
  ADD CONSTRAINT `sertifikat_tryouts_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswas_program_bimbel_id_foreign` FOREIGN KEY (`program_bimbel_id`) REFERENCES `program_bimbels` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan_komentars`
--
ALTER TABLE `tanggapan_komentars`
  ADD CONSTRAINT `tanggapan_komentars_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_komentars_komentar_id_foreign` FOREIGN KEY (`komentar_id`) REFERENCES `komentars` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `alumnis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tryouts`
--
ALTER TABLE `tryouts`
  ADD CONSTRAINT `tryouts_tahun_pelajaran_id_foreign` FOREIGN KEY (`tahun_pelajaran_id`) REFERENCES `tahun_pelajarans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
