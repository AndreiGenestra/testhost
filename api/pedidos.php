<!DOCTYPE html>
<html>
  <?php
        session_start();

  ?>
<head>
    <title>Pedidos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/style.css">
    <meta http-equiv="refresh" content="10">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            margin-bottom: 24px;
        }
        th, td {
            padding: 12px 10px;
            text-align: center;
        }
        th {
            background: #5537db;
            color: #fff;
            font-size: 1.1em;
            letter-spacing: 1px;
        }
        tr:nth-child(even) {
            background: #f5f5f5;
        }
        tr:hover {
            background: #ecebff;
        }
        .voltar-link {
            margin-top: 18px;
            display: inline-block;
            color: #fff;
            background: #5537db;
            padding: 10px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 2px 8px #0001;
            transition: background 0.2s;
        }
        .voltar-link:hover {
            background: #2f00ff;
        }
        .search-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        th.sinopse-col, td.sinopse-col {
            width: auto;
            max-width: 800px;
            min-width: 300px;
            word-break: break-word;
            white-space: pre-line;
            text-align: left;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;      /* Centraliza tudo horizontalmente */
            justify-content: flex-start;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
            background: #f8f8ff;
            border-radius: 12px;
            box-shadow: 0 4px 24px #00000010;
        }

        .container > h1 {
            text-align: center;
            width: 100%;
            margin-bottom: 24px;
        }

        .container table {
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            /* Remove qualquer margin-top/margin-bottom se quiser */
        }

        .sinopse-anim {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(.4,0,.2,1), padding 0.3s;
            padding: 0 0;
        }
        .sinopse-anim.open {
            max-height: 500px; /* ajuste conforme necessário */
            padding: 8px 0;
        }
        .mostrar-btn {
            background: var(--cor-primaria, #393bb5);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 22px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 2px 8px #393bb520;
            transition: background 0.2s, transform 0.2s;
            outline: none;
            display: inline-block;
        }
        .mostrar-btn:hover {
            background: var(--cor-secundaria, #917bff);
            color: #fff;
            transform: scale(1.05);
        }
        .formulario {
            width: auto;
            max-width: none;        /* permite o container crescer se necessário */
            margin: 0 auto;         /* centraliza horizontalmente */
            background: transparent;
            padding: 0;
            box-sizing: border-box;
            overflow: visible;      /* sem scroll horizontal no container */
        }

        /* tabela usa largura automática e fica centralizada */
        .formulario table {
            width: auto;            /* não força 100% que causava overflow */
            max-width: 100%;        /* evita ultrapassar a largura da viewport */
            margin: 0 auto;
            border-collapse: collapse;
            table-layout: auto;     /* colunas se ajustam conforme conteúdo */
        }

        /* permitir quebra natural de texto para evitar deslocamentos */
        .formulario th,
        .formulario td {
            padding: 12px 10px;
            text-align: center;
            vertical-align: middle;
            white-space: normal;    /* permite quebra de linhas para caber na tela */
            word-break: break-word; /* evita juntar palavras sem quebra */
        }

        /* ajustar larguras desejadas por coluna (ajuste os valores se necessário) */
        .formulario th:nth-child(1),
        .formulario td:nth-child(1) { width: 100px; }   /* Código */
        .formulario th:nth-child(2),
        .formulario td:nth-child(2) { width: 200px; }  /* Título */
        .formulario th:nth-child(3),
        .formulario td:nth-child(3) { width: auto; max-width: 600px; text-align:left; } /* Sinopse */
        .formulario th:nth-child(4),
        .formulario td:nth-child(4) { width: 110px; }  /* Imagem */
        .formulario th:nth-child(5),
        .formulario td:nth-child(5) { width: 120px; }  /* Gênero */
        .formulario th:nth-child(6),
        .formulario td:nth-child(6) { width: 140px; }  /* Autor */
        .formulario th:nth-child(7),
        .formulario td:nth-child(7) { width: 110px; }  /* PDF */
        .formulario th:nth-child(8),
        .formulario td:nth-child(8) { width: 110px; }  /* Apagar (apenas se existir) */

        /* mantém botão e imagens visíveis sem expandir demais */
        .formulario img { max-width: 100px; height: auto; display:block; margin:0 auto; }
        .btn-entraro { box-sizing: border-box; }

        /* animação de sinopse continua */
        .sinopse-anim { max-height: 0; overflow: hidden; transition: max-height .4s; padding:0; }
        .sinopse-anim.open { max-height: 800px; padding: 8px 0; }

        /* ...existing code... */
    </style>
</head>
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
        <a class="btn icon" href="paginaperfil.php"><i class="bi bi-person-circle"></i></i> <!-- Ícone de perfil --></a>
        <img class="navlogo" src="src/img/logodeitada.png" alt="Logo da Bibliotec">
      </div>
</nav>
  
  <!--  fim da Navbar --> 
<div class="container">
    <h1 class="titulo-sessao">Lista de pedidos</h1>
    <div class="formulario">
       
        
        <?php

        require_once('bd.php');
        $mysql = new BancodeDados();
        $mysql->conecta();
        $sqlstring = 'SELECT * FROM PEDIDO ORDER BY datapedido DESC';
        
        $query = @mysqli_query($mysql->conn, $sqlstring);


       
        echo "<table style='margin:auto;'>";
        echo "<tr>
            <th width='30px'>Código livro</th>
            <th width='100px'>titulo</th>
            <th class='sinopse-col'>sinopse</th>
            <th width='100px'>imagem</th>
            <th width='100px'>genero</th>
            <th width='100px'>autor</th>
            <th width='100px'>PDF</th>";
            
            
            if ($_SESSION['cargo']=="adm"){
            echo"
            <th width='100px'>Apagar</th>";
            }
           echo" <th width='100px'>Postar</th>";
          echo"</tr>";
          // mostra a tabela dos livros encontrados

        while($dados=mysqli_fetch_array($query))
        {
            $idLivro = $dados['id_pedido'];

            $sqlstringGenero = "SELECT classificacao FROM genero WHERE id_genero = {$dados['id_genero']}";
            $queryGenero = @mysqli_query($mysql->conn, $sqlstringGenero);
            $dadosgenero=mysqli_fetch_array($queryGenero);
            echo "<tr>";
            echo "<td align='center'>". $dados['id_pedido']."</td>";
            echo "<td align='center'><b>". $dados['titulo']."</b></td>";
            // Sinopse escondida por padrão, com animação
            echo "<td class='sinopse-col'>
                    <div id='sinopse-$idLivro' class='sinopse-anim'><b>". nl2br(htmlspecialchars($dados['sinopse'])) ."</b></div>
                    <button type='button' class='mostrar-btn' onclick=\"toggleSinopse('$idLivro', this)\">Mostrar mais</button>
                  </td>";
            echo "<td align='center'><b> <img src='{$dados['caminhoimg']}' alt='Capa do Livro' style='width:80px; height:120px; object-fit:cover; border-radius:8px; margin:16px; box-shadow:0 2px 8px #00000040;'/>"."</b></td>";
            echo "<td align='center'><b>". $dadosgenero['classificacao']."</b></td>";
            echo "<td align='center'><b>". $dados['autor']."</b></td>";
            echo "<td style='padding:0;'>";
                      
            echo"<form action='visualizador.php' method='POST'>
            <input type='hidden' id='id' name='id' value='{$dados['id_pedido']}'>
            <input type='hidden' id='nomelivro' name='nomelivro' value='{$dados['titulo']}'>
            <input type='hidden' id='caminho' name='caminho' value='{$dados['caminho']}'>
            
            ";
            echo "<button type='submit' class='btn-entraro' style='background:#fff;color:#393bb5;font-weight:600;box-shadow:0 2px 8px #393bb520; min-width:100px; text-align:center;'>Ler</button>";

            echo "</form>";
               echo"</td>";
                   if ($_SESSION['cargo']=="adm"){
                    echo "<td style='padding:0px;'>
                     <div style='display:flex; justify-content:center; align-items:center; height:100%;'>";
                echo"<form action='deletarpedido.php' method='POST' style='margin:0; padding:0; display:inline; border:none;'>"; 

                  echo"<li class='list' style='list-style:none;'>";
                  
                echo"<input type='hidden' id='id' name='id' value='{$dados['id_pedido']}'>"; 

                

                 echo"<input type='hidden' id='caminho' name='caminho' value='{$dados['caminho']}'>"; 

                  echo"<input type='hidden' id='caminhoimg' name='caminhoimg' value='{$dados['caminhoimg']}'>
                  
                  "; 

                
                echo"<button id='deletar' class='btn-entraro' style='background:#e81515ff;color:#fff;font-weight:600;box-shadow:0 2px 8px #393bb520; min-width:100px; text-align:center; display:inline-block;'>Apagar</button>";
              echo"</form>";
                    echo "</div>";
                    echo "</td>";
                    }

                    echo "<td style='padding:0px;'>
                     <div style='display:flex; justify-content:center; align-items:center; height:100%;'>";
                echo"<form action='princUpload.php' method='POST' style='margin:0; padding:0; display:inline; border:none;'>"; 

                  echo"<li class='list' style='list-style:none;'>";
                  
                echo"<input type='hidden' id='id' name='id' value='{$dados['id_pedido']}'>"; 

                

                 echo"<input type='hidden' id='caminho' name='caminho' value='{$dados['caminho']}'>"; 

                  echo"<input type='hidden' id='caminhoimg' name='caminhoimg' value='{$dados['caminhoimg']}'>

                  <input type='hidden' id='titulo' name='titulo' value='{$dados['titulo']}'>
                  <input type='hidden' id='sinopse' name='sinopse' value='{$dados['sinopse']}'>
                  <input type='hidden' id='genero' name='genero' value='{$dados['id_genero']}'>
                  <input type='hidden' id='autor' name='autor' value='{$dados['autor']}'>

                  <input type='hidden' id='url' name='url' value='pedidos.php'>
                  <input type='hidden' id='nome' name='nome' value='{$dados['nome_arquivo']}'>
                  <input type='hidden' id='id_pedido' name='id_pedido' value='{$dados['id_pedido']}'>
                  "; 

                
                echo"<button id='postar' class='btn-entraro' style='background:#ffffff;color:#393bb5;font-weight:600;box-shadow:0 2px 8px #393bb520; min-width:100px; text-align:center; display:inline-block;'>Postar</button>";
              echo"</form>";
                    echo "</div>";
                    echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        $mysql->fechar();
        ?>
        <a href='homepage.php' class="voltar-link">Voltar para a Home</a>
    </div>
</div>
<script>
function toggleSinopse(id, btn) {
    var sinopseDiv = document.getElementById('sinopse-' + id);
    if (!sinopseDiv.classList.contains('open')) {
        sinopseDiv.classList.add('open');
        btn.textContent = "Mostrar menos";
    } else {
        sinopseDiv.classList.remove('open');
        btn.textContent = "Mostrar mais";
    }
}
</script>
</body>
</html>