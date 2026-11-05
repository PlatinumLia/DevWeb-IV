
// Configuração do firebase
const firebaseConfig = {
  apiKey: "AIzaSyDsClRAJQ7u0-36tZXclBt8mE5MOPFMjLQ",
  authDomain: "jogodavelha-767a7.firebaseapp.com",
  projectId: "jogodavelha-767a7",
  storageBucket: "jogodavelha-767a7.firebasestorage.app",
  messagingSenderId: "729007127348",
  appId: "1:729007127348:web:92f27846a381b857e3c361"
};

// Inicializando o firebase
firebase.initializeApp(firebaseConfig);

const database = firebase.database();

const celulas = document.querySelectorAll('cell');
const displayJogadorAtual = document.getElementById('current-player');
const displayPlacarX = document.getElementById('score-x');
const displayPlacarO = document.getElementById('score-o');
const botaoReiniciar = document.getElementById('restart-btn');

const salaRef = database.ref('salas/sala_teste');

let meuSimbolo = "X";

function atualizarInterface(dados){
  celulas.forEach( (celula) => {
    const indice = celula.getAttribute('data-index')
    celula.textContent = dados.tabuleiro[indice] || "";
  });

  displayJogadorAtual.textContent = dados.turno;

  displayPlacarX.textContent = dados.score.x;
  displayPlacarO.textContent = dados.score.o;

}

//verifica se há atualizações
salaRef.on('value', (snapshot) => {
  const dados = snapshot.val();

  if(dados){
    atualizarInterface(dados);
  }
});

function realizarJogada(indice){
  salaRef.once('value').then( (snapshot) => {
    const dados = snapshot.val();

    if(dados.tabuleiro[indice] !== ""){ return; }
    
    dados.tabuleiro[indice] = dados.turn;

    const vencedor = verificarVencedor(dados.tabuleiro);
    
    if(vencedor){
      const novoPlacar = { ...dados.placar };
      novoPlacar[vencedor] += 1;
      
      alert('O jogador $[vencedor} venceu!');
      reiniciarJogo();
    }else{
      // ninguém venceu == alterna a vez
      const proximoTurno = dados.turno === "X" ? "O" : "X";
      
      salaRef.update({
        tabuleiro: dados.tabuleiro,
        turno: proximoTurno
      });
    }
  });
}

function reiniciarJogo(){
  salaRef.update({
    tabuleiro: ["", "", "", "", "", "", "", ""],
    turno: "X"
  });
}

botaoReiniciar.addEventListener('click', reiniciarJogo);

celulas.forEach( (celula) => {
  celula.addEventListener('click', () => {
    const indice = celula.getAttribute('data-index');

    realizarJogada(indice);
  });
});

const combinacoesVitoria = [
  [0, 1, 2], [3, 4, 5], [6, 7, 8],
  [0, 3, 6], [1, 4, 7], [2, 5, 8],
  [0, 4, 8], [2, 4, 6]
]

function verificarVencedor(tabuleiro){
  for(let combinacao of  combinacoesVitoria){
    const [a, b, c] = combinacao;

    if(tabuleiro[a] && tabuleiro[a] === tabuleiro[b] && tabuleiro[b] === tabuleiro[c]){
      return tabuleiro[a]; // retorna "X" ou "O" se houver vencedor
    }
  }

  return null;
}