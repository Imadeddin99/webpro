function deleterow(reg) {
    $.ajax({
        type: 'POST',
        url: 'deleteEdit.php',
        data: { type: "delete",id:reg },
        success: function(response) {
            window.location.href="EmployeePage.php"
        }
    });

}

function editAjax(reg,first,last,email,pass,start,job) {
    var modal = document.getElementById("myModal");
    modal.style.display="block";

console.log(reg);

    document.getElementById("first").value=first;
    document.getElementById("last").value=last;
    document.getElementById("email").value=email;
    document.getElementById("pass").value=pass;
    //document.getElementById("job").value="";
  //  document.getElementById("datepicker").setDate(start);
//    $datepicker.datepicker('setDate', start);

    document.getElementById("datepicker").value=start;
document.getElementById("reg").value=""+reg;
document.getElementById("selector").value=job;

    $.ajax({
        type: 'POST',
        url: 'deleteEdit.php',
        data: { type: "delete",id:reg },
        success: function(response) {
        }
    });

}