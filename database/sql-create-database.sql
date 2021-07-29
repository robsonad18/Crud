-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para teste_php
CREATE DATABASE IF NOT EXISTS `teste_php` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `teste_php`;

-- Copiando estrutura para tabela teste_php.autorizacoes
CREATE TABLE IF NOT EXISTS `autorizacoes` (
  `USUARIO_ID` int(11) unsigned NOT NULL,
  `CHAVE_AUTORIZACAO` varchar(100) NOT NULL,
  PRIMARY KEY (`USUARIO_ID`,`CHAVE_AUTORIZACAO`) USING BTREE,
  CONSTRAINT `FK_USUARIOS_AUTORIZACOES` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios` (`USUARIO_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela teste_php.chave
CREATE TABLE IF NOT EXISTS `chave` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela teste_php.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `USUARIO_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(30) NOT NULL,
  `SENHA` varchar(30) NOT NULL,
  `ATIVO` varchar(1) NOT NULL DEFAULT 'S',
  `NOME_COMPLETO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`USUARIO_ID`),
  UNIQUE KEY `IDX_USUARIOS_LOGIN` (`LOGIN`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para view teste_php.vw_autorizacoes
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_autorizacoes` (
	`CHAVE` VARCHAR(22) NOT NULL COLLATE 'utf8mb4_general_ci',
	`DESCRICAO` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view teste_php.vw_autorizacoes
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `vw_autorizacoes`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_autorizacoes` AS select 'cadastrar_clientes' AS `CHAVE`,'Cadastrar clientes' AS `DESCRICAO` union all select 'excluir_clientes' AS `CHAVE`,'Excluir clientes' AS `DESCRICAO` union all select 'cadastrar_fornecedores' AS `CHAVE`,'Cadastrar fornecedores' AS `DESCRICAO` union all select 'excluir_fornecedores' AS `CHAVE`,'Excluir fornecedores' AS `DESCRICAO` union all select 'cadastrar_produtos' AS `CHAVE`,'Cadastrar produtos' AS `DESCRICAO` union all select 'alterar_preco_produtos' AS `CHAVE`,'Alterar preço de produtos' AS `DESCRICAO` ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
