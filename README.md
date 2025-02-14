# Prueba Tecnica - Desarrollador Web

Este proyecto es una aplicación de gestión de tareas que permite agregar, eliminar, actualizar y filtrar tareas a través de llamadas a una API.

## Requisitos

- XAMPP o WAMP
- Navegador web

## Instalación

### Paso 1: Instalación de XAMPP o WAMP

#### XAMPP

##### Windows

1. Descarga XAMPP desde [Apache Friends](https://www.apachefriends.org/index.html).
2. Ejecuta el instalador y sigue las instrucciones para completar la instalación.
3. Inicia el panel de control de XAMPP y asegúrate de que los servicios de Apache y MySQL estén en ejecución.

##### Linux

1. Descarga XAMPP desde [Apache Friends](https://www.apachefriends.org/index.html).
2. Abre una terminal y navega al directorio donde descargaste el archivo.
3. Ejecuta el siguiente comando para hacer el archivo ejecutable:
    ```sh
    chmod +x xampp-linux-x64-<version>-installer.run
    ```
4. Ejecuta el instalador:
    ```sh
    sudo ./xampp-linux-x64-<version>-installer.run
    ```
5. Sigue las instrucciones para completar la instalación.
6. Inicia XAMPP con el siguiente comando:
    ```sh
    sudo /opt/lampp/lampp start
    ```

#### WAMP (solo para Windows)

1. Descarga WAMP desde [WampServer](http://www.wampserver.com/en/).
2. Ejecuta el instalador y sigue las instrucciones para completar la instalación.
3. Inicia WAMP y asegúrate de que los servicios de Apache y MySQL estén en ejecución.

### Paso 2: Configuración del Proyecto

1. Clona este repositorio en el directorio `htdocs` de XAMPP o en el directorio `www` de WAMP.
    ```sh
    git clone https://github.com/Korintios/Technical-Test-ElizaApp
    ```

### Paso 3: Configuración de la Base de Datos

1. Abre el archivo [database.php](http://_vscodecontentref_/0) y configura los parámetros de conexión a la base de datos:
    ```php
    $host = "";
    $dbname = "";
    $user = "";
    $pass = "";
    ```

### Paso 4: Configuración de la URL de la API

1. Abre el archivo [app.js](http://_vscodecontentref_/1) y configura la URL base de la API:
    ```javascript
    const URL = ""; //Ejemplo: http://localhost:3000/technical_test
    ```

### Paso 5: Ejecución del Proyecto

1. Abre tu navegador web y navega a `http://localhost/technical_test`.
2. Deberías ver la interfaz de la aplicación de gestión de tareas.