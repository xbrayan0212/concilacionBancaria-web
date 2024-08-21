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


#Imagenes de Referencia 
## Login
![image](https://github.com/user-attachments/assets/702ddbd2-7041-4385-9858-849833f93876)
## Pagina Inicial
![image](https://github.com/user-attachments/assets/ca3762d9-2659-4cad-8039-3da9a5908d2c)
## Pagina Creacion de Cheques
![image](https://github.com/user-attachments/assets/54176c3d-17ba-4dc9-b64a-4067291778df)
## Pagina Anulacion de Cheques
![image](https://github.com/user-attachments/assets/d94c7141-c128-4589-b37c-d022835298b1)
## Pagina para Sacar fuera de Circulacion de Cheques
![image](https://github.com/user-attachments/assets/6f1986ce-ecdd-4589-b685-7f80597df60f)
## Pagina de Conciliacion
![image](https://github.com/user-attachments/assets/22e021ec-825c-43d9-8861-0787fe93a93d)
## Pagina de Reporte
![image](https://github.com/user-attachments/assets/d8b2d33d-a308-4f66-8357-c0b959f529f4)






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


