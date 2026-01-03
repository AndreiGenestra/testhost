# tccgit

# PASSOS PARA A COLOCAR O PROJETO NO AR

# 1 INICIALIZE O WAMP;
# 2 O ARQUIVO DO SITE ESTÁ EM "PROTOTIPO", ESTE DEVE SER A PASTA QUE ESTARÁ DENTRO DO DIRETORIO "www" localizado em algo como: "C:\wamp64\www";

# 3 APÓS COLOCAR A PASTA NO www E  O WAMP INICIALIZAR ABRA O "PhpMyAdmin" coloque a senha e usuário -- a depender da máquina -- e importe o banco de dados "compartilhador.sql" localizando na pasta "bancos";

# 4 APÓS A IMPORTAÇÃO, PROCURE NO GERENCIADOR DE TAREFAS O ARQUIVO "php.ini" este arquivo deve ser colocado no seguinte caminho: "C:\wamp64\bin\apache\apache2.4.62.1\bin" ele vain substituir um arquivo ja existente. Esta etapa é fundamental caso você queira fazer upload de itens maiores do que 2 MB de espaço.

# 5 ABRA O VISUAL STUDIO CODE E A PASTA PROTOTIPO, LOGO APÓS ACESSE O "TERMINAL" LOCALIZADO NA BARRA DE TAREFAS SUPERIOR DO VS CODE E DIGITE A SEGUINTE ORDEM DE COMANDOS (A CADA NÚMERO DÊ ENTER):  1 - "cd pdf.js" 2 - "npm install". Assim você iniciará o node js e permitirá a visualização de pdfs no site. Caso nao seja possível instalar o node modules tentar essa alternativa online
          //<iframe src="https://mozilla.github.io/pdf.js/web/viewer.html?file=/uploads/arquivo.pdf#toolbar=0"width="100%" height="600px"></iframe> (Na página visualizador)

# 6 INICIALIZE O LOCAL HOST NO NAVEGADOR E ACESSE O DIRETORIO PROTOTIPO, LA ESTARÁ O SITE PRONTO PARA SER APRESENTADO.

# ------ CASO DE ERRO ------

# 7 CASO ABRA O SITE COM UM ERRO DE PHP, O ERRO PROVAVELMENTE SERÁ A SENHA DO BANCO DE DADOS, PORTANTO VÁ PARA "bd.php" e mude a senha de acordo com a colocada no phpMyAdmin.