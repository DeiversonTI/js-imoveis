
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


