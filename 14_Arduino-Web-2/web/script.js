function buscarDados(){
    fetch('ler.php')
      .then(resposta => resposta.json())
      .then(dados => {
        if(dados){
            const listaDeChaves = Object.keys(dados);
            const ultimaChave = listaDeChaves[listaDeChaves.length - 1];
            const ultimaLeitura = dados[ultimaChave];
    
            document.getElementById("temp").innerText = ultimaLeitura.temperatura;
            document.getElementById("umid").innerText = ultimaLeitura.umidade;
    
            const listaHtml = document.getElementById("historico");
            listaHtml.innerHTML = "";
            
            listaDeChaves.forEach(chave => {
                const item = dados[chave];
    
                listaHtml.innerHTML += `<li>Temperatura: ${item.temperatura} °C | Umidade: ${item.umidade} %<li/>`;
            });
        }
      });
}

buscarDados();
setInterval(buscarDados, 5000);