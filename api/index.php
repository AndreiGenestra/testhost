<?php // BANCO DE DADOS
// Inclui o arquivo de conexão com o banco de dados
require_once('bd.php');
$mysql = new BancodeDados();
$mysql->conecta();
session_start();
$_SESSION['strerrolog'] ="";
// Inicia a sessão e define o estado de login

$_SESSION['logado'] = false;
$_SESSION['strCadErro'] ="";
// Buscar arquivos no banco de dados
$sqlstring = "SELECT * FROM livros ORDER BY data_upload DESC";
// $resultado = @mysqli_query($mysql->conn, $sqlstring);
if ($resultado = @mysqli_query($mysql->conn, "SELECT * FROM livros ORDER BY data_upload DESC"));



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="script" href="script.js">
    <title>Bibliotec</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <button class="navbar-toggle" aria-label="Abrir menu" onclick="toggleNavbar()">☰</button>
        <!-- Lista de navegação -->
        <ul class="nav-list">
            <!-- Item Home -->
            <li class="nav-list-item home-item">
                <a href="./index.php">
                    <!-- Ícone Home -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                    </svg>
                    <span class="home-text">Início</span>
                </a>
            </li>
            <!-- Item Sobre Nós -->
            <li class="nav-list-item generos-item">
                <a href="sobrenos.php">
                    <!-- Ícone Sobre Nós -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>
                    <span class="sobre-text">Sobre Nós</span>
                </a>
            </li>
        </ul>
        <!-- Botão de Login -->
        <div class="nav-actions">
            <a href="./entrarconta.php" class="home-btn">Login</a>
        </div>
    </nav>

    <!-- Título e apresentação -->
    <div class="bloco1">
        <div class="bloco1-texto" >
            <h1 class="titulo">Bibliotec</h1>
            <p id="typewriter-text"></p>
        </div>
        <img src="./src/img/logo.png" class="logo" alt="Logo da Bibliotec" style="margin: 100px">
    </div>
    <div class="apresentacao">
        <h1 style="font-size: 100px; color:var(--cor-primaria)">Acervo Disponível</h1>
        <br>
        <br>
        <div class="card-area">
            <!-- Card 1 -->
            <div class="card">
                <h3 class="title">E Não Sobrou Nenhum</h3>
                <div class="bar">
                    <a href="livro_sentimento.php" target="_blank"><img src="./src/img/naosobrounada.jpg"></a>
                </div>
                <div>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"></svg>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card">
                <h3 class="title">Canaã</h3>
                <div class="bar">
                    <a href="livro_enigma.php" target="_blank"><img src="./src/img/canaa.jpg"></a>
                </div>
                <div>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"></svg>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card">
                <h3 class="title">Antologia Poética</h3>
                <div class="bar">
                    <a href="livro_antologia.php" target="_blank"><img src="./src/img/antologia.jfif"></a>
                </div>
                <div>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"></svg>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="card">
                <h3 class="title">A Revolução dos Bichos</h3>
                <div class="bar">
                    <a href="livro_rosa.php" target="_blank"><img src="./src/img/bicho.jfif"></a>
                </div>
                <div>
                    <svg version="1.1" xmlns="capa2.jpg"></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Bibliotec. Todos os direitos reservados by Maiam Technologies</p>
    </footer>

    <!-- Scripts para animação e interatividade -->
    <script>
        // Efeito máquina de escrever
    
        const texto = "Bibliotec é uma biblioteca digital que oferece uma ampla gama de livros e recursos para leitores de todas as idades.";
        const elemento = document.getElementById("typewriter-text");
        let i = 0;
        function digitar() {
            if (i < texto.length) {
                elemento.innerHTML += texto.charAt(i);
                i++;
                setTimeout(digitar, 35); // velocidade da digitação
            }
        }
        window.onload = digitar;

        // Efeito lupa
        var lupa = document.getElementById("lupa");
        var bolalupa = document.getElementById("bolalupa");
        function mudacor() {
            lupa.style.color = "Blue";
        }
        function mudacor2() {
            lupa.style.color = "var(--cor-fundo)";
        }
        bolalupa.addEventListener("mousemove", mudacor, false);
        bolalupa.addEventListener("mouseleave", mudacor2, false);

        // Navbar responsiva
        function toggleNavbar() {
            var navList = document.querySelector('.nav-list');
            navList.classList.toggle('active');
        }
    </script>
</body>
</html>