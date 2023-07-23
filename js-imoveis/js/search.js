

async function changeValuesSearch(value) {

    // const valor = new FormData;
    // valor.append('dados', value);


    console.log(value);

    await fetch("http://localhost/js-imoveis/back/pages/getSearch.php", {
        method: "POST",
        body: value,
        mode: 'cors'
        
        
    })
    // .then(t => t.json())
    // .then(res => console.log(res))   
    // .catch((e) => console.log(e))





    
    
    
}


