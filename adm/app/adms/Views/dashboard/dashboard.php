<?php

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="box box-first">
            <span class="fa-solid fa-users"></span>
            <span>
                <?php
                if (!empty($this->data['countUsers'])) {
                    echo $this->data['countUsers'][0]['qnt_users'];
                }
                ?>
            </span>
            <span>Usuários Cadastrados</span>
        </div>
        
        
        
        
        
<!--
        <div class="box box-second">
            <span class="fa-solid fa-truck-ramp-box"></span>
            <span>43</span>
            <span>Entregas</span>
        </div>
<!--
        <div class="box box-third">
            <span class="fa-solid fa-circle-check"></span>
            <span>12</span>
            <span>Completas</span>
        </div>

        <div class="box box-fourth">
            <span class="fa-solid fa-triangle-exclamation"></span>
            <span>3</span>
            <span>Alertas</span>
            
        </div>
        
       
        
    </div>--->
</div>
<div class="wrapper">
     <div class="row">
<iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSEMVKjT0O9bguSVQ-JJUbHJmt5t9Hjc5YMwugETNs5YhZBQgEEA9562N7drE_tA4hqvmwQtU5kJJpp/pubhtml?widget=true&amp;headers=false" width="950" height="380"></iframe>



<div class="box box-second">
            <span class="fa-solid fa-truck-ramp-box"></span>
<button onclick="window.location.href='https://docs.google.com/spreadsheets/d/1WGxTp2aigV2re7NAdvZNjNBjY-tkv-W6TUKAYPjiZ38/edit?usp=sharing';"></button>    <a href="https://docs.google.com/spreadsheets/d/1WGxTp2aigV2re7NAdvZNjNBjY-tkv-W6TUKAYPjiZ38/edit?usp=sharing" target="_blank">
 ACESSAR O MODO DE EDIÇÂO DO TCO</a>
            </div>
        </div>
        
        </div>
<div class="wrapper">
    <div class="row">
<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1J8fQqPj5QGpZtActI9d3XWl1ApPNhaU&ehbc=2E312F" width="950" height="380"></iframe>



<div class="box box-second">
            <span class="fa-solid fa-truck-ramp-box"></span>
<button onclick="window.location.href='https://docs.google.com/spreadsheets/d/1WGxTp2aigV2re7NAdvZNjNBjY-tkv-W6TUKAYPjiZ38/edit?usp=sharing';"></button>    <a href="https://www.google.com/maps/d/u/0/edit?mid=1J8fQqPj5QGpZtActI9d3XWl1ApPNhaU&usp=sharing" target="_blank">
 ACESSAR MAPA 10º RISP</a>
            </div>
        </div>
<!-- Fim do conteudo do administrativo -->
<!----
<?php
// Verifique se foi enviada uma mensagem
if (isset($_POST['message'])) {
    $message = $_POST['message'];

    // Lógica para processar a mensagem ou encaminhá-la para um chatbot, por exemplo
    $response = 'Resposta do chat';

    echo $response;
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Online teste</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Chat Online teste</h1>

    <div id="chat-container">
        <div id="chat-messages"></div>
        <form id="chat-form" action="chat.php" method="post">
            <input type="text" id="message-input" name="message" placeholder="Digite sua mensagem" autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        // Função para exibir mensagens no chat
        function showMessage(message) {
            $('#chat-messages').append('<p>' + message + '</p>');
        }

        // Enviar mensagem via AJAX
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message-input').val();
            showMessage('Você: ' + message);
            $.post('chat.php', {message: message}, function(response) {
                showMessage('Chatbot: ' + response);
            });
            $('#message-input').val('');
        });
    </script>
</body>
</html>
--->
<!---
<?php
// Verifique se foi enviada uma mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];

    // Lógica para processar a mensagem ou encaminhá-la para um chatbot, por exemplo
    $response = 'Resposta do chat';

    echo $response;
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Online</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Chat Online teste</h1>

    <div id="chat-container">
        <div id="chat-messages"></div>
        <form id="chat-form" action="chat.php" method="post">
            <input type="text" id="message-input" name="message" placeholder="Digite sua mensagem" autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        // Função para exibir mensagens no chat
        function showMessage(message) {
            $('#chat-messages').append('<p>' + message + '</p>');
        }

        // Enviar mensagem via AJAX
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message-input').val();
            showMessage('Você: ' + message);
            $.post('chat.php', {message: message}, function(response) {
                showMessage('Chatbot: ' + response);
            });
            $('#message-input').val('');
        });
    </script>
</body>
</html>--->
