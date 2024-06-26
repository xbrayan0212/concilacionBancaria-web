function buscarValidar(evento) {
    evento.preventDefault();
    var nCheque = document.getElementById('Numerocheque').value;
    var mensajeError = document.getElementById('mensajeBuscar');
    var camposAdicionales = document.getElementsByClassName('contenedorDemasCampos')[0];
    if (nCheque === '') {
        alert('Por favor ingresa un número de cheque válido');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../logica/logicaOperaciones.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText); 
                var respuesta = xhr.responseText;
                if (respuesta.includes('noAnulado') ){ 
                    mensajeError.innerHTML = 'El número de cheque es válido'; // Mensaje corregido
                    mensajeError.style.backgroundColor = 'rgba(0, 255, 38, 0.7)';
                    camposAdicionales.style.display = 'block';
                    // tomo los datos y los voy agregando separandolos por el *
                    var partesRespuesta = respuesta.split('*');
                    // Actualizar los campos del formulario con los datos obtenidos//
                    document.getElementById('fechaA').value = partesRespuesta[0]; 
                    document.getElementById('ordenA').value = partesRespuesta[1]; 
                    document.getElementById('sumaA').value = partesRespuesta[2]; 
                    document.getElementById('detalleA').value = partesRespuesta[3]; 
                    mostrarMontoEnLetrasA();
                    console.log(2);
                } else if (respuesta === 'anulado') {
                    mensajeError.innerHTML = 'El número de cheque fue anulado.';
                    mensajeError.style.backgroundColor = 'rgba(255, 255, 0, 0.7)';
                    camposAdicionales.style.display = 'none';
                    console.log(3);
                } else if (respuesta === 'no_existe') {
                    mensajeError.innerHTML = 'El número de cheque no existe.';
                    mensajeError.style.backgroundColor = 'rgba(255, 0, 34, 0.7)';
                    camposAdicionales.style.display = 'none';
                    console.log(1);
                }else if (respuesta === 'fueraDeCirculacion') {
                    mensajeError.innerHTML = 'El número de cheque ya esta fuera de circulacion';
                    camposAdicionales.style.display = 'none';
                    mensajeError.style.backgroundColor = 'rgba(33, 33, 148, 0.534)';
                    console.log(4);
                }
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send('nCheque=' + encodeURIComponent(nCheque));
}
//funcion para evitar enviar campos vacios en la anulacion de cheques
function validarCamposAnulacion(event){
    console.log("holaaa"); // Corregido de console() a console.log()
    event.preventDefault(); // Evita que se envíe el formulario automáticamente
    var fechaA = document.getElementById('fechaAnulacion').value
    var detalleA = document.getElementById('detalleAnulacion').value

    if(fechaA === '' || detalleA === '' ){
        alert('rellene todos los campos');
        return;
    }
       // Si pasa la validación, enviar los datos mediante AJAX
       var formData = new FormData(document.getElementById('formularioAnulacion'));
       var xhr = new XMLHttpRequest();
       xhr.onreadystatechange = function() {
           if (xhr.readyState == 4 && xhr.status == 200) {
               var response = JSON.parse(xhr.responseText);
               if (response.success) {
                   alert("Los datos se han guardado exitosamente.");
                   // Resetear los campos del formulario
                document.getElementById('fechaAnulacion').value = '';
                document.getElementById('detalleAnulacion').value = '';
                document.getElementById('Numerocheque').value = '';
                // Ocultar nuevamente los campos adicionales
                document.getElementsByClassName('contenedorDemasCampos')[0].style.display = 'none';
                var mensajeError = document.getElementById('mensajeBuscar');
                mensajeError.innerHTML = '';
                mensajeError.style.backgroundColor = ' rgba(0, 0, 0, 0)';

               } else {
                   alert("Error al guardar los datos: " + response.mensaje);
               }
           }
       };
       //envia datos a logica
       xhr.open('POST', '../logica/insertarDatos.php', true);
       xhr.send(formData);
    
}