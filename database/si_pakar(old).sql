/*
 Navicat Premium Data Transfer

 Source Server         : macbook
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : si_pakar

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 30/07/2021 08:46:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tblbobot
-- ----------------------------
DROP TABLE IF EXISTS `tblbobot`;
CREATE TABLE `tblbobot` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `bobot` varchar(100) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblbobot
-- ----------------------------
BEGIN;
INSERT INTO `tblbobot` VALUES (1, 'sangat tidak yakin', 0.2);
INSERT INTO `tblbobot` VALUES (2, 'tidak yakin', 0.4);
INSERT INTO `tblbobot` VALUES (3, 'yakin', 0.6);
INSERT INTO `tblbobot` VALUES (4, 'cukup yakin', 0.8);
INSERT INTO `tblbobot` VALUES (5, 'sangat yakin', 1);
COMMIT;

-- ----------------------------
-- Table structure for tblgejala
-- ----------------------------
DROP TABLE IF EXISTS `tblgejala`;
CREATE TABLE `tblgejala` (
  `id_gejala` int(255) NOT NULL AUTO_INCREMENT,
  `gejala` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `cfpakar` double DEFAULT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblgejala
-- ----------------------------
BEGIN;
INSERT INTO `tblgejala` VALUES (1, 'Tinja berwarna hijau lumut dengan gumpalan putih', NULL, 0.4);
INSERT INTO `tblgejala` VALUES (2, 'Ayam gemetar', NULL, 0.4);
INSERT INTO `tblgejala` VALUES (3, 'Kelumpuhan pada kaki', NULL, 0.6);
INSERT INTO `tblgejala` VALUES (4, 'Kelumpuhan pada sayap', NULL, 0.2);
INSERT INTO `tblgejala` VALUES (5, 'Leher terpelintir', NULL, 0.2);
INSERT INTO `tblgejala` VALUES (6, 'Ayam berputar-putar', NULL, 0.4);
INSERT INTO `tblgejala` VALUES (7, 'Nafsu makan menurun', NULL, 0.2);
INSERT INTO `tblgejala` VALUES (8, 'Lemas', NULL, 0.8);
INSERT INTO `tblgejala` VALUES (9, 'Bulu menjadi kusam dan berdiri', NULL, 0.6);
INSERT INTO `tblgejala` VALUES (10, 'Tinja cair dan berwarna putih', NULL, 0.4);
COMMIT;

-- ----------------------------
-- Table structure for tblkategori_gejala
-- ----------------------------
DROP TABLE IF EXISTS `tblkategori_gejala`;
CREATE TABLE `tblkategori_gejala` (
  `id_katgejala` int(255) NOT NULL AUTO_INCREMENT,
  `id_penyakit` int(255) DEFAULT NULL,
  `id_gejala` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_katgejala`),
  KEY `fk_penyakit` (`id_penyakit`),
  KEY `fk_gejala` (`id_gejala`),
  CONSTRAINT `fk_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tblgejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `tblpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblkategori_gejala
-- ----------------------------
BEGIN;
INSERT INTO `tblkategori_gejala` VALUES (1, 1, 1);
INSERT INTO `tblkategori_gejala` VALUES (2, 1, 2);
INSERT INTO `tblkategori_gejala` VALUES (3, 1, 3);
INSERT INTO `tblkategori_gejala` VALUES (4, 1, 4);
INSERT INTO `tblkategori_gejala` VALUES (5, 1, 5);
INSERT INTO `tblkategori_gejala` VALUES (6, 1, 6);
INSERT INTO `tblkategori_gejala` VALUES (7, 2, 7);
INSERT INTO `tblkategori_gejala` VALUES (8, 2, 8);
INSERT INTO `tblkategori_gejala` VALUES (9, 2, 2);
INSERT INTO `tblkategori_gejala` VALUES (10, 2, 9);
INSERT INTO `tblkategori_gejala` VALUES (11, 2, 10);
COMMIT;

-- ----------------------------
-- Table structure for tbllogin
-- ----------------------------
DROP TABLE IF EXISTS `tbllogin`;
CREATE TABLE `tbllogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbllogin
-- ----------------------------
BEGIN;
INSERT INTO `tbllogin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);
INSERT INTO `tbllogin` VALUES (2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2);
COMMIT;

-- ----------------------------
-- Table structure for tblpenyakit
-- ----------------------------
DROP TABLE IF EXISTS `tblpenyakit`;
CREATE TABLE `tblpenyakit` (
  `id_penyakit` int(255) NOT NULL AUTO_INCREMENT,
  `penyakit` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblpenyakit
-- ----------------------------
BEGIN;
INSERT INTO `tblpenyakit` VALUES (1, 'ND', 'ini penyakit ND');
INSERT INTO `tblpenyakit` VALUES (2, 'Gumboro', NULL);
INSERT INTO `tblpenyakit` VALUES (3, 'Flu Burung', NULL);
INSERT INTO `tblpenyakit` VALUES (4, 'IBH', NULL);
INSERT INTO `tblpenyakit` VALUES (5, 'IB', NULL);
INSERT INTO `tblpenyakit` VALUES (6, 'Snot', NULL);
INSERT INTO `tblpenyakit` VALUES (7, 'Kolibasilosis', NULL);
INSERT INTO `tblpenyakit` VALUES (8, 'CRD', NULL);
INSERT INTO `tblpenyakit` VALUES (9, 'Pullorum', NULL);
INSERT INTO `tblpenyakit` VALUES (10, 'Kolera', NULL);
INSERT INTO `tblpenyakit` VALUES (11, 'Berak Darah', NULL);
INSERT INTO `tblpenyakit` VALUES (12, 'Aspergillosis', NULL);
COMMIT;

-- ----------------------------
-- View structure for viewkategori_gejala
-- ----------------------------
DROP VIEW IF EXISTS `viewkategori_gejala`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewkategori_gejala` AS select `tblpenyakit`.`id_penyakit` AS `id_penyakit`,`tblpenyakit`.`penyakit` AS `penyakit`,`tblgejala`.`gejala` AS `gejala`,`tblgejala`.`cfpakar` AS `cfpakar` from ((`tblkategori_gejala` join `tblgejala` on((`tblkategori_gejala`.`id_gejala` = `tblgejala`.`id_gejala`))) join `tblpenyakit` on((`tblkategori_gejala`.`id_penyakit` = `tblpenyakit`.`id_penyakit`))) order by `tblpenyakit`.`id_penyakit`;

SET FOREIGN_KEY_CHECKS = 1;
