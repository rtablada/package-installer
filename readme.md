Laravel 4 Package Installer
===========================

[![Build Status](https://travis-ci.org/rtablada/package-installer.png?branch=master)](http://travis-ci.org/rtablada/package-installer)

This package allows for quick and easy installation of supported Laravel 4 packages.
This packages installs packages and adds any necessary ServiceProviders and Aliases.

## Installing Package Installer

This package installer is available through packagist and composer.

Add `"rtablada/package-installer": "dev-master"` to your `composer.json` or run `composer require rtablada/package-installer`.

Then you have to add `"Rtablada\PackageInstaller\PackageInstallerServiceProvider"` to your list of providers in your `app/config/app.php`. Luckily, this will be one of the last package Aliases you will ever have to add manually!

## Using this installer

This package allows for supported packages to be installed by running `php artisan package:install vendor/name`.
For instance, to install [Traffic Signs](https://github.com/rtablada/traffic-signs)(a simple error page handler) you can run `php artisan package:install rtablada/traffic-signs`.

## Developing packages for Laravel 4 Package Installer

To allow your package to be installed by Laravel 4 Package Installer, just add a `provides.json` to the root of your package.

The format for `provides.json` looks like this:

```json
{
  "providers": [
    "Illuminate\Html\HtmlServiceProvider"
  ],
  "aliases": [
    {
      "alias": "HTML",
      "facade": "Illuminate\Support\Facades\HTML"
    }
  ]
}
```

** Note that either valid JSON or invalid JSON can be written to add to the readability of the `provides.json` this is to increase human readability while allowing developers to write whichever way they prefer.
