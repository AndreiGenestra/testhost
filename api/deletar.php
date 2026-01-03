<!-- TELA DE CONFIGURAÇÃO
 
Grupo MAIAM TECH - Allan Araujo, Andrei Genestra, Isabelle Lima, Milena Mazzo, Murilo Minghini
  Etec de Poá
 Salve como Upload.php -->
<?php



session_start();

//recebe os dados do formulario

$tipo = $_POST['tipo'];

if($_POST['tipo'] == "livro"){
    $id = $_POST['id'];
    $url = $_POST['url'];
    // pegar só o nome do arquivo por segurança
    $caminho = isset($_POST['caminho']) ? basename($_POST['caminho']) : '';
    $caminhoimg = isset($_POST['caminhoimg']) ? basename($_POST['caminhoimg']) : '';

    // caminho absoluto para a pasta uploads (ajuste se sua pasta for outra)
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
    $fullArquivo = $uploadDir . $caminho;
    $fullImgArquivo = $uploadDir . $caminhoimg;

    // conecta com o banco
    require_once('bd.php');
    $mysql = new BancodeDados();
    $mysql->conecta();

    // deleta o registro do banco (use parâmetros para segurança)
    $stmt = $mysql->conn->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $mysql->fechar();

    // tenta apagar cada arquivo separadamente (não exigir os dois)
    $errors = [];
    if ($caminho !== '') {
        if (file_exists($fullArquivo)) {
            if (!@unlink($fullArquivo)) {
                $errors[] = "Falha ao excluir: $fullArquivo";
            }
        } // se não existir, ignorar
    }
    if ($caminhoimg !== '') {
        if (file_exists($fullImgArquivo)) {
            if (!@unlink($fullImgArquivo)) {
                $errors[] = "Falha ao excluir: $fullImgArquivo";
            }
        }
    }

    // montar mensagem e redirecionar depois de tentar apagar
    if (empty($errors)) {
        echo "<script>alert('Deletado com sucesso'); window.location.href='{$url}';</script>";
    } else {
        $msg = implode('\\n', $errors);
        echo "<script>alert('Deletado (com erros):\\n{$msg}'); window.location.href='{$url}';</script>";
    }
    exit;
}
else if($_POST['tipo'] == "postagem"){
$id = $_POST['idpostagem'];
$url = "homepage.php";
//conecta com o banco
 require_once('bd.php');   
$mysql = new BancodeDados();
    $mysql -> conecta();

    // deleta o arquivo do banco
  $stmt = $mysql->conn->prepare(" DELETE FROM postagem WHERE ID_Postagem=$id");
      
    $stmt->execute();
        $stmt->close();
        
  $mysql -> fechar();
echo "<script language='javascript' type='text/javascript'> alert('Deletado com sucesso'); window.location.href='{$url}';</script>"; 
}

else {
    echo "<script language='javascript' type='text/javascript'> alert('Erro ao deletar'); window.location.href='{$url}';</script>";
}


?>