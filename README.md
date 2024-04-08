# Configurando o Ambiente de Desenvolvimento

## Passo 1: Instalando o XAMPP e Configurando as Variáveis de Ambiente

1. Instale o XAMPP.
2. Configure o PHP na variável de ambiente:
   - Acesse as variáveis de ambiente do sistema.
   - Clique em "Path", depois "Novo" e adicione o caminho para o PHP (por padrão: `C:\xampp\php`).

## Passo 2: Instalando o Visual Studio Code e as Extensões Necessárias

1. Instale o Visual Studio Code.
2. Certifique-se de que está funcionando.
3. Na seção de extensões (ou pressionando Ctrl+Shift+x), instale as seguintes extensões:
   - Open PHP/HTML/JS In Browser
   - PHP Intelephense

## Passo 3: Adicionando a Pasta no htdocs

1. Copie a pasta do meu projeto (por exemplo, `processo_seletivo`) localizada nesse repositório GitHub (ou clone).
2. Acesse a pasta do XAMPP e vá para a pasta `htdocs`.
3. Cole a pasta do seu projeto nesta localização.

## Passo 4: Abrindo o Painel de Controle do XAMPP

1. Abra o Painel de Controle do XAMPP.
2. Acesse a pasta de instalação do XAMPP e clique duas vezes em `xampp-control.exe`.
3. No painel de controle, clique em "Start" ao lado de "Apache" e "MySQL" para garantir que ambos estejam em execução (indicado pela cor verde).

## Passo 5: Configurando o MySQL

1. Após iniciar o MySQL, clique na seção correspondente e em "Admin".
2. Use as credenciais padrão (usuário: `root`, sem senha).
3. Adicione um novo banco de dados chamado `db_covid`.
4. Na aba SQL, cole e execute o seguinte código:

```sql
CREATE TABLE acessos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_hora DATETIME NOT NULL,
    pais VARCHAR(50) NOT NULL
);
```
## Passo 6: Configurando o MySQL

1. Abra a pasta do seu projeto `(processo_seletivo)` no Visual Studio Code.
2. No arquivo index.php, ajuste as configurações de conexão com o banco de dados:
3. O codigo abaixo é os ajuste no arquivo index.php
```
// Conexão com o banco de dados MySQL
$servername = "localhost"; // servidor
$username = "root"; // nome de usuário
$password = ""; // senha
$dbname = "db_covid"; // nome do banco de dados
```
## Passo 7: Executando o Código

1. Com o arquivo index.php aberto no Visual Studio Code, clique com o botão esquerdo sobre ele.
2. Selecione a opção "Open PHP/HTML/JS in Browser" e escolha seu navegador preferido.
3. Certifique-se de que o Apache e o MySQL estão ligados no XAMPP.
4.Se todos os passos foram seguidos corretamente, o código deverá ser executado sem erros.

Agora seu projeto deve estar funcionando corretamente em outra máquina! Lembre-se de fornecer as credenciais de acesso ao MySQL, se aplicável, para quem for utilizar o projeto.

## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://portiforio-two.vercel.app)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/evelyn-galhardo/)

## Stack utilizada

**Front-end:** HTML, CSS, JavaScript
**Back-end:** PHP
**Banco de dados:** MySQL (pelo xampp)
