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

 Date: 09/10/2020 10:10:04
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
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_odontogram
-- ----------------------------
INSERT INTO `kkp_odontogram` VALUES (1, 6, 11, 'P18-T', 'test', '1', 11, '2020-10-09 06:09:08', '2020-10-09 06:09:08', NULL, '127.0.0.1');
INSERT INTO `kkp_odontogram` VALUES (2, 6, 25, 'P17-C', 'test kedua', '1', 11, '2020-10-09 06:16:03', '2020-10-09 06:16:03', NULL, '127.0.0.1');

-- ----------------------------
-- Table structure for kkp_pasien
-- ----------------------------
DROP TABLE IF EXISTS `kkp_pasien`;
CREATE TABLE `kkp_pasien`  (
  `pasien_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasien_uker_id` int(10) UNSIGNED NOT NULL,
  `pasien_norekdis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_tgllahir` date NOT NULL,
  `pasien_jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_umur` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pasien_golongan_id` int(10) UNSIGNED DEFAULT NULL,
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
INSERT INTO `kkp_pasien` VALUES (25, 9, '0001/Ditjen P2SDKP', 'Linda S', '1992-04-15', 'P', '28', 7, 'Bandung', 'tidak ada', '089734', 'linda@mail.com', '1', 5, '2020-07-31 21:03:33', 5, '2020-07-31 22:13:28', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (26, 5, '0002/Ditjen P. Tangk', 'Hasan', '1980-08-12', 'L', '39', 4, 'Jln Raya Cikesal no 70', 'tidak ada', '08124565456', 'hasan@mail.com', '1', 5, '2020-07-31 21:08:56', NULL, '2020-07-31 21:08:56', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (27, 11, '0003/BKIPM', 'Sandra', '1989-01-31', 'P', '31', 1, 'jakarta', 'tidak ada', '089734', 'sandra@mail.com', '1', 5, '2020-10-06 20:35:09', NULL, '2020-10-06 20:35:09', '127.0.0.1');
INSERT INTO `kkp_pasien` VALUES (28, 9, '0004/Ditjen P2SDKP', 'susan', '2008-12-28', 'P', '11', 4, '-', '-', '089734', 'susan@mail.com', '1', 5, '2020-10-07 20:17:58', NULL, '2020-10-07 20:17:58', '127.0.0.1');

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
  `pastrans_status` enum('1','2','3','4','5','6','99') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '99 = Selesai, \r\n',
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
INSERT INTO `kkp_pasien_trans` VALUES (28, 27, '2', NULL, 5, '2020-10-06 20:35:09', NULL, '2020-10-06 22:14:43', 11);
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kkp_radiologi
-- ----------------------------
INSERT INTO `kkp_radiologi` VALUES (1, 7, '2020-10-08', 'RS Fatmawati', 'Madndor', '1', '1', 'testing', NULL, NULL, '2020-10-08 08:16:08', NULL, '127.0.0.1');
INSERT INTO `kkp_radiologi` VALUES (2, 7, '2020-08-10', 'testing', 'Madndor', '1', '1', 'testing', NULL, NULL, '2020-10-08 08:32:41', NULL, '127.0.0.1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

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
INSERT INTO `users` VALUES (15, 'KKPDKT', 2, 'Dr. Cipuk Muhaswitri, SP.GK', 'cipuk@mail.com', '2020-07-25 15:57:34', '$2y$10$3Pccd4O2cQXaYeIjwQkY4uWCTkNe6oGNgZ9ToM3/w61kSlRHo1Qb2', '1', NULL, '2020-07-19 06:20:37', '2020-07-19 06:20:37');
INSERT INTO `users` VALUES (16, 'KKPDKT', 3, 'Dr. Spesialis', 'spesial@mail.com', '2020-07-25 15:57:34', '$2y$10$5qn2J1An6zUsCFHEuWgaUeW5OKBThyUgzqDowo7wsLMqB36.RJmEW', '1', NULL, '2020-07-24 19:32:56', '2020-07-24 19:32:56');
INSERT INTO `users` VALUES (17, 'KKPLBT', NULL, 'lab', 'lab@mail.com', '2020-07-25 15:57:34', '$2y$10$z8.f/y8f3XpCLvU4jL6LN.aJaB592Umy7C4IKllPmBu3WAuDOZ3h.', '1', NULL, '2020-07-25 10:29:34', '2020-07-25 10:29:34');

SET FOREIGN_KEY_CHECKS = 1;
