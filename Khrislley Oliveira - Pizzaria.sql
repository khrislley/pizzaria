CREATE DATABASE  IF NOT EXISTS `pizzaria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pizzaria`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: pizzaria
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adicional`
--

DROP TABLE IF EXISTS `adicional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adicional` (
  `CODI_ADICIONAL` int NOT NULL AUTO_INCREMENT,
  `NOME_ADICIONAL` varchar(120) NOT NULL,
  `VALOR_ADICIONAL` decimal(6,2) NOT NULL,
  PRIMARY KEY (`CODI_ADICIONAL`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adicional`
--

LOCK TABLES `adicional` WRITE;
/*!40000 ALTER TABLE `adicional` DISABLE KEYS */;
INSERT INTO `adicional` VALUES (2,'Bacon',5.00),(5,'Calabresa',5.00),(8,'Azeitona',2.00),(9,'Catupiry',3.00),(10,'Cebola',2.00),(11,'Cheddar',4.00),(12,'Presunto',4.00),(14,'Picles',1.00);
/*!40000 ALTER TABLE `adicional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aux_adicional`
--

DROP TABLE IF EXISTS `aux_adicional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aux_adicional` (
  `CODI_PIZZA` int NOT NULL,
  `CODI_PEDIDO` int NOT NULL,
  `CODI_ITEM` int DEFAULT NULL,
  `CODI_ADICIONAL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aux_adicional`
--

LOCK TABLES `aux_adicional` WRITE;
/*!40000 ALTER TABLE `aux_adicional` DISABLE KEYS */;
INSERT INTO `aux_adicional` VALUES (1,1,1,10),(1,1,1,11),(2,1,2,2),(2,1,2,14),(3,2,1,10),(5,4,1,2),(5,4,1,11),(6,4,2,5),(6,4,2,12),(8,6,1,10),(9,7,1,2),(10,8,1,11),(10,8,1,12),(12,9,2,2),(12,9,2,5),(12,9,2,8),(12,9,2,9),(12,9,2,10),(12,9,2,11),(12,9,2,12),(12,9,2,14),(14,10,1,2),(14,10,1,11),(16,11,1,2),(16,11,1,9),(17,12,1,2),(17,12,1,12),(18,13,1,2),(18,13,1,5),(19,13,2,11),(19,13,2,12),(21,13,4,14);
/*!40000 ALTER TABLE `aux_adicional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borda`
--

DROP TABLE IF EXISTS `borda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `borda` (
  `CODI_BORDA` int NOT NULL AUTO_INCREMENT,
  `NOME_BORDA` varchar(45) NOT NULL,
  PRIMARY KEY (`CODI_BORDA`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borda`
--

LOCK TABLES `borda` WRITE;
/*!40000 ALTER TABLE `borda` DISABLE KEYS */;
INSERT INTO `borda` VALUES (1,'Sem borda'),(2,'Cheddar'),(8,'Catupiry');
/*!40000 ALTER TABLE `borda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `CODI_CLIENTE` int NOT NULL AUTO_INCREMENT,
  `NOME_CLIENTE` varchar(120) NOT NULL,
  `CPF_CLIENTE` varchar(45) NOT NULL,
  `FONE_CLIENTE` varchar(45) NOT NULL,
  `EMAIL_CLIENTE` varchar(120) NOT NULL,
  PRIMARY KEY (`CODI_CLIENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Maria','123456789-10','99911-1111','maria@gmail.com'),(2,'João','456789123-47','99922-2222','joao@gmail.com'),(3,'Francisco','789456123-85','99933-3333','francisco@gmail.com'),(4,'Jéssica','123789456-69','99944-4444','jessica@gmail.com'),(5,'Monike','369258147-41','99955-5555','monike@gmail.com'),(6,'Gabriel','258147369-52','99966-6666','gabriel@gmail.com'),(7,'Agmar','147369258-63','99977-7777','agmar@gmail.com'),(8,'Caroline','147258369-73','99988-8888','carol@gmail.com'),(9,'Larissa','753159486-24','99999-9999','larissa@gmail.com');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `CODI_ENDERECO` int NOT NULL AUTO_INCREMENT,
  `CODI_CLIENTE` int NOT NULL,
  `LOGRADOURO_ENDERECO` varchar(45) NOT NULL,
  `NUMERO_ENDERECO` varchar(45) NOT NULL,
  `COMPLEMENTO_ENDERECO` varchar(45) DEFAULT NULL,
  `BAIRRO_ENDERECO` varchar(45) NOT NULL,
  `CIDADE_ENDERECO` varchar(45) NOT NULL,
  `ESTADO_ENDERECO` varchar(45) NOT NULL,
  `CEP_ENDERECO` varchar(45) NOT NULL,
  PRIMARY KEY (`CODI_ENDERECO`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,1,'Rua Itauba','100','Q.10 Lt. 100','Veneza','Rio Verde','Goiás','75900-000'),(2,2,'Av ,Pres. Vargas','200',NULL,'Centro','Rio Verde','Goiás','75900-000'),(3,3,'Rua 12','300','Ap. 300','Vila Borges','Rio Verde','Goiás','75900-000'),(4,4,'Av. Rio Verde','400',NULL,'Veneza','Rio Verde','Goiás','75900-000'),(5,5,'Rua Buriti','500',NULL,'Veneza','Rio Verde','Goiás','75900-000'),(6,6,'Rua Augusta Bastos','600','Q. 6 Lt.60 Ap.60','Centro','Rio Verde','Goiás','75900-000'),(7,7,'Rua Goiania','700',NULL,'Centro','Rio Verde','Goiás','75900-000'),(8,8,'Av. João Belo','800',NULL,'Jardim Goias','Rio Verde','Goiás','75900-000'),(9,9,'Rua 20','900','Ap. 90 ','Popular','Rio Verde','Goiás','75900-000');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entregador`
--

DROP TABLE IF EXISTS `entregador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entregador` (
  `CODI_ENTR` int NOT NULL AUTO_INCREMENT,
  `NOME_ENTR` varchar(120) NOT NULL,
  `CPF_ENTR` varchar(45) NOT NULL,
  `FONE_ENTR` varchar(45) NOT NULL,
  `EMAIL_ENTR` varchar(120) NOT NULL,
  PRIMARY KEY (`CODI_ENTR`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador`
--

LOCK TABLES `entregador` WRITE;
/*!40000 ALTER TABLE `entregador` DISABLE KEYS */;
INSERT INTO `entregador` VALUES (1,'Mateus','111111111-11','1111-1111','mateus@gmail.com'),(2,'Jorge','222222222-22','2222-2222','jorge@gmail.com');
/*!40000 ALTER TABLE `entregador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `CODI_FUNC` int NOT NULL AUTO_INCREMENT,
  `NOME_FUNC` varchar(120) NOT NULL,
  `LOGIN_FUNC` varchar(50) NOT NULL,
  `SENHA_FUNC` varchar(120) NOT NULL,
  PRIMARY KEY (`CODI_FUNC`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,'Administrador','adm','202cb962ac59075b964b07152d234b70'),(2,'Lucas','lucas','202cb962ac59075b964b07152d234b70'),(5,'Carlos','carlos','202cb962ac59075b964b07152d234b70'),(6,'Jessica','jessica','202cb962ac59075b964b07152d234b70'),(7,'Eduarda','eduarda','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_pedido`
--

DROP TABLE IF EXISTS `itens_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_pedido` (
  `CODI_PIZZA` int NOT NULL AUTO_INCREMENT,
  `CODI_PEDIDO` int NOT NULL,
  `CODI_ITEM` int DEFAULT NULL,
  `CODI_SABOR` int NOT NULL,
  `CODI_SABOR2` int DEFAULT NULL,
  `CODI_BORDA` int NOT NULL,
  `CODI_TAMANHO` int NOT NULL,
  `VALOR_ITEM` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`CODI_PIZZA`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_pedido`
--

LOCK TABLES `itens_pedido` WRITE;
/*!40000 ALTER TABLE `itens_pedido` DISABLE KEYS */;
INSERT INTO `itens_pedido` VALUES (1,1,1,1,7,2,1,31.00),(2,1,2,7,2,2,2,41.00),(3,2,1,7,7,2,3,47.00),(4,3,1,9,NULL,1,4,55.00),(5,4,1,8,2,2,3,54.00),(6,4,2,7,1,1,3,54.00),(7,5,1,9,NULL,2,1,25.00),(8,6,1,7,NULL,1,4,57.00),(9,7,1,9,8,1,3,50.00),(10,8,1,8,NULL,2,1,33.00),(11,9,1,9,NULL,2,4,55.00),(12,9,2,8,NULL,2,4,81.00),(13,2,2,9,NULL,1,4,55.00),(14,10,1,2,7,2,3,54.00),(15,10,2,9,NULL,1,2,35.00),(16,11,1,7,2,1,3,53.00),(17,12,1,14,15,8,3,54.00),(18,13,1,1,2,1,1,35.00),(19,13,2,8,13,2,2,43.00),(20,13,3,9,15,1,3,45.00),(21,13,4,13,14,2,3,46.00);
/*!40000 ALTER TABLE `itens_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `CODI_PEDIDO` int NOT NULL AUTO_INCREMENT,
  `CODI_CLIENTE` int NOT NULL,
  `CODI_ENDERECO` int NOT NULL,
  `VALOR_PED` decimal(6,2) DEFAULT NULL,
  `SITU_PED` int NOT NULL,
  `HORARIO_PED` timestamp NOT NULL,
  `PREVISAO_ENTREGA` timestamp NOT NULL,
  `CODI_ENTREGADOR` int NOT NULL,
  `VERIFICA_STATUS` tinyint NOT NULL,
  PRIMARY KEY (`CODI_PEDIDO`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,1,1,72.00,2,'2020-12-13 22:35:13','2020-12-13 23:35:13',1,0),(2,2,2,102.00,2,'2020-12-13 22:35:49','2020-12-13 23:35:49',2,0),(3,3,3,27.50,1,'2020-12-13 22:36:05','2020-12-13 23:36:05',1,1),(4,4,4,54.00,1,'2020-12-13 22:36:50','2020-12-13 23:36:50',1,1),(5,5,5,12.50,1,'2020-12-13 22:37:36','2020-12-13 23:37:36',1,1),(6,6,6,28.50,1,'2020-12-13 22:38:04','2020-12-13 23:38:04',2,1),(7,7,7,25.00,1,'2020-12-13 22:38:24','2020-12-13 23:38:24',2,1),(8,8,8,16.50,1,'2020-12-13 22:38:47','2020-12-13 23:38:47',2,1),(9,9,9,68.00,1,'2020-12-13 22:39:16','2020-12-13 23:39:16',2,1),(10,1,1,44.50,1,'2020-12-13 22:58:31','2020-12-13 23:58:31',2,1),(11,7,6,26.50,2,'2020-12-14 14:16:13','2020-12-14 15:16:13',1,1),(12,4,4,54.00,1,'2020-12-14 17:11:05','2020-12-14 18:11:05',2,0),(13,1,1,169.00,1,'2020-12-14 17:11:59','2020-12-14 18:11:59',1,0);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sabor`
--

DROP TABLE IF EXISTS `sabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sabor` (
  `CODI_SABOR` int NOT NULL AUTO_INCREMENT,
  `NOME_SABOR` varchar(45) NOT NULL,
  `PRECO_TAM_P` decimal(6,2) NOT NULL,
  `PRECO_TAM_M` decimal(6,2) NOT NULL,
  `PRECO_TAM_G` decimal(6,2) NOT NULL,
  `PRECO_TAM_GG` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`CODI_SABOR`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sabor`
--

LOCK TABLES `sabor` WRITE;
/*!40000 ALTER TABLE `sabor` DISABLE KEYS */;
INSERT INTO `sabor` VALUES (1,'Moda',25.00,35.00,45.00,55.00),(2,'Strogonoff de Carne',25.00,35.00,45.00,55.00),(7,'Portuguesa',25.00,35.00,45.00,55.00),(8,'Strogonoff de Frango',25.00,35.00,45.00,55.00),(9,'Brigadeiro',25.00,35.00,45.00,55.00),(13,'Frango c/ Catupiry',25.00,35.00,45.00,55.00),(14,'Quatro Queijos',25.00,35.00,45.00,55.00),(15,'Frango com Bacon',25.00,35.00,45.00,55.00),(16,'Lombo Canadense',25.00,35.00,45.00,55.00);
/*!40000 ALTER TABLE `sabor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacao`
--

DROP TABLE IF EXISTS `situacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `situacao` (
  `CODI_SITU` int NOT NULL AUTO_INCREMENT,
  `NOME_SITU` varchar(45) NOT NULL,
  PRIMARY KEY (`CODI_SITU`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacao`
--

LOCK TABLES `situacao` WRITE;
/*!40000 ALTER TABLE `situacao` DISABLE KEYS */;
INSERT INTO `situacao` VALUES (1,'Aberto'),(2,'Entregue');
/*!40000 ALTER TABLE `situacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamanho`
--

DROP TABLE IF EXISTS `tamanho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tamanho` (
  `CODI_TAMANHO` int NOT NULL AUTO_INCREMENT,
  `VALOR_TAMANHO` decimal(6,2) NOT NULL,
  `DESC_TAMANHO` varchar(45) NOT NULL,
  PRIMARY KEY (`CODI_TAMANHO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamanho`
--

LOCK TABLES `tamanho` WRITE;
/*!40000 ALTER TABLE `tamanho` DISABLE KEYS */;
INSERT INTO `tamanho` VALUES (1,25.00,'P  - 4 pedaços'),(2,35.00,'M  - 6 pedaços'),(3,45.00,'G  - 8 pedaços'),(4,55.00,'GG - 12 pedaços');
/*!40000 ALTER TABLE `tamanho` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-14 22:49:15
