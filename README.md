# Ride: Setup

Installer hooks for the [Composer](http://getcomposer.org) dependency manager.

## How To Use

Define your composer package with _ride-setup_ as type.

By doing so, you can create the following files which will be included when your package is installed, updated or uninstalled:

* src/install.php
* src/update.php
* src/uninstall.php 

## Related Modules 

- [ride/setup-app](https://github.com/all-ride/ride-setup-app)
- [ride/setup-base](https://github.com/all-ride/ride-setup-base)
- [ride/setup-cli](https://github.com/all-ride/ride-setup-cli)
- [ride/setup-cms](https://github.com/all-ride/ride-setup-cms)
- [ride/setup-web](https://github.com/all-ride/ride-setup-web)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/setup
```
