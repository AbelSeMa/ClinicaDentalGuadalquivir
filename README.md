# ClinicaDentalGuadalquivir

Proyecto final de grado - DAW
Por: Abel Sexto Martínez
Curso 2023/24

# Descripción general del proyecto

Clínica dental 'Guadalquivir' es el sitio web de la clínica que da nombre al sitio. En ella se busca
que los clientes de nuestra clinica tengan un acceso rápido y sencillo a sus citas, informes y planes
anuales (membresia).

## Funcionalidad principal de la aplicación

Se busca como funcionalidad principal, dar un servicio de reserva de citas en nuestra clínica
de forma sencilla y clara. Así como la gestión de las citas ya concertadas, pudiendo modificarlas
o anular las citas.
También se tiene acceso al historial de citas del paciente, así como la visualización de los informes
generados por los doctores.

## Objetivos generales

-   Objetivo: "gestionar las citas dentales y acceder a su información médica".
-   Casos de uso:

    -   Usuario no registado:

        -   Consultar planes y membresias
        -   Ver la información sobre planes dentales

    -   Rol paciente registrado y validado:

        -   Acceder a la información personal.
        -   Acceder a la información médica de su doctor asignado.
        -   Hacer una reserva de cita médica.
        -   Modificar sus citas médicas.
        -   Eliminar sus citas médicas.
        -   Cambiar su plan anual de pago.
        -   Darse de baja en el servicio.
        -   Consultar sus informes médicos.

    -   Rol administrador:
        -   Asignación de doctores.
        -   Crear nuevos planes anuales. (membresias)
        -   Modificar planes anuales.
        -   Borrar planes anuales.
        -   Añadir nuevos empleados.
        -   Añadir nuevos pacientes.
        -   Eliminar a los empleados.
        -   Eliminar a los pacientes.
        -   Denegar acceso a la web a los usuarios.
        -   Restablecer el acceso a la web a los usuarios.

# Usos del sistema

-   Para el uso de este proyecto en un entorno local sigue las instrucciones de instalación:
-   Debes saber que este proyecto está creado con Laravel 10, así que necesitaras:
    -   PhP
    -   Extensiónes de PhP usadas en el proyecto
    -   PostgreSQL como gestor de bases de datos

## Installation de PhP

Se requiere PhP en su versión más actual [Php 8.3](https://php.net).

Ejecuta estos comandos en tu terminal de Linux/Debian para instalar todo lo necesario.

```sh
sudo apt install php8.3 php8.3-amqp php8.3-cgi php8.3-cli php8.3-common php8.3-curl php8.3-fpm php8.3-gd php8.3-igbinary php8.3-intl php8.3-mbstring php8.3-opcache php8.3-pgsql php8.3-readline php8.3-redis php8.3-sqlite3 php8.3-xml php8.3-zip php8.3-bcmath php8.3-gmp php-imagick
```
