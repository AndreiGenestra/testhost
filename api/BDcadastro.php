<!-- TELA DE CONFIGURAÇÃO
 
Grupo MAIAM TECH - Allan Araujo, Andrei Genestra, Isabelle Lima, Milena Mazzo, Murilo Minghini
  Etec de Poá
 Salve como Upload.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./src/csspaginas/BDcadastro.css" rel="stylesheet">
    <title>Login</title>
</head>
<?php
session_start();
?>

<body>
 <!-- Começo da navbar -->
   <nav class="navbar">
      <button class="navbar-toggle" aria-label="Abrir menu" onclick="toggleNavbar()">☰</button>
      <ul class="nav-list">
        <li class="nav-list-item home-item">
          <a href="./index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
              <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
            </svg>
            <span class="home-text">Home</span>
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
    <!-- Navbar --> 

    <div class="login-area">

       
 <svg class="coroalogin"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1920" zoomAndPan="magnify" viewBox="0 0 1440 809.999993" height="1080" preserveAspectRatio="xMidYMid meet" version="1.2"><g id="2185f57ce3"><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 334.683594 446.0625 C 335.949219 440.15625 334.683594 433.40625 330.046875 427.078125 C 324.984375 420.328125 319.921875 413.578125 314.859375 406.828125 C 292.078125 365.910156 264.660156 327.101562 234.289062 290.824219 C 219.945312 273.953125 192.527344 293.355469 199.699219 312.339844 C 199.699219 315.714844 200.121094 319.929688 202.226562 323.726562 C 207.289062 333.851562 212.773438 343.554688 218.679688 353.257812 C 225.429688 409.78125 261.707031 460.824219 311.484375 487.402344 C 331.3125 497.945312 349.027344 477.277344 340.589844 458.292969 C 338.902344 454.074219 336.792969 450.28125 334.683594 446.0625 Z M 334.683594 446.0625 "/><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 585.679688 199.707031 C 586.523438 191.691406 581.882812 186.210938 575.976562 183.257812 C 575.554688 179.039062 575.132812 174.820312 574.710938 170.179688 C 572.601562 144.027344 533.792969 143.183594 533.792969 170.179688 C 533.792969 192.957031 533.792969 215.316406 533.792969 238.09375 C 526.621094 268.890625 524.089844 300.949219 524.089844 333.007812 C 522.824219 338.914062 521.558594 344.398438 520.292969 350.304688 C 519.871094 352.835938 523.246094 354.101562 524.511719 352.414062 C 525.355469 369.285156 527.042969 386.160156 528.730469 402.613281 C 530.839844 419.90625 559.945312 428.34375 562.898438 407.25 C 562.898438 406.410156 563.320312 405.144531 563.320312 404.300781 C 569.226562 401.769531 573.867188 395.863281 574.289062 387.425781 C 574.710938 375.191406 574.710938 362.539062 575.132812 350.304688 C 582.304688 347.773438 588.632812 341.445312 588.210938 332.585938 C 587.367188 301.792969 584.835938 271 581.882812 240.203125 C 583.148438 226.707031 584.414062 213.207031 585.679688 199.707031 Z M 585.679688 199.707031 "/><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 911.335938 199.707031 C 875.902344 260.03125 845.53125 321.617188 817.265625 385.316406 C 814.734375 390.800781 822.328125 395.863281 825.703125 390.378906 C 826.96875 388.269531 828.234375 385.738281 829.921875 383.628906 C 832.03125 391.222656 837.9375 397.550781 845.109375 400.082031 C 854.390625 409.78125 875.058594 409.78125 881.386719 392.488281 C 894.042969 357.476562 908.382812 322.882812 919.351562 287.027344 C 926.101562 270.578125 932.851562 254.546875 940.023438 238.515625 C 943.394531 231.347656 942.554688 224.175781 939.601562 218.691406 C 940.445312 216.582031 940.867188 214.894531 941.710938 212.785156 C 947.613281 194.644531 920.617188 184.101562 911.335938 199.707031 Z M 911.335938 199.707031 "/><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 1218.011719 406.410156 C 1216.746094 403.878906 1215.480469 401.347656 1213.371094 399.660156 C 1219.277344 394.175781 1219.277344 386.160156 1216.324219 380.253906 C 1217.589844 378.988281 1218.855469 377.722656 1219.699219 376.878906 C 1235.730469 361.695312 1214.214844 332.164062 1195.65625 345.664062 C 1166.546875 366.332031 1141.238281 391.222656 1120.566406 419.90625 C 1112.976562 428.765625 1105.382812 437.625 1098.632812 446.484375 C 1098.632812 446.484375 1098.210938 446.90625 1098.210938 446.90625 C 1097.367188 448.171875 1096.523438 449.015625 1095.679688 450.28125 C 1088.929688 458.714844 1083.023438 467.574219 1078.382812 476.855469 C 1075.851562 481.917969 1081.757812 489.933594 1087.242188 485.714844 C 1088.507812 484.871094 1089.351562 484.027344 1090.617188 483.183594 C 1092.726562 493.308594 1102.429688 500.054688 1112.976562 498.367188 C 1119.722656 502.164062 1128.160156 502.585938 1135.332031 495.835938 C 1161.484375 472.214844 1189.75 451.121094 1219.699219 432.984375 C 1229.402344 426.234375 1226.871094 410.625 1218.011719 406.410156 Z M 1218.011719 406.410156 "/><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 173.121094 582.3125 C 161.730469 578.941406 150.34375 575.566406 138.953125 572.191406 C 111.535156 550.675781 81.582031 537.601562 46.570312 532.539062 C 35.179688 530.851562 25.480469 538.863281 28.007812 551.097656 C 28.851562 555.316406 30.539062 559.113281 32.226562 562.488281 C 12.402344 559.535156 0.167969 587.796875 19.152344 598.34375 C 56.273438 619.015625 96.769531 632.933594 139.375 636.308594 C 150.765625 637.152344 157.09375 628.714844 158.355469 619.4375 C 161.730469 619.4375 164.683594 619.859375 168.058594 619.859375 C 189.996094 620.703125 193.371094 588.21875 173.121094 582.3125 Z M 173.121094 582.3125 "/><path style=" stroke:none;fill-rule:nonzero;fill:#917bff;fill-opacity:1;" d="M 1427.242188 606.359375 C 1417.121094 603.828125 1406.574219 604.25 1396.027344 605.515625 C 1396.027344 605.09375 1396.027344 604.671875 1396.027344 604.25 C 1401.089844 600.875 1403.621094 595.8125 1403.621094 590.75 C 1405.308594 589.90625 1406.996094 589.0625 1408.683594 588.21875 C 1425.132812 580.207031 1413.324219 554.472656 1396.449219 559.113281 C 1361.015625 567.972656 1327.691406 581.890625 1296.472656 599.609375 C 1287.617188 602.5625 1279.179688 605.515625 1270.320312 608.890625 C 1266.523438 610.15625 1264.835938 614.375 1265.679688 617.75 C 1263.992188 618.59375 1262.304688 619.4375 1260.617188 620.28125 C 1246.699219 627.449219 1253.445312 649.808594 1266.523438 650.652344 C 1268.210938 659.089844 1275.804688 666.683594 1286.773438 664.574219 C 1299.847656 662.464844 1312.082031 659.089844 1323.894531 654.449219 C 1336.125 651.496094 1348.359375 648.542969 1360.59375 646.011719 C 1382.949219 641.371094 1409.105469 640.949219 1429.773438 629.980469 C 1439.476562 624.917969 1437.789062 608.890625 1427.242188 606.359375 Z M 1427.242188 606.359375 "/></g></svg>
        <div class="login-container">

       
            
        <h2>Cadastro realizado com sucesso!</h2>
        <span> Volte para a página inicial e faça o login!</span>
        <br> <br> <br>
        <a href="entrarconta.php"><button class="btn-login">Voltar para o Login</button></a>
        
        
       
    </div>
    </div>


    <style>

     body{
         background-image: url("src/img/fundologin.png");
     }

         .navbar-logo {
    max-width: 200px;
    width: 100%;
    height: auto;
    display: block;
  
    
}

    .coroalogin {
        
        
        z-index: -1;
        max-height: 300px;
        min-height:300px; 
        min-width: 400px; ;
        max-width: 600px;
        
      
    }
        .login-area{


            width:100%;
            height: 80vh;
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

         .login-container {
            min-width: 400px; ;
            max-width: 600px;
            margin: 40px auto;
            background: #e3dfdf;
            border-radius: 8px;
            padding: 32px 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-items: center;
            position: relative;
            bottom:100px;
            z-index: 1;
        }

        .login-container h2 {
            margin-bottom: 18px;
            font-size: 1.4rem;
            font-weight: 600;
            color:rgb(98, 194, 117);
        }

        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            margin-bottom: 6px;
            font-weight: 500;
        }

        .login-form input {
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-login {
            background: var(--cor-primaria);
            max-width: 200px;
            min-width:auto;
            color: #fff;
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: var(--cor-gradiente);
        }

        .cadastro-link {
            margin-top: 14px;
            font-size: 0.95rem;
        }

        .cadastro-link a {
            color: #007bff;
            text-decoration: none;
        }

        .cadastro-link a:hover {
            text-decoration: underline;
        }
    </style>

</body>
</html>

<?php


$nome = $_POST['nome']; 
$email = $_POST['email'];
$idade = $_POST['idade'];
$senhausuario = $_POST['senha'];
$senhausuario2 = $_POST['senha2']; 
$check= $_POST['termos'];
$cargo = "usuario";

require_once('bd.php');
$mysql = new BancodeDados();
	$mysql -> conecta();

 $sqlstring = "select * from usuarios where email='$email' || nome='$nome' "  ;
    
	$result = @mysqli_query($mysql->conn, $sqlstring);
	$total = $result -> num_rows;
 
if($check != 1){
    {
      $_SESSION["strCadErro"] = " <p class='erro-cadastro'>  Você deve aceitar os termos de uso para se cadastrar. </p>";
      echo"<script language='javascript' type='text/javascript'>
          ;window.location.href='cadastro.php';
          </script>";
       
    }
  }
  else

  if($total==1){
    {
      $_SESSION["strCadErro"] = " <p class='erro-cadastro'>  Essa conta já existe. </p>";
      echo"<script language='javascript' type='text/javascript'>
          ;window.location.href='cadastro.php';
          </script>";
       
    }
  }
     elseif($senhausuario != $senhausuario2){
    {
      $_SESSION["strCadErro"] = " <p class='erro-cadastro'>  As senhas devem ser correspondentes. </p>";
      echo"<script language='javascript' type='text/javascript'>
          ;window.location.href='cadastro.php';
          </script>";
       
    }
  }
  elseif(strlen($senhausuario) < 20000){

       $stmt =$mysql->conn->prepare("INSERT INTO usuarios (nome, email, senha, idade, cargo, Data_Cadastro) VALUES (?, ?, ?, ?, ?, null)");
       $stmt->bind_param("sssis", $nome, $email, $senhausuario, $idade, $cargo);
        $stmt->execute();
        $stmt->close();
        
         $_SESSION["strCadErro"] = "";
         
        exit;
  }

 





// Verifica se o arquivo foi enviado


?>




