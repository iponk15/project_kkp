/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : project_kkp

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 11/10/2020 05:32:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kkp_golongan
-- ----------------------------
DROP TABLE IF EXISTS `kkp_golongan`;
CREATE TABLE `kkp_golongan`  (
  `golongan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `golongan_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `golongan_created_by` bigint(20) UNSIGNED NOT NULL,
  `golongan_created_date` datetime(0) NOT NULL,
  `golongan_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `golongan_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `golongan_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`golongan_id`) USING BTREE,
  INDEX `kkp_golongan_golongan_created_by_foreign`(`golongan_created_by`) USING BTREE,
  INDEX `kkp_golongan_golongan_updated_by_foreign`(`golongan_updated_by`) USING BTREE,
  CONSTRAINT `kkp_golongan_golongan_created_by_foreign` FOREIGN KEY (`golongan_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_golongan_golongan_updated_by_foreign` FOREIGN KEY (`golongan_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_golongan
-- ----------------------------
INSERT INTO `kkp_golongan` VALUES (1, 'I A', 'Juru Muda', 'Golongan I A dengan nama Juru Muda', '1', 1, '2020-07-31 17:42:12', NULL, '2020-07-31 17:42:12', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (2, 'I B', 'Juru Muda Tingkat 1', 'Juru Muda Tingkat 1', '1', 1, '2020-07-31 17:45:42', NULL, '2020-07-31 17:45:42', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (3, 'I C', 'Juru', 'Juru', '1', 1, '2020-07-31 17:45:51', NULL, '2020-07-31 17:45:51', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (4, 'I D', 'Juru Tingkat 1', 'Juru Tingkat 1', '1', 1, '2020-07-31 17:46:08', NULL, '2020-07-31 17:46:08', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (5, 'II A', 'Pengatur Muda', 'Pengatur Muda', '1', 1, '2020-07-31 17:46:48', NULL, '2020-07-31 17:46:48', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (6, 'II B', 'Pengatur Muda Tingkat 1', 'Pengatur Muda Tingkat 1', '1', 1, '2020-07-31 17:47:01', NULL, '2020-07-31 17:47:01', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (7, 'II C', 'Pengatur', 'Pengatur', '1', 1, '2020-07-31 17:47:10', NULL, '2020-07-31 17:47:10', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (8, 'II D', 'Pengatur Tingkat 1', 'Pengatur Tingkat 1', '1', 1, '2020-07-31 17:47:59', NULL, '2020-07-31 17:47:59', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (9, 'III A', 'Penata Muda', 'Penata Muda', '1', 1, '2020-07-31 17:48:14', NULL, '2020-07-31 17:48:14', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (10, 'III B', 'Pengata Muda Tingakat 1', 'Pengata Muda Tingakat 1', '1', 1, '2020-07-31 17:48:29', NULL, '2020-07-31 17:48:29', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (11, 'III C', 'Penata', 'Penata', '1', 1, '2020-07-31 17:48:39', NULL, '2020-07-31 17:48:39', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (12, 'III D', 'Penata Tingkat 1', 'Penata Tingkat 1', '1', 1, '2020-07-31 17:48:53', NULL, '2020-07-31 17:48:53', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (13, 'IV A', 'Pembina', 'Pembina', '1', 1, '2020-07-31 17:49:15', NULL, '2020-07-31 17:49:15', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (14, 'IV B', 'Pembina Tingkat 1', 'Pembina Tingkat 1', '1', 1, '2020-07-31 17:49:28', NULL, '2020-07-31 17:49:28', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (15, 'IV C', 'Pembina Utama Muda', 'Pembina Utama Muda', '1', 1, '2020-07-31 17:49:49', NULL, '2020-07-31 17:49:49', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (16, 'IV D', 'Pembina Utama Madya', 'Pembina Utama Madya', '1', 1, '2020-07-31 17:50:15', NULL, '2020-07-31 17:50:15', '127.0.0.1');
INSERT INTO `kkp_golongan` VALUES (17, 'IV E', 'Pembina Utama', 'Pembina Utama', '1', 1, '2020-07-31 17:50:28', NULL, '2020-07-31 17:50:28', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_jenis_obat
-- ----------------------------
DROP TABLE IF EXISTS `kkp_jenis_obat`;
CREATE TABLE `kkp_jenis_obat`  (
  `jenobat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenobat_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenobat_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenobat_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `jenobat_created_by` bigint(20) UNSIGNED NOT NULL,
  `jenobat_created_date` datetime(0) NOT NULL,
  `jenobat_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `jenobat_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenobat_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`jenobat_id`) USING BTREE,
  INDEX `kkp_jenis_obat_jenobat_created_by_foreign`(`jenobat_created_by`) USING BTREE,
  INDEX `kkp_jenis_obat_jenobat_updated_by_foreign`(`jenobat_updated_by`) USING BTREE,
  CONSTRAINT `kkp_jenis_obat_jenobat_created_by_foreign` FOREIGN KEY (`jenobat_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_jenis_obat_jenobat_updated_by_foreign` FOREIGN KEY (`jenobat_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_jenis_obat
-- ----------------------------
INSERT INTO `kkp_jenis_obat` VALUES (8, 'Generik', 'Generik', '1', 1, '2020-07-14 23:19:59', NULL, '2020-07-15 06:19:59', '127.0.0.1');
INSERT INTO `kkp_jenis_obat` VALUES (9, 'Non Generik', 'Non Generik', '1', 1, '2020-07-14 23:20:06', NULL, '2020-07-15 06:20:06', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_jenisp_gigi
-- ----------------------------
DROP TABLE IF EXISTS `kkp_jenisp_gigi`;
CREATE TABLE `kkp_jenisp_gigi`  (
  `jenisp_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenisp_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jenisp_warna` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jenisp_deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `jenisp_status` enum('0','1','99') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `jenisp_createddate` datetime(0) DEFAULT NULL,
  `jenisp_createdby` int(11) DEFAULT NULL,
  `jenisp_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `jenisp_updatedby` int(11) DEFAULT NULL,
  `jenisp_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`jenisp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_jenisp_gigi
-- ----------------------------
INSERT INTO `kkp_jenisp_gigi` VALUES (1, 'Pit dan Fissure Sealang (fis)', '#0000FF', 'Pit dan Fissure Sealang (fis)', '1', '2020-10-08 21:11:39', NULL, '2020-10-08 21:11:39', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (2, 'Tambalan Composite', '#00FFFF', 'Tambalan Composite', '1', '2020-10-08 21:13:19', NULL, '2020-10-08 21:13:19', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (3, 'Gigi non Vital', '#8A2BE2', 'Gigi non Vital', '1', '2020-10-08 21:14:35', NULL, '2020-10-08 21:14:35', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (4, 'Perawatan Saluran Akar', '#A52A2A', 'Perawatan Saluran Akar', '1', '2020-10-08 21:17:00', NULL, '2020-10-08 21:17:00', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (5, 'Gigi tidak ada', '#7FFF00', 'tidak diketahui ada atau tidak ada', '1', '2020-10-08 21:18:20', NULL, '2020-10-08 21:18:20', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (6, 'Un-Erupted (une)', '#6464ED', 'Un-Erupted (une)', '1', '2020-10-08 21:19:10', NULL, '2020-10-08 21:19:10', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (7, 'Partial Erupt (pre)', '#00FFFF', 'Partial Erupt (pre)', '1', '2020-10-08 21:20:20', NULL, '2020-10-08 21:20:20', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (8, 'Norma / Baik (sou)', '#00008B', 'Norma / Baik (sou)', '1', '2020-10-08 21:21:11', NULL, '2020-10-08 21:21:11', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (9, 'Anomali (ano)', '#008B8B', 'Anomali (ano)', '1', '2020-10-08 21:23:02', NULL, '2020-10-08 21:23:02', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (10, 'Pegshape, micro, fusi, etc', '#B8860B', 'Pegshape, micro, fusi, etc', '1', '2020-10-08 21:24:46', NULL, '2020-10-08 21:24:46', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (11, 'Caries, tambalan sementara', '#E18C00', 'Caries, tambalan sementara', '1', '2020-10-08 21:28:49', NULL, '2020-10-08 21:28:49', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (12, 'Garis batas caries dibuat sesuai carries', '#9400D3', 'Garis batas caries dibuat sesuai carries', '1', '2020-10-08 21:31:11', NULL, '2020-10-08 21:31:11', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (13, 'Fracture (cfr)', '#FF09FF', 'Fracture (cfr)', '1', '2020-10-08 21:36:09', NULL, '2020-10-08 21:36:09', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (14, 'Tambalan Amalgam pada gigi non vital = Root Canal', '#FFD700', 'Tambalan Amalgam pada gigi non vital = Root Canal', '1', '2020-10-08 21:41:41', NULL, '2020-10-08 21:41:41', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (15, 'Tambah Composite pada gigi non vital = Root Canal', '#008000', 'Tambah Composite pada gigi non vital = Root Canal', '1', '2020-10-08 21:43:14', NULL, '2020-10-08 21:43:14', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (16, 'Full metal crown pada gigi vital (fmc)', '#ADFF2F', 'Full metal crown pada gigi vital (fmc)', '1', '2020-10-08 21:44:10', NULL, '2020-10-08 21:44:10', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (17, 'Full Metal Crown pada gigi non vital (fmc-rct)', '#4B0082', 'Full Metal Crown pada gigi non vital (fmc-rct)', '1', '2020-10-08 21:48:38', NULL, '2020-10-08 21:48:38', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (18, 'Porcelain crown pada gigi vital (poc)', '#FF69B4', 'Porcelain crown pada gigi vital (poc)', '1', '2020-10-08 21:51:14', NULL, '2020-10-08 21:51:14', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (19, 'Porcelain crown pada gigi no vital (poc-rct)', '#FF00FF', 'Porcelain crown pada gigi no vital (poc-rct)', '1', '2020-10-08 21:52:50', NULL, '2020-10-08 21:52:50', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (20, 'Sisa Akar (rrx)', '#FF0000', 'Sisa Akar (rrx)', '1', '2020-10-08 21:53:54', NULL, '2020-10-08 21:53:54', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (21, 'Gigi hilang (mis)', '#87CEEB', 'Gigi hilang', '1', '2020-10-08 21:56:14', NULL, '2020-10-08 21:56:14', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (22, 'Implant + Porcelain Crown (ipx - poc)', '#C0C0C0', 'Implant + Porcelain Crown (ipx - poc)', '1', '2020-10-08 21:58:25', NULL, '2020-10-08 21:58:25', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (23, 'Full metal bridge 3 units. (MEB) (masing-masing gigi)', '#FFFF00', 'Full metal bridge 3 units. (MEB) (masing-masing gigi)', '1', '2020-10-08 22:00:41', NULL, '2020-10-08 22:00:41', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (24, 'Porcelain bridge 4 units (pob)', '#008080', 'Porcelain bridge 4 units (pob)', '1', '2020-10-08 22:03:03', NULL, '2020-10-08 22:03:03', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (25, 'Full Metal Cantilever Bridge (meb)', '#D2B48C', 'Full Metal Cantilever Bridge (meb)', '1', '2020-10-08 22:06:41', NULL, '2020-10-08 22:06:41', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (26, 'Partial Denture/ Full Denture (frm=Frame, acr=Acr)', '#DDA0DD', 'Partial Denture/ Full Denture (frm=Frame, acr=Acr)', '1', '2020-10-08 22:08:17', NULL, '2020-10-08 22:08:17', NULL, '127.0.0.1');
INSERT INTO `kkp_jenisp_gigi` VALUES (27, 'Migrasi / Verison / Rotasi dibuat panah sesuai arah', '#FFE4B5', 'Migrasi / Verison / Rotasi dibuat panah sesuai arah', '1', '2020-10-08 22:09:09', NULL, '2020-10-08 22:09:09', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_kategori_obat
-- ----------------------------
DROP TABLE IF EXISTS `kkp_kategori_obat`;
CREATE TABLE `kkp_kategori_obat`  (
  `katobat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `katobat_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `katobat_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `katobat_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `katobat_created_by` bigint(20) UNSIGNED NOT NULL,
  `katobat_created_date` datetime(0) NOT NULL,
  `katobat_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `katobat_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `katobat_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`katobat_id`) USING BTREE,
  INDEX `kkp_kategori_obat_katobat_created_by_foreign`(`katobat_created_by`) USING BTREE,
  INDEX `kkp_kategori_obat_katobat_updated_by_foreign`(`katobat_updated_by`) USING BTREE,
  CONSTRAINT `kkp_kategori_obat_katobat_created_by_foreign` FOREIGN KEY (`katobat_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_kategori_obat_katobat_updated_by_foreign` FOREIGN KEY (`katobat_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_kategori_obat
-- ----------------------------
INSERT INTO `kkp_kategori_obat` VALUES (6, 'ANTIBIOTIK/ANTIFUNGI/ANTIVIRAL', 'ANTIBIOTIK/ANTIFUNGI/ANTIVIRAL', '1', 1, '2020-07-14 22:48:05', NULL, '2020-07-15 05:48:05', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (7, 'COLD REMEDIS', 'COLD REMEDIS', '1', 1, '2020-07-14 22:48:15', NULL, '2020-07-15 05:48:15', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (8, 'OBAT SALURAN CERNA', 'OBAT SALURAN CERNA', '1', 1, '2020-07-14 22:48:23', NULL, '2020-07-15 05:48:23', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (9, 'OBAT METABOLISME & PENY DALAM', 'OBAT METABOLISME & PENY DALAM', '1', 1, '2020-07-14 22:48:34', NULL, '2020-07-15 05:48:34', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (10, 'ANALGETIK ANTIPIRETIK', 'ANALGETIK ANTIPIRETIK', '1', 1, '2020-07-14 22:48:43', NULL, '2020-07-15 05:48:43', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (11, 'ANTI INFLAMASI & ALERGI', 'ANTI INFLAMASI & ALERGI', '1', 1, '2020-07-14 22:48:51', NULL, '2020-07-15 05:48:51', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (12, 'SEDIAAN TOPIKAL', 'SEDIAAN TOPIKAL', '1', 1, '2020-07-14 22:49:00', NULL, '2020-07-15 05:49:00', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (13, 'VITAMIN & SUPLEMEN', 'VITAMIN & SUPLEMEN', '1', 1, '2020-07-14 22:49:14', NULL, '2020-07-15 05:49:14', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (14, 'OBAT KB', 'OBAT KB', '1', 1, '2020-07-14 22:49:23', NULL, '2020-07-15 05:49:23', '127.0.0.1');
INSERT INTO `kkp_kategori_obat` VALUES (15, 'LAIN - LAIN', 'LAIN - LAIN', '1', 1, '2020-07-14 22:49:34', NULL, '2020-07-15 05:49:34', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_log
-- ----------------------------
DROP TABLE IF EXISTS `kkp_log`;
CREATE TABLE `kkp_log`  (
  `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_psntrans_id` int(10) UNSIGNED NOT NULL,
  `log_subjek` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `log_created_by` bigint(20) UNSIGNED NOT NULL,
  `log_created_date` datetime(0) NOT NULL,
  `log_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`log_id`) USING BTREE,
  INDEX `kkp_log_log_psntrans_id_foreign`(`log_psntrans_id`) USING BTREE,
  INDEX `kkp_log_log_created_by_foreign`(`log_created_by`) USING BTREE,
  CONSTRAINT `kkp_log_log_created_by_foreign` FOREIGN KEY (`log_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_log_log_psntrans_id_foreign` FOREIGN KEY (`log_psntrans_id`) REFERENCES `kkp_pasien_trans` (`psntrans_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_log
-- ----------------------------
INSERT INTO `kkp_log` VALUES (54, 26, 'Pendaftaran', 'Pasien melakukan pendaftaran', 5, '2020-07-31 21:03:33', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (55, 27, 'Pendaftaran', 'Pasien melakukan pendaftaran', 5, '2020-07-31 21:08:57', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (57, 26, 'Pengecakan suster', 'Pasien telah dicek oleh suster', 8, '2020-07-31 23:00:52', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (58, 26, 'Resep Obat', 'Dokter telah membuat resep obat untuk pasien', 15, '2020-07-31 23:35:17', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (59, 26, 'Pengecakan Dokter', 'Pasien telah dicek oleh Dokter', 15, '2020-07-31 23:55:56', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (60, 26, 'Resep Obat', 'Dokter telah membuat resep obat untuk pasien', 15, '2020-08-01 20:12:01', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (61, 26, 'Rujukan Laboratorium', 'Dokter telah merujuk pasien ke bagian laboratorium', 15, '2020-08-01 20:24:04', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (62, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-03 05:56:41', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (63, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-03 06:06:13', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (64, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 19:50:44', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (65, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 20:48:37', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (66, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 23:28:53', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (67, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 23:29:17', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (68, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 23:29:33', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (69, 26, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 15, '2020-08-08 23:29:43', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (70, 26, 'Rujukan Laboratorium', 'Dokter telah merujuk pasien ke bagian laboratorium', 15, '2020-08-08 23:34:14', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (71, 27, 'Pengecakan suster', 'Pasien telah dicek oleh suster', 8, '2020-08-09 11:29:44', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (73, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan sehat', 13, '2020-08-09 21:32:50', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (74, 27, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-08-09 21:33:34', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (75, 27, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-08-09 21:40:53', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (76, 27, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-08-09 21:55:42', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (77, 27, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-08-09 21:56:32', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (78, 27, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-08-09 23:20:46', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (79, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:21:58', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (80, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:24:08', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (81, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:24:22', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (82, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:29:40', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (83, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:29:46', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (84, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:30:33', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (85, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:37:14', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (86, 27, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 13, '2020-08-09 23:37:48', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (87, 28, 'Pendaftaran', 'Pasien melakukan pendaftaran', 5, '2020-10-06 20:35:09', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (88, 28, 'Pengecakan suster', 'Pasien telah dicek oleh suster', 8, '2020-10-06 22:14:43', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (89, 28, 'Pengecakan Dokter', 'Pasien telah dicek oleh Dokter', 11, '2020-10-06 22:49:12', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (90, 28, 'Pengecakan Dokter', 'Pasien telah dicek oleh Dokter', 11, '2020-10-06 22:49:23', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (91, 29, 'Pendaftaran', 'Pasien melakukan pendaftaran', 5, '2020-10-07 20:17:59', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (92, 29, 'Pengecakan suster', 'Pasien telah dicek oleh suster', 8, '2020-10-07 20:21:33', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (93, 29, 'Pengecakan Dokter', 'Pasien telah dicek oleh Dokter', 13, '2020-10-07 20:24:18', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (94, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 21:55:26', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (95, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:03:02', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (96, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:08:45', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (97, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:18:07', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (98, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:19:04', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (99, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:23:26', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (100, 29, 'Cek Lab', 'Hasil telah keluar, tinggal diambil oleh pasien', 13, '2020-10-07 22:23:37', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (101, 29, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-10-07 23:38:03', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (102, 29, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-10-07 23:39:08', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (103, 29, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-10-07 23:39:35', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (104, 29, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 13, '2020-10-08 08:16:08', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (105, 29, 'Pemeriksaan Penunjang - Radiologi', 'Dokter telah mengubah form radiologi', 13, '2020-10-08 08:32:41', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (106, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-09 06:09:08', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (107, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-09 06:16:03', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (108, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-09 23:42:37', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (109, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-10 16:13:45', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (110, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-10 16:14:00', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (111, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-10 17:18:45', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (112, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-10 17:19:45', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (113, 28, 'Odontogram', 'Dokter telah mengubah data odontogram', 11, '2020-10-10 17:20:24', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (114, 28, 'Pemeriksaan Penunjang - Radiologi', 'Dokter telah mengubah form radiologi', 11, '2020-10-10 17:37:49', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (115, 28, 'Surat Keterangan Sehat', 'Dokter telah membuat surat keterangan Sehat', 11, '2020-10-10 21:10:24', '127.0.0.1');
INSERT INTO `kkp_log` VALUES (116, 28, 'Surat Keterangan Sakit', 'Dokter telah membuat surat keterangan Sakit', 11, '2020-10-10 21:10:41', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_modon
-- ----------------------------
DROP TABLE IF EXISTS `kkp_modon`;
CREATE TABLE `kkp_modon`  (
  `modon_id` int(11) NOT NULL AUTO_INCREMENT,
  `modon_kode` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `modon_no` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `modon_tipe` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1' COMMENT '1 = box 5, 2 = box 4',
  `modon_transform` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `modon_order` int(2) DEFAULT NULL,
  `modon_status` enum('0','1','99') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `modon_createdby` int(11) DEFAULT NULL,
  `modon_createddate` datetime(0) DEFAULT NULL,
  `modon_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `modon_updatedby` int(11) DEFAULT NULL,
  `modon_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`modon_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_modon
-- ----------------------------
INSERT INTO `kkp_modon` VALUES (1, 'P18', '18', '1', 'matrix(1, 0, 0, 1, -18.841303, 0)', 1, '1', NULL, '2020-10-10 00:48:01', '2020-10-10 01:19:03', 1, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (2, 'P17', '17', '1', 'matrix(1, 0, 0, 1, 1.292291, 0)', 2, '1', NULL, '2020-10-10 02:50:07', '2020-10-10 02:50:07', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (3, 'P16', '16', '1', 'matrix(1, 0, 0, 1, 21.959291, 0)', 3, '1', NULL, '2020-10-10 02:53:26', '2020-10-10 02:53:26', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (4, 'P15', '15', '1', 'matrix(1, 0, 0, 1, 41.29229, 0)', 4, '1', NULL, '2020-10-10 02:54:11', '2020-10-10 02:54:11', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (5, 'P14', '14', '1', 'matrix(1, 0, 0, 1, 61.29229, 0)', 5, '1', NULL, '2020-10-10 02:54:51', '2020-10-10 02:54:51', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (6, 'P13', '13', '2', 'matrix(1, 0, 0, 1, 81.29229, 0)', 6, '1', NULL, '2020-10-10 02:55:22', '2020-10-10 02:55:22', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (11, 'P12', '12', '2', 'matrix(1, 0, 0, 1, 101.29229, 0)', 7, '1', NULL, '2020-10-10 08:58:06', '2020-10-10 08:58:06', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (12, 'P11', '11', '2', 'matrix(1, 0, 0, 1, 121.29229, 0)', 8, '1', NULL, '2020-10-10 08:59:38', '2020-10-10 08:59:38', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (13, 'P55', '55', '1', 'matrix(1, 0, 0, 1, 41.225494, 40)', 9, '1', NULL, '2020-10-10 09:01:41', '2020-10-10 09:02:03', 1, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (14, 'P54', '54', '1', 'matrix(1, 0, 0, 1, 61.225494, 40)', 10, '1', NULL, '2020-10-10 09:04:28', '2020-10-10 09:08:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (15, 'P53', '53', '2', 'matrix(1, 0, 0, 1, 81.225494, 40)', 11, '1', NULL, '2020-10-10 09:09:30', '2020-10-10 09:11:38', 1, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (16, 'P52', '52', '2', 'matrix(1, 0, 0, 1, 101.225494, 40)', 12, '1', NULL, '2020-10-10 09:13:09', '2020-10-10 09:13:09', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (17, 'P51', '51', '2', 'matrix(1, 0, 0, 1, 121.225494, 40)', 13, '1', NULL, '2020-10-10 09:14:53', '2020-10-10 09:14:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (18, 'P85', '85', '1', 'matrix(1, 0, 0, 1, 41.225494, 80)', 14, '1', NULL, '2020-10-10 09:21:53', '2020-10-10 09:21:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (19, 'P84', '84', '1', 'matrix(1, 0, 0, 1, 61.225494, 80)', 15, '1', NULL, '2020-10-10 09:23:33', '2020-10-10 09:23:33', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (20, 'P83', '83', '2', 'matrix(1, 0, 0, 1, 81.225494, 80)', 16, '1', NULL, '2020-10-10 09:24:37', '2020-10-10 09:26:23', 1, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (21, 'P82', '82', '2', 'matrix(1, 0, 0, 1, 101.225494, 80)', 17, '1', NULL, '2020-10-10 09:29:11', '2020-10-10 09:29:11', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (22, 'P81', '81', '2', 'matrix(1, 0, 0, 1, 121.225494, 80)', 18, '1', NULL, '2020-10-10 09:31:12', '2020-10-10 09:31:12', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (23, 'P48', '48', '1', 'matrix(1, 0, 0, 1, -18.774506, 120)', 19, '1', NULL, '2020-10-10 09:32:30', '2020-10-10 09:32:30', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (24, 'P47', '47', '1', 'matrix(1, 0, 0, 1, 1.225494, 120)', 20, '1', NULL, '2020-10-10 09:33:52', '2020-10-10 09:33:52', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (25, 'P46', '46', '1', 'matrix(1, 0, 0, 1, 21.225494, 120)', 21, '1', NULL, '2020-10-10 09:35:46', '2020-10-10 09:35:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (26, 'P45', '45', '1', 'matrix(1, 0, 0, 1, 41.225494, 120)', 22, '1', NULL, '2020-10-10 09:37:28', '2020-10-10 09:37:28', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (27, 'P44', '44', '1', 'matrix(1, 0, 0, 1, 61.225494, 120)', 23, '1', NULL, '2020-10-10 13:56:35', '2020-10-10 13:56:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (28, 'P43', '43', '2', 'matrix(1, 0, 0, 1, 81.225494, 120)', 24, '1', NULL, '2020-10-10 13:58:21', '2020-10-10 13:58:21', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (29, 'P42', '42', '2', 'matrix(1, 0, 0, 1, 101.225494, 120)', 25, '1', NULL, '2020-10-10 14:00:01', '2020-10-10 14:00:01', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (30, 'P41', '41', '2', 'matrix(1, 0, 0, 1, 121.225494, 120)', 26, '1', NULL, '2020-10-10 14:01:28', '2020-10-10 14:01:28', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (31, 'P21', '21', '2', 'matrix(1, 0, 0, 1, 141.292297, 0)', 27, '1', NULL, '2020-10-10 14:02:32', '2020-10-10 14:02:32', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (32, 'P22', '22', '2', 'matrix(1, 0, 0, 1, 161.292297, 0)', 28, '1', NULL, '2020-10-10 14:10:05', '2020-10-10 14:10:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (33, 'P23', '23', '2', 'matrix(1, 0, 0, 1, 181.292297, 0)', 29, '1', NULL, '2020-10-10 14:38:01', '2020-10-10 14:38:01', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (34, 'P24', '24', '1', 'matrix(1, 0, 0, 1, 201.292297, 0)', 30, '1', NULL, '2020-10-10 14:39:07', '2020-10-10 14:39:07', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (35, 'P25', '25', '1', 'matrix(1, 0, 0, 1, 221.292297, 0)', 31, '1', NULL, '2020-10-10 14:46:04', '2020-10-10 14:46:04', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (36, 'P26', '26', '1', 'matrix(1, 0, 0, 1, 241.292297, 0)', 32, '1', NULL, '2020-10-10 14:47:24', '2020-10-10 14:47:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (37, 'P27', '27', '1', 'matrix(1, 0, 0, 1, 261.292297, 0)', 33, '1', NULL, '2020-10-10 14:48:45', '2020-10-10 14:48:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (38, 'P28', '28', '1', 'matrix(1, 0, 0, 1, 281.292297, 0)', 34, '1', NULL, '2020-10-10 15:28:06', '2020-10-10 15:28:06', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (39, 'P61', '61', '2', 'matrix(1, 0, 0, 1, 141.225494, 40)', 35, '1', NULL, '2020-10-10 15:29:24', '2020-10-10 15:29:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (40, 'P62', '62', '2', 'matrix(1, 0, 0, 1, 161.225494, 40)', 36, '1', NULL, '2020-10-10 15:30:31', '2020-10-10 15:30:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (41, 'P63', '63', '2', 'matrix(1, 0, 0, 1, 181.225494, 40)', 37, '1', NULL, '2020-10-10 15:31:28', '2020-10-10 15:31:28', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (42, 'P64', '64', '1', 'matrix(1, 0, 0, 1, 201.225494, 40)', 38, '1', NULL, '2020-10-10 15:32:28', '2020-10-10 15:32:28', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (43, 'P65', '65', '1', 'matrix(1, 0, 0, 1, 221.225494, 40)', 39, '1', NULL, '2020-10-10 15:33:35', '2020-10-10 15:33:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (44, 'P71', '71', '2', 'matrix(1, 0, 0, 1, 141.225494, 80)', 40, '1', NULL, '2020-10-10 15:34:59', '2020-10-10 15:34:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (45, 'P72', '72', '2', 'matrix(1, 0, 0, 1, 161.225494, 80)', 41, '1', NULL, '2020-10-10 15:35:52', '2020-10-10 15:35:52', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (46, 'P73', '73', '2', 'matrix(1, 0, 0, 1, 181.225494, 80)', 42, '1', NULL, '2020-10-10 15:36:53', '2020-10-10 15:36:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (47, 'P74', '74', '2', 'matrix(1, 0, 0, 1, 201.225494, 80)', 43, '1', NULL, '2020-10-10 15:38:03', '2020-10-10 15:38:03', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (48, 'P75', '75', '1', 'matrix(1, 0, 0, 1, 221.225494, 80)', 44, '1', NULL, '2020-10-10 15:39:05', '2020-10-10 15:39:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (49, 'P31', '31', '2', 'matrix(1, 0, 0, 1, 141.225494, 120)', 45, '1', NULL, '2020-10-10 15:40:25', '2020-10-10 15:40:25', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (50, 'P32', '32', '2', 'matrix(1, 0, 0, 1, 161.225494, 120)', 46, '1', NULL, '2020-10-10 15:41:24', '2020-10-10 15:41:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (51, 'P33', '33', '2', 'matrix(1, 0, 0, 1, 181.225494, 120)', 47, '1', NULL, '2020-10-10 15:43:09', '2020-10-10 15:43:09', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (52, 'P34', '34', '1', 'matrix(1, 0, 0, 1, 201.225494, 120)', 48, '1', NULL, '2020-10-10 15:44:46', '2020-10-10 15:44:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (53, 'P35', '35', '1', 'matrix(1, 0, 0, 1, 221.225494, 120)', 49, '1', NULL, '2020-10-10 15:45:59', '2020-10-10 15:45:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (54, 'P36', '36', '1', 'matrix(1, 0, 0, 1, 241.225494, 120)', 50, '1', NULL, '2020-10-10 15:47:10', '2020-10-10 15:47:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (55, 'P37', '37', '1', 'matrix(1, 0, 0, 1, 261.225494, 120)', 51, '1', NULL, '2020-10-10 15:48:22', '2020-10-10 15:48:22', NULL, '127.0.0.1');
INSERT INTO `kkp_modon` VALUES (56, 'P38', '38', '1', 'matrix(1, 0, 0, 1, 281.225494, 120)', 52, '1', NULL, '2020-10-10 15:49:19', '2020-10-10 15:49:19', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_modon_detail
-- ----------------------------
DROP TABLE IF EXISTS `kkp_modon_detail`;
CREATE TABLE `kkp_modon_detail`  (
  `modet_id` int(11) NOT NULL AUTO_INCREMENT,
  `modet_modon_id` int(11) DEFAULT NULL,
  `modet_kode` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `modet_points` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `modet_order` int(2) DEFAULT NULL,
  `modet_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `modet_createdby` int(11) DEFAULT NULL,
  `modet_createddate` datetime(0) DEFAULT NULL,
  `modet_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `modet_updatedby` int(11) DEFAULT NULL,
  `modet_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`modet_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 243 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_modon_detail
-- ----------------------------
INSERT INTO `kkp_modon_detail` VALUES (1, 1, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 01:58:23', '2020-10-10 01:58:24', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (2, 1, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', NULL, NULL, '2020-10-10 01:59:49', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (3, 1, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', NULL, NULL, '2020-10-10 02:00:03', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (4, 1, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20\"', 4, '1', NULL, NULL, '2020-10-10 02:00:31', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (5, 1, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', NULL, NULL, '2020-10-10 02:00:33', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (6, 2, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', NULL, NULL, '2020-10-10 02:50:43', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (7, 2, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', NULL, NULL, '2020-10-10 02:51:16', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (8, 2, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', NULL, NULL, '2020-10-10 02:51:55', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (9, 2, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', NULL, NULL, '2020-10-10 02:52:10', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (10, 2, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', NULL, NULL, '2020-10-10 02:52:25', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (11, 6, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', NULL, NULL, '2020-10-10 02:56:37', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (12, 6, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', NULL, NULL, '2020-10-10 02:56:49', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (13, 6, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', NULL, NULL, '2020-10-10 02:56:58', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (14, 6, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', NULL, NULL, '2020-10-10 02:57:07', NULL, NULL);
INSERT INTO `kkp_modon_detail` VALUES (15, NULL, 'a', 'a', 1, '1', 1, '2020-10-10 07:08:10', '2020-10-10 07:08:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (22, 3, 'T', '-0.667 0 19.333 0 14.333 5 4.333 5', 1, '1', 1, '2020-10-10 08:38:54', '2020-10-10 08:38:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (23, 3, 'B', '4.333 15 14.333 15 19.333 20 -0.667 20', 2, '1', 1, '2020-10-10 08:39:06', '2020-10-10 08:39:06', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (24, 3, 'R', '14.333 5 19.333 0 19.333 20 14.333 15', 3, '1', 1, '2020-10-10 08:39:43', '2020-10-10 08:39:43', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (25, 3, 'L', '-0.667 0 4.333 5 4.333 15 -0.667 20', 4, '1', 1, '2020-10-10 08:39:58', '2020-10-10 08:39:58', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (26, 3, 'C', '4.333 5 14.333 5 14.333 15 4.333 15', 5, '1', 1, '2020-10-10 08:40:17', '2020-10-10 08:40:17', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (27, 4, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 08:40:48', '2020-10-10 08:40:48', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (28, 4, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 08:41:18', '2020-10-10 08:41:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (29, 4, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 08:41:29', '2020-10-10 08:41:29', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (30, 4, 'l', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 08:41:43', '2020-10-10 08:41:43', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (31, 4, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 08:41:53', '2020-10-10 08:41:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (32, 5, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 08:42:20', '2020-10-10 08:42:20', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (33, 5, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 08:42:36', '2020-10-10 08:42:36', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (34, 5, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 08:42:50', '2020-10-10 08:42:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (35, 5, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 08:43:07', '2020-10-10 08:43:07', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (36, 5, 'c', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 08:43:18', '2020-10-10 08:43:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (37, 11, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 08:58:22', '2020-10-10 08:58:22', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (38, 11, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 08:58:34', '2020-10-10 08:58:34', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (39, 11, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 08:58:45', '2020-10-10 08:58:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (40, 11, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 08:58:56', '2020-10-10 08:58:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (41, 12, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 08:59:57', '2020-10-10 08:59:57', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (42, 12, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:00:08', '2020-10-10 09:00:08', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (43, 12, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:00:18', '2020-10-10 09:00:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (44, 12, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:00:31', '2020-10-10 09:00:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (45, 13, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:02:20', '2020-10-10 09:02:20', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (46, 13, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:02:35', '2020-10-10 09:02:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (47, 13, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:02:45', '2020-10-10 09:02:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (48, 13, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:02:57', '2020-10-10 09:02:57', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (49, 13, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:03:08', '2020-10-10 09:03:08', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (50, 14, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:04:43', '2020-10-10 09:04:43', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (51, 14, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:04:55', '2020-10-10 09:04:55', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (52, 14, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:05:04', '2020-10-10 09:05:04', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (53, 14, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:05:14', '2020-10-10 09:05:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (54, 14, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:05:26', '2020-10-10 09:05:26', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (55, 15, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:09:46', '2020-10-10 09:09:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (56, 15, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:09:55', '2020-10-10 09:09:55', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (57, 15, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:10:14', '2020-10-10 09:10:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (58, 15, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:10:25', '2020-10-10 09:10:25', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (59, 16, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:13:24', '2020-10-10 09:13:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (60, 16, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:13:37', '2020-10-10 09:13:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (61, 16, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:13:47', '2020-10-10 09:13:47', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (62, 16, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:14:06', '2020-10-10 09:14:06', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (63, 17, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:15:59', '2020-10-10 09:15:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (64, 17, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:16:19', '2020-10-10 09:16:19', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (65, 17, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:16:48', '2020-10-10 09:16:48', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (66, 17, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:16:58', '2020-10-10 09:16:58', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (67, 18, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:22:05', '2020-10-10 09:22:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (68, 18, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:22:19', '2020-10-10 09:22:19', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (69, 18, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:22:31', '2020-10-10 09:22:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (70, 18, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:22:43', '2020-10-10 09:22:43', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (71, 18, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:22:54', '2020-10-10 09:22:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (72, 19, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:23:44', '2020-10-10 09:23:44', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (73, 19, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:23:52', '2020-10-10 09:23:52', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (74, 19, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:24:00', '2020-10-10 09:24:00', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (75, 19, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:24:09', '2020-10-10 09:24:09', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (76, 19, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:24:19', '2020-10-10 09:24:19', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (77, 20, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:25:37', '2020-10-10 09:25:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (78, 20, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:25:50', '2020-10-10 09:25:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (79, 20, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:26:01', '2020-10-10 09:26:01', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (80, 20, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:26:14', '2020-10-10 09:26:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (81, 21, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:29:54', '2020-10-10 09:29:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (82, 21, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:30:18', '2020-10-10 09:30:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (83, 21, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:30:31', '2020-10-10 09:30:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (84, 21, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:30:40', '2020-10-10 09:30:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (85, 22, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 09:31:23', '2020-10-10 09:31:23', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (86, 22, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 09:31:31', '2020-10-10 09:31:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (87, 22, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 09:31:41', '2020-10-10 09:31:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (88, 22, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 09:31:50', '2020-10-10 09:31:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (89, 23, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:32:51', '2020-10-10 09:32:51', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (90, 23, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:33:00', '2020-10-10 09:33:00', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (91, 23, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:33:07', '2020-10-10 09:33:07', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (92, 23, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:33:15', '2020-10-10 09:33:15', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (93, 23, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:33:25', '2020-10-10 09:33:25', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (94, 24, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:34:12', '2020-10-10 09:34:12', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (95, 24, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20\"', 2, '1', 1, '2020-10-10 09:34:22', '2020-10-10 09:34:22', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (96, 24, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:34:31', '2020-10-10 09:34:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (97, 24, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:34:41', '2020-10-10 09:34:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (98, 24, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:34:50', '2020-10-10 09:34:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (99, 25, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 09:35:57', '2020-10-10 09:35:57', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (100, 25, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 09:36:25', '2020-10-10 09:36:25', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (101, 25, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 09:36:39', '2020-10-10 09:36:39', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (102, 25, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 09:36:49', '2020-10-10 09:36:49', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (103, 25, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 09:37:00', '2020-10-10 09:37:00', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (104, 26, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 13:55:26', '2020-10-10 13:55:26', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (105, 26, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 13:52:46', '2020-10-10 13:52:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (106, 26, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 13:55:55', '2020-10-10 13:55:55', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (107, 26, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 13:53:51', '2020-10-10 13:53:51', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (108, 26, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 13:54:10', '2020-10-10 13:54:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (109, 27, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 13:56:56', '2020-10-10 13:56:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (110, 27, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 13:57:10', '2020-10-10 13:57:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (111, 27, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 13:57:22', '2020-10-10 13:57:22', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (112, 27, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 13:57:40', '2020-10-10 13:57:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (113, 27, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 13:57:53', '2020-10-10 13:57:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (114, 28, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 13:58:39', '2020-10-10 13:58:39', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (115, 28, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 13:58:51', '2020-10-10 13:58:51', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (116, 28, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 13:59:03', '2020-10-10 13:59:03', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (117, 28, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 13:59:14', '2020-10-10 13:59:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (118, 29, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 14:00:14', '2020-10-10 14:00:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (119, 29, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 14:00:25', '2020-10-10 14:00:25', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (120, 29, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 14:00:37', '2020-10-10 14:00:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (121, 29, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 14:00:48', '2020-10-10 14:00:48', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (122, 30, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 14:01:38', '2020-10-10 14:01:38', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (123, 30, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 14:01:47', '2020-10-10 14:01:47', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (124, 30, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 14:01:56', '2020-10-10 14:01:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (125, 30, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 14:02:06', '2020-10-10 14:02:06', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (126, 31, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 14:02:41', '2020-10-10 14:02:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (127, 31, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 14:02:50', '2020-10-10 14:02:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (128, 31, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 14:02:59', '2020-10-10 14:02:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (129, 31, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 14:03:09', '2020-10-10 14:03:09', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (130, 32, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 14:10:15', '2020-10-10 14:10:15', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (131, 32, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 14:10:26', '2020-10-10 14:10:26', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (132, 32, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 14:11:02', '2020-10-10 14:11:02', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (133, 32, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 14:10:52', '2020-10-10 14:10:52', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (134, 33, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 14:38:12', '2020-10-10 14:38:12', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (135, 33, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 14:38:21', '2020-10-10 14:38:21', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (136, 33, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 14:38:30', '2020-10-10 14:38:30', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (137, 33, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 14:38:41', '2020-10-10 14:38:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (138, 34, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5\"', 1, '1', 1, '2020-10-10 14:39:16', '2020-10-10 14:39:16', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (139, 34, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 14:39:23', '2020-10-10 14:39:23', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (140, 34, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 14:39:32', '2020-10-10 14:39:32', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (141, 34, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 14:39:40', '2020-10-10 14:39:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (142, 34, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 14:39:49', '2020-10-10 14:39:49', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (143, 35, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 14:46:18', '2020-10-10 14:46:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (144, 35, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 14:46:33', '2020-10-10 14:46:33', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (145, 35, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 14:46:40', '2020-10-10 14:46:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (146, 35, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 14:46:49', '2020-10-10 14:46:49', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (147, 35, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 14:46:59', '2020-10-10 14:46:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (148, 36, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 14:47:34', '2020-10-10 14:47:34', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (149, 36, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 14:47:44', '2020-10-10 14:47:44', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (150, 36, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 14:47:54', '2020-10-10 14:47:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (151, 36, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 14:48:04', '2020-10-10 14:48:04', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (152, 36, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 14:48:13', '2020-10-10 14:48:13', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (153, 37, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 14:48:56', '2020-10-10 14:48:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (154, 37, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 14:49:05', '2020-10-10 14:49:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (155, 37, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 14:49:13', '2020-10-10 14:49:13', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (156, 37, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 14:49:23', '2020-10-10 14:49:23', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (157, 37, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 14:49:34', '2020-10-10 14:49:34', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (158, 38, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:28:16', '2020-10-10 15:28:16', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (159, 38, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:28:24', '2020-10-10 15:28:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (160, 38, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:28:34', '2020-10-10 15:28:34', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (161, 38, 'L', '\"0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:28:43', '2020-10-10 15:28:43', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (162, 38, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:28:53', '2020-10-10 15:28:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (163, 39, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:29:38', '2020-10-10 15:29:38', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (164, 39, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:29:50', '2020-10-10 15:29:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (165, 39, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:29:59', '2020-10-10 15:29:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (166, 39, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:30:10', '2020-10-10 15:30:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (167, 40, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:30:41', '2020-10-10 15:30:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (168, 40, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:30:49', '2020-10-10 15:30:49', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (169, 40, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:30:59', '2020-10-10 15:30:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (170, 40, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:31:08', '2020-10-10 15:31:08', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (171, 41, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:31:38', '2020-10-10 15:31:38', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (172, 41, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:31:46', '2020-10-10 15:31:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (173, 41, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:31:54', '2020-10-10 15:31:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (174, 41, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:32:02', '2020-10-10 15:32:02', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (175, 42, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:32:37', '2020-10-10 15:32:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (176, 42, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:32:46', '2020-10-10 15:32:46', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (177, 42, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:32:53', '2020-10-10 15:32:53', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (178, 42, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:33:04', '2020-10-10 15:33:04', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (179, 42, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:33:13', '2020-10-10 15:33:13', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (180, 43, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:33:50', '2020-10-10 15:33:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (181, 43, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:33:59', '2020-10-10 15:33:59', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (182, 43, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:34:11', '2020-10-10 15:34:11', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (183, 43, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:34:18', '2020-10-10 15:34:18', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (184, 43, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:34:28', '2020-10-10 15:34:28', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (185, 44, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:35:07', '2020-10-10 15:35:07', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (186, 44, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:35:15', '2020-10-10 15:35:15', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (187, 44, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:35:23', '2020-10-10 15:35:23', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (188, 44, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:35:32', '2020-10-10 15:35:32', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (189, 45, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:36:01', '2020-10-10 15:36:01', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (190, 45, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:36:10', '2020-10-10 15:36:10', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (191, 45, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:36:20', '2020-10-10 15:36:20', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (192, 45, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:36:27', '2020-10-10 15:36:27', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (193, 46, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:37:03', '2020-10-10 15:37:03', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (194, 46, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:37:20', '2020-10-10 15:37:20', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (195, 46, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:37:35', '2020-10-10 15:37:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (196, 46, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:37:45', '2020-10-10 15:37:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (197, 47, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:38:12', '2020-10-10 15:38:12', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (198, 47, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:38:24', '2020-10-10 15:38:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (199, 47, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:38:35', '2020-10-10 15:38:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (200, 47, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:38:45', '2020-10-10 15:38:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (201, 48, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:39:13', '2020-10-10 15:39:13', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (202, 48, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:39:21', '2020-10-10 15:39:21', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (203, 48, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:39:29', '2020-10-10 15:39:29', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (204, 48, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:39:40', '2020-10-10 15:39:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (205, 48, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:39:51', '2020-10-10 15:39:51', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (206, 49, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:40:34', '2020-10-10 15:40:34', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (207, 49, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:40:45', '2020-10-10 15:40:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (208, 49, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:40:56', '2020-10-10 15:40:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (209, 49, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:41:05', '2020-10-10 15:41:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (210, 50, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:41:33', '2020-10-10 15:41:33', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (211, 50, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:41:47', '2020-10-10 15:41:47', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (212, 50, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:42:03', '2020-10-10 15:42:03', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (213, 50, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:42:13', '2020-10-10 15:42:13', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (214, 51, 'T', '0 0 20 0 15 8.333 5 8.333', 1, '1', 1, '2020-10-10 15:43:19', '2020-10-10 15:43:19', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (215, 51, 'B', '5 8.342 15 8.342 20 20.009 0 20.009', 2, '1', 1, '2020-10-10 15:43:37', '2020-10-10 15:43:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (216, 51, 'R', '15 8.5 20 0 20 20 15 8.5', 3, '1', 1, '2020-10-10 15:43:48', '2020-10-10 15:43:48', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (217, 51, 'L', '0 0 5 8.5 5 8.5 0 20', 4, '1', 1, '2020-10-10 15:43:57', '2020-10-10 15:43:57', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (218, 52, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:44:56', '2020-10-10 15:44:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (219, 52, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:45:05', '2020-10-10 15:45:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (220, 52, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:45:14', '2020-10-10 15:45:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (221, 52, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:45:23', '2020-10-10 15:45:23', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (222, 52, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:45:33', '2020-10-10 15:45:33', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (223, 53, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:46:14', '2020-10-10 15:46:14', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (224, 53, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:46:24', '2020-10-10 15:46:24', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (225, 53, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:46:32', '2020-10-10 15:46:32', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (226, 53, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:46:41', '2020-10-10 15:46:41', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (227, 53, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:46:52', '2020-10-10 15:46:52', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (228, 54, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:47:20', '2020-10-10 15:47:20', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (229, 54, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:47:29', '2020-10-10 15:47:29', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (230, 54, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:47:37', '2020-10-10 15:47:37', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (231, 54, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:47:50', '2020-10-10 15:47:50', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (232, 54, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:47:58', '2020-10-10 15:47:58', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (233, 55, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:48:31', '2020-10-10 15:48:31', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (234, 55, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:48:40', '2020-10-10 15:48:40', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (235, 55, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:48:48', '2020-10-10 15:48:48', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (236, 55, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:48:56', '2020-10-10 15:48:56', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (237, 55, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:49:05', '2020-10-10 15:49:05', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (238, 56, 'T', '0,0 &#9;20,0 &#9;15,5 &#9;5,5', 1, '1', 1, '2020-10-10 15:49:35', '2020-10-10 15:49:35', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (239, 56, 'B', '5,15 &#9;15,15 &#9;20,20 &#9;0,20', 2, '1', 1, '2020-10-10 15:49:45', '2020-10-10 15:49:45', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (240, 56, 'R', '15,5 &#9;20,0 &#9;20,20 &#9;15,15', 3, '1', 1, '2020-10-10 15:49:54', '2020-10-10 15:49:54', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (241, 56, 'L', '0,0 &#9;5,5 &#9;5,15 &#9;0,20', 4, '1', 1, '2020-10-10 15:50:02', '2020-10-10 15:50:02', NULL, '127.0.0.1');
INSERT INTO `kkp_modon_detail` VALUES (242, 56, 'C', '5,5 &#9;15,5 &#9;15,15 &#9;5,15', 5, '1', 1, '2020-10-10 15:50:13', '2020-10-10 15:50:13', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_obat
-- ----------------------------
DROP TABLE IF EXISTS `kkp_obat`;
CREATE TABLE `kkp_obat`  (
  `obat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `obat_jenobat_id` int(10) UNSIGNED DEFAULT NULL,
  `obat_katobat_id` int(10) UNSIGNED NOT NULL,
  `obat_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat_stok` bigint(20) NOT NULL,
  `obat_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `obat_created_by` bigint(20) UNSIGNED NOT NULL,
  `obat_created_date` datetime(0) NOT NULL,
  `obat_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `obat_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obat_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`obat_id`) USING BTREE,
  INDEX `kkp_obat_obat_created_by_foreign`(`obat_created_by`) USING BTREE,
  INDEX `kkp_obat_obat_updated_by_foreign`(`obat_updated_by`) USING BTREE,
  INDEX `kkp_obat_obat_jenobat_id_foreign`(`obat_jenobat_id`) USING BTREE,
  INDEX `kkp_obat_obat_katobat_id_foreign`(`obat_katobat_id`) USING BTREE,
  CONSTRAINT `kkp_obat_obat_created_by_foreign` FOREIGN KEY (`obat_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_obat_obat_jenobat_id_foreign` FOREIGN KEY (`obat_jenobat_id`) REFERENCES `kkp_jenis_obat` (`jenobat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_obat_obat_katobat_id_foreign` FOREIGN KEY (`obat_katobat_id`) REFERENCES `kkp_kategori_obat` (`katobat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_obat_obat_updated_by_foreign` FOREIGN KEY (`obat_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_obat
-- ----------------------------
INSERT INTO `kkp_obat` VALUES (2, 8, 6, 'Acyclovir 400 mg', 'Acyclovir 400 mg', 212, '1', 1, '2020-07-14 23:24:52', 1, '2020-07-15 06:24:52', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (3, 8, 6, 'Amoksilin DS 125 mg', 'Amoksilin DS 125 mg', 140, '1', 1, '2020-07-14 23:25:10', 1, '2020-07-15 06:25:10', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (4, 8, 6, 'Amoksisilin kaplet 500 mg', 'Amoksisilin kaplet 500 mg', 50, '1', 1, '2020-07-14 23:55:20', NULL, '2020-07-15 06:55:20', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (5, 8, 6, 'Cotrimoksazol 960 mg tab', 'Cotrimoksazol 960 mg tab', 0, '1', 1, '2020-07-14 23:55:32', NULL, '2020-07-15 06:55:32', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (6, 8, 6, 'Cefadroxil 500 mg', 'Cefadroxil 500 mg', 0, '1', 1, '2020-07-14 23:55:44', NULL, '2020-07-15 06:55:44', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (7, 8, 6, 'Cefadroxil sirup kering 125 ml/5 ml', 'Cefadroxil sirup kering 125 ml/5 ml', 0, '1', 1, '2020-07-14 23:55:54', NULL, '2020-07-15 06:55:54', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (8, 8, 6, 'Cefadroxil sirup kering 250 ml/5 ml', 'Cefadroxil sirup kering 250 ml/5 ml', 0, '1', 1, '2020-07-14 23:56:06', NULL, '2020-07-15 06:56:06', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (9, 8, 6, 'Cefiksim kapsul 100 mg', 'Cefiksim kapsul 100 mg', 0, '1', 1, '2020-07-14 23:56:17', NULL, '2020-07-15 06:56:17', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (10, 8, 6, 'Cefiksim sirup kering 100 mg/5 ml', 'Cefiksim sirup kering 100 mg/5 ml', 0, '1', 1, '2020-07-14 23:56:31', NULL, '2020-07-15 06:56:31', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (11, 8, 6, 'Cefixim 200 mg', 'Cefixim 200 mg', 0, '1', 1, '2020-07-14 23:56:41', NULL, '2020-07-15 06:56:41', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (12, 8, 6, 'Ciprofloksasin 500 mg', 'Ciprofloksasin 500 mg', 0, '1', 1, '2020-07-14 23:56:52', NULL, '2020-07-15 06:56:52', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (13, 8, 6, 'Clindamisin 300 mg', 'Clindamisin 300 mg', 0, '1', 1, '2020-07-14 23:57:03', NULL, '2020-07-15 06:57:03', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (14, 8, 6, 'Cotrimoksazol syrup', 'Cotrimoksazol syrup', 0, '1', 1, '2020-07-14 23:57:16', NULL, '2020-07-15 06:57:16', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (15, 8, 6, 'Chloramphenicol caps', 'Chloramphenicol caps', 0, '1', 1, '2020-07-14 23:57:27', NULL, '2020-07-15 06:57:27', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (16, 8, 6, 'Erytromisin 500 cap', 'Erytromisin 500 cap', 0, '1', 1, '2020-07-14 23:57:38', NULL, '2020-07-15 06:57:38', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (17, 8, 6, 'Ketoconazol 200 mg', 'Ketoconazol 200 mg', 0, '1', 1, '2020-07-14 23:57:48', NULL, '2020-07-15 06:57:48', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (18, 8, 6, 'Linkomisin 500 mg', 'Linkomisin 500 mg', 0, '1', 1, '2020-07-14 23:57:59', NULL, '2020-07-15 06:57:59', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (19, 8, 6, 'Levofloxacin 500', 'Levofloxacin 500', 0, '1', 1, '2020-07-14 23:58:13', NULL, '2020-07-15 06:58:13', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (20, 8, 6, 'Metronidazol 500 mg', 'Metronidazol 500 mg', 0, '1', 1, '2020-07-14 23:58:24', NULL, '2020-07-15 06:58:24', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (21, 9, 6, 'Amoxicilin DS 125 mg/5 mL (AMOXAN SYR)', 'Amoxicilin DS 125 mg/5 mL (AMOXAN SYR)', 0, '1', 1, '2020-07-14 23:58:36', NULL, '2020-07-15 06:58:36', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (22, 9, 6, 'Amoxicilin DS 250 mg/5 mL (AMOXAN FORTE  DS)', 'Amoxicilin DS 250 mg/5 mL (AMOXAN FORTE  DS)', 0, '1', 1, '2020-07-15 00:00:03', NULL, '2020-07-15 07:00:03', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (23, 9, 6, 'Anerocid 300 mg', 'Anerocid 300 mg', 0, '1', 1, '2020-07-15 00:00:16', NULL, '2020-07-15 07:00:16', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (24, 9, 6, 'Cefat 500 mg', 'Cefat 500 mg', 0, '1', 1, '2020-07-15 00:00:26', NULL, '2020-07-15 07:00:26', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (25, 9, 6, 'Cefspan 100 mg', 'Cefspan 100 mg', 0, '1', 1, '2020-07-15 00:00:36', NULL, '2020-07-15 07:00:36', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (26, 9, 6, 'Cefspan 200 mg', 'Cefspan 200 mg', 0, '1', 1, '2020-07-15 00:00:48', NULL, '2020-07-15 07:00:48', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (27, 9, 6, 'Enystin oral susp', 'Enystin oral susp', 0, '1', 1, '2020-07-15 00:00:59', NULL, '2020-07-15 07:00:59', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (28, 9, 6, 'FG Troches', 'FG Troches', 0, '1', 1, '2020-07-15 00:01:10', NULL, '2020-07-15 07:01:10', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (29, 9, 6, 'Fladystin Ovula', 'Fladystin Ovula', 0, '1', 1, '2020-07-15 00:01:19', NULL, '2020-07-15 07:01:19', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (30, 9, 6, 'Isoprinosin tab', 'Isoprinosin tab', 0, '1', 1, '2020-07-15 00:01:28', NULL, '2020-07-15 07:01:28', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (31, 9, 6, 'Sanprima Tablet', 'Sanprima Tablet', 0, '1', 1, '2020-07-15 00:01:38', NULL, '2020-07-15 07:01:38', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (32, 9, 6, 'Sanprima Syrup', 'Sanprima Syrup', 0, '1', 1, '2020-07-15 00:01:49', NULL, '2020-07-15 07:01:49', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (33, 9, 6, 'Siclidon 100', 'Siclidon 100', 0, '1', 1, '2020-07-15 00:02:00', NULL, '2020-07-15 07:02:00', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (34, 9, 6, 'Urotractin Tablet', 'Urotractin Tablet', 0, '1', 1, '2020-07-15 00:02:10', NULL, '2020-07-15 07:02:10', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (35, 9, 6, 'Vioquin 500 mg', 'Vioquin 500 mg', 0, '1', 1, '2020-07-15 00:02:22', NULL, '2020-07-15 07:02:22', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (36, 8, 7, 'Ambroxol sirup 15 mg/5 ml', 'Ambroxol sirup 15 mg/5 ml', 119, '1', 1, '2020-07-15 00:04:25', NULL, '2020-07-15 07:04:25', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (37, 8, 7, 'Ambroxol tablet 30 mg', 'Ambroxol tablet 30 mg', 100, '1', 1, '2020-07-15 00:04:41', NULL, '2020-07-15 07:04:41', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (38, 8, 7, 'CTM', 'CTM', 0, '1', 1, '2020-07-15 00:04:53', NULL, '2020-07-15 07:04:53', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (39, 8, 7, 'Gliserin Guaiacolate', 'Gliserin Guaiacolate', 0, '1', 1, '2020-07-15 00:05:07', NULL, '2020-07-15 07:05:07', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (40, 8, 7, 'OBH', 'OBH', 0, '1', 1, '2020-07-15 00:05:18', NULL, '2020-07-15 07:05:18', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (41, 8, 7, 'Paracetamol, GG,CTM, ol.anisi Syrup (Baby Cough)', 'Paracetamol, GG,CTM, ol.anisi Syrup (Baby Cough)', 0, '1', 1, '2020-07-15 00:05:34', NULL, '2020-07-15 07:05:34', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (42, 8, 7, 'Salbutamol 2mg', 'Salbutamol 2mg', 0, '1', 1, '2020-07-15 00:05:45', NULL, '2020-07-15 07:05:45', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (43, 8, 7, 'Salbutamol 4 mg', 'Salbutamol 4 mg', 0, '1', 1, '2020-07-15 00:05:56', NULL, '2020-07-15 07:05:56', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (44, 8, 7, 'Salbutamol 1 mg; Theophylin 150 mg', 'Salbutamol 1 mg; Theophylin 150 mg', 0, '1', 1, '2020-07-15 00:06:09', NULL, '2020-07-15 07:06:09', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (45, 9, 7, 'Alpara tablet', 'Alpara tablet', 235, '1', 1, '2020-07-15 00:09:00', NULL, '2020-07-15 07:09:00', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (46, 9, 7, 'Bisolvon elixir Sirup 60 mL', 'Bisolvon elixir Sirup 60 mL', 0, '1', 1, '2020-07-15 00:09:17', NULL, '2020-07-15 07:09:17', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (47, 9, 7, 'Bisolvon tablet', 'Bisolvon tablet', 0, '1', 1, '2020-07-15 00:09:26', NULL, '2020-07-15 07:09:26', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (48, 9, 7, 'Obat Batuk Herbal (Herbakof Syr 60 mL)', 'Obat Batuk Herbal (Herbakof Syr 60 mL)', 0, '1', 1, '2020-07-15 00:09:35', NULL, '2020-07-15 07:09:35', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (49, 9, 7, 'Cohistan Expetoran Sirup', 'Cohistan Expetoran Sirup', 0, '1', 1, '2020-07-15 00:09:45', NULL, '2020-07-15 07:09:45', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (50, 9, 7, 'Edotin syrup', 'Edotin syrup', 0, '1', 1, '2020-07-15 00:09:55', NULL, '2020-07-15 07:09:55', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (51, 9, 7, 'Edotin capsul', 'Edotin capsul', 0, '1', 1, '2020-07-15 00:10:12', NULL, '2020-07-15 07:10:12', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (52, 9, 7, 'Intunal Syrup', 'Intunal Syrup', 0, '1', 1, '2020-07-15 00:10:25', NULL, '2020-07-15 07:10:25', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (53, 9, 7, 'Intunal Forte tablet', 'Intunal Forte tablet', 0, '1', 1, '2020-07-15 00:10:37', NULL, '2020-07-15 07:10:37', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (54, 9, 7, 'Molexflu', 'Molexflu', 0, '1', 1, '2020-07-15 00:10:49', NULL, '2020-07-15 07:10:49', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (55, 9, 7, 'Sanadryl DMP Syrup 120 mL', 'Sanadryl DMP Syrup 120 mL', 0, '1', 1, '2020-07-15 00:13:13', NULL, '2020-07-15 07:13:13', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (56, 9, 7, 'Mucera Drop', 'Mucera Drop', 0, '1', 1, '2020-07-15 00:13:21', NULL, '2020-07-15 07:13:21', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (57, 9, 7, 'Mucos syrup', 'Mucos syrup', 0, '1', 1, '2020-07-15 00:13:31', NULL, '2020-07-15 07:13:31', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (58, 9, 7, 'Mucotein kapsul', 'Mucotein kapsul', 0, '1', 1, '2020-07-15 00:13:40', NULL, '2020-07-15 07:13:40', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (59, 9, 7, 'Rhinos Junior', 'Rhinos Junior', 0, '1', 1, '2020-07-15 00:13:50', NULL, '2020-07-15 07:13:50', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (60, 9, 7, 'Rhinos NEO  drop', 'Rhinos NEO  drop', 0, '1', 1, '2020-07-15 00:13:59', NULL, '2020-07-15 07:13:59', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (61, 9, 7, 'Rhinos SR', 'Rhinos SR', 0, '1', 1, '2020-07-15 00:14:10', NULL, '2020-07-15 07:14:10', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (62, 9, 7, 'Trifedrin', 'Trifedrin', 0, '1', 1, '2020-07-15 00:14:20', NULL, '2020-07-15 07:14:20', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (63, 9, 7, 'OBH Nellco Spesial 100 mL', 'OBH Nellco Spesial 100 mL', 0, '1', 1, '2020-07-15 00:14:29', NULL, '2020-07-15 07:14:29', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (64, 9, 7, 'OBH Nellco Spesial anak 55 mL', 'OBH Nellco Spesial anak 55 mL', 0, '1', 1, '2020-07-15 00:14:38', NULL, '2020-07-15 07:14:38', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (65, 9, 7, 'Obat Pilek (Tremenza tab)', 'Obat Pilek (Tremenza tab)', 0, '1', 1, '2020-07-15 00:14:51', NULL, '2020-07-15 07:14:51', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (66, 9, 7, 'Obat Flu + Batuk (Fluzep)', 'Obat Flu + Batuk (Fluzep)', 0, '1', 1, '2020-07-15 00:15:01', NULL, '2020-07-15 07:15:01', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (67, 9, 7, 'Silex Syrup', 'Silex Syrup', 0, '1', 1, '2020-07-15 00:15:11', NULL, '2020-07-15 07:15:11', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (68, 9, 7, 'Bronkodilator tablet (Teosal Tab)', 'Bronkodilator tablet (Teosal Tab)', 110, '1', 1, '2020-07-15 00:15:21', NULL, '2020-07-15 07:15:21', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (69, 9, 7, 'Bronkodilator Syrup (Teosal Syrup)', 'Bronkodilator Syrup (Teosal Syrup)', 30, '1', 1, '2020-07-15 00:15:31', NULL, '2020-07-15 07:15:31', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (70, 8, 8, 'Antasida Tablet', 'Antasida Tablet', 45, '1', 1, '2020-07-15 00:15:51', NULL, '2020-07-15 07:15:51', '127.0.0.1');
INSERT INTO `kkp_obat` VALUES (71, 9, 8, 'Anadium', 'Anadium', 162, '1', 1, '2020-07-15 00:16:05', NULL, '2020-07-15 07:16:05', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_obat_stok
-- ----------------------------
DROP TABLE IF EXISTS `kkp_obat_stok`;
CREATE TABLE `kkp_obat_stok`  (
  `stkbat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stkbat_obat_id` int(10) UNSIGNED NOT NULL,
  `stkbat_stok` bigint(20) NOT NULL,
  `stkbat_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stkbat_created_by` bigint(20) UNSIGNED NOT NULL,
  `stkbat_created_date` datetime(0) NOT NULL,
  `stkbat_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `stkbat_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stkbat_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`stkbat_id`) USING BTREE,
  INDEX `kkp_obat_stok_stkbat_created_by_foreign`(`stkbat_created_by`) USING BTREE,
  INDEX `kkp_obat_stok_stkbat_updated_by_foreign`(`stkbat_updated_by`) USING BTREE,
  INDEX `kkp_obat_stok_stkbat_obat_id_foreign`(`stkbat_obat_id`) USING BTREE,
  CONSTRAINT `kkp_obat_stok_stkbat_created_by_foreign` FOREIGN KEY (`stkbat_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_obat_stok_stkbat_obat_id_foreign` FOREIGN KEY (`stkbat_obat_id`) REFERENCES `kkp_obat` (`obat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_obat_stok_stkbat_updated_by_foreign` FOREIGN KEY (`stkbat_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_obat_stok
-- ----------------------------
INSERT INTO `kkp_obat_stok` VALUES (2, 71, 50, 'anadium stok pertama 50', 6, '2020-07-15 08:12:18', NULL, '2020-07-15 15:12:18', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (3, 71, 100, 'restock', 6, '2020-07-15 08:12:35', NULL, '2020-07-15 15:12:35', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (4, 70, 45, 'stok pertama', 6, '2020-07-15 08:12:53', NULL, '2020-07-15 15:12:53', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (5, 71, 12, 'aa', 6, '2020-07-15 09:34:54', NULL, '2020-07-15 16:34:54', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (6, 69, 30, 'input stok 30', 6, '2020-07-15 09:38:53', NULL, '2020-07-15 16:38:53', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (7, 68, 50, 'Input stok tanggal 10 Juli 2020', 6, '2020-07-15 09:40:29', NULL, '2020-07-15 16:40:29', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (8, 68, 60, 'Input stok tanggal 14 Juli 2020', 6, '2020-07-15 09:40:53', NULL, '2020-07-15 16:40:53', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (9, 2, 100, 'tambah stok', 6, '2020-07-24 01:20:21', NULL, '2020-07-24 01:20:21', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (10, 45, 100, 'tambah stok', 6, '2020-07-24 01:20:37', NULL, '2020-07-24 01:20:37', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (11, 36, 120, 'tambah stok', 6, '2020-07-24 01:20:47', NULL, '2020-07-24 01:20:47', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (12, 37, 90, 'tambah stok', 6, '2020-07-24 01:21:01', NULL, '2020-07-24 01:21:01', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (13, 3, 170, 'tambah stok', 6, '2020-07-24 01:21:13', NULL, '2020-07-24 01:21:13', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (14, 4, 50, 'tambah stok', 6, '2020-07-24 01:21:23', NULL, '2020-07-24 01:21:23', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (15, 2, 50, 'tambah lagi stok', 6, '2020-07-24 10:21:45', NULL, '2020-07-24 10:21:45', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (16, 2, 10, '10', 6, '2020-07-24 11:14:30', NULL, '2020-07-24 11:14:30', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (17, 45, 90, '90', 6, '2020-07-24 11:14:40', NULL, '2020-07-24 11:14:40', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (18, 2, 20, '20', 6, '2020-07-24 13:31:48', NULL, '2020-07-24 13:31:48', '127.0.0.1');
INSERT INTO `kkp_obat_stok` VALUES (19, 45, 10, '10', 6, '2020-07-24 13:31:56', NULL, '2020-07-24 13:31:56', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_odontogram
-- ----------------------------
DROP TABLE IF EXISTS `kkp_odontogram`;
CREATE TABLE `kkp_odontogram`  (
  `odon_id` int(11) NOT NULL AUTO_INCREMENT,
  `odon_psnrekdis_id` int(11) DEFAULT NULL,
  `odon_jenisp_id` int(11) DEFAULT NULL,
  `odon_kode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `odon_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `odon_status` enum('0','1','99') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `odon_createdby` int(11) DEFAULT NULL,
  `odon_createddate` datetime(0) DEFAULT NULL,
  `odon_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `odon_updatedby` int(11) DEFAULT NULL,
  `odon_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`odon_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_odontogram
-- ----------------------------
INSERT INTO `kkp_odontogram` VALUES (1, 6, 11, 'P18-T', 'test', '1', 11, '2020-10-09 06:09:08', '2020-10-09 06:09:08', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (2, 6, 25, 'P17-C', 'test kedua', '1', 11, '2020-10-09 06:16:03', '2020-10-09 06:16:03', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (3, 6, 23, 'P18-R', 'a', '1', 11, '2020-10-09 23:42:37', '2020-10-09 23:42:37', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (4, 6, 13, 'P34-C', 'testing', '1', 11, '2020-10-10 16:13:45', '2020-10-10 16:13:45', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (5, 6, 12, 'P71-B', 'sdsd', '1', 11, '2020-10-10 16:14:00', '2020-10-10 16:14:00', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (6, 6, 22, 'P51-B', 'P63-R', '1', 11, '2020-10-10 17:18:45', '2020-10-10 17:18:45', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (7, 6, 9, 'P51-B', 'P51-B', '1', 11, '2020-10-10 17:19:45', '2020-10-10 17:19:45', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (8, 6, 13, 'P46-C', 'P46-C', '1', 11, '2020-10-10 17:20:24', '2020-10-10 17:20:24', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_pasien
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pasien`;
CREATE TABLE `kkp_pasien`  (
  `pasien_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasien_uker_id` int(10) UNSIGNED NOT NULL,
  `pasien_golongan_id` int(10) UNSIGNED DEFAULT NULL,
  `pasien_norekdis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_tgllahir` date NOT NULL,
  `pasien_jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_umur` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pasien_alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_alergi_obat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pasien_telp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pasien_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `pasien_created_by` bigint(20) UNSIGNED NOT NULL,
  `pasien_created_date` datetime(0) NOT NULL,
  `pasien_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `pasien_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `pasien_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pasien_id`) USING BTREE,
  INDEX `kkp_pasien_pasien_created_by_foreign`(`pasien_created_by`) USING BTREE,
  INDEX `kkp_pasien_pasien_updated_by_foreign`(`pasien_updated_by`) USING BTREE,
  INDEX `kkp_pasien_pasien_uker_id_foreign`(`pasien_uker_id`) USING BTREE,
  INDEX `kkp_pasien_pasien_golongan_id_foreign`(`pasien_golongan_id`) USING BTREE,
  CONSTRAINT `kkp_pasien_pasien_created_by_foreign` FOREIGN KEY (`pasien_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_pasien_golongan_id_foreign` FOREIGN KEY (`pasien_golongan_id`) REFERENCES `kkp_golongan` (`golongan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_pasien_uker_id_foreign` FOREIGN KEY (`pasien_uker_id`) REFERENCES `kkp_unit_kerja` (`uker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_pasien_updated_by_foreign` FOREIGN KEY (`pasien_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_pasien
-- ----------------------------
INSERT INTO `kkp_pasien` VALUES (25, 9, 7, '0001/Ditjen P2SDKP', 'Linda S', '1992-04-15', 'P', '28', 'Bandung', 'tidak ada', '089734', 'linda@mail.com', '1', 5, '2020-07-31 21:03:33', 5, '2020-07-31 22:13:28', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (26, 5, 4, '0002/Ditjen P. Tangk', 'Hasan', '1980-08-12', 'L', '39', 'Jln Raya Cikesal no 70', 'tidak ada', '08124565456', 'hasan@mail.com', '1', 5, '2020-07-31 21:08:56', NULL, '2020-07-31 21:08:56', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (27, 11, 1, '0003/BKIPM', 'Sandra', '1989-01-31', 'P', '31', 'jakarta', 'tidak ada', '089734', 'sandra@mail.com', '1', 5, '2020-10-06 20:35:09', NULL, '2020-10-06 20:35:09', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (28, 9, 4, '0004/Ditjen P2SDKP', 'susan', '2008-12-28', 'P', '11', '-', '-', '089734', 'susan@mail.com', '1', 5, '2020-10-07 20:17:58', NULL, '2020-10-07 20:17:58', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_pasien_rekamedis
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pasien_rekamedis`;
CREATE TABLE `kkp_pasien_rekamedis`  (
  `psnrekdis_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `psnrekdis_psntrans_id` int(10) UNSIGNED NOT NULL,
  `psnrekdis_sbj_kelutm` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `psnrekdis_sbj_keltam` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `psnrekdis_sbj_riwpktskr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_sbj_riwpktdhl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_sbj_riwpktklg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_sbj_riwpktkalg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_asm_digkrt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_pln_rak` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `psnrekdis_obj_vstd` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_vshr` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_vsrr` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_vst` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_sgbb` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_sgtb` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_sgimt` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pfkpl` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pflhr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pftcor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pftpul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pfabd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pfeksats` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_obj_pfeksbwh` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrekdis_buta_warna` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `psnrekdis_created_by` bigint(20) UNSIGNED NOT NULL,
  `psnrekdis_created_date` datetime(0) NOT NULL,
  `psnrekdis_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`psnrekdis_id`) USING BTREE,
  INDEX `kkp_pasien_rekamedis_psnrekdis_psntrans_id_foreign`(`psnrekdis_psntrans_id`) USING BTREE,
  INDEX `kkp_pasien_rekamedis_psnrekdis_created_by_foreign`(`psnrekdis_created_by`) USING BTREE,
  CONSTRAINT `kkp_pasien_rekamedis_psnrekdis_created_by_foreign` FOREIGN KEY (`psnrekdis_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_rekamedis_psnrekdis_psntrans_id_foreign` FOREIGN KEY (`psnrekdis_psntrans_id`) REFERENCES `kkp_pasien_trans` (`psntrans_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_pasien_rekamedis
-- ----------------------------
INSERT INTO `kkp_pasien_rekamedis` VALUES (4, 26, 'batuk', 'pilex', '-', '-', '-', '-', '-', '-', '100 / 80', '10', '10', '38', '60', '160', '23.44', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', 'normal', '0', 8, '2020-07-31 23:00:52', '127.0.0.1');
INSERT INTO `kkp_pasien_rekamedis` VALUES (5, 27, 'a', 'a', 'a', 'a', 'a', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 8, '2020-08-09 11:29:44', '127.0.0.1');
INSERT INTO `kkp_pasien_rekamedis` VALUES (6, 28, 'test', 'test skjahf', 'sdfjhsdf se`', 'sdfhsdkfj sdfsdf', 'shjf  sdf', 'sfskfj  sdf', NULL, NULL, '100 / 80', '1', '1', '36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 8, '2020-10-06 22:14:43', '127.0.0.1');
INSERT INTO `kkp_pasien_rekamedis` VALUES (7, 29, 'asdasd', 'asdasdasd', 'aasd', NULL, NULL, NULL, 'sdf', 'dfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normal', 'a', 'a', 'a', 'a', 'a`add``', 'sdf', '0', 8, '2020-10-07 20:21:33', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_pasien_trans
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pasien_trans`;
CREATE TABLE `kkp_pasien_trans`  (
  `psntrans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pastrans_pasien_id` int(11) NOT NULL,
  `pastrans_status` enum('1','2','3','4','5','6','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = Daftar, \r\n2 = Periksa Suster, \r\n3 = Periksa Dokter,\r\n99 = Selesai, \r\n',
  `pastrans_flag` enum('1','2','3','4','5','6','7','8','9','10','11') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = Resep Obat, \r\n2 = Radiologi, \r\n3 = Lab Internal, \r\n4 = Lab External, \r\n5 = Poli Gigi, \r\n6 = Poli Umum, \r\n7 = Poli Spesialis, \r\n8 = Pengantar Spesialis, \r\n9 = Pengantar RS,\r\n10 = Surat Keterangan Sakit, \r\n11 = Surat Keterangan Sehat',
  `pastrans_created_by` bigint(20) UNSIGNED NOT NULL,
  `pastrans_created_date` datetime(0) NOT NULL,
  `pastrans_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `pastrans_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `pastrans_dokter_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`psntrans_id`) USING BTREE,
  INDEX `kkp_pasien_trans_pastrans_created_by_foreign`(`pastrans_created_by`) USING BTREE,
  INDEX `kkp_pasien_trans_pastrans_dokter_id_foreign`(`pastrans_dokter_id`) USING BTREE,
  CONSTRAINT `kkp_pasien_trans_pastrans_created_by_foreign` FOREIGN KEY (`pastrans_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_trans_pastrans_dokter_id_foreign` FOREIGN KEY (`pastrans_dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_pasien_trans
-- ----------------------------
INSERT INTO `kkp_pasien_trans` VALUES (26, 25, '3', '3', 5, '2020-07-31 21:03:33', NULL, '2020-08-08 23:34:14', 15);
INSERT INTO `kkp_pasien_trans` VALUES (27, 26, '2', NULL, 5, '2020-07-31 21:08:57', NULL, '2020-08-12 20:33:23', 13);
INSERT INTO `kkp_pasien_trans` VALUES (28, 27, '2', '10', 5, '2020-10-06 20:35:09', NULL, '2020-10-10 21:10:41', 11);
INSERT INTO `kkp_pasien_trans` VALUES (29, 28, '4', '2', 5, '2020-10-07 20:17:59', NULL, '2020-10-07 23:38:02', 13);

-- ----------------------------
-- Table structure for kkp_pasien_uker
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pasien_uker`;
CREATE TABLE `kkp_pasien_uker`  (
  `pasker_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasker_pasien_id` int(10) UNSIGNED NOT NULL,
  `pasker_uker_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`pasker_id`) USING BTREE,
  INDEX `kkp_pasien_uker_pasker_pasien_id_foreign`(`pasker_pasien_id`) USING BTREE,
  INDEX `kkp_pasien_uker_pasker_uker_id_foreign`(`pasker_uker_id`) USING BTREE,
  CONSTRAINT `kkp_pasien_uker_pasker_pasien_id_foreign` FOREIGN KEY (`pasker_pasien_id`) REFERENCES `kkp_pasien` (`pasien_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_pasien_uker_pasker_uker_id_foreign` FOREIGN KEY (`pasker_uker_id`) REFERENCES `kkp_unit_kerja` (`uker_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kkp_pengantar_spesialis
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pengantar_spesialis`;
CREATE TABLE `kkp_pengantar_spesialis`  (
  `ps_id` int(11) NOT NULL AUTO_INCREMENT,
  `ps_psnrekdis_id` int(11) DEFAULT NULL,
  `ps_dokter_id` int(11) DEFAULT NULL,
  `ps_pasien_id` int(11) DEFAULT NULL,
  `ps_rs` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ps_keluhan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ps_tindakan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ps_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ps_status` enum('0','1','99') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1',
  `ps_createdby` int(255) DEFAULT NULL,
  `ps_createddate` datetime(0) DEFAULT NULL,
  `ps_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `ps_updatedby` int(11) DEFAULT NULL,
  `ps_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`ps_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kkp_poli
-- ----------------------------
DROP TABLE IF EXISTS `kkp_poli`;
CREATE TABLE `kkp_poli`  (
  `poli_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `poli_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `poli_created_by` bigint(20) UNSIGNED NOT NULL,
  `poli_created_date` datetime(0) NOT NULL,
  `poli_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `poli_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poli_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`poli_id`) USING BTREE,
  INDEX `kkp_poli_poli_created_by_foreign`(`poli_created_by`) USING BTREE,
  INDEX `kkp_poli_poli_updated_by_foreign`(`poli_updated_by`) USING BTREE,
  CONSTRAINT `kkp_poli_poli_created_by_foreign` FOREIGN KEY (`poli_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_poli_poli_updated_by_foreign` FOREIGN KEY (`poli_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_poli
-- ----------------------------
INSERT INTO `kkp_poli` VALUES (1, 'KKPPOLGG', 'Poli Gigi', 'Poli Gigi', '1', 1, '2020-07-18 14:07:59', 1, '2020-07-18 14:07:59', '127.0.0.1');
INSERT INTO `kkp_poli` VALUES (2, 'KKPPOLMUM', 'Poli Umum', 'Poli Umum', '1', 1, '2020-07-18 14:09:18', 1, '2020-07-18 14:09:18', '127.0.0.1');
INSERT INTO `kkp_poli` VALUES (3, 'KKPPOLSPS', 'Poli Spesialis', 'Poli Spesialis', '1', 1, '2020-07-24 19:32:21', NULL, '2020-07-24 19:32:21', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_radiologi
-- ----------------------------
DROP TABLE IF EXISTS `kkp_radiologi`;
CREATE TABLE `kkp_radiologi`  (
  `radio_id` int(11) NOT NULL AUTO_INCREMENT,
  `radio_psnrekdis_id` int(11) DEFAULT NULL,
  `radio_tanggal` date DEFAULT NULL,
  `radio_rs` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `radio_pekerjaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `radio_jenis` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '1 = Diagnostik, \r\n2 = Intervensi',
  `radio_ragio` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `radio_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `radio_createdby` int(11) DEFAULT NULL,
  `radio_createddate` datetime(0) DEFAULT NULL,
  `radio_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `radio_updatedby` int(11) DEFAULT NULL,
  `radio_ip` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`radio_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_radiologi
-- ----------------------------
INSERT INTO `kkp_radiologi` VALUES (1, 7, '2020-10-08', 'RS Fatmawati', 'Madndor', '1', '1', 'testing', NULL, NULL, '2020-10-08 08:16:08', NULL, '127.0.0.1');
INSERT INTO `kkp_radiologi` VALUES (2, 7, '2020-08-10', 'testing', 'Madndor', '1', '1', 'testing', NULL, NULL, '2020-10-08 08:32:41', NULL, '127.0.0.1');
INSERT INTO `kkp_radiologi` VALUES (3, 6, '2020-10-10', 'RS Fatmawati', 'Madndor', '1', '1', 'tester', NULL, NULL, '2020-10-10 17:37:49', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_resep_note
-- ----------------------------
DROP TABLE IF EXISTS `kkp_resep_note`;
CREATE TABLE `kkp_resep_note`  (
  `resnot_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `resnote_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `resnote_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`resnot_id`) USING BTREE,
  INDEX `kkp_resep_note_resnote_psnrekdis_id_foreign`(`resnote_psnrekdis_id`) USING BTREE,
  CONSTRAINT `kkp_resep_note_resnote_psnrekdis_id_foreign` FOREIGN KEY (`resnote_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kkp_resep_obat
-- ----------------------------
DROP TABLE IF EXISTS `kkp_resep_obat`;
CREATE TABLE `kkp_resep_obat`  (
  `resep_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `resep_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `resep_obat_id` int(10) UNSIGNED NOT NULL,
  `resep_jumlah` int(10) UNSIGNED NOT NULL,
  `resep_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resep_created_by` bigint(20) UNSIGNED NOT NULL,
  `resep_created_date` datetime(0) NOT NULL,
  `resep_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `resep_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resep_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`resep_id`) USING BTREE,
  INDEX `kkp_resep_obat_resep_psnrekdis_id_foreign`(`resep_psnrekdis_id`) USING BTREE,
  INDEX `kkp_resep_obat_resep_obat_id_foreign`(`resep_obat_id`) USING BTREE,
  INDEX `kkp_resep_obat_resep_created_by_foreign`(`resep_created_by`) USING BTREE,
  INDEX `kkp_resep_obat_resep_updated_by_foreign`(`resep_updated_by`) USING BTREE,
  CONSTRAINT `kkp_resep_obat_resep_created_by_foreign` FOREIGN KEY (`resep_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_resep_obat_resep_obat_id_foreign` FOREIGN KEY (`resep_obat_id`) REFERENCES `kkp_obat` (`obat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_resep_obat_resep_psnrekdis_id_foreign` FOREIGN KEY (`resep_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_resep_obat_resep_updated_by_foreign` FOREIGN KEY (`resep_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for kkp_role
-- ----------------------------
DROP TABLE IF EXISTS `kkp_role`;
CREATE TABLE `kkp_role`  (
  `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_kode` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `role_created_by` bigint(20) UNSIGNED NOT NULL,
  `role_created_date` datetime(0) NOT NULL,
  `role_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `role_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE,
  INDEX `kkp_role_role_created_by_foreign`(`role_created_by`) USING BTREE,
  INDEX `kkp_role_role_updated_by_foreign`(`role_updated_by`) USING BTREE,
  CONSTRAINT `kkp_role_role_created_by_foreign` FOREIGN KEY (`role_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_role_role_updated_by_foreign` FOREIGN KEY (`role_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_role
-- ----------------------------
INSERT INTO `kkp_role` VALUES (1, 'Admin', 'KKPADM', 'Role Admin', '1', 1, '2020-07-14 21:43:23', 1, '2020-07-14 21:43:27', '127.0.0.1');
INSERT INTO `kkp_role` VALUES (6, 'Apoteker', 'KKPAPT', 'Apoteker', '1', 1, '2020-07-15 02:00:05', NULL, '2020-07-15 09:00:05', '127.0.0.1');
INSERT INTO `kkp_role` VALUES (7, 'Dokter', 'KKPDKT', 'Dokter', '1', 1, '2020-07-15 02:00:20', NULL, '2020-07-15 09:00:20', '127.0.0.1');
INSERT INTO `kkp_role` VALUES (8, 'Petugas', 'KKPPTG', 'Petugas input data pasien', '1', 1, '2020-07-15 02:07:05', 1, '2020-07-15 09:07:05', '127.0.0.1');
INSERT INTO `kkp_role` VALUES (9, 'Suster', 'KKPSTR', 'Role untuk suster', '1', 1, '2020-07-16 17:24:07', NULL, '2020-07-16 17:24:07', '127.0.0.1');
INSERT INTO `kkp_role` VALUES (10, 'Laboratorium', 'KKPLBT', 'Role untuk role laboratorium', '1', 1, '2020-07-25 10:27:16', NULL, '2020-07-25 10:27:16', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_rujukan_lab
-- ----------------------------
DROP TABLE IF EXISTS `kkp_rujukan_lab`;
CREATE TABLE `kkp_rujukan_lab`  (
  `rjklab_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rjklab_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `rjklab_diagnosa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rjklab_htg_rutin` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_hb` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_hematokrit` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_eritrosit` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_lekosit` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_trombosit` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_led` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_mmm` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_dc` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_gd` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_htg_rhesus` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_ld_kt` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_ld_kh` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_ld_kl` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_ld_trig` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_fh_ast` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_fh_alt` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_fg_ureum` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_fg_kreatinin` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_fg_au` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_gd_gds` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_gd_gdp` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_gd_gdj` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_kk_gd_hba` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_is_widal` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_is_hbs` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_is_ah` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_urine_hcg` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_urine_narkoba` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_urine_ul` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rjklab_created_by` bigint(20) UNSIGNED NOT NULL,
  `rjklab_created_date` datetime(0) NOT NULL,
  `rjklab_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rjklab_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rjklab_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rjklab_id`) USING BTREE,
  INDEX `kkp_rujukan_lab_rjklab_psnrekdis_id_foreign`(`rjklab_psnrekdis_id`) USING BTREE,
  INDEX `kkp_rujukan_lab_rjklab_created_by_foreign`(`rjklab_created_by`) USING BTREE,
  INDEX `kkp_rujukan_lab_rjklab_updated_by_foreign`(`rjklab_updated_by`) USING BTREE,
  CONSTRAINT `kkp_rujukan_lab_rjklab_created_by_foreign` FOREIGN KEY (`rjklab_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_rujukan_lab_rjklab_psnrekdis_id_foreign` FOREIGN KEY (`rjklab_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_rujukan_lab_rjklab_updated_by_foreign` FOREIGN KEY (`rjklab_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_rujukan_lab
-- ----------------------------
INSERT INTO `kkp_rujukan_lab` VALUES (1, 7, 'hallo world pocong', '1', '1', '1', '1', '0', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '1', '0', 13, '2020-10-07 22:23:37', NULL, '2020-10-07 22:19:04', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_rujukan_spesialis
-- ----------------------------
DROP TABLE IF EXISTS `kkp_rujukan_spesialis`;
CREATE TABLE `kkp_rujukan_spesialis`  (
  `rjksps_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rjksps_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `rjksps_dokter_id` bigint(20) UNSIGNED NOT NULL,
  `rjksps_rs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rjksps_keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rjksps_ssb` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rjksps_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rjksps_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `rjksps_created_by` bigint(20) UNSIGNED NOT NULL,
  `rjksps_created_date` datetime(0) NOT NULL,
  `rjksps_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rjksps_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rjksps_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rjksps_id`) USING BTREE,
  INDEX `kkp_rujukan_spesialis_rjksps_psnrekdis_id_foreign`(`rjksps_psnrekdis_id`) USING BTREE,
  INDEX `kkp_rujukan_spesialis_rjksps_dokter_id_foreign`(`rjksps_dokter_id`) USING BTREE,
  INDEX `kkp_rujukan_spesialis_rjksps_created_by_foreign`(`rjksps_created_by`) USING BTREE,
  INDEX `kkp_rujukan_spesialis_rjksps_updated_by_foreign`(`rjksps_updated_by`) USING BTREE,
  CONSTRAINT `kkp_rujukan_spesialis_rjksps_created_by_foreign` FOREIGN KEY (`rjksps_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_rujukan_spesialis_rjksps_dokter_id_foreign` FOREIGN KEY (`rjksps_dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_rujukan_spesialis_rjksps_psnrekdis_id_foreign` FOREIGN KEY (`rjksps_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_rujukan_spesialis_rjksps_updated_by_foreign` FOREIGN KEY (`rjksps_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_rujukan_spesialis
-- ----------------------------
INSERT INTO `kkp_rujukan_spesialis` VALUES (1, 6, 15, 'Rs Fatmawati', 'sakit gigi', 'obat anti nyeri', 'tidak ada', '1', 11, '2020-10-10 18:55:08', NULL, '2020-10-10 18:55:08', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_surat_sakit
-- ----------------------------
DROP TABLE IF EXISTS `kkp_surat_sakit`;
CREATE TABLE `kkp_surat_sakit`  (
  `sskt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sskt_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `sskt_tgl_mulai` datetime(0) NOT NULL,
  `sskt_tgl_akhir` datetime(0) NOT NULL,
  `sskt_jmlhari` int(10) UNSIGNED NOT NULL,
  `sskt_created_by` bigint(20) UNSIGNED NOT NULL,
  `sskt_created_date` datetime(0) NOT NULL,
  `sskt_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sskt_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sskt_id`) USING BTREE,
  INDEX `kkp_surat_sakit_sskt_psnrekdis_id_foreign`(`sskt_psnrekdis_id`) USING BTREE,
  INDEX `kkp_surat_sakit_sskt_created_by_foreign`(`sskt_created_by`) USING BTREE,
  CONSTRAINT `kkp_surat_sakit_sskt_created_by_foreign` FOREIGN KEY (`sskt_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_surat_sakit_sskt_psnrekdis_id_foreign` FOREIGN KEY (`sskt_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_surat_sakit
-- ----------------------------
INSERT INTO `kkp_surat_sakit` VALUES (1, 6, '2020-10-12 00:00:00', '2020-10-14 00:00:00', 3, 11, '2020-10-10 21:10:41', '2020-10-10 21:10:41', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_surat_sehat
-- ----------------------------
DROP TABLE IF EXISTS `kkp_surat_sehat`;
CREATE TABLE `kkp_surat_sehat`  (
  `ssht_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ssht_psnrekdis_id` int(10) UNSIGNED NOT NULL,
  `ssht_keperluan` enum('1','2','3','4') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = Diklat Perjabatan, \r\n2 = Diklat PIM,\r\n3 = Mengikuti Training, \r\n4 = Lain - lain',
  `ssht_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ssht_created_by` bigint(20) UNSIGNED NOT NULL,
  `ssht_created_date` datetime(0) NOT NULL,
  `ssht_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ssht_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ssht_id`) USING BTREE,
  INDEX `kkp_surat_sehat_ssht_psnrekdis_id_foreign`(`ssht_psnrekdis_id`) USING BTREE,
  INDEX `kkp_surat_sehat_ssht_created_by_foreign`(`ssht_created_by`) USING BTREE,
  CONSTRAINT `kkp_surat_sehat_ssht_created_by_foreign` FOREIGN KEY (`ssht_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_surat_sehat_ssht_psnrekdis_id_foreign` FOREIGN KEY (`ssht_psnrekdis_id`) REFERENCES `kkp_pasien_rekamedis` (`psnrekdis_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_surat_sehat
-- ----------------------------
INSERT INTO `kkp_surat_sehat` VALUES (1, 6, '2', NULL, 11, '2020-10-10 21:10:23', '2020-10-10 21:10:23', '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_unit_kerja
-- ----------------------------
DROP TABLE IF EXISTS `kkp_unit_kerja`;
CREATE TABLE `kkp_unit_kerja`  (
  `uker_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uker_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uker_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uker_status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `uker_created_by` bigint(20) UNSIGNED NOT NULL,
  `uker_created_date` datetime(0) NOT NULL,
  `uker_updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `uker_lastupdate` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uker_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uker_id`) USING BTREE,
  INDEX `kkp_unit_kerja_uker_created_by_foreign`(`uker_created_by`) USING BTREE,
  INDEX `kkp_unit_kerja_uker_updated_by_foreign`(`uker_updated_by`) USING BTREE,
  CONSTRAINT `kkp_unit_kerja_uker_created_by_foreign` FOREIGN KEY (`uker_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kkp_unit_kerja_uker_updated_by_foreign` FOREIGN KEY (`uker_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_unit_kerja
-- ----------------------------
INSERT INTO `kkp_unit_kerja` VALUES (3, 'Itjen', 'Itjen', '1', 1, '2020-07-14 15:54:06', 1, '2020-07-14 22:54:06', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (4, 'Sekertariat Jendral', 'Sekertariat Jendral', '1', 1, '2020-07-16 06:50:18', 1, '2020-07-16 06:50:18', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (5, 'Ditjen P. Tangkap', 'Ditjen P. Tangkap', '1', 1, '2020-07-20 12:44:51', NULL, '2020-07-20 12:44:51', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (6, 'Ditjen P. Budidaya', 'Ditjen P. Budidaya', '1', 1, '2020-07-20 12:45:08', NULL, '2020-07-20 12:45:08', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (7, 'PDSPKP', 'PDSPKP', '1', 1, '2020-07-20 12:45:19', NULL, '2020-07-20 12:45:19', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (8, 'PRL', 'PRL', '1', 1, '2020-07-20 12:45:27', NULL, '2020-07-20 12:45:27', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (9, 'Ditjen P2SDKP', 'Ditjen P2SDKP', '1', 1, '2020-07-20 12:45:45', NULL, '2020-07-20 12:45:45', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (10, 'BRSDMKP', 'BRSDMKP', '1', 1, '2020-07-20 12:45:56', NULL, '2020-07-20 12:45:56', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (11, 'BKIPM', 'BKIPM', '1', 1, '2020-07-20 12:46:05', NULL, '2020-07-20 12:46:05', '127.0.0.1');
INSERT INTO `kkp_unit_kerja` VALUES (12, 'Lain - lain', 'Lain - lain', '1', 1, '2020-07-20 12:46:14', NULL, '2020-07-20 12:46:14', '127.0.0.1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_07_14_102347_add_field_to_user_table', 2);
INSERT INTO `migrations` VALUES (5, '2020_07_14_102935_create_kkp_role_table', 3);
INSERT INTO `migrations` VALUES (6, '2020_07_14_103209_create_kkp_jenis_obat_table', 4);
INSERT INTO `migrations` VALUES (7, '2020_07_14_103323_create_kkp_obat_table', 5);
INSERT INTO `migrations` VALUES (8, '2020_07_14_104950_create_kkp_obat_table', 6);
INSERT INTO `migrations` VALUES (9, '2020_07_14_105351_create_kkp_kategori_obat_table', 7);
INSERT INTO `migrations` VALUES (10, '2020_07_14_105513_add_field_to_kkp_obat_table', 8);
INSERT INTO `migrations` VALUES (11, '2020_07_14_111801_create_kkp_pasien_table', 9);
INSERT INTO `migrations` VALUES (12, '2020_07_14_113819_create_kkp_unit_kerja_table', 10);
INSERT INTO `migrations` VALUES (13, '2020_07_14_113946_create_kkp_pasien_uker_table', 11);
INSERT INTO `migrations` VALUES (14, '2020_07_14_225127_change_column_obat_jenobat_id', 12);
INSERT INTO `migrations` VALUES (15, '2020_07_15_015241_add_column_role_code_to_role', 13);
INSERT INTO `migrations` VALUES (16, '2020_07_15_022809_change_role_kode_on_kkp_user', 14);
INSERT INTO `migrations` VALUES (17, '2020_07_15_031445_add_column_obat_stok', 15);
INSERT INTO `migrations` VALUES (18, '2020_07_15_074713_create_kkp_obat_stok_table', 16);
INSERT INTO `migrations` VALUES (19, '2020_07_16_063803_create_kkp_pasien_trans', 17);
INSERT INTO `migrations` VALUES (20, '2020_07_18_054655_create_kkp_log', 18);
INSERT INTO `migrations` VALUES (21, '2020_07_18_061558_create_kkp_pasien_rekamedis', 19);
INSERT INTO `migrations` VALUES (22, '2020_07_18_135545_create_kkp_poli_table', 20);
INSERT INTO `migrations` VALUES (23, '2020_07_18_141145_add_column_poli_id', 21);
INSERT INTO `migrations` VALUES (24, '2020_07_18_142325_change_column_poli_id_nullable', 22);
INSERT INTO `migrations` VALUES (25, '2020_07_19_060947_add_column_pastrans_dokter_id', 23);
INSERT INTO `migrations` VALUES (26, '2020_07_19_061313_change_position_pastrans_dokter_id', 24);
INSERT INTO `migrations` VALUES (27, '2020_07_20_125030_add_column_pasien_uker_id_to_kkp_oasien', 25);
INSERT INTO `migrations` VALUES (28, '2020_07_22_105441_add_column_poli_kode', 26);
INSERT INTO `migrations` VALUES (29, '2020_07_24_002514_create_table_kkp_resep_obat', 27);
INSERT INTO `migrations` VALUES (30, '2020_07_24_223001_create_table_kkp_rujukan_spesialis', 28);
INSERT INTO `migrations` VALUES (31, '2020_07_24_224213_create_table_kkp_rujukan_spesialis', 29);
INSERT INTO `migrations` VALUES (32, '2020_07_25_000714_create_table_kkp_rujukan_lab', 30);
INSERT INTO `migrations` VALUES (33, '2020_07_25_002247_create_table_kkp_rujukan_lab', 31);
INSERT INTO `migrations` VALUES (34, '2020_07_25_093655_add_column_psnrekdis_is_lab', 32);
INSERT INTO `migrations` VALUES (35, '2020_07_25_153018_add_column_resep_status', 33);
INSERT INTO `migrations` VALUES (36, '2020_07_31_172636_create_table_kkp_golongan', 34);
INSERT INTO `migrations` VALUES (37, '2020_07_31_200539_rename_column_pasien_pangkat_to_golongan_id', 35);
INSERT INTO `migrations` VALUES (38, '2020_07_31_200712_change_datatype_colum_pasien_golongan_id', 36);
INSERT INTO `migrations` VALUES (39, '2020_07_31_203419_change_datatype_column_pasien_umur', 37);
INSERT INTO `migrations` VALUES (40, '2020_07_31_205755_change_datatype_column_pasien_norekdis', 38);
INSERT INTO `migrations` VALUES (41, '2020_07_31_231609_create_table_kkp_resep_note', 39);
INSERT INTO `migrations` VALUES (42, '2020_07_31_232121_create_table_kkp_resep_note', 40);
INSERT INTO `migrations` VALUES (43, '2020_08_03_053434_add_column_rjklab_diagnosa', 41);
INSERT INTO `migrations` VALUES (44, '2020_08_08_202235_add_column_pastrans_flag', 42);
INSERT INTO `migrations` VALUES (45, '2020_08_08_203931_remove_column_is_lab_resep_status', 43);
INSERT INTO `migrations` VALUES (46, '2020_08_09_103912_create_table_kkp_surat_sehat', 44);
INSERT INTO `migrations` VALUES (47, '2020_08_09_113042_create_table_kkp_surat_sakit', 44);
INSERT INTO `migrations` VALUES (48, '2020_08_09_113154_add_column_psnrekdis_buta_warna', 44);
INSERT INTO `migrations` VALUES (49, '2020_08_09_211501_add_column_sskt_jmlhari', 45);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_kode` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'KKPADM', NULL, 'admin', 'admin@mail.com', '2020-07-26 05:59:06', '$2y$10$6KsuW7DRMtYk97kJwz4SWuHdcPZvwXuhS2SvWzxUVYHwRWhPgh7te', '1', NULL, '2020-07-26 05:59:06', '2020-07-26 05:59:06');
INSERT INTO `users` VALUES (5, 'KKPPTG', NULL, 'nisa', 'nisa@mail.com', '2020-07-25 15:57:34', '$2y$10$u5.BdfZMSJuO5WtWuVpKmOGVx4u43DMhSOjx23A5FVYmLo8fDTCiq', '1', NULL, '2020-07-15 02:39:42', '2020-07-20 12:47:43');
INSERT INTO `users` VALUES (6, 'KKPAPT', NULL, 'Nana', 'nana@mail.com', '2020-07-25 15:57:34', '$2y$10$EhHTM0QmD4fl4J81I0SDzePe9ck4NVIvTkgCe4dh5cH3xwrp5tbKK', '1', NULL, '2020-07-15 02:40:09', '2020-07-22 13:17:05');
INSERT INTO `users` VALUES (8, 'KKPSTR', NULL, 'Arti', 'arti@mail.com', '2020-07-25 15:57:34', '$2y$10$UAMLfuXdWToTW0zRobxqZ.aVdKgbeOqaG6D9JDbQUOonV9emlfCJ2', '1', NULL, '2020-07-16 17:24:40', '2020-07-20 13:28:52');
INSERT INTO `users` VALUES (10, 'KKPDKT', 1, 'Drg. Trisnawati', 'trisna@mail.com', '2020-07-25 15:57:34', '$2y$10$ylwWQfzGKVr/8pUp93KKA.0Gnfg.hZMMIaEIv7JRC/r65cYkYjJkG', '1', NULL, '2020-07-19 06:17:31', '2020-07-19 06:17:31');
INSERT INTO `users` VALUES (11, 'KKPDKT', 1, 'Drg. Dona Saputri', 'dona@mail.com', '2020-07-25 15:57:34', '$2y$10$DfhzGzRtFYhgvbnBeAFYyO3nNayS4tBje2DB47DNzqwh4GOdDa4rS', '1', NULL, '2020-07-19 06:18:35', '2020-07-19 06:18:35');
INSERT INTO `users` VALUES (12, 'KKPDKT', 1, 'Drg. Lisna Marisa', 'lisna@mail.com', '2020-07-25 15:57:34', '$2y$10$rP.UTjRC.XfdBoTSIkUoMeF0LHTojYJKgC97pvtzky5NvrBmxm47m', '1', NULL, '2020-07-19 06:19:01', '2020-07-19 06:19:01');
INSERT INTO `users` VALUES (13, 'KKPDKT', 2, 'Dr. Evi Fitriana', 'evi@mail.com', '2020-07-25 15:57:34', '$2y$10$cXK2FSQhMAGl5poKn/ef2u1cRvVieh/To.2eVnbxI9fdck4j5yCpq', '1', NULL, '2020-07-19 06:19:28', '2020-07-19 06:19:28');
INSERT INTO `users` VALUES (14, 'KKPDKT', 2, 'Dr. Triani Hanissa', 'triani@mail.com', '2020-07-25 15:57:34', '$2y$10$WpXsECMbck69jGk9aBeJGO7zo0sFA111ovFP3IJlYPdlqvqCQbUaa', '1', NULL, '2020-07-19 06:19:58', '2020-07-19 06:19:58');
INSERT INTO `users` VALUES (15, 'KKPDKT', 3, 'Dr. Cipuk Muhaswitri, SP.GK', 'cipuk@mail.com', '2020-10-10 18:53:57', '$2y$10$3Pccd4O2cQXaYeIjwQkY4uWCTkNe6oGNgZ9ToM3/w61kSlRHo1Qb2', '1', NULL, '2020-10-10 18:53:57', '2020-10-10 18:53:57');
INSERT INTO `users` VALUES (16, 'KKPDKT', 3, 'Dr. Spesialis', 'spesial@mail.com', '2020-07-25 15:57:34', '$2y$10$5qn2J1An6zUsCFHEuWgaUeW5OKBThyUgzqDowo7wsLMqB36.RJmEW', '1', NULL, '2020-07-24 19:32:56', '2020-07-24 19:32:56');
INSERT INTO `users` VALUES (17, 'KKPLBT', NULL, 'lab', 'lab@mail.com', '2020-07-25 15:57:34', '$2y$10$z8.f/y8f3XpCLvU4jL6LN.aJaB592Umy7C4IKllPmBu3WAuDOZ3h.', '1', NULL, '2020-07-25 10:29:34', '2020-07-25 10:29:34');

SET FOREIGN_KEY_CHECKS = 1;
