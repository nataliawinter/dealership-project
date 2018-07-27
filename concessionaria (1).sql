-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 14/07/2012 às 17h55min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `concessionaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `Cargo` varchar(45) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`idCargo`, `Cargo`) VALUES
(1, 'Financeiro'),
(2, 'Gerente'),
(3, 'Secretariaas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp850 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Categoria`) VALUES
(3, 'ESPORTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCompleto` varchar(60) NOT NULL,
  `Cpf` int(11) NOT NULL,
  `Rg` int(11) NOT NULL,
  `DataNasc` varchar(20) DEFAULT NULL,
  `Telefone` int(11) DEFAULT NULL,
  `Celular` int(11) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Rua` varchar(60) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Cep` int(11) DEFAULT NULL,
  `Cidade` varchar(60) NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `Pais` varchar(30) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `NomeCompleto`, `Cpf`, `Rg`, `DataNasc`, `Telefone`, `Celular`, `Email`, `Rua`, `Bairro`, `Numero`, `Cep`, `Cidade`, `Estado`, `Pais`) VALUES
(3, 'jajajaja', 2147483647, 2147483647, '20011112', 2147483647, 2147483647, NULL, 'hahahahaha', 'ahhahaha', 7272, 2147483647, 'estatasd', 'RS', 'ruhe'),
(5, 'uaihsduiehiuh', 88282, 83828382, '19910202', 37373737, 73737373, NULL, 'nana@jhahaha', '222', 0, 0, '89120234832', 'Es', 'RS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comissao`
--

CREATE TABLE IF NOT EXISTS `comissao` (
  `idComissao` int(11) NOT NULL AUTO_INCREMENT,
  `De` double NOT NULL,
  `Ate` double NOT NULL,
  `Valor` double NOT NULL,
  PRIMARY KEY (`idComissao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `comissao`
--

INSERT INTO `comissao` (`idComissao`, `De`, `Ate`, `Valor`) VALUES
(2, 10, 25, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregado`
--

CREATE TABLE IF NOT EXISTS `empregado` (
  `idEmpregado` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCompleto` varchar(50) NOT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `DataNasc` date NOT NULL,
  `Cpf` int(11) NOT NULL,
  `Rg` int(11) NOT NULL,
  `NroCarteiraTrab` int(11) NOT NULL,
  `Telefone` int(11) DEFAULT NULL,
  `Celular` int(11) DEFAULT NULL,
  `Salario` double NOT NULL,
  `Rua` varchar(60) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Cep` int(11) DEFAULT NULL,
  `Cargo_idCargo` int(11) NOT NULL,
  `Cidade` varchar(60) NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `Pais` varchar(30) NOT NULL,
  PRIMARY KEY (`idEmpregado`),
  KEY `fk_Empregado_Cargo1` (`Cargo_idCargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `empregado`
--

INSERT INTO `empregado` (`idEmpregado`, `NomeCompleto`, `Email`, `DataNasc`, `Cpf`, `Rg`, `NroCarteiraTrab`, `Telefone`, `Celular`, `Salario`, `Rua`, `Bairro`, `Numero`, `Cep`, `Cargo_idCargo`, `Cidade`, `Estado`, `Pais`) VALUES
(5, 'Roger', 'rogerio@gmail.com', '0000-00-00', 2147483647, 1091546943, 2147483647, 2147483647, 0, 500, '', '', 0, 93600, 2, 'Estância Velha', 'PR', 'Brasil'),
(6, 'Victor Souza', 'vitor@gmail.com', '0000-00-00', 2147483647, 1091546943, 2147483647, 2147483647, 0, 1000, '', '', 0, 93600000, 1, 'estancia velha', ' ', 'brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastosempresa`
--

CREATE TABLE IF NOT EXISTS `gastosempresa` (
  `idGastosempresa` int(11) NOT NULL AUTO_INCREMENT,
  `Detalhes` varchar(200) NOT NULL,
  `Valor` double NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`idGastosempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gastosempresa`
--

INSERT INTO `gastosempresa` (`idGastosempresa`, `Detalhes`, `Valor`, `Data`) VALUES
(2, 'dETALH\r\nGL', 7171, '1991-10-20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastosveiculo`
--

CREATE TABLE IF NOT EXISTS `gastosveiculo` (
  `idGastosveiculo` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(200) DEFAULT NULL,
  `TotalGasto` double NOT NULL,
  `Pago` tinyint(1) DEFAULT NULL,
  `veiculo_idVeiculo` int(11) NOT NULL,
  `DataGasto` date NOT NULL,
  PRIMARY KEY (`idGastosveiculo`),
  KEY `fk_GastosVeiculo_veiculo` (`veiculo_idVeiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` varchar(45) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`idMarca`, `Marca`) VALUES
(3, 'Audi'),
(5, 'Porsche'),
(6, 'Chevrolet');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE IF NOT EXISTS `modelo` (
  `idModelo` int(11) NOT NULL AUTO_INCREMENT,
  `Modelo` varchar(45) NOT NULL,
  `Marca_idMarca` int(11) NOT NULL,
  PRIMARY KEY (`idModelo`),
  KEY `fk_Modelo_Marca1` (`Marca_idMarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`idModelo`, `Modelo`, `Marca_idMarca`) VALUES
(5, 'Eclipse', 5),
(6, 'teste', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Senha` varchar(45) NOT NULL,
  `Permissao` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `idVeiculo` int(11) NOT NULL AUTO_INCREMENT,
  `Placa` varchar(7) NOT NULL,
  `Cor` varchar(15) NOT NULL,
  `NroPortas` int(11) NOT NULL,
  `ItensOpcionais` varchar(200) DEFAULT NULL,
  `ValorPago` double NOT NULL,
  `ValorVenda` double NOT NULL,
  `TotalGanho` double NOT NULL,
  `AnoModelo` int(11) NOT NULL,
  `AnoFabricacao` int(11) NOT NULL,
  `Combustivel` int(11) NOT NULL,
  `EstadoDeUso` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Modelo_idModelo` int(11) NOT NULL,
  `Categoria_idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idVeiculo`),
  KEY `fk_Veiculo_Modelo1` (`Modelo_idModelo`),
  KEY `fk_Veiculo_Categoria1` (`Categoria_idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`idVeiculo`, `Placa`, `Cor`, `NroPortas`, `ItensOpcionais`, `ValorPago`, `ValorVenda`, `TotalGanho`, `AnoModelo`, `AnoFabricacao`, `Combustivel`, `EstadoDeUso`, `Status`, `Modelo_idModelo`, `Categoria_idCategoria`) VALUES
(7, 'IMC-100', 'PRETA', 4, 'AR', 1000, 1111, 12121, 2011, 2110, 1, 1, 1, 5, 3),
(8, 'imc1010', 'preta', 4, 'ar', 1211111, 111111, 111111, 2011, 2011, 1, 1, 1, 5, 3),
(9, 'IMC-011', 'ROSA', 3, 'AR CONDICIONADO, travas', 10000, 20000, 10000, 2011, 2010, 1, 2, 2, 5, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE IF NOT EXISTS `venda` (
  `idVenda` int(11) NOT NULL AUTO_INCREMENT,
  `FormaPagamento` varchar(40) NOT NULL,
  `ValorVenda` double NOT NULL,
  `DataVenda` date NOT NULL,
  `Pago` tinyint(1) NOT NULL,
  `DataPagto` date DEFAULT NULL,
  `Veiculo_idVeiculo` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  `Empregado_idEmpregado` int(11) NOT NULL,
  `Banco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idVenda`),
  KEY `fk_Vendas_Veiculo1` (`Veiculo_idVeiculo`),
  KEY `fk_Vendas_Cliente1` (`Cliente_idCliente`),
  KEY `fk_Vendas_Empregado1` (`Empregado_idEmpregado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`idVenda`, `FormaPagamento`, `ValorVenda`, `DataVenda`, `Pago`, `DataPagto`, `Veiculo_idVeiculo`, `Cliente_idCliente`, `Empregado_idEmpregado`, `Banco`) VALUES
(1, 'Cartao', 10000, '2012-10-23', 0, '2012-12-25', 7, 3, 5, 'Itau');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `empregado`
--
ALTER TABLE `empregado`
  ADD CONSTRAINT `fk_Empregado_Cargo1` FOREIGN KEY (`Cargo_idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `gastosveiculo`
--
ALTER TABLE `gastosveiculo`
  ADD CONSTRAINT `fk_GastosVeiculo_veiculo` FOREIGN KEY (`veiculo_idVeiculo`) REFERENCES `veiculo` (`idVeiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_Modelo_Marca1` FOREIGN KEY (`Marca_idMarca`) REFERENCES `marca` (`idMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_Veiculo_Categoria1` FOREIGN KEY (`Categoria_idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Veiculo_Modelo1` FOREIGN KEY (`Modelo_idModelo`) REFERENCES `modelo` (`idModelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_Vendas_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vendas_Empregado1` FOREIGN KEY (`Empregado_idEmpregado`) REFERENCES `empregado` (`idEmpregado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vendas_Veiculo1` FOREIGN KEY (`Veiculo_idVeiculo`) REFERENCES `veiculo` (`idVeiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
