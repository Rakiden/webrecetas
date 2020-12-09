# webrecetas
Proyecto 2ºDAW

Para el funcionamiento de la web será necesario tener la version 8.13.0 de Laravel y php 7.3 o superior.
Para el despliegue se recomienda Docker Hub para gestionar las imágenes.
Tras descargar el proyecto del enlace a github, tendremos un sistema de carpetas en las que se organizan el código del proyecto, la base de datos en mariadb y un phpmyadmin.

Lo primero que deberemos hacer es loguearnos en dockerhub. Acto seguido podremos, en la carpeta “php-pdo” ejecutar el comando “docker-compose up”. Todas las imágenes se montaran, se creará una base de datos y el proyecto Laravel estará listo. 
El siguiente paso sería ejecutar el comando “php artisan migrate” a nivel del proyecto, en “recetario”. Si se desea tener elementos de prueba, se puede ejecutar también “php artisan seeder”.
El último paso sería realizar “php artisan serve” y acceder a la url designada para el proyecto.

