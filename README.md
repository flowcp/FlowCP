# FlowCP
FlowCP is an experimental, modular control panel for rAthena MMORPG emulator based on the Laravel PHP framework.
FlowCP is not production ready yet.

## Requirements
* PHP >= 7.1.3
* FlowCP is based on Laravel 5.8, so [its requirements](https://laravel.com/docs/5.8/installation#server-requirements) apply as well.
* A MySQL/MariaDB server with rAthena's database pre-installed.

## Features
* Account management (only login and register for now)
* Configurable theme
* Laravel module supported
* ~~Terrible css~~

## Development
* Install [composer](https://getcomposer.org/)
* Run `composer install` to install FlowCP's dependencies
* Add your MySQL credentials to the .env file, copy it from .env.example if it does not exist
* Run `php artisan serve`
* Access FlowCP via http://localhost/8000

## License
FlowCP is licensed under GNU Affero General Public License version 3.