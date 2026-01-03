<?php
 require_once('bd.php');
	//criando o objeto mysql e conectando ao banco de dados
	$mysql = new BancodeDados();
	$mysql -> conecta();
    
	
    session_start();
    if ( $_SESSION['logado'] = true)
    {
      $_SESSION['logado'] = false;
      echo"<script language='javascript' type='text/javascript'>
          alert('Você fez logout com sucesso!');window.location.href='index.php';
          </script>";
      	$_SESSION['id']="" ;
 		$_SESSION['nome']="" ;
    $_SESSION['senha']="" ;
    $_SESSION['email']="" ;
    $_SESSION['idade'] = "";
    $_SESSION['caminhoimgperfil'] = "" ;
    }
   
		  

  


      $mysql->fechar();
 ?>


