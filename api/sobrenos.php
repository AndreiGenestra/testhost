<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./csspaginas/sobrenos.css" rel="stylesheet">
    <title>Conheça a Maiam Tech</title>
</head>
<?php
// Inicia sessão
session_start();

$strlink = "";

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Usuário NÃO está logado
    $_SESSION['id'] = "";
    $_SESSION['senha'] = "";
    $_SESSION['email'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['idade'] = "";
    $strlink = "index.php";
} else {
    // Usuário ESTÁ logado
    $strlink = "homepage.php";
    // As variáveis de sessão já existem e não são zeradas
}
?>


</head>
<body>
    <!-- Navbar principal -->
    <nav class="navbar">
        <button class="navbar-toggle" aria-label="Abrir menu" onclick="toggleNavbar()">☰</button>
        <ul class="nav-list">
            <!-- Item Home -->
            <li class="nav-list-item home-item">
                <?php
                // Redireciona para homepage se logado, senão para index
                
                    echo "<a href='./" . $strlink . "'>";
                
                   
                ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                    </svg>
                    <span class="home-text">Página Inicial</span>
                </a>
            </li>
            <!-- Item Sobre Nós -->
            <li class="nav-list-item generos-item">
                <!-- Espaço reservado para outros itens -->
            </li>
            <li class="nav-list-item sobre-item">
                <a href="sobrenos.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                        <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0m6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0"/>
                    </svg>
                    <span class="sobre-text">Sobre Nós</span>
                </a>
            </li>
        </ul>
    <img class="navbar-logo" src="src/img/logodeitada.png" alt="Logo da Bibliotec">
    </nav>

    <!-- Título da empresa -->
    <div class="titulo-empresa">
        <center>
            <strong class="forteb"><h1>Sobre a empresa</h1></strong>
        </center>
    </div>

    <div class="container">
        <!-- SOBRE A EMPRESA -->
        <section class="sobre">
            <div class="sobre-texto">
                <p>Com foco em transformar a jornada acadêmica, a <span class="forteb">Bibliotec</span> foi idealizada para ser a sua biblioteca digital definitiva. Desde sua fundação, a Bibliotec tem se dedicado a oferecer um acervo vasto e de alta qualidade, com ferramentas de pesquisa avançadas e uma interface intuitiva. Nossa plataforma é a solução ideal para as necessidades de estudantes, oferecendo acesso ilimitado a livros, artigos e materiais de estudo essenciais para o seu sucesso.</p>
                <p>Nossa prioridade é o seu aprendizado. A <span class="forteb">Bibliotec</span> foi criada para simplificar a sua pesquisa, garantindo que você encontre o conhecimento que precisa de forma rápida e eficiente, com a transparência e profissionalismo que você merece.</p>
            </div>
            <div class="sobre-imagem">
                <img src="src/img/logo.png" alt="Logo da Bibliotec">
            </div>
        </section>

        <!-- MISSÃO, VISÃO E VALORES -->
        <section class="secao-missao">
            <h3>Missão, Visão e Valores</h3>
            <h2>Saiba o que nos move</h2>
            <div class="itens-missao">
                <div class="item-missao">
                    <h4><strong class="forte">MISSÃO</strong></h4>
                    <p>Atender personalizadamente a cada cliente, ouvir e apresentar a melhor solução com profissionalismo.</p>
                </div>
                <div class="item-missao">
                    <h4><strong class="forte">VISÃO</strong></h4>
                    <p>Liderar o mercado da administração condominial e gerar soluções aos nossos clientes e rentabilidade a seus negócios.</p>
                </div>
                <div class="item-missao">
                    <h4><strong class="forte">VALORES</strong></h4>
                    <p>Transparência, imparcialidade, especialização, inovação, competência e qualidade.</p>
                </div>
            </div>
        </section>
    </div>
    <div class="espaço"></div>
    <!-- Rodapé -->
    <footer class="footer">
        <p>&copy; 2025 Bibliotec. Todos os direitos reservados by Maiam Technologies</p>
    </footer>
</body>
</html>