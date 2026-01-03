-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17/11/2025 às 02:17
-- Versão do servidor: 11.2.2-MariaDB
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `compartilhador`
--
CREATE DATABASE IF NOT EXISTS `compartilhador` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `compartilhador`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administracao`
--

DROP TABLE IF EXISTS `administracao`;
CREATE TABLE IF NOT EXISTS `administracao` (
  `ID_Administracao` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(11) NOT NULL,
  `Nivel_Acesso` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  PRIMARY KEY (`ID_Administracao`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `id_livro` (`id_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade`
--

DROP TABLE IF EXISTS `comunidade`;
CREATE TABLE IF NOT EXISTS `comunidade` (
  `id_comunidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_comunidade` varchar(30) NOT NULL,
  `descrição` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_comunidade`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `comunidade`
--

INSERT INTO `comunidade` (`id_comunidade`, `nome_comunidade`, `descrição`, `id_usuario`) VALUES
(2, 'homepage', 'para a pagina inicial', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `classificacao` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `classificacao`) VALUES
(1, 'Poesia'),
(2, 'Romance'),
(3, 'Mistério'),
(4, 'Ficcão científica'),
(5, 'fantasia'),
(7, 'História');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

DROP TABLE IF EXISTS `livros`;
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `sinopse` varchar(2500) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `caminhoimg` varchar(250) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `data_upload` timestamp NULL DEFAULT current_timestamp(),
  `autor` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `sinopse`, `nome_arquivo`, `caminhoimg`, `id_genero`, `caminho`, `data_upload`, `autor`) VALUES
(60, 'Memórias Póstumas de Brás Cubas', 'Brás Cubas, já falecido, decide narrar suas lembranças da vida terrena. Não é um autor defunto qualquer: ele escreve de sua condição pós-morte, com ironia, humor ácido e liberdade para reinventar o olhar sobre sua trajetória.  Ele relata sua infância aristocrática no Rio de Janeiro, os amores e desilusões (como a paixão por Marcela e Virgília), os relacionamentos pessoais, os costumes sociais da época e sua passagem pela Europa. Também pondera sobre as instituições, a hipocrisia social, o egoísmo humano e a própria insignificância da vida diante da morte.  Ao final, Brás Cubas faz um balanço de sua existência: “negações” de tudo aquilo que não foi — ele não foi grande, não teve filhos, não alcançou fama duradoura — mas, ao mesmo tempo, sugere que, apesar de tudo, saiu “em conta” da vida, pois não sofreu certos males e manteve certo conforto. Apesar disso, fica a reflexão amarga de que não deixou legado, nem filhos que levem adiante algo das suas dores ou da sua experiência.', 'memoriasBras.pdf', 'uploads/17632243456918ab191f7debrascubas.jpg.jpg', 2, 'uploads/17632243456918ab191f570memoriasBras.pdf.pdf', '2025-11-15 16:32:35', 'Machado De Assis'),
(62, 'Antologia Poética', 'Antologia Poética reúne uma seleção representativa dos principais momentos da obra de Carlos Drummond de Andrade, um dos maiores nomes da poesia brasileira. Organizado originalmente pelo próprio autor, o livro funciona como um panorama de sua trajetória literária, contemplando poemas que vão do humor ao lirismo, da crítica social à reflexão existencial.', 'antologia.pdf', 'uploads/17632252986918aed2c1596antologia.jfif.jfif', 1, 'uploads/17632252986918aed2c1452antologia.pdf.pdf', '2025-11-15 16:55:07', 'Carlos Drummond de Andrade'),
(63, 'Memórias de Martha', 'A mãe, viúva, luta para sustentar a filha, aconselhando-a para que aprenda tarefas domésticas como estratégia de sobrevivência. Martha, porém, idealiza um futuro diferente: acredita que a educação e o trabalho podem ser caminhos para escapar da situação difícil em que vivem. A obra explora como a protagonista encara limitações sociais impostas pela pobreza, pelas condições de gênero e pela rigidez das expectativas da época.', '176054583368efcc2949b0eMemoriasdemartha.pdf.pdf', 'uploads/17632308836918c4a34276fmemoriasdemartha.jpg.jpg', 2, 'uploads/17632308836918c4a34264a176054583368efcc2949b0eMemoriasdemartha.pdf.pdf.pdf', '2025-11-15 18:21:37', 'Julia de Almeida'),
(64, 'Claro Enigma', 'Claro Enigma marca um momento de virada na poesia de Carlos Drummond de Andrade. Diferentemente do tom mais coloquial e social de obras anteriores, este livro mergulha em reflexões filosóficas, existenciais e metafísicas, revelando um Drummond mais introspectivo e formal.  Dividido em seis partes, a obra explora temas como o tempo, a morte, a incompletude humana, o sentido da criação artística e a crise do mundo moderno após a Segunda Guerra Mundial. A linguagem é mais densa, marcada por rigor construtivo, referências eruditas e certa atmosfera de desencanto. É nesse livro que surge o famoso poema “A Máquina do Mundo”, um dos mais importantes da literatura brasileira, no qual o poeta recusa a promessa de conhecimento total diante da complexidade da existência.', 'drummond-claroenigma.pdf', 'uploads/17632311026918c57eef191claroEnigma.jpg.jpg', 1, 'uploads/17632311026918c57eef063drummond-claroenigma.pdf.pdf', '2025-11-15 18:25:24', 'Carlos Drummond de Andrade');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `sinopse` varchar(2500) NOT NULL,
  `datapedido` varchar(10) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `caminho` varchar(300) NOT NULL,
  `caminhoimg` varchar(300) NOT NULL,
  `nome_arquivo` varchar(250) NOT NULL,
  `autor` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `titulo`, `sinopse`, `datapedido`, `id_genero`, `caminho`, `caminhoimg`, `nome_arquivo`, `autor`) VALUES
(17, 'As Aventuras de Pimpollone', 'kjkjkjjdf', '2025-11-17', 4, 'uploads/1763344020691a7e944876cantologia.pdf.pdf', 'uploads/1763344020691a7e9448779bicho.jfif.jfif', 'antologia.pdf', 'Julia de Almeida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pontos`
--

DROP TABLE IF EXISTS `pontos`;
CREATE TABLE IF NOT EXISTS `pontos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `pontos` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pontos`
--

INSERT INTO `pontos` (`id`, `id_usuario`, `pontos`) VALUES
(1, 2, 21),
(4, 12, 3),
(7, 14, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `ID_Postagem` int(11) NOT NULL AUTO_INCREMENT,
  `Conteudo` varchar(2500) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `datapostagem` varchar(10) NOT NULL,
  `idcomunidade` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`ID_Postagem`),
  KEY `ID_Usuario` (`idusuario`),
  KEY `ID_Comunidade` (`idcomunidade`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `postagem`
--

INSERT INTO `postagem` (`ID_Postagem`, `Conteudo`, `titulo`, `datapostagem`, `idcomunidade`, `idusuario`) VALUES
(16, 'oiiii', 'oie', '15/11/2025', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idade` int(11) NOT NULL,
  `cargo` varchar(15) NOT NULL,
  `Data_Cadastro` timestamp NULL DEFAULT current_timestamp(),
  `id_post` int(11) DEFAULT NULL,
  `caminhoimgperfil` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `idade`, `cargo`, `Data_Cadastro`, `id_post`, `caminhoimgperfil`) VALUES
(1, 'MUrilow', 'murilowhaha@gmail.com', '1234', 13, 'adm', NULL, 0, ''),
(2, 'Andrei', 'dreiestuda@gmail.com', '1234', 18, 'adm', NULL, 0, 'src/img/perfis/avatar_2_1762965683.jfif'),
(3, 'Allan Araujo', 'allanfs762@gmail.com', '1234', 18, 'adm', NULL, 0, ''),
(6, 'imaculado', 'maculado@gmail.com', '1234', 12, 'usuario', NULL, NULL, ''),
(10, 'Ã¡ndrei', 'sim@gmail.com', '1234', 59, 'usuario', NULL, NULL, ''),
(11, 'Conta de Usuário', 'teste@teste.com.br', '1234', 66, 'usuario', NULL, NULL, ''),
(12, 'Katty', 'katty@gmail.com', 'dedei2007', 15, 'usuario', NULL, NULL, 'src/img/perfis/avatar_12_1762910448.jpg'),
(13, 'Genestra', 'genestradavi@gmail.com', 'Miau2012', 28, 'usuario', NULL, NULL, 'src/img/perfis/avatar_13_1762966168.png'),
(14, 'oya', 'oya@gmail.com', '1234', 1, 'usuario', NULL, NULL, 'src/img/perfis/avatar_14_1763166329.jpg'),
(15, 'oie', 'oie@gmail.com', '1234', 19, 'usuario', NULL, NULL, NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `administracao`
--
ALTER TABLE `administracao`
  ADD CONSTRAINT `administracao_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `administracao_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `comunidade`
--
ALTER TABLE `comunidade`
  ADD CONSTRAINT `comunidade_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

--
-- Restrições para tabelas `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postagem_ibfk_2` FOREIGN KEY (`idcomunidade`) REFERENCES `comunidade` (`id_comunidade`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
