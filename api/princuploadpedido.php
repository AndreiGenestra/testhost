<?php 

$tipo = $_POST['tipo']; 

    if($tipo == "pedido"){
        if($_POST['tipo'] == "pedido"){
            if ( isset( $_FILES[ 'livro' ][ 'name' ] ) && $_FILES[ 'livro' ][ 'error' ] == 0 ) {
$arquivo_tmp = $_FILES[ 'livro' ][ 'tmp_name' ];
$nome = $_FILES[ 'livro' ][ 'name' ];
$arquivo_img_tmp = $_FILES[ 'img' ][ 'tmp_name' ];
$img = $_FILES['img']['name'];
$titulo = $_POST['titulo'];
$url = "sugerirlivro.php";
$sinopse = $_POST['sinopse'];
$genero = $_POST['genero'];
$extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
$data = date("Y-m-d");
$autor = $_POST['autor'];

$extensao = strtolower ( $extensao );
$extensaoimg = pathinfo ( $img, PATHINFO_EXTENSION );

$extensaoimg = strtolower ( $extensaoimg );

    if ( strstr ( '.docx;.doc;.pdf', $extensao ) ) {

    if( strstr ( '.jpg;.jpeg;.gif;.png;.jfif', $extensaoimg ) ){

$novoNome = uniqid ( time () ). $nome .".". $extensao;
$novoNomeimg = uniqid ( time () ) . $img .".". $extensaoimg;


// <img src="curriculo/andrei.png"
//$novoNome = uniqid ( time () ) . $extensao;
 $destino = 'uploads/' . $novoNome;
  $destinoimg = 'uploads/' . $novoNomeimg;
// $destino = $novoNome;

//salvando na pasta do computador
if ( @move_uploaded_file ( $arquivo_tmp, $destino ) && @move_uploaded_file ( $arquivo_img_tmp, $destinoimg ) ) {




//banco de dados
 require_once('bd.php');
$mysql = new BancodeDados();
	$mysql -> conecta();
  $stmt = $mysql->conn->prepare("INSERT INTO pedido (titulo, sinopse, datapedido, id_genero, caminho, caminhoimg, nome_arquivo, autor) VALUES (?,?,?,?,?,?,?,?)");
       $stmt->bind_param("sssissss", $titulo, $sinopse, $data, $genero, $destino, $destinoimg, $nome, $autor);
        $stmt->execute();
        $stmt->close();

        echo"<script language='javascript' type='text/javascript'>
          alert('Postagem enviada com sucesso');window.location.href='homepage.php';
          </script>";

}
else
 
 echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão  de escrita.');window.location.href='".$url."';
          </script>";        

}
else
   echo"<script language='javascript' type='text/javascript'>
          alert('Voce nao enviou uma imagem em formato .jpg;.jpeg;.gif;.png;.jfif');window.location.href='".$url."';
          </script>"; 
        


}
else


  echo" <script language='javascript' type='text/javascript'>
          alert('Você pode enviar apenas documentos de livro em formato *.docx, *.doc e *.pdf ');window.location.href='".$url."';
          </script>"; 
      


}
else
 

   echo"<script language='javascript' type='text/javascript'>
          alert('Você não enviou nenhum arquivo!');window.location.href='".$url."';
          </script>"; 
        
}
}