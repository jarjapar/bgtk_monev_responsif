-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2026 at 05:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgtk_monev`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcks_jawaban`
--

CREATE TABLE `bcks_jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bcks_pengisian_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_indikator` tinyint(3) UNSIGNED NOT NULL,
  `level` enum('Reaction','Learning','Behavior','Results') NOT NULL,
  `skor` tinyint(3) UNSIGNED NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcks_pengisians`
--

CREATE TABLE `bcks_pengisians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bcks` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `angkatan_pelatihan` varchar(255) DEFAULT NULL,
  `nama_responden` varchar(255) NOT NULL,
  `unit_kerja_responden` varchar(255) DEFAULT NULL,
  `status_responden` enum('BCKS','Atasan Langsung / Pengawas Sekolah','Perwakilan Guru / Tenaga Kependidikan') NOT NULL,
  `nama_petugas_monev` varchar(255) NOT NULL,
  `unit_kerja_petugas` varchar(255) DEFAULT NULL,
  `tanggal_evaluasi` date NOT NULL,
  `total_skor` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `nilai_akhir` decimal(5,2) NOT NULL DEFAULT 0.00,
  `predikat` enum('Sangat Baik','Baik','Cukup','Perlu Pembinaan') DEFAULT NULL,
  `dampak_implementasi_rptks` text DEFAULT NULL,
  `kendala_strategi_mitigasi` text DEFAULT NULL,
  `perubahan_pengambilan_keputusan` text DEFAULT NULL,
  `dukungan_lingkungan_sekolah` text DEFAULT NULL,
  `keberlanjutan_program_inovasi` text DEFAULT NULL,
  `status_pengisian` enum('Draft','Selesai') NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sekolah_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bk_answers`
--

CREATE TABLE `bk_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bk_submission_id` bigint(20) UNSIGNED NOT NULL,
  `bk_question_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bk_essay_answers`
--

CREATE TABLE `bk_essay_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bk_submission_id` bigint(20) UNSIGNED NOT NULL,
  `nomor` tinyint(3) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bk_questions`
--

CREATE TABLE `bk_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL,
  `level_nama` varchar(255) NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `judul_bagian` varchar(255) NOT NULL,
  `nomor` tinyint(3) UNSIGNED NOT NULL,
  `pernyataan` text NOT NULL,
  `urutan` smallint(5) UNSIGNED NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bk_questions`
--

INSERT INTO `bk_questions` (`id`, `level`, `level_nama`, `bagian`, `judul_bagian`, `nomor`, `pernyataan`, `urutan`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 'Reaksi (Reaction)', 'A', 'Iklim Kelas', 1, 'Siswa merasa aman dan nyaman dalam mengungkapkan pendapat atau pertanyaan tanpa takut dihakimi oleh guru atau teman sekelas.', 1, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(2, 1, 'Reaksi (Reaction)', 'A', 'Iklim Kelas', 2, 'Tidak ada kasus bullying, intimidasi, atau kekerasan verbal/fisik di dalam kelas', 2, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(3, 1, 'Reaksi (Reaction)', 'A', 'Iklim Kelas', 3, 'Siswa memahami dan mematuhi aturan kelas yang disepakati bersama untuk menciptakan lingkungan yang tertib dan aman.', 3, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(4, 1, 'Reaksi (Reaction)', 'A', 'Iklim Kelas', 4, 'Guru merespons dengan cepat dan adil terhadap konflik atau ketidaknyamanan yang muncul di antara siswa.', 4, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(5, 1, 'Reaksi (Reaction)', 'A', 'Iklim Kelas', 5, 'Siswa merasa dilindungi dan didukung oleh guru dan teman sekelas dalam situasi apa pun', 5, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(6, 1, 'Reaksi (Reaction)', 'B', 'Suasana Kelas Menyenangkan', 1, 'Siswa antusias dan termotivasi untuk hadir dan berpartisipasi aktif dalam pembelajaran.', 6, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(7, 1, 'Reaksi (Reaction)', 'B', 'Suasana Kelas Menyenangkan', 2, 'Pembelajaran dirancang dengan metode yang kreatif dan interaktif (misalnya permainan, proyek, atau diskusi kelompok).', 7, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(8, 1, 'Reaksi (Reaction)', 'B', 'Suasana Kelas Menyenangkan', 3, 'Suasana kelas penuh dengan tawa, semangat, dan energi positif tanpa tekanan berlebihan.', 8, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(9, 1, 'Reaksi (Reaction)', 'B', 'Suasana Kelas Menyenangkan', 4, 'Siswa merasa dihargai dan diterima apa adanya sehingga mereka lebih percaya diri.', 9, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(10, 1, 'Reaksi (Reaction)', 'B', 'Suasana Kelas Menyenangkan', 5, 'Guru menggunakan humor dan pendekatan yang ramah untuk mengurangi kecemasan siswa', 10, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(11, 1, 'Reaksi (Reaction)', 'C', 'Layanan Pembelajaran', 1, 'Siswa merasa materi pembelajaran yang disampaikan guru mudah dipahami dan relevan dengan kebutuhan.', 11, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(12, 1, 'Reaksi (Reaction)', 'C', 'Layanan Pembelajaran', 2, 'Metode pembelajaran yang digunakan guru (misalnya diskusi, proyek, atau media digital) membuat siswa lebih tertarik untuk belajar.', 12, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(13, 1, 'Reaksi (Reaction)', 'C', 'Layanan Pembelajaran', 3, 'Siswa mendapatkan umpan balik yang jelas dan bermanfaat dari guru setelah mengerjakan tugas atau ujian.', 13, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(14, 1, 'Reaksi (Reaction)', 'C', 'Layanan Pembelajaran', 4, 'Guru memberikan kesempatan kepada siswa untuk bertanya atau mengungkapkan pendapat selama pembelajaran.', 14, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(15, 1, 'Reaksi (Reaction)', 'C', 'Layanan Pembelajaran', 5, 'Pembelajaran di kelas membantu siswa mengembangkan keterampilan yang berguna untuk masa depan (misalnya berpikir kritis, kolaborasi', 15, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(16, 1, 'Reaksi (Reaction)', 'D', 'Pembimbingan', 1, 'Siswa merasa didukung oleh guru dalam mengatasi kesulitan belajar atau masalah pribadi.', 16, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(17, 1, 'Reaksi (Reaction)', 'D', 'Pembimbingan', 2, 'Guru memberikan bimbingan yang jelas tentang cara meningkatkan prestasi akademik atau keterampilan sosial siswa.', 17, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(18, 1, 'Reaksi (Reaction)', 'D', 'Pembimbingan', 3, 'Siswa merasa nyaman untuk curhat atau meminta nasihat kepada guru tanpa takut dihakimi.', 18, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(19, 1, 'Reaksi (Reaction)', 'D', 'Pembimbingan', 4, 'Guru membantu ssiswa mengenali potensi diri dan merencanakan langkah-langkah untuk mencapainya.', 19, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(20, 1, 'Reaksi (Reaction)', 'D', 'Pembimbingan', 5, 'Pembimbingan yang siswa terima membuat lebih percaya diri dan termotivasi untuk belajar', 20, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(21, 2, 'Pembelajaran (Learning)', 'A', 'Kualitas Penerapan Layanan BK', 1, 'Siswa menunjukkan peningkatan pemahaman tentang nilai-nilai kehidupan (seperti integritas, empati, dan tanggung jawab) setelah mengikuti layanan BK.', 11, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(22, 2, 'Pembelajaran (Learning)', 'A', 'Kualitas Penerapan Layanan BK', 2, 'Penurunan kasus masalah sosial dan emosional di sekolah (misalnya bullying, konflik antar-siswa) karena intervensi layanan BK yang efektif.', 12, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(23, 2, 'Pembelajaran (Learning)', 'A', 'Kualitas Penerapan Layanan BK', 3, 'Siswa lebih aktif mencari bantuan untuk masalah akademik maupun non-akademik melalui layanan BK.', 13, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(24, 2, 'Pembelajaran (Learning)', 'A', 'Kualitas Penerapan Layanan BK', 4, 'Guru BK lebih terampil dalam menggunakan metode konseling yang variatif (misalnya pendekatan CBT, solution-focused).', 14, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(25, 2, 'Pembelajaran (Learning)', 'A', 'Kualitas Penerapan Layanan BK', 5, 'Layanan BK terintegrasi dengan program sekolah (misalnya pengembangan karakter, anti-bullying)', 15, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(26, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 1, 'Mampu menyusun RPL yang jelas dan terstruktur untuk mencapai tujuan pembinaan karakter positif siswa.', 16, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(27, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 2, 'RPL yang disusun mencakup aspek pengembangan pribadi, sosial, belajar, dan karir siswa secara seimbang.', 17, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(28, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 3, 'Melibatkan data kebutuhan siswa (misalnya, hasil asesmen, masukan guru/orang tua) dalam menyusun RPL.', 18, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(29, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 4, 'Menetapkan indikator keberhasilan yang terukur dalam RPL untuk mengevaluasi dampak layanan BK.', 19, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(30, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 5, 'Menyusun RPL dengan mempertimbangkan keragaman latar belakang dan kebutuhan siswa.', 20, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(31, 2, 'Pembelajaran (Learning)', 'B', 'Kinerja Guru BK Selama OJL', 6, 'Berkolaborasi dengan guru BK ketika menemukan siswa yang memerlukan pendampingan lebih intensif terkait masalah pribadi atau sosial', 21, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(32, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 1, 'Mampu merancang program BK yang efektif untuk membina karakter positif siswa.', 22, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(33, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 2, 'Terampil dalam menggunakan teknik konseling (misalnya, refleksi, pertanyaan terbuka) untuk membantu siswa mengatasi masalah pribadi.', 23, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(34, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 3, 'Aktif membimbing siswa dalam mengembangkan keterampilan sosial, seperti kerja sama dan komunikasi.', 24, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(35, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 4, 'Memberikan pendampingan yang tepat untuk meningkatkan motivasi belajar siswa.', 35, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(36, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 6, 'Mampu mengevaluasi perkembangan siswa setelah mengikuti program BK dan memberikan tindak lanjut yang sesuai.', 36, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(37, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 7, 'Mampu berkolaborasi dengan guru, orang tua, dan pihak terkait untuk mendukung perkembangan siswa secara holistik', 37, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(38, 3, 'Behavior', 'B', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 1, 'Pembelajaran di kelas lebih bernuansa pengembangan diri (misalnya refleksi nilai-nilai kehidupan, diskusi kasus).', 27, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(39, 3, 'Behavior', 'B', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 2, 'Siswa mampu mengaitkan materi pembelajaran dengan aplikasi kehidupan nyata (misalnya keterampilan problem-solving).', 28, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(40, 3, 'Behavior', 'B', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 3, 'Guru menggunakan asesmen yang mencakup aspek sikap dan sosial (tidak hanya kognitif).', 29, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(41, 3, 'Behavior', 'B', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 4, 'Pembelajaran kolaboratif mendorong siswa untuk saling menghargai dan bekerja sama.', 30, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(42, 3, 'Behavior', 'B', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 5, 'Siswa lebih termotivasi untuk belajar karena merasa dipahami dan dihargai sebagai individu', 31, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(43, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 1, 'Pembelajaran di kelas lebih bernuansa pengembangan diri (misalnya refleksi nilai-nilai kehidupan, diskusi kasus).', 32, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(44, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 2, 'Siswa mampu mengaitkan materi pembelajaran dengan aplikasi kehidupan nyata (misalnya keterampilan problem-solving).', 33, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(45, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 3, 'Guru menggunakan asesmen yang mencakup aspek sikap dan sosial (tidak hanya kognitif).', 34, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(46, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 4, 'Pembelajaran kolaboratif mendorong siswa untuk saling menghargai dan bekerja sama.', 46, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(47, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 5, 'Siswa lebih termotivasi untuk belajar karena merasa dipahami dan dihargai sebagai individu', 47, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(48, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 1, 'Memahami implementasi 7 Jurus BK Hebat dalam Layanan BK', 40, 1, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(49, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 2, 'Memahami dengan jelas tujuan layanan BK dalam membina karakter positif siswa.', 49, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(50, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 3, 'Layanan BK yang dilakukan mencakup pengembangan pribadi, sosial, belajar, dan karir siswa secara seimbang.', 50, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(51, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 4, 'Menggunakan metode kreatif (misalnya, role-play, diskusi kelompok) untuk membangun karakter positif siswa.', 51, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(52, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 5, 'Mampu membantu siswa mengenali potensi diri dan mengatasi masalah pribadi melalui layanan BK.', 52, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(53, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 6, 'Aktif memandu siswa dalam mengeksplorasi minat dan bakat untuk perencanaan karir.', 53, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(54, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 1, 'Mampu mengenali perubahan emosi atau perilaku siswa selama sesi konseling.', 54, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(55, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 2, 'Menunjukkan sikap empati (misalnya, mendengarkan aktif, merespons dengan hangat) saat siswa bercerita tentang masalahnya.', 55, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(56, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 3, 'Peka terhadap dinamika kelompok saat melakukan konseling kelompok atau kelas.', 56, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(57, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 4, 'Menyesuaikan pendekatan konseling berdasarkan kebutuhan dan respons siswa.', 57, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(58, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 5, 'Memberikan ruang aman bagi siswa untuk mengekspresikan perasaan atau pikiran mereka tanpa takut dihakimi.', 58, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(59, 4, 'Hasil (Result)', 'B', 'Sikap Guru BK', 6, 'Memperhatikan tanda-tanda nonverbal (ekspresi wajah, bahasa tubuh) siswa untuk memahami kondisi mereka', 59, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(60, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 1, 'Pendekatan terhadap siswa menjadi lebih personal dan memahami kebutuhan mereka.', 60, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(61, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 2, 'Lebih sering menggunakan teknik komunikasi yang mendorong keterbukaan siswa (misalnya, pertanyaan terbuka, refleksi).', 61, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(62, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 3, 'Adanya peningkatan keterlibatan siswa dalam proses pembelajaran atau konseling setelah perubahan pendekatan.', 62, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(63, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 4, 'Lebih peka dalam mengenali tanda-tanda stres atau masalah emosional pada siswa.', 63, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(64, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 5, 'Siswa terlihat lebih nyaman dan percaya diri saat berinteraksi dengan guru.', 64, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(65, 4, 'Hasil (Result)', 'C', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 6, 'Menerima umpan balik positif dari siswa atau rekan sejawat tentang pendekatan yang lebih empatik.', 65, 0, '2026-10-07 17:01:36', '2026-10-11 16:50:51'),
(66, 1, 'Reaksi (Reaction)', 'A', 'Materi Pelatihan', 1, 'Materi pelatihan 7 Jurus BK Hebat sesuai dengan tujuan pelatihan.', 1, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(67, 1, 'Reaksi (Reaction)', 'A', 'Materi Pelatihan', 2, 'Materi yang disampaikan sesuai dengan kebutuhan dan tugas guru BK.', 2, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(68, 1, 'Reaksi (Reaction)', 'A', 'Materi Pelatihan', 3, 'Bahan/modul pembelajaran yang diberikan membantu saya memahami 7 Jurus BK Hebat.', 3, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(69, 1, 'Reaksi (Reaction)', 'B', 'Fasilitator Pelatihan', 1, 'Fasilitator menguasai materi 7 Jurus BK Hebat yang disampaikan.', 4, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(70, 1, 'Reaksi (Reaction)', 'B', 'Fasilitator Pelatihan', 2, 'Fasilitator menyampaikan materi secara sistematis dan mudah dipahami.', 5, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(71, 1, 'Reaksi (Reaction)', 'B', 'Fasilitator Pelatihan', 3, 'Fasilitator mampu membangun suasana pembelajaran yang aktif dan menyenangkan', 6, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(72, 1, 'Reaksi (Reaction)', 'C', 'LMS Pelatihan', 1, 'Petunjuk penggunaan LMS mudah dipahami.', 7, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(73, 1, 'Reaksi (Reaction)', 'C', 'LMS Pelatihan', 2, 'Kendala teknis dalam penggunaan LMS dapat ditangani dengan baik oleh admin/pengelola', 8, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(74, 1, 'Reaksi (Reaction)', 'D', 'Kepanitiaan', 1, 'Sarana dan prasarana pada pelaksanaan luring mendukung proses pembelajaran.', 9, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(75, 1, 'Reaksi (Reaction)', 'D', 'Kepanitiaan', 2, 'Panitia/pengelola memberikan informasi dan layanan yang dibutuhkan peserta dengan baik.', 10, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(76, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 5, 'Mampu mengevaluasi perkembangan siswa setelah mengikuti program BK dan memberikan tindak lanjut yang sesuai.', 25, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(77, 3, 'Behavior', 'A', 'Keterampilan Guru BK', 6, 'Mampu berkolaborasi dengan guru, orang tua, dan pihak terkait untuk mendukung perkembangan siswa secara holistik', 26, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(78, 3, 'Behavior', 'C', 'Penerapan Layanan Pembelajaran yang Bernuansa BK', 4, 'Siswa lebih termotivasi untuk belajar karena merasa dipahami dan dihargai sebagai individu', 35, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(79, 3, 'Behavior', 'D', 'Sikap Guru BK', 1, 'Mampu mengenali perubahan emosi atau perilaku siswa selama sesi konseling.', 36, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(80, 3, 'Behavior', 'D', 'Sikap Guru BK', 2, 'Menunjukkan sikap empati (misalnya, mendengarkan aktif, merespons dengan hangat) saat siswa bercerita tentang masalahnya.', 37, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(81, 3, 'Behavior', 'D', 'Sikap Guru BK', 3, 'Menyesuaikan pendekatan konseling berdasarkan kebutuhan dan respons siswa.', 38, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(82, 3, 'Behavior', 'D', 'Sikap Guru BK', 4, 'Memberikan ruang aman bagi siswa untuk mengekspresikan perasaan atau pikiran mereka tanpa takut dihakimi.', 39, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(83, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 2, 'Layanan BK yang dilakukan mencakup pengembangan pribadi, sosial, belajar, dan karir siswa secara seimbang.', 41, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(84, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 3, 'Menggunakan metode kreatif (misalnya, role-play, diskusi kelompok) untuk membangun karakter positif siswa.', 42, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(85, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 4, 'Mampu membantu siswa mengenali potensi diri dan mengatasi masalah pribadi melalui layanan BK.', 43, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(86, 4, 'Hasil (Result)', 'A', 'Pengetahuan Guru BK', 5, 'Aktif memandu siswa dalam mengeksplorasi minat dan bakat untuk perencanaan karir.', 44, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(87, 4, 'Hasil (Result)', 'B', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 1, 'Pendekatan terhadap siswa menjadi lebih personal dan memahami kebutuhan mereka.', 45, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(88, 4, 'Hasil (Result)', 'B', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 2, 'Lebih sering menggunakan teknik komunikasi yang mendorong keterbukaan siswa (misalnya, pertanyaan terbuka, refleksi).', 46, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(89, 4, 'Hasil (Result)', 'B', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 3, 'Adanya peningkatan keterlibatan siswa dalam proses pembelajaran atau konseling setelah perubahan pendekatan.', 47, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(90, 4, 'Hasil (Result)', 'B', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 4, 'Lebih peka dalam mengenali tanda-tanda stres atau masalah emosional pada siswa.', 48, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(91, 4, 'Hasil (Result)', 'B', 'Sikap Perubahan Positif dalam Pendekatan ke Murid', 5, 'Siswa terlihat lebih nyaman dan percaya diri saat berinteraksi dengan guru.', 49, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(92, 4, 'Hasil (Result)', 'C', 'Iklim Kelas', 1, 'Siswa merasa aman dan nyaman dalam mengungkapkan pendapat atau pertanyaan tanpa takut dihakimi oleh guru atau teman sekelas.', 50, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(93, 4, 'Hasil (Result)', 'C', 'Iklim Kelas', 2, 'Tidak ada kasus bullying, intimidasi, atau kekerasan verbal/fisik di dalam kelas', 51, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(94, 4, 'Hasil (Result)', 'C', 'Iklim Kelas', 3, 'Siswa memahami dan mematuhi aturan kelas yang disepakati bersama untuk menciptakan lingkungan yang tertib dan aman.', 52, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(95, 4, 'Hasil (Result)', 'C', 'Iklim Kelas', 4, 'Guru merespons dengan cepat dan adil terhadap konflik atau ketidaknyamanan yang muncul di antara siswa.', 53, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(96, 4, 'Hasil (Result)', 'D', 'Suasana Kelas Menyenangkan', 1, 'Siswa antusias dan termotivasi untuk hadir dan berpartisipasi aktif dalam pembelajaran.', 54, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(97, 4, 'Hasil (Result)', 'D', 'Suasana Kelas Menyenangkan', 2, 'Pembelajaran dirancang dengan metode yang kreatif dan interaktif (misalnya permainan, proyek, atau diskusi kelompok).', 55, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(98, 4, 'Hasil (Result)', 'D', 'Suasana Kelas Menyenangkan', 3, 'Suasana kelas penuh dengan tawa, semangat, dan energi positif tanpa tekanan berlebihan.', 56, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(99, 4, 'Hasil (Result)', 'D', 'Suasana Kelas Menyenangkan', 4, 'Siswa merasa dihargai dan diterima apa adanya sehingga mereka lebih percaya diri.', 57, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(100, 4, 'Hasil (Result)', 'E', 'Layanan Pembelajaran', 1, 'Siswa merasa materi pembelajaran yang disampaikan guru mudah dipahami dan relevan dengan kebutuhan.', 58, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(101, 4, 'Hasil (Result)', 'E', 'Layanan Pembelajaran', 2, 'Metode pembelajaran yang digunakan guru (misalnya diskusi, proyek, atau media digital) membuat siswa lebih tertarik untuk belajar.', 59, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(102, 4, 'Hasil (Result)', 'E', 'Layanan Pembelajaran', 3, 'Siswa mendapatkan umpan balik yang jelas dan bermanfaat dari guru setelah mengerjakan tugas atau ujian.', 60, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(103, 4, 'Hasil (Result)', 'E', 'Layanan Pembelajaran', 4, 'Guru memberikan kesempatan kepada siswa untuk bertanya atau mengungkapkan pendapat selama pembelajaran.', 61, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(104, 4, 'Hasil (Result)', 'F', 'Pembimbingan', 1, 'Siswa merasa didukung oleh guru dalam mengatasi kesulitan belajar atau masalah pribadi.', 62, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(105, 4, 'Hasil (Result)', 'F', 'Pembimbingan', 2, 'Guru memberikan bimbingan yang jelas tentang cara meningkatkan prestasi akademik atau keterampilan sosial siswa.', 63, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(106, 4, 'Hasil (Result)', 'F', 'Pembimbingan', 3, 'Siswa merasa nyaman untuk curhat atau meminta nasihat kepada guru tanpa takut dihakimi.', 64, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51'),
(107, 4, 'Hasil (Result)', 'F', 'Pembimbingan', 4, 'Guru membantu ssiswa mengenali potensi diri dan merencanakan langkah-langkah untuk mencapainya.', 65, 1, '2026-10-11 16:50:51', '2026-10-11 16:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `bk_submissions`
--

CREATE TABLE `bk_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas_monev` varchar(255) NOT NULL,
  `instansi_petugas` varchar(255) DEFAULT NULL,
  `lokasi_monev` varchar(255) DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `nama_responden` varchar(255) NOT NULL,
  `instansi_responden` varchar(255) DEFAULT NULL,
  `kab_kota` varchar(255) DEFAULT NULL,
  `jumlah_soal` int(10) UNSIGNED NOT NULL DEFAULT 65,
  `jumlah_ya` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `jumlah_tidak` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `skor_persentase` decimal(5,2) NOT NULL DEFAULT 0.00,
  `kategori` enum('Baik / Kategori Tinggi','Kurang / Kategori Rendah') DEFAULT NULL,
  `status` enum('Draft','Selesai') NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sekolah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_responden` varchar(255) DEFAULT NULL,
  `jabatan_lainnya` varchar(255) DEFAULT NULL,
  `satuan_pendidikan` varchar(255) DEFAULT NULL,
  `masa_kerja` tinyint(3) UNSIGNED DEFAULT NULL,
  `nama_pelatihan` varchar(255) DEFAULT NULL,
  `tanggal_pengisian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instrumens`
--

CREATE TABLE `instrumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_instrumen` varchar(50) NOT NULL,
  `nama_instrumen` varchar(255) NOT NULL,
  `jenis_instrumen` enum('Pemantauan','Evaluasi','Monitoring') NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Draft','Aktif','Selesai') NOT NULL DEFAULT 'Draft',
  `jumlah_pertanyaan` int(11) NOT NULL DEFAULT 0,
  `capaian` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instrumens`
--

INSERT INTO `instrumens` (`id`, `kode_instrumen`, `nama_instrumen`, `jenis_instrumen`, `deskripsi`, `status`, `jumlah_pertanyaan`, `capaian`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 'INS-001', 'Instrumen Pemantauna Sekolah', 'Monitoring', 'Kami melakukan kegiatan wawancara', 'Selesai', 40, 0.00, '2026-10-09', '2026-10-19', '2026-10-06 17:09:49', '2026-10-06 17:54:38'),
(2, 'INS-002', 'Instrumen Pemantauna kominfo', 'Evaluasi', NULL, 'Aktif', 20, 10.00, '2026-10-22', '2026-10-29', '2026-10-06 17:54:32', '2026-10-06 17:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_06_041124_create_sekolahs_table', 2),
(5, '2026_10_07_005606_create_instrumens_table', 3),
(6, '2026_10_07_020252_create_wawancaras_table', 4),
(7, '2026_10_07_023652_create_tindak_lanjuts_table', 5),
(8, '2026_10_07_070057_create_bcks_pengisians_table', 6),
(9, '2026_10_07_070202_create_bcks_jawaban_table', 6),
(10, '2026_10_08_005556_create_bk_instruments_tables', 7),
(11, '2026_10_12_013426_add_jawaban_esai_to_wawancaras_table', 8),
(12, '2026_10_12_020511_add_identitas_bcks_to_wawancaras_table', 9),
(13, '2026_10_12_021346_add_tanggal_evaluasi_to_wawancaras_table', 10),
(14, '2026_10_12_025118_add_jenis_wawancara_to_wawancaras_table', 11),
(15, '2026_10_12_034102_make_wawancara_pelaksanaan_fields_nullable', 12),
(16, '2026_10_13_024712_create_tendiks_table', 13),
(17, '2026_10_15_032612_add_username_nip_role_to_users_table', 14),
(18, '2026_10_16_053357_make_sekolah_metadata_nullable', 15),
(19, '2026_10_16_053955_add_sekolah_id_to_monev_activity_tables', 15),
(20, '2026_10_16_093452_add_lokasi_monev_to_tendiks_table', 16),
(21, '2026_10_16_102043_add_identitas_responden_to_bk_submissions_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sekolahs`
--

CREATE TABLE `sekolahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `jenjang` enum('SD','SMP','SMA','SMK') DEFAULT NULL,
  `kabupaten_kota` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_monitoring` enum('Sudah Dimonitor','Belum Dimonitor') NOT NULL DEFAULT 'Belum Dimonitor',
  `tahun_monitoring` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PU85yh2fsrcY0QHe4jwpBYF5j2aKOdzNuEKHS5tt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJpcmM4M1hkQUhnWTU1aXRLMzRkSXFYQ2tnY3FUT0Z0VGM4cHhLT1RsIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93YXdhbmNhcmFcLzI2XC9jZXRhayIsInJvdXRlIjoid2F3YW5jYXJhLmNldGFrIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiZjlmYmJjYjYwMjkxMGY1MWFhNmFiODE2ZDhjYTNiMWIwNmY4NmFmNjE1YzQwNjE1YjgwNzhhNGJjM2QxODg2ZCJ9', 1792291079),
('SjUE3iKwwmQ1iqJjEzy6OluBs8nJPSdvwYWpEID7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ5NFkxSEo5VkxpWG9CdE1pWWFhQ09hWlo2ZDRPS0szVnhFdUZyZVRXIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6ImY5ZmJiY2I2MDI5MTBmNTFhYTZhYjgxNmQ4Y2EzYjFiMDZmODZhZjYxNWM0MDYxNWI4MDc4YTRiYzNkMTg4NmQifQ==', 1792294320);

-- --------------------------------------------------------

--
-- Table structure for table `tendiks`
--

CREATE TABLE `tendiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas_monev` varchar(255) NOT NULL,
  `instansi_petugas` varchar(255) NOT NULL,
  `nama_responden` varchar(255) NOT NULL,
  `jabatan_responden` varchar(255) NOT NULL,
  `jabatan_lainnya` varchar(255) DEFAULT NULL,
  `satuan_pendidikan` varchar(255) NOT NULL,
  `masa_kerja` smallint(5) UNSIGNED NOT NULL,
  `nama_pelatihan` varchar(255) NOT NULL,
  `tanggal_pengisian` date NOT NULL,
  `jawaban_1` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_2` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_3` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_4` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_5` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_6` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_7` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_8` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_9` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_10` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_11` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_12` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_13` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_14` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_15` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_16` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_17` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_18` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_19` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_20` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_21` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_22` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_23` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_24` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_25` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_26` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_27` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_28` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_29` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_30` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_31` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_32` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_33` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_34` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_35` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_36` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_37` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_38` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_39` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_40` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_41` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_42` tinyint(3) UNSIGNED DEFAULT NULL,
  `jawaban_43` tinyint(3) UNSIGNED DEFAULT NULL,
  `skor_level_1` decimal(5,2) DEFAULT NULL,
  `skor_level_2` decimal(5,2) DEFAULT NULL,
  `skor_level_3` decimal(5,2) DEFAULT NULL,
  `skor_level_4` decimal(5,2) DEFAULT NULL,
  `skor_keseluruhan` decimal(5,2) DEFAULT NULL,
  `predikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sekolah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lokasi_monev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tindak_lanjuts`
--

CREATE TABLE `tindak_lanjuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sekolah_id` bigint(20) UNSIGNED NOT NULL,
  `wawancara_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul_tindak_lanjut` varchar(255) NOT NULL,
  `uraian_tindak_lanjut` text NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `target_selesai` date DEFAULT NULL,
  `status` enum('Belum Dimulai','Dalam Proses','Selesai') NOT NULL DEFAULT 'Belum Dimulai',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'petugas_monev',
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `nip`, `role`, `is_active`) VALUES
(1, 'Administrator', 'admin@bgtkntb.go.id', NULL, '$2y$12$xA0nUpMJtHm8f3uaMRp2Zes2DVxTXUcW1EpMFTAoiMa9NTPsPQWvS', 'Qhgce7DreMPNtVqma43YqBww8llViu7wPLIxPkyKdU8Z0iJRLgw16NYsutxL', '2026-10-06 20:03:52', '2026-10-14 19:53:39', 'Admin', 'ADMIN', 'admin', 1),
(2, 'Fauziyah', 'fauziyah@bgtk-monev.local', NULL, '$2y$12$XUJfJW1TQeIcrLTwPD59n.I2fCQ9PXcMjH0wv.m2YOFpplrO2ZkOG', NULL, '2026-10-14 19:46:44', '2026-10-14 19:46:44', 'Fauziyah', '198910092014042002', 'petugas_monev', 1),
(3, 'Adelina', 'adelina@bgtk-monev.local', NULL, '$2y$12$iGD.GuF59adKG34xY6wN3uzUpJZBgZ1gHUA5AejmZVo8y6veG79c6', NULL, '2026-10-14 19:46:44', '2026-10-14 21:31:27', 'Adelina', '199902022025062009', 'petugas_monev', 1),
(4, 'Masturi', 'masturi@bgtk-monev.local', NULL, '$2y$12$/kXn9hC5kA3AYtDNXq7uJe16mri0rTEMO4NscoOwNIW0gAjHjkak.', NULL, '2026-10-14 19:46:44', '2026-10-14 19:46:44', 'Masturi', '197603142002122004', 'petugas_monev', 1),
(5, 'Agus', 'agus@bgtk-monev.local', NULL, '$2y$12$upG6pDUudBnJVgnPoo80ge1SMrtRIvCrkTDrBUuJr8ynYuCT1br8.', NULL, '2026-10-14 19:46:44', '2026-10-14 19:46:44', 'Agus', '199012052015041001', 'petugas_monev', 1),
(6, 'Doni', 'doni@bgtk-monev.local', NULL, '$2y$12$Q6Mbolr8K2yBkPE6qBSn6OqRhclJJmljWSS2uPAzH3f.LZKFhuTby', NULL, '2026-10-14 19:46:45', '2026-10-14 19:46:45', 'Doni', '198205062025211051', 'petugas_monev', 1),
(7, 'Nur', 'nur@bgtk-monev.local', NULL, '$2y$12$yoIi8BlylYBWVUqVgT1pheFqLv26lvOGMZb3Izf0EpXqcweVDysTC', NULL, '2026-10-14 19:46:45', '2026-10-14 19:46:45', 'Nur', '198612292010122003', 'petugas_monev', 1),
(8, 'Dewi', 'dewi@bgtk-monev.local', NULL, '$2y$12$Fc3B5R9s4.zvC99s8br58ej/VVKmaaV81vg/nY2E2AYw/mrvUoRla', NULL, '2026-10-14 19:46:45', '2026-10-14 19:46:45', 'Dewi', '198405092008122002', 'petugas_monev', 1),
(9, 'Eliana', 'eliana@bgtk-monev.local', NULL, '$2y$12$DsC1nlAcGIHJ3z/uU/hXheE4dbzewpMw5LB1Yjfx2dypUcinf.zzS', NULL, '2026-10-14 19:46:45', '2026-10-14 19:46:45', 'Eliana', '197612102008102001', 'petugas_monev', 1),
(10, 'Prita', 'prita@bgtk-monev.local', NULL, '$2y$12$Ti7MqgXZrrIZtWe/svJwcOXq88izQprM9ihfAUWLwhnz16PXwBBH.', NULL, '2026-10-14 19:46:46', '2026-10-14 19:46:46', 'Prita', '199202082019022010', 'petugas_monev', 1),
(11, 'Ibnu', 'ibnu@bgtk-monev.local', NULL, '$2y$12$hDlJQ7RumL4ylmnK6GOHte/VQY7uqVkP/fuqNJoJSbfIKsg9t7yRm', NULL, '2026-10-14 19:46:46', '2026-10-14 19:46:46', 'Ibnu', '198407042010121004', 'petugas_monev', 1),
(12, 'Akhmad', 'akhmad@bgtk-monev.local', NULL, '$2y$12$trDR1mbeY8kSDGoibADc/u7w/c7GxiQrRYcFQLWzncE3rrQlD0KrW', NULL, '2026-10-14 19:46:46', '2026-10-14 19:46:46', 'Akhmad', '198108212010121002', 'petugas_monev', 1),
(13, 'Ari', 'ari@bgtk-monev.local', NULL, '$2y$12$4rCcYL/.34Qr1yvzeQwGqeqsdocKZsvJeopPsTNs5b/l0LfI1B.ra', NULL, '2026-10-14 19:46:46', '2026-10-14 19:46:46', 'Ari', '198608092009121005', 'petugas_monev', 1),
(14, 'Fahrurrozi', 'lalufahrurrozi@bgtk-monev.local', NULL, '$2y$12$lGJmzvRkEpEllTIk8eKYVuVmeGH8v5RDYB4Idy9nXMkBsBWoVS1Ma', NULL, '2026-10-14 19:46:46', '2026-10-14 19:46:46', 'Fahrurrozi', '198408282010121006', 'petugas_monev', 1),
(15, 'Mukti', 'lalumukti@bgtk-monev.local', NULL, '$2y$12$1Od3QrVjz5ep7UxKtrgLVOI.JR2UnK9bLp/biZGB2TeoE6ZSR/m8O', NULL, '2026-10-14 19:46:47', '2026-10-14 19:46:47', 'Mukti', '198612082014041001', 'petugas_monev', 1),
(16, 'Rieza', 'rieza@bgtk-monev.local', NULL, '$2y$12$CZnxEwMwiEejtO57guDFAu1a6b/6XqJNi.aiam6Hm6eqrwn1/xeNO', NULL, '2026-10-14 19:46:47', '2026-10-14 19:46:47', 'Rieza', '198502232025211038', 'petugas_monev', 1),
(17, 'Yandri', 'yandri@bgtk-monev.local', NULL, '$2y$12$YBUTtkhWz.AwgdJPdWQOmu49W1Ml/3lKisY72RrM/LWku3uSIDq7S', NULL, '2026-10-14 19:46:47', '2026-10-14 19:46:47', 'Yandri', '197406012025211020', 'petugas_monev', 1),
(18, 'Rusmawati', 'rusmawati@bgtk-monev.local', NULL, '$2y$12$RCz6JJtbqSKI7S2EezKJb.ry7EFcHcl7iZQC4KL5Pv.aeKaJROS1.', NULL, '2026-10-14 19:46:47', '2026-10-14 19:46:47', 'Rusmawati', '198007072009122004', 'petugas_monev', 1),
(19, 'Evi', 'evi@bgtk-monev.local', NULL, '$2y$12$4wi/L1lDnXPR5gwtCcRdNedSw6pRipj6scJPbiy34Y1Yh8r4fRpEy', NULL, '2026-10-14 19:46:48', '2026-10-14 19:46:48', 'Evi', '199108192019022005', 'petugas_monev', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wawancaras`
--

CREATE TABLE `wawancaras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_wawancara` varchar(20) DEFAULT NULL,
  `instrumen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sekolah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_wawancara` date NOT NULL,
  `nama_narasumber` varchar(255) NOT NULL,
  `jabatan_narasumber` varchar(255) DEFAULT NULL,
  `nama_pewawancara` varchar(255) NOT NULL,
  `status` enum('Belum Dilaksanakan','Selesai') NOT NULL DEFAULT 'Belum Dilaksanakan',
  `hasil_wawancara` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jawaban_1` longtext DEFAULT NULL,
  `jawaban_2` longtext DEFAULT NULL,
  `jawaban_3` longtext DEFAULT NULL,
  `jawaban_4` longtext DEFAULT NULL,
  `jawaban_5` longtext DEFAULT NULL,
  `nama_bcks` varchar(255) DEFAULT NULL,
  `unit_kerja_bcks` varchar(255) DEFAULT NULL,
  `angkatan_pelatihan_bcks` varchar(255) DEFAULT NULL,
  `nama_responden` varchar(255) DEFAULT NULL,
  `unit_kerja_responden` varchar(255) DEFAULT NULL,
  `status_responden` varchar(255) DEFAULT NULL,
  `nama_petugas_monev` varchar(255) DEFAULT NULL,
  `unit_kerja_petugas` varchar(255) DEFAULT NULL,
  `tanggal_evaluasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcks_jawaban`
--
ALTER TABLE `bcks_jawaban`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bcks_jawaban_bcks_pengisian_id_nomor_indikator_unique` (`bcks_pengisian_id`,`nomor_indikator`);

--
-- Indexes for table `bcks_pengisians`
--
ALTER TABLE `bcks_pengisians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bcks_pengisians_sekolah_id_foreign` (`sekolah_id`);

--
-- Indexes for table `bk_answers`
--
ALTER TABLE `bk_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bk_answers_bk_submission_id_bk_question_id_unique` (`bk_submission_id`,`bk_question_id`),
  ADD KEY `bk_answers_bk_question_id_foreign` (`bk_question_id`);

--
-- Indexes for table `bk_essay_answers`
--
ALTER TABLE `bk_essay_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bk_essay_answers_bk_submission_id_nomor_unique` (`bk_submission_id`,`nomor`);

--
-- Indexes for table `bk_questions`
--
ALTER TABLE `bk_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bk_questions_level_bagian_urutan_index` (`level`,`bagian`,`urutan`);

--
-- Indexes for table `bk_submissions`
--
ALTER TABLE `bk_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bk_submissions_sekolah_id_foreign` (`sekolah_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `instrumens`
--
ALTER TABLE `instrumens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instrumens_kode_instrumen_unique` (`kode_instrumen`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sekolahs`
--
ALTER TABLE `sekolahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sekolahs_npsn_unique` (`npsn`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tendiks`
--
ALTER TABLE `tendiks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tendiks_sekolah_id_foreign` (`sekolah_id`);

--
-- Indexes for table `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tindak_lanjuts_sekolah_id_foreign` (`sekolah_id`),
  ADD KEY `tindak_lanjuts_wawancara_id_foreign` (`wawancara_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- Indexes for table `wawancaras`
--
ALTER TABLE `wawancaras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wawancaras_instrumen_id_foreign` (`instrumen_id`),
  ADD KEY `wawancaras_sekolah_id_foreign` (`sekolah_id`),
  ADD KEY `wawancaras_jenis_wawancara_index` (`jenis_wawancara`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcks_jawaban`
--
ALTER TABLE `bcks_jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `bcks_pengisians`
--
ALTER TABLE `bcks_pengisians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bk_answers`
--
ALTER TABLE `bk_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT for table `bk_essay_answers`
--
ALTER TABLE `bk_essay_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `bk_questions`
--
ALTER TABLE `bk_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `bk_submissions`
--
ALTER TABLE `bk_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instrumens`
--
ALTER TABLE `instrumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sekolahs`
--
ALTER TABLE `sekolahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tendiks`
--
ALTER TABLE `tendiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wawancaras`
--
ALTER TABLE `wawancaras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bcks_jawaban`
--
ALTER TABLE `bcks_jawaban`
  ADD CONSTRAINT `bcks_jawaban_bcks_pengisian_id_foreign` FOREIGN KEY (`bcks_pengisian_id`) REFERENCES `bcks_pengisians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bcks_pengisians`
--
ALTER TABLE `bcks_pengisians`
  ADD CONSTRAINT `bcks_pengisians_sekolah_id_foreign` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolahs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bk_answers`
--
ALTER TABLE `bk_answers`
  ADD CONSTRAINT `bk_answers_bk_question_id_foreign` FOREIGN KEY (`bk_question_id`) REFERENCES `bk_questions` (`id`),
  ADD CONSTRAINT `bk_answers_bk_submission_id_foreign` FOREIGN KEY (`bk_submission_id`) REFERENCES `bk_submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bk_essay_answers`
--
ALTER TABLE `bk_essay_answers`
  ADD CONSTRAINT `bk_essay_answers_bk_submission_id_foreign` FOREIGN KEY (`bk_submission_id`) REFERENCES `bk_submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bk_submissions`
--
ALTER TABLE `bk_submissions`
  ADD CONSTRAINT `bk_submissions_sekolah_id_foreign` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolahs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tendiks`
--
ALTER TABLE `tendiks`
  ADD CONSTRAINT `tendiks_sekolah_id_foreign` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolahs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  ADD CONSTRAINT `tindak_lanjuts_sekolah_id_foreign` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolahs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tindak_lanjuts_wawancara_id_foreign` FOREIGN KEY (`wawancara_id`) REFERENCES `wawancaras` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wawancaras`
--
ALTER TABLE `wawancaras`
  ADD CONSTRAINT `wawancaras_instrumen_id_foreign` FOREIGN KEY (`instrumen_id`) REFERENCES `instrumens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wawancaras_sekolah_id_foreign` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolahs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
