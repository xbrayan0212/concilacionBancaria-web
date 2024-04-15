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
    xhr.open('POST', '../logica/buscarCheque.php', true);
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
                    var partesRespuesta = respuesta.split(',');
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
