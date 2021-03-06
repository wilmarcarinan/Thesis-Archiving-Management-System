#Thesis Archiving Management System

Thesis Archiving Management System is a management system that archives thesis documents and remain retrievable for as long as they are required. This system has been developed to provide a management in records.

##What does this do?
It is a PHP/MySQL web application written in Laravel framework that records and maintains thesis files.

The users can search and view thesis documents.

##Features:
- [Laravel v5.3][1]
- [Bootstrap][2]

##Requirements:
- git (optional)
- Composer
- Laravel
- WAMP/XAMPP/LAMP

## Quick Start and Installation:

To get started and start making something of your own using this repository as a base: clone or download this repository, create an empty database that this application will use, configure a few settings in the config folder.

### Configuration

- Open up `config/database.php` and configure connection settings for your database.
- Edit the .env.example file to match your database and rename it to .env

### Installation

CD into the directory of this project and run the following commands:

1. `composer install`
2. `php artisan migrate`
3. `php artisan serve`

Note: Open your .env file and check if your APP_KEY has a value. If it does't have a value, run this in your cmd: `php artisan key:generate`

This will install all Composer dependencies, create the database structure, and run the application. Open up your browser and navigate to `localhost:8000` to see it in action. Enjoy!

[1]: https://laravel.com
[2]: http://getbootstrap.com