function buscarValidarSacarCirculacion(evento) {
    evento.preventDefault();
    var nCheque = document.getElementById('NumerochequeS').value;
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
                    document.getElementById('fechaS').value = partesRespuesta[0]; 
                    document.getElementById('ordenS').value = partesRespuesta[1]; 
                    document.getElementById('sumaS').value = partesRespuesta[2]; 
                    document.getElementById('detalleS').value = partesRespuesta[3]; 
                    //para mostrar en letras en el campo monto//
                    mostrarMontoEnLetrasSacarCirculacion();
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
                    mensajeError.style.backgroundColor = ' rgba(114, 4, 100, 0.678)';
                    console.log(4);
                }
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send('nCheque=' + encodeURIComponent(nCheque));
}

//funcion para evitar enviar campos vacios en la Circulacion de cheques
function validarCamposSacarCirculacion(event){
    event.preventDefault(); // Evita que se envíe el formulario automáticamente
    var fechaS = document.getElementById('fechaSacarCirculacion').value

    if(fechaS === ''){
        alert('rellene todos los campos');
        return;
    }
       // Si pasa la validación, enviar los datos mediante AJAX
       var formData = new FormData(document.getElementById('formularioSacar'));
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
       xhr.open('POST', '../logica/insertarDatos.php', true);
       xhr.send(formData);
    
}