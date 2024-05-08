function buscarFechaAnterior(event) {
    event.preventDefault();
    var mes = document.getElementById('mesConcilacion').value;
    var year = document.getElementById('anoConcilacion').value;
    if (mes === '' || year === '') {
        alert('Rellene todos los campos');
        return;
    }
    limpiarEtiquetas();
    var formData = new FormData();
    formData.append('mes', mes);
    formData.append('ano', year);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success && response.conciliacion) {
                var fechaSeleccionada = response.ultimoDiaMesSeleccionado + " de " + response.nombreMesSeleccionado + " de " + response.anoSeleccionado;
                llenarCamposConciliacion(response.conciliacion);
                if (response.conciliacion.mesAnteriorConciliado) {
                    alert('Mes anterior conciliado');
                    obtenerCamposConciliacion(response.conciliacionTransacciones);
                    obtenerCamposConciliacionCheques(response.conciliacionCheques);
                    document.getElementById('saldo_anterior').value = response.conciliacion.saldo_conciliado_mes_anterior || 0;
                    document.getElementById('saldobanco').value = 0;
                    sumaSubtotales();
                } else {
                    alert('Mes anterior No Conciliado');
                }
                actualizarEtiquetas(response.ultimoDiaMesAnterior, response.nombreMesAnterior, response.anoAnterior, fechaSeleccionada);
                 // Nuevo código para asignar el saldo conciliado del mes anterior al campo "saldo_anterior"
                 

            } else {
                alert("Error al obtener el último día del mes anterior.");
            }
        }
    }
    xhr.open('POST', '../logica/logicaConcilacion.php', true);
    xhr.send(formData);
}

function limpiarEtiquetas() {
    document.getElementById('saldoLibro-label').textContent = "SALDO SEGÚN LIBRO AL ";
    document.getElementById('saldoConciliadoLibroLabel').textContent = "SALDO CONCILIADO SEGÚN LIBRO AL   ";
    document.getElementById('saldoBancoLabel').textContent = "SALDO SEGÚN BANCO AL ";
    document.getElementById('saldoConciliadoBancoLabel').textContent = "SALDO CONCILIADO IGUAL AL BANCO AL  ";
}

function actualizarEtiquetas(ultimoDiaMesAnterior, nombreMesAnterior, anoAnterior, fechaSeleccionada) {
    document.getElementById('saldoLibro-label').textContent += ultimoDiaMesAnterior + " DE " + nombreMesAnterior + " DE " + anoAnterior;
    document.getElementById('saldoConciliadoLibroLabel').textContent += fechaSeleccionada;
    document.getElementById('saldoBancoLabel').textContent += fechaSeleccionada;
    document.getElementById('saldoConciliadoBancoLabel').textContent += fechaSeleccionada;
}

function llenarCamposConciliacion(conciliacion) {
    console.log("Datos de conciliacionTransacciones:", conciliacion);
    var fields = ['saldo_anterior', 'masdepositos', 'maschequesanulados', 'masnotascredito', 'masajusteslibro', 'sub1', 'subtotal1', 'menoschequesgirados', 'menosnotasdebito', 'menosajusteslibro', 'sub2', 'saldolibros', 'saldobanco', 'masdepositostransito', 'menoschequescirculacion', 'masajustesbanco', 'sub3', 'saldo_conciliado'];
    fields.forEach(function(field) {
        document.getElementById(field).value = conciliacion ? conciliacion[field] : '';
    });
}

function obtenerCamposConciliacion(conciliacionTransacciones) {
    console.log("Datos de conciliacionTransacciones:", conciliacionTransacciones);
    var fields = ['masdepositos', 'masnotascredito', 'masajusteslibro', 'menosnotasdebito', 'menosajusteslibro', 'masdepositostransito', 'masajustesbanco'];
    fields.forEach(function(field) {
        document.getElementById(field).value = conciliacionTransacciones && conciliacionTransacciones.transacciones ? conciliacionTransacciones.transacciones[field] : '';
    });
}

function obtenerCamposConciliacionCheques(conciliacionCheques) {
    console.log("Datos de conciliacionCheques:", conciliacionCheques); 
    var fields = ['maschequesanulados', 'menoschequesgirados', 'menoschequescirculacion'];
    fields.forEach(function(field) {
        document.getElementById(field).value = conciliacionCheques && conciliacionCheques.cheques ? conciliacionCheques.cheques[field] : '';
    });
}
function sumaSubtotales() {
    // Obtener los valores de las transacciones y cheques
    var masdepositos = parseFloat(document.getElementById('masdepositos').value) || 0;
    var chequesanulados = parseFloat(document.getElementById('maschequesanulados').value) || 0;
    var notascredito = parseFloat(document.getElementById('masnotascredito').value) || 0;
    var masajusteslibros = parseFloat(document.getElementById('masajusteslibro').value) || 0;
    var chequesgirados = parseFloat(document.getElementById('menoschequesgirados').value) || 0;
    var menosnotasdebitos = parseFloat(document.getElementById('menosnotasdebito').value) || 0;
    var masdepositostransito = parseFloat(document.getElementById('masdepositostransito').value) || 0;
    var menoschequescirculacion = parseFloat(document.getElementById('menoschequescirculacion').value) || 0;
    var masajustesbanco = parseFloat(document.getElementById('masajustesbanco').value) || 0;
    var saldo_anterior = parseFloat(document.getElementById('saldo_anterior').value) || 0;
    var saldo_conciliado = parseFloat(document.getElementById('saldo_conciliado').value) || 0;

    // Calcular subtotales
    var sub1 = masdepositos - chequesanulados + notascredito + masajusteslibros;
    var sub2 = chequesgirados - menosnotasdebitos;
    var sub3 = masdepositostransito - menoschequescirculacion + masajustesbanco;
    var total1= saldo_anterior + sub1;
    var total2 = total1 + sub2;
    var total3 = total2 + saldo_conciliado;
    // Mostrar los resultados en los campos correspondientes
    document.getElementById('sub1').value = sub1.toFixed(2);
    document.getElementById('sub2').value = sub2.toFixed(2);
    document.getElementById('sub3').value = sub3.toFixed(2);
     document.getElementById('subtotal1').value = total1.toFixed(2);
    document.getElementById('saldolibros').value = total2.toFixed(2);
    document.getElementById('saldo_conciliado').value = total3.toFixed(2);

}
function guardarConciliacion(event) {
    event.preventDefault();

    var mes = document.getElementById('mesConcilacion').value;
    var year = document.getElementById('anoConcilacion').value;
 
    // Obtener los valores del formulario
    var formData = new FormData(document.getElementById('formularioDatosConcilacion'));
    var xhr = new XMLHttpRequest();
    // Agregar mes y año al formData
    formData.append('mesConcilacion', mes);
    formData.append('anoConcilacion', year);
    
    // Si 'sub3' representa un campo en el formulario, puedes obtener su valor de la siguiente manera:
    var sub3 = document.getElementById('sub3').value;
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.ola) {
                    alert(response.mensaje);
                } else {
                    alert(response.mensaje);
                }
            } else {
                alert('Error al intentar guardar la conciliación. Inténtalo de nuevo más tarde.');
            }
        }
    };

    xhr.open('POST', '../logica/logicaConcilacion.php', true);
    xhr.send(formData);
}

