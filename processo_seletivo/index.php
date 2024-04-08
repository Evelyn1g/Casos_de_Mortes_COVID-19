<?php
session_start(); // Inicia a sessão

// Função para fazer solicitações HTTP
function httpRequest($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Conexão com o banco de dados MySQL
$servername = "localhost";  //servidor (local)
$username = "root"; //nome padrão do MySQL
$password = ""; //senha padrão do MySQL
$dbname = "db_covid"; //bancoo de dados criado para armazenar o ultimo acesso
 
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// URL da API-Covid-19
$url_covid = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=";

// URL da API-Países-Disponíveis
$url_paises_disponiveis = "https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1";

// Fazendo solicitação HTTP para obter lista de países disponíveis
$response_paises = httpRequest($url_paises_disponiveis);

// Verificando se a resposta é válida
if ($response_paises) {
    // Decodificando a resposta JSON
    $paises_disponiveis = json_decode($response_paises, true);

    // Verificando se há erro na resposta
    if (isset($paises_disponiveis['error'])) {
        echo "Erro ao obter lista de países disponíveis: " . $paises_disponiveis['error'];
    } else {
        // Lista de países disponíveis
        $paises = $paises_disponiveis;
    }
} else {
    echo "Erro ao fazer solicitação HTTP para obter lista de países disponíveis.";
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['country1']) && isset($_POST['country2'])) {
    $pais1 = $_POST['country1'];
    $pais2 = $_POST['country2'];

    // Fazendo solicitação HTTP para obter dados da API-Covid-19 para o país 1
    $response_pais1 = httpRequest($url_covid . urlencode($pais1));

    // Fazendo solicitação HTTP para obter dados da API-Covid-19 para o país 2
    $response_pais2 = httpRequest($url_covid . urlencode($pais2));

    // Verificando se as respostas são válidas
    if ($response_pais1 && $response_pais2) {
        // Decodificando as respostas JSON
        $data_pais1 = json_decode($response_pais1, true);
        $data_pais2 = json_decode($response_pais2, true);

        // Se o país for o Brasil, vamos somar os dados de todos os estados
        if ($pais1 == 'Brazil') {
            $total_confirmados_pais1 = 0;
            $total_mortos_pais1 = 0;
            foreach ($data_pais1 as $estado) {
                $total_confirmados_pais1 += $estado['Confirmados'];
                $total_mortos_pais1 += $estado['Mortos'];
            }
        } else {
            $total_confirmados_pais1 = $data_pais1[0]['Confirmados'];
            $total_mortos_pais1 = $data_pais1[0]['Mortos'];
        }

        if ($pais2 == 'Brazil') {
            $total_confirmados_pais2 = 0;
            $total_mortos_pais2 = 0;
            foreach ($data_pais2 as $estado) {
                $total_confirmados_pais2 += $estado['Confirmados'];
                $total_mortos_pais2 += $estado['Mortos'];
            }
        } else {
            $total_confirmados_pais2 = $data_pais2[0]['Confirmados'];
            $total_mortos_pais2 = $data_pais2[0]['Mortos'];
        }

        // Exibir os dados dos países
        $output = "<h2>Dados do $pais1</h2>";
        $output .= "<p>Confirmados: " . $total_confirmados_pais1 . "</p>";
        $output .= "<p>Mortos: " . $total_mortos_pais1 . "</p>";

        $output .= "<h2>Dados do $pais2</h2>";
        $output .= "<p>Confirmados: " . $total_confirmados_pais2 . "</p>";
        $output .= "<p>Mortos: " . $total_mortos_pais2 . "</p>";

        // Calcula a diferença na taxa de mortalidade
        $taxa_mortalidade_pais1 = $total_mortos_pais1 / $total_confirmados_pais1;
        $taxa_mortalidade_pais2 = $total_mortos_pais2 / $total_confirmados_pais2;
        $diferenca_taxa_mortalidade = $taxa_mortalidade_pais1 - $taxa_mortalidade_pais2;

        $output .= "<h2>Diferença na Taxa de Mortalidade</h2>";
        $output .= "<p>$pais1: $taxa_mortalidade_pais1</p>";
        $output .= "<p>$pais2: $taxa_mortalidade_pais2</p>";
        $output .= "<p>Diferença: $diferenca_taxa_mortalidade</p>";

        // Define as variáveis de sessão para o último acesso à API-Covid-19
        $_SESSION['last_access_date'] = date('Y-m-d H:i:s');
        $_SESSION['last_country'] = $pais1;

        // Exibe os resultados na div 'result'
        echo $output;
    } else {
        echo "Erro ao fazer solicitação HTTP para obter dados da API-Covid-19.";
    }

    // Interromper a execução do script após a exibição dos dados
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Casos de Covid-19</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Informações sobre Covid-19</h1>
    
    <!-- Formulário para escolher dois países -->
    <form id="countryForm" action="" method="post">
        <label for="country1">País 1:</label>
        <select name="country1" id="country1">
            <?php
            // Exibir opções para os países disponíveis
            foreach ($paises as $pais) {
                echo "<option value='$pais'>$pais</option>";
            }
            ?>
        </select>

        <label for="country2">País 2:</label>
        <select name="country2" id="country2">
            <?php
            // Exibir opções para os países disponíveis
            foreach ($paises as $pais) {
                echo "<option value='$pais'>$pais</option>";
            }
            ?>
        </select>

        <button type="submit" id="submitBtn">Ver Diferença na Taxa de Mortalidade</button>
    </form>

    <!-- Div para exibir os resultados -->
    <div id="result"></div>

    <!-- Rodapé da página -->
    <footer class="footer">
        <?php
        // Verifica se a variável de sessão para o último acesso existe
        if(isset($_SESSION['last_access_date']) && isset($_SESSION['last_country'])) {
            $last_access_date = $_SESSION['last_access_date'];
            $last_country = $_SESSION['last_country'];
            echo "<div class='data'>Último acesso em: $last_access_date | Último país consultado: $last_country</div>";
        }
        ?>
    </footer>

    <script>
    $(document).ready(function() {
        // Intercepta o envio do formulário
        $('#countryForm').submit(function(e) {
            e.preventDefault(); // Impede o envio padrão do formulário

            // Obtém os países selecionados
            var country1 = $('#country1').val();
            var country2 = $('#country2').val();

            // Faz a solicitação AJAX para o mesmo script (index.php)
            $.post('index.php', {country1: country1, country2: country2}, function(response) {
                // Exibe os resultados na div 'result'
                $('#result').html(response);
            });
        });
    });
    </script>
</body>
</html>
