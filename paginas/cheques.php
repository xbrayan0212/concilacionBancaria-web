
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../scripts/validaciones.js" defer></script>
    <script src="../scripts/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" rel="stylesheet">
</head>
<body>

    <main id="mainCheques">
    
        <form id="formulario" onsubmit="validarFormulario(event)" >
            <h1>Creación</h1>
                <section class="contenedorCheque">
                    <div class="seccion">
                        <h2>Cheques</h2>
                        <p id="checkCheque"></p>
                            <div class="chequeNumero">
                                <label id="labelcheque" for="nCheque">NO. de Cheque</label>
                                <input id="cheque" name="nCheque" type="text" onblur="validarCheque(event);"  onkeypress="return soloNumeros(event)"  >  
                                
                            </div>
                            <label for="fecha">Fecha</label>
                            <input id="fecha" type="date" name="fecha" class="fecha input" ><br>
                            <label for="orden">Páguese a la Orden de:</label><br>
                            <select id="orden" name="ordenCheque" >
                                <option value="">Seleccione una opción</option>
                                <?php include '../logica/logicaCheque.php'; obtenerOpcionesProveedores($conn); ?>
                            </select><br>
                            <label for="suma">La Suma de:</label><br>
                            <input type="text" class="input" name="suma" id="suma-cheque" onblur="mostrarMontoEnLetras(); " onkeypress="return soloDecimal(event) && verificarPunto(event)">
                            <input type="text" class="input" name="sumaLetras" id="sumaletras-Cheque" disabled><br>
                            <label for="detalle">Detalle:</label><br>
                            <input id="detalle"I class="input" name="detalles" type="text"  onkeypress="return soloLetras(event)">
                        
                    
                    </div>
                    <div class="seccion">
                        <h2>Objetos de Gastos</h2>
                        <label for="objeto">Objeto</label>
                        <select id="objeto" name="objeto">    
                                <option value="null"></option>
                                <?php obtenerOpcionesObjetos($conn); ?>
                        </select><br>
                        <label for="monto">Monto</label><br>
                        <input type="text" name="montoCheque" id="montoCheque" readonly>
                    </div>
                </section>
            <div class="botonesCheques">
                <button type="submit" id="guardar" class="btnCheque">Guardar</button>
                <button type="reset" class="btnCheque" onclick="borrarmensajeCheque()">Nuevo</button>      
            </div>
        </form>
    </main>
    <script src="../scripts/script.js" defer></script>
</body>
</html>
