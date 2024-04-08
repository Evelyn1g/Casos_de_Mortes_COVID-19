# PASSO A PASSO DE COMO RODAR O CÓDIGO

1 PASSO: INSTALANDO O XAMPP E CONFIGURANDO A VARIÁVEIS DE AMBIENTE

Instalar o xampp, configurar o php na variável de ambiente. Por padrão o xampp é instalado no disco local pensando nisso, acesse as variáveis de ambiente, clique em path, novo, e coloque o caminho logo após clique em ok. No casso do exemplo padrão seria: C:\xampp\php

2 PASSO: INSTALANDO O VISUAL STUDIO CODE E AS EXTENSÕES NECESSÁRIAS

Instale e Visual Studio code e certifique que está funcionando. Logo após, execute ele e na parte de extensões (ou clicando em  Ctrl+Shift+x) instale as seguintes extensões: -Open PHP/HTML/JS In Browser -PHP Intelephense 

PASSO 3: ADICIONANDO A MINHA PASTA NO HTDOCS

Logo após ter finalizado todas essas etapas, copie a minha pasta processo_seletivo (github) acesse a pasta do xampp e procure a pasta chamada htdocs, clique nela, e cole a minha pasta.

PASSO 4: ABRINDO O PAINEL DE CONTROLE DO XAMPP

Antes de rodar o código, precisa abrir o painel de controle do xampp. Para isso acesse a pasta que foi instalado o xampp e clique 2x em xampp-control. Assim abrirá o painel de controle.
No serviço Apache, clique em Start, e certifique que quando clicado ele fique verde (isso significa que está funcionando normalmente). Faça o mesmo com o MySQL (certificando que esteja verde)

PASSO 5: CONFIGURANDO O MYSQL

Logo quando der start no MySQL, clique na seção dele, em Adim. Caso não tenha configurado por padrão o nome de usuario sera root e não haverá senha (essa informação será importante na hora de colocar o código). Adicione um novo banco de dados com o nome db_covid e com ele aberto acesse a aba SQL e cole o seguinte código:

    CREATE TABLE acessos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        data_hora DATETIME NOT NULL,
        pais VARCHAR(50) NOT NULL
    );


Logo após clique em executar

PASSO 6: EDITANDO O INDEX.PHP

No passo 3, colocamos a pasta processo_seletivo no htdocs do xampp. Agora, vamos executar essa pasta no Visual Studeo Code. Assim que ela for aberta nele, iremos no arquivo index.php e seguimos o seguintes passos:

// Conexão com o banco de dados MySQL

$servername = "localhost";    --> Nessa aba, colocamos o servidor. Por padrão é localhost, caso não tenha alterado
$username = "root"; --> aqui colocamos o user name, do MySQL, caso seja a primeira vez esse é o padrão também. Caso tenha outro username, só modficar
$password = ""; --> Aqui é a senha do banco de dados, por padrão vem sem senha. Caso tenha uma senha só modificar
$dbname = "db_covid"; --> Aqui é o banco de dados que criamos, caso não tenha colocado o nome que eu disse no passo 5, apenas trocar.

PASSO 7: EXECUTANDO O CODIGO

Ainda com o arquivo aberto no visual studeo code, clicamos no index.php com o botão esquerdo e ira aparecer a opção Open PHP/HTML/JS in Browser clique nela e escolha seu navegador de preferência. Caso tenha feito o passo a passo direitinho, irá estar rodando o código. Importante, o Apache e o MySQL deve estar ligado pelo xampp para o código funcionar sem erro.
