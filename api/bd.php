
<?php
//BANCO DE DADOS
class BancodeDados {
    // Nas linhas abaixo você poderá colocar as informações do Banco de Dados.
   // private $host = "localhost:3308";
/* BD DOS LABARATÓRIOS */
/*
    private $host = "localhost:3306"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usuário do Servidor MySQL
    private $senha = "prof@3t3c"; 		// Senha do Usuário MySQL
    private $banco = "compartilhador"; 		// Nome do seu Banco de Dados
    public $conn;
*/
/* BD CASA DO ANDREI */
 
    private $host = "localhost:3306"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usuário do Servidor MySQL
    private $senha = "dedei2007"; 		// Senha do Usuário MySQL
    private $banco = "compartilhador"; 		// Nome do seu Banco de Dados
    public $conn;

/* BD CASA DO Allan */
 /*
    private $host = "localhost:3306"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usuário do Servidor MySQL
    private $senha = ""; 		// Senha do Usuário MySQL
    private $banco = "compartilhador"; 		// Nome do seu Banco de Dados
    public $conn;

*/
/*
private $host = "localhost:3306"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usuário do Servidor MySQL
    private $senha = "prof@3t3c"; 		// Senha do Usuário MySQL
    private $banco = "compartilhador"; 		// Nome do seu Banco de Dados
    public $conn;*/
function conecta(){
        $this->conn = mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
/* if ($this->conn->connect_error) {
 die (" Erro na conexão: " . $this->conn->connect_error);
 }*/
if ($this->conn) {
        mysqli_set_charset($this->conn, "utf8");
    }
   if(!$this->conn){
      		// Caso ocorra um erro, exibe uma mensagem com o erro
			die ("Problemas com a conex&atildeo");
        }
}
function fechar(){
		mysqli_close($this->conn);
		return;
	}

}
?>
