import { db, ref, get, update} from './firebase.js';

const parametros = new URLSearchParams(window.location.search);
const id = parametros.get("id");
const itemRef = ref(db, "leituras/" + id);

get(itemRef).then((snapshot) => {
    if (snapshot.exists()) {
        const dados = snapshot.val();
        document.getElementById("ph").value = dados.ph;
        document.getElementById("temperatura").value = dados.temperatura;
        document.getElementById("turbidez").value = dados.turbidez;
    }
});

const formEditar = document.getElementById("form-editar"); 

formEditar.addEventListener("submit", (e) => {
    e.preventDefault(); 

    const novoPh = document.getElementById("ph").value;
    const novaTemperatura = document.getElementById("temperatura").value;
    const novaTurbidez = document.getElementById("turbidez").value;

    update(itemRef, {
        ph: Number(novoPh),
        temperatura: Number(novaTemperatura),
        turbidez: Number(novaTurbidez)
    }).then(() => {
        alert("Leitura atualizada com sucesso!");
        window.location.href = "index.php"; 
    }).catch((error) => {
        console.error("Erro ao atualizar: ", error);
        alert("Erro ao atualizar os dados.");
    });
});