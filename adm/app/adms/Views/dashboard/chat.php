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
