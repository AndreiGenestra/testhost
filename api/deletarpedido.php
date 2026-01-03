<?php

$id = $_POST['id'];
$url = "pedidos.php";
$caminhoArquivo = $_POST['caminho'];
$caminhoimg = $_POST['caminhoimg'];
$caminhoArquivo = __DIR__ . '/' . $caminhoArquivo;
$caminhoimgArquivo = __DIR__ . '/' . $caminhoimg;

//conecta com o banco
 require_once('bd.php');
$mysql = new BancodeDados();
	$mysql -> conecta();

    // deleta o arquivo do banco
  $stmt = $mysql->conn->prepare(" DELETE FROM pedido WHERE id_pedido=$id");
      
    $stmt->execute();
        $stmt->close();
        
  $mysql -> fechar();

echo "<script language='javascript' type='text/javascript'> alert('Deletado com sucesso'); window.location.href='pedidos.php';</script>"; 


//tirando da pasta do computador:

//  Verifique se o arquivo existe no servidor
if (file_exists($caminhoArquivo) && file_exists($caminhoimgArquivo)) {
    //  Tente excluir o arquivo
    if (unlink($caminhoArquivo) && unlink($caminhoimgArquivo)) {
        
        echo "Arquivo excluído com sucesso!";
    } else {
        
        echo "Não foi possível excluir o arquivo.";
    }
} else {
    //  Se o arquivo não existir
    echo "O arquivo não foi encontrado.";
}

?>