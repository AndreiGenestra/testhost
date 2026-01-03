<!-- TELA DE CONFIGURAÇÃO
 
Grupo MAIAM TECH - Allan Araujo, Andrei Genestra, Isabelle Lima, Milena Mazzo, Murilo Minghini
  Etec de Poá
-->
<?php

// Verifica se o arquivo foi enviado




$autor = $_POST['autor'];
$titulo = $_POST['titulo'];
$url = $_POST['url'];
$sinopse = $_POST['sinopse'];
$genero = $_POST['genero'];
$nome = $_POST['nome'];
$id_pedido = $_POST['id_pedido'];




// <img src="curriculo/andrei.png"
//$novoNome = uniqid ( time () ) . $extensao;
 $destino =  $_POST['caminho'];
  $destinoimg = $_POST['caminhoimg'];
// $destino = $novoNome;

 require_once('bd.php');
$mysql = new BancodeDados();
	$mysql -> conecta();
  $stmt = $mysql->conn->prepare("INSERT INTO livros (nome_arquivo, caminhoimg, caminho, titulo, sinopse, id_genero, autor) VALUES (?,?,?,?,?,?,?)");
       $stmt->bind_param("sssssis", $nome, $destinoimg, $destino, $titulo, $sinopse, $genero, $autor);
        $stmt->execute();
        $stmt->close();

        // remover o registro da tabela de pedidos (se o id do pedido for enviado no formulário

            $del = $mysql->conn->prepare("DELETE FROM pedido WHERE id_pedido = ?");
            $del->bind_param("i", $id_pedido);
            $del->execute();
            $del->close();
        

      echo"<script language='javascript' type='text/javascript'>
          alert('Postagem enviada com sucesso');window.location.href='pedidos.php';
          </script>";

 
   
?>