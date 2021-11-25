-- MariaDB dump 10.19  Distrib 10.6.4-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: si_pakar
-- ------------------------------------------------------
-- Server version	10.6.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage` (
  `id_store` int(11) NOT NULL AUTO_INCREMENT,
  `id_gejala` int(11) NOT NULL,
  `nilai_gejala` float NOT NULL,
  `nilai_user` float NOT NULL,
  PRIMARY KEY (`id_store`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage`
--

/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
INSERT INTO `storage` VALUES (66,44,0.4,0.4),(67,15,1,0.6),(68,12,0.4,0.8),(69,37,0.2,0.2),(70,22,1,0.6);
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;

--
-- Table structure for table `tblbobot`
--

DROP TABLE IF EXISTS `tblbobot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblbobot` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `bobot` varchar(100) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbobot`
--

/*!40000 ALTER TABLE `tblbobot` DISABLE KEYS */;
INSERT INTO `tblbobot` VALUES (1,'sangat tidak yakin',0.2),(2,'tidak yakin',0.4),(3,'yakin',0.6),(4,'cukup yakin',0.8),(5,'sangat yakin',1);
/*!40000 ALTER TABLE `tblbobot` ENABLE KEYS */;

--
-- Table structure for table `tbldiagnosa`
--

DROP TABLE IF EXISTS `tbldiagnosa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldiagnosa` (
  `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gejala` varchar(255) NOT NULL,
  `cf_user` varchar(255) NOT NULL,
  `nilai_gejala` float NOT NULL,
  `nilai_cfuser` float NOT NULL,
  `cf_he` float NOT NULL,
  `cfold_akhir` float NOT NULL,
  PRIMARY KEY (`id_diagnosa`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldiagnosa`
--

/*!40000 ALTER TABLE `tbldiagnosa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldiagnosa` ENABLE KEYS */;

--
-- Table structure for table `tblgejala`
--

DROP TABLE IF EXISTS `tblgejala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblgejala` (
  `id_gejala` int(255) NOT NULL AUTO_INCREMENT,
  `gejala` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nilai_gejala` double DEFAULT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgejala`
--

/*!40000 ALTER TABLE `tblgejala` DISABLE KEYS */;
INSERT INTO `tblgejala` VALUES (1,'Tinja berwarna hijau lumut dengan gumpalan putih','aaa',0.4),(2,'Ayam gemetar',NULL,0.4),(3,'Kelumpuhan pada kaki',NULL,0.6),(4,'Kelumpuhan pada sayap',NULL,0.2),(5,'Leher terpelintir',NULL,0.2),(6,'Ayam berputar-putar',NULL,0.4),(7,'Nafsu makan menurun',NULL,0.2),(8,'Lemas',NULL,0.8),(9,'Bulu menjadi kusam dan berdiri',NULL,0.6),(10,'Tinja cair dan berwarna putih',NULL,0.4),(11,'Jengger Ayam membengkak dengan warna kebiruan',NULL,0.6),(12,'kaki kerokan',NULL,0.4),(13,'Gangguan pernafasan',NULL,0.8),(14,'Keluar cairan dari rongga mulut',NULL,0.4),(15,'Diare',NULL,1),(16,'Heus berlebihan / lebih banyak minum',NULL,0.6),(17,'Kerabang telur lembek',NULL,0.2),(18,'Sayap terkulai',NULL,1),(19,'Gerakan tidak seimbang / sempoyongan',NULL,0.8),(20,'Jengger dan pial memucat',NULL,0.4),(21,'Ayam terengah - engah',NULL,1),(22,'Batuk',NULL,1),(23,'Bersin',NULL,1),(24,'Ngorok',NULL,1),(25,'Keluar lendir dari hidung',NULL,0.8),(26,'Kelopak mata mengalami peradangan',NULL,0.6),(27,'Mata bengkak dan berair',NULL,0.6),(28,'Kaki pucat',NULL,0.2),(29,'Pertumbuhan yang lambat',NULL,0.4),(30,'Penurunan konsumsi ransum',NULL,0.4),(31,'Menggigil',NULL,0.6),(32,'Tinja berwarna putih seperti kapur',NULL,0.8),(33,'Kotoran menempel di sekitar dubur',NULL,0.4),(34,'Jengger berwarna keabuan',NULL,0.6),(35,'Mata sayu / menutup',NULL,0.8),(36,'Sayap menggentung dan kusam',NULL,0.8),(37,'Ayam bergerombol',NULL,0.2),(38,'Kepala disembunyikan pada ketiak',NULL,0.4),(39,'terlihat lesu dan lemas',NULL,0.6),(40,'Tinja encer',NULL,0.8),(41,'Perubahan warna pada kotoran',NULL,0.4),(42,'Kondisi tubuh panas',NULL,0.6),(43,'Ayam enggan berlari',NULL,0.6),(44,'Ayam lebih suka menyendiri',NULL,0.4),(45,'Tinja berdarah dan mencret',NULL,0.4),(46,'Kepala dan leher menekuk',NULL,0.4),(47,'Ayam menjadi kurus',NULL,0.6),(48,'Ayam mengalami sembelit',NULL,0.4);
/*!40000 ALTER TABLE `tblgejala` ENABLE KEYS */;

--
-- Table structure for table `tblkategori_gejala`
--

DROP TABLE IF EXISTS `tblkategori_gejala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblkategori_gejala` (
  `id_katgejala` int(255) NOT NULL AUTO_INCREMENT,
  `id_penyakit` int(255) DEFAULT NULL,
  `id_gejala` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_katgejala`),
  KEY `fk_penyakit` (`id_penyakit`),
  KEY `fk_gejala` (`id_gejala`),
  CONSTRAINT `fk_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tblgejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `tblpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblkategori_gejala`
--

/*!40000 ALTER TABLE `tblkategori_gejala` DISABLE KEYS */;
INSERT INTO `tblkategori_gejala` VALUES (1,0,1),(2,0,2),(3,0,3),(4,0,4),(5,0,5),(6,0,6),(7,2,7),(8,2,8),(9,2,2),(10,2,9),(11,2,10),(12,3,11),(13,3,12),(14,3,13),(15,3,14),(16,3,15),(17,3,16),(18,3,17),(19,4,18),(20,4,19),(21,4,20),(22,4,2),(23,5,21),(24,5,22),(25,5,23),(26,5,24),(27,6,21),(28,6,25),(29,6,26),(30,6,27),(31,7,28),(32,7,29),(33,8,25),(35,8,27),(36,8,30),(37,8,29),(38,8,31),(39,8,7),(40,9,7),(41,9,8),(42,9,32),(43,9,33),(44,9,34),(45,9,35),(46,9,36),(47,9,3),(48,9,4),(49,9,37),(50,10,7),(51,10,38),(52,10,39),(53,10,40),(54,10,13),(55,10,41),(56,10,42),(57,10,43),(58,10,35),(59,10,44),(60,11,9),(61,11,39),(62,11,46),(63,11,35),(64,12,7),(66,12,13),(79,8,2),(80,8,3),(81,10,2),(82,10,1),(85,12,22),(86,12,47),(89,8,24);
/*!40000 ALTER TABLE `tblkategori_gejala` ENABLE KEYS */;

--
-- Table structure for table `tbllogin`
--

DROP TABLE IF EXISTS `tbllogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllogin`
--

/*!40000 ALTER TABLE `tbllogin` DISABLE KEYS */;
INSERT INTO `tbllogin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1),(2,'user','ee11cbb19052e40b07aac0ca060c23ee',2);
/*!40000 ALTER TABLE `tbllogin` ENABLE KEYS */;

--
-- Table structure for table `tblpenyakit`
--

DROP TABLE IF EXISTS `tblpenyakit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpenyakit` (
  `id_penyakit` int(255) NOT NULL AUTO_INCREMENT,
  `penyakit` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpenyakit`
--

/*!40000 ALTER TABLE `tblpenyakit` DISABLE KEYS */;
INSERT INTO `tblpenyakit` VALUES (0,'ND','ini penyakit ND'),(2,'Gumboro',NULL),(3,'Flu Burung',NULL),(4,'IBH',NULL),(5,'IB',NULL),(6,'Snot',NULL),(7,'Kolibasilosis',NULL),(8,'CRD',NULL),(9,'Pullorum',NULL),(10,'Kolera',NULL),(11,'Berak Darah',NULL),(12,'Aspergillosis',NULL);
/*!40000 ALTER TABLE `tblpenyakit` ENABLE KEYS */;

--
-- Temporary table structure for view `viewkategori_gejala`
--

DROP TABLE IF EXISTS `viewkategori_gejala`;
