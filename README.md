# CELLHUB - Arquitectura de Software

Este proyecto está desarrollado en Laravel*y utiliza **MySQL de XAMPP** como base de datos.
Este es el paso a paso necesario para clonar, configurar y ejecutar el proyecto en tu máquina local.

## Requisitos previos

- Tener instalado [XAMPP](https://www.apachefriends.org/es/index.html).
- Tener instalado [Composer](https://getcomposer.org/).
- Tener instalado [PHP](https://www.php.net/downloads) (versión 8.x recomendada).
- Git para clonar el repositorio.

## Pasos de instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/ssabogall/ArquitecturaSoftware.git
cd ArquitecturaSoftware
```
### 2. Instalar dependencias de Laravel
```bash
composer install
```
### 3. Configurar el archivo .env
```bash
cp .env.example .env
```
Luego, edita el archivo `.env` para configurar la conexión a la base de datos y otras variables de entorno según tus necesidades.
Ejemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arquitectura
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Configurar la base de datos en XAMPP
- Abre el panel de control de XAMPP y asegúrate de que Apache y MySQL estén en ejecución.
- Accede a [phpMyAdmin](http://localhost/phpmyadmin/) y crea una nueva base de datos llamada igual al nombre que hayas puesto en el archivo `.env`.
- Importa el archivo `proyectofinal.sql` que se encuentra en `database/backups/proyectofinal.sql`.

### 6. Ejecutar servidor
```bash
php artisan serve
```
El servidor se ejecutará en `http://localhost:8000`.