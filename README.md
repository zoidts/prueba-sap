## Tabla de contenido
1. [Información General](#general-info)
2. [Tecnologías](#technologies)
3. [Instalación](#installation)

### Información General
***
Práctica SPA desarrollado con Laravel 9 y Vue. 

![Image text](https://repository-images.githubusercontent.com/500707715/a1143b9f-f6a3-4b50-b759-be14dea9363b)
## Tecnologías
***
Tecnologías utilizadas en el proyecto:
* [Laravel](https://laravel.com/): Version 9.x 
* [Vue Js](https://v2.vuejs.org/): Version 3.2.36
* [Axios](https://github.com/axios/axios): Version 0.25
* [vue-loader](https://vue-loader.vuejs.org/): Version 17.0.0
* [element-plus](https://element.eleme.io): Version 2.2.3
* [laravel-mix](https://laravel-mix.com/): Version 6.0.6
* [vuex](https://vuex.vuejs.org/): Version 4.0.2
* [vue-router](https://router.vuejs.org/): Version  ^4.0.15,

## Instalación
***
 **Es importante que tenga instalado [composer](https://getcomposer.org/) y [Node JS](https://nodejs.org/es/) para realizar la instalación
```
$ git clone https://github.com/zoidts/prueba-sap.git
$ Ingresar a la carpeta prueba-sap que se ha creado
$ crear archivo .env con los datos de ejemplo que contiene el archivo .env.example 
$ Ejecutar composer install en su terminal. 
$ Ejecutrar php artisan key:generate
$ Ejecutar el comando npm install
$ Crear base de datos y realizar la conexión en el archivo .env
```
***
Crear base de datos y realizar la conexión en el archivo .env 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba-sap
DB_USERNAME=root
DB_PASSWORD=
```

***
Crear las migraciones
```
 php artisan migrate 
```

***
Inciar el sistema
```
 npm run dev 
 php artisan serv

```
## importante

***
Recuperación de contraseña
```
 Para realizar pruebas de envío para recuperar la contraseña es recomendable usar -[mailtrap.io](https://mailtrap.io) y crear una cuenta gratuita
```



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
