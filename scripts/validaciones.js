
function validarCheque() {
    var numeroCheque = document.getElementById('cheque').value.trim();
    var mensajeError = document.getElementById('checkCheque');

    // Verificar si el número de cheque está vacío
    if (numeroCheque === "") { 
        mensajeError.innerHTML = 'Por favor ingrese un número de cheque.';
        mensajeError.style.backgroundColor = 'rgba(255, 255, 0, 0.7)';
        document.getElementById('cheque').focus();
        return;
    }

    // Realizar una solicitud AJAX al servidor para verificar el número de cheque
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../logica/verificarCheque.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'existe') {
                    mensajeError.innerHTML = 'Número de Cheque ya existente';
                    mensajeError.style.backgroundColor = 'rgba(255, 0, 34, 0.7)';
                    document.getElementById('cheque').focus();
                } else {
                    mensajeError.innerHTML = 'El número de Cheque es válido.'; 
                    mensajeError.style.backgroundColor = 'rgba(0, 255, 38, 0.7)';
                }
            } else {
                // Manejar errores de la solicitud AJAX
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send('nCheque=' + encodeURIComponent(numeroCheque));
}
//campos vacios UwU
function validarCampo(event) {
    let input = event.target;
    
    if (input.value.trim() === '') {
        input.focus(); // Mantener el foco en el campo vacío
    }
}

//validar lol
function validarFormulario(event) {
    event.preventDefault(); // Evita que se envíe el formulario automáticamente
    
    // Validar campos aquí (por ejemplo, verificar si están vacíos)
    var nCheque = document.getElementById('cheque').value;
    var fecha = document.getElementById('fecha').value;
    var orden = document.getElementById('orden').value;
    var suma = document.getElementById('suma-cheque').value;
    var detalles = document.getElementById('detalle').value;
    var objeto = document.getElementById('objeto').value;
    var monto = document.getElementById('montoCheque').value;

    if (nCheque === '' || fecha === '' || orden === '' || suma === '' || detalles === '' || objeto === '' || monto === '') {
        alert("Por favor, complete todos los campos.");
        return;
    }
    // Si pasa la validación, enviar los datos mediante AJAX
    var formData = new FormData(document.getElementById('formulario'));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert("Los datos se han guardado exitosamente.");
                var mensajeError = document.getElementById('checkCheque');
                mensajeError.innerHTML = '';
                mensajeError.style.backgroundColor = 'rgba(221, 221, 221, 0';
            } else {
                alert("Error al guardar los datos: " + response.mensaje);
            }
        }
    };
    xhr.open('POST', '../logica/guardarCheque.php', true);
    xhr.send(formData);
}


function borrarmensajeCheque(){
    var mensajeError = document.getElementById('checkCheque');
                mensajeError.innerHTML = '';
                mensajeError.style.backgroundColor = 'rgba(221, 221, 221, 0';

}
