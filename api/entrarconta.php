<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./csspaginas/entrarconta.css" rel="stylesheet">
    <title>Login</title>
</head>
<?php
session_start();
$_SESSION['logado']="false";
if(empty($_SESSION['strerrolog']) ){
   $_SESSION['strerrolog']="";
    $strerro = $_SESSION['strerrolog'];
}

else{
  $strerro = $_SESSION['strerrolog'];
}

?>


<body>

    <nav class="navbar">
      <button class="navbar-toggle" aria-label="Abrir menu" onclick="toggleNavbar()">☰</button>
      <ul class="nav-list">
        <li class="nav-list-item home-item">
          <a href="./index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
              <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
            </svg>
            <span class="home-text">Início</span>
          </a>
        </li>
        <li class="nav-list-item generos-item">
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
   <!-- final da Navbar -->    

    <div class="login-area">

       
 
        <div class="login-container">
            
        <h2>Entrar na Conta</h2>
        <form class="login-form" method="POST" action="BDentrarconta.php">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <strong class="erro"><?php echo $strerro; ?></strong>
        <p class="cadastro-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
    </div>

</body>
</html>