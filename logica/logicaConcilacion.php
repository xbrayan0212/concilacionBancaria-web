<?php
include 'conexionDB.php';

function obtenerMes($conn) {
    $sql = "SELECT mes, nombre_mes FROM meses ORDER BY mes";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo '<option value="' . $fila['mes'] . '">' . $fila['nombre_mes'] . '</option>';
        }
    } else {
        echo '<option value="">No se encontraron meses</option>';
    }
}

function obtenerYear() {
    // Obtener el año actual
    $year_actual = date("Y");

    // Arreglo para almacenar los cinco años anteriores
    $years_anteriores = array();

    // Obtener los cinco años anteriores
    for ($i = 0; $i < 5; $i++) {
        $years_anteriores[] = $year_actual - $i;
    }
    foreach ($years_anteriores as $year) {
        echo "<option value=\"$year\">$year</option>";
    }
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

if (isset($_POST['mes']) && isset($_POST['ano'])) {
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];

    $resultado_anterior = obtener_ultimo_dia_mes_anterior($mes, $ano, $conn);
    $resultado_seleccionado = obtener_ultimo_dia_mes_seleccionado($mes, $ano, $conn);

    $conciliacion = obtener_conciliacion($mes, $ano, $conn);

    echo json_encode(array(
        'success' => true,
        'ultimoDiaMesAnterior' => $resultado_anterior['ultimoDiaMesAnterior'],
        'nombreMesAnterior' => $resultado_anterior['nombreMesAnterior'],
        'anoAnterior' => $resultado_anterior['anoAnterior'],
        'ultimoDiaMesSeleccionado' => $resultado_seleccionado['ultimoDiaMesSeleccionado'],
        'nombreMesSeleccionado' => $resultado_seleccionado['nombreMesSeleccionado'],
        'anoSeleccionado' => $resultado_seleccionado['anoSeleccionado'],
        'conciliacion' => $conciliacion
    ));
    exit();
}

function obtener_conciliacion($mes, $ano, $conn) {
    $sql = "SELECT * FROM conciliacion WHERE mes = $mes AND agno = $ano";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
?>
