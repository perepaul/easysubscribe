## About Easysubscribe

A newsletter subscription application where users can subscribe to a website to receive updates (email) on new posts.


## Requireents

1. PHP ^7.3 || 8.0.
2. Composer ^2.0
3. And off course the knowledge of servers.

## Installation

1. clone this repository. run: git clone https://github.com/perepaul/easysubscribe.git on your terminal
2. run: **cd easysubscribe** // on your terminal
3. run: **composer install** // on your terminal to install the dependencies.
4. run: **cp .env.example .env** // on your terminal
5. run: **php artisan key:generate**
6. set your database credentials in the env file. ie. database host, port, user and password.
7. run: **php artisan migrate** on your terminal to generate the database tables.

## Endpoints

The application consist of endpoints and each carry out a specific task. Set the http Accept header to 'application/json'.

### User Endpoints

- **GET -** /api/users : Gets a paginated list of users
- **POST -** /api/users : Creates a new user
- **GET -** /api/users/{user} : Gets a single user
- **PUT -** /api/users/{user} : Updates a single user
- **DELETE -** /api/users/{user} : Soft deletes a user and its related record.


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
