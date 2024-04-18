//funcion para evitar enviar campos vacios en la Transacciones de cheques
function validarCamposOtrasTransacciones(event){
    event.preventDefault(); // Evita que se envíe el formulario automáticamente
    var fechaT = document.getElementById('fechaT').value
    var montoT = document.getElementById('montoT').value
    var transaccion = document.getElementById('transaccion').value

    if(fechaT === '' || montoT === '' || transaccion===''){
        alert('rellene todos los campos');
        return;
    }
       // Si pasa la validación, enviar los datos mediante AJAX
       var formData = new FormData(document.getElementById('formularioTransacciones'));
       var xhr = new XMLHttpRequest();
       xhr.onreadystatechange = function() {
           if (xhr.readyState == 4 && xhr.status == 200) {
               var response = JSON.parse(xhr.responseText);
               if (response.success) {
                   alert("Los datos se han guardado exitosamente.");
               } else {
                   alert("Error al guardar los datos: " + response.mensaje);
               }
           }
       };
       //envia datos a logica
       xhr.open('POST', '../logica/insertarTransaccion.php', true);
       xhr.send(formData);
    
}