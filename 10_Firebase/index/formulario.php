<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nova_mensagem"])){
    $opcoes = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json\r\n',
            'content' => json_encode($_POST["nova_mensagem"])
        ]
    ];

    $contexto = stream_context_create($opcoes);

    file_get_contents('https://aula-php-firebase-5e8c1-default-rtdb.europe-west1.firebasedatabase.app/mensagens.json', false, $contexto);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Firebase Realtime</title>
    <style>
        body{ 
            font-family: Arial, sans-serif; 
            margin: 30px; 
        }
        
        #caixa-status{ 
            padding: 15px; 
            border: 2px solid #2196F3; 
            background-color: #e3f2fd; 
            border-radius: 5px; 
            margin-bottom: 20px; 
        }

        .texto-alerta{
            color: #0d47a1; 
            font-weight: bold;
        }
        
        form { margin-top: 20px; }
        
        input[type="text"]{ 
            padding: 8px; 
            width: 300px; 
        }
        
        button{ 
            padding: 8px 15px; 
            background-color: #2196F3; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        
        button:hover{ 
            background-color: #0b7dda; 
        }
    </style>
</head>

<body>
    <h1>Mensagem em Tempo Real do Firebase</h1>

    <div id="caixa-status">
        Mensagem atual: <span id="texto-status" class="texto-alerta">A carregar dados...</span>
    </div>

    <!-- Formulário que envia dados para o próprio PHP -->
    <form method="POST" action="formulario.php">
        <label for="nova_mensagem">Enviar nova mensagem pelo PHP:</label>
        <br><br>
        
        <input type="text" id="nova_mensagem" name="nova_mensagem" placeholder="Digite uma mensagem..." required>
        
        <button type="submit">Atualizar via PHP</button>
    </form>

    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
        import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyAmgubQqVUPDdbZJN9XrDj4tm1YcDNgtYc",
            authDomain: "aula-php-firebase-5e8c1.firebaseapp.com",
            databaseURL: "https://aula-php-firebase-5e8c1-default-rtdb.europe-west1.firebasedatabase.app",
            projectId: "aula-php-firebase-5e8c1",
            storageBucket: "aula-php-firebase-5e8c1.firebasestorage.app",
            messagingSenderId: "1047499477804",
            appId: "1:1047499477804:web:dc6f40caff046aab7b9289"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);
        const caminhoMsg = ref(db, 'mensagens');

        onValue(caminhoMsg, (snapshot) => {
            const dados = snapshot.val();
            let html = "";

            if(dados != null){
                Object.values(dados).forEach((mensagem) => {
                    html += `${mensagem}<br>`;
                });

                document.getElementById("texto-status").innerHTML = html;
            }else{
                document.getElementById("texto-status").innerHTML = "Nenhum dado encontrado.";
            }
        });
    </script>
</body>

</html>