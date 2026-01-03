<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    echo "<script language='javascript' type='text/javascript'>
    alert('Acesso negado! Entre na conta para acessar');window.location.href='entrarconta.php';</script>";
    die();
}

require_once('bd.php');
$mysql = new BancodeDados();
$mysql->conecta();

$id = $_SESSION['id'];
$nome_usuario = $_SESSION['nome'];
$email = $_SESSION['email'];
$idade = $_SESSION['idade'];
$foto_atual = $_SESSION['caminhoimgperfil'] ?? 'src/img/default-avatar.png';

$mensagem = ''; //mensagem a ser mandada ao usuário se tiver erro ou... sucesso!
$tipo_mensagem = ''; //tipo da mensagem: 'erro' ou 'sucesso'

// Processar atualização
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_nome = mysqli_real_escape_string($mysql->conn, $_POST['nome']);
    $novo_email = mysqli_real_escape_string($mysql->conn, $_POST['email']); // esse mysql serve para evitar SQL Injection :) muito legal pois com o injection o usuário pode colocar coisas tipo DROP TABLE de nome de usuário, daí quando faz a string do sql exemplo: "SELECT * FROM usuarios WHERE nome='$nome_usuario'" o banco de dados acaba executando o DROP TABLE e apagando a tabela inteira kkkk
    $nova_idade = mysqli_real_escape_string($mysql->conn, $_POST['idade']);
    $nova_senha = $_POST['senha'] ?? '';

    // Validações básicas
    if (empty($novo_nome)) {
        $mensagem = "Nome não pode estar vazio!";
        $tipo_mensagem = "erro";
    } elseif (empty($novo_email)) {
        $mensagem = "E-mail não pode estar vazio!";
        $tipo_mensagem = "erro";
    } elseif (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido!";
        $tipo_mensagem = "erro";
    } elseif (empty($nova_idade)) {
        $mensagem = "Idade não pode estar vazia!";
        $tipo_mensagem = "erro";
    } else {
        // Processar upload de foto se existir
        $foto_nova = $foto_atual;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $arquivo = $_FILES['foto'];
            $nome_arquivo = $arquivo['name'];
            $tipo_arquivo = $arquivo['type'];
            $tamanho_arquivo = $arquivo['size'];
            $tmp_arquivo = $arquivo['tmp_name'];

            // Validar tipo de arquivo
            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($tipo_arquivo, $tipos_permitidos)) { // verifica se os tipos de foto acima estao corretos
                $mensagem = "Tipo de arquivo não permitido! Use JPG, PNG ou GIF.";
                $tipo_mensagem = "erro";
            } elseif ($tamanho_arquivo > 5242880) { // 5MB
                $mensagem = "Arquivo muito grande! Máximo 5MB.";
                $tipo_mensagem = "erro";
            } else {
            
                $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
                $nome_novo = 'avatar_' . $id . '_' . time() . '.' . $extensao;
                $caminho_upload = 'src/img/perfis/' . $nome_novo;

                // Criar diretório se não existir
                if (!is_dir('src/img/perfis')) {
                    mkdir('src/img/perfis', 0755, true);
                }

    
                if (move_uploaded_file($tmp_arquivo, $caminho_upload)) {
                
                    if ($foto_atual != 'src/img/default-avatar.png' && file_exists($foto_atual)) {
                        unlink($foto_atual);
                    }
                    $foto_nova = $caminho_upload;
                } else {
                    $mensagem = "Erro ao fazer upload da foto!";
                    $tipo_mensagem = "erro";
                }
            }
        }

        // Se não houver erro, atualizar banco de dados
        if ($tipo_mensagem !== 'erro') {
            $sql = "UPDATE usuarios SET nome='$novo_nome', email='$novo_email', idade='$nova_idade', caminhoimgperfil='$foto_nova'";
            
            if (!empty($nova_senha)) {
                
                $nova_senha_esc = mysqli_real_escape_string($mysql->conn, $nova_senha);
                $sql .= ", senha='$nova_senha_esc'";
            }
            
            $sql .= " WHERE id='$id'";

            if (mysqli_query($mysql->conn, $sql)) {
                $_SESSION['nome'] = $novo_nome;
                $_SESSION['email'] = $novo_email;
                $_SESSION['idade'] = $nova_idade;
                $_SESSION['caminhoimgperfil'] = $foto_nova;
                if (!empty($nova_senha)) {
                  
                    $_SESSION['senha'] = $nova_senha;
                }
                
                $mensagem = "Perfil atualizado com sucesso!";
                $tipo_mensagem = "sucesso";
                $foto_atual = $foto_nova;
                $nome_usuario = $novo_nome;
                $email = $novo_email;
                $idade = $nova_idade;
            } else {
                $mensagem = "Erro ao atualizar perfil: " . mysqli_error($mysql->conn);
                $tipo_mensagem = "erro";
            }
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="./csspaginas/paginaperfil.css" rel="stylesheet">
    <title>Editar Perfil</title>
    <style>
        .edit-form {
            max-width: 900px;
            margin: 40px auto;
            background: rgba(255,255,255,0.98);
            padding: 56px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(57,59,181,0.15);
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #393bb5;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            box-sizing: border-box;
            background: white;
            color: #333;
        }
        .form-group input:focus {
            outline: none;
            border-color: #393bb5;
            box-shadow: 0 0 0 3px rgba(57,59,181,0.1);
        }
        .form-group input::placeholder {
            color: #999;
        }
        .btn-container {
            display: flex;
            gap: 24px;
            width: 100%;
            justify-content: flex-start;
            margin-top: 32px;
        }
        .btn-salvar {
            background: #5a57d8;
            color: #fff;
            padding: 16px 32px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s;
            flex: 1;
            box-shadow: 0 2px 8px rgba(57,59,181,0.10);
        }
        .btn-salvar:hover {
            background: #393bb5;
        }
        .btn-voltar {
            background: #8a7ccdff;
            color: #ffffffff;
            padding: 16px 32px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            flex: 1;
            text-align: center;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .btn-voltar:hover {
            background: #5c4f9cff;
        }
        h1 {
            color: #393bb5;
            text-align: center;
            margin-bottom: 32px;
            font-size: 2rem;
            font-weight: 700;
        }
        main {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 87.45vh;
            padding: 0;
        }

        .btn-alterar-foto {
            background: #5a57d8;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(57,59,181,0.10);
        }

        .btn-alterar-foto:hover {
            background: #393bb5;
        }

        hr {
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        .mensagem {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .mensagem.sucesso {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mensagem.erro {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
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

  <div class="menuo"> <span class="tresrisco" style="font-size:30px;cursor:pointer;margin-left:50px;" onclick="openNav()">&#9776;</span> </div>

  <script>
  function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
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

<main>
    <div class="edit-form">
        <h1>Editar Perfil</h1>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem <?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <!-- Seção de foto de perfil -->
            <div class="form-group">
                <label style="text-align:center;">Foto de Perfil</label>
                <div style="display: flex; align-items: center; gap: 24px; margin-top: 16px;">
                    <div style="width: 120px; height: 120px; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 3px solid #393bb5;">
                        <img id="previewFoto" src="<?php echo htmlspecialchars($foto_atual); ?>" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div>
                        <input type="file" id="fotoInput" name="foto" accept="image/*" style="display: none;">
                        <button type="button" class="btn-alterar-foto" onclick="document.getElementById('fotoInput').click()">Alterar Foto</button>
                        <p style="font-size: 0.9rem; color: #999; margin-top: 8px;">JPG, PNG ou GIF (máx. 5MB)</p>
                    </div>
                </div>
            </div>

            <hr style="margin: 32px 0; border: none; border-top: 1px solid #e0e0e0;">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" value="<?php echo htmlspecialchars($nome_usuario); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            
            
            <div class="form-group">
                <label for="senha">Nova Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite uma nova senha (deixe em branco para não alterar)">
            </div>
            
            <div class="btn-container">
                <button type="submit" class="btn-salvar">Salvar Alterações</button>
                <a href="paginaperfil.php" class="btn-voltar">Voltar</a>
            </div>
        </form>
    </div>
</main>

<!-- Rodapé -->
<footer class="footer">
    <p>&copy; 2025 Bibliotec. Todos os direitos reservados by Maiam Technologies</p>
</footer>

<script>
    // Preview da imagem selecionada
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewFoto').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>