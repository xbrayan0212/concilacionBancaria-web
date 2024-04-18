<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>
<body>
    <main id="mainTransacciones" >
        <form action="">
            <h1>Otras Transacciones - Depósitos,Ajustes y Notas(DB/CR)</h1>
            <label id="ltransaccion" for="transacciones">Transacción</label>
            <select name="transaccion" id="transaccion">
                <option value="">Seleccione una opción</option>
                <?php include '../logica/buscarOpcionTransacciones.php'; obtenerOpcionesTransacciones($conn); ?>
            </select>
            <br>
                <label for="fecha">Fecha</label>
                <input id="fechaT" class="fecha"  type="date">
                <label for="monto">Monto</label>
                <input id="montoT" type="text">
        </form>
    </main>
</body>
</html>