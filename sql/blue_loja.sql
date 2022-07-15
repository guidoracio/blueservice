-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jul-2022 às 22:09
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blue_loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id_caracteristica` int(6) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` enum('S','N','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `caracteristicas`
--

INSERT INTO `caracteristicas` (`id_caracteristica`, `nome`, `status`) VALUES
(1, 'PRETO', 'S'),
(2, 'VERDE', 'S'),
(3, 'AZUL', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carrinho` int(6) NOT NULL,
  `id_cliente` int(6) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id_carrinho`, `id_cliente`, `cliente`, `codigo`, `data_hora`, `cep`, `endereco`, `numero`, `bairro`, `complemento`, `cidade`, `estado`) VALUES
(1, 1, 'GUILHERME COMELLI DORACIO', 'ACF5F3A857EBEC783932F7C844799858', '2022-07-15 18:39:06', '19801030', 'Rua Otávio Floriano Rosa', '40', 'Jardim Canadá', '', 'Assis', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_itens`
--

CREATE TABLE `carrinho_itens` (
  `id_item` int(6) NOT NULL,
  `id_caracteristica` int(6) NOT NULL,
  `id_carrinho` int(6) NOT NULL,
  `id_produto` int(6) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `nome_produto` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `quantidade` int(3) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carrinho_itens`
--

INSERT INTO `carrinho_itens` (`id_item`, `id_caracteristica`, `id_carrinho`, `id_produto`, `data_cadastro`, `nome_produto`, `quantidade`, `valor`) VALUES
(1, 1, 1, 1, '2022-07-15 18:39:06', 'Phone 11 Apple (64GB)', 1, '3199.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(6) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` enum('S','N','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `status`) VALUES
(1, 'CELULARES', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(6) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('S','N','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `documento`, `nome`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `telefone`, `email`, `senha`, `data_nascimento`, `data_cadastro`, `status`) VALUES
(1, '41356583857', 'GUILHERME COMELLI DORACIO', '19801030', 'Rua Otávio Floriano Rosa', '40', '', 'Jardim Canadá', 'Assis', 'SP', '18996584940', 'gdoracio@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1994-07-27', '2022-07-15 18:33:29', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(6) NOT NULL,
  `id_cliente` int(6) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor_pedido` decimal(10,2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `status_pedido` enum('INSERIDO','ANDAMENTO','CONCLUIDO','CANCELADO') NOT NULL,
  `apagado` enum('N','S') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `cliente`, `codigo`, `data_hora`, `valor_pedido`, `cep`, `endereco`, `numero`, `bairro`, `complemento`, `cidade`, `estado`, `status_pedido`, `apagado`) VALUES
(1, 1, 'GUILHERME COMELLI DORACIO', 'ACF5F3A857EBEC783932F7C844799858', '2022-07-15 18:39:06', '3199.00', '19801030', 'Rua Otávio Floriano Rosa', '40', 'Jardim Canadá', '', 'Assis', 'SP', 'INSERIDO', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_itens`
--

CREATE TABLE `pedidos_itens` (
  `id_item` int(6) NOT NULL,
  `id_caracteristica` int(6) NOT NULL,
  `id_pedido` int(6) NOT NULL,
  `id_produto` int(6) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `nome_produto` varchar(300) NOT NULL,
  `quantidade` int(3) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`id_item`, `id_caracteristica`, `id_pedido`, `id_produto`, `data_cadastro`, `nome_produto`, `quantidade`, `valor`) VALUES
(1, 1, 1, 1, '2022-07-15 19:42:12', 'Phone 11 Apple (64GB)', 1, '3199.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(6) NOT NULL,
  `caracteristicas` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` enum('S','N','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `caracteristicas`, `nome`, `descricao`, `imagem`, `valor`, `status`) VALUES
(1, '3,1,2', 'Phone 11 Apple (64GB)', 'Sistema Operacional\r\niOS 13\r\n\r\nTela\r\nTamanho: 6,1\"\r\nMaterial: Liquid Retina HD\r\n\r\nConectividade\r\n4G\r\nWi-Fi\r\nEDGE\r\nBluetooth\r\nNFC\r\n\r\nCapacidade\r\n64GB*\r\n\r\n* Parte da memória interna já é utilizada pelo sistema operacional e aplicativos pré-instalados\r\n\r\nProcessador\r\nA13 Bionic Neural Engine (3ª Geração)\r\n\r\nCâmera Traseira\r\nCâmera dupla (ultra-angular e grande-angular) de 12 MP com modo Noite,\r\nCâmera TrueDepth de 12 MP\r\nFlash\r\n\r\nCâmera Frontal\r\n12MP\r\n\r\nOutros Recursos\r\nDual Chip\r\nTipo de Chip: eSIM e nano SIM (não incluso)\r\nGPS\r\nMP3\r\nRecursos de Som: Alto-falante estéreo\r\nRecursos de Vídeo: Gravação de vídeo 4K a 24 qps, 30 qps ou 60 qps, Gravação de vídeo HD de 1080p a 30 qps ou 60 qps, Gravação de vídeo HD de 720p a 30 qps\r\nAlerta Vibratório\r\nViva-voz\r\nRecursos de Chamadas: Chamada de vídeo, FaceTime de vídeo via Wi-Fi ou dados celulares - Chamada de áudio: FaceTime de áudio, VoLTE (Voice over LTE), Chamadas Wi?Fi\r\nBanda:  FDD?LTE (Bandas 1, 2, 3, 4, 5, 7, 8, 11, 12, 13, 17, 18, 19, 20, 21, 25, 26, 28, 29, 30, 32, 66) TD?LTE (Bandas 34, 38, 39, 40, 41, 42, 46, 48) UMTS/HSPA+/DC?HSDPA (850, 900, 1700/2100, 1900, 2100 MHz) GSM/EDGE (850, 900, 1800, 1900 MHz)\r\nFrequência:  FDD?LTE (Bandas 1, 2, 3, 4, 5, 7, 8, 11, 12, 13, 17, 18, 19, 20, 21, 25, 26, 28, 29, 30, 32, 66) TD?LTE (Bandas 34, 38, 39, 40, 41, 42, 46, 48) UMTS/HSPA+/DC?HSDPA (850, 900, 1700/2100, 1900, 2100 MHz) GSM/EDGE (850, 900, 1800, 1900 MHz)\r\nIdiomas do Menu: Alemão, árabe, catalão, chinês (simplificado, tradicional, tradicional de Hong Kong), coreano, croata, dinamarquês, eslovaco, espanhol (América Latina, Espanha, México), finlandês, francês (Canadá, França), grego, hebraico, hindi, holandês, húngaro, indonésio, inglês (Austrália, EUA, Reino Unido), italiano, japonês, malaio, norueguês, polonês, português (Brasil, Portugal), romeno, russo, sueco, tailandês, tcheco, turco, ucraniano, vietnamita\r\nEstrutura em vidro e alumínio\r\nResistência à água a uma profundidade de até dois metros por até 30 minutos\r\n\r\nBateria\r\nTipo de Bateria: íon de lítio\r\nBateria com até uma hora a mais de duração comparada ao iPhone XR\r\n\r\nCor\r\nPreto\r\n\r\nEAN\r\n194252097106\r\n\r\nEspecificações Técnicas\r\nModelo: MHDA3BZ/A\r\nGarantia: 12 meses\r\n\r\nDimensões e Peso\r\nDimensões do produto sem embalagem (AxLxP): 150,9x75,7x8,3 mm\r\nDimensões do produto com embalagem (AxLxP): 168x93x29 mm\r\nPeso do produto sem embalagem: 0,138 kg\r\nPeso do produto com embalagem: 0,194 kg\r\n\r\nItens Inclusos\r\n01 iPhone 11\r\n01 Cabo USB-C\r\nDocumentação', '501322134015072022203245.jpeg', '3199.00', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_categorias`
--

CREATE TABLE `produtos_categorias` (
  `id` int(6) NOT NULL,
  `id_produto` int(6) NOT NULL,
  `id_categoria` int(6) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos_categorias`
--

INSERT INTO `produtos_categorias` (`id`, `id_produto`, `id_categoria`, `data_hora`) VALUES
(1, 1, 1, '2022-07-15 18:32:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` enum('S','N','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `login`, `senha`, `status`) VALUES
(1, 'Guilherme', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'S'),
(2, 'Bira', 'bira', 'e10adc3949ba59abbe56e057f20f883e', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id_caracteristica`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`);

--
-- Índices para tabela `carrinho_itens`
--
ALTER TABLE `carrinho_itens`
  ADD PRIMARY KEY (`id_item`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices para tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD PRIMARY KEY (`id_item`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `produtos_categorias`
--
ALTER TABLE `produtos_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id_caracteristica` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrinho_itens`
--
ALTER TABLE `carrinho_itens`
  MODIFY `id_item` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  MODIFY `id_item` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_categorias`
--
ALTER TABLE `produtos_categorias`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
