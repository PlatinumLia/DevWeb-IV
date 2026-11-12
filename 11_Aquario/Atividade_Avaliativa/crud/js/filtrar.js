import { db, ref, get } from "./firebase.js";

const btnFiltrar = document.getElementById("btn-filtrar");
const btnLimpar = document.getElementById("btn-limpar-filtro");
const dataInicioInput = document.getElementById("data-inicio");
const dataFimInput = document.getElementById("data-fim");
const tabelaLeitura = document.getElementById("tabela-leituras");

if (btnFiltrar) {
    btnFiltrar.addEventListener("click", () => {
        const dataInicioStr = dataInicioInput.value;
        const dataFimStr = dataFimInput.value;     

        if (!dataInicioStr || !dataFimStr) {
            alert("Por favor, selecione a data inicial e a data final.");
            return;
        }

        const dataInicio = new Date(dataInicioStr + "T00:00:00");
        const dataFim = new Date(dataFimStr + "T23:59:59");

        const leiturasRef = ref(db, "leituras");

        get(leiturasRef).then((snapshot) => {
            if (snapshot.exists()) {
                const dados = snapshot.val();
                tabelaLeitura.innerHTML = ""; 
                let encontrou = false;

                Object.keys(dados).forEach((id) => {
                    const item = dados[id];

                    const partesData = item.data.split("/");
                    const dataItemFormatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`;
                    const dataItem = new Date(dataItemFormatada + "T00:00:00");

                    if (dataItem >= dataInicio && dataItem <= dataFim) {
                        encontrou = true;
                        const tr = document.createElement("tr");
                        tr.innerHTML = "<td>" + item.data + " às " + item.hora + "</td>" +
                            "<td>" + item.temperatura + "ºC | Ph: " + item.ph + " | Turb :" + item.turbidez + "NTU</td>" +
                            "<td><button class='btn-acao btn-alterar' data-id='" + id + "'>Alterar</button>" +
                            "<button class='btn-acao btn-excluir' data-id='" + id + "'>Excluir</button></td>";
                        tabelaLeitura.appendChild(tr);
                    }
                });

                if (!encontrou) {
                    alert("Nenhum registo encontrado para este período.");
                }
            } else {
                alert("Não há dados no banco de dados.");
            }
        }).catch((error) => {
            console.error("Erro ao filtrar dados:", error);
        });
    });
}

if (btnLimpar) {
    btnLimpar.addEventListener("click", () => {
        dataInicioInput.value = "";
        dataFimInput.value = "";
        window.location.reload(); 
    });
}