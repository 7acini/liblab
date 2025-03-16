//validacao form login
function validaLogin(){
    msg = "";
    if(document.form1.email.value == ""){
        msg+="Preencha o EMAIL!\n";
    }
    if(document.form1.pwd.value == ""){
        msg+="Preencha a SENHA!\n";
    }
    if(document.form1.pwd.value < 5){
        msg+="A SENHA necessita de no mínimo 5 dígitos, por favor retorne!\n";
    }
    if(!msg == ""){
        alert(msg);
        return false;
    }else{
        return true; //irá para o evento onsubmit
    }
}

function validaCadastro(){
    msg = "";
    if(document.form1.email.value == ""){
        msg+="Preencha o EMAIL!\n";
    }
    if(document.form1.nomeCompleto.value <= 4){
        msg+="O NOME necessita de no mínimo 5 dígitos, por favor retorne!\n";        
    }
    if(document.form1.nomeCompleto.value == ""){
        msg+="Preencha o NOME COMPLETO!\n";
    }
    if(document.form1.pwd.value == ""){
        msg+="Preencha a SENHA!\n";
    }
    if(document.form1.pwd.value < 5){
        msg+="A SENHA necessita de no mínimo 5 dígitos, por favor retorne!\n";
    }
    if(document.form1.data.value == ""){
        msg+="Preencha a DATA!\n";
    }
    if(!msg ==""){
        alert(msg);
        return false;
    }else{
        return true; //irá para o evento onsubmit
    }
}

//validacao inserção
function validaInsert(){
    msg="";
    if(document.form1.niv.value == ""){
        msg+="Preencha o NÍVEL\n";
    }
    if(document.form1.niv.value <= "0"){
        msg+="O NÍVEL não pode ser nulo\n";
    }
    if(document.form1.perg.value == ""){
        msg+="Preencha a PERGUNTA\n";
    }
    if(document.form1.resp.value == ""){
        msg+="Preencha a RESPOSTA\n";
    }
    if(!msg ==""){
        alert(msg);
        return false;
    }else{
        return true; //irá para o evento onsubmit
    }
}

//validaVoc
function validaVoc(){
    msg = "";
    if(document.frmImage.palavra.value == ""){
        msg+="Preencha a PALAVRA!\n";
    }
    if(document.frmImage.userImage.value == ""){
        msg+="Preencha a IMAGEM!\n";        
    }
    if(!msg ==""){
        alert(msg);
        return false;
    }else{
        return true; //irá para o evento onsubmit
    }
}