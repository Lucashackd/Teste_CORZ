formulario = document.querySelector("form")     //Busca o elemento de formulário no HTML

/**
 * Declaração de variáveis
 */
let precoItem = []                      //Array com os valores digitados
let valorTotal = Number()               //Soma simples do valores digitados
let valorTotalDesconto = Number()       //Soma dos valores após a plicação do desconto
let desconto = Number()                 //Valor descontado do item
let descontoTotal = Number()            //Valor do desconto sobre os valores finais
let quantidade = Number()               //Quantidade de valores no array

/**Função atrelada ao submeter o formulário, ou seja, clicar no botão "Adicionar Item"
 * Inclui os valores digitados em um array e calcula a soma dos valores e a quantidade de itens no array
 */
formulario.addEventListener("submit", (event) => {
    event.preventDefault()                                          //Previne o envio do formulário (comportamento padrão)

    ultimoItem = Number(document.querySelector("#preco").value)     //Intercepta o valor enviado pelo campo
    precoItem.push(ultimoItem)                                      //Adiciona o valor no array
    valorTotal = valorTotal + ultimoItem                            //Atualiza a soma dos valores do array
    quantidade = precoItem.length                                   //Atualiza a quantidade de valores(itens) no array

    document.querySelector("#preco").value = ""                     //Limpa o campo do formulário
})

/**Função atrelada ao clicar no botão "Finalizar Compra"
 * Encerra a adição de itens, calcula os descontos e exibe a nota na tela
 */
function emitirNota() {
    const desconto5 = 0.05                                      //Constante com o valor de desconto de 5%
    const desconto10 = 0.10                                     //Constante com o valor de desconto de 10%

    if (valorTotal > 100) {                                     //Verifica o valor total do itens no array
        desconto = valorTotal * desconto5                       //Calcula o desconto de 5% em relação ao preço total
        valorTotalDesconto = valorTotal - desconto              //Calcula o valor final dos itens com o desconto aplicado
        if (valorTotal > 200) {                                     //Verifica o valor total do itens no array
            desconto = valorTotalDesconto * desconto10              //Calcula o desconto adicional de 10% em cima do valor descontado inicialmente
            valorTotalDesconto = valorTotalDesconto - desconto      //Calcula o valor final dos itens com os descontos aplicados  
        }
        descontoTotal = valorTotal - valorTotalDesconto         //Calcula o total do desconto
    } else {
        valorTotalDesconto = valorTotal     //Mantem o valor inicial como valor final (sem descontos)
        descontoTotal = 0                   //Zera o valor de desconto para compras menores de $100
    }

    /**
     * Variáveis DOM para inclusão dos resultados na página
     */
    const respostaValor = document.querySelector("#valorTotal")
    respostaValor.innerHTML = " Valor total: " + valorTotal.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})

    const respostaValorTotal = document.querySelector("#valorTotalDesconto")
    respostaValorTotal.innerHTML = "Valor Final: " + valorTotalDesconto.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})

    const respostaValorDesconto = document.querySelector("#valorDesconto")
    respostaValorDesconto.innerHTML = "Desconto: " + descontoTotal.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})

    const respostaQuantidade = document.querySelector("#quantidade")
    if (quantidade > 1) {
        respostaQuantidade.innerHTML = "Quantidade: " + quantidade + " itens"       //Singular para item único
    } else {
        respostaQuantidade.innerHTML = "Quantidade: " + quantidade + " item"        //Plural para múltiplos itens
    }
    

    /**
     * Zerando as variáveis para emitir nova nota de compras atualizada com novos items a serem inseridos
     */
    precoItem.length = 0
    valorTotal = 0
    valorTotalDesconto = 0
    desconto = 0
    quantidade = 0
}