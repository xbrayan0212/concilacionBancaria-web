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
                    reportar(evento)
                } else {
                    console.log( response.mensaje)
                    alert("Error al guardar los datos: " + response.mensaje);
                }
                // Ocultar la barra de progreso y el mensaje de carga después de completar la operación
                document.getElementById('barraProgreso').style.display = 'none';
                document.getElementById('mensajeCarga').style.display = 'none';
            }
        }
    }; 
    // Actualiza la barra de progreso
    xhr.upload.addEventListener("progress", function(event) {
        if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            document.getElementById('barraProgreso').value = percentComplete;
        }
    }, false);
      
    // Mostrar la barra de progreso y el mensaje de carga antes de enviar los datos
    document.getElementById('barraProgreso').style.display = 'block';
    document.getElementById('mensajeCarga').style.display = 'block';
    xhr.open('POST', '../logica/insertarDatos.php', true);
    xhr.send(formData);
}


//Funcion para haccer reporte 
function reportar(evento) {
    console.log("hola wasaa👻🐥")
    evento.preventDefault();

    const form = document.getElementById('formularioBuscar');
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../logica/logicaReportes.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('resultados').innerHTML = xhr.responseText; 
        } else {
            alert('Error al buscar los reportes');
        }
    };

    xhr.onerror = function() {
        alert('Error de red');
    };

    xhr.send(formData);
}
