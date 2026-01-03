<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./csspaginas/paginaperfil.css" rel="stylesheet">
    <title>Seu perfil</title>
</head>

 
<?php
session_start();

$id = $_SESSION['id'];
$nome_usuario = $_SESSION['nome'];
$senha = $_SESSION['senha'];
$email = $_SESSION['email'];
$idade = $_SESSION['idade'];
$logado = $_SESSION['logado'];
$cargo = $_SESSION['cargo'];

if (!isset($logado) || $logado !== true) {
    echo "<script language='javascript' type='text/javascript'>
    alert('Acesso negado! Entre na conta para acessar');window.location.href='entrarconta.php';</script>";
    die();
}

?>

<body>

<!-- NAVBAR -->
 <nav class="navbar">
  <div id="mySidenav" class="navbarladinho">
    <a class="" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="homepage.php"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
      </svg>
      <span class="generos-text">Página Inicial</span>
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
      <img class="navlogo" src="src/img/logodeitada.png" alt="Logo da Bibliotec">
      </div>

</nav>
  <!--  fim da Navbar --> 


  <main style="display:flex;align-items:center;justify-content:center;min-height:87.45vh;padding:0;">
    <section style="width:100%;max-width:900px;background:rgba(255,255,255,0.98);border-radius:16px;box-shadow:0 8px 32px rgba(57,59,181,0.15);padding:56px 0;display:flex;flex-direction:row;align-items:center;gap:0;">
      <!-- Avatar e nome -->
      <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;">
        <div style="width:160px;height:160px;border-radius:16px;background:#917bff;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(57,59,181,0.12);font-size:5.5rem;color:#fff;font-weight:700;">
          <?php 
          if(empty($_SESSION['caminhoimgperfil'])) {
            
          echo strtoupper(substr($nome_usuario,0,1));
          }

          else{
            echo "<img src=" .$_SESSION['caminhoimgperfil'] . " alt='Avatar do usuário' style='width:160px;height:160px;border-radius:16px;object-fit:cover;'/>";
          }
           ?>
          
        </div>
        <span style="font-size:2rem;font-weight:700;color:#393bb5;"><?php echo ($nome_usuario); ?></span>
        <span style="color:#917bff;font-size:1.1rem;">@<?php echo ($nome_usuario); ?></span>
            </div>
            <!-- Dados do usuário -->
            <div style="flex:2;display:flex;flex-direction:column;gap:28px;padding:0 48px;">
              <div style="font-size:2rem;font-weight:700;color:#393bb5; align-items: center; display:flex;justify-content:center;width:100%;"><?php echo ($cargo); ?></div>
        
        <div style="background:#e3e0fa;border-radius:8px;padding:20px 32px;box-shadow:0 1px 4px rgba(57,59,181,0.07);margin-bottom:0;">
          <label style="font-weight:600;color:#393bb5;">E-mail</label>
          <div style="font-size:1.15rem;color:#393bb5;"><?php echo ($email); ?></div>
        </div>
        <div style="background:#e3e0fa;border-radius:8px;padding:20px 32px;box-shadow:0 1px 4px rgba(57,59,181,0.07);margin-bottom:0;">
          <label style="font-weight:600;color:#393bb5;">Idade</label>
          <div style="font-size:1.15rem;color:#393bb5;"><?php echo ($idade); ?> anos</div> 
        </div>

        <!-- Seção Pedidos -->

        <?php 

        if($cargo == 'adm')
        echo"
        <div style='background:#fff7e6;border-radius:8px;padding:20px 32px;box-shadow:0 1px 4px rgba(57,59,181,0.07);margin-bottom:0;'>
          <label style='font-weight:600;color:#393bb5;'>Pedidos</label>
          <div style='font-size:1.15rem;color:#393bb5; margin-top:8px;'>
            <a href='pedidos.php' style='display:inline-block;background:#ff7043;color:#fff;padding:10px 16px;border-radius:8px;text-decoration:none;font-weight:700;'>Ver Pedidos</a>
          </div>
        </div>
        ";
        ?>
        <!-- fim da seção pedidos -->
        <div style="display:flex;gap:24px;width:100%;justify-content:flex-start;margin-top:24px;">
          <a href="bddeslogar.php" style="background:#393bb5;color:#fff;padding:16px 0;border:none;border-radius:8px;font-weight:700;font-size:1.1rem;cursor:pointer;text-decoration:none;transition:background 0.2s;width:45%;text-align:center;box-shadow:0 2px 8px rgba(57,59,181,0.10);">Logout</a>
          <a href="homepage.php" style="background:#393bb5;color:#fff;padding:16px 0;border:none;border-radius:8px;font-weight:700;font-size:1.1rem;cursor:pointer;text-decoration:none;transition:background 0.2s;width:45%;text-align:center;box-shadow:0 2px 8px rgba(57,59,181,0.10);">Voltar</a>
          
          <a href="editarperfil.php" style="background:#5a57d8;color:#fff;padding:16px 0;border:none;border-radius:8px;font-weight:700;font-size:1.1rem;cursor:pointer;text-decoration:none;transition:background 0.2s;width:45%;text-align:center;box-shadow:0 2px 8px rgba(57,59,181,0.10);">Alterar</a>
        </div>
            </div>
          </section>
        </main>
        <!-- Rodapé -->
    <footer class="footer">
        <p>&copy; 2025 Bibliotec. Todos os direitos reservados by Maiam Technologies</p>
    </footer>

</body>

</html>