# Pallo: Setup

Installer hooks for the [Composer](http://getcomposer.org) dependency manager.

## How To Use

Define your composer package with _pallo-setup_ as type.

By doing so, you can create the following files which will be included when your package is installed, updated or uninstalled:

* src/install.php
* src/update.php
* src/uninstall.php 