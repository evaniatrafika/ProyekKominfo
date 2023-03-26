var button = document.getElementById("buttonconfirm");

document.getElementById("InputNewPass2").oninput = function () {
    document.getElementById("InputNewPass1").onkeyup = validatePassword;
    document.getElementById("InputNewPass2").onkeyup = validatePassword;
}

function validatePassword(){
    var pass2=document.getElementById("InputNewPass1").value;
    var pass1=document.getElementById("InputNewPass2").value;

    if(pass1!=pass2){
        document.getElementById("NewPass2").hidden = false;
        button.disabled = true;
    }
    else{
        document.getElementById("NewPass2").hidden = true;
        if(pass2.length <=5){
        document.getElementById("NewPass3").hidden = false;
        button.disabled = true;
        }else{
            document.getElementById("NewPass3").hidden = true;
            button.disabled = false;
        }
        
    }
}

