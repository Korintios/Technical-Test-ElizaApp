# Prueba Tecnica - Desarrollador Web

Este proyecto es una aplicación de gestión de tareas que permite agregar, eliminar, actualizar y filtrar tareas a través de llamadas a una API.

## Requisitos

- XAMPP o WAMP
- Navegador web

## Instalación

### Paso 1: Instalación de XAMPP o WAMP

#### XAMPP

1. Descarga XAMPP desde [Apache Friends](https://www.apachefriends.org/index.html).
2. Ejecuta el instalador y sigue las instrucciones para completar la instalación.
3. Inicia el panel de control de XAMPP y asegúrate de que los servicios de Apache y MySQL estén en ejecución.

#### WAMP

1. Descarga WAMP desde [WampServer](http://www.wampserver.com/en/).
2. Ejecuta el instalador y sigue las instrucciones para completar la instalación.
3. Inicia WAMP y asegúrate de que los servicios de Apache y MySQL estén en ejecución.

### Paso 2: Configuración del Proyecto

1. Clona este repositorio en el directorio `htdocs` de XAMPP o en el directorio `www` de WAMP.
    ```sh
    git clone https://github.com/tu-usuario/tu-repositorio.git
    ```

2. Importa la base de datos:
    - Abre phpMyAdmin desde el panel de control de XAMPP o WAMP.
    - Crea una nueva base de datos llamada [tasks](http://_vscodecontentref_/0).
    - Importa el archivo [tasks.sql](http://_vscodecontentref_/1) que se encuentra en el directorio raíz del proyecto.

### Paso 3: Configuración de la Base de Datos

1. Abre el archivo [database.php](http://_vscodecontentref_/2) y configura los parámetros de conexión a la base de datos:
    ```php
    $host = "127.0.0.1";
    $dbname = "tasks";
    $user = "root";
    $pass = "P@ssw0rd123!";
    ```

### Paso 4: Configuración de la URL de la API

1. Abre el archivo [app.js](http://_vscodecontentref_/3) y configura la URL base de la API:
    ```javascript
    const URL = "http://localhost/tu_proyecto";
    ```

### Paso 5: Ejecución del Proyecto

1. Abre tu navegador web y navega a `http://localhost/tu_proyecto`.
2. Deberías ver la interfaz de la aplicación de gestión de tareas.

## Uso

- **Agregar Tarea:** Escribe el título de la tarea en el campo de entrada y presiona la tecla Enter.
- **Completar/Descompletar Tarea:** Haz clic en la casilla de verificación junto a la tarea.
- **Editar Tarea:** Haz clic en el botón de editar (icono de lápiz) junto a la tarea.
- **Eliminar Tarea:** Haz clic en el botón de eliminar (icono de basura) junto a la tarea.
- **Filtrar Tareas:** Usa los botones de filtro para mostrar todas las tareas, solo las pendientes o solo las completadas.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para obtener más detalles.