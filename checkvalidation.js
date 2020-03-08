function checkvalidate() {
    var pass1=document.getElementById('pass1').value;
    var pass2=document.getElementById('pass2').value;
    if(pass1!==pass2){
        document.getElementById('errormsg').innerText="The two passwords are not the same";
    }
    else{
        document.getElementById('errormsg').innerText="";
    }

}