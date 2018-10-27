# Admission

App buit to manage school admission interview process

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Requirements for running this app 

```
Vagrant
VirtualBox/or other compatible VM software
Laravel Homestead
```

### Installing

* Clone this repo
* Login to the Homestead
* CD to directory where your app is
* Generate your ``.env`` file ``cp .env.example .env``
* Run ``composer install``
* ``php artisan key:generate`` if it's not generated after the installation
* Edit ``.env`` file
* ``php artisan migrate --seed``    

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Bootstrap](https://getbootstrap.com/) - CSS Library


## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Bosko Stupar** - *Initial work* - [shkabo](https://github.com/shkabo)

See also the list of [contributors](https://github.com/your/tagalytic/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc

