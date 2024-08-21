# Sistema de Gestión de Cheques y Transacciones

Este proyecto es un sistema web diseñado para gestionar cheques, transacciones y conciliaciones financieras. Utilizando tecnologías web como HTML, CSS, JavaScript y PHP, el sistema ofrece una interfaz intuitiva y robusta para realizar diversas operaciones relacionadas con la administración de cheques y reportes financieros.

## Funcionalidades

- **Gestión de Cheques**: Emisión, anulación y verificación de cheques.
- **Transacciones Financieras**: Registro y gestión de diversas transacciones.
- **Conciliación Bancaria**: Proceso de conciliación para verificar y conciliar registros bancarios.
- **Generación de Reportes**: Herramientas para crear reportes financieros detallados.
- **Validaciones y Seguridad**: Incluye validaciones de formularios y seguridad en la gestión de datos.

## Instalación

1. Clona el repositorio en tu servidor local.
2. Configura la base de datos utilizando los scripts SQL proporcionados.
3. Ajusta las configuraciones de conexión en `conexionDB.php`.
4. Accede al sistema a través de `index.php`.

## Uso

Navega por las diferentes páginas del sistema para gestionar cheques, transacciones y generar reportes financieros. Cada módulo del sistema está diseñado para ser intuitivo y eficiente.

## Requisitos

- **Servidor Web** con soporte PHP.
- **Base de Datos MySQL** para almacenar los datos.
- **Navegador Web** compatible con HTML5, CSS3 y JavaScript.


## Estructura del Proyecto

El proyecto está organizado en las siguientes carpetas y archivos:

- **`css/`**: Contiene los estilos CSS utilizados para diseñar la interfaz de usuario del sistema.
- **`imagenes/`**: Carpeta destinada a almacenar las imágenes utilizadas en la aplicación.
- **`logica/`**: Incluye los scripts PHP que manejan la lógica del negocio y las operaciones principales del sistema:
  - **`buscarOpcionTransacciones.php`**: Lógica para buscar y gestionar opciones de transacciones.
  - **`conexionDB.php`**: Archivo que maneja la conexión a la base de datos.
  - **`insertarDatos.php`**: Script para insertar datos en las tablas correspondientes de la base de datos.
  - **`logicaCheque.php`**: Gestiona la lógica específica para el manejo de cheques.
  - **`logicaConcilacion.php`**: Lógica para la conciliación bancaria.
  - **`logicaOperaciones.php`**: Maneja las operaciones generales del sistema.
  - **`logicaReportes.php`**: Se encarga de generar reportes financieros.
  - **`usuarioDB.php`**: Maneja las operaciones relacionadas con la gestión de usuarios en la base de datos.
  - **`verificarCheque.php`**: Verifica la validez y estado de los cheques en el sistema.

- **`paginas/`**: Contiene las páginas principales de la interfaz del sistema:
  - **`anulacion.html`**: Página para la anulación de cheques.
  - **`cheques.php`**: Interfaz para la gestión de cheques.
  - **`concilacion.php`**: Página para la conciliación bancaria.
  - **`paginaInicial.html`**: Página inicial o de bienvenida al sistema.
  - **`reportes.php`**: Página para la generación de reportes financieros.
  - **`sacarCheque.html`**: Formulario para emitir o sacar un cheque.
  - **`transacciones.php`**: Página para la gestión de transacciones.

- **`scripts/`**: JavaScript que complementa la funcionalidad de las páginas:
  - **`anulacionScript.js`**: Script para la anulación de cheques.
  - **`concilacion.js`**: Script para la conciliación bancaria.
  - **`otrasTransacciones.js`**: Maneja las transacciones adicionales del sistema.
  - **`reportes.js`**: Lógica para la generación de reportes financieros.
  - **`sacarCirculacion.js`**: Script para emitir cheques.
  - **`script.js`**: Script principal que unifica funcionalidades globales.
  - **`validaciones.js`**: Maneja las validaciones de formularios en el sistema.

- **`index.php`**: Archivo principal del sistema, que funciona como punto de entrada y controlador de la aplicación.


