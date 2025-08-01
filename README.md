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
    
    Igualmente configurar otras varaibles como

    ```ini
    APP_NAME=HelloWorldCup
    APP_ENV=local
    APP_DEBUG=true
    APP_URL=http://hello-world-cup-backend.test
    ```
    
    Nota que app url puede ser distinto, depende de como tengas configurado tu entorno

6.  **Ejecuta las migraciones de la base de datos:**

    Esto creará las tablas necesarias.

    ```bash
    php artisan migrate
    ```

6.  **Actualizar el php.ini:**

    Buscar en el php.ini la variable upload_tmp_dir, y actualizarla con la carpeta temporal, en el caso de laragon es

    ```
    upload_tmp_dir=C:/laragon/tmp
    ```

7.  **Inicia el servidor de desarrollo:**

    Si usas algún entorno como Laragon, esto no es requerido, simplemente con estar en la carpeta www e iniciar funcionará, si no cuentas con laragon puedes correr el servidor de Laravel
    ```bash
    php artisan serve
    ```

¡Listo! La aplicación estará disponible en el puerto/url configurado
