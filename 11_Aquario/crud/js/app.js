// Importações usando a versão estável do Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase, ref, push, onValue, remove, update, get } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

// Your web app's Firebase configuration
const firebaseConfig = {
    
};

// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

const cardPh = document.getElementById('card-ph');
const cardTemp = document.getElementById('card-temp');
const cardTurb = document.getElementById('card-turb');
const tabelaLeitura = document.getElementById('tabela-leituras');
const formEditar = document.getElementById('form-editar');

if(tabelaLeitura){
    const leituraRef = ref(db, "leituras");
    
    onValue(leituraRef, (snapshot) => {
        if(snapshot.exists()){
            const dados = snapshot.val();
            let ultimaLeitura = null;
    
            Object.keys(dados).forEach( (id) => {
                const item = dados[id];
                
                ultimaLeitura = item;
    
                const tr = document.createElement('tr');
                tr.innerHTML = "<td>" + item.data + " às " + item.hora + "</td>" 
                             + "<td>" + item.temperatura + " °C | Ph: " 
                             + item.ph + " | Turb: " 
                             + item.turbidez + " NTU" + "</td>"
                             + "<td> <button class='btn-acao btn-alterar' data-id='" + id + "'> Alterar </button>" 
                             + "<button class='btn-acao btn-excluir' data-id='" + id + "'> Excluir </button> </td>";
                
                tabelaLeitura.prepend(tr);
            });
    
            if(ultimaLeitura){
                cardPh.innerHTML = ultimaLeitura.ph;
                cardTemp.innerHTML = ultimaLeitura.temperatura + " °C";
                cardTurb.innerHTML = ultimaLeitura.turbidez + " NTU";
            }
        }
    });
    
    tabelaLeitura.addEventListener("click", (evento) => {
        const id = evento.target.getAttribute("data-id");
    
        if(evento.target.classList.contains("btn-excluir")){
            if(confirm("Quer excluir?")){
                const itemRef = ref(db, "leituras/" + id);
    
                remove(itemRef);
            }
        }
    
        if(evento.target.classList.contains("btn-alterar")){
            window.location.href = "editar.php?id=" + id;
        }
    });
}

if(formEditar){
    const parametros = new URLSearchParams(window.location.search);
    const id = parametros.get("id");
    const itemRef = ref(db, "leituras/" + id);
    
    get(itemRef).then((snapshot) => {
        if(snapshot.exists()){
            const dados = snapshot.val();

            document.getElementById("ph").value = dados.ph;
            document.getElementById("temperatura").value = dados.temperatura;
            document.getElementById("turbidez").value = dados.turbidez;
        }
    });
}

let tempo = 60;

/*function gravarLeitura(){
    const agora = new Date();
    const painel = document.getElementById('painel').innerHTML = "Nova leitura em: " + tempo-- + "s";

    if(tempo <= 0){
        const novaLeitura = {
            ph : Number((Math.random() * (8.5 - 6.6) + 6.5).toFixed(1)),
            temperatura : Number((Math.random() * (28 - 22) + 22).toFixed(1)),
            turbidez : Number((Math.random() * (15 - 5) + 5).toFixed(1)),
            data : agora.toLocaleDateString("pt-BR"),
            hora : agora.toLocaleTimeString("pt-BR")
        };

        push(leituraRef, novaLeitura);
        tempo = 60;
    }
}

setInterval(gravarLeitura, 1000); */