<!DOCTYPE html>

<html lang="pt-br" dir="ltr" data-bs-theme="auto">

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

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <link rel="stylesheet" href="./src/style.css">
     <link rel="stylesheet" href="./csspaginas/homepage.css">

    <link rel="script" href="script.js">

    <title>Sistema Bibliotec</title>

    <link href="./src/bootstrapcss/css/bootstrap.css" rel="stylesheet">

    <link href="./src/bootstrapIcons/bootstrap-icons.css" rel="stylesheet">
    <link href="./effects.js" rel="">

</head>

<!-- Adicione este botão para abrir o dropdown de tema -->


<body>
<?php if ($cargo == "adm"): ?>



<!-- Modal postar (flutuante) -->
<button id="abrirmodalpostar" class="btn-entraro position-fixed" style="right:20px;bottom:20px;z-index:1050;padding:12px 18px;border-radius:10px;box-shadow:0 6px 18px rgba(57,59,181,0.12);">Postar</button>

<div id="modalpostar" class="modal-fundo" style="z-index:9999;display:none;">
    <div class="modal-conteudo" style="min-width:600px;">
      <span class="fecharpostar" style="position:absolute;right:12px;top:8px;background:none;border:none;font-size:26px;cursor:pointer;color:#aaa;">&times;</span>
      <h2 style="color:var(--cor-primaria);margin-bottom:12px;">Nova postagem</h2>
      <form action="postagem.php" method="POST" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:12px;">
        <div style="display:flex;flex-direction:column;gap:6px;">
          <label for="titulo" style="font-weight:600;color:var(--cor-primaria);">Título</label>
          <input type="text" id="titulo" name="titulo" required style="padding:10px;border-radius:8px;border:1px solid #ccc;font-size:1rem;">
        </div>
        <div style="display:flex;flex-direction:column;gap:6px;">
          <label for="conteudo" style="font-weight:600;color:var(--cor-primaria);">Descrição</label>
          <input type="text" id="conteudo" name="conteudo" required style="padding:10px;border-radius:8px;border:1px solid #ccc;font-size:1rem;">
        </div>

        <!-- pegando a data, url e o id do usuário -->
         <input type="hidden" name ="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
         <input type="hidden" name="idusuario" value="<?php echo $id; ?>">
         <input type="hidden" name="datapostagem" value="<?php echo date('d/m/Y'); ?>">
         <input type="hidden" name="nomeusuario" value="<?php echo $nomeusuario; ?>">

         <input type="hidden" name="idcomunidade" value="2">

        <button type="submit" style="background:var(--cor-primaria);color:#fff;padding:12px 0;border:none;border-radius:8px;font-weight:600;font-size:1.1rem;cursor:pointer;text-decoration:none;transition:background 0.2s;width:100%;text-align:center;box-shadow:0 2px 8px rgba(57,59,181,0.10);">Postar</button>
      </form>
    </div>
</div>

<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var modalpostar = document.getElementById('modalpostar');
  var btnpostar = document.getElementById('abrirmodalpostar');
  var spanpostar = document.querySelector('.fecharpostar');

  btnpostar.onclick = function() {
    modalpostar.style.display = 'block';
  }

  spanpostar.onclick = function() {
    modalpostar.style.display = 'none';
  }

  window.onclick = function(event) {
    if (event.target == modalpostar) {
      modalpostar.style.display = 'none';
    }
  }
});
</script>

    </button>

</div>

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

   <a href="sugerirlivro.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-feather" viewBox="0 0 16 16">
          <path d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0 .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524zm3.346-3.357C9.594 3.147 6.045 6.8 3.149 10.678c.007-.464.121-1.086.37-1.806.533-1.535 1.65-3.415 3.455-4.976 1.807-1.561 3.746-2.36 5.31-2.68a8 8 0 0 1 1.564-.173" />
        </svg>
        <span class="generos-text">Sugira seu livro!</span>
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
  <!--  fim da Navbar --> 
   

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">

        <symbol id="check2" viewBox="0 0 16 16">

            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>

        </symbol>

        <symbol id="circle-half" viewBox="0 0 16 16">

            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>

        </symbol>

        <symbol id="moon-stars-fill" viewBox="0 0 16 16">

            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>

            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>

        </symbol>

        <symbol id="sun-fill" viewBox="0 0 16 16">

            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>

        </symbol>

    </svg>


    <!-- Dropdown de seleção de tema -->

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">

        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">

            <li>

                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">

                    <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#circle-half"></use></svg>

                    Normal

                    <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>

                </button>

            </li>

            <li>

                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">

                    <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#moon-stars-fill"></use></svg>

                    Escuro

                    <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>

                </button>

            </li>

            <li>

                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">

                    <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#sun-fill"></use></svg>

                    Claro

                    <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>

                </button>

            </li>

        </ul>

    </div>


    <!-- Container principal do conteúdo da página -->

    <div class="container">

        <div class="row align-items-center py-4">

            <div class="col-12 d-flex justify-content-between align-items-center">

                <a class="saudacao" href="paginaperfil.php" style="white-space: nowrap;">

                    Bem-vindo (a) <span style="font-weight:bold;"><?php echo "$nomeusuario"; ?></span>!

                </a>

               

                <img class="navlogo" src="src/img/logodeitada.png" alt="Logo da Bibliotec">

            </div>

        </div>

    </div>


    <main class="container">

        <!-- Bloco de destaque principal -->

        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary destaque">

            <div class="col-lg-6 px-0">

                <h1 class="display-4 fst-italic">Destaques da Bibliotec!</h1>

                <p class="lead my-3">Aventuras perigosas, romances melancólicos... Descubra seu próximo livro favorito!</p>

                <p class="">

                    <a style="color: #333bb5 !important; text-decoration: none; cursor: pointer;" class="text-body-emphasis fw-bold lead" href="busca.php?nomelivro=">Acessar</a>

                </p>

             
        <div id="modalalterar" class="modal-fundo">
    <div class="modal-conteudo">
      <span class="fechar">&times;</span>
     <form action="princUpload.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="titulo" style="font-weight: 600; color: var(--cor-primaria);">Título</label>
          <input type="text" id="titulo" name="titulo" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="img" style="font-weight: 600; color: var(--cor-primaria);">Background</label>
          <input type="file" id="img" name="img" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        <div style="display: flex; flex-direction: column; gap: 6px;">
          <label for="sinopse" style="font-weight: 600; color: var(--cor-primaria);">Descrição</label>
          <input type="text" id="sinopse" name="sinopse" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem;">
        </div>
        
      
        <button type="submit" style="background: var(--cor-primaria); color: #fff; padding: 12px 0; border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; cursor: pointer; text-decoration: none; transition: background 0.2s; width: 100%; text-align: center; box-shadow: 0 2px 8px rgba(57,59,181,0.10);">Alterar</button>
        
      </form>
    </div>
  </div>
<script> // Script para abrir e fechar o modal de alterar
document.addEventListener("DOMContentLoaded", function() {
  var modalalterar = document.getElementById("modalalterar");
  var btn = document.getElementById("abrirmodalalterar");
  var span = document.querySelector(".fechar");

  btn.onclick = function() {
    modalalterar.style.display = "block";
  }

  span.onclick = function() {
    modalalterar.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modalalterar) {
      modalalterar.style.display = "none";
    }
  }
});
</script>

           </div>

        </div>


        <div class="containero">
        <!-- Cards de postagens em destaque -->

        <div class="row mb-2">

            <!-- Card 1 -->

            <div class="col-md-6">

                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                    <div class="col p-4 d-flex flex-column position-static">

                        <strong class="d-inline-block mb-2 text-primary-emphasis">Poesia</strong>

                        <h3 class="mb-0">Claro Enigma</h3>

                        <div class="mb-1 text-body-secondary">14 de outubro</div>

                        <p class="card-text mb-auto">Claro Enigma marca um momento de virada na poesia de Carlos Drummond de Andrade.</p>

                        <a style="color: #333bb5; text-decoration: none;" href="livroromance" class="icon-link gap-1 icon-link-hover stretched-link">
                            Continue lendo

                            <svg class="bi" aria-hidden="false"><use xlink:href="#chevron-right"></use></svg>

                        </a>

                    </div>

                    <div class="col-auto d-none d-lg-block">

                   <img class="bd-placeholder-img" src="src/img/claroEnigma.jpg" alt="Logo da Bibliotec" height="250" width="200">

                    </div>

                </div>

            </div>

           

            <!-- Card 2 -->

            <div class="col-md-6">

                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative titulo-card">

                    <div class="col p-4 d-flex flex-column position-static">

                        <strong style="color: #333bb5;" class="d-inline-block mb-2 text-success-emphasis">Romance</strong>

                        <h4 class="mb-0">Memórias Póstumas de Brás Cubas</h4>

                        <div class="mb-1 text-body-secondary">13 de outubro</div>

                        <p class="mb-auto">"Memórias Póstumas de Brás Cubas" é a história de um rico do século XIX.</p>

                        <a style="color: #333bb5; text-decoration: none;" href="livroromance" class="icon-link gap-1 icon-link-hover stretched-link">

                            Continue lendo

                            <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"></use></svg>

                        </a>

                    </div>

                    <div class="col-auto d-none d-lg-block">

                     <img class="bd-placeholder-img" src="src/img/memorias.png" alt="Logo da Bibliotec" height="250" width="200">

                    </div>

                </div>

            </div>

        </div>


        <!-- Seção de artigos e postagens -->

        <div class="row g-5">

            <div class="col-md-8">

                <h3 class="pb-4 mb-4 fst-italic border-bottom">

                    Da Maiam Technologies para você

                </h3>

               

                <article class="blockquote">

                    <h2 class="display-5 link-body-emphasis mb-1">O Poder da Palavra Compartilhada: Por Que Você Precisa de uma Comunidade Literária</h2>

                    <p class="blog-post-meta">1 de agosto de 2025 por Murilo Minghini dos Santos</p>

                    <p>Muito mais do que apenas um grupo de leitores, uma comunidade literária é um <strong>ecossistema vibrante</strong> onde o amor pelos livros se transforma em conhecimento, amizade e novas descobertas.</p>

                    <hr>

                    <p>Você já terminou um livro que te transformou e sentiu aquela necessidade urgente de falar sobre ele com alguém? De debater o final, analisar a motivação dos personagens ou até mesmo criticar a tradução? Se sim, você sabe que a leitura, apesar de ser um ato solitário, <strong>floresce quando é compartilhada.</strong> É aí que entram as <strong>comunidades literárias.</strong> Onde o ato solitário da leitura se torna uma jornada coletiva, as comunidades literárias oferecem <strong>perspectivas que jamais encontraríamos sozinhos</strong>. Ao discutir um romance, cada membro traz sua bagagem de vida, suas experiências e sua interpretação única, desvendando camadas de significado que poderiam ter passado despercebidas. O que para você era apenas um conflito de enredo, para outro pode ser uma metáfora social profunda. Essa riqueza de visões amplia não só a sua compreensão do texto, mas também a sua empatia pelo mundo, ensinando a ver além da sua própria lente.</p>

             </blockquote>

                    <blockquote class="blockquote">

                        <h3>Conhecimento Compartilhado e a Curva de Aprendizado Acelerada</h3>

                        <p>Uma das maiores vantagens de fazer parte de uma comunidade literária é o <strong>acesso a um vasto leque de conhecimento </strong>e a aceleração da sua curva de aprendizado. Imagine que você está tentando se aprofundar em um gênero novo, como a ficção científica soviética, mas não sabe por onde começar. Em um grupo, você rapidamente receberá recomendações de clássicos essenciais, autores contemporâneos importantes e, o que é melhor, contexto histórico e análises já prontas de quem já percorreu esse caminho.</p>

                        <p>Não se trata apenas de receber dicas de leitura; <strong> é sobre aprender a ler melhor. </strong>As discussões em grupo frequentemente abordam <strong>teoria literária de forma acessível</strong>: o que é um narrador não confiável, a estrutura de um soneto, o uso de flashback. Você absorve<strong> técnicas de análise e crítica </strong>sem sequer perceber, elevando o nível da sua própria <strong>leitura solitária.</strong> O insight de um membro sobre o simbolismo das cores em um livro pode ser a chave que faltava para você começar a <strong>enxergar esses padrões</strong> em todas as suas leituras futuras.</p>

                    </blockquote>

                   

                    <h3>Motivos para estar em uma comunidade literária</h3>

                    <p>Uma comunidade literária se faz importante pois estimula a criatividade, colaboração, cooperação e camaradagem.</p>

                    <p>Nossa comunidade é composta por nossos usuários e é completamente personalizável. Alguns dos principais motivos para fazer parte de uma são:</p>

                    <ol>

                        <li>Se sentir incluso em uma comunidade;</li>

                        <li>Expansão de conhecimento;</li>

                        <li>Estímulo à criatividade;</li>

                        <li>Desenvolvimento de habilidades sociais.</li>

                    </ol>
             </article>

               
              <?php 
              
              $sqlstringpost = "SELECT * FROM postagem p JOIN usuarios u ON p.idusuario = u.id ORDER BY p.datapostagem DESC LIMIT 3"; 
              $result = @mysqli_query($mysql->conn, $sqlstringpost);
              while ($post = mysqli_fetch_assoc($result)){
                 
              
                echo"<article class='blog-post'>

                    <h2 class='display-5 link-body-emphasis mb-1'>{$post['titulo']}</h2>

                    <p class='blog-post-meta'>{$post['datapostagem']} por <a href='#'>{$post['nome']}</a></p>

                    <p>{$post['Conteudo']}</p>

                   ";

                    if($cargo=="adm"){
                    echo"<form action='deletar.php' method='POST'>
                    <input type='hidden' name='idpostagem' value='{$post['ID_Postagem']}'> 
                    <input type='hidden' name='tipo' value='postagem'>
                    <button type ='submit' style='background-color: red;
                     color:white; text-decoration: none; padding: 3px; border: none;'> Excluir </button>
                    </form>"; 
                    }


                echo"</article>";
              }
                ?>


            </div>

           

            <div class="col-md-4">

                <div class="position-sticky" style="top: 2rem;">

                    <div class="p-4 mb-3 bg-body-tertiary rounded">

                        <h4 class="fst-italic">Sobre</h4>

                        <p class="mb-0">Com foco em transformar a jornada acadêmica, a Bibliotec foi <strong>idealizada para ser a sua biblioteca digital definitiva</strong>. Desde sua fundação, a Bibliotec tem se dedicado a oferecer um <strong>acervo vasto e de alta qualidade</strong>, com ferramentas de pesquisa avançadas e uma interface intuitiva. Nossa plataforma é a <strong>solução ideal</strong> para as necessidades de estudantes, oferecendo <strong>acesso ilimitado</strong> a livros, artigos e materiais de estudo essenciais para o seu sucesso.</p>

                        <br><a style="color: #333bb5; text-decoration: none;"href="sobrenos.php"> Ler mais </a>

                    </div>

                   
                 
                    <div>


                        <ul class="list-unstyled">

                            <li>

                            <h1> Rank  </h1>
                         <?php
                         $i=0;
                   $sqlstringpontos = "SELECT * FROM pontos p JOIN usuarios u ON p.id_usuario = u.id ORDER BY p.pontos DESC LIMIT 3"; 
              $resultpontos = @mysqli_query($mysql->conn, $sqlstringpontos);
                  
                  
                  while ($ponto = mysqli_fetch_assoc($resultpontos)): ?>
                                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?php echo"paginaperfiloutros.php?nome_usuario={$ponto['nome']}";?>">

                                    <img src="<?php echo"{$ponto['caminhoimgperfil']}";?>" class="bd-placeholder-img " width="60px" height="60px" alt='Avatar do usuário' style='width:60px;height:60px;border-radius:16px;object-fit:cover;' 
                                    />
                                    

                                    <div class="col-lg-8">
                                    <!-- Local do Rank -->
                                    

                                    

                                        <h6 class="mb-0">
                                          
                                        <?php
                                        
                                        $i++;
                                        echo"{$ponto['nome']}";


                                        ?>
                                        </h6>

                                        <small class="text-body-secondary">
                                          <?php
                                          if($i==1){
                                          echo " &#129351;{$i}º Lugar - {$ponto['pontos']} pontos";
                                          }
                                          else if($i==2){
                                            echo " &#129352;{$i}º Lugar - {$ponto['pontos']} pontos";
                                          }
                                          else if($i==3){
                                            echo " &#129353;{$i}º Lugar - {$ponto['pontos']} pontos";
                                          }
                                          ?>
                                          </small>

                                    </div>

                                </a>
                    <?php endwhile; ?>
                            
                            </li>

                        </ul>

                    </div>
                    
                   

                   

                   

                    <div class="p-4">

                        <h4 class="fst-italic">Em outro lugar</h4>

                        <ol class="list-unstyled">

                            <li> <a style="text-decoration: none; color: #393bb5;" href="#">Email</a></li>

                            <li> <a style="text-decoration: none; color: #393bb5;"href="#">Instagram</a></li>

                            <li> <a style="text-decoration: none; color: #393bb5;"href="#">Twitter</a></li>

                            

                        </ol>

                    </div>

                </div>

            </div>

           

            <div class="finterna">

                

                <a class="link"href="#"> Voltar ao topo </a>

            </div>

        </div>

    </main>


  

</body>

</html>