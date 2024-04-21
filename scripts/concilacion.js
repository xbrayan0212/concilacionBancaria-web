function buscarFechaAnterior(event) {
    event.preventDefault(); // Evita que se envíe el formulario automáticamente
    var mes = document.getElementById('mesConcilacion').value;
    var year = document.getElementById('anoConcilacion').value;

    if (mes === '' || year === '') {
        alert('Rellene todos los campos');
        return;
    }
    // Limpia el contenido de las etiquetas antes de asignarles un nuevo valor
    document.getElementById('saldoLibro-label').textContent = "SALDO SEGÚN LIBRO AL ";
    document.getElementById('saldoConciliadoLibroLabel').textContent = "Más: ";
    document.getElementById('saldoBancoLabel').textContent = "SALDO SEGÚN BANCO AL ";
    document.getElementById('saldoConciliadoBancoLabel').textContent = "Más: ";

    // Si pasa la validación, enviar los datos mediante AJAX
    var formData = new FormData();
    formData.append('mes', mes);
    formData.append('ano', year);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response); // Agregamos esta línea para depurar la respuesta recibida
            if (response.success) {
                document.getElementById('saldoLibro-label').textContent += response.ultimoDiaMesAnterior + " DE " + response.nombreMesAnterior + " DE " + response.anoAnterior;
                var fechaSeleccionada = response.ultimoDiaMesSeleccionado + " de "+ response.nombreMesSeleccionado + " de " + response.anoSeleccionado ;
                document.getElementById('saldoConciliadoLibroLabel').textContent += fechaSeleccionada;
                document.getElementById('saldoBancoLabel').textContent += fechaSeleccionada;
                document.getElementById('saldoConciliadoBancoLabel').textContent += fechaSeleccionada;
            } else {
                alert("Error al obtener el último día del mes anterior.");
            }
        }
    }

    // Envía datos a lógica
    xhr.open('POST', '../logica/obtenerFecha.php', true);
    xhr.send(formData);
}


