<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" onsubmit="grabarArchivo(event)" id="formularioArchivo" class="formularioReporte">
        <h1>Procesar Datos</h1>
        <input name="archivo" type="file" accept=".tex,.log,.dat">
        <button type="submit">Procesar Datos</button>
        <!-- Barra de progreso -->
        <progress id="barraProgreso" value="0" max="100"></progress>
        <!-- Mensaje de carga -->
        <div id="mensajeCarga" style="display: none;">Enviando datos...</div>
    </form>
    
    <div class="reporte-div">
        <form action="" onsubmit="reportar(event)" id="formularioBuscar" class="formularioBuscar">
        <h1>Reportes</h1>
            <label for="desdeF">Desde</label>
            <input id="desdeF" name="desdeF" type="date" class="reporte-input">
            <label for="hastaF">Hasta</label>
            <input id="hastaF" name="hastaF" type="date" class="reporte-input">
            <label for="nombre">Nombre</label>
            <select name="nombre" id="nombre-reporte" class="reporte-input">
                <option value="">Seleccione una Opción</option>
                <?php include '../logica/logicaReportes.php'; obtenerOpcionesNombresReportes($conn); ?>
            </select>
            <button type="submit">Buscar</button>
            <div id="resultados"></div>
        </form>
    </div>
</body>
</html>
