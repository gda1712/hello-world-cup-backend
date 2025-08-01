# Nombre del proyecto

¡Bienvenido al repositorio de la Hello World Cup 2025!

Este es el backend de la aplicación, desarrollado con **Laravel**.

## Requisitos del sistema

Antes de empezar, asegúrate de tener instalados los siguientes componentes:

* **PHP 8.2** o superior
* **Composer**
* **MySQL**

## Instalación del proyecto

Sigue estos pasos para poner en marcha el proyecto en tu máquina local:

1.  **Clona el repositorio:**

    ```bash
    git clone [https://github.com/gda1712/hello-world-cup-backend](https://github.com/gda1712/hello-world-cup-backend)
    cd [hello-world-cup-backend]
    ```

2.  **Instala las dependencias de Composer:**

    ```bash
    composer install
    ```

3.  **Configura el archivo de entorno:**

    Copia el archivo `.env.example` y renómbralo a `.env`.

    ```bash
    cp .env.example .env
    ```

4.  **Genera la clave de la aplicación:**

    ```bash
    php artisan key:generate
    ```

5.  **Configura la base de datos:**

    Abre el archivo `.env` y configura las credenciales de tu base de datos MySQL.

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tu_bd
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

6.  **Ejecuta las migraciones de la base de datos:**

    Esto creará las tablas necesarias.

    ```bash
    php artisan migrate
    ```

7.  **Inicia el servidor de desarrollo:**

    ```bash
    php artisan serve
    ```

¡Listo! La aplicación estará disponible en `http://127.0.0.1:8000`.
