//Recupera o formulário na página HTML
const formulario = document.querySelector("form");

//Inicia Função ao submeter o formulário (evento)
formulario.addEventListener("submit", (event) => {
  //Evita que o formulário faça sua ação padrão de envio dos dados nos inputs
  event.preventDefault();

  //Pega o valor inserido no campo do formulário
  let numerosExtras = document.querySelector("#numero").value;

  //Valor de adição inicial ao último número da sequência
  let adicao = 12;

  //Array que irá receber os demais números da sequência, inicialmente contendo o último valor da mesma.
  let resposta = [30];

  //Iteração do conteúdo do array
  for (let i = 0; i < numerosExtras; i++) {
    //Soma e adiciona no próximo index
    resposta[i + 1] = resposta[i] + adicao;

    //Segue a lógica de acrescentar 2 ao somados da sequência
    adicao += 2;
  }

  //Recupera campo da página onde a sequência deve ser incrementada
  const campoDeResposta = document.querySelector("#sequencia");

  //Verifica se o array não está vazio
  if (resposta.length > 1) {
    //Remove o número 30 (que já estava na sequência e está no index 0)
    resposta.shift(0);

    //Adiciona os números extras na página separados por vírgula adicionando um espaço após para melhor visualização
    campoDeResposta.innerHTML = ", " + resposta.join(", ");
  } else {
    //Quando o usuário digitar "0" no input, a sequência é zerada
    campoDeResposta.innerHTML = "";
  }
});
