import { db, ref, push, onValue, remove } from './firebase.js';

const leituraRef = ref(db, "leituras");
const cardPh = document.getElementById("card-ph");
const cardTemp = document.getElementById("card-temp");
const cardTurb = document.getElementById("card-turb");
const tabelaLeitura = document.getElementById("tabela-leituras");

onValue(leituraRef, (snapshot) => {
    tabelaLeitura.innerHTML = "";

    if (snapshot.exists()) {
        const dados = snapshot.val();
        let ultimaLeitura = null;
        Object.keys(dados).forEach((id) => {
            const item = dados[id];
            ultimaLeitura = item;
            const tr = document.createElement("tr");
            tr.innerHTML = "<td>" + item.data + " às " + item.hora + "</td>" +
                "<td>" + item.temperatura + "ºC | Ph: " +
                item.ph + " | Turb :" +
                item.turbidez + "NTU</td>" +
                "<td><button class='btn-acao btn-alterar' data-id='" + id + "'>Alterar</button>" +
                "<button class='btn-acao btn-excluir' data-id='" + id + "'>Excluir</button></td>";
            tabelaLeitura.prepend(tr);

        });
        if (ultimaLeitura) {
            cardPh.innerHTML = ultimaLeitura.ph;
            cardTemp.innerHTML = ultimaLeitura.temperatura + " ºC";
            cardTurb.innerHTML = ultimaLeitura.turbidez + " NTU";
        }
    }
});
tabelaLeitura.addEventListener("click", (evento) => {
    
    const id = evento.target.getAttribute("data-id");

    if (evento.target.classList.contains("btn-alterar")){
        window.location.href = "editar.php?id=" + id;
    }
    if (evento.target.classList.contains("btn-excluir")) {
        if (confirm("Tem certeza que quer excluir?")) {
            const itemRef = ref(db, "leituras/" + id);
            remove(itemRef);
        }
    }
    if (evento.target.classList.contains("btn-alterar")) {
        window.location.href = "editar.php?id=" + id;
    }
});


let t = 60;
function gravarLeitura() {
    const agora = new Date();
    document.getElementById('painel').innerHTML = "Nova leitura em " + t-- + "s";
    if (t <= 0) {
        const novaLeitura = {
            ph: Number((Math.random() * (8.5 - 6.5) + 6.5).toFixed(1)),
            temperatura: Number((Math.random() * (28 - 22) + 22).toFixed(1)),
            turbidez: Number((Math.random() * (15 - 5) + 5).toFixed(1)),
            data: agora.toLocaleDateString("pt-BR"),
            hora: agora.toLocaleTimeString("pt-BR")
        };
        push(leituraRef, novaLeitura)
            .then(() => console.log("Leitura gravada"))
            .catch((erro) => console.error("Erro ao gravar:", erro));
        t = 60;
        
    }
}
setInterval(gravarLeitura, 1000);