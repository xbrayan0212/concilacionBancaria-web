function grabarArchivo(evento) {
    evento.preventDefault();
    var xhr = new XMLHttpRequest();
    var formData = new FormData(document.getElementById('formularioArchivo'));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Los datos se han guardado exitosamente.");
                } else {
                    console.log( response.mensaje)
                    alert("Error al guardar los datos: " + response.mensaje);
                }
            }
        }
    };
    xhr.open('POST', '../logica/insertarDatos.php', true);
    xhr.send(formData);
}