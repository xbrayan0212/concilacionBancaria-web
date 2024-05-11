<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main id="concilacionMain">
        <h1 class="titulo">Concilacion Bancaria</h1>
        <section id="concilacionSeccion">
            <form action="" onsubmit=" buscarFechaAnterior(event)" id="formularioConcilacion">
            <div class="seccion-1">
                <label for="mesConcilacion">Mes:</label>
                <select name="mesConcilacion" id="mesConcilacion">
                <option value="" disabled selected>-</option>
                <?php include '../logica/logicaConcilacion.php';obtenerMes($conn); ?>
                </select>
               
                <label for="anoConcilacion">Año:</label>
                <select name="anoConcilacion" id="anoConcilacion">
                <option value="" disabled selected>-</option>
                <?php obtenerYear(); ?>
                </select>
                <button id="realizarConcilacion">Realizar Concilacion</button>
                </form>
            </div>
            <form action="" onsubmit="guardarConciliacion(event)"  id="formularioDatosConcilacion">
            <section class="libro">
                <div class="labels">
                    <label for="saldoLibro" id="saldoLibro-label">SALDO SEGÚN LIBRO AL</label>
                    <label for="masDeposito">Más: Deposito</label>
                    <label for="chequesAnulados">Cheques Anulados</label>
                    <label for="notasCreditos">Notas de Crédito</label>
                    <label for="ajustes">Ajustes</label>
                    <label for="subtotal1" id="labelsub1" class="label-end">SUBTOTAL</label>
                </div>
                <div class="inputs">
                    <input readonly name="saldo_anterior" id="saldo_anterior" type="text">
                    <input readonly name="masdepositos" id="masdepositos" type="text">
                    <input readonly name="maschequesanulados" id="maschequesanulados" type="text">
                    <input readonly name="masnotascredito" id="masnotascredito" type="text">
                    <input readonly name="masajusteslibro" id="masajusteslibro" type="text">
                    <div class="div-subtotal">
                        <label for="mini-subtotal1" class="label-subtotal">Subtotal:</label>
                        <input readonly  name="sub1" id="sub1"  type="text">
                    </div>
                    <input  readonly  name="subtotal1" id="subtotal1"  class="input-left" type="text">
                </div>
            </section>
            <!--segun parte libro-->
            <section class="libro dos">
                <div class="labels">
                    <label for="chequesGirados">Menos: Cheques girados en el mes</label>
                    <label for="notasDebitos">Notas de Debitos</label>
                    <label for="ajustesMenos">Ajustes</label>
                    <label for="saldoConciliado" id="saldoConciliadoLibroLabel" class="label-end">SALDO CONCILIADO SEGÚN EL LIBRO AL</label>
                </div>
                <div class="inputs">
                    <input readonly  name="menoschequesgirados" id="menoschequesgirados" type="text">
                    <input readonly name="menosnotasdebito" id="menosnotasdebito" type="text">
                    <input readonly name="menosajusteslibro" id="menosajusteslibro" type="text">
                    <div class="div-subtotal">
                        <label for="mini-subtotal2" class="label-subtotal">Subtotal:</label>
                        <input readonly  name="sub2" id="sub2"  type="text">
                    </div>
                    <input readonly  name="saldolibros" id="saldolibros" class="input-left" type="text">
                </div>
            </section>
            <hr class="divisor">
           <!--Banco--> 
           <section class="banco">
            <div class="labels">
                <label for="saldoBanco" id="saldoBancoLabel">SALDO EN BANCO AL</label>
                <label for="depositoTransito">Mas: Dépositos en Transito</label>
                <label for="chequesCirculacion">Menos: Cheques en Circulación</label>
                <label for="ajustesBanco">Mas: Ajustes</label>
                <label for="saldoBanco" id="saldoConciliadoBancoLabel" class="label-end">SALDO CONCILIADO IGUAL A BANCO AL</label>
            </div>
            <div class="inputs">
                    <input   name="saldobanco" id="saldobanco" type="text">
                    <input readonly name="masdepositostransito" id="masdepositostransito" type="text">
                    <input readonly name="menoschequescirculacion" id="menoschequescirculacion" type="text">
                    <input readonly name="masajustesbanco" id="masajustesbanco" type="text">
                <div class="div-subtotal">
                    <label for="mini-subtotal2" class="label-subtotal">Subtotal:</label>
                    <input readonly name="sub3" id="sub3" type="text">
                </div>
                <input readonly  name="saldo_conciliado" id="saldo_conciliado" class="input-left" type="text">
            </div>
        </section>
        <hr class="divisor">
        <Section class="botones">
            <button disabled type="submit" id="botongrabar">Grabar</button>
            <button type="reset">Nuevo</button>
        </Section>
        </form>
    </main>
</body>

</html>