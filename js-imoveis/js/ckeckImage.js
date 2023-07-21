
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


