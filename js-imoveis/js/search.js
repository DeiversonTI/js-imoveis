
// PRECISO ENVIAR OS DADOS PARA O PHP, NÃO ESTOU CONSEGUINDO, FAREI ISSO MAIS TARDE.

async function changeValuesSearch(value) {

    const data = await fetch("http://localhost/js-imoveis/back/pages/getSearch.php", {
        method: "POST",
        body: JSON.stringify(value),
        mode: 'cors'
    })

    const resp = await data.json()

    console.log(resp.data)

    
}