<!DOCTYPE html>
<html lang="pt-br">
    <?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {

    echo "<script language='javascript' type='text/javascript'>

    alert('Acesso negado! Entre na conta para acessar');window.location.href='entrarconta.php';</script>";

    die();

}


$id = $_SESSION['id'];

$nomeusuario = $_SESSION['nome'];

$senha = $_SESSION['senha'];

$email = $_SESSION['email'];

$idade = $_SESSION['idade'];
$cargo = $_SESSION['cargo'];

require_once('bd.php');
$mysql = new BancodeDados();
$mysql -> conecta();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./csspaginas/entrarconta.css" rel="stylesheet">
    <title>Login</title>
</head>
<style> 

/* Cards e containers */
.card, .bg-body-secondary, .bg-body-tertiary, .destaque, .container, .containero, .login-container {
  border-radius: 12px;
  transition: background 0.3s, color 0.3s;
  
}
.titulo-card{
    background-color: none;
    color: var(--cor-lead);
}

.destaque{
    width: 100%;
    margin: auto;
    background: var(--destaque);
    border-radius: 8px;
    padding: 32px 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-items: center;
    position: relative;
    
}
/* Botões */
.btn, .btn-primary, .btn-outline-primary, .btn-login, .home-btn {
  border: none;
  border-radius: 6px;
  transition: background 0.2s, color 0.2s;
}


/* Footer */
footer, .finterna {
  padding: 1rem;
  text-align: center;
  margin-top: 2rem;
  border-radius: 0 0 12px 12px;
}

/* Dropdown de tema */
.bd-mode-toggle .dropdown-menu {
  
  border-radius: 10px;
}
.bd-mode-toggle .dropdown-item.active, .bd-mode-toggle .dropdown-item:active {
 
  color: #fff !important;
}
.bd-mode-toggle .dropdown-item:hover {
 
  color: #fff !important;
}
.modal-fundo {
  display: none; /* Escondido por padrão */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
}

/* Caixa do modal */
.modal-conteudo {
  background-color: white;
  margin: 10% auto;
  padding: 20px;
  border-radius: 10px;
  min-width: 600px;
  position: relative;
}

/* Botão de fechar */
.fechar {
  position: absolute;
  top: 8px;
  right: 10px;
  color: #aaa;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
}

.fechar:hover {
  color: black;
}
</style>



<body>

    <nav class="navbar">
  <div id="mySidenav" class="navbarladinho">
    <a class="" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="homepage.php"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
      </svg>
      <span class="generos-text">Pagina Inicial</span>
    </a>
    
    
    
    <a href="sobrenos.php"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
        <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
      </svg>  
      <span class="generos-text">Sobre Nós</span>
    </a>

    <a href="paginaperfil.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
      </svg> 
      <span class="generos-text">Perfil</span>
    </a>

      <div class="dropdown">
        <a class="dropbtn generos-text" href="busca.php?nomelivro=">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
          </svg>  
        Livros</a>
          <div class="dropdown-content">
            <a href="livropoesias.php">Poesia</a>
            <a href="livroromance.php">Romance</a>
            <a href="livromisterio.php">Mistério</a>
            <a href="livrofantasia.php">Fantasia</a>
            <a href="livroficcao.php">Ficção Científica</a>
          </div>
    </div>
  </div>

  <div class="menuo"> <span class="tresrisco"  style="font-size:30px;cursor:pointer;margin-left:50px;" onclick="openNav()">&#9776;</span> </div>
  </div>

  <script>
  function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
  }
  </script> 
      <div class="search-area">
        <form class="search-form" action="busca.php" method="get">
          <input type="text" style="align-items: center;" id="nomelivro" name="nomelivro" class="search-input" placeholder="Pesquisar...">
          <button type="submit" class="search-btn" id="bolalupa"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" id="lupa">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </form>
      </div>
      <div class="col-4 d-flex justify-content-end align-items- header-1">
         <?php 
          if(empty($_SESSION['caminhoimgperfil'])) {
       echo" <a style='color: white; border: solid 1px white;' class='btn icon' href='paginaperfil.php'>"; 
        
            
          echo strtoupper(substr($nomeusuario,0,1));
          }

          else{
            echo" <a style='color: white; border: none;' class='btn icon' href='paginaperfil.php'>"; 
            echo "<img src=" .$_SESSION['caminhoimgperfil'] . " alt='Avatar do usuário' style='width:30px;height:30px;border-radius:16px;object-fit:cover;'/>";
          }
           ?> <!-- Ícone de perfil --></a> 
      </div>

</nav>
   <!-- final da Navbar -->    

      <div class="login-area">
    <div class="login-container" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(57,59,181,0.10); padding: 32px 24px; max-width: 500px; width: 100%; min-height: 700px;max-height: 1000px; overflow-y: auto;">
      <h1 style="color: var(--cor-primaria); font-size: 2rem; font-weight: 700; margin-bottom: 18px; text-align:center;">Sugira seu livro</h1>
      <h4 style="text-align:center"> futuramente ele pode ser escolhido pra compor a biblioteca! </h4>
      <?php if (isset($_GET['sucesso'])):
        echo"<p style='color: green; margin: auto;'>Arquivo enviado com sucesso!</p>";
      endif; ?> 
      <form action="princuploadpedido.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="titulo" style="font-weight: 600; color: var(--cor-primaria);">Título</label>
          <input type="text" id="titulo" name="titulo" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="img" style="font-weight: 600; color: var(--cor-primaria);">Imagem</label>
          <input type="file" id="img" name="img" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="sinopse" style="font-weight: 600; color: var(--cor-primaria);">Sinopse</label>
          <input type="text" id="sinopse" name="sinopse" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label for="autor" style="font-weight: 600; color: var(--cor-primaria);">Autor do livro</label>
            <input type="text" id="autor" name="autor" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;" placeholder="Autor do livro">
          <label for="genero" style="font-weight: 600; color: var(--cor-primaria);">Gênero do livro</label>
          <?php 
           echo"<input type='hidden' id='url' name='url' value='{$_SERVER['REQUEST_URI']}'>"; 
          ?>        
          

          <select name="genero" id="genero" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
            <option value="">Selecione...</option>
            <option value="1">Poesia</option>
            <option value="2">Romance</option>
            <option value="3">Mistério</option>
            <option value="4">Ficcao</option>
            <option value="5">Fantasia</option>
          </select>
        </div>
       <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="img" style="font-weight: 600; color: var(--cor-primaria);">Arquivo do livro</label>
          <input type="file" id="livro" name="livro" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <input type="hidden" id="tipo" name="tipo" value="pedido">
        <button type="button" class="btn-aviso" onclick="abrirModal()" style="background: var(--cor-primaria); color: #fff; padding: 12px 0; border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; cursor: pointer; text-decoration: none; transition: background 0.2s; width: 100%; text-align: center; box-shadow: 0 2px 8px rgba(57,59,181,0.10); margin-bottom: 12px;">Aviso</button>

        <div id="modalAviso" class="modal-fundo">
          <div class="modal-conteudo">
            <span class="fechar" onclick="fecharModal()">&times;</span>
            <h4>Ao enviar um livro para esta plataforma, o usuário declara estar ciente de que somente obras de domínio público ou de autoria própria podem ser publicadas.
      <br><br>O envio de materiais que violem direitos autorais constitui infração aos Termos de Uso e poderá resultar em remoção do conteúdo, suspensão da conta e demais medidas cabíveis.
      <br><br>O usuário também reconhece que, ao postar qualquer livro no site, o conteúdo se tornará público e acessível aos demais usuários.
      <br><br>A partir do momento em que o material é disponibilizado publicamente, não é de responsabilidade da empresa qualquer uso indevido, cópia ou distribuição realizada por terceiros, cabendo exclusivamente ao usuário avaliar os riscos antes da publicação.
      Ao prosseguir com o envio, o usuário aceita e concorda integralmente com estas condições.</h4>
          </div>
        </div>

        
        <button type="submit" style="background: var(--cor-primaria); color: #fff; padding: 12px 0; border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; cursor: pointer; text-decoration: none; transition: background 0.2s; width: 100%; text-align: center; box-shadow: 0 2px 8px rgba(57,59,181,0.10);">Enviar</button>

        <script>
        function abrirModal() {
          document.getElementById("modalAviso").style.display = "block";
        }

        function fecharModal() {
          document.getElementById("modalAviso").style.display = "none";
        }

        window.onclick = function(event) {
          var modal = document.getElementById("modalAviso");
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
        </script>
      </form>
    </div>

</body>
</html>