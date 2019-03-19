[![Build Status](https://travis-ci.org/sanchescom/laravel-phpsocket.io.svg?branch=master)](https://travis-ci.org/sanchescom/laravel-phpsocket.io)
[![codecov](https://codecov.io/gh/sanchescom/laravel-phpsocket.io/branch/master/graph/badge.svg)](https://codecov.io/gh/sanchescom/laravel-phpsocket.io)
[![Maintainability](https://api.codeclimate.com/v1/badges/852384730259754d4008/maintainability)](https://codeclimate.com/github/sanchescom/laravel-phpsocket.io/maintainability)
[![StyleCI](https://github.styleci.io/repos/175257648/shield?branch=master)](https://github.styleci.io/repos/175257648)
[![Quality Score](https://img.shields.io/scrutinizer/g/sanchescom/laravel-phpsocket.io.svg?style=flat-square)](https://scrutinizer-ci.com/g/sanchescom/laravel-phpsocket.io)
# Laravel with phpsocket.io

This is Laravel package for phpsocket.io which is a server side alternative implementation of socket.io in PHP based on Workerman.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require sanchescom/laravel-phpsocket.io
```

And repeat

```
until finished
```

## Usage

``` php
<?php

namespace Vendor\Package;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
        $this->publishConfig();
        $this->publishViews();
        $this->publishAssets();
        $this->loadViews();
        $this->loadTranslations();
    }

    public function register()
    {
        $this->mergeConfig();
    }
}
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

``` bash
$ phpunit
```

### And coding style tests

Explain what these tests test and why

``` bash
$ composer check-style
```

## Deployment

Add additional notes about how to deploy this on a live system

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Efimov Aleksandr** - *Initial work* - [Sanchescom](https://github.com/sanchescom)

See also the list of [contributors](https://github.com/sanchescom/laravel-phpsocket.io/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

