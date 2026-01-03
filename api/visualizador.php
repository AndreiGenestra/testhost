<!DOCTYPE html>
<html lang="pt-br">
    <?php
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

$caminho = $_POST['caminho'];
$nomelivro = $_POST['nomelivro'];
$idlivro = $_POST['id'];



require_once('bd.php');
$mysql = new BancodeDados();
$mysql -> conecta();
$sqlstring = "select * from livros where id=$idlivro"; 
$result = @mysqli_query($mysql->conn, $sqlstring);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nomelivro; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="./csspaginas/visualizador.css">
    <style>
        /* Estilo para centralizar o iframe */
        .iframe-container {
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            height: 600px; /* Altura do contêiner */
            margin: 20px 0; /* Margem superior e inferior */
        }

       
    </style>
</head>


<body>
  


    <!-- modo "claro"
    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
        <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#circle-half"></use></svg>
        Claro
        <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
    </button>-->
  



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
      <button class="navbar-toggle" aria-label="Abrir menu" onclick="toggleNavbar()">☰</button>
      <div class="search-area">
        <form class="search-form" action="busca.php" method="get">
          <input type="text" style="align-items: center;" id="nomelivro" name="nomelivro" class="search-input" placeholder="Pesquisar...">
          <button type="submit" class="search-btn" id="bolalupa"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" id="lupa">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </form>
      </div>
       <img class="navbar-logo" src="src/img/logodeitada.png" alt="Logo da Bibliotec">
    </nav>


<div class="container mt-5" style="background-color: #fffdfdff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); text-align: center;">
        <div class="row">
            <div class="col-12">
                <h2><?php echo $nomelivro ?></h2>
                <p>Veja o conteúdo do livro abaixo:</p>
                <p style="display:none;">Pontos de Leitura: <span id="contador">0</p></h1>

    <script>
        // variáveis vindas do PHP
        const idLivro = <?php echo json_encode($idlivro); ?>; // conversão para valores que podem entrar no javascript
        const idUsuario = <?php echo json_encode($id); ?>;

        // contador simples
        let contador = 0;
        const intervaloMS = 5000; // 5 segundos

        const elContador = document.getElementById('contador');

        function incrementar() {
            contador++;
            if (elContador) elContador.textContent = contador;
        }

        const timer = setInterval(incrementar, intervaloMS); // definindo intervalo para cada vez que vai incrementear

        // envia pontos ao servidor usando navigator.sendBeacon 
        function enviarPontos() {
            if (contador <= 0) return;
            // preparar payload urlencoded
            const params = new URLSearchParams();
            params.append('id_livro', idLivro);
            params.append('id_usuario', idUsuario);
            params.append('pontos', contador);

            const url = 'salvarpontos.php';
            if (navigator.sendBeacon) {
                const blob = new Blob([params.toString() /* aqui ele manda os paramatros do contador e do id livro pro salvar pontos*/], { type: 'application/x-www-form-urlencoded' });
                navigator.sendBeacon(url, blob);
            } else {
                // fallback para enviar caso o navegador nao tenha sendBeacon
                navigator.fetch(url, { method: 'POST', body: params, keepalive: true }).catch(()=>{});
            }
            // zerar contador para evitar envios duplicados
            contador = 0;
        }

        // eventos para enviar quando a aba for escondida ou o usuário sair
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                enviarPontos();
            }
        });
        window.addEventListener('beforeunload', function() {
            enviarPontos();
        });
    </script>
            </div>
        </div>
    </div>
    
    <div class="iframe-container">
        <?php
        echo "<iframe src='pdf.js/web/viewer.html?file=http://localhost/tccgit/prototipo/{$caminho}#tooglebar=0' style= 'width: 85%; height: 800px; margin-top: 20%;' ></iframe>";
        ?>     
    </div>

    <br>
   



</body>
</html>