<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main id="mainTransacciones" onsubmit="validarCamposOtrasTransacciones(event);">
        <form action=""  id='formularioTransacciones'>
            <h1>Otras Transacciones - Depósitos,Ajustes y Notas(DB/CR)</h1>
            <div class="transaccion-div">
            <label id="transacciones" for="transacciones">Transacción</label>
            <select name="transaccion" id="transaccion">
                <option value="">Seleccione una opción</option>
                <?php include '../logica/buscarOpcionTransacciones.php'; obtenerOpcionesTransacciones($conn); ?>
            </select>
            <br>
                <label for="fecha">Fecha</label>
                <input id="fechaT" name='fechaT' class="fecha"  type="date">
                <label for="monto">Monto</label>
                <input id="montoT" name='montoT' type="text"  onkeypress="return soloDecimal(event) && verificarPunto(event)"><br>
                <button class="botones-transaccion"  type='submit' >Grabar</button>
                <button class="botones-transaccion" type = 'reset'>Nuevo</button>
                </div>
        </form>
    </main>
</body>
</html>