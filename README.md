
# Proyecto final de grado - DAW
<p align="center"><img src="/public/img/logo-2.png" width="300" alt="Finca Monterruiz Logo"></p>
 **Clinica Dental Guadalquivir**
 **Por: Abel Sexto Martínez**
 **Curso 2023/24**

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
    -   Composer

## Installation de PhP

Se requiere PhP en su versión más actual [Página oficial de PhP](https://www.postgresql.org/).

Ejecuta estos comandos en tu terminal de Linux/Debian para instalar todo lo necesario.

```sh
sudo apt install php8.3 php8.3-amqp php8.3-cgi php8.3-cli php8.3-common php8.3-curl php8.3-fpm php8.3-gd php8.3-igbinary php8.3-intl php8.3-mbstring php8.3-opcache php8.3-pgsql php8.3-readline php8.3-redis php8.3-sqlite3 php8.3-xml php8.3-zip php8.3-bcmath php8.3-gmp php-imagick
```

## Instalación de PostgreSQL

Se requiere PostgreSQL en su versión más actual [Página oficial de PostgreSQL](https://php.net).

Ejecuta estos comandos en tu terminal de Linux/Debian para instalar todo lo necesario.

```sh
sudo apt install postgresql postgresql-contrib
```

A continuación crea su usuario de PostgreSQL con el comando:

```sh
sudo -u postgres createuser -P nombredeusuario
```

Y creamos una base de datos para el proyecto:

```sh
sudo -u postgres createdb -O nombreusuario nombrebasedatos
```
## Instalación de composer
```sh
 composer install
```
Hasta aquí todo lo necesario antes de descargar el proyecto.

## Descarga e instalación de Clínica Dental Guadalquivir

Puede descargarse el proyecto o directamente clonarlo desde el repositorio.

Para clonar:

-   Abra una terminal en el directorio que quiere hacer la copia
-   Utilize el siguiente comando

```sh
gh repo clone AbelSeMa/ClinicaDentalGuadalquivir
cd ClinicaDentalGuadalquivir
```

En este punto tendrá que configurar las distintas variables de entorno del proyecto. Para ello busque un archivo
llamado .env.example en la carpeta generada a partir del clonado y cambiar el nombre a .env

```sh
cp .env.example .env
```

Si abre el archivo verá que muchas de las variables están vacías. Pero vamos a rellenar las importantes para nuestro proyecto:

-   APP_KEY
-   DB_DATABASE
-   DB_USERNAME
-   DB_PASSWORD

Vamos a empezar por generar una APP_KEY:

```sh
php artisan key:generate
```

Después debes rellenar las variables:
`DB_DATABASE` con el nombre de su base de datos.
`DB_USERNAME` con el nombre del usuario creado.
`DB_PASSWORD` con su clave del usuario PostgreSQL

### Servidor de correos.

Aunque no es de vital importancia para el funcionamiento de nuestro proyecto,
algunas de las funciones si necesitan de tal servicio.
Para este proyecto yo personalmente he usado [Mailtrap.io](https://mailtrap.io/)
pero puedes usar otras como la propia de GMAIL.

Crea una cuenta en [Mailtrap.io](https://mailtrap.io/). En la pestaña de Email Testing crea un nuevo buzón para nuestro proyecto en el botón `Add inbox` y dele un nombre.

Una vex creado nuestro buzón hay que abrir la pestaña SMTP Settings y en el despegable seleccionar Larave 9+.

Copia las variables en tu archivo .env

Con esto ya habremos terminado con el archivo .env

## Paypal

Una de las funcionalidades importate es el uso de PayPal en la aplicación. Para ello dirigete a [PaypalDeveloper](https://developer.paypal.com/home) y crea una cuenta o logea si ya tenías una de Paypal.

Acceder al Panel de Desarrollador de PayPal. Aquí es donde puedes gestionar tus aplicaciones y obtener tus credenciales API. Para obtener tus credenciales API, necesitas crear una aplicación en el Dashboard de Desarrolladores:

Haz clic en "Crear Aplicación". Esto te llevará a una página donde puedes nombrar tu nueva aplicación. El nombre que elijas te ayudará a identificarla, así que preferiblente pon el nombre de la web o algo relacionado. Selecciona la cuenta de sandbox asociada que deseas usar para pruebas.
Cuando hayas creado tu aplicación en paypal podras acceder a tus credenciales, simplemente rellenas las variables:
`PAYPAL_SANDBOX_CLIENT_ID=`
`PAYPAL_SANDBOX_CLIENT_SECRET=`

Una vez puesta las credenciales y procedas a pagar en nuestra app, te hará una redirección al sitio de PayPal Dev y tendrás que acceder con tu cuenta recién creada.

## Creación de las tablas y datos
Para hacer un uso correcto de nuestra web deberás migrar las tablas a tu base de dato. Para ello ejecuta el siguiente comando en la terminal:
```sh
php artisan migrate --seed
```
`--seed` Creará en las tablas registros aleatorios para que la aplicación pueda funcionar.

# Uso del servidor laravel
Antes de hacer uso del servidor web vamos a instalar las dependecias que necesita el proyecto:
```sh
npm install
```
Para poder acceder a nuestra web desde un navegador, deberás iniciar el servidor web. Para ello:
```sh
php artisan serve
```
y en otra ventana distinta del terminal:
```sh
npm run dev
```
Y desde nuestro navegador web accedemos con la url: [http://127.0.0.1:8000/]