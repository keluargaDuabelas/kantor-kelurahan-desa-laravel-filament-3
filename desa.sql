/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : desa

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 25/07/2025 13:26:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for datangs
-- ----------------------------
DROP TABLE IF EXISTS `datangs`;
CREATE TABLE `datangs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_pindah` date NULL DEFAULT NULL,
  `alasan_datang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa_asal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_asal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_asal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_asal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  `penduduk_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `datangs_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  INDEX `datangs_penduduk_id_foreign`(`penduduk_id` ASC) USING BTREE,
  CONSTRAINT `datangs_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `datangs_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of datangs
-- ----------------------------
INSERT INTO `datangs` VALUES (1, '2025-07-23', 'keamanan', 'sss', 'ss', 'sss', 'ssss', 1, 2, '2025-07-23 07:26:18', '2025-07-23 07:26:18');

-- ----------------------------
-- Table structure for domisilis
-- ----------------------------
DROP TABLE IF EXISTS `domisilis`;
CREATE TABLE `domisilis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  `penduduk_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `domisilis_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  INDEX `domisilis_penduduk_id_foreign`(`penduduk_id` ASC) USING BTREE,
  CONSTRAINT `domisilis_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `domisilis_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of domisilis
-- ----------------------------
INSERT INTO `domisilis` VALUES (1, '1111', 1, 2, '2025-07-24 03:30:51', '2025-07-24 03:30:51');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kelahirans
-- ----------------------------
DROP TABLE IF EXISTS `kelahirans`;
CREATE TABLE `kelahirans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_bayi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_bayi` date NOT NULL,
  `jam_lahir_bayi` time NOT NULL,
  `tempat_lahir_bayi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin_bayi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_bayi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang_bayi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kelahirans_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  CONSTRAINT `kelahirans_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelahirans
-- ----------------------------
INSERT INTO `kelahirans` VALUES (1, 'baru', 'siti', '2025-07-23', '15:11:01', 'rumah_sakit', 'perempuan', '80 KL', '45 KL', 'aaaa', '2025-07-23 05:54:34', '2025-07-23 05:54:34', 1);

-- ----------------------------
-- Table structure for keluargas
-- ----------------------------
DROP TABLE IF EXISTS `keluargas`;
CREATE TABLE `keluargas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_kepala_keluarga` date NOT NULL,
  `tempat_lahir_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw_kepala_keluarga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penduduk_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `keluargas_nomor_kepala_keluarga_unique`(`nomor_kepala_keluarga` ASC) USING BTREE,
  UNIQUE INDEX `keluargas_nik_kepala_keluarga_unique`(`nik_kepala_keluarga` ASC) USING BTREE,
  INDEX `keluargas_penduduk_id_foreign`(`penduduk_id` ASC) USING BTREE,
  CONSTRAINT `keluargas_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keluargas
-- ----------------------------
INSERT INTO `keluargas` VALUES (1, '12345678910', '12345678910', 'contoh', 'laki', '2025-07-22', 'jambi', 'jambi', '005', '004', '2025-07-22 06:45:04', '2025-07-22 06:45:04', NULL);

-- ----------------------------
-- Table structure for kematians
-- ----------------------------
DROP TABLE IF EXISTS `kematians`;
CREATE TABLE `kematians`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `sebab_kematian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_kematian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_kematian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelapor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_pelapor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pelapor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon_pelapor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `penduduk_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kematians_penduduk_id_foreign`(`penduduk_id` ASC) USING BTREE,
  INDEX `kematians_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  CONSTRAINT `kematians_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `kematians_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kematians
-- ----------------------------
INSERT INTO `kematians` VALUES (1, '2025-07-23', '12:38:40', 'bunuh_diri', 'puskesmas', 'jaknknjnkdd', 'contoh', 'saudara_kandung', 'assddd', '0851513116', 2, '2025-07-23 05:38:58', '2025-07-23 05:38:58', 1);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_07_19_072953_create_penduduks_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_07_19_075302_create_kelahirans_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_07_19_081309_create_kematians_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_07_19_082100_create_keluargas_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_07_19_082231_create_ktps_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_07_19_082843_create_pindahs_table', 1);
INSERT INTO `migrations` VALUES (11, '2025_07_22_050055_add_kk_to_kks_table', 1);
INSERT INTO `migrations` VALUES (12, '2025_07_22_062104_add_kk_to_kks_table', 2);
INSERT INTO `migrations` VALUES (13, '2025_07_23_043547_add_kelahiran_to_kks_table', 3);
INSERT INTO `migrations` VALUES (15, '2025_07_23_045014_drop_penduduk_from_kelahirans_table', 4);
INSERT INTO `migrations` VALUES (16, '2025_07_23_045245_drop_kk_from_kelahirans_table', 5);
INSERT INTO `migrations` VALUES (17, '2025_07_23_051426_add_kk_to_kematians_table', 6);
INSERT INTO `migrations` VALUES (18, '2025_07_23_053757_drop_jenis_from_kematians_table', 7);
INSERT INTO `migrations` VALUES (19, '2025_07_23_063640_add_penduduk_to_pindahs_table', 8);
INSERT INTO `migrations` VALUES (22, '2025_07_23_063922_drop_nik_from_pindahs_table', 9);
INSERT INTO `migrations` VALUES (23, '2025_07_23_065146_add_tujuan_to_pindahs_table', 10);
INSERT INTO `migrations` VALUES (24, '2025_07_23_071936_create_datangs_table', 11);
INSERT INTO `migrations` VALUES (25, '2025_07_24_032239_create_domisilis_table', 12);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for penduduks
-- ----------------------------
DROP TABLE IF EXISTS `penduduks`;
CREATE TABLE `penduduks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_perkawinan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `penduduks_nik_unique`(`nik` ASC) USING BTREE,
  INDEX `penduduks_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  CONSTRAINT `penduduks_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penduduks
-- ----------------------------
INSERT INTO `penduduks` VALUES (1, '222222', 's', '2025-07-22', 's', 's', 's', 's', 's', 's', 's', 's', 's', '2025-07-22 07:36:03', '2025-07-22 07:36:03', 1);
INSERT INTO `penduduks` VALUES (2, '44444444', 'duaa', '2025-07-23', 'jambi', 'belum_menikah', 'Ibu Rumah Tangga', 'Kristen Protestan', 'perempuan', 'Belum Tamat SD/Sederajat', '02', '02', 'jamabai', '2025-07-23 04:27:23', '2025-07-23 04:27:23', 1);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for pindahs
-- ----------------------------
DROP TABLE IF EXISTS `pindahs`;
CREATE TABLE `pindahs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_pindah` date NULL DEFAULT NULL,
  `penduduk_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keluarga_id` bigint UNSIGNED NULL DEFAULT NULL,
  `alasan_pindah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pindahs_penduduk_id_foreign`(`penduduk_id` ASC) USING BTREE,
  INDEX `pindahs_keluarga_id_foreign`(`keluarga_id` ASC) USING BTREE,
  CONSTRAINT `pindahs_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluargas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `pindahs_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pindahs
-- ----------------------------
INSERT INTO `pindahs` VALUES (1, '2025-07-23', 1, '2025-07-23 07:04:28', '2025-07-23 07:04:28', 1, 'pendidikan', 'kota', 'jambikecil', 'jambi', 'jambi');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', NULL, '$2y$12$D5teYVC73Fvk2QGESJsdFOsqODAEwep/qq1vjrO4aQDtLwvT1Po5K', NULL, '2025-07-22 06:18:05', '2025-07-22 06:18:05');

SET FOREIGN_KEY_CHECKS = 1;
