<?php
// index.php
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
        }
        
        .texto-alerta{ 
            color: #0d47a1; 
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Mensagem em Tempo Real do Firebase</h1>

    <div id="caixa-status">
        Mensagem atual: <span id="texto-status" class="texto-alerta">A carregar dados...</span>
    </div>

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
        const caminhoMsg = ref(db, 'mensagem');

        onValue(caminhoMsg, (snapshot) => {
            const valor = snapshot.val();

            if(valor != null){
                document.getElementById("texto-status").innerHTML=valor;
            }else{
                document.getElementById("texto-status").innerHTML="Nenhuma mensagem";
            }
        });
    </script>
</body>

</html>