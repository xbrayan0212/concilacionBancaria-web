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
    document.getElementById('saldoConciliadoLibroLabel').textContent = "SALDO CONCILIADO SEGÚN LIBRO AL   ";
    document.getElementById('saldoBancoLabel').textContent = "SALDO SEGÚN BANCO AL ";
    document.getElementById('saldoConciliadoBancoLabel').textContent = "SALDO CONCILIADO IGUAL AL BANCO AL  ";

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
                var fechaSeleccionada = response.ultimoDiaMesSeleccionado + " de " + response.nombreMesSeleccionado + " de " + response.anoSeleccionado;
                document.getElementById('saldoConciliadoLibroLabel').textContent += fechaSeleccionada;
                document.getElementById('saldoBancoLabel').textContent += fechaSeleccionada;
                document.getElementById('saldoConciliadoBancoLabel').textContent += fechaSeleccionada;

                // Rellenar campos de conciliación
                var conciliacion = response.conciliacion;
                document.getElementById('saldo_anterior').value = conciliacion ? conciliacion.saldo_anterior : '';
                document.getElementById('masdepositos').value = conciliacion ? conciliacion.masdepositos : '';
                document.getElementById('maschequesanulados').value = conciliacion ? conciliacion.maschequesanulados : '';
                document.getElementById('masnotascredito').value = conciliacion ? conciliacion.masnotascredito : '';
                document.getElementById('masajusteslibro').value = conciliacion ? conciliacion.masajusteslibro : '';
                document.getElementById('sub1').value = conciliacion ? conciliacion.sub1 : '';
                document.getElementById('subtotal1').value = conciliacion ? conciliacion.subtotal1 : '';
                document.getElementById('menoschequesgirados').value = conciliacion ? conciliacion.menoschequesgirados : '';
                document.getElementById('menosnotasdebito').value = conciliacion ? conciliacion.menosnotasdebito : '';
                document.getElementById('menosajusteslibro').value = conciliacion ? conciliacion.menosajusteslibro : '';
                document.getElementById('sub2').value = conciliacion ? conciliacion.sub2 : '';
                document.getElementById('saldolibros').value = conciliacion ? conciliacion.saldolibros : '';
                document.getElementById('saldobanco').value = conciliacion ? conciliacion.saldobanco : '';
                document.getElementById('masdepositostransito').value = conciliacion ? conciliacion.masdepositostransito : '';
                document.getElementById('menoschequescirculacion').value = conciliacion ? conciliacion.menoschequescirculacion : '';
                document.getElementById('masajutesbanco').value = conciliacion ? conciliacion.masajustesbanco : '';
                document.getElementById('sub3').value = conciliacion ? conciliacion.sub3 : '';
                document.getElementById('saldoconciliado').value = conciliacion ? conciliacion.saldo_conciliado : '';
            } else {
                alert("Error al obtener el último día del mes anterior.");
            }
        }
    }

    // Envía datos a lógica
    xhr.open('POST', '../logica/obtenerFecha.php', true);
    xhr.send(formData);
}
