
function previewImage() {

    var image = document.querySelector("input[name=files]").files[0];
    var preview = document.querySelector('#preview');

    var reader = new FileReader();

    reader.onloadend = () =>{
        preview.src = reader.result;
    }

    if(image){
        reader.readAsDataURL(image);
    }else{
        preview.src = "";
    }

}

function previewLogo() {

    var image = document.querySelector("input[name=logo]").files[0];
    var preview = document.querySelector('#preview_logo');

    var reader = new FileReader();

    reader.onloadend = () =>{
        preview.src = reader.result;
    }

    if(image){
        reader.readAsDataURL(image);
    }else{
        preview.src = "";
    }

}


// EFEITO DARK MODE
function selDark(event){
    const selDarkBody = document.querySelector("#darkColorBody");
    const selDark = document.querySelectorAll("#darkModeColor");

    if(event.target.checked){
        selDark.forEach((res)=>{      
            res.classList.remove("dark_color")
        })    
        selDarkBody.classList.remove("dark_color_body")
    }else{
        selDark.forEach((res)=>{      
            res.classList.add("dark_color")
        })          
        selDarkBody.classList.add("dark_color_body")
    }   
}


var flexCheckDefault = document.querySelector("input[id='flexCheckDefault']");
 
function ckecked(event) {

    console.log(document.querySelector("input[type='checkbox']"))
   
    // console.log(event)
    // console.log(flexCheckDefault);
   
    if (event.target.checked) {
     
        flexCheckDefault.ckecked = true;
       localStorage.setItem("ckecado",flexCheckDefault.ckecked = true)

        console.log("ckecado")
        
        // var teste = document.content
        
    } else {
        // flexCheckDefault.removeAttribute("checked");
        flexCheckDefault.checked = false;
        console.log("BLOQUEADO")
    }
}

function atendido(id) {

      
    const xhttp = new XMLHttpRequest();    

    xhttp.onreadystatechange = () => {

        if (xhttp.readyState == 4) {
            var car = xhttp.response;
            console.log(car);
        }
    }

    xhttp.open("GET", `http://localhost/js-imoveis/back/pages/update_contato_teste.php?id=${id}`);

    xhttp.send(id);
   
//    fetch(`http://localhost/js-imoveis/back/pages/update_contato_teste.php?id=${id}`, {method: "post"}) 
   
//    .then((resp)=>{
//        return resp.json()
      
//    })
   
//     .then((res)=>{
//         console.log(res)
//     })
//     .catch(e=> console.error(e))

//     console.log("legal -> " + id )
}

function changeValuesSearch(id) {
    alert(id)
}

