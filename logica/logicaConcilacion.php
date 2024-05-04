<?php
include 'conexionDB.php';

function obtenerMes($conn) {
    $sql = "SELECT mes, nombre_mes FROM meses ORDER BY mes";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $options = '';
        while ($fila = $resultado->fetch_assoc()) {
            $options .= '<option value="' . $fila['mes'] . '">' . $fila['nombre_mes'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">No se encontraron meses</option>';
    }
}

function obtenerYear() {
    $year_actual = date("Y");
    $options = '';
    for ($i = 0; $i < 5; $i++) {
        $year = $year_actual - $i;
        $options .= "<option value=\"$year\">$year</option>";
    }
    echo $options;
}

if (isset($_POST['mes']) && isset($_POST['ano'])) {
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];

    $resultado_anterior = obtener_ultimo_dia_mes_anterior($mes, $ano, $conn);
    $resultado_seleccionado = obtener_ultimo_dia_mes_seleccionado($mes, $ano, $conn);

    $conciliacion = obtener_conciliacion($mes, $ano, $conn);
    $conciliacion1= realizarConciliacion($mes, $ano, $conn);
    $cheques= realizarConciliacionCheques($mes, $ano, $conn);

    echo json_encode(array(
        'success' => true,
        'ultimoDiaMesAnterior' => $resultado_anterior['ultimoDiaMesAnterior'],
        'nombreMesAnterior' => $resultado_anterior['nombreMesAnterior'],
        'anoAnterior' => $resultado_anterior['anoAnterior'],
        'ultimoDiaMesSeleccionado' => $resultado_seleccionado['ultimoDiaMesSeleccionado'],
        'nombreMesSeleccionado' => $resultado_seleccionado['nombreMesSeleccionado'],
        'anoSeleccionado' => $resultado_seleccionado['anoSeleccionado'],
        'conciliacion' => $conciliacion,
        'conciliacionTransacciones' => $conciliacion1,
        'conciliacionCheques' => $cheques
    ));
    exit();
}

function obtener_ultimo_dia_mes_anterior($mes, $ano, $conn) {
    $mes_anterior = $mes - 1;
    $ano_anterior = $ano;
    if ($mes_anterior == 0) {
        $mes_anterior = 12;
        $ano_anterior--;
    }
    $sql = "SELECT dia, nombre_mes, abreviatura FROM meses WHERE mes = $mes_anterior";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimo_dia = $row['dia'];
        $nombre_mes = $row['nombre_mes'];
    } else {
        $ultimo_dia = '';
        $nombre_mes = '';
    }
    return array(
        'ultimoDiaMesAnterior' => $ultimo_dia,
        'nombreMesAnterior' => $nombre_mes,
        'anoAnterior' => $ano_anterior
    );
}

function obtener_ultimo_dia_mes_seleccionado($mes, $ano, $conn) {
    $sql = "SELECT dia, nombre_mes, abreviatura FROM meses WHERE mes = $mes";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimo_dia = $row['dia'];
        $nombre_mes = $row['nombre_mes'];
    } else {
        $ultimo_dia = '';
        $nombre_mes = '';
    }
    return array(
        'ultimoDiaMesSeleccionado' => $ultimo_dia,
        'nombreMesSeleccionado' => $nombre_mes,
        'anoSeleccionado' => $ano
    );
}

function obtener_conciliacion($mes, $ano, $conn) {
    $sql = "SELECT * FROM conciliacion WHERE mes = $mes AND agno = $ano";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        $mes_anterior = $mes - 1;
        $ano_anterior = $ano;
        if ($mes_anterior == 0) {
            $mes_anterior = 12;
            $ano_anterior--;
        }
        $sql_mes_anterior = "SELECT * FROM conciliacion WHERE mes = $mes_anterior AND agno = $ano_anterior";
        $result_mes_anterior = $conn->query($sql_mes_anterior);
        if ($result_mes_anterior && $result_mes_anterior->num_rows > 0) {
            realizarConciliacion($mes, $ano, $conn);
            return array(
                'mesAnteriorConciliado' => true,
            );
        } else {
            $resultado_mes_anterior = obtener_ultimo_dia_mes_anterior($mes, $ano, $conn);
            return array(
                'mesAnteriorConciliado' => false,
            );
        }
    }
}

function realizarConciliacion($mes, $ano, $conn) {
    $transacciones = array(
        1 => 'masdepositos',
        2 => 'masnotascredito',
        3 => 'masajusteslibro',
        4 => 'menosnotasdebito',
        5 => 'menosajusteslibro',
        6 => 'masdepositostransito',
        7 => 'masajustesbanco',
        8 => 'Transferencia',
        9 => 'Transferencia - Apoyo Extraordinario'
        
    );
    $totales = array();
    foreach ($transacciones as $numero => $transaccion) {
        $sql = "SELECT SUM(monto) AS total FROM otros WHERE transaccion = '$numero' AND MONTH(fecha) = $mes AND YEAR(fecha) = $ano";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $total = $row['total'];
            if ($total === null) {
                $total = 0;
            }
            $totales[$transaccion] = $total;
        } else {
            // Handle query errors
        }
    }
    return array(
        'transacciones' => $totales,
    );
}
function realizarConciliacionCheques($mes, $ano, $conn) {
    $estadosCheque = array(
        'menoschequesgirados',
        'maschequesanulados',
        'menoschequescirculacion'
    );
    $totalesCheques = array();
    foreach ($estadosCheque as $estado) {
        switch ($estado) {
            case 'menoschequescirculacion':
                $sql = "SELECT SUM(monto) AS total FROM cheques WHERE fecha_circulacion IS NOT NULL AND fecha_circulacion != '0000-00-00' AND MONTH(fecha_circulacion) = $mes AND YEAR(fecha_circulacion) = $ano";
                break;
            case 'maschequesanulados':
                $sql = "SELECT SUM(monto) AS total FROM cheques WHERE fecha_anulado IS NOT NULL AND fecha_anulado != '0000-00-00' AND MONTH(fecha_anulado) = $mes AND YEAR(fecha_anulado) = $ano";
                break;
            case 'menoschequesgirados':
                $sql = "SELECT SUM(monto) AS total FROM cheques WHERE fecha_circulacion IS NULL AND fecha_anulado IS NULL AND MONTH(fecha) = $mes AND YEAR(fecha) = $ano";
                break;
            default:
                $sql = "";
                break;
        }
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $total = $row['total'];
            if ($total === null) {
                $total = 0;
            }
            $total = round($total, 2);
            $totalesCheques[$estado] = $total;
        } else {
            // Handle query errors
        }
    }
    return array(
        'cheques' => $totalesCheques,
    );
}
?>