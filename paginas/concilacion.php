<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
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
                <?php include '../logica/obtenerFecha.php';obtenerMes($conn); ?>
                </select>
               
                <label for="anoConcilacion">Año:</label>
                <select name="anoConcilacion" id="anoConcilacion">
                <option value="" disabled selected>-</option>
                <?php obtenerYear(); ?>
                </select>
                <button id="realizarConcilacion">Realizar Concilacion</button>
                </form>
            </div>
            <section class="libro">
                <div class="labels">
                    <label for="saldoLibro" id="saldoLibro-label">SALDO SEGÚN LIBRO AL</label>
                    <label for="masDeposito">Más: Deposito</label>
                    <label for="chequesAnulados">Cheques Anulados</label>
                    <label for="notasCreditos">Notas de Crédito</label>
                    <label for="ajustes">Ajustes</label>
                    <label for="subtotal1" class="label-end">SUBTOTAL</label>
                </div>
                <div class="inputs">
                    <input disabled name="saldoLibro" id="saldo_anterior" type="text">
                    <input disabled name="masdeposito" id="masdepositos" type="text">
                    <input disabled name="chequesAnulados" id="maschequesanulados" type="text">
                    <input disabled name="masnotascredito" id="masnotascredito" type="text">
                    <input disabled name="ajustes" id="masajusteslibro" type="text">
                    <div class="div-subtotal">
                        <label for="mini-subtotal1" class="label-subtotal">Subtotal:</label>
                        <input disabled name="sub1" id="sub1"  type="text">
                    </div>
                    <input disabled  name="subtotal" id="subtotal1"  class="input-left" type="text">
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
                    <input disabled name="chequesGirados" id="menoschequesgirados" type="text">
                    <input disabled name="notasDebitos" id="menosnotasdebito" type="text">
                    <input disabled name="ajustesMenos" id="menos" type="text">
                    <div class="div-subtotal">
                        <label for="mini-subtotal2" class="label-subtotal">Subtotal:</label>
                        <input disabled name="mini-subtotal2" id="sub2"  type="text">
                    </div>
                    <input disabled  name="subtotal2" id="saldolibros" class="input-left" type="text">
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
                <input disabled name="saldoBanco" id="saldobanco" type="text">
                <input disabled name="depositoTransito" id="masdepositostransito" type="text">
                <input disabled name="ajustesMenos" id="menoschequescirculacion" type="text">
                <input disabled type="text" id="masajutesbanco">
                <div class="div-subtotal">
                    <label for="mini-subtotal2" class="label-subtotal">Subtotal:</label>
                    <input disabled name="mini-subtotal2" id="sub3" type="text">
                </div>
                <input disabled  name="subtotal2" id="saldoconciliado" class="input-left" type="text">
            </div>
        </section>
        <hr class="divisor">
        <Section class="botones">
            <button>Grabar</button>
            <button>Nuevo</button>
        </Section>
    </main>
</body>

</html>